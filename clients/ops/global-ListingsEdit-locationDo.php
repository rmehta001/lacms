<?php
//BEGIN global-ListingsEdit-location.php //


$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];

$LOC = $_POST['LOC'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `LOC` = '$LOC' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with the new location by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit-location.php //
?>
