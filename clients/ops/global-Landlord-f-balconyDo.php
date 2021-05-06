<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_BALCONY = $_POST['FEATURES_BALCONY'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_BALCONY` = '$FEATURES_BALCONY' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Balcony setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>