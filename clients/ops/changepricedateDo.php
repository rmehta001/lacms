<?php
//END changepriceDo //
	$postedCount = count($_POST);
	$now = date ("Ymd");
		$nowMon = date (m);
		$nowDay = date (d);
		$nowYear = date (Y);

	$bbbMonth = $_POST['bbbMonth'];
	$bbbDay   = $_POST['bbbDay'];
	$bbbYear  = $_POST['bbbYear'];
	if ($bbbMonth !== "--" && $bbbDay !== "--" && $bbbYear !== "--") {
		$avail = $bbbYear.$bbbMonth.$bbbDay;
	} else {
		$avail = 0;
	}


	$bbbLEMonth = $_POST['bbbLEMonth'];
	$bbbLEDay   = $_POST['bbbLEDay'];
	$bbbLEYear  = $_POST['bbbLEYear'];
	if ($bbbLEMonth !== "--" && $bbbLEDay !== "--" && $bbbLEYear !== "--") {
		$lease_expire = $bbbLEYear.$bbbLEMonth.$bbbLEDay;
	} else {
		$lease_expire = 0;
	}



	
	if ($_POST['cid']) {


		$UPDATESTR = "UPDATE CLASS SET `MOD`='$now', MODBY='$handle', PRICE='$price', AVAIL='$avail', LEASE_EXPIRE='$lease_expire' WHERE CID=" . $_POST['cid'] . " AND CLI=$grid";



	$quUpdateClass = mysqli_query($dbh, $UPDATESTR);


	//AUTO UPDATE LANDLORD
	if ($pref_auto_update_landlord=="1") {
		if ($_POST['LANDLORD']) {
			$lid = $_POST['LANDLORD'];
			$now_now = date ("Ymd");
			$quStrUpdateLandlord = "UPDATE LANDLORD SET LAST_CONTACTED='$now_now' WHERE LID='$lid' AND GRID='$grid'";
			$quUpdateLandlord = mysqli_query($dbh, $quStrUpdateLandlord) or die (mysqli_error($dbh));
		}
	}




			}


	
	
	//sort out where to go//
	if ($adlEditNav) {
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
			$msg = "Ad $cid modified by $handle on $nowMon-$nowDay-$nowYear.";
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
	
//END changepriceDo //
?>
