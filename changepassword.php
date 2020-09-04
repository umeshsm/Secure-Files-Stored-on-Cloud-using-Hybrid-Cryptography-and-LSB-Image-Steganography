<?php

include('header.php');
include('session.php');
include('AES.php');

if(isset($_POST['submit']))      
{

  $sql = "SELECT password FROM user where uname = '$uname' ";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      $c_pass = $row["password"];
    }
  }

  $current_pass = $_POST['current_pass'];
  $pass = $_POST['password'];
  
  $pass = Encrypt_Aes($pass, "123");
  $current_pass = Encrypt_Aes($current_pass, "123");

  if ($current_pass == $c_pass) {

      $query = "UPDATE user SET password = '$pass' where uname = '$uname'";
      $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

      if($result)
      {
          echo "<script type='text/javascript'> alert('Password Changed Successfully.') </script>";
      }
    
  }
  else{
    echo "<script type='text/javascript'> alert('Invalid Current Password!') </script>";
  }

}

?>



<!DOCTYPE html>
<html>
<head>
  <title>Change Password Page</title>
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
            <h1 class="mb-3" style="color: orange">Change Password</h1>
            
            <br>
            
            <p class="text-center" style="color: white;">
              
             <form name="validate" action="" method="post" onsubmit="return validateForm()">

              <table align="center">                   
              <tr><td>
              <label for="current_pass" style="color:orange">Enter Current Password</label>
              </td><td>
                <input type="password" name="current_pass" placeholder="enter current password" required=""/>
              </td></tr>

                <tr><td>
          
                <label  style="color:orange">Enter New Password</label>
              </td><td>
                <input type="password" name="password" placeholder="enter new password" required="" />

                </td></tr>
                <tr><td>

                <label style="color:orange">Confirm New Password</label>
              </td><td>
                <input type="password" name="repassword" placeholder="re-enter new password" required="" />

                </td></tr>
              </table>
                <br>
                <br>

                <input class="btn btn-enc py-3 px-8" type="submit" name="submit" value='Submit'/>


                <script  type="text/javascript">
                function validateForm()
                {
                    var a = document.forms["validate"]["current_pass"].value;
                    var b = document.forms["validate"]["password"].value;
                    var c = document.forms["validate"]["repassword"].value;

                    if (a==null || a=="" || b==null || b=="" || c==null || c=="")
                    {
                      alert("Please enter All Details!");
                      return false;
                    }

                    if (a == b)
                    {
                      alert("Your new Password cannot be your Current Password!");
                      return false;
                    }

                    if (b != c)
                    {
                      alert("Your new Passwords did not match!");
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