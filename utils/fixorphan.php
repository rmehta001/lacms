<html>
<body>
<?php

include("../inc/global.php");
include("../inc/local_info.php");

mysqli_select_db($dbh,  "LACMS" );

$cli=$HTTP_GET_VARS['cli'];

$adminSTR="SELECT * FROM `GROUP` WHERE GRID=$cli";
$adminQ=mysqli_query($dbh, $adminSTR);
$count=mysqli_num_rows($adminQ);
if($count <=0 || $count > 1)
{ echo "ERRROR: can't find admin"; exit(1); }
else {
	$gr=mysqli_fetch_object($adminQ);
	$admin_id=$gr->ADMIN;
}

echo "ADMIN: $admin_id<hr>";

if($admin_id<2)
{
	echo "ERROR: invalid admin id"; exit(1);
}

$sqlSTR="SELECT * FROM CLASS WHERE CLI=$cli";
# AND STATUS_ACTIVE=1";
$sqlQ=mysqli_query($dbh, $sqlSTR);

while ($row = mysqli_fetch_object($sqlQ))
{
	$strUID="SELECT * FROM USERS WHERE UID=$row->UID";
	$uidQ=mysqli_query($dbh, $strUID);
	$numrows=mysqli_num_rows($uidQ);
	if($numrows<=0)
	{
		echo "$row->CID -  $row->UID";
		if($row->STATUS_ACTIVE==1)
		{
			echo " - ACTIVE";
		}
		$updateSTR="UPDATE CLASS SET UID=$admin_id WHERE CID=$row->CID LIMIT 1";
		$updateQ=mysqli_query($dbh, $updateSTR);
		echo "<br>$updateSTR<hr>";
	}
}
?>
</body>
</html>
