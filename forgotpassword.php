
<?php

ob_start();

include('header.php');
include('connect.php');
include('AES.php');

$i = 0;
$err = 0;

if (isset($_POST['forgot_pass_submit'])) {

  $emailid = $_POST['emailid'];

  $result = mysqli_query($conn,"SELECT email FROM user");

  while ($row = $result->fetch_assoc()) {
    $e[$i] = $row["email"];

    $i = $i+1;
  }

  for ($k=0; $k < $i; $k++) {

    if ($e[$k] == $emailid) {
        
        $err = 1;
        

    }
  }

  if($err == 1){
      
      
        $result = mysqli_query($conn,"SELECT uname,password FROM user WHERE email = '$emailid'");

        while ($row = $result->fetch_assoc()) {
            
        $user_name = $row["uname"];
        $password = $row["password"];
        
        }
        
        $password = Decrypt_Aes($password, "123");
        
        $to      = $emailid;
        $subject = 'Login Credentials.';
        $message = 'Username : ' .$user_name. "\r\n\r\n" . 'Password : ' . $password ."\r\n\r\n\r\n\r\n".'Thank you'."\r\n\r\n".'SecureCloud Team';
        $headers = 'From: SecureCloud <securecloud1000@gmail.com>' . "\r\n" .
                    'Reply-To: '. $emailid . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);

    echo "<SCRIPT> 
        alert('An Email with the Login Credentials has been sent to your Email-Id.')
        window.location.replace('./editprofile.php');
    </SCRIPT>";

  }
  else
  {
    echo " <script type='text/javascript'> alert('Email did not match!\\nPlease enter the Correct Email address.'); </script> ";
  }

}


?>
   
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Forgot Password Page</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <style>

    table{
      color: white;
      text-align: center;
    }
    table,tr,th,td{
      border: 1px solid grey;
      height: 50px;
    }
    th{
      width: 300px;
      color: yellow;
    }

  </style>
</head>

<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange";>Enter your Registered Email.</h1><br>
            
            <p class="text-center" style="color: white";>

              <form name="validate" action="" method="post" onsubmit="return validateForm()">

          <input type="email" name="emailid" required="" placeholder="someone@gmail.com" autocomplete="off"><br><br><br>

          <input class="btn btn-dec py-3 px-8" type="submit" name="forgot_pass_submit" value="Submit">

          <script  type="text/javascript">
            function validateForm()
            {
              var x=document.forms["validate"]["emailid"].value;
              if (x==null || x=="")
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