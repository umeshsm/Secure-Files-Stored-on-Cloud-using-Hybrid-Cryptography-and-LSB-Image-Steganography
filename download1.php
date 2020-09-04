<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
}

include('session.php');

$enc_down_filename = $_SESSION['enc_down_filename'];

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