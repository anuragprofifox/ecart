<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends CI_Model{


	public function add_slider($data){
		$this->db->insert('slider', $data);
		return $this->db->insert_id();
	}
	
	
}
