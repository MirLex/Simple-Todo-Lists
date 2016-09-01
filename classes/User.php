<?php

class User {
	private $registry;

	private $id;
	private $username;
	private $user_id;
	private $is_authorized = false;

	function __construct($registry) {

			$this->registry = $registry;
			$this->db = $registry['db'];
	}

	public static function isAuthorized() {
		if (!empty($_SESSION["is_auth"])) {
			return (bool) $_SESSION["is_auth"];
		}
		return false;
	}

	public function passwordHash($password, $salt = null, $iterations = 10) {
		$salt || $salt = uniqid();
		$hash = md5(md5($password . md5(sha1($salt))));

		for ($i = 0; $i < $iterations; ++$i) {
			$hash = md5(md5(sha1($hash)));
		}
		return array('hash' => $hash, 'salt' => $salt);
	}

	public function getSalt($username) {
		$query = "select salt from users where username = :username limit 1";
		$sth = $this->db->prepare($query);
		$sth->execute(
			array(
				":username" => $username
			)
		);
		$row = $sth->fetch();
		if (!$row) {
			return false;
		}
		return $row["salt"];
	}

	public function authorize($username, $password, $remember=false) {
		$query = "select id, username from users where
			username = :username and password = :password limit 1";
		$sth = $this->db->prepare($query);
		$salt = $this->getSalt($username);

		if (!$salt) {
			return false;
		}

		$hashes = $this->passwordHash($password, $salt);
		$sth->execute(
			array(
				":username" => $username,
				":password" => $hashes['hash'],
			)
		);
		$this->user = $sth->fetch();

		if (!$this->user) {
			$this->is_authorized = false;
		} else {
			$this->is_authorized = true;
			$this->user_id = $this->user['id'];
			$this->username = $this->user['username'];
			$this->saveSession($remember);
		}

		$data = array(
			'result' => $this->is_authorized, 
			'user_id' => $this->user_id, 
		);
		return $data;
	}

	public static function logout() {
		if(!isset($_SESSION)) {
			 session_start();
		} 
		if (!empty($_SESSION["is_auth"])) {
			unset($_SESSION["is_auth"]);
			unset($_SESSION["user_id"]);
			unset($_SESSION["username"]);
		}
		session_destroy();
	}

	public function saveSession($remember = false, $http_only = true, $days = 7) {
		if(!isset($_SESSION)) {
			 session_start();
		}      

		$_SESSION["is_auth"] = true;
		$_SESSION["user_id"] = $this->user_id;
		$_SESSION["username"] = $this->username;

		$sid = session_id();

		$expire = time() + $days * 24 * 3600;
		$domain = ""; // default domain
		$secure = false;
		$path = "/";

		$cookie = setcookie("sid", $sid, $expire, $path, $domain, $secure, $http_only);
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
}