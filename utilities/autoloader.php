<?php

class Autoloader {

	public static function load($class) {
		$class = strtolower($class);
		if (false === strpos($class, '\\')) {
			require APPROOT . "utilities/$class.php";
		}
		else {
			require APPROOT . str_replace('\\', '/', $class) . '.php';
		}
	}

}
