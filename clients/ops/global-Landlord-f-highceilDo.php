<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_HIGH_CEILINGS = $_POST['AMENITIES_HIGH_CEILINGS'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_HIGH_CEILINGS` = '$AMENITIES_HIGH_CEILINGS' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the High Ceilings  to setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>