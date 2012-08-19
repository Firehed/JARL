<?php

class ErrorHandler {

	public static function error($code, $message, $file, $line, $context) {
		throw new ErrorException($message, 0, $code, $file, $line);
	}

	public static function unhandledException(Exception $e) {
		echo "<pre>Uncaught $e</pre>";
	}
}