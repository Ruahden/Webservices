<?php

	// Include confi.php
	include_once('./confi.php');

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		if($_SERVER['CONTENT_TYPE'] == 'application/json'){
			$json = file_get_contents('php://input');
			$patient = json_decode($json, true);
		}else{
			$patient = $_POST;
		}

		// Get data
		$name = isset($patient['name']) ? mysql_real_escape_string($patient['name']) : "";
		$dob = isset($patient['dob']) ? mysql_real_escape_string($patient['dob']) : "";
		$ssn = isset($patient['ssn']) ? mysql_real_escape_string($patient['ssn']) : "";
		$address = isset($patient['address']) ? mysql_real_escape_string($patient['address']) : "";
		$phone = isset($patient['phone']) ? mysql_real_escape_string($patient['phone']) : "";
		$email = isset($patient['email']) ? mysql_real_escape_string($patient['email']) : "";
		$doctor = isset($patient['doctor']) ? mysql_real_escape_string($patient['doctor']) : "";
		$hospital = isset($patient['hospital']) ? mysql_real_escape_string($patient['hospital']) : "";

		// Insert data into data base
		$sql = "INSERT INTO `phie`.`patient` (`name`, `dob`, `ssn`, `address`, `phone`, `email`, `doctor`, `hospital`) VALUES ('$name', '$dob', '$ssn', '$address', '$phone', '$email' ,'$doctor', '$hospital');";
		$qur = mysql_query($sql);
		
		if($qur){
			$json = array("status" => 1, "msg" => "Done Patient added!");
			
			// $json = file_get_contents('php://input');
			// $patient = json_decode($json);
			// $json = array("content" => $patient);

		}else{
			$json = array("status" => 0, "msg" => "Error adding user!");
		}

	}else{
		$json = array("status" => 0, "msg" => "Request method not accepted");
	}

	@mysql_close($conn);

	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);

?>