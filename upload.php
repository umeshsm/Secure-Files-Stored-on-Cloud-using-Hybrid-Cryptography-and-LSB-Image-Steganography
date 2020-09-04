<?php

ob_start();

include('header.php');
include('session.php');

if(isset($_FILES['uploaded-file'])){

$err = 0;

$errors= array();
$file_name = $_FILES['uploaded-file']['name'];
$file_size =$_FILES['uploaded-file']['size'];
$file_tmp =$_FILES['uploaded-file']['tmp_name'];
$file_type=$_FILES['uploaded-file']['type'];
$file_ex=explode('.',$file_name);
$file_ext=strtolower(end($file_ex));
$extensions= array("txt");

$file_name = strtolower($file_name);

$file_content = file_get_contents($_FILES['uploaded-file']['tmp_name']);

if(in_array($file_ext,$extensions)=== false){
  $err = 1;
  $errors[]="extension not allowed, please choose a TEXT (.txt) file.";
  echo "<script type='text/javascript'> alert('Enter a Valid Text (.txt) File !'); </script>";
}
      
else if($file_size > 2097152 || $file_size==0){
  $err = 1;
  $errors[]='File size must be between 0 to 2 MB';
  echo "<script type='text/javascript'> alert('Enter a Valid Text (.txt) File of Size : > 1 Kb & < 2 Mb !'); </script>";
}

if($_POST['desc'] == ''){
    $desc = 'No Description Found...';
}
else{
    $desc = $_POST['desc'];
}

$_SESSION['desc_input'] = $desc;

$sql = "SELECT file_name FROM files_encrypted; ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $f = $row["file_name"];
    
    var_dump($f);
    var_dump($file_name);

    if( $f == $file_name ) {
        
        $err = 1;

        $_SESSION['file_size'] = $file_size;
        $_SESSION['file_content'] = $file_content;

        header("Location: uploadchoose.php");

    }
  }
}

if($err == 0){

  $_SESSION['file_size'] = $file_size;
  $_SESSION['file_name'] = $file_name;
  $_SESSION['file_content'] = $file_content;

  move_uploaded_file($file_tmp,"files uploaded/".$file_name);
  header("Location: uploaded.php");

}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Upload Page</title>
	
	<style>
textarea {
  width: 30%;
  min-height: 100px;
  resize: none;
  border-radius: 8px;
  border: 1px solid #ddd;
  padding: 0.5rem;
  color: #666;
  box-shadow: inset 0 0 0.25rem #ddd;
  &:focus {
    outline: none;
    border: 1px solid darken(#ddd, 5%);
    box-shadow: inset 0 0 0.5rem darken(#ddd, 5%);
  }
  &[placeholder] { 
    font-style: italic;
    font-size: 0.875rem;
  }
}

#the-count {
  /*float: right;*/
  padding: 0.1rem 0 0 0;
  font-size: 0.875rem;
  /*color:grey;*/
}    
	</style>
	
</head>
<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">

            <h1 class="mb-3" style="color: orange">Upload Your File</h1><br>
            
            <p class="text-center">
              
            <form name="validate" action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

         		<input class="btn btn-upload py-3 px-8" type="file" name="uploaded-file" />
         		
         		<br><br>
         		
         		
         		<label style="color:yellow">Description (optional) : </label><br>
         		<center>
                <textarea name="desc" maxlength="300" placeholder="Start Typin..." ></textarea> 
                <div id="the-count">
                    <span id="current">0</span>
                    <span id="maximum">/ 300</span>
                </div>
                </center>
                
                <br>
                
         		<input class="btn btn-tango py-3 px-8" type="submit" name="submit" value='Upload'/>

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

<script>
    $('textarea').keyup(function() {
    
  var characterCount = $(this).val().length,
      current = $('#current'),
      maximum = $('#maximum'),
      theCount = $('#the-count');
    
  current.text(characterCount);
 
  
  /*This isn't entirely necessary, just playin around*/
  if (characterCount < 70) {
    current.css('color', '#666');
  }
  if (characterCount > 70 && characterCount < 90) {
    current.css('color', '#6d5555');
  }
  if (characterCount > 90 && characterCount < 100) {
    current.css('color', '#793535');
  }
  if (characterCount > 100 && characterCount < 120) {
    current.css('color', '#841c1c');
  }
  if (characterCount > 120 && characterCount < 139) {
    current.css('color', '#8f0001');
  }
  
  if (characterCount >= 140) {
    maximum.css('color', '#8f0001');
    current.css('color', '#8f0001');
    theCount.css('font-weight','bold');
  } else {
    maximum.css('color','#666');
    theCount.css('font-weight','normal');
  }
  
      
});
</script>