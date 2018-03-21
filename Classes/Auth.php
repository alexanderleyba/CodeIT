<?php

class Auth
{
	 private $db_instance;
	 private $userdata;
	 private $login_flag;

	 public function __construct()
	 {
	 	$this->db_instance = DB::getInstance();

	 	$user_id = $_SESSION['user'];

	 	$check_if_user_exists = $this->db_instance->get('users',['id','=',$user_id]);

	 	if($check_if_user_exists->count()){
	 		$this->login_flag = true;
	 		$this->userdata = $check_if_user_exists->first();
 	    }
 	    else{
	 		// logout
        }

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

	 public function logout(){
	 	Helper::Session_delete('user');
	 }

	 // getter for login_flag
	public function isLogin(){
	 	return $this->login_flag;
	}

	// getter for userdata
	public function UserData(){
		return $this->userdata;
	}
}