<?php
/**
 * Steps:
 *  Pre-execution setup
 *   Prepare error handling
 *   Establish autoloader
 *
 *  Parse request
 *  Prepare Controller
 *  Execute Controller
 */

// Pull core config, import into $GLOBALS
$GLOBALS = require 'config.php';

// Prepare error handling
require 'utilities/errorhandler.php';
ini_set('error_reporting', $GLOBALS['error_reporting']);
ini_set('display_errors', $GLOBALS['display_errors']);
set_error_handler(array('ErrorHandler', 'error'), $GLOBALS['errorExceptionLevel']);
set_exception_handler(array('ErrorHandler', 'unhandledException'));
