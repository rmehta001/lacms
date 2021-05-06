<?php
//BEGIN editAddendumDo //
	if ($level>4) {
		$lid = $_POST['lid'];
		$addendum_name = $_POST['addendum_name'];
		$ll_addendum_id = $_POST['ll_addendum_id'];
		$ll_addendum = $_POST['ll_addendum'];


		$quStrUpdateAddendum = "UPDATE LANDLORD_ADDENDUMS SET UID='$uid', LL_ADDENDUM='$ll_addendum', ADDENDUM_NAME='$addendum_name' WHERE LID='$lid' AND `CLI`='$grid' AND LL_ADDENDUM_ID='$ll_addendum_id'";
		$quUpdateAddendum = mysqli_query($dbh, $quStrUpdateAddendum)or die (mysqli_error($dbh));

		
		$page = "addendums";
		$msg = "Addendum $addendum_name has been updated by $handle.";
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, Your access level does not allow that functionality.";
		$msg_error = true;
	}
//END editAddendumDo //
?>