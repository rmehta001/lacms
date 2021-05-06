<?php
//BEGIN select_and_do //

	$now = date ("Ymd");
	$nowDay = date ("d");
	$nowMon = date ("m");
	$nowYear = date ("Y");


		$quStrCountActive = "SELECT count(CID) AS ACTIVECOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid'";
		$quCountActive = mysqli_query($dbh, $quStrCountActive);
		$rowCountActive= mysqli_fetch_object ($quCountActive);


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
			$msg = "No action taken, no ads selected.";
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
			$page = "select_and_email";
			$msg = "Please confirm the email of $numIDs ad(s).";
			$title = "Select and Email";

		$disData = "user";
		$disData2 = "ads";
		$disData3 = "clients";
		}
		


	}elseif ($sop=="print") {
		if (!$numIDs) {
			$page = "sel";
			$disData = "ads";
			$msg = "No action taken, no ads selected.";
			$title = "Selected";
		} else {
			$page = "select_and_print";
			$msg = "Please confirm the printing of $numIDs ad(s).";
			$title = "Select and Print";

		$disData = "user";
		$disData2 = "ads";
		$disData3 = "clients";
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
		$quStrSelAndDo = "UPDATE CLASS SET STATUS_ACTIVE='1', `MOD`='$now', MODBY='$handle', DATEONMARKET='$now' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Available by $handle on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";

	}elseif ($sop=="dom") {
		$quStrSelAndDo = "UPDATE CLASS SET `DATEONMARKET`='$now', `MOD`='$now', MODBY='$handle' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) reset Days on Market and Last Modified Date was set to today by $handle on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";

	}elseif ($sop=="unavailable") {
		$quStrSelAndDo = "UPDATE CLASS SET STATUS_ACTIVE='0', `MOD`='$now', MODBY='$handle' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Unavailable by $handle on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";


	}elseif ($sop=="deact-unavail") {
		$quStrSelAndDo = "UPDATE CLASS SET STATUS='STO', STATUS_ACTIVE='0', STATUS_VACANT='0', `MOD`='$now', MODBY='$handle' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-128"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked deactivated and unavailable and occupied by $handle on $nowMon-$nowDay-$nowYear.";
		$title = "Selected";






	}elseif ($sop=="datenow") {
		$quStrSelAndDo = "UPDATE CLASS SET `DATEONMARKET`='$now',`AVAIL`='$now', `MOD`='$now', MODBY='$handle' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) reset Date Available, Days on Market and Last Modified Date was set to today by $handle on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";















	}elseif ($sop=="pending") {
		$quStrSelAndDo = "UPDATE CLASS SET STATUS_PENDING='1', `MOD`='$now', MODBY='$handle' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Pending by $handle on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";

	}elseif ($sop=="pendingno") {
		$quStrSelAndDo = "UPDATE CLASS SET STATUS_PENDING='0', `MOD`='$now', MODBY='$handle' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Not Pending by $handle on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";




	}elseif ($sop=="act-avail") {
		

		if ($rowCountActive->ACTIVECOUNT <= $maxAct) {

			
		$quStrSelAndDo = "UPDATE CLASS SET STATUS='ACT', STATUS_ACTIVE='1', `MOD`='$now', MODBY='$handle', DATEONMARKET='$now' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-128"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked deactivated and unavailable by $handle on $nowMon-$nowDay-$nowYear.";
		$title = "Selected";

		} else {

$page = "sel";
			$disData = "ads";
			$msg = "<B><FONT COLOR=RED>$numIDs ad(s) NOT activated</FONT>. Maximum number ($maxAct) of active ads exceeded.  <B>You must deactivate " . ($rowCountActive->ACTIVECOUNT-$maxAct) ." ad(s) before you can activate these $numIDs.";
			$msg_error = true;
			$title = "Selected";
		}



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
		
	
if ($rowCountActive->ACTIVECOUNT <= $maxAct) {
	
			$quStrSelAndDo = "UPDATE CLASS SET STATUS='ACT', `MOD`='$now', MODBY='$handle' $selWHERE";
			$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die("can't multi update");
			$page = "sel";
			$disData = "ads";
			$msg = "$numIDs ad(s) activated by $handle on $nowMon-$nowDay-$nowYear.";
			$title = "Selected";


		} else {
			$page = "sel";
			$disData = "ads";
			$msg = "$numIDs ad(s) <B><FONT COLOR=RED>NOT activated</FONT>. Maximum number ($maxAct) of active ads exceeded.  <B>You must deactivate " . ($rowCountActive->ACTIVECOUNT-$maxAct) ." ad(s) before you can activate these $numIDs.</B>";
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
	}elseif ($sop=="feehalf") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=2, `MOD`='$now', MODBY='$handle' $selWHERE";
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die("can't multi update");
		$page = "sel";
		$msg = "$numIDs ad(s) changed to 'HALF FEE' by $handle on $nowMon-$nowDay-$nowYear.";
		$disData = "ads";
		$title = "Selected";
	}










	$needOptions = true;



if (($sop!="delete") AND ($sop!="email") AND ($sop!="print")) {

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