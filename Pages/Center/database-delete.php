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

$table = correct_input($parameters -> table);
$condition = correct_input($parameters -> condition);

$sql = "DELETE FROM $table WHERE $condition";
$state = $connection -> query($sql);

if($state !== false){
	echo "Table $table record deleted";
} else {
	echo "$table record delete error";
}

?>