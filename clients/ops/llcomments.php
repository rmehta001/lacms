<?php
//BEGIN llcomments //
	if ($_SESSION["level"]>4) {
		$page = "llcomments";
		$title = "Landlord Comments";
		$llid = $_GET['llid'];
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END llcomments //
?>