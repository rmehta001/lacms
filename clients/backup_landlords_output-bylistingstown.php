<?php
//Download backup (CSV)//
session_start();
include ("../inc/global.php");
include ("../inc/local_info.php");

mysqli_select_db($dbh, $DBNAME);
if (!$isAdmin) {
	die("Your are not entitled to this function.");
}


$newLine = "\n";


$quStrGetFields = "desc LANDLORD";
$quGetFields = mysqli_query($dbh, $quStrGetFields);
$numFields = mysqli_num_rows($quGetFields);

while ($rowGetFields = mysqli_fetch_object($quGetFields)) {
	$row++;
	if ($row < $numFields) {
		$heading .= "\"$rowGetFields->Field\",";
	}else {
		$heading .= "\"$rowGetFields->Field\"";
	}
}
$output = $heading . $newLine;

$quStrGetAds = "SELECT DISTINCT `LOCNAME` , `SHORT_NAME` , HOME_NAME_FIRST, HOME_NAME_LAST, HOME_SPOUSE_FIRST, HOME_SPOUSE_LAST, HOME_STREET, HOME_STREET2, HOME_CITY, HOME_STATE, HOME_ZIP, HOME_PHONE, HOME_FAX, CAREOF, SPOUSE_CELL, SPOUSE_OFFICE, SPOUSE_EMAIL, OFF_NAME, OFF_STREET, OFF_STREET2, OFF_CITY, OFF_STATE, OFF_ZIP, OFF_PHONE, OFF_FAX, OFF_EMAIL, OFF_WEBSITE, OFF_WEBLISTINGS, ADDENDUM, LLNOTES, PETS, SUPER_NAME, SUPER_PHONE, LL_EMAIL, MOBILE_PHONE, DATE_CREATED, LAST_CONTACTED, NEXT_CONTACT, LAST_CONTACT_ACTION, LAST_MOD, LAST_MOD_BY, NEWSLETTER_SUBSCRIBE 
FROM CLASS
INNER JOIN LANDLORD ON CLASS.LANDLORD = LANDLORD.LID
INNER JOIN LOC ON CLASS.LOC = LOC.LOCID
WHERE `CLI`='$grid'
ORDER BY `LOC`, `SHORT_NAME`";
$quGetAds = mysqli_query($dbh, $quStrGetAds) or die ("Error: procedure failed.");

while ($rowGetAds = mysqli_fetch_assoc($quGetAds)) {
	$irow = 0;
	foreach ($rowGetAds as $row) {
		$irow++;
		$value =  addslashes($row);
		if ($irow < $numFields) {
			$output .= "\"$value\",";
		}else {
			$output .= "\"$value\"";
		}
	}
	$output .= $newLine;
}

echo $output;
?>
			
			


