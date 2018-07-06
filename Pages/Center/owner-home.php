<!doctype html>
<html lang="en">
  <head>

      <script>
          var index;
          function staffFunction() {

              document.getElementById('staffConroll').style.display='contents';


          }
          function changeSalary(e) {
                index=e;
           }
          function saveSalary() {

              var hr=new XMLHttpRequest();
              var url="owner-home.php#staffControll";
              var salary=document.getElementById("amount").value;
              var q="amount="+salary+"&index="+index;
              hr.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                   document.getElementById("body").innerHTML=hr.responseText;
                  }
              };
              hr.open("POST",url,true);
              hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

              hr.send(q);
          }

          function deleteEntry(e) {
              if(confirm("Are u really want to delte")){
                  var hhxmlhttp =new XMLHttpRequest();
                  var url="owner-home.php#staffControll";
                  hhxmlhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                          document.getElementById("body").innerHTML=hhxmlhttp.responseText;
                      }
                  };
                  hhxmlhttp.open("POST",url,true);
                  hhxmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                  hhxmlhttp.send("deleteIndex="+e);
              }else{

              }
          }

          function approveDoctor(e){
              if(confirm("Do u like to add him/his to staff")){
                  var hhxmlhttp =new XMLHttpRequest();
                  var url="owner-home.php#staffControll";
                  hhxmlhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                          document.getElementById("body").innerHTML=hhxmlhttp.responseText;
                      }
                  };
                  hhxmlhttp.open("POST",url,true);
                  hhxmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                  hhxmlhttp.send("addDoctortoStaff="+e);
              }
          }

      </script>
      <?php
      if(isset($_POST['index'])){

          $conn=mysqli_connect("localhost","root","","bins_medical_center");
          $quary="UPDATE `salery` SET `salery`={$_POST['amount']} WHERE `index`={$_POST['index']}";
          mysqli_query($conn, $quary);
          mysqli_close($conn);

      }
      if(isset($_POST['deleteIndex'])){
          $conn=mysqli_connect("localhost","root","","bins_medical_center");
          mysqli_query($conn, "DELETE FROM `salery` WHERE `index`={$_POST['deleteIndex']}");
          mysqli_close($conn);

      }if(isset($_POST['addDoctortoStaff'])){
          include "../../debug/ChromePhp.php";
          $conn=mysqli_connect("localhost","root","","bins_medical_center");
          if(mysqli_query($conn, "INSERT INTO `doctor`(`doc_nic`,`name`,`specialization`,`mobile`,`email`,`dob`,`medical_license`) SELECT `doc_nic`,`name`,`specialization`, `mobile`,`email`, `dob`,`medical_license` FROM `doctor_application` WHERE `id`={$_POST['addDoctortoStaff']}")){
              ChromePhp::log("done");
          }else{
              ChromePhp::log("failed");
          }
          mysqli_close($conn);

      }
      ?>

      <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Owner Page</title>
  </head>
  <body  id="body">
  <nav class="nav bg-dark">
      <a  style="color:white" class="nav-link  btn-info" href="#staffControll" onclick="staffFunction()">Staff</a>
      <a style="color:white" class="nav-link btn-info " href="#pharmacy">Pharmacy</a>
      <a style="color:white;margin-left: 83%" class="nav-link  btn-info " href="#"  >Logout</a>
  </nav>
  <div class="container" style="display:none" id="staffConroll">
      <table class="table table-striped table-dark">
          <thead>
          <tr>
              <th scope="col">Role</th>
              <th scope="col">Name</th>
              <th scope="col">Pay</th>

          </tr>
          </thead>
          <tbody>
          <tr>

              <?php
              // table connect query
              $conn=mysqli_connect("localhost","root","","bins_medical_center");
              mysqli_query($conn,"REPLACE  INTO `salery`(`nic`,`role`,`name`,`salery`) SELECT  `doc_nic`,`specialization`,`name`,`fee` FROM `doctor`;REPLACE INTO `salery`(`nic`,`role`,`name`,`salery`) SELECT `staff_nic`,`position`,`name`,`salary` FROM `staff`");
              $result=mysqli_query($conn, "SELECT `index`,`role`,`name`,`salery` FROM `salery`");
              while($row=mysqli_fetch_assoc($result)){
                     echo"
                     <tr>
                        <td>{$row['role']}</td>
                        <td>{$row['name']}</td>
                        <td id='{$row['index']}'>{$row['salery']} <button class='btn btn-primary btn-sm'  data-toggle='modal' data-target='#exampleModal' onclick='changeSalary({$row['index']})' >edit</button></td>
                        <td id='remove'><button class='btn btn-danger btn-sm' onclick='deleteEntry({$row['index']})'><h7>delete</h7></button> </td>
                     </tr>
                     ";
              }
              $staffResult=mysqli_query($conn, "SELECT `name`,`position`,`salary` FROM `staff`");
              mysqli_close($conn);
              ?>

          </tr>

          </tbody>
      </table>
      <button class="btn btn-success" data-toggle='modal' data-target="#addStaffModal">Add staff Member</button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Enter new Salary</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">

                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">Rs.</span>
                          </div>
                          <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="amount" id="amount">
                          <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="submit"  class="btn btn-primary" onclick="saveSalary()">Save changes</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="addStaffModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="addStaffModalLabel">Choose Worker</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <button class="btn btn-primary " data-dismiss="modal" data-toggle='modal' data-target="#DoctorForms">Doctor</button>
                      <button class="btn btn-primary" data-toggle='modal' data-target="#NurseForms">Nurse</button>
                      <button class="btn btn-primary"data-toggle='modal' data-target="#pharmacistForm">Pharmacists</button>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
<!--      Doctor form-->
      <div class="modal fade" id="DoctorForms" tabindex="-1" role="dialog" aria-labelledby="DoctorFormsLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" style="width: 100%" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="DoctorFormsLabel">Applications</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body " style="overflow-x: auto">
                     <div>
                         <table class="table table-striped table-dark" STYLE="width: fit-content" >
                             <thead>
                             <tr>
                                 <th scope="col" >NIC</th>
                                 <th scope="col">Name</th>
                                 <th scope="col">Specialization</th>
                                 <th scope="col">Mobile Number</th>
                                 <th scope="col">Email</th>
                                 <th scope="col">Date of Birth</th>
                                 <th scope="col">Medical Licence</th>
                                 <th scope="col">Status</th>
                             </tr>
                             </thead>
                             <?php
                             $conn=mysqli_connect("localhost","root","","bins_medical_center");

                             $result=mysqli_query($conn, "SELECT * FROM `doctor_application`");
                             while($row=mysqli_fetch_assoc($result)){
                                 echo"
                     <tr>
                        <td>{$row['doc_nic']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['specialization']}</td>
                        <td>{$row['mobile']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['dob']}</td>
                        <td><a href='file:///C:/xampp/htdocs/bins-medical-center/Uploads/cv.pdf'>Show</a></td>
                        <td><button class='btn btn-danger btn-sm'  onclick='approveDoctor({$row['id']})'>N/A</button></td>
                     </tr>
                     ";
                             }
                             ?>
                         </table>
                     </div>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>


<!--      Nurse Form-->
      <div class="modal fade" id="NurseForms" tabindex="-1" role="dialog" aria-labelledby="NurseFormsLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="NurseFormsLabel">Applications</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">


                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>

      </div>






.



  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>