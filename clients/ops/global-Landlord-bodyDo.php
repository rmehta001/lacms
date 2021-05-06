<?php
//BEGIN global-ListingsEdit //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$adbody = $_POST['BODY'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `BODY` = '$adbody' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the Ad Body Text by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit //
?>
