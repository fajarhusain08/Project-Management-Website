<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_model');
        $this->load->library('form_validation');
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['project'] = $this->db->get('project')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('project/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function index()
    {
        $data['title'] = 'Projects';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['tasks'] = $this->db->get('project')->result_array();
        $data['project'] = $this->db->get('project')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('project/index', $data);
        $this->load->view('templates/footer');
    }



    public function viewproject($pro_id)
    {
        $data['title'] = 'View Project';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['project'] = $this->db->get_where('project', ['id' => $pro_id])->row_array();
        $data['manager'] = $this->db->query("SELECT * FROM user where role_id = 2")->row_array();
        $data['member'] = $this->db->query("SELECT * FROM user where role_id = 3")->result_array();
        $data['tasks'] = $this->db->get('tasks')->result_array();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('project/viewproject', $data);
        $this->load->view('project/modals', $data);
        $this->load->view('templates/footer');
    }

    public function save_project()
    {
        $data['title'] = 'New Project';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['manager'] = $this->db->query("SELECT id, name FROM user where role_id = 2")->result_array();
        $data['member'] = $this->db->query("SELECT id, name FROM user where role_id = 3")->result_array();
        $date = date('d-m-Y');


        $this->form_validation->set_rules('name', 'Project Name', 'required');
        $this->form_validation->set_rules('status', 'Project Status', 'required');
        $this->form_validation->set_rules('start_date', 'Project Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'Project End Date', 'required');
        $this->form_validation->set_rules('manager_id', 'Project Manager', 'required');
        $this->form_validation->set_rules('user_ids[]', 'Project Members', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required|min_length[9]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('project/newproject', $data);
            $this->load->view('templates/footer');
        } else {

            extract($_POST);
            $data = "";
            foreach ($_POST as $k => $v) {
                if (!in_array($k, array('id', 'user_ids')) && !is_numeric($k)) {
                    if ($k == 'description')
                        $v = htmlentities(str_replace("'", "&#x2019;", $v));
                    if (empty($data)) {
                        $data .= " $k='$v' ";
                    } else {
                        $data .= ", $k='$v' ";
                    }
                }
            }
            if (isset($user_ids)) {
                $data .= ", user_ids='" . implode(',', $user_ids) . "' ";
            }
            // echo $data;exit;
            if (empty($id)) {
                $save = $this->db->query("INSERT INTO project set $data");
            } else {
                $save = $this->db->query("UPDATE project set $data where id = $id");
            }
            if ($save) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Project added!</div>');
                redirect('project');
            }
        }
    }

    public function editProject($pro_id)
    {
        $data['title'] = 'Edit Projects';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['project'] = $this->db->get_where('project', ['id' => $pro_id])->row_array();
        $data['manager'] = $this->db->query("SELECT id, name FROM user where role_id = 2")->result_array();
        $data['member'] = $this->db->query("SELECT id, name FROM user where role_id = 3")->result_array();
        $date = date('d-m-Y');

        $id = $this->input->post('id');
        $this->form_validation->set_rules('name', 'Project Name', 'required');
        $this->form_validation->set_rules('status', 'Project Status', 'required');
        $this->form_validation->set_rules('start_date', 'Project Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'Project End Date', 'required');
        $this->form_validation->set_rules('manager_id', 'Project Manager', 'required');
        $this->form_validation->set_rules('user_ids[]', 'Project Members', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required|min_length[9]');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('project/editproject', $data);
            $this->load->view('templates/footer');
        } else {

            extract($_POST);
            $data = "";
            foreach ($_POST as $k => $v) {
                if (!in_array($k, array('id', 'user_ids')) && !is_numeric($k)) {
                    if ($k == 'description')
                        $v = htmlentities(str_replace("'", "&#x2019;", $v));
                    if (empty($data)) {
                        $data .= " $k='$v' ";
                    } else {
                        $data .= ", $k='$v' ";
                    }
                }
            }
            if (isset($user_ids)) {
                $data .= ", user_ids='" . implode(',', $user_ids) . "' ";
            }
            // echo $data;exit;
            $save = $this->db->query("UPDATE project set $data where id = $id");

            if ($save) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                New Project added!</div>');
                redirect('project');
            }
        }
    }

    public function deleteProject($project_id)
    {
        $data = $this->Project_model->deleteProject($project_id);
        $data = $this->Project_model->deleteTask($project_id);
        $data = $this->Project_model->DeleteProductivityP($project_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Project has been deleted! 
          </div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
           Project delete failed! 
          </div>');;
        }
        redirect('project');
    }

    public function tasklist()
    {
        $data['title'] = 'Projects';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $data['tasks'] = $this->db->get('tasks')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('project/tasklist', $data);
        $this->load->view('templates/footer');
    }

    public function save_task()
    {
        $data['title'] = 'Task';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $data['manager'] = $this->db->query("SELECT * FROM user where role_id = 2")->row_array();
        $data['member'] = $this->db->query("SELECT * FROM user where role_id = 3")->result_array();
        $data['tasks'] = $this->db->get('tasks')->result_array();
        $id = $this->input->post('id');
        $project_id = $this->input->post('project_id');


        $this->form_validation->set_rules('project_id', 'Project Name', 'required');
        $this->form_validation->set_rules('task', 'Task Title', 'required');
        $this->form_validation->set_rules('description', 'Select Members', 'required');
        $this->form_validation->set_rules('status', 'Task Status', 'required');
        print_r($_POST);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('project/viewproject', $data);
            $this->load->view('templates/footer');
        } else {
            print_r($_POST);
            $data = "";
            extract($_POST);
            foreach ($_POST as $k => $v) {
                if (!in_array($k, array('id')) && !is_numeric($k)) {
                    if ($k == 'description')
                        $v = htmlentities(str_replace("'", "&#x2019;", $v));
                    if (empty($data)) {
                        $data .= " $k='$v' ";
                    } else {
                        $data .= ", $k='$v' ";
                    }
                }
            }

            if (empty($id)) {
                $add = $this->db->query("INSERT INTO tasks set $data");
            } else {
                $edit = $this->db->query("UPDATE tasks set $data where id = $id");
            }
            if ($add) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                New Task added!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Task has been edited!</div>');
            }
            $pid = 'project/viewproject/' . $project_id;
            redirect($pid);
        }
    }


    public function deleteTask($task_id)
    {
        $data['title'] = 'Task';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->db->get_where('project', ['id'])->row_array();
        $data['tasks'] = $this->db->get('tasks')->result_array();

        $project_id = $this->input->post('project_id');
        $data = $this->Project_model->deleteTasks($task_id);
        $data = $this->Project_model->DeleteProductivity($task_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Task has been deleted! 
          </div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
           Task delete failed! 
          </div>');;
        }
        $pid = 'project/viewproject/' . $project_id;
        redirect($pid);
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

        print_r($_POST);

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
            print_r($data);
            if ($add) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Progress/Activity added!</div>');
                $pid = 'project/viewproject/' . $project_id;
                redirect($pid);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Progress/Activity has been edited!</div>');
                $pid = 'project/viewproject/' . $project_id;
                redirect($pid);
            }
        }
    }

    public function deleteProgress($p_id)
    {
        $data['title'] = 'Task';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->db->get_where('project', ['id'])->row_array();
        $data = $this->Project_model->deleteProgress($p_id);
        $data['tasks'] = $this->db->get('tasks')->result_array();
        $project_id = $this->input->post('project_id');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Progress has been deleted! 
          </div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
           Progress delete failed! 
          </div>');;
        }
        $pid = 'project/viewproject/' . $project_id;
        redirect($pid);
    }
}
