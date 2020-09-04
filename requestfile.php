<?php

ob_start();

include('header.php');
include('session.php');

$err = 0;
    
if ($_GET['usrname1'] &&  $_GET['flname1'] &&  $_GET['purpose']){
      
$req_uname = $_GET['usrname1'];
$req_fname = $_GET['flname1'];
$req_purpose = $_GET['purpose'];
    
$_SESSION['request_fname'] = $req_fname;
$_SESSION['request_uname'] = $req_uname;
$_SESSION['request_purpose'] = $req_purpose;

$result = mysqli_query($conn,"SELECT description FROM files_encrypted where file_name = '$req_fname';");
$row = $result->fetch_assoc();
$desc = $row["description"];
    
$sql = "SELECT file_name, to_user FROM requests WHERE from_user = '$uname' ; ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $f = $row["file_name"];
    $to = $row["to_user"];
    
    if($f == $req_fname && $to == $req_uname){
        
        $err = 1;
        echo "<script type='text/javascript'>
                var f = '$req_fname';
                alert('Request already sent for the file ' + f)
                window.location.replace('./allfiles.php');
            </script>";
    }
}
}

if($err == 0){
  date_default_timezone_set("Asia/Kolkata");  
  $datetime = date("d / m / Y  h : i : s a");
  $query1 = "insert into requests(file_name,description,purpose,to_user,from_user,req_date) values ('$req_fname','$desc','$req_purpose','$req_uname','$uname','$datetime')";
  $result1 = mysqli_query($conn,$query1) or die(mysqli_query($conn));

  $enc_filename = str_replace(".txt","_Encrypted.txt",$req_fname);
  $_SESSION['enc_down_filename'] = $enc_filename;

  header('Location: requestsent.php');

}
}


?>