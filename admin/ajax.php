<?php

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();


if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}


?>