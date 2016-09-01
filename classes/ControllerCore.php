<?php
Abstract Class ControllerCore {
	protected $registry;
	protected $result;


	function __construct($registry) {
		$this->registry = $registry;
		$this->result = New Result();
	}

	abstract function index();
}
?>