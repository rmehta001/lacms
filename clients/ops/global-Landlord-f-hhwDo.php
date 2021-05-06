<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_HT_AND_HW = $_POST['FEATURES_HT_AND_HW'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_HT_AND_HW` = '$FEATURES_HT_AND_HW' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Heat &amp; Hot Water setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>