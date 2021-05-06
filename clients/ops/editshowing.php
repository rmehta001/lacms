<?php
//BEGIN editshowing //
	if ($_SESSION["level"]>4) {
		$page = "editshowing";
		$title = "Edit A Showing";
		if (isset($_GET['cid'])) {
            $cid = $_GET['cid'];
        }
        if (isset($_GET['showid'])) {
            $showid = $_GET['showid'];
        }

		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END editshowing //
?>