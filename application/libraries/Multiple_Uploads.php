<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multiple_Uploads {

    public function __construct()
    {

    }


    public function multiple_uploads($id){

        //Set the config
        $config['upload_path'] = './uploads/'; //Use relative or absolute path
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '10000';
        $config['max_width'] = '1920';
        $config['max_height'] = '1080';
        $config['overwrite'] = FALSE; //If the file exists it will be saved with a progressive number appended

        //Initialize
        $CI =& get_instance();
        $CI->load->library('upload');
        $CI->upload->initialize($config);

        $filesCount = count($_FILES['files']['name']);

        if($filesCount != 0) {
            for ($i = 0; $i < $filesCount; $i++) {

                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                if ($CI->upload->do_upload('file')) {
                    $fileData = $CI->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['contact_id'] = $id;

                }
//            else{
////                $message = $this->upload->display_errors();
////                echo "<script type='text/javascript'>alert('$message');</script>";
//            }
            }

            return $uploadData;


        }

        else{
            echo "No files to upload";
        }

    }

}

//if (!empty($uploadData)) {
//    //Insert file information into the database
//    if ($this->Users_model->insert_Photos($uploadData)) {
//        $this->add_photos($id);
//    } else {
//        $message = "Error during Upload";
//        echo "<script type='text/javascript'> alert('$message');</script>";
//    }
//
//}
//$this->add_photos($id);