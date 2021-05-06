<?php
//BEGIN editllcomment //
//changes done by Tanvi//
	if ($level>4) {
		$page = "editllcomment";
		$title = "Edit A Landlord Comment";
		$llid = $_GET['llid'];
		$llcomment_id = $_GET['llcomment_id'];

		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END editllcomment //
?>