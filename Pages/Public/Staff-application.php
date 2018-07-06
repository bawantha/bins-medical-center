<style>
    h1 {
		font-family : Sans-serif;
		font-size : 40px;
	}
</style>
<h1> Staff Application Form </h1>
<?php
	$nic_error =  $mobile_error = $email_error = $specialization_error = "";
	$name_error = "";
	$pos_error = "Select what position you are applying for";
	$nic = $name = $mobile = $email = $dob = "";
	
	$file_error = "Select a pdf or an image of your medical  license";
	
	include 'form-validation.php';
	if (empty($_POST["position"])){
		$pos_error = "You must select a position";
		$upload_ok = false;
	} else {
		$pos = correct_input($_POST["position"]);
	}
?>
<form method = 'post' action = <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> name = 'Staff application', enctype = 'multipart/form-data'>
	<pre>
	NIC :				<input maxlength = 10 name = 'nic' value = "<?php echo $nic;?>" required > <span class="error">* <?php echo $nic_error;?></span><br>
	Name :				<input maxlength = 45 name = 'name' value = "<?php echo $name;?>" required> <span class="error" >* <?php echo $name_error;?></span><br>
	Mobile :			<input type = 'tel' name = 'mobile' maxlength = 10 value = "<?php echo $mobile;?>" required> <span class="error">* <?php echo $mobile_error;?></span><br>
	Position :			<input type = 'radio' name = 'position' value = 'nurse'> Nurse <input type = 'radio' name = 'position' value = 'pharmacist'> Pharmacist <span class="error">* <?php echo $pos_error;?></span><br> 
	Email :				<input type = 'email' name = 'email' value = <?php echo $email;?>> <span class="error"> <?php echo $email_error;?></span><br>
	DOB :				<input type = 'date' name = 'dob'> <br>
	Medical License :		<input type = 'file' name = 'license' required> <span class="error">* <?php echo $file_error;?></span><br>
	<input type = 'submit' name = 'submit'>
	</pre>
</form>

<?php
	if (isset($_POST['submit'])){
		include 'Database-connect.php';
		if ($upload_ok) {
			$target_loc = $target_loc . "staff/$nic - $name.$file_type";
			$sql = "insert into staff_application values ('$nic'," . 
			" '$name', '$pos', '$mobile', '$email', '$dob', '$target_loc', 'pending interview')";
			$state = $connection -> query($sql);
			if ($state !== false and move_uploaded_file($_FILES['license']['tmp_name'], $target_loc)) {
				echo "<script> window.alert('Apllication saved'); </script>";
			} else {
				echo "<script> window.alert('Error saving application'); </script>";
			}
			
		}
	}
?>

	