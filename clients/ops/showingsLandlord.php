<?php
//BEGIN showingsLandlord //
	if ($_SESSION["level"]>4) {
		$page = "showingsLandlord";

		$title = "Landlord Showing History";
		$llid = $_GET['llid'];
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END showingsLandlord //
?>