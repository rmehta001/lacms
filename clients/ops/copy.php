<?php
// BEGIN copy.php //
// to debug set test variable to troubleshoot SQL, no copy will be performed
// should only do this in a offline copy NOT a live site
$test=0;
$cid = $_GET['cid'];
$old_cid = $cid;

$now = date ("Ymd");
$quGetFields = mysqli_query($GLOBALS['dbh'], "desc CLASS");
$numFields = mysqli_num_rows($quGetFields);
$quStrGetAd = "SELECT * FROM CLASS WHERE CID='$cid'";
$quGetAd = mysqli_query($GLOBALS['dbh'], $quStrGetAd) or die($quStrGetAd) ;
$rowGetAd = mysqli_fetch_assoc($quGetAd);

$csource=0;
$row=0;

$fields = "(`DATEIN`, `MOD`, `MODBY`, ";
$values = "('$now', '$now', ".$_SESSION["handle"].", ";
while ($rowGetFields = mysqli_fetch_object($quGetFields)) {
	$row++;
	if ($rowGetFields->Field !== "CID" && $rowGetFields->Field !== "DATEIN" && $rowGetFields->Field !== "MOD" && $rowGetFields->Field !== "MODBY") {
		if ($row < ($numFields)) {
			$fields .= " `$rowGetFields->Field`, ";
			$fixedString=preg_replace('/\"/','\"',$rowGetAd[$rowGetFields->Field]);
			$values .= "\"" . $fixedString . "\", ";
		}else {
			$fields .= " `$rowGetFields->Field`";
			$fixedString=preg_replace('/\"/','\"',$rowGetAd[$rowGetFields->Field]);
			$values .= "\"" . $fixedString . "\"";
		}
	}
}
$fields .= ")";
$values .= ")";


$quStrCopyAd = "INSERT INTO CLASS $fields VALUES $values";
if($test==0)
{
$quCopyAd = mysqli_query($GLOBALS['dbh'], $quStrCopyAd);
$cid = mysqli_insert_id($GLOBALS['dbh']);

// * Clean up copied listing * //

$quCleanAd = "UPDATE CLASS SET TENANT_NAME='',TENANT_PHONE='',THUMBNAIL='',CSOURCE='0',CLI='$grid' WHERE CID='$cid'";


$CleanAd = mysqli_query($GLOBALS['dbh'], $quCleanAd);

}

//Move Pictures//
$quStrGetPics = "select * from PICTURE where CID='$old_cid'";
$quGetPics = mysqli_query($GLOBALS['dbh'], $quStrGetPics);
while ($rowGetPics = mysqli_fetch_object($quGetPics)) {
	$quStrInsertPic = "insert into PICTURE (CID, EXT, DESCRIPT, UID, PICORDER) values ('$cid', '$rowGetPics->EXT', '$rowGetPics->DESCRIPT', '$rowGetPics->UID', '$rowGetPics->PICORDER')";
if($test==0)
{
	$quInsertPic = mysqli_query($GLOBALS['dbh'], $quStrInsertPic);
	$new_pid = mysqli_insert_id($GLOBALS['dbh']);
}
	$old_path = "$picsDirectory/" . $rowGetPics->PID . "." . $rowGetPics->EXT;
	$new_path = "$picsDirectory/" . $new_pid . "." . $rowGetPics->EXT;
if($test==0)
{
	copy ($old_path, $new_path);
}
}





$page = "adlEdit";
$disData = "ad";
$needOptions = true;
if($test==0)
{
	$msg = "Listing Copied, Make changes here and hit save to create a new listing.";
} else {
	$msg = $quStrCopyAd;
}
//END copy.php//
?>
