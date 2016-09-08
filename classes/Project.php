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
}