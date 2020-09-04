<?php

include('header.php');

?>
   
 
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home Page</title>
</head>

<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange";>Securely store your files on Cloud</h1>
            <br><br>         
            <p class="lead mx-auto desc mb-5" style="color: lightgrey";>File Storage, Encryption, Decryption & File Tranfer.</p>
            <p class="text-center">

              <?php if(isset($_SESSION['login_user']))
                {
              ?>

              <a href="upload.php" class="btn btn-enc py-3 px-6">Encrypt</a>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="decryptchoose.php" class="btn btn-dec py-3 px-6">Decrypt</a>

              <?php
                }
                
              ?>

              
            </p>
          </div>
        </div>

      </div>
    </div>

</body>

</html>