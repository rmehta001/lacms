<?php
//BEGIN editAddendum //
	if ($level>4) {

	$lid = $HTTP_GET_VARS['lid'];
	$ll_addendum_id = $HTTP_GET_VARS['ll_addendum_id'];
	$quStrGetLandLordA = "SELECT * FROM `LANDLORD_ADDENDUMS` WHERE `LID`=$lid AND `CLI`=$grid AND `LL_ADDENDUM_ID`=$ll_addendum_id";
	$quGetLandlordA = mysqli_query($dbh, $quStrGetLandLordA) or die(dieNice("Sorry,  couldn't find that landord's addendum", "E-Addendum"));
	$rowGetLandlordA = mysqli_fetch_object($quGetLandlordA);
	$page = "editAddendum";
	
	$title = "Edit Landlord Addendum";


	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available to you.";
		$msg_error = true;
	}
//END editAddendum //
?>