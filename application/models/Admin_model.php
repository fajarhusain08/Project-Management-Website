<?php
defined('BASEPATH') or die('Error');


class Admin_model extends CI_model
{
    public function deleteRole($role_id)
    {
        // menghapus data di MySQL Server
        $this->db->where('id', $role_id);
        $this->db->delete('user_role');
        $this->db->affected_rows();
    }

    public function deleteUser($user_id)
    {
        // menghapus data di MySQL Server
        $this->db->where('id', $user_id);
        $this->db->delete('user');
        $this->db->affected_rows();
    }
}
