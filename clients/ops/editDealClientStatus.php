<?php
//BEGIN editDealClientStatus //
	$dclid =        $_POST['dclid']; 
	$app_status  =  $_POST['app_status'];
	$credit_check = $_POST['credit_check'];
	
	$did = $_POST['did'];
	$cid = $_POST['cid'];
	
	$quStrUpdateClients = "UPDATE CLIENTS SET CLIENT_APP_STATUS='$app_status', CLIENT_CREDIT_CHECK='$credit_check' WHERE CLID='$dclid' AND GRID='$grid'";
	$quUpdateClients = mysqli_query($dbh, $quStrUpdateClients) or die ($quStrUpdateClients);
	
	$page = "editDeal";
	$msg = "Client status updated.";
	$disData = "deal";
	$disData2 = "ad";
	
//END editDealClientStatus //
?>
	