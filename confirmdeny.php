
    <?php

    ob_start();
    include('session.php');

	if ($_GET['usrname1'] && $_GET['flname1'] ) {
      
  	$deny_user = $_GET['usrname1'];
  	$deny_fname = $_GET['flname1'];

  	$_SESSION['deny_fname'] = $deny_fname;
  	$_SESSION['deny_user'] = $deny_user;
  	
    }

    ?>
    
    <script text="text/javascript">
    
    var u = '<?php echo $deny_user; ?>';
    var f = '<?php echo $deny_fname; ?>';

    var c = confirm("Are you Sure you want to Deny Request from " + u + " for the file " + f + " ?");

    if(c == true) {
        var deny_reason = prompt("Reason for Deny (optional)");
        if(deny_reason == ''){
            deny_reason = "No Specific Reason";
        }

        window.location.href = "./requestdenied.php?deny_reason=" + deny_reason;
    }
    else{
        window.history.back();
    }
    
</script>

