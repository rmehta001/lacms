
<?php
//BEGIN editUser //
	if ($isAdmin) {
		$page = "mail_reminder";
		$euid = $HTTP_GET_VARS['uid'];
		$clid = $HTTP_GET_VARS['clid'];
		$rid = $HTTP_GET_VARS['rid'];
		
		$title = "Email Reminder";
		$disData = "user";
		$disData3 = "clients";


	}elseif ($level>0) {

		$page = "mail_reminder";
		$euid = $HTTP_GET_VARS['uid'];
		$clid = $HTTP_GET_VARS['clid'];
		$rid = $HTTP_GET_VARS['rid'];

		$title = "Email Reminder";
		$disData = "user";
		$disData3 = "clients";

	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END editUser //
?>