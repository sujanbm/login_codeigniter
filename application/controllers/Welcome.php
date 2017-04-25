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
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;


        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Users_model->fetch_users($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

//        $users['user_list'] = $this->Users_model->get_all_users();
//        var_dump($data);
        $this->load->helper('test');
        $data["test"] = test();

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
        $this->form_validation->set_rules('first_name', 'First Name', 'required|callback_name_check');
        $this->form_validation->set_rules('last_name', 'Last Name','required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[25]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('phone_number', 'Phone Number', array('required',array('check',array($this->Users_model, 'phone_check') ) ));
        $this->form_validation->set_message('check', 'Phone number already taken');
//        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|callback_phone_check');
        $this->form_validation->set_rules('files', 'Profile Photo', 'required');
        $this->form_validation->set_rules('file', 'Photos', 'required');


        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('contact/create');
        }
        else
        {

            $password = $this->input->post('password');

            $file_name = $this->file_upload('file');

            if ($this->Users_model->insert_User($file_name, $password)) {
                $id = $this->Users_model->get_Last_Id();
                $this->load->library('multiple_uploads');

               $data = $this->multiple_uploads->multiple_uploads($id);
                if($data != FALSE){
                    if ($this->Users_model->insert_Photos($data)) {
                        $this->profile($id);
                    } else {
                        $message = "Error during Upload";
                        echo "<script type='text/javascript'> alert('$message');</script>";
                    }
                }
                else {
                    $this->profile($id);
                }
//                redirect(base_url());
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

	public function profile($id){

	    $users['user']= $this->Users_model->get_User_By_Id($id);
        $users['files'] = $this->Users_model->get_Photos($id);
        $this->load->library('calendar');
        $users['data'] = $this->calendar->generate();
        $this->load->view('contact/user', $users);
    }

    public function files_upload($id){

        $this->load->library('multiple_uploads');
        $data = $this->multiple_uploads->multiple_uploads($id);
        if($data != FALSE){
            if ($this->Users_model->insert_Photos($data)) {
                $this->profile($id);
            } else {
                $message = "Error during Upload";
                echo "<script type='text/javascript'> alert('$message');</script>";

            }
        }else
        {
            $this->profile($id);
        }


    }


    public function delete_photo($userId, $photoId){

        if($this->Users_model->delete_photo($userId, $photoId)){
            $this->profile($userId);
        }else{
            echo "Error";
        }

    }

	public function logout(){
	    $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect(base_url());
    }

    public function name_check($str)
    {
        if ($str == 'test' || $str == 'asdf' )
        {
            $this->form_validation->set_message('name_check', 'The {field} can not be the word "test"');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function phone_check($str){

        if($this->Users_model->phone_check($str)){

            return TRUE;
        }else{
            $this->form_validation->set_message('phone_check', 'The number is already taken');
            return FALSE;
        }

    }



}


//
//	public function multiple_upload($id){
//
//        //Set the config
//        $config['upload_path'] = './uploads/'; //Use relative or absolute path
//        $config['allowed_types'] = 'gif|jpg|png';
//        $config['max_size'] = '10000';
//        $config['max_width'] = '1920';
//        $config['max_height'] = '1080';
//        $config['overwrite'] = FALSE; //If the file exists it will be saved with a progressive number appended
//
//        //Initialize
//        $this->load->library('upload');
//        $this->upload->initialize($config);
//
//        $filesCount = count($_FILES['files']['name']);
//
//        if($filesCount != 0) {
//            for ($i = 0; $i < $filesCount; $i++) {
//
//                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
//                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
//                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
//                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
//                $_FILES['file']['size'] = $_FILES['files']['size'][$i];
//
//                if ($this->upload->do_upload('file')) {
//                    $fileData = $this->upload->data();
//                    $uploadData[$i]['file_name'] = $fileData['file_name'];
//                    $uploadData[$i]['contact_id'] = $id;
//                }
////            else{
//////                $message = $this->upload->display_errors();
//////                echo "<script type='text/javascript'>alert('$message');</script>";
////            }
//            }
//
//            if (!empty($uploadData)) {
//                //Insert file information into the database
//                if ($this->Users_model->insert_Photos($uploadData)) {
//                    $this->profile($id);
//                } else {
//                    $message = "Error during Upload";
//                    echo "<script type='text/javascript'> alert('$message');</script>";
//                }
//
//            }
//        }
//        $this->profile($id);
//    }


