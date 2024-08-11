<?php
session_start();

class Action
{
    private $db;

    public function __construct(){
        ob_start();
        include 'db_connect.php';

        $this->db = $conn;
    }
    
    function __destruct(){
        $this->db->close();
        ob_end_flush();
    }



    function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
        header('location: index');
        exit();
	}







}
