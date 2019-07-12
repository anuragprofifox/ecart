<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('bms/product/product_model');
	}
	
	public function index(){
		$this->load->view('template/header.html');
		$this->load->view('products/products.html');
		$this->load->view('template/menu_panel.html');
	}


	public function add_product(){	
		$title 			= $this->input->post('title');
		$category 		= $this->input->post('category_id');
		$quantity 		= $this->input->post('quantity');
		$price 			= $this->input->post('price');
		$weight 		= $this->input->post('weight');
		$is_available 	= $this->input->post('is_available');
		$unit 			= $this->input->post('unit');

		if ($this->form_validation->run('addproduct')){
			$data 		= array('title' => $title,'category' => $category,'quantity' => $quantity, 'price' => $price,
			 					'weight' => $weight,'is_available' => $is_available, 'unit' => $unit);
			$res 		= $this->product_model->add_product($data);
			if(isset($res)){
				$folder_name = '/product/';
				$image_name = $this->picture_upload($folder_name,$res);
				$this->product_model->add_product_image($res,$image_name);
			}else{
				
			}	
		}else{
			echo form_error('title');
			echo form_error('category');
			echo form_error('qty');
			echo form_error('price');
		}
	}




	public function picture_upload($folder_name,$res){	
		$id   = $res;              							//Fetch userID to Insert image in their folder
		$name = $_FILES['picture']['name'];
		$ext  = pathinfo($name, PATHINFO_EXTENSION);
		$filename = $id . "_" . "img." . $ext;
		$img_path = './assets/uploads/users/' . $_SESSION['userid'] .$folder_name;

		$config['upload_path'] = $img_path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 1000;
		$config['max_width'] = 1366;
		$config['max_height'] = 768;
		$config['file_ext_tolower'] = true;
		$config['remove_spaces'] = true;
		$config['file_name'] = $filename;
		$this->load->library('upload',$config);
        $this->upload->initialize($config);
		
		$prev_image = $this->product_model->productPicName($id);
		if(file_exists($img_path . $prev_image)){
			unlink($img_path . $prev_image);
		}

		if($this->upload->do_upload('picture')){
			$uploadData = $this->upload->data();
			$picture = $uploadData['file_name'];
		}else{
			$picture = '';
		}
		return $picture;
	}


	public function video_upload(){
		$name = $_FILES['video']['name'];
		$ext  = pathinfo($name, PATHINFO_EXTENSION);
		$filename = $_FILES['video']['name'];
		$video_path = './assets/uploads/';

		$config['upload_path'] = $video_path;
		$config['allowed_types'] = 'mp4';
		$config['remove_spaces'] = true;
		$config['file_name'] = $filename;
		$this->load->library('upload',$config);
        $this->upload->initialize($config);
		

		if($this->upload->do_upload('video')){
			$uploadData = $this->upload->data();
			$video = $uploadData['file_name'];
		}else{
			$video = '';
		}
		return $video;
	}




	
}
