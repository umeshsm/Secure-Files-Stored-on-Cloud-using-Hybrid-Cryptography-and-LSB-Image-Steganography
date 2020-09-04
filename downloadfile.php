<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
}

include('session.php');
include('connect.php');

if ($_GET['flname1']) {
      
  	$temp_fname = $_GET['flname1'];

  	$down_fname = str_replace(".txt","_Encrypted.txt",$temp_fname);

  	$result = mysqli_query($conn,"SELECT file_content FROM encrypted_files_joined WHERE file_name = '$temp_fname' and uname = '$uname'");

  	while ($row = $result->fetch_assoc()) {
  		$down_content = $row["file_content"];
  	}

  	$files = fopen("Encrypted files list/$down_fname", "w");

	fwrite($files, $down_content);

	fclose($files);

}

$filename = "Encrypted files list/$down_fname";      
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