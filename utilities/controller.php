<?php

interface Controller {

	// This is the default method if one is not specified by the request
	function index_get();

	// This will be called before the method. Use this in favor of __construct
	function setUp();

	// This will be called after the method. Use this in favor of __destruct (more predictable due to PHP's GC)
	function tearDown();

}

