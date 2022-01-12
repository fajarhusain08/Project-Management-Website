<?php
$stat = array("Pending", "Started", "On-Progress", "On-Hold", "Over Due", "Done");
foreach ($project as $k => $v) {
    $$k = $v;
}
$where = "";
if ($user['role_id'] == 2) {
    $where = " where manager_id = '{$user['id']}' ";
} elseif ($user['role_id'] == 3) {
    $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$user['id']}]%' ";
}
$tprog = $this->db->query("SELECT * FROM tasks where project_id = {$project['id']}")->num_rows;
$cprog = $this->db->query("SELECT * FROM tasks where project_id = {$project['id']} and status = 3")->num_rows;
$prog = $tprog > 0 ? ($cprog / $tprog) * 100 : 0;
$prog = $prog > 0 ?  number_format($prog, 2) : $prog;
$prod = $this->db->query("SELECT * FROM user_productivity where project_id = {$project['id']}")->num_rows;
if ($status == 0 && strtotime(date('Y-m-d')) >= strtotime($start_date)) :
    if ($prod  > 0  || $cprog > 0)
        $status = 2;
    else
        $status = 1;
elseif ($status == 0 && strtotime(date('Y-m-d')) > strtotime($end_date)) :
    $status = 4;
endif;
?>
<!-- load modal -->
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

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="callout callout-info">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <dl>
                                            <dt><b class="border-bottom border-primary">Project Name</b></dt>
                                            <dd><?= $name ?></dd>
                                            <dt><b class="border-bottom border-primary">Description</b></dt>
                                            <dd><?php echo html_entity_decode($description) ?></dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl>
                                            <dt><b class="border-bottom border-primary">Start Date</b></dt>
                                            <dd><?php echo date("F d, Y", strtotime($start_date)) ?></dd>
                                        </dl>
                                        <dl>
                                            <dt><b class="border-bottom border-primary">End Date</b></dt>
                                            <dd><?php echo date("F d, Y", strtotime($end_date)) ?></dd>
                                        </dl>
                                        <dl>
                                            <dt><b class="border-bottom border-primary">Status</b></dt>
                                            <dd>
                                                <?php
                                                if ($stat[$status] == 'Pending') {
                                                    echo "<span class='badge badge-secondary'>{$stat[$status]}</span>";
                                                } elseif ($stat[$status] == 'Started') {
                                                    echo "<span class='badge badge-primary'>{$stat[$status]}</span>";
                                                } elseif ($stat[$status] == 'On-Progress') {
                                                    echo "<span class='badge badge-info'>{$stat[$status]}</span>";
                                                } elseif ($stat[$status] == 'On-Hold') {
                                                    echo "<span class='badge badge-warning'>{$stat[$status]}</span>";
                                                } elseif ($stat[$status] == 'Over Due') {
                                                    echo "<span class='badge badge-danger'>{$stat[$status]}</span>";
                                                } elseif ($stat[$status] == 'Done') {
                                                    echo "<span class='badge badge-success'>{$stat[$status]}</span>";
                                                }
                                                ?>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt><b class="border-bottom border-primary">Project Manager</b></dt>
                                            <dd>
                                                <?php if (isset($manager['id'])) : ?>
                                                    <div class="d-flex align-items-center mt-1">
                                                        <img class="img-circle img-thumbnail p-0 shadow-sm border-info img-sm mr-3 " height="40px" width="40px" src="<?= base_url('assets/img/profile/') . $manager['image']; ?>">
                                                        <b><?php echo ucwords($manager['name']) ?></b>
                                                    </div>
                                                <?php else : ?>
                                                    <small><i>Manager Deleted from Database</i></small>
                                                <?php endif; ?>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <span><b>Team Member/s:</b></span>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="users-list clearfix">
                                    <?php
                                    $id = $project['id'];
                                    $members = $this->db->query("SELECT * FROM user where id in ($user_ids)");
                                    foreach ($members->result_array() as $m) :
                                    ?>

                                        <li>
                                            <img src="<?= base_url('assets/img/profile/') . $m['image']; ?>" alt="User Image" height="40px" width="40px">
                                            <a class="users-list-name"><?php echo ucwords($m['name']) ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <span><b>Task List:</b></span>
                                <?php if ($user['role_id'] <= 2) : ?>
                                    <a class="btn btn-primary bg-gradient-primary btn-sm float-right" id="new_task" href="<?= base_url('project/viewproject/') . $project['id']; ?>" data-toggle="modal" data-target="#newTaskModal">New Task</a>
                                <?php endif; ?>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-condensed m-0 table-hover">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="25%">
                                            <col width="30%">
                                            <col width="15%">
                                            <col width="15%">
                                        </colgroup>
                                        <thead>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            $task = $this->db->query("SELECT * FROM tasks where project_id = {$id} order by task asc")->result_array();
                                            foreach ($task as $t) :
                                                $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                                                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                                                $desc = strtr(html_entity_decode($t['description']), $trans);
                                                $desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo ++$i ?></td>
                                                    <td class=""><b><?php echo ucwords($t['task']) ?></b></td>
                                                    <td class="">
                                                        <p class="truncate"><?php echo strip_tags($desc) ?></p>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($t['status'] == 1) {
                                                            echo "<span class='badge badge-secondary'>Pending</span>";
                                                        } elseif ($t['status'] == 2) {
                                                            echo "<span class='badge badge-primary'>On-Progress</span>";
                                                        } elseif ($t['status'] == 3) {
                                                            echo "<span class='badge badge-success'>Done</span>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <?php $tes = "view_task" . $i; ?>
                                                            <a href="<?= base_url('project/viewproject/') . $project['id']; ?>" class="dropdown-item view_task1" data-toggle="modal" data-target=<?= "#viewTaskModal" . $t['id']; ?>>View</a>
                                                            <div class="dropdown-divider"></div>
                                                            <?php if ($user['role_id'] != 3) : ?>
                                                                <a class="dropdown-item edit_task" href="<?= base_url('project/viewproject/') . $project['id']; ?>" data-toggle="modal" data-target=<?= "#editTaskModal" . $t['id']; ?>>Edit</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item delete_task" href="<?= base_url('project/viewproject/') . $project['id']; ?>" data-toggle="modal" data-target=<?= "#deleteTaskModal" . $t['id']; ?>>Delete</a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <span><b>Members Progress/Activity</b></span>
                                <?php if ($user['role_id'] != 4) : ?>
                                    <a class="btn btn-primary bg-gradient-primary btn-sm float-right" id="new_progress" href="<?= base_url('project/viewproject/') . $project['id']; ?>" data-toggle="modal" data-target=<?= "#newProgressModal" . $project['id'] ?>>New Productivity</a>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <?php
                                $progress = $this->db->query("SELECT p.*, name as uname,u.image,t.task FROM user_productivity p inner join user u on u.id = p.user_id inner join tasks t on t.id = p.task_id where p.project_id = $id order by unix_timestamp(p.date_created) desc ");
                                foreach ($progress->result_array() as $pro) :
                                ?>
                                    <div class="post">
                                        <div class="user-block">
                                            <?php if ($user['id'] == $pro['user_id']) : ?>
                                                <span class="btn-group dropleft float-right">
                                                    <span class="btndropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </span>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item manage_progress" href="<?= base_url('project/viewproject/') . $project['id']; ?>" data-toggle="modal" data-target=<?= "#editProgressModal" . $pro['id'] ?>>Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item delete_progress" href="<?= base_url('project/viewproject/') . $project['id']; ?>" data-toggle="modal" data-target=<?= "#deleteProgressModal" . $pro['id']; ?>>Delete</a>
                                                    </div>
                                                </span>
                                            <?php endif; ?>
                                            <img class="img-circle img-bordered-sm" height="40px" width="40px" src="<?= base_url('assets/img/profile/') . $pro['image']; ?>" alt="user image">
                                            <span class="username">
                                                <a href="#"><?php echo ucwords($pro['uname']) ?>[ <?php echo ucwords($pro['task']) ?> ]</a>
                                            </span>
                                            <span class="description">
                                                <span class="fa fa-calendar-day"></span>
                                                <span><b><?php echo date('M d, Y', strtotime($pro['date'])) ?></b></span>
                                                <span class="fa fa-user-clock"></span>
                                                <span>Start: <b><?php echo date('h:i A', strtotime($pro['date'] . ' ' . $pro['start_time'])) ?></b></span>
                                                <span> | </span>
                                                <span>End: <b><?php echo date('h:i A', strtotime($pro['date'] . ' ' . $pro['end_time'])) ?></b></span>
                                            </span>
                                        </div>
                                        <dt><b class="border-bottom border-primary"><?= $pro['subject'] ?></b></dt>
                                        <div>
                                            <?php echo html_entity_decode($pro['comment']) ?>
                                        </div>
                                        <p>
                                        </p>
                                    </div>
                                    <div class="post clearfix"></div>
                                <?php endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- /.container-fluid -->

<!-- End of Main Content -->



<style>
    .users-list>li img {
        border-radius: 50%;
        height: 67px;
        width: 67px;
        object-fit: cover;
    }

    .users-list>li {
        width: 33.33% !important
    }

    .truncate {
        -webkit-line-clamp: 1 !important;
    }
</style>