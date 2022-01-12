<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tasks extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Tasks';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['project'] = $this->db->get('project')->result_array();
        $data['tasks'] = $this->db->get('tasks')->result_array();
        $data['userpro'] = $this->db->get('user_productivity')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('tasks/index', $data);
        $this->load->view('templates/footer');
    }

    function save_progress()
    {
        $data['title'] = 'Task';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['project'] = $this->db->get('project')->result_array();
        $data['manager'] = $this->db->query("SELECT * FROM user where role_id = 2")->row_array();
        $data['member'] = $this->db->query("SELECT * FROM user where role_id = 3")->result_array();
        $data['tasks'] = $this->db->get('tasks')->result_array();
        $id = $this->input->post('id');
        $start_time = $this->input->post('start_time_time');
        $end_time = $this->input->post('end_time');
        $project_id = $this->input->post('project_id');


        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('comment', 'Comment', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('project/index', $data);
            $this->load->view('templates/footer');
        } else {
            extract($_POST);
            $data = "";
            foreach ($_POST as $k => $v) {
                if (!in_array($k, array('id')) && !is_numeric($k)) {
                    if ($k == 'comment')
                        $v = htmlentities(str_replace("'", "&#x2019;", $v));
                    if (empty($data)) {
                        $data .= " $k='$v' ";
                    } else {
                        $data .= ", $k='$v' ";
                    }
                }
            }
            $dur = abs(strtotime("2020-01-01 " . $end_time)) - abs(strtotime("2020-01-01 " . $start_time));
            $dur = $dur / (60 * 60);
            $data .= ", time_rendered='$dur' ";
            if (empty($id)) {
                $data .= ", user_id={$_SESSION['login_id']} ";

                $add = $this->db->query("INSERT INTO user_productivity set $data");
            } else {
                $edit = $this->db->query("UPDATE user_productivity set $data where id = $id");
            }
            if ($add) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Progress/Activity added!</div>');
                $pid = 'project/viewproject/' . $project_id;
                redirect('tasks');
            }
        }
    }
}
