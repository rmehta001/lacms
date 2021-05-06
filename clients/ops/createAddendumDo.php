<?php
//BEGIN createLandlordAddendumDo //


		$lid = $_POST['lid'];
		$addendum_name = $_POST['addendum_name'];
		$ll_addendum = $_POST['ll_addendum'];


if  ($ll_addendum == "") {

	$page = "createAddendum";
	$msg = "<FONT COLOR=red>Addendum NOT created. There was no Addendum entered.</FONT>";

} else {

	$quStrCreateAddendum = "INSERT INTO LANDLORD_ADDENDUMS (UID, CLI, LID, ADDENDUM_NAME, LL_ADDENDUM) VALUES ('$uid', '$grid', '$lid', '$addendum_name', '$ll_addendum')";
	
	$quCreateAddendum = mysqli_query($dbh, $quStrCreateAddendum) or die (dieNice("Sorry, couldn't create Addendum record.", "E-Addendum 7000"));

	$page = "Addendums";
	$needOptions = true;
	$msg = "New addendum created.";
	$title = "Addendums";
	$sec_op = "manageLandlord";

}

//END createLandlordAddendumDo //
?>