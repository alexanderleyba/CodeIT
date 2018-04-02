<?php

class ModelLogin extends Model
{	
	public function login(){
		$user = new Auth;
		$login = $user->login(Helper::getInput('login'),Helper::getInput('password'));
		if(!$login){
			return $user->generateHTMLerror();
		}
		return true;
	}

} 
?>
