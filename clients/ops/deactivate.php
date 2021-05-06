<?php
//BEGIN deactivate //

		$nowMon = date ("m");
		$nowDay = date ("d");
		$nowYear = date ("Y");

$return_page = isset($_GET['return_page']) ? $_GET['return_page'] : "";

	$cid = $_GET['cid'];
	$quStrUpdateAd = "UPDATE CLASS SET `MOD`='$now', MODBY='".$_SESSION["handle"]."', STATUS='STO' WHERE CID=$cid AND CLI=$grid";;
	$quUpdateAd = mysqli_query($GLOBALS['dbh'], $quStrUpdateAd) or die (dieNice ("Sorry, Couldn't update ad.", "ERROR-DEACTIVATE-SEL"));

if ($return_page) {
$page = "$return_page";
} else {
$page = "sel";
}

	$title = "Selected";
	$disData = "ads";
	$msg = "Ad $cid deactivated by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";
//END deactivate //
?>