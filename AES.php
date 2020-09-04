<?php 
include('header.php');
 
function Encrypt_Aes($data, $secret)
 
     {
            $len = strlen($secret);
            if($len < 24 && $len != 16)
            {
                $secret = str_pad($secret, 24, "\0", STR_PAD_RIGHT); 
            } 
            elseif ($len > 24 && $len < 32) 
            {
                $secret = str_pad($secret, 32, "\0", STR_PAD_RIGHT);       
            }
            elseif ($len > 32)
            {
                $secret = substr($secret, 0, 32);
            }
 
            //Generate a key from a hash   
 
              $key = md5(utf8_encode($secret), true);   
 
              $data2 = utf8_encode($data);    
 
              $iv =utf8_encode("aUrxt1ryqwertyas");  
 
              //Take first 8 bytes of $key and append them to the end of $key.   
 
              $key .= substr($key, 0, 8);      
 
              //Pad for PKCS7    
 
             $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');     
 
              //Encrypt data   
 
             $encData = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data2, MCRYPT_MODE_CBC, $iv);     
 
             return urlencode(base64_encode($encData));  
 
     } 
 
function Decrypt_Aes($data, $secret)
 
     {    

            $len = strlen($secret);
            if($len < 24 && $len != 16)
            {
                $secret = str_pad($secret, 24, "\0", STR_PAD_RIGHT); 
            } 
            elseif ($len > 24 && $len < 32) 
            {
                $secret = str_pad($secret, 32, "\0", STR_PAD_RIGHT);       
            }
            elseif ($len > 32)
            {
                $secret = substr($secret, 0, 32);
            }
 
             //Generate a key from a hash   
 
               $data2 = urldecode($data);      
 
               $iv =utf8_encode("aUrxt1ryqwertyas");  
 
               $key = md5(utf8_encode($secret), true);   
 
               //Take first 8 bytes of $key and append them to the end of $key.   
 
               $key .= substr($key, 0, 8);     
 
               $data3 = base64_decode($data2);  
 
               return $data4 = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data3, MCRYPT_MODE_CBC, $iv);
 
      }  
 
 
?>