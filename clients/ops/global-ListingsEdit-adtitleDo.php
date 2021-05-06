<?php
//BEGIN global-ListingsEdit-Do//


$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];

$AD_TITLE = $_POST['AD_TITLE'];

		$quStrUpdateGLOBAL = "UPDATE CLASS SET AD_TITLE = '$AD_TITLE' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with the new Ad Title of \"$AD_TITLE\" by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit-Do //
?>
