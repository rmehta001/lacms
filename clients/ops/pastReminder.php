<?php
//BEGIN createClient //
	if ($level>4) {
		$page = "pastReminder";
		$title = "Past Reminders";
		
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END createClient //
?>