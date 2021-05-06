
<?php
//BEGIN editUser //
	if (($isAdmin)  OR ($userlevel >="4")){
		$page = "mail_listing2";
		$euid = $HTTP_GET_VARS['uid'];

		$title = "Email Listing";
		$disData = "user";
		$disData2 = "ad";
		$disData3 = "clients";


	}elseif ($level>0) {

		$page = "mail_listing2";
		$euid = $HTTP_GET_VARS['uid'];

		$title = "Email Listing";
		$disData = "user";
		$disData2 = "ad";
		$disData3 = "clients";

	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END editUser //
?>