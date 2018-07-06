<?php
	if ($result !== false and $result -> num_rows > 0){
		echo "<datalist id = $name>";
		//echo "<script> window.alert('aa') </script>";
		while ($row = $result -> fetch_assoc()){
			//echo "<script> window.alert('asdsad') </script>";
			//echo  "<script> window.alert('Error loading datalist $row[$col_name];') </script>";
			echo "<option value = '$row[$col_name]'>";
		}
		echo "</datalist>";
	} else {
		echo "<script> window.alert('Error loading datalist $name;') </script>";
	}
?>