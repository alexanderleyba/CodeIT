<?php

class ControllerHome extends Controller
{

	function index()
	{	
		$this->view->generate('Home.php', 'layout.php');
	}
}