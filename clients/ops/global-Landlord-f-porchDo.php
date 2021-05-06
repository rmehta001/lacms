<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_PORCH = $_POST['FEATURES_PORCH'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_PORCH` = '$FEATURES_PORCH' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Porch setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>