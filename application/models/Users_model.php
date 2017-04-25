<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_model extends CI_Model{

  public function __construct(){
    parent::__construct();

    }

  public function get_All_Users(){
    $query = $this->db->get('users');
    return $query->result();
  }

  public function insert_User($file_name, $password){
      $user = array(
          'first_name' => $this->input->post('first_name'),
          'last_name' => $this->input->post('last_name'),
          'email' => $this->input->post('email'),
          'password' => $this->bcrypt->hash_password($password),
          'phone_number' => $this->input->post('phone_number'),
          'file' => $file_name
      );

    return $this->db->insert('users', $user);
  }

  public function get_Last_Id(){
      $id = $this->db->insert_id();
      return $id;
  }

  public function get_User_By_Id($id){
    $this->db->where(array('id' => $id));
    $query = $this->db->get('users');
    return $query->row();
  }

  public function update_User($file_name){
        $user = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'phone_number' => $this->input->post('phone_number'),
                'file' => $file_name
            );
            $id = $this->input->post('id');
        $this->db->where('id', $id);
        return $this->db->update('users', $user);

  }

  public function delete_User($id){
      $this->db->trans_begin();
      $this->db->where(array('contact_id'=>$id));
      $this->db->delete('photos');
      $this->db->where('id', $id);
      $this->db->delete('users');
      $this->db->trans_complete();
      if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return FALSE;
      }
      else{
          $this->db->trans_commit();

          return TRUE;
      }
  }

  public function upload($files){
      return $this->db->insert('photos', $files);
  }

    public function insert_Photos($file_names = array()){

        return $this->db->insert_batch('photos', $file_names);

    }

    public function get_Photos($id){

        $this->db->where(array('contact_id'=>$id));
        $query = $this->db->get('photos');

        return $query->result();


    }

    public function login(){
      $email = $this->input->post('email');
      $this->db->select('id, email, password, first_name');
      $this->db->from('users');
      $this->db->where(array('email'=>$email));

      $query = $this->db->get();

      if($query -> num_rows() == 1)
      {
          return $query->row();
      }
      else
      {
          return false;
      }

  }

  public function record_count(){

        return $this->db->count_all('users');
  }

  public function delete_photo($userId, $photoId){

      $this->db->trans_begin();
      $this->db->where(array('id'=>$photoId, 'contact_id'=>$userId));
      $this->db->delete('photos');
      $this->db->trans_complete();
      if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return FALSE;
      }else{
            $this->db->trans_commit();
             return TRUE;
      }
  }

  public function fetch_users($limit, $start){
      $this->db->limit($limit, $start);
      $query = $this->db->get('users');
      if($query->num_rows() > 0){
          foreach($query->result() as $row){
                $data[] = $row;
          }
          return $data;
      }
      else{
          return false;

      }
  }

  public function phone_check($phone){

      $this->db->where(array('phone_number'=>$phone));
      $query = $this->db->get('users');
      if($query->num_rows() > 0){
          return FALSE;
      }else{
          return TRUE;
      }

  }

}

?>
