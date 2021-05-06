<?php
//BEGIN global-ListingsEdit //


$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];

$bodyfind = $_POST['bodyfind'];
$bodyreplace = $_POST['bodyreplace'];

$where = "CLI='$grid' AND STREET_NUM='$street_num' AND `STREET`='$street' AND `LANDLORD`='$lid' ";


$quStrGetListings = "select  * FROM CLASS `BODY` LIKE ('%$bodyfind%') AND $where ";
	$quGetListings = mysqli_query($dbh, $quStrGetListings) or die (mysqli_error($dbh));
	while ($rowGetListing = mysqli_fetch_object($quGetListings)) {
		$bodyreplace = stripslashes ($bodyreplace);
		$bodyreplace = str_replace("\"", "", $bodyreplace);
		$listing_id = $rowGetListing->CID;
		$old_body = $rowGetListing->BODY;
		$new_body = str_replace ($bodyfind, $bodyreplace, $old_body);
		$new_body = mysqli_real_escape_string($dbh, $new_body);
		
		$quStrUpdateClass = "update CLASS set BODY='$new_body' where CID='$listing_id'";
		$quUpdateClass = mysqli_query($dbh, $quStrUpdateClass) or die (mysqli_error($dbh));
		$replaced++;
	}






$msg = "ALL Listings at $street_num $street were updated with the Ad Body Text by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit //
?>
