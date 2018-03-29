<?php

class ModelLogin extends Model
{	
	Public function login(){
		$user = new Auth();
		// checking if user alredy logged in
		if($user->isLogin()){
			return true;
		} elseif (Helper::checkInput()){
			// if input exists. validate input.
			$validate = new Validator();
		    $rules = [
			    'login' => ['name'=>'Login','required'=>true],
			    'password'=>['name'=>'Password','required'=>true]
		    ];
		    $validation = $validate->validate($_POST,$rules);
		    if($validation->status()){
		    	// validation passed loggin user in.
		    	$login = $user->login(Helper::getInput('login'),Helper::getInput('password'));
		    	if($login){
		    		return true;
		    	}
		    	else{
		    		// loggin in failed.
		    		return $user->generateHTMLerror();
		    	}
		    }
		    else{
		    	// validation errorrs
		    	return $validation->generateHTMLerror();
		    }
		}
	}
} 
?>
