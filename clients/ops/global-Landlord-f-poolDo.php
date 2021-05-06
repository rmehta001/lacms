<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_POOL = $_POST['AMENITIES_POOL'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_POOL` = '$AMENITIES_POOL' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Pool setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>