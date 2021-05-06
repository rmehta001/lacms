<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AMENITIES_ROOF_DECK = $_POST['AMENITIES_ROOF_DECK'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AMENITIES_ROOF_DECK` = '$AMENITIES_ROOF_DECK' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Roof Deck setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>