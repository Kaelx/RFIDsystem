<?php
session_start();

class Action{
	
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
		$data = " role_name = '$name' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO role set ".$data);
			if($save)
			return 1;
		}else{
			$save = $this->db->query("UPDATE role set ".$data." where id=".$id);
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
		$data = " dept_id = '$dept_id' ";
		$data .= ", prog_name = '$name' ";
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


	function save_category4(){
		extract($_POST);
		$data = "gender = '$name' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO gender set ".$data);
			if($save)
			return 1;
		}else{
			$save = $this->db->query("UPDATE gender set ".$data." where id=".$id);
			if($save)
			return 2;
		}
	}


	function delete_category(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM role where id = ".$id);
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

	function delete_category4(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM gender where id = ".$id);
		if($delete)
			return 1;
	}


	function get_department(){
		extract($_POST);

		$fetch = $this->db->query("SELECT * FROM program WHERE id = " . $prog_id);

		if ($fetch->num_rows > 0) {
			$data = $fetch->fetch_assoc();
			$dept_id = $data['dept_id'];

			$fetch = $this->db->query("SELECT * FROM department WHERE id = " . $dept_id);
			$data = $fetch->fetch_assoc();

			$response = [
				'success' => true,
				'dept_id' => $dept_id,
				'dept_name' => $data['dept_name'],
			];
		} else {
			$response = ['success' => false];
		}

		echo json_encode($response);
	}
	


	
	function register(){
		extract($_POST);

		$data = " fname = '$fname' ";
		$data .= ", mname = '$mname' ";
		$data .= ", lname = '$lname' ";
		$data .= ", bdate = '$bdate' ";
		$data .= ", gender_id = '$gender' ";
		$data .= ", address = '$address' ";
		$data .=", cellnum = '$cellnum' ";
		$data .= ", email = '$email' ";
		$data .=", parent_name = '$parent_name' ";
		$data .= ", parent_num = '$parent_num' ";
		$data .= ", parent_address = '$parent_address' ";
		$data .= ", school_id = '$school_id' ";
		$data .= ", role_id = '$role_id' ";
		$data .= ", prog_id = '$prog_id' ";
		$data .= ", dept_id = '$dept_id' ";
		$data .= ", rfid = '$rfid' ";

		if ($_FILES['img']['tmp_name'] != '') {
			$img = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/img/' . $img);
			if($move){
				$data .= ", img_path = '$img' ";
			}
		}

		if(empty($id)){
			$save = $this->db->query("INSERT INTO students set ".$data);
			if($save)
			return 1;
		}else{
			$save = $this->db->query("UPDATE students set ".$data." where id=".$id);
			if($save)
			return 2;
		}
	}


	function delete_student(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM students where id = ".$id);
		if($delete)
			return 1;
	}



	function fetch_data(){
		extract($_POST);

		$fetch = $this->db->query("SELECT s.*, d.dept_name, p.prog_name, r.role_name 
		FROM students s 
		LEFT JOIN department d ON s.dept_id = d.id 
		LEFT JOIN program p ON s.prog_id = p.id 
		LEFT JOIN role r ON s.role_id = r.id  
		WHERE s.rfid = '$rfid'");


		if ($fetch->num_rows > 0) {
			$data = $fetch->fetch_assoc();

			$img_path = !empty($data['img_path']) ? $data['img_path'] : 'blank-img.png';

			$response = [
				'success' => true,
				'fname' => $data['fname'],
				'lname' => $data['lname'],
				'role_name' => $data['role_name'],
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

	
	// function adduser(){
	// 	extract($_POST);

	// 	return($_POST);


		
	// 	if(empty($id)){
	// 		$save = $this->db->query("INSERT INTO user set ".$data);
	// 		if($save)
	// 		return 1;
	// 	}else{
	// 		$save = $this->db->query("UPDATE user set ".$data." where id=".$id);
	// 		if($save)
	// 		return 2;
	// 	}
		
	// }


	// function import() {
	// 	if (isset($_FILES['csv']['tmp_name'])) {
	// 		$csvFile = $_FILES['csv']['tmp_name'];
	
	// 		// Check if the file exists
	// 		if (($handle = fopen($csvFile, 'r')) !== FALSE) {
	// 			// Skip the first row if it contains column headers
	// 			fgetcsv($handle);
	
	// 			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	// 				// Check if the row has the expected number of columns
	// 				if (count($data) < 6) {
	// 					// Handle the error: Skip this row or log an error
	// 					continue; // Skip the row if it doesn't have enough columns
	// 				}
	
	// 				// Assign each CSV column to a variable, using a default value if it's missing
	// 				$id = !empty($data[0]) ? $data[0] : NULL; // or some default value
	// 				$fname = !empty($data[1]) ? $data[1] : '';
	// 				$lname = !empty($data[2]) ? $data[2] : '';
	// 				$role_id = !empty($data[3]) ? $data[3] : NULL;
	// 				$school_id = !empty($data[4]) ? $data[4] : NULL;
	// 				$email = !empty($data[5]) ? $data[5] : '';
	
	// 				// Adjust the SQL query to exclude rfid and img_path
	// 				$query = "INSERT INTO member (id, fname, lname, role_id, school_id, email) 
	// 						VALUES ('$id', '$fname', '$lname', '$role_id', '$school_id', '$email') 
	// 						ON DUPLICATE KEY UPDATE 
	// 						fname='$fname', lname='$lname', role_id='$role_id', school_id='$school_id', email='$email'";
	
	// 				if ($this->db->query($query) === TRUE) {
	// 					continue; // Data successfully added or updated, continue to next row
	// 				} else {
	// 					return 0; // Error occurred
	// 				}
	// 			}
	
	// 			fclose($handle);
	// 			return 1; // All data processed successfully
	// 		} else {
	// 			return 0; // Could not open the file
	// 		}
	// 	} else {
	// 		return 0; // File not set
	// 	}
	// }
	
	


	



}