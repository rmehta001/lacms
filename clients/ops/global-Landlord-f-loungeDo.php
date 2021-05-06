<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_LOUNGE = $_POST['AMENITIES_LOUNGE'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_LOUNGE` = '$AMENITIES_LOUNGE' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Lounge setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>