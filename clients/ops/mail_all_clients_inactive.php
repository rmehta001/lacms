<?php
//BEGIN editUser //
	if (isset($isAdmin)) {
		$page = "mail_all_clients_inactive";
		$euid = $_GET['uid'];
		
		$title = "Email All Inactive Clients Form";
		$disData = "user";
		$disData2 = "clients";

$needOptions = true;



	}





elseif ($_SESSION["level"]>0) {
    //elseif ($level>0) {

		$page = "mail_all_clients_inactive";
		if(isset($_GET['uid']))
                    $euid = $_GET['uid'];
		
		$title = "Email All Inactive Clients Form";
		$disData = "user";
		$disData2 = "clients";
		$disData3 = "landlords";




	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END editUser //






?>