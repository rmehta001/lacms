<?php
//BEGIN global-ListingsEdit //


$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];

$BUILDING_NAME = $_POST['BUILDING_NAME'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET BUILDING_NAME = '$BUILDING_NAME' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with the new street name of $BUILDING_NAME by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit //
?>
