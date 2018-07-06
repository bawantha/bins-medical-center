<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>JS Bin</title>
<?php
$id = "";
if (isset($_POST['submit1']) and isset($_POST['id'])){
	echo $_POST["id"] ."<br>";
}
if (isset($_POST['submit2'])){
	echo $_POST["id2"] ."<br>";
}
?>
</head>
<body>
  <form id = 'form1' method = 'post' action =  <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> >
	ID1 <input type = 'hidden' name = 'id1' value = '<?php echo $_POST['id']; ?>'>
  </form>
  
  <input type = 'submit' form = 'form1' name = 'submit1' >
  
  <form id = 'form2' method = 'post' action =  <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> >
	IDw <input name = 'id2'>
  </form>
  
  <button type = 'button' form = 'form2' name = 'submit2' onclick = '<?php $_POST['id'] = 'aaaaaaa'; ?>'>
  
<?php $id = 'adasdad'; echo $_POST["id"] ."<br>";?>
</body>
</html>
