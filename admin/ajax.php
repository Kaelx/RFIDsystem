<?php

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();


if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}

if($action == "save_category"){
	$save = $crud->save_category();
	if($save)
		echo $save;
}


if($action == "save_category2"){
	$save = $crud->save_category2();
	if($save)
		echo $save;
}

if($action == "save_category3"){
	$save = $crud->save_category3();
	if($save)
		echo $save;
}

if($action == "delete_category"){
	$save = $crud->delete_category();
	if($save)
		echo $save;
}

if($action == "delete_category2"){
	$save = $crud->delete_category2();
	if($save)
		echo $save;
}

if($action == "delete_category3"){
	$save = $crud->delete_category3();
	if($save)
		echo $save;
}


if($action == "register"){
	$save = $crud->register();
	if($save)
		echo $save;
}
?>