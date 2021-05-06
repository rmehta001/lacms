<?php
include("../inc/global.php");
include("../inc/local_info.php");
//DB CONNECT//
mysqli_select_db ("$dbh");

die ("do not run this script without editing!");

$quStrGetAds = "SELECT CID, STREET FROM CLASS WHERE STREET<>''";
$quGetAds = mysqli_query($dbh,$quStrGetAds);

while ($rowGetAds = mysqli_fetch_object($quGetAds)) {
	$split = explode (" ", $rowGetAds->STREET, 2);
	$first_letter = substr ($split[0], 1, 1);
	if (ord($first_letter) >=47 && ord($first_letter) <=57) {
		$street_num = $split[0];
		$street = $split[1];
		$quStrUpdate = "UPDATE CLASS SET STREET_NUM='$street_num', STREET='$street' WHERE CID='$rowGetAds->CID'";
		$quUpdate = mysqli_query($dbh,$quStrUpdate);
		$update++;
	}
}
echo $update;
?>




