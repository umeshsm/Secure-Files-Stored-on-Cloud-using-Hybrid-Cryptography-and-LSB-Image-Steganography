<?php

if(!isset($_SESSION)) 
{ 
  session_start(); 
}
//Enter the following details
$hostname = "";
$username = "";
$password = "";
$dbname="";

$conn = new mysqli($hostname, $username, $password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "";

?>