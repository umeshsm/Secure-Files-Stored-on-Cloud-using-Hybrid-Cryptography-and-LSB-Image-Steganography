<script type="text/JavaScript">

function decryptElement(flname) {
  var flname1 = flname;
  if (flname1) {
  window.location.href = "./decrypt.php?flname1=" + flname1;
  } 
  else 
    exit();
}

function downloadElement(flname){

  var flname1 = flname;

  if (flname1) {
  window.location.href = "./downloadfile.php?flname1=" + flname1;
  }
  else 
    exit();
}

function deleteElement(flname){

  var flname1 = flname;

  if (flname1) {
  window.location.href = "./confirmdeletefile.php?flname1=" + flname1;
  }
  else 
    exit();
}

</script>



<?php

ob_start();

include('header.php');
include('session.php');

$result = mysqli_query($conn,"SELECT id,file_name, description, enc_date FROM files_encrypted where uname = '$uname' order by id desc;");

?>
   
<!DOCTYPE html>
<html lang="en">

<head>
    
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
  <title>My Files Page</title>
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
    .edit-btn{
        background-color: Transparent;
        background-repeat:no-repeat;
        border: none;
        cursor:pointer;
        overflow: hidden;
    }
 
</style>

</head>

<body>
    
    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            
           <h1 class="mb-3" style="color: orange";>Encrypted Files List</h1>

<div class="search-container">
  <input class="search-input" id="myInput" type="text" placeholder="Search..." onkeyup="myFunction()">
  <div class="search"></div>
</div>

            <p class="text-center" style="color: white";>

              <table align="center" id="myTable">

              <?php

                $i = 0;

                if ($result->num_rows > 0) {

                  echo "<tr><th> Sl no. </th><th style='width:300px'> Filename </th><th style='width:300px'> Date and Time </th><th style='width:350px'> Take Action </th></tr>";

                  while ($row = $result->fetch_assoc()) {

                      $id[$i] = $row["id"];
                      $f[$i] = $row["file_name"];
                      $desc[$i] = $row["description"];
                      $d[$i] = $row["enc_date"];

                      $j = $i+1;
                      echo "<tr><td> $j. </td><td style='width:300px'><a style='text-decoration: none' href='#' id='$id[$i]' title=' ' > $f[$i] </a>&nbsp;&nbsp;&nbsp;<button name='$f[$i]' onclick='renameFile(this.name)' class='edit-btn'><i class='fa fa-edit' style='color:#E77D66'></i></button> </td><td style='width:300px'> $d[$i] </td><td><button class='btn btn-green py-3 px-6' name='$f[$i]' onclick='decryptElement(this.name)'> Decrypt </button> &nbsp;&nbsp;&nbsp;&nbsp;<button name='$f[$i]' class='btn btn-brown py-3 px-6' onclick='downloadElement(this.name)'> Download </button>&nbsp;&nbsp;&nbsp;&nbsp; <button name='$f[$i]' class='btn btn-red py-3 px-6' onclick='deleteElement(this.name)'> Delete </button></td></tr>";

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

function renameFile(id) {
  var fn = id;
  var r = prompt("Enter a new Filename with .txt extension for " +fn , fn);
  
  <?php
  
    $result = mysqli_query($conn,"SELECT file_name FROM files_encrypted;");

    if ($result->num_rows > 0) {

        $i = 0;
        
        while($row = $result->fetch_assoc()) {
    
            $filenames[$i] = $row["file_name"];
    
            $i = $i + 1;
        }
    }
    
  ?>
  
  if (r == '') {
    alert("Enter a valid Filename!");
  }
  else{
      
        r = r.toLowerCase();
        var ext = r.slice(r.length - 4);
      
        var dot_count = 0;
        for (var position = 0; position < r.length; position++) 
         {
            if (r.charAt(position) == ".") 
              {
                  dot_count += 1;
              }
          }
  
      if(r == fn){
          alert("Filename remains unchanged.");
      }
      else if(ext != ".txt"){
          alert("Enter .txt extension in the Filename.");
      }
      else if(dot_count > 1){
          alert("Dot (.) should be used only for extension and not in Filename!");
      }
      else{
        var fnames = new Array();
        <?php foreach($filenames as $key => $val){ ?>
            fnames.push('<?php echo $val; ?>');
        <?php } ?>
        
        var i,j=0;
        for(i = 0; i < fnames.length; i++){
            if(fnames[i] == r){
                alert("Filename already exists!");
                j = 1;
            }
        }
        
        if(j == 0){

            var rname;
            window.location.href = "./renamefile.php?rname=" + r + "&oname=" + fn;

        }
        
      }
  }
}

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