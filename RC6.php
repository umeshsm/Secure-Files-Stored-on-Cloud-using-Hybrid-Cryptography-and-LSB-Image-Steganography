<?php 
 
function Encrypt_Rc6($data, $secret)
 
     {
 
            //Generate a key from a hash   
 
              $key = md5(utf8_encode($secret), true);   
 
              $data2 = utf8_encode($data);    
 
              $iv =utf8_encode("aUrxt1ry");  
 
              //Take first 8 bytes of $key and append them to the end of $key.   
 
              $key .= substr($key, 0, 8);      
 
              //Pad for PKCS7    
 
             $blockSize = mcrypt_get_block_size(MCRYPT_RC2, 'cbc');     
 
              //Encrypt data   
 
             $encData = mcrypt_encrypt(MCRYPT_RC2, $key, $data2, MCRYPT_MODE_CBC, $iv);     
 
             return urlencode(base64_encode($encData));  
 
     } 
 
function Decrypt_Rc6($data, $secret)
 
     {    
 
             //Generate a key from a hash   
 
               $data2 = urldecode($data);      
 
               $iv =utf8_encode("aUrxt1ry");  
 
               $key = md5(utf8_encode($secret), true);   
 
               //Take first 8 bytes of $key and append them to the end of $key.   
 
               $key .= substr($key, 0, 8);     
 
               $data3 = base64_decode($data2);  
 
               return $data4 = mcrypt_decrypt(MCRYPT_RC2, $key, $data3, MCRYPT_MODE_CBC, $iv);
 
      }  
 
 
?>