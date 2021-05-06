
<?php
//BEGIN maillistings //
    $cid = $_GET["cid"];
	if (($_SESSION["isAdmin"])  OR ($_SESSION["user_level"] >="4")){
		$page = "mail_listing";
		$euid = isset($_GET['uid']) ? $_GET['uid'] : "";

		$title = "Email Listing";
		$disData = "user";
		$disData2 = "ad";
		$disData3 = "clients";


	}elseif ($_SESSION["level"]>0) {

		$page = "mail_listing";
		$euid = $_GET['uid'];

		$title = "Email Listing";
		$disData = "user";
		$disData2 = "ad";
		$disData3 = "clients";

	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END mail listing //
?>