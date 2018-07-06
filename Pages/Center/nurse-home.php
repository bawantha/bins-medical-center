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
		<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#channeling" role="tab" >Channeling</a></li>
		<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#registration" role="tab" onclick = "document.getElementById('channelContainer').classList('hidden');">Patient Registration</a></li>
		<form method = 'post' action = <?php echo $_SERVER['PHP_SELF']; ?> id = 'navForm'></form>
      </ul>
	  	
			<input class="btn btn-info" type = 'submit' style = "float:right;" value = 'Sign Out' name = 'signout' form ='navForm'>
		
		
    </nav>
</div>
<div class="tab-content">
	<!-- Home -->	
	
	<div class="tab-pane active" id="home">
		<p id="Home"> Welcome</p>
		<div id="hom"><img src="g.jpg" width="1000px" height="500px"></div>	  	
	</div>
	
	
	
	<!--Channeling content -->
	<div id="channeling" class="tab-panel" role="tabpanel" aria-expanded = 'false'>
		<div class="jumbotron jumbotron-fluid hidden" id = 'channelContainer'>
			<div class="container col-md-4 text-center ">
				<a class=" btn btn-primary btn-lg btn-outline-primary" data-toggle="modal" data-target="#channelTypeChose" >Channel now</a>
			</div>
			<div id = "SearchResults" class = 'hidden'>
				<div class="panel-body">
					<div class="p-b-15 p-l-15 p-r-15">
						<h4 class="p-b-10">Search Results</h4>
						<table class="table table-hover table-responsive-block" id = 'resultsTable'>
							
							<tbody id = 'tableBody' >
							
							
							</tbody>
						</table>


					</div>

				</div>
			</div>
		  
		  
		  
		  
		  <!--Channeling Modal -->
			<div class="modal fade" id="channelTypeChose" tabindex="-1" role="dialog" aria-labelledby="channelTypeChoseLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="channelTypeChoseLabel">Choose</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" id = 'modalClose'>
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form name = 'chanel form' id = 'chanel form'>
								<div class="form-row">
									<div class="form-group col-md-12">
										<label class="form-lable" for="DoctorName">Doctor name</label>
										<input list = 'doctorName' class="form-control" id="docName" value = "">
											<?php  
												$name = "doctorName";
												include "$_SERVER[DOCUMENT_ROOT]/bins-medical-center/Pages/Public/Database-connect.php";
												$result = $connection -> query("select name from doctor order by name");
												$col_name = "name";
												include "$_SERVER[DOCUMENT_ROOT]/bins-medical-center/Pages/Public/create-datalist.php";
											?>
										<label class="form-lable" for="SpecialtyDescription">Speialization</label>
										<input list = 'specialization' class="form-control" id="specialization" placeholder="">
											<?php  
												$name = "specialization";
												$result = $connection -> query("select distinct specialization from doctor order by specialization");
												$col_name = "specialization";
												include "$_SERVER[DOCUMENT_ROOT]/bins-medical-center/Pages/Public/create-datalist.php";
												$connection -> close();
											?>
										<label class="form-lable" for="Date">Date</label>
										<input type="date" class="form-control" id ="date">
									  
									</div>
								</div>
							</form>
							<div class="modal-footer">
								<p id = 'status'> </p>
								<button class="btn btn-primary" name="chanelSubmit" id = "chanelSubmit" onclick = 'loadSearchResults()'>Search</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--End of Channeling Modal -->
			
			
		</div>
	</div>
		<!--End of Channeling Content -->
		

	  
	  
</div>	  
<script>
function createResult(data){
	return "		<td scope='row' style='width:40%'>" +
		"<div class='row'>" +
			"<div class='col-xs-4' style = 'padding-left : 15px; padding-right : 15px;'>" +
				"<img class='img-circle mini-profile-pic p-t-10' alt='' height = 132 width = 132 src='http://localhost/bins-medical-center/Files/doctor/"+ data['doc_nic'] +"/"+ data['doc_nic'] +" - icon.jpg' onerror = 'alternateImage(this); this.onerror = false;'>" +

			"</div>" +
			"<div class='col-xs-8'>" +
				"<h5 class='semi-bold'>"+ data['name'] +"</h5>" +

				"<p class='no-margin specialization'>"+ data['specialization'] +"</p>" +
			"</div>" +
		"</div>" +
	"</td>" +
	"<td class='v-align-middle'>" +
		"<form method='get' action = 'doctor-channel-details.php'>" +
			"<input type='hidden' name='docNIC' value='"+ data['doc_nic'] +"'>" +
			"<input type='submit' class='btn btn-danger btn-m' value='Book Now'>" +
		"</form>" +
	"</td>";
}

function loadSearchResults(){

	var docName = document.getElementById('docName').value;
	var specialization = document.getElementById('specialization').value;
	var date = document.getElementById('date').value;

	var query1 = {
		columns : 'DISTINCT name, specialization, doctor.doc_nic', 
		table : 'doctor JOIN doctor_schedule USING (doc_nic)', 
		condition : ("name LIKE '%Z"+ docName +"%' AND specialization LIKE '%Z"+ specialization +"%' AND date LIKE '%Z"+ date +"%'")
	};
	var params = JSON.stringify(query1);
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {

		var result = JSON.parse(this.responseText);
		var text = "";
		var total = result.length;
		var count = 1;
		
		for (row in result){

			var odd = (count % 2) != 0;
			if (odd){
				text += "<tr>";
			}
			
			text +=  createResult(result[row]);
			
			if (!odd || count++ == total){
				text+= "</tr>";
			}
		}
		
		document.getElementById('tableBody').innerHTML = text;		
		document.getElementById('SearchResults').style.display = 'block';
		document.getElementById('modalClose').click();
		//$('#channelTypeChose').modal('hide');
		
		
	}			
	};
	
	xmlhttp.open('GET', 'database-search.php?params=' + params, true);
	xmlhttp.send();
}

function alternateImage(image){
	image.src = 'noavatar.png';
	
}
</script>	



    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>