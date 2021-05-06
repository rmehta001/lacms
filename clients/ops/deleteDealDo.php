<?php
//BEGIN deleteDealDo //
	$did = $_POST['did'];
	$cid = $_POST['cid'];
	
	$conf = $_POST['conf'];
	
	if ($conf == 'y' || $conf == 'Y') {
		$quStrDeleteDeal = "DELETE FROM DEALS WHERE DID='$did' AND GRID='$grid'";
		$quDeleteDeal = mysqli_query($dbh, $quStrDeleteDeal);
		
		$quStrDeleteDealClients = "DELETE FROM DEALCLIENTS WHERE DID='$did' AND DGRID='$grid'";
		$quDeleteDealClients = mysqli_query($dbh, $quStrDeleteDealClients);
		
		$quStrDeleteHots = "DELETE FROM HOTS WHERE ITEM_TYPE=2 AND ITEM_ID='$did' AND ITEM_ID2='$cid' AND GRID='$grid'";
		$quDeleteHots = mysqli_query($dbh, $quStrDeleteHots);
		
		$page = "manageListingDeals";
		$disData = "listingDeals";
		$disData2 = "ad";
		$msg = "Deal deleted.";
	}else {
		$page = "manageListingDeals";
		$disData = "listingdeals";
		$disData2 = "ad";
		
		$msg = "Deal not deleted";
	}
//END deleteDealDo //
?>
		
		
		