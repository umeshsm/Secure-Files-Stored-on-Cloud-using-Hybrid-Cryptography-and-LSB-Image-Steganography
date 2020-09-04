<?php

function toBinary(string $message) {
    $result = '';
    for($i = 0; $i < strlen($message); $i++) {
        $result .= str_pad(decbin(ord($message[$i])), 8, "0", STR_PAD_LEFT);
    }
    return $result;
}

?>