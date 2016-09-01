<?php

Class Router {
		private $registry;
		private $path;
		private $args = array();

		function __construct($registry) {
				$this->registry = $registry;
		}

		function setPath($path) {

			// for web host 
			// $path = trim($path, '/\\');
			$path .= DIRSEP;

			if (is_dir($path) == false) {
				throw new Exception ('Invalid controller path: `' . $path . '`');
			}
			$this->path = $path;
		}

		function delegate() {
			$this->getController($file, $controller, $action, $args);

			if (is_readable($file) == false) {
					die ('404 Not Found');
			}

			include ($file);

			$class = $controller.'Controller';
		
			$controller = new $class($this->registry);

			if (is_callable(array($controller, $action)) == false) {
					die ('404 Not Found');
			}
			$controller->$action($args);
		}

		private function getController(&$file, &$controller, &$action, &$args) {
			$route = (empty($_GET['route'])) ? '' : $_GET['route'];

			if (isset($_POST['ajax']) && ($_POST['ajax'] == 'true' )) {
				unset($_POST['ajax']);

				$cmd_path = $this->path;

				if (isset($_POST['controller'])) {
					if (is_file($cmd_path . $_POST['controller'] . 'Controller.php')) {
						$controller = $_POST['controller'];
						$file = $cmd_path . $controller . 'Controller.php';

						unset($_POST['controller']);
					} 
				}

				if (isset($_POST['action'])) {
					$action = $_POST['action'];
					unset($_POST['action']);

				 }

				 $args = $_POST;
				return;
			}

			if (empty($route)) {
				$route = 'index'; 
			}

			$route = trim($route, '/\\');
			$parts = explode('/', $route);
			$cmd_path = $this->path;

			foreach ($parts as $part) {
					$fullpath = $cmd_path . $part;
					if (is_dir($fullpath)) {
							$cmd_path .= $part . DIRSEP;
							array_shift($parts);
							continue;
					}

					if (is_file($fullpath . 'Controller.php')) {
							$controller = $part;
							array_shift($parts);
							break;
					}
			}

			if (empty($controller)) { 
				$controller = 'index'; 
			};
			$action = array_shift($parts);

			if (empty($action)) {
				$action = 'index'; 
			}

			$file = $cmd_path . $controller . 'Controller.php';
			$args = $parts;
		}
}
?>