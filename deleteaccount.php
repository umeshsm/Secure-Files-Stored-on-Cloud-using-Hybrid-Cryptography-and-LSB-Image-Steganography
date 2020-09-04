
<?php

	ob_start();

	include('session.php');
	include('connect.php');
  	    
    $result1 = mysqli_query($conn,"DELETE FROM files_encrypted WHERE uname = '$uname'");
    $result4 = mysqli_query($conn,"DELETE FROM encrypted_pass WHERE uname = '$uname'");
    $result5 = mysqli_query($conn,"DELETE FROM encrypted_files_joined WHERE uname = '$uname'");
    $result7 = mysqli_query($conn,"DELETE FROM requests WHERE to_user = '$uname'");
    $result8 = mysqli_query($conn,"DELETE FROM requests WHERE from_user = '$uname'");
    $result9 = mysqli_query($conn,"DELETE FROM user WHERE uname = '$uname'");
    
    echo "<SCRIPT> 
            alert('Your Account has been Removed Successfully.')
            window.location.replace('./logout.php');
        </SCRIPT>";
    
?>

