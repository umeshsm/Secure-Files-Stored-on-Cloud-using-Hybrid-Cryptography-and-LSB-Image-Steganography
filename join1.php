<?php

ob_start();
include('header.php');
include('session.php');

$dec_data1 = $_SESSION['dec_data1'];
$dec_data2 = $_SESSION['dec_data2'];
$dec_data3 = $_SESSION['dec_data3'];
$fname123 = $_SESSION['fname123'];

$dec_data1 = trim($dec_data1);
$dec_data2 = trim($dec_data2);
$dec_data3 = trim($dec_data3);

$dec_filename = $fname123 . "_Decrypted.txt";
$files = fopen("files joined/$dec_filename", 'w');

fwrite($files, $dec_data1);
fwrite($files, $dec_data2);
fwrite($files, $dec_data3);

fclose($files);

$files = file_get_contents("files joined/$dec_filename");

$_SESSION['dec_filename'] = $dec_filename;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Join1 Page</title>
</head>

<body>


    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange">Joined File</h1>
            
            <br>
            
            <p class="text-center" style="color: white;">
              

              <?php 

             
              	echo "<br>$files<br><br><br>";
             

              ?>

             <a href="download2.php" class="btn btn-download py-3 px-8">Download</a>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    			   <input class="btn btn-tango py-3 px-8" type="button" onClick="location.href='index.php'" value="Home">
     		
            </p>
          </div>
        </div>
      </div>
    </div>


</body>
</html>

	
