<?php
//BEGIN deleteLandlord //


if ($_SESSION['user_level']>2) {
	$lid = $_GET['lid'];
	$quStrGetLL = "SELECT * FROM LANDLORD WHERE LID=$lid";
	$quGetLL = mysqli_query ($dbh, $quStrGetLL) or die (dieNice ("Sorry,  Couldn't find that landlord.", "E-7005"));
	$rowGetLL = mysqli_fetch_object($quGetLL);
	$page = "deleteLandlord";
	$msg = "Are you sure you want to delete this landlord record?";
	$title = "Delete Landlord";
}else {
	$page = "home";
	$msg = "You are not authorized to delete landlords.";
}
//END deleteLandlord //
?>