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


	
	function register(){
		extract($_POST);
		$data = " fname = '$fname' ";
		$data .= ", lname = '$lname' ";
		$data .= ", type_id = '$type_id' ";
		$data .= ", studentid = '$studentid' ";
		$data .= ", email = '$email' ";
		$data .= ", dept_id = '$dept_id' ";
		$data .= ", prog_id = '$prog_id' ";
		$data .= ", rfid = '$rfid' ";

		if ($_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/img/' . $fname);
			if($move){
				$data .= ", img_path = '$fname' ";
			}
		}

		if(empty($id)){
			$save = $this->db->query("INSERT INTO member set ".$data);
			if($save)
			return 1;
		}else{
			$save = $this->db->query("UPDATE member set ".$data." where id=".$id);
			if($save)
			return 2;
		}
	}



	function fetch_data(){
		extract($_POST);

		$fetch = $this->db->query("SELECT m.*, d.dept_name, p.prog_name, c.cat_name FROM member m 
									JOIN department d ON m.dept_id = d.id 
									JOIN program p ON m.prog_id = p.id 
									JOIN category c ON m.type_id = c.id  
									WHERE rfid = '$rfid'");

		if ($fetch->num_rows > 0) {
			$data = $fetch->fetch_assoc();

			$img_path = !empty($data['img_path']) ? $data['img_path'] : 'blank-img.png';

			$response = [
				'success' => true,
				'fname' => $data['fname'],
				'lname' => $data['lname'],
				'cat_name' => $data['cat_name'],
				'dept_name' => $data['dept_name'],
				'prog_name' => $data['prog_name'],
				'img_path' => $img_path
			];

			if ($response) {
				$check_existing = $this->db->query('SELECT * FROM record 
													WHERE fname = "' . $data['fname'] . '" 
													AND lname = "' . $data['lname'] . '" 
													AND timeout IS NULL');

				if ($check_existing->num_rows > 0) {
					$update = $this->db->query('UPDATE record SET timeout = current_timestamp() 
												WHERE fname = "' . $data['fname'] . '" 
												AND lname = "' . $data['lname'] . '" 
												AND timeout IS NULL');
				} else {
					$insert = $this->db->query('INSERT INTO record (fname, lname, timein) 
												VALUES ("' . $data['fname'] . '", "' . $data['lname'] . '", current_timestamp())');
				}
			}
		} else {
			$response = ['success' => false];
		}
		
		echo json_encode($response);
	}
	




}