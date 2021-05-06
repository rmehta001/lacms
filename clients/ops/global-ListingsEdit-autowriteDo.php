<?php
//BEGIN global-ListingsEdit //

$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];


$AUTO_WRITE = $_POST['AUTO_WRITE'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AUTO_WRITE` = '$AUTO_WRITE' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with a change to the Auto-Write Features &amp; Amenities in Ads setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>