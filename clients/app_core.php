<?php
date_default_timezone_set('America/Adak');

/*///////////////////////////////////////////////////////////////////////////
//bstapts client interface core 3.0 Copyright 1995-2014 BostonApartments.com //
//////////////////////////////////////////////////////////////////////////*/
session_start();

$uid = $_SESSION["uid"];
$grid = $_SESSION["grid"];
$_SESSION["user_level"] = $_SESSION["user_level"];
$HTTP_COOKIE_VARS = &$_COOKIE;
$availFilter;
$now = date("Ymd");

//DEFAULT OP VALUE//
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "home";
}

//REQUIRE PROPER SESSION//
if (!$_SESSION["handle"]) {
    die(dieNice("You are not correctly logged in or have been logged out.  Please click <a href=\"../\">here</a> to login.", "E-1"));
}

//USABILITY DATA RECORD//

$usa_req_num = $_SESSION["usa_req_num"];
$usa_sid_num = $_SESSION["usa_sid_num"];
$usa_req_delta = (time() - $_SESSION["usa_req_delta_start"]);
$quStrRecordUSA = "INSERT INTO USA (SIDNUM, REQNUM, OP, DELTA, STATUS, MSG) VALUES ('$usa_sid_num', '$usa_req_num', '$op', '$usa_req_delta', '0', '')";
$quRecordUSA = mysqli_query($dbh, $quStrRecordUSA);
//usa end//

$needOptions = false;
//$dontPrintHeader = $_GET['dontPrintHeader'];
//$scroll_return = $_GET['scroll_return'];
//$modby = $_GET['modby'];
//
//session_register ("groupFilterIsSet");
//session_register ("groupFilter");
//session_register ("sort");
//session_register ("sortD");
//session_register ("typeFilter");
//session_register ("app");
//session_register ("start");
//session_register ("limitN");
//session_register ("LLstart");
//session_register ("LLlimitN");
//session_register ("userFilter");
//session_register ("activeFilter");
//session_register ("availFilter");
//session_register ("vid");
//session_register ("WHERE");
//session_register ("listing_filter_display");
//session_register ("return_page");
//session_register ("return_page_rid");
//session_register ("return_page_rid2");
//session_register ("return_page_scroll");
//session_register ("hot_list_cat");
//session_register ("show_hot_list");
//session_register ("return_page_div");
//session_register ("modby");

//$_SESSION ["groupFilterIsSet"] = $groupFilterIsSet;
//$groupFilter = $_SESSION['groupFilter'];
// $_SESSION ['sort'] = $sort;
//$sortD = $_SESSION ["sortD"];
//$typeFilter = $_SESSION ["typeFilter"];
//$app = $_SESSION ["app"];
//$start = $_SESSION ["start"];
//$limitN = $_SESSION ["limitN"];
//$LLstart = $_SESSION ["LLstart"];
//$LLlimitN = $_SESSION ["LLlimitN"];
//$userFilter = $_SESSION ["userFilter"];
//$activeFilter = $_SESSION ["activeFilter"];
//$availFilter = $_SESSION ["availFilter"];
//$vid = $_SESSION ["vid"];
//$WHERE = $_SESSION ["WHERE"];
//$listing_filter_display = $_SESSION ["listing_filter_display"];
//$return_page = $_SESSION ["return_page"];
//$return_page_rid = $_SESSION ["return_page_rid"];
//$return_page_rid2 = $_SESSION ["return_page_rid2"];
//$return_page_scroll = $_SESSION ["return_page_scroll"];
//$hot_list_cat = $_SESSION ["hot_list_cat"];
// $_SESSION ["show_hot_list"] = $show_hot_list;
//$return_page_div = $_SESSION ["return_page_div"];
//$modby = $_SESSION ["modby"];

//DEFAULT SESSION VALUES//

//$HTTP_GET_VARS = &$_GET;
if (!isset($_GET['app'])) {

    $app = "home";

} else {
    $app = $_GET['app'];
}

if (!isset($_GET['typeFilter'])) {

    $typeFilter = 1;

} else {
    $typeFilter = $_GET['typeFilter'];
}

if (!isset($_GET['limitN'])) {

    $limitN = $_SESSION["user_num_ads"];

} else {
    $limitN = $_GET['limitN'];
}

if (!isset($_GET['start'])) {
    if (isset($_GET['start']) == "z") {
        $start = 0;
    } elseif (!isset($_GET['start'])) {
        $start = 0;
    }
} else {
    $start = $_GET['start'];
    if ($start == "z") {
        $start = 0;
    }
}

if (!isset($_GET['LLlimitN'])) {

    $LLlimitN = $_SESSION["user_num_ads"];

} else {
    $LLlimitN = $_GET['LLlimitN'];
}

if (!isset($_GET['LLstart'])) {
    if (isset($_GET['LLstart']) == "z") {
        $LLstart = 0;
    } elseif (!isset($_GET['LLstart'])) {
        $LLstart = 0;
    }
} else {
    $LLstart = $_GET['LLstart'];
    if ($LLstart == "z") {
        $LLstart = 0;
    }
}

if (!isset($_GET['userFilter'])) {
    if (isset($_GET['userFilter']) == "n") {
        $userFilter = false;
    } elseif (!isset($_GET['userFilter'])) {
        $userFilter = false;
    }
} else {
    $userFilter = $_GET['userFilter'];
    if ($userFilter == "n") {
        $userFilter = false;
    }
}

if (!isset($_GET['activeFilter'])) {
    if (isset($_GET['activeFilter']) == "n") {
        $activeFilter = false;
    } elseif (!isset($_GET['activeFilter'])) {
        $activeFilter = false;
    }
} else {
    $activeFilter = $_GET['activeFilter'];
    if ($activeFilter == "n") {
        $activeFilter = false;
    }
}

if (!isset($_GET['availFilter'])) {
    if (isset($_GET['availFilter']) == "n") {
        $availFilter = false;
    } elseif (!isset($_GET['$availFilter'])) {
        $availFilter = false;
    }
} else {
    $availFilter = $_GET['availFilter'];
    if ($availFilter == "n") {
        $availFilter = false;
    }
}

if (!isset($_GET['vid'])) {
    //if (!$vid) { //Commented by Barkha
    $vid = 1; //$default_vid;
    //}
} else {
    $vid = $_GET['vid'];
}
if (!isset($_GET['listing_filter_display'])) {
    $listing_filter_display = "none";
} else {
    if ($_GET['listing_filter_display']) {
        $listing_filter_display = $_GET['listing_filter_display'];
    }
}

if (isset($_GET['return_page'])) {
    if ($_GET['return_page'] == 'sel' || $_GET['return_page'] == 'listings' || $_GET['return_page'] == 'editLandlord' || $_GET['return_page'] == 'home') {
        $return_page = $_GET['return_page'];
    }

} elseif (!isset($_GET['return_page'])) {
    $return_page = "home";
}
if (isset($_GET['return_page_rid'])) {
    $return_page_rid = $_GET['return_page_rid'];
}
if (isset($_GET['return_page_rid2'])) {
    $return_page_rid2 = $_GET['return_page_rid2'];
}

if (isset($_GET['hot_list_cat'])) {
    $hot_list_cat = $_GET['hot_list_cat'];
} else {
    if (!isset($_GET['hot_list_cat'])) {
        $hot_list_cat = "listings";
    }
}

if (isset($_GET['show_hot_list'])) {
    $show_hot_list = $_GET['show_hot_list'];

    if ($show_hot_list == "n") {
        $show_hot_list = 0;
    }
} else {
    if (!isset($_GET['$show_hot_list'])) {
        $show_hot_list = 1;
    }
}

if (isset($_GET['return_page_div'])) {
    $return_page_div = $_GET['return_page_div'];
}

//Where builder //

// if ($_GET['modby']) {

// $userFilterStr = ($userFilter) ? " AND CLASS.MODBY=$modby " : " ";

// } else {

//  $userFilterStr = ($userFilter) ? " AND CLASS.UID=$uid " : " ";

// }

/* @var $_GET type */

$userFilterStr = ($userFilter) ? " AND CLASS.UID=$uid " : " ";
$activeFilterStr = ($activeFilter) ? " AND CLASS.STATUS='ACT' " : " ";
$availFilterStr = ($availFilter) ? " AND CLASS.STATUS_ACTIVE='1' " : " ";

if ($op == "listings") {
    if (isset($_GET['client_id_filter'])) {
        $clientFilterStr = "SELECT * FROM CLIENTS WHERE CLID=" . $_GET['client_id_filter'];
        $clientFilterQ = mysqli_query($dbh, $clientFilterStr);
        $clientFilterO = mysqli_fetch_object($clientFilterQ);
    }

    //FILTERS (WHERE CLAUSE)//
    if (isset($_POST['filterChange'])) {
        //barkha

        $bbbmonth = isset($_POST['bbbmonth']) ? $_POST['bbbmonth'] : "";

        $bbbday = isset($_POST['bbbday']) ? $_POST['bbbday'] : "";

        $bbbyear = isset($_POST['bbbyear']) ? $_POST['bbbyear'] : "";

        $bbemonth = isset($_POST['bbemonth']) ? $_POST['bbemonth'] : "";

        $bbeday = isset($_POST['bbeday']) ? $_POST['bbeday'] : "";

        $bbeyear = isset($_POST['bbeyear']) ? $_POST['bbeyear'] : "";
        //barkha

        if ($bbbyear == "--" || $bbbmonth == "--" || $bbbday == "--") {
            $begin_date = false;
        } else {
            $begin_date = $bbbyear . "-" . $bbbmonth . "-" . $bbbday;
        }

        if ($begin_date == "--") {
            $begin_date = false;
        }

        if ($bbeyear == "--" || $bbemonth == "--" || $bbeday == "--") {
            $end_date = false;
        } else {
            $end_date = $bbeyear . "-" . $bbemonth . "-" . $bbeday;
        }

        if ($end_date == "--") {
            $end_date = false;
        }
        ?>
<!-- still does not work
		$begin_d=$bbbyear.$bbbmonth.$bbbday;
		$end_d=$bbeyear.$bbemonth.$bbeday;
		if ($end_d == $begin_d)
		{
			$end_date = false;
		}

		if ($begin_d > $end_d)
		{
			$end_date = false;
		}
-->
<?php

        $sourcemls = isset($_POST['sourcemls']) ? $_POST['sourcemls'] : "";

        $bbbLEMonth = $_POST['bbbLEMonth']; //;
        $bbbLEDay = $_POST['bbbLEDay']; //;
        $bbbLEYear = $_POST['bbbLEYear']; //;
        if ($bbbLEMonth !== "--" && $bbbLEDay !== "--" && $bbbLEYear !== "--") {
            $lease_expire = $bbbLEYear . "-" . $bbbLEMonth . "-" . $bbbLEDay;
        } else {
            $lease_expire = 0;
        }
        if ($lease_expire == "--") {
            $lease_expire = 0;
        }

        $preFilters = array();
        $preFilters[1] = isset($_POST['type']) ? array($_POST['type'], "CLASS.TYPE", "=", "Type") : "";
        if (isset($_POST['loc']) and is_array($_POST['loc'])) {
            foreach ($_POST['loc'] as $l0c) {
                if (preg_match("/\,/", $l0c)) {
                    $_POST['loc'] = preg_split("/\,/", $l0c);
                }
            }
        }

        $preFilters[2] = array($_POST['loc'], "LOC.LOCID", "=", "Location");
        $preFilters[3] = isset($_POST['priceStart'][0]) ? array($_POST['priceStart'], "PRICE", ">=", "Price Min") : "";
        $preFilters[4] = isset($_POST['priceEnd'][0]) ? array($_POST['priceEnd'], "PRICE", "<=", "Price Max") : "";
        $preFilters[5] = array($_POST['rooms'], "ROOMS", "=", "Bedrooms");
        $preFilters[6] = array($_POST['bath'], "BATH", "=", "Bathrooms");
        $preFilters[7] = array($_POST['pets'], "PETSA", "=", "Pets");

        $preFilters[8] = isset($_POST['status'][0]) ? array($_POST['status'], "CLASS.STATUS", "=", "Advertising") : "";

        $preFilters[9] = isset($_POST['status_vacant'][0]) ? array($_POST['status_vacant'], "STATUS_VACANT", "=", "Vacant") : "";

        $preFilters[10] = isset($_POST['status_active'][0]) ? array($_POST['status_active'], "STATUS_ACTIVE", "=", "Active") : "";

        $preFilters[11] = array($begin_date, "CLASS.AVAIL", ">=", "Available begin date");
        $preFilters[12] = array($end_date, "CLASS.AVAIL", "<=", "Available end date");
        $preFilters[13] = array($_POST['landlord'], "CLASS.LANDLORD", "=", "Landlord");
        $preFilters[14] = array($_POST['listing_type'], "CLASS.LISTING_TYPE", "=", "Listing Type");
        $preFilters[15] = array($_POST['lease_type'], "CLASS.LEASE_TYPE", "=", "Lease Type");
        $preFilters[16] = isset($_POST['terms'][0]) ? array($_POST['terms'], "CLASS.TERMS", "=", "Lease Terms") : "";
        $preFilters[17] = array($_POST['tax_clause'], "CLASS.TAX_CLAUSE", "=", "Tax Clause");
        $preFilters[18] = isset($_POST['tenant_fee'][0]) ? array($_POST['tenant_fee'], "CLASS.TENANT_FEE", "=", "Tenant Fee") : "";
        $preFilters[19] = isset($_POST['landlord_fee'][0]) ? array($_POST['landlord_fee'], "CLASS.LANDLORD_FEE", "=", "Landlord Fee") : "";
        $preFilters[20] = isset($_POST['payment_first'][0]) ? array($_POST['payment_first'], "CLASS.PAYMENT_FIRST", "=", "First Month Payment") : "";
        $preFilters[21] = isset($_POST['payment_last'][0]) ? array($_POST['payment_last'], "CLASS.PAYMENT_LAST", "=", "Last Month Payment") : "";
        $preFilters[22] = isset($_POST['payment_sec'][0]) ? array($_POST['payment_sec'], "CLASS.PAYMENT_SEC", "=", "Security Deposit") : "";
        $preFilters[23] = isset($_POST['key_deposit'][0]) ? array($_POST['key_deposit'], "CLASS.KEY_DEPOSIT", "=", "Key Deposit") : "";
        $preFilters[24] = isset($_POST['clean_deposit'][0]) ? array($_POST['clean_deposit'], "CLASS.CLEAN_DEPOSIT", "=", "Clean Deposit") : "";
        $preFilters[25] = isset($_POST['fee_comments'][0]) ? array($_POST['fee_comments'], "CLASS.FEE_COMMENTS", "=", "Fee Comments") : "";
        $preFilters[26] = isset($_POST['parking_num'][0]) ? array($_POST['parking_num'], "CLASS.PARKING_NUM", "=", "Number of Parking Spaces") : "";
        $preFilters[27] = array($_POST['parking_type'], "CLASS.PARKING_TYPE", "=", "Type of Parking Spaces");
        $preFilters[28] = isset($_POST['parking_cost'][0]) ? array($_POST['parking_cost'], "CLASS.PARKING_COST", "=", "Cost per Parking Space") : "";
        $preFilters[29] = array($_POST['features_deleaded'], "CLASS.FEATURES_DELEADED", "=", "Features: Deleaded");
        $preFilters[30] = array($_POST['features_furnished'], "CLASS.FEATURES_FURNISHED", "=", "Features: Furnished");
        $preFilters[31] = array($_POST['features_non_smoking'], "CLASS.FEATURES_NON_SMOKING", "=", "Features: Non Smoking");
        $preFilters[32] = array($_POST['features_alarm'], "CLASS.FEATURES_ALARM", "=", "Features: Alarm");
        $preFilters[33] = array($_POST['features_heat'], "CLASS.FEATURES_HEAT", "=", "Features: Heat");
        $preFilters[34] = array($_POST['features_hot_water'], "CLASS.FEATURES_HOT_WATER", "=", "Features: Hot Water");
        $preFilters[35] = array($_POST['features_ht_and_hw'], "CLASS.FEATURES_HT_AND_HW", "=", "Features: Heat and Hot Water");
        $preFilters[36] = array($_POST['features_all_utilities'], "CLASS.FEATURES_ALL_UTILITIES", "=", "Features: All Utilities");
        $preFilters[37] = array($_POST['features_gas_heat'], "CLASS.FEATURES_GAS_HEAT", "=", "Features: Gas Heat");
        $preFilters[38] = array($_POST['features_oil_heat'], "CLASS.FEATURES_OIL_HEAT", "=", "Features: Oil Heat");
        $preFilters[39] = array($_POST['features_elec_heat'], "CLASS.FEATURES_ELEC_HEAT", "=", "Features: Elec Heat");
        $preFilters[40] = array($_POST['features_hwfi'], "CLASS.FEATURES_HWFI", "=", "Features: Hardwood Floors");
        $preFilters[41] = array($_POST['features_fireplace_working'], "CLASS.FEATURES_FIREPLACE_WORKING", "=", "Features: Working Fireplace");
        $preFilters[42] = array($_POST['features_carpet'], "CLASS.FEATURES_CARPET", "=", "Features: Carpet");
        $preFilters[43] = array($_POST['features_modern_kitchen'], "CLASS.FEATURES_MODERN_KITCHEN", "=", "Features: Modern Kitchen");
        $preFilters[44] = array($_POST['features_kitchenette'], "CLASS.FEATURES_KITCHENETTE", "=", "Features: Kitchenette");
        $preFilters[45] = array($_POST['features_eat_in_kitchen'], "CLASS.FEATURES_EAT_IN_KITCHEN", "=", "Features: Eat In Kitchen");
        $preFilters[46] = array($_POST['features_gas_range'], "CLASS.FEATURES_GAS_RANGE", "=", "Features: Gas Range");
        $preFilters[47] = array($_POST['features_elec_range'], "CLASS.FEATURES_ELEC_RANGE", "=", "Features: Elec Range");
        $preFilters[48] = array($_POST['features_disposal'], "CLASS.FEATURES_DISPOSAL", "=", "Features: Disposal");
        $preFilters[49] = array($_POST['features_dishwasher'], "CLASS.FEATURES_DISHWASHER", "=", "Features: Dishwasher");
        $preFilters[50] = array($_POST['features_skylight'], "CLASS.FEATURES_SKYLIGHT", "=", "Features: Skylight");
        $preFilters[51] = array($_POST['features_porch'], "CLASS.FEATURES_PORCH", "=", "Features: Porch");
        $preFilters[52] = array($_POST['features_balcony'], "CLASS.FEATURES_BALCONY", "=", "Features: Balcony");
        $preFilters[53] = array($_POST['features_patio'], "CLASS.FEATURES_PATIO", "=", "Features: Patio");
        $preFilters[54] = array($_POST['features_central_ac'], "CLASS.FEATURES_CENTRAL_AC", "=", "Features: Central AC");
        $preFilters[55] = array($_POST['features_ac'], "CLASS.FEATURES_AC", "=", "Features: AC");
        $preFilters[56] = array($_POST['features_deck'], "CLASS.FEATURES_DECK", "=", "Features: Deck");
        $preFilters[57] = array($_POST['features_modern_bath'], "CLASS.FEATURES_MODERN_BATH", "=", "Features: Modern Bath");
        $preFilters[58] = array($_POST['features_dinning_room'], "CLASS.FEATURES_DINNING_ROOM", "=", "Features: Dining Room");
        $preFilters[59] = array($_POST['amenities_conciearge'], "CLASS.AMENITIES_CONCIEARGE", "=", "Amenities: Conciearge ");
        $preFilters[60] = array($_POST['amenities_elevator'], "CLASS.AMENITIES_ELEVATOR", "=", "Amenities: Elevator ");
        $preFilters[61] = array($_POST['amenities_deck'], "CLASS.AMENITIES_DECK", "=", "Amenities: Deck ");
        $preFilters[62] = array($_POST['amenities_roof_deck'], "CLASS.AMENITIES_ROOF_DECK", "=", "Amenities: Roof Deck ");
        $preFilters[63] = array($_POST['amenities_garden'], "CLASS.AMENITIES_GARDEN", "=", "Amenities: Garden ");
        $preFilters[64] = array($_POST['amenities_yard'], "CLASS.AMENITIES_YARD", "=", "Amenities: Yard ");
        $preFilters[65] = array($_POST['amenities_security'], "CLASS.AMENITIES_SECURITY", "=", "Amenities: Security ");
        $preFilters[66] = array($_POST['amenities_health_club'], "CLASS.AMENITIES_HEALTH_CLUB", "=", "Amenities: Health Club ");
        $preFilters[67] = array($_POST['amenities_pool'], "CLASS.AMENITIES_POOL", "=", "Amenities: Pool ");
        $preFilters[68] = array($_POST['amenities_tennis'], "CLASS.AMENITIES_TENNIS", "=", "Amenities: Tennis ");
        $preFilters[69] = array($_POST['amenities_lounge'], "CLASS.AMENITIES_LOUNGE", "=", "Amenities: Lounge ");
        $preFilters[70] = array($_POST['amenities_sauna'], "CLASS.AMENITIES_SAUNA", "=", "Amenities: Sauna ");
        $preFilters[71] = array($_POST['amenities_high_ceilings '], "CLASS.AMENITIES_HIGH_CEILINGS", "=", "Amenities: High Ceilings ");
        $preFilters[72] = array($_POST['amenities_balcony '], "CLASS.AMENITIES_BALCONY", "=", "Amenities: Balcony ");
        $preFilters[73] = array($_POST['amenities_deck2'], "CLASS.AMENITIES_DECK2", "=", "Amenities: Deck2");
        $preFilters[74] = array($_POST['amenities_elevator_building'], "CLASS.AMENITIES_ELEVATOR_BUILDING", "=", "Amenities: Elevator Building");
        $preFilters[75] = array($_POST['features_walk_in_closet'], "CLASS.FEATURES_WALK_IN_CLOSET", "=", "Features: Walk In Closet ");
        $preFilters[76] = array($_POST['building_type'], "CLASS.BUILDING_TYPE", "=", "Building Type");
        $preFilters[77] = array($_POST['laundry_room'], "CLASS.LAUNDRY_ROOM", "=", "Laundry Room");
        $preFilters[78] = array($_POST['amenities_attic'], "CLASS.AMENITIES_ATTIC", "=", "Storage: Attic");
        $preFilters[79] = array($_POST['amenities_bin'], "CLASS.AMENITIES_BIN", "=", "Storage: Bin");
        $preFilters[80] = array($_POST['amenities_basement'], "CLASS.AMENITIES_BASEMENT", "=", "Storage: Basement");
        $preFilters[81] = isset($_POST['tenant_name'][0]) ? array($_POST['tenant_name'], "CLASS.TENANT_NAME", "=", "Tenant Name") : "";
        $preFilters[82] = isset($_POST['tenant_phone'][0]) ? array($_POST['tenant_phone'], "CLASS.TENANT_PHONE", "=", "Tenant Phone") : "";
        $preFilters[83] = array($_POST['key_info'], "CLASS.KEY_INFO", "=", "Key Info");
        $preFilters[84] = array($_POST['students'], "CLASS.STUDENTS", "=", "Students");
        $preFilters[85] = isset($_POST['alarm'][0]) ? array($_POST['alarm'], "CLASS.ALARM", "=", "Alarm Code") : "";
        $preFilters[86] = array($lease_expire, "CLASS.LEASE_EXPIRE", "=", "Lease Expiration Date");
        $preFilters[87] = isset($_POST['rented_by'][0]) ? array($_POST['rented_by'], "CLASS.RENTED_BY", "=", "Rented By") : "";
        $preFilters[88] = array($_POST['nofee'], "CLASS.NOFEE", "=", "Fee");
        $preFilters[89] = array($_POST['school'], "CLASS.SCHOOL", "=", "Colleges");
        $preFilters[90] = isset($_POST['status_not_active'][0]) ? array($_POST['status_not_active'], "STATUS_ACTIVE", "<>", "Available") : "";
        $preFilters[91] = isset($_POST['street_num'][0]) ? array($_POST['street_num'], "CLASS.STREET_NUM", " LIKE ", "Street Number") : "";
        $preFilters[92] = isset($_POST['street'][0]) ? array($_POST['street'], "CLASS.STREET", " LIKE ", "Street Name") : "";
        $preFilters[93] = array($_POST['features_pantry'], "CLASS.FEATURES_PANTRY", "=", "Features: Pantry");
        $preFilters[94] = array($_POST['features_microwave'], "CLASS.FEATURES_MICROWAVE", "=", "Features: Microwave");
        $preFilters[95] = array($_POST['features_enclosed_porch'], "CLASS.FEATURES_ENCLOSED_PORCH", "=", "Features: Enclosed Porch");
        $preFilters[96] = array($_POST['features_high_speed_internet'], "CLASS.FEATURES_INTERNET", "=", "Features: High Speed Internet");
        $preFilters[97] = array($_POST['features_duplex'], "CLASS.FEATURES_DUPLEX", "=", "Features: Duplex");
        $preFilters[98] = array($_POST['amenities_superintendant'], "CLASS.AMENITIES_SUPERINTENDANT", "=", "Amenities: Superintendent");
        $preFilters[99] = array($_POST['amenities_on_site_management'], "CLASS.AMENITIES_ON_SITE_MANAGEMENT", "=", "Amenities: On Site Management");
        $preFilters[100] = array($_POST['features_fireplace_decor'], "CLASS.FEATURES_FIREPLACE_DECOR", "=", "Features: Decorative Fireplace");
        $preFilters[101] = array($_POST['building_style'], "CLASS.BUILDING_STYLE", "=", "Building Style");
        $preFilters[102] = array($_POST['features_whirlpool'], "CLASS.FEATURES_WHIRLPOOL", "=", "Features: Whirlpool Tub");
        $preFilters[103] = array($_POST['features_not_furnished'], "CLASS.FEATURES_FURNISHED", "!=", "Not Furnished");

        $preFilters[104] = array($_POST['user'], "USERS.UID", "=", "User");

        $preFilters[105] = array($_POST['amenities_subway'], "CLASS.AMENITIES_SUBWAY", "=", "Features: Subway");
        $preFilters[106] = array($_POST['amenities_crail'], "CLASS.AMENITIES_CRAIL", "=", "Features: Commuter Rail");
        $preFilters[107] = array($_POST['amenities_bus'], "CLASS.AMENITIES_BUS", "=", "Features: Bus");
        $preFilters[108] = array($_POST['amenities_shuttle'], "CLASS.AMENITIES_SHUTTLE", "=", "Features: Shuttle Bus");
        $preFilters[109] = isset($_POST['zip'][0]) ? array($_POST['zip'], "CLASS.ZIP", "=", "Zip Code") : "";

        $preFilters[110] = array($_POST['amenities_owner_occupied'], "CLASS.AMENITIES_OWNER_OCCUPIED", "=", "Features: Owner Occupied");
        $preFilters[111] = array($_POST['features_electricity'], "CLASS.FEATURES_ELECTRICITY", "=", "Features: Electricity");

        $preFilters[112] = array($_POST['amenities_clubhouse'], "CLASS.AMENITIES_CLUBHOUSE", "=", "Features: Club House");
        $preFilters[113] = array($_POST['amenities_businesscenter'], "CLASS.AMENITIES_BUSINESSCENTER", "=", "Features: Business Center");
        $preFilters[114] = array($_POST['amenities_wheelchair'], "CLASS.AMENITIES_WHEELCHAIR", "=", "Features: Wheelchair");

        $preFilters[115] = array($_POST['exterior'], "CLASS.EXTERIOR", "=", "Exterior");

        $preFilters[116] = array($_POST['uid'], "CLASS.UID", "=", "Agent");

        $preFilters[117] = array($_POST['CONDO_FEES_INCLUDE'], "CONDO_FEES_INCLUDE", "=", "Condo Fees Include");

        $preFilters[118] = array($_POST['features_kitchen_galley'], "CLASS.FEATURES_KITCHEN_GALLEY", "=", "Features: Galley Kitchen");

        $preFilters[119] = array($_POST['pic'], "CLASS.PIC", ">=", "Has Pics");

        $preFilters[120] = array($_POST['not_deleaded'], "CLASS.NOT_DELEADED", "=", "Not Deleaded");

        $preFilters[121] = isset($_POST['status_pending'][0]) ? array($_POST['status_pending'], "STATUS_PENDING", "=", "Pending") : "";

        $preFilters[122] = array($_POST['modby'], "MODBY", "=", "Mod by");

        $preFilters[123] = isset($_POST['street_num_begin'][0]) ? array($_POST['street_num_begin'], "CLASS.STREET_NUM", " >= ", "Street Number Begin") : "";
        $preFilters[124] = isset($_POST['street_num_end'][0]) ? array($_POST['street_num_end'], "CLASS.STREET_NUM", " <= ", "Street Number End") : "";

        $preFilters[125] = array($_POST['amenities_not_owner_occupied'], "CLASS.AMENITIES_NOT_OWNER_OCCUPIED", "=", "Not Owner Occupied");

        $preFilters[126] = array($_POST['agency'], "CLASS.AGENCY_HEADERS", "=", "agency");

        $preFilters[127] = isset($_POST['priority'][0]) ? array($_POST['priority'], "PRIORITY", "=", "Priority") : "";

        $preFilters[128] = array($_POST['keyword'], "CLASS.BODY", " LIKE ", "%keyword%");

    }

    if (isset($clientFilterO->CLID)) {
        $preFilters = array();
        $preFilters[1] = array($clientFilterO->TYPE_PREF, "CLASS.TYPE", "=", "Type");
        if (preg_match('/,/', $clientFilterO->LOC_PREF)) {
            $location_list = preg_split('/,/', $clientFilterO->LOC_PREF);
            $preFilters[2] = array($location_list, "LOC.LOCID", "=", "Location");
        } else {
            $preFilters[2] = array($clientFilterO->LOC_PREF, "LOC.LOCID", "=", "Location");
        }
        $preFilters[3] = ($clientFilterO->PRICEMIN > 1) ? array($clientFilterO->PRICEMIN, "PRICE", ">=", "Price Min") : "";
        $preFilters[4] = ($clientFilterO->PRICEMAX > 1) ? array($clientFilterO->PRICEMAX, "PRICE", "<=", "Price Max") : "";
        if (preg_match('/,/', $clientFilterO->ROOMS_PREF)) {
            $rooms_list = preg_split('/,/', $clientFilterO->ROOMS_PREF);
            $preFilters[5] = array($rooms_list, "ROOMS", "=", "Bedrooms");
        } else {
            $preFilters[5] = array($clientFilterO->ROOMS_PREF, "ROOMS", "=", "Bedrooms");
        }
        if (preg_match('/,/', $clientFilterO->BATH_PREF)) {
            $baths_list = preg_split('/,/', $clientFilterO->BATH_PREF);
            $preFilters[6] = array($baths_list, "BATH", "=", "Bathrooms");
        } else {
            $preFilters[6] = array($clientFilterO->BATH_PREF, "BATH", "=", "Bathrooms");
        }
        if (preg_match('/,/', $clientFilterO->PETS_PREF)) {
            $pets_list = preg_split('/,/', $clientFilterO->PETS_PREF);
            $preFilters[7] = array($pets_list, "PETSA", "=", "Pets");
        } else {
            $preFilters[7] = array($clientFilterO->PETS_PREF, "PETSA", "=", "Pets");
        }
        if ($clientFilterO->DATE_MOVEIN) {
            $preFilters[11] = ($clientFilterO->DATE_MOVEIN) ? array($clientFilterO->DATE_MOVEIN, "CLASS.AVAIL", ">=", "Available begin date") : "";
            $date_list = preg_split('/-/', $clientFilterO->DATE_MOVEIN);
            $bbyear = $date_list[0];
            $bbmonth = $date_list[1];
            $bbday = $date_list[3];
        }

        if ($clientFilterO->DATE_MOVEIN_END) {
            $preFilters[12] = ($clientFilterO->DATE_MOVEIN_END) ? array($clientFilterO->DATE_MOVEIN_END, "CLASS.AVAIL", "<=", "Available end date") : "";
            $date_list_end = preg_split('/-/', $clientFilterO->DATE_MOVEIN);
            $bbyear = $date_list[0];
            $bbmonth = $date_list[1];
            $bbday = $date_list[3];
        }

        if ($clientFilterO->CLIENT_SHORTTERM) {
            $preFilters[15] = array(array("3.5"), "CLASS.LEASE_TYPE", "=", "Lease Type");
        }
        if ($clientFilterO->CLIENT_FURNISHED) {
            $preFilters[30] = array(array("1"), "CLASS.FEATURES_FURNISHED", "=", "Features: Furnished");
        }
    }

    if (isset($_POST['filterChange']) || isset($clientFilterO->CLID)) {
        $filters = array();
        $i = 0;
        $tempStr = "";
        foreach ($preFilters as $preFilter) {
            if (isset($preFilter[0])) {
                if (is_array($preFilter[0])) {
                    $tempArr = $preFilter[0];
                    $numTempArr = count($tempArr);
                    $tempStr .= "(";
                    foreach ($tempArr as $key => $value) {
                        $tempStr .= " $preFilter[1]$preFilter[2]'$value' ";
                        if ($key < ($numTempArr - 1)) {
                            $tempStr .= " OR ";
                        }
                    }
                    $tempStr .= ")";
                    $filters[$i] = $tempStr;

                    $tempStr = "";
                    $i++;
                } else {

                    if ($preFilter[2] == " LIKE ") {
                        $f = "%$preFilter[0]%";
                        $f = preg_replace('/ /', '%', $f);
                        $filters[$i] = " ($preFilter[1]$preFilter[2]'$f') ";

//                                                $filters[$i] = " ($preFilter[1]$preFilter[2]'%$preFilter[0]%') ";
                    } else {
                        $filters[$i] = " ($preFilter[1]$preFilter[2]'$preFilter[0]') ";
                    }

                    $i++;
                }
            }
        }

        if (isset($sourcemls)) {
            if ($sourcemls == "$grid") {

                $numFilters = count($filters);
                switch ($numFilters) {

                    case 0:
                        $WHERE = " WHERE (CLI='$grid' AND CSOURCE='0') $userFilterStr $activeFilterStr $availFilterStr";
                        break;
                    case 1:
                        $WHERE = " WHERE " . $filters[0] . " AND CLI='$grid' AND CSOURCE='0' $userFilterStr $activeFilterStr $availFilterStr";
                        break;
                    default:
                        $WHERE = " WHERE ";
                        for ($i = 0; $i <= ($numFilters - 1); $i++) {
                            $WHERE .= $filters[$i] . " AND ";
                        }
                        $WHERE .= " CLI='$grid' AND CSOURCE='0' $userFilterStr $activeFilterStr $availFilterStr";
                        break;
                }

            } elseif (isset($sourcemls)) {
                if ($sourcemls == "1075A") {

                    $numFilters = count($filters);
                    switch ($numFilters) {

                        case 0:
                            $WHERE = " WHERE (CLI='1075') $userFilterStr $activeFilterStr $availFilterStr";
                            break;
                        case 1:
                            $WHERE = " WHERE " . $filters[0] . " AND CLI='1075' $userFilterStr $activeFilterStr $availFilterStr";
                            break;
                        default:
                            $WHERE = " WHERE ";
                            for ($i = 0; $i <= ($numFilters - 1); $i++) {
                                $WHERE .= $filters[$i] . " AND ";
                            }
                            $WHERE .= " CLI='1075' $userFilterStr $activeFilterStr $availFilterStr";
                            break;
                    }

                } elseif (isset($sourcemls)) {
                    if ($sourcemls == "BA") {

                        $numFilters = count($filters);
                        switch ($numFilters) {

                            case 0:
                                $WHERE = " WHERE ((CLI!='1075' AND CLI!='$grid' AND CLI!='392') AND (COBROKE='1' AND STATUS_ACTIVE='1')) $userFilterStr $activeFilterStr $availFilterStr";
                                break;
                            case 1:
                                $WHERE = " WHERE " . $filters[0] . " AND ((CLI!='1075' AND CLI!='$grid' AND CLI!='392') AND (COBROKE='1' AND STATUS_ACTIVE='1')) $userFilterStr $activeFilterStr $availFilterStr";
                                break;
                            default:
                                $WHERE = " WHERE ";
                                for ($i = 0; $i <= ($numFilters - 1); $i++) {
                                    $WHERE .= $filters[$i] . " AND ";
                                }
                                $WHERE .= " ((CLI!='1075' AND CLI!='$grid' AND CLI!='392') AND (COBROKE='1' AND STATUS_ACTIVE='1')) $userFilterStr $activeFilterStr $availFilterStr";
                                break;
                        }

                    } elseif (isset($sourcemls)) {
                        if ($sourcemls == "BAA") {

                            $numFilters = count($filters);
                            switch ($numFilters) {

                                case 0:
                                    $WHERE = " WHERE (((CLI!='1075' AND CLI!='$grid' AND CLI!='392') AND (COBROKE='1' AND STATUS_ACTIVE='1')) OR (CLI='$grid' AND CSOURCE=0)) $userFilterStr $activeFilterStr $availFilterStr";
                                    break;
                                case 1:
                                    $WHERE = " WHERE " . $filters[0] . " AND (((CLI!='1075' AND CLI!='$grid' AND CLI!='392') AND (COBROKE='1' AND STATUS_ACTIVE='1')) OR (CLI='$grid' AND CSOURCE=0)) $userFilterStr $activeFilterStr $availFilterStr";
                                    break;
                                default:
                                    $WHERE = " WHERE ";
                                    for ($i = 0; $i <= ($numFilters - 1); $i++) {
                                        $WHERE .= $filters[$i] . " AND ";
                                    }
                                    $WHERE .= " (((CLI!='1075' AND CLI!='$grid' AND CLI!='392') AND (COBROKE='1' AND STATUS_ACTIVE='1')) OR (CLI='$grid' AND CSOURCE=0)) $userFilterStr $activeFilterStr $availFilterStr";
                                    break;
                            }

                        } elseif (isset($sourcemls)) {
                            if ($sourcemls == "RJ") {

                                $numFilters = count($filters);
                                switch ($numFilters) {

                                    case 0:
                                        $WHERE = " WHERE (CLI!='1075' AND CLI!='392' AND CSOURCE='1' AND CLI='$grid') $userFilterStr $activeFilterStr $availFilterStr";
                                        break;
                                    case 1:
                                        $WHERE = " WHERE " . $filters[0] . " AND ((CLI!='1075' AND CLI!='392') AND (CLI='$grid') AND (CSOURCE='1')) $userFilterStr $activeFilterStr $availFilterStr";
                                        break;
                                    default:
                                        $WHERE = " WHERE ";
                                        for ($i = 0; $i <= ($numFilters - 1); $i++) {
                                            $WHERE .= $filters[$i] . " AND ";
                                        }
                                        $WHERE .= " ((CLI!='1075' AND CLI!='392') AND (CLI='$grid') AND (CSOURCE='1')) $userFilterStr $activeFilterStr $availFilterStr";
                                        break;
                                }

                            } elseif (isset($sourcemls)) {
                                if ($sourcemls == "RJA") {

                                    $numFilters = count($filters);
                                    switch ($numFilters) {

                                        case 0:
                                            $WHERE = " WHERE ((CLI!='1075' AND CLI!='392' AND CSOURCE='1' AND CLI='$grid') OR (CLI='$grid' AND CSOURCE=0)) $userFilterStr $activeFilterStr $availFilterStr";
                                            break;
                                        case 1:
                                            $WHERE = " WHERE " . $filters[0] . " AND (((CLI!='1075' AND CLI!='392') AND (CLI='$grid') AND (CSOURCE='1')) OR (CLI='$grid' AND CSOURCE=0)) $userFilterStr $activeFilterStr $availFilterStr";
                                            break;
                                        default:
                                            $WHERE = " WHERE ";
                                            for ($i = 0; $i <= ($numFilters - 1); $i++) {
                                                $WHERE .= $filters[$i] . " AND ";
                                            }
                                            $WHERE .= " (((CLI!='1075' AND CLI!='392') AND (CLI='$grid') AND (CSOURCE='1')) OR (CLI='$grid' AND CSOURCE=0))) $userFilterStr $activeFilterStr $availFilterStr";
                                            break;
                                    }

                                } elseif (isset($sourcemls)) {
                                    if ($sourcemls == "YGL") {

                                        $numFilters = count($filters);
                                        switch ($numFilters) {

                                            case 0:
                                                $WHERE = " WHERE (CLI!='1075' AND CLI!='392' AND CSOURCE='2' AND CLI='$grid') $userFilterStr $activeFilterStr $availFilterStr";
                                                break;
                                            case 1:
                                                $WHERE = " WHERE " . $filters[0] . " AND ((CLI!='1075' AND CLI!='392') AND (CLI='$grid') AND (CSOURCE='2')) $userFilterStr $activeFilterStr $availFilterStr";
                                                break;
                                            default:
                                                $WHERE = " WHERE ";
                                                for ($i = 0; $i <= ($numFilters - 1); $i++) {
                                                    $WHERE .= $filters[$i] . " AND ";
                                                }
                                                $WHERE .= " ((CLI!='1075' AND CLI!='392') AND (CLI='$grid') AND (CSOURCE='2')) $userFilterStr $activeFilterStr $availFilterStr";
                                                break;
                                        }

                                    } elseif (isset($sourcemls)) {
                                        if ($sourcemls == "YGLA") {

                                            $numFilters = count($filters);
                                            switch ($numFilters) {

                                                case 0:
                                                    $WHERE = " WHERE ((CLI!='1075' AND CLI!='392' AND CSOURCE='2' AND CLI='$grid') OR (CLI='$grid' AND CSOURCE=0)) $userFilterStr $activeFilterStr $availFilterStr";
                                                    break;
                                                case 1:
                                                    $WHERE = " WHERE " . $filters[0] . " AND (((CLI!='1075' AND CLI!='392') AND (CLI='$grid') AND (CSOURCE='2')) OR (CLI='$grid' AND CSOURCE=0)) $userFilterStr $activeFilterStr $availFilterStr";
                                                    break;
                                                default:
                                                    $WHERE = " WHERE ";
                                                    for ($i = 0; $i <= ($numFilters - 1); $i++) {
                                                        $WHERE .= $filters[$i] . " AND ";
                                                    }
                                                    $WHERE .= " (((CLI!='1075' AND CLI!='392') AND (CLI='$grid') AND (CSOURCE='2')) OR (CLI='$grid' AND CSOURCE=0)) $userFilterStr $activeFilterStr $availFilterStr";
                                                    break;
                                            }

                                        } elseif (isset($sourcemls)) {
                                            if ($sourcemls == "YGLB") {

                                                $numFilters = count($filters);
                                                switch ($numFilters) {

                                                    case 0:
                                                        $WHERE = " WHERE ((CLI!='1075' AND CLI!='392' AND (CSOURCE='1' OR CSOURCE='2') AND CLI='$grid') OR (CLI='$grid' AND CSOURCE=0)) $userFilterStr $activeFilterStr $availFilterStr";
                                                        break;
                                                    case 1:
                                                        $WHERE = " WHERE " . $filters[0] . " AND (((CLI!='1075' AND CLI!='392') AND (CLI='$grid') AND (CSOURCE='1' OR CSOURCE='2')) OR (CLI='$grid' AND CSOURCE=0)) $userFilterStr $activeFilterStr $availFilterStr";
                                                        break;
                                                    default:
                                                        $WHERE = " WHERE ";
                                                        for ($i = 0; $i <= ($numFilters - 1); $i++) {
                                                            $WHERE .= $filters[$i] . " AND ";
                                                        }
                                                        $WHERE .= " (((CLI!='1075' AND CLI!='392') AND (CLI='$grid') AND (CSOURCE='1' OR CSOURCE='2')) OR (CLI='$grid' AND CSOURCE=0)) $userFilterStr $activeFilterStr $availFilterStr";
                                                        break;
                                                }

                                            } elseif (isset($sourcemls)) {
                                                if ($sourcemls == "YGLC") {

                                                    $numFilters = count($filters);
                                                    switch ($numFilters) {

                                                        case 0:
                                                            $WHERE = " WHERE ((CLI='1075' AND CLI!='392' AND (CSOURCE='1' OR CSOURCE='2') AND CLI='$grid') OR (CLI='$grid' AND CSOURCE=0)) $userFilterStr $activeFilterStr $availFilterStr";
                                                            break;
                                                        case 1:
                                                            $WHERE = " WHERE " . $filters[0] . " AND (((CLI='1075' AND CLI!='392') AND (CLI='$grid') AND (CSOURCE='1' OR CSOURCE='2')) OR (CLI='$grid' AND CSOURCE=0)) $userFilterStr $activeFilterStr $availFilterStr";
                                                            break;
                                                        default:
                                                            $WHERE = " WHERE ";
                                                            for ($i = 0; $i <= ($numFilters - 1); $i++) {
                                                                $WHERE .= $filters[$i] . " AND ";
                                                            }
                                                            $WHERE .= " (((CLI='1075' AND CLI!='392') AND (CLI='$grid') AND (CSOURCE='1' OR CSOURCE='2')) OR (CLI='$grid' AND CSOURCE=0)) $userFilterStr $activeFilterStr $availFilterStr";
                                                            break;
                                                    }

                                                } elseif (isset($sourcemls)) {
                                                    if ($sourcemls == "ALL") {

                                                        $numFilters = count($filters);
                                                        switch ($numFilters) {

                                                            case 0:
                                                                $WHERE = " WHERE ((CLI='$grid') OR (CLI='1075') OR (CLI!='$grid' AND COBROKE='1' AND STATUS_ACTIVE='1')) $userFilterStr $activeFilterStr $availFilterStr";
                                                                break;
                                                            case 1:
                                                                $WHERE = " WHERE " . $filters[0] . " AND ((CLI='$grid') OR (CLI='1075') OR (CLI!='$grid' AND COBROKE='1' AND STATUS_ACTIVE='1')) $userFilterStr $activeFilterStr $availFilterStr";
                                                                break;
                                                            default:
                                                                $WHERE = " WHERE ";
                                                                for ($i = 0; $i <= ($numFilters - 1); $i++) {
                                                                    $WHERE .= $filters[$i] . " AND ";
                                                                }
                                                                $WHERE .= " ((CLI='$grid') OR (CLI='1075') OR (CLI!='$grid' AND COBROKE='1' AND STATUS_ACTIVE='1')) $userFilterStr $activeFilterStr $availFilterStr";
                                                                break;
                                                        }

                                                    } else {

                                                        $numFilters = count($filters);
                                                        switch ($numFilters) {

                                                            case 0:
                                                                $WHERE = " WHERE (CLI='$grid') $userFilterStr $activeFilterStr $availFilterStr";
                                                                break;
                                                            case 1:
                                                                $WHERE = " WHERE " . $filters[0] . " AND (CLI='$grid' OR CLI='1075') $userFilterStr $activeFilterStr $availFilterStr";
                                                                break;
                                                            default:
                                                                $WHERE = " WHERE ";
                                                                for ($i = 0; $i <= ($numFilters - 1); $i++) {
                                                                    $WHERE .= $filters[$i] . " AND ";
                                                                }
                                                                $WHERE .= " (CLI='$grid' OR CLI='1075') $userFilterStr $activeFilterStr $availFilterStr";
                                                                break;
                                                        }

                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $start = 0;
    } else {
        if (isset($_POST['clear_filter'])) {
            $WHERE = " WHERE CLI='$grid' ";
        }
    }
} elseif ($op == "sel" || $op == "app_sel") {
    $WHERE = "WHERE CLI=$grid AND TYPES.TYPE=$typeFilter $userFilterStr $activeFilterStr $availFilterStr";
}

if (!isset($_GET['WHERE'])) {
    $WHERE = " WHERE CLI='$grid' ";
}
if (isset($clientFilterO->CLID)) {
    $WHERE .= "AND STATUS_ACTIVE=1 ";
}
//* echo "<font size=-3>$WHERE</font>";

//Sort section //

if (!isset($_GET['sortD'])) {
    //if (!$sortD) {
    $sortD = "ASC";
    //}
} else {
    $sortD = $_GET['sortD'];
}

if (!isset($_GET['sort'])) {
    //if (!$sort) {
    $sort = "LOCNAME";
    //}
} elseif ($_GET['sort'] == "MOD") {
    $sort = "`" . $_GET['sort'] . "`";
} else {
    $sort = $_GET['sort'];
}

$antiSortD = ($sortD == "ASC") ? "DESC" : "ASC";

if ($sort == "edit" || $sort == "delete") {
    $sort = "LOCNAME, STREET, STREET_NUM, APT";
}

if ($sort == "STREET") {
    $sort = "STREET, STREET_NUM, APT";
}

$ORDERBY = " ORDER BY $sort $sortD, LOCNAME, AVAIL, ROOMS, PRICE  ";

$LISTINGS_ORDERBY = " ORDER BY $sort $sortD, LOCNAME, AVAIL, ROOMS, PRICE  ";

$LIMIT = " LIMIT $start, $limitN ";

$LLLIMIT = " LIMIT $LLstart, $LLlimitN ";

//DEFINED VALUE SETS //
$quStrGetValueDefs = "SELECT * FROM VALUE_DEFINE";
$quGetValueDefs = mysqli_query($dbh, $quStrGetValueDefs);

while ($rowGetValueDefs = mysqli_fetch_object($quGetValueDefs)) {
    $string = $rowGetValueDefs->DEFINE;
    $values = explode(",", $string);
    foreach ($values as $key => $value) {
        $values2[$key] = explode("_", $value);
    }
    foreach ($values2 as $values3) {
        if (count($values3) > 1) {
            $offset = $values3[0];
            $DEFINED_VALUE_SETS[$rowGetValueDefs->CLASS_NAME][$offset] = $values3[1];
        }
    }

    $string = false;
    $values = false;
    $values2 = false;
    $values3 = false;
    $offset = false;

}

$disData = null;
$disData2 = null;
$disData3 = null;
$disData4 = null;

//OPERATIONS SWITCH --- APPLICATION LAYER//
include "./ops/$op.php";
//END OPERATIONS SWITCH --- APPLICATION LAYER//

//SECONDARY OPERATIONS SWITCH ///
if (isset($GET_['sec_op'])) {
    include "./ops/$sec_op.php";
}
//END SECONDARY OPERATIONS SWITCH///

//RETURN PAGE MECH//
if (isset($return_page_go) and $return_page_go) {
    $cid = "";
    $did = "";
    $lid = "";
    $clid = "";
    $pid = "";

    $page = str_replace("Do", "", $return_page);
    $page = str_replace("create", "edit", $page);

    $script_name = $_SERVER['SCRIPT_NAME'];
    $script_name = explode("/", $script_name);
    $slash_count = count($script_name);
    $script_name = $script_name[$slash_count - 1];

}

if (isset($page)) {
    if ($page == "sel") {
        $disData = "ads";
    } elseif ($page == "listings") {
        $disData = "listings";
    } elseif ($page == "edit") {
        $disData = "ad";
    } elseif ($page == "editListing" || $page == "viewListing") {
        $disData = "ad";
    } elseif ($page == "manageLandlords") {
        $disData = "landlords";
    } elseif ($page == "editLandlord") {
        $disData = "landlord";
    } elseif ($page == "manageClients") {
        $disData = "clients";
    } elseif ($page == "editClient" || $page == "deleteClient") {
        $disData = "client";
    } elseif ($page == "editDeal" || $page == "deleteDeal") {
        $disData = "deal";
        $disData2 = "ad";
    } elseif ($page == "createDeal") {
        $disData = "clients";
        $disData2 = "ad";
    } elseif ($page == "managePics") {
        $disData = "pics";
        $disData2 = "ad";
    } elseif ($page == "editPic" || $page == "deletePic") {
        $disData = "pic";
    } elseif ($page == "manageListingDeals") {
        $disData = "listingDeals";
    }
}

//RECORDSET SWITCH -- DATABASE LAYER//
if ($disData == "ads" || $disData2 == "ads" || $disData3 == "ads") {
    $FilterAdsNew = "";
    if (isset($_GET['activeFilter'])) {
        $FilterAdsNew = " AND CLASS.STATUS='ACT' ";
    }

    if (isset($_GET['userFilter'])) {
        $FilterAdsNew = " AND CLASS.UID='$uid' ";
    }

    $ads_table_set = "(((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN STATES ON LOC.STATE=STATES.STATE_ID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID";
    $quStrGetAds = "select * from $ads_table_set $WHERE $FilterAdsNew $ORDERBY $LIMIT";
    $quGetAds = mysqli_query($dbh, $quStrGetAds);
    echo "<!--RECORDSET ads $quStrGetAds -->";
}
if ($disData == "ad" || $disData2 == "ad" || $disData3 == "ad") {

    if ($_SESSION["mls_town_pref"] == "1") {

        $quStrGetAd = "SELECT * FROM (((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN STATES ON LOC.STATE=STATES.STATE_ID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID WHERE CID='$cid' AND CLI=$grid";

    } else {

        $quStrGetAd = "SELECT * FROM (((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN STATES ON LOC.STATE=STATES.STATE_ID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID WHERE CID='$cid' AND ((CLI=$grid OR CLI='1075') OR (CLI!=$grid AND CLI!='1075' AND COBROKE=1 AND STATUS_ACTIVE=1))";

    }

    $quGetAd = mysqli_query($dbh, $quStrGetAd) or die(dieNice("Sorry, couldn't look up that ad.", "E-117"));
    echo "<!--RECORDSET ad -->";
    $rowGetAd = mysqli_fetch_object($quGetAd);

    $quStrGetAgentAd = "SELECT BODY_AGENT FROM CLASS_AGENTS WHERE CID='$cid' AND (CLI=$grid OR CLI='1075') AND UID=$uid";
    $quGetAgentAd = mysqli_query($dbh, $quStrGetAgentAd);
    $rowGetAgentAd = mysqli_fetch_object($quGetAgentAd);

}
if ($disData == "pics" || $disData2 == "pics" || $disData3 == "pics") {
    $quStrGetPics = "SELECT * FROM PICTURE WHERE CID=$cid ORDER BY PICORDER, PID";
    $quGetPics = mysqli_query($dbh, $quStrGetPics) or die(dieNice("Sorry, couldn't find any pictures.", "E-118"));
    echo "<!--RECORDSET pics -->";
}
if ($disData == "pic" || $disData2 == "pic" || $disData3 == "pic") {
    $quStrGetPic = "SELECT * FROM PICTURE WHERE PID=$pid";
    $quGetPic = mysqli_query($dbh, $quStrGetPic) or die(dieNice("Sorry, couldn't find that picture.", "E-119"));
    echo "<!--RECORDSET pic -->";
    $rowGetPic = mysqli_fetch_object($quGetPic);
}
if ($disData == "user" || $disData2 == "user" || $disData3 == "user") {
    $quStrGetUser = "SELECT * FROM USERS WHERE UID=$uid";
    $quGetUser = mysqli_query($dbh, $quStrGetUser);
    $rowGetUser = mysqli_fetch_object($quGetUser);
}
if ($disData == "euser" || $disData2 == "euser" || $disData3 == "euser") {
    $quStrGetUser = "SELECT * FROM USERS WHERE UID=$euid";
    $quGetUser = mysqli_query($dbh, $quStrGetUser);
    $rowGetUser = mysqli_fetch_object($quGetUser);
}
if ($disData == "listings" || $disData2 == "listings" || $disData3 == "listings") {
    if (!$LIMIT) {
        die();
    }
    $quStrGetListings = "SELECT * FROM ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID $WHERE $LISTINGS_ORDERBY $LIMIT";
    $quGetListings = mysqli_query($dbh, $quStrGetListings);
//    echo "<font color=\"#000000\"> $quStrGetListings</font>";
}
if ($disData == "group" || $disData2 == "group" || $disData3 == "group" || $disData4 == "group") {
    $quStrGetGroup = "SELECT * FROM `GROUP` WHERE GRID=$grid";
    $quGetGroup = mysqli_query($dbh, $quStrGetGroup);
    $rowGetGroup = mysqli_fetch_object($quGetGroup);
}

if ($disData == "clients" || $disData2 == "clients" || $disData3 == "clients") {

    if (!isset($clients_order_by)) {
        $clients_order_by = "ORDER BY NAME_LAST, NAME_FIRST";
    }

    if (isset($_GET['clients_filter'])) {
        $clients_order_by = "";
    }

    if (!isset($clients_where)) {
        $clients_where = "where GRID='$grid'";
    }
    if ((!$_SESSION["isAdmin"]) and ($_SESSION["user_level"] < 4)) {
        $clients_where .= " AND (CLIENTS.UID='$uid' OR CLIENTS.PUBLIC!='0' OR CLIENTS.SHARE_WITH='$uid')";
    }
    $clients_table_set = "(CLIENTS INNER JOIN USERS ON CLIENTS.UID=USERS.UID) left join TYPES on CLIENTS.TYPE_PREF=TYPES.TYPE";

    $quStrGetClientsCount = "select count(CLID) as clients_count from $clients_table_set $clients_where $clients_order_by";
//    echo $quStrGetClientsCount;
    $quGetClientsCount = mysqli_query($dbh, $quStrGetClientsCount);
    $rowGetClientsCount = mysqli_fetch_object($quGetClientsCount);
    $clients_count = $rowGetClientsCount->clients_count;

    $quStrGetClients = "SELECT * FROM $clients_table_set $clients_where $clients_order_by";
    if (isset($clients_limit)) {
        $quStrGetClients .= " $clients_limit";
    }
//    echo $clients_limit;
    //echo $quStrGetClients;
    $quGetClients = mysqli_query($dbh, $quStrGetClients) or die(mysqli_error($dbh));
}
if ($disData == "client" || $disData2 == "client" || $disData3 == "client") {
    if (($_SESSION["isAdmin"]) or ($_SESSION["user_level"] > "1")) {
        $clientsFilter = " WHERE GRID='$grid' AND CLID='$clid' ";
    } else {
        $clientsFilter = " WHERE GRID='$grid' AND CLID='$clid' AND (CLIENTS.UID='$uid' OR PUBLIC!=0)";
    }
    $quStrGetClient = "SELECT * FROM (CLIENTS JOIN USERS ON CLIENTS.UID=USERS.UID) LEFT JOIN DEALCLIENTS ON CLIENTS.CLID=DEALCLIENTS.DCLID $clientsFilter ";
    $quGetClient = mysqli_query($dbh, $quStrGetClient);
    $rowGetClient = mysqli_fetch_object($quGetClient);
}
if ($disData == "listingDeals" || $disData2 == "listingDeals" || $disData3 == "listingDeals") {
    $quStrGetDeals = "SELECT * FROM DEALS LEFT JOIN CLASS ON DEALS.CID=CLASS.CID WHERE DEALS.CID='$cid'";
    $quGetDeals = mysqli_query($dbh, $quStrGetDeals);
}
if ($disData == "deal" || $disData2 == "deal" || $disData3 == "deal") {
    $quStrGetDeal = "SELECT * FROM DEALS INNER JOIN CLASS ON DEALS.GRID=CLASS.CLI WHERE CLASS.CLI='$grid' AND DID='$did'";
    $quGetDeal = mysqli_query($dbh, $quStrGetDeal);
    $rowGetDeal = mysqli_fetch_object($quGetDeal);

    $quStrGetDealClients = "SELECT * FROM DEALCLIENTS INNER JOIN CLIENTS ON DEALCLIENTS.DCLID=CLIENTS.CLID WHERE DID='$did' AND CLIENTS.GRID='$grid'";
    $quGetDealClients = mysqli_query($dbh, $quStrGetDealClients);

}

if ($disData == "landlords" || $disData2 == "landlords" || $disData3 == "landlords") {
    $landlords_table_set = "LANDLORD";

    //if(!isset($_GET["landlords_where"]))
    if (!isset($landlords_where)) {

        $landlords_where = "where GRID='$grid'";
    }
    /*else
    {
    $landlords_where = null;
    $landlords_where = $_GET["landlords_where"];
    }*/

    $landlords_sort = isset($_GET["landlords_sort"]) ? $_GET["landlords_sort"] : "SHORT_NAME";

    $landlords_order_by = "order by $landlords_sort";

    if (!isset($landlords_limit)) {
        $landlords_limit = "";
    }
    $quStrGetLandlordCount = "select count(LID) as landlords_count from $landlords_table_set $landlords_where $landlords_order_by";

    $quGetLandlordCount = mysqli_query($dbh, $quStrGetLandlordCount) or die(mysqli_error($dbh));
    $rowGetLandlordCount = mysqli_fetch_object($quGetLandlordCount);

    $landlords_count = $rowGetLandlordCount->landlords_count;

    $quStrPageLandlord = "select * from $landlords_table_set $landlords_where $landlords_order_by $landlords_limit";

    //echo "query seems to be this lets see ".$quStrPageLandlord;
    $quPageLandlord = mysqli_query($dbh, $quStrPageLandlord);

}

if ($disData == "landlord" || $disData2 == "landlord" || $disData3 == "landlord") {
    $landlords_table = "LANDLORD";
    $quStrGetLandlord = "select * from $landlords_table WHERE LID=$lid AND GRID=$grid";
    $quGetLandlord = mysqli_query($dbh, $quStrGetLandlord) or die(mysqli_error($dbh));

    $rowGetLandlord = mysqli_fetch_object($quGetLandlord);

}

if ($disData == "openhouses" || $disData2 == "openhouses" || $disData3 == "openhouses") {
    $quStrGetOpenHouses = "select * from OPENHOUSE where CLI='$grid' and CID='$cid' order by DATE";
    $quGetOpenHouses = mysqli_query($dbh, $quStrGetOpenHouses) or die(mysqli_error($dbh));
}
if ($disData == "openhouse" || $disData2 == "openhouse" || $disData3 == "openhouse") {
    $quStrGetOpenHouse = "select * from OPENHOUSE where CLI='$grid' and ID='$ohid' order by DATE";
    $quGetOpenHouse = mysqli_query($dbh, $quStrGetOpenHouse) or die(mysqli_error($dbh));
    $rowGetOpenHouse = mysqli_fetch_object($quGetOpenHouse);
}

if ($disData == "xml" || $disData2 == "xml" || $disData3 == "xml") {
    $quStrGetActiveAds = "select * from CLASS where STATUS_ACTIVE='ACT' AND CLI=$grid";
    $quGetActiveAds = mysqli_query($dbh, $quStrGetActiveAds) or die(mysqli_error($dbh));
    $rowGetActiveAds = mysqli_fetch_object($quGetActiveAds);
}

if (isset($page)) {
    if ($page == "sel" || $page == "compose" || $page == "edit" || $page == "home" || $page == "listings" || $page == "editClient" || $page == "manageClients") {
        $needOptions = true;
    }
}

//FORM OPTIONS LOOKUP SWITCH//
if ($needOptions) {

    $quStrFavLocs = "SELECT * FROM FAVLOC INNER JOIN LOC ON FAVLOC.LOC=LOC.LOCID WHERE UID='$uid' ORDER BY SCORE DESC LIMIT 20";
    $quFavLocs = mysqli_query($dbh, $quStrFavLocs);
    if ($op == "listings" or $op == "createClient") {

        if (isset($_SESSION["mls_town_pref"]) and $_SESSION["mls_town_pref"] == "2") {
            $quStrLocs = "SELECT DISTINCT LOC, LOCNAME, LOCID FROM CLASS INNER JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE (CLI=$grid  OR CLI='1075')ORDER BY LOCNAME";
        } else {
            $quStrLocs = "SELECT DISTINCT LOC, LOCNAME, LOCID FROM CLASS INNER JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE CLI=$grid ORDER BY LOCNAME";
        }

    } else {
        $locations = "WHERE STATE=21 OR STATE=29 OR STATE=40";
        $quStrLocs = "SELECT * FROM LOC $locations ORDER BY STATE, LOCNAME";
    }
    $quLocs = mysqli_query($dbh, $quStrLocs) or die(dieNice("Sorry, couldn't find locations table.", "E-120"));
    while ($rowLocArray = mysqli_fetch_object($quLocs)) {
        $LOC_ARRAY[$rowLocArray->LOCID] = $rowLocArray->LOCNAME;
    }
// used the at to block error when no result //
    @mysqli_data_seek($quLocs, 0);
    $quStrTypes = "SELECT * FROM TYPES";
    $quTypes = mysqli_query($dbh, $quStrTypes) or die(dieNice("Sorry, couldn't find types table.", "E-121"));
    while ($rowTypeArray = mysqli_fetch_object($quTypes)) {
        $TYPE_ARRAY[$rowTypeArray->TYPE] = $rowTypeArray->TYPENAME;
    }

    mysqli_data_seek($quTypes, 0);

    $quStrLandlord = "SELECT * FROM LANDLORD WHERE GRID=$grid ORDER BY SHORT_NAME";
    //echo $quStrLandlord;
    $quLandlord = mysqli_query($dbh, $quStrLandlord);
    $num_landlords = mysqli_num_rows($quLandlord);
    while ($rowLLArray = mysqli_fetch_object($quLandlord)) {
        $LL_ARRAY[$rowLLArray->LID] = $rowLLArray->SHORT_NAME;
    }
    if ($num_landlords) {
        mysqli_data_seek($quLandlord, 0);
    }
    //if ($_SESSION["isAdmin"] OR $_SESSION["user_level"] >="4") {
    if ($_SESSION["user_level"] >= "4") {
        $quStrGetUsers = "SELECT * FROM USERS WHERE `GROUP`=$grid ORDER BY `HANDLE`";
        $quGetUsers = mysqli_query($dbh, $quStrGetUsers);
    }

}
$quStrIntf = "SELECT * FROM INTERFACE";
$quIntf = mysqli_query($dbh, $quStrIntf);

if ($app == "home") {
    $appLink = "home";
} elseif ($app == "ad") {
    $appLink = "sel";
}

?>
