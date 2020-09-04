<?php

ob_start();

include('header.php');
include('session.php');

?>

<!DOCTYPE html>
<html>
<head>
  <title>Encrypt Page</title>
</head>
<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange">Enter Secret Keys</h1>
            <h3 style="color: white;">All Three Secret Keys can be same or different</h3>
            <br>
            
            <p class="text-center">
              
              <form name="validate" action="encrypted.php" method="POST" onsubmit="return validateForm()">

         		<label for="key1" style="color: white;"><b style="color: yellow;">Secret Key 1 to Encrypt Part 1  </b> </label> <br>
    			<input type="password" name="key1" ><br><br>

    			<label for="key2" style="color: white;"><b style="color: yellow;">Secret Key 2 to Encrypt Part 2  </b> </label> <br>
    			<input type="password" name="key2" ><br><br>

				<label for="key3" style="color: white;"><b style="color: yellow;">Secret Key 3 to Encrypt Part 3  </b> </label> <br>
    			<input type="password" name="key3" >	<br><br>

    			<input class="btn btn-tango py-3 px-8" type="submit" name="enc_submit" value="Encrypt!">

          <script  type="text/javascript">
            function validateForm()
            {
              var x=document.forms["validate"]["key1"].value;
              var y=document.forms["validate"]["key2"].value;
              var z=document.forms["validate"]["key3"].value;
              if (x==null || x=="" || y==null || y=="" || z==null || z=="")
              {
                alert("Enter Valid Secret Keys !");
                return false;
              }
            }
          </script>

     		 </form>

            </p>

          </div>
        </div>
      </div>
    </div>

</body>
</html>
	