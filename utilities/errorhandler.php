<?php

class ErrorHandler {

	public static function error($code, $message, $file, $line, $context) {
		throw new ErrorException($message, 0, $code, $file, $line);
	}

	public static function unhandledException(Exception $e) {
		$log = true;
		$http = new HTTPError(500);
		$display = $e;

		if ($e instanceof HTTPError) {
			$log = ($e->getCode() >= 500); // Don't log 4xx errors
			$http = $e;
			$display = '';
		}

		if ($log) {
			error_log($e->getMessage() . PHP_EOL . $e->getTraceAsString());
		}

		echo $http;
		if ($GLOBALS['display_errors']) {
			printf('cli' === PHP_SAPI ? '%s' : '<pre>%s</pre>', "\n$display");
		}
		exit(1);
	}

}