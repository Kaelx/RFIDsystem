<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '.././vendor/autoload.php';

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


	function login(){
		extract($_POST);

		$qry = $this->db->query("SELECT * FROM users where status = 0 and username = '" . $username . "' ");
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
					'action' => ' has logged in'
				];
				$this->save_log($log);

				return 1;
			}
			return 2;
		}
		return 3;
	}

	

	function forgot_pass(){
		require '../credentials.php';
		extract($_POST);

		$qry = $this->db->query("SELECT * FROM users WHERE status = 0 AND email = '" . $email . "'");

			if ($qry-> num_rows > 0) {
				$otp = rand(100000, 999999);
				$_SESSION['otp'] = $otp;
				$_SESSION['mail'] = $email;

				function sendOTP($email, $otp, $mailUsername, $mailPassword){
					$mail = new PHPMailer;
			
					$mail->isSMTP();
					$mail->Host = 'smtp.gmail.com';
					$mail->Port = 587;
					$mail->SMTPAuth = true;
					$mail->SMTPSecure = 'tls';
			
					$mail->Username = $mailUsername; 
					$mail->Password = $mailPassword;
			
					$mail->setFrom('evsuoc-rfid@gmail.com', 'EVSU-OC RFID Verification Code');
					$mail->addAddress($email);
			
					$mail->isHTML(true);
					$mail->Subject = "EVSU-OC RFID Verification Code";
					$mail->Body = "<h5>Dear user, </h5> <h3>Your recovery OTP code is $otp <br></h3>";
			
					return $mail->send();
				}

				if (!sendOTP($email, $otp, $mailUsername, $mailPassword)) {
					return 4;
				} else {
					return 1;
				}
			}else{
				return 3;
			}
	}

	function updatepass(){
		extract($_POST);

		if ($otpcode == $_SESSION['otp']) {
			if($newpass == $confirmpass){
				$newpass = password_hash($newpass, PASSWORD_DEFAULT);
				$qry = $this->db->query("UPDATE users set password = '" . $newpass . "' where email = '" . $_SESSION['mail'] . "' ");
				if ($qry) {
					unset($_SESSION['otp']);
					unset($_SESSION['mail']);
					return 1;
				}
				return 2;

			}
			return 3;

		}
		return 4;
	}




	function save_log($log) {

		
		$qry = $this->db->query("INSERT INTO logs (user_id, action) 
								VALUES ('" . $log['user_id'] . "', '" . $log['action'] . "')");
	
		// Check for errors
		if (!$qry) {
			error_log("Error saving log: " . $this->db->error);
		}
	}

	
}
