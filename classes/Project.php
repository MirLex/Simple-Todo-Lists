<?php

class Project {
	private $registry;

	private $id;
	private $name;
	private $user_id;

	private $projects;
	private $tasks;

	function __construct($registry) {
			$this->registry = $registry;
			$this->db = $registry['db'];
	}

	public function getProjects($user_id) {
		$query = "SELECT id, user_id, name FROM projects WHERE user_id = :user_id";

		$sth = $this->db->prepare($query);

		$sth->execute(
			array(
				":user_id" => $user_id,
			)
		);
		$this->projects = $sth->fetchAll();

		if (!$this->projects) {
			return false;
		} else {
			return $this->projects;
		}
	}

	public function getTasks($project_id) {
		$query = "SELECT id, name, status, deadline FROM tasks WHERE project_id = :project_id";

		$sth = $this->db->prepare($query);

		$sth->execute(
			array(
				":project_id" => $project_id,
			)
		);
		$this->tasks = $sth->fetchAll();

		if (!$this->tasks) {
			return false;
		} else {
			return $this->tasks;
		}
	}

	public function deleteTasks($project_id) {
		$query = "DELETE FROM tasks WHERE project_id = :project_id";
		$sth = $this->db->prepare($query);

		try {
			$this->db->beginTransaction();
			$result = $sth->execute(
				array(
					':project_id' => $project_id,
				)
			);
			$this->db->commit();
		} catch (\PDOException $e) {
			$this->db->rollback();
			echo "Database error: " . $e->getMessage();
			die();
		}

		if (!$result) {
			$info = $sth->errorInfo();
			printf("Database error %d %s", $info[1], $info[2]);
			die();
		} 
		return $result;
	}

	public function deleteTask($task_id) {
		$query = "DELETE FROM tasks WHERE id = :task_id";
		$sth = $this->db->prepare($query);

		try {
			$this->db->beginTransaction();
			$result = $sth->execute(
				array(
					':task_id' => $task_id,
				)
			);
			$this->db->commit();
		} catch (\PDOException $e) {
			$this->db->rollback();
			echo "Database error: " . $e->getMessage();
			die();
		}

		if (!$result) {
			$info = $sth->errorInfo();
			printf("Database error %d %s", $info[1], $info[2]);
			die();
		} 
		return $result;
	}

	public function deleteProject($user_id,$project_id) {
		$query = "DELETE FROM projects WHERE id = :id_project AND user_id = :user_id";
		$sth = $this->db->prepare($query);

		try {
			$this->db->beginTransaction();
			$result = $sth->execute(
				array(
					':id_project' => $project_id,
					':user_id' => $user_id,
				)
			);
			$this->db->commit();
		} catch (\PDOException $e) {
			$this->db->rollback();
			echo "Database error: " . $e->getMessage();
			die();
		}

		if (!$result) {
			$info = $sth->errorInfo();
			printf("Database error %d %s", $info[1], $info[2]);
			die();
		} 
		return $result;
	}

	public function createTask($project_id,$name) {
		$query = "INSERT INTO tasks (name, status, project_id) VALUES (:name, :status, :project_id)";
		$sth = $this->db->prepare($query);

		try {
			$this->db->beginTransaction();
			$result = $sth->execute(
				array(
					':name' => $name,
					':status' => 'new',
					':project_id' => $project_id,
				)
			);
			$result = $this->db->lastInsertId();

			$this->db->commit();
		} catch (\PDOException $e) {
			$this->db->rollback();
			echo "Database error: " . $e->getMessage();
			die();
		}

		if (!$result) {
			$info = $sth->errorInfo();
			printf("Database error %d %s", $info[1], $info[2]);
			die();
		} 
		return $result;
	}

	public function createProject($user_id,$name) {
		$query = "INSERT INTO projects (user_id, name) VALUES (:user_id, :name)";
		$sth = $this->db->prepare($query);

		try {
			$this->db->beginTransaction();
			$result = $sth->execute(
				array(
					':user_id' => $user_id,
					':name' => $name,
				)
			);
			$result = $this->db->lastInsertId();

			$this->db->commit();
		} catch (\PDOException $e) {
			$this->db->rollback();
			echo "Database error: " . $e->getMessage();
			die();
		}

		if (!$result) {
			$info = $sth->errorInfo();
			printf("Database error %d %s", $info[1], $info[2]);
			die();
		} 
		return $result;
	}

	public function updateTaskName($task_id, $name) {
		$query = "UPDATE tasks SET name = :name WHERE id = :task_id";
		$sth = $this->db->prepare($query);

		try {
			$this->db->beginTransaction();
			$result = $sth->execute(
				array(
					':task_id' => $task_id,
					':name' => $name,
				)
			);
			$this->db->commit();
		} catch (\PDOException $e) {
			$this->db->rollback();
			echo "Database error: " . $e->getMessage();
			die();
		}

		if (!$result) {
			$info = $sth->errorInfo();
			printf("Database error %d %s", $info[1], $info[2]);
			die();
		} 
		return $result;
	}	

	public function updateTaskStatus($task_id, $status) {
		$query = "UPDATE tasks SET status = :status WHERE id = :task_id";
		$sth = $this->db->prepare($query);

		try {
			$this->db->beginTransaction();
			$result = $sth->execute(
				array(
					':task_id' => $task_id,
					':status' => $status,
				)
			);
			$this->db->commit();
		} catch (\PDOException $e) {
			$this->db->rollback();
			echo "Database error: " . $e->getMessage();
			die();
		}

		if (!$result) {
			$info = $sth->errorInfo();
			printf("Database error %d %s", $info[1], $info[2]);
			die();
		} 
		return $result;
	}

	public function updateProject($user_id,$id_project,$name) {
		$query = "UPDATE projects SET name = :name WHERE id = :id_project AND user_id = :user_id";
		$sth = $this->db->prepare($query);

		try {
			$this->db->beginTransaction();
			$result = $sth->execute(
				array(
					':id_project' => $id_project,
					':user_id' => $user_id,
					':name' => $name,
				)
			);
			$this->db->commit();
		} catch (\PDOException $e) {
			$this->db->rollback();
			echo "Database error: " . $e->getMessage();
			die();
		}

		if (!$result) {
			$info = $sth->errorInfo();
			printf("Database error %d %s", $info[1], $info[2]);
			die();
		} 
		return $result;
	}

	public function create($username, $password) {
		$user_exists = $this->getSalt($username);

		if ($user_exists) {
			throw new \Exception("User exists: " . $username, 1);
		}

		$query = "insert into users (username, password, salt)
			values (:username, :password, :salt)";
		$hashes = $this->passwordHash($password);
		$sth = $this->db->prepare($query);

		try {
			$this->db->beginTransaction();
			$result = $sth->execute(
				array(
					':username' => $username,
					':password' => $hashes['hash'],
					':salt' => $hashes['salt'],
				)
			);
			$new_user_id = $this->db->lastInsertId();

			$this->db->commit();
		} catch (\PDOException $e) {
			$this->db->rollback();
			echo "Database error: " . $e->getMessage();
			die();
		}

		if (!$result) {
			$info = $sth->errorInfo();
			printf("Database error %d %s", $info[1], $info[2]);
			die();
		} 

		$result = $new_user_id;
		return $result;
	}

	public function getUserIDbytaskID($task_id) {
		$query = "SELECT user_id FROM projects WHERE id = (SELECT project_id FROM tasks WHERE id = :task_id)";

		$sth = $this->db->prepare($query);

		$sth->execute(
			array(
				":task_id" => $task_id,
			)
		);
		$row = $sth->fetch();

		if (!$row) {
			return false;
		} else {
			return $row['user_id'];
		}
	}

	// get the count of all tasks in each project, order by tasks count descending
	// get the count of all tasks in each project, order by projects names
	public function getTasksCount($user_id,$orderBy = 'tasks', $orderType = 'DESC') {
		if (!in_array($orderBy, array('tasks','name'))) {
			return false;
		}
		if (!in_array($orderType, array('DESC','ASC'))) {
			return false;
		}

		$query = "SELECT p.id, p.name as name, 
			(SELECT COUNT(*) FROM tasks AS t WHERE t.project_id = p.id) AS tasks 
			FROM projects AS p
			WHERE p.user_id = :user_id
			ORDER BY ".$orderBy." ". $orderType;

		$sth = $this->db->prepare($query);

		$sth->execute(
			array(
				":user_id" => $user_id,
			)
		);
		$row = $sth->fetchAll();

		if (!$row) {
			return false;
		} else {
			return $row;
		}
	}

	// get the tasks for all projects having the name beginning with letter
	public function getTasksByProjectName($user_id,$firstLetter) {
	
	$query = "SELECT 
				t.id, t.name, t.status ,p.name as project_name 
				FROM tasks as t 
				LEFT JOIN projects as p ON t.project_id = p.id 
				WHERE p.user_id = :user_id AND 
				p.name LIKE '".$firstLetter."%' ";

		$sth = $this->db->prepare($query);

		$sth->execute(
			array(
				":user_id" => $user_id,
			)
		);
		$row = $sth->fetchAll();

		if (!$row) {
			return false;
		} else {
			return $row;
		}
	}

	// get the list of all projects containing the letter in the middle of the name, and show the tasks count near each project.
	public function getProjectsByLatterInName($user_id,$letter) {
	
	$query = "SELECT p.user_id, p.id, p.name, 
				(SELECT COUNT(*) FROM tasks AS t WHERE t.project_id = p.id) AS tasks 
				FROM projects AS p
				WHERE p.user_id = :user_id AND
				p.name LIKE '%".$letter."%' ";

		$sth = $this->db->prepare($query);

		$sth->execute(
			array(
				":user_id" => $user_id,
			)
		);
		$row = $sth->fetchAll();

		if (!$row) {
			return false;
		} else {
			return $row;
		}
	}

	// get the list of tasks with duplicate names. Order alphabetically
	public function getDuplicateTasks($user_id) {
	
		$query = "SELECT t.name, COUNT(*)  
				FROM tasks as t 
				LEFT JOIN projects as p ON t.project_id = p.id 
				WHERE p.user_id = :user_id
				GROUP BY
				t.name
				HAVING COUNT(*)>1
				ORDER BY name ASC";

		$sth = $this->db->prepare($query);

		$sth->execute(
			array(
				":user_id" => $user_id,
			)
		);
		$row = $sth->fetchAll();

		if (!$row) {
			return false;
		} else {
			return $row;
		}
	}
}