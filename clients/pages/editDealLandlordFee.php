<?php
//BEGIN editDealLandlordFee //
	$cid = $_GET['cid'];
	$did = $_GET['did'];
	$landlord_paid = $_GET['LANDLORD_PAID'];
	
	$quStrUpdateDeal = "UPDATE DEALS SET LANDLORD_PAID='$landlord_paid' WHERE DID='$did' AND CID='$cid'";
	$quUpdateDeal = mysqli_query($GLOBALS['dbh'], $quStrUpdateDeal);
	
	$page = "editDeal";
	$msg = "Deal Accounting: Landlord updated.";
	
	$disData = "deal";
	$disData2 = "ad";
//END editDealLandlordFee //
?>
	