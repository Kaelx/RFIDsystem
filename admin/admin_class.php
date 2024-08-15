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


	function save_category(){
		extract($_POST);
		$data = " cat_name = '$name' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO category set ".$data);
			if($save)
			return 1;
		}else{
			$save = $this->db->query("UPDATE category set ".$data." where id=".$id);
			if($save)
			return 2;
		}
	}

	function save_category2(){
		extract($_POST);
		$data = " dept_name = '$name' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO department set ".$data);
			if($save)
			return 1;
		}else{
			$save = $this->db->query("UPDATE department set ".$data." where id=".$id);
			if($save)
			return 2;
		}
	}


	function save_category3(){
		extract($_POST);
		$data = " prog_name = '$name' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO program set ".$data);
			if($save)
			return 1;
		}else{
			$save = $this->db->query("UPDATE program set ".$data." where id=".$id);
			if($save)
			return 2;
		}
	}


	function delete_category(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM category where id = ".$id);
		if($delete)
			return 1;
	}

	function delete_category2(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM department where id = ".$id);
		if($delete)
			return 1;
	}

	function delete_category3(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM program where id = ".$id);
		if($delete)
			return 1;
	}





}
