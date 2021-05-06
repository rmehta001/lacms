<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_CONCIEARGE = $_POST['AMENITIES_CONCIEARGE'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_CONCIEARGE` = '$AMENITIES_CONCIEARGE' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Concierge setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>