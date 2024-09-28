<?php

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();


if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}


if($action == 'forgot_pass'){
	$login = $crud->forgot_pass();
	if($login)
		echo $login;
}

if($action == 'updatepass'){
	$login = $crud->updatepass();
	if($login)
		echo $login;
}
?>