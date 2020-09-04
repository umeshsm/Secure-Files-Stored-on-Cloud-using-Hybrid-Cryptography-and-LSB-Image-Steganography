<?php

ob_start();
include('header.php');
include('session.php');

echo " <script type='text/javascript'> alert('Decryption Successfull.'); </script> ";

$dec_fname = $_SESSION['dec_fname'];

$sql = "SELECT file_name, part1, part2, part3 FROM files_encrypted where file_name = '$dec_fname'; ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
  while($row = $result->fetch_assoc()) {
    $filename = $row["file_name"];
    $enc_info1 = $row["part1"];
    $enc_info2 = $row["part2"];
    $enc_info3 = $row["part3"];
  }
}
else {
  echo "0 results";
}

  include 'AES.php';
  include 'DES.php';
  include 'RC6.php';

  $key1 = $_SESSION['pass1'];
  $key2 = $_SESSION['pass2'];
  $key3 = $_SESSION['pass3'];

 	$dec_filename1 = str_replace(".txt","_Decrypted_1.txt",$filename);
 	$dec_data1 = Decrypt_Aes($enc_info1, $key1);    
 	$f1 = fopen("files decrypted/$dec_filename1", "w");
 	fwrite($f1, $dec_data1);
 	fclose($f1);

	$dec_filename2 = str_replace(".txt","_Decrypted_2.txt",$filename);
 	$dec_data2 = Decrypt_Des($enc_info2, $key2);    
 	$f2 = fopen("files decrypted/$dec_filename2", "w");
 	fwrite($f2, $dec_data2);
 	fclose($f2);

	$dec_filename3 = str_replace(".txt","_Decrypted_3.txt",$filename);
 	$dec_data3 = Decrypt_Rc6($enc_info3, $key3);    
 	$f3 = fopen("files decrypted/$dec_filename3", "w");
 	fwrite($f3, $dec_data3);
 	fclose($f3);

  $_SESSION['dec_data1'] = $dec_data1;
  $_SESSION['dec_data2'] = $dec_data2;
  $_SESSION['dec_data3'] = $dec_data3;


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Decrypted Page</title>
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

    			   <input class="btn btn-skip py-3 px-6" type="button" onClick="location.href='join.php'" value="Join">
     		
            </p>
          </div>
        </div>
      </div>
    </div>

</body>
</html>

	
	