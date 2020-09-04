<?php

ob_start();

include('header.php');
include('session.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>File Sharing Page</title>
</head>
<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">

            <h1 class="mb-3" style="color: orange";>LSB Steganography</h1><br><br>
            
            <p class="text-center">

            <a href="decode.php" class="btn btn-stego py-3 px-6">Decode a Stego Image</a>

            </p>

          </div>
        </div>
      </div>
    </div>
</body>
</html>