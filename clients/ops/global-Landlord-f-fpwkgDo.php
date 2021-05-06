<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_FIREPLACE_WORKING = $_POST['FEATURES_FIREPLACE_WORKING'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_FIREPLACE_WORKING` = '$FEATURES_FIREPLACE_WORKING' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Working Fireplace setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>