<?php

ob_start();
include('header.php');
include('session.php');

if(isset($_FILES['uploaded-file'])){

  $errors= array();
  $file_name = $_FILES['uploaded-file']['name'];
  $file_size =$_FILES['uploaded-file']['size'];
  $file_tmp =$_FILES['uploaded-file']['tmp_name'];
  $file_type=$_FILES['uploaded-file']['type'];
  $file_ex=explode('.',$file_name);
  $file_ext=strtolower(end($file_ex));
  $extensions= array("txt");

  $fnames = explode("_Enc", $file_name);
  $fname123 = $fnames[0];

$_SESSION['dec_file_size'] = $file_size;
$_SESSION['dec_file_name'] = $file_name;
$_SESSION['fname123'] = $fname123;
 
  if(in_array($file_ext,$extensions)=== false){
    $errors[]="extension not allowed, please choose a TEXT (.txt) file.";
    echo "<script type='text/javascript'> alert('Enter a Valid Text (.txt) File !'); </script>";
  }
      
  else if($file_size > 2097152 || $file_size==0){
    $errors[]='File size must be between 0 to 2 MB';
    echo "<script type='text/javascript'> alert('Enter a Valid Text (.txt) File of Size : > 1 Kb & < 2 Mb !'); </script>";
  }
        
  else{
    move_uploaded_file($file_tmp,"files uploaded/".$file_name);
    header("Location: decryptuploaded.php");
  }

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Decrypt Upload Page</title>
</head>
<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">

            <h1 class="mb-3" style="color: orange">Upload the Encrypted File</h1><br><br>
            
            <p class="text-center">
              
              <form name="validate" action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

         		<input class="btn btn-upload py-3 px-8" type="file" name="uploaded-file" /><br><br><br><br>

         		<input class="btn btn-tango py-3 px-8" type="submit" name="dec_upload_submit" value='Upload'/>

         		<script  type="text/javascript">
            function validateForm()
            {
              var x=document.forms["validate"]["uploaded-file"].value;
              
              if (x==null || x=="")
              {
                alert("Enter Valid Text (.txt) File !");
                return false;
              }
            }
          </script>


     		 </form>

            </p>

          </div>
        </div>
      </div>
    </div>

</body>
</html>