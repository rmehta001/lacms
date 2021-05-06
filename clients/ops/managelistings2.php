<?php
//BEGIN listings //
	$needOptions = true;
        echo $level;
	if ($level>4) {
		
		
		$disData = "ads";
		$disData2 = "user";
		$page = "managelistings2";
		
		$title = "Admin for Ads / Listings";
	}else {
		$page = "upgrade";
		$msg = "This feature is not available to you at this time.";
		$msg_error = true;
	}
//END listings //
?>