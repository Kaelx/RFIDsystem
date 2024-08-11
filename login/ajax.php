<?php

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();


if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
?>