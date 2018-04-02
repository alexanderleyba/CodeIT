<?php

// Router engine

class Route
{

	public static function init()
	{
		// default controller 
		$Controller = 'Home';
		$ControllerMethod = 'index';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		// getting Controller 
		if(!empty($routes[2])){
			$Controller = $routes[2];
		}
		// getting Controller Method
		if( !empty($routes[3])){
			$ControllerMethod = $routes[3];
		}

		// Model and Controller file
		$Model = 'Model'.$Controller;
		$Controller = 'Controller'.$Controller;
		
		// Including Model file
		if(file_exists("application/models/".$Model.'.php')){
			include "application/models/".$Model.'.php';
		}

		// Including controller file
		if(file_exists("application/controllers/".$Controller.'.php')){
			include "application/controllers/".$Controller.'.php';
		}
		else{
			// redirect 404;
			Helper::redirect('404');
		}
		// creating new Controller instance
		$Controller = new $Controller;

		if(method_exists($Controller, $ControllerMethod)){
			$Controller->$ControllerMethod();
		}else{
			Helper::redirect('404');
		}
	} 
}
