<?php
//BEGIN activate //

		$nowMon = date ("m");
		$nowDay = date ("d");
		$nowYear = date ("Y");


		$cid = $_GET['cid'];
		$return_page = $_GET['return_page'];
		$quStrCountActive = "SELECT count(CID) AS ACTIVECOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid'";
		$quCountActive = mysqli_query($GLOBALS['dbh'], $quStrCountActive);
		$rowCountActive= mysqli_fetch_object ($quCountActive);
		if ($rowCountActive->ACTIVECOUNT <= $_SESSION["maxAct"]) {
			$quStrUpdateAd = "UPDATE CLASS SET `MOD`='$now', MODBY='".$_SESSION["handle"]."', STATUS='ACT' WHERE CID=$cid AND CLI=$grid";
			$quUpdateAd = mysqli_query($GLOBALS['dbh'], $quStrUpdateAd) or die (dieNice ("Sorry, Couldn't update ad.", "ERROR-ACTIVATE-LISTINGS"));


if ($return_page == "findit") {
		$findit = $_SESSION['findit'];
     header("Location: " . $_SERVER['HTTP_REFERER'] . "&findit=".$findit); 
   
   } else {
			$page = $return_page;
}

			$title = "Selected";
			$disData = "ads";
			$msg = "Ad $cid activated by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
		}else {


if ($return_page == "findit") {
		$findit = $_SESSION['findit'];
     header("Location: " . $_SERVER['HTTP_REFERER'] . "&findit=".$findit); 
   
   } else {
		$page = $return_page;
}


		$title = "Selected";
			$disData = "ads";
			$msg = "<font color=red>Ad $cid NOT ACTIVATED.</FONT> The maximum number (".$_SESSION["maxAct"].") of active ads exceeded. You must deactivate " . ($rowCountActive->ACTIVECOUNT-$_SESSION["maxAct"]) . " ad(s) first to activate this one. You may also purchase additional ads.";
			$msg_error = true;
		}
//END activate //
?>


