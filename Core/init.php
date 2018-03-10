<?php
/**
 Should be included on every page.
 **/
// just starting php session
session_start();

// storing in super global variable our config array

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


