<?php
//BEGIN global-ListingsEdit //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$xstreet = $_POST['xstreet'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET xstreet = '$xstreet' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the new cross street name of $xstreet by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit //
?>
