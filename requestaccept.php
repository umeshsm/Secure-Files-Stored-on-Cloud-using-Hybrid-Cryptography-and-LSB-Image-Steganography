<?php

ob_start();

include('header.php');
include('session.php');

include('AES.php');
include('DES.php');
include('RC6.php');

$i = 0;
$err = 0;

$result = mysqli_query($conn,"SELECT file_name,from_user,req_date FROM requests where to_user = '$uname';");
if ($result->num_rows > 0) {
 	$j = 0;
 	while ($row = $result->fetch_assoc()) {

	$f[$i] = $row["file_name"];
    $u[$i] = $row["from_user"];
    $d = $row["req_date"];

    $j = $j+1;
    $i = $i + 1;

    }
}

if ($_GET['usrname1'] && $_GET['flname1']) {
      
  $send_fname = $_GET['flname1'];
  $send_uname = $_GET['usrname1'];
  
  $_SESSION['send_fname'] = $send_fname;
  $_SESSION['send_uname'] = $send_uname;


  for ($k=0; $k < $i; $k++) {

    if ($f[$k] == $send_fname && $u[$k] == $send_uname) {

      $err = 1;
    }
  
  }

if ($err == 1) {

  $result2 = mysqli_query($conn,"SELECT pass1,pass2,pass3 FROM encrypted_pass where file_name = '$send_fname' and uname = '$uname';");

  while ($row = $result2->fetch_assoc()) {

    $p1 = $row["pass1"];
    $p2 = $row["pass2"];
    $p3 = $row["pass3"];

  }
  
  	$pass1 = Decrypt_Aes($p1, "123");
    $pass2 = Decrypt_Des($p2, "456"); 
    $pass3 = Decrypt_Rc6($p3, "789");
	
	$p1 = trim($pass1);
	$p2 = trim($pass2);
	$p3 = trim($pass3);

  $msg = "<span style='color:yellow'>Secret Key 1 : </span>" . $p1 . "<br><br>" . "<span style='color:yellow'> Secret Key 2 : </span>" . $p2 . "<br><br>" . "<span style='color:yellow'> Secret Key 3 : </span>" . $p3 ;

  $_SESSION['steg_msg'] = $msg;

  $result3 = mysqli_query($conn,"SELECT email FROM user where uname = '$send_uname';");

  while ($row = $result3->fetch_assoc()) {

    $to_email = $row["email"];

  }

  $_SESSION['steg_email'] = $to_email;

  header('Location: encode.php');

}

}

?>