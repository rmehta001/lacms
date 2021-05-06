<?php
//BEGIN agentreport //
	if ($HTTP_GET_VARS['euid']) {
		$page = "agentreport2";
		$euid = $HTTP_GET_VARS['euid'];
		
		$title = "Agent Report";
		$disData = "euser";
		
		 if (!$isAdmin) { 	$showback = "no"; }
		
	}else {

		$page = "agentreport2";
		$euid = $uid;
		$showback = "no";

		$title = "Agent Report";
		$disData = "euser";


	}
//END agentreport //
?>