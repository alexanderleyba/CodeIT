<?php
class ControllerRegistration extends Controller
{
	
	public $model;
	public $view;
	public $data = array();
	public $rules;
	
	public function __construct()
	{
		parent::__construct();
		$this->model = new ModelRegistration();
		// gettting countries list
		$this->data['countries'] = $this->model->getCountriesArray();
		// validation rules
		$this->rules = [
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
	}
	

	public function index(){
		$Auth = new Auth;
		// checking if user alredy logged in
		if($Auth->isLogin()){
			// if loggen in redirect home
			Helper::redirect('home');
		}elseif(Helper::checkInput()){
			// if input was provided 
			// validating form data 
			$validate = new Validator();
			$validation = $validate->validate($_POST,$this->rules);	
			if($validation->status()){
				// validation passed -> registring a user;	
				$register = $this->model->process_registration();
				// if registration successful -> loggin user in
				$Auth->login(Helper::getInput('email'),Helper::getInput('password'));
				// and redirecting home
				Helper::redirect('Home');
			}
			else{
				// validation failed 
				$this->data['error'] = $validation->errors();
				$this->RegisterView();
			}
		}
		else{
			// just rendering a view
			$this->RegisterView();
		}
	}	

	public function RegisterView(){
		$this->view->generate('register.php', 'layout.php', $this->data);
	}
}