<?php
//BEGIN select_and_do //

	$now = date ("Ymd");
	$nowDay = date ("d");
	$nowMon = date ("m");
	$nowYear = date ("Y");


		$quStrCountActive = "SELECT count(CID) AS ACTIVECOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid' AND CSOURCE='0'";
		$quCountActive = mysqli_query($GLOBALS['dbh'], $quStrCountActive);
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
            $string2Cat = "";
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

		
			}elseif ($sop=="clpost") {
		if (!$numIDs) {
			$page = "listings";
			$disData = "ads";
			$msg = "No action taken, no ads selected.";
			$title = "Selected";
		} else {		

$i = $numIDs;

echo "i".$i;

		for ($i=1;$i<$numIDs;$i++){

		
		echo "test".$i;
		
// header("Location: https://www.BostonApartments.com/clpost.php?ad=$sel_ids[$i]&cli=$grid&uid=$uid target=$sel_ids[$i]");

//	printf("<script>location.href='https://www.BostonApartments.com/clpost.php?ad=$sel_ids[$i]&cli=$grid&uid=$uid target=$sel_ids[$i]'</script>");


// echo "<script type="text/javascript" language="Javascript">window.open('https://www.BostonApartments.com/clpost.php?ad=$sel_ids[$i]&cli=$grid&uid=$uid');</script>";

			}
		
			$msg = "Posting $numIDs ad(s) to Craigslist";
			$title = "Select and Post to Craigslist";
			$disData = "ads";
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
		$quStrSelAndDo = "UPDATE CLASS SET `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Updated by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";


	}elseif ($sop=="available") {
		$quStrSelAndDo = "UPDATE CLASS SET STATUS_ACTIVE='1', `MOD`='$now', MODBY='".$_SESSION["handle"]."', DATEONMARKET='$now' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Available by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";

	}elseif ($sop=="dom") {
		$quStrSelAndDo = "UPDATE CLASS SET `DATEONMARKET`='$now', `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) reset Days on Market and Last Modified Date was set to today by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";

	}elseif ($sop=="unavailable") {
		$quStrSelAndDo = "UPDATE CLASS SET STATUS_ACTIVE='0', `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Unavailable by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";


	}elseif ($sop=="deact-unavail") {
		$quStrSelAndDo = "UPDATE CLASS SET STATUS='STO', STATUS_ACTIVE='0', STATUS_VACANT='0', `STATUS_PENDING`='0', `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-128"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked deactivated and unavailable and occupied by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Selected";




	}elseif ($sop=="pending") {
		$quStrSelAndDo = "UPDATE CLASS SET STATUS_PENDING='1', `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Pending by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";

	}elseif ($sop=="pendingno") {
		$quStrSelAndDo = "UPDATE CLASS SET STATUS_PENDING='0', `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Not Pending by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";

	}elseif ($sop=="priority") {
		$quStrSelAndDo = "UPDATE CLASS SET PRIORITY='1', `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Priority Listing by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";



	}elseif ($sop=="act-avail") {
		

		if ($rowCountActive->ACTIVECOUNT <= $_SESSION["maxAct"]) {

			
		$quStrSelAndDo = "UPDATE CLASS SET STATUS='ACT', STATUS_ACTIVE='1', `MOD`='$now', MODBY='".$_SESSION["handle"]."', DATEONMARKET='$now' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-128"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Activated and Available by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Selected";

	
		} else {

$page = "sel";
			$disData = "ads";
			$msg = "<B><FONT COLOR=RED>$numIDs ad(s) NOT activated</FONT>. Maximum number (".$_SESSION["maxAct"].") of active ads exceeded.  <B>You must deactivate " . ($rowCountActive->ACTIVECOUNT-$_SESSION["maxAct"]) ." ad(s) before you can activate these $numIDs.";
			$msg_error = true;
			$title = "Selected";
		}


		
		
			}elseif ($sop=="act-avail-datenow") {
		

		if ($rowCountActive->ACTIVECOUNT <= $_SESSION["maxAct"]) {

			
		$quStrSelAndDo = "UPDATE CLASS SET STATUS='ACT', STATUS_ACTIVE='1', `AVAIL`='$now', `MOD`='$now', MODBY='".$_SESSION["handle"]."', DATEONMARKET='$now' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-128"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Activated and Available NOW by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Selected";

	
		} else {

$page = "sel";
			$disData = "ads";
			$msg = "<B><FONT COLOR=RED>$numIDs ad(s) NOT activated</FONT>. Maximum number (".$_SESSION["maxAct"].") of active ads exceeded.  <B>You must deactivate " . ($rowCountActive->ACTIVECOUNT-$_SESSION["maxAct"]) ." ad(s) before you can activate these $numIDs.";
			$msg_error = true;
			$title = "Selected";
		}

		
		
		
		
		

	}elseif ($sop=="vacant") {
		$quStrSelAndDo = "UPDATE CLASS SET VACANT='1' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked vacant by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";


	}elseif ($sop=="occupied") {
		$quStrSelAndDo = "UPDATE CLASS SET VACANT='0' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked occupied by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";


	}elseif ($sop=="deactivate") {
		$quStrSelAndDo = "UPDATE CLASS SET STATUS='STO', `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-126"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) deactivated by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Selected";


	}elseif ($sop=="activate") {
		
	
if ($rowCountActive->ACTIVECOUNT <= $_SESSION["maxAct"]) {
	
			$quStrSelAndDo = "UPDATE CLASS SET STATUS='ACT', `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
			$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die("can't multi update");
			$page = "sel";
			$disData = "ads";
			$msg = "$numIDs ad(s) activated by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
			$title = "Selected";


		} else {
			$page = "sel";
			$disData = "ads";
			$msg = "$numIDs ad(s) <B><FONT COLOR=RED>NOT activated</FONT>. Maximum number (".$_SESSION["maxAct"].") of active ads exceeded.  <B>You must deactivate " . ($rowCountActive->ACTIVECOUNT-$_SESSION["maxAct"]) ." ad(s) before you can activate these $numIDs.</B>";
			$msg_error = true;
			$title = "Selected";
		}



	}elseif ($sop=="cobroke") {
		$quStrSelAndDo = "UPDATE CLASS SET COBROKE='1', `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Co-Broke for distribution by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";

	}elseif ($sop=="cobroke2") {
		$quStrSelAndDo = "UPDATE CLASS SET COBROKE='1', STATUS_ACTIVE='1', `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Co-Broke for distribution and Active by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";
		
	}elseif ($sop=="cobroke3") {
		$quStrSelAndDo = "UPDATE CLASS SET COBROKE='1', STATUS='ACT', STATUS_ACTIVE='1', `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) marked Co-Broke for distribution, Active and Advertisedby ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";

	}elseif ($sop=="cobrokeoff") {
		$quStrSelAndDo = "UPDATE CLASS SET COBROKE='0' `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) removed from Co-Broke distribution by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";
		
	}elseif ($sop=="cobrokeoff2") {
		$quStrSelAndDo = "UPDATE CLASS SET COBROKE='0', STATUS_ACTIVE='0', `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) removed from Co-Broke distribution by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";
		
	}elseif ($sop=="cobrokeoff3") {
		$quStrSelAndDo = "UPDATE CLASS SET COBROKE='0', STATUS='STO', STATUS_ACTIVE='0', `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die (dieNice ("can't multi update", "E-120"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) removed from Co-Broke distribution by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$title = "Ads View";




	}elseif ($sop=="nofee") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=1, `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die("can't multi update");
		$page = "sel";
		$msg = "$numIDs ad(s) switched to 'NO FEE' by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$disData = "ads";
		$title = "Selected";
	}elseif ($sop=="fee") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=0, `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die("can't multi update");
		$page = "sel";
		$msg = "$numIDs ad(s) 'NO FEE' value negated by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$disData = "ads";
		$title = "Selected";
		
		
		
			}elseif ($sop=="fee2") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=9, `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die("can't multi update");
		$page = "sel";
		$msg = "$numIDs ad(s) 'FEE' value marked FEE (Don't Print) by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$disData = "ads";
		$title = "Selected";
		
			}elseif ($sop=="fee2print") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=10, `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die("can't multi update");
		$page = "sel";
		$msg = "$numIDs ad(s) 'FEE' value marked FEE (Print) by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$disData = "ads";
		$title = "Selected";
		
		
	}elseif ($sop=="nofee") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=1, `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die("can't multi update");
		$page = "sel";
		$msg = "$numIDs ad(s) switched to 'NO FEE' by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$disData = "ads";
		$title = "Selected";
		
	}elseif ($sop=="feeprint") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=7, `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die("can't multi update");
		$page = "sel";
		$msg = "$numIDs ad(s) 'FEE' value changed to PRINT NO FEE by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$disData = "ads";
		$title = "Selected";
		
		
	}elseif ($sop=="feeneg") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=6, `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die("can't multi update");
		$page = "sel";
		$msg = "$numIDs ad(s) changed to 'FEE NEGOTIABLE' by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$disData = "ads";
		$title = "Selected";
	}elseif ($sop=="feehalf") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=2, `MOD`='$now', MODBY='".$_SESSION["handle"]."' $selWHERE";
		$quSelAndDo = mysqli_query($GLOBALS['dbh'], $quStrSelAndDo) or die("can't multi update");
		$page = "sel";
		$msg = "$numIDs ad(s) changed to 'HALF FEE' by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		$disData = "ads";
		$title = "Selected";
	}

	


	$needOptions = true;



if (($sop!="delete") AND ($sop!="email") AND ($sop!="print")) {

	//sort out where to go//
	if (isset($adlEditNav)) {
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