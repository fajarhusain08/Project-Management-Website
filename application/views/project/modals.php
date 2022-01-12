 <?php $task = $this->db->query("SELECT * FROM tasks where project_id = {$project['id']} order by task asc")->result_array();
    $id =  $project['id'];
    $progress = $this->db->query("SELECT p.*, name as uname,u.image,t.task FROM user_productivity p inner join user u on u.id = p.user_id inner join tasks t on t.id = p.task_id where p.project_id = $id order by unix_timestamp(p.date_created) desc "); ?>
 <!-- View Task Modal -->
 <?php foreach ($task as $t) : ?>
     <div class="modal fade" id=<?= "viewTaskModal" . $t['id'] ?> aria-labelledby="viewTaskModal2Label" aria-hidden="true" style="overflow:hidden;">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <!-- <?php var_dump($t) ?> -->
                     <h5 class="modal-title">Task Detail</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="container-fluid">
                         <dl>
                             <dt><b class="border-bottom border-primary">Task</b></dt>
                             <dd><?php echo ucwords($t['task']) ?></dd>
                         </dl>
                         <dl>
                             <dt><b class="border-bottom border-primary">Status</b></dt>
                             <dd>
                                 <?php
                                    if ($t['status'] == 1) {
                                        echo "<span class='badge badge-secondary'>Pending</span>";
                                    } elseif ($t['status'] == 2) {
                                        echo "<span class='badge badge-primary'>On-Progress</span>";
                                    } elseif ($t['status'] == 3) {
                                        echo "<span class='badge badge-success'>Done</span>";
                                    }
                                    ?>
                             </dd>
                         </dl>
                         <dl>
                             <dt><b class="border-bottom border-primary">Description</b></dt>
                             <dd><?php echo html_entity_decode($t['description']) ?></dd>
                         </dl>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 </div>
             </div>
         </div>
     </div>
 <?php endforeach; ?>

 <!-- Add new Task -->
 <div class="modal fade" id="newTaskModal" aria-labelledby="newTaskModalLabel" aria-hidden="true" style="overflow:hidden;">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Add New Task</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="<?= base_url('project/save_task/') ?>" method="post" id="manage-task">
                 <div class="modal-body">
                     <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                     <div class="form-group">
                         <label for="">Task</label>
                         <input type="text" class="form-control" id="task" name="task" placeholder="">
                         </label>
                     </div>
                     <div class="form-group">
                         <label for="">Description</label>
                         <textarea name="description" id="" cols="30" rows="10" class="summernote form-control"></textarea>
                     </div>
                     <div class="form-group">
                         <label for="">Status</label>
                         <select name="status" id="status" class="custom-select custom-select-sm">
                             <option value="1" <?php echo isset($task['status']) && $task['status'] == 1 ? 'selected' : '' ?>>Pending</option>
                             <option value="2" <?php echo isset($task['status']) && $task['status'] == 2 ? 'selected' : '' ?>>On-Progress</option>
                             <option value="3" <?php echo isset($task['status']) && $task['status'] == 3 ? 'selected' : '' ?>>Done</option>
                         </select>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="submit" href="" class="btn btn-primary" form="manage-task">Save</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 </div>
             </form>
         </div>
     </div>
 </div>


 <!-- Edit Task Modal -->
 <?php foreach ($task as $t) : ?>
     <div class="modal fade" id=<?= "editTaskModal" . $t['id'] ?> aria-labelledby="newTaskModalLabel" aria-hidden="true" style="overflow:hidden;">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Edit Task</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form action="<?= base_url('project/save_task/') . $t['id']; ?>" method="post">
                     <div class="modal-body">
                         <input type="hidden" name="id" value="<?= $t['id'] ?>">
                         <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                         <div class="form-group">
                             <label for="">Task</label>
                             <input type="text" class="form-control" id="task" name="task" placeholder="" value="<?= $t['task'] ?>">
                             </label>
                         </div>
                         <div class="form-group">
                             <label for="">Description</label>
                             <textarea name="description" id="" cols="30" rows="10" class="summernote form-control">
                             <?= $t['description'] ?>
                             </textarea>
                         </div>
                         <div class="form-group">
                             <label for="">Status</label>
                             <select name="status" id="status" class="custom-select custom-select-sm">
                                 <option value="1" <?php echo isset($t['status']) && $t['status'] == 1 ? 'selected' : '' ?>>Pending</option>
                                 <option value="2" <?php echo isset($t['status']) && $t['status'] == 2 ? 'selected' : '' ?>>On-Progress</option>
                                 <option value="3" <?php echo isset($t['status']) && $t['status'] == 3 ? 'selected' : '' ?>>Done</option>
                             </select>
                         </div>
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

 <!-- Delete Task -->
 <?php foreach ($task as $t) : ?>
     <div class="modal fade" id=<?= "deleteTaskModal" . $t['id'] ?> aria-labelledby="deleteTaskModalLabel" aria-hidden="true" style="overflow:hidden;">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Delete Task</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form action="<?= base_url('project/deletetask/') . $t['id']; ?>" method="post">
                     <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                     <div class="modal-body">
                         <p>Are you sure want to delete <b><?= $t['task']; ?></b>?</p>
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

 <!-- Add new Progress -->
 <div class="modal fade" id=<?= "newProgressModal" . $project['id'] ?> aria-labelledby=" newTaskModalLabel" aria-hidden="true" style="overflow:hidden;">
     <div class="modal-dialog modal-xl" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Add New Progress</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="<?= base_url('project/save_progress') ?>" method="post">
                 <div class="modal-body">
                     <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                     <div class="col-lg-12">
                         <div class="row">
                             <div class="col-md-5">
                                 <div class="form-group">
                                     <label for="" class="control-label">Task</label>
                                     <select class="form-control form-control-sm select2" name="task_id">
                                         <option></option>
                                         <?php foreach ($task as $t) : ?>
                                             <option value="<?php echo $t['id'] ?>"><?php echo ucwords($t['task']) ?></option>
                                         <?php endforeach; ?>
                                     </select>
                                 </div>
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

 <!-- Edit Progress Modal -->
 <?php foreach ($progress->result_array() as $pro) : ?>
     <div class="modal fade" id=<?= "editProgressModal" . $pro['id'] ?> aria-labelledby="newProgressModalLabel" aria-hidden="true" style="overflow:hidden;">
         <div class="modal-dialog modal-xl" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Edit Progress</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form action="<?= base_url('project/save_progress') ?>" method="post">
                     <div class="modal-body">
                         <input type="hidden" name="id" value="<?= $pro['id'] ?>">
                         <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                         <div class="col-lg-12">
                             <div class="row">
                                 <div class="col-md-5">
                                     <div class="form-group">
                                         <label for="" class="control-label">Task</label>
                                         <select class="form-control form-control-sm select2" name="task_id">
                                             <option></option>
                                             <?php foreach ($task as $t) : ?>
                                                 <option value="<?php echo $t['id'] ?>" <?php echo isset($pro['task_id']) && $pro['task_id'] == $t['id'] ? "selected" : '' ?>> <?php echo ucwords($t['task']) ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                     </div>
                                     <div class="form-group">
                                         <label for="">Subject</label>
                                         <input type="text" class="form-control form-control-sm" name="subject" value="<?= $pro['subject'] ?>">
                                     </div>
                                     <div class="form-group">
                                         <label for="">Date</label>
                                         <input type="date" class="form-control form-control-sm" name="date" value="<?= $pro['date'] ?>">
                                     </div>
                                     <div class="form-group">
                                         <label for="">Start Time</label>
                                         <input type="time" class="form-control form-control-sm" name="start_time" value="<?= $pro['start_time'] ?>">
                                     </div>
                                     <div class="form-group">
                                         <label for="">End Time</label>
                                         <input type="time" class="form-control form-control-sm" name="end_time" value="<?= $pro['end_time'] ?>">
                                     </div>
                                 </div>
                                 <div class="col-md-7">
                                     <div class="form-group">
                                         <label for="">Comment/Progress Description</label>
                                         <textarea name="comment" id="" cols="30" rows="10" class="summernote form-control" required="">
                                         <?= $pro['comment'] ?>
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

 <!-- Delete Progress -->
 <?php foreach ($progress->result_array() as $row) : ?>
     <div class="modal fade" id=<?= "deleteProgressModal" . $row['id'] ?> aria-labelledby="deleteProgressModalLabel" aria-hidden="true" style="overflow:hidden;">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Delete Progress</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form action="<?= base_url('project/deleteprogress/') . $row['id']; ?>" method="post">
                     <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                     <div class="modal-body">
                         <p>Are you sure want to delete <b><?= $row['subject']; ?></b>?</p>
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