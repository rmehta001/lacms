<?php
//BEGIN global-ListingsEdit //


$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];


$bbbMonth = $_POST['bbbMonth'];
$bbbDay = $_POST['bbbDay'];
$bbbYear = $_POST['bbbYear'];

$avail = "$bbbYear$bbbMonth$bbbDay";

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AVAIL` = '$avail' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with an availability date of $bbbYear-$bbbMonth-$bbbDay by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
