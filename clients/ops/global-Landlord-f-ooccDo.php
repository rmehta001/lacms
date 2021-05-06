<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_OWNER_OCCUPIED = $_POST['AMENITIES_OWNER_OCCUPIED'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_OWNER_OCCUPIED` = '$AMENITIES_OWNER_OCCUPIED' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Owner Occupied setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>