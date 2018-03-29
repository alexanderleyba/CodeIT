<?php 
class ModelRegistration extends Model
{
	public function process_registration(){
	$Auth = new Auth;	
	// validation rules 
	$validate = new Validator();
	// define validation rules
	$rules = [
		    'username'=> [
			    'name'=>'Username',
			    'required'=> true,
			    'min' => 5,
			    'max' => 20,
			    'unique'=> 'users',
			    'bad_symbols'=>true
		    ],

		    'name'=> [
			    'name' => 'Real name',
			    'required'=> true,
			    'min' => 5,
			    'max' => 50
		    ],

		    'DOB' => [
			    'name' => 'Date of Birth',
			    'required'=> true
		    ],

		    'country' => [
			    'name'=> 'Country',
			    'required'=> true
		    ],

		    'email'=>[
			    'name'=>'Email',
			    'required'=> true,
			    'type'=>'email',
			    'unique'=>'users'
		    ],

		    'password' => [
			    'name'=>'Password',
			    'required'=> true,
			    'min' => 6,
			    'max' => 25
		    ],

		    'password_second' => [
			    'name'=>'Password again',
			    'required'=> true,
			    'matches' => 'password'
		    ],

		    'terms' => [
			    'name'=>'Terms',
			    'required' => true
		    ]
	    ];

	    $validation = $validate->validate($_POST,$rules);


	    if($validation->status()){
	    	// validation passed try register
		    try {
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
		    } catch(Exception $e) {
			    die($e->getMessage());
		    }
	    }
	    else{
	    	// validation errors
            return $validation->generateHTMLerror();
        }
	}

	public function getCountriesArray(){
		// get country list for select. Simple.
		$countries = DB::getInstance()->QueryExecute('SELECT * FROM Country');
		$countries = $countries->results();
		return $countries;
	}
}
?>