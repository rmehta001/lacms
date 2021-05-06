<?php
include ("./inc/local_info.php");
include ("./inc/global.php");
mysqli_select_db($dbh, $DBNAME);
$quStrGetAds = "select * from CLASS where PIC>0";
$quGetAds = mysqli_query($dbh, $quStrGetAds) or die (mysqli_error($dbh));
while ($rowGetAds = mysqli_fetch_object($quGetAds)) {
	$quStrCheckPics = "select * from PICTURE where CID='$rowGetAds->CID'";
	$quCheckPics = mysqli_query($dbh, $quStrCheckPics);
	$num_pics = mysqli_num_rows ($quCheckPics);
	
	if (!$num_pics) {
		$quStrUpdateAd = "update class set PIC=0 where CID='$rowGetAds->CID'";
		echo "$quStrUpdateAd <br>";
		//$quUpdateAd = mysqli_query($dbh, $quUpdateAd);
	}
}
?>