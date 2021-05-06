<?php
//BEGIN mark_available //
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
   elseif ($turn=="available")
   {
	$quStrSetAvailable = "UPDATE CLASS SET `MOD`='$now', MODBY='".$_SESSION["handle"]."', STATUS_ACTIVE='1', DATEONMARKET='$now' WHERE CID=$cid AND CLI=$grid";
        $quSetAvailable = mysqli_query($GLOBALS['dbh'], $quStrSetAvailable) or die (dieNice ("Sorry, Couldn't update ad.", "E-113"));
	$msg = "Ad $cid marked Available by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear";
   } elseif ($turn=="unavailable") {
	$quStrSetAvailable = "UPDATE CLASS SET `MOD`='$now', MODBY='".$_SESSION["handle"]."', STATUS_ACTIVE='0' WHERE CID=$cid AND CLI=$grid";
        $quSetAvailable = mysqli_query($GLOBALS['dbh'], $quStrSetAvailable) or die (dieNice ("Sorry, Couldn't update ad.", "E-113"));
	$msg = "Ad $cid marked Unavailable by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear";
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

//END mark_available //
?>