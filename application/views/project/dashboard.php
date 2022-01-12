<?php
$twhere = "";
if ($user['role_id'] != 1)
    $twhere = "  ";
?>
<!-- Info boxes -->

<?php

$where = "";
if ($user['role_id'] == 2) {
    $where = " where manager_id = '{$user['id']}' ";
} elseif ($user['role_id'] == 3) {
    $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$user['id']}]%' ";
}
$where2 = "";
if ($user['role_id'] == 2) {
    $where2 = " where manager_id = '{$user['id']}' ";
} elseif ($user['role_id'] == 3) {
    $where2 = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$user['id']}]%' ";
}
?>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        Welcome <?php echo $user['name'] ?>!
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <b>Project Progress</b>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0 table-hover">
                                    <colgroup>
                                        <col width="5%">
                                        <col width="30%">
                                        <col width="35%">
                                        <col width="15%">
                                        <col width="15%">
                                    </colgroup>
                                    <thead>
                                        <th>#</th>
                                        <th>Project</th>
                                        <th>Progress</th>
                                        <th>Status</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $stat = array("Pending", "Started", "On-Progress", "On-Hold", "Over Due", "Done");
                                        $where = "";
                                        $where = "";
                                        if ($user['role_id'] == 2) {
                                            $where = " where manager_id = '{$user['id']}' ";
                                        } elseif ($user['role_id'] == 3) {
                                            $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$user['id']}]%' ";
                                        }
                                        $qry = $this->db->query("SELECT * FROM project $where order by name asc");
                                        foreach ($qry->result_array() as $row) :
                                            $prog = 0;
                                            $tprog = $this->db->query("SELECT * FROM tasks where project_id = {$row['id']}")->num_rows();
                                            $cprog = $this->db->query("SELECT * FROM tasks where project_id = {$row['id']} and status = 3")->num_rows();
                                            $prog = $tprog > 0 ? ($cprog / $tprog) * 100 : 0;
                                            $prog = $prog > 0 ?  number_format($prog, 2) : $prog;
                                            $prod = $this->db->query("SELECT * FROM user_productivity where project_id = {$row['id']}")->num_rows();
                                            if ($row['status'] == 0 && strtotime(date('Y-m-d')) >= strtotime($row['start_date'])) :
                                                if ($prod  > 0  || $cprog > 0)
                                                    $row['status'] = 2;
                                                else
                                                    $row['status'] = 1;
                                            elseif ($row['status'] == 0 && strtotime(date('Y-m-d')) > strtotime($row['end_date'])) :
                                                $row['status'] = 4;
                                            endif;
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i++ ?>
                                                </td>
                                                <td>
                                                    <a>
                                                        <?php echo ucwords($row['name']) ?>
                                                    </a>
                                                    <br>
                                                    <small>
                                                        Due: <?php echo date("Y-m-d", strtotime($row['end_date'])) ?>
                                                    </small>
                                                </td>
                                                <td class="project_progress">
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%">
                                                        </div>
                                                    </div>
                                                    <small>
                                                        <?php echo $prog ?>% Complete
                                                    </small>
                                                </td>
                                                <td class="project-state">
                                                    <?php
                                                    if ($stat[$row['status']] == 'Pending') {
                                                        echo "<span class='badge badge-secondary'>{$stat[$row['status']]}</span>";
                                                    } elseif ($stat[$row['status']] == 'Started') {
                                                        echo "<span class='badge badge-primary'>{$stat[$row['status']]}</span>";
                                                    } elseif ($stat[$row['status']] == 'On-Progress') {
                                                        echo "<span class='badge badge-info'>{$stat[$row['status']]}</span>";
                                                    } elseif ($stat[$row['status']] == 'On-Hold') {
                                                        echo "<span class='badge badge-warning'>{$stat[$row['status']]}</span>";
                                                    } elseif ($stat[$row['status']] == 'Over Due') {
                                                        echo "<span class='badge badge-danger'>{$stat[$row['status']]}</span>";
                                                    } elseif ($stat[$row['status']] == 'Done') {
                                                        echo "<span class='badge badge-success'>{$stat[$row['status']]}</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="<?= base_url('project/viewproject/') . $row['id'] ?>">
                                                        <i class="fas fa-folder">
                                                        </i>
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-12">
                            <div class="small-box bg-light shadow-sm border">
                                <div class="inner">
                                    <h3><?= $this->db->query("SELECT * FROM project $where")->num_rows() ?></h3>
                                    <p>Total Projects</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-layer-group"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-12">
                            <div class="small-box bg-light shadow-sm border">
                                <div class="inner">
                                    <h3><?= $this->db->query("SELECT t.*,p.name as pname,p.start_date,p.status as pstatus, p.end_date,p.id as pid FROM tasks t inner join project p on p.id = t.project_id $where2")->num_rows()  ?></h3>
                                    <p>Total Tasks</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-tasks"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>