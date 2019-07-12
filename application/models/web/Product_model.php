<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model{

	public function product_category_list(){
		$this->db->select('');
		$this->db->from('product_category');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function product_featured_images(){
		$this->db->select('');
		$this->db->from('product');
		$this->db->order_by('rand()');
		$this->db->limit(6);
		$query=$this->db->get();
		return $query->result_array();
	}

	public function product_recommended_images(){
		$this->db->select('');
		$this->db->from('product');
	////	$this->db->order_by('rand()');
		$this->db->limit(3);
		$query=$this->db->get();
		return $query->result_array();
	}

	public function product_slider_images(){
		$this->db->select('');
		$this->db->from('product');
		$this->db->order_by('rand()');
		$this->db->limit(4);
		$query=$this->db->get();
		return $query->result_array();
	}

	
}
