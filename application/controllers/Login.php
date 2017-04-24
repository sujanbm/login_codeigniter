<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {

    public function __construct(){

        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
        $this->load->model('Users_model');
    }

    public function index(){

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required');

        $userCaptcha = $this->input->post('captcha');

        $word = $this->session->userdata('captchaWord');

        if($this->form_validation->run() == TRUE && strcmp(strtoupper($userCaptcha), strtoupper($word)) == 0)

        {

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

        else{
//            $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
            $config = array(
//                'word' => $random_number,
                'img_path' => './static/',
                'img_url' => base_url().'static/',
                'img_width'     => '150',
                'img_height'    => 50,
                'word_length'   => 5,
                'font_size'     => 20,
                'expiration'    => 7200
            );
            $this->load->helper('captcha');
            $data = create_captcha($config);

            $this->session->set_userdata('captchaWord', $data['word']);

            $this->load->view('login/login_form', $data);
        }

    }

//
//    public function authenticate(){
//
//        $this->form_validation->set_rules('email', 'Email', 'required');
//        $this->form_validation->set_rules('password', 'Password', 'required');
//        $this->form_validation->set_rules('captcha', 'Captcha', 'required');
//
//        $userCaptcha = set_value('captcha');
//
//        $word = $this->session->userdata('captchaWord');
//
//        if($this->form_validation->run() == TRUE && strcmp(strtoupper($userCaptcha), strtoupper($word)) == 0)
//
//        {
//
//            $password = $this->input->post('password');
//
//            if ($result = $this->Users_model->login()){
//
//                if ($this->bcrypt->check_password($password, $result->password))
//                {
//                    $sess_array = array(
//                        'id' => $result->id,
//                        'email' => $result->email
//                    );
//                    $this->session->set_userdata('logged_in', $sess_array);
////                return var_dump($this->session->userdata('logged_in'));
//                    redirect('Welcome', 'refresh');
//                }
//                else
//                {
//                    $message = "Invalid Password";
//                    echo "<script type='text/javascript'>alert('$message');</script>";
//                    redirect('Login', 'refresh');
//                }
//
//            }
//            else {
//                $message = "Invalid Email or password";
//                echo "<script type='text/javascript'>alert('$message');</script>";
//                redirect('Login', 'refresh');
//            }
//
//        }
//
//        else{
////            $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
//            $config = array(
////                'word' => $random_number,
//                'img_path' => './static/',
//                'img_url' => base_url().'static/',
//                'img_width'     => '150',
//                'img_height'    => 50,
//                'word_length'   => 8,
//                'font_size'     => 16
//            );
//            $this->load->helper('captcha');
//            $data['captcha'] = create_captcha($config);
//
//            $this->session->set_userdata('captchaWord', $data['captcha']['word']);
//
//            $this->load->view('login/login_form', $data);
//        }
//
//    }
}

?>