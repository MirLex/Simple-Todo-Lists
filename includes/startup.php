<?php
	function __autoload($class_name) {
			$filename = strtolower($class_name) . '.php';
			$file = site_path . 'classes' . DIRSEP . $filename;
			if (file_exists($file) == false) {
					return false;
			}
			include ($file);
	}

	define ('DIRSEP', DIRECTORY_SEPARATOR);

	$site_path = realpath(dirname(__FILE__) . DIRSEP . '..' . DIRSEP) . DIRSEP;
	define ('site_path', $site_path);

	if (!empty($_COOKIE['sid'])) {
		session_start(); 
		session_id($_COOKIE['sid']);
	}
?>