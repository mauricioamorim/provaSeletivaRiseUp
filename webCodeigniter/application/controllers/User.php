<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Controller {

	public $api_url = 'http://localhost.riseup.api/user';
     
	 /**
	  * List User Page for this controller.
	  *
	  */
	 public function index(){
		 /* Init cURL resource */
		 $ch = curl_init($this->api_url);
		 /* set return type json */
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 /* execute request */
		 $curl_result = json_decode(curl_exec($ch), true);
		 /* close cURL resource */
		 curl_close($ch);

		 $return_view 				= [];
		 $return_view["result"]		= $curl_result;
		 $return_view["content"] 	= $this->load->view("user/list", $return_view, true);
		 $this->load->view('index', $return_view);
	 }

	 /**
	  * Update User Page for this controller.
	  *
	  */
	  public function detail($id = 0){
		$result = array(	
			  	"status" 	=> false,
			  	"view"  	=> "user/message",
				"message" 	=> ""
		  );

		/* Init cURL resource */
		$ch = curl_init($this->api_url.'?id='.$id);
		/* set return type json */
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		/* execute request */
		$curl_result = json_decode(curl_exec($ch), true);
		/* close cURL resource */
		curl_close($ch);

		$UserVO = (is_array($curl_result) && count($curl_result)>0)? array_values($curl_result)[0] : 0;
		if(isset($UserVO["id"]) && $UserVO["id"] > 0){
			$_POST["active"]		= $UserVO["active"];
			$_POST["name"] 			= $UserVO["name"];
			$_POST["email"]			= $UserVO["email"];
			$_POST["created_at"]	= $UserVO["created_at"];
			$_POST["updated_at"]	= $UserVO["updated_at"];

			$result["status"] 	= true;
			$result["view"] 	= 'user/detail';
			$result["message"] 	= '';
		} else {
		  	$result["view"] 	= 'user/message';
		 	$result["message"] 	= '<h5 class="text-danger">Error</h5><p>User not found.</p>';
		}

		$return_view 						= [];
		$return_view["id"]					= $id;
		$return_view["result"]				= $result["message"];
		$return_view["form_title"]			= "Details";
		$return_view["form_description"]	= "User";
		$return_view["form_action"]			= base_url("user/update/".$id);
		$return_view["content"] 			= $this->load->view($result["view"], $return_view, true);
	   
		$this->load->view('index', $return_view);		  
	}

	  /**
	  * Create User Page for this controller.
	  *
	  */
	  public function create(){
		  $result = "";
		  $id	  = 0;
		  if(isset($_POST["name"])){
			$this->load->library('form_validation');

			//se o formulario foi postado entao pupula a validacao do condeigniter
			$this->form_validation->set_data($_POST);
			$this->form_validation->set_error_delimiters('', '</br>');
			$this->form_validation->set_rules('name', 'name', 'required|min_length[5]');
			$this->form_validation->set_rules('email', 'email', 'required|valid_email'); 

			if($this->form_validation->run() == TRUE){
				/* Init cURL resource */
				$ch = curl_init($this->api_url);
				/* set return type json */
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));

				/* execute request */
				$curl_result = json_decode(curl_exec($ch), true);
				/* close cURL resource */
				curl_close($ch);

				if(!isset($curl_result["id"])){
					$result = '<h5 class="text-danger">Error</h5><p>Please try again or contact us</p>';
				}else{
					$id 	= $curl_result["id"];
					$result = '<h5 class="text-success">Success</h5><p>New user id '.$curl_result["id"].' created.</p>';
				}
			}
		  }

		  $return_view 						= [];
		  $return_view["id"]				= $id;
		  $return_view["result"]			= $result;
		  $return_view["form_title"]		= "Create";
		  $return_view["form_description"]	= "User";
		  $return_view["form_action"]		= base_url("user/create");
		  
		  if($id > 0){
			$return_view["content"] = $this->load->view("user/message", $return_view, true);
		  }else{
		   	$return_view["content"] = $this->load->view("user/form", $return_view, true);
		  }
		 
		  $this->load->view('index', $return_view);
	  }

	 /**
	  * Update User Page for this controller.
	  *
	  */
	  public function update($id = 0){
		  $result = array(	
				"status" 	=> false,
				"view"  	=> "user/message",
			  	"message" 	=> ""
			);

		  /* Init cURL resource */
		  $ch = curl_init($this->api_url.'?id='.$id);
		  /* set return type json */
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  /* execute request */
		  $curl_result = json_decode(curl_exec($ch), true);
		  /* close cURL resource */
		  curl_close($ch);

		  $UserVO = (is_array($curl_result) && count($curl_result)>0)? array_values($curl_result)[0] : 0;
		  if(isset($UserVO["id"]) && $UserVO["id"] > 0){
			if(isset($_POST["name"])){
				$_POST["_METHOD"] = "PUT";
				$this->load->library('form_validation');
				//se o formulario foi postado entao pupula a validacao do condeigniter
				$this->form_validation->set_data($_POST);
				$this->form_validation->set_error_delimiters('', '</br>');
				$this->form_validation->set_rules('name', 'name', 'required|min_length[5]');
				$this->form_validation->set_rules('email', 'email', 'required|valid_email'); 
				if ($this->form_validation->run() == TRUE){
					/* Init cURL resource */
					$ch = curl_init($this->api_url.'/'.$id);
					/* set return type json */
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
					curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
	
					/* execute request */
					$curl_result = json_decode(curl_exec($ch), true);
					/* close cURL resource */
					curl_close($ch);


					$result["status"] 	= true;
					$result["view"] 	= 'user/message';
					$result["message"] 	= '<h5 class="text-success">Success</h5><p>User '.$_POST["name"].' id '.$id.' updated</p>';
				
					if(!isset($curl_result["status"])){
						$result["status"] 	= false;
						$result["view"] 	= 'user/form';
						$result["message"] 	= '<h5 class="text-danger">Error</h5><p>Please try again or contact us</p>';
					}
				
				}else{
					$result["status"] 	= false;
					$result["view"] 	= 'user/form';
					$result["message"] 	= '';	
				}
			} else {
				$_POST["active"]	= $UserVO["active"];
				$_POST["name"] 		= $UserVO["name"];
				$_POST["email"]		= $UserVO["email"];

				$result["status"] 	= true;
				$result["view"] 	= 'user/form';
				$result["message"] 	= '';
			}
		  }else{
			$result["view"] 	= 'user/message';
			$result["message"] 	= '<h5 class="text-danger">Error</h5><p>User not found.</p>';
		  }

		  $return_view 						= [];
		  $return_view["id"]				= $id;
		  $return_view["result"]			= $result["message"];
		  $return_view["form_title"]		= "Update";
		  $return_view["form_description"]	= "User";
		  $return_view["form_action"]		= base_url("user/update");
	      $return_view["content"] 			= $this->load->view($result["view"], $return_view, true);
		 
		  $this->load->view('index', $return_view);		  
	  }

	  /**
	  * Index Page for this controller.
	  *
	  */
	  public function delete($id = 0){
	  		$result = array(	
				"status" 	=> false,
				"view"  	=> "user/message",
				"message" 	=> ""
				);

			$ch = curl_init($this->api_url.'/'.$id);
			/* set return type json */
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("id"=>$id, "_METHOD"=>"DELETE")));

			/* execute request */
			$curl_result = json_decode(curl_exec($ch), true);

			/* close cURL resource */
			curl_close($ch);

			if(isset($curl_result["status"]) && $curl_result["status"] == true){
				$result["status"] 	= true;
				$result["view"] 	= 'user/message';
				$result["message"] 	= '<h5 class="text-success">Success</h5><p>User id '.$id.' deleted.</p>';
			} else {
				$result["view"] 	= 'user/message';
				$result["message"] 	= '<h5 class="text-danger">Error</h5><p>User id '.$id.' not found.</p>';
			}

			$return_view 						= [];
			$return_view["id"]					= $id;
			$return_view["result"]				= $result["message"];
			$return_view["form_title"]			= "Delete";
			$return_view["form_description"]	= "User";
			$return_view["form_action"]			= base_url("user/delete/".$id);
			$return_view["content"] 			= $this->load->view($result["view"], $return_view, true);
			
			$this->load->view('index', $return_view);	
	  }


 }
