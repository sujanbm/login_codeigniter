<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Users_model');
        if(is_null($this->session->userdata('logged_in'))){
            redirect(base_url());
        }
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $users['user_list'] = $this->Users_model->get_all_users();
            //var_dump($users);
            $this->load->view('contact/view', $users);
	}

	public function create(){
		$this->load->view('contact/create');
	}

	public function edit($id){
		$user = $this->Users_model->get_User_By_Id($id);
		$this->load->view('contact/edit', $user);
	}

	public function add_user(){

	    $password = $this->input->post('password');
		$user = array(
			'first_name' => $this->input->post('first_name'),
		 	'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
            'password' => $this->bcrypt->hash_password($password),
			'phone_number' => $this->input->post('phone_number'),
			);
		if($this->Users_model->insert_User($user)){
			redirect(base_url());
		}
	}

	public function edit_user(){

		if($this->Users_model->update_User()){
						redirect(base_url());
		}


	}

	public function delete($id){
			if($this->Users_model->delete_User($id)){
				redirect(base_url());
			}

	}

	public function logout(){
	    $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect(base_url());
    }
}
