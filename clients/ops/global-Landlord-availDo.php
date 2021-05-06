<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$bbbMonth = $_POST['bbbMonth'];
$bbbDay = $_POST['bbbDay'];
$bbbYear = $_POST['bbbYear'];

$avail = "$bbbYear$bbbMonth$bbbDay";

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `AVAIL` = '$avail' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with an availability date of $bbbYear-$bbbMonth-$bbbDay by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
