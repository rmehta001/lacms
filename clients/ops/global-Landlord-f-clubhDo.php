<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_CLUBHOUSE = $_POST['AMENITIES_CLUBHOUSE'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_CLUBHOUSE` = '$AMENITIES_CLUBHOUSE' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Club House setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>