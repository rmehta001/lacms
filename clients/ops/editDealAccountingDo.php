<?php
//BEGIN editDealAccountingDo //
	$did = $HTTP_GET_VARS['did'];
	$cid = $HTTP_GET_VARS['cid'];
	
	$client_array = array();
	foreach ($_POST as $postedKey => $postedValue) {
		$posted_split = split ("~", $postedKey);
		$client_array[$posted_split[0]][$posted_split[1]] = $postedValue;
	}
	
	foreach ($client_array as $clientID => $client_data) {
		$i = 0;
		$update_string = "";
		foreach ($client_data as $client_field => $client_value) {		
			$i++;
			$update_string .= " $client_field='$client_value' ";
			
			if ($i <= 5) {
				$update_string .= ",";
			}
		}
		$quStrUpdateClient = "UPDATE CLIENTS SET $update_string WHERE CLID='$clientID' AND GRID='$grid'";
		$quUpdateClient = mysqli_query($dbh, $quStrUpdateClient);
		
	}
	
	$page = "editDeal";
	$disData = "deal";
	$disData2 = "ad";
	$msg = "Client accounting updated.";
	

?>
		
	