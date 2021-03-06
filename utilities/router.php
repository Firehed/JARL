<?php

class Router {

	// Information derived from the request
	private static $name;
	private static $action;
	private static $parts = array();

	// Routed locations
	private static $controller;
	private static $method;

	public static function parseRequest() {
		if ('cli' === PHP_SAPI) {
			$uri = $_SERVER['argc'] > 1 ? $_SERVER['argv'][1] : '';
			$_SERVER['REQUEST_METHOD'] = 'GET';
		}
		else {
			$uri = $_SERVER['REQUEST_URI'];
		}
		// Remove duplicate slashes from weird URIs
		$uri = preg_replace('#/{2,}#', '/', $uri); // using # as delimeter instead of typical / for readability (avoid excessive escaping)
		// Trim the leading slash, then split by subsequent slashes
		$parts = explode('/', ltrim($uri, '/'));
		self::$name   = array_shift($parts) ? : $GLOBALS['defaultController'];
		self::$action = array_shift($parts) ? : 'index';
		self::$parts  = $parts;
	}

	public static function preController() {
		$controllerClass = 'controllers\\' . self::$name;
		self::$controller = new $controllerClass;
		if (!self::$controller instanceof Controller) {
			throw new Exception('Class ' . self::$name .  ' is not a Controller');
		}

		// Create a stack of method names to try
		$actions[] = self::$action . '_get';
		if ('POST' === $_SERVER['REQUEST_METHOD']) {
			$actions[] = self::$action . '_post_no_csrf';
			if (1) {
				$actions[] = self::$action . '_post';
			}
		}

		// Pop items off the stack, stop if we find one that works
		while ($action = array_pop($actions)) {
			if (is_callable(array(self::$controller, $action))) {
				break;
			}
		}

		// Nothing found? 404
		if (!$action) {
			throw new HTTPError(404);
		}
		self::$method = $action;
		self::$controller->setUp();
	}

	public static function executeController() {
		call_user_func(array(self::$controller, self::$method));
	}

	public static function postController() {
		self::$controller->tearDown();
	}

	/**
	 * Get page "arguments", padded with NULLs as-needed for safe use with list()
	 * ex: list($subpage, $userId) = Router::getArguments(2)
	 */
	public static function getArguments($min = 0) {
		return array_pad(self::$parts, $min, null);
	}

}