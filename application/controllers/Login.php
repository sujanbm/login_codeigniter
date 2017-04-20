<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {

    public function __construct(){

        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Users_model');
    }

    public function index(){
        $this->load->view('login/login_form');
    }

    public function authenticate(){
        $password = $this->input->post('password');
        if ($result = $this->Users_model->login()){

            if ($this->bcrypt->check_password($password, $result->password))
            {
                $sess_array = array(
                    'id' => $result->id,
                    'email' => $result->email
                );
                $this->session->set_userdata('logged_in', $sess_array);
//                return var_dump($this->session->userdata('logged_in'));
                redirect('Welcome', 'refresh');
            }
            else
            {
                $message = "Invalid Password";
                echo "<script type='text/javascript'>alert('$message');</script>";
                redirect('Login', 'refresh');
            }

        }
        else {
            $message = "Invalid Email or password";
            echo "<script type='text/javascript'>alert('$message');</script>";
            redirect('Login', 'refresh');
        }
    }
}

?>