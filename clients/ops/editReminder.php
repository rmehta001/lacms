<?php
//BEGIN createClient //
	if ($level>4) {
		$page = "editReminder";
		$title = "Edit Reminder";
		
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END createClient //
?>