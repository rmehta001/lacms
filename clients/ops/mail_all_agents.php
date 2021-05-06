<?php
//BEGIN mail_all_agents //
	if ($_SESSION["isAdmin"]) {
		$page = "mail_all_agents";
                if(isset($_GET['uid']))
		$euid = $_GET['uid'] ;
		
		$title = "Email All Agents Form";
		$disData = "user";
		$disData2 = "group";

$needOptions = true;



	}





elseif ($_SESSION['level']>0) {

		$page = "mail_all_agents";
		if(isset($_GET['uid']))
                    $euid = $_GET['uid'];
		
		$title = "Email All Agents Form";
		$disData = "user";
		$disData2 = "group";



	}else {
		$page = "home";
		$msg = "Sorry, You are not authorized to use this feature.";
		$msg_error = true;
	}
//END mail_all_agents //

?>