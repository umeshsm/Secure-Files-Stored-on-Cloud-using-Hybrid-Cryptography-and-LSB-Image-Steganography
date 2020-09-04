<?php

include('header.php');
include('session.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Decrypt Choose Page</title>
</head>

<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange">Decryption</h1>
            <br><br>
            <h3 style="color: yellow;">How do you want to Decrypt?</h3>
            <br><br>
            <p class="text-center" style="color: white;">
              
              <input class="btn btn-decrypt py-3 px-8" type="button" name="dec_upload" onclick="location.href='decryptupload.php'" value="Upload a File from Local Storage">
           		 &nbsp;&nbsp;&nbsp;&nbsp;
               <label><b style="color: #E15D44";>OR</b></label>
               &nbsp;&nbsp;&nbsp;&nbsp;
    			    <input class="btn btn-decrypt py-3 px-8" type="button" name="dec_show" onclick="location.href='decryptshow.php'" value="Select a File on the Server">

            </p>

          </div>
        </div>
      </div>
    </div>

</body>
</html>
	