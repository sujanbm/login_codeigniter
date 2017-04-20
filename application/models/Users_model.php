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

  public function insert_User($user){
    return $this->db->insert('users', $user);
  }

  public function get_User_By_Id($id){
    $this->db->where(array('id' => $id));
    $query = $this->db->get('users');
    return $query->row();
  }

  public function update_User(){
    $user = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'phone_number' => $this->input->post('phone_number')
		);
		$id = $this->input->post('id');
    $this->db->where('id', $id);
    return $this->db->update('users', $user);

  }

  public function delete_User($id){
    $this->db->where('id', $id);
    return $this->db->delete('users');
  }

  public function login(){
      $email = $this->input->post('email');
      $this->db->select('id, email, password');
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
}

?>
