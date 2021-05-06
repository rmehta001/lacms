<?php
//BEGIN mark_vacant //
		$cid = $HTTP_GET_VARS['cid'];

   $cid = $HTTP_GET_VARS['cid'];
   if($cid=="" | $grid=="" | $turn=="")
   {  $msg="ERROR"; }
   elseif ($turn=="vacant")
   {
	$quStrSetVacant = "UPDATE CLASS SET STATUS_VACANT='1' WHERE CID=$cid AND CLI=$grid";
        $quSetVacant = mysqli_query($dbh, $quStrSetVacant) or die (dieNice ("Sorry, Couldn't update ad.", "E-114"));
	$msg = "Ad $cid marked VACANT";
   } elseif ($turn=="occupied") {
	$quStrSetVacant = "UPDATE CLASS SET STATUS_VACANT='0' WHERE CID=$cid AND CLI=$grid";
        $quSetVacant = mysqli_query($dbh, $quStrSetVacant) or die (dieNice ("Sorry, Couldn't update ad.", "E-114"));
	$msg = "Ad $cid marked OCCUPIED";
   }
   $page = "listings";
   $title = "Listings View";
   $disData = "listings";
//END mark_vacant //
?>