<?php
//BEGIN global-ListingsEdit //


$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];

$xstreet = $_POST['xstreet'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET xstreet = '$xstreet' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with the new cross street name of $xstreet by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit //
?>
