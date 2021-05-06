<?php
//BEGIN mark_vacant //

	$cid = $_GET['cid'];
	$page = $_GET['return_page'];
	$turn = $_GET['turn'];

   if($cid=="" | $grid=="" | $turn == "")
   {  $msg="ERROR"; }
   elseif ($turn=="vacant")
   {
	$quStrSetVacant = "UPDATE CLASS SET STATUS_VACANT='1' WHERE CID=$cid AND CLI=$grid";
        $quSetVacant = mysqli_query($GLOBALS['dbh'], $quStrSetVacant) or die (dieNice ("Sorry, Couldn't update ad.", "E-114"));
	$msg = "Ad $cid marked VACANT";
   } elseif ($turn=="occupied") {
	$quStrSetVacant = "UPDATE CLASS SET STATUS_VACANT='0' WHERE CID=$cid AND CLI=$grid";
        $quSetVacant = mysqli_query($GLOBALS['dbh'], $quStrSetVacant) or die (dieNice ("Sorry, Couldn't update ad.", "E-114"));
	$msg = "Ad $cid marked OCCUPIED";
   }

   $title = "Listings View";
   $disData = "listings";
//END mark_vacant //
?>