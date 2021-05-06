<?php
//BEGIN createshowingentry /"/
	if ($_SESSION["level"]>4) {
		$page = "createllcomments";
		$title = "Create Landlord Comments Entry";
		$llid = $_GET['llid'];
		$needOptions = true;
		$disdata = "landlords";
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END createshowingentry //
?>