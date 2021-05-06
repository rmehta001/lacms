<?php
//BEGIN deactivate //

		$nowMon = date (m);
		$nowDay = date (d);
		$nowYear = date (Y);

	$cid = $HTTP_GET_VARS['cid'];
	$quStrUpdateAd = "UPDATE CLASS SET `MOD`='$now', MODBY='$handle', STATUS='STO' WHERE CID=$cid AND CLI=$grid";;
	$quUpdateAd = mysqli_query($dbh, $quStrUpdateAd) or die (dieNice ("Sorry, Couldn't update ad.", "ERROR-DEACTIVATE-SEL"));

if ($return_page) {

	$page = "$return_page";

} else {
	$page = "sel";
}

	$title = "Selected";
	$disData = "ads";
	$msg = "Ad $cid deactivated by $handle on $nowMon-$nowDay-$nowYear.";
//END deactivate //
?>