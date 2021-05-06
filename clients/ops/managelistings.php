<?php
//BEGIN listings //
 echo "level ".$_SESSION["level"];
	$needOptions = true;
	if ($_SESSION["level"]>4) {
		
		
		$disData = "ads";
		$disData2 = "user";
		$page = "managelistings";
		
		$title = "Admin for Ads / Listings";
	}else {
		$page = "upgrade";
		$msg = "This feature is not available to you at this time.";
		$msg_error = true;
	}
//END listings //
?>