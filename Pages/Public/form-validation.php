<?php
	function correct_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	
	
	$upload_ok = true;
    
	
	
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {	
		//validate nic
		if (empty($_POST["nic"])) {
			$nic_error = "NIC is required";
		} else {
			$nic = correct_input($_POST['nic']);
			if (strlen($nic) != 10 or !ctype_alpha(substr($nic, 9, 10))){
				$nic_error = "Invalid NIC";
				$upload_ok = false;
			} else {
				//check if duplicate entry
				include "Database-connect.php";
				$tables = array("doctor", "doctor_application", "staff", "staff_application", "patient");
				$columns = array("doc_nic", 'doc_nic', 'staff_nic', 'staff_nic', 'patient_nic');
				for ($i = 0; $i < 5; $i++){
					$result = $connection -> query("select $columns[$i] from $tables[$i] where $columns[$i] = '$nic'");
					if ($result !== false and $result -> num_rows != 0) {
						$nic_error = "Duplicate entry";
						$upload_ok = false;
						break;
					}
				}
				$connection -> close();
			}
		}
		
		
		//validate name
		if (empty($_POST["name"])) {
			$name_error = "Name is required";
		} else {
			$name = correct_input("$_POST[name]");
			if (!ctype_alpha($name) and strpos($name, '.') === false and strpos($name, ' ') === false){
				$name_error = "Enter name properly";
				$upload_ok = false;
			}
		}
		
		//validate mobile
		if (empty($_POST["mobile"])) {
			$mobile_error = "Mobile is required";
		} else {
			$mobile = correct_input($_POST['mobile']);
			if (!is_numeric($mobile)){
				$mobile_error = "Invalid mobile";
				$upload_ok = false;
			}
		}
		
		//validate email
		if (!empty($_POST["email"])) {
			$email = correct_input($_POST['email']);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$email_error = "Invalid email";
				$upload_ok = false;
			}	
		}
		
		if (!empty($_POST["dob"])) {
			$dob = correct_input($_POST['dob']);	
		}
		
		
		//validate file
		if (empty($_FILES["license"]["tmp_name"])) {
			$file_error = "Medical license is required";
		} else {
			if ($name_error == "" and $nic_error == ""){
				$target_loc  = $_SERVER["DOCUMENT_ROOT"] . "/bins-medical-center/Uploads/";
			} else {
				$target_loc = "$_SERVER[DOCUMENT_ROOT]/bins-medical-center/Uploads/";
			}
			$file_type = strtolower(pathinfo($_FILES['license']['name'], PATHINFO_EXTENSION));
			if ($file_type != 'pdf' and !(getimagesize($_FILES['license']['tmp_name']) !== false)){
				$file_error = "Select either an image or a pdf";
				$upload_ok = false;
			}
		}
	}
	
	
?>