<?php   

if(!isset($_SESSION)) 
{ 
  session_start(); 
}
session_unset(); 
session_destroy(); 
unset($_SESSION['login_user']);
header('Location: index.php'); 

exit();

?>
