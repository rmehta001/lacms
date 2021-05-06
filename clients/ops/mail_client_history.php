<?php
//BEGIN mail_client_history //
	if ($_SESSION ["level"]>4) {
		$page = "mail_client_history";
		$title = "Client Email History";
		$clid = $_GET['clid'];
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END mail_client_history //
?>
