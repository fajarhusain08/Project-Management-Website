<?php
defined('BASEPATH') or die('Error');


class Project_model extends CI_model
{
    public function getTasks()
    {
        $query = "SELECT `tasks`.*, `project`.`pro_name`
                FROM   `tasks` JOIN `project`
                ON `tasks`.`pro_id` = `project`.`id`
        ";
        return $this->db->query($query)->result_array();
    }


    public function deleteProject($project_id)
    {
        // menghapus data di MySQL Server
        $this->db->where('id', $project_id);
        $this->db->delete('project');
        $this->db->affected_rows();
    }
    public function deleteTasks($task_id)
    {
        // menghapus data di MySQL Server
        $this->db->where('id', $task_id);
        $this->db->delete('tasks');
        $this->db->affected_rows();
    }
    public function deleteProgress($p_id)
    {
        // menghapus data di MySQL Server
        $this->db->where('id', $p_id);
        $this->db->delete('user_productivity');
        $this->db->affected_rows();
    }
    public function DeleteTask($id)
    {
        $this->db->delete('tasks', array('project_id' => $id));
    }
    public function DeleteProductivity($id)
    {
        $this->db->delete('user_productivity', array('task_id' => $id));
    }
    public function DeleteProductivityP($id)
    {
        $this->db->delete('user_productivity', array('project_id' => $id));
    }
    public function DeletAssignuser($id)
    {
        $this->db->delete('task_assign', array('task_id' => $id));
    }
    public function getTaskAssignUser($id)
    {
        $query = "SELECT `task_assign`.*,
          `user`.`name`,`image`
          FROM `task_assign`
          LEFT JOIN `user` ON `task_assign`.`assign_user`=`user`.`id`
          WHERE `task_assign`.`task_id`='$id'";
        return $this->db->query($query)->result();
    }
    public function getUser()
    {
        $query = "SELECT * FROM `user`";
        return $this->db->query($query)->result_array();
    }

    public function Add_Tasks($data)
    {
        $this->db->insert('tasks', $data);
    }
    public function insert_members_Data($data)
    {
        $this->db->insert('task_assign', $data);
    }
    public function Update_Tasks($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tasks', $data);
    }
    public function Update_members_Data($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('task_assign', $data);
    }
}
