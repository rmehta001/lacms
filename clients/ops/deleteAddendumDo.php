<?php
//BEGIN deleteAddendumDo //	
if ($user_level>2) {

	$lid = $_POST['lid'];
	$ll_addendum_id = $_POST['ll_addendum_id'];
	$conf = $_POST['conf'];
	if ($conf=="y" || $conf=="Y") {

		$quStrDeleteAddendum = "DELETE FROM LANDLORD_ADDENDUMS WHERE LID=$lid AND LL_ADDENDUM_ID=$ll_addendum_id AND CLI=$grid";
		$quDeleteAddendum = mysqli_query($dbh, $quStrDeleteAddendum);

		$page = "addendums";
		$needOptions = true;
		$msg = "Addendum deleted.";
		$sec_op = "manageLandlord";
	}else {
		$page = "deleteAddendum";
		$msg = "Please type 'y' to confirm,  no action taken.";
		$msg_error = true;
	}
}else {
	$page = "home";
	$msg = "You are not authorized to delete addendums.";
}
//END deleteAddendumDo //
?>