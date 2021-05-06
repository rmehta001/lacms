<?php
//BEGIN global-ListingsEdit //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$MAP = $_POST['MAP'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `MAP` = '$MAP' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the new map view setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
