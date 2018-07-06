<?php
	if ($result !== false and $result -> num_rows > 0){
		while ($row = $result -> fetch_assoc()){
			echo "<option id = '$row[$id]' value = '$row[$value]'>$row[$col_name] </option>";
		}
	} elseif ($result === false){
		echo "<script> window.alert('false error') </script>";
	} elseif ($result -> num_rows == 0){
		echo "<script> window.alert('0 error') </script>";
	}
	else {
		echo "<script> window.alert('Error loading select $name;') </script>";
	}
?>