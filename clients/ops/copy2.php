<?php
// BEGIN copy.php //
// to debug set test variable to troubleshoot SQL, no copy will be performed
// should only do this in a offline copy NOT a live site
$test=0;
$cid = $HTTP_GET_VARS['cid'];
$old_cid = $cid;

$now = date ("Ymd");
$quGetFields = mysqli_query($dbh, "desc CLASS");
$numFields = mysqli_num_rows($quGetFields);
$quStrGetAd = "SELECT * FROM CLASS WHERE CID='$cid'";
$quGetAd = mysqli_query($dbh, $quStrGetAd) or die($quStrGetAd) ;
$rowGetAd = mysqli_fetch_assoc($quGetAd);
$csource=0;
$picsource=0;


$fields = "(`DATEIN`, `MOD`, `MODBY`, ";
$values = "('$now', '$now', '$handle', ";
while ($rowGetFields = mysqli_fetch_object($quGetFields)) {
	$row++;

	if ($rowGetFields->Field == "CSOURCE" AND $rowGetAd[$rowGetFields->Field]==1) { $picsource=1; }
	if ($rowGetFields->Field == "CSOURCE" AND $rowGetAd[$rowGetFields->Field]==2) { $picsource=2; }
	if ($rowGetFields->Field == "CSOURCE" AND $rowGetAd[$rowGetFields->Field]==3) { $picsource=3; }

	
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
$quCopyAd = mysqli_query($dbh, $quStrCopyAd);
$cid = mysqli_insert_id($dbh);

// * Clean up copied listing * //

$quCleanAd = "UPDATE CLASS SET TENANT_NAME='',TENANT_PHONE='',THUMBNAIL='',CSOURCE='0',CLI='$grid' WHERE CID='$cid'";


$CleanAd = mysqli_query($dbh, $quCleanAd);

}

//Move Pictures//



$quStrGetPics = "select * from PICTURE where CID='$old_cid'";
$quGetPics = mysqli_query($dbh, $quStrGetPics);
while ($rowGetPics = mysqli_fetch_object($quGetPics)) {
	$quStrInsertPic = "insert into PICTURE (CID, EXT, DESCRIPT, UID) values ('$cid', '$rowGetPics->EXT', '$rowGetPics->DESCRIPT', '$rowGetPics->UID')";
if($test==0)
{
	$quInsertPic = mysqli_query($dbh, $quStrInsertPic);
	$new_pid = mysqli_insert_id($dbh);
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
	$msg = " ps - $picspource - Listing Copied, Make changes here and hit save to create a new listing.";
} else {
	$msg = $quStrCopyAd;
}



//END copy.php//
?>
