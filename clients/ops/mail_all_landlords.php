<?php
//BEGIN mailLandlord //
//	$lid = $HTTP_GET_VARS['lid'];
//	$e = $HTTP_GET_VARS['e'];
        $lid = $_GET['lid'];
	$e = $_GET['e'];
	$quStrGetLandLord = "SELECT * FROM LANDLORD WHERE GRID=$grid";
	$quGetLandlord = mysqli_query($dbh, $quStrGetLandLord) or die(dieNice("Sorry,  couldn't find that landord", "E-8000"));
	$rowGetLandlord = mysqli_fetch_object($quGetLandlord);
	$page = "mail_all_landlords";

$disData = "user";	

	$title = "Mail A Landlord";
//END editLandlord //
?>



