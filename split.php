<?php

function fsplit($file){
 
    //open file to read
    $file_handle = fopen($file,'r');
    
    $len=filesize($file);
    $count=0;

    while ($len % 3 != 0) {
        $len+=1;
        $count++;
    }
    
    //get file size
    $file_size = filesize($file);

    //no of parts to split
    $parts = 3;

    $buffer=$len/$parts;

    
    //store all the file names
    $file_parts = array();

    //path to write the final files
    $store_path = "files splitted/";

    //name of input file
    $file_name = basename($file,".txt");

    for($i=0;$i<$parts;$i++){
        //read buffer sized amount from file
        $file_part = fread($file_handle, $buffer);
        //the filename of the part
        $file_part_path = $store_path.$file_name.($i+1).".txt";
        //open the new file [create it] to write
        $file_new = fopen($file_part_path,'w+');
        //write the part of file
        fwrite($file_new, $file_part);
        //add the name of the file to part list [optional]
        array_push($file_parts, $file_part_path);
        //close the part file handle
        fclose($file_new);
    }    
    //close the main file handle


    fclose($file_handle);
    return $file_parts;
}


?>
