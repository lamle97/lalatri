<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function list_controller()
{
	$result = array();

	$controllers = glob(APPPATH . 'controllers/admin/*/*.php');

	foreach ($controllers as $value) {
		preg_match("/controllers\/.*\/(.*).php/", $value, $matches);

		$controller = strtolower($matches[1]);

		$avoid = array("home", "login", "logout");

		if(in_array($controller, $avoid)) {
			continue;
		}

		$result[] = strtolower($controller);
	}

	return $result;
}