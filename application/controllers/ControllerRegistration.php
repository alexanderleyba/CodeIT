<?php

class ControllerRegistration extends Controller
{

	public $model;
	public $view;
	public $data = array();
	
	public function __construct()
	{
		$this->model = new ModelRegistration();
		$this->view = new View();
		// gettting countries list
		$this->data['countries'] = $this->model->getCountriesArray();
	}
	
	public function index(){
		// checking if user already logged in
		$Auth = new Auth;
		if($Auth->isLogin()){
			// if logged in redirect home
			Helper::redirect('home');
			// checking if input was provided
		}elseif(Helper::checkInput()){
			// trying to register
			$register = $this->model->process_registration();
			if($register === true){
				// if registration was successful loggin user in
				$Auth->login(Helper::getInput('email'),Helper::getInput('password'));
				// and redirecting home
				Helper::redirect('home');
			}
			else{
				// if registration fails, saving errors and render view
				$this->data['error'] = $register;
				$this->RegisterView();
			}
		}
		else{
			// just rendering view
			$this->RegisterView();
		}
	}

	public function RegisterView(){
		$this->view->generate('register.php', 'layout.php', $this->data);
	}
}