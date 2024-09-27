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


	function login(){
		extract($_POST);

		$qry = $this->db->query("SELECT * FROM users where username = '" . $username . "' ");
		if ($qry->num_rows > 0) {
			$result = $qry->fetch_array();
			$is_verified = password_verify($password, $result['password']);
			if ($is_verified) {
				foreach ($result as $key => $value) {
					if ($key != 'password' && !is_numeric($key))
						$_SESSION['login_' . $key] = $value;
				}

				// Create the log entry
				$log = [
					'user_id' => $_SESSION['login_id'],
					'action' => 'Logged in'
				];
				$this->save_log($log);

				return 1;
			}
			return 2;
		}
		return 3;
	}


	function save_log($log){
		$qry = $this->db->query("INSERT INTO logs (user_id, action) 
								VALUES ('" . $log['user_id'] . "', '" . $log['action'] . "')");

		if (!$qry) {
			error_log("Error saving log: " . $this->db->error);
		}

		return $qry ? true : false;
	}
	

}
