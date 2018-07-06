<?php
function correct_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

header("Content-Type: application/json; charset=UTF-8");
if (isset($_GET['params'])){
	//echo $_GET['x'];
	$parameters = json_decode(str_replace("%Z", "%", $_GET['params']), false);

} elseif (isset($_POST['params'])){
	//echo $_GET['x'];
	$parameters = json_decode(str_replace("%Z", "%", $_POST['params']), false);

}

include "$_SERVER[DOCUMENT_ROOT]/bins-medical-center/Pages/Public/Database-connect.php";
$columns1 = correct_input($parameters -> columns);
$table1 = correct_input($parameters -> table);
$condition1 = correct_input($parameters -> condition);

$sql = "SELECT $columns1 FROM $table1 WHERE $condition1";
$result = $connection -> query($sql);

if ($result !== false and $result -> num_rows > 0){
	$output = array();
	$output = $result -> fetch_all(MYSQLI_ASSOC);
	echo json_encode($output);
} else {
	echo "No results";
}
?>