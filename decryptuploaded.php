<?php

ob_start();
include('header.php');
include('session.php');

$file_size = $_SESSION['dec_file_size'];
$dec_file_name = $_SESSION['dec_file_name'];
 
function function_alert($msg) {
  echo "<script type='text/javascript'> alert('$msg'); </script>";
}
         
function_alert("File Uploaded Successfully.");

$up_data = file_get_contents("files uploaded/$dec_file_name");

$arr = explode('@MiD*',$up_data);
$parts = $arr[0];
$keys = $arr[1];

$arr1 = explode('%oK#',$parts);
$part1 = $arr1[0];
$part2 = $arr1[1];
$part3 = $arr1[2];

$arr2 = explode('%oR&',$keys);
$pass_key1 = $arr2[0];
$pass_key2 = $arr2[1];
$pass_key3 = $arr2[2];


$_SESSION['dec_upload_part1'] = $part1;
$_SESSION['dec_upload_part2'] = $part2;
$_SESSION['dec_upload_part3'] = $part3;
$_SESSION['pass_key1'] = $pass_key1;
$_SESSION['pass_key2'] = $pass_key2;
$_SESSION['pass_key3'] = $pass_key3;

?>

<script type="text/javascript">
  var val="<?php echo $file_size; ?>";
  alert("File Size : " +val+ " Kb"); 
</script>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Decrypt Uploaded Page</title>
 </head>
    <style>
     table{
      color: white;
      position: center;
    }
    th{
      width: 25%;
      color: orange;
      height: 50px;
    }
    td{
      width:  100%;
      height: 50px;
    }
    table,tr,th,td{
      border: 1px solid grey;
    }
  </style>
 <body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange">Split Files.</h1><br><br>
            <p class="text-center" style="color: white;">

           <table align="center">
                <tr><th style="height: 50px">Parts</th><th style="height: 50px">Split File Data</th></tr>
            <?php

            echo "<tr><th style='color:yellow'> Part 1 </th> <td> $part1 </td></tr>";
            echo "<tr><th style='color:yellow'> Part 2 </th> <td> $part2 </td></tr>";
            echo "<tr><th style='color:yellow'> Part 3 </th> <td> $part3 </td></tr>";

            ?>
          </p>
        </table>
        <br><br>

          <input class="btn btn-download py-3 px-8" type=button onClick="location.href='decrypt1.php'" value='Decrypt File'>

          </div>
        </div>

      </div>
    </div>

</body>
</html>