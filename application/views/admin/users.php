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
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newUserModal">Add New User</a>
            <table id="lists" class="table tabe-hover table-condensed">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">User Type</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($users as $u) : ?>
                        <?php $type = array('', "Admin", "Manager", "Member", "Pembina"); ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $u['name']; ?></td>
                            <td><?= $u['email']; ?></td>
                            <td><?= $type[$u['role_id']]; ?></td>
                            <td><?= date('d F Y', $u['date_created']); ?></td>
                            <td>
                                <a href="<?= base_url('admin/deleteuser/') . $u['id']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure want to delete?')">delete</a>
                            </td>

                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newUserModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/usermanagement'); ?>" method="post">

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <select name="role_id" id="role_id" class="custom-select custom-select-sm">
                            <option value="4" <?php echo isset($users['role_id']) && $users['role_id'] == 4 ? 'selected' : '' ?>>Pembina</option>
                            <option value="3" <?php echo isset($users['role_id']) && $users['role_id'] == 3 ? 'selected' : '' ?>>Member</option>
                            <option value="2" <?php echo isset($users['role_id']) && $users['role_id'] == 2 ? 'selected' : '' ?>>Manager</option>
                            <option value="1" <?php echo isset($users['role_id']) && $users['role_id'] == 1 ? 'selected' : '' ?>>Admin</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>

            </form>
        </div>
    </div>
</div>