<?php

ob_start();

include('header.php');
include('session.php');

include('AES.php');
include('DES.php');
include('RC6.php');

$result2 = mysqli_query($conn,"SELECT email FROM user where uname = '$uname'");

while ($row = $result2->fetch_assoc()) {

    $to_email = $row["email"];

}

  $_SESSION['steg_email'] = $to_email;

if ($_GET['flname1']) {
      
    $send_fname = $_GET['flname1'];
    $_SESSION['send_fname'] = $send_fname;
    $_SESSION['send_uname'] = $uname;
    
}

if (isset($_POST['submit'])) {
    
    $result1 = mysqli_query($conn,"SELECT pass1,pass2,pass3 FROM encrypted_pass where file_name = '$send_fname' and uname = '$uname'");

  while ($row = $result1->fetch_assoc()) {

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

    header('Location:encode.php');

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Forgot Secret Keys Page</title>
</head>
<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">

            <h2 class="mb-3" style="color: orange";>The Secret Keys for the File : ' <?php echo $send_fname ?> ' will be encoded in a Stego Image and sent to ' <?php echo $to_email ?> '</h2><br><br>
            
            <p class="text-center">
                
            <form method="post">
            <input type="submit" name="submit" class="btn btn-dec py-3 px-6" value="Next"/>
            </form>
            
            </p>

          </div>
        </div>
      </div>
    </div>
</body>
</html>