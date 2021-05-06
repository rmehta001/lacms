<?php
//BEGIN createClient //
	if ($level>4) {
		$page = "createClient2";
		$title = "Create Client";
		
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END createClient //
?>