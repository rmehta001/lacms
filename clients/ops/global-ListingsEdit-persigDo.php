<?php
//BEGIN global-ListingsEdit //


$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];


$USE_USER_SIG = $_POST['USE_USER_SIG'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `USE_USER_SIG` = '$USE_USER_SIG' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with a change \"display a personal signature\" on ads by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
