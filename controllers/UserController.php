<?php

Class UserController Extends ControllerCore {

	protected $user;
	protected $request;

	function __construct($registry) {
			parent::__construct($registry);

			if (!empty($_COOKIE['sid'])) {
				session_id($_COOKIE['sid']);
			}
	}

	function index() {
			echo 'Default index of the `users` controllers';
	}

	public function getRequestParam($name) {
		if (array_key_exists($name, $this->request)) {
			return trim($this->request[$name]);
		}
			return null;
	}

	function create($args = null) {
		$this->request = $args;

		if ($_SERVER["REQUEST_METHOD"] !== "POST") {
			// Method Not Allowed
			http_response_code(405);
			header("Allow: POST");
			$this->result->registerError("Method Not Allowed");
			return;
		}

		setcookie("sid", "");

		$username = $this->getRequestParam("username");
		$password1 = $this->getRequestParam("password1");
		$password2 = $this->getRequestParam("password2");

		if (strlen($username)< 6 || !preg_match('/^[\s-a-zA-Z0-9]+$/',$username)) {
			$this->result->registerError('Incorect data: username');
		}

		if (strlen($password1)< 6) {
			$this->result->registerError('Password to short');
		}

		if (empty($username)) {
			$this->result->registerError('Enter the username');
		}

		if (empty($password1)) {
			$this->result->registerError("Enter the password");
		}

		if (empty($password2)) {
			$this->result->registerError("Confirm the password");
		}

		if ($password1 !== $password2) {
			$this->result->registerError("Confirm password is not match");
		}

		if ($this->result->hasErrors()) {
			$this->result->echoJsonResult();
		}

		$user = new user($this->registry);

		try {
			$new_user_id = $user->create($username, $password1);
		} catch (\Exception $e) {
			$this->result->registerError($e->getMessage());
			$this->result->echoJsonResult();
		}

		$user->authorize($username, $password1);

		$this->result->setData(array('status' => 'Hello, '.$username.' Thank you for registration.' ));
		$this->result->echoJsonResult();
	}

	public function login($args = null){
		$this->request = $args;

		if ($_SERVER["REQUEST_METHOD"] !== "POST") {
			// Method Not Allowed
			http_response_code(405);
			header("Allow: POST");
			$this->result->registerError("Method Not Allowed");
			return;
		}
		setcookie("sid", "");

		$username = $this->getRequestParam("username");
		$password = $this->getRequestParam("password");

		if (empty($username)) {
			$this->result->registerError("Enter the username");
		}

		if (empty($password)) {
			$this->result->registerError("Enter the password");
		}

		if ($this->result->hasErrors()) {
			$this->result->echoJsonResult();
		}


		$user = new User($this->registry);
		$auth_result = $user->authorize($username, $password);

		if (!$auth_result['result']) {
			$this->result->registerError("Invalid username or password");
			$this->result->echoJsonResult();
		}

		$project = new Project($this->registry);

		$projects = $project->getProjects($auth_result['user_id']);

		if ($projects) {
			$user_projects = array();

			foreach ($projects as $user_project) {

				$project_id = $user_project['id'];
				$project_name = $user_project['name'];

				$user_projects[$project_id]['name'] = $project_name;
				$user_projects[$project_id]['id'] = $project_id;


				$tasks = $project->getTasks($project_id);
				if ($tasks) {
					foreach ($tasks as $user_task) {
						$task_id = $user_task['id'];
						$task_name = $user_task['name'];
						$task_status = $user_task['status'];
						$task_deadline = $user_task['deadline'];
						
						$user_projects[$project_id]['tasks'][$task_id]['id'] = $task_id;
						$user_projects[$project_id]['tasks'][$task_id]['name'] = $task_name;
						$user_projects[$project_id]['tasks'][$task_id]['status'] = $task_status;
						$user_projects[$project_id]['tasks'][$task_id]['deadline'] = $task_deadline;
					}

				}
			}
		}

		if (isset($user_projects)) {
			$this->result->setData(array(
				'projects' => $user_projects, 
			));
			$this->result->echoJsonResult();

		}
	}

	public function logout() {
		User::logout();
	}
}
?>