<?php
// BEGIN 60 day deactivate //
	$now = date ("Ymd");
	$deactuser = $HTTP_GET_VARS['deactuser'];

if ($deactuser == "ALL") {

$quStrGet60days = "UPDATE CLASS SET STATUS='STO', STATUS_ACTIVE='0', STATUS_VACANT='0', `MOD`='".$now."', MODBY='".$handle."' where ((`MOD` < DATE_SUB(CURDATE() ,INTERVAL 60 DAY)) AND `CLI`='".$grid."')" ;

} else {

$quStrGet60days = "UPDATE CLASS SET STATUS='STO', STATUS_ACTIVE='0', STATUS_VACANT='0', `MOD`='".$now."', MODBY='".$handle."' where ((`MOD` < DATE_SUB(CURDATE() ,INTERVAL 60 DAY)) AND `CLI`='".$grid."' AND `UID`='".$deactuser."')" ;

}
	
$quGet60days = mysqli_query($dbh, $quStrGet60days) or die (mysqli_error($dbh));


		$disData = "ads";
		$disData2 = "user";

		$msg = "Ad(s) marked deactivated and unavailable and occupied";
		$title = "Manage Ads/Listings";

header("Location: $PHP_SELF?op=agentreport&euid=$deactuser");
/* Make sure that code below does not get executed when we redirect. */
exit;



//END 60 day deactivate /
?>