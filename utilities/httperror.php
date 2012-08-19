<?php

class HTTPError extends Exception {

	public function __construct($code) {
		switch ($code) {
			case 401:
				$msg = 'Unauthorized';
			break;

			case 402:
				$msg = 'Payment Required';
			break;

			case 403:
				$msg = 'Forbidden';
			break;

			case 404:
				$msg = 'Not Found';
			break;

			case 410:
				$msg = 'Gone';
			break;

			case $code < 500:
				$code = 400;
				$msg = 'Bad Request';
			break;

			default:
				$code = 500;
				$msg = 'Internal Server Error';
			break;
		}
		parent::__construct($msg, $code);
	}

	public function __toString() {
		$this->sendHeader();
		return "{$this->getCode()} {$this->getMessage()}";
	}

	private function sendHeader() {
		header("HTTP/1.1 {$this->getCode()} {$this->getMessage()}");
	}

}