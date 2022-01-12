<!-- Begin Page Content -->
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
            <?php if ($user['role_id'] <= 2) : ?>
                <a href="<?= base_url('project/save_project'); ?>" class="btn btn-primary mb-3">Add New Project</a>
            <?php endif; ?>
            <div class="card-body">
                <table id="lists" class="table tabe-hover table-condensed">
                    <colgroup>
                        <col width="5%">
                        <col width="35%">
                        <col width="15%">
                        <col width="15%">
                        <col width="20%">
                        <col width="10%">
                    </colgroup>
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Project Title</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        $stat = array("Pending", "Started", "On-Progress", "On-Hold", "Over Due", "Done");
                        $where = "";
                        if ($user['role_id'] == 2) {
                            $where = " where manager_id = '{$user['id']}' ";
                        } elseif ($user['role_id'] == 3) {
                            $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$user['id']}]%' ";
                        }

                        $qry = $this->db->query("SELECT * FROM project $where order by name asc")->result_array();
                        foreach ($qry as $p) :
                            $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                            unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                            $desc = strtr(html_entity_decode($p['description']), $trans);
                            $desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);

                        ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td>
                                    <p><b><?= ucwords($p['name']); ?></b></p>
                                    <p class="truncate"><?php echo strip_tags($desc) ?></p>
                                </td>
                                <td><?= $p['start_date']; ?></td>
                                <td><?= $p['end_date']; ?></td>
                                <td><?php
                                    if ($stat[$p['status']] == 'Pending') {
                                        echo "<span class='badge badge-secondary'>{$stat[$p['status']]}</span>";
                                    } elseif ($stat[$p['status']] == 'Started') {
                                        echo "<span class='badge badge-primary'>{$stat[$p['status']]}</span>";
                                    } elseif ($stat[$p['status']] == 'On-Progress') {
                                        echo "<span class='badge badge-info'>{$stat[$p['status']]}</span>";
                                    } elseif ($stat[$p['status']] == 'On-Hold') {
                                        echo "<span class='badge badge-warning'>{$stat[$p['status']]}</span>";
                                    } elseif ($stat[$p['status']] == 'Over Due') {
                                        echo "<span class='badge badge-danger'>{$stat[$p['status']]}</span>";
                                    } elseif ($stat[$p['status']] == 'Done') {
                                        echo "<span class='badge badge-success'>{$stat[$p['status']]}</span>";
                                    }
                                    ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" style="">
                                        <a href="<?= base_url('project/viewproject/') . $p['id']; ?>" class="dropdown-item">View</a>
                                        <div class="dropdown-divider"></div>
                                        <?php if ($user['role_id']  <= 2) : ?>
                                            <a href="<?= base_url('project/editproject/') . $p['id']; ?>" class=" dropdown-item">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class=" dropdown-item" href="<?= base_url('project') ?>" data-toggle="modal" data-target=<?= "#deleteProjectModal" . $p['id'] ?>>Delete</a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php $tasks = $this->db->query("SELECT * FROM tasks where project_id = {$p['id']} order by task asc")->result_array() ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->




<!-- Delete Project Modal-->
<?php foreach ($project as $p) : ?>
    <div class="modal fade" id=<?= "deleteProjectModal" . $p['id'] ?> aria-labelledby="deleteProjectModalLabel" aria-hidden="true" style="overflow:hidden;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('project/deleteproject/') . $p['id']; ?>" method="post">
                    <input type="hidden" name="project_id" value="<?= $p['id'] ?>">
                    <div class="modal-body">
                        <p>Are you sure want to delete <b><?= $p['name']; ?></b>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
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