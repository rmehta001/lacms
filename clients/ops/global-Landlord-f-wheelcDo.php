<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_WHEELCHAIR = $_POST['AMENITIES_WHEELCHAIR'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_WHEELCHAIR` = '$AMENITIES_WHEELCHAIR' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Wheel Chair Access setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>