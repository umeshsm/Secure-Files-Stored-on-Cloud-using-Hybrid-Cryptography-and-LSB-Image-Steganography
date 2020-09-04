<?php

ob_start();

include('header.php');
include('session.php');

if(isset($_FILES['uploaded-file'])) {
    
$err = 0;

$errors = array();
$file_name = $_FILES['uploaded-file']['name'];
$file_size =$_FILES['uploaded-file']['size'];
$file_tmp =$_FILES['uploaded-file']['tmp_name'];
$file_type=$_FILES['uploaded-file']['type'];
$file_ex=explode('.',$file_name);
$file_ext=strtolower(end($file_ex));
$extensions= array("png");

if(in_array($file_ext,$extensions)=== false){
  $err = 1;
  $errors[]="extension not allowed, please choose a PNG (.png) file.";
  echo "<script type='text/javascript'> alert('Enter a Valid PNG (.png) Image !'); </script>";
}
else{
$INTEGER_BITS = 32;
$src = $_FILES['uploaded-file']['tmp_name'];
$image = imagecreatefrompng($src);

$size = getimagesize($src);
$width = $size[0];
$height = $size[1];

// Returns the message length in bits as an integer.
function decodeMessageLength($image, $width, $height) {
    // We need to process the first 32 LSB's of the image to retrieve the int.
    $numOfBits = 32;
    $bitIndex = 0;
    $binaryMessageLength = 0;
    for($y = 0; $y < $height; $y++) {
        for($x = 0; $x < $width; $x++) {
            $rgb = imagecolorat($image, $x, $y);
            // We extract each component's LSB by simply ANDing with 1.
            $r = ($rgb >> 16) & 1;
            $g = ($rgb >> 8) & 1;
            $b = $rgb & 1;

            $binaryMessageLength = ($bitIndex++ < $numOfBits) ? (($binaryMessageLength << 1) | $r) : $binaryMessageLength;
            $binaryMessageLength = ($bitIndex++ < $numOfBits) ? (($binaryMessageLength << 1) | $g) : $binaryMessageLength;
            $binaryMessageLength = ($bitIndex++ < $numOfBits) ? (($binaryMessageLength << 1) | $b) : $binaryMessageLength;

            if($bitIndex >= $numOfBits) {
                return $binaryMessageLength;
            }
        }
    }
}

function decodeBinaryMessage($image, $width, $height, $offset, $messageLength) {
    $offsetRemainder = $offset % 3;
    // We get 3 bits for each pixel, so the offset needs to be divided by 3.
    $offset /= 3;
    // Instead of looping through all the pixels, an offset is used for the starting indices.
    $line = $offset / $width;
    $col = $offset % $width;
    $binaryMessage = '';
    $bitIndex = 0;
    for($y = $line; $y < $height; $y++) {
        for($x = $col; $x < $width; $x++) {
            $rgb = imagecolorat($image, $x, $y);
            // We extract each component's LSB by simply ANDing with 1.
            $r = ($rgb >> 16) & 1;
            $g = ($rgb >> 8) & 1;
            $b = $rgb & 1;

            // Depending on the remainder, we will start with a different LSB.
            if($offsetRemainder == 1) {
                $binaryMessage .= $g;
                $binaryMessage .= $b;
                $offsetRemainder = 0;
                $bitIndex += 2;
            } else if($offsetRemainder == 2) {
                $binaryMessage .= $b;
                $offsetRemainder = 0;
                $bitIndex++;
            } else {
                // As long as the bit index is lower than the length of the message, concatenate each component's LSB to the message.
                $binaryMessage = ($bitIndex++ < $messageLength) ? ($binaryMessage.$r) : $binaryMessage;
                $binaryMessage = ($bitIndex++ < $messageLength) ? ($binaryMessage.$g) : $binaryMessage;
                $binaryMessage = ($bitIndex++ < $messageLength) ? ($binaryMessage.$b) : $binaryMessage;

                if($bitIndex >= $messageLength) {
                    return $binaryMessage;
                }
            }
        }
    }
}

$decodedMessageLength = decodeMessageLength($image, $width, $height);
$decodedBinaryMessage = decodeBinaryMessage($image, $width, $height, $INTEGER_BITS, $decodedMessageLength);

$decodedMessage = implode(array_map('chr', array_map('bindec', str_split($decodedBinaryMessage, 8))));

imagedestroy($image);

$_SESSION['decodedMessage'] = $decodedMessage;

header('Location: decoded.php');

}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Decode Page</title>
</head>

<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange";>Upload Stego Image.</h1><br><br><br>
            
            <p class="text-center" style="color: white";>

              <form name="validate" action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

                <input class="btn btn-upload py-3 px-8" type="file" name="uploaded-file" /><br><br><br>

                <input class="btn btn-tango py-3 px-8" type="submit" name="submit" value='Decode'/>

                <script  type="text/javascript">
                
                function validateForm()
                {
                    var x=document.forms["validate"]["uploaded-file"].value;
              
                    if (x==null || x=="")
                    {
                        alert("Enter Valid Stego Image (.png) !");
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