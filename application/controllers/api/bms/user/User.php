<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('bms/user/user_model');
	}
	
	public function index(){
		$this->load->view('users/login.html');
	}

	public function login(){
		$email_address 	= $this->input->post('email_address');
		$password 		= $this->input->post('password');

		if ($this->form_validation->run('login')){
			$res 			= $this->user_model->login($email_address,$password);
			if(isset($res)){
				$sessionData = array(
					'userid'  => $res->id,
					'username'  => $res->username,
					'email'     => $res->email_address,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($sessionData);	
				$this->remember_me($email_address,$password);				
				redirect('api/bms/Dashboard');
				
				// echo $_SESSION['username'];
				// echo $_SESSION['email'];
				// echo $_SESSION['userid'];
				// die();
				//$this->load->view('View File',$data, FALSE);
			}else{
				echo "hello";
			}	
		}else{
			echo form_error('email_address');
			echo form_error('password');
		}
	}

	public function register(){
		$this->load->view('users/register.html');
	}

	public function signup(){
		$email_address 	= $this->input->post('email_address');
		$password 		= $this->input->post('password');
		$cfmpassword 	= $this->input->post('cfmpassword');
		$username 		= $this->input->post('username');

		if ($this->form_validation->run('signup')){
			$data 		= array('username' => $username ,'email_address' => $email_address ,'password' => $password);
			$res 		= $this->user_model->sign_up($data);
			if(isset($res)){
				mkdir('./assets/uploads/users/' . $res .'/profile', 0777, TRUE);
				mkdir('./assets/uploads/users/' . $res .'/product', 0777, TRUE);
				    
				$this->send_mail($email_address);
			}else{
				
			}	
		}else{
			echo form_error('email_address');
			echo form_error('password');
			echo form_error('cfmpassword');
			echo form_error('username');
		}
	}

	public function load_forgot_password(){
		$this->load->view('users/forgot.html');
	}

	public function forgot_password(){	
		if($_POST){
			$email_address      = $this->input->post('email_address');
			$this->send_mail($email_address);
			redirect('User/signin');
		}
		//$this->load->view('');
	}

	public function send_mail($email){
		$message = $this->set_message($email);
		echo $message;
		$this->email->from('anuragprofitfox@gmail.com', 'Anurag');
		$this->email->to($email);
		$this->email->subject('Email_Verification_mail');
		$this->email->message($message);
		$this->email->send();
		die();
	}

	public function set_message($email){
		$link  		= base_url('api/bms/user/user/verify_user_account').'/'.md5($email);  
		$message 	= '<h1>Dear Sir/mam</h1>';
		$message 	.= '<br><br><br><a href="'.$link.'">Please Click here to Activate Your account</a>';
		$message 	.= '<br><br><br><p>Thanks & Regards</p><br>';
		$message 	.= '<b>Anurag Rathore</b>';
		return $message;
	}

	public function verify_user_account($hashcode){
		$this->user_model->verify_user_account($hashcode);
		//redirect('');
	}


	/**
		* Set Cookie for Remember me
		* Type: function	
		* @param array $data
		* @return Ab_tests Add Message
	*/
	public function remember_me($email_address,$password){
		if($this->input->post("chkremember")){
			set_cookie('uemail', $email_address, 86400); 	
			set_cookie('upassword', $password, 86400); 
		}else{
			if(get_cookie('uemail') || get_cookie('upassword')){
				delete_cookie('uemail');
				delete_cookie('upassword');
			}
		} 
	}

	
}
