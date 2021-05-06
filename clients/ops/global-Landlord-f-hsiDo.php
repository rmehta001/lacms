<?php
//BEGIN global-ListingsEdit //
$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$FEATURES_INTERNET = $_POST['FEATURES_INTERNET'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `FEATURES_INTERNET` = '$FEATURES_INTERNET' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the High-Speed Internet setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>