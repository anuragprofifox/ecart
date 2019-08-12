<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('web/Product_model');
	}
	
	public function index(){
		$data['product_category_list']		=$this->Product_model->product_category_list();
		$data['product_featured_images']	=$this->Product_model->product_featured_images();
		$data['product_featured_images_nuts']	=$this->Product_model->product_featured_images_nuts();
		$data['product_featured_images_oil']	=$this->Product_model->product_featured_images_oil();
		$data['product_featured_images_Packagedfood']	=$this->Product_model->product_featured_images_Packagedfood();
		$data['special_products']			=$this->Product_model->special_products();
		$data['special_offer']			=$this->Product_model->special_offer();

		$data['product_slider_images']		=$this->Product_model->product_slider_images();
		
		$this->load->view('web/index', $data);
	}




	
}
