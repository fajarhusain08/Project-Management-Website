<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <div class="card card-outline card-primary">
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                <?php endif; ?>
                <?= $this->session->flashdata('message'); ?>
                <div class="card-body">
                    <form action="" method="post" id="manage-project">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Project Title</label>
                                    <input type="text" class="form-control form-control-sm" name="name" id="name" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" id="status" class="custom-select custom-select-sm">
                                        <option value="0" <?php echo isset($project['status']) && $project['status'] == 0 ? 'selected' : '' ?>>Pending</option>
                                        <option value="3" <?php echo isset($project['status']) && $project['status'] == 3 ? 'selected' : '' ?>>On-Hold</option>
                                        <option value="5" <?php echo isset($project['status']) && $project['status'] == 5 ? 'selected' : '' ?>>Done</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Start Date</label>
                                    <input type="date" class="form-control form-control-sm" autocomplete="off" name="start_date" id="start_date" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">End Date</label>
                                    <input type="date" class="form-control form-control-sm" autocomplete="off" name="end_date" id="end_date" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Project Manager</label>
                                    <select class="form-control form-control-sm select2" name="manager_id" id="manager_id">
                                        <option value=""></option>
                                        <?php foreach ($manager as $ma) : ?>
                                            <option value="<?= $ma['id']; ?>"><?= $ma['name'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Project Member</label>
                                    <select class="form-control form-control-sm select2" multiple="multiple" name="user_ids[]" id="user_ids[]">
                                        <option value=""></option>
                                        <?php foreach ($member as $m) : ?>
                                            <option value="<?= $m['id']; ?>"><?= $m['name'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="" class="control-label">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-top border-info">
                            <div class="col-lg d-flex w-100 justify-content-center align-items-center">
                                <button type="submit" href="<?= base_url('project/save_project'); ?>" class=" btn btn-primary mb-3 mx-1" form="manage-project">Save</button>
                                <a href="<?= base_url('project'); ?>" class="btn btn-secondary mb-3 mx-3">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>


        </div>
    </div>

</div>
<!-- /.container-fluid -->


</div>
<!-- End of Main Content -->
<script>

</script>