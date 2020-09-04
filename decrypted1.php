<?php

ob_start();
include('header.php');
include('session.php');

echo " <script type='text/javascript'> alert('Decryption Successfull.'); </script> ";

  include 'AES.php';
  include 'DES.php';
  include 'RC6.php';

  $key1 = $_SESSION['pass1'];
  $key2 = $_SESSION['pass2'];
  $key3 = $_SESSION['pass3'];

  $enc_info1 = $_SESSION['dec_upload_part1'];
  $enc_info2 = $_SESSION['dec_upload_part2'];
  $enc_info3 = $_SESSION['dec_upload_part3'];
  $filename = $_SESSION['dec_file_name'];

  
  $dec_data1 = Decrypt_Aes($enc_info1, $key1);    

  $dec_data2 = Decrypt_Des($enc_info2, $key2);    

  $dec_data3 = Decrypt_Rc6($enc_info3, $key3);    
  

  $_SESSION['dec_data1'] = $dec_data1;
  $_SESSION['dec_data2'] = $dec_data2;
  $_SESSION['dec_data3'] = $dec_data3;


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Decrypted1 Page</title>
</head>
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
      width: 35%;
      color: orange;
    }
    td{
      width: 100%;
    }
  </style>
<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange">Decrypted Files</h1>
            
            <br>
            
            <p class="text-center" style="color: white;">
              
             <table align="center">

              <?php 

                echo "<tr><th colspan=2> AES </th></tr>";
                echo "<tr><th style='color:yellow'> Decrypted File Part 1  </th><td> $dec_data1 </td></tr>";
                echo "<tr><th colspan=2> DES </th></tr>";
                echo "<tr><th style='color:yellow'> Decrypted File Part 2  </th><td> $dec_data2 </td></tr>";
                echo "<tr><th colspan=2> RC2 </th></tr>";
                echo "<tr><th style='color:yellow'> Decrypted File Part 3  </th><td> $dec_data3 </td></tr>";

              ?>

            </table>

            <br><br>

    			<input class="btn btn-skip py-3 px-6" type="button" onClick="location.href='join1.php'" value="Join">
     		
            </p>
          </div>
        </div>
      </div>
    </div>

</body>
</html>

	
	