<?php


$view_listing_table_set = "(((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN STATES ON LOC.STATE=STATES.STATE_ID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID";


function db_delete_listing_admin ($listing_id) {
	global $picsDirectory;
	//delete pictures
	$quStrGetListing = "select * from CLASS inner join `GROUP` on CLASS.CLI=`GROUP`.GRID where CID='$listing_id'";
	$quGetListing = mysqli_query($GLOBALS['dbh'],$quStrGetListing) or die (mysqli_error());
	$rowGetListing = mysqli_fetch_object($quGetListing);
	
	$quStrCountPics = "select count(PID) as picture_count from PICTURE where CID='$listing_id'";
	$quCountPics = mysqli_query($GLOBALS['dbh'],$quStrCountPics) or die (mysqli_error($dbh));
	$rowCountPics = mysqli_fetch_object($quCountPics);
	$picture_count = $rowCountPics->picture_count;
	
	if ($picture_count) {
		
		$quStrGetPics = "select * from PICTURE where CID='$listing_id'";
		$quGetPics = mysqli_query($GLOBALS['dbh'],$quStrGetPics) or die (mysqli_error());
		while ($rowGetPics = mysqli_fetch_object($quGetPics)) {
			$picture = "$picsDirectory/$rowGetPics->PID.$rowGetPics->EXT";
			unlink ($picture) or die ($picture);
			
		}
		$quStrDeletePics = "delete from PICTURE where CID='$listing_id'";
		$quDeletePics = mysqli_query($GLOBALS['dbh'],$quStrDeletePics) or die (mysqli_error());
		
	}
	
	//delete hot list entries (both listings and deals)
	$quStrDeleteHots = "delete from HOTS where (ITEM_TYPE='1' and ITEM_ID='$listing_id') OR (ITEM_TYPE='2' and ITEM_ID2='$listing_id')";
	$quDeleteHots = mysqli_query($GLOBALS['dbh'],$quStrDeleteHots) or die (mysqli_error());
	
	
	//delete deals and deal clients
	$quStrGetDeals = "select * from DEALS where CID='$listing_id'";
	$quGetDeals = mysqli_query($GLOBALS['dbh'],$quStrGetDeals) or die (mysqli_error($dbh));
	
	
	while ($rowGetDeals = mysqli_fetch_object($quGetDeals)) {
		$deal_id = $rowGetDeals->DID;
		$quStrDeleteDealClients = "delete from DEALCLIENTS where DID='$deal_id'";
		$quDeleteDealClients = mysqli_query($GLOBALS['dbh'],$quStrDeleteDealClients) or die (mysqli_error($dbh));
		
		
	}
	
	$quStrDeleteDeals = "delete from DEALS where CID='$listing_id'";
	$quDeleteDeals = mysqli_query($GLOBALS['dbh'],$quStrDeleteDeals) or die (mysqli_error());
	
	
	//delete open house
	$quStrDeleteOpenHouse = "delete from OPENHOUSE where CID='$listing_id'";
	$quDeleteOpenHouse = mysqli_query($GLOBALS['dbh'],$quStrDeleteOpenHouse) or die (mysqli_error());
	

	//delete listing
	$quStrDeleteListing = "delete from CLASS where CID='$listing_id'";
	$quDeleteListing = mysqli_query($GLOBALS['dbh'],$quStrDeleteListing) or die (mysqli_error());
	
	return 1;
	

}

function db_deactivate_listing_admin($listing_id) {
	$quStrDeactivateListing = "update CLASS set STATUS='STO' where CID='$listing_id'";
	$quDeactivateListing = mysqli_query($GLOBALS['dbh'],$quStrDeactivateListing) or die (mysqli_error());
	
	return 1;
}

function db_activate_listing_admin ($listing_id) {
	$quStrDeactivateListing = "update CLASS set STATUS='ACT' where CID='$listing_id'";
	$quDeactivateListing = mysqli_query($GLOBALS['dbh'],$quStrDeactivateListing) or die (mysqli_error());
	
	return 1;
}	

?>