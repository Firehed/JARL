<?php

class Autoloader {

	public static function load($class) {
		$class = strtolower($class);
		if (false === strpos($class, '\\')) {
			$path = APPROOT . "utilities/$class.php";
		}
		else {
			$path = APPROOT . str_replace('\\', '/', $class) . '.php';
		}
		if (file_exists($path)) {
			include $path;
		}
		else {
			throw new Exception("File for class '$class' not found at $path");
		}
	}

}
