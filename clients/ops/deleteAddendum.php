<?php
//BEGIN deleteAddendum //
if ($user_level>2) {
	$lid = $HTTP_GET_VARS['lid'];
	$ll_addendum_id = $HTTP_GET_VARS['ll_addendum_id'];


	$quStrGetAddendum = "SELECT * FROM LANDLORD_ADDENDUMS WHERE LID=$lid AND LL_ADDENDUM_ID=$ll_addendum_id AND CLI=$grid";
	$quGetAddendum = mysqli_query($dbh, $quStrGetAddendum) or die (dieNice ("$quStrGetAddendum Sorry, Couldn't find that addendum.", "E-7006"));
	$rowGetAddendum = mysqli_fetch_object($quGetAddendum);
	$page = "deleteAddendum";
	$msg = "Are you sure you want to delete this addendum?";
	$title = "Delete Addendum";
}else {
	$page = "home";
	$msg = "You are not authorized to delete landlords.";
}
//END deleteAddendum //
?>