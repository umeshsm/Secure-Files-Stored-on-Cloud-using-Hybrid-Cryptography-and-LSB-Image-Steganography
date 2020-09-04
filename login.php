<?php

session_start();
include('header.php');
include('AES.php');

$user="";
$pass="";
$userError="";
$passError="";

if(isset($_POST['submit']))       
{
  $user= $_POST['uname'];
  $pass= $_POST['password'];
  
  $pass = Encrypt_Aes($pass, "123");

  if(empty($_POST['uname']))
  {
    $userError="required";
  }
  if(empty($_POST['password']))
  {
    $passError="required";
  }
  if(!$userError && !$passError)
  {
    $query = "select * from user where uname = '$user' and  password = '$pass';";
    $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
    $num=mysqli_num_rows($result);

    if($num==1)
    {
        $this_ip = getenv("REMOTE_ADDR") ; 
        
        $result2 = mysqli_query($conn,"SELECT email,ipaddress FROM user where uname = '$user';");

        while ($row = $result2->fetch_assoc()) {
            $email = $row["email"];
            $ip = $row["ipaddress"];
        }
        
        $ip_Array = explode("###&&&",$ip);
        $err =0;
        foreach ($ip_Array as $value){
            if($value == $this_ip){
                $err=1;
                $_SESSION['login_user'] = $user;
                header('location:index.php');
            }
        }
        
        if($err == 0){
        $otp = rand(100000,999999);
        
        $to      = $email;
        $subject = 'Security Alert';
        $message = 'A Login attempt found on a New Device.'."\r\n\r\n".'Confirm its You.'."\r\n\r\n".'Verification Code : '.$otp."\r\n\r\n\r\n\r\n".'Thank you'."\r\n\r\n".'SecureCloud Team';
        $headers = 'From: SecureCloud <securecloud1000@gmail.com>' . "\r\n" .
                    'Reply-To: '. $email . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                    
        mail($to, $subject, $message, $headers);
        
        $_SESSION['new_device_user'] = $user;
        $_SESSION['new_device_otp'] = $otp;
        $_SESSION['new_device_email'] = $email;
                
        echo "<SCRIPT> 
                alert('This Device is not Registered! \\nVerification Required.')
                window.location.replace('./newdeviceverify.php');
            </SCRIPT>";
        
    }
    }
    else
    {
      echo " <script type='text/javascript'> alert('Invalid Username or Password'); </script> ";
    }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
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

            <h1 class="mb-3" style="color: orange">Sign In</h1>
            
            <br>
            
            <p class="text-center" style="color: white;">
              
             <form name="validate" action="" method="post" onsubmit="return validateForm()">

              <table align="center">
                <tr><td>

                <label  style="color:orange">User name</label>
              </td><td>
                <input type="text" name="uname" autocomplete="off" placeholder="enter your username" value="<?php echo $user;?>" /><br>

                </td></tr>
                <tr><td>
          
                <label  style="color:orange">Password</label>
                </td><td>
                <input type="password" name="password" placeholder="enter your password" value="" />

                </td></tr>
              </table>
              <br><br>
              
                <input class="btn btn-dec py-3 px-8" type="submit" name="submit" onClick="" value="submit"/>

                <script  type="text/javascript">

                  function validateForm()
                  {
                    var x=document.forms["validate"]["uname"].value;
                    var y=document.forms["validate"]["password"].value;
                    if (x==null || x=="" || y==null || y=="")
                    {
                      alert("Enter Valid Credentials !!");
                      return false;
                    }
                  }
                </script>
 
              </form>

              <br>
              

              <p style="color: white;">Don't have an account? &nbsp;&nbsp;&nbsp;&nbsp;<a href="register.php" style="color: orange;">Sign Up</a>.</p>
              
              <br>
              <a href="forgotpassword.php" style="color: orange;">Forgot Password</a>.</p>
        
            </p>

          </div>
        </div>
      </div>
    </div>
</body>
</html>
