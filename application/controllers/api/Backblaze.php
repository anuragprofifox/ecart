<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backblaze extends CI_Controller {

	public function __construct(){
		parent::__construct();

	}
	
	public function index(){
		echo "hello";
	}

	//Fetch api_url,downloadurl information
	public function authorize_account(){
		$application_key_id = "147cd01b5a68"; // Obtained from your B2 account page
		$application_key 	= "002209184f1b7bb99c53256e456fec038776c7df3a"; // Obtained from your B2 account page
		$credentials 		= base64_encode($application_key_id . ":" . $application_key);
		$url = "https://api.backblazeb2.com/b2api/v2/b2_authorize_account";
		
		$session = curl_init($url);
		
		// Add headers
		$headers 	= array();
		$headers[] = "Accept: application/json";
		$headers[] = "Authorization: Basic " . $credentials;
		curl_setopt($session, CURLOPT_HTTPHEADER, $headers);  // Add headers
		
		curl_setopt($session, CURLOPT_HTTPGET, true);  // HTTP GET
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true); // Receive server response
		$server_output = curl_exec($session);
		curl_close ($session);
		echo ($server_output);

		/* We will get these details
			{ 	
				"absoluteMinimumPartSize": 5000000, "accountId": "147cd01b5a68", 
				"allowed": { "bucketId": null, "bucketName": null, 
				"capabilities": [ "listKeys", "writeKeys", "deleteKeys", "listBuckets", "writeBuckets", 
				"deleteBuckets", "listFiles", "readFiles", "shareFiles", "writeFiles", "deleteFiles" ], "namePrefix": null }, 
				"apiUrl": "https://api002.backblazeb2.com", 
				"authorizationToken": "4_002147cd01b5a680000000000_018d4c36_d47af5_acct_8SQ4r2LRCypwp1wl0rPo1ySwDm4=", 
				"downloadUrl": "https://f002.backblazeb2.com", 
				"recommendedPartSize": 100000000 
			} 
		*/
	}

	//Bucket Will delete only if it is Empty otherwise we cant delete it
	public function delete_bucket(){
		$account_id 	= "147cd01b5a68"; // Obtained from your B2 account page
		$api_url 		= "https://api002.backblazeb2.com"; // From b2_authorize_account call
		$auth_token 	= "4_002147cd01b5a680000000000_018d4c36_d47af5_acct_8SQ4r2LRCypwp1wl0rPo1ySwDm4="; // From b2_authorize_account call
		$bucket_id 		= "6114278c8d80b1cb65ba0618"; 


		$session = curl_init($api_url .  "/b2api/v2/b2_delete_bucket");

		// Add post fields
		$data = array("accountId" => $account_id, "bucketId" => $bucket_id);
		$post_fields = json_encode($data);
		curl_setopt($session, CURLOPT_POSTFIELDS, $post_fields); 

		// Add headers
		$headers = array();
		$headers[] = "Authorization: " . $auth_token;
		curl_setopt($session, CURLOPT_HTTPHEADER, $headers); 

		curl_setopt($session, CURLOPT_POST, true); // HTTP POST
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);  // Receive server response
		$server_output = curl_exec($session); // Let's do this!
		curl_close ($session); // Clean up
		echo ($server_output);
	}

	//Create New Bucket 
	public function create_bucket(){
		$account_id 	= "147cd01b5a68"; // Obtained from your B2 account page
		$api_url 		= "https://api002.backblazeb2.com"; // From b2_authorize_account call
		$auth_token 	= "4_002147cd01b5a680000000000_018d4c36_d47af5_acct_8SQ4r2LRCypwp1wl0rPo1ySwDm4="; // From b2_authorize_account call
		$bucket_name 	= "anuragsnew"; // 6 char min, 50 char max: letters, digits, - and _
		$bucket_type 	= "allPublic"; // Either allPublic or allPrivate

		$session = curl_init($api_url .  "/b2api/v2/b2_create_bucket");

		// Add post fields
		$data = array("accountId" => $account_id, "bucketName" => $bucket_name, "bucketType" => $bucket_type);
		$post_fields = json_encode($data);
		curl_setopt($session, CURLOPT_POSTFIELDS, $post_fields); 

		// Add headers
		$headers = array();
		$headers[] = "Authorization: " . $auth_token;
		curl_setopt($session, CURLOPT_HTTPHEADER, $headers); 

		curl_setopt($session, CURLOPT_POST, true); // HTTP POST
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);  // Receive server response
		$server_output = curl_exec($session); // Let's do this!
		curl_close ($session); // Clean up
		echo ($server_output); // Tell me about the rabbits, George!

		/* We will get these details 
			{ 
				"accountId": "147cd01b5a68", "bucketId": "d184771c8d50b17b65ba0618", 
				"bucketInfo": {}, "bucketName": "anurags", "bucketType": "allPublic", 
				"corsRules": [], "lifecycleRules": [], "options": [], "revision": 2 } 
		*/

	}

	//Show list of all Buckets
	public function list_bucket(){
		$account_id = "147cd01b5a68"; // Obtained from your B2 account page
		$api_url 	= "https://api002.backblazeb2.com"; // From b2_authorize_account call
		$auth_token = "4_002147cd01b5a680000000000_018d4c36_d47af5_acct_8SQ4r2LRCypwp1wl0rPo1ySwDm4="; // From b2_authorize_account call

		$session = curl_init($api_url .  "/b2api/v2/b2_list_buckets");

		// Add post fields
		$data = array("accountId" => $account_id);
		$post_fields = json_encode($data);
		curl_setopt($session, CURLOPT_POSTFIELDS, $post_fields); 

		// Add headers
		$headers = array();
		$headers[] = "Authorization: " . $auth_token;
		curl_setopt($session, CURLOPT_HTTPHEADER, $headers); 

		curl_setopt($session, CURLOPT_POST, true); // HTTP POST
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);  // Receive server response
		$server_output = curl_exec($session); // Let's do this!
		curl_close ($session); // Clean up
		echo ($server_output); // Tell me about the rabbits, George!

		/*
			{
			"buckets": [ 
				{ 	"accountId": "147cd01b5a68", 
					"bucketId": "d184771c8d50b17b65ba0618", "bucketInfo": {}, 
					"bucketName": "anurags", "bucketType": "allPublic", "corsRules": [], 
					"lifecycleRules": [], "options": [], "revision": 2 }, 
				{ 	"accountId": "147cd01b5a68", "bucketId": "7134874c2de0b17b65ba0618", 
					"bucketInfo": {}, "bucketName": "ecarts", "bucketType": "allPublic", 
					"corsRules": [], "lifecycleRules": [], "options": [], "revision": 4 } ] } 
		*/

	}

	//get Uploaded Url and put this url inside the upload file function
	public function get_uploaded_url(){
		$api_url 	= "https://api002.backblazeb2.com"; // From b2_authorize_account call
		$auth_token = "4_002147cd01b5a680000000000_018d4c36_d47af5_acct_8SQ4r2LRCypwp1wl0rPo1ySwDm4="; // From b2_authorize_account call
		$bucket_id 	= "d184771c8d50b17b65ba0618";  // The ID of the bucket you want to upload to

		$session = curl_init($api_url .  "/b2api/v2/b2_get_upload_url");

		// Add post fields
		$data = array("bucketId" => $bucket_id);
		$post_fields = json_encode($data);
		curl_setopt($session, CURLOPT_POSTFIELDS, $post_fields); 

		// Add headers
		$headers = array();
		$headers[] = "Authorization: " . $auth_token;
		curl_setopt($session, CURLOPT_HTTPHEADER, $headers); 

		curl_setopt($session, CURLOPT_POST, true); // HTTP POST
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);  // Receive server response
		$server_output = curl_exec($session); // Let's do this!
		curl_close ($session); // Clean up
		echo ($server_output); // Tell me about the rabbits, George!

		/*
		{ 	
			"authorizationToken": "4_002147cd01b5a680000000000_018d4c4a_2690fb_upld_YoK-yBz17Mj5QQS60UQ1bVwRtXw=", 
			"bucketId": "d184771c8d50b17b65ba0618", 
			"uploadUrl": "https://pod-000-1126-02.backblaze.com/b2api/v2/b2_upload_file/d184771c8d50b17b65ba0618/c002_v0001126_t0048" 
		} 
		*/
	}


	//Upload file on Backblazz 
	public function upload_file(){
		$file_title = explode("/",$_GET['url']);
		$file_name = end($file_title);

		$my_file = $_GET['url'];
		$handle = fopen($my_file, 'r');
		$read_file = fread($handle,filesize($my_file));

		$upload_url = "https://pod-000-1126-02.backblaze.com/b2api/v2/b2_upload_file/d184771c8d50b17b65ba0618/c002_v0001126_t0048"; 
		$upload_auth_token = "4_002147cd01b5a680000000000_018d4c4a_2690fb_upld_YoK-yBz17Mj5QQS60UQ1bVwRtXw=";
		$bucket_id = "d184771c8d50b17b65ba0618";  
		$content_type = "text/plain";
		$sha1_of_file_data = sha1_file($my_file);

		$session = curl_init($upload_url);

		curl_setopt($session, CURLOPT_POSTFIELDS, $read_file); 

		$headers = array();
		$headers[] = "Authorization: " . $upload_auth_token;
		$headers[] = "X-Bz-File-Name: " . $file_name;
		$headers[] = "Content-Type: " . $content_type;
		$headers[] = "X-Bz-Content-Sha1: " . $sha1_of_file_data;
		curl_setopt($session, CURLOPT_HTTPHEADER, $headers); 

		curl_setopt($session, CURLOPT_POST, true); 
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);  
		$server_output = curl_exec($session); 
		curl_close ($session); 
		echo ($server_output);  
	}

	//Get File Name , ID aur detailed Information
	public function get_file_detail(){
		$api_url 	= "https://api002.backblazeb2.com";
		$auth_token = "4_002147cd01b5a680000000000_018d4c36_d47af5_acct_8SQ4r2LRCypwp1wl0rPo1ySwDm4="; 
		$bucket_id = "d184771c8d50b17b65ba0618";  // The ID of the bucket

		$session = curl_init($api_url .  "/b2api/v2/b2_list_file_names");

		// Add post fields
		$data = array("bucketId" => $bucket_id);
		$post_fields = json_encode($data);
		curl_setopt($session, CURLOPT_POSTFIELDS, $post_fields); 

		// Add headers
		$headers = array();
		$headers[] = "Authorization: " . $auth_token;
		curl_setopt($session, CURLOPT_HTTPHEADER, $headers); 

		curl_setopt($session, CURLOPT_POST, true); // HTTP POST
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);  // Receive server response
		$server_output = curl_exec($session); // Let's do this!
		curl_close ($session); // Clean up
		echo ($server_output); // Tell me about the rabbits, George!
	}


	//Delete File using file_id
	public function delete_file(){
		$api_url 	= "https://api002.backblazeb2.com";
		$auth_token = "4_002147cd01b5a680000000000_018d4c36_d47af5_acct_8SQ4r2LRCypwp1wl0rPo1ySwDm4="; 
		$file_id 	= "4_zd184771c8d50b17b65ba0618_f10273ca4a9b98700_d20190704_m095545_c002_v0001126_t0048";  
		$file_name = "main.html"; 

		$session = curl_init($api_url .  "/b2api/v2/b2_delete_file_version");
	
		$data = array("fileId" => $file_id, "fileName" => $file_name);
		$post_fields = json_encode($data);
		curl_setopt($session, CURLOPT_POSTFIELDS, $post_fields); 

		$headers = array();
		$headers[] = "Authorization: " . $auth_token;
		curl_setopt($session, CURLOPT_HTTPHEADER, $headers); 

		curl_setopt($session, CURLOPT_POST, true); 
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);  
		$server_output = curl_exec($session); 
		curl_close ($session); 
		echo ($server_output); 
	}

	
	public function download_file(){
		$download_url = "https://api002.backblazeb2.com"; 
		$bucket_name = "anurags";  
		$file_name = "View.php"; 
		$uri = $download_url . "/file/" . $bucket_name . "/" . $file_name;

		$session = curl_init($uri);

		curl_setopt($session, CURLOPT_HTTPGET, true); 
		curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);  
		$server_output = curl_exec($session); 
		curl_close ($session); 
		echo ($server_output); 
	}


	
}
