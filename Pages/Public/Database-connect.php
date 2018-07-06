<?php
	$connection = new mysqli('localhost', 'root');
	if ($connection -> connect_error){
		echo '<script> window.alert("Could not connect to mysql"); </script>';
	}
	//echo '<script> window.alert("Connected to mysql"); </script>';
	$state = $connection -> query("use bins_medical_center");
	if ($state  === true) {
		//echo '<script> window.alert("Connected to databse"); </script>';
	} else {
		echo '<script> window.alert("Could not connect to databse"); </script>';
	}
?>































































