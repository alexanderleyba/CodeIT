<?php
class ControllerLogout extends Controller
{
	function index()
	{	
		$Auth = new Auth();
		$Auth->logout();
		Helper::redirect('home');
	}
}