<?php
//BEGIN deleteClientDo//



	$clid = $_POST['clid'];
	$conf = $_POST['conf'];
	$handle = $_SESSION ["handle"];
        if(empty($handle))
        {
            die (dieNice ("You are not correctly logged in or have been logged out.  Please click <a href=\"../\">here</a> to login.", "E-1"));
        }
	$return_page = $_POST['return_page'];
	
	
	if ($conf == 'y' || $conf == 'Y') {
		$quStrCheckForDeals = "SELECT count(id)AS DCLIDCOUNT FROM DEALCLIENTS WHERE DCLID='$clid'";
		$quCheckForDeals = mysqli_query($dbh, $quStrCheckForDeals);
		$rowCheckForDeals = mysqli_fetch_object($quCheckForDeals);
		
		if ($rowCheckForDeals && $rowCheckForDeals->DCLIDCOUNT) {
			
			$page = "manageClients";
			$title = "Manage Clients";
			$disData = "clients";
			$msg_err = true;
			if ($rowCheckForDeals->DCLIDCOUNT == 1) {
				$msg = "There is a DealSheet associated with this client that must be deleted first.";
			}else {
				$msg = "There are ". $rowCheckForDeals->DCLIDCOUNT . " DealSheets associated with this client which must be deleted first.";
			}
		}else {
			$quStrDelClient = "DELETE FROM CLIENTS WHERE CLID='$clid'";
			$quDelClient = mysqli_query($dbh, $quStrDelClient);


$action = "Client deleted by $handle";
$quStrAddClientH = "INSERT INTO CLIENTS_HISTORY (UID, HANDLE, CLI, CLID, ACTION) VALUES ('$uid', '$handle', '$grid', '$clid', '$action')";
$quAddClientH = mysqli_query($dbh, $quStrAddClientH) or die ($quStrAddClientH);


						if ($return_page == "hotlist") {
			$page = "hotlist";
			$title = "Hot List";
				} else {
			$page = "manageClients";
			$title = "Manage Clients";
			}
			
			
			$disData = "clients";
			$msg = "Client contact deleted.";
			$sec_op = "manageClients";
		}
	}else {
		
		$page = "deleteClient";
		$title = "Delete Client";
		$disData = "client";
		$msg_err = true;
		$msg = "Please type 'y' to confirm.";
	}

	
//END deleteClientDo//
?>