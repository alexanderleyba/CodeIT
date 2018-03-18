<?php

class Auth
{
	 private $db_instance;
	 private $userdata;


	 public function __construct()
	 {
	 	$this->db_instance = DB::getInstance();
	 }

	 public function register($registration_data){
	 	if(!$this->db_instance->insert('users',$registration_data)){
	 		throw new Exception("Error registering a user");
	    }
	 }

	 public function login($login = null,$password = null){
		// checking if user exists in DB by username or email
		 $query = "SELECT * FROM users WHERE username = ? OR email = ?";
		 $user = $this->db_instance->QueryExecute($query,array($login,$login));
		 if($user->count()){
		 	$this->userdata = $user->first();
			if(password_verify($password,$this->userdata->password)){
				Helper::Session_save('user',$this->userdata->id);
				return true;
			}
		 }
		 return false;

	 }
}