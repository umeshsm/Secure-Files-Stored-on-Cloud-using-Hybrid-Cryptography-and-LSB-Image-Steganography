<script type="text/JavaScript">

function createNewElement() {
    // First create a DIV element.
  var txtNewInputBox = document.createElement('div');

    // Then add the content (a new input box) of the element.
  txtNewInputBox.innerHTML = "<br><br><form method='post'><label style='color:yellow'>Enter a different name (Exclude dot(.) Extension)  :</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' autocomplete='off' name ='renamed_file' required=''><label style='color:yellow'>&nbsp; .txt</label><br><br><input class='btn btn-enc py-3 px-6' type='submit' name='ren_submit' value='Rename'></form><br><br>";

    // Finally put it where it is supposed to appear.
  document.getElementById("newElementId").appendChild(txtNewInputBox);
}

</script>

<?php

ob_start();
include('header.php');
include('session.php');

$err = 0;

$file_size = $_SESSION['file_size'];
$file_content = $_SESSION['file_content'];

$result = mysqli_query($conn,"SELECT file_name FROM files_encrypted;");

if ($result->num_rows > 0) {

  $i = 0;
    
  while($row = $result->fetch_assoc()) {

    $f[$i] = $row["file_name"];

    $i = $i + 1;

    
  }
}

if (isset($_POST['ren_submit'])) {
      
  $rename_bfr = $_POST['renamed_file'];
  $rename_bfr = strtolower($rename_bfr);
  
    if(strpos($rename_bfr, '.' ) !== false){
    $err = 1;
    echo " <script type='text/javascript'> alert('Filename is Invalid! \\nEnter a filename without dot(.) Extensions.'); </script> ";
    } 

  $rename = $rename_bfr . ".txt";

  for ($k=0; $k < $i; $k++) {

    if ($f[$k] == $rename) {

      $err = 1;
              
      echo " <script type='text/javascript'> alert('Filename already exists! \\nEnter some other name.'); </script> ";

    }
  
  }

if ($err == 0) {

  $file_name = $rename;

  $_SESSION['file_size'] = $file_size;
  $_SESSION['file_name'] = $file_name;
  $_SESSION['file_content'] = $file_content;
  
  if($file_size > 2097152 || $file_size==0){
  $err = 1;
  $errors[]='File size must be between 0 to 2 MB';
  echo "<script type='text/javascript'> alert('Enter a Valid Text (.txt) File of Size : > 1 Kb & < 2 Mb !'); </script>";
}
else{
  $fh = fopen("files uploaded/$file_name", 'w');
  fwrite($fh, $file_content);
  fclose($fh);

    header('Location: uploaded.php');
}
}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Upload Choose Page</title>
</head>
<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">

            <h1 class="mb-3" style='color:orange'>Filename Exists.</h1><br><br>
            
            <p class="text-center">

            <a href="upload.php" class="btn btn-long py-3 px-6">Upload a different File</a>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<<label style="color: gold">OR</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" class="btn btn-long py-3 px-6" value="Rename the current File" onclick="createNewElement();">

            <div  id="newElementId"></div>

            </p>

          </div>
        </div>
      </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>
</html>