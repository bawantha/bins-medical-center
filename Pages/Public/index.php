<!doctype html>
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
			
			<li class="nav-item"><a class="nav-link " href="#Home" onclick="homeFunctionhomeFunction()">Home</a></li>
			<li class="nav-item"><a class="nav-link " href="#About Us" onclick="AboutUsFunction()">About Us</a></li>
			<li class="nav-item "><a class="nav-link " href="#Channeling" onclick="channelingFunction()">Channeling</a></li>
			<li class="nav-item "><a class="nav-link " href="#Staff Registation" onclick="StaffRegistationFunction()">Staff Registation</a></li>
		  </ul>
		</nav>
	</div>

	<p id="Home"> Welcome</p>
	
	<div id="hom">
	<img src="http://localhost/bins-medical-center/Images/g.jpg" width="1000px" height="500px"   >
	</div>
	  
	  
	<div id="About Us" class="hidden">
		<div id="AboutUsFull">
			<p class="AU"><STRONG>CEOs Message</STRONG></p>
			<div class="AUsub">
				<p>Providing access to the State-of-Art diagnostic and treatment technologies is a hallmark of Nawaloka Hospital. Driven by our Vision to be the Hospital of Tomorrow we give precedence to superior care, accuracy, and excellence in all we do.</p>

				<p>Among the many healthy choices one can make in life, I sincerely believe Nawaloka Hospital to be a supremely healthy choice - from many perspectives. To the customer, we are a provider of the finest health care available in Sri Lanka today.</p>

				<p>Our State-of-the Art technology, medical systems and procedures, skilled professionals and years of experience in the field equate to a top tier health care provider. Within the health sector too Nawaloka;s stature makes it a healthy choice amongst consultants and other professionals, who have no qualms in selecting Nawaloka as a fitting entity through which they serve the public.</p>

				<p>Our consultants enjoy national repute as being among the most experienced practitioners in their fields. Together, we take great pride in the quality of the care we provide and in the integrity of our institution</p>
			</div>
			<p class="AU"><STRONG>BINS Hospital</STRONG></p>
			
		<div class="AUsub">
			<p>The entry of Nawaloka Hospitals into the state dominated healthcare sector in 1985, saw the private health care system take root in Sri Lanka. The launch of the hospital and the overwhelming response it received from the people demonstrated a long felt need for superior healthcare in a pleasant environment.</p>
			<p>Nawaloka was set up to mirror reputed hospitals in the region which offered advanced medical technology and expert medical care, thus eliminating the need for people to travel out of Sri Lanka for specialized medical treatment.</p>

			<p>The Hospital was a pioneering initiative, established under the Chairmanship of Late Deshamanya H. K. Dharmadasa, to be a centre of excellence in high technology diagnostic and curative facilities. Driven by the Vision to be the Hospital of Tomorrow, the medical institution has come to be known as a centre of excellence and a preferred healthcare institution in the country.</p>
		</div>
		</div>
	</div>
		  
	<div id="channaling" class="hidden">
		<div class="jumbotron jumbotron-fluid">
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
		  
		  
		  
		  
		  <!-- Modal -->
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
										<input list = 'doctorName' class="form-control" id="docName" value = "" onchange="onChangeText(this.id)">
											<!-- <?php  
												$name = "doctorName";
												include 'Database-connect.php';
												$result = $connection -> query("SELECT `name` FROM `doctor` ORDER BY `name`");
												$col_name = "name";
												include 'create-datalist.php';
											?> -->

										<label class="form-lable" for="SpecialtyDescription">Speialization</label>
										<input list = 'specialization' class="form-control" id="specialization" placeholder="">
											<?php  
												$name = "specialization";
												$result = $connection -> query("SELECT  `specialization` FROM `doctor` ORDER BY `specialization`");
												$col_name = "specialization";
												include 'create-datalist.php';

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



		  <div class="modal fade" id="diseaseModal" tabindex="-1" role="dialog" aria-labelledby="diseaseModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			  <div class="modal-content">
				<div class="modal-header">
				  <h5 class="modal-title" id="diseaseModalLabel1">Choose</h5>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  <button type="button" class="btn btn-primary">Save changes</button>
				</div>
			  </div>
			</div>
		  </div>








			</div>
		</div>
	</div>		   
	 <div id="Staff Registation" class="hidden"> <br> <div class="container col-md-4 text-center ">
		  <a class=" btn btn-primary btn-lg btn-outline-primary" href = "Doctor-application.php" >Doctor Application</a> </div>
		  <div class="container col-md-4 text-center "> <br>
		  <a class=" btn btn-primary btn-lg btn-outline-primary" href = "Staff-application.php" >Staff Application</a> </div>
		  
	</div>


 
	
	
<script type="text/javascript">

	function createResult(data){
		return "		<td scope='row' style='width:40%'>" +
			"<div class='row'>" +
				"<div class='col-xs-4' style = 'padding-left : 15px; padding-right : 15px;'>" +
					"<img class='img-circle mini-profile-pic p-t-10' alt='' height = 132 width = 132 src='http://localhost/bins-medical-center/Files/doctor/"+ data['doc_nic'] +"/"+ data['doc_nic'] +" - icon.jpg' onerror = 'alternateImage(this);'>" +

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
function onChangeText(id){
	if(id=="docName"){
		if(document.getElementById("docName").value!=0){
		document.getElementById("specialization").disabled=true;
	}else{
		document.getElementById("specialization").disabled=false;
		
	}
	}if(id=="specialization"){
		if(document.getElementById("specialization").value!=0){
		document.getElementById("docName").disabled=true;
	}else{
		document.getElementById("docName").disabled=false;
		
	}
}
}

	function loadSearchResults(){

		var docName = document.getElementById('docName').value;
		var specialization = document.getElementById('specialization').value;
		var date = document.getElementById('date').value;

		var query1 = {columns : 'DISTINCT name, specialization, doctor.doc_nic', table : 'doctor JOIN doctor_schedule USING (doc_nic)', condition : ("name LIKE '%Z"+ docName +"%' AND specialization LIKE '%Z"+ specialization +"%' AND date LIKE '%Z"+ date +"%'")};
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
		  
	function homeFunction() {
		document.getElementById('About Us').style.display='none';
		document.getElementById('channaling').style.display='none';
		document.getElementById('Home').style.display='block';
		document.getElementById('hom').style.display='block';
		document.getElementById('Staff Registation').style.display='none';
	}
	function AboutUsFunction() {
		document.getElementById('About Us').style.display='block';
		document.getElementById('Home').style.display='none';
		document.getElementById('hom').style.display='none';
		document.getElementById('channaling').style.display='none';
		document.getElementById('Staff Registation').style.display='none';
	}
	function  channelingFunction() {
		document.getElementById('Home').style.display='none';
		document.getElementById('hom').style.display='none';
		document.getElementById('About Us').style.display='none';
		document.getElementById('channaling').style.display='block';
		document.getElementById('Staff Registation').style.display='none';
	}

	function StaffRegistationFunction() {
		document.getElementById('Home').style.display='none';
		document.getElementById('hom').style.display='none';
		document.getElementById('About Us').style.display='none';
		document.getElementById('channaling').style.display='none';
		document.getElementById('Staff Registation').style.display='block';
	}

	function alternateImage(image){
		image.src = 'noavatar.png';
	}


	//homeFunction();
	</script>


		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	 <!--   <img src="g.jpg" width="1000px" height="500px" style="margin-top: 150px" >
		<div class="jumble">
		  <p id="aaa">Well come!</p>

		</div> -->
		
  </body>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>
