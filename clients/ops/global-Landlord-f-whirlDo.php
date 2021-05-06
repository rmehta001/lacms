<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_WHIRLPOOL = $_POST['FEATURES_WHIRLPOOL'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_WHIRLPOOL` = '$FEATURES_WHIRLPOOL' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Whirlpool Tub setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>