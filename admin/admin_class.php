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

		// Check if RFID exists in students or employees table
		if (!empty($id)) {
			$check_students = $this->db->query("SELECT * FROM students WHERE rfid = '$rfid' AND id != '$id'");
			$check_employees = $this->db->query("SELECT * FROM employees WHERE rfid = '$rfid' AND id != '$id'");

			if ($check_students->num_rows > 0 || $check_employees->num_rows > 0) {
				// RFID already exists in either students or employees, return 3
				return 3;
			}
		}

		$data = " fname = '$fname' ";
		$data .= ", mname = '$mname' ";
		$data .= ", lname = '$lname' ";
		$data .= ", bdate = '$bdate' ";
		$data .= ", gender_id = '$gender' ";
		$data .= ", address = '$address' ";
		$data .= ", cellnum = '$cellnum' ";
		$data .= ", email = '$email' ";
		$data .= ", parent_name = '$parent_name' ";
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
			if ($move) {
				$data .= ", img_path = '$img' ";
			}
		}


		try {
			if (empty($id)) {
				$save = $this->db->query("INSERT INTO students set " . $data);
				if ($save)
				return 1;
			} else {
				$save = $this->db->query("UPDATE students set " . $data . " where id=" . $id);
				if ($save)
				return 2;
			}
		} catch (mysqli_sql_exception $e) {
			if ($e->getCode() == 1062) {
				return 3;
			} else {
				return $e->getMessage();  // For debugging
			}
		}
	}


	function register2(){
		extract($_POST);
		
		if (!empty($id)) {
			$check_students = $this->db->query("SELECT * FROM students WHERE rfid = '$rfid' AND id != '$id'");
			$check_employees = $this->db->query("SELECT * FROM employees WHERE rfid = '$rfid' AND id != '$id'");

			if ($check_students->num_rows > 0 || $check_employees->num_rows > 0) {
				// RFID already exists in either students or employees, return 3
				return 3;
			}
		}

		$data = " fname = '$fname' ";
		$data .= ", mname = '$mname' ";
		$data .= ", lname = '$lname' ";
		$data .= ", bdate = '$bdate' ";
		$data .= ", gender_id = '$gender' ";

		$data .= ", civil_stat = '$civil_stat' ";
		$data .= ", blood_type = '$blood_type' ";
		$data .= ", height = '$height' ";
		$data .= ", weight = '$weight' ";


		$data .= ", address = '$address' ";
		$data .= ", cellnum = '$cellnum' ";
		$data .= ", email = '$email' ";

		$data .= ", tin_num = '$tin_num' ";
		$data .= ", gsis_num = '$gsis_num' ";
		$data .= ", phil_num = '$phil_num' ";
		$data .= ", pagibig_num = '$pagibig_num' ";
		$data .= ", sss_num = '$sss_num' ";

		$data .= ", parent_name = '$parent_name' ";
		$data .= ", parent_num = '$parent_num' ";
		$data .= ", parent_address = '$parent_address' ";
		$data .= ", school_id = '$school_id' ";
		$data .= ", role_id = '$role_id' ";
		$data .= ", rfid = '$rfid' ";

		if ($_FILES['img']['tmp_name'] != '') {
			$img = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/img/' . $img);
			if ($move) {
				$data .= ", img_path = '$img' ";
			}
		}


		try{
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO employees set " . $data);
			if ($save)
			return 1;
		} else {
			$save = $this->db->query("UPDATE employees set " . $data . " where id=" . $id);
			if ($save)
			return 2;
		}

	} catch (mysqli_sql_exception $e) {
		if ($e->getCode() == 1062) {
			return 3;
		} else {
			return $e->getMessage();  // For debugging
		}
	}
	}




	function delete_student(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM students where id = ".$id);
		if($delete)
			return 1;
	}


	function delete_employee(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM employees where id = ".$id);
		if($delete)
			return 1;
	}



	function fetch_data(){
		extract($_POST);

		$fetch = $this->db->query("SELECT s.id, s.fname, s.mname, s.lname, g.gender, s.school_id, r.role_name, s.rfid, s.img_path
		FROM students s
		LEFT JOIN gender g ON s.gender_id = g.id
		LEFT JOIN role r ON s.role_id = r.id
		WHERE s.rfid = '$rfid'
	
		UNION
	
		SELECT e.id, e.fname, e.mname, e.lname, g.gender, e.school_id, r.role_name, e.rfid, e.img_path
		FROM employees e
		LEFT JOIN gender g ON e.gender_id = g.id
		LEFT JOIN role r ON e.role_id = r.id
		WHERE e.rfid = '$rfid'");
	
	
	


		if ($fetch->num_rows > 0) {
			$data = $fetch->fetch_assoc();

			$img_path = !empty($data['img_path']) ? $data['img_path'] : 'blank-img.png';

			$response = [
				'success' => true,
				'fname' => $data['fname'],
				'mname' => $data['mname'],
				'lname' => $data['lname'],
				'gender' => $data['gender'],
				'role_name' => $data['role_name'],
				'school_id' => $data['school_id'],
				'img_path' => $img_path
			];

			if ($response) {
				$check_existing = $this->db->query("SELECT * FROM records 
				WHERE rfid_num = '" . $data['rfid'] . "' 
				AND timeout IS NULL
			");

				if ($check_existing->num_rows > 0) {
					$update = $this->db->query("UPDATE records 
					SET timeout = CURRENT_TIMESTAMP() 
					WHERE rfid_num = '" . $data['rfid'] . "' 
					AND timeout IS NULL
				");
				} else {
					$insert = $this->db->query("INSERT INTO records (rfid_num, timein) 
					VALUES ('" . $data['rfid'] . "', CURRENT_TIMESTAMP())
				");
				}
			}
		} else {
			$response = ['success' => false];
		}
		
		echo json_encode($response);
	}

	
	function adduser(){
		extract($_POST);
	
		if(!empty($password)) {
			$password = password_hash($password, PASSWORD_BCRYPT);
		}
	
		$data = "";
		if(!empty($fname)) {
			$data .= " fname = '$fname', ";
		}
		if(!empty($mname)) {
			$data .= " mname = '$mname', ";
		}
		if(!empty($lname)) {
			$data .= " lname = '$lname', ";
		}
		if(!empty($email)) {
			$data .= " email = '$email', ";
		}
		if(!empty($username)) {
			$data .= " username = '$username', ";
		}
		if(!empty($password)) {
			$data .= " password = '$password', ";
		}
		if(!empty($account_type)) {
			$data .= " account_type = '$account_type', ";
		}
	
		// Remove trailing comma and space
		$data = rtrim($data, ', ');
	
		// Check if the email already exists
		$chk = $this->db->query("SELECT * FROM users WHERE email = '$email' AND id != '$id'")->num_rows;
		if($chk > 0) {
			return 3;
			exit;
		}
	

		if(empty($id)) {
			$save = $this->db->query("INSERT INTO users SET ".$data);
			if($save) {
				return 1;  
			}
		} else {
			$save = $this->db->query("UPDATE users SET ".$data." WHERE id = ".$id);
			if($save) {
				return 2;  
			}
		}
	}
	


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