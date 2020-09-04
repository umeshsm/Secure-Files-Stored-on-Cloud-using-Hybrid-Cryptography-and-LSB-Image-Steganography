<script type="text/JavaScript">

function acceptElement(usrname,flname) {
  var usrname1 = usrname;
  var flname1 = flname;
  if (usrname1 && flname1) {
  window.location.href = "./requestaccept.php?usrname1=" + usrname1 + "&flname1=" + flname1;
  } 
  else 
    exit();
}

function denyElement(usrname,flname){

  var usrname1 = usrname;
  var flname1 = flname;

  if (usrname1 && flname1) {
  window.location.href = "./confirmdeny.php?usrname1=" + usrname1 + "&flname1=" + flname1;
  }
  else 
    exit();
}

</script>

<?php


ob_start();

include('header.php');
include('session.php');

$i = 0;
$err = 0;

$result = mysqli_query($conn,"SELECT id,file_name,purpose,from_user,req_date FROM requests where to_user = '$uname' order by id desc;");

?>
   
<!DOCTYPE html>
<html lang="en">

<head>
    
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
  <title>Requests Page</title>

  <style>

    table{
      color: white;
      text-align: center;
    }
    table,tr,th,td{
      border: 1px solid grey;
      height: 50px;
    }
    th{
      
      color: yellow;
    }

  </style>
</head>

<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange";>Requests Received</h1>
            
<div class="search-container">
  <input class="search-input" id="myInput" type="text" placeholder="Search..." onkeyup="myFunction()">
  <div class="search"></div>
</div>
            
            <p class="text-center" style="color: white";>

              <table id="myTable" align="center">
              
              <?php

                if ($result->num_rows > 0) {

                  echo "<tr><th style='width:50px'> Sl no. </th><th> Filename </th><th> Purpose of Request </th><th> Username </th><th> Date and Time</th><th style='width:350px'> Take Action </th></tr>";

                  $j = 0;

                  while ($row = $result->fetch_assoc()) {

                    $id[$i]=$row["id"];
                    $f[$i] = $row["file_name"];
                    $p[$i] = $row["purpose"];
                    $u[$i] = $row["from_user"];
                    $d = $row["req_date"];

                    $j = $j+1;

                    echo "<tr><td> $j. </td><td style='width:300px'> <a style='text-decoration: none' href='#' id='$id[$i]' title=' ' > $f[$i]</a> </td><td style='width:300px'> $p[$i] </td><td style='width:100px'> $u[$i] </td><td style='width:350px'> $d </td><td><button class='btn btn-green py-3 px-6' name='$f[$i]' id='$u[$i]' onclick='acceptElement(this.id,this.name)'>Accept</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button name='$f[$i]' id='$u[$i]' class='btn btn-red py-3 px-6' onclick='denyElement(this.id,this.name)'> Deny </button></td></tr>";


                    $i = $i + 1;

                  }
                }
                else {

                  echo "<h3 style='color:white'>No Requests found.</h3>";

                }

             ?>

           </table>

            </p>
          </div>
        </div>
      </div>
    </div>

</body>


</html>

<script>  
$(document).ready(function(){ 

 $('a').tooltip({
  classes:{
   "ui-tooltip":"highlight"
  },
  position:{ my:'left center', at:'right+50 center'},
  content:function(result){
   $.post('fetchreq.php', {
    id:$(this).attr('id')
   }, function(data){
    result(data);
   });
  }
 });
});  


function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toLowerCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    if (td1 || td2) {
      txtValue1 = td1.textContent || td1.innerText;
      txtValue2 = td2.textContent || td2.innerText;
      if (txtValue1.toLowerCase().indexOf(filter) > -1 || txtValue2.toLowerCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }     
  }
}

</script>