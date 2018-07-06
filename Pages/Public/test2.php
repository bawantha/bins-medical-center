<form method = 'post' action = 'dasdasdsad'>
	Specialization :<input list = "specializations" name = "specialization">
	<?php  $name = "specializations";
	$connection = new mysqli('localhost', 'root');
	if ($connection -> connect_error){
		echo '<script> window.alert("Could not connect to mysql"); </script>';
	}
	echo '<script> window.alert("Connected to mysql"); </script>';
	$state = $connection -> query("use phptest");
	if ($state  === true) {
		echo '<script> window.alert("Connected to databse"); </script>';
	} else {
		echo '<script> window.alert("Could not connect to databse"); </script>';
	}
	$result = $connection -> query("select distinct id from phptesttable");
	$col_name = "id";
	include 'create-datalist.php';
	$connection -> close();?><br>