<?php
//BEGIN createshowing //
	if ($_SESSION["level"]>4) {
		$page = "showingsAgent";

		$title = "Agent Showing History";
		if (isset($_GET['agentx'])) {
            $agentx = $_GET['agentx'];
        }
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END createshowing //
?>