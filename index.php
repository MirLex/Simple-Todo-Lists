<?php
require 'includes/startup.php';

$registry = new Registry;

if (isset($_SESSION['user_id'])) {
	$registry->set('user_id', $_SESSION['user_id']);
}

$db = new PDO('mysql:host=localhost;dbname=demo', 'root', 'root');
$registry->set('db', $db);

$template = new Template($registry);
$registry->set('template', $template);

$router = new Router($registry);
$router->setPath(site_path . 'controllers');

$registry->set('router', $router);
$router->delegate();
?>