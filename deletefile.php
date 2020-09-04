<?php

	ob_start();

	include('session.php');
	include('connect.php');
      
  	$del_fname = $_SESSION['del_fname'];

    $result1 = mysqli_query($conn,"DELETE FROM files_encrypted WHERE file_name = '$del_fname' and uname = '$uname'");
    $result4 = mysqli_query($conn,"DELETE FROM encrypted_pass WHERE file_name = '$del_fname' and uname = '$uname'");
    $result5 = mysqli_query($conn,"DELETE FROM encrypted_files_joined WHERE file_name = '$del_fname' and uname = '$uname'");
    $result7 = mysqli_query($conn,"DELETE FROM requests WHERE file_name = '$del_fname' and to_user = '$uname'");
    $result8 = mysqli_query($conn,"DELETE FROM requests WHERE file_name = '$del_fname' and from_user = '$uname'");
    
    header('Location: myfiles.php');


?>