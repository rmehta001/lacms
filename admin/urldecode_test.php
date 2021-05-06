<?php

include ("../inc/local_info.php");


$quStrGetBadBody = "SELECT BODY, CID FROM CLASS WHERE CLI=49";
$quGetBadBody = mysqli_query($dbh,$quStrGetBadBody);

while ($rowGetBadBody = mysqli_fetch_object($quGetBadBody)) {
	$goodBody = urldecode ($rowGetBadBody->BODY);
	$quStrUpdateClass = "UPDATE CLASS SET BODY='$goodBody' WHERE CID='$rowGetBadBody->CID' AND CLI=49";
	$quUpdateClass = mysqli_query($dbh,$quStrUpdateClass);
	
}
echo "done";
?>
