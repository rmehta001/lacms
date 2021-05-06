<?php
//BEGIN createClient //
	if ($_SESSION["level"]>4) {
		$page = "createReminder";
		$title = "Create Reminder";
		
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END createClient //
?>