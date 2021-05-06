<?php 

include ("../inc/local_info.php");

$quStrGetAdmins = "SELECT UID, HANDLE, USER_LEVEL FROM USERS INNER JOIN `GROUP` ON USERS.UID=`GROUP`.ADMIN";
$quGetAdmins = mysqli_query ($dbh,$quStrGetAdmins);

while ($rowGetAdmins = mysqli_fetch_object($quGetAdmins)) {
	$quStrUpdateAdmin = "UPDATE USERS SET USER_LEVEL=3 WHERE UID='$rowGetAdmins->UID'";
	$quUpdateAdmin = mysqli_query($dbh,$quStrUpdateAdmin);
	echo "$rowGetAdmins->HANDLE --- old: $rowGetAdmins->USER_LEVEL new: 3<br>";
}
?>
done.