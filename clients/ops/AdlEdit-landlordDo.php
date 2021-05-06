<?php
//BEGIN global-ListingsEdit //


$lid = $_POST['lid'];
$cid = $_POST['cid'];
$return_page = $_POST['return_page'];


$LANDLORD = $_POST['LANDLORD'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET `LANDLORD` = '$LANDLORD' WHERE LANDLORD='$lid' AND CID='$cid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);


$msg = "The Landlord / Owner was changed by $handle on $now";

$page="editLandlord";

//END global-ListingsEdit//
?>
