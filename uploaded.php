<?php

ob_start();

include('header.php');
include('session.php');

$file_name = $_SESSION['file_name'];
$file_size = $_SESSION['file_size'];
$file_content = $_SESSION['file_content'];
 
function function_alert($msg) {
  echo "<script type='text/javascript'> alert('$msg'); </script>";
}
         
function_alert("File Uploaded Successfully.");
  
include 'split.php';

$parts = fsplit("files uploaded/".$file_name);
      
$part1 = file_get_contents($parts[0]);              
$part2 = file_get_contents($parts[1]);     
$part3 = file_get_contents($parts[2]);
   
$_SESSION['part1'] = $part1;
$_SESSION['part2'] = $part2;
$_SESSION['part3'] = $part3; 

?>

<script type="text/javascript">
  var val="<?php echo $file_size; ?>";
  alert("File Size : " +val+ " Kb"); 
</script>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Uploaded Page</title>
    <style>
    table{
      color: white;
      position: center;
    }
    th{
      width: 25%;
      color: orange;
      height: 50px;
    }
    td{
      width:  100%;
      height: 50px;
    }
    table,tr,th,td{
      border: 1px solid grey;
    }
  </style>
 </head>
 <body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style='color:orange'>Split Files</h1><br>
            <p class="text-center" style="color: white;">

              <table align="center">
                <tr><th style="height: 50px">Parts</th><th style="height: 50px">Split File Data</th></tr>
            <?php

            echo "<tr><th style='color:yellow'> Part 1  </th> <td> $part1 </td></tr>";
            echo "<tr><th style='color:yellow'> Part 2  </th> <td> $part2 </td></tr>";
            echo "<tr><th style='color:yellow'> Part 3  </th> <td> $part3 </td></tr>";

            ?>
          </p>
        </table>

        <br><br>

          <input class="btn btn-send py-3 px-8" type=button onClick="location.href='encrypt.php'" value='Encrypt File'>

          </div>
        </div>

      </div>
    </div>

</body>
</html>