<?php
//BEGIN listings //
	$needOptions = true;
	$app = "listings";
	$appLink = "listings";
	if ($_SESSION["level"]>4) {
		
		
		$disData = "listings";
		$disData2 = "user";
		$page = "listings";
		
		$title = "Listings View";
	}else {
		$page = "upgrade";
		$msg = "This feature is not available to you at this time.";
		$msg_error = true;
	}
//END listings //
?>