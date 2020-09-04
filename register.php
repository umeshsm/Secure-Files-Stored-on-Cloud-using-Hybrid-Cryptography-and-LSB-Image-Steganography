<?php

include('header.php');

if(isset($_POST['submit']))      
{
  $user = $_POST['username'];
  $pass = $_POST['password'];
  $repass = $_POST['repassword'];
  $email = $_POST['email'];
  $phno = $_POST['phno'];

  $user = strtolower($user);
    
  $sql = "SELECT uname, email, phno FROM user ; ";
  $result = $conn->query($sql);

  $flag = 0;

  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      $u1 = $row["uname"];
      $u2 = $row["email"];
      $u3 = $row["phno"];

      if ($u1 == $user) {
            
        echo " <script type='text/javascript'> alert('Username already Exists!! \\nPlease enter a different Username.'); </script> ";

        $flag = 1;
          
      }

      if ($u2 == $email) {
            
        echo " <script type='text/javascript'> alert('Email already Exists!! \\nPlease enter a different one.'); </script> ";

        $flag = 1;
          
      }

      if ($u3 == $phno) {
            
        echo " <script type='text/javascript'> alert('Mobile Number already Exists!! \\nPlease enter a different one.'); </script> ";

        $flag = 1;
          
      }

    }
  }
  else {
    echo "0 results";
  }

  if ($flag == 0) {
      
    $otp = rand(100000,999999);
    
    $to      = $email;
    $subject = 'Thank you for registering with SecureCloud';
    $message = 'Verify your Email to continue with SecureCloud.'."\r\n\r\n".'Verification Code : '.$otp."\r\n\r\n\r\n\r\n".'Thank you'."\r\n\r\n".'SecureCloud Team';
    //add your email below
    $headers = 'From: SecureCloud <youremailid@gmail.com>' . "\r\n" .
                'Reply-To: '. $email . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
    
    $_SESSION['reg_uname'] = $user;
    $_SESSION['reg_pass'] = $pass;
    $_SESSION['reg_email'] = $email;
    $_SESSION['reg_phno'] = $phno;
    $_SESSION['reg_otp'] = $otp;

    header('location:verifyaccount.php');

  }

}

?>



<!DOCTYPE html>
<html>
<head>
  <title>Register Page</title>
  <style>
    table{
      color: white;
    }
    table,tr,td{
      border: 1px solid yellow;
    }
    tr,td{
      width: 200px;
    }
    a:link{
        text-decoration:none;
    }
  </style>
</head>
<body>
                           
    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange">Sign Up</h1>
            
            <br>
            
            <p class="text-center" style="color: white;">
              
             <form name="validate" action="" method="post" onsubmit="return validateForm()">

                  <table align="center">                   
                  <tr><td>
                <label for="uname" style="color:orange">Username</label>
              </td><td>
                <input type="text" name="username" autocomplete="off" placeholder="enter your username" />
              </td></tr>

                <tr><td>
          
                <label  style="color:orange">Password</label>
              </td><td>
                <input type="password" name="password" placeholder="enter your password" />

                </td></tr>
                <tr><td>

                <label style="color:orange">Re-enter Password</label>
              </td><td>
                <input type="password" name="repassword" placeholder="re-enter your password" />

                </td></tr>
                <tr><td>

                <label style="color:orange">Email Id</label>
                </td><td>
                <input type="email" name="email" placeholder="enter your email-id" />

                </td></tr>
                <tr><td>

                <label style="color:orange">Mobile Number</label>
                </td><td>
                <input type="tel" name="phno" placeholder="enter your phone no." />

                </td></tr>
              </table>
                <br>
                <br>

                <input class="btn btn-enc py-3 px-8" type="submit" name="submit" value='Register'/>
               <br>
                <br>
                <script  type="text/javascript">
                function validateForm()
                {
                    var a = document.forms["validate"]["username"].value;
                    var b = document.forms["validate"]["password"].value;
                    var c = document.forms["validate"]["repassword"].value;
                    var d = document.forms["validate"]["email"].value;
                    var e = document.forms["validate"]["phno"].value;

                    if (a==null || a=="" || b==null || b=="" || c==null || c=="" || d==null || d=="" || e==null || e=="")
                    {
                      alert("Please enter All Details !!");
                      return false;
                    }

                    if (b != c)
                    {
                      alert("Your Passwords did not match !!");
                      return false;
                    }

                    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

                if (reg.test(d) == false) 
                {
                    alert('Invalid Email Address !! \\nPlease enter a Valid one.');
                    return false;
                }

              if(e.length != 10)
              {
                  alert('Invalid Mobile Number !! \\nPlease enter a Valid one.');
                    return false;
              }

                }

              </script>

                </form>

                <p style="color: white;">Already have an account? &nbsp;&nbsp;&nbsp;&nbsp;<a href="login.php" style="color: orange;">Sign In</a>.</p>
        
            </p>

          </div>
        </div>
      </div>
    </div>
    
</body>
</html>