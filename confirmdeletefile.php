
    <?php

    ob_start();
    include('session.php');

    if ($_GET['flname1']) {
      
  	$del_fname = $_GET['flname1'];
  	$_SESSION['del_fname'] = $del_fname;
  	
    }

    ?>
    
    <script text="text/javascript">
    
    var f = '<?php echo $del_fname; ?>';

    var c = confirm("Are you Sure you want to delete the file " + f + " ?");

    if(c == true) {
        
        window.location.href = "./deletefile.php";
    }
    else{
        window.history.back();
    }
    
</script>

