<?php
session_start();
include("../inc/global.php");
include("../inc/local_info.php");
if (isset($HTTP_GET_VARS['debug'])) {
	error_reporting(E_ALL);
}

/*///////////////////////////////////////////////////////////////////////////
//bstapts admin interface 1.0. �2002 Chris Hinkle Legacy-Adaptive Systems //
//////////////////////////////////////////////////////////////////////////*/


$fakePicsDeleted = 0;

$quStrGetPics = "SELECT * FROM PICTURE WHERE 1";
$quGetPics = mysqli_query ($dbh,$quStrGetPics);

while ($rowGetPics = mysqli_fetch_object ($quGetPics)) {
	$picture_file_loc = "$picsDirectory/$rowGetPics->PID.$rowGetPics->EXT";
	if (!$pic_act = @fopen ($picture_file_loc, 'r')) {
		$quStrDeleteFakePic = "DELETE FROM PICTURE WHERE PID=$rowGetPics->PID";
		$quDeleteFakePic = mysqli_query($dbh,$quStrDeleteFakePic);
		$fakePicsDeleted++;
	}
}

echo "Picture table cleaned: $fakePicsDeleted fake picture records purged."; 
?>