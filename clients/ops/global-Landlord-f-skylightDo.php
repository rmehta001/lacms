<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_SKYLIGHT = $_POST['FEATURES_SKYLIGHT'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_SKYLIGHT` = '$FEATURES_SKYLIGHT' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Skyligh setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>