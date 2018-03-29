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
		
	/*	echo '<pre>';
		print_r($routes);
		echo '</pre>';*/

		if ( !empty($routes[2]) )
		{	
			$Controller = $routes[2];
		}	
		if ( !empty($routes[3]) )
		{
			$ControllerMethod = $routes[3];
		}

		// Model and Controller file
		$Model = 'Model'.$Controller;
		$Controller = 'Controller'.$Controller;
		
/*		echo $Model;
		echo '<br>';
		echo $Controller;
		echo '<br>';*/

		// Including Model 

		if(file_exists("application/models/".$Model.'.php'))
		{
/*		    echo 'Model exists';
			echo '<br>';*/
			include "application/models/".$Model.'.php';
		}

		// Including controller

		if(file_exists("application/controllers/".$Controller.'.php'))
		{
			include "application/controllers/".$Controller.'.php';
/*			echo 'Controller exists!';
			echo '<br>';*/
		}
		else
		{
			Route::ErrorPage404();
		}
		
		$Controller = new $Controller;

		if(method_exists($Controller, $ControllerMethod))
		{
/*			echo $controller.' Method exissts and it is '.$ControllerMethod;
			echo "<br>";*/
			$Controller->$ControllerMethod();
		}
		else
		{
			Route::ErrorPage404();
		}
	
	}

	public static function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
    
}
