
<?php
//BEGIN email multilistings //

	$sel_ids = $_POST['sel_ids'];
	$numIDs = count($sel_ids);

if ($isAdmin) {
		$page = "mail_multilistings";
		$euid = $HTTP_GET_VARS['uid'];

		$title = "Email Multiple Listings";
		$disData = "user";
		$disData2 = "ads";
		$disData3 = "clients";


	}elseif ($level>0) {

		$page = "mail_multilistings";
		$euid = $HTTP_GET_VARS['uid'];


		$title = "Email Multiple Listings";
		$disData = "user";
		$disData2 = "ads";
		$disData3 = "clients";

	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END email multilistings  //
?>




