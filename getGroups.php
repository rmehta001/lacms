<?php
include ("./inc/global.php");
include ("./inc/local_info.php");
mysqli_select_db($dbh, $DBNAME);


$quStrGetGroups = "SELECT * FROM `GROUP` INNER JOIN USERS ON `GROUP`.ADMIN = USERS.UID ORDER BY NAME";
$quGetGroups = mysqli_query($dbh, $quStrGetGroups) or die  (mysqli_error($dbh));

$outStr = "\"Group ID\",\"Name\",\"Signature\",\"Admin\",\"Password\",\"Maximum Ads\",\"Active ads\",\"Total Logins\"\n";
while ($rowGroup = mysqli_fetch_object($quGetGroups)) {
	$quStrGetActive = "select count(CID) as ACTIVE_COUNT from CLASS where CLI='$rowGroup->GRID' and STATUS='ACT'";
	$quGetActive = mysqli_query($dbh, $quStrGetActive) or die (mysqli_error($dbh));
	$rowActive = mysqli_fetch_object($quGetActive);
	$active = $rowActive->ACTIVE_COUNT;
	$quStrGetRecentSessions = "select count(ID) as SCOUNT from SESSIONS where GRID='$rowGroup->GRID'";
	$quGetRecentSessions = mysqli_query($dbh, $quStrGetRecentSessions) or die($quStrGetRecentSessions);
	$rowRecent = mysqli_fetch_object($quGetRecentSessions);
	$quStrGetOldSessions = "select count(ID) as SCOUNT from SESSIONS_OLD where GRID='$rowGroup->GRID'";
	$quGetOldSessions = mysqli_query($dbh, $quStrGetOldSessions);
	$rowOld = mysqli_fetch_object($quGetOldSessions);
	$totalLogins = $rowRecent->SCOUNT + $rowOld->SCOUNT;
	$sig = str_replace(",", "", $rowGroup->SIG);
	$name = str_replace(",","", $rowGroup->NAME);
	$name = str_replace("\"", "", $name);
	$outStr .= "\"$rowGroup->GRID\",\"$name\",\"$sig\",\"$rowGroup->HANDLE\",\"$rowGroup->PASS\",\"$rowGroup->MAXACT\",\"$active\",\"$totalLogins\"\n";
}
	
	
	
echo $outStr;	
	
?>