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

if($action == "save_category4"){
	$save = $crud->save_category4();
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

if($action == "delete_category4"){
	$save = $crud->delete_category4();
	if($save)
		echo $save;
}


if($action == "get_department"){
	$save = $crud->get_department();
	if($save)
		echo $save;
}


if($action == "register"){
	$save = $crud->register();
	if($save)
		echo $save;
}


if($action == "register2"){
	$save = $crud->register2();
	if($save)
		echo $save;
}

if($action == "adduser"){
	$save = $crud->adduser();
	if($save)
		echo $save;
}


if($action == "fetch_data"){
	$save = $crud->fetch_data();
	if($save)
		echo $save;
}

// if($action == "import"){
// 	$save = $crud->import();
// 	if($save)
// 		echo $save;
// }


if($action == "delete_student"){
	$save = $crud->delete_student();
	if($save)
		echo $save;
}


if($action == "delete_employee"){
	$save = $crud->delete_employee();
	if($save)
		echo $save;
}




?>