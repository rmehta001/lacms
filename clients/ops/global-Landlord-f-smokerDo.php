<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_NON_SMOKING = $_POST['FEATURES_NON_SMOKING'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_NON_SMOKING` = '$FEATURES_NON_SMOKING' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Features &amp; Amenities Non-Smoking setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>