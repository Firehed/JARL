<?php

abstract class Controller {

	// This is the default method if one is not specified by the request
	abstract public function index_get();

	// This will be called before the method. Use this in favor of __construct
	public function setUp() {
		// Override me
	}

	// This will be called after the method. Use this in favor of __destruct (more predictable due to PHP's GC)
	public function tearDown() {
		// Override me
	}

	// Force use of setUp and tearDown
	final public function __construct() {}
	final public function __destruct() {}

}
