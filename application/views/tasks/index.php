<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>

            <div class="card-body">
                <table class="table tabe-hover table-condensed" id="list">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="20%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead class="thead-light">
                        <tr>
                            <th class=" text-center">#</th>
                            <th>Project</th>
                            <th>Task</th>
                            <th>Project Started</th>
                            <th>Project Due Date</th>
                            <th>Project Status</th>
                            <th>Task Status</th>
                            <?php if ($user['role_id'] != 4) : ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $where = "";
                        if ($user['role_id'] == 2) {
                            $where = " where p.manager_id = '{$user['id']}' ";
                        } elseif ($user['id'] == 3) {
                            $where = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[{$user['id']}]%' ";
                        }

                        $stat = array("Pending", "Started", "On-Progress", "On-Hold", "Over Due", "Done");
                        $qry = $this->db->query("SELECT t.*,p.name as pname,p.start_date,p.status as pstatus, p.end_date,p.id as pid FROM tasks t inner join project p on p.id = t.project_id $where order by p.name asc");
                        foreach ($qry->result_array() as $row) :
                            $project['id'] = $row['pid'];
                            $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                            unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                            $desc = strtr(html_entity_decode($row['description']), $trans);
                            $desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);
                            $tprog = $this->db->query("SELECT * FROM tasks where project_id = {$row['pid']}")->num_rows;
                            $cprog = $this->db->query("SELECT * FROM tasks where project_id = {$row['pid']} and status = 3")->num_rows;
                            $prog = $tprog > 0 ? ($cprog / $tprog) * 100 : 0;
                            $prog = $prog > 0 ?  number_format($prog, 2) : $prog;
                            $prod = $this->db->query("SELECT * FROM user_productivity where project_id = {$row['pid']}")->num_rows;
                            if ($row['pstatus'] == 0 && strtotime(date('Y-m-d')) >= strtotime($row['start_date'])) :
                                if ($prod  > 0  || $cprog > 0)
                                    $row['pstatus'] = 2;
                                else
                                    $row['pstatus'] = 1;
                            elseif ($row['pstatus'] == 0 && strtotime(date('Y-m-d')) > strtotime($row['end_date'])) :
                                $row['pstatus'] = 4;
                            endif;
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++ ?></td>
                                <td>
                                    <p><b><?php echo ucwords($row['pname']) ?></b></p>
                                </td>
                                <td>
                                    <p><b><?php echo ucwords($row['task']) ?></b></p>
                                    <p class="truncate"><?php echo strip_tags($desc) ?></p>
                                </td>
                                <td><b><?php echo date("M d, Y", strtotime($row['start_date'])) ?></b></td>
                                <td><b><?php echo date("M d, Y", strtotime($row['end_date'])) ?></b></td>
                                <td class="text-center">
                                    <?php
                                    if ($stat[$row['pstatus']] == 'Pending') {
                                        echo "<span class='badge badge-secondary'>{$stat[$row['pstatus']]}</span>";
                                    } elseif ($stat[$row['pstatus']] == 'Started') {
                                        echo "<span class='badge badge-primary'>{$stat[$row['pstatus']]}</span>";
                                    } elseif ($stat[$row['pstatus']] == 'On-Progress') {
                                        echo "<span class='badge badge-info'>{$stat[$row['pstatus']]}</span>";
                                    } elseif ($stat[$row['pstatus']] == 'On-Hold') {
                                        echo "<span class='badge badge-warning'>{$stat[$row['pstatus']]}</span>";
                                    } elseif ($stat[$row['pstatus']] == 'Over Due') {
                                        echo "<span class='badge badge-danger'>{$stat[$row['pstatus']]}</span>";
                                    } elseif ($stat[$row['pstatus']] == 'Done') {
                                        echo "<span class='badge badge-success'>{$stat[$row['pstatus']]}</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($row['status'] == 1) {
                                        echo "<span class='badge badge-secondary'>Pending</span>";
                                    } elseif ($row['status'] == 2) {
                                        echo "<span class='badge badge-primary'>On-Progress</span>";
                                    } elseif ($row['status'] == 3) {
                                        echo "<span class='badge badge-success'>Done</span>";
                                    }
                                    ?>
                                </td>
                                <?php if ($user['role_id'] != 4) : ?>
                                    <td class="text-center">

                                        <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item new_productivity" href="" data-toggle="modal" data-target=<?= "#newProgressModal" . $row['id'] ?>>Add Productivity</a>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add new Progress -->
<?php foreach ($qry->result_array() as $row) : ?>
    <div class="modal fade" id=<?= "newProgressModal" . $row['id'] ?> aria-labelledby=" newTaskModalLabel" aria-hidden="true" style="overflow:hidden;">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Progress For: <?= $row['task'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('tasks/save_progress') ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="project_id" value="<?= $row['pid'] ?>">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Subject</label>
                                        <input type="text" class="form-control form-control-sm" name="subject" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Date</label>
                                        <input type="date" class="form-control form-control-sm" name="date" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Start Time</label>
                                        <input type="time" class="form-control form-control-sm" name="start_time" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">End Time</label>
                                        <input type="time" class="form-control form-control-sm" name="end_time" value="">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="">Comment/Progress Description</label>
                                        <textarea name="comment" id="" cols="30" rows="10" class="summernote form-control" required="">
						</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" href="" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<style>
    table p {
        margin: unset !important;
    }

    table td {
        vertical-align: middle !important
    }
</style>
<script>
    $(document).ready(function() {
        $('#list').dataTable()
    })
</script>