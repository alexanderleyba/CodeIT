<?php 
class ModelRegistration extends Model
{
	public function process_registration(){
	$Auth = new Auth;	

		try {
				// try register a user
			 $Auth->register(array(
						    'username'=>Helper::getInput('username'),
						    'name'=>Helper::getInput('name'),
						    'email'=>Helper::getInput('email'),
						    'date_of_birth'=>Helper::getInput('DOB'),
						    'country'=>Helper::getInput('country'),
						    'password'=>password_hash(Helper::getInput('password'),PASSWORD_DEFAULT),
						    'registration_time' => strtotime(date('Y-m-d H:i:s'))
					    )
				    );
			 return true;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getCountriesArray(){
		// get country list for select. Simple.
		$countries = DB::getInstance()->QueryExecute('SELECT * FROM country');
		$countries = $countries->results();
		return $countries;
	}
}
?>