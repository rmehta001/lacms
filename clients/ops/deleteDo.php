<?php
//BEGIN deleteDo //
if ($_SESSION["user_level"]>1) {
	$cid = $_POST['cid'];
	$conf = $_POST['conf'];
	if ($conf=="y" || $conf=="Y") {
		$quStrDelAd = "DELETE FROM CLASS WHERE CID=$cid AND CLI=$grid";
		$quDelAd = mysqli_query($GLOBALS['dbh'], $quStrDelAd) or die (dieNice("Sorry, couldn't delete that ad", "E-102"));
		$quStrGetPics = "SELECT PID, EXT FROM PICTURE WHERE CID=$cid";
		$quGetPics = mysqli_query($GLOBALS['dbh'], $quStrGetPics);
//		while ($rowGetPics = mysqli_fetch_object($quGetPics)) {
//			unlink ("$picsDirectory/$rowGetPics->PID.$rowGetPics->EXT");
//		}
		$quStrDelPics = "DELETE FROM PICTURE WHERE CID=$cid";
		$quDelPics = mysqli_query($GLOBALS['dbh'], $quStrDelPics) or die (dieNice ("Sorry, couldn't delete the picture(s)", "E-103"));
		$quStrDelHots = "DELETE FROM HOTS WHERE ITEM_ID='$cid' AND GRID='$grid'";
		$quDelHots = mysqli_query($GLOBALS['dbh'], $quStrDelHots);

		$quStrDelOpenhouse = "DELETE FROM OPENHOUSE WHERE CID='$cid' AND CLI='$grid'";
		$quDelOpenhouse = mysqli_query($GLOBALS['dbh'], $quStrDelOpenhouse);

		$page = "sel";
		$disData = "ads";
		$title = "Selected";
		$msg = "Ad $cid deleted by ".$_SESSION["handle"].".";
	
	}else {
		$page = "delete";
		$title = "Delete Ad Confirmation";
		$disData = "ad";
		$msg = "<FONT COLOR=red>Ad not deleted,  you must type 'yes' to confirm.</FONT>";
		$msg_error = true;
	}


	//sort out where to go//
	if (isset($adlEditNav)) {
		if ($adlEditNav=="managePics") {
			$disData = "pics";
			$page = $adlEditNav;
		}elseif ($adlEditNav=="manageListingDeals") {
			$disData = "listingdeals";
			$disData2 = "listing";
			$page = $adlEditNav;
		}elseif ($adlEditNav=="printOuts") {
			$page = $adlEditNav;
		}elseif ($adlEditNav=="listings") {
			$disData = "listings";
			$page = "listings";
		}elseif ($adlEditNav=="sel") {
			$disData = "ads";
			$page = "sel";
		}
	}else {
		if ($return_page == "adlEdit") {
			$return_page = "home";
		}
		$return_page_go = true;
	}

//* end nav

}else {
	$page = "home";
	$msg = "You are not authorized to make deletes.";
}
//END deleteDo //
?>
	