<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function __construct(){
		parent::__construct();

	}
	
	public function add_folder(){
		
	}


	public function index(){
		$this->load->view('template/header.html');
		$this->load->view('gallery/gallery.html');
		$this->load->view('template/menu_panel.html');
	}

	




}
