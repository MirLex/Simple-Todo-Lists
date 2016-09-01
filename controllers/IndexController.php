<?php
Class IndexController Extends ControllerCore {
	function index() {
			if (User::isAuthorized()) {
				$this->registry['template']->set('isAuthorized', true);
				$this->registry['template']->set('username', $_SESSION["username"]);
				$this->registry['template']->set('user_id', $_SESSION["user_id"]);
			} else {
				$this->registry['template']->set('isAuthorized', false);
			}
			$this->registry['template']->show('index');
	}
}
?>