<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

	public function login($email_address,$password){	
		$this->db->select('id,username,email_address');
		$this->db->where('email_address', $email_address);
		$this->db->where('password', $password);	
		$this->db->where('is_verified', '1');	
		$query = $this->db->get('user');
		return $query->row();
	}


	public function sign_up($data){
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}

	
    public function verify_user_account($key){
        $data = array('is_verified' => 1);
        $this->db->where('md5(email_address)',$key);
        return $this->db->update('user', $data);   
	}

	
}
