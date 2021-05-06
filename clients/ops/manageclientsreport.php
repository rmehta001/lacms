<?php
//BEGIN listings //
	$needOptions = true;
	if ($level>4) {
		
		
		$disData = "ads";
		$disData2 = "user";
		$disData3 = "clients";
		$page = "manageclientsreport";
		
		$title = "Admin for Clients Reporting";
	}else {
		$page = "upgrade";
		$msg = "This feature is not available to you at this time.";
		$msg_error = true;
	}
//END listings //
?>