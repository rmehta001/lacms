<?php
//BEGIN global-ListingsEdit //


$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];

$PARKING_NUM = $_POST['PARKING_NUM'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `PARKING_NUM` = '$PARKING_NUM' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with the # of spaces per unit set to $PARKING_NUM by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
