<?php

ob_start();

include('header.php');
include('session.php');

$reg_email = $_SESSION['new_email'];
$reg_otp = $_SESSION['new_otp'];

if (isset($_POST['verify_submit'])) {
      
  $entered_otp = $_POST['otp'];

  if($entered_otp == $reg_otp){
      
    $query = "UPDATE user SET email = '$reg_email' where uname = '$uname'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    
    if($result)
    {
            echo "<SCRIPT> 
                    alert('Profile Updated Successfully.')
                    window.location.replace('./index.php');
            </SCRIPT>";
    }
      
  }
  else{
      echo " <script type='text/javascript'> alert('Verification Code is Invalid.'); </script> ";
  }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Verify New Email Page</title>
</head>

<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange">Enter the Verification Code sent to <?php echo $reg_email ?></h1>
            
            <br>
            
            <p class="text-center" style="color: white;">
              
           		<form name="validate" action="" method="post" onsubmit="return validateForm()">


    			<input type="tel" name="otp" required="" autocomplete="off" placeholder="enter otp here">
    			
                <br><br><br>

    			<input class="btn btn-enc py-3 px-8" type="submit" name="verify_submit" value="Verify">

    			<script  type="text/javascript">
            function validateForm()
            {
              var x=document.forms["validate"]["otp"].value;

              if (x==null || x=="")
              {
                alert("Enter a Valid OTP");
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

	
	