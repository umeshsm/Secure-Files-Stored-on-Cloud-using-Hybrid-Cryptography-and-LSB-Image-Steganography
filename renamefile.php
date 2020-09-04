<?php

ob_start();

include('connect.php');
include('session.php');

if ($_GET['rname'] &&  $_GET['oname']) {
      
    $new_fname = $_GET['rname'];
    $old_fname = $_GET['oname'];
    
    $query1 = "UPDATE files_encrypted SET file_name = '$new_fname' where file_name = '$old_fname'";
    $result1 = mysqli_query($conn,$query1) or die(mysqli_error($conn));
    
    $query2 = "UPDATE encrypted_files_joined SET file_name = '$new_fname' where file_name = '$old_fname'";
    $result2 = mysqli_query($conn,$query2) or die(mysqli_error($conn));
    
    $query3 = "UPDATE encrypted_pass SET file_name = '$new_fname' where file_name = '$old_fname'";
    $result3 = mysqli_query($conn,$query3) or die(mysqli_error($conn));
    
    $query4 = "UPDATE requests SET file_name = '$new_fname' where file_name = '$old_fname'";
    $result4 = mysqli_query($conn,$query4) or die(mysqli_error($conn));

    echo "<SCRIPT> 
        alert('File renamed Successfully.')
        window.location.replace('./myfiles.php');
        </SCRIPT>";

}

?>
