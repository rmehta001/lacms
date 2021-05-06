<?php
//BEGIN mark_pending //
		$return_page = $_GET['return_page'];
		$return_page_div = $_GET['return_page_div'];
		$turn = $_GET['turn'];


		
if (isset($page) AND $page == "sel") { $grid = $_GET['grid']; };


   $cid = $_GET['cid'];

	$now = date ("Ymd");
		$nowMon = date ("m");
		$nowDay = date ("d");
		$nowYear = date ("Y");

   if($cid=="" | $grid=="" | $turn == "")
   {  $msg="ERROR $cid - $grid - $turn"; }
   elseif ($turn=="pendingno")
   {
	$quStrSetPending = "UPDATE CLASS SET `MOD`='$now', MODBY='".$_SESSION["handle"]."', STATUS_PENDING='0' WHERE CID=$cid AND CLI=$grid";
        $quSetPending = mysqli_query($GLOBALS['dbh'], $quStrSetPending) or die (dieNice ("Sorry, Couldn't update ad.", "E-113"));
	$msg = "Ad $cid marked Pending by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear";
   } elseif ($turn=="pending") {
	$quStrSetPending = "UPDATE CLASS SET `MOD`='$now', MODBY='".$_SESSION["handle"]."', STATUS_PENDING='1' WHERE CID=$cid AND CLI=$grid";
        $quSetPending = mysqli_query($GLOBALS['dbh'], $quStrSetPending) or die (dieNice ("Sorry, Couldn't update ad.", "E-113"));
	$msg = "Ad $cid marked Pending by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear";
   }


if ($return_page == "listings") {

   $page = "listings";
   $title = "Listings View";
   $disData = "listings";


} elseif ($return_page == "sel") {

   $page = "sel";
   $title = "Ad View";
   $disData = "listings";


} elseif ($return_page == "findit") {
		$findit = $_SESSION['findit'];


		

     header("Location: " . $_SERVER['HTTP_REFERER'] . "&findit=".$findit); 

   
   
   } else {

$page = "$return_page";

}

//END mark_pending //
?>