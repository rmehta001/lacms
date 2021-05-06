<?php
//BEGIN editLandlord //
	//$lid = $HTTP_GET_VARS['lid'];
        $lid = $_GET['lid'];
	$quStrGetLandLord = "SELECT * FROM LANDLORD WHERE LID=$lid AND GRID=$grid";
	$quGetLandlord = mysqli_query($dbh, $quStrGetLandLord) or die(dieNice("Sorry,  couldn't find that landlord", "E-8000"));
	$rowGetLandlord = mysqli_fetch_object($quGetLandlord);
	$page = "editLandlord";
	
	$title = "Edit Landlord";
//END editLandlord //
?>