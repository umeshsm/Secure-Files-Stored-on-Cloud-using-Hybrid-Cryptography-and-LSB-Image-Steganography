<?php

include('header.php');
include('session.php');
include('AES.php');


$sql = "SELECT uname,password,email,phno FROM user where uname = '$uname' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
  while($row = $result->fetch_assoc()) {
      $c_uname = $row["uname"];
      $c_pass = $row["password"];
      $c_email = $row["email"];
      $c_phno = $row["phno"];
  }

}

$sql2 = "SELECT uname, email, phno FROM user where uname != '$uname'  ";
$result2 = $conn->query($sql2);

if(isset($_POST['submit']))      
{
  $user = $_POST['username'];
  $pass = $_POST['password'];
  $email = $_POST['email'];
  $phno = $_POST['phno'];
  
  $user = strtolower($user);
  
  if($pass == $c_pass){
      $pass = $c_pass;
  }
  else{
      $pass = Encrypt_Aes($pass, "123");
  }

  $flag = 0;

  if ($result2->num_rows > 0) {
    
    while($row = $result2->fetch_assoc()) {
      $u1 = $row["uname"];
      $u2 = $row["email"];
      $u3 = $row["phno"];

      if ($u1 == $user) {
            
        echo " <script type='text/javascript'> alert('Username already Exists! \\nPlease enter a different Username.'); </script> ";

        $flag = 1;
          
      }

      if ($u2 == $email) {
            
        echo " <script type='text/javascript'> alert('Email already Exists! \\nPlease enter a different one.'); </script> ";

        $flag = 1;
          
      }
      

      if ($u3 == $phno) {
            
        echo " <script type='text/javascript'> alert('Mobile Number already Exists! \\nPlease enter a different one.'); </script> ";

        $flag = 1;
          
      }

    }
  }
  else {
    echo "0 results";
  }

  if($flag == 0){

    $old_uname = $uname;
    
    $_SESSION['new_email'] = $email;
  
    $query1 = "UPDATE user SET uname = '$user', password = '$pass', phno = '$phno' where uname = '$old_uname'";
    $result1 = mysqli_query($conn,$query1) or die(mysqli_error($conn));

    $query2 = "UPDATE encrypted_files_joined SET uname = '$user' where uname = '$old_uname'";
    $result2 = mysqli_query($conn,$query2) or die(mysqli_error($conn));

    $query3 = "UPDATE encrypted_pass SET uname = '$user' where uname = '$old_uname'";
    $result3 = mysqli_query($conn,$query3) or die(mysqli_error($conn));

    $query5 = "UPDATE files_encrypted SET uname = '$user' where uname = '$old_uname'";
    $result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));

    $query8 = "UPDATE requests SET to_user = '$user' where to_user = '$old_uname'" ;
    $result8 = mysqli_query($conn,$query8) or die(mysqli_error($conn));

    $query9 = "UPDATE requests SET from_user = '$user' where from_user = '$old_uname'" ;
    $result9 = mysqli_query($conn,$query9) or die(mysqli_error($conn));

    $_SESSION['login_user'] = $user;
        
    if($c_email == $email){
        echo "<SCRIPT> 
        alert('Profile Updated Successfully.')
        window.location.replace('./editprofile.php');
    </SCRIPT>";
    }
    else{
           
        $otp = rand(100000,999999);
    
        $to      = $email;
        $subject = 'Email Verification Code.';
        $message = 'Verify your Email to continue with SecureCloud.'."\r\n\r\n".'Verification Code : '.$otp."\r\n\r\n\r\n\r\n".'Thank you'."\r\n\r\n".'SecureCloud Team';
        $headers = 'From: SecureCloud <securecloud1000@gmail.com>' . "\r\n" .
                    'Reply-To: '. $email . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
        
        mail($to, $subject, $message, $headers);

        $_SESSION['new_email'] = $email;
        $_SESSION['new_otp'] = $otp;
        
        header('location:verifynewemail.php');
      }
        
        

}
}

?>



<!DOCTYPE html>
<html>
<head>
  <title>Edit Profile Page</title>
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
  </style>
</head>
<body>
                           
    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange">Edit Profile</h1>
            
            <br>
            
            <p class="text-center" style="color: white;">
              
             <form name="validate" action="" method="post" onsubmit="return validateForm()">

              <table align="center">                   
              <tr><td>

              <label for="uname" style="color:orange">Username</label>
              </td><td>
                <input type="text" name="username" autocomplete="off" placeholder="enter your username" value="<?php echo $c_uname ?>" />
              </td></tr>

                <tr><td>
          
                <label  style="color:orange">Password</label>
              </td><td>
                <input type="password" name="password" placeholder="enter your password" value="<?php echo $c_pass ?>"/>

                </td></tr>
                <tr><td>

                <label style="color:orange">Re-enter Password</label>
              </td><td>
                <input type="password" name="repassword" placeholder="re-enter your password" value="<?php echo $c_pass ?>"/>

                </td></tr>
                <tr><td>

                <label style="color:orange">Email Id</label>
                </td><td>
                <input type="email" name="email" autocomplete="off" placeholder="enter your email-id" value="<?php echo $c_email ?>"/>

                </td></tr>
                <tr><td>

                <label style="color:orange">Mobile Number</label>
                </td><td>
                <input type="tel" name="phno" autocomplete="off" placeholder="enter your phone no." value="<?php echo $c_phno?>"/>

                </td></tr>
              </table>
                <br>
                <br>

                <input class="btn btn-enc py-3 px-8" type="submit" name="submit" value='Update'/>
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
                      alert("Please enter All Details!");
                      return false;
                    }

                    if (b != c)
                    {
                      alert("Your Passwords did not match!");
                      return false;
                    }

                    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

                if (reg.test(d) == false) 
                {
                    alert('Invalid Email Address! \\nPlease enter a Valid one.');
                    return false;
                }

              if(e.length != 10)
              {
                  alert('Invalid Mobile Number! \\nPlease enter a Valid one.');
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