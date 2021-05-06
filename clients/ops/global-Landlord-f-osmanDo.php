<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_ON_SITE_MANAGEMENT = $_POST['AMENITIES_ON_SITE_MANAGEMENT'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_ON_SITE_MANAGEMENT` = '$AMENITIES_ON_SITE_MANAGEMENT' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the On-site Management setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>