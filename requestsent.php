<?php

ob_start();

include('header.php');
include('session.php');

$request_fname = $_SESSION['request_fname'];
$request_uname = $_SESSION['request_uname'];
$request_purpose = $_SESSION['request_purpose'];

$result = mysqli_query($conn,"SELECT email FROM user where uname = '$request_uname';");

if ($result->num_rows > 0) {

 	while ($row = $result->fetch_assoc()) {

		$to_email = $row["email"];

    }
}

$to = $to_email;
$subject = 'File Request Recieved.';
$message = 'You have a New Request from '.$uname.' for the File '.$request_fname. "\r\n\r\n" . 'Purpose of Request : ' .$request_purpose;
//enter your email below
$headers = 'From: SecureCloud <youremailid@gmail.com>' . "\r\n" .
            'Reply-To: '. $to_emailid . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

?>
   
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Request Sent Page</title>
</head>

<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange";>Request Sent Successfully to <?php echo $request_uname ?> for File <?php echo $request_fname ?></h1><br>
            <p style="color: yellow">Download the Encrypted File below, and wait for the Owner of this file to mail you the Stego Image. </p>
            
            <p class="text-center" style="color: white";><br><br><br>

            <a href="download1.php" class="btn btn-long py-3 px-8">Download the Encrypted File</a>
            <br><br><br>
            <a href="allfiles.php" class="btn btn-skip py-3 px-8">Back</a>

            </p>
          </div>
        </div>
      </div>
    </div>

</body>

</html>