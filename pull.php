<?php

	// Include confi.php
	 include_once('../confi.php');
	 
	 $ssn = isset($_GET['ssn']) ? mysql_real_escape_string($_GET['ssn']) :  "";
	 
	 if(!empty($ssn)){

		 $qur = mysql_query("select name, dob, ssn, address, phone, email, doctor, hospital from `phie`.`patient` where ID=".$ssn."");
		 // $result =array();
		 // while($r = mysql_fetch_array($qur)){
			//  $result[] = extract($r);
			//  $result[] = array("name" => $r["name"], "dob" => $dob, 'ssn' => $ssn, "address" => $address, "phone" => $phone, 'email' => $email, "doctor" => $doctor, "hospital" => $hospital); 
	 	// }
	 	$json = array("status" => 1, "info" => $qur);

	 }else{

		 $json = array("status" => 0, "msg" => "SSN not found");

	 }

	 @mysql_close($conn);
	 
	 /* Output header */
	 header('Content-type: application/json');
	 echo json_encode($json);

?>