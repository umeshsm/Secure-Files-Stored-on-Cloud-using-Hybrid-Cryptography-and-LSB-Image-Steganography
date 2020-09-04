<?php

include('connect.php');
include('session.php');


if(isset($_POST["id"]))
{

$result = mysqli_query($conn,"SELECT description FROM files_encrypted WHERE id = '".$_POST["id"]."'");


 $row = $result->fetch_assoc();

 $output = '';

  $output .= '
  <p style="font-size:16px;font-family: Lucida Console, Courier, monospace"> '.$row["description"].' </p>
  ';

 echo $output;
}

?>
