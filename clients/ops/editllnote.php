<?php
//BEGIN editllcomment //
	if ($level>4) {
		$page = "editllnote";
		$title = "Edit Landlord Notes";
		$llid = $HTTP_GET_VARS['llid'];
		$llnote = $HTTP_GET_VARS['llnote'];

		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END editllcomment //
?>