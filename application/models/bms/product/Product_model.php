<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model{


	public function add_product($data){
		$this->db->insert('product', $data);
		return $this->db->insert_id();
	}


	public function add_product_image($id,$image_name){
		$this->db->set('image', $image_name);
		$this->db->set('thumb', $image_name);
		$this->db->where('id', $id);
		$this->db->update('product');
		return true;
	}

	public function productPicName($id){
		$this->db->select('image');
		$this->db->from('product');
		$this->db->where('id', $id);
		$result = $this->db->get();
		$row = $result->row();
		return $row->image;
	}
	
	
}
