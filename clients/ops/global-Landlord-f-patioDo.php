<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_PATIO = $_POST['FEATURES_PATIO'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_PATIO` = '$FEATURES_PATIO' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Patio setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>