<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model{

	public function submitquery($data){
		$this->db->insert('tbl_contacts', $data);
		return $this->db->insert_id();
	}


	
}
