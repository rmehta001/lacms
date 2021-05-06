<?php
//BEGIN global-ListingsEdit //

$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$AGENCY_HEADERS = $_POST['AGENCY_HEADERS'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AGENCY_HEADERS` = '$AGENCY_HEADERS' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were changed to a differnt Office/Agency by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>