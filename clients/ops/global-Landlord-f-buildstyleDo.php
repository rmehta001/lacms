<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$BUILDING_STYLE = $_POST['BUILDING_STYLE'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `BUILDING_STYLE` = '$BUILDING_STYLE' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Building Style setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>