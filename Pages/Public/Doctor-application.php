<style>
    h1 {
		font-family : Sans-serif;
		font-size : 40px;
	}
</style>
<h1> Doctor Application Form </h1>
<?php
	$nic_error =  $mobile_error = $email_error = $specialization_error = "";
	$name_error = "Please enter in the example format";
	$nic = $name = $specialization = $mobile = $email = $dob = "";
	$file_error = "Select a pdf or an image of your medical  license";
	
	include 'form-validation.php';
	//validate specialization
	if (empty($_POST["specialization"])) {
		$specialization_error = "Specialization is required";
	} else {
		$specialization = correct_input("$_POST[specialization]");
		if (!ctype_alpha($specialization) and strpos($specialization, " ") === false){
			$$specialization_error = "Invalid NIC";
			$upload_ok = false;
		}
	}
?>
<form method = 'post' action = <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> name = 'Doctor application' enctype = 'multipart/form-data'>
	<pre>
	NIC :				<input maxlength = 10 name = 'nic' value = "<?php echo $nic;?>" > <span class="error">* <?php echo $nic_error;?></span><br>
	Name :				<input maxlength = 45 name = 'name' value = "<?php echo $name;?>" placeholder = "e.g: Dehigaspitiya S.L"> <span class="error">* <?php echo $name_error;?></span><br>
	Specialization :		<input list = "specializations" name = "specialization" value = "<?php echo $specialization;?>"> <?php  $name = "specializations";
	include 'Database-connect.php';
	$result = $connection -> query("select distinct specialization from doctor");
	$col_name = "specialization";
	include 'create-datalist.php';
	echo "<span class='error'>* <?php echo $file_error;?></span>";
	$connection -> close();?><br>
	Mobile :			<input type = 'tel' name ='mobile' maxlength = 10 value = <?php echo $mobile;?>> <span class="error">* <?php echo $mobile_error;?></span><br> 
	Email :				<input type = 'email' name= 'email' value = <?php echo $email;?>> <span class="error"> <?php echo $email_error;?></span><br>
	DOB :				<input type = 'date' name = 'dob' value = <?php echo $dob;?>><br>
	Medical License :		<input type = 'file' name = 'license' id = 'license' accept = "image/*, .pdf"> <span class="error">* <?php echo $file_error;?></span><br>
	<input type = 'submit' name = 'submit'>
	</pre>
</form>

<?php
	if (isset($_POST['submit'])){
		include 'Database-connect.php';
		if ($upload_ok) {
			$sql = "insert into doctor_application values ('$nic'," . 
			" '$name', '$specialization', '$mobile', '$email', '$dob', '$target_loc', 'pending interview')";
			$state = $connection -> query($sql);
			$target_loc = $target_loc . "doctor/license/$nic - $name.$file_type";
			if ($state !== false and move_uploaded_file($_FILES['license']['tmp_name'], $target_loc)) {
				echo "<script> window.alert('Apllication saved'); </script>";
			} else {
				echo "<script> window.alert('Error saving application'); </script>";
			}
			
		}
	}
?>

	