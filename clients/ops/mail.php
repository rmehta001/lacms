<?php
//BEGIN mail //
	if (isset($isAdmin) OR ($user_level >="5")){
		$page = "mailform";
                if(isset($_GET['uid']))
		$euid = $_GET['uid'];
		
		$title = "Email Form";
$app = "ad";
		$disData = "user";
		$disData2 = "ad";
		$disData3 = "clients";

$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END mail //






?>