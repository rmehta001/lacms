<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_FURNISHED = $_POST['FEATURES_FURNISHED'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_FURNISHED` = '$FEATURES_FURNISHED' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Features &amp; Amenities Furnished setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>