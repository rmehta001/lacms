<?php
//BEGIN global-ListingsEdit //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$STREET = $_POST['STREET'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET STREET = '$STREET' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the new street name of $STREET by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit //
?>
