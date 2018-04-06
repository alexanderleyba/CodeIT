<?php

/**
 Here written some helper functions
 *  like dealing with inputs
 *  henerating hashes for passwords
 *  redirects etc..
 */
class Helper
{
	// static functions for dealing with inputs can be used like Helper::getInput('username');
	public static function getInput($item){
		if(isset($_POST[$item])){
			return $_POST[$item];
		} else if(isset($_GET[$item])){
			return $_GET[$item];
		}
		return '';
	}

	// checks if input exists true/false
	public static function checkInput($type='post'){
		switch ($type) {
			case 'post':
				if(!empty($_POST)){
					return true;
				}
				else{
					return false;
				}
				break;
			case 'get':
				if(!empty($_GET)){
					return true;
				}
				else{
					return false;
				}
				break;
			default:
				return false;
				break;
		}
	}

	// redirect function
	public static function redirect($redirectTo = null){
		if($redirectTo){
			header('Location:'.$redirectTo);
			exit();
		}
	}

    // simple helpers for SESSION superglobal

    // saves to SESSION
	public static function Session_save($name,$value){
		return $_SESSION[$name] = $value;
	}
    // delete from SESSION
	public static function  Session_delete($name){
		if(isset($_SESSION[$name])){
			unset($_SESSION[$name]);
			return true;
		}
		return false;
	}

}