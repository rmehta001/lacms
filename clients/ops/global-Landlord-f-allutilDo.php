<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_ALL_UTILITIES = $_POST['FEATURES_ALL_UTILITIES'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_ALL_UTILITIES` = '$FEATURES_ALL_UTILITIES' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the All Utilities setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>