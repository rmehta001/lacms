<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_ENCLOSED_PORCH = $_POST['FEATURES_ENCLOSED_PORCH'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_ENCLOSED_PORCH` = '$FEATURES_ENCLOSED_PORCH' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Enclosed Porch setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>