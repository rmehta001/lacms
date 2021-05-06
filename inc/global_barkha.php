<?php


function format_deal ($recordset) {
	if ($recordset->DID) {
		$string .= "Dealsheet # $recordset->DID for Listing # $recordset->CID";
		return $string;
	}else {
		return "";
	}
}

function format_client ($recordset) {
	if ($recordset->CLID) {
		$string .= "$recordset->NAME_FIRST $recordset->NAME_LAST";
		return $string;
	}else {
		return "";
	}
}

function display_landlord ($recordset) {
	if ($recordset->LID) {


if ($recordset->LAST_CONTACT_ACTION == "1") { $LCA="- Contact/Updated" ;}
if ($recordset->LAST_CONTACT_ACTION == "2") { $LCA="- Left Message" ;}
if ($recordset->LAST_CONTACT_ACTION == "3") { $LCA="- No Answer" ;}
if ($recordset->LAST_CONTACT_ACTION == "4") { $LCA="- Call later" ;}
if ($recordset->LAST_CONTACT_ACTION == "5") { $LCA="- Emailed" ;}
if ($recordset->LAST_CONTACT_ACTION == "6") { $LCA="- Landlord Feed" ;}
if ($recordset->LAST_CONTACT_ACTION == "7") { $LCA="- Don't Contact" ;}
if ($recordset->LAST_CONTACT_ACTION == "8") { $LCA="- Other" ;}

		$emailString = ($recordset->LL_EMAIL) ? "<a href=\"mailto:$recordset->LL_EMAIL\">$recordset->LL_EMAIL</a><br>" : "";

		
		$string .= "<a href=$PHP_SELF?op=editLandlord&lid=$recordset->LID>$recordset->HOME_NAME_FIRST $recordset->HOME_NAME_LAST, $recordset->OFF_NAME</A>";
		if ($recordset->EXCLUSIVE == "1" ) {
		$string .= " <B><FONT COLOR=red>Exclusive Landlord</FONT></B>";
		}
		
		
		$string .= "<BR>".$emailString;

if ($recordset->MOBILE_PHONE) {
		$string .= "Mobile Phone: $recordset->MOBILE_PHONE <br>";
		}

if (($recordset->OFF_PHONE) OR ($recordset->OFF_FAX !="")) {
		$string .= "Office Phone: $recordset->OFF_PHONE    Fax: $recordset->OFF_FAX<br>";
		}

if (($recordset->HOME_PHONE) OR ($recordset->HOME_FAX !="")) {
		$string .= "Home Phone: $recordset->HOME_PHONE  Fax: $recordset->HOME_FAX <br>";
}

if (($recordset->HOME_SPOUSE_FIRST !="") OR ($recordset->HOME_SPOUSE_LAST !="")) {
		$string .= "Spouse:  $recordset->HOME_SPOUSE_FIRST $recordset->HOME_SPOUSE_LAST<br>";
}

if (($recordset->SPOUSE_CELL !="") OR ($recordset->SPOUSE_OFFICE !="")) {
		$string .= "Spouse Cell: $recordset->SPOUSE_CELL Spouse Office: $recordset->SPOUSE_OFFICE<br>";
}

if ($recordset->SPOUSE_EMAIL !="") {
		$string .= "Spouse Email: <A HREF=\"mailto:$recordset->SPOUSE_EMAIL\">$recordset->SPOUSE_EMAIL</A><br>";
}


if (($recordset->SUPER_NAME) OR ($recordset->SUPER_PHONE !="")) {
		$string .= "Super: $recordset->SUPER_NAME";
		$string .= " - $recordset->SUPER_PHONE<BR>";
			}

$string .= "Last LL: $recordset->LAST_CONTACTED Next LL: $recordset->NEXT_CONTACT $LCA<BR>";

if ($recordset->OFF_WEBSITE !="") {
		$string .= "<A HREF=\"$recordset->OFF_WEBLISTINGS\" target=\"_NEW\">Web Listings</A>";
}

if ($recordset->OFF_WEBSITE !="" AND $recordset->OFF_WEBLISTINGS !="") {
		$string .= " | "; }

if ($recordset->OFF_WEBLISTINGS !="") { 
		$string .= "<A HREF=\"$recordset->OFF_WEBSITE\" target=\"_NEW\">Website</A>"; }

if ($recordset->OFF_WEBSITE !="" OR $recordset->OFF_WEBLISTINGS !="") {
		$string .= " | "; }

$string .= "<A HREF=\"$PHP_SELF?op=addendums&lid=$recordset->LID\" target=\"_newaddenda\">Additional Addenda & Docs</a><BR>";


		return $string;
	}else {
		return "";
	}
}


function array_to_string ($array, $char) {
	if (is_array($array)) {
		for ($i=0;$i<=count($array);$i++) {
			$string .= $array[$i];
			if ($i < (count($array) - 1)) {
				$string .= $char;
			}
		}
		}else {
			$string = "";
		}
	return $string;
}

function string_to_array ($string, $char) {
	if ($string) {
		$array = split($char, $string);
	}else {
		$array = array();
	}
	return $array;
}



function format_pick_list ($values_string) {
	$values = split (",",$values_string);
	foreach($values as $key => $value) {
		$values2[$key] = split("_",$value);
	}
	return $values2;
}

function format_ad ($thisRowGetAds, $thisDEFINED_VALUE_SETS) {
	$nowYYYYMMDD = date ("Ymd");
	$adDateIn = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->DATEIN)));
	$adDateMod = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->MOD)));
	if (!$thisRowGetAds->TRANSIN) {
		$isNewLog = (($adDateIn < 2) || ($adDateMod < 2)) ? 1 : 0;
	}
	$isNew = ($isNewLog) ? "<img src='https://www.BostonApartments.com/images/newIcon.gif'>" : "";
	$hasPics = ($thisRowGetAds->PIC) ? "<a href=\"https://www.BostonApartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$thisRowGetAds->CID\" target=\"blank\"><img border='0' width='22' height='12' src='https://www.BostonApartments.com/images/pic.gif'></a>" : "";

	$hasExternalPics = ($thisRowGetAds->EXTERNALPIC) ? "<A HREF=\"https://www.BostonApartments.com/homepage-MLS.php?cli=1075&ad=$thisRowGetAds->CID\"><img border='0' width='22' height='12' src='https://www.BostonApartments.com/images/pic.gif'></a>" : "";


	$hasVirtualTour = ($thisRowGetAds->VIRT_TOUR) ? "<a href=\"$thisRowGetAds->VIRT_TOUR\" target=\"blank\"><img border='0' width='59' height='11' src='https://www.BostonApartments.com/images/virtualtour.gif'></a>" : "";


	$hasYouTubeURL = ($thisRowGetAds->YOUTUBEURL) ? "<a href=\"$thisRowGetAds->YOUTUBEURL\" target=\"blank\"><img src='https://www.BostonApartments.com/images/youtube.gif' border=\"0\"></a>" : "";
	if ($thisRowGetAds->NOFEE==3 || $thisRowGetAds->NOFEE==8 || $thisRowGetAds->NOFEE==9) {
		$noFee = "";
	}else {
		$noFee = ($thisRowGetAds->NOFEE) ? "<font color='red'><b>" . $thisDEFINED_VALUE_SETS['NOFEE'][$thisRowGetAds->NOFEE] . "</b></font> - " : "";
	}


	if ($thisRowGetAds->STATUS_SALE==0) {
		$status_sale = "";
	}else {
		$status_sale = ($thisRowGetAds->STATUS_SALE) ? "<font color='red'><b>" . $thisDEFINED_VALUE_SETS['STATUS_SALE'][$thisRowGetAds->STATUS_SALE] . "</b></font> - " : "";
	}

if ($thisRowGetAds->ASSESSMENT !="0.00"){
$assessment =  ($thisRowGetAds->ASSESSMENT) ? "<B>Assessed Value:</B> \$".$thisRowGetAds->ASSESSMENT : "";} else {$assessment = "";}

if ($thisRowGetAds->PROPERTYTAX !="0.00"){
$propertytax =  ($thisRowGetAds->PROPERTYTAX) ? "<B>Property Tax:</B> \$".$thisRowGetAds->PROPERTYTAX : "";} else {$propertytax = "";}

if ($thisRowGetAds->CONDO_FEES !="0.00"){
$condofee =  ($thisRowGetAds->CONDO_FEES) ? "<B>Condo Fee:</B> \$".$thisRowGetAds->CONDO_FEES : "";} else {$condofee = "";}

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
	
	
	
		
	$rooms = ($thisRowGetAds->ROOMS !="0.00") ? $thisDEFINED_VALUE_SETS['ROOMS'][$thisRowGetAds->ROOMS] . " - " : "";
	$baths = ($thisRowGetAds->BATH !="0.00") ? $thisDEFINED_VALUE_SETS['BATH'][$thisRowGetAds->BATH] . " - " : "";


	$pets = ($thisRowGetAds->PETSA !="0.00") ? $thisDEFINED_VALUE_SETS['PETSA'][$thisRowGetAds->PETSA] . " - " : "";

	$parkingnum = ($thisRowGetAds->PARKING_NUM) ? $thisDEFINED_VALUE_SETS['PARKING_NUM'][$thisRowGetAds->PARKING_NUM] . " parking " : "";

	$parkingtype = ($thisRowGetAds->PARKING_TYPE) ? $thisDEFINED_VALUE_SETS['PARKING_TYPE'][$thisRowGetAds->PARKING_TYPE] . " " : "";


	$parkingcost = ($thisRowGetAds->PARKING_COST) ? $thisDEFINED_VALUE_SETS['PARKING_COST'][$thisRowGetAds->PARKING_COST] . "\$$thisRowGetAds->PARKING_COST." : "";



	$laundry = ($thisRowGetAds->LAUNDRY_ROOM) ? $thisDEFINED_VALUE_SETS['LAUNDRY_ROOM'][$thisRowGetAds->LAUNDRY_ROOM] . " - " : "";




	if ($thisRowGetAds->AUTO_WRITE) {
		$features_array['FEATURES_DELEADED']		= $thisRowGetAds->FEATURES_DELEADED          ;
		$features_array['FEATURES_FURNISHED']           = $thisRowGetAds->FEATURES_FURNISHED         ;
		$features_array['FEATURES_NON_SMOKING']         = $thisRowGetAds->FEATURES_NON_SMOKING       ;
		$features_array['FEATURES_ALARM']               = $thisRowGetAds->FEATURES_ALARM             ;
		$features_array['FEATURES_HEAT']                = $thisRowGetAds->FEATURES_HEAT              ;
		$features_array['FEATURES_HOT_WATER']           = $thisRowGetAds->FEATURES_HOT_WATER         ;
		$features_array['FEATURES_HT_AND_HW']           = $thisRowGetAds->FEATURES_HT_AND_HW         ;
		$features_array['FEATURES_ALL_UTILITIES']       = $thisRowGetAds->FEATURES_ALL_UTILITIES     ;
		$features_array['FEATURES_ELECTRICITY']       = $thisRowGetAds->FEATURES_ELECTRICITY     ;
		$features_array['FEATURES_GAS_HEAT']            = $thisRowGetAds->FEATURES_GAS_HEAT          ;
		$features_array['FEATURES_OIL_HEAT']            = $thisRowGetAds->FEATURES_OIL_HEAT          ;
		$features_array['FEATURES_ELEC_HEAT']           = $thisRowGetAds->FEATURES_ELEC_HEAT         ;
		$features_array['FEATURES_HWFI']                = $thisRowGetAds->FEATURES_HWFI              ;
		$features_array['FEATURES_FIREPLACE_WORKING']   = $thisRowGetAds->FEATURES_FIREPLACE_WORKING ;
		$features_array['FEATURES_FIREPLACE_DECOR']     = $thisRowGetAds->FEATURES_FIREPLACE_DECOR   ;
		$features_array['FEATURES_CARPET']              = $thisRowGetAds->FEATURES_CARPET            ;
		$features_array['FEATURES_MODERN_KITCHEN']      = $thisRowGetAds->FEATURES_MODERN_KITCHEN    ;
		$features_array['FEATURES_KITCHEN_GALLEY']      = $thisRowGetAds->FEATURES_KITCHEN_GALLEY    ;
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
		$features_array['FEATURES_CABLETV']              = $thisRowGetAds->FEATURES_CABLETV            ;
		$features_array['FEATURES_STAINLESS']              = $thisRowGetAds->FEATURES_STAINLESS            ;
		$features_array['FEATURES_GRANITEC']              = $thisRowGetAds->FEATURES_GRANITEC            ;
		$features_array['FEATURES_BAYWINDOWS']              = $thisRowGetAds->FEATURES_BAYWINDOWS            ;
		$features_array['FEATURES_INTERCOM']              = $thisRowGetAds->FEATURES_INTERCOM            ;
		$features_array['FEATURES_CEILINGFAN']              = $thisRowGetAds->FEATURES_CEILINGFAN            ;


		foreach ($features_array as $name => $value) {
			if ($value) {
				$feature_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$feature_string .= " - ";
			}
		}
		if ($feature_string) {
			$feature_string = " <strong>Features:</strong> " . $feature_string;
		}
		
				
		$amenities_array['AMENITIES_CONCIEARGE']         = $thisRowGetAds->AMENITIES_CONCIEARGE       ;
		$amenities_array['AMENITIES_ELEVATOR']           = $thisRowGetAds->AMENITIES_ELEVATOR         ;
		$amenities_array['AMENITIES_DECK']               = $thisRowGetAds->AMENITIES_DECK             ;
		$amenities_array['AMENITIES_ROOF_DECK']          = $thisRowGetAds->AMENITIES_ROOF_DECK        ;
		$amenities_array['AMENITIES_GARDEN']             = $thisRowGetAds->AMENITIES_GARDEN           ;
		$amenities_array['AMENITIES_YARD']               = $thisRowGetAds->AMENITIES_YARD             ;
		$amenities_array['AMENITIES_SECURITY']           = $thisRowGetAds->AMENITIES_SECURITY         ;
		$amenities_array['AMENITIES_BUSINESSCENTER']        = $thisRowGetAds->AMENITIES_BUSINESSCENTER      ;
		$amenities_array['AMENITIES_CLUBHOUSE']        = $thisRowGetAds->AMENITIES_CLUBHOUSE      ;
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
		$amenities_array['AMENITIES_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_NOT_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_NOT_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_WHEELCHAIR'] = $thisRowGetAds->AMENITIES_WHEELCHAIR   ;
		$amenities_array['AMENITIES_SUBWAY']              = $thisRowGetAds->AMENITIES_SUBWAY            ;
		$amenities_array['AMENITIES_CRAIL']              = $thisRowGetAds->AMENITIES_CRAIL            ;
		$amenities_array['AMENITIES_BUS']              = $thisRowGetAds->AMENITIES_BUS            ;
		$amenities_array['AMENITIES_SHUTTLE']              = $thisRowGetAds->AMENITIES_SHUTTLE            ;		
		$amenities_array['AMENITIES_BIKEROOM']         = $thisRowGetAds->AMENITIES_BIKEROOM       ;
		$amenities_array['AMENITIES_PLAYGROUND']         = $thisRowGetAds->AMENITIES_PLAYGROUND       ;
		$amenities_array['AMENITIES_BASKETBALL']         = $thisRowGetAds->AMENITIES_BASKETBALL       ;
		$amenities_array['AMENITIES_BBQ']         = $thisRowGetAds->AMENITIES_BBQ       ;
		$amenities_array['AMENITIES_ZIPCAR']         = $thisRowGetAds->AMENITIES_ZIPCAR       ;


		
		foreach ($amenities_array as $name => $value) {
			if ($value) {
				$amenity_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$amenity_string .= " - ";
			}
		}
		
		if ($amenity_string) {
			$amenity_string = " <strong>Amenities:</strong> " . $amenity_string;
		}
	}
		
		
		
	//MAP MAKER//

	if (($thisRowGetAds->MAP) AND ($thisRowGetAds->CLI != 1075)) {
		$map_link = make_map_email($thisRowGetAds);
	} else { $map_link = ""; }



        if($thisRowGetAds->AGENCY_HEADERS)
        {
                $strAgency="SELECT * FROM AGENCIES WHERE AGENCY_ID=$thisRowGetAds->AGENCY_HEADERS";
                $quAgency = mysqli_query($dbh, $strAgency);
                if($rowAgency=mysqli_fetch_object($quAgency))
                {
                        $agency_sig=$rowAgency->CUSTOM_SIGNATURE;
			$signature=$agency_sig;
                }
        }
		
	$priceFormat = number_format ($thisRowGetAds->PRICE);
	$price =  ($thisRowGetAds->PRICE) ? " \$$priceFormat " : ""; 
	$price_sqft = ($thisRowGetAds->PRICE_SQFT) ? " $" .(number_format($thisRowGetAds->PRICE_SQFT)) . "/sqft ": "";
	$user_sig = ($thisRowGetAds->USE_USER_SIG) ? "<BR>$thisRowGetAds->USER_SIG<BR> " : "";
	$refNum = "$thisRowGetAds->ABV-$thisRowGetAds->CID";
	$adString =  "<HR>\n$thisRowGetAds->LOCNAME - $noFee$status_sale $rooms$baths$thisRowGetAds->BODY $feature_string $amenity_string$laundry $pets $parkingnum$parkingtype $parkingcost  $avail $condofee $assessment $propertytax $price$price_sqft$user_sig $refNum$hasPics
$hasExternalPics $hasVirtualTour $hasYouTubeURL $map_link $isNew<BR>\n$signature<!-- CID $thisRowGetAds->CID --></b></b><BR>\n\n";
	return $adString;
}





function format_ad_homepage ($thisRowGetAds, $thisDEFINED_VALUE_SETS) {
	$nowYYYYMMDD = date ("Ymd");
	$adDateIn = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->DATEIN)));
	$adDateMod = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->MOD)));
	if (!$thisRowGetAds->TRANSIN) {
		$isNewLog = (($adDateIn < 2) || ($adDateMod < 2)) ? 1 : 0;
	}
	$isNew = ($isNewLog) ? "<img src='https://www.BostonApartments.com/images/newIcon.gif'>" : "";

	$hasExternalPics = ($thisRowGetAds->EXTERNALPIC) ? "<A HREF=\"https://www.BostonApartments.com/homepage-MLS.php?cli=1075&ad=$thisRowGetAds->CID\"><img border='0' width='22' height='12' src='https://www.BostonApartments.com/images/pic.gif'></a>" : "";

	$hasVirtualTour = ($thisRowGetAds->VIRT_TOUR) ? "<a href=\"$thisRowGetAds->VIRT_TOUR\" target=\"blank\"><img border='0' width='59' height='11' src='https://www.BostonApartments.com/images/virtualtour.gif'></a>" : "";


	$hasYouTubeURL = ($thisRowGetAds->YOUTUBEURL) ? "<a href=\"$thisRowGetAds->YOUTUBEURL\" target=\"blank\"><img src='https://www.BostonApartments.com/images/youtube.gif' border=\"0\"></a>" : "";
	if ($thisRowGetAds->NOFEE==3 || $thisRowGetAds->NOFEE==8 || $thisRowGetAds->NOFEE==9) {
		$noFee = "";
	}else {
		$noFee = ($thisRowGetAds->NOFEE) ? "<font color='red'><b>" . $thisDEFINED_VALUE_SETS['NOFEE'][$thisRowGetAds->NOFEE] . "</b></font> " : "";
	}


	if ($thisRowGetAds->STATUS_SALE==0) {
		$status_sale = "";
	}else {
		$status_sale = ($thisRowGetAds->STATUS_SALE) ? "<font color='red'><b>" . $thisDEFINED_VALUE_SETS['STATUS_SALE'][$thisRowGetAds->STATUS_SALE] . "</b></font> - " : "";
	}


	$signature = ($thisRowGetAds->ALTSIG) ? "$thisRowGetAds->ALTSIG" : "$thisRowGetAds->SIG";
	$avail = ($thisRowGetAds->AVAIL !== "0000-00-00") ? " Available: $thisRowGetAds->AVAIL " : "";
	if ($thisRowGetAds->AVAIL == "0000-00-00") {
		$avail = "";	
	}else {
		
		$today = date ("Ymd");
		$avail_all = str_replace ("-", "", $thisRowGetAds->AVAIL);
		if (($today - $avail_all) >= 0) {


if ($thisRowGetAds->PRICE !="0"){
$avail = " Available:<B> Now</B>. ";
} else {
$avail = "<BR>Available:<B> Now</B>. ";
}




}else {
			$avail_year = substr ($thisRowGetAds->AVAIL, 2,2);
			$avail_month = substr ($thisRowGetAds->AVAIL, 5,2);
			$avail_day = substr ($thisRowGetAds->AVAIL, 8,2);


if ($thisRowGetAds->PRICE !="0"){
$avail = " Available: <B> $avail_month/$avail_day/$avail_year</B>. ";
} else {
$avail = "<BR>Available: <B> $avail_month/$avail_day/$avail_year</B>. ";
}


		}
	}
	

	$rooms = ($thisRowGetAds->ROOMS !="0.00") ? $thisDEFINED_VALUE_SETS['ROOMS'][$thisRowGetAds->ROOMS] . " - " : "";
	$baths = ($thisRowGetAds->BATH !="0.00") ? $thisDEFINED_VALUE_SETS['BATH'][$thisRowGetAds->BATH] . " " : "";

	$pets = ($thisRowGetAds->PETSA !="0.00") ? $thisDEFINED_VALUE_SETS['PETSA'][$thisRowGetAds->PETSA] . " - " : "";

	$parkingnum = ($thisRowGetAds->PARKING_NUM) ? $thisDEFINED_VALUE_SETS['PARKING_NUM'][$thisRowGetAds->PARKING_NUM] . " parking " : "";

	$parkingtype = ($thisRowGetAds->PARKING_TYPE) ? $thisDEFINED_VALUE_SETS['PARKING_TYPE'][$thisRowGetAds->PARKING_TYPE] . " " : "";

	$parkingcost = ($thisRowGetAds->PARKING_COST) ? $thisDEFINED_VALUE_SETS['PARKING_COST'][$thisRowGetAds->PARKING_COST] . "\$$thisRowGetAds->PARKING_COST." : "";


	$laundry = ($thisRowGetAds->LAUNDRY_ROOM) ? $thisDEFINED_VALUE_SETS['LAUNDRY_ROOM'][$thisRowGetAds->LAUNDRY_ROOM] . " - " : "";

	$floor = ($thisRowGetAds->FLOOR) ? $thisDEFINED_VALUE_SETS['FLOOR'][$thisRowGetAds->FLOOR] . "Floor#: $thisRowGetAds->FLOOR" : "";


	if ($thisRowGetAds->AUTO_WRITE) {
		$features_array['FEATURES_DELEADED']		= $thisRowGetAds->FEATURES_DELEADED          ;
		$features_array['FEATURES_FURNISHED']           = $thisRowGetAds->FEATURES_FURNISHED         ;
		$features_array['FEATURES_NON_SMOKING']         = $thisRowGetAds->FEATURES_NON_SMOKING       ;
		$features_array['FEATURES_ALARM']               = $thisRowGetAds->FEATURES_ALARM             ;
		$features_array['FEATURES_HEAT']                = $thisRowGetAds->FEATURES_HEAT              ;
		$features_array['FEATURES_HOT_WATER']           = $thisRowGetAds->FEATURES_HOT_WATER         ;
		$features_array['FEATURES_HT_AND_HW']           = $thisRowGetAds->FEATURES_HT_AND_HW         ;
		$features_array['FEATURES_ALL_UTILITIES']       = $thisRowGetAds->FEATURES_ALL_UTILITIES     ;
		$features_array['FEATURES_ELECTRICITY']       = $thisRowGetAds->FEATURES_ELECTRICITY     ;
		$features_array['FEATURES_GAS_HEAT']            = $thisRowGetAds->FEATURES_GAS_HEAT          ;
		$features_array['FEATURES_OIL_HEAT']            = $thisRowGetAds->FEATURES_OIL_HEAT          ;
		$features_array['FEATURES_ELEC_HEAT']           = $thisRowGetAds->FEATURES_ELEC_HEAT         ;
		$features_array['FEATURES_HWFI']                = $thisRowGetAds->FEATURES_HWFI              ;
		$features_array['FEATURES_FIREPLACE_WORKING']   = $thisRowGetAds->FEATURES_FIREPLACE_WORKING ;
		$features_array['FEATURES_FIREPLACE_DECOR']     = $thisRowGetAds->FEATURES_FIREPLACE_DECOR   ;
		$features_array['FEATURES_CARPET']              = $thisRowGetAds->FEATURES_CARPET            ;
		$features_array['FEATURES_MODERN_KITCHEN']      = $thisRowGetAds->FEATURES_MODERN_KITCHEN    ;
		$features_array['FEATURES_KITCHEN_GALLEY']      = $thisRowGetAds->FEATURES_KITCHEN_GALLEY    ;
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
		$features_array['FEATURES_CABLETV']              = $thisRowGetAds->FEATURES_CABLETV            ;
		$features_array['FEATURES_STAINLESS']              = $thisRowGetAds->FEATURES_STAINLESS            ;
		$features_array['FEATURES_GRANITEC']              = $thisRowGetAds->FEATURES_GRANITEC            ;
		$features_array['FEATURES_BAYWINDOWS']              = $thisRowGetAds->FEATURES_BAYWINDOWS            ;
		$features_array['FEATURES_INTERCOM']              = $thisRowGetAds->FEATURES_INTERCOM            ;
		$features_array['FEATURES_CEILINGFAN']              = $thisRowGetAds->FEATURES_CEILINGFAN            ;


		foreach ($features_array as $name => $value) {
			if ($value) {
				$feature_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$feature_string .= " - ";
			}
		}
		if ($feature_string) {
			$feature_string = "<BR><strong>Features:<BR></strong> " . $feature_string."<BR>";
		}


		$amenities_array['AMENITIES_CONCIEARGE']         = $thisRowGetAds->AMENITIES_CONCIEARGE       ;
		$amenities_array['AMENITIES_ELEVATOR']           = $thisRowGetAds->AMENITIES_ELEVATOR         ;
		$amenities_array['AMENITIES_DECK']               = $thisRowGetAds->AMENITIES_DECK             ;
		$amenities_array['AMENITIES_ROOF_DECK']          = $thisRowGetAds->AMENITIES_ROOF_DECK        ;
		$amenities_array['AMENITIES_GARDEN']             = $thisRowGetAds->AMENITIES_GARDEN           ;
		$amenities_array['AMENITIES_YARD']               = $thisRowGetAds->AMENITIES_YARD             ;
		$amenities_array['AMENITIES_SECURITY']           = $thisRowGetAds->AMENITIES_SECURITY         ;
		$amenities_array['AMENITIES_BUSINESSCENTER']        = $thisRowGetAds->AMENITIES_BUSINESSCENTER      ;
		$amenities_array['AMENITIES_CLUBHOUSE']        = $thisRowGetAds->AMENITIES_CLUBHOUSE      ;
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
		$amenities_array['AMENITIES_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_NOT_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_NOT_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_WHEELCHAIR'] = $thisRowGetAds->AMENITIES_WHEELCHAIR   ;
		$amenities_array['AMENITIES_SUBWAY']              = $thisRowGetAds->AMENITIES_SUBWAY            ;
		$amenities_array['AMENITIES_CRAIL']              = $thisRowGetAds->AMENITIES_CRAIL            ;
		$amenities_array['AMENITIES_BUS']              = $thisRowGetAds->AMENITIES_BUS            ;
		$amenities_array['AMENITIES_SHUTTLE']              = $thisRowGetAds->AMENITIES_SHUTTLE            ;		
		$amenities_array['AMENITIES_BIKEROOM']         = $thisRowGetAds->AMENITIES_BIKEROOM       ;
		$amenities_array['AMENITIES_PLAYGROUND']         = $thisRowGetAds->AMENITIES_PLAYGROUND       ;
		$amenities_array['AMENITIES_BASKETBALL']         = $thisRowGetAds->AMENITIES_BASKETBALL       ;
		$amenities_array['AMENITIES_BBQ']         = $thisRowGetAds->AMENITIES_BBQ       ;
		$amenities_array['AMENITIES_ZIPCAR']         = $thisRowGetAds->AMENITIES_ZIPCAR       ;


		
		foreach ($amenities_array as $name => $value) {
			if ($value) {
				$amenity_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$amenity_string .= " - ";
			}
		}
		
		if ($amenity_string) {
			$amenity_string = " <strong>Amenities:<BR></strong> " . $amenity_string;
		}
	}
		
		
		
	//MAP MAKER//
	if ($thisRowGetAds->MAP) {
		$map_link = make_map($thisRowGetAds);
	}
	
        if($thisRowGetAds->AGENCY_HEADERS)
        {
                $strAgency="SELECT * FROM AGENCIES WHERE AGENCY_ID=$thisRowGetAds->AGENCY_HEADERS";
                $quAgency = mysqli_query($dbh, $strAgency);
                if($rowAgency=mysqli_fetch_object($quAgency))
                {
                        $agency_sig=$rowAgency->CUSTOM_SIGNATURE;
			$signature=$agency_sig;
                }
        }

if ($thisRowGetAds->ASSESSMENT !="0.00"){
$assessment =  ($thisRowGetAds->ASSESSMENT) ? "<BR><B>Assessed Value:</B> \$".$thisRowGetAds->ASSESSMENT : "";} else {$assessment = "";}

if ($thisRowGetAds->PROPERTYTAX !="0.00"){
$propertytax =  ($thisRowGetAds->PROPERTYTAX) ? "<BR><B>Property Tax:</B> \$".$thisRowGetAds->PROPERTYTAX : "";} else {$propertytax = "";}

if ($thisRowGetAds->CONDO_FEES !="0.00"){
$condofee =  ($thisRowGetAds->CONDO_FEES) ? "<BR><B>Condo Fee:</B> \$".$thisRowGetAds->CONDO_FEES : "";} else {$condofee = "";}

if ($thisRowGetAds->PRICE !="0"){
$priceprefix = "<BR>Price:<B> ";
$pricesuffix = "</B> ";
} else {
$priceprefix = "";
$pricesuffix = "";
}



if ($thisRowGetAds->TOTAL_NUM_ROOMS =="1"){
$totalrooms =  ($thisRowGetAds->TOTAL_NUM_ROOMS) ? " - ".$thisRowGetAds->TOTAL_NUM_ROOMS." Room " : "";
} elseif (($thisRowGetAds->TOTAL_NUM_ROOMS !="0") AND ($thisRowGetAds->TOTAL_NUM_ROOMS !="1")){
$totalrooms =  ($thisRowGetAds->TOTAL_NUM_ROOMS) ? " - ".$thisRowGetAds->TOTAL_NUM_ROOMS." Rooms" : "";} else {$totalrooms = "";}

if ($thisRowGetAds->SQFT !="0"){
$sqft =  ($thisRowGetAds->SQFT) ? " - ".$thisRowGetAds->SQFT." SqFt." : "";} else {$sqft = "";}




$buildingtype = ($thisRowGetAds->BUILDING_TYPE) ? $thisDEFINED_VALUE_SETS['BUILDING_TYPE'][$thisRowGetAds->BUILDING_TYPE] . " " : "";
$buildingstyle = ($thisRowGetAds->BUILDING_STYLE) ? $thisDEFINED_VALUE_SETS['BUILDING_STYLE'][$thisRowGetAds->BUILDING_STYLE] . " " : "";


	
	$priceFormat = number_format ($thisRowGetAds->PRICE);
	$price =  ($thisRowGetAds->PRICE) ? " \$$priceFormat " : ""; 
	$price_sqft = ($thisRowGetAds->PRICE_SQFT) ? " $" .(number_format($thisRowGetAds->PRICE_SQFT)) . "/sqft ": "";
	$user_sig = ($thisRowGetAds->USE_USER_SIG) ? " $thisRowGetAds->USER_SIG " : "";
	$refNum = "$thisRowGetAds->ABV-$thisRowGetAds->CID";
	$adString =  "<HR>\n<B>$thisRowGetAds->LOCNAME - $noFee$status_sale</B> $priceprefix$price$pricesuffix $avail<BR>$rooms$baths$totalrooms$sqft $floor $buildingstyle $buildingtype <BR><BR>$thisRowGetAds->BODY $feature_string $amenity_string$laundry $pets $parkingnum$parkingtype $parkingcost<BR>$price_sqft  $condofee $assessment $propertytax<BR>$user_sig Listing#$refNum 
$hasExternalPics $hasVirtualTour $hasYouTubeURL $map_link $isNew<BR><BR>\n$signature<!-- CID $thisRowGetAds->CID --></b></b><BR>\n\n";
	return $adString;
}





















function format_ad_ft ($thisRowGetAds, $thisDEFINED_VALUE_SETS, $ftSearchTerm) {
	$nowYYYYMMDD = date ("Ymd");
	$adDateIn = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->DATEIN)));
	$adDateMod = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->MOD)));
	if (!$thisRowGetAds->TRANSIN) {
		$isNewLog = (($adDateIn < 2) || ($adDateMod < 2)) ? 1 : 0;
	}
	$isNew = ($isNewLog) ? "<img src='https://www.BostonApartments.com/images/newIcon.gif'>" : "";
	$hasPics = ($thisRowGetAds->PIC) ? "<a href=\"https://www.BostonApartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$thisRowGetAds->CID\" target=\"blank\"><img border='0' width='22' height='12' src='https://www.BostonApartments.com/images/pic.gif'></a>" : "";

	$hasExternalPics = ($thisRowGetAds->EXTERNALPIC) ? "<A HREF=\"https://www.BostonApartments.com/homepage-MLS.php?cli=1075&ad=$thisRowGetAds->CID\"><img border='0' width='22' height='12' src='https://www.BostonApartments.com/images/pic.gif'></a>" : "";
	
	$hasVirtualTour = ($thisRowGetAds->VIRT_TOUR) ? "<a href=\"$thisRowGetAds->VIRT_TOUR\" target=\"blank\"><img border='0' width='59' height='11' src='https://www.BostonApartments.com/images/virtualtour.gif'></a>" : "";


	if ($thisRowGetAds->NOFEE==3 || $thisRowGetAds->NOFEE==8 || $thisRowGetAds->NOFEE==9) {
		$noFee = "";
	}else {
		$noFee = ($thisRowGetAds->NOFEE) ? "<font color='red'><b>" . $thisDEFINED_VALUE_SETS['NOFEE'][$thisRowGetAds->NOFEE] . "</b></font> - " : "";
	}




	if ($thisRowGetAds->STATUS_SALE==0) {
		$status_sale = "";
	}else {
		$status_sale = ($thisRowGetAds->STATUS_SALE) ? "<font color='red'><b>" . $thisDEFINED_VALUE_SETS['STATUS_SALE'][$thisRowGetAds->STATUS_SALE] . "</b></font> - " : "";
	}

if ($thisRowGetAds->ASSESSMENT !="0.00"){
$assessment =  ($thisRowGetAds->ASSESSMENT) ? "<B>Assessed Value:</B> \$".$thisRowGetAds->ASSESSMENT : "";} else {$assessment = "";}

if ($thisRowGetAds->PROPERTYTAX !="0.00"){
$propertytax =  ($thisRowGetAds->PROPERTYTAX) ? "<B>Property Tax:</B> \$".$thisRowGetAds->PROPERTYTAX : "";} else {$propertytax = "";}

if ($thisRowGetAds->CONDO_FEES !="0.00"){
$condofee =  ($thisRowGetAds->CONDO_FEES) ? "<B>Condo Fee:</B> \$".$thisRowGetAds->CONDO_FEES : "";} else {$condofee = "";}

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
	
	
	
		
	$rooms = ($thisRowGetAds->ROOMS !="0.00") ? $thisDEFINED_VALUE_SETS['ROOMS'][$thisRowGetAds->ROOMS] . " - " : "";
	$baths = ($thisRowGetAds->BATH !="0.00") ? $thisDEFINED_VALUE_SETS['BATH'][$thisRowGetAds->BATH] . " - " : "";
	
	
	if ($thisRowGetAds->AUTO_WRITE) {
		$features_array['FEATURES_DELEADED']		= $thisRowGetAds->FEATURES_DELEADED          ;
		$features_array['FEATURES_FURNISHED']           = $thisRowGetAds->FEATURES_FURNISHED         ;
		$features_array['FEATURES_NON_SMOKING']         = $thisRowGetAds->FEATURES_NON_SMOKING       ;
		$features_array['FEATURES_ALARM']               = $thisRowGetAds->FEATURES_ALARM             ;
		$features_array['FEATURES_HEAT']                = $thisRowGetAds->FEATURES_HEAT              ;
		$features_array['FEATURES_HOT_WATER']           = $thisRowGetAds->FEATURES_HOT_WATER         ;
		$features_array['FEATURES_HT_AND_HW']           = $thisRowGetAds->FEATURES_HT_AND_HW         ;
		$features_array['FEATURES_ELECTRICITY']       = $thisRowGetAds->FEATURES_ELECTRICITY     ;
		$features_array['FEATURES_ALL_UTILITIES']       = $thisRowGetAds->FEATURES_ALL_UTILITIES     ;
		$features_array['FEATURES_GAS_HEAT']            = $thisRowGetAds->FEATURES_GAS_HEAT          ;
		$features_array['FEATURES_OIL_HEAT']            = $thisRowGetAds->FEATURES_OIL_HEAT          ;
		$features_array['FEATURES_ELEC_HEAT']           = $thisRowGetAds->FEATURES_ELEC_HEAT         ;
		$features_array['FEATURES_HWFI']                = $thisRowGetAds->FEATURES_HWFI              ;
		$features_array['FEATURES_FIREPLACE_WORKING']   = $thisRowGetAds->FEATURES_FIREPLACE_WORKING ;
		$features_array['FEATURES_FIREPLACE_DECOR']     = $thisRowGetAds->FEATURES_FIREPLACE_DECOR   ;
		$features_array['FEATURES_CARPET']              = $thisRowGetAds->FEATURES_CARPET            ;
		$features_array['FEATURES_MODERN_KITCHEN']      = $thisRowGetAds->FEATURES_MODERN_KITCHEN    ;
		$features_array['FEATURES_KITCHEN_GALLEY']      = $thisRowGetAds->FEATURES_KITCHEN_GALLEY    ;
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
		$features_array['FEATURES_CABLETV']              = $thisRowGetAds->FEATURES_CABLETV            ;
		$features_array['FEATURES_STAINLESS']              = $thisRowGetAds->FEATURES_STAINLESS            ;
		$features_array['FEATURES_GRANITEC']              = $thisRowGetAds->FEATURES_GRANITEC            ;
		$features_array['FEATURES_BAYWINDOWS']              = $thisRowGetAds->FEATURES_BAYWINDOWS            ;
		$features_array['FEATURES_INTERCOM']              = $thisRowGetAds->FEATURES_INTERCOM            ;
		$features_array['FEATURES_CEILINGFAN']              = $thisRowGetAds->FEATURES_CEILINGFAN            ;

		
		foreach ($features_array as $name => $value) {
			if ($value) {
				$feature_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$feature_string .= " - ";
			}
		}
		if ($feature_string) {
			$feature_string = " <strong>Features:</strong> " . $feature_string;
		}
		
				
		$amenities_array['AMENITIES_CONCIEARGE']         = $thisRowGetAds->AMENITIES_CONCIEARGE       ;
		$amenities_array['AMENITIES_ELEVATOR']           = $thisRowGetAds->AMENITIES_ELEVATOR         ;
		$amenities_array['AMENITIES_DECK']               = $thisRowGetAds->AMENITIES_DECK             ;
		$amenities_array['AMENITIES_ROOF_DECK']          = $thisRowGetAds->AMENITIES_ROOF_DECK        ;
		$amenities_array['AMENITIES_GARDEN']             = $thisRowGetAds->AMENITIES_GARDEN           ;
		$amenities_array['AMENITIES_YARD']               = $thisRowGetAds->AMENITIES_YARD             ;
		$amenities_array['AMENITIES_SECURITY']           = $thisRowGetAds->AMENITIES_SECURITY         ;
		$amenities_array['AMENITIES_BUSINESSCENTER']        = $thisRowGetAds->AMENITIES_BUSINESSCENTER      ;
		$amenities_array['AMENITIES_CLUBHOUSE']        = $thisRowGetAds->AMENITIES_CLUBHOUSE      ;
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
		$amenities_array['AMENITIES_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_NOT_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_NOT_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_WHEELCHAIR'] = $thisRowGetAds->AMENITIES_WHEELCHAIR   ;
		$amenities_array['AMENITIES_SUBWAY']              = $thisRowGetAds->AMENITIES_SUBWAY            ;
		$amenities_array['AMENITIES_CRAIL']              = $thisRowGetAds->AMENITIES_CRAIL            ;
		$amenities_array['AMENITIES_BUS']              = $thisRowGetAds->AMENITIES_BUS            ;
		$amenities_array['AMENITIES_SHUTTLE']              = $thisRowGetAds->AMENITIES_SHUTTLE            ;
		$amenities_array['AMENITIES_BIKEROOM']         = $thisRowGetAds->AMENITIES_BIKEROOM       ;
		$amenities_array['AMENITIES_PLAYGROUND']         = $thisRowGetAds->AMENITIES_PLAYGROUND       ;
		$amenities_array['AMENITIES_BASKETBALL']         = $thisRowGetAds->AMENITIES_BASKETBALL       ;
		$amenities_array['AMENITIES_BBQ']         = $thisRowGetAds->AMENITIES_BBQ       ;
		$amenities_array['AMENITIES_ZIPCAR']         = $thisRowGetAds->AMENITIES_ZIPCAR       ;
		
		
		foreach ($amenities_array as $name => $value) {
			if ($value) {
				$amenity_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$amenity_string .= " - ";
			}
		}
		
		if ($amenity_string) {
			$amenity_string = " <strong>Amenities:</strong> " . $amenity_string;
		}
	}
		
		
		
		
	
	//full text highlighting//
	$ftSearchTerm = stripslashes ($ftSearchTerm);
	$ftSearchTerm = str_replace ("\"", "", $ftSearchTerm);
	$ftSearchTerm = str_replace ("\t", "", $ftSearchTerm);
	$ftSearchTerm = str_replace ("\n", "", $ftSearchTerm);
	$ftSearchTerm = str_replace ("\r", "", $ftSearchTerm);
	
	$body = eregi_replace ($ftSearchTerm, "<span style=\"background-color: #FFFF00\">$ftSearchTerm</span>", $thisRowGetAds->BODY);
	
	//MAP MAKER//
	if ($thisRowGetAds->MAP) {
		$map_link = make_map($thisRowGetAds);
	}
	
	$priceFormat = number_format ($thisRowGetAds->PRICE);
	$price =  ($thisRowGetAds->PRICE) ? " \$$priceFormat " : ""; 
	$price_sqft = ($thisRowGetAds->PRICE_SQFT) ? " $" .(number_format($thisRowGetAds->PRICE_SQFT)) . "/sqft ": "";
	$user_sig = ($thisRowGetAds->USE_USER_SIG) ? " $thisRowGetAds->USER_SIG " : "";
	$refNum = "$thisRowGetAds->ABV-$thisRowGetAds->CID";
	$adString =  "<HR>\n$thisRowGetAds->LOCNAME - $noFee$status_sale$rooms$baths$body $feature_string $amenity_string $laundry $pets $parkingnum$parkingtype $parkingcost $avail $condofee $assessment $propertytax $price$price_sqft$user_sig $refNum$hasPics$hasExternalPics $hasVirtualTour $hasYouTubeURL $map_link$isNew<BR>\n$signature<!-- CID $thisRowGetAds->CID --><BR>\n\n";
	return $adString;
}

function format_ad_2 ($thisRowGetAds, $thisDEFINED_VALUE_SETS) {
	$nowYYYYMMDD = date ("Ymd");
	$adDateIn = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->DATEIN)));
	$adDateMod = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->MOD)));
	if (!$thisRowGetAds->TRANSIN) {
		$isNewLog = (($adDateIn < 2) || ($adDateMod < 2)) ? 1 : 0;
	}
	$isNew = ($isNewLog) ? "<img src='https://www.BostonApartments.com/images/newIcon.gif'>" : "";
	$hasPics = ($thisRowGetAds->PIC) ? "<a href=\"https://www.BostonApartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$thisRowGetAds->CID\" target=\"blank\"><img border='0' width='22' height='12' src='https://www.BostonApartments.com/images/pic.gif'></a>" : "";

	$hasExternalPics = ($thisRowGetAds->EXTERNALPIC) ? "<A HREF=\"https://www.BostonApartments.com/homepage-MLS.php?cli=1075&ad=$thisRowGetAds->CID\"><img border='0' width='22' height='12' src='https://www.BostonApartments.com/images/pic.gif'></a>" : "";

	$hasVirtualTour = ($thisRowGetAds->VIRT_TOUR) ? "<a href=\"$thisRowGetAds->VIRT_TOUR\" target=\"blank\"><img border='0' width='59' height='11' src='https://www.BostonApartments.com/images/virtualtour.gif'></a>" : "";

	
	if ($thisRowGetAds->NOFEE==3 || $thisRowGetAds->NOFEE==8 || $thisRowGetAds->NOFEE==9) {
		$noFee = "";
	}else {
		$noFee = ($thisRowGetAds->NOFEE) ? "<font color='red'><b>" . $thisDEFINED_VALUE_SETS['NOFEE'][$thisRowGetAds->NOFEE] . "</b></font> - " : "";
	}

	if ($thisRowGetAds->STATUS_SALE==0) {
		$status_sale = "";
	}else {
		$status_sale = ($thisRowGetAds->STATUS_SALE) ? "<font color='red'><b>" . $thisDEFINED_VALUE_SETS['STATUS_SALE'][$thisRowGetAds->STATUS_SALE] . "</b></font> - " : "";
	}

if ($thisRowGetAds->ASSESSMENT !="0.00"){
$assessment =  ($thisRowGetAds->ASSESSMENT) ? "<B>Assessed Value:</B> \$".$thisRowGetAds->ASSESSMENT : "";} else {$assessment = "";}

if ($thisRowGetAds->PROPERTYTAX !="0.00"){
$propertytax =  ($thisRowGetAds->PROPERTYTAX) ? "<B>Property Tax:</B> \$".$thisRowGetAds->PROPERTYTAX : "";} else {$propertytax = "";}

if ($thisRowGetAds->CONDO_FEES !="0.00"){
$condofee =  ($thisRowGetAds->CONDO_FEES) ? "<B>Condo Fee:</B> \$".$thisRowGetAds->CONDO_FEES : "";} else {$condofee = "";}

	$signature = ($thisRowGetAds->ALTSIG) ? "$thisRowGetAds->ALTSIG" : "$thisRowGetAds->SIG";
	$signature = eregi_replace ("<A HREF=\"", "<A HREF=\"https://www.BostonApartments.com/", $signature);
	$signature = eregi_replace ("<A HREF=\"https://www.BostonApartments.com/https://www.BostonApartments.com/", "<A HREF=\"https://www.BostonApartments.com/", $signature);
	$signature = eregi_replace ("<A HREF=\"https://www.BostonApartments.com/mailto:", "<A HREF=\"mailto:", $signature);
	$signature = eregi_replace ("https://www.BostonApartments.com/http:", "http:", $signature);
	
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
	
	
	
		
	$rooms = ($thisRowGetAds->ROOMS !="0.00") ? $thisDEFINED_VALUE_SETS['ROOMS'][$thisRowGetAds->ROOMS] . " - " : "";
	$baths = ($thisRowGetAds->BATH !="0.00") ? $thisDEFINED_VALUE_SETS['BATH'][$thisRowGetAds->BATH] . " - " : "";
	
	
	if ($thisRowGetAds->AUTO_WRITE) {
		$features_array['FEATURES_DELEADED']		= $thisRowGetAds->FEATURES_DELEADED          ;
		$features_array['FEATURES_FURNISHED']           = $thisRowGetAds->FEATURES_FURNISHED         ;
		$features_array['FEATURES_NON_SMOKING']         = $thisRowGetAds->FEATURES_NON_SMOKING       ;
		$features_array['FEATURES_ALARM']               = $thisRowGetAds->FEATURES_ALARM             ;
		$features_array['FEATURES_HEAT']                = $thisRowGetAds->FEATURES_HEAT              ;
		$features_array['FEATURES_HOT_WATER']           = $thisRowGetAds->FEATURES_HOT_WATER         ;
		$features_array['FEATURES_HT_AND_HW']           = $thisRowGetAds->FEATURES_HT_AND_HW         ;
		$features_array['FEATURES_ELECTRICITY']           = $thisRowGetAds->FEATURES_ELECTRICITY         ;
		$features_array['FEATURES_ALL_UTILITIES']       = $thisRowGetAds->FEATURES_ALL_UTILITIES     ;
		$features_array['FEATURES_GAS_HEAT']            = $thisRowGetAds->FEATURES_GAS_HEAT          ;
		$features_array['FEATURES_OIL_HEAT']            = $thisRowGetAds->FEATURES_OIL_HEAT          ;
		$features_array['FEATURES_ELEC_HEAT']           = $thisRowGetAds->FEATURES_ELEC_HEAT         ;
		$features_array['FEATURES_HWFI']                = $thisRowGetAds->FEATURES_HWFI              ;
		$features_array['FEATURES_FIREPLACE_WORKING']   = $thisRowGetAds->FEATURES_FIREPLACE_WORKING ;
		$features_array['FEATURES_FIREPLACE_DECOR']     = $thisRowGetAds->FEATURES_FIREPLACE_DECOR   ;
		$features_array['FEATURES_CARPET']              = $thisRowGetAds->FEATURES_CARPET            ;
		$features_array['FEATURES_MODERN_KITCHEN']      = $thisRowGetAds->FEATURES_MODERN_KITCHEN    ;
		$features_array['FEATURES_KITCHEN_GALLEY']      = $thisRowGetAds->FEATURES_KITCHEN_GALLEY    ;
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
		$features_array['FEATURES_CABLETV']              = $thisRowGetAds->FEATURES_CABLETV            ;
		$features_array['FEATURES_STAINLESS']              = $thisRowGetAds->FEATURES_STAINLESS            ;
		$features_array['FEATURES_GRANITEC']              = $thisRowGetAds->FEATURES_GRANITEC            ;
		$features_array['FEATURES_BAYWINDOWS']              = $thisRowGetAds->FEATURES_BAYWINDOWS            ;
		$features_array['FEATURES_INTERCOM']              = $thisRowGetAds->FEATURES_INTERCOM            ;
		$features_array['FEATURES_CEILINGFAN']              = $thisRowGetAds->FEATURES_CEILINGFAN            ;

		
		foreach ($features_array as $name => $value) {
			if ($value) {
				$feature_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$feature_string .= " - ";
			}
		}
		if ($feature_string) {
			$feature_string = " <strong>Features:</strong> " . $feature_string;
		}
		
		$amenities_array['AMENITIES_CONCIEARGE']         = $thisRowGetAds->AMENITIES_CONCIEARGE       ;
		$amenities_array['AMENITIES_ELEVATOR']           = $thisRowGetAds->AMENITIES_ELEVATOR         ;
		$amenities_array['AMENITIES_DECK']               = $thisRowGetAds->AMENITIES_DECK             ;
		$amenities_array['AMENITIES_ROOF_DECK']          = $thisRowGetAds->AMENITIES_ROOF_DECK        ;
		$amenities_array['AMENITIES_GARDEN']             = $thisRowGetAds->AMENITIES_GARDEN           ;
		$amenities_array['AMENITIES_YARD']               = $thisRowGetAds->AMENITIES_YARD             ;
		$amenities_array['AMENITIES_SECURITY']           = $thisRowGetAds->AMENITIES_SECURITY         ;
		$amenities_array['AMENITIES_BUSINESSCENTER']        = $thisRowGetAds->AMENITIES_BUSINESSCENTER      ;
		$amenities_array['AMENITIES_CLUBHOUSE']        = $thisRowGetAds->AMENITIES_CLUBHOUSE      ;
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
		$amenities_array['AMENITIES_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_NOT_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_NOT_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_WHEELCHAIR'] = $thisRowGetAds->AMENITIES_WHEELCHAIR   ;
		$amenities_array['AMENITIES_SUBWAY']              = $thisRowGetAds->AMENITIES_SUBWAY            ;
		$amenities_array['AMENITIES_CRAIL']              = $thisRowGetAds->AMENITIES_CRAIL            ;
		$amenities_array['AMENITIES_BUS']              = $thisRowGetAds->AMENITIES_BUS            ;
		$amenities_array['AMENITIES_SHUTTLE']              = $thisRowGetAds->AMENITIES_SHUTTLE            ;
		$amenities_array['AMENITIES_BIKEROOM']         = $thisRowGetAds->AMENITIES_BIKEROOM       ;
		$amenities_array['AMENITIES_PLAYGROUND']         = $thisRowGetAds->AMENITIES_PLAYGROUND       ;
		$amenities_array['AMENITIES_BASKETBALL']         = $thisRowGetAds->AMENITIES_BASKETBALL       ;
		$amenities_array['AMENITIES_BBQ']         = $thisRowGetAds->AMENITIES_BBQ       ;
		$amenities_array['AMENITIES_ZIPCAR']         = $thisRowGetAds->AMENITIES_ZIPCAR       ;		
		
		foreach ($amenities_array as $name => $value) {
			if ($value) {
				$amenity_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$amenity_string .= " - ";
			}
		}
		
		if ($amenity_string) {
			$amenity_string = " <strong>Amenities:</strong> " . $amenity_string;
		}
	}
		
		
		
		
	
	//MAP MAKER//
	if ($thisRowGetAds->MAP) {
		$map_link = make_map($thisRowGetAds);
	}	
        if($thisRowGetAds->AGENCY_HEADERS)
        {
                $strAgency="SELECT * FROM AGENCIES WHERE AGENCY_ID=$thisRowGetAds->AGENCY_HEADERS";
                $quAgency = mysqli_query($dbh, $strAgency);
                if($rowAgency=mysqli_fetch_object($quAgency))
                {
                        $agency_sig=$rowAgency->CUSTOM_SIGNATURE;
                        $signature=$agency_sig;
                }
        }
		
		
	$priceFormat = number_format ($thisRowGetAds->PRICE);
	$price =  ($thisRowGetAds->PRICE) ? " \$$priceFormat " : ""; 
	$price_sqft = ($thisRowGetAds->PRICE_SQFT) ? " $" .(number_format($thisRowGetAds->PRICE_SQFT)) . "/sqft ": "";
	$user_sig = ($thisRowGetAds->USE_USER_SIG) ? " $thisRowGetAds->USER_SIG " : "";
	$refNum = "$thisRowGetAds->ABV-$thisRowGetAds->CID";
	$adString =  "<HR>\n$thisRowGetAds->LOCNAME - $noFee$status_sale$rooms$baths$thisRowGetAds->BODY$avail$price$price_sqft $feature_string$amenity_string$laundry $pets $parkingnum$parkingtype $parkingcost  $condofee $assessment $propertytax $user_sig $refNum $hasPics $hasExternalPics $hasVirtualTour $hasYouTubeURL $map_link $isNew<BR>\n$signature<!-- CID $thisRowGetAds->CID --><BR>\n\n";
	return $adString;
}


function format_ad_email ($thisRowGetAds, $thisDEFINED_VALUE_SETS) {
	$nowYYYYMMDD = date ("Ymd");
	$adDateIn = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->DATEIN)));
	$adDateMod = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->MOD)));
	if (!$thisRowGetAds->TRANSIN) {
		$isNewLog = (($adDateIn < 2) || ($adDateMod < 2)) ? 1 : 0;
	}
	
	$hasPics = ($thisRowGetAds->PIC) ? "<BR>Picture Link: <A HREF='https://www.BostonApartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$thisRowGetAds->CID'>https://www.BostonApartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$thisRowGetAds->CID</A><BR>" : "";
	
	
	
	$hasExternalPics = ($thisRowGetAds->EXTERNALPIC) ? "<A HREF=\"https://www.BostonApartments.com/homepage-MLS.php?cli=1075&ad=$thisRowGetAds->CID\"><img border='0' width='22' height='12' src='https://www.BostonApartments.com/images/pic.gif'></a>" : "";


	$hasVirtualTour = ($thisRowGetAds->VIRT_TOUR) ? "<BR>Virtual Tour Link: <A HREF=$thisRowGetAds->VIRT_TOUR>$thisRowGetAds->VIRT_TOUR</A> <BR>" : "";
	$hasYouTubeURL = ($thisRowGetAds->YOUTUBEURL) ? "<BR>Video Link: <A HREF=$thisRowGetAds->YOUTUBEURL>$thisRowGetAds->YOUTUBEURL</A><BR>" : "";
	if ($thisRowGetAds->NOFEE==3 || $thisRowGetAds->NOFEE==8 || $thisRowGetAds->NOFEE==9) {
		$noFee = "";
	}else {
		$noFee = ($thisRowGetAds->NOFEE) ? " " . $thisDEFINED_VALUE_SETS['NOFEE'][$thisRowGetAds->NOFEE] . " - " : "";
	}

	if ($thisRowGetAds->STATUS_SALE==0) {
		$status_sale = "";
	}else {
		$status_sale = ($thisRowGetAds->STATUS_SALE) ? "<font color='red'><b>" . $thisDEFINED_VALUE_SETS['STATUS_SALE'][$thisRowGetAds->STATUS_SALE] . "</b></font> - " : "";
	}

if ($thisRowGetAds->ASSESSMENT !="0.00"){
$assessment =  ($thisRowGetAds->ASSESSMENT) ? "<BR><B>Assessed Value:</B> \$".$thisRowGetAds->ASSESSMENT : "";} else {$assessment = "";}
if ($thisRowGetAds->PROPERTYTAX !="0.00"){
$propertytax =  ($thisRowGetAds->PROPERTYTAX) ? "<BR><B>Property Tax:</B> \$".$thisRowGetAds->PROPERTYTAX : "";} else {$propertytax = "";}
if ($thisRowGetAds->CONDO_FEES !="0"){
$condofee =  ($thisRowGetAds->CONDO_FEES !="0.00") ? "<BR><B>Condo Fee:</B> \$".$thisRowGetAds->CONDO_FEES : "";} else {$condofee = "";}

	$signature = ($thisRowGetAds->ALTSIG) ? "$thisRowGetAds->ALTSIG" : "$thisRowGetAds->SIG";
	$avail = ($thisRowGetAds->AVAIL !== "0000-00-00") ? " Available: $thisRowGetAds->AVAIL " : "<BR>";
	if ($thisRowGetAds->AVAIL == "0000-00-00") {
		$avail = "";	
	}else {
		
		$today = date ("Ymd");
		$avail_all = str_replace ("-", "", $thisRowGetAds->AVAIL);
		if (($today - $avail_all) >= 0) {
			$avail = "<B>Available:</B> Now.<BR>";
		}else {
			$avail_year = substr ($thisRowGetAds->AVAIL, 2,2);
			$avail_month = substr ($thisRowGetAds->AVAIL, 5,2);
			$avail_day = substr ($thisRowGetAds->AVAIL, 8,2);
			$avail = " Available: $avail_month/$avail_day/$avail_year. ";
		}
	}
	
		
	$rooms = ($thisRowGetAds->ROOMS !="0.00") ? $thisDEFINED_VALUE_SETS['ROOMS'][$thisRowGetAds->ROOMS] . " - " : "";
	$baths = ($thisRowGetAds->BATH !="0.00") ? $thisDEFINED_VALUE_SETS['BATH'][$thisRowGetAds->BATH] . " - " : "";

	$pets = ($thisRowGetAds->PETSA) ? $thisDEFINED_VALUE_SETS['PETSA'][$thisRowGetAds->PETSA] . " - " : "";

	$parkingnum = ($thisRowGetAds->PARKING_NUM) ? $thisDEFINED_VALUE_SETS['PARKING_NUM'][$thisRowGetAds->PARKING_NUM] . " parking " : "";

	$parkingtype = ($thisRowGetAds->PARKING_TYPE) ? $thisDEFINED_VALUE_SETS['PARKING_TYPE'][$thisRowGetAds->PARKING_TYPE] . " " : "";

	$parkingcost = ($thisRowGetAds->PARKING_COST) ? $thisDEFINED_VALUE_SETS['PARKING_COST'][$thisRowGetAds->PARKING_COST] . "\$$thisRowGetAds->PARKING_COST." : "";



	$laundry = ($thisRowGetAds->LAUNDRY_ROOM) ? $thisDEFINED_VALUE_SETS['LAUNDRY_ROOM'][$thisRowGetAds->LAUNDRY_ROOM] . " - " : "";




	if ($thisRowGetAds->AUTO_WRITE) {
		$features_array['FEATURES_DELEADED']		= $thisRowGetAds->FEATURES_DELEADED          ;
		$features_array['FEATURES_FURNISHED']           = $thisRowGetAds->FEATURES_FURNISHED         ;
		$features_array['FEATURES_NON_SMOKING']         = $thisRowGetAds->FEATURES_NON_SMOKING       ;
		$features_array['FEATURES_ALARM']               = $thisRowGetAds->FEATURES_ALARM             ;
		$features_array['FEATURES_HEAT']                = $thisRowGetAds->FEATURES_HEAT              ;
		$features_array['FEATURES_HOT_WATER']           = $thisRowGetAds->FEATURES_HOT_WATER         ;
		$features_array['FEATURES_HT_AND_HW']           = $thisRowGetAds->FEATURES_HT_AND_HW         ;
		$features_array['FEATURES_ELECTRICITY']       = $thisRowGetAds->FEATURES_ELECTRICITY     ;
		$features_array['FEATURES_ALL_UTILITIES']       = $thisRowGetAds->FEATURES_ALL_UTILITIES     ;
		$features_array['FEATURES_GAS_HEAT']            = $thisRowGetAds->FEATURES_GAS_HEAT          ;
		$features_array['FEATURES_OIL_HEAT']            = $thisRowGetAds->FEATURES_OIL_HEAT          ;
		$features_array['FEATURES_ELEC_HEAT']           = $thisRowGetAds->FEATURES_ELEC_HEAT         ;
		$features_array['FEATURES_HWFI']                = $thisRowGetAds->FEATURES_HWFI              ;
		$features_array['FEATURES_FIREPLACE_WORKING']   = $thisRowGetAds->FEATURES_FIREPLACE_WORKING ;
		$features_array['FEATURES_FIREPLACE_DECOR']     = $thisRowGetAds->FEATURES_FIREPLACE_DECOR   ;
		$features_array['FEATURES_CARPET']              = $thisRowGetAds->FEATURES_CARPET            ;
		$features_array['FEATURES_MODERN_KITCHEN']      = $thisRowGetAds->FEATURES_MODERN_KITCHEN    ;
		$features_array['FEATURES_KITCHEN_GALLEY']      = $thisRowGetAds->FEATURES_KITCHEN_GALLEY    ;
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
		$features_array['FEATURES_CABLETV']              = $thisRowGetAds->FEATURES_CABLETV            ;
		$features_array['FEATURES_STAINLESS']              = $thisRowGetAds->FEATURES_STAINLESS            ;
		$features_array['FEATURES_GRANITEC']              = $thisRowGetAds->FEATURES_GRANITEC            ;
		$features_array['FEATURES_BAYWINDOWS']              = $thisRowGetAds->FEATURES_BAYWINDOWS            ;
		$features_array['FEATURES_INTERCOM']              = $thisRowGetAds->FEATURES_INTERCOM            ;
		$features_array['FEATURES_CEILINGFAN']              = $thisRowGetAds->FEATURES_CEILINGFAN            ;
		
		foreach ($features_array as $name => $value) {
			if ($value) {
				$feature_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$feature_string .= " - ";
			}
		}
		if ($feature_string) {
			$feature_string = " <BR><B>Features:</B><BR> " . $feature_string;
		}
		
				
		$amenities_array['AMENITIES_CONCIEARGE']         = $thisRowGetAds->AMENITIES_CONCIEARGE       ;
		$amenities_array['AMENITIES_ELEVATOR']           = $thisRowGetAds->AMENITIES_ELEVATOR         ;
		$amenities_array['AMENITIES_DECK']               = $thisRowGetAds->AMENITIES_DECK             ;
		$amenities_array['AMENITIES_ROOF_DECK']          = $thisRowGetAds->AMENITIES_ROOF_DECK        ;
		$amenities_array['AMENITIES_GARDEN']             = $thisRowGetAds->AMENITIES_GARDEN           ;
		$amenities_array['AMENITIES_YARD']               = $thisRowGetAds->AMENITIES_YARD             ;
		$amenities_array['AMENITIES_SECURITY']           = $thisRowGetAds->AMENITIES_SECURITY         ;
		$amenities_array['AMENITIES_BUSINESSCENTER']        = $thisRowGetAds->AMENITIES_BUSINESSCENTER      ;
		$amenities_array['AMENITIES_CLUBHOUSE']        = $thisRowGetAds->AMENITIES_CLUBHOUSE      ;
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
		$amenities_array['AMENITIES_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_NOT_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_NOT_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_WHEELCHAIR'] = $thisRowGetAds->AMENITIES_WHEELCHAIR   ;
		$amenities_array['AMENITIES_SUBWAY']              = $thisRowGetAds->AMENITIES_SUBWAY            ;
		$amenities_array['AMENITIES_CRAIL']              = $thisRowGetAds->AMENITIES_CRAIL            ;
		$amenities_array['AMENITIES_BUS']              = $thisRowGetAds->AMENITIES_BUS            ;
		$amenities_array['AMENITIES_SHUTTLE']              = $thisRowGetAds->AMENITIES_SHUTTLE            ;
		$amenities_array['AMENITIES_BIKEROOM']         = $thisRowGetAds->AMENITIES_BIKEROOM       ;
		$amenities_array['AMENITIES_PLAYGROUND']         = $thisRowGetAds->AMENITIES_PLAYGROUND       ;
		$amenities_array['AMENITIES_BASKETBALL']         = $thisRowGetAds->AMENITIES_BASKETBALL       ;
		$amenities_array['AMENITIES_BBQ']         = $thisRowGetAds->AMENITIES_BBQ       ;
		$amenities_array['AMENITIES_ZIPCAR']         = $thisRowGetAds->AMENITIES_ZIPCAR       ;
		
		
		foreach ($amenities_array as $name => $value) {
			if ($value) {
				$amenity_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$amenity_string .= " - ";
			}
		}
		
		if ($amenity_string) {
			$amenity_string = " <BR><B>Amenities:</B><BR> " . $amenity_string;
		}
	}
		
		
		
	//MAP MAKER//
	if (($thisRowGetAds->MAP) AND ($thisRowGetAds->CLI != 1075)) {
		$map_link = make_map_email($thisRowGetAds);
	} else { $map_link = ""; }
	
        if($thisRowGetAds->AGENCY_HEADERS)
        {
                $strAgency="SELECT * FROM AGENCIES WHERE AGENCY_ID=$thisRowGetAds->AGENCY_HEADERS";
                $quAgency = mysqli_query($dbh, $strAgency);
                if($rowAgency=mysqli_fetch_object($quAgency))
                {
                        $agency_sig=$rowAgency->CUSTOM_SIGNATURE;
			$signature=$agency_sig;
                }
        }
		
	$priceFormat = number_format ($thisRowGetAds->PRICE);
	$price =  ($thisRowGetAds->PRICE) ? "<BR><B>Price:</B> \$$priceFormat " : ""; 
	$price_sqft = ($thisRowGetAds->PRICE_SQFT) ? " $" .(number_format($thisRowGetAds->PRICE_SQFT)) . "/sqft ": "";
	$user_sig = ($thisRowGetAds->USE_USER_SIG) ? " $thisRowGetAds->USER_SIG " : "";
	
	$companysignature="$thisRowGetAds->NAME $thisRowGetAds->GROUP_PHONE";
	
	$refNum = "<B>AD #:</B> $thisRowGetAds->CID";
	$adString =  "<BR>$thisRowGetAds->LOCNAME - $noFee$status_sale<BR>$rooms$baths<BR>$thisRowGetAds->BODY<BR>$feature_string <BR>$amenity_string $laundry $pets $parkingnum$parkingtype $parkingcost  $avail $condofee $assessment $propertytax $price$price_sqft <BR>$refNum<BR>$user_sig<BR>$companysignature<BR> $hasExternalPics$hasPics$hasVirtualTour$hasYouTubeURL$map_link<BR><BR>";
	return $adString;
}





function format_ad_kijiji ($thisRowGetAds, $thisDEFINED_VALUE_SETS) {
	$nowYYYYMMDD = date ("Ymd");
	$adDateIn = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->DATEIN)));
	$adDateMod = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->MOD)));
	if (!$thisRowGetAds->TRANSIN) {
		$isNewLog = (($adDateIn < 2) || ($adDateMod < 2)) ? 1 : 0;
	}
	

	if ($thisRowGetAds->NOFEE==3 || $thisRowGetAds->NOFEE==8 || $thisRowGetAds->NOFEE==9) {
		$noFee = "";
	}else {
		$noFee = ($thisRowGetAds->NOFEE) ? " " . $thisDEFINED_VALUE_SETS['NOFEE'][$thisRowGetAds->NOFEE] . " - " : "";
	}

	if ($thisRowGetAds->STATUS_SALE==0) {
		$status_sale = "";
	}else {
		$status_sale = ($thisRowGetAds->STATUS_SALE) ? " " . $thisDEFINED_VALUE_SETS['STATUS_SALE'][$thisRowGetAds->STATUS_SALE] . " - " : "";
	}

if ($thisRowGetAds->ASSESSMENT !="0.00"){
$assessment =  ($thisRowGetAds->ASSESSMENT) ? " Assessed Value: \$".$thisRowGetAds->ASSESSMENT : "";} else {$assessment = "";}
if ($thisRowGetAds->PROPERTYTAX !="0.00"){
$propertytax =  ($thisRowGetAds->PROPERTYTAX) ? " Property Tax:  \$".$thisRowGetAds->PROPERTYTAX : "";} else {$propertytax = "";}
if ($thisRowGetAds->CONDO_FEES !="0"){
$condofee =  ($thisRowGetAds->CONDO_FEES !="0.00") ? "Condo Fee: \$".$thisRowGetAds->CONDO_FEES : "";} else {$condofee = "";}

	$signature = ($thisRowGetAds->ALTSIG) ? "$thisRowGetAds->ALTSIG" : "$thisRowGetAds->SIG";
	$avail = ($thisRowGetAds->AVAIL !== "0000-00-00") ? " Available: $thisRowGetAds->AVAIL " : "<BR>";
	if ($thisRowGetAds->AVAIL == "0000-00-00") {
		$avail = "";	
	}else {
		
		$today = date ("Ymd");
		$avail_all = str_replace ("-", "", $thisRowGetAds->AVAIL);
		if (($today - $avail_all) >= 0) {
			$avail = "Available Now. ";
		}else {
			$avail_year = substr ($thisRowGetAds->AVAIL, 2,2);
			$avail_month = substr ($thisRowGetAds->AVAIL, 5,2);
			$avail_day = substr ($thisRowGetAds->AVAIL, 8,2);
			$avail = " Available: $avail_month/$avail_day/$avail_year. ";
		}
	}
	
		
	$rooms = ($thisRowGetAds->ROOMS !="0.00") ? $thisDEFINED_VALUE_SETS['ROOMS'][$thisRowGetAds->ROOMS] . " - " : "";
	$baths = ($thisRowGetAds->BATH !="0.00") ? $thisDEFINED_VALUE_SETS['BATH'][$thisRowGetAds->BATH] . " - " : "";

	$pets = ($thisRowGetAds->PETSA) ? $thisDEFINED_VALUE_SETS['PETSA'][$thisRowGetAds->PETSA] . " - " : "";

	$parkingnum = ($thisRowGetAds->PARKING_NUM) ? $thisDEFINED_VALUE_SETS['PARKING_NUM'][$thisRowGetAds->PARKING_NUM] . " parking " : "";

	$parkingtype = ($thisRowGetAds->PARKING_TYPE) ? $thisDEFINED_VALUE_SETS['PARKING_TYPE'][$thisRowGetAds->PARKING_TYPE] . " " : "";

	$parkingcost = ($thisRowGetAds->PARKING_COST) ? $thisDEFINED_VALUE_SETS['PARKING_COST'][$thisRowGetAds->PARKING_COST] . "\$$thisRowGetAds->PARKING_COST." : "";



	$laundry = ($thisRowGetAds->LAUNDRY_ROOM) ? $thisDEFINED_VALUE_SETS['LAUNDRY_ROOM'][$thisRowGetAds->LAUNDRY_ROOM] . " - " : "";




	if ($thisRowGetAds->AUTO_WRITE) {
		$features_array['FEATURES_DELEADED']		= $thisRowGetAds->FEATURES_DELEADED          ;
		$features_array['FEATURES_FURNISHED']           = $thisRowGetAds->FEATURES_FURNISHED         ;
		$features_array['FEATURES_NON_SMOKING']         = $thisRowGetAds->FEATURES_NON_SMOKING       ;
		$features_array['FEATURES_ALARM']               = $thisRowGetAds->FEATURES_ALARM             ;
		$features_array['FEATURES_HEAT']                = $thisRowGetAds->FEATURES_HEAT              ;
		$features_array['FEATURES_HOT_WATER']           = $thisRowGetAds->FEATURES_HOT_WATER         ;
		$features_array['FEATURES_HT_AND_HW']           = $thisRowGetAds->FEATURES_HT_AND_HW         ;
		$features_array['FEATURES_ELECTRICITY']       = $thisRowGetAds->FEATURES_ELECTRICITY     ;
		$features_array['FEATURES_ALL_UTILITIES']       = $thisRowGetAds->FEATURES_ALL_UTILITIES     ;
		$features_array['FEATURES_GAS_HEAT']            = $thisRowGetAds->FEATURES_GAS_HEAT          ;
		$features_array['FEATURES_OIL_HEAT']            = $thisRowGetAds->FEATURES_OIL_HEAT          ;
		$features_array['FEATURES_ELEC_HEAT']           = $thisRowGetAds->FEATURES_ELEC_HEAT         ;
		$features_array['FEATURES_HWFI']                = $thisRowGetAds->FEATURES_HWFI              ;
		$features_array['FEATURES_FIREPLACE_WORKING']   = $thisRowGetAds->FEATURES_FIREPLACE_WORKING ;
		$features_array['FEATURES_FIREPLACE_DECOR']     = $thisRowGetAds->FEATURES_FIREPLACE_DECOR   ;
		$features_array['FEATURES_CARPET']              = $thisRowGetAds->FEATURES_CARPET            ;
		$features_array['FEATURES_MODERN_KITCHEN']      = $thisRowGetAds->FEATURES_MODERN_KITCHEN    ;
		$features_array['FEATURES_KITCHEN_GALLEY']      = $thisRowGetAds->FEATURES_KITCHEN_GALLEY    ;
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
		$features_array['FEATURES_CABLETV']              = $thisRowGetAds->FEATURES_CABLETV            ;
		$features_array['FEATURES_STAINLESS']              = $thisRowGetAds->FEATURES_STAINLESS            ;
		$features_array['FEATURES_GRANITEC']              = $thisRowGetAds->FEATURES_GRANITEC            ;
		$features_array['FEATURES_BAYWINDOWS']              = $thisRowGetAds->FEATURES_BAYWINDOWS            ;
		$features_array['FEATURES_INTERCOM']              = $thisRowGetAds->FEATURES_INTERCOM            ;
		$features_array['FEATURES_CEILINGFAN']              = $thisRowGetAds->FEATURES_CEILINGFAN            ;
		
		foreach ($features_array as $name => $value) {
			if ($value) {
				$feature_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$feature_string .= " - ";
			}
		}
		if ($feature_string) {
			$feature_string = "  Features: " . $feature_string;
		}
		
				
		$amenities_array['AMENITIES_CONCIEARGE']         = $thisRowGetAds->AMENITIES_CONCIEARGE       ;
		$amenities_array['AMENITIES_ELEVATOR']           = $thisRowGetAds->AMENITIES_ELEVATOR         ;
		$amenities_array['AMENITIES_DECK']               = $thisRowGetAds->AMENITIES_DECK             ;
		$amenities_array['AMENITIES_ROOF_DECK']          = $thisRowGetAds->AMENITIES_ROOF_DECK        ;
		$amenities_array['AMENITIES_GARDEN']             = $thisRowGetAds->AMENITIES_GARDEN           ;
		$amenities_array['AMENITIES_YARD']               = $thisRowGetAds->AMENITIES_YARD             ;
		$amenities_array['AMENITIES_SECURITY']           = $thisRowGetAds->AMENITIES_SECURITY         ;
		$amenities_array['AMENITIES_BUSINESSCENTER']        = $thisRowGetAds->AMENITIES_BUSINESSCENTER      ;
		$amenities_array['AMENITIES_CLUBHOUSE']        = $thisRowGetAds->AMENITIES_CLUBHOUSE      ;
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
		$amenities_array['AMENITIES_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_NOT_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_NOT_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_WHEELCHAIR'] = $thisRowGetAds->AMENITIES_WHEELCHAIR   ;
		$amenities_array['AMENITIES_SUBWAY']              = $thisRowGetAds->AMENITIES_SUBWAY            ;
		$amenities_array['AMENITIES_CRAIL']              = $thisRowGetAds->AMENITIES_CRAIL            ;
		$amenities_array['AMENITIES_BUS']              = $thisRowGetAds->AMENITIES_BUS            ;
		$amenities_array['AMENITIES_SHUTTLE']              = $thisRowGetAds->AMENITIES_SHUTTLE            ;
		$amenities_array['AMENITIES_BIKEROOM']         = $thisRowGetAds->AMENITIES_BIKEROOM       ;
		$amenities_array['AMENITIES_PLAYGROUND']         = $thisRowGetAds->AMENITIES_PLAYGROUND       ;
		$amenities_array['AMENITIES_BASKETBALL']         = $thisRowGetAds->AMENITIES_BASKETBALL       ;
		$amenities_array['AMENITIES_BBQ']         = $thisRowGetAds->AMENITIES_BBQ       ;
		$amenities_array['AMENITIES_ZIPCAR']         = $thisRowGetAds->AMENITIES_ZIPCAR       ;
		
		
		foreach ($amenities_array as $name => $value) {
			if ($value) {
				$amenity_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$amenity_string .= " - ";
			}
		}
		
		if ($amenity_string) {
			$amenity_string = " Amenities: " . $amenity_string;
		}
	}
		
		
		
	
        if($thisRowGetAds->AGENCY_HEADERS)
        {
                $strAgency="SELECT * FROM AGENCIES WHERE AGENCY_ID=$thisRowGetAds->AGENCY_HEADERS";
                $quAgency = mysqli_query($dbh, $strAgency);
                if($rowAgency=mysqli_fetch_object($quAgency))
                {
                        $agency_sig=$rowAgency->CUSTOM_SIGNATURE;
			$signature=$agency_sig;
                }
        }
		
	$priceFormat = number_format ($thisRowGetAds->PRICE);
	$price =  ($thisRowGetAds->PRICE) ? " Price: \$$priceFormat " : ""; 
	$price_sqft = ($thisRowGetAds->PRICE_SQFT) ? " $" .(number_format($thisRowGetAds->PRICE_SQFT)) . "/sqft ": "";
	$user_sig = ($thisRowGetAds->USE_USER_SIG) ? " $thisRowGetAds->USER_SIG " : "";
	
	$companysignature="$thisRowGetAds->NAME $thisRowGetAds->GROUP_PHONE";
	
	$refNum = " AD #: $thisRowGetAds->CID";
	$adString =  "$thisRowGetAds->LOCNAME - $noFee$status_sale $rooms$baths $thisRowGetAds->BODY $feature_string  $amenity_string $laundry $pets $parkingnum$parkingtype $parkingcost  $avail $condofee $assessment $propertytax $price$price_sqft  $refNum


Posted via BostonApartments.com
";
	
	
	$adString = str_replace("<BR>", "
", $adString);

$adString = str_replace("<br>", "
 ", $adString);

$adString = str_replace("<b>", "", $adString);

$adString = str_replace("</b>", "", $adString);

$adString = str_replace("<li>", " 
", $adString);

$adString = str_replace("</li>", " ", $adString);
	
	return $adString;
}








function fuzDate ($date) {
	$getMon = subStr ($date, 5, 2);
	$getDay = subStr ($date, 8, 2);
	$getYear = subStr ($date, 2, 2);


	if ($getDay=="00") {
		$getDay = ""; }

	if ($getYear=="00") {
		$getYear = ""; }


	if ($getMon=="01") {
		$mAbv = "Jan";
	}elseif ($getMon=="02") {
		$mAbv = "Feb";
	}elseif ($getMon=="03") {
		$mAbv = "Mar";
	}elseif ($getMon=="04") {
		$mAbv = "Apr";
	}elseif ($getMon=="05") {
		$mAbv = "May";
	}elseif ($getMon=="06") {
		$mAbv = "Jun";
	}elseif ($getMon=="07") {
		$mAbv = "Jul";
	}elseif ($getMon=="08") {
		$mAbv = "Aug";
	}elseif ($getMon=="09") {
		$mAbv = "Sep";
	}elseif ($getMon=="10") {
		$mAbv = "Oct";
	}elseif ($getMon=="11") {
		$mAbv = "Nov";
	}elseif ($getMon=="12") {
		$mAbv = "Dec";

	}
	return "<NOBR>$mAbv $getDay $getYear</NOBR>";
}


function handle_error ($num) {
	echo ($num);
}

function csv_parse ($data, $separator) {
    $quote = '"';
    $values = array();
    $toggle = 0;
    $len = strlen($data);
    $count = 1;
    for ($i = 0; $i < $len; $i++) {
        $tmp = substr ($data, $i, 1);
        if (strcmp($tmp, $quote) == 0) {
            $toggle = $toggle ^ 1;
        }
        $value =  $value . $tmp;
        if (strcmp($tmp, $separator) == 0) {
            if (! $toggle) {
                # End of word
                $value = ereg_replace(",$", "", $value);
                $value = ereg_replace("^\"", "", $value);
                $value = ereg_replace("\"$", "", $value);
                $value = ereg_replace("\"+", "\"", $value);
                $num_of_elems = count($values);
                $values[$num_of_elems] = $value;
                $value = "";
            }
        }
    }
    $value = ereg_replace("^\"", "", $value);
    $value = ereg_replace("\"$", "", $value);
    $value = ereg_replace("\"+", "\"", $value);
    $num_of_elems = count($values);
    $values[$num_of_elems] = $value;
    return ($values);
}


class filterMember {
	/*-----------------------------------------------------------------------------------------------------------
	|
	|
	|	USAGE
	|   this class takes a checkbox and a field from a form,  checks the status,  validates input and creates a
	|	string fragment to be used in a WHERE clause.
	|
	|	constructor   mixed = new filterMember(string checkbox, string key name, string key data type ["STR" | "INT"], -
	|	>string operation ["EQ" | "GTEQ" | "LTEQ"], mixed key value)
	|
	|	Example  $qkey1 = new filterMember ($ck1, "ID", "INT", "EQ", $field1);
	|			 if ($qkey1->isActive()) {
	|				$myFrag = $qkey1->makeFrag();
	|			 }
	|
	|----------------------------------------------------------------------------------------------------------*/







	var $checkBoxName;
	var $keyName;
	var $keyDataType;
	var $keyOperation;
	var $keyValue;


	function filterMember ($checkBoxName, $keyName, $keyDataType, $keyOperation, $keyValue)
		{
			$this->checkBoxName = $checkBoxName;
			$this->keyName = $keyName;
			$this->keyDataType =$keyDataType;
			$this->keyOperation = $keyOperation;
			$this->keyValue = $keyValue;
	    }

    function isActive () {
	    if ($this->checkBoxName=="ON"){
		    return true;
	    }else {
		    return false;
	    }
    }

    function makeFrag() {
	   	if ($this->keyOperation=="EQ") {
	    	if ($this->keyDataType=="STR"){
		    	if ($this->keyValue=="") {die ("Inproper Input supplied");}
		   		return (" " . $this->keyName . "='" . $this->keyValue . "' ");
	    	}elseif ($this->keyDataType=="INT") {
		   		if ($this->keyValue=="") {die ("Inproper Input supplied");}
		   		return (" " . $this->keyName . "=" . $this->keyValue );
	    	}
	   	}elseif ($this->keyOperation=="GTEQ") {
	    	if ($this->keyDataType=="STR"){
		   		if ($this->keyValue=="") {die ("Inproper Input supplied");}
	    		return (" " . $this->keyName . ">='" . $this->keyValue . "' ");
	   		}elseif ($this->keyDataType=="INT") {
	    		if ($this->keyValue=="") {die ("Inproper Input supplied");}
	    		return (" " . $this->keyName . ">=" . $this->keyValue);
	    	}
	   	}elseif ($this->keyOperation=="LTEQ") {
	    	if ($this->keyDataType=="STR"){
		   		if ($this->keyValue=="") {die ("Inproper Input supplied");}
		   		return (" " . $this->keyName . "<='" . $this->keyValue . "' ");
	   		}elseif ($this->keyDataType=="INT") {
	    		if ($this->keyValue=="") {die ("Inproper Input supplied");}
	    		return (" " . $this->keyName . "<=" . $this->keyValue);
	   		}
	   	}
    }
}



class PwFile {
	/* This class manipulates .htapassword files used on apache webservers for .htaaccess */


    var $fp; // filepointer
    var $filename;



    function PwFile($filename) // constructor
    {
        $this->fp = fopen ($filename,"r+");
        $this->filename = $filename;
    }

    function closeFile ()
    {
    fclose ($this->fp);
    }

    function existsUser ($usr_ID){
    	rewind($this->fp); 
    	while (feof($this->fp)==0)    {
    		
	        $line = chop(fgets($this->fp));  //read line from file
	        $arr = split(":", $line);  //slit at ':'
	        echo $arr[0] ."<br>";
	        if ($arr[0] == $usr_ID){
              		return 1; // username found
        	}else{
              		//return false;  // username not found
        	}
        	
        	
    	}
    }

    function getFileSize()
    {
        return (filesize($this->filename));
    }

    function write_temp ($contents)
    {
       // echo "<pre>$contents</pre>";
      $temp_filename = tempnam ("/tmp", "php_");
     // echo "<br>$temp_filename<br>";
         $temp_fp = fopen($temp_filename, 'r+');
         fwrite($temp_fp, $contents);
         fclose($temp_fp);
         fclose($this->fp);
         copy ($temp_filename, $this->filename);
         $this->fp = fopen($this->filename, "r+");
         //unlink($temp_filename);
    }

    function addUser ($usr_ID, $usr_passwd)
    {
    //rewind($this->fp);
    $contents = fread($this->fp, $this->getFileSize());
        // echo "<pre>bevor $contents</pre>";
         $contents .= "$usr_ID:".crypt($usr_passwd)."\n";
        // echo "<pre>danach $contents</pre>";
         $this->write_temp($contents);
    }

    function deleteUser ($usr_ID)
    {
    $contents = "";
    rewind($this->fp);
    while (feof($this->fp) == 0)
    {
        $line = "";
        $line = chop(fgets($this->fp,1000));
              $arr = split(":", $line);
              if ($arr[0] != $usr_ID)
              {
                  //echo $arr[0] ." ist nicht gleich ". $usr_ID;
              $contents .= $line . "\n";
              }
          }
         // echo "<hr>$contents<hr>";
          $contents = chop ($contents);
          $contents .= "\n"; // kind a tricky
          $this->write_temp($contents);

    }

    function updateUser ($usr_ID, $usr_passwd)
    {
        $this->deleteUser($usr_ID);
        $this->addUser($usr_ID,$usr_passwd);
    }
}

function dieNice ($code, $dMsg) {
	//USABILITY DATA RECORD//
	$usa_req_delta = (time() - $_SESSION['usa_req_delta_start']);
	$quStrRecordUSA = "INSERT INTO USA (SIDNUM, REQNUM, OP, DELTA, STATUS, MSG) VALUES ('" . $_SESSION['usa_sid_num'] . "', '" . $_SESSION['usa_req_num'] . "', '" . $_GET['op'] . "', '$usa_req_delta', '1', '$dMsg')";
	$quRecordUSA = mysqli_query($dbh, $quStrRecordUSA); 
	//usa end//
?>

<?php 
if ($dMsg == "E-1") { 
/* Redirect browser */
header("Location: http://bostonapartments.com/lacms/logout.php");
/* Make sure that code below does not get executed when we redirect. */
exit;
}
?>



<html>
<head>
<title>LACMS Error</title>
</head>
<body>
<center>
<br>
<br>
<br>
<table width="400" height="48" border="1" bordercolor="#FFFFFF" BGCOLOR="#FFFFFF">
<tr>
<td align="center" valign="middle">

<NOBR>I'm sorry... An Error has occured.</NOBR>
<br>
<NOBR>Please do not use back button or refresh button.</NOBR>
<br>

<hr size=1 noshad>

<b>Tech Support Code:</b> <?php echo $dMsg;?><br>
<P>
Message: <?php echo $code;?><br>
<P>
You need to <a href="http://bostonapartments.com/lacms/logout.php">log out</a> and log back in.<BR>
<P>
<NOBR>If this problem persists, please <A HREF="mailto:webmaster@bostonapartments.com">email BostonApartments.com</A></NOBR> <NOBR>with the details of how this error occurred.</NOBR>


</td>
</tr>
</table>
</body>
</html>
<?php
}


function prepareAdBody ($adString, $allowHTML) {
	if (!$allowHTML) {
 		$adString = strip_tags ($adString, '<b><i><br>');
	}
	$adString = str_replace("\n", " ", $adString);
	$adString = str_replace("\r", " ", $adString);
	$adString = str_replace("   ", " ", $adString);
	$adString = str_replace("  ", " ", $adString);
	$adString = str_replace("Type your ad here.", "", $adString);
	
	if (strpos($adString, "<b>") || strpos($adString, "<i>")) {
		$adString .= "</i></b>";
	}
	
	return $adString;
}

function getGroupInfo ($group) {
	$quStrGetGroupInfo = "SELECT * FROM `GROUP` INNER JOIN USERS ON `GROUP`.ADMIN=USERS.UID WHERE GRID=$group";
	$quGetGroupInfo = mysqli_query($dbh, $quStrGetGroupInfo);
	$quStrGetGroupCount = "SELECT count(CID) AS TOTALADS FROM CLASS WHERE CLI=$group";
	$quStrGetGroupActCount = "SELECT count(CID) AS TOTALACT FROM CLASS WHERE CLI=$group AND STATUS='ACT'";
	$quGetGroupCount = mysqli_query($dbh, $quStrGetGroupCount);
	$quGetGroupActCount = mysqli_query($dbh, $quStrGetGroupActCount);
	$rowGetGroupInfo = mysqli_fetch_object ($quGetGroupInfo);
	$rowGetGroupCount = mysqli_fetch_object($quGetGroupCount);
	$rowGetGroupActCount = mysqli_fetch_object($quGetGroupActCount);
	$thisInfo = array ("name" => $rowGetGroupInfo->NAME,
			"admin" => $rowGetGroupInfo->HANDLE,
			"total" => $rowGetGroupCount->TOTALADS,
			"active" =>$rowGetGroupActCount->TOTALACT,
			"limit" => $rowGetGroupInfo->MAXACT);
	return $thisInfo;
}


function session_default_get_var ($session_var, $stringVarName, $default) {
	if (!$HTTP_GET_VARS[$stringVarName]) {
		if (!$session_var) {
			$session_var = $default;
		}
	} else {
		$session_var = $HTTP_GET_VARS[$stringVarName];
	}
}


function session_default_get_var_not_null ($session_var, $stringVarName, $default, $null_char) {
	if (!$HTTP_GET_VARS[$stringVarName]) {
		if (!$session_var && $session_var !== 0) {
			$session_var = $default;
		}
		
	} else {
		$session_var = $HTTP_GET_VARS[$stringVarName];
		if ($session_var == $null_char) {
			$session_var = $default;
		}
	}
}

function error_ip ($eusr) { ?>
<h1>Access Denied</h1>
<h3>Sorry,  <?php echo $eusr;?>, you are not authorized to login from your current location.  You must go in to the office or speak to your administrator.</h2>
<h4><i><?php echo date ("F j, Y, g:i a"); ?> Bostonapartments.com Agency Database $group login system.</i></h4>

<?php }


function make_map ($rowGetAd) {
	$quStrGetMap = "select * from MAP_OFFER where id='$rowGetAd->MAP'";
	$quGetMap = mysqli_query($dbh, $quStrGetMap) or die (mysqli_error($dbh));
	$rowMapDetails = mysqli_fetch_object($quGetMap);
	
	$url = $rowMapDetails->url;
	$args = $rowMapDetails->args;
	$args = split (",", $args);
	foreach ($args as $arg) {
		$arg = split ("=", $arg);
		$var = $arg[0];
		$val = $arg[1];
		$val_str = "";
		if (strpos($val, "^") == 0) {
			$val = split ("\^", $val);
			foreach ($val as $va) {
				if ($va=="zip") {
					$val_str .= "+$rowGetAd->ZIP";
				}elseif ($va=="street_num") {
					$val_str .= "+$rowGetAd->STREET_NUM";
				}elseif ($va=="street") {
					$val_str .= "+$rowGetAd->STREET";
				}elseif ($va=="city") {
					$val_str .= "+$rowGetAd->CITY";
				}elseif ($va=="xstreet") {
					$val_str .= "+$rowGetAd->xstreet";
				}elseif ($va=="intersection") {
					$val_str .= "+$rowGetAd->STREET at $rowGetAd->xstreet";
				}
			}
		}else {
			$val_str = $val;
		}
		$arg_str .= "$var=$val_str&";
	}
	$url .= "?$arg_str";
	$link = "<a href=\"$url\" target=\"new\"><IMG SRC='https://www.BostonApartments.com/images/map.gif' BORDER='0' height='12' width='48'></a>";
	return $link;
}
					


function make_map_email ($rowGetAd) {
	$quStrGetMap = "select * from MAP_OFFER where id='$rowGetAd->MAP'";
	$quGetMap = mysqli_query($dbh, $quStrGetMap) or die (mysqli_error($dbh));
	$rowMapDetails = mysqli_fetch_object($quGetMap);
	
	$url = $rowMapDetails->url;
	$args = $rowMapDetails->args;
	$args = split (",", $args);
	foreach ($args as $arg) {
		$arg = split ("=", $arg);
		$var = $arg[0];
		$val = $arg[1];
		$val_str = "";
		if (strpos($val, "^") == 0) {
			$val = split ("\^", $val);
			foreach ($val as $va) {
				if ($va=="zip") {
					$val_str .= "+$rowGetAd->ZIP";
				}elseif ($va=="street_num") {
					$val_str .= "+$rowGetAd->STREET_NUM";
				}elseif ($va=="street") {
					$val_str .= "+$rowGetAd->STREET";
				}elseif ($va=="city") {
					$val_str .= "+$rowGetAd->CITY";
				}elseif ($va=="xstreet") {
					$val_str .= "+$rowGetAd->xstreet";
				}elseif ($va=="intersection") {
					$val_str .= "+$rowGetAd->STREET at $rowGetAd->xstreet";
				}
			}
		}else {
			$val_str = $val;
		}
		$arg_str .= "$var=$val_str&";
	}
	$url .= "?$arg_str";
	$link = "<BR>Map Link: <A HREF=\"$url\">$url</A><BR>";
	return $link;
}




function features ($thisRowGetAds, $DEFINED_VALUE_SETS) {

	$pets = ($thisRowGetAds->PETSA) ? $thisDEFINED_VALUE_SETS['PETSA'][$thisRowGetAds->PETSA] . " - " : "";

	$parkingnum = ($thisRowGetAds->PARKING_NUM) ? $thisDEFINED_VALUE_SETS['PARKING_NUM'][$thisRowGetAds->PARKING_NUM] . " " : "";

	$parkingtype = ($thisRowGetAds->PARKING_TYPE) ? $thisDEFINED_VALUE_SETS['PARKING_TYPE'][$thisRowGetAds->PARKING_TYPE] . " parking " : "";

	$parkingcost = ($thisRowGetAds->PARKING_COST) ? $thisDEFINED_VALUE_SETS['PARKING_COST'][$thisRowGetAds->PARKING_COST] . "\$$thisRowGetAds->PARKING_COST." : "";

	$laundry = ($thisRowGetAds->LAUNDRY_ROOM) ? $thisDEFINED_VALUE_SETS['LAUNDRY_ROOM'][$thisRowGetAds->LAUNDRY_ROOM] . " - " : "";

	if ($thisRowGetAds->AUTO_WRITE) {
		$features_array['FEATURES_DELEADED']		= $thisRowGetAds->FEATURES_DELEADED          ;
		$features_array['FEATURES_FURNISHED']           = $thisRowGetAds->FEATURES_FURNISHED         ;
		$features_array['FEATURES_NON_SMOKING']         = $thisRowGetAds->FEATURES_NON_SMOKING       ;
		$features_array['FEATURES_ALARM']               = $thisRowGetAds->FEATURES_ALARM             ;
		$features_array['FEATURES_HEAT']                = $thisRowGetAds->FEATURES_HEAT              ;
		$features_array['FEATURES_HOT_WATER']           = $thisRowGetAds->FEATURES_HOT_WATER         ;
		$features_array['FEATURES_HT_AND_HW']           = $thisRowGetAds->FEATURES_HT_AND_HW         ;
		$features_array['FEATURES_ELECTRICITY']           = $thisRowGetAds->FEATURES_ELECTRICITY         ;
		$features_array['FEATURES_ALL_UTILITIES']       = $thisRowGetAds->FEATURES_ALL_UTILITIES     ;
		$features_array['FEATURES_GAS_HEAT']            = $thisRowGetAds->FEATURES_GAS_HEAT          ;
		$features_array['FEATURES_OIL_HEAT']            = $thisRowGetAds->FEATURES_OIL_HEAT          ;
		$features_array['FEATURES_ELEC_HEAT']           = $thisRowGetAds->FEATURES_ELEC_HEAT         ;
		$features_array['FEATURES_HWFI']                = $thisRowGetAds->FEATURES_HWFI              ;
		$features_array['FEATURES_FIREPLACE_WORKING']   = $thisRowGetAds->FEATURES_FIREPLACE_WORKING ;
		$features_array['FEATURES_FIREPLACE_DECOR']     = $thisRowGetAds->FEATURES_FIREPLACE_DECOR   ;
		$features_array['FEATURES_CARPET']              = $thisRowGetAds->FEATURES_CARPET            ;
		$features_array['FEATURES_MODERN_KITCHEN']      = $thisRowGetAds->FEATURES_MODERN_KITCHEN    ;
		$features_array['FEATURES_KITCHEN_GALLEY']      = $thisRowGetAds->FEATURES_KITCHEN_GALLEY    ;
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
		$features_array['FEATURES_CABLETV']              = $thisRowGetAds->FEATURES_CABLETV            ;
		$features_array['FEATURES_STAINLESS']              = $thisRowGetAds->FEATURES_STAINLESS            ;
		$features_array['FEATURES_GRANITEC']              = $thisRowGetAds->FEATURES_GRANITEC            ;
		$features_array['FEATURES_BAYWINDOWS']              = $thisRowGetAds->FEATURES_BAYWINDOWS            ;
		$features_array['FEATURES_INTERCOM']              = $thisRowGetAds->FEATURES_INTERCOM            ;
		$features_array['FEATURES_CEILINGFAN']              = $thisRowGetAds->FEATURES_CEILINGFAN            ;

		
		foreach ($features_array as $name => $value) {
			if ($value) {
				$feature_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$feature_string .= " - ";
			}
		}
		if ($feature_string) {
			$feature_string = " <strong>Features:</strong> " . $feature_string;
		}
		
				
		$amenities_array['AMENITIES_CONCIEARGE']         = $thisRowGetAds->AMENITIES_CONCIEARGE       ;
		$amenities_array['AMENITIES_ELEVATOR']           = $thisRowGetAds->AMENITIES_ELEVATOR         ;
		$amenities_array['AMENITIES_DECK']               = $thisRowGetAds->AMENITIES_DECK             ;
		$amenities_array['AMENITIES_ROOF_DECK']          = $thisRowGetAds->AMENITIES_ROOF_DECK        ;
		$amenities_array['AMENITIES_GARDEN']             = $thisRowGetAds->AMENITIES_GARDEN           ;
		$amenities_array['AMENITIES_YARD']               = $thisRowGetAds->AMENITIES_YARD             ;
		$amenities_array['AMENITIES_SECURITY']           = $thisRowGetAds->AMENITIES_SECURITY         ;
		$amenities_array['AMENITIES_BUSINESSCENTER']        = $thisRowGetAds->AMENITIES_BUSINESSCENTER      ;
		$amenities_array['AMENITIES_CLLUBHOUSE']        = $thisRowGetAds->AMENITIES_CLUBHOUSE      ;
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
		$amenities_array['AMENITIES_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_NOT_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_NOT_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_WHEELCHAIR'] = $thisRowGetAds->AMENITIES_WHEELCHAIR   ;
		$amenities_array['AMENITIES_SUBWAY']              = $thisRowGetAds->AMENITIES_SUBWAY            ;
		$amenities_array['AMENITIES_CRAIL']              = $thisRowGetAds->AMENITIES_CRAIL            ;
		$amenities_array['AMENITIES_BUS']              = $thisRowGetAds->AMENITIES_BUS            ;
		$amenities_array['AMENITIES_SHUTTLE']              = $thisRowGetAds->AMENITIES_SHUTTLE            ;
		$amenities_array['AMENITIES_BIKEROOM']         = $thisRowGetAds->AMENITIES_BIKEROOM       ;
		$amenities_array['AMENITIES_PLAYGROUND']         = $thisRowGetAds->AMENITIES_PLAYGROUND       ;
		$amenities_array['AMENITIES_BASKETBALL']         = $thisRowGetAds->AMENITIES_BASKETBALL       ;
		$amenities_array['AMENITIES_BBQ']         = $thisRowGetAds->AMENITIES_BBQ       ;
		$amenities_array['AMENITIES_ZIPCAR']         = $thisRowGetAds->AMENITIES_ZIPCAR       ;
		
		
		foreach ($amenities_array as $name => $value) {
			if ($value) {
				$amenity_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$amenity_string .= " - ";
			}
		}
		
		if ($amenity_string) {
			$amenity_string = " <strong>Amenities:</strong> " . $amenity_string;
		}
	}
		
	$adString =  "$feature_string $amenity_string $laundry $pets $parkingnum$parkingtype $parkingcost";
	return $adString;
}




function Avail ($thisRowGetAds) {
	$nowYYYYMMDD = date ("Ymd");

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
	
	return $avail;
}






function get_thumb ($thisRowGetAds)
{
   if (is_file("/www/pics/$thisRowGetAds->THUMBNAIL"))
   //if($thisRowGetAds->THUMBNAIL)
   {
      $rowGetPics="<a href=\"https://www.BostonApartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$thisRowGetAds->CID$agenteml\"><img border=0 src='https://www.BostonApartments.com/pics/$thisRowGetAds->THUMBNAIL' width='125' alt='$rowGetPics->DESCRIPT'></a><br>";
   } else {
      $quStrGetPics = "SELECT * FROM PICTURE WHERE CID=$thisRowGetAds->CID ORDER BY PID LIMIT 1";
      $quGetPics = mysqli_query($dbh, $quStrGetPics);
      if($rowGetPics = mysqli_fetch_object($quGetPics))
      {
         $rowGetPics="<a href=\"https://www.BostonApartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$thisRowGetAds->CID$agenteml\"><img border=0 src='https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT' width='125' alt='$rowGetPics->DESCRIPT'></a><br>"; 
      }
   }
   
   if ($thisRowGetAds->EXTERNALPIC) {
            $rowGetPics="<a href=\"https://www.BostonApartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$thisRowGetAds->CID$agenteml\"><img border=0 src='$thisRowGetAds->EXTERNALPIC' width='125' height='125' alt='$rowGetPics->DESCRIPT'></a><br>"; 
   }
   
   return $rowGetPics;
}


function get_thumb_pic ($thisRowGetAds)
{
   if (is_file("/www/pics/$thisRowGetAds->THUMBNAIL"))
   //if($thisRowGetAds->THUMBNAIL)
{


      $quStrGetPics = "SELECT * FROM PICTURE WHERE CID=$thisRowGetAds->CID ORDER BY PID LIMIT 1";
      $quGetPics = mysqli_query($dbh, $quStrGetPics);
      if($rowGetPics = mysqli_fetch_object($quGetPics))
      {
         $rowGetPics="https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT"; 
      }
   }
 else {


      $quStrGetPics = "SELECT * FROM PICTURE WHERE CID=$thisRowGetAds->CID ORDER BY PID LIMIT 1";
      $quGetPics = mysqli_query($dbh, $quStrGetPics);
      if($rowGetPics = mysqli_fetch_object($quGetPics))
      {
         $rowGetPics="https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT"; 
      }
   }
   
      if ($thisRowGetAds->EXTERNALPIC) {
            $rowGetPics="<a href=\"https://www.BostonApartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$thisRowGetAds->CID\" rel=\"gb_page_fs[]\"><img border=0 src='$thisRowGetAds->EXTERNALPIC' width='125' height='125' alt='$rowGetPics->DESCRIPT'></a><br>"; 
   }
   
   return $rowGetPics;
}




function icons ($thisRowGetAds) {
	$nowYYYYMMDD = date ("Ymd");
	$adDateIn = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->DATEIN)));
	$adDateMod = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->MOD)));
	if (!$thisRowGetAds->TRANSIN) {
		$isNewLog = (($adDateIn < 2) || ($adDateMod < 2)) ? 1 : 0;
	}
	$isNew = ($isNewLog) ? "<img src='https://www.BostonApartments.com/images/newIcon.gif'>" : "";
	$hasPics = ($thisRowGetAds->PIC) ? "<a href=\"https://www.BostonApartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$thisRowGetAds->CID\" target=\"blank\"><img border='0' width='22' height='12' src='https://www.BostonApartments.com/images/pic.gif'></a>" : "";

	$hasExternalPics = ($thisRowGetAds->EXTERNALPIC) ? "<A HREF=\"https://www.BostonApartments.com/homepage-MLS.php?cli=1075&ad=$thisRowGetAds->CID\"><img border='0' width='22' height='12' src='https://www.BostonApartments.com/images/pic.gif'></a>" : "";

	$hasVirtualTour = ($thisRowGetAds->VIRT_TOUR) ? "<a href=\"$thisRowGetAds->VIRT_TOUR\" target=\"blank\"><img border='0' width='59' height='11' src='https://www.BostonApartments.com/images/virtualtour.gif'></a>" : "";

	$hasYouTubeURL = ($thisRowGetAds->YOUTUBEURL) ? "<a href=\"$thisRowGetAds->YOUTUBEURL\" target=\"blank\"><img src='https://www.BostonApartments.com/images/youtube.gif' border=\"0\"></a>" : "";

	//MAP MAKER//
	if ($thisRowGetAds->MAP) {
		$map_link = make_map($thisRowGetAds);
	}

	$icons =  "$hasPics $hasExternalPics $hasVirtualTour $hasYouTubeURL $map_link $isNew";
	return $icons;
}



function keys ($thisRowGetAds, $thisDEFINED_VALUE_SETS) {

	$keys = ($thisRowGetAds->KEY_INFO) ? $thisDEFINED_VALUE_SETS['KEY_INFO'][$thisRowGetAds->KEY_INFO] . " " : "";

   return $keys;

}


function fee ($thisRowGetAds, $thisDEFINED_VALUE_SETS) {

if ($thisRowGetAds->FEE!='3' AND $thisRowGetAds->FEE!='8') {

	$fee = ($thisRowGetAds->FEE) ? $thisDEFINED_VALUE_SETS['FEE'][$thisRowGetAds->FEE] . " " : "";

	}
	
   return $fee;

}




function sig ($thisRowGetAds) {
	$sig = ($thisRowGetAds->ALTSIG) ? "$thisRowGetAds->ALTSIG" : "$thisRowGetAds->SIG";
	return $sig;
}



function format_ad_cl ($thisRowGetAds, $thisDEFINED_VALUE_SETS) {
	$nowYYYYMMDD = date ("Ymd");
	$adDateIn = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->DATEIN)));
	$adDateMod = ($nowYYYYMMDD - (str_replace ("-", "", $thisRowGetAds->MOD)));
	if (!$thisRowGetAds->TRANSIN) {
		$isNewLog = (($adDateIn < 2) || ($adDateMod < 2)) ? 1 : 0;
	}
	$isNew = ($isNewLog) ? "<img src='https://www.BostonApartments.com/images/newIcon.gif'>" : "";

	$hasExternalPics = ($thisRowGetAds->EXTERNALPIC) ? "<A HREF=\"https://www.BostonApartments.com/homepage-MLS.php?cli=1075&ad=$thisRowGetAds->CID\"><img border='0' width='22' height='12' src='https://www.BostonApartments.com/images/pic.gif'></a>" : "";

	$hasVirtualTour = ($thisRowGetAds->VIRT_TOUR) ? "<a href=\"$thisRowGetAds->VIRT_TOUR\" target=\"blank\"><img border='0' width='59' height='11' src='https://www.BostonApartments.com/images/virtualtour.gif'></a>" : "";


	$hasYouTubeURL = ($thisRowGetAds->YOUTUBEURL) ? "<a href=\"$thisRowGetAds->YOUTUBEURL\" target=\"blank\"><img src='https://www.BostonApartments.com/images/youtube.gif' border=\"0\"></a>" : "";
	if ($thisRowGetAds->NOFEE==3 || $thisRowGetAds->NOFEE==8 || $thisRowGetAds->NOFEE==9) {
		$noFee = "";
	}else {
		$noFee = ($thisRowGetAds->NOFEE) ? "<font color='red'><b>" . $thisDEFINED_VALUE_SETS['NOFEE'][$thisRowGetAds->NOFEE] . "</b></font> " : "";
	}


	if ($thisRowGetAds->STATUS_SALE==0) {
		$status_sale = "";
	}else {
		$status_sale = ($thisRowGetAds->STATUS_SALE) ? "<font color='red'><b>" . $thisDEFINED_VALUE_SETS['STATUS_SALE'][$thisRowGetAds->STATUS_SALE] . "</b></font> - " : "";
	}


	$signature = ($thisRowGetAds->ALTSIG) ? "$thisRowGetAds->ALTSIG" : "$thisRowGetAds->SIG";
	$avail = ($thisRowGetAds->AVAIL !== "0000-00-00") ? " Available: $thisRowGetAds->AVAIL " : "";
	if ($thisRowGetAds->AVAIL == "0000-00-00") {
		$avail = "";	
	}else {
		
		$today = date ("Ymd");
		$avail_all = str_replace ("-", "", $thisRowGetAds->AVAIL);
		if (($today - $avail_all) >= 0) {


if ($thisRowGetAds->PRICE !="0"){
$avail = " Available:<B> Now</B>. ";
} else {
$avail = "<BR>Available:<B> Now</B>. ";
}




}else {
			$avail_year = substr ($thisRowGetAds->AVAIL, 2,2);
			$avail_month = substr ($thisRowGetAds->AVAIL, 5,2);
			$avail_day = substr ($thisRowGetAds->AVAIL, 8,2);


if ($thisRowGetAds->PRICE !="0"){
$avail = " Available: <B> $avail_month/$avail_day/$avail_year</B>. ";
} else {
$avail = "<BR>Available: <B> $avail_month/$avail_day/$avail_year</B>. ";
}


		}
	}
	

	$rooms = ($thisRowGetAds->ROOMS !="0.00") ? $thisDEFINED_VALUE_SETS['ROOMS'][$thisRowGetAds->ROOMS] . " - " : "";
	$baths = ($thisRowGetAds->BATH !="0.00") ? $thisDEFINED_VALUE_SETS['BATH'][$thisRowGetAds->BATH] . " " : "";

	$pets = ($thisRowGetAds->PETSA !="0.00") ? $thisDEFINED_VALUE_SETS['PETSA'][$thisRowGetAds->PETSA] . " - " : "";

	$parkingnum = ($thisRowGetAds->PARKING_NUM) ? $thisDEFINED_VALUE_SETS['PARKING_NUM'][$thisRowGetAds->PARKING_NUM] . " parking " : "";

	$parkingtype = ($thisRowGetAds->PARKING_TYPE) ? $thisDEFINED_VALUE_SETS['PARKING_TYPE'][$thisRowGetAds->PARKING_TYPE] . " " : "";

	$parkingcost = ($thisRowGetAds->PARKING_COST) ? $thisDEFINED_VALUE_SETS['PARKING_COST'][$thisRowGetAds->PARKING_COST] . "\$$thisRowGetAds->PARKING_COST." : "";


	$laundry = ($thisRowGetAds->LAUNDRY_ROOM) ? $thisDEFINED_VALUE_SETS['LAUNDRY_ROOM'][$thisRowGetAds->LAUNDRY_ROOM] . " - " : "";

	$floor = ($thisRowGetAds->FLOOR) ? $thisDEFINED_VALUE_SETS['FLOOR'][$thisRowGetAds->FLOOR] . "Floor#: $thisRowGetAds->FLOOR" : "";


	if ($thisRowGetAds->AUTO_WRITE) {
		$features_array['FEATURES_DELEADED']		= $thisRowGetAds->FEATURES_DELEADED          ;
		$features_array['FEATURES_FURNISHED']           = $thisRowGetAds->FEATURES_FURNISHED         ;
		$features_array['FEATURES_NON_SMOKING']         = $thisRowGetAds->FEATURES_NON_SMOKING       ;
		$features_array['FEATURES_ALARM']               = $thisRowGetAds->FEATURES_ALARM             ;
		$features_array['FEATURES_HEAT']                = $thisRowGetAds->FEATURES_HEAT              ;
		$features_array['FEATURES_HOT_WATER']           = $thisRowGetAds->FEATURES_HOT_WATER         ;
		$features_array['FEATURES_HT_AND_HW']           = $thisRowGetAds->FEATURES_HT_AND_HW         ;
		$features_array['FEATURES_ALL_UTILITIES']       = $thisRowGetAds->FEATURES_ALL_UTILITIES     ;
		$features_array['FEATURES_ELECTRICITY']       = $thisRowGetAds->FEATURES_ELECTRICITY     ;
		$features_array['FEATURES_GAS_HEAT']            = $thisRowGetAds->FEATURES_GAS_HEAT          ;
		$features_array['FEATURES_OIL_HEAT']            = $thisRowGetAds->FEATURES_OIL_HEAT          ;
		$features_array['FEATURES_ELEC_HEAT']           = $thisRowGetAds->FEATURES_ELEC_HEAT         ;
		$features_array['FEATURES_HWFI']                = $thisRowGetAds->FEATURES_HWFI              ;
		$features_array['FEATURES_FIREPLACE_WORKING']   = $thisRowGetAds->FEATURES_FIREPLACE_WORKING ;
		$features_array['FEATURES_FIREPLACE_DECOR']     = $thisRowGetAds->FEATURES_FIREPLACE_DECOR   ;
		$features_array['FEATURES_CARPET']              = $thisRowGetAds->FEATURES_CARPET            ;
		$features_array['FEATURES_MODERN_KITCHEN']      = $thisRowGetAds->FEATURES_MODERN_KITCHEN    ;
		$features_array['FEATURES_KITCHEN_GALLEY']      = $thisRowGetAds->FEATURES_KITCHEN_GALLEY    ;
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
		$features_array['FEATURES_CABLETV']              = $thisRowGetAds->FEATURES_CABLETV            ;
		$features_array['FEATURES_STAINLESS']              = $thisRowGetAds->FEATURES_STAINLESS            ;
		$features_array['FEATURES_GRANITEC']              = $thisRowGetAds->FEATURES_GRANITEC            ;
		$features_array['FEATURES_BAYWINDOWS']              = $thisRowGetAds->FEATURES_BAYWINDOWS            ;
		$features_array['FEATURES_INTERCOM']              = $thisRowGetAds->FEATURES_INTERCOM            ;
		$features_array['FEATURES_CEILINGFAN']              = $thisRowGetAds->FEATURES_CEILINGFAN            ;


		foreach ($features_array as $name => $value) {
			if ($value) {
				$feature_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$feature_string .= " - ";
			}
		}
		if ($feature_string) {
			$feature_string = "<BR><strong>Features:<BR></strong> " . $feature_string."<BR>";
		}


		$amenities_array['AMENITIES_CONCIEARGE']         = $thisRowGetAds->AMENITIES_CONCIEARGE       ;
		$amenities_array['AMENITIES_ELEVATOR']           = $thisRowGetAds->AMENITIES_ELEVATOR         ;
		$amenities_array['AMENITIES_DECK']               = $thisRowGetAds->AMENITIES_DECK             ;
		$amenities_array['AMENITIES_ROOF_DECK']          = $thisRowGetAds->AMENITIES_ROOF_DECK        ;
		$amenities_array['AMENITIES_GARDEN']             = $thisRowGetAds->AMENITIES_GARDEN           ;
		$amenities_array['AMENITIES_YARD']               = $thisRowGetAds->AMENITIES_YARD             ;
		$amenities_array['AMENITIES_SECURITY']           = $thisRowGetAds->AMENITIES_SECURITY         ;
		$amenities_array['AMENITIES_BUSINESSCENTER']        = $thisRowGetAds->AMENITIES_BUSINESSCENTER      ;
		$amenities_array['AMENITIES_CLUBHOUSE']        = $thisRowGetAds->AMENITIES_CLUBHOUSE      ;
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
		$amenities_array['AMENITIES_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_NOT_OWNER_OCCUPIED'] = $thisRowGetAds->AMENITIES_NOT_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_WHEELCHAIR'] = $thisRowGetAds->AMENITIES_WHEELCHAIR   ;
		$amenities_array['AMENITIES_SUBWAY']              = $thisRowGetAds->AMENITIES_SUBWAY            ;
		$amenities_array['AMENITIES_CRAIL']              = $thisRowGetAds->AMENITIES_CRAIL            ;
		$amenities_array['AMENITIES_BUS']              = $thisRowGetAds->AMENITIES_BUS            ;
		$amenities_array['AMENITIES_SHUTTLE']              = $thisRowGetAds->AMENITIES_SHUTTLE            ;		
		$amenities_array['AMENITIES_BIKEROOM']         = $thisRowGetAds->AMENITIES_BIKEROOM       ;
		$amenities_array['AMENITIES_PLAYGROUND']         = $thisRowGetAds->AMENITIES_PLAYGROUND       ;
		$amenities_array['AMENITIES_BASKETBALL']         = $thisRowGetAds->AMENITIES_BASKETBALL       ;
		$amenities_array['AMENITIES_BBQ']         = $thisRowGetAds->AMENITIES_BBQ       ;
		$amenities_array['AMENITIES_ZIPCAR']         = $thisRowGetAds->AMENITIES_ZIPCAR       ;

		
		foreach ($amenities_array as $name => $value) {
			if ($value) {
				$amenity_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$amenity_string .= " - ";
			}
		}
		
		if ($amenity_string) {
			$amenity_string = " <strong>Amenities:<BR></strong> " . $amenity_string;
		}
	}
		
		
		
	//MAP MAKER//
	if ($thisRowGetAds->MAP) {
		$map_link = "";
	}
	
        if($thisRowGetAds->AGENCY_HEADERS)
        {
                $strAgency="SELECT * FROM AGENCIES WHERE AGENCY_ID=$thisRowGetAds->AGENCY_HEADERS";
                $quAgency = mysqli_query($dbh, $strAgency);
                if($rowAgency=mysqli_fetch_object($quAgency))
                {
                        $agency_sig=$rowAgency->CUSTOM_SIGNATURE;
			$signature=$agency_sig;
                }
        }

if ($thisRowGetAds->ASSESSMENT !="0.00"){
$assessment =  ($thisRowGetAds->ASSESSMENT) ? "<BR><B>Assessed Value:</B> \$".$thisRowGetAds->ASSESSMENT : "";} else {$assessment = "";}

if ($thisRowGetAds->PROPERTYTAX !="0.00"){
$propertytax =  ($thisRowGetAds->PROPERTYTAX) ? "<BR><B>Property Tax:</B> \$".$thisRowGetAds->PROPERTYTAX : "";} else {$propertytax = "";}

if ($thisRowGetAds->CONDO_FEES !="0.00"){
$condofee =  ($thisRowGetAds->CONDO_FEES) ? "<BR><B>Condo Fee:</B> \$".$thisRowGetAds->CONDO_FEES : "";} else {$condofee = "";}

if ($thisRowGetAds->PRICE !="0"){
$priceprefix = "<BR>Price:<B> ";
$pricesuffix = "</B> ";
} else {
$priceprefix = "";
$pricesuffix = "";
}



if ($thisRowGetAds->TOTAL_NUM_ROOMS =="1"){
$totalrooms =  ($thisRowGetAds->TOTAL_NUM_ROOMS) ? " - ".$thisRowGetAds->TOTAL_NUM_ROOMS." Room " : "";
} elseif (($thisRowGetAds->TOTAL_NUM_ROOMS !="0") AND ($thisRowGetAds->TOTAL_NUM_ROOMS !="1")){
$totalrooms =  ($thisRowGetAds->TOTAL_NUM_ROOMS) ? " - ".$thisRowGetAds->TOTAL_NUM_ROOMS." Rooms" : "";} else {$totalrooms = "";}

if ($thisRowGetAds->SQFT !="0"){
$sqft =  ($thisRowGetAds->SQFT) ? " - ".$thisRowGetAds->SQFT." SqFt." : "";} else {$sqft = "";}




$buildingtype = ($thisRowGetAds->BUILDING_TYPE) ? $thisDEFINED_VALUE_SETS['BUILDING_TYPE'][$thisRowGetAds->BUILDING_TYPE] . " " : "";
$buildingstyle = ($thisRowGetAds->BUILDING_STYLE) ? $thisDEFINED_VALUE_SETS['BUILDING_STYLE'][$thisRowGetAds->BUILDING_STYLE] . " " : "";


	
	$priceFormat = number_format ($thisRowGetAds->PRICE);
	$price =  ($thisRowGetAds->PRICE) ? " \$$priceFormat " : ""; 
	$price_sqft = ($thisRowGetAds->PRICE_SQFT) ? " $" .(number_format($thisRowGetAds->PRICE_SQFT)) . "/sqft ": "";
	$user_sig = ($thisRowGetAds->USE_USER_SIG) ? " $thisRowGetAds->USER_SIG " : "";
	$refNum = "$thisRowGetAds->ABV-$thisRowGetAds->CID";
	$adString =  "<HR>\n<B>$thisRowGetAds->LOCNAME - $noFee$status_sale</B> $priceprefix$price$pricesuffix $avail<BR>$rooms$baths$totalrooms$sqft $floor $buildingstyle $buildingtype <BR><BR>$thisRowGetAds->BODY $feature_string $amenity_string$laundry $pets $parkingnum$parkingtype $parkingcost<BR>$price_sqft  $condofee $assessment $propertytax<BR>$user_sig Listing#$refNum 
$hasExternalPics $isNew<BR><BR>\n$signature<!-- CID $thisRowGetAds->CID --></b></b><BR>\n\n";
	return $adString;
}


?>