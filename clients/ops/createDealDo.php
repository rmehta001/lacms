<?php
//BEGIN createDealDo //
	$selected_clients = $_POST['selected_clients'];
	$cid = $_POST['cid'];
	$now = date("Ymd");
	
	$quStrInsertDeal = "INSERT INTO DEALS (DUID, GRID, CID, PUBLIC, DSTATUS, DEAL_DATEIN) VALUES ('$uid', '$grid', '$cid', 1, 1, '$now')";
	$quInsertDeal = mysqli_query($dbh, $quStrInsertDeal) or die ($quStrInsertDeal);
	$new_did = mysqli_insert_id($dbh);
	
	foreach ($selected_clients as $selected_client) {
		$quStrInsertDealClient = "INSERT INTO DEALCLIENTS (DID, DCLID, DGRID) VALUES ('$new_did', '$selected_client', '$grid')";
		$quInsertDealClient = mysqli_query($dbh, $quStrInsertDealClient);
	}
	
	$page = "editDeal";
	$did = $new_did;
	$disData = "deal";
	$disData2 = "ad";
	
	$msg = "New Deal created.";
	
	


//END createDealDo //
?>