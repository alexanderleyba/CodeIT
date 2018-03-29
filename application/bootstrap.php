<?php

session_start();
// defining Config Array
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => '',
		'db' => 'test'
	)
);
// setting up an autoloader for classes
spl_autoload_register(function($class) {
	require_once 'Classes/'.$class.'.php';
});



// load Core classes
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';

// Route initializaztion
Route::init(); 
