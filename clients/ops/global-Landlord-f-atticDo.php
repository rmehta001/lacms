<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_ATTIC = $_POST['AMENITIES_ATTIC'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_ATTIC` = '$AMENITIES_ATTIC' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Business Center setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>