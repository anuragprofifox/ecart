<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploadfile extends CI_Controller {

	public function __construct(){
		parent::__construct();

		//Temporary folder for storing uploads
		//$tempDirectory = base_url().'assets/files/tmp/';

		//Final folder for storing uploads
		$mainDirectory = base_url().'assets/files/';
		//$tmpName = 0;
	}
	
	public function index(){
		$this->load->view('uploadfile.html');
	}
	

	//Create a random file name for the file to use as it's being uploaded
	function createTempName() {
		$tmpName = mt_rand() . '';
	}

	//Function to upload the file chunks into the temp folder
	function uploadFile() {
		// echo $tmpName = mt_rand() . '';
		// die();
		$tmpName = mt_rand() . '';
		//Create a filename if this is the first chunk
		// if($tmpName == 0) {
		// 	$this->createTempName();
		// }

		//Open the raw POST data from php://input
		$fileData = file_get_contents('php://input');


		$tempDirectory = base_url().'assets/files/tmp/';
		//Write the actual chunk
		$handle = fopen($tempDirectory . $tmpName, 'a');
		fwrite($handle, $fileData);
		fclose($handle);

		return json_encode(array(
			'key' => $tmpName,
			'errorStatus' => 0
		));
	}

		//Function for cancelling uploads while they're in-progress; just deletes the temp file
		function abortUpload() {
			if(unlink($tempDirectory . $tmpName)) {
				return json_encode(array('errorStatus' => 0));
			}
			else {

				return json_encode(array(
					'errorStatus' => 1,
					'errorText' => 'Unable to delete temporary file.'
				));
			}
		}

		//Function to rename and move the finished file
		function finishUpload($finalName) {
			if(rename($tempDirectory . $tmpName, $mainDirectory . $finalName)) {
				return json_encode(array('errorStatus' => 0));
			}
			else {
				return json_encode(array(
					'errorStatus' => 1,
					'errorText' => 'Unable to move file after uploading.'
				));
			}
		}
	

	// $bigUpload = new BigUpload;
	// $bigUpload->tmpName = (isset($_GET['key'])) ? $_GET['key'] : $_POST['key'];

	// switch($_GET['action']) {
	// 	case 'upload':
	// 		print $bigUpload->uploadFile();
	// 		break;
	// 	case 'abort':
	// 		print $bigUpload->abortUpload();
	// 		break;
	// 	case 'finish':
	// 		print $bigUpload->finishUpload($_POST['name']);
	// 		break;
	// }

	
}
