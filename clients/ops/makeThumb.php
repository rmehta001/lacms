<?php
   if( $pic && $uid && cid && is_file("$picsDirectory/$pic") && $grid)
   {
	$quStrUpdateThumb = "UPDATE CLASS SET THUMBNAIL='$pic' WHERE CID='$cid' AND CLI='$grid'";
	$quUpdateThumb = mysqli_query($dbh, $quStrUpdateThumb) or die (dieNice ("Sorry, Couldn't update ad.", "E-113"));
        $page = "managePics";
        $msg = "$pic set as thumbnail for $abv-$cid";
   } else {
	$page = "managePics";
	$msg="error while setting thumbail $pic for uid: $uid cid: $cid";
	$msg_err = true;
   }
?>
