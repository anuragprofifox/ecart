<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('web/Product_model');
	}
	
	public function index(){

		$data['product_category_list']		=$this->Product_model->product_category_list();
		$data['product_featured_images']	=$this->Product_model->product_featured_images();
		$data['product_recommended_images']	=$this->Product_model->product_recommended_images();
		$data['product_slider_images']	=$this->Product_model->product_slider_images();
		
		$this->load->view('web/products', $data);
	}




	
}
