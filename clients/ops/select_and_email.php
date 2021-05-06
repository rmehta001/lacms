<?php
//BEGIN select_and_email //
	$sel_ids = $_POST['sel_ids'];
	$conf = $_POST['conf'];
	$numIDs = count($sel_ids);


	switch ($numIDs) {
		case 0:
			$selWHERE = " WHERE 1=2";
			break;
		case 1: $selWHERE = " WHERE CID=$sel_ids[0] AND CLI='$grid'";
			break;
		default:
			$selWHERE = " WHERE (CID=$sel_ids[0]";
			for ($i=1;$i<$numIDs;$i++){
				$string2Cat.= " OR CID=$sel_ids[$i] ";
			}
			$string2Cat.=" )AND CLI=$grid ";
			$selWHERE.= $string2Cat;
	}
	if ($conf=='y' or $conf=='Y') {









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











// $page = "$return_page";

		
		$disData = "ads";
		$msg = "$numIDs ad(s) emailed by $handle.";
		$title = "Selected";
	}else {
		$page = "select_and_email";
		$msg = "No action taken,  please type 'y'";
		$msg_error = true;
		$title = "Select and Email";
	}

//END select_and_email //
?>