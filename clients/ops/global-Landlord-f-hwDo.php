<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_HOT_WATER = $_POST['FEATURES_HOT_WATER'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_HOT_WATER` = '$FEATURES_HOT_WATER' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Hot Water setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>