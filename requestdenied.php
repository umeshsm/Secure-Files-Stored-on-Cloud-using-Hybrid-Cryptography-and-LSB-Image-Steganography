<?php

	ob_start();

	include('session.php');
	include('connect.php');
	
	$deny_fname = $_SESSION['deny_fname'];
  	$deny_uname = $_SESSION['deny_user'];
	
	if ($_GET['deny_reason']) {
      
  	$deny_reason = $_GET['deny_reason'];
  	
  	$result = mysqli_query($conn,"SELECT email FROM user where uname = '$deny_uname';");

    while ($row = $result->fetch_assoc()) {

        $to_emailid = $row["email"];

    }

  	$sql = "DELETE FROM requests WHERE file_name = '$deny_fname' and from_user = '$deny_uname'";

  	if ($conn->query($sql) === TRUE) {
  	    
  	    $to      = $to_emailid;
        $subject = 'File Request DENIED.';
        $message = 'We are sorry to inform you that your request for the File '.$deny_fname.' has been DENIED by '.$uname."\r\n\r\n" . 'Reason for Deny : ' .$deny_reason;
		//Enter your email below
		$headers = 'From: SecureCloud <youremailid@gmail.com>' . "\r\n" .
                    'Reply-To: '. $to_emailid . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
  	    
    	header('Location: requests.php');
  	}

}
?>