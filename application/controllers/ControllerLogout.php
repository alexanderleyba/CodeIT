<?php
class ControllerLogout extends Controller
{
	function index()
	{	
		$Auth = new Auth();
		if($Auth->logout()){
			Helper::redirect('Home');
		}
	}
}