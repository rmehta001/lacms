<?php
//BEGIN mark_updated //
		$cid = $_GET['cid'];

   $cid = $_GET['cid'];
   $return_page = $_GET['return_page'];

   if($cid=="" | $grid=="")
   {  $msg="ERROR"; }
   else
   {
	$quStrSetVacant = "UPDATE CLASS SET `MOD`='$now', MODBY='".$_SESSION["handle"]."' WHERE CID=$cid AND CLI=$grid";
        $quSetVacant = mysqli_query($GLOBALS['dbh'], $quStrSetVacant) or die (dieNice ("Sorry, Couldn't update ad.", "E-114"));
	$msg = "Ad $cid marked UPDATED by ".$_SESSION["handle"]." on $now.";
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

//END mark_updated //
?>