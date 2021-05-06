<?php
//END changepriceDo //
	$postedCount = count($_POST);
	$now = date ("Ymd");

	
	if ($_POST['cid']) {




		$UPDATESTR = "UPDATE CLASS SET `MOD`='$now', MODBY='$handle', PRICE='$price' WHERE CID=" . $_POST['cid'] . " AND CLI=$grid";



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
