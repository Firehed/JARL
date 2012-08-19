<?php
/**
 * Steps:
 *  Pre-execution setup
 *   Prepare error handling
 *   Register autoloader
 *
 *  Parse request
 *  Prepare Controller
 *  Execute Controller
 *  Post Controller
 */

// Define applocation root
define('APPROOT', dirname(__FILE__) . '/');

// Pull core config, import into $GLOBALS
$GLOBALS = require 'config.php';

// Prepare error handling
require 'utilities/errorhandler.php';
ini_set('error_reporting', $GLOBALS['error_reporting']);
ini_set('display_errors', $GLOBALS['display_errors']);
set_error_handler(array('ErrorHandler', 'error'), $GLOBALS['errorExceptionLevel']);
set_exception_handler(array('ErrorHandler', 'unhandledException'));

// Register autoloader
require 'utilities/autoloader.php';
spl_autoload_register(array('Autoloader', 'load'));

// Go!
require 'utilities/router.php';
Router::parseRequest();
Router::preController();
Router::executeController();
Router::postController();
