<?php
//BEGIN mailLandlord //
//	$lid = $HTTP_GET_VARS['lid'];
//	$e = $HTTP_GET_VARS['e'];
        $lid = $_GET['lid'];
        $e = $HTTP_GET_VARS['e'];
	$quStrGetLandLord = "SELECT * FROM LANDLORD WHERE LID=$lid AND GRID=$grid";
	$quGetLandlord = mysqli_query($dbh, $quStrGetLandLord) or die(dieNice("Sorry,  couldn't find that landord", "E-8000"));
	$rowGetLandlord = mysqli_fetch_object($quGetLandlord);
	$page = "mail_landlord";

$disData = "user";	

	$title = "Mail A Landlord";
//END editLandlord //
?>



