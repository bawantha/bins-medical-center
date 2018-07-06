<?php
function correct_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
$parameters = '';
header("Content-Type: application/json; charset=UTF-8");
if (isset($_GET['params'])){
	//echo $_GET['x'];
	$parameters = json_decode(str_replace("%Z", "%", $_GET['params']), false);
	

} elseif (isset($_POST['params'])){
	//echo $_GET['x'];
	$parameters = json_decode(str_replace("%Z", "%", $_POST['params']), false);
}

include "$_SERVER[DOCUMENT_ROOT]/bins-medical-center/Pages/Public/Database-connect.php";
$columns = correct_input($parameters -> columns);
$table = correct_input($parameters -> table);
$values = correct_input($parameters -> values);

$sql = "INSERT INTO $table $columns VALUES ($values)";
$state = $connection -> query($sql);

if($state !== false){
	echo "$table Values saved";
} else {
	echo "$table Insert error";
}

?>