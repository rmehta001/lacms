<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_DISHWASHER = $_POST['FEATURES_DISHWASHER'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_DISHWASHER` = '$FEATURES_DISHWASHER' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Dishwasher setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>