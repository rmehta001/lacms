<?php
//BEGIN global-ListingsEdit //

$lid = $_POST['lid'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$return_page = $_POST['return_page'];


$MIDDLE_SCHOOL = $_POST['MIDDLE_SCHOOL'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `MIDDLE_SCHOOL` = '$MIDDLE_SCHOOL' WHERE LANDLORD='$lid' AND STREET_NUM='$street_num' AND STREET='$street' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings at $street_num $street were updated with a change to the Middle School setting by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>