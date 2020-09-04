<?php

ob_start();

include('header.php');
include('session.php');

$send_fname = $_SESSION['send_fname'];
$send_uname = $_SESSION['send_uname'];

$sql = "DELETE FROM requests WHERE file_name = '$send_fname' and from_user = '$send_uname'";

if ($conn->query($sql) === TRUE) {
    echo "<script type='text/javascript'> alert('Email Sent Successfully.') </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Encode Page</title>
</head>

<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange";>Stego Image sent Successfully to <?php echo $send_uname ?> for File <?php echo $send_fname ?></h1>
        
            <p class="text-center" style="color: white";>

             <br><br><br>
             <a href="requests.php" class="btn btn-dec py-3 px-6">Back</a>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <a href="index.php" class="btn btn-enc py-3 px-6">Home</a>

            </p>
          </div>
        </div>
      </div>
    </div>

</body>

</html>