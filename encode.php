<?php

ob_start();

include('header.php');
include('session.php');
include('functions.php');

$send_fname = $_SESSION['send_fname'];

if(isset($_FILES['uploaded-file'])){

$err = 0;

$errors= array();
$file_name = $_FILES['uploaded-file']['name'];
$file_size =$_FILES['uploaded-file']['size'];
$file_tmp =$_FILES['uploaded-file']['tmp_name'];
$file_type=$_FILES['uploaded-file']['type'];
$file_ex=explode('.',$file_name);
$file_ext=strtolower(end($file_ex));
$extensions= array("jpg");

if(in_array($file_ext,$extensions)=== false){
  $err = 1;
  $errors[]="extension not allowed, please choose a JPG(.jpg) file.";
  echo "<script type='text/javascript'> alert('Enter a Valid JPG (.jpg) Image !'); </script>";
}
else{
$image_name = str_replace(".jpg",".png",$file_name);

$message = $_SESSION['steg_msg'];
$email_to = $_SESSION['steg_email'];
// Number of bytes in an integer.
$INTEGER_BYTES = 4;
$BYTE_BITS = 8;

$binaryMessage = toBinary($message);
// The number of bits contained in the message, aka the size of the payload as an integer.
$messageLength = strlen($binaryMessage);
// Convert the length to binary as well and make sure to pad it with 32 0's.
$binaryMessageLength = str_pad(decbin($messageLength), $INTEGER_BYTES * $BYTE_BITS, "0", STR_PAD_LEFT);


// The payload will incorporate the length and the message.
$payload = $binaryMessageLength.$binaryMessage;

$src = $_FILES['uploaded-file']['tmp_name'];
$image = imagecreatefromjpeg($src);

$size = getimagesize($src);
$width = $size[0];
$height = $size[1];

function encodePayload(string $payload, $image, $width, $height) {
    $payloadLength = strlen($payload);
    // We are able to store 3 bits per pixel (1 LSB for each color channel) times the width, times the height.

    if(($width * $height * 3) < 500000) {
        echo "<script type='text/javascript'> alert('Image too Small !\\nPlease choose a Bigger Image.'); </script>";
    }
    else{
    $bitIndex = 0;
    for($y = 0; $y < $height; $y++) {
        for($x = 0; $x < $width; $x++) {
            $rgb = imagecolorat($image, $x, $y);
            // Each color channel's value is extracted from the original integer.
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;

            // LSB's are cleared by ANDing with 0xFE and filled by ORing with the current payload bit, as long as the payload length isn't hit.
            $r = ($bitIndex < $payloadLength) ? (($r & 0xFE) | $payload[$bitIndex++]) : $r;
            $g = ($bitIndex < $payloadLength) ? (($g & 0xFE) | $payload[$bitIndex++]) : $g;
            $b = ($bitIndex < $payloadLength) ? (($b & 0xFE) | $payload[$bitIndex++]) : $b;

            $color = imagecolorallocate($image, $r, $g, $b);
            imagesetpixel($image, $x, $y, $color);

            if($bitIndex >= $payloadLength) {
                return true;
            }
        }
    }
    }
}
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Encode Page</title>
</head>

<body>

    <div class="intro-section" id="home-section" style="background-color: black;">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1 class="mb-3" style="color: orange";>Choose a JPG Image</h1><br><br>
        
            <p class="text-center" style="color: white";>

            <form name="validate" action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

                <input class="btn btn-upload py-3 px-8" type="file" name="uploaded-file" /><br><br><br><br>

                <input class="btn btn-send py-3 px-8" type="submit" name="submit" value='Encode and Send'/>

                <script  type="text/javascript">
            function validateForm()
            {
              var x=document.forms["validate"]["uploaded-file"].value;
              
              if (x==null || x=="")
              {
                alert("Enter Valid JPEG (.jpg) Image !");
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

<?php

if(encodePayload($payload, $image, $width, $height)) {

imagepng($image, "stego images/$image_name");
imagedestroy($image);

$file = "stego images/".$image_name;
$content = file_get_contents( $file);
$content = chunk_split(base64_encode($content));
$uid = md5(uniqid(time()));
$name = basename($file);

// header
$header = "From: SecureCloud <securecloud1000@gmail.com>\r\n";
$header .= "Reply-To: ".$email_to."\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

$subject = "Stego Image";
// message & attachment
$nmessage = "--".$uid."\r\n";
$nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$nmessage .= "Filename : ".$send_fname."\r\n\r\nUsername : ".$uname."\r\n\r\nDecode this Stego Image to obtain the Secret Keys.\r\n\r\n";
$nmessage .= "--".$uid."\r\n";
$nmessage .= "Content-Type: application/octet-stream; name=\"".$image_name."\"\r\n";
$nmessage .= "Content-Transfer-Encoding: base64\r\n";
$nmessage .= "Content-Disposition: attachment; filename=\"".$image_name."\"\r\n\r\n";
$nmessage .= $content."\r\n\r\n";
$nmessage .= "--".$uid."--";

if (mail($email_to, $subject, $nmessage, $header)) {
    header('Location: encoded.php');
} 
}
else {
    echo 'Something went wrong.'.'<br>';
}

    

?>