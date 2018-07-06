<!DOCTYPE html>
<?php
session_start();
$nic = "";
if (empty($_SESSION['nic']) and empty($_SESSION['user_type'])){
	header("Location: index.php");
} else {
	$nic = $_SESSION['nic'];
	echo "<script> window.NIC = '$nic'; </script>";
}

if(isset($_POST['signout'])){
	$_SESSION['nic'] = $_SESSION['user_type'] = null;
	header("Location: index.php");
}
?>
<html lang="en">
	<style>
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


<div>
    <nav class="navbar bg-info navbar-light  " id="navbar-example"  >
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item "><a class="nav-link " data-toggle="tab" href="#home" role="tab">Home</a></li>
		<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#medicalProfile" role="tab" >Search Prescription</a></li>
		<form method = 'post' action = <?php echo $_SERVER['PHP_SELF']; ?> id = 'navForm'></form>
      </ul>
	  	
			<input class="btn btn-info" type = 'submit' style = "float:right;" value = 'Sign Out' name = 'signout' form ='navForm'>
		
		
    </nav>
</div>

<div class="tab-content">
	<br>
	  <div class="tab-pane active" id="home">
			<p id="Home"> Welcome</p>
			<div id="hom"><img src="g.jpg" width="1000px" height="500px"></div>	  	
	  </div>
	  
	  
	<div id="medicalProfile" class="tab-pane" role="tabpanel">  
		<form   method = 'get' action = <?php echo $_SERVER['PHP_SELF']; ?>>
			<div class="form-group row" style = 'align : center'>
			  <label for="text-input" class="col-2 col-form-label-lg" >Patient NIC</label>
			  <div class="col-2">
				<input class="form-control-lg" type="text" id = 'patientNIC'>
			  </div>
			</div>

		</form>
		
			<div class="form-group row">
			  <div class="offset-sm-2 col-sm-10">
				<button class="btn btn-info" style = "cursor:pointer" name = 'prescriptionSearch' data-toggle="tab" href="#searchResults" role="tab"onclick = 'loadSearchResults()'>Search</button>
			  </div>
			</div>
			

		<!-- Search Results -->	
		<div id = 'searchResults' class="tab-pane hidden" role="tabpanel">
			<div class="panel-body"  id = 'patientPrescriptions'>
				<div class="p-b-15 p-l-15 p-r-15">
					<h4 class="p-b-10">&nbsp; Prescription</h4>
					<table  class="table table-hover table-responsive-block"  id = 'resultsTable'>
						<thead align = 'center'>
							<tr>
								<th>
									<h5>Patient NIC</h5>
								</th>
								<th>
									<h5>Patient Name</h5>
								</th>
								<th>
									<h5>Doctor</h5>
								</th>
								<th>
									<h5>Date</h5>
								</th>
								<th>
									<h5>Time</h5>
								</th>
								<th>
									 &nbsp;
								</th>
							</tr>
						</thead>
						<tbody align = 'center' id = 'resultsTableBody'>
						</tbody>
					</table>

				</div>
			</div>
		</div>
		<!-- End of Search Results -->

	</div>
</div>
	





    
<script>
function setHome(){
    document.getElementById('home').style.display='block';
    //document.getElementById('hom').style.display='block';
	document.getElementById('medicalProfile').style.display='none'; 

}

function setPrescriptions(){
    document.getElementById('home').style.display='none';
    //document.getElementById('hom').style.display='block';
	document.getElementById('medicalProfile').style.display='block'; 

}

function loadSearchResults(){
	document.getElementById('resultsTableBody').innerHTML = "";
	//console.log(window.docNIC);
	var query = {
		columns : 'channel.pesc_id AS pesc_id, channel.patient_nic AS patient_nic, channel.patient_name AS patient_name, doctor.name AS doc_name, doctor_schedule.date AS date, doctor_schedule.start_time AS start_time, doctor_schedule.end_time AS end_time',
		table : 'channel JOIN prescription USING (pesc_id) JOIN doctor USING (doc_nic) JOIN doctor_schedule ON (schedule_id = id)',
		condition : ("patient_nic LIKE '%Z"+ document.getElementById('patientNIC').value +"%' AND prescription.status = 'pending'")
	};
	var params = JSON.stringify(query);
	var searchRequest = new XMLHttpRequest();
	
	searchRequest.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
			var pescrpitionResults = JSON.parse(this.responseText);
			var table = document.getElementById('resultsTableBody');
			for (key in pescrpitionResults){
				
				result = pescrpitionResults[key];
				row = table.insertRow();
				row.insertCell().innerText = result['patient_nic'];
				row.insertCell().innerText = result['patient_name'];
				row.insertCell().innerText = result['doc_name'];
				row.insertCell().innerText = result['date'];
				row.insertCell().innerText = result['start_time'] + " - " + result['end_time'];
				row.insertCell().innerHTML = "<form method = 'post' action = 'medical-profile.php'>" +
				"<input type = 'hidden' name = 'prescriptionID' value = '"+ result['pesc_id'] +"'>" + 
				"<input type = 'hidden' name = 'PID' value = '"+ result['patient_nic'] +"'>" + 
				"<input type = 'hidden' name = 'PatientName' value = '"+ result['patient_name'] +"'>" + 
				"<input type = 'hidden' name = 'docName' value = '"+ result['doc_name'] +"'>" + 
				"<input type = 'hidden' name = 'date' value = '"+ result['date'] +"'>" + 
				"<input class = 'btn btn-success' type = 'submit' name = 'submit' value = 'Open'></form>";
				
			}
			
			
		}
		setPrescriptions();
		document.getElementById('searchResults').style.display = "block";
	};
	
	console.log(params);
	searchRequest.open('GET', 'database-search.php?params=' + params, true);
	searchRequest.send();
}
</script>

<?php
/* if(isset($_GET['prescriptionSearch'])){
	include "$_SERVER[DOCUMENT_ROOT]/bins-medical-center/Pages/Public/Database-connect.php";
	$result = $connection -> query("SELECT* FROM channel JOIN prescription USING (pesc_id) WHERE patient_nic = '$_GET[patientNIC]'"
	echo "window.loadSearchResults()";
} */
?>
	
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>