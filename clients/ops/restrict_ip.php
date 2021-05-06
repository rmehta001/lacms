<?php
//BEGIN restrict_ip //
	if ($isAdmin) {
		$page = "restrict_ip";
		
		$app = "home";
		$applink = "home";	
		$disData = "group";
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END restrict_ip //
?>