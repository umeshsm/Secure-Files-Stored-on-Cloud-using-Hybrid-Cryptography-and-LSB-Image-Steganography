<script type="text/JavaScript">

function decryptElement(flname) {
  var flname1 = flname;
  if (flname1) {
  window.location.href = "./decrypt.php?flname1=" + flname1;
  } 
  else 
    exit();
}

function forgotElement(flname) {
  var flname1 = flname;
  if (flname1) {
  window.location.href = "./forgotsecretkeys.php?flname1=" + flname1;
  } 
  else 
    exit();
}

</script>


<?php

ob_start();

include('header.php');
include('session.php');

$result = mysqli_query($conn,"SELECT id,file_name, enc_date FROM files_encrypted where uname = '$uname';");

$i = 0;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
  <title>Decrypt Show Page</title>
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
    h2{
      color: white;
    }
  </style>
</head>

<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange">Encrypted Files List </h1>
            
<div class="search-container">
  <input class="search-input" id="myInput" type="text" placeholder="Search..." onkeyup="myFunction()">
  <div class="search"></div>
</div>
                       
            <p class="text-center" style="color: white;">

              <table id="myTable" align="center">
              
           		<?php

                if ($result->num_rows > 0) {

                  echo "<tr><th> Sl no. </th><th style='width:300px'> Filename </th><th style='width:300px'> Date and Time </th><th style='width:350px'> Decrypt the File </th></tr>";

                	while ($row = $result->fetch_assoc()) {

                  	$id[$i]=$row["id"];
                  	$f[$i] = $row["file_name"];
                    $d[$i] = $row["enc_date"];

                  	$j = $i+1;
                  	echo "<tr><td> $j. </td><td style='width:300px'> <a style='text-decoration: none' href='#' id='$id[$i]' title=' ' > $f[$i]</a> </td><td style='width:300px'> $d[$i] </td><td><button name='$f[$i]' class='btn btn-green py-3 px-6' onclick='decryptElement(this.name)'> Decrypt </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button name='$f[$i]' class='btn btn-forgot py-3 px-6' onclick='forgotElement(this.name)'> Forgot Secret Keys </button></td></tr>";

                  	$i = $i + 1;

                	}
            	}
            	else
            	{
            		echo "<h3 style='color:white'>No Files found.<h3>";
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
   $.post('fetch.php', {
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
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toLowerCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

</script>
