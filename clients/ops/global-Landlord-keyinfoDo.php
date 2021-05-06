<?php
//BEGIN global-ListingsEdit //

$handle = $_SESSION['handle'];
$lid = $_POST['lid'];
$return_page = $_POST['return_page'];


$KEY_INFO = $_POST['KEY_INFO'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET `KEY_INFO` = '$KEY_INFO' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with a change to the Key Information by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
