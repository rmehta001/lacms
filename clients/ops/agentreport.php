<?php
//BEGIN agentreport //

$_POST = &$_POST;
$HTTP_GET_VARS = &$_GET;
$HTTP_COOKIE_VARS = &$_COOKIE;

	if (isset($HTTP_GET_VARS['euid'])) {
		$page = "agentreport";
		$euid = $HTTP_GET_VARS['euid'];
		
		$title = "Agent Report";
		$disData = "euser";
		
		 if (!$_SESSION['isAdmin']) { 	$showback = "no"; }
		
	}else {

		$page = "agentreport";
		$euid = $uid;
		$showback = "no";

		$title = "Agent Report";
		$disData = "euser";


	}
//END agentreport //
?>