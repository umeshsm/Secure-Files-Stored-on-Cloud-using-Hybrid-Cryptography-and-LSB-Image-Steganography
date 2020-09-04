<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
}

include('session.php');
include('connect.php');

if ($_GET['usrname1'] &&  $_GET['flname1']){
      
    $req_uname = $_GET['usrname1'];
    $req_fname = $_GET['flname1'];
    
    $result = mysqli_query($conn,"SELECT file_content FROM encrypted_files_joined where uname = '$req_uname' and file_name = '$req_fname' ");

    while ($row = $result->fetch_assoc()) {

        $file_content = $row["file_content"];

    }
    
    $enc_down_filename = str_replace(".txt","_Encrypted.txt",$req_fname);
    
    $f2 = fopen("Encrypted files list/$enc_down_filename", "w");
 	fwrite($f2, $file_content);
 	fclose($f2);
    
}

$filename = "Encrypted files list/$enc_down_filename";      
header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private', false); 
header('Content-Type: application/pdf');

header('Content-Disposition: attachment; filename="'. basename($filename) . '";');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($filename));

readfile($filename);

exit;

?>