<?php
//BEGIN global-Landlord-parkingcost.php //


$handle = $_SESSION['handle'];

$lid = $_POST['lid'];
$return_page = $_POST['return_page'];

$SHOW_INSTRUCT = $_POST['SHOW_INSTRUCT'];


		$quStrUpdateGLOBAL = "UPDATE CLASS SET SHOW_INSTRUCT = '$SHOW_INSTRUCT' WHERE LANDLORD='$lid' AND CLI='$grid'";
		$quUpdateGLOBAL = mysqli_query($dbh, $quStrUpdateGLOBAL);

$msg = "ALL Listings for this landlord were updated with the new showing instructions by $handle on $now";

$page="editLandlord";

//END global-Landlord-parkingcost.php //
?>
