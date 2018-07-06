<!doctype html>
<?php
include "Database-connect.php";

function correct_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
$doc_nic = $patient_nic = $schedule_id = $start_time = $end_time = $date = $mobile =  "";

if (isset($_GET['docNIC'])){
	$doc_nic = correct_input($_GET['docNIC']);
	$doctor_result = $connection -> query("SELECT* FROM doctor WHERE doc_nic = '$doc_nic'");
	$doctor_row = $doctor_result -> fetch_assoc();
}

if (isset($_POST['docNIC'])){
	$doc_nic = correct_input($_POST['docNIC']);
	$doctor_result = $connection -> query("SELECT* FROM doctor WHERE doc_nic = '$doc_nic'");
	$doctor_row = $doctor_result -> fetch_assoc();
}

if (isset($_POST['Confirm'])){
	$patient_nic = correct_input($_POST['patientNIC']);
	$schedule_id = correct_input($_POST['scheduleID']);
	$start_time = correct_input($_POST['startTime']);
	$end_time = correct_input($_POST['endTime']);
	$mobile = correct_input($_POST['mobile']);

	
	$max_count = round((strtotime($end_time) - strtotime($start_time))/(60*15));
	
	//check for duplicate entries
	$upload_ok = true;
	$result = $connection -> query("select* from channel where schedule_id = '$schedule_id' and patient_nic = '$patient_nic'");
	if ($result !== false and $result -> num_rows > 0) {
		echo "<script> alert('Appointment already made'); </script>";
		$upload_ok = false;
	}
	
	//add channeling and update schedule
	if ($upload_ok){
		$date = date("YmdHis");
		$channel_state = $connection -> query("INSERT INTO channel (channel_id, doc_nic, patient_nic, mobile, schedule_id, status) VALUES ('$date', '$doc_nic', '$patient_nic', '$mobile', '$schedule_id', 'pending')");
		$schedule_state = $connection -> query("UPDATE doctor_schedule SET no_of_channels = no_of_channels+1 WHERE id = '$schedule_id'");
		
		//update availability status
		$result = $connection -> query("SELECT no_of_channels FROM doctor_schedule WHERE id = '$schedule_id'");
		$row = $result -> fetch_assoc();
		$count = (int) $row['no_of_channels'];
		if ($count == $max_count){
			$schedule_state = $schedule_state and $connection -> query("UPDATE doctor_schedule SET status = 'Full' WHERE id = '$schedule_id'");
		}
		
		
		if ($channel_state !== false and $schedule_state !== false){
			echo "<script> alert('Appointment registered'); </script>";
		} elseif (!($channel_state !== false)){
			echo "<script> alert('channel state'); </script>";
		} elseif (!($schedule_state !== false)){
			echo "<script> alert('schedule_state'); </script>";
		} else {
			echo "<script> alert('Upload ok error'); </script>";
		}
		
	} else {
		echo "<script> alert('Upload not ok'); </script>";
	}
}
$connection -> close();
?>

<html lang="en">
  <style type="text/css">
  body{

    position: relative;
  }
    #aa{
        
        margin-right: : 500px;
        font-size: 200%;
        background-color: #99ccff;  
    }
    .AUsub{
      margin-right: 400px;
      margin-left: 15px;
      margin-top: 5px;
      text-align: right;
      
    }
    .hidden{

      display: none;
    }
    .AU{
      margin-top: 100px;
      margin-left: 15px;
      font-size: 300%;
      color:red;

    }
    .nav-link{
      color: black;
    }
    #AboutUsFull{
      background-color: yellow;
      margin-right: 400px;
      margin-left: 50px;
      margin-top: 5px;
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/index.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/index.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>BINS PLC</title>
  </head>
<body data-spy="scroll" data-target="#navbar-example" data-offset="70">

    <img src="http://localhost/bins-medical-center/Images/ekg.png" width="150px" height="150px" style="margin:0px 0px 0px 50px" align="left" style="background-color: #99ccff" border-radius="20%">
    <div id="aa"> 

      <em><strong>BINS </strong><br>
      Health Center<br><br><br></em>
    </div> 

	
	
<div class="contaner">
    <nav class="navbar bg-info navbar-light  " id="navbar-example"  >
      <ul class="nav nav-tabs" role="tablist">
        
        <li class="nav-item"><a class="nav-link " href="#Home" onclick="homeFunction()">Home</a></li>
        <li class="nav-item"><a class="nav-link " href="#About Us" onclick="AboutUsFunction()">About Us</a></li>
        <li class="nav-item "><a class="nav-link " href="#Channeling" onclick="channelingFunction()">Channeling</a></li>
        <li class="nav-item"><a class="nav-link " href="#Pharmacy service" onclick="PharmacyserviceFunction()">Pharmacy service</a></li>
        <li class="nav-item "><a class="nav-link " href="#Staff Registation" onclick="StaffRegistationFunction()">Staff Registation</a></li>
      </ul>
    </nav>
</div>

<div id = "doctor-details" >
<div style="width:100%">
	<div class="row" style = "float : 'left';">
		<div class="col-sm-4" height = 350 width = 350>
			<img src = '<?php echo "http://localhost/bins-medical-center/Files/doctor/$doc_nic/$doc_nic - icon.jpg"; ?>' onerror = 'alternateImage(this);' height = 300 width = 350 style = "float:right; padding-left : 50px; padding-right : 50px; padding-bottom : 50px"> </label><br>

		</div>
		<div class="col-sm-8">
			<h1 class="semi-bold"><?php echo $doctor_row['name']; ?></h1>

			<h3 class="no-margin specialization"><?php echo $doctor_row['specialization']; ?></h2>
		</div>
	</div>
</div>

	
	<div class="panel panel-default" >
	
	<!--Modal-->
	<div class="modal fade" id="Confirm" tabindex="-1" role="dialog" aria-labelledby="channelTypeChoseLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="channelTypeChoseLabel">Confirm Channeling</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form name = 'chanel form' id = 'chanel form' method = 'post' action =  <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label class="form-lable" for="NIC">NIC</label>
								<input type = 'text' class="form-control" name="patientNIC" value = "" maxlength = 10 required>
								
								<label class="form-lable" for="Patient mobile">Mobile</label>
								<input type = 'tel' class="form-control" name="mobile" maxlength = 10>
								
								<input type = 'hidden' name = 'docNIC' value = '<?php echo $_POST['docNIC']; ?>'>
								<input type = 'hidden' name = 'scheduleID' value = '<?php echo $_POST['scheduleID']; ?>'>
								<input type='hidden' value='<?php echo $_post['date']; ?>' name = 'date'>
								<input type='hidden' value='<?php echo $_post['startTime']; ?>' name = 'startTime'>
								<input type='hidden' value='<?php echo $_post['endTime']; ?>' name = 'endTime'>
								
							</div>
						</div>
					</form>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" name="Confirm" id = "chanelSubmit" value = 'Confirm' form = 'chanel form' >
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!--End of Modal-->
	
    <div class="panel-body">
        <div class="p-b-15 p-l-15 p-r-15">
            <h4 class="p-b-10">&nbsp; Schedule</h4>
            <table class="table table-hover table-responsive-block">
                
                <tbody align = 'center'>
                <tr>
                    <th>
                        <h5>Appointment Date</h5>
                    </th>
                    <th>
                        <h5>Status</h5>
                    </th>
                    <th>
                        <h5>From</h5>
                    </th>
					<th>
                        <h5>To</h5>
                    </th>
                    <th>
                        <h5> No of Channels</h5>
                    </th>
                    <th>
                         &nbsp;
                    </th>
                </tr>

                
                <?php
				function generate_result($data){
					echo "
					<td style='width:20%'>
                        <p class='no-margin bold'>$data[date]</p>
                        
                        <p class='no-margin bold'></p>
                        
                     </td>
					";
					
					$state = "";
					if ($data['status'] == 'Available'){
						$state = 'success';
					} elseif ($data['status'] == 'Unavailable'){
						$state = 'muted';
					} elseif ($data['status'] == 'Full'){
						$state = 'danger';
					}
					echo "
					<td class='p-b-20'>
                        
                        <p class='text-$state'>
                            $data[status]
                        </p>
                    </td>
                    
                    <td>
                        <p class='no-margin'>
                            
                            $data[start_time]</p>
                        
                        

                    </td>
					<td>
                        <p class='no-margin'>
                            
                            $data[end_time]</p>
                        
                        

                    </td>";
					$text = "";
					if ($state == "muted"){
						$text = "-";
					} else {
						$text = $data['no_of_channels'];
					}
					echo "
                    <td>
                         $text

                        
                        
                    </td>
					";
					
					echo "
					<td>
                        <form action='$_SERVER[PHP_SELF]' method='post' id = 'form'>
							<input type='hidden' value='$data[doc_nic]' name = 'doc nic'>
							<input type='hidden' value='$data[id]' name = 'schedule id'>
							";
					if ($state == "success"){
						$text =  "<input class='btn btn-success btn-m' type='submit' value='Book Now' form = 'form' name = 'book'>";
					} elseif ($state == "danger"){
						$text =  "<input class='btn btn-danger btn-m' type='button' value='Full' form = 'form' name = 'full'>";
					} elseif ($state == "muted"){
						$text =  "<input class='btn btn-muted btn-m' type='button' value='Unavailable' form = 'form' name = 'unavailable'>";
					}
					echo "
					<td>
                        <form action='$_SERVER[PHP_SELF]' method='post' id = 'form'>
							<input type='hidden' value='$data[doc_nic]' name = 'docNIC'>
							<input type='hidden' value='$data[id]' name = 'scheduleID'>
							<input type='hidden' value='$data[date]' name = 'date'>
							<input type='hidden' value='$data[start_time]' name = 'startTime'>
							<input type='hidden' value='$data[end_time]' name = 'endTime'>
							$text
						</form>
					</td>";
				}
				
				include "Database-connect.php";
				$result = $connection -> query("SELECT* FROM doctor_schedule WHERE doc_nic = '$doctor_row[doc_nic]'");
				if ($result !== false and $result -> num_rows > 0){
					while ($row = $result -> fetch_assoc()){
						echo "<tr>";
						
						generate_result($row);
						
						echo "</tr>";						
					}
				}
				$connection -> close();
				?>
                
            </tbody></table>
        </div>
    </div>
</div>

</div>
<script type="text/javascript">
	  
function homeFunction() {
    document.getElementById('About Us').style.display='none';
    document.getElementById('channaling').style.display='none';
    document.getElementById('Home').style.display='block';
    document.getElementById('hom').style.display='block';
    document.getElementById('Pharmacy service').style.display='none';
    document.getElementById('Staff Registation').style.display='none';
}
function AboutUsFunction() {
    document.getElementById('About Us').style.display='block';
    document.getElementById('Home').style.display='none';
    document.getElementById('hom').style.display='none';
    document.getElementById('channaling').style.display='none';
    document.getElementById('Pharmacy service').style.display='none';
    document.getElementById('Staff Registation').style.display='none';
}
function  channelingFunction() {
    window.location.assign('http://localhost/bins-medical-center/Pages/Public/index.php#Channeling');
	//window.location.channelingFunction();
}
function PharmacyserviceFunction() {
    document.getElementById('Home').style.display='none';
    document.getElementById('hom').style.display='none';
    document.getElementById('About Us').style.display='none';
    document.getElementById('channaling').style.display='none';
    document.getElementById('Pharmacy service').style.display='block';
    document.getElementById('Staff Registation').style.display='none';
}
function StaffRegistationFunction() {
    document.getElementById('Home').style.display='none';
    document.getElementById('hom').style.display='none';
    document.getElementById('About Us').style.display='none';
    document.getElementById('channaling').style.display='none';
    document.getElementById('Pharmacy service').style.display='none';
    document.getElementById('Staff Registation').style.display='block';
}

function alternateImage(image){
	image.src = 'noavatar.png';
}


//homeFunction();
</script>
<?php
if (isset($_POST['book'])){
	echo "
	<script type='text/javascript'> 
       $(document).ready(function(){
           $('#Confirm').modal('show');
       });
	</script>";
}	
?>