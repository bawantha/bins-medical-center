<!DOCTYPE html>
<?php
session_start();
$doc_nic = "";
if (empty($_SESSION['nic']) and empty($_SESSION['user_type'])){
	header("Location: index.php");
} else {
	$doc_nic = $_SESSION['nic'];
	echo "<script> window.docNIC = '$doc_nic'; </script>";
}

if(isset($_POST['signout'])){
	$_SESSION['nic'] = $_SESSION['user_type'] = null;
	header("Location: index.php");
}
include "$_SERVER[DOCUMENT_ROOT]/bins-medical-center/Pages/Public/Database-connect.php";

$doctor_result = $connection -> query("SELECT* FROM doctor WHERE doc_nic = '$_SESSION[nic]'");
$doctor_row = $doctor_result -> fetch_assoc();
$doctor_fee = $doctor_row['fee'];
echo "<script> window.docFee = parseInt($doctor_fee); </script>";


$connection -> close();
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


<div>
    <nav class="navbar bg-info navbar-light  " id="navbar-example"  >
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item "><a class="nav-link " href="#Home" onclick="setHome()">Home</a></li>
		<form method = 'post' action = <?php echo $_SERVER['PHP_SELF']; ?> id = 'navForm' style = "float:right;">
		</form>
		<li class="nav-item"><a class="nav-link " href="#Schedule" onclick="loadSchedule()">Schedule</a></li>
        <li class="nav-item"><a class="nav-link " href="#Channels" onclick="loadChannels()">Channeling Appointments</a></li>
      </ul>
		<input class="btn btn-info" type = 'submit' style = "float:right;" value = 'Sign Out' name = 'signout' form ='navForm'>
    </nav>
</div>

<p id="Home" > Welcome Dr.<?php echo " ".$doctor_row['name']; ?>!</p>

<div id="hom">
	<img src="http://localhost/bins-medical-center/Images/g.jpg" width="1000px" height="500px"   >
</div>

<div id="Schedule" class="hidden">
    
	<div class="panel-body" id = 'scheduleTable'>
        <div class="p-b-15 p-l-15 p-r-15">
            <h4 class="p-b-10">&nbsp; prescription</h4>
            <table  class="table table-hover table-responsive-block"  id = 'sTable'>
                <thead align = 'center'>
				<tr>
					<th>
                        <h5>Date</h5>
                    </th>
                    <th>
                        <h5>Start Time</h5>
                    </th>
                    <th>
                        <h5>End Time</h5>
                    </th>
                    <th>
                        <h5>No of Channels</h5>
                    </th>
					<th>
                        <h5>Status</h5>
                    </th>
                    <th>
                         &nbsp;
                    </th>
				</tr>
				</thead>
                <tbody align = 'center' id = "scheduleTableBody" >
                
				</tbody>
			</table>
			&nbsp;<button class  = "btn btn-link"  href = '#' id = 'addRow' onclick = "showModal('scheduleModal')"> + Add date </button>

        </div>
    </div>
	
	
	<!--Schedule Modal-->
	<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="channelTypeChoseLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"> Add schedule</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" id = 'sModalClose'>
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label class="form-lable" for="date">Date</label>
								<input type= 'date' class="form-control" id="date" min = '<?php echo date('Y-m-d'); ?>' >
								
								<label class="form-lable" for="startTime">Start time</label>
								<input type= 'time' class="form-control" id="startTime" placeholder="">
								
								<label class="form-lable" for="endTime">End time</label>
								<input type= 'time' class="form-control" id="endTime" placeholder="">
								
							</div>
						</div>
					</form>
					<div class="modal-footer">
						<p id = 'status'> </p>
						<button class="btn btn-primary" id = "add" onclick = 'addScheduleRow()'>Add</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<!--End of Schedule Modal-->
	
	
</div>


<div id = 'Report' class = 'hidden'>

	<form method = 'post' action = <?php echo $_SERVER['PHP_SELF']; ?> id = 'reportForm'>
		<input type = 'hidden' id = 'prescriptionID' name = 'prescriptionID' value = ''>
		<input type = 'hidden' id = 'listID' name = 'listID' value = ''>
		<input type = 'hidden' id = 'reportChannelID' name = 'reportChannelID' value = ''>
	</form>


		<!--Drug Modal-->
	<div class="modal fade" id="prescriptionModal" tabindex="-1" role="dialog" aria-labelledby="channelTypeChoseLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"> Add drug</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" id = 'drugModalClose'>
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label class="form-lable" for="drugName">Drug</label>
								<select name= 'DrugName' class="form-control" id="drugName" size = 10>
									<?php  
										$name = "DrugName";
										include "$_SERVER[DOCUMENT_ROOT]/bins-medical-center/Pages/Public/Database-connect.php";
										$col_name = "name";
										$result = $connection -> query("SELECT drug_id, name, unit_price FROM drug ORDER BY name");
										$id = 'drug_id';
										$value = 'unit_price';
										include 'create-dropdown-list.php';
										$connection -> close();
									?>
								</select>
								<label class="form-lable" for="dosage">Dosage</label>
								<input type= 'text' class="form-control" id="dosage" placeholder="">
								
								<label class="form-lable" for="quantity">Quantity</label>
								<input type= 'number' class="form-control" id ="quantity">
							  
							</div>
						</div>
					</form>
					<div class="modal-footer">
						<p id = 'status'> </p>
						<button class="btn btn-primary" id = "add" onclick = 'addPrescriptionRow()'>Add</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
	
	<!--End of Drug Modal-->
	


<h4 class="p-b-10">&nbsp; <?php echo "$_POST[patientName]"; ?> Report</h4>
<button class = 'btn btn-warning btn-lg' style = 'float:right' onclick = "saveReport()"> Finish Processing </button>
	<br>
	&nbsp;<button class  = "btn btn-primary btn-md" id = 'addprescription' onclick = 'createPrescription(this)'> + Add prescription </button>
	
	<!-- Prescription table -->
	<div class="panel-body" style = "display: none" id = 'prescriptionTable'>
        <div class="p-b-15 p-l-15 p-r-15">
            <h4 class="p-b-10">&nbsp; Prescription</h4>
            <table  class="table table-hover table-responsive-block"  id = 'pTable'>
                <thead align = 'center'>
				<tr>
					<th>
                        <h5>ID</h5>
                    </th>
                    <th>
                        <h5>Drug</h5>
                    </th>
                    <th>
                        <h5>Dosage</h5>
                    </th>
                    <th>
                        <h5>Quantity</h5>
                    </th>
					<th>
                        <h5>Price</h5>
                    </th>
                    <th>
                         &nbsp;
                    </th>
				</tr>
				</thead>
                <tbody align = 'center' id = 'prescriptionTableBody'>
                
				</tbody>
			</table>
			&nbsp;<button class  = "btn btn-link"  href = '#' id = 'addRow' onclick = "showModal('prescriptionModal')"> + Add row </button>

        </div>
    </div>
	<!-- End of Prescription table -->
	
	
		<!--Instrument Modal-->
	<div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="channelTypeChoseLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"> Add instrument</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" id = 'modalClose'>
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label class="form-lable" for="instrumentName">Instrument</label>
								<select name= 'InstrumentName' class="form-control" id="instrumentName" size = 10>
									<?php  
										$name = "InstrumentName";
										include "$_SERVER[DOCUMENT_ROOT]/bins-medical-center/Pages/Public/Database-connect.php";
										$col_name = "name";
										$result = $connection -> query("SELECT ins_id, name FROM instrument WHERE type = 'consumable' ORDER BY name");
										$id = 'ins_id';
										$value = '';
										include 'create-dropdown-list.php';
										$connection -> close();
									?>
								</select>
								
								<label class="form-lable" for="quantity">Quantity</label>
								<input type= 'number' class="form-control" id ="instrumentQuantity">
							  
							</div>
						</div>
					</form>
					<div class="modal-footer">
						<p id = 'status'> </p>
						<button class="btn btn-primary" id = "add" onclick = 'addListRow()'>Add</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!--End of Instrument Modal-->
	
	
	<br>
	<br>
	&nbsp;<button class  = "btn btn-primary btn-md" id = 'addList' onclick = 'createList(this)'> + Add Instrument List </button>
	
	
	<!-- Instrument table -->
	<div class="panel-body" style = "display: none" id = 'listTable'>
        <div class="p-b-15 p-l-15 p-r-15">
            <h4 class="p-b-10">&nbsp; Instruments</h4>
            <table class="table table-hover table-responsive-block" id = 'lTable'>
                <thead align = 'center'>
				<tr>
                    <th>
                        <h5>ID</h5>
                    </th>
                    <th>
                        <h5>Instrument</h5>
                    </th>
                    <th>
                        <h5>Quantity</h5>
                    </th>
                    <th>
                         &nbsp;
                    </th>
				</tr>
				</thead>
				
                <tbody align = 'center' id = 'listTableBody'>
				
				</tbody>
				

			</table>
			&nbsp; <button class  = "btn btn-link"  href = '#' id = 'addRow' onclick = 'showModal("listModal")'> + Add row </button>
        </div>
    </div>
	
	<!-- End of Instrument table -->
	
	<br><br>
	<div class = 'container' style = 'margin-left : 50px'>
		<label for="comment">Comment:</label>
		<textarea class="form-control" rows="5" id="comment" form = 'reportForm' style = 'width: 50%'></textarea>
	</div>
</div>
	
	

<div id='Channels' class='hidden'>


</div>
	
	




<script >

function saveReport() {

	var xmlRequest = new XMLHttpRequest();
	
	xmlRequest.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			
			console.log(this.responseText);
			alert(this.responseText);
			
		}			
	};
	
	var query = {columns : '', table : '', values : ""};
	var prescriptionID = document.getElementById('prescriptionID').value;
	var listID = document.getElementById('listID').value;
	var channelID = document.getElementById('reportChannelID').value;
	var date = createDate(true);
	
	if (prescriptionID != ''){
		
		//Creating prescription
		query.table = 'prescription';
		query.values = "'"+ prescriptionID +"', '"+ date +"', 'NULL', 'pending'";
		var params = JSON.stringify(query);

		xmlRequest.open('POST', 'database-insert.php', false);
		xmlRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlRequest.send('params=' + params);
		//-------
		
		//Assign prescription to channel
		var query1 = {
			set : "pesc_id = '"+ prescriptionID +"'", 
			table : 'channel', 
			condition : "channel_id = '"+ channelID +"'"
		};
		params = JSON.stringify(query1);

		xmlRequest.open('POST', 'database-update.php', false);
		xmlRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlRequest.send('params=' + params);
		//-------
		
		//Adding drugs to prescription
		var prescriptionTable = document.getElementById('prescriptionTableBody');
		var price = 0;
		for (var i = 0, row; row = prescriptionTable.rows[i]; i++){
			var rowCells = row.cells;
			
			price += parseInt(rowCells[4].innerText);
			console.log(rowCells[0].innerText + rowCells[1].innerText+ rowCells[2].innerText + rowCells[3].innerText);
			query.table = "`prescription-drug`";
			query.values = "'"+ prescriptionID +"','"+ rowCells[0].innerText +"','"+ rowCells[2].innerText +"','"+ rowCells[3].innerText +"', 'pending'";
			params = JSON.stringify(query);
						console.log(params);
			xmlRequest.open('POST', 'database-insert.php', false);
			xmlRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

			xmlRequest.send('params=' + params);
		}
		//--------
		
		//Updating pescrition price
		var query1 = {set : "price = '"+ price +"'", table : 'prescription', condition : "pesc_id = '"+ prescriptionID +"'"};
		params = JSON.stringify(query1);
					console.log(params);
		xmlRequest.open('POST', 'database-update.php', false);
		xmlRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlRequest.send('params=' + params);
		//--------
	}
	
	
	
	if (listID !== ''){
		//Creating list
		query.table = 'instrument_list';
		query.values = "'"+ listID +"', '"+ date +"'";
		var params = JSON.stringify(query);

		xmlRequest.open('POST', 'database-insert.php', false);
		xmlRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlRequest.send('params=' + params);
		//-------
		
		//Assign list to channel
		var query1 = {
			set : "list_id = '"+ listID +"'", 
			table : 'channel', 
			condition : "channel_id = '"+ channelID +"'"
		};
		params = JSON.stringify(query1);

		xmlRequest.open('POST', 'database-update.php', false);
		xmlRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlRequest.send('params=' + params);
		//-------
		
		var listTable = document.getElementById('listTableBody');

		for (var i = 0, row; row = listTable.rows[i]; i++){
			var rowCells = row.cells;
			query.table = "`instrument_list-instrument`	";
			query.values = "'"+ listID +"','"+ rowCells[0].innerText +"','"+ rowCells[2].innerText +"'";
			var params1 = JSON.stringify(query);
			
			xmlRequest.open('POST', 'database-insert.php', false);
			xmlRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			console.log(params1);
			xmlRequest.send('params=' + params1);
		}
	}
	
	//Update channel as processed
	var query1 = {
		set : "comment = '"+ document.getElementById('comment').value +"', status = 'processed'", 
		table : 'channel', 
		condition : "channel_id = '"+ channelID +"'"
	};
	params = JSON.stringify(query1);

	xmlRequest.open('POST', 'database-update.php', false);
	xmlRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlRequest.send('params=' + params);
	//-------
	
	loadChannels();
}

function createDate(status = false){
	var date = new Date();
	var yyyy = date.getFullYear();
	var MM = date.getMonth() + 1;
	var dd = date.getDate();
	var hh = date.getHours();
	var mm = date.getMinutes();
	var ss = date.getSeconds();
	
	if(dd < 10){
		dd = '0' + dd;
	} 
	if(MM < 10){
		MM = '0' + MM;
	} 
	
	return status? "" + yyyy + "-" + MM + "-" + dd : "" + yyyy + MM + dd + hh + mm + ss;
}

function createResult(data){
	var returnText = "<td style='width:20%'>" +
							"<p class='no-margin bold'>" +data['patient_name']+ "</p>" +
							
							"<p class='no-margin bold'></p>" +
							
						"</td>" +
						
						"<td class='p-b-20'>" +
							
							"<p class='no-margin'>" +
								data['call_num']+ 
							"</p>" +
						"</td>" +
						
						"<td>" +
							"<p class='no-margin'>" +
								
								data['status']+ "</p>" + "</td>";
						
						
	var button1 = "", button2 = "";
	var state = data['status'];
	if (state == "pending"){
		button1 =  "<input class='btn btn-success btn-m' type='submit' value='Create Report' name = 'createReport'>";
		//button1 =  "<button class='btn btn-success btn-m' id = '"+ data['channel_id'] +"' name = 'createReport' onclick = 'createReport(this.id)'> Create Report </button>";							
		//button2 = "<button class='btn btn-danger btn-m' id = '"+ data['channel_id'] +"Process'> Process </button>";
	} else if (state == "processed"){
		button1 =  "<input class='btn btn-muted btn-m' type='button' value='Processed' name = 'processed' disabled>";
		//button2 = "<button class='btn btn-muted btn-m' id = '"+ data['channel_id'] +"Process' disabled> Processed </button>";
	}
	
	returnText += "<td>" +
		"<form method='post'>" +
			"<input type='hidden' value='" +data['channel_id']+ "' name = 'channelID'>" +
			"<input type='hidden' value='" +data['patient_name']+ "' name = 'patientName'>" +
			button1 +
		"</form>" +

	"</td> <td> " + button2 + " </td>";
	return returnText;
}

function loadSchedule(){
	document.getElementById('scheduleTableBody').innerHTML = "";
	var text = "";
	//console.log(window.docNIC);
	var query = {
		columns : '*', 
		table : 'doctor_schedule', 
		condition : ("doc_nic  = '"+ window.docNIC +"' AND status != 'Unavailable'")
	};
	var params = JSON.stringify(query);
	var schedulesRequest = new XMLHttpRequest();
	
	schedulesRequest.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
			var scheduleResult = JSON.parse(this.responseText);
			var tableBody = document.getElementById('scheduleTableBody');
			for (key in scheduleResult){
				var result = scheduleResult[key];
				
				var button = document.createElement("BUTTON");
				button.innerText = 'Remove date';
				button.id = result['pesc_id'];
				button.classList.add('btn');
				button.classList.add('btn-danger');
				button.classList.add('btn-xs');
				button.addEventListener('click', function(){
 
					xmlRequest = new XMLHttpRequest();
					xmlRequest.onreadystatechange = function(){
						if (this.readyState == 4 && this.status == 200) {
							console.log(this.responseText);
						}	
					}
					var query = {
						table : 'doctor_schedule',
						condition : "pesc_id = '"+ this.id +"'"
					};
					var params = JSON.stringify(query);
					
					xmlRequest.open('POST', 'database-delete.php', false);
					xmlRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xmlRequest.send('params=' + params);
					
					delete xmlRequest;
					removeRow(this);
					
				});
				
				row = tableBody.insertRow();
				row.insertCell().innerText = result['date'];
				row.insertCell().innerText = result['start_time'];
				row.insertCell().innerText = result['end_time'];
				row.insertCell().innerText = result['no_of_channels'];
				row.insertCell().innerText = result['status'];
				row.insertCell().appendChild(button);
				
			}
			
			
		}			
	};
	
	schedulesRequest.open('POST', 'database-search.php', true);
	schedulesRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	schedulesRequest.send('params=' + params);
	
	setSchedule();	

}

function loadChannels(){
	document.getElementById('Channels').innerHTML = "";
	var text = "";
	console.log(window.docNIC);
	var query1 = {columns : '*', table : 'doctor_schedule', condition : ("doc_nic  = '"+ window.docNIC +"'")};
	var params = JSON.stringify(query1);
	var schedulesRequest = new XMLHttpRequest();
	var channelsRequest = new XMLHttpRequest();
	
	channelsRequest.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			//console.log(this.responseText);
			var channelsResult = JSON.parse(this.responseText);
			
			for (channelRow in channelsResult){
				
				text += "<tr>";
				
				text +=  createResult(channelsResult[channelRow]);
				
				text+= "</tr>";
			}
			
			
		}			
	};


	schedulesRequest.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			//console.log(this.responseText);
			var scheduleResult = JSON.parse(this.responseText);
			//var text = "";

			for (row in scheduleResult){
				var rowResult = scheduleResult[row];
				text += "<div class='panel-body'> " +
							"<div class='p-b-15 p-l-15 p-r-15'>" +
								"<h4 class='p-b-10'>&nbsp; <kbd>" + rowResult['date'] + ":</kbd>&nbsp;" + rowResult['start_time'] + " - " + rowResult['end_time'] + "</h4>" +
									"<table class='table table-hover table-responsive-block'>" +
										"<tbody align = 'center'>" +
											"<tr>" +
												"<th>" +
													"<h5>Patient Name</h5>" +
												"</th>" +
												"<th>" +
													"<h5>Number</h5>" +
												"</th>" +
												"<th>" +
													"<h5>Status</h5>" +
												"</th>" +
												"<th>" +
													 "&nbsp;" +
												"</th>" +
												//"<th>" +
												//	 "&nbsp;" +
												//"</th>" +
											"</tr>";
											
				query1.table = 'channel';
				query1.condition = "schedule_id  = '"+ rowResult['id'] +"'";
				params = JSON.stringify(query1);
				
				channelsRequest.open('POST', 'database-search.php', false);
				channelsRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				channelsRequest.send('params=' + params);
				text += "</tbody> </table> </div> </div>";
				
			}
			

			document.getElementById('Channels').innerHTML += text;		
			setChanneling();
			//document.getElementById('modalClose').click();
			
			
		}			
	};
	

	schedulesRequest.open('POST', 'database-search.php', true);
	schedulesRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//console.log(params);
	schedulesRequest.send('params=' + params);
}

function setChanneling(){
	document.getElementById('Channels').style.display='block';
    document.getElementById('Home').style.display='none';
    document.getElementById('hom').style.display='none';
	document.getElementById('Schedule').style.display='none'; 
	document.getElementById('Report').style.display='none';
	document.getElementById('Report').style.display='none';

}

function setSchedule(){
	document.getElementById('Schedule').style.display='block';
    document.getElementById('Home').style.display='none';
    document.getElementById('hom').style.display='none';
	document.getElementById('Channels').style.display='none'; 
	document.getElementById('Report').style.display='none';

}

function setHome(){
	document.getElementById('Schedule').style.display='none';
    document.getElementById('Home').style.display='block';
    document.getElementById('hom').style.display='block';
	document.getElementById('Channels').style.display='none'; 
	document.getElementById('Report').style.display='none';

}

function createReport(channelID){
	document.getElementById('Schedule').style.display='none';
    document.getElementById('Home').style.display='none';
    document.getElementById('hom').style.display='none';
	document.getElementById('Channels').style.display='none'; 
	document.getElementById('Report').style.display='block';
	
	document.getElementById('reportChannelID').value = channelID;
}

function createPrescription(button){
	button.style.display = 'none';
	
	document.getElementById('prescriptionID').value = createDate();
	document.getElementById('prescriptionTable').style.display='block';
}

function createList(button){
	button.style.display = 'none';
	document.getElementById('listID').value = createDate();
	document.getElementById('listTable').style.display='block';

}

function showModal(modalID){
	$('#' + modalID).modal('show');
		console.log(modalID);
}

function addScheduleRow(){
	var date = document.getElementById('date').value;
	var startTime = document.getElementById('startTime').value;
	var endTime = document.getElementById('endTime').value;
	
	var insertRequest = new XMLHttpRequest();
	insertRequest.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
			alert(this.responseText);
			console.log(this.responseText);
			loadSchedule();
		} else {
			console.log(this.statusText + " " + this.responseText);
		}
	};
	
	var query = {
		columns : '', 
		table : 'doctor_schedule', 
		values : "'"+ createDate() +"', '"+ window.docNIC +"', '"+ date +"', '"+ startTime +"', '"+ endTime +"', '0', 'Available'"
	};
	var params = JSON.stringify(query);
	
	insertRequest.open('POST', 'database-insert.php', true);
	insertRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	insertRequest.send('params=' + params);
	
	document.getElementById('sModalClose').click();

}

function addPrescriptionRow(){
	var dropDown = document.getElementById('drugName');
	var drug = dropDown.options[dropDown.selectedIndex].text;
	var dosage = document.getElementById('dosage').value;
	var quantity = document.getElementById('quantity').value;
	
	var button = document.createElement("BUTTON");
	button.classList.add('btn');
	button.classList.add('btn-danger');
	button.classList.add('btn-xs');
	button.addEventListener('click', function(){ removeRow(this); });
	
	button.innerHTML = 'Remove Row';
	var row = document.getElementById('prescriptionTableBody').insertRow();
	
	row.insertCell().innerText = dropDown.options[dropDown.selectedIndex].id;
	row.insertCell().innerText = drug;
	row.insertCell().innerText = dosage;
	row.insertCell().innerText = quantity;
	row.insertCell().innerText = parseInt(dropDown.options[dropDown.selectedIndex].value) * parseInt(quantity);
	row.insertCell().appendChild(button);
		
}

function addListRow(){
	var dropDown = document.getElementById('instrumentName');
	var instrument = dropDown.options[dropDown.selectedIndex].text;
	var quantity = document.getElementById('instrumentQuantity').value;
	
	var button = document.createElement("BUTTON");
	button.classList.add('btn');
	button.classList.add('btn-danger');
	button.classList.add('btn-xs');
	button.addEventListener('click', function(){ removeRow(this); });
	
	button.innerHTML = 'Remove Row';
	var row = document.getElementById('listTableBody').insertRow();
	
	row.insertCell().innerText = dropDown.options[dropDown.selectedIndex].id;
	row.insertCell().innerText = instrument;
	row.insertCell().innerText = quantity;
	row.insertCell().appendChild(button);
}

function removeRow(button){
	var row =  button.parentNode.parentNode;
	var table = row.parentNode.parentNode;
	table.deleteRow(row.rowIndex);
}
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<?php

if (isset($_POST['createReport'])){
	echo "<script>
	window.createReport($_POST[channelID]);
	</script>";
}


?>