<?php

include('header.php');
include('session.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Choose Page</title>
</head>
<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3"></h1>
            
            <p class="text-center" style="color: white;">
              
           <input class="btn btn-long1 py-3 px-8" type="button" onClick="location.href='upload.php'" value="Encrypt Another File">
    			<br><br><br><br>
    			<input class="btn btn-long2 py-3 px-8" type="button" onClick="location.href='decryptchoose.php'" value="Decrypt a File">
    			<br><br><br><br>
    			<input class="btn btn-tango py-3 px-8" type="button" onClick="location.href='index.php'" value="Home">
   		
            </p>
          </div>
        </div>
      </div>
    </div>


</body>
</html>
					
