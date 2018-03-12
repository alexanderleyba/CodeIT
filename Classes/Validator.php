<?php

/**
  Validation class
 */
class Validator
{
	// property indicates passed validation or failed
	private $status = false;
	// here stored array of errors..
	private $errors = array();
	// and DB instance
	private $db_instance = null;

	public function __construct()
	{
		$this->db_instance = DB::getInstance();
	}
	// main validation method. 
	public function validate($check,$rule_set){
		foreach ($rule_set as $rule_item => $rules ){
			foreach ($rules as $rule => $setting){
				$value = $check[$rule_item];
				$name = $rules['name'];
				if($rule === 'required' && empty($value)){
					$this->processError("{$name} is required!");
				}else{
					switch ($rule){
						case 'min':
							if(strlen($value) < $setting){
								$this->processError("{$name} must be a min of {$setting} letters!");
							}
						break;

						case 'max':
							if(strlen($value) > $setting){
								$this->processError("{$name} must be a max of {$setting} letters!");
							}
						break;

						case 'matches':
							if($value != $check[$setting]){
								$this->processError("passwords are not equal!");
							}
						break;

					}
				}
			}
		}

		if(empty($this->errors)){
			$this->status = true;
		}

		return $this;
	}
	// Adds an error to the errors property.
	private function processError($error){
		$this->errors[] = $error;
	}
	// generates HTML for Erros
	public function generateErrorHTML(){
		if(!$this->status()){
			echo "<div class='alert alert-danger class=' role='alert'>";
			foreach ($this->errors as $error){
				echo $error;
				echo "<br>";
			}
			echo "</div>";
		}
		return false;
	}

	// getter for Errors
	public function errors(){
		return $this->errors;
	}
	// getter for status
	public function status(){
		return $this->status;
	}
}