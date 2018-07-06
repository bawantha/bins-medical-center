<!DOCTYPE html>
<?php
$prescription_id = "";

if(isset($_POST['prescriptionID'])){
	$prescription_id = $_POST['prescriptionID'];
	echo "<script> window.prescriptionID = '$prescription_id'; </script>";
} else {
	header("Location: pharmacist-home.php");
}

include "$_SERVER[DOCUMENT_ROOT]/bins-medical-center/Pages/Public/Database-connect.php";

$pesc_result = $connection -> query("SELECT* FROM `prescription-drug` JOIN drug USING (drug_id) WHERE pesc_id = '$prescription_id'");
//$pesc_row = $pesc_result -> fetch_assoc();
//echo $pesc_result;
$connection -> close();
?>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<title>medical profile </title>
	
	<style>
		.prescription{
		
		width : 750px;
		height : 290px;
		margin : 10px;
		border : 2px solid gray;
		border-radius : 15px;
		overflow: scroll;
		
		}
		html, body {
			height: 100%;
			border : 1px solid gray;
			border-radius : 10px;
		}

		html {
			display: table;
			margin: auto;
		}

		body {
			display: table-cell;
			
		}
		.hidden{

		  display: none;
		}
	</style>
  </head>
  <body>
	<div>
		<h3 align = "center" style="background-color: #99ccff ; border-top-left-radius: 10px ; border-top-right-radius: 10px" >Medical Profile</h3>
		
		<table align = "center">
			<tr>
				<td>NIC :</td>
				<td></td>
				<td><?php echo $_POST['PID']; ?></td>
			</tr>			
			<tr>
				<td>Name :</td>
				<td></td>
				<td><?php echo $_POST['PatientName']; ?></td>
			</tr>
			

		</table>
		
		<hr style = "height: 1px ; background-color: gray"/>
		<h5 align = "center"> Prescription </h5>
		
		
		<div class = "prescription">
			<div>
				<table>
				
					<tr>
						<td> Consulted By </td>
						<td width = "50px">:</td>
						<td> Dr. <?php echo $_POST['docName']; ?> </td>	
					</tr>
					<tr>
						<td> Consulted On </td>
						<td>:</td>
						<td> <?php echo $_POST['date']; ?></td>	
					</tr>		
					
				</table>
			</div>
			<br/>
			<div>	
				<table width = "100%" id = 'table'>
					<tr>
						<th></th>
						<th min-width = "25%">Drugs</th>
						<th width = "25%">Dosage</th>
						<th width = "25%">Quantity</th>
						<th width = "25%">Price</th>
						
					</tr>
					<?php
					
					while($pesc_row = $pesc_result -> fetch_assoc()){
						$drug_name = $pesc_row['name'];
						$dosage = $pesc_row['dosage'];
						$quantity = $pesc_row['quantity'];
						$price = ((int) $pesc_row['unit_price'])*((int) $quantity);
						
						echo "
						<tr>
							<td>
								<div class='form-check'>
								  <label class='form-check-label'>
									<input class='form-check-input' type='checkbox' onchange = 'addPrice(this)' id = '$pesc_row[drug_id]' ' value='$price' aria-label='...'>
								  </label>
								</div>						
							</td>
							<td>$drug_name</td>
							<td>$dosage</td>
							<td>$quantity</td>
							<td>$price</td>
							
						</tr>";
						
					}
					?>
				</table>
			</div>
		</div>
		 Total:&nbsp; <label id = 'total' for ='total'>0 </label>
		<br />
		<button type="submit" class="btn btn-primary" style = "cursor:pointer ; margin : 10px" >Back</button>
		<div style = "float:right">
			<button onclick = 'processPrescription()' class="btn btn-primary" style = "cursor:pointer ; margin : 10px " >Process</button>
		</div>
	</div>	
 
<script>

function processPrescription(){
	
	var xmlRequest = new XMLHttpRequest();
	
	xmlRequest.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			
			console.log(this.responseText);
			
		}			
	};
	
	//Updating drugs in prescription
	var table = document.getElementById('table');
	var query = {set :'', table : '', condition : ''};
	
	for (var i = 1, row; row = table.rows[i]; i++){
		var rowCells = row.cells;
		var checkbox = rowCells[0].firstElementChild .firstElementChild.firstElementChild ;
		console.log(checkbox.innerHTML);
		if (!checkbox.checked){
			console.log('skipped');
			continue;
		}
		
		query.set = "status = 'processed'";
		query.table = "`prescription-drug`";
		query.condition = "pesc_id = '"+ window.prescriptionID +"' AND drug_id = '"+ checkbox.getAttribute('id') +"'";
		
		var params = JSON.stringify(query);
		console.log(params);
		xmlRequest.open('POST', 'database-update.php', false);
		xmlRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		xmlRequest.send('params=' + params);
	}
	//--------
	
	//set prescription to processed
	query.set = "status = 'processed', price = '"+ document.getElementById('total').innerHTML +"'";
	query.table = "prescription";
	query.condition = "pesc_id = '"+ window.prescriptionID+"'";
	var params = JSON.stringify(query);
	
	xmlRequest.open('POST', 'database-update.php', false);
	xmlRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlRequest.send('params=' + params);
	//--------
	
	window.location.assign('pharmacist-home.php');

}

function addPrice(checkbox){
	var total = parseInt(document.getElementById('total').innerText);
	var value = parseInt(checkbox.value);

	if (checkbox.checked){
	 total += value;
	} else {
	 total -= value;
	}
	document.getElementById('total').innerHTML = total;
}

</script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>