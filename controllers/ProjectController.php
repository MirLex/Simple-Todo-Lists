<?php

Class ProjectController Extends ControllerCore {
	protected $request;

	function __construct($registry) {
			parent::__construct($registry);
	}

	function index() {
			echo 'Default index of the ProjectController';
	}

	function deleteTask($args = null) {
		$this->request = $args;

		$task_id = $this->getRequestParam("task_id");

		if (!$task_id){
			$this->result->registerError('Incorect data: task_id: NULL');
		} 

		if ($this->result->hasErrors()) {
				$this->result->echoJsonResult();
		}

		$project = new Project($this->registry);

		$result = $project->deleteTask($task_id);

		if (!$result) {
			$this->result->registerError('Error:');
		} else {
			$this->result->setData(array(
				'status' => 'Task is deleted', 
			));
		}

		$this->result->echoJsonResult();
	}

	function delete($args=null) {
		$this->request = $args;
		$project_id = $this->getRequestParam("id_project");
		
		if (!$project_id){
			$this->result->registerError('Incorect data: id_project: NULL');
		} 

		if ($this->result->hasErrors()) {
				$this->result->echoJsonResult();
		}

		$project = new Project($this->registry);

		$result = $project->deleteProject($this->registry['user_id'],$project_id);

		if (!$result) {
			$this->result->registerError('Error:');
		} else {
			$project->deleteTasks($project_id);
			
			$this->result->setData(array(
				'status' => 'Project is deleted', 
			));
		}

		$this->result->echoJsonResult();
	}

	function createTask($args =null) {
		$this->request = $args;
		$project_id = $this->getRequestParam("id_project");
		$task_name = $this->getRequestParam("task_name");

	   if (!$project_id){
			$this->result->registerError('Incorect data: id_project: NULL');
		}

		if (!$task_name || !preg_match('/^[\s-a-zA-Z0-9]+$/',$task_name)) {
			$this->result->registerError('Incorect data: name');

		}

		if ($this->result->hasErrors()) {
			$this->result->echoJsonResult();
		}

		$project = new Project($this->registry);

		$task = $project->createTask($project_id,$task_name);

		if (!$task) {
			$this->result->registerError('Error:');
		} else {
			$this->result->setData(array(
				'status' => 'Task is added', 
				'task_id' => $task, 
			));

			$this->result->echoJsonResult();
		}
	}

	function updateTaskName($args=null) {
		$this->request = $args;

		$task_id = $this->getRequestParam("task_id");
		$name = $this->getRequestParam("name");

		if (!$task_id){
			$this->result->registerError('Incorect data: task_id: NULL');
		}

		if (!$name || !preg_match('/^[\s-a-zA-Z0-9]+$/',$name)) {
			$this->result->registerError('Incorect data: name');

		}

		if ($this->result->hasErrors()) {
				$this->result->echoJsonResult();
		}

		$project = new Project($this->registry);

		$task = $project->updateTaskName($task_id,$name);

		if (!$task) {
			$this->result->registerError('Error:');
		} else {
			$this->result->setData(array(
				'status' => 'Task is updated', 
			));

			$this->result->echoJsonResult();
		}
	}

	function updateName($args = null){
		$this->request = $args;

		$project_id = $this->getRequestParam("id_project");
		$name = $this->getRequestParam("name");
		$mode = $this->getRequestParam("mode");

		if (!$project_id){
			$this->result->registerError('Incorect data: id_project: NULL');
		}

		if (!$mode) {
			$this->result->registerError('Incorect data: mode: NULL');
		}

		if (!$name || !preg_match('/^[\s-a-zA-Z0-9]+$/',$name)) {
			$this->result->registerError('Incorect data: name');

		}

		if ($this->result->hasErrors()) {
				$this->result->echoJsonResult();
		}
		
		$project = new Project($this->registry);

		if ($mode == 'create') {
			$project = $project->createProject($this->registry['user_id'],$name);

			$this->result->setData(array(
				'status' => 'Project is created', 
				'tmp_id' => $project_id,
				'project_id' => $project
			));

			$this->result->echoJsonResult();
		}

		if ($mode == 'update') {
			$project = $project->updateProject($this->registry['user_id'],$project_id,$name);

			$this->result->setData(array(
				'status' => 'Project name updated', 
			));

			$this->result->echoJsonResult();
		}
	}

	public function getRequestParam($name) {
		if (array_key_exists($name, $this->request)) {
			return trim($this->request[$name]);
		}
			return null;
	}
}
?>