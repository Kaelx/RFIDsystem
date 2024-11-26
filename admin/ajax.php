<?php

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();


if ($action == 'logout') {
	$logout = $crud->logout();
	if ($logout)
		echo $logout;
}


if ($action == "save_category2") {
	$save = $crud->save_category2();
	if ($save)
		echo $save;
}

if ($action == "save_category3") {
	$save = $crud->save_category3();
	if ($save)
		echo $save;
}

if ($action == "save_category4") {
	$save = $crud->save_category4();
	if ($save)
		echo $save;
}


if ($action == "delete_category2") {
	$save = $crud->delete_category2();
	if ($save)
		echo $save;
}

if ($action == "delete_category3") {
	$save = $crud->delete_category3();
	if ($save)
		echo $save;
}

if ($action == "delete_category4") {
	$save = $crud->delete_category4();
	if ($save)
		echo $save;
}


if ($action == "get_department") {
	$save = $crud->get_department();
	if ($save)
		echo $save;
}

//register student
if ($action == "register") {
	$save = $crud->register();
	if ($save)
		echo $save;
}

//register employee
if ($action == "register2") {
	$save = $crud->register2();
	if ($save)
		echo $save;
}

//register visitor
if ($action == "register3") {
	$save = $crud->register3();
	if ($save)
		echo $save;
}

//register vendors
if ($action == "register4") {
	$save = $crud->register4();
	if ($save)
		echo $save;
}

if ($action == "adduser") {
	$save = $crud->adduser();
	if ($save)
		echo $save;
}

if ($action == "fetch_data") {
	$save = $crud->fetch_data();
	if ($save)
		echo $save;
}

if ($action == "fetch_data_in") {
	$save = $crud->fetch_data_in();
	if ($save)
		echo $save;
}

if ($action == "fetch_data_out") {
	$save = $crud->fetch_data_out();
	if ($save)
		echo $save;
}


if ($action == "request_report") {
	$save = $crud->request_report();
	if ($save)
		echo $save;
}


if ($action == "archive_student") {
	$save = $crud->archive_student();
	if ($save)
		echo $save;
}

if ($action == "unarchive_student") {
	$save = $crud->unarchive_student();
	if ($save)
		echo $save;
}


if ($action == "archive_employee") {
	$save = $crud->archive_employee();
	if ($save)
		echo $save;
}

if ($action == "unarchive_employee") {
	$save = $crud->unarchive_employee();
	if ($save)
		echo $save;
}

if ($action == "archive_visitor") {
	$save = $crud->archive_visitor();
	if ($save)
		echo $save;
}

if ($action == "unarchive_visitor") {
	$save = $crud->unarchive_visitor();
	if ($save)
		echo $save;
}



if ($action == "archive_vendor") {
	$save = $crud->archive_vendor();
	if ($save)
		echo $save;
}

if ($action == "unarchive_vendor") {
	$save = $crud->unarchive_vendor();
	if ($save)
		echo $save;
}

if ($action == "archive_user") {
	$save = $crud->archive_user();
	if ($save)
		echo $save;
}

if ($action == "unarchive_user") {
	$save = $crud->unarchive_user();
	if ($save)
		echo $save;
}


if ($action == "get_record") {
	$save = $crud->get_record();
	if ($save)
		echo $save;
}


if ($action == "mode") {
	$save = $crud->mode();
	if ($save)
		echo $save;
}
