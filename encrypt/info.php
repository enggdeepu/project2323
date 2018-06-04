<?Php 
define("SECUREKEY",'JHKJDHHQHQHHBHJVJA48744523'); 
 //**** Custom Encryption *****//
function custom_encrypt($decryptedstr) {
if(!empty($decryptedstr)) {
$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(SECUREKEY), $decryptedstr, MCRYPT_MODE_CBC, md5(md5(SECUREKEY))));
return $encrypted;
}
}

//**** Custom Decryption *****//
function custom_decrypt($encryptedstr) {
if(!empty($encryptedstr)) {
$encryptedstr=str_replace(" ","+",$encryptedstr);
$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(SECUREKEY), base64_decode($encryptedstr), MCRYPT_MODE_CBC, md5(md5(SECUREKEY))), "\0");
return $decrypted;
}
}

echo $a= custom_encrypt(2);
echo custom_decrypt($a);

?>