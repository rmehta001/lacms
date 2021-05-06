<?php
//BEGIN global-ListingsEdit //


$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];

$HOT_WATER_RESP = $_POST['HOT_WATER_RESP'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `HOT_WATER_RESP` = '$HOT_WATER_RESP' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with the new hot water responsibility by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
