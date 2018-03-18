<?php

class Auth
{
	 private $db_instance;

	 public function __construct()
	 {
	 	$this->db_instance = DB::getInstance();
	 }

	 public function register($registration_data){
	 	if(!$this->db_instance->insert('users',$registration_data)){
	 		throw new Exception("Error registering a user");
	    }

	 }

}