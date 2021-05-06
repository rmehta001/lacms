<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_FIREPLACE_DECOR = $_POST['FEATURES_FIREPLACE_DECOR'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_FIREPLACE_DECOR` = '$FEATURES_FIREPLACE_DECOR' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Decorative Fireplace setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>