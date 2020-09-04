
<?php

if(!isset($_SESSION))
{ 
  session_start();
}

include('connect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">
  <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
<link rel="stylesheet" href="css/styleup11.css">
<link rel="stylesheet" href="css/styledown06.css">

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>

        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

      <div class="container-fluid">
        <div class="d-flex align-items-center">
            
<?php if(isset($_SESSION['login_user']))
  { 
?> 
<div id="mySidenav" class="sidenav">
  <center>
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  
  <img class="profile_image" src="fonts/profile.png" alt="Profile Image">
  <br>        
  <p class="uname-btn">Hello, <?php echo $_SESSION['login_user'] ?></p>
  <br>
  <a href="editprofile.php">Edit Profile</a>
  <a href="changepassword.php">Change Password</a>
  <a href="confirmdeleteaccount.php">Delete Account</a>
  <a href="logout.php">Logout</a>
  <br>
<?php  date_default_timezone_set("Asia/Kolkata");  ?>
<p style='color:white'>Date : <?php echo(strftime("%d / %m / %Y, %a"));?></p>

  </center>
</div>

<span class="menu-btn" onclick="openNav()">&#9776;</span>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";


}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";

}

</script>
<?php
  }
?>
            
          <div class="site-logo"><a href="index.php"> SecureCloud<span>.</span> </a></div>
          <div class="ml-auto">

            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">

                <li><a style="color: orange"; href="index.php" class="nav-link"><i style='color:#DA1515' class="fa fa-home"></i> Home</a></li>
                

                <?php if(isset($_SESSION['login_user']))
                {
                ?>
                
                <li><a href="upload.php" class="nav-link">Encrypt</a></li>
                <li><a href="decryptchoose.php" class="nav-link">Decrypt</a></li>
                <!--<li><a href="#" class="nav-link">About</a></li>-->
                <li><a href="myfiles.php"> MyFiles</a></li>
                <li><a href="allfiles.php" class="nav-link">All files</a></li>
                <li><a href="requests.php" class="nav-link">Requests</a></li>
                <li><a href="filesharing.php" class="nav-link">Stego Image</a></li>
                <!--<li><a href="logout.php">Logout</a></li>-->

                <?php
                }
                else
                {
                ?>

                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>

                <?php
                }
                ?>
              
              </ul>

            </nav>

            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a>

          </div>
        </div>
      </div>

    </header>

  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>
  <script src="js/main.js"></script>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</body>

</html>
