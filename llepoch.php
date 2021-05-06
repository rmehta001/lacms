<?php
include("./inc/local_info.php");
mysqli_select_db($dbh, "$DBNAME");

$quStrGetLandlords = "select * from LANDLORD";
$quGetLandlords = mysqli_query($dbh, $quStrGetLandlords) or die (mysqli_error($dbh));

while ($rowGetLandlords = mysqli_fetch_object($quGetLandlords)) {
	$quStrGetLastMod = "select max(MOD) as last_contacted from CLASS where LANDLORD='$rowGetLandlords->LID'";
	$quGetLastMod = mysqli_query($dbh, $quStrGetLastMod) or die (mysqli_error($dbh));
	$rowGetLastMod = mysqli_fetch_object($quGetLastMod);
	$last_contacted = $rowGetLastMod->last_contacted;
	
	if ($last_contacted) {
		$quStrUpdateLandlord = "update LANDLORD set LAST_CONTACTED='$last_contacted' where LID='$rowGetLandlords->LID'";
		$quUpdateLandlord = mysqli_query($dbh, $quStrUpdateLandlord) or die (mysqli_error($dbh));
		echo $quStrUpdateLandlord . "<br>";
	}
}
?>