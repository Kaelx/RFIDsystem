<?php
session_start();

class Action
{

	private $db;

	public function __construct()
	{
		ob_start();
		include 'db_connect.php';

		$this->db = $conn;
	}

	function __destruct()
	{
		$this->db->close();
		ob_end_flush();
	}



	function logout()
	{
		$result = $this->db->query("SELECT * FROM users where id = " . $_SESSION['login_id'])->fetch_array();
		$log = [
			'user_id' => $result['id'],
			'action' => ' has logged out'
		];
		$this->save_log($log);


		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header('location: index');
		exit();
	}



	function save_category2()
	{
		extract($_POST);
		$data = " dept_name = '$name' ";
		$data .= ", color = '$colorpick' ";
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO department set " . $data);
			if ($save)
				return 1;
		} else {
			$save = $this->db->query("UPDATE department set " . $data . " where id=" . $id);
			if ($save)
				return 2;
		}
	}


	function save_category3()
	{
		extract($_POST);
		$data = " dept_id = '$dept_id' ";
		$data .= ", prog_name = '$name' ";
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO program set " . $data);
			if ($save)
				return 1;
		} else {
			$save = $this->db->query("UPDATE program set " . $data . " where id=" . $id);
			if ($save)
				return 2;
		}
	}


	function delete_category()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM role where id = " . $id);
		if ($delete)
			return 1;
	}

	function delete_category2()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM department where id = " . $id);
		if ($delete)
			return 1;
	}

	function delete_category3()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM program where id = " . $id);
		if ($delete)
			return 1;
	}



	function get_department()
	{
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



	//register student
	function register()
	{
		extract($_POST);

		if (!empty($id)) {
			$current_rfid = $this->db->query("SELECT rfid FROM students WHERE id = '$id'")->fetch_assoc()['rfid'];
		}

		if (empty($id) || (!empty($id) && $rfid != $current_rfid)) {
			$check_students = $this->db->query("SELECT * FROM students WHERE rfid = '$rfid'");
			$check_employees = $this->db->query("SELECT * FROM employees WHERE rfid = '$rfid'");
			$check_vistors = $this->db->query("SELECT * FROM visitors WHERE rfid = '$rfid'");

			if ($check_students->num_rows > 0 || $check_employees->num_rows > 0 || $check_vistors->num_rows > 0) {
				return 3;
			}
		}

		$data = " fname = '$fname' ";
		$data .= ", mname = '$mname' ";
		$data .= ", lname = '$lname' ";
		$data .= ", bdate = '$bdate' ";
		$data .= ", gender = '$gender' ";
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


		$base64_data = $_POST['croppedImageData'];

		$base64_data = preg_replace('/^data:image\/\w+;base64,/', '', $base64_data);
		$decoded_image = base64_decode($base64_data);

		$img_name = strtotime(date('y-m-d H:i')) .$rfid.'.png';
		$img_path = 'assets/img/' . $img_name;

		if (file_put_contents($img_path, $decoded_image)) {
			$data .= ", img_path = '$img_name' ";
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

			return $e->getMessage();  // For debugging
		}
	}


	//register employee
	function register2()
	{
		extract($_POST);

		if (!empty($id)) {
			$current_rfid = $this->db->query("SELECT rfid FROM employees WHERE id = '$id'")->fetch_assoc()['rfid'];
		}

		if (empty($id) || (!empty($id) && $rfid != $current_rfid)) {
			$check_students = $this->db->query("SELECT * FROM students WHERE rfid = '$rfid'");
			$check_employees = $this->db->query("SELECT * FROM employees WHERE rfid = '$rfid'");
			$check_vistors = $this->db->query("SELECT * FROM visitors WHERE rfid = '$rfid'");

			if ($check_students->num_rows > 0 || $check_employees->num_rows > 0 || $check_vistors->num_rows > 0) {
				return 3;
			}
		}

		$data = " fname = '$fname' ";
		$data .= ", mname = '$mname' ";
		$data .= ", lname = '$lname' ";
		$data .= ", bdate = '$bdate' ";
		$data .= ", gender = '$gender' ";

		$data .= ", address = '$address' ";
		$data .= ", cellnum = '$cellnum' ";
		$data .= ", email = '$email' ";

		$data .= ", parent_name = '$parent_name' ";
		$data .= ", parent_num = '$parent_num' ";
		$data .= ", parent_address = '$parent_address' ";
		$data .= ", school_id = '$school_id' ";
		$data .= ", role_id = '$role_id' ";
		$data .= ", rfid = '$rfid' ";

		$base64_data = $_POST['croppedImageData'];

		$base64_data = preg_replace('/^data:image\/\w+;base64,/', '', $base64_data);
		$decoded_image = base64_decode($base64_data);

		$img_name = strtotime(date('y-m-d H:i')) .$rfid.'.png';
		$img_path = 'assets/img/' . $img_name;

		if (file_put_contents($img_path, $decoded_image)) {
			$data .= ", img_path = '$img_name' ";
		}


		try {
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
			return $e->getMessage();  // For debugging

		}
	}




	//register visitor
	function register3()
	{
		extract($_POST);

		if (!empty($id)) {
			$current_rfid = $this->db->query("SELECT rfid FROM visitors WHERE id = '$id'")->fetch_assoc()['rfid'];
		}

		if (empty($id) || (!empty($id) && $rfid != $current_rfid)) {
			$check_students = $this->db->query("SELECT * FROM students WHERE rfid = '$rfid'");
			$check_employees = $this->db->query("SELECT * FROM employees WHERE rfid = '$rfid'");
			$check_vistors = $this->db->query("SELECT * FROM visitors WHERE rfid = '$rfid'");

			if ($check_students->num_rows > 0 || $check_employees->num_rows > 0 || $check_vistors->num_rows > 0) {
				return 3;
			}
		}

		$data = " fname = '$fname' ";
		$data .= ", mname = '$mname' ";
		$data .= ", lname = '$lname' ";
		$data .= ", bdate = '$bdate' ";
		$data .= ", gender = '$gender' ";
		$data .= ", address = '$address' ";
		$data .= ", cellnum = '$cellnum' ";
		$data .= ", email = '$email' ";
		$data .= ", parent_name = '$parent_name' ";
		$data .= ", parent_num = '$parent_num' ";
		$data .= ", parent_address = '$parent_address' ";
		$data .= ", role_id = '$role_id' ";
		$data .= ", rfid = '$rfid' ";

		$base64_data = $_POST['croppedImageData'];

		$base64_data = preg_replace('/^data:image\/\w+;base64,/', '', $base64_data);
		$decoded_image = base64_decode($base64_data);

		$img_name = strtotime(date('y-m-d H:i')) .$rfid.'.png';
		$img_path = 'assets/img/' . $img_name;

		if (file_put_contents($img_path, $decoded_image)) {
			$data .= ", img_path = '$img_name' ";
		}


		try {
			if (empty($id)) {
				$save = $this->db->query("INSERT INTO visitors set " . $data);
				if ($save)
					return 1;
			} else {
				$save = $this->db->query("UPDATE visitors set " . $data . " where id=" . $id);
				if ($save)
					return 2;
			}
		} catch (mysqli_sql_exception $e) {
			return $e->getMessage();  // For debugging

		}
	}




	function archive_student()
	{
		extract($_POST);
		$archive = $this->db->query("UPDATE students set status = 1 where id = " . $id);
		if ($archive)
			return 1;
	}

	function unarchive_student()
	{
		extract($_POST);
		$archive = $this->db->query("UPDATE students set status = 0 where id = " . $id);
		if ($archive)
			return 1;
	}




	function archive_employee()
	{
		extract($_POST);
		$archive = $this->db->query("UPDATE employees set status = 1 where id = " . $id);
		if ($archive)
			return 1;
	}

	function unarchive_employee()
	{
		extract($_POST);
		$archive = $this->db->query("UPDATE employees set status = 0 where id = " . $id);
		if ($archive)
			return 1;
	}



	function archive_visitor()
	{
		extract($_POST);
		$archive = $this->db->query("UPDATE visitors set status = 1 where id = " . $id);
		if ($archive)
			return 1;
	}

	function unarchive_visitor()
	{
		extract($_POST);
		$archive = $this->db->query("UPDATE visitors set status = 0 where id = " . $id);
		if ($archive)
			return 1;
	}



	function fetch_data()
	{
		extract($_POST);

		$fetch = $this->db->query("SELECT s.id, s.fname, s.lname, s.gender, s.school_id, r.role_name, s.rfid, s.img_path, 'students' as source_table
			FROM students s
			LEFT JOIN role r ON s.role_id = r.id
			WHERE s.rfid = '$rfid' AND s.status = 0
			
			UNION
			
			SELECT e.id, e.fname, e.lname, e.gender, e.school_id, r.role_name, e.rfid, e.img_path, 'employees' as source_table
			FROM employees e
			LEFT JOIN role r ON e.role_id = r.id
			WHERE e.rfid = '$rfid' AND e.status = 0
			
			UNION
			
			SELECT v.id, v.fname, v.lname, v.gender, null as school_id, r.role_name, v.rfid, v.img_path, 'visitors' as source_table
			FROM visitors v
			LEFT JOIN role r ON v.role_id = r.id
			WHERE v.rfid = '$rfid' AND v.status = 0
		");

		if ($fetch->num_rows > 0) {
			$data = $fetch->fetch_assoc();

			$img_path = !empty($data['img_path']) ? $data['img_path'] : 'blank-img.png';

			$response = [
				'success' => true,
				'fname' => $data['fname'],
				'lname' => $data['lname'],
				'gender' => ucfirst($data['gender']),
				'role_name' => $data['role_name'],
				'school_id' => $data['school_id'] !== null ? $data['school_id'] : 'Visitor',
				'img_path' => $img_path
			];

			if ($response) {
				$check_existing = $this->db->query("SELECT * FROM records 
					WHERE recordable_id = '" . $data['id'] . "' 
					AND recordable_table = '" . $data['source_table'] . "'
					AND timeout IS NULL
				");

				if ($check_existing->num_rows > 0) {
					$update = $this->db->query("UPDATE records 
						SET timeout = CURRENT_TIMESTAMP() 
						WHERE recordable_id = '" . $data['id'] . "' 
						AND recordable_table = '" . $data['source_table'] . "'
						AND timeout IS NULL
					");
				} else {
					$insert = $this->db->query("INSERT INTO records (recordable_id, recordable_table, timein) 
						VALUES ('" . $data['id'] . "', '" . $data['source_table'] . "', CURRENT_TIMESTAMP())
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

		$data = " fname = '$fname'";
		$data .= ", mname = '$mname'";
		$data .= ",lname = '$lname'";
		$data .= ", bdate = '$bdate'";
		$data .= ", gender = '$gender'";
		$data .= ", address = '$address'";
		$data .= ", cellnum = '$cellnum'";
		$data .= ", email = '$email'";
		$data .= ", school_id = '$school_id'";
		$data .= ", username = '$username'";
		
		if (!empty($account_type)) {
			$data .= ", account_type = '$account_type'";
		}

		if (!empty($password)) {
			$hashed_password = password_hash($password, PASSWORD_BCRYPT);
			$data .= ", password = '$hashed_password'";
		}

		$base64_data = $_POST['croppedImageData'];
		$base64_data = preg_replace('/^data:image\/\w+;base64,/', '', $base64_data);
		$decoded_image = base64_decode($base64_data);
		$img_name = strtotime(date('y-m-d H:i')) .$fname.'.png';
		$img_path = 'assets/img/' . $img_name;
		if (file_put_contents($img_path, $decoded_image)) {
			$data .= ", img_path = '$img_name' ";
		}

		$chk = $this->db->query("SELECT * FROM users WHERE email = '$email' AND id != '$id'")->num_rows;
		if ($chk > 0) {
			return 3; 

		}

		if (empty($id)) {
			$save = $this->db->query("INSERT INTO users SET " . $data);
			if ($save) {
				return 1; 

			}
		} else {
			$save = $this->db->query("UPDATE users SET " . $data . " WHERE id = " . $id);
			if ($save) {
				return 2;
			}
		}


	}



	function archive_user(){
		extract($_POST);
		$archive = $this->db->query("UPDATE users set status = 1 where id = " . $id);
		if ($archive)
			return 1;
	}

	function unarchive_user(){
		extract($_POST);
		$archive = $this->db->query("UPDATE users set status = 0 where id = " . $id);
		if ($archive)
			return 1;
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




	// function save_log($log){
	// 	$qry = $this->db->query("INSERT INTO logs (user_id, action) 
	// 							VALUES ('" . $log['user_id'] . "', '" . $log['action'] . "')");

	// 	if (!$qry) {
	// 		error_log("Error saving log: " . $this->db->error);
	// 	}

	// 	return $qry ? true : false;
	// }


	function save_log($log) {

		// Get user IP address
		$ip_address = $_SERVER['REMOTE_ADDR'];

		$location = 'Unknown';  // Default location if API fails
		$geo_data = @file_get_contents("http://ip-api.com/json/{$ip_address}");
		if ($geo_data) {
			$geo_data = json_decode($geo_data, true);
			if ($geo_data['status'] === 'success') {
				$location = $geo_data['city'] . ', ' . $geo_data['country'];
			}
		}

		$info = $location;

	
		$qry = $this->db->query("INSERT INTO logs (user_id, action, ip_address, device_info) 
								VALUES ('" . $log['user_id'] . "', '" . $log['action'] . "', '" . $ip_address . "', '" . $info . "')");
	
		// Check for errors
		if (!$qry) {
			error_log("Error saving log: " . $this->db->error);
		}
	
		return $qry ? true : false;
	}

	
}
