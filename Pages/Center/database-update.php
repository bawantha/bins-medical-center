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
$set = correct_input($parameters -> set);
$table = correct_input($parameters -> table);
$condition = correct_input($parameters -> condition);

$sql = "UPDATE $table SET $set WHERE $condition";
$state = $connection -> query($sql);

if($state !== false){
	echo "Table $table updated";
} else {
	echo "$table Update error";
}

?>