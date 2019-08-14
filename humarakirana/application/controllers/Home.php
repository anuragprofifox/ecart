<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('home_model');
		
	}
	

	public function index(){
		$this->load_page('index');
	}

	public function contactus(){
		$this->load_page('contact');
	}

	public function submitquery(){
		$name 			= $this->input->post('name');
		$contact_number = $this->input->post('contact_number');
		$subject 		= $this->input->post('subject');
		$message 		= $this->input->post('message');
		
		if ($this->form_validation->run('submitquery')){
			$data 		= array('name' => $name ,'contact_number' => $contact_number ,'subject' => $subject,'message' => $message);
			$res  = $this->home_model->submitquery($data);
			redirect('home/contactus');
		
		}else{
			redirect('home/contactus');
			// echo form_error('name');
			// echo form_error('contact_number');
			// echo form_error('subject');
			// echo form_error('message');
			// show error
		}

	}


	public function aboutus(){
		$this->load_page('about');
	}
	
	
	public function shop(){	
		$this->load_page('shop');
	}
	
	public function load_page($page_name){
		$this->load->view('header');
		$this->load->view($page_name);
		$this->load->view('footer');
	}


}
