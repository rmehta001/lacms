<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_SHUTTLE = $_POST['AMENITIES_SHUTTLE'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_SHUTTLE` = '$AMENITIES_SHUTTLE' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Shuttle Bus setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>