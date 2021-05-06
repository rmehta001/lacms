<?php
include ("../inc/local_info.php");


//GET TYPE HEADERS//
$quStrTypes = "SELECT TYPE, HTML_FOOT, HTML_HEAD, LOCHEAD, LOCFOOT FROM TYPES";
$quTypes = mysqli_query($dbh,$quStrTypes);

while ($rowTypes = mysqli_fetch_object($quTypes)) {
	$newHTML_HEAD = str_replace ("1995-2002", "1995-2003", $rowTypes->HTML_HEAD);
	$newHTML_FOOT = str_replace ("1995-2002", "1995-2003", $rowTypes->HTML_FOOT);
	$newLOCHEAD = str_replace ("1995-2002", "1995-2003", $rowTypes->LOCHEAD);
	$newLOCFOOT = str_replace ("1995-2002", "1995-2003", $rowTypes->LOCFOOT);
	$quStrUpdateType = "UPDATE TYPES SET HTML_HEAD=$newHTML_HEAD, HTML_FOOT=$newHTML_FOOT, LOCHEAD=$newLOCHEAD, LOCFOOT=$newLOCFOOT WHERE TYPE=$rowTypes->TYPE";
	mysqli_query ($dbh,$quStrUpdateType);
}

?>