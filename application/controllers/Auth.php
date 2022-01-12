<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Project_model');
    }
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //validasi sukses
            $this->_login();
        }
    }
    // $token, $type
    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'gamingjos08@gmail.com',
            'smtp_pass' => 'gerakanpramuka08',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        // $this->email->initialize($config);

        $this->email->initialize($config);
        $this->load->library('email', $config);

        $this->email->from('gamingjos08@gmail.com', 'Admin ManPro');
        $this->email->to($this->input->post('email'));
        //(Contoh) $this->email->to('fajarhusain.08@gmail.com');
        // $this->email->subject('Testing');
        // $this->email->message('Hello World');

        if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Hello, <br> Your reset password has been received. Please click link below to reset your password. <br><br>'
                . ' <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Click here to Reset Password</a> <br><br>'
                . 'Thanks<br>ManPro');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    private function _login()
    {

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            //jika user aktif
            foreach ($user as $key => $value) {
                $_SESSION['login_' . $key] = $value;
            }
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                    redirect('project/dashboard');
                } else {
                    redirect('project/dashboard');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong password!</div>');
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           You have been logout!
          </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[7]|matches[password2]'
        );
        $this->form_validation->set_rules(
            'password2',
            'Repeat Password',
            'required|trim|min_length[7]|matches[password1]'
        );

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/changepassword');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->db->delete('user_token', ['email' => $email]);

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Password has been changed! Please login.
               </div>');
            redirect('auth');
        }
    }
}
