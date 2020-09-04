<?php

ob_start();

include('header.php');
include('session.php');

if (isset($_POST['enc_submit'])) {

	$part1 = $_SESSION['part1'];
	$part2 = $_SESSION['part2'];
	$part3 = $_SESSION['part3'];
	$filename = $_SESSION['file_name'];

	include 'AES.php';
	include 'DES.php';
	include 'RC6.php';

  $key1 = $_POST['key1'];
  $key2 = $_POST['key2'];
  $key3 = $_POST['key3'];


	$enc_data1 = Encrypt_Aes($part1, $key1);
  $k1 = Encrypt_Aes($key1, "123"); 

 	$enc_filename1 = str_replace(".txt","_Encrypted_1.txt",$filename);
 	$f1 = fopen("files encrypted/$enc_filename1", "w");
 	fwrite($f1, $enc_data1);
 	fclose($f1);
 	
 	$display_data1 = str_split($enc_data1,100);


	$enc_data2 = Encrypt_Des($part2, $key2);
  $k2 = Encrypt_Des($key2, "456");  

 	$enc_filename2 = str_replace(".txt","_Encrypted_2.txt",$filename);
 	$f2 = fopen("files encrypted/$enc_filename2", "w");
 	fwrite($f2, $enc_data2);
 	fclose($f2);
 	
 	$display_data2 = str_split($enc_data2,100);


	$enc_data3 = Encrypt_Rc6($part3,$key3);
  $k3 = Encrypt_Rc6($key3,"789");

	$enc_filename3 = str_replace(".txt","_Encrypted_3.txt",$filename);
 	$f3 = fopen("files encrypted/$enc_filename3", "w");
 	fwrite($f3, $enc_data3);
 	fclose($f3);
 	
 	$display_data3 = str_split($enc_data3,100);


 	$f4 = fopen("Encrypted files list/encrypted files list.txt", "a");
 	fwrite($f4, $filename ."\n");
 	fclose($f4);


 	$enc_joined_data = $enc_data1 . "%oK#" . $enc_data2 . "%oK#" . $enc_data3 . "@MiD*" . $k1 . "%oR&" . $k2 . "%oR&" . $k3;

 	$enc_down_filename = str_replace(".txt","_Encrypted.txt",$filename);
 	$f5 = fopen("Encrypted files list/$enc_down_filename", "w");
 	fwrite($f5, $enc_joined_data);
 	fclose($f5);
  
  date_default_timezone_set("Asia/Kolkata");  
  $enc_date = date("d / m / Y  h : i : s a");
  
  $desc = $_SESSION['desc_input'];

  $query="insert into files_encrypted(part1,part2,part3,file_name,description,uname,enc_date) values ('$enc_data1','$enc_data2','$enc_data3','$filename','$desc','$uname','$enc_date')";
  $result=mysqli_query($conn,$query) or die(mysqli_query($conn));

  $query2="insert into encrypted_pass(pass1,pass2,pass3,file_name,uname) values('$k1','$k2','$k3','$filename','$uname')";
  $result2=mysqli_query($conn,$query2)or die(mysqli_query($conn));

  $query3="insert into encrypted_files_joined(file_content,file_name,uname) values('$enc_joined_data','$filename','$uname')";
  $result3=mysqli_query($conn,$query3)or die(mysqli_query($conn));


  $_SESSION['enc_down_filename'] = $enc_down_filename;


}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Encrypted Page</title>
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
            <h1 class="mb-3" style="color: orange">Encrypted files</h1><br>
            
            <p class="text-center" style="color: white;">
              
              <table align="center">

           		<?php 
           			echo "<tr><th colspan=2> AES </th></tr>";
           			echo "<tr><th style='color:yellow'> Encrypted File Part 1  </th><td> $display_data1[0]";
           			if(strlen($display_data1[1])>0){
           			echo"<br>$display_data1[1]"; }
           			if(strlen($display_data1[2])>0){
           			echo"<br>$display_data1[2]"; }
           			if(strlen($display_data1[3])>0){
           			echo"<br>$display_data1[3]"; }
           			if(strlen($display_data1[4])>0){
           			echo"<br>$display_data1[4]"; }
           			if(strlen($display_data1[5])>0){
           			echo"<br>$display_data1[5]"; } 
           			echo "</td></tr>";
           			echo "<tr><th colspan=2> DES </th></tr>";
           			echo "<tr><th style='color:yellow'> Encrypted File Part 2  </th><td> $display_data2[0]";
           			if(strlen($display_data2[1])>0){
           			echo"<br>$display_data2[1]"; }
           			if(strlen($display_data2[2])>0){
           			echo"<br>$display_data2[2]"; }
           			if(strlen($display_data2[3])>0){
           			echo"<br>$display_data2[3]"; }
           			if(strlen($display_data2[4])>0){
           			echo"<br>$display_data2[4]"; }
           			if(strlen($display_data2[5])>0){
           			echo"<br>$display_data2[5]"; } 
           			echo "</td></tr>";
           			echo "<tr><th colspan=2> RC2 </th></tr>";
           			echo "<tr><th style='color:yellow'> Encrypted File Part 3  </th><td> $display_data3[0]";
           			if(strlen($display_data3[1])>0){
           			echo"<br>$display_data3[1]"; }
           			if(strlen($display_data3[2])>0){
           			echo"<br>$display_data3[2]"; }
           			if(strlen($display_data3[3])>0){
           			echo"<br>$display_data3[3]"; }
           			if(strlen($display_data3[4])>0){
           			echo"<br>$display_data3[4]"; }
           			if(strlen($display_data3[5])>0){
           			echo"<br>$display_data3[5]"; } 
           			echo "</td></tr>";		
           			
           		?>

            </table>

            <br><br>

				<a href="download1.php" class="btn btn-download py-3 px-8">Download</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				<a href="choose.php" class="btn btn-skip py-3 px-8">Skip >>></a>
 		
            </p>
          </div>
        </div>
      </div>
    </div>


</body>
</html>
	