<!doctype html>
<?php 
session_start();
function correct_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
  return $data;
  
}


$error = "";
$upload_ok = false;
if (isset($_POST['submit'])){
    $nic = correct_input($_POST['nic']);
	$password = correct_input($_POST['password']);
	include "../Public/Database-connect.php";
	$tables = array("owner", "doctor", "staff");
	$columns = array("owner_nic", "doc_nic", 'staff_nic');
	for ($i = 0; $i < 3; $i++){
		$result = $connection -> query("select* from $tables[$i] where $columns[$i] = '$nic' and password = '$password'");
		if ($result !== false and $result -> num_rows != 0) {

			$upload_ok = true;
			$_SESSION['nic'] = $nic;
			$_SESSION['user_type'] = $tables[$i];
			if ($tables[$i] == 'staff'){
				$row = $result -> fetch_assoc();
				$_SESSION['user_type'] = $row['position'];
			}if($tables[$i]=='owner'){
                include "../../debug/ChromePhp.php";
                ChromePhp::log("asda");
			    $row=$result->fetch_assoc();
			    $_SESSION['user_type']='owner';

            }
			break;
		}
		$error = "invalid NIC or password";
	}
	$connection -> close();

}

if ($upload_ok or (!empty($_SESSION['nic']) and !empty($_SESSION['nic']))){
	header("Location: $_SESSION[user_type]-home.php");
}

?>
<html lang="en">
  <style type="text/css">
  body{

    position: relative;
  }
  .inner{
    margin:150px;
  }
    #aa{
        
        margin-right: : 500px;
        font-size: 200%;
        background-color: #99ccff;  
    }
    #Superviser_Login{
      margin-left: 200px;
      margin-top: 50px;
      margin-right: 200px;
      background-color: gray;

    }
    #Doctor_Login{
      margin-left: 200px;
      margin-top: 50px;
      margin-right: 200px;
      background-color: gray;
    }

    .hidden{

      display: none;
    }
    
    .nav-link{
      color: black;
    }
    
    #aaa{

      font-size: 90px;   
      color: gray;  
      float: right;
    }
    #hom{
      margin-left: 220px;
    }
    #Home{
      margin-left: 30px;
      margin-top: 10px;
      font-size: 400%;
    }
  </style>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>BINS PLC</title>
  </head>
  <body data-spy="scroll" data-target="#navbar-example" data-offset="100">
    <img src="http://localhost/bins-medical-center/Images/ekg.png" width="150px" height="150px" style="margin:0px 0px 0px 50px" align="left" style="background-color: #99ccff" border-radius="20%">
    <div id="aa"> 

      <em><strong>BINS </strong><br>
      Health Center<br><br><br></em>
    </div> 

<div class="contaner">
    <nav class="navbar bg-info navbar-light  " id="navbar-example"  >
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item "><a class="nav-link " href="#Home" onclick="HomeFunction()">Home</a></li>
        <li class="nav-item"><a class="nav-link " href="#Login" onclick="LoginFunction();">Login</a></li>
      </ul>
    </nav>
</div>

<p id="Home" > Welcome</p>

<div id="hom">
	<img src="http://localhost/bins-medical-center/Images/g.jpg" width="1000px" height="500px"   >
</div>

<div id="Login" class="hidden">
    <div class="inner">
		<form method = 'post' action =  <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>>
			  <fieldset class="form-group">
				<label for="User Name">NIC</label>
				<input type="User Name" name="nic" class="form-control" maxlength = 10 required>
			  </fieldset>
			  <fieldset class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control" required>
			  </fieldset>
			  <p class = "error"> <?php echo $error; ?></p>
			  <fieldset class="form-group">
				<input type="submit" class="btn btn-primary" name = 'submit'>
			  </fieldset>
			  
			</form>
    </div>
</div>
        
<script type="text/javascript">

function HomeFunction() {
    document.getElementById('Login').style.display='none';
    document.getElementById('Home').style.display='block';
    document.getElementById('hom').style.display='block';
}

function LoginFunction() {
    document.getElementById('Login').style.display='block';
    document.getElementById('Home').style.display='none';
    document.getElementById('hom').style.display='none';
}
</script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
  </body>
</html>
