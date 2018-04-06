<?php

class Auth
{
	 private $db_instance;
	 private $userdata;
	 private $login_flag;
     private $errors = array();

	 public function __construct()
	 {
	 	// database connection
	    $this->db_instance = DB::getInstance();
        // checking if user already logged in
	 	
	 	if(isset($_SESSION['user'])){
	 		$user_id = $_SESSION['user'];
	 		$check_if_user_exists = $this->db_instance->get('users',['id','=',$user_id]);	
	 		if($check_if_user_exists->count()){
		 	    // if ID stored in SESSION matches ID in database then user is logged in
		 		$this->login_flag = true;
		 		$this->userdata = $check_if_user_exists->first();
 	   	 	}	
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
		 	// checking provided password with hashed password in DB
			if(password_verify($password,$this->userdata->password)){
				Helper::Session_save('user',$this->userdata->id);
				return true;
			}
			else{
                $this->addError('Password is incorrect!');
            }
		 }
		 else{
		     $this->addError('User with provided username or email not found!');
             return false;
         }
	 }

    public function logout(){
    	if(Helper::Session_delete('user')){
    		return true;
    	}
    	return false;
	 	
    }

    // Adds an error to errors array
	private function addError($error){
	     $this->errors[] = $error;
    }

	// getter for login_flag
	public function isLogin(){
	 	return $this->login_flag;
	}

	// getter for userdata
	public function UserData(){
		return $this->userdata;
	}

	// getter for errors
    public function errors(){
	    return $this->errors;
    }


}
?>