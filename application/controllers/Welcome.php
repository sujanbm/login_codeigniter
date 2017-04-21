<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->model('Users_model');
        $this->load->library(array('upload', 'form_validation', 'pagination'));

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
        $config = array();
        $config["base_url"] = site_url() . "/Welcome/index";
        $config["total_rows"] = $this->Users_model->record_count();
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Users_model->fetch_users($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
//
//        $users['user_list'] = $this->Users_model->get_all_users();
//        var_dump($data);
        $this->load->view('contact/view', $data);
	}

	public function create(){
		$this->load->view('contact/create');
	}

	public function edit($id){
		$user = $this->Users_model->get_User_By_Id($id);
		$this->load->view('contact/edit', $user);
	}

	public function add_user()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name','required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|regex_match[/^[0-9]{10}$/]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('contact/create');
        }
        else
        {

            $password = $this->input->post('password');

            $file_name = $this->file_upload('file');
            if ($this->Users_model->insert_User($file_name, $password)) {
                redirect(base_url());
            }
    }
    }


    public function file_upload($file)
    {
        //Set the config
        $config['upload_path'] = './uploads/'; //Use relative or absolute path
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '10000';
        $config['max_width'] = '1920';
        $config['max_height'] = '1080';
        $config['overwrite'] = FALSE; //If the file exists it will be saved with a progressive number appended

        //Initialize
        $this->load->library('upload');
        $this->upload->initialize($config);

        //Upload file
        if (!$this->upload->do_upload("file")) {

            //echo the errors
            echo $this->upload->display_errors();
        } else {
            //If the upload success
            $file_name = $this->upload->file_name;

            //Save the file name into the db
            return $file_name;

        }
    }

	public function edit_user(){
        $file_name = $this->file_upload('file');
		if($this->Users_model->update_User($file_name)){
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