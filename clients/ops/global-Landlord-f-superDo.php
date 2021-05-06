<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_SUPERINTENDANT = $_POST['AMENITIES_SUPERINTENDANT'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_SUPERINTENDANT` = '$AMENITIES_SUPERINTENDANT' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Superintendent setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>