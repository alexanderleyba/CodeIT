<?php

class Controller404 extends Controller
{
	
	function index()
	{
		$this->view->generate('404.php', 'layout.php');
	}

}
