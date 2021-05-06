<html>
<body>
<?php

include("inc/global.php");
include("inc/local_info.php");

mysqli_select_db($dbh,  "LACMS" );

$cli=$HTTP_GET_VARS['cli'];

$sqlSTR="SELECT * FROM CLASS WHERE CLI=$cli";
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
			echo " - ACTIVE<BR>";
		} else {
			echo "<BR>";
		}
	}
}

?>
</body>
</html>
