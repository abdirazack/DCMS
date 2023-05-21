<?php

class encodec{
    function enco($plainText, $shift) {
        $encryptedMessage = '';
        $plainText = strtolower($plainText); // Convert the plain text to lowercase
        
        for ($i = 0; $i < strlen($plainText); $i++) {
            $char = $plainText[$i];
            
            if (ctype_alpha($char)) {
                $encryptedChar = chr((ord($char) - 97 + $shift) % 26 + 97); // Shift the alphabetic character by $shift positions
                $encryptedMessage .= $encryptedChar;
            } else if (ctype_digit($char)) {
                $encryptedChar = chr((ord($char) - 48 + $shift) % 10 + 48); // Shift the numeric character by $shift positions
                $encryptedMessage .= $encryptedChar;
            } else if ($char === ' ') {
                $encryptedMessage .= '#'; // Replace spaces with '#'
            } else {
                $encryptedMessage .= $char; // Preserve non-alphanumeric characters
            }
        }
        
        return $encryptedMessage;
    }
    
    function deco($encryptedMessage, $shift) {
        $decryptedMessage = '';
        
        for ($i = 0; $i < strlen($encryptedMessage); $i++) {
            $char = $encryptedMessage[$i];
            
            if (ctype_alpha($char)) {
                $decryptedChar = chr((ord($char) - 97 - $shift + 26) % 26 + 97); // Reverse the shift for alphabetic characters
                $decryptedMessage .= $decryptedChar;
            } else if (ctype_digit($char)) {
                $decryptedChar = chr((ord($char) - 48 - $shift + 10) % 10 + 48); // Reverse the shift for numeric characters
                $decryptedMessage .= $decryptedChar;
            } else if ($char === '#') {
                $decryptedMessage .= ' '; // Replace '#' with a space
            } else {
                $decryptedMessage .= $char; // Preserve non-alphanumeric characters
            }
        }
        
        return $decryptedMessage;
    }
    
}

// $plainText = "hi how are you";
// $shift = 4;

// $encryptedMessage = encryptMessage($plainText, $shift);
// echo "Encrypted message: " . $encryptedMessage . "\n";

// $decryptedMessage = decryptMessage($encryptedMessage, $shift);
// echo "Decrypted message: " . $decryptedMessage;


?>