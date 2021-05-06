<?php
//BEGIN global-ListingsEdit //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$NOFEE = $_POST['NOFEE'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `NOFEE` = '$NOFEE' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a fee type by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
