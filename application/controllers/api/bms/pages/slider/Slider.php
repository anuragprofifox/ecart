<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('bms/pages/slider_model');
	}
	
	public function index(){
		$this->load->view('template/header.html');
		$this->load->view('pages/slider/slider.html');
		$this->load->view('template/menu_panel.html');
	}

	public function add_slider(){
		$title 			= $this->input->post('title[]', true);
		$description 	= $this->input->post('description[]', true);
		$image 			= $_FILES['picture']['name']; 

		for($i = 0; $i < sizeof($title); $i++){		
			$data = array(
				'title' 		=> (!empty($title[$i])) ? $title[$i] : 0,
				'description' 	=> (!empty($description[$i])) ? $description[$i] : 0,
				'image' 		=> (!empty($image[$i])) ? $image[$i] : 0,
			);

			$res = $this->slider_model->add_slider($data);
			$folder_name = '/profile/';
			$image_name = $this->picture_upload($folder_name, $res, $image[$i]);

		}

		die();
	}

	public function picture_upload($folder_name,$res, $image_name){	
		

		$id   = $res;              							
		$name = $image_name;
		$ext  = pathinfo($name, PATHINFO_EXTENSION);
		$filename = $id . "_" . "img." . $ext;
		//$img_path = './assets/uploads/users/' . '3' .$folder_name;
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

		if($this->upload->do_upload('picture[]')){
			$uploadData = $this->upload->data();
			$picture = $uploadData['file_name'];
		}else{
			$picture = '';
		}
		return $picture; 
	}
	
}
