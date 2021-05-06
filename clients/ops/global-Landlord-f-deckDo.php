<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_DECK = $_POST['FEATURES_DECK'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_DECK` = '$FEATURES_DECK' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Deck setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>