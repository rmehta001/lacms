<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_GAS_RANGE = $_POST['FEATURES_GAS_RANGE'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_GAS_RANGE` = '$FEATURES_GAS_RANGE' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Gas Range setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>