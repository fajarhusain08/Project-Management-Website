<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                FROM   `user_sub_menu` JOIN `user_menu`
                ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function deleteMenu($menu_id)
    {
        // menghapus data di MySQL Server
        $this->db->where('id', $menu_id);
        $this->db->delete('user_menu');
        $this->db->affected_rows();
    }
    public function deleteSubMenu($submenu_id)
    {
        // menghapus data di MySQL Server
        $this->db->where('id', $submenu_id);
        $this->db->delete('user_sub_menu');
        $this->db->affected_rows();
    }
}
