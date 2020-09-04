<script type="text/JavaScript">

function requestElement(usrname,flname) {
    
    // First create a DIV element.
    var usrname1=usrname;
    var flname1=flname;
    
    var purpose = prompt("Specify the Purpose of Requesting " + flname1 + " (optional)");
    
    if(purpose == ''){
        purpose = "No Specific Purpose";
    }
    
    if (usrname1 && flname1) {
    window.location.href = "./requestfile.php?usrname1=" + usrname1 + "&flname1=" + flname1 + "&purpose=" + purpose;
    } else 
        exit();
}

function downloadElement(usrname,flname) {
    // First create a DIV element.
    var usrname1=usrname;
    var flname1=flname;
    if (usrname1 && flname1) {
    window.location.href = "./download3.php?usrname1=" + usrname1 + "&flname1=" + flname1;
    } else 
        exit();
}

</script>

<?php

ob_start();

include('header.php');
include('session.php');

$i = 0;
$err = 0;

$result = mysqli_query($conn,"SELECT id,file_name,description,uname,enc_date FROM files_encrypted where uname != '$uname' order by id desc;");

?>
   
<!DOCTYPE html>
<html lang="en">

<head>
    
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
  <title>All Files Page</title>
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

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange">All Files</h1>
            
<div class="search-container">
  <input class="search-input" id="myInput" type="text" placeholder="Search..." onkeyup="myFunction()">
  <div class="search"></div>
</div>
            
            <p class="text-center" style="color: white";><br>

              <table id="myTable" align="center">

              <?php

                $j = 0;
           
                if ($result->num_rows > 0) {

                  echo "<tr><th style='width:50px'> Sl no. </th><th style='width:300px'> Filename </th><th style='width:300px'> Username </th><th style='width:350px'> Date and Time </th><th style='width:350'> Request </th></tr>";

                  while ($row = $result->fetch_assoc()) {
                    
                    $id[$i] = $row["id"];
                    $f[$i] = $row["file_name"];
                    $desc[$i] = $row["description"];
                    $u[$i] = $row["uname"];
                    $d[$i] = $row["enc_date"];

                    $j = $i+1;

                    echo "<tr><td> $j. </td><td style='width:300px'><a style='text-decoration: none' href='#' id='$id[$i]' title=' ' > $f[$i]</a> </td><td style='width:300px'> $u[$i] </td><td style='width:300px'> $d[$i] </td><td><button class='btn btn-blue py-3 px-6' id='$u[$i]'name='$f[$i]' onclick='requestElement(this.id,this.name)'>Request</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class='btn btn-brown py-3 px-6' id='$u[$i]'name='$f[$i]' onclick='downloadElement(this.id,this.name)'>Download</button></td></tr>";

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

    var desc = new Array();

    <?php foreach($desc as $key => $val){ ?>
        desc.push('<?php echo $val; ?>');
    <?php } ?>

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
    td1 = tr[i].getElementsByTagName("td")[1];
    
    td2 = desc[i-1];

    if (td1) {
        
        txtValue1 = td1.textContent || td1.innerText;
      
        if (txtValue1.toLowerCase().indexOf(filter) > -1 || td2.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }     
  }
}

</script>

