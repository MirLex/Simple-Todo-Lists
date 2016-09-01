<?php
class Result {
	var $errors = array();
	var $data = null;

	function __construct() {
	}

	public function registerError($errorMessage) {
		array_push($this->errors, $errorMessage);
	}

	public function getErrors() {
		return $this->errors;
	}

	public function hasErrors() {
		if (!empty($this->errors)) {
			return true; 
		}
		return false;
	}

	public function setData($data) {
		$this->data = $data;
	}

	public function getResult($mode = 'array') {
		$result = array();
		$result['errors'] = $this->getErrors();
		$result['data'] = $this->data;

		if ($mode == 'json') {
			$result = json_encode($result);
		}
		return $result;
	}

	public function echoJsonResult() {
		$result = $this->getResult('json');

		header('Content-type: application/json');
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
		exit();
	} 
}

?>
