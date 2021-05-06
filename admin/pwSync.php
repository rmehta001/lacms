<?php
include ("../inc/local_info.php");

$quStrGetUsers = "SELECT * FROM USERS";
$quGetUsers = mysqli_query($dbh,$quStrGetUsers);

$pw = fopen ("PasswordFile", 'w');
while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) {
if (CRYPT_MD5 == 1) {
	$string = "$rowGetUsers->HANDLE:" . crypt($rowGetUsers->PASS,'$1$rasmusle$') . "\n";
	fwrite($pw, $string);
}
	
}

echo  ("Password File and Users table synchronized.");
?>
