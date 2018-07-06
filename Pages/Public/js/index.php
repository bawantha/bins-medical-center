<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/index.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/index.js"></script>

</head>
<body>
  <!-- Just an image -->
  <nav class="navbar navbar-light bg-info">
    <a class="navbar-brand" href="#">
      <img src="images/logo.png" width="30" height="30" alt="">
    </a>
  </nav>
  <div class="jumbotron jumbotron-fluid">
    <div class="container col-md-4 text-center ">
      <a class=" btn btn-primary btn-lg btn-outline-primary" data-toggle="modal" data-target="#channelTypeChose">Channel now</a>
      <!-- Modal -->
      <div class="modal fade" id="channelTypeChose" tabindex="-1" role="dialog" aria-labelledby="channelTypeChoseLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="channelTypeChoseLabel">Chose</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id = 'chanel form'>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label class="form-lable" for="DoctorName">Doctor name</label>
                  <input list = 'DoctorName' class="form-control" id="Name">
				  <?php  
					$name = "DoctorName";
					include 'Database-connect.php';
					$result = $connection -> query("select name from doctor order by name");
					$col_name = "name";
					include 'create-datalist.php';
				  ?>
                  <label class="form-lable" for="SpecialtyDescription">Spcialization</label>
                  <input list = 'specialization' class="form-control" id="SpecialtyDescription" placeholder="">
				  <?php  
					$name = "specialization";
					$result = $connection -> query("select distinct specialization from doctor order by specialization");
					$col_name = "specialization";
					include 'create-datalist.php';
					$connection -> close();
				  ?>
                  <label class="form-lable" for="Date">Date</label>
                  <input type="date" class="form-control" id="date">
				  
                </div>
            </div>
			<div class="modal-footer">
				    <input type="submit" class="btn btn-primary" name="submit" value = 'Search' form = 'chanel form'>
			</div>
          </div>
        </div>
      </div>
	  </div>



      <div class="modal fade" id="diseaseModal" tabindex="-1" role="dialog" aria-labelledby="diseaseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="diseaseModalLabel1">Chose</h5>
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
</body>