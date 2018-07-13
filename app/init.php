<?php
	session_start();
	spl_autoload_register(function($class)
	{
	require_once 'core/'.$class.'.php';
	});
	require_once __DIR__ . '/../vendor/autoload.php';
	$GLOBALS['path'] = "/kasir-klontong/";
	// $route = new Route();