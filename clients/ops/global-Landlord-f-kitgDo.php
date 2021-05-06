<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_KITCHEN_GALLEY = $_POST['FEATURES_KITCHEN_GALLEY'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_KITCHEN_GALLEY` = '$FEATURES_KITCHEN_GALLEY' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Galley Kitchen setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>