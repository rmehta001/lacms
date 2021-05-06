<?php
//BEGIN deactivate //
		$nowMon = date ("m");
		$nowDay = date ("d");
		$nowYear = date ("Y");

	$cid = $_GET['cid'];
	$return_page = $_GET['return_page'];
	$quStrUpdateAd = "UPDATE CLASS SET `MOD`='$now', MODBY='".$_SESSION["handle"]."', STATUS='STO' WHERE CID=$cid AND CLI=$grid";;
	$quUpdateAd = mysqli_query($GLOBALS['dbh'], $quStrUpdateAd) or die (dieNice ("Sorry, Couldn't update ad.", "ERROR-DEACTIVATE-LISTINGS"));

if ($return_page == "findit") {
		$findit = $_SESSION['findit'];
     header("Location: " . $_SERVER['HTTP_REFERER'] . "&findit=".$findit); 
   
   } else {
		$page = $return_page;
}

	//$page = "sel";
	$title = "Selected";
	$disData = "ads";
	$msg = "Ad $cid deactivated by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.";





//END deactivate //
?>
