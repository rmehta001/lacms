<?php



function check_date($avail)

{

	$now=date(Ymd);

	$date_avail=str_replace("-", "", $avail);

	if ($date_avail=='00000000')

	{ $check="Date not listed."; }

	elseif($now>=$date_avail)

	{ $check="NOW"; }

	else

	{ $check=$avail; }

	return "$check";

}

function get_thumb_AHR ($thisRowGetAds)

{

	$quStrGetPics = "SELECT * FROM PICTURE WHERE CID=$thisRowGetAds->CID ORDER BY PID LIMIT 1";

	$quGetPics = mysqli_query($GLOBALS['dbh'],$quStrGetPics);

	if($rowGetPics = mysqli_fetch_object($quGetPics))

	{	$rowGetPics="<a href=\"http://www.bostonapartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$thisRowGetAds->CID\"><img border=0 src='http://www.bostonapartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT' width='125' alt='$rowGetPics->DESCRIPT'></a><br>"; }

	return $rowGetPics;

}



function format_ad_client ($thisRowGetAds, $thisDEFINED_VALUE_SETS, $usig) {

	$nowYYYYMMDD = date ("Ymd");

	$adDateIn = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->DATEIN)));

	$adDateMod = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->MOD)));

	if (!$thisRowGetAds->TRANSIN) {

		$isNewLog = (($adDateIn < 2) || ($adDateMod < 2)) ? 1 : 0;

	}

	$isNew = ($isNewLog) ? "<img src='http://www.bostonapartments.com/images/newIcon.gif'>" : "";

	$hasPics = ($thisRowGetAds->PIC) ? "<a href=\"http://www.bostonapartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$thisRowGetAds->CID\"><img border='0' width='22' height='12' src='http://www.bostonapartments.com/images/pic.gif'></a>" : "";

	$morePics = ($thisRowGetAds->PIC) ? "<a href=\"http://www.bostonapartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$thisRowGetAds->CID\">more details</a>" : "";

	if ($thisRowGetAds->PIC!=0)

	{	$thumb=get_thumb_AHR($thisRowGetAds); 	}

	else

	{	$thumb="<FONT SIZE=-2>No Photo Available</FONT>";	}

	$hasExternalPics = ($thisRowGetAds->EXTERNALPIC) ? $thisRowGetAds->EXTERNALPIC : "";

	$hasVirtualTour = ($thisRowGetAds->VIRT_TOUR) ? "<a href=\"$thisRowGetAds->VIRT_TOUR\"><img border='0' width='59' height='11' src='http://www.bostonapartments.com/images/virtualtour.gif'></a>" : "";



	$hasYouTubeURL = ($thisRowGetAds->YOUTUBEURL) ? "<a href=\"$thisRowGetAds->YOUTUBEURL\" target=\"blank\"><img src='http://www.bostonapartments.com/images/youtube.gif' border=\"0\"></a>" : "";

	if ($thisRowGetAds->NOFEE==3 || $thisRowGetAds->NOFEE==8) {

		$noFee = "";

	}else {

		$noFee = ($thisRowGetAds->NOFEE) ? "<font color='red'><b>" . $thisDEFINED_VALUE_SETS['NOFEE'][$thisRowGetAds->NOFEE] . "</b></font> - " : "";

	}

	$signature = ($thisRowGetAds->ALTSIG) ? "$thisRowGetAds->ALTSIG" : "$thisRowGetAds->SIG";

	$avail = ($thisRowGetAds->AVAIL !== "0000-00-00") ? " Available: $thisRowGetAds->AVAIL " : "";

	if ($thisRowGetAds->AVAIL == "0000-00-00") {

		$avail = "";	

	}else {

		

		$today = date ("Ymd");

		$avail_all = str_replace ("-", "", $thisRowGetAds->AVAIL);

		if (($today - $avail_all) >= 0) {

			$avail = " Available: Now. ";

		}else {

			$avail_year = substr ($thisRowGetAds->AVAIL, 2,2);

			$avail_month = substr ($thisRowGetAds->AVAIL, 5,2);

			$avail_day = substr ($thisRowGetAds->AVAIL, 8,2);

			$avail = " Available: $avail_month/$avail_day/$avail_year. ";

		}

	}

	

		

	$rooms = ($thisRowGetAds->ROOMS) ? $thisDEFINED_VALUE_SETS['ROOMS'][$thisRowGetAds->ROOMS] . " - " : "";

	$baths = ($thisRowGetAds->BATH) ? $thisDEFINED_VALUE_SETS['BATH'][$thisRowGetAds->BATH] . " - " : "";

	

	

	if ($thisRowGetAds->AUTO_WRITE) {

		$features_array['FEATURES_DELEADED']		= $thisRowGetAds->FEATURES_DELEADED          ;

		$features_array['FEATURES_FURNISHED']           = $thisRowGetAds->FEATURES_FURNISHED         ;

		$features_array['FEATURES_NON_SMOKING']         = $thisRowGetAds->FEATURES_NON_SMOKING       ;

		$features_array['FEATURES_ALARM']               = $thisRowGetAds->FEATURES_ALARM             ;

		$features_array['FEATURES_HEAT']                = $thisRowGetAds->FEATURES_HEAT              ;

		$features_array['FEATURES_HOT_WATER']           = $thisRowGetAds->FEATURES_HOT_WATER         ;

		$features_array['FEATURES_HT_AND_HW']           = $thisRowGetAds->FEATURES_HT_AND_HW         ;

		$features_array['FEATURES_ALL_UTILITIES']       = $thisRowGetAds->FEATURES_ALL_UTILITIES     ;

		$features_array['FEATURES_GAS_HEAT']            = $thisRowGetAds->FEATURES_GAS_HEAT          ;

		$features_array['FEATURES_OIL_HEAT']            = $thisRowGetAds->FEATURES_OIL_HEAT          ;

		$features_array['FEATURES_ELEC_HEAT']           = $thisRowGetAds->FEATURES_ELEC_HEAT         ;

		$features_array['FEATURES_HWFI']                = $thisRowGetAds->FEATURES_HWFI              ;

		$features_array['FEATURES_FIREPLACE_WORKING']   = $thisRowGetAds->FEATURES_FIREPLACE_WORKING ;

		$features_array['FEATURES_FIREPLACE_DECOR']     = $thisRowGetAds->FEATURES_FIREPLACE_DECOR   ;

		$features_array['FEATURES_CARPET']              = $thisRowGetAds->FEATURES_CARPET            ;

		$features_array['FEATURES_MODERN_KITCHEN']      = $thisRowGetAds->FEATURES_MODERN_KITCHEN    ;

		$features_array['FEATURES_KITCHENETTE']         = $thisRowGetAds->FEATURES_KITCHENETTE       ;

		$features_array['FEATURES_EAT_IN_KITCHEN']      = $thisRowGetAds->FEATURES_EAT_IN_KITCHEN    ;

		$features_array['FEATURES_GAS_RANGE']           = $thisRowGetAds->FEATURES_GAS_RANGE         ;

		$features_array['FEATURES_ELEC_RANGE']          = $thisRowGetAds->FEATURES_ELEC_RANGE        ;

		$features_array['FEATURES_DISPOSAL']            = $thisRowGetAds->FEATURES_DISPOSAL          ;

		$features_array['FEATURES_DISHWASHER']          = $thisRowGetAds->FEATURES_DISHWASHER        ;

		$features_array['FEATURES_SKYLIGHT']            = $thisRowGetAds->FEATURES_SKYLIGHT          ;

		$features_array['FEATURES_PORCH']               = $thisRowGetAds->FEATURES_PORCH             ;

		$features_array['FEATURES_BALCONY']             = $thisRowGetAds->FEATURES_BALCONY           ;

		$features_array['FEATURES_PATIO']               = $thisRowGetAds->FEATURES_PATIO             ;

		$features_array['FEATURES_CENTRAL_AC']          = $thisRowGetAds->FEATURES_CENTRAL_AC        ;

		$features_array['FEATURES_AC']                  = $thisRowGetAds->FEATURES_AC                ;

		$features_array['FEATURES_DECK']                = $thisRowGetAds->FEATURES_DECK              ;

		$features_array['FEATURES_MODERN_BATH']         = $thisRowGetAds->FEATURES_MODERN_BATH       ;

		$features_array['FEATURES_WHIRLPOOL']           = $thisRowGetAds->FEATURES_WHIRLPOOL         ;

		$features_array['FEATURES_DINNING_ROOM']        = $thisRowGetAds->FEATURES_DINNING_ROOM      ;

		$features_array['FEATURES_WALK_IN_CLOSET']      = $thisRowGetAds->FEATURES_WALK_IN_CLOSET    ;

		$features_array['AMENITIES_HIGH_CEILINGS']      = $thisRowGetAds->AMENITIES_HIGH_CEILINGS    ;

		$features_array['FEATURES_ENCLOSED_PORCH']      = $thisRowGetAds->FEATURES_ENCLOSED_PORCH    ;

		$features_array['FEATURES_MICROWAVE']           = $thisRowGetAds->FEATURES_MICROWAVE         ;

		$features_array['FEATURES_PANTRY']              = $thisRowGetAds->FEATURES_PANTRY            ;

		$features_array['FEATURES_INTERNET'] = $thisRowGetAds->FEATURES_INTERNET        ;

		$features_array['FEATURES_DUPLEX']              = $thisRowGetAds->FEATURES_DUPLEX            ;

		

		foreach ($features_array as $name => $value) {

			if ($value) {

				$feature_string .= $thisDEFINED_VALUE_SETS[$name][$value];

				$feature_string .= " - ";

			}

		}

		if ($feature_string) {

			$feature_string = "<br> <strong>Features:</strong> " . $feature_string."<br>";

		}

		

				

		$amenities_array['AMENITIES_CONCIEARGE']         = $thisRowGetAds->AMENITIES_CONCIEARGE       ;

		$amenities_array['AMENITIES_ELEVATOR']           = $thisRowGetAds->AMENITIES_ELEVATOR         ;

		$amenities_array['AMENITIES_DECK']               = $thisRowGetAds->AMENITIES_DECK             ;

		$amenities_array['AMENITIES_ROOF_DECK']          = $thisRowGetAds->AMENITIES_ROOF_DECK        ;

		$amenities_array['AMENITIES_GARDEN']             = $thisRowGetAds->AMENITIES_GARDEN           ;

		$amenities_array['AMENITIES_YARD']               = $thisRowGetAds->AMENITIES_YARD             ;

		$amenities_array['AMENITIES_SECURITY']           = $thisRowGetAds->AMENITIES_SECURITY         ;

		$amenities_array['AMENITIES_HEALTH_CLUB']        = $thisRowGetAds->AMENITIES_HEALTH_CLUB      ;

		$amenities_array['AMENITIES_POOL']               = $thisRowGetAds->AMENITIES_POOL             ;

		$amenities_array['AMENITIES_TENNIS']             = $thisRowGetAds->AMENITIES_TENNIS           ;

		$amenities_array['AMENITIES_LOUNGE']             = $thisRowGetAds->AMENITIES_LOUNGE           ;

		$amenities_array['AMENITIES_SAUNA']              = $thisRowGetAds->AMENITIES_SAUNA            ;

		$amenities_array['AMENITIES_BALCONY']            = $thisRowGetAds->AMENITIES_BALCONY          ;

		$amenities_array['AMENITIES_DECK2']              = $thisRowGetAds->AMENITIES_DECK2            ;

		$amenities_array['AMENITIES_ELEVATOR_BUILDING']  = $thisRowGetAds->AMENITIES_ELEVATOR_BUILDING;

		$amenities_array['AMENITIES_ATTIC']              = $thisRowGetAds->AMENITIES_ATTIC            ;

		$amenities_array['AMENITIES_BASEMENT']           = $thisRowGetAds->AMENITIES_BASEMENT         ;

		$amenities_array['AMENITIES_BIN']                = $thisRowGetAds->AMENITIES_BIN              ;

		$amenities_array['AMENITIES_SUPERINTENDANT']     = $thisRowGetAds->AMENITIES_SUPERINTENDANT   ;

		$amenities_array['AMENITIES_ON_SITE_MANAGEMENT'] = $thisRowGetAds->AMENITIES_ON_SITE_MANAGEMENT   ;

		

		

		foreach ($amenities_array as $name => $value) {

			if ($value) {

				$amenity_string .= $thisDEFINED_VALUE_SETS[$name][$value];

				$amenity_string .= " - ";

			}

		}

		

		if ($amenity_string) {

			$amenity_string = "<br> <strong>Amenities:</strong> " . $amenity_string;

		}

	}

		

		

		

	//MAP MAKER//

	if ($thisRowGetAds->MAP) {

		$map_link = make_map($thisRowGetAds);

	}



//	$rooms_formated=preg_replace('/BEDROOM/', ' ', $rooms);

//	$rooms_formated=preg_replace('/-/',' ',$rooms_formated);

	

	$priceFormat = number_format ($thisRowGetAds->PRICE);

	$price =  ($thisRowGetAds->PRICE) ? " \$$priceFormat " : ""; 

	$price_sqft = ($thisRowGetAds->PRICE_SQFT) ? " $" .(number_format($thisRowGetAds->PRICE_SQFT)) . "/sqft ": "";

	if($usig=="yes") {

		$user_sig = ($thisRowGetAds->USE_USER_SIG) ? " $thisRowGetAds->USER_SIG " : "";

	}

	$fdate=check_date($thisRowGetAds->AVAIL);

	$refNum = "$thisRowGetAds->ABV-$thisRowGetAds->CID";

	$adString="<tr valign=top><td valign=middle align=center>$thumb&nbsp;<font size=1>$morePics</td><td><font size=2>$thisRowGetAds->LOCNAME - $noFee $rooms $baths $thisRowGetAds->BODY $amenity_string $feature_string $hasExternalPics $hasVirtualTour $hasYouTubeURL $isNew #$thisRowGetAds->CID&nbsp;&nbsp;$signature $user_sig</td><td><font size=2>$fdate</td><td><font size=2>$price&nbsp;</td></tr>";

	return $adString;

}

?>

