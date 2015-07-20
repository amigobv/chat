<?php

error_reporting(E_ALL); ini_set('display_errors', 'On');

spl_autoload_register(function($class) {
	require_one('lib/' . $class . '.php');
});



