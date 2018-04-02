<?php

class ControllerLogin extends Controller
{

	public $model;
	public $view;
	public $data = array();
	public $rules;

	public function __construct()
	{
		parent::__construct();
		$this->model = new ModelLogin();
		$this->rules = [
			    'login' => ['name'=>'Login','required'=>true],
			    'password'=>['name'=>'Password','required'=>true]
		    ];
	}

/*	public function index(){
		// checking if user already logged in
		$Auth = new Auth;
		if($Auth->isLogin()){
			// if logged in -> redirect home
			Helper::redirect('home');
		}
		// checking if input was provided
		elseif(Helper::checkInput()){
			// trying to log user in
			$tryLogin = $this->model->login();
			if($tryLogin === true){
				// if loggin in successful -> redirect home
				Helper::redirect('home');
			}
			else{
				// if loggin in failed save errors and render view
				$this->data['error'] = $tryLogin;
				$this->loginView();
			}
		}
		else{
			// if no input just render view
			$this->loginView();
		}
	}*/

	public function index(){
		// checking if user already logged in
		$Auth = new Auth;
		if($Auth->isLogin()){
			// if logged in -> redirect home
			Helper::redirect('home');
		}elseif(Helper::checkInput()){
			// if input was provided -> validating form data
			$validate = new Validator();
			$validation = $validate->validate($_POST,$this->rules);
			if($validation->status()){
				// validation passed -> try log user in
				$tryLogin = $this->model->login();
				if($tryLogin){
					Helper::redirect('home');
				}else{
					$this->data['error'] = $tryLogin;
					$this->loginView();	
				}
			}else{
				// validation failed -> generating errors;
				$this->data['error'] = $validation->generateHTMLerror();
				$this->loginView();	
			}	
		}else{
			// just rendering view
			$this->loginView();	
		}

	}


	public function loginView(){
		$this->view->generate('Login.php', 'layout.php',$this->data);
	}

}