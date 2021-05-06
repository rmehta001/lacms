<?php
//BEGIN editUser //

$PHP_SELF = $_SERVER['PHP_SELF'];
	if (isset($isAdmin)) {
		$page = "mail_all_clients";
		if(isset($_GET['uid']))
                $euid = $_GET['uid'];
		$title = "Email All Clients Form";
		$disData = "user";
		$disData2 = "clients";

$needOptions = true;



	}



 
	elseif ($_SESSION["level"]>0) {
// elseif ($level>0) {

		$page = "mail_all_clients";
                if(isset($_GET['uid']))
		$euid = ($_GET['uid']);
		$title = "Email All Clients Form";
		$disData = "user";
		$disData2 = "clients";
		$disData3 = "landlords";




	}else {
		$page = "mail_all_clients";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END editUser //






?>