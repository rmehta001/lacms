<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_HEALTH_CLUB = $_POST['AMENITIES_HEALTH_CLUB'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_HEALTH_CLUB` = '$AMENITIES_HEALTH_CLUB' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Health Club setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>