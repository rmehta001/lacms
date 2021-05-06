<?php
//BEGIN select_and_do //

	$now = date ("Ymd");
	$nowDay = date ("d");
	$nowMon = date ("m");
	$nowYear = date ("Y");


	$sop = $_POST['sop'];
	$sel_ids = $_POST['sel_ids'];
	
	$numIDs = count($sel_ids);

	switch ($numIDs) {
		case 0:
			$selWHERE = " WHERE 1=2";
			break;
		case 1: $selWHERE = " WHERE CID=$sel_ids[0] AND CLI=$grid";
			break;
		default:
			$selWHERE = " WHERE CID=$sel_ids[0]";
			for ($i=1;$i<$numIDs;$i++){
				$string2Cat.= " OR CID=$sel_ids[$i] ";
			}
			$string2Cat.= " AND CLI=$grid ";
			$selWHERE.= $string2Cat;
		}
	if ($sop=="delete") {
		if (!$numIDs) {
			$page = "sel";
			$disData = "ads";
			$msg = "No action taken,  no ads selected.";
			$title = "Selected";
		} else {			
			$page = "select_and_delete";
			$msg = "Please confirm the deletion of $numIDs ad(s).";
			$title = "Select and Delete";
		}



	}elseif ($sop=="email") {
		if (!$numIDs) {
			$page = "sel";
			$disData = "ads";
			$msg = "No action taken, no ads selected.";
			$title = "Selected";
		} else {			
			$page = "mail_multilistings";
			$msg = "Please enter the address(es) the $numIDs ad(s) should be emailed to.";
			$title = "Select and Email";
		}



	}elseif ($sop=="updtd") {
		$quStrSelAndDo = "UPDATE CLASS SET `MOD`='$now', MODBY='$handle' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Updated by $handle on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";


	}elseif ($sop=="available") {
		$quStrSelAndDo = "UPDATE CLASS SET STATUS_ACTIVE='1', `MOD`='$now', MODBY='$handle' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Available by $handle on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";


	}elseif ($sop=="unavailable") {
		$quStrSelAndDo = "UPDATE CLASS SET STATUS_ACTIVE='0', `MOD`='$now', MODBY='$handle' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Unavailable by $handle on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";


	}elseif ($sop=="vacant") {
		$quStrSelAndDo = "UPDATE CLASS SET VACANT='1' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked vacant by $handle on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";


	}elseif ($sop=="occupied") {
		$quStrSelAndDo = "UPDATE CLASS SET VACANT='0' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked occupied by $handle on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";


	}elseif ($sop=="deactivate") {
		$quStrSelAndDo = "UPDATE CLASS SET STATUS='STO', `MOD`='$now', MODBY='$handle' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-126"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) deactivated by $handle on $nowMon-$nowDay-$nowYear.";
		$title = "Selected";


	}elseif ($sop=="activate") {
		$quStrCountActive = "SELECT count(CID) AS ACTIVECOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid'";
		$quCountActive = mysqli_query($dbh, $quStrCountActive);
		$rowCountActive= mysqli_fetch_object ($quCountActive);
		if ($rowCountActive->ACTIVECOUNT <= $maxAct) {
			$quStrSelAndDo = "UPDATE CLASS SET STATUS='ACT', `MOD`='$now', MODBY='$handle' $selWHERE";
			$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die("can't muli update");
			$page = "sel";
			$disData = "ads";
			$msg = "$numIDs ad(s) activated by $handle on $nowMon-$nowDay-$nowYear.";
			$title = "Selected";


		} else {
			$page = "sel";
			$disData = "ads";
			$msg = "$numIDs ad(s) not activated. Maximum number ($maxAct) of active ads exceeded.  You must deactivate " . ($rowCountActive->ACTIVECOUNT-$maxAct) ." ad(s) before you can activate these $numIDs.";
			$msg_error = true;
			$title = "Selected";
		}







	}elseif ($sop=="nofee") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=1, `MOD`='$now', MODBY='$handle' $selWHERE";
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die("can't multi update");
		$page = "sel";
		$msg = "$numIDs ad(s) switched to 'NO FEE' by $handle on $nowMon-$nowDay-$nowYear.";
		$disData = "ads";
		$title = "Selected";
	}elseif ($sop=="fee") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=0, `MOD`='$now', MODBY='$handle' $selWHERE";
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die("can't multi update");
		$page = "sel";
		$msg = "$numIDs ad(s) 'NO FEE' value negated by $handle on $nowMon-$nowDay-$nowYear.";
		$disData = "ads";
		$title = "Selected";
	}elseif ($sop=="feeneg") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=6, `MOD`='$now', MODBY='$handle' $selWHERE";
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die("can't multi update");
		$page = "sel";
		$msg = "$numIDs ad(s) changed to 'FEE NEGOTIABLE' by $handle on $nowMon-$nowDay-$nowYear.";
		$disData = "ads";
		$title = "Selected";
	}elseif ($sop=="feenhalf") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=2, `MOD`='$now', MODBY='$handle' $selWHERE";
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die("can't multi update");
		$page = "sel";
		$msg = "$numIDs ad(s) changed to 'HALF FEE' by $handle on $nowMon-$nowDay-$nowYear.";
		$disData = "ads";
		$title = "Selected";
	}



	$needOptions = true;



if ($sop!="delete" or $sop!="email") {

	//sort out where to go//
	if ($adlEditNav) {
		if ($adlEditNav=="managePics") {
			$disData = "pics";
			$page = $adlEditNav;
		}elseif ($adlEditNav=="manageListingDeals") {
			$disData = "listingdeals";
			$disData2 = "listing";
			$page = $adlEditNav;
		}elseif ($adlEditNav=="printOuts") {
			$page = $adlEditNav;
		}elseif ($adlEditNav=="listings") {
			$disData = "listings";
			$page = "listings";
		}elseif ($adlEditNav=="sel") {
			$disData = "ads";
			$page = "sel";
		}
	}else {
		if ($return_page == "adlEdit") {
			$return_page = "home";
		}
		$return_page_go = true;
	}

}

//END select_and_do //
?>