<?php
//BEGIN editClientDo //

if ($level>4) {
		$clid = $_POST['CLID'];

$quStrUpdateClient = "UPDATE CLIENTS SET  SHOW_DATE='0000-00-00', SHOW_TIME='', SHOW_LENGTH='' WHERE GRID='$grid' AND UID='$uid' AND CLID='$clid'";


$action = "Appontment cancelled by $handle";
$quStrAddClientH = "INSERT INTO CLIENTS_HISTORY (UID, HANDLE, CLI, CLID, ACTION) VALUES ('$uid', '$handle', '$grid', '$clid', '$action')";
$quAddClientH = mysqli_query($dbh, $quStrAddClientH) or die ($quStrAddClientH);




		$quUpdateClient = mysqli_query($dbh, $quStrUpdateClient) or die ($quStrUpdateClient);
		
		$page = "hotlist";
		$msg = "Appointment Canceled." ;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END editClientDo //
?>