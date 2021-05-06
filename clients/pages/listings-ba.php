<!--BEGIN listings -->

<?php

if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}

if ($pref_coltit=="") {
$coltitcolor="#3DB1FF";
} else {
$coltitcolor="$pref_coltit";
}

if ($listsearchshow !="n") {
$listsearchs1="$listsearch";
}
else {
$listsearchs1="none";
}

?>

<?php
$quStrGetViews = "SELECT * FROM VIEWS WHERE GRID=$grid OR PUBLIC=1 ORDER BY NAME";
$quGetViews = mysqli_query($dbh, $quStrGetViews) or die ($quStrGetViews);
$quStrGetView = "SELECT * FROM VIEWS WHERE ID=$vid AND (GRID='$grid' OR PUBLIC=1)";
$quGetView = mysqli_query($dbh, $quStrGetView);
$rowGetView = mysqli_fetch_array($quGetView);



	$quStrGetUsers = "select * from USERS where `GROUP`=$grid ORDER BY `HANDLE`";
	$quGetUsers = mysqli_query($dbh, $quStrGetUsers) or die (mysqli_error($dbh));





// AGENCY_HEADERS
if ($vid==9 && $agcy>0)
{
	$quStrGetAgencies = "SELECT * FROM AGENCIES WHERE GID=$grid";
	$quGetAgencies = mysqli_query($dbh, $quStrGetAgencies) or die ($quStrGetAgencies);
	$num_agencies=mysqli_num_rows($quGetAgencies);
	if($num_agencies>0)
	{
		while($rowAgency = mysqli_fetch_object($quGetAgencies))
		{
			$arrayAgency[$rowAgency->AGENCY_ID]=$rowAgency->AGENCY_NAME;
		}
	}
}

//$LISTINGS_FILTER = $rowGetView['FILTER'] . " AND CLI=$grid";
//$ORDERBY = $rowGetView['SORT'];

$k = 1;

$actions['edit'] = "adlEdit";
$actions['edit ad'] = "adlEdit";
$actions['view'] = "adlEdit";
$actions['map'] = "map";
$actions['delete'] = "delete";
$actions['email'] = "mail_listing";


$cols = split (",", $rowGetView['COLUMNS']);

$numCols = count ($cols);


for ($i=0;$i<$numCols;$i++) {
	$cols[$i] = split ("~", $cols[$i]);
}

$quStrLimitCount = "SELECT COUNT(CID) as count FROM ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID $WHERE ";
$quLimitCount = mysqli_query($dbh, $quStrLimitCount) or die (dieNice("Sorry, I could not find an exact match to your search and pagenate your listings. Please click \"Listings\" in the menu and clear and try another search. You can use the \"Quick Search\" to find listings that you may not be able to get an exact match . $WHERE", "E-200"));
//$num_rows = mysqli_num_rows($quLimitCount);
$nRowsQ = mysqli_fetch_object($quLimitCount);
$num_rows=$nRowsQ->count;

$numPages = ceil($num_rows / $limitN);

//Filter Display String //
session_register ("switch_remember");
session_register ("filter_string_display");

if($HTTP_GET_VARS['client_id_filter'])
{
	$clientFilterStr="SELECT * FROM CLIENTS WHERE CLID=".$HTTP_GET_VARS['client_id_filter'];
	$clientFilterQ=mysqli_query($dbh, $clientFilterStr);
	$clientFilterO=mysqli_fetch_object($clientFilterQ);
}




if ($_POST['filterChange']) {

	$preFilters_str = array();
	$switch_remember = array();
	$preFilters_str[1] = array($_POST['type'], "CLASS.TYPE", "=", "Type");
	$switch_remember['type'] = $_POST['type'];
	$preFilters_str[2] = array($_POST['loc'], "LOC.LOCID", "=", "Location");
	$switch_remember['loc'] = $_POST['loc'];
	$preFilters_str[3] = ($_POST['priceStart'][0]> 1) ? array($_POST['priceStart'], "PRICE", ">=", "Price Min") : "";
	$switch_remember['priceStart'] = $_POST['priceStart'][0];
	$preFilters_str[4] = ($_POST['priceEnd'][0] > 1) ? array($_POST['priceEnd'], "PRICE", "<=", "Price Max") : "";
	$switch_remember['priceEnd'] = $_POST['priceEnd'][0];
	$preFilters_str[5] = array($_POST['rooms'], "ROOMS", "=", "Bedrooms");
	$switch_remember['rooms'] = $_POST['rooms'];
	$preFilters_str[6] = array($_POST['bath'], "BATH", "=", "Bathrooms");
	$switch_remember['bath'] = $_POST['bath'];
	$preFilters_str[7] = array($_POST['pets'], "PETSA", "=", "Pets");
	$switch_remember['pets'] = $_POST['pets'];
	$preFilters_str[8] = ($_POST['status'][0]) ? array($_POST['status'], "CLASS.STATUS", "=", "Advertising") : "";
	$switch_remember['status'] = $_POST['status'][0];
	$preFilters_str[9] = ($_POST['status_vacant'][0]) ? array($_POST['status_vacant'], "STATUS_VACANT", "=", "Vacant") : "";
	$switch_remember['status_vacant'] = $_POST['status_vacant'][0];
	$preFilters_str[10] = ($_POST['status_active'][0]) ? array($_POST['status_active'], "STATUS_ACTIVE", "=", "Available") : "";
	$switch_remember['status_active'] = $_POST['status_active'][0];
	$preFilters_str[11] = ($begin_date) ? array($begin_date, "CLASS.AVAIL", ">=", "Available begin date") : "";
	$switch_remember['bbbmonth'] = $_POST['bbbmonth'];
	$switch_remember['bbbday'] = $_POST['bbbday'];
	$switch_remember['bbbyear'] = $_POST['bbbyear'];
	$preFilters_str[12] = ($end_date) ? array($end_date, "CLASS.AVAIL", "=<", "Available end date") : "";
	$switch_remember['bbemonth'] = $_POST['bbemonth'];
	$switch_remember['bbeday'] = $_POST['bbeday'];
	$switch_remember['bbeyear'] = $_POST['bbeyear'];
	$preFilters_str[13] = array($_POST['landlord'], "CLASS.LANDLORD", "=", "Landlord");
	$switch_remember['landlord'] = $_POST['landlord'];
	$preFilters_str[14] = array($_POST['listing_type'], "CLASS.LISTING_TYPE", "=", "Listing Type");
	$switch_remember['listing_type'] = $_POST['listing_type'];
	$preFilters_str[15] = array($_POST['lease_type'], "CLASS.LEASE_TYPE", "=", "Lease Type");
	$switch_remember['lease_type'] = $_POST['lease_type'];
	$preFilters_str[16] = ($_POST['terms'][0]) ? array($_POST['terms'], "CLASS.TERMS", "=", "Lease Terms") : "";
	$switch_remember['terms'] = $_POST['terms'][0];
	$preFilters_str[17] = array($_POST['tax_clause'], "CLASS.TAX_CLAUSE", "=", "Tax Clause");
	$switch_remember['tax_clause'] = $_POST['tax_clause'];
	$preFilters_str[18] = ($_POST['tenant_fee'][0]) ? array($_POST['tenant_fee'], "CLASS.TENANT_FEE", "=", "Tenant Fee") : "";
	$switch_remember['tenant_fee'] = $_POST['tenant_fee'][0];
	$preFilters_str[19] = ($_POST['landlord_fee'][0]) ? array($_POST['landlord_fee'], "CLASS.LANDLORD_FEE", "=", "Landlord Fee") : "";
	$switch_remember['landlord_fee'] = $_POST['landlord_fee'][0];
	$preFilters_str[20] = ($_POST['payment_first'][0]) ? array($_POST['payment_first'], "CLASS.PAYMENT_FIRST", "=", "First Month Payment") : "";
	$switch_remember['payment_first'] = $_POST['payment_first'][0];
	$preFilters_str[21] = ($_POST['payment_last'][0]) ? array($_POST['payment_last'], "CLASS.PAYMENT_LAST", "=", "Last Month Payment") : "";
	$switch_remember['payment_last'] = $_POST['payment_last'][0];
	$preFilters_str[22] = ($_POST['payment_sec'][0]) ? array($_POST['payment_sec'], "CLASS.PAYMENT_SEC", "=", "Security Deposit") : "";
	$switch_remember['payment_sec'] = $_POST['payment_sec'][0];
	$preFilters_str[23] = ($_POST['key_deposit'][0]) ? array($_POST['key_deposit'], "CLASS.KEY_DEPOSIT", "=", "Key Deposit") : "";
	$switch_remember['key_deposit'] = $_POST['key_deposit'][0];
	$preFilters_str[24] = ($_POST['clean_deposit'][0]) ? array($_POST['clean_deposit'], "CLASS.CLEAN_DEPOSIT", "=", "Clean Deposit") : "";
	$switch_remember['clean_deposit'] = $_POST['clean_deposit'][0];
	$preFilters_str[25] = ($_POST['fee_comments'][0]) ? array($_POST['fee_comments'], "CLASS.FEE_COMMENTS", "=", "Fee Comments") : "";
	$switch_remember['fee_comments'] = $_POST['fee_comments'][0];
	$preFilters_str[26] = ($_POST['parking_num'][0]) ? array($_POST['parking_num'], "CLASS.PARKING_NUM", "=", "Number of Parking Spaces") : "";
	$switch_remember['parking_num'] = $_POST['parking_num'];
	$preFilters_str[27] = array($_POST['parking_type'], "CLASS.PARKING_TYPE", "=", "Type of Parking Spaces");
	$switch_remember['parking_type'] = $_POST['parking_type'];
	$preFilters_str[28] = ($_POST['parking_cost'][0]) ? array($_POST['parking_cost'], "CLASS.PARKING_COST", "=", "Cost per Parking Space") : "";
	$switch_remember['parking_cost'] = $_POST['parking_cost'][0];
	$preFilters_str[29] = array($_POST['features_deleaded'], "CLASS.FEATURES_DELEADED","=", "Features: Deleaded" );
	$switch_remember['features_deleaded'] = $_POST['features_deleaded'];
	$preFilters_str[30] = array($_POST['features_furnished'], "CLASS.FEATURES_FURNISHED","=", "Features: Furnished" );
	$switch_remember['features_furnished']  = $_POST['features_furnished'];
	$preFilters_str[31] = array($_POST['features_non_smoking'], "CLASS.FEATURES_NON_SMOKING","=", "Features: Non Smoking" );
	$switch_remember['features_non_smoking'] = $_POST['features_non_smoking'];
	$preFilters_str[32] = array($_POST['features_alarm'], "CLASS.FEATURES_ALARM","=", "Features: Alarm" );
	$switch_remember['features_alarm'] = $_POST['features_alarm'];
	$preFilters_str[33] = array($_POST['features_heat'], "CLASS.FEATURES_HEAT","=", "Features: Heat" );
	$switch_remember['features_heat'] = $_POST['features_heat'];
	$preFilters_str[34] = array($_POST['features_hot_water'], "CLASS.FEATURES_HOT_WATER","=", "Features: Hot Water" );
	$switch_remember['features_hot_water'] = $_POST['features_hot_water'];
	$preFilters_str[35] = array($_POST['features_ht_and_hw'], "CLASS.FEATURES_HT_AND_HW","=", "Features: Heat and Hot Water" );
	$switch_remember['features_ht_and_hw'] = $_POST['features_ht_and_hw'];
	$preFilters_str[36] = array($_POST['features_all_utilities'], "CLASS.FEATURES_ALL_UTILITIES","=", "Features: All Utilities" );
	$switch_remember['features_all_utilities'] = $_POST['features_all_utilities'];
	$preFilters_str[37] = array($_POST['features_gas_heat'], "CLASS.FEATURES_GAS_HEAT","=", "Features: Gas Heat" );
	$switch_remember['features_gas_heat'] = $_POST['features_gas_heat'];
	$preFilters_str[38] = array($_POST['features_oil_heat'], "CLASS.FEATURES_OIL_HEAT","=", "Features: Oil Heat" );
	$switch_remember['features_oil_heat']  = $_POST['features_oil_heat'];
	$preFilters_str[39] = array($_POST['features_elec_heat'], "CLASS.FEATURES_ELEC_HEAT","=", "Features: Elec Heat" );
	$switch_remember['features_elec_heat'] = $_POST['features_elec_heat'];
	$preFilters_str[40] = array($_POST['features_hwfi'], "CLASS.FEATURES_HWFI","=", "Features: Hardwood Floors" );
	$switch_remember['features_hwfi'] = $_POST['features_hwfi'];
	$preFilters_str[41] = array($_POST['features_fireplace_working'], "CLASS.FEATURES_FIREPLACE_WORKING","=", "Features: Working Fireplace" );
	$switch_remember['features_fireplace_working'] = $_POST['features_fireplace_working'];
	$preFilters_str[42] = array($_POST['features_carpet'], "CLASS.FEATURES_CARPET","=", "Features: Carpet" );
	$switch_remember['features_carpet'] = $_POST['features_carpet'];
	$preFilters_str[43] = array($_POST['features_modern_kitchen'], "CLASS.FEATURES_MODERN_KITCHEN","=", "Features: Modern Kitchen" );
	$switch_remember['features_modern_kitchen'] = $_POST['features_modern_kitchen'];
	$preFilters_str[44] = array($_POST['features_kitchenette'], "CLASS.FEATURES_KITCHENETTE","=", "Features: Kitchenette" );
	$switch_remember['features_kitchenette'] = $_POST['features_kitchenette'];
	$preFilters_str[45] = array($_POST['features_eat_in_kitchen'], "CLASS.FEATURES_EAT_IN_KITCHEN","=", "Features: Eat In Kitchen" );
	$switch_remember['features_eat_in_kitchen'] = $_POST['features_eat_in_kitchen'];
	$preFilters_str[46] = array($_POST['features_gas_range'], "CLASS.FEATURES_GAS_RANGE","=", "Features: Gas Range" );
	$switch_remember['features_gas_range'] = $_POST['features_gas_range'];
	$preFilters_str[47] = array($_POST['features_elec_range'], "CLASS.FEATURES_ELEC_RANGE","=", "Features: Elec Range" );
	$switch_remember['features_elec_range'] = $_POST['features_elec_range'];
	$preFilters_str[48] = array($_POST['features_disposal'], "CLASS.FEATURES_DISPOSAL","=", "Features: Disposal" );
	$switch_remember['features_disposal'] = $_POST['features_disposal'];
	$preFilters_str[49] = array($_POST['features_dishwasher'], "CLASS.FEATURES_DISHWASHER","=", "Features: Dishwasher" );
	$switch_remember['features_dishwasher']  = $_POST['features_dishwasher'];
	$preFilters_str[50] = array($_POST['features_skylight'], "CLASS.FEATURES_SKYLIGHT","=", "Features: Skylight" );
	$switch_remember['features_skylight'] = $_POST['features_skylight'];
	$preFilters_str[51] = array($_POST['features_porch'], "CLASS.FEATURES_PORCH","=", "Features: Porch" );
	$switch_remember['features_porch'] = $_POST['features_porch'];
	$preFilters_str[52] = array($_POST['features_balcony'], "CLASS.FEATURES_BALCONY","=", "Features: Balcony" );
	$switch_remember['features_balcony'] = $_POST['features_balcony'];
	$preFilters_str[53] = array($_POST['features_patio'], "CLASS.FEATURES_PATIO","=", "Features: Patio" );
	$switch_remember['features_patio'] = $_POST['features_patio'];
	$preFilters_str[54] = array($_POST['features_central_ac'], "CLASS.FEATURES_CENTRAL_AC","=", "Features: Central AC" );
	$switch_remember['features_central_ac'] = $_POST['features_central_ac'];
	$preFilters_str[55] = array($_POST['features_ac'], "CLASS.FEATURES_AC","=", "Features: AC" );
	$switch_remember['features_ac'] = $_POST['features_ac'];
	$preFilters_str[56] = array($_POST['features_deck'], "CLASS.FEATURES_DECK","=", "Features: Deck" );
	$switch_remember['features_deck'] = $_POST['features_deck'];
	$preFilters_str[57] = array($_POST['features_modern_bath'], "CLASS.FEATURES_MODERN_BATH","=", "Features: Modern Bath" );
	$switch_remember['features_modern_bath'] = $_POST['features_modern_bath'];
	$preFilters_str[58] = array($_POST['features_dinning_room'], "CLASS.FEATURES_DINNING_ROOM","=", "Features: Dining Room");
	$switch_remember['features_dinning_room'] = $_POST['features_dinning_room'];
	$preFilters_str[59] = array($_POST['amenities_conciearge'], "CLASS.AMENITIES_CONCIEARGE","=", "Amenities: Conciearge ");
	$switch_remember['amenities_conciearge'] = $_POST['amenities_conciearge'];
	$preFilters_str[60] = array($_POST['amenities_elevator'], "CLASS.AMENITIES_ELEVATOR","=", "Amenities: Elevator ");
	$switch_remember['amenities_elevator'] = $_POST['amenities_elevator'];
	$preFilters_str[61] = array($_POST['amenities_deck'], "CLASS.AMENITIES_DECK","=", "Amenities: Deck ");
	$switch_remember['amenities_deck'] = $_POST['amenities_deck'];
	$preFilters_str[62] = array($_POST['amenities_roof_deck'], "CLASS.AMENITIES_ROOF_DECK","=", "Amenities: Roof Deck ");
	$switch_remember['amenities_roof_deck'] = $_POST['amenities_roof_deck'];
	$preFilters_str[63] = array($_POST['amenities_garden'], "CLASS.AMENITIES_GARDEN","=", "Amenities: Garden ");
	$switch_remember['amenities_garden'] = $_POST['amenities_garden'];
	$preFilters_str[64] = array($_POST['amenities_yard'], "CLASS.AMENITIES_YARD","=", "Amenities: Yard ");
	$switch_remember['amenities_yard'] = $_POST['amenities_yard'];
	$preFilters_str[65] = array($_POST['amenities_security'], "CLASS.AMENITIES_SECURITY","=", "Amenities: Security ");
	$switch_remember['amenities_security'] = $_POST['amenities_security'];
	$preFilters_str[66] = array($_POST['amenities_health_club'], "CLASS.AMENITIES_HEALTH_CLUB","=", "Amenities: Health Club ");
	$switch_remember['amenities_health_club'] = $_POST['amenities_health_club'];
	$preFilters_str[67] = array($_POST['amenities_pool'], "CLASS.AMENITIES_POOL","=", "Amenities: Pool ");
	$switch_remember['amenities_pool'] = $_POST['amenities_pool'];
	$preFilters_str[68] = array($_POST['amenities_tennis'], "CLASS.AMENITIES_TENNIS","=", "Amenities: Tennis ");
	$switch_remember['amenities_tennis'] =$_POST['amenities_tennis'];
	$preFilters_str[69] = array($_POST['amenities_lounge'], "CLASS.AMENITIES_LOUNGE","=", "Amenities: Lounge ");
	$switch_remember['amenities_lounge'] = $_POST['amenities_lounge'];
	$preFilters_str[70] = array($_POST['amenities_sauna'], "CLASS.AMENITIES_SAUNA","=", "Amenities: Sauna ");
	$switch_remember['amenities_sauna'] = $_POST['amenities_sauna'];
	$preFilters_str[71] = array($_POST['amenities_high_ceilings '], "CLASS.AMENITIES_HIGH_CEILINGS","=", "Amenities: High Ceilings ");
	$switch_remember['amenities_high_ceilings '] = $_POST['amenities_high_ceilings '];
	$preFilters_str[72] = array($_POST['amenities_balcony '], "CLASS.AMENITIES_BALCONY","=", "Amenities: Balcony ");
	$switch_remember['amenities_balcony '] = $_POST['amenities_balcony '];
	$preFilters_str[73] = array($_POST['amenities_deck2'], "CLASS.AMENITIES_DECK2","=", "Amenities: Deck2");
	$switch_remember['amenities_deck2'] = $_POST['amenities_deck2'];
	$preFilters_str[74] = array($_POST['amenities_elevator_building'], "CLASS.AMENITIES_ELEVATOR_BUILDING","=", "Amenities: Elevator Building");
	$switch_remember['amenities_elevator_building'] = $_POST['amenities_elevator_building'];
	$preFilters_str[75] = array($_POST['featues_walk_in_closet'], "CLASS.FEATURES_WALK_IN_CLOSET","=", "Features: Walk In Closet ");
	$switch_remember['amenities_walk_in_closet'] = $_POST['features_walk_in_closet'];
	$preFilters_str[76] = array($_POST['building_type'], "CLASS.BUILDING_TYPE","=", "Building Type");
	$switch_remember['building_type'] = $_POST['building_type'];
	$preFilters_str[77] = array($_POST['laundry_room'], "CLASS.LAUNDRY_ROOM","=", "Laundry Room");
	$switch_remember['laundry_room'] = $_POST['laundry_room'];
	$preFilters_str[78] = array($_POST['amenities_attic'], "CLASS.AMENITIES_ATTIC","=", "Storage: Attic");
	$switch_remember['amenities_attic'] = $_POST['amenities_attic'];
	$preFilters_str[79] = array($_POST['amenities_bin'], "CLASS.AMENITIES_BIN","=", "Storage: Bin");
	$switch_remember['amenities_bin'] = $_POST['amenities_bin'];
	$preFilters_str[80] = array($_POST['amenities_basement'], "CLASS.AMENITIES_BASEMENT","=", "Storage: Basement");
	$switch_remember['amenities_basement'] = $_POST['amenities_basement'];
	$preFilters_str[81] = ($_POST['tenant_name'][0]) ? array($_POST['tenant_name'], "CLASS.TENANT_NAME","=", "Tenant Name") : "";
	$switch_remember['tenant_name'] = $_POST['tenant_name'][0];
	$preFilters_str[82] = ($_POST['tenant_phone'][0]) ? array($_POST['tenant_phone'], "CLASS.TENANT_PHONE","=", "Tenant Phone") : "";
	$switch_remember['tenant_phone'] = $_POST['tenant_phone'][0];
	$preFilters_str[83] = array($_POST['key_info'], "CLASS.KEY_INFO","=", "Key Info");
	$switch_remember['key_info'] = $_POST['key_info'];
	$preFilters_str[84] = array($_POST['students'], "CLASS.STUDENTS","=", "Students");
	$switch_remember['students'] = $_POST['students'];
	$preFilters_str[85] = ($_POST['alarm'][0]) ? array($_POST['alarm'], "CLASS.ALARM","=", "Alarm Code") : "";
	$switch_remember['alarm'] = $_POST['alarm'][0];
	$preFilters_str[86] = array($lease_expire, "CLASS.LEASE_EXPIRE", "=", "Lease Expiration Date");
	$switch_remember['bbbLEMonth'] = $_POST['bbbLEMonth'];
	$switch_remember['bbbLEYear'] = $_POST['bbbLEYear'];
	$switch_remember['bbbLEDay'] = $_POST['bbbLEDay'];
	$preFilters_str[87] =  array($_POST['rented_by'], "CLASS.RENTED_BY","=", "Listing Status");
	$switch_remember['rented_by'] = $_POST['rented_by'];
	$preFilters_str[88] = array($_POST['nofee'], "CLASS.NOFEE", "=", "Fee");
	$switch_remember['nofee'] = $_POST['nofee'];
	$preFilters_str[89] = array($_POST['school'], "CLASS.SCHOOL", "=", "Colleges");
	$switch_remember['school'] = $_POST['school'];
	$preFilters_str[90] = array($_POST['status_not_active'], "STATUS_ACTIVE", "!=", "Available");
	$switch_remember['status_not_active'] = $_POST['status_not_active'][0];
	$preFilters_str[91] =  ($_POST['street_num'][0]) ? array($_POST['street_num'], "CLASS.STREET_NUM", "=", "Street Number") : "";
	$switch_remember['street_num'] = $_POST['street_num'];
	$preFilters_str[92] =  array($_POST['street'], "CLASS.STREET", " LIKE ", "Street Name");
	$switch_remember['street'] = $_POST['street'];
	$preFilters_str[93] = array($_POST['features_pantry'], "CLASS.FEATURES_PANTRY","=", "Features: Pantry");
	$switch_remember['features_pantry'] = $_POST['features_pantry'];
	$preFilters_str[94] = array($_POST['features_microwave'], "CLASS.FEATURES_MICROWAVE","=", "Features: Microwave");
	$switch_remember['features_microwave'] = $_POST['features_microwave'];
	$preFilters_str[95] = array($_POST['features_enclosed_porch'], "CLASS.FEATURES_ENCLOSED_PORCH","=", "Features: Enclosed Porch");
	$switch_remember['features_enclosed_porch'] = $_POST['features_enclosed_porch'];
	$preFilters_str[96] = array($_POST['features_high_speed_internet'], "CLASS.FEATURES_INTERNET","=", "Features: High Speed Internet");
	$switch_remember['features_high_speed_internet'] = $_POST['features_high_speed_internet'];
	$preFilters_str[97] = array($_POST['features_duplex'], "CLASS.FEATURES_DUPLEX","=", "Features: Duplex");
	$switch_remember['features_duplex'] = $_POST['features_duplex'];
	$preFilters_str[98] = array($_POST['amenities_superintendant'], "CLASS.AMENITIES_SUPERINTENDANT","=", "Amenities: Superintendent");
	$switch_remember['amenities_superintendant'] = $_POST['amenities_superintendant'];
	$preFilters_str[99] = array($_POST['amenities_on_site_management'], "CLASS.AMENITIES_ON_SITE_MANAGEMENT","=", "Amenities: On Site Management");
	$switch_remember['amenities_on_site_management'] = $_POST['amenities_on_site_management'];
	$preFilters_str[100] = array($_POST['features_fireplace_decor'], "CLASS.FEATURES_FIREPLACE_DECOR","=", "Features: Decorative Fireplace" );
	$switch_remember['features_fireplace_decor'] = $_POST['features_fireplace_decor'];
	$preFilters_str[101] = array($_POST['building_style'], "CLASS.BUILDING_STYLE","=", "Building Style");
	$switch_remember['building_style'] = $_POST['building_style'];
	$preFilters_str[102] =  array($_POST['uid'], "CLASS.UID", "=", "Agent");
	$preFilters_str[103] =  array($_POST['features_not_furnished'], "CLASS.FEATURES_FURNISHED", "!=", "Not Furnished");
	$switch_remember['features_not_furnished'] = $_POST['features_not_furnished'][0];
	$preFilters_str[104] = array($_POST['amenities_subway'], "CLASS.AMENITIES_SUBWAY","=", "Features: Subway");
	$switch_remember['amenities_subway'] = $_POST['amenities_subway'];
	$preFilters_str[105] = array($_POST['amenities_crail'], "CLASS.AMENITIES_CRAIL","=", "Features: Commuter Rail");
	$switch_remember['amenities_crail'] = $_POST['amenities_crail'];
	$preFilters_str[106] = array($_POST['amenities_bus'], "CLASS.AMENITIES_BUS","=", "Features: Bus");
	$switch_remember['amenities_bus'] = $_POST['amenities_bus'];
	$preFilters_str[107] = array($_POST['amenities_shuttle'], "CLASS.AMENITIES_SHUTTLE","=", "Features: Shuttle Bus");
	$switch_remember['amenities_shuttle'] = $_POST['amenities_shuttle'];

	$preFilters_str[108] = ($_POST['zip'][0]) ? array($_POST['zip'], "CLASS.ZIP", "=", "Zip Code") : "";
	$switch_remember['zip'] = $_POST['zip'][0];

	$preFilters_str[109] = array($_POST['amenities_owner_occupied'], "CLASS.AMENITIES_OWNER_OCCUPIED","=", "Features: Owner Occupied");
	$switch_remember['amenities_owner_occupied'] = $_POST['amenities_owner_occupied'];

	$preFilters_str[110] = array($_POST['features_electricity'], "CLASS.FEATURES_ELECTRICITY","=", "Features: Electricity");
	$switch_remember['features_electricity'] = $_POST['features_electricity'];

	$preFilters_str[111] = array($_POST['amenities_clubhouse'], "CLASS.AMENITIES_CLUBHOUSE","=", "Amenities: Club House");
	$switch_remember['amenities_clubhouse'] = $_POST['amenities_clubhouse'];

	$preFilters_str[112] = array($_POST['amenities_businesscenter'], "CLASS.AMENITIES_BUSINESSCENTER","=", "Amenities: Business Center");
	$switch_remember['amenities_businesscenter'] = $_POST['amenities_businesscenter'];

	$preFilters_str[113] = array($_POST['amenities_wheelchair'], "CLASS.AMENITIES_WHEELCHAIR","=", "Amenities: Wheelchair Accessable");
	$switch_remember['amenities_wheelchair'] = $_POST['amenities_wheelchair'];

	$preFilters_str[114] = array($_POST['exterior'], "CLASS.EXTERIOR","=", "Exterior");

	$preFilters_str[115] = array($_POST['features_kitchen_galley'], "CLASS.FEATURES_KITCHEN_GALLEY","=", "Features: Galley Kitchen" );
	$switch_remember['features_kitchen_galley'] = $_POST['features_kitchen_galley'];

	$preFilters_str[116] =  array($_POST['Deactivated'], "CLASS.STATUS", "!=", "Deactivated");
	$switch_remember['Deactivated'] = $_POST['Deactivated'][0];


	$preFilters_str[117] = ($_POST['pic'][0]> 0) ? array($_POST['pic'], "PIC", ">", "Has Pics") : "";

	$preFilters_str[118] = array($_POST['not_deleaded'], "CLASS.NOT_DELEADED","=", "Not Deleaded" );


	$preFilters_str[119] = ($_POST['status_pending'][0]) ? array($_POST['status_pending'], "STATUS_PENDING", "=", "Pending") : "";
	$switch_remember['status_pending'] = $_POST['status_pending'][0];


	$preFilters_str[120] = array($_POST['modby'], "MODBY", "=", "Mod by");
	$switch_remember['modby'] = $_POST['modby'];

	$switch_remember['exterior'] = $_POST['exterior'];
	$switch_remember['uid'] = $_POST['uid'];

	$preFilters_str[121] =  ($_POST['street_num_begin'][0]) ? array($_POST['street_num_begin'], "CLASS.STREET_NUM", ">=", "Street # Begin") : "";
	$switch_remember['street_num_begin'] = $_POST['street_num_begin'];

	$preFilters_str[122] =  ($_POST['street_num_end'][0]) ? array($_POST['street_num_end'], "CLASS.STREET_NUM", "<=", "Street # End") : "";
	$switch_remember['street_num_end'] = $_POST['street_num_end'];

	$preFilters_str[123] = array($_POST['amenities_not_owner_occupied'], "CLASS.AMENITIES_NOT_OWNER_OCCUPIED","=", "Not Owner Occupied");
	$switch_remember['amenities_not_owner_occupied'] = $_POST['amenities_not_owner_occupied'];


	$preFilters_str[124] = array($_POST['agency'], "CLASS.AGENCY_HEADERS","=", "Office");
	$switch_remember['agency'] = $_POST['agency'];



	
	if ($_POST['sourcemls']=="1075") {
		$defaultmls = "2";
		$switch_remember['sourcemls'] = '1075';

		
	} elseif  ($_POST['sourcemls']=="1075A") {
		$defaultmls = "3";
		$switch_remember['sourcemls'] = '1075A';
	} elseif  ($_POST['sourcemls']=="BA") {
		$defaultmls = "4";
		$switch_remember['sourcemls'] = 'BA';
	}
		
		
		
}  else {
	$defaultmls = "1";
	$switch_remember['sourcemls'] = $grid;
	}
	
	
if($clientFilterO->CLID)
{
        $preFilters_str = array();
        $switch_remember = array();
	$preFilters_str[1] = array($clientFilterO->TYPE_PREF, "CLASS.TYPE", "=", "Type");
	$switch_remember['type'] = $clientFilterO->TYPE_PREF;
	if(preg_match('/,/',$clientFilterO->LOC_PREF))
	{
	   $location_list=preg_split('/,/',$clientFilterO->LOC_PREF);
	   $preFilters_str[2] = array($location_list, "LOC.LOCID", "=", "Location");
	   $switch_remember['loc'] = $location_list;
	} else {
          $preFilters_str[2] = array($clientFilterO->LOC_PREF, "LOC.LOCID", "=", "Location");
          $switch_remember['loc'] = $clientFilterO->LOC_PREF;
	}
	$preFilters_str[3] = ($clientFilterO->PRICEMIN > 1) ? array($clientFilterO->PRICEMIN, "PRICE", ">=", "Price Min") : "";
	$switch_remember['priceStart'] = $clientFilterO->PRICEMIN;
        $preFilters_str[4] = ($clientFilterO->PRICEMAX > 1) ? array($clientFilterO->PRICEMAX, "PRICE", "<=", "Price Max") : "";
        $switch_remember['priceEnd'] = $clientFilterO->PRICEMAX;
	if(preg_match('/,/',$clientFilterO->ROOMS_PREF))
	{
	   $rooms_list=preg_split('/,/',$clientFilterO->ROOMS_PREF);
	   $preFilters_str[5] = array($rooms_list, "ROOMS", "=", "Bedrooms");
	   $switch_remember['rooms'] = $rooms_list;
	} else {
	   $preFilters_str[5] = array($clientFilterO->ROOMS_PREF, "ROOMS", "=", "Bedrooms");
	   $switch_remember['rooms'] = $clientFilterO->ROOMS_PREF;
        }
	if(preg_match('/,/',$clientFilterO->BATH_PREF))
	{
	   $baths_list=preg_split('/,/',$clientFilterO->BATH_PREF);
	   $preFilters_str[6] = array($baths_list, "BATH", "=", "Bathrooms");
	   $switch_remember['bath'] = $baths_list;
	} else {
	   $preFilters_str[6] = array($clientFilterO->BATH_PREF, "BATH", "=", "Bathrooms");
           $switch_remember['bath'] = $clientFilterO->BATH_PREF;
	}
	if(preg_match('/,/', $clientFilterO->PETS_PREF))
	{
            $pets_list=preg_split('/,/',$clientFilterO->PETS_PREF);
	    $preFilters_str[7] = array($pets_list, "PETSA", "=", "Pets");
	    $switch_remember['pets'] = $pets_list;
	} else {
	    $preFilters_str[7] = array($clientFilterO->PETS_PREF, "PETSA", "=", "Pets");
	    $switch_remember['pets'] = $clientFilterO->PETS_PREF;
	}
	if($clientFilterO->DATE_MOVEIN)
	{
	   $preFilters_str[11] = ($clientFilterO->DATE_MOVEIN) ? array($clientFilterO->DATE_MOVEIN, "CLASS.AVAIL", ">=", "Available begin date") : "";
	   $date_list=preg_split('/-/', $clientFilterO->DATE_MOVEIN);
	   $bbbyear=$date_list[0];
	   $bbbmonth=$date_list[1];
	   $bbbday=$date_list[2];
	   $switch_remember['bbbmonth'] = $bbbmonth;
           $switch_remember['bbbday'] = $bbbday;
           $switch_remember['bbbyear'] = $bbbyear;
	}

	if($clientFilterO->DATE_MOVEIN_END)
	{
	   $preFilters_str[12] = ($clientFilterO->DATE_MOVEIN_END) ? array($clientFilterO->DATE_MOVEIN_END, "CLASS.AVAIL", "<=", "Available end date") : "";
	   $date_list=preg_split('/-/', $clientFilterO->DATE_MOVEIN_END);
	   $bbeyear=$date_list[0];
	   $bbemonth=$date_list[1];
	   $bbeday=$date_list[2];
	   $switch_remember['bbemonth'] = $bbemonth;
           $switch_remember['bbeday'] = $bbeday;
           $switch_remember['bbeyear'] = $bbeyear;
	}



	if($clientFilterO->CLIENT_SHORTTERM)
	{
	   $preFilters_str[15] = array(array("3.5"),"CLASS.LEASE_TYPE", "=","Lease Type");
	   $switch_remember['lease_type'] = 3.5;
	}
	if($clientFilterO->CLIENT_FURNISHED)
	{
	   $preFilters_str[30] = array(array("1") , "CLASS.FEATURES_FURNISHED","=", "Features: Furnished" );
	   $switch_remember['features_furnished']  = "1";
	}
}

if ($_POST['filterChange'] || $clientFilterO->CLID) {
	$filters_str = array();
	$i = 0;
	foreach ($preFilters_str as $preFilter_str) {
		if ($preFilter_str[0]) {
			if (is_array($preFilter_str[0])) {
				$tempArr_str = $preFilter_str[0];
				$numTempArr_str = count($tempArr_str);
				foreach ($tempArr_str as $key_str => $value_str) {
					if ($preFilter_str[1] == "LOC.LOCID") {
						$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $LOC_ARRAY[$value_str] . "' ");
					}elseif ($preFilter_str[1] == "CLASS.TYPE") {
						$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $TYPE_ARRAY[$value_str] . "' ");
					}elseif ($preFilter_str[1] == "CLASS.LANDLORD") {
						$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $LL_ARRAY[$value_str] . "' ");
					}elseif ($preFilter_str[1] == "PRICE" || $preFilter_str[1] == "CLASS.TENANT_FEE" || $preFilter_st[1] == "CLASS.LANDLORD_FEE" || $preFilter_str[1] == "CLASS.PAYMENT_FIRST" || $preFilter_str[1] == "CLASS.PAYMENT_LAST" || $preFilter_str[1] == "CLASS.PAYMENT_SEC" || $preFilter_str[1] == "CLASS.KEY_DEPOSIT" || $preFilter_str[1] == "CLASS.CLEAN_DEPOSIT" || $preFilter_str[1] == "CLASS.FEE_COMMENTS" || $preFilter_str[1] == "CLASS.PARKING_NUM" || $preFilter_str[1] == "CLASS.PARKING_COST" || $preFilter_str[1] == "CLASS.TENANT_NAME" || $preFilter_str[1] == "CLASS.TENANT_PHONE" || $preFilter_str[1] == "CLASS.ALARM" || $preFilter_str[1] == "CLASS.TERMS" || $preFilter_str[1] == "CLASS.ZIP" || $preFilter_str[1] == "CLASS.STREET" || $preFilter_str[1] == "CLASS.STREET_NUM") {
						$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $value_str  . "' ");
					}elseif ($preFilter_str[1] == "CLASS.STATUS" || $preFilter_str[1] == "STATUS_VACANT" || $preFilter_str[1] == "STATUS_ACTIVE" || $preFilter_str[1] == "STATUS_PENDING" || $preFilter_str[1] == "CLASS.STORAGE_BIN" || $preFilter_str[1] == "CLASS.STORAGE_ATTIC" || $preFilter_str[1] == "CLASS.STORAGE_BASEMENT") {
						$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $value_str  . "' ");
					}elseif ($preFilter_str[1] == "CLASS.AVAIL" || $preFilter_str[1] == "CLASS.LEASE_EXPIRE") {
						$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $preFilter_str[0]  . "' ");
					}else {
						$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $DEFINED_VALUE_SETS[str_replace ("CLASS.", "", $preFilter_str[1])][$value_str] . "' ");
					}
					if ($key_str < ($numTempArr_str-1)) {
						$tempStr_str.= " <font color=\"#000000\">OR</font> ";
					}
				}
				$filters_str[$i] = $tempStr_str;
				$tempStr_str = "";
				$i++;
			}else{
				$value_str=$preFilter_str[0];
				if ($preFilter_str[1] == "LOC.LOCID") {
					$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $LOC_ARRAY[$value_str] . "' ");
				}elseif ($preFilter_str[1] == "CLASS.TYPE") {
					$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $TYPE_ARRAY[$value_str] . "' ");
				}elseif ($preFilter_str[1] == "CLASS.LANDLORD") {
					$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $LL_ARRAY[$preFilter_str[0]] . "' ");
				}elseif ($preFilter_str[1] == "PRICE" || $preFilter_str[1] == "CLASS.TENANT_FEE" || $preFilter_str[1] == "CLASS.LANDLORD_FEE" || $preFilter_str[1] == "CLASS.PAYMENT_FIRST" || $preFilter_str[1] == "CLASS.PAYMENT_LAST" || $preFilter_str[1] == "CLASS.PAYMENT_SEC" || $preFilter_str[1] == "CLASS.KEY_DEPOSIT" || $preFilter_str[1] == "CLASS.CLEAN_DEPOSIT" || $preFilter_str[1] == "CLASS.FEE_COMMENTS" || $preFilter_str[1] == "CLASS.PARKING_NUM" || $preFilter_str[1] == "CLASS.PARKING_COST" || $preFilter_str[1] == "CLASS.TENANT_NAME" || $preFilter_str[1] == "CLASS.TENANT_PHONE" || $preFilter_str[1] == "CLASS.ALARM" || $preFilter_str[1] == "CLASS.TERMS" || $preFilter_str[1] == "CLASS.ZIP" || $preFilter_str[1] == "CLASS.STREET" || $preFilter_str[1] == "CLASS.STREET_NUM" || $preFilter_str[1] == "CLASS.CLI") {
					$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $value_str  . "' ");
				}elseif ($preFilter_str[1] == "CLASS.STATUS" || $preFilter_str[1] == "STATUS_VACANT" || $preFilter_str[1] == "STATUS_PENDING" || $preFilter_str[1] == "STATUS_ACTIVE" || $preFilter_str[1] == "CLASS.STORAGE_BIN" || $preFilter_str[1] == "CLASS.STORAGE_ATTIC" || $preFilter_str[1] == "CLASS.STORAGE_BASEMENT") {
					$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $value_str  . "' ");
				}elseif ($preFilter_str[1] == "CLASS.AVAIL" || $preFilter_str[1] == "CLASS.LEASE_EXPIRE") {
					$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $preFilter_str[0]  . "' ");
				}else {
					$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $DEFINED_VALUE_SETS[$preFilter_str[1]][$value_str] . "' ");
				}
				$filters_str[$i] = $tempStr_str;
				$tempStr_str = "";
				$i++;
			}
		}
	}


	$numFilters_str = count($filters_str);

	switch ($numFilters_str) {
		case 0:
			$filter_string_display = "Showing all listings for $group";
			break;
		case 1:
			$filter_string_display = "<br><font color=\"#000000\">Filter set: </font> " . $filters_str[0];
			break;
		default:
			$filter_string_display = "<br><font color=\"#000000\">Filter set: </font> ";
			$filter_string_display .=  $filters_str[0];
			for ($i=1;$i<=($numFilters_str -1);$i++) {
				$filter_string_display .= "<br><font color=\"#000000\">AND</font> " . $filters_str[$i];
			}
			$i++;
			$filter_string_display .= $filters_str[$i];
			break;
	}
}else {
	$foo = "bar";
}

if ($_POST['clear_filter']) {
	$switch_remember = false;
	$filter_string_display = "Showing all listings for $group";
}


?>

<!-- BEGIN SEARCH SCREENS -->

<?php if ($listing_filter_display!= "none") {?>
<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="1" BGCOLOR="#FFFFFF"><TR><TD>
<div class="controltext"><NOBR>&nbsp;<IMG SRC="../images/search.gif" border="0"> <B>Search Listings:</B> <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=big";?>">Full Search</a> | <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=small";?>">Simple Search</a> | <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=mobile";?>">Mobile Search</a> | <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>">Hide Search Form</a> | <a id="displayMenu" href="javascript:togglemenu();">Hide Menu</a>&nbsp;</NOBR></DIV>
</TD></TR></TABLE>
<?php }?>




	<?php if ($listing_filter_display == "mobile") {?>
	<table border="0" cellspacing="0" cellpadding="0" width="45%">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=$listsearchs1";?>" method="POST">
	<input type="hidden" name="filterChange" value="1">
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>" align="center">
		<table>
			<tr>

			<td height="30" width="110" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Listing Type(s):</NOBR></div><select name="type[]" multiple size="3" STYLE="Background-Color : #FFFFFF">
				<?php while($rowTypes = mysqli_fetch_object($quTypes)) { ?>
					<option value="<?php echo $rowTypes->TYPE;?>"
					<?php if (is_array($switch_remember['type'])) {
						if (in_array($rowTypes->TYPE, $switch_remember['type'])) {
							echo " selected ";
						}
						} elseif ($rowTypes->TYPE==$switch_remember['type']) {
						  echo " selected ";

					}?>>
					<?php echo $rowTypes->TYPENAME;?></option>
				<?php } ?>
			</select></td>


			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">

<div class="controltext"><NOBR>Landlord/Owner(s):</NOBR></DIV><select name="landlord[]" multiple size="3" STYLE="Background-Color : #FFFFFF">
				<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
					<option value="<?php echo $rowGetLandlord->LID; ?>"
					<?php if (is_array($switch_remember['landlord'])) {
						if (in_array($rowGetLandlord->LID, $switch_remember['landlord'])) {
							echo " selected ";
						}
					}?>>
					<?php echo $rowGetLandlord->SHORT_NAME;?></option>
				<?php } ?>
			</select>


</td>



			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>


			<td height="30" width="90" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Location(s):</div><select name="loc[]" multiple size="3" STYLE="Background-Color : #FFFFFF">
	<?php while ($rowFavLocs = mysqli_fetch_object($quFavLocs)) { ?>
	<option value="<?php echo $rowFavLocs->LOCID;?>" <?php if ($rowGetAd->LOC==$rowFavLocs->LOCID) {echo " selected"; $locSeled = true; }?>><?php echo $rowFavLocs->LOCNAME;?></option>
	<?php } ?>
	<option value="0">--------------------</option>
<?php while($rowLocs = mysqli_fetch_object($quLocs)) { ?>
				<option value="<?php echo $rowLocs->LOCID;?>"
			<?php if (is_array($switch_remember['loc'])) {
				if (in_array($rowLocs->LOCID, $switch_remember['loc'])) {
					echo " selected ";
				}
				} elseif ($switch_remember['loc']) {
				  echo " selected ";
			}?>>
				<?php echo $rowLocs->LOCNAME;?></option>
			<?php } ?>
			</select></td>
			</tr>
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>" align="center">
		<table BORDER=0>
			<tr>




			<td height="30" width="80" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Price Min:</NOBR><BR>$<input type="text" name="priceStart[]" size="4" value="<?php echo $switch_remember['priceStart'];?>"></div></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="80" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Price Max:</NOBR><BR>$<input type="text" name="priceEnd[]" size="4" value="<?php echo $switch_remember['priceEnd'];?>"></div></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>" align="right"><div class="controltext" align="right"><NOBR>Available:&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="status_active[]" value="1" <?php if ($switch_remember['status_active']) {echo " checked "; }?> ></NOBR><BR>
<NOBR>Not Available:<input type="checkbox" name="status_not_active[]" value="1" <?php if ($switch_remember['status_not_active']) {echo " checked "; }?> ></NOBR></DIV>
</td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>" align="right"><div class="controltext"><NOBR>Advertising:<input type="checkbox" name="status[]" <?php if ($switch_remember['status']=='ACT') { echo checked;} ?> value="ACT"></NOBR><BR>
<NOBR>Vacant:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="status_vacant[]" value="1" <?php if ($switch_remember['status_vacant']) { echo " checked "; } ?> ></NOBR><BR></DIV></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td height="30" width="30" bgcolor="<?php echo $pagebgcolor;?>" VALIGN=top><div class="controltext" align="right"><NOBR><NOBR>Furnished:&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="features_furnished[]" value="1" <?php if ($switch_remember['features_furnished']) { echo "checked"; } ?> ></NOBR><BR>
<NOBR>Not Furnished:<input type="checkbox" name="features_not_furnished[]" value="1" <?php if ($switch_remember['features_not_furnished']) {echo " checked "; }?> ></NOBR></DIV></td>


			</tr>
		</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>" align="center">
		<?php
		$getMon = date (m);
		$getDay = date (d);
		$getYear = date (Y);
		?>

		<table CELLPADDING="0" CELLSPACING="0">
			<tr>

			<td height="30" width="200" bgcolor="<?php echo $pagebgcolor;?>" align="center"><div class="controltext"><NOBR>Available begin date:</NOBR></div></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="200" bgcolor="<?php echo $pagebgcolor;?>" align="center"><div class="controltext"><NOBR>Available end date:</NOBR></div></td>
			 </tr>
			 </table></td>

	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>" align="center">

		<table>
			<tr>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Month</div> <select name="bbbmonth" STYLE="Background-Color : #FFFFFF">
				<option value="--" <?php if ($switch_remember['bbbmonth'] =="--") { echo " selected ";}?>>--</option>
				<option value="01" <?php if ($switch_remember['bbbmonth'] =="01") { echo " selected ";}?> >Jan</option>
				<option value="02" <?php if ($switch_remember['bbbmonth'] =="02") { echo " selected ";}?> >Feb</option>
				<option value="03" <?php if ($switch_remember['bbbmonth'] =="03") { echo " selected ";}?> >Mar</option>
				<option value="04" <?php if ($switch_remember['bbbmonth'] =="04") { echo " selected ";}?> >Apr</option>
				<option value="05" <?php if ($switch_remember['bbbmonth'] =="05") { echo " selected ";}?> >May</option>
				<option value="06" <?php if ($switch_remember['bbbmonth'] =="06") { echo " selected ";}?> >Jun</option>
				<option value="07" <?php if ($switch_remember['bbbmonth'] =="07") { echo " selected ";}?> >Jul</option>
				<option value="08" <?php if ($switch_remember['bbbmonth'] =="08") { echo " selected ";}?> >Aug</option>
				<option value="09" <?php if ($switch_remember['bbbmonth'] =="09") { echo " selected ";}?> >Sep</option>
				<option value="10" <?php if ($switch_remember['bbbmonth'] =="10") { echo " selected ";}?> >Oct</option>
				<option value="11" <?php if ($switch_remember['bbbmonth'] =="11") { echo " selected ";}?> >Nov</option>
				<option value="12" <?php if ($switch_remember['bbbmonth'] =="12") { echo " selected ";}?> >Dec</option>
				</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Day</div><select name="bbbday" STYLE="Background-Color : #FFFFFF">
				<option value="--" <?php if ($switch_remember['bbbday']=="--") { echo " selected ";}?>>--</option>
				<?php for ($i=1;$i<=31;$i++) {
					if ($i<=9) {
						$j = "0".$i;
					} else {
						$j = $i;
					}
				?>
				<option value="<?php echo $j;?>" <?php if ($switch_remember['bbbday']==$j) { echo " selected ";}?>><?php echo $j;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Year</div><select name="bbbyear" STYLE="Background-Color : #FFFFFF">
				<option value="--" <?php if ($switch_remember['bbbyear']=="--") { echo " selected "; }?>>--</option>
				<?php
				$thisYear = date ("Y")-3;
				for ($i=0;$i<=7;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($switch_remember['bbbyear']== ($thisYear + $i)) { echo " selected "; }?>><?php echo ($thisYear + $i);?></option>
				<?php }?>
				</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Month</div><select name="bbemonth" STYLE="Background-Color : #FFFFFF">
				<option value="--" <?php if ($switch_remember['bbemonth']=="--") { echo " selected"; } ?>>--</option>
				<option value="01" <?php if ($switch_remember['bbemonth']=="01") { echo " selected"; } ?>>Jan</option>
				<option value="02" <?php if ($switch_remember['bbemonth']=="02") { echo " selected"; } ?>>Feb</option>
				<option value="03" <?php if ($switch_remember['bbemonth']=="03") { echo " selected"; } ?>>Mar</option>
				<option value="04" <?php if ($switch_remember['bbemonth']=="04") { echo " selected"; } ?>>Apr</option>
				<option value="05" <?php if ($switch_remember['bbemonth']=="05") { echo " selected"; } ?>>May</option>
				<option value="06" <?php if ($switch_remember['bbemonth']=="06") { echo " selected"; } ?>>Jun</option>
				<option value="07" <?php if ($switch_remember['bbemonth']=="07") { echo " selected"; } ?>>Jul</option>
				<option value="08" <?php if ($switch_remember['bbemonth']=="08") { echo " selected"; } ?>>Aug</option>
				<option value="09" <?php if ($switch_remember['bbemonth']=="09") { echo " selected"; } ?>>Sep</option>
				<option value="10" <?php if ($switch_remember['bbemonth']=="10") { echo " selected"; } ?>>Oct</option>
				<option value="11" <?php if ($switch_remember['bbemonth']=="11") { echo " selected"; } ?>>Nov</option>
				<option value="12" <?php if ($switch_remember['bbemonth']=="12") { echo " selected"; } ?>>Dec</option>
				</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Day</div><select name="bbeday" STYLE="Background-Color : #FFFFFF">
				<option value="--" <?php if ($switch_remember['bbeday'] == "--") { echo " selected ";}?>>--</option>
				<?php for ($i=1;$i<=31;$i++) {
					if ($i<=9) {
						$j = "0".$i;
					} else {
						$j = $i;
					}
				?>
				<option value="<?php echo $j;?>" <?php if ($switch_remember['bbeday'] ==$j) { echo " selected ";}?>><?php echo $j;?></option>
				<?php } ?>
				</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Year</div><select name="bbeyear" STYLE="Background-Color : #FFFFFF">
				<option value="--" <?php if ($switch_remember['bbeyear'] == "--") { echo " selected ";}?>>--</option>
				<?php
				$thisYear = date ("Y")-3;
				for ($i=0;$i<=7;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($switch_remember['bbeyear'] == ($thisYear + $i)) { echo " selected ";}?> ><?php echo ($thisYear + $i);?></option>
				<?php }?>
				</select></td>
			</tr>
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">
			<table align="center">
			<tr>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Bedrooms:</div><select name="rooms[]" multiple size="3" STYLE="Background-Color : #FFFFFF">
			<?php foreach($DEFINED_VALUE_SETS['ROOMS'] as $roomKey => $roomVal) { ?>
				<option value="<?php echo $roomKey;?>"
				<?php if (is_array($switch_remember['rooms'])) {
						if (in_array($roomKey, $switch_remember['rooms'])) {
							echo " selected ";
						}
						}elseif($switch_remember['rooms']==$roomKey)
						{
							echo " selected ";

					}?>>
					<?php echo $roomVal; ?></option>
			<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Bath(s):</NOBR></div><select name="bath[]" multiple size="3" STYLE="Background-Color : #FFFFFF">
				<?php foreach($DEFINED_VALUE_SETS['BATH'] as $bathKey => $bathVal) { ?>
				<option value="<?php echo $bathKey;?>"
				<?php if (is_array($switch_remember['bath'])) {
						if (in_array($bathKey, $switch_remember['bath'])) {
							echo " selected ";
						}
						} elseif ($switch_remember['bath'] == $bathKey ) {
						  echo " selected ";
					}?>>
					<?php echo $bathVal; ?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Pets:</div><select name="pets[]" multiple size="3" STYLE="Background-Color : #FFFFFF">
				<?php foreach($DEFINED_VALUE_SETS['PETSA'] as $petKey => $petVal) { ?>
					<option value="<?php echo $petKey;?>"
					<?php if (is_array($switch_remember['pets'])) {
						if (in_array($petKey, $switch_remember['pets'])) {
							echo " selected ";
						}
						} elseif ($switch_remember['pets']==$petKey) {
						  echo " selected ";
					}?>>
					<?php echo $petVal; ?></option>
			<?php } ?>
			</select></td>
			</tr>
			</table>


	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">
			<table align="center">
			<tr>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>" VALIGN="TOP">
<CENTER>

		<table>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Street #: <input type="text" size="5" name="street_num" value="<?php echo $switch_remember['street_num']; ?>"> Street Name: <input type="text" size="20" name="street" value="<?php echo $switch_remember['street']; ?>"> Zip Code: <input type="text" size="8" name="zip[]" value="<?php echo $switch_remember['zip'];?>" STYLE="Background-Color : #FFFFFF">
			</td>
			</tr>
	</table>
</TR>
			<tr>
			<td bgcolor="<?php echo $pagebgcolor;?>" VALIGN="TOP">
<CENTER>


<div class="controltext">
<NOBR>Source: 
<SELECT NAME="sourcemls" STYLE="Background-Color : #FFFFFF">
<OPTION VALUE="<?php echo $grid;?>" <?php if ($switch_remember['sourcemls']=="$grid" OR $sourcepref=="$grid") { echo "selected"; } ?>>Our Office Only
<OPTION VALUE="1075" <?php if ($switch_remember['sourcemls']=="1075" or $sourcepref=="1075") { echo "selected"; } ?>>MLS + OFFICE
<OPTION VALUE="1075A" <?php if ($switch_remember['sourcemls']=="1075A" or $sourcepref=="1075A") { echo "selected"; } ?>>MLS Only
</SELECT>
</NOBR>
</div>


<TABLE BORDER=0>
<TR><TD VALIGN="TOP">

<input type="image" src="../assets/images/button-searchlistings.png" alt="Search Listings"></form>

</TD><TD VALIGN="TOP">

<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=small&availFilter=n";?>" method="POST"><input type="hidden" name="clear_filter" value="1"><input type="hidden" name="filter_change" value="1">
<input type="image" src="../assets/images/button-searchclear.png" alt="Clear Search"></form>
</TD></TR></TABLE>
</CENTER>

</td>
			</tr>
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">
			<table width="100%" align="center">
			<tr>

			<td width="100%" bgcolor="<?php echo $pagebgcolor;?>"><div class="ad"><?php echo $filter_string_display;?><?php echo "<FONT SIZE=-3> - Total # of matching listings: $num_rows</FONT>"; ?></div></td>
			</tr>
			<tr>
			<td height="30" width="100%" bgcolor="<?php echo $pagebgcolor;?>" valign="bottom" align="right"><div class="controltext"><NOBR><IMG SRC="../images/search.gif" border="0"> <B>Search Listings:</B> <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=big";?>">Full Search</a> | <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=small";?>">Simple Search</a> | <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=mobile";?>">Mobile Search</a> | <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>">Hide Search Form</a> | <a id="displayMenu" href="javascript:togglemenu();">Hide/Show Menu</a></NOBR></DIV></td>
			</tr>

			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>


<?php } elseif ($listing_filter_display == "small") {?>

	<table border="0" cellspacing="0" cellpadding="0" width="98%">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=$listsearchs1";?>" method="POST">
	<input type="hidden" name="filterChange" value="1">
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>" align="center">
		<table>
			<tr>

			<td height="30" width="110" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Listing Type(s):</NOBR></div><select name="type[]" multiple size="3" STYLE="Background-Color : #FFFFFF; font-size : 8pt;">
				<?php while($rowTypes = mysqli_fetch_object($quTypes)) { ?>
					<option value="<?php echo $rowTypes->TYPE;?>"
					<?php if (is_array($switch_remember['type'])) {
						if (in_array($rowTypes->TYPE, $switch_remember['type'])) {
							echo " selected ";
						}
						} elseif ($rowTypes->TYPE==$switch_remember['type']) {
						  echo " selected ";

					}?>>
					<?php echo $rowTypes->TYPENAME;?></option>
				<?php } ?>
			</select></td>



			<td height="30" bgcolor="<?php echo $pagebgcolor;?>">

<div class="controltext"><NOBR>Landlord/Owner(s):</NOBR></DIV><select name="landlord[]" multiple size="3" STYLE="Background-Color : #FFFFFF; width: 160px; font-size : 8pt;">
				<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
					<option value="<?php echo $rowGetLandlord->LID; ?>"
					<?php if (is_array($switch_remember['landlord'])) {
						if (in_array($rowGetLandlord->LID, $switch_remember['landlord'])) {
							echo " selected ";
						}
					}?>>
					<?php echo $rowGetLandlord->SHORT_NAME;?></option>
				<?php } ?>
			</select>
</td>

			<td height="30" width="90" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Location(s):</div><select name="loc[]" multiple size="3" STYLE="Background-Color : #FFFFFF; width: 250px; font-size : 8pt;">
				<?php while ($rowFavLocs = mysqli_fetch_object($quFavLocs)) { ?>
	<option value="<?php echo $rowFavLocs->LOCID;?>" <?php if ($rowGetAd->LOC==$rowFavLocs->LOCID) {echo " selected"; $locSeled = true; }?>><?php echo $rowFavLocs->LOCNAME;?></option>
	<?php } ?>
	<option value="0">--------------------</option>
			<?php while($rowLocs = mysqli_fetch_object($quLocs)) { ?>
				<option value="<?php echo $rowLocs->LOCID;?>"
			<?php if (is_array($switch_remember['loc'])) {
				if (in_array($rowLocs->LOCID, $switch_remember['loc'])) {
					echo " selected ";
				}
				} elseif ($switch_remember['loc']) {
				  echo " selected ";
			}?>>
				<?php echo $rowLocs->LOCNAME;?></option>
			<?php } ?>
			</select></td>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Bedrooms:</div><select name="rooms[]" multiple size="3" STYLE="Background-Color : #FFFFFF; font-size : 8pt;">
			<?php foreach($DEFINED_VALUE_SETS['ROOMS'] as $roomKey => $roomVal) { ?>
				<option value="<?php echo $roomKey;?>"
				<?php if (is_array($switch_remember['rooms'])) {
						if (in_array($roomKey, $switch_remember['rooms'])) {
							echo " selected ";
						}
						}elseif($switch_remember['rooms']==$roomKey)
						{
							echo " selected ";

					}?>>
					<?php echo $roomVal; ?></option>
			<?php } ?>
			</select></td>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Bath(s):</NOBR></div><select name="bath[]" multiple size="3" STYLE="Background-Color : #FFFFFF; font-size : 8pt;">
				<?php foreach($DEFINED_VALUE_SETS['BATH'] as $bathKey => $bathVal) { ?>
				<option value="<?php echo $bathKey;?>"
				<?php if (is_array($switch_remember['bath'])) {
						if (in_array($bathKey, $switch_remember['bath'])) {
							echo " selected ";
						}
						} elseif ($switch_remember['bath'] == $bathKey ) {
						  echo " selected ";
					}?>>
					<?php echo $bathVal; ?></option>
				<?php } ?>
			</select></td>

   <td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Pets:</div><select name="pets[]" multiple size="3" STYLE="Background-Color : #FFFFFF; font-size : 8pt;">
				<?php foreach($DEFINED_VALUE_SETS['PETSA'] as $petKey => $petVal) { ?>
					<option value="<?php echo $petKey;?>"
					<?php if (is_array($switch_remember['pets'])) {
						if (in_array($petKey, $switch_remember['pets'])) {
							echo " selected ";
						}
						} elseif ($switch_remember['pets']==$petKey) {
						  echo " selected ";
					}?>>
					<?php echo $petVal; ?></option>
			<?php } ?>
			</select></td>

			</tr>
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>" align="center">
		<table BORDER=0>
			<tr>

			<td height="30" width="80" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Price Min:</NOBR><BR>$<input type="text" name="priceStart[]" size="4" value="<?php echo $switch_remember['priceStart'];?>"></div></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="80" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Price Max:</NOBR><BR>$<input type="text" name="priceEnd[]" size="4" value="<?php echo $switch_remember['priceEnd'];?>"></div></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>" align="right"><div class="controltext" align="right"><NOBR>Available:&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="status_active[]" value="1" <?php if ($switch_remember['status_active']) {echo " checked "; }?> ></NOBR><BR>
<NOBR>Not Available:<input type="checkbox" name="status_not_active[]" value="1" <?php if ($switch_remember['status_not_active']) {echo " checked "; }?> ></NOBR><BR><NOBR>Has Pics: &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="pic[]" value="1" <?php if ($switch_remember['pic']) {echo " checked "; }?> ></NOBR><BR>


</DIV>
</td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>" align="right"><div class="controltext"><NOBR>Advertising:<input type="checkbox" name="status[]" <?php if ($switch_remember['status']=='ACT') { echo checked;} ?> value="ACT"></NOBR><BR>
<NOBR>Vacant:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="status_vacant[]" value="1" <?php if ($switch_remember['status_vacant']) { echo " checked "; } ?> ></NOBR><BR>


<NOBR>Parking: <select name="parking_num[]" STYLE="Background-Color : #FFFFFF; width : 40px;" multiple size="1">
<OPTION VALUE=""> -- </OPTION>

				<?php foreach($DEFINED_VALUE_SETS['PARKING_NUM'] as $pknKey => $pknVal) { ?>
					<option value="<?php echo $pknKey;?>"
					<?php if (is_array($switch_remember['parking_num'])) {
						if (in_array($pknKey, $switch_remember['parking_num'])) {
							echo " selected ";
						}
					}?>>
					<?php echo $pknVal; ?></option>
			<?php } ?>
			</select>
</NOBR><BR>


</DIV></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td height="30" width="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext" align="right"><NOBR><NOBR>Furnished:&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="features_furnished[]" value="1" <?php if ($switch_remember['features_furnished']) { echo "checked"; } ?> ></NOBR><BR>
<NOBR>Not Furnished:<input type="checkbox" name="features_not_furnished[]" value="1" <?php if ($switch_remember['features_not_furnished']) {echo " checked "; }?> ></NOBR><BR>

<NOBR>Deleaded:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="features_deleaded[]" value="1" <?php if ($switch_remember['features_deleaded']) { echo "checked"; } ?> ></NOBR><BR>

</DIV></td>

<td bgcolor="<?php echo $pagebgcolor;?>" align="center">
&nbsp;&nbsp;
</TD>

<td bgcolor="<?php echo $pagebgcolor;?>" align="center">

		<?php
		$getMon = date (m);
		$getDay = date (d);
		$getYear = date (Y);
		?>

		<table CELLPADDING="0" CELLSPACING="0" BORDER=0>
			<tr>

			<td width="200" bgcolor="<?php echo $pagebgcolor;?>" align="center"><div class="controltext"><NOBR><B>Available begin date:</B></NOBR></div></td>
			<td width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td width="200" bgcolor="<?php echo $pagebgcolor;?>" align="center"><div class="controltext"><NOBR><B>Available end date:</B></NOBR></div></td>
			 </tr><TR>

<td colspan=3 bgcolor="<?php echo $pagebgcolor;?>" align="center">

		<table>
			<tr>
			<td width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Month</div> <select name="bbbmonth" STYLE="Background-Color : #FFFFFF; font-size : 8pt;">
				<option value="--" <?php if ($switch_remember['bbbmonth'] =="--") { echo " selected ";}?>>--</option>
				<option value="01" <?php if ($switch_remember['bbbmonth'] =="01") { echo " selected ";}?> >Jan</option>
				<option value="02" <?php if ($switch_remember['bbbmonth'] =="02") { echo " selected ";}?> >Feb</option>
				<option value="03" <?php if ($switch_remember['bbbmonth'] =="03") { echo " selected ";}?> >Mar</option>
				<option value="04" <?php if ($switch_remember['bbbmonth'] =="04") { echo " selected ";}?> >Apr</option>
				<option value="05" <?php if ($switch_remember['bbbmonth'] =="05") { echo " selected ";}?> >May</option>
				<option value="06" <?php if ($switch_remember['bbbmonth'] =="06") { echo " selected ";}?> >Jun</option>
				<option value="07" <?php if ($switch_remember['bbbmonth'] =="07") { echo " selected ";}?> >Jul</option>
				<option value="08" <?php if ($switch_remember['bbbmonth'] =="08") { echo " selected ";}?> >Aug</option>
				<option value="09" <?php if ($switch_remember['bbbmonth'] =="09") { echo " selected ";}?> >Sep</option>
				<option value="10" <?php if ($switch_remember['bbbmonth'] =="10") { echo " selected ";}?> >Oct</option>
				<option value="11" <?php if ($switch_remember['bbbmonth'] =="11") { echo " selected ";}?> >Nov</option>
				<option value="12" <?php if ($switch_remember['bbbmonth'] =="12") { echo " selected ";}?> >Dec</option>
				</select></td>
			<td width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Day</div><select name="bbbday" STYLE="Background-Color : #FFFFFF; font-size : 8pt;">
				<option value="--" <?php if ($switch_remember['bbbday']=="--") { echo " selected ";}?>>--</option>
				<?php for ($i=1;$i<=31;$i++) {
					if ($i<=9) {
						$j = "0".$i;
					} else {
						$j = $i;
					}
				?>
				<option value="<?php echo $j;?>" <?php if ($switch_remember['bbbday']==$j) { echo " selected ";}?>><?php echo $j;?></option>
				<?php } ?>
			</select></td>
			<td width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Year</div><select name="bbbyear" STYLE="Background-Color : #FFFFFF; font-size : 8pt;">
				<option value="--" <?php if ($switch_remember['bbbyear']=="--") { echo " selected "; }?>>--</option>
				<?php
				$thisYear = date ("Y")-3;
				for ($i=0;$i<=7;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($switch_remember['bbbyear']== ($thisYear + $i)) { echo " selected "; }?>><?php echo ($thisYear + $i);?></option>
				<?php }?>
				</select></td>
			<td width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Month</div><select name="bbemonth" STYLE="Background-Color : #FFFFFF; font-size : 8pt;">
				<option value="--" <?php if ($switch_remember['bbemonth']=="--") { echo " selected"; } ?>>--</option>
				<option value="01" <?php if ($switch_remember['bbemonth']=="01") { echo " selected"; } ?>>Jan</option>
				<option value="02" <?php if ($switch_remember['bbemonth']=="02") { echo " selected"; } ?>>Feb</option>
				<option value="03" <?php if ($switch_remember['bbemonth']=="03") { echo " selected"; } ?>>Mar</option>
				<option value="04" <?php if ($switch_remember['bbemonth']=="04") { echo " selected"; } ?>>Apr</option>
				<option value="05" <?php if ($switch_remember['bbemonth']=="05") { echo " selected"; } ?>>May</option>
				<option value="06" <?php if ($switch_remember['bbemonth']=="06") { echo " selected"; } ?>>Jun</option>
				<option value="07" <?php if ($switch_remember['bbemonth']=="07") { echo " selected"; } ?>>Jul</option>
				<option value="08" <?php if ($switch_remember['bbemonth']=="08") { echo " selected"; } ?>>Aug</option>
				<option value="09" <?php if ($switch_remember['bbemonth']=="09") { echo " selected"; } ?>>Sep</option>
				<option value="10" <?php if ($switch_remember['bbemonth']=="10") { echo " selected"; } ?>>Oct</option>
				<option value="11" <?php if ($switch_remember['bbemonth']=="11") { echo " selected"; } ?>>Nov</option>
				<option value="12" <?php if ($switch_remember['bbemonth']=="12") { echo " selected"; } ?>>Dec</option>
				</select></td>
			<td width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Day</div><select name="bbeday" STYLE="Background-Color : #FFFFFF; font-size : 8pt;">
				<option value="--" <?php if ($switch_remember['bbeday'] == "--") { echo " selected ";}?>>--</option>
				<?php for ($i=1;$i<=31;$i++) {
					if ($i<=9) {
						$j = "0".$i;
					} else {
						$j = $i;
					}
				?>
				<option value="<?php echo $j;?>" <?php if ($switch_remember['bbeday'] ==$j) { echo " selected ";}?>><?php echo $j;?></option>
				<?php } ?>
				</select></td>
			<td width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Year</div><select name="bbeyear" STYLE="Background-Color : #FFFFFF; font-size : 8pt;">
				<option value="--" <?php if ($switch_remember['bbeyear'] == "--") { echo " selected ";}?>>--</option>
				<?php
				$thisYear = date ("Y")-3;
				for ($i=0;$i<=7;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($switch_remember['bbeyear'] == ($thisYear + $i)) { echo " selected ";}?> ><?php echo ($thisYear + $i);?></option>
				<?php }?>
				</select></td>
			</tr>
			</table>

			 </TR>
			 </table>

			 </td>
			</tr>
		</table>

</td>


	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>


	<tr>
	<td valign="top" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">
			<table align="center" CELLPADDING="0" CELLSPACING="0" BORDER="0">
			<tr>
			<td width="20" bgcolor="<?php echo $pagebgcolor;?>">

		<table CELLPADDING="0" CELLSPACING="0" BORDER="0">
			<tr>
			<td bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">

<TABLE><TR><TD>


<TABLE><TR><TD COLSPAN="5"><CENTER>
<B><FONT SIZE="-1">Street # Range</FONT></B></CENTER>
</TD></TR><TR><TD>
<NOBR><FONT SIZE="-2">Begin #</FONT></NOBR><BR><NOBR>(>=):</NOBR></TD><TD><input type="text"  TITLE="Exact Street # (>=)" size="5" name="street_num_begin" value="<?php echo $switch_remember['street_num_begin']; ?>">
</TD><TD>
&nbsp;
</TD><TD>
<NOBR><FONT SIZE="-2">End #:</FONT></NOBR><BR><NOBR>(<=)</NOBR></TD><TD><input type="text" size="5"  TITLE="Exact Street # (<=)" name="street_num_end" value="<?php echo $switch_remember['street_num_end']; ?>">
</TD></TR></TABLE>
</TD><TD>

			<NOBR>Street #:<input type="text" size="5" name="street_num" value="<?php echo $switch_remember['street_num']; ?>" STYLE="Background-Color : #FFFFFF; height :20px; font-size : 8pt;"> Street Name:<input type="text" size="20" name="street" value="<?php echo $switch_remember['street']; ?>" STYLE="Background-Color : #FFFFFF; height :20px; font-size : 8pt;"> Zip: <input type="text" size="5" name="zip[]" value="<?php echo $switch_remember['zip'];?>" STYLE="Background-Color : #FFFFFF; height :20px; font-size : 8pt;">
</TD><TD VALIGN="CENTER"><div class="controltext">
<NOBR>Source: 
<SELECT NAME="sourcemls" STYLE="Background-Color : #FFFFFF">
<OPTION VALUE="<?php echo $grid;?>" <?php if ($switch_remember['sourcemls']=="$grid" OR $sourcepref=="$grid") { echo "selected"; } ?>>Our Office Only
<OPTION VALUE="1075" <?php if ($switch_remember['sourcemls']=="1075" or $sourcepref=="1075") { echo "selected"; } ?>>MLS + OFFICE
<OPTION VALUE="1075A" <?php if ($switch_remember['sourcemls']=="1075A" or $sourcepref=="1075A") { echo "selected"; } ?>>MLS Only
<!-- <OPTION VALUE="BA" <?php if ($switch_remember['sourcemls']=="BA" or $sourcepref=="BA") { echo "selected"; } ?>>BA CO-Brokes -->
</SELECT>
</NOBR>
</div>
</TD></TR></TABLE>


</td>
			<TD>
&nbsp;&nbsp;
</TD>
<TD>

<TABLE CELLPADDING="2" CELLSPACING="0" BORDER="0"><TR><TD VALIGN="TOP">
<input type="image" src="../assets/images/button-searchlistings.png" alt="Search Listings">
</TD></form><TD>&nbsp;&nbsp;</TD><TD VALIGN="TOP">
<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=small&availFilter=n";?>" method="POST"><input type="hidden" name="clear_filter" value="1"><input type="hidden" name="filter_change" value="1"><input type="image" src="../assets/images/button-searchclear.png" alt="Clear Search">
</TD></TR></TABLE>

</TD></form>
</tr></table>
</TR></table>

</td>
	<td valign="top" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>


	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">
			<table width="100%" align="center">
			<tr>

			<td width="100%" bgcolor="<?php echo $pagebgcolor;?>"><div class="ad"><?php echo $filter_string_display;?><?php echo "<FONT SIZE=-3> - Total # of matching listings: $num_rows</FONT>"; ?></div></td>
			</tr>

			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>





<?php } elseif ($listing_filter_display == "big") {?>


	<table border="0" cellspacing="0" cellpadding="0" width="60%">
	<tr>
	<td colspan="3" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=$listsearchs1";?>" method="POST">
	<input type="hidden" name="filterChange" value="1">
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">
			<table width="100%" align="center">
			<tr>
			<td height="30" width="110" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Landlord/Owner(s):</NOBR><select name="landlord[]" multiple size="4" STYLE="Background-Color : #FFFFFF">
				<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
					<option value="<?php echo $rowGetLandlord->LID; ?>"
					<?php if (is_array($switch_remember['landlord'])) {
						if (in_array($rowGetLandlord->LID, $switch_remember['landlord'])) {
							echo " selected ";
						}
					}?>>
					<?php echo $rowGetLandlord->SHORT_NAME;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="110" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Listing Type(s):</NOBR></div><select name="type[]" multiple size="4" STYLE="Background-Color : #FFFFFF">
				<?php while($rowTypes = mysqli_fetch_object($quTypes)) { ?>
					<option value="<?php echo $rowTypes->TYPE;?>"
					<?php if (is_array($switch_remember['type'])) {
						if (in_array($rowTypes->TYPE, $switch_remember['type'])) {
							echo " selected ";
						}
						} elseif ($rowTypes->TYPE==$switch_remember['type']) {
						echo " selected ";
					}?>>
					<?php echo $rowTypes->TYPENAME;?></option>
				<?php } ?>
			</select></td>

			<TD><CENTER>
			
			<TABLE border="0" WIDTH="164"><TR>
		<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			
			<td height="30" width="80" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Price Min:</NOBR></div><NOBR>$<input type="text" name="priceStart[]" size="4" value="<?php echo $switch_remember['priceStart'];?>"></NOBR></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="80" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Price Max:</NOBR></div><NOBR>$<input type="text" name="priceEnd[]" size="4" value="<?php echo $switch_remember['priceEnd'];?>"></NOBR></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			</TD></TR><TR><TD COLSPAN=5>		
<CENTER><div class="controltext">
<NOBR>Source: 
<SELECT NAME="sourcemls" STYLE="Background-Color : #FFFFFF">
<OPTION VALUE="<?php echo $grid;?>" <?php if ($switch_remember['sourcemls']=="$grid" OR $sourcepref=="$grid") { echo "selected"; } ?>>Our Office Only
<OPTION VALUE="1075" <?php if ($switch_remember['sourcemls']=="1075" or $sourcepref=="1075") { echo "selected"; } ?>>MLS + OFFICE
<OPTION VALUE="1075A" <?php if ($switch_remember['sourcemls']=="1075A" or $sourcepref=="1075A") { echo "selected"; } ?>>MLS Only
</SELECT>
</NOBR>
</div></CENTER></TD></TR></TABLE>
			</CENTER>
			</TD>
			
			<td height="30" width="90" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Location(s):</div><select name="loc[]" multiple size="4" STYLE="Background-Color : #FFFFFF">
			<?php while ($rowFavLocs = mysqli_fetch_object($quFavLocs)) { ?>
	<option value="<?php echo $rowFavLocs->LOCID;?>" <?php if ($rowGetAd->LOC==$rowFavLocs->LOCID) {echo " selected"; $locSeled = true; }?>><?php echo $rowFavLocs->LOCNAME;?></option>
	<?php } ?>
	<option value="0">--------------------</option>
				<?php while($rowLocs = mysqli_fetch_object($quLocs)) { ?>
				<option value="<?php echo $rowLocs->LOCID;?>"
			<?php if (is_array($switch_remember['loc'])) {
				if (in_array($rowLocs->LOCID, $switch_remember['loc'])) {
					echo " selected ";
				}
				} else {
				  if($rowLocs->LOCID == $switch_remember['loc'])
				  { echo " selected"; }
				 }?>>
				<?php echo $rowLocs->LOCNAME;?></option>
			<?php } ?>
			</select></td>
			</tr>
			</table>

</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>" align="center">
		<table border=0 WIDTH=100% BORDER=1>
			<tr>
<TD>

		<?php
		$getMon = date (m);
		$getDay = date (d);
		$getYear = date (Y);
		?>

</td>

	</tr>
	<tr>
	<td bgcolor="<?php echo $pagebgcolor;?>" align="center">


<TABLE><TR><TD><CENTER>

		<table BORDER=0>
			<tr>
			<td height="30" width="150" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Available begin date:</NOBR></div></td>
			<td height="30" width="15" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="150" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Available end date:</NOBR></div></td>
		 </tr>
		 </table>

		<table>
			<tr>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Month</div> <select name="bbbmonth" STYLE="Background-Color : #FFFFFF">
				<option value="--" <?php if ($switch_remember['bbbmonth'] =="--") { echo " selected ";}?>>--</option>
				<option value="01" <?php if ($switch_remember['bbbmonth'] =="01") { echo " selected ";}?> >Jan</option>
				<option value="02" <?php if ($switch_remember['bbbmonth'] =="02") { echo " selected ";}?> >Feb</option>
				<option value="03" <?php if ($switch_remember['bbbmonth'] =="03") { echo " selected ";}?> >Mar</option>
				<option value="04" <?php if ($switch_remember['bbbmonth'] =="04") { echo " selected ";}?> >Apr</option>
				<option value="05" <?php if ($switch_remember['bbbmonth'] =="05") { echo " selected ";}?> >May</option>
				<option value="06" <?php if ($switch_remember['bbbmonth'] =="06") { echo " selected ";}?> >Jun</option>
				<option value="07" <?php if ($switch_remember['bbbmonth'] =="07") { echo " selected ";}?> >Jul</option>
				<option value="08" <?php if ($switch_remember['bbbmonth'] =="08") { echo " selected ";}?> >Aug</option>
				<option value="09" <?php if ($switch_remember['bbbmonth'] =="09") { echo " selected ";}?> >Sep</option>
				<option value="10" <?php if ($switch_remember['bbbmonth'] =="10") { echo " selected ";}?> >Oct</option>
				<option value="11" <?php if ($switch_remember['bbbmonth'] =="11") { echo " selected ";}?> >Nov</option>
				<option value="12" <?php if ($switch_remember['bbbmonth'] =="12") { echo " selected ";}?> >Dec</option>
				</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Day</div><select name="bbbday" STYLE="Background-Color : #FFFFFF">
				<option value="--" <?php if ($switch_remember['bbbday']=="--") { echo " selected ";}?>>--</option>
				<?php for ($i=1;$i<=31;$i++) {
					if ($i<=9) {
						$j = "0".$i;
					} else {
						$j = $i;
					}
				?>
				<option value="<?php echo $j;?>" <?php if ($switch_remember['bbbday']==$j) { echo " selected ";}?>><?php echo $j;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Year</div><select name="bbbyear" STYLE="Background-Color : #FFFFFF">
				<option value="--" <?php if ($switch_remember['bbbyear']=="--") { echo " selected "; }?>>--</option>
				<?php
				$thisYear = date ("Y")-4;
				for ($i=0;$i<=7;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($switch_remember['bbbyear']== ($thisYear + $i)) { echo " selected "; }?>><?php echo ($thisYear + $i);?></option>
				<?php }?>
				</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Month</div><select name="bbemonth" STYLE="Background-Color : #FFFFFF">
				<option value="--" <?php if ($switch_remember['bbemonth']=="--") { echo " selected"; } ?>>--</option>
				<option value="01" <?php if ($switch_remember['bbemonth']=="01") { echo " selected"; } ?>>Jan</option>
				<option value="02" <?php if ($switch_remember['bbemonth']=="02") { echo " selected"; } ?>>Feb</option>
				<option value="03" <?php if ($switch_remember['bbemonth']=="03") { echo " selected"; } ?>>Mar</option>
				<option value="04" <?php if ($switch_remember['bbemonth']=="04") { echo " selected"; } ?>>Apr</option>
				<option value="05" <?php if ($switch_remember['bbemonth']=="05") { echo " selected"; } ?>>May</option>
				<option value="06" <?php if ($switch_remember['bbemonth']=="06") { echo " selected"; } ?>>Jun</option>
				<option value="07" <?php if ($switch_remember['bbemonth']=="07") { echo " selected"; } ?>>Jul</option>
				<option value="08" <?php if ($switch_remember['bbemonth']=="08") { echo " selected"; } ?>>Aug</option>
				<option value="09" <?php if ($switch_remember['bbemonth']=="09") { echo " selected"; } ?>>Sep</option>
				<option value="10" <?php if ($switch_remember['bbemonth']=="10") { echo " selected"; } ?>>Oct</option>
				<option value="11" <?php if ($switch_remember['bbemonth']=="11") { echo " selected"; } ?>>Nov</option>
				<option value="12" <?php if ($switch_remember['bbemonth']=="12") { echo " selected"; } ?>>Dec</option>
				</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Day</div><select name="bbeday" STYLE="Background-Color : #FFFFFF">
				<option value="--" <?php if ($switch_remember['bbeday'] == "--") { echo " selected ";}?>>--</option>
				<?php for ($i=1;$i<=31;$i++) {
					if ($i<=9) {
						$j = "0".$i;
					} else {
						$j = $i;
					}
				?>
				<option value="<?php echo $j;?>" <?php if ($switch_remember['bbeday'] ==$j) { echo " selected ";}?>><?php echo $j;?></option>
				<?php } ?>
				</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Year</div><select name="bbeyear" STYLE="Background-Color : #FFFFFF">
				<option value="--" <?php if ($switch_remember['bbeyear'] == "--") { echo " selected ";}?>>--</option>
				<?php
				$thisYear = date ("Y")-3;
				for ($i=0;$i<=7;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($switch_remember['bbeyear'] == ($thisYear + $i)) { echo " selected ";}?> ><?php echo ($thisYear + $i);?></option>
				<?php }?>
				</select></td>
			</tr>
			</table>
</TD></TR></TABLE>


</TD>


				<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>


			<td height="30" width="30%" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>College(s):</NOBR></div><select name="school[]" multiple size="4" STYLE="Background-Color : #FFFFFF">
				<?php foreach($DEFINED_VALUE_SETS['SCHOOL'] as $schoolKey => $schoolVal) { ?>
				<option value="<?php echo $schoolKey;?>"
				<?php if (is_array($switch_remember['school'])) {
						if (in_array($schoolKey, $switch_remember['school'])) {
							echo " selected ";
						}
					}?>>
					<?php echo $schoolVal; ?></option>
				<?php } ?>
			</select></td>

			</tr>
		</table>

</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>






<TD bgcolor="<?php echo $pagebgcolor;?>">
<CENTER>

<TABLE BORDER=0><TR>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">
<div class="controltext"><NOBR>Available:<input type="checkbox" name="status_active[]" value="1" <?php if ($switch_remember['status_active']) {echo " checked "; }?> ></NOBR></DIV>
</TD><TD><div class="controltext">
<NOBR>Not Available:<input type="checkbox" name="status_not_active[]" value="1" <?php if ($switch_remember['status_not_active']) {echo " checked "; }?> ></NOBR>
</DIV>
</td>
<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">
<div class="controltext"><NOBR>Advertised:<input type="checkbox" name="status[]" <?php if ($switch_remember['status']=='ACT') { echo checked;} ?> value="ACT">
</NOBR></DIV>
</td>
<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><NOBR>
<div class="controltext">Not Advertised:<input type="checkbox" name="status[]" <?php if ($switch_remember['status']=='STO') { echo checked;} ?> value="STO">
</NOBR></DIV>
</TD><TD>
<div class="controltext">
<NOBR>Vacant:<input type="checkbox" name="status_vacant[]" value="1" <?php if ($switch_remember['status_vacant']) { echo " checked "; } ?> ></NOBR>
</DIV>
</td>


			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">
<div class="controltext"><NOBR>Furnished:<input type="checkbox" name="features_furnished[]" value="1" <?php if ($switch_remember['features_furnished']) { echo "checked"; } ?> ></DIV></td>



			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">
<div class="controltext"><NOBR>Not Furnished:<input type="checkbox" name="features_not_furnished[]" value="1" <?php if ($switch_remember['features_not_furnished']) {echo " checked "; }?> ></NOBR>
</DIV>
</td>

</td>
<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Has Pics:<input type="checkbox" name="pic[]" value="1" <?php if ($switch_remember['pic']) {echo " checked "; }?> >
</NOBR>
</DIV></TD>
</td>
<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Pending:<input type="checkbox" name="status_pending[]" value="1" <?php if ($switch_remember['status_pending']) {echo " checked "; }?> >
</NOBR>
</DIV></TD>

</TR></TABLE>
</CENTER>

</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">
			<table align="center" VALIGN="BOTTOM">
			<tr>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>" VALIGN="BOTTOM"><div class="controltext">Bedrooms:</div><select name="rooms[]" multiple size="4" STYLE="Background-Color : #FFFFFF">
			<?php foreach($DEFINED_VALUE_SETS['ROOMS'] as $roomKey => $roomVal) { ?>
				<option value="<?php echo $roomKey;?>"
				<?php if (is_array($switch_remember['rooms'])) {
						if (in_array($roomKey, $switch_remember['rooms'])) {
							echo " selected ";
						}
						}elseif($switch_remember['rooms']==$roomKey)
                                                {
                                                        echo " selected ";


					}?>>
					<?php echo $roomVal; ?></option>
			<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>" VALIGN="BOTTOM"><div class="controltext"><NOBR>Bath(s):</NOBR></div><select name="bath[]" multiple size="4" STYLE="Background-Color : #FFFFFF">
				<?php foreach($DEFINED_VALUE_SETS['BATH'] as $bathKey => $bathVal) { ?>
				<option value="<?php echo $bathKey;?>"
				<?php if (is_array($switch_remember['bath'])) {
						if (in_array($bathKey, $switch_remember['bath'])) {
							echo " selected ";
						}
                                                } elseif ($switch_remember['bath'] == $bathKey ) {
                                                  echo " selected ";
					}?>>
					<?php echo $bathVal; ?></option>
				<?php } ?>
			</select></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>" VALIGN="BOTTOM"><div class="controltext">Fee:</div><select name="nofee[]" multiple size="4" STYLE="Background-Color : #FFFFFF">
				<?php foreach($DEFINED_VALUE_SETS['NOFEE'] as $feeKey => $feeVal) { ?>
					<option value="<?php echo $feeKey;?>"
					<?php if (is_array($switch_remember['nofee'])) {
						if (in_array($feeKey, $switch_remember['nofee'])) {
							echo " selected ";
						}
					}?>>
					<?php echo $feeVal; ?></option>
			<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

<TD VALIGN="BOTTOM">
<div class="controltext">Pets:</div><select name="pets[]" multiple size="4" STYLE="Background-Color : #FFFFFF">
				<?php foreach($DEFINED_VALUE_SETS['PETSA'] as $petKey => $petVal) { ?>
					<option value="<?php echo $petKey;?>"
					<?php if (is_array($switch_remember['pets'])) {
						if (in_array($petKey, $switch_remember['pets'])) {
							echo " selected ";
						}
                                                } elseif ($switch_remember['pets']==$petKey) {
                                                  echo " selected ";
					}?>>
					<?php echo $petVal; ?></option>
			<?php } ?>
			</select>
</TD>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
<TD VALIGN="BOTTOM">
<CENTER>
<TABLE CELLSPACING="0" CELLPADDING="0"><TR>
<TD COLSPAN="2" VALIGN="BOTTOM"><div class="controltext"><CENTER><b>Parking</b></CENTER></div></TD></TR>
</TR>
<TR>
<TD VALIGN="BOTTOM" align="center"><div class="controltext"><NOBR># of spaces:</NOBR></DIV>
<select name="parking_num[]" multiple size="4" STYLE="Background-Color : #FFFFFF">
				<?php foreach($DEFINED_VALUE_SETS['PARKING_NUM'] as $pknKey => $pknVal) { ?>
					<option value="<?php echo $pknKey;?>"
					<?php if (is_array($switch_remember['parking_num'])) {
						if (in_array($pknKey, $switch_remember['parking_num'])) {
							echo " selected ";
						}
					}?>>
					<?php echo $pknVal; ?></option>
			<?php } ?>
			</select>

</TD>
<TD  VALIGN="BOTTOM" align="center"><div class="controltext">Type:</DIV>
<select name="parking_type[]"  multiple size="4" STYLE="Background-Color : #FFFFFF">
				<?php foreach ($DEFINED_VALUE_SETS['PARKING_TYPE'] as $parkkey => $parkVal) { ?>
					<option value="<?php echo $parkkey;?>"
					<?php if (is_array($switch_remember['parking_type'])) {
						if (in_array($parkkey, $switch_remember['parking_type'])) {
							echo " selected ";
						}
					}?>>
					<?php echo $parkVal;?> </option>
				<?php } ?>
			</select>
</TD></TR></TABLE>
</CENTER>
</TD>

			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="3" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="<?php echo $pagebgcolor;?>">
		<table>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">


<TABLE><TR><TD>


<TABLE><TR><TD COLSPAN="4"><CENTER>
<B><FONT SIZE="-1">Street # Range</FONT></B></CENTER>
</TD></TR><TR><TD>
<FONT SIZE="-2">Begin #</FONT><BR>(>=):</TD><TD><input type="text"  TITLE="Exact Street # (>=)" size="5" name="street_num_begin" value="<?php echo $switch_remember['street_num_begin']; ?>">
</TD><TD>
<FONT SIZE="-2">End #:</FONT><BR>(<=)</TD><TD><input type="text" size="5"  TITLE="Exact Street # (<=)" name="street_num_end" value="<?php echo $switch_remember['street_num_end']; ?>">
</TD></TR></TABLE>
</TD><TD>
&nbsp;&nbsp;
</TD><TD>
<NOBR>
Street #:<input type="text" TITLE="Partial or exact Street #" size="5" name="street_num" value="<?php echo $switch_remember['street_num']; ?>"> Street:<input type="text" size="25" name="street" value="<?php echo $switch_remember['street']; ?>">  Zip:<input type="text" size="10" name="zip[]" value="<?php echo $switch_remember['zip'];?>" STYLE="Background-Color : #FFFFFF">
</NOBR>
</TD></TR></TABLE>



</td>
			</tr>
		</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="3" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="<?php echo $pagebgcolor;?>">
		<table>
			<tr>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Listing type:</NOBR><select name="listing_type[]"  multiple size="4" STYLE="Background-Color : #FFFFFF">
						<?php foreach ($DEFINED_VALUE_SETS['LISTING_TYPE'] as $lskey => $lsVal) { ?>
						<option value="<?php echo $lskey;?>"
						<?php if (is_array($switch_remember['listing_type'])) {
							if (in_array($lskey, $switch_remember['listing_type'])) {
								echo " selected ";
							}
					}?>>
						<?php echo $lsVal;?></option>
						<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Lease type:</NOBR><select name="lease_type[]"  multiple size="4" STYLE="Background-Color : #FFFFFF">
					<?php foreach ($DEFINED_VALUE_SETS['LEASE_TYPE'] as $lkey => $lVal) { ?>
					<option value="<?php echo $lkey;?>"
					<?php if (is_array($switch_remember['lease_type'])) {
						if (in_array($lkey, $switch_remember['lease_type'])) {
							echo " selected ";
						}
						} elseif ($switch_remember['lease_type'] == $lkey ) {
						  echo " selected ";
					}?>>
					<?php echo $lVal;?></option>
					<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" valign="TOP" bgcolor="<?php echo $pagebgcolor;?>" align="center"><div class="controltext"><CENTER><NOBR>Term (months):</NOBR>  <input type="text" size="3" name="terms[]" value="<?php echo $switch_remember['terms'];?>" STYLE="Background-Color : #FFFFFF"></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30"  valign="top" bgcolor="<?php echo $pagebgcolor;?>" align="center"><div class="controltext"><NOBR>Tax Clause:</NOBR></div><select name="tax_clause[]"  multiple size="2" STYLE="Background-Color : #FFFFFF">
				<?php foreach ($DEFINED_VALUE_SETS['TAX_CLAUSE'] as $taxKey => $taxVal) {?>
					<option value="<?php echo $taxKey;?>"
					<?php if (is_array($switch_remember['tax_clause'])) {
						if (in_array($taxKey, $switch_remember['tax_clause'])) {
							echo " selected ";
						}
					}?>>
					<?php echo $taxVal;?></option>
				<?php }?>
				</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

		</tr>
		</table>


	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">
	<CENTER>
		<table>
			<tr>
			<td colspan="10" height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><strong>Features:</strong></div></td>
			</tr>
			<tr>
			<td valign="top">


				<table border="0">
				<tr><td align="right" class="controltext">Deleaded</td><td align="left"><input type="checkbox" name="features_deleaded[]" value="1" <?php if ($switch_remember['features_deleaded']) { echo "checked"; } ?> ></td></tr>

				<tr><td align="right" class="controltext">Not Deleaded</td><td align="left"><input type="checkbox" name="not_deleaded[]" value="1" <?php if ($switch_remember['not_deleaded']) { echo "checked"; } ?> ></td></tr>


				<tr><td align="right" class="controltext">Non-smoking</td><td align="left"><input type="checkbox" name="features_non_smoking[]" value="1" <?php if ($switch_remember['features_non_smoking']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Alarm</td><td align="left"><input type="checkbox" name="features_alarm[]" value="1" <?php if ($switch_remember['features_alarm']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">High Ceilings </td><td align="left"><input type="checkbox" name="amenities_high_ceilings[]" value="1" <?php if ($switch_remember['amenities_high_ceilings']) { echo "checked"; } ?> ></td></tr>

				<tr><td align="right" class="controltext">Central AC </td><td align="left"><input type="checkbox" name="features_central_ac[]" value="1" <?php if ($switch_remember['features_central_ac']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">AC </td><td align="left"><input type="checkbox" name="features_ac[]" value="1" <?php if ($switch_remember['features_ac']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Dining Room </td><td align="left"><input type="checkbox" name="features_dinning_room[]" value="1" <?if ($switch_remember['features_dinning_room']) { echo "checked"; } ?> ></td></tr>

				</table>
			</td>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Hot Water</td><td align="left"><input type="checkbox" name="features_hot_water[]" value="1" <?php if ($switch_remember['features_hot_water']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Heat & Hot Water</td><td align="left"><input type="checkbox" name="features_ht_and_hw[]" value="1" <?php if ($switch_remember['features_ht_and_hw'] ) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">All Utilities</td><td align="left"><input type="checkbox" name="features_all_utilities[]" value="1" <?php if ($switch_remember['features_all_utilities']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">High Speed Internet </td><td align="left"><input type="checkbox" name="features_high_speed_internet[]" value="1" <?php if ($switch_remember['features_high_speed_internet']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Walk-in Closet </td><td align="left"><input type="checkbox" name="features_walk_in_closet[]" value="1" <?php if ($switch_remember['features_walk_in_closet']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Modern Bath </td><td align="left"><input type="checkbox" name="features_modern_bath[]" value="1" <?if ($switch_remember['features_modern_bath']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Whirlpool Tub</td><td align="left"><input type="checkbox" name="features_whirlpool[]" value="1" <?if ($switch_remember['features_whirlpool']) { echo "checked"; } ?> ></td></tr>

				</table>
			</td>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Working Fireplace</td><td align="left"><input type="checkbox" name="features_fireplace_working[]" value="1" <?php if ($switch_remember['features_fireplace_working']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Decorative Fireplace </td><td align="left"><input type="checkbox" name="features_fireplace_decor[]" value="1" <?php if ($switch_remember['features_fireplace_decor']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Hardwood Floors</td><td align="left"><input type="checkbox" name="features_hwfi[]" value="1" <?php if ($switch_remember['features_hwfi']) { echo "checked"; } ?> ></td></tr>

				<tr><td align="right" class="controltext">Carpet</td><td align="left"><input type="checkbox" name="features_carpet[]" value="1" <?php if ($switch_remember['features_carpet']) { echo "checked"; } ?> ></td></tr>

				<tr><td align="right" class="controltext">Modern Kitchen</td><td align="left"><input type="checkbox" name="features_modern_kitchen[]" value="1" <?php if ($switch_remember['features_modern_kitchen']) { echo "checked"; } ?> ></td></tr>

				<tr><td align="right" class="controltext">Galley Kitchen</td><td align="left"><input type="checkbox" name="features_kitchen_galley[]" value="1" <?php if ($switch_remember['features_kitchen_galley']) { echo "checked"; } ?> ></td></tr>

				<tr><td align="right" class="controltext">Kitchenette </td><td align="left"><input type="checkbox" name="features_kitchenette[]" value="1" <?php if ($switch_remember['features_kitchenette']) { echo "checked"; } ?> ></td></tr>
				</table>
			</td>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Eat-in-Kitchen </td><td align="left"><input type="checkbox" name="features_eat_in_kitchen[]" value="1" <?php if ($switch_remember['features_eat_in_kitchen']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Microwave </td><td align="left"><input type="checkbox" name="features_microwave[]" value="1" <?php if ($switch_remember['features_microwave']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Pantry</td><td align="left"><input type="checkbox" name="features_pantry[]" value="1" <?php if ($switch_remember['features_pantry']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Gas Range</td><td align="left"><input type="checkbox" name="features_gas_range[]" value="1" <?php if ($switch_remember['features_gas_range']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Electric Range</td><td align="left"><input type="checkbox" name="features_elec_range[]" value="1" <?php if ($switch_remember['features_elec_range']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Disposal</td><td align="left"><input type="checkbox" name="features_disposal[]" value="1" <?php if ($switch_remember['features_disposal']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Dishwasher</td><td align="left"><input type="checkbox" name="features_dishwasher[]" value="1" <?php if ($switch_remember['features_dishwasher']) { echo "checked"; } ?> ></td></tr>



				</table>
			</td>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Skylight </td><td align="left"><input type="checkbox" name="features_skylight[]" value="1" <?php if ($switch_remember['features_skylight']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Balcony </td><td align="left"><input type="checkbox" name="features_balcony[]" value="1" <?php if ($switch_remember['features_balcony']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Patio </td><td align="left"><input type="checkbox" name="features_patio[]" value="1" <?php if ($switch_remember['features_patio']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Porch </td><td align="left"><input type="checkbox" name="features_porch[]" value="1" <?php if ($switch_remember['features_porch']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Enclosed Porch </td><td align="left"><input type="checkbox" name="features_enclosed_porch[]" value="1" <?php if ($switch_remember['features_enclosed_porch']) { echo "checked"; } ?> ></td></tr>

				<tr><td align="right" class="controltext">Deck </td><td align="left"><input type="checkbox" name="features_deck[]" value="1" <?if ($switch_remember['features_deck']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Duplex </td><td align="left"><input type="checkbox" name="features_duplex[]" value="1" <?if ($switch_remember['features_duplex']) { echo "checked"; } ?> ></td></tr>


				</table>
				</CENTER>
			</td>
			<td valign="top">
				<table border="0">

				</table>

			</td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">
	<CENTER>
		<table>
			<tr>
			<td colspan="10" height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><strong>Amenities:</strong></div></td>
			</tr>
			<tr>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Concierge </td><td align="left"><input type="checkbox" name="amenities_conciearge[]" value="1" <?php if ($switch_remember['amenities_conciearge']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Security </td><td align="left"><input type="checkbox" name="amenities_security[]" value="1" <?php if ($switch_remember['amenities_security']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Superintendent </td><td align="left"><input type="checkbox" name="amenities_superintendant[]" value="1" <?php if ($switch_remember['amenities_superintendant']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">On Site Management</td><td align="left"><input type="checkbox" name="amenities_on_site_management[]" value="1" <?php if ($switch_remember['amenities_on_site_management']) { echo "checked"; } ?> ></td></tr>

				<tr><td align="right" class="controltext">Owner Occupied</td><td align="left"><input type="checkbox" name="amenities_owner_occupied[]" value="1" <?php if ($switch_remember['amenities_owner_occupied']) { echo "checked"; } ?> ></td></tr>


				</table>
			</td>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Roof Deck </td><td align="left"><input type="checkbox" name="amenities_roof_deck[]" value="1" <?php if ($switch_remember['amenities_roof_deck']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Garden </td><td align="left"><input type="checkbox" name="amenities_garden[]" value="1" <?php if ($switch_remember['amenities_garden']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Yard </td><td align="left"><input type="checkbox" name="amenities_yard[]" value="1" <?php if ($switch_remember['amenities_yard']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Elevator </td><td align="left"><input type="checkbox" name="amenities_elevator[]" value="1" <?php if ($switch_remember['amenities_elevator']) { echo "checked"; } ?> ></td></tr>

				<tr><td align="right" class="controltext">Not Owner Occupied</td><td align="left"><input type="checkbox" name="amenities_not_owner_occupied[]" value="1" <?php if ($switch_remember['amenities_not_owner_occupied']) { echo "checked"; } ?> ></td></tr>


				</table>
			</td>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Health Club </td><td align="left"><input type="checkbox" name="amenities_health_club[]" value="1" <?php if ($switch_remember['amenities_health_club']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Pool </td><td align="left"><input type="checkbox" name="amenities_pool[]" value="1" <?php if ($switch_remember['amenities_pool']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Sauna </td><td align="left"><input type="checkbox" name="amenities_sauna[]" value="1" <?php if ($switch_remember['amenities_sauna']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Tennis </td><td align="left"><input type="checkbox" name="amenities_tennis[]" value="1" <?php if ($switch_remember['amenities_tennis']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Lounge </td><td align="left"><input type="checkbox" name="amenities_lounge[]" value="1" <?php if ($switch_remember['amenities_lounge']) { echo "checked"; } ?> ></td></tr>

</table>
</CENTER>
			</td>
			<td valign="top">

				<table border="0">

<tr><td align="right" class="controltext">Business Center</td><td align="left"><input type="checkbox" name="amenities_businesscenter[]" value="1" <?php if ($switch_remember['amenities_businesscenter']) { echo "checked"; } ?> ></td></tr>

				<tr><td align="right" class="controltext">Club House</td><td align="left"><input type="checkbox" name="amenities_clubhouse[]" value="1" <?php if ($switch_remember['amenities_clubhouse']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Storage in Attic </td><td align="left"><input type="checkbox" name="amenities_attic[]" value="1" <?php if ($switch_remember['amenities_attic']) { echo "checked"; }?> >  </td></tr>
				<tr><td align="right" class="controltext">Storage in Basement </td><td align="left"><input type="checkbox" name="amenities_basement[]" value="1" <?php if ($switch_remember['amenities_basement']) {echo "checked"; } ?> >  </td></tr>
				<tr><td align="right" class="controltext">Storage in Bin </td><td align="left"><input type="checkbox" name="amenities_bin[]" value="1" <?php if ($switch_remember['amenities_bin']) {echo "checked"; }?> ></td></tr>

				</table>

			</TD>
			<td valign="top">

				<table border="0">

				<tr><td align="right" class="controltext">Subway</td><td align="left"><input type="checkbox" name="amenities_subway[]" value="1" <?php if ($switch_remember['amenities_subway']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Commuter Rail</td><td align="left"><input type="checkbox" name="amenities_crail[]" value="1" <?php if ($switch_remember['amenities_crail']) { echo "checked"; }?> >  </td></tr>
				<tr><td align="right" class="controltext">Bus</td><td align="left"><input type="checkbox" name="amenities_bus[]" value="1" <?php if ($switch_remember['amenities_bus']) {echo "checked"; } ?> >  </td></tr>
				<tr><td align="right" class="controltext">Shuttle bus</td><td align="left"><input type="checkbox" name="amenities_shuttle[]" value="1" <?php if ($switch_remember['amenities_shuttle']) {echo "checked"; }?> ></td></tr>
				<tr><td align="right" class="controltext">Wheelchair Access</td><td align="left"><input type="checkbox" name="amenities_wheelchair[]" value="1" <?php if ($switch_remember['amenities_wheelchair']) { echo "checked"; } ?> ></td></tr>
</table>


			</td>
			</tr>
			</table>

	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="<?php echo $pagebgcolor;?>">
		<table>
		<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Building Type:</div><select name="building_type[]"  multiple size="4" STYLE="Background-Color : #FFFFFF">
				<?php foreach ($DEFINED_VALUE_SETS['BUILDING_TYPE'] as $btkey => $btVal) { ?>
					<option value="<?php echo $btkey;?>"
					<?php if (is_array($switch_remember['building_type'])) {
						if (in_array($btkey, $switch_remember['building_type'])) {
							echo " selected ";
						}
					}?>>
					<?php echo $btVal;?></option>
				<?php } ?>
			</select></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Building Style:</div><select name="building_style[]"  multiple size="4" STYLE="Background-Color : #FFFFFF">
				<?php foreach ($DEFINED_VALUE_SETS['BUILDING_STYLE'] as $bskey => $bsVal) { ?>
					<option value="<?php echo $bskey;?>"
					<?php if (is_array($switch_remember['building_style'])) {
						if (in_array($bskey, $switch_remember['building_style'])) {
							echo " selected ";
						}
					}?>>
					<?php echo $bsVal;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>





			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Exterior:</div><select name="exterior[]"  multiple size="4" STYLE="Background-Color : #FFFFFF">
				<?php foreach ($DEFINED_VALUE_SETS['EXTERIOR'] as $exteriorkey => $exteriorVal) { ?>
					<option value="<?php echo $exteriorkey;?>"
					<?php if (is_array($switch_remember['exterior'])) {
						if (in_array($exteriorkey, $switch_remember['exterior'])) {
							echo " selected ";
						}
					}?>>
					<?php echo $exteriorVal;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>





			<td height="30"  width="100" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Laundry:</div><select name="laundry_room[]"  multiple size="4" STYLE="Background-Color : #FFFFFF">
				<?php foreach ($DEFINED_VALUE_SETS['LAUNDRY_ROOM'] as $launkey => $launVal) {?>
					<option value="<?php echo $launkey; ?>"
					<?php if (is_array($switch_remember['laundry_room'])) {
						if (in_array($launkey, $switch_remember['laundry_room'])) {
							echo " selected ";
						}
					}?>>
					<?php echo $launVal;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			</tr>
			</table>
	</td>
	<td valign="top" width="1" height="100%" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="<?php echo $pagebgcolor;?>">
		<table>
		<tr>
			<td height="30"  colspan="10" align="center" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><strong>Misc:<strong></div></td>
		</tr>

		</table>
	</td>
	<td valign="top" width="1" height="100%" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="<?php echo $pagebgcolor;?>">
		<table>
		<tr>
			<td height="30"  bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Key Info:</div><select name="key_info[]"  multiple size="4" STYLE="Background-Color : #FFFFFF">
				<?php foreach ($DEFINED_VALUE_SETS['KEY_INFO'] as $keyKey => $keyVal) {?>
					<option value="<?php echo $keyKey;?>"
					<?php if (is_array($switch_remember['key_info'])) {
						if (in_array($keykey, $switch_remember['key_info'])) {
							echo " selected ";
						}
					}?>>
					<?php echo $keyVal;?></option>
				<?php } ?>
				</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Students:</div><select name="students[]"  multiple size="4" STYLE="Background-Color : #FFFFFF">
				<?php foreach ($DEFINED_VALUE_SETS['STUDENTS'] as $studentKey => $studentVal) {?>
				<option value="<?php echo $studentKey;?>"
				<?php if (is_array($switch_remember['students'])) {
						if (in_array($studentkey, $switch_remember['students'])) {
							echo " selected ";
						}
					}?>>
				<?php echo $studentVal;?></option>
				<?php }?>
				</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

		</tr>
		</table>
	</td>
	<td valign="top" width="1" height="100%" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="<?php echo $pagebgcolor;?>">
		<table border="0">
		<?php
			$getLEMon = $switch_remember['bbbLEMonth'];
			$getLEDay = $switch_remember['bbbLEDay'];
			$getLEYear = $switch_remember['bbbLEYear'];
			?>
		<tr>
		<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30"  bgcolor="<?php echo $pagebgcolor;?>">



<TABLE border=0><TR><TD COLSPAN=5 align="center">

<div class="controltext">Lease Expires:</DIV>

</TD></TR><TR><TD>


 <div class="controltext">Month</div><select name="bbbLEMonth" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<option value="01" <?php if ($getLEMon == "01") { echo " selected "; } ?>>Jan</option>
				<option value="02" <?php if ($getLEMon == "02") { echo " selected "; } ?>>Feb</option>
				<option value="03" <?php if ($getLEMon == "03") { echo " selected "; } ?>>Mar</option>
				<option value="04" <?php if ($getLEMon == "04") { echo " selected "; } ?>>Apr</option>
				<option value="05" <?php if ($getLEMon == "05") { echo " selected "; } ?>>May</option>
				<option value="06" <?php if ($getLEMon == "06") { echo " selected "; } ?>>Jun</option>
				<option value="07" <?php if ($getLEMon == "07") { echo " selected "; } ?>>Jul</option>
				<option value="08" <?php if ($getLEMon == "08") { echo " selected "; } ?>>Aug</option>
				<option value="09" <?php if ($getLEMon == "09") { echo " selected "; } ?>>Sep</option>
				<option value="10" <?php if ($getLEMon == "10") { echo " selected "; } ?>>Oct</option>
				<option value="11" <?php if ($getLEMon == "11") { echo " selected "; } ?>>Nov</option>
				<option value="12" <?php if ($getLEMon == "12") { echo " selected "; } ?>>Dec</option>
			</select></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>


			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Day</div><select name="bbbLEDay" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php for ($i=1;$i<=31;$i++) {
					if ($i<=9) {
						$j = "0".$i;
					} else {
						$j = $i;
					}
				?>
				<option value="<?php echo $j;?>" <?php if ($getLEDay == $j) { echo " selected "; } ?>><?php echo $j;?></option>
				<?php } ?>
			</select></td>



			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Year</div><select name="bbbLEYear" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php
				$thisYear = date ("Y")-2;
				for ($i=0;$i<=4;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($getLEYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
				<?php }?>
			</select></td>

</TD></TR></TABLE>


<?php if ($agcy>0) { ?>
<TD valign="top">
<div class="controltext">Office/Agency:<br>

<select name="agency[]" multiple size="3" STYLE="Background-Color : #FFFFFF">

<OPTION VALUE="0"><?php echo $group; ?></OPTION>

<?php
	$quStrGetAgencies1 = "SELECT * FROM AGENCIES WHERE GID=$grid";
	$quGetAgencies1 = mysqli_query($dbh, $quStrGetAgencies1) or die ($quStrGetAgencies1);

		while($rowAgency1 = mysqli_fetch_object($quGetAgencies1))
			{
echo "<OPTION VALUE=\"$rowAgency1->AGENCY_ID\">$rowAgency1->AGENCY_NAME</OPTION>";
}
?>
				</select>
</div>
</TD>
<?php } ?>





<TD>
<div class="controltext"><NOBR>Listing Agent:</NOBR><br>
	<select name="uid[]" STYLE="Background-Color : #FFFFFF" SIZE=3 MULTIPLE>
		<?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) { ?>
		<option value="<?php echo $rowGetUsers->UID;?>"><?php echo $rowGetUsers->HANDLE; ?></option>
		<?php } ?>
	</select>
</DIV>
</TD>


<TD>
<?php

$quStrGetname = "SELECT * FROM `USERS` WHERE `GROUP`=$grid ORDER BY `HANDLE`";

	$quGetname = mysqli_query($dbh, $quStrGetname) or die ($quStrGetname);

@	mysqli_data_seek ($quStrGetname, 0);


?>

<div class="controltext">Mod By Agent:<br>
	<select name="modby[]" STYLE="Background-Color : #FFFFFF" SIZE=3 MULTIPLE>
		<?php
while($rowGetname=mysqli_fetch_object($quGetname)) { ?>
		<option value="<?php echo $rowGetname->HANDLE; ?>"><?php echo $rowGetname->HANDLE; ?></option>
		<?php } ?>
	</select>
</DIV>
</TD>




			<td height="30" width="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Listing&nbsp;Status:<select name="rented_by[]" multiple size="3" STYLE="Background-Color : #FFFFFF">
				<?php foreach ($DEFINED_VALUE_SETS['RENTED_BY'] as $rentedKey => $rentedVal) {?>
				<option value="<?php echo $rentedKey;?>"
				<?php if (is_array($switch_remember['rented_by'])) {
						if (in_array($rentedkey, $switch_remember['rented_by'])) {
							echo " selected ";
						}
					}?>>
				<?php echo $rentedVal;?></option>
				<?php }?>
				</select>
</td>
<!--
<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">
<NOBR>Pending <img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="16" WIDTH="16" alt="Pending Status - Yes" title="Pending Status - YES - Check Status">:<input type="checkbox" name="status_pending[]" value="1" <?php if ($switch_remember['status_pending']) { echo " checked "; } ?> ></NOBR>
</DIV></TD>
-->

<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>



			</tr>



			<tr>

			<td colspan="10" height="30" width="100%" bgcolor="<?php echo $pagebgcolor;?>" align="center">
<P><BR>

<TABLE><TR><TD VALIGN="TOP">

<input type="image" src="../assets/images/button-searchlistings.png" alt="Search Listings"></form>

</TD><TD VALIGN="TOP">
<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=big&availFilter=n";?>" method="POST"><input type="hidden" name="clear_filter" value="1"><input type="hidden" name="filter_change" value="1"><input type="image" src="../assets/images/button-searchclear.png" alt="Clear Search"></form>
</TD></TR></TABLE>




</td>
			</tr>


	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>



			<tr>
			<td width="100%" colspan="10" bgcolor="<?php echo $pagebgcolor;?>"><div class="ad"><?php echo $filter_string_display;?><?php echo "<FONT SIZE=-3> - Total # of matching listings: $num_rows</FONT>"; ?></div></td>
			</tr>
			<tr>
			<td height="30" width="100%" colspan="10" bgcolor="<?php echo $pagebgcolor;?>" valign="bottom" align="right"><div class="controltext"><NOBR><IMG SRC="../images/search.gif" border="0"> <B>Search Listings:</B> <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=big";?>">Full Search</a> | <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=small";?>">Simple Search</a> | <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=mobile";?>">Mobile Search</a> | <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>">Hide Search Form</a> | <a id="displayMenu" href="javascript:togglemenu();">Toggle Menu</a></NOBR></DIV></td>
			</tr>

			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="3" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	<?php } else {?>

	<table border="0" cellspacing="0" cellpadding="0" width="50%">
	<tr>
	<td colspan="3" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">


			<table width="100%" align="center" border=0>
			<tr>

			<td width="100%" bgcolor="<?php echo $pagebgcolor;?>"><div class="ad"><?php echo $filter_string_display;?><?php echo "<FONT SIZE=-3> - Total # of matching listings: $num_rows</FONT>"; ?></div></td>
			</tr>
			<tr>
			<td height="30" width="100%" bgcolor="<?php echo $pagebgcolor;?>" valign="bottom" align="center"><div class="controltext">

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="100%"><TR><TD ALIGN="MIDDLE" BGCOLOR="#FFFFFF" style="font-size:12px;">
<NOBR>
<IMG SRC="../images/search.gif" border="0"> <B>Search Listings:</B> <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=big";?>">Full Search</a> | <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=small";?>">Simple Search</a> | <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=mobile";?>">Mobile Search</a> | <a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>">Hide Search Form</a> | <a id="displayMenu" href="javascript:togglemenu();">Toggle Menu</a> &nbsp;</NOBR>
</DIV>


</TD><TD VALIGN="MIDDLE" ALIGN="CENTER" BGCOLOR="#CCCCCC">



<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none&availFilter=n";?>" method="POST"><input type="hidden" name="clear_filter" value="1"><input type="hidden" name="filter_change" value="1"><input type="image" src="../assets/images/button-searchclear.png" alt="Clear Search"></form>




</TD></TR></TABLE>

</td>
			</tr>

			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="3" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	<?php }?>

<!-- END SEARCH SCREENS -->

<!-- BEGIN VIEW SELECT -->

	<FONT SIZE="-3">&nbsp;<br></FONT>

<?php if ($vid!=7) { ?>

<TABLE BORDER=0 CELLPADDING="0" CELLSPACING="0"><TR><TD VALIGN="TOP">

<?php } ?>


	<table border="0" cellspacing="0" cellpadding="0" height="10" BGCOLOR="lightgrey">
		<tr>
		<td width="230" align="center">
		<form action="<?php echo "$PHP_SELF";?>" method="GET" name="listings_view_form"><input type="hidden" name="op" value="listings">
			<div class="controltext"><NOBR>View:<select style="background-color:white" name="vid" onchange="JavaScript:document.listings_view_form.submit();">
			<?php
			mysqli_data_seek ($quGetViews, 0);
			while ($rowGetViews = mysqli_fetch_object($quGetViews)) {?>
			<?php if ($rowGetViews->ID!=9 || $agcy>0) { ?>
				<option value="<?php echo $rowGetViews->ID;?>" <?php if ($vid==$rowGetViews->ID) { echo " selected "; }?>><?php echo $rowGetViews->NAME;?></option>
			<?php } ?>
			<?php } ?>
			</select></NOBR></div>
			</form>
		</td>
		<td width="1">&nbsp;</td>
		<td align="center"><form action="<?php echo "$PHP_SELF";?>" method="GET" name="limitNForm"><input type="hidden" name="op" value="listings"><div class="controltext">Show<input type="text" size="2" name="limitN" value="<?php echo $limitN;?>" onchange="JavaScript:document.limitNForm.submit();">listings per page.</div></form></td>
		<td width="1">&nbsp;</td>
		<td align="center">
		<form action="<?php echo $PHP_SELF;?>" method="GET" name="pageFlipForm">
		<input type="hidden" name="op" value="listings">
		<div class="controltext">View page:<select style="background-color:white" name="start" onchange="JavaScript:document.pageFlipForm.submit();" >
		<?php for ($i=1;$i<=$numPages;$i++) {
		    	$thisCalc = $limitN * ($i-1);
		    	if (!$thisCalc) {
		    		$thisCalc = "z";
		    	}?>		    	?>
		    	<option value="<?php echo $thisCalc;?>" <?php if ($thisCalc==$start) {echo " selected ";}?>><?php echo $i;?></option>
		<?php }?>
		</select></div>
		</form>
		</td>
		</tr>
		<tr>
		<td colspan="5" bgcolor="#FFFFFF" align="center">
		<div class="controltext">
		 <a href="<?php echo "$PHP_SELF?op=listings&start=z&limitN=$num_rows&filterChange=1";?>">Show all listings</a> -
		    <?php
		    if ($userFilter) { ?>
		    	<a href="<?php echo "$PHP_SELF?op=listings&start=z&userFilter=n&filterChange=1";?>">Show all listings for <?php echo $group;?></a>
		    <?php } else { ?>
		    	<a href="<?php echo "$PHP_SELF?op=listings&start=z&userFilter=1&filterChange=1";?>">Show only <?php echo $handle;?>'s listings</a>
		    <?php } ?>
		   -
		    <?php
		    if ($activeFilter) { ?>
		    	<a href="<?php echo "$PHP_SELF?op=listings&start=z&activeFilter=n&filterChange=1";?>">Show all active and inactive listings</a>
		    <?php } else { ?>
		    	<a href="<?php echo "$PHP_SELF?op=listings&start=z&activeFilter=1&filterChange=1";?>">Show only active listings</a>

		    <?php } ?>
		    </div>
		</td>
		</tr>
	</table>



<?php if ($vid!=7) { ?>

<TD BGCOLOR="#000000" WIDTH="1">&nbsp;</TD>

</TD><TD VALIGN="TOP" ALIGN="CENTER" BGCOLOR="GRAY">
<?php if ($user_level>0) {?>
		      <form action="<?php echo "$PHP_SELF?op=select_and_do&return_page=listings";?>" method="POST" name="moveform">
		      <select size="1" name="sop" style="background-color:white">
				<option value="" selected>Pick a Multi-Action</option>
			<?php if ($user_level >= 3) { echo "<option value='delete'>Delete...</option>";} ?>
		  		<option value="deactivate">Deactivate Ad(s)</option>
		  		<option value="activate">Activate Ad(s)</option>
				<option value="available">Mark Available</option>
				<option value="act-avail">Mark Avail+Advertised</option>
				<option value="act-avail-datenow">Mark Avail+Advertised+Date Now</option>
				<option value="unavailable">Mark Unavailable</option>
				<option value="deact-unavail">Mark Unavl+Deactive Ad</option>
		  		<option value="updtd">Mark as Updated</option>
		  		<option value="vacant">Mark Vacant</option>
		  		<option value="occupied">Mark Occupied</option>
		  		<option value="pending">Mark Pending</option>
				<option value="pendingno">Mark Not Pending</option>
		  		<option value="nofee">Make NO FEE</option>
		  		<option value="fee">Remove NO FEE</option>
		  		<option value="feehalf">Make 1/2 FEE</option>
		  		<option value="feeneg">FEE Negotiable</option>
		  		<option value="email">Email Listing(s)</option>
				<option value="datenow">Mark Avail Date Now</option>
		  		<option value="dom">Reset Days on Market</option>
				<option value="cobroke">Mark Co-Broke ON</option>
				<option value="cobroke2">Mark Co-Broke+Avail ON</option>
				<option value="cobroke3">Mark Co-Broke+Avail+Active</option>
				<option value="cobrokeoff">Mark Co-Broke Off</option>
				<option value="cobrokeoff2">Mark Co-Broke Off+UnAvl</option>
				<option value="cobrokeoff3">Mark Co-Broke Off+UnAvl+No Ad</option>
				</select><br>
		        <INPUT TYPE=IMAGE SRC="../images/dotochecked.gif" NAME="SUBMIT"><br>
<?php }?>
</TD></TR></TABLE>

<?php }?>

<!-- END VIEW SELECT -->


<?php if( $vid==9 && $agcy>0 ) { // AGENCY ?>
	<FONT SIZE="-3"><br></FONT>
        <center>
        <?php if ($isAdmin || $handle=="eboyer")
        { ?>
        <table border=1 width=320 BORDERCOLOR="#000000" BGCOLOR="#FFFFFF"><tr><td><font size=-1>

                <a href=<?php echo "$PHP_SELF?op=createAgency&return_page=listings";?>>Create New Agency/Office</a><br><BR>
        <?php   foreach ($arrayAgency as $key => $value)
                {
                        echo "<b>$value</b>&nbsp;&nbsp;&nbsp;<a href=\"$PHP_SELF?op=editAgency&agency_id=$key&return_page=$page&return_page_div=$k\"><FONT COLOR=green>edit</FONT></a>&nbsp;<a href=\"$PHP_SELF?op=deleteAgency&agency_id=$key&return_page=$page&return_page_div=$k\"><FONT COLOR=red>delete</FONT></a> (agency id:=$key)<br>";
                }
        } ?>
        </td></tr></table></CENTER>
<?php } ?>

	<FONT SIZE="-3"><br></FONT>

	<?php if ($rowGetView['GRID_EDIT']) {?>
	<!--GRID_EDIT TOP CONTROLS -->
  	<input type="button" value="Grid Update">
  	<!--END GRID_EDIT TOP CONTROLS -->
	<?php }?>



	<table border="0" cellpadding="2" cellspacing="0">
	<tr>
	<!--TOP COLUMN-->



	<?php foreach ($cols as $col) {



		if ($sort==$col[1]) {
			if ($sortD=="DESC") {
				$bgcolor = $rowGetView['COLOR4'];
				$sortImage = "<img src='../images/down.gif' border='0' >";
			}else {
				$bgcolor = $rowGetView['COLOR5'];
				$sortImage = "<img src='../images/up.gif' border='0' >";
			}
		}else {
			$bgcolor = $rowGetView['COLOR3'];
			$sortImage = "";
		}

		?>




		<td class="controltext" width="<?php echo $col[2]; ?>" height="28" bgcolor="<?php echo $coltitcolor;?>">



<?php if ( $col[3] == 'ckbox') { ?>
<CENTER>
<span style="font-size:7px;"><NOBR>&#9745;All</NOBR><input type="checkbox" name="allbox" value="sel_all" onClick="CheckAll();"></span></CENTER>

<?php } elseif ( $col[1] == 'delete') { ?>

<span style="font-size:8px;">Del</span></CENTER>

<?php } elseif ( $col[1] == 'edit') { ?>

<span style="font-size:8px;">Edit</span></CENTER>


                        <?php }elseif ($col[0]=='ssheet') { ?>

<CENTER><span style="font-size:6px;">Show Sheet</span></CENTER>

                        <?php }elseif ($col[0]=='ssheetpic') { ?>

<CENTER><span style="font-size:6px;">Show Sheet</span></CENTER>


                        <?php }elseif ($col[0]=='csheet') { ?>

<CENTER><span style="font-size:6px;">Client Sheet</span></CENTER>

                        <?php }elseif ($col[0]=='csheetpic') { ?>

<CENTER><span style="font-size:6px;">Client Sheet</span></CENTER>



                        <?php }elseif ($col[1]=='email') { ?>

<span style="font-size:8px;">Email</span></CENTER>



                        <?php }elseif ($col[0]=='adprint') { ?>

<CENTER><span style="font-size:7px;">Print Ad</span></CENTER>

                        <?php }elseif ($col[0]=='weblist') { ?>

<span style="font-size:8px;">Website</SPAN><span style="font-size:6px;"><BR></SPAN><span style="font-size:8px;"><NOBR>Web List</NOBR></span></CENTER>


                        <?php }elseif ($col[0]=='pending') { ?>

<a href="<?php echo "$PHP_SELF?op=listings&sort=STATUS_PENDING&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo "<span style=\"font-size:9px;\">Pndg</FONT>";?><?php echo $sortImage;?></span></a>




                        <?php }elseif ($col[0]=='descriptive' OR $col[0]=='descriptive-agent') { ?>



<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD ALIGN="LEFT">

<span style="font-size:11px;">&#9745;All <input type="checkbox" name="allbox" value="sel_all" onClick="CheckAll();"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</SPAN></TD><TD ALIGN="CENTER"><NOBR>
<span style="font-size:11px;"> Sort by:
<a href="<?php echo "$PHP_SELF?op=listings&sort=PRICE&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo "PRICE";?><?php echo $sortImage;?></font></a>

&nbsp;

<a href="<?php echo "$PHP_SELF?op=listings&sort=LOC&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo "LOCATION";?><?php echo $sortImage;?></font></a>

&nbsp;

<a href="<?php echo "$PHP_SELF?op=listings&sort=AVAIL&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo "AVAILABLE";?><?php echo $sortImage;?></font></a>

&nbsp;

<a href="<?php echo "$PHP_SELF?op=listings&sort=STATUS_ACTIVE&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo "AVAILABILITY";?><?php echo $sortImage;?></font></a>

&nbsp;

<a href="<?php echo "$PHP_SELF?op=listings&sort=MOD&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo "MODIFIED";?><?php echo $sortImage;?></font></a>

&nbsp;

<a href="<?php echo "$PHP_SELF?op=listings&sort=ROOMS&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo "BEDS";?><?php echo $sortImage;?></font></a>

&nbsp;

<a href="<?php echo "$PHP_SELF?op=listings&sort=PIC&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo "PICS";?><?php echo $sortImage;?></font></a>

&nbsp;

<a href="<?php echo "$PHP_SELF?op=listings&sort=STATUS&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo "AD STATUS";?><?php echo $sortImage;?></font></a>

&nbsp;

<a href="<?php echo "$PHP_SELF?op=listings&sort=LANDLORD&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo "LANDLORD";?><?php echo $sortImage;?></font></a>

&nbsp;

<a href="<?php echo "$PHP_SELF?op=listings&sort=UID&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo "CREATED BY";?><?php echo $sortImage;?></font></a>

&nbsp;

<a href="<?php echo "$PHP_SELF?op=listings&sort=MODBY&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo "MOD BY";?><?php echo $sortImage;?></font></a>

&nbsp;

<a href="<?php echo "$PHP_SELF?op=listings&sort=DATEONMARKET&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo "DOM";?><?php echo $sortImage;?></font></a>

&nbsp;

<a href="<?php echo "$PHP_SELF?op=listings&sort=STATUS_PENDING&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo "PENDING";?><?php echo $sortImage;?></font></a>

</NOBR>
</span></CENTER>
</TD></TR></TABLE>

<?php } else { ?>

<a href="<?php echo "$PHP_SELF?op=listings&sort=$col[1]&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo $col[3];?><?php echo $sortImage;?></font></a>

<?php } ?>



</td>

	<?php } ?>




	<!--END TOP COLUMN-->
	</tr>

	<!--RECORDS -->
	<?php while ($rowGetListings = mysqli_fetch_array($quGetListings)) { ?>

        <?php if ($rowColor=="#FFFFFF") {

if ($pref_row_color=="") {
$rowColor="#F5F5DC";
	} else {
$rowColor="$pref_row_color";
}

        }else {
         $rowColor="#FFFFFF";
        } ?>

		<tr tabindex="2" id="ad<?php echo $k++;?>k">
		<?php
		$i = 0;
		foreach ($cols as $col) {



			?>

			<td class="ad" width="<?php echo $col[2]; ?>" height="28" bgcolor="<?php echo $rowColor; ?>" nowrap>
			<?php if ($col[0]=='f') {
				if ($col[5]) { //use images;
					if (!$rowGetListings[$col[1]]) {
						echo "<img src='../assets/images/icons/" . $col[4] . "' border='0' alt='" . $col[3] . "=" . $rowGetListings[$col[1]] . "'>";
					}elseif ($rowGetListings[$col[1]] >= 5) {
						echo "<img src='../assets/images/icons/" . $col[9] . "' border='0' alt='" . $col[3] . "=" . $rowGetListings[$col[1]] . "'>";
					}elseif ($rowGetListings[$col[1]] >= 4) {
						echo "<img src='../assets/images/icons/" . $col[8] . "' border='0' alt='" . $col[3] . "=" . $rowGetListings[$col[1]] . "'>";
					}elseif ($rowGetListings[$col[1]] >= 3) {
						echo "<img src='../assets/images/icons/" . $col[7] . "' border='0' alt='" . $col[3] . "=" . $rowGetListings[$col[1]] . "'>";
					}elseif ($rowGetListings[$col[1]] >= 2) {
						echo "<img src='../assets/images/icons/" . $col[6] . "' border='0' alt='" . $col[3] . "=" . $rowGetListings[$col[1]] . "'>";
					}elseif ($rowGetListings[$col[1]] >= 1) {
						echo "<img src='../assets/images/icons/" . $col[5] . "' border='0' alt='" . $col[3] . "=" . $rowGetListings[$col[1]] . "'>";
					}
				}else { //use values;
					if ($col[4] == "df") {
						echo $DEFINED_VALUE_SETS[$col[1]][$rowGetListings[$col[1]]];
					}elseif ($col[4] == "fd") {
						echo fuzDate ($rowGetListings[$col[1]]);
					}else {
						$prefix_char = substr ($col[4], 1, 10);
						echo "$prefix_char" . $rowGetListings[$col[1]];
					}
				}
			 }elseif ($col[0] == 'form') {
                               if($col[4] == 'text') {

                                }elseif ($col[4] == 'agency') {
                                // AGENCY

                                echo "<form name=\"agency_update_form".$rowGetListings['CID']."\" action=\"$PHP_SELF\" method=GET>";
                                echo "<input type=hidden name=op value=\"changeAgency\">";
                                echo "<input type=hidden name=cid value=\"".$rowGetListings['CID']."\">";
                                echo "<input type=hidden name=gid value=$gid>";
                                echo "<input type=hidden name=return_page value=listings>";
                                echo "<input type=hidden name=return_page_div value=$k>";
                                        echo "<select name=agency onchange=\"JavaScript:document.agency_update_form".$rowGetListings['CID'].".submit();\">";
                                        ?>
                                        <option value=0
                                        <?php if ($key>0)
                                        {       echo " selected "; }
                                        ?>
                                        >Main Agency</option>
                                        <?php
                                        foreach($arrayAgency as $key => $value)
                                        {
                                        ?>
                                        <option value="<?php echo $key; ?>"
<?php                                   if ($key==$rowGetListings[$col[1]])
                                                { echo " selected ";}
?>
                                        >
                                        <?php echo $value; ?></option>
                                        <?php
//                                              echo "$key $value";
                                        }
                                        echo "</select>";
//                                      echo $arrayAgency[$rowGetListings[$col[1]]];
                                echo "</form>";
                                } else
                                {
                                        echo $col[1];
                                }

			}elseif ($col[0]=='a') {
				if (($col[1] == "delete") && ($user_level <2)) {
					continue;
				}
//				echo "<a href=\"$PHP_SELF?op=" . $actions[$col[1]] . "&cid=" . $rowGetListings['CID'] . "&return_page=listings&return_page_div=$k\">" . $col[1] ."</a>";
				echo "<a href=\"$PHP_SELF?op=" . $actions[$col[1]] . "&cid=" . $rowGetListings['CID'] . "&return_page=listings&return_page_div=$k\">"."<img border=0 src=\"../images/icons/".$col[1].".gif\" alt=\"".$col[1]."\">"."</a>";
			}elseif ($col[0]=='ut') {?>
				<input type="text" name="<?php echo "ge_" . $rowGetListings['CID'] . "_" . $col[1];?>" value="<?php echo $rowGetListings[$col[1]];?>" size="<?php echo $col[4];?>">

<?php
                        }elseif ($col[0]=='px') { // photo display
                                if($rowGetListings[$col[1]])
                                { ?>
                                        <CENTER><a href="<?php echo "$PHP_SELF?op=managePics&cid=" . $rowGetListings['CID'] . "&return_page=listings&return_page_div=$k"; ?>"><img src="../images/pic.gif" alt="View and Edit Photos" title="View and Edit Photos" border=0></a></CENTER>
                                <? }else { ?>


<?php if ($user_level>0) {?>
                                        <CENTER><a href="<?php echo "$PHP_SELF?op=managePics&cid=" . $rowGetListings['CID'] . "&return_page=listings&return_page_div=$k"; ?>">add pic</a></CENTER>

				<?php } ?>
				<?php } ?>


                        <?php }elseif ($col[0]=='pkg') { ?>
				<CENTER>
			<?php
			if (!$rowGetListings['PARKING_NUM']) {
			    echo "";
			} elseif ($rowGetListings['PARKING_NUM']=="9") {
			    echo "A";
			} elseif ($rowGetListings['PARKING_NUM']=="0") {
			    echo "";
			} else {
			echo $rowGetListings['PARKING_NUM'];
			}
			?>
				</CENTER>



                        <?php }elseif ($col[0]=='email') { ?>

				<CENTER><a href="<?php echo "$PHP_SELF?op=mail_listing&cid=". $rowGetListings['CID'] . "&return_page=listings&return_page_div=" . $k; ?>" target="_email">
<img src="../assets/images/mail_listing.gif" border=0 alt="Email Listing" title="Email Listing"></a></CENTER>


                        <?php }elseif ($col[0]=='ssheet') { ?>

<CENTER><a href="javascript:popUpPrintOut('./printout_agent.php?cid=<?php echo $rowGetListings['CID'];?>');"><img src="../assets/images/agent-ss.gif" vspace="0" hspace="0" border="0" height="18" width="18" alt="Agent Show Sheet" title="Agent Show Sheet <?php if ($rowGetListings['SHOW_INSTRUCT']) { echo  " - ".$rowGetListings['SHOW_INSTRUCT']; }?><?php if ($rowGetListings['LISTING_NOTES']) { echo  " - ".$rowGetListings['LISTING_NOTES']; }?>"></a></CENTER>

                        <?php }elseif ($col[0]=='ssheetpic') { ?>

<?php if ($rowGetListings['PIC']>0) { ?>

<CENTER><a href="javascript:popUpPrintOut('./printout_agent_pic.php?cid=<?php echo $rowGetListings['CID'];?>');"><img src="../assets/images/agent-ss-pic.gif" vspace="0" hspace="0" border="0" height="18" width="18" alt="Agent Show Sheet with Pictures" title="Agent Show Sheet with Pictures <?php if ($rowGetListings['SHOW_INSTRUCT']) { echo  " - ".$rowGetListings['SHOW_INSTRUCT']; }?><?php if ($rowGetListings['LISTING_NOTES']) { echo  " - ".$rowGetListings['LISTING_NOTES']; }?>"></a></CENTER>

<?php  } else {
echo "&nbsp;";
} ?>

                        <?php }elseif ($col[0]=='csheet') { ?>

<CENTER><a href="javascript:popUpPrintOut('./printout_client.php?cid=<?php echo $rowGetListings['CID'];?>');"><img src="../assets/images/doc.gif" vspace="0" hspace="0" border="0" height="18" width="18" alt="Client Printout" title="Client Printout"></a></CENTER>

                        <?php }elseif ($col[0]=='csheetpic') { ?>

<?php if ($rowGetListings['PIC']>0) { ?>

<CENTER><a href="javascript:popUpPrintOut('./printout_client_pic.php?cid=<?php echo $rowGetListings['CID'];?>');"><img src="../assets/images/doc-pic.gif" vspace="0" hspace="0" border="0" height="18" width="18" alt="Client Printout with Pictures" title="Client Printout with Pictures"></a></CENTER>

<?php  } else {
echo "&nbsp;";
} ?>


                        <?php }elseif ($col[0]=='pending') { ?>


<CENTER>
<?php if($rowGetListings['STATUS_PENDING']=="1")
			   { ?>

<?php if ($user_level>0) {?>

                              <a href="<?php echo "$PHP_SELF?op=mark_status_pending&cid=".$rowGetListings['CID'] . "&turn=pendingno&return_page=listings&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="16" WIDTH="16" alt="Pending Status - Yes" title="Pending Status - YES - Check Status">
<?php if ($user_level>0) {?>
</a>
<?php }?>
</CENTER>
			    <?php  } else { ?>
<CENTER>
<?php if ($user_level>0) {?>
	<a href="<?php echo "$PHP_SELF?op=mark_status_pending&cid=".$rowGetListings['CID'] . "&turn=pending&return_page=listings&return_page_div=" . $k;?>">
<?php } ?>
<img src="../assets/images/icons/pending-no.gif" border=0 HEIGHT="16" WIDTH="16" alt="Pending Status - No" title="Pending Status - No">
<?php if ($user_level>0) {?>
</a>
<?php } ?><?php } ?></FONT>

</CENTER>


                        <?php }elseif ($col[0]=='adprint') { ?>

<CENTER><a href="<?php echo "https://www.BostonApartments.com/homepage.php?ad=".$rowGetListings['CID']."&cli=".$rowGetListings['CLI']."\" target=\"_NEW\"";?>"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18" alt="Print the Ad" title="Print the Ad"></A></CENTER>



                        <?php }elseif ($col[0]=='myspace') { ?>

<CENTER>
<script type="text/javascript">
function GetThis(T, C, U, L)
{
   var targetUrl = 'http://www.myspace.com/index.cfm?fuseaction=postto&' + 't=' + encodeURIComponent(T)
   + '&c=' + encodeURIComponent(C) + '&u=' + encodeURIComponent(U) + '&l=' + L;
   window.open(targetUrl);
}
</script>
<a href="javascript:GetThis('<?php
if ($rowGetListings['AD_TITLE'] !="") {
echo $rowGetListings['AD_TITLE'];
} else {
echo $rowGetListings['LOCNAME']." - ".$rowGetListings['PRICE']." - ".$rowGetListings['ROOMS']."%20Bed";
} ;?>','<?php echo htmlspecialchars($rowGetListings['BODY']); ?>','<?php echo "http%3A%2F%2Fbostonapartments.com%2Fhomepage.php%3Fcli%3D".$rowGetListings['CLI']."%26ad%3D".$rowGetListings['CID'];?>','1')"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/myspace.gif" alt="Post to MySpace" title="Post to MySpace"></a>
</CENTER>

                        <?php }elseif ($col[0]=='descriptive' OR $col[0]=='descriptive-agent') { ?>

<TABLE BORDER="0"><TR>
<TD WIDTH="80" VALIGN="TOP">
<CENTER>
<TABLE CELLPADDING="0" CELLSPACING="0"><TR><TD ALIGN=LEFT>





<?php

if ($rowGetListings['CLI']=="1075") { echo "<FONT COLOR=BLUE><B>MLS</B></FONT>"; } 


else {

if ($rowGetListings['STATUS']=="STO") { ?>

<?php if ($user_level>0) {?>
		<a href="<?php echo "$PHP_SELF?op=activate_a&cid=". $rowGetListings['CID'] . "&return_page=listings&return_page_div=" . $k; ?>">
<?php } ?>

<img src="../assets/images/inact.jpg" border=0 HEIGHT="16" WIDTH="16" alt="Deactivated Ad" title="Deactivated Ad">
<?php if ($user_level>0) {?>
</a>
<?php } ?>


				<?php } elseif ($rowGetListings['STATUS']=="ACT") { ?>
<?php if ($user_level>0) {?>
				<a href="<?php echo "$PHP_SELF?op=deactivate_a&cid=" . $rowGetListings['CID'] . "&return_page=listings&return_page_div=" . $k; ?>">
<?php } ?>
<img src="../assets/images/act.gif" border=0 HEIGHT="16" WIDTH="16" alt="Activated Ad" title="Activated Ad">
<?php if ($user_level>0) {?>
</a>
<?php } ?>
			<?php	}else{ echo "ERROR"; } } ?>



</TD><TD>&nbsp;</TD><TD>


<?php if($rowGetListings['STATUS_ACTIVE']=="1")
			   { ?>

<?php if ($user_level>0 AND $rowGetListings['CLI']!="1075") {?>

                              <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetListings['CID'] . "&turn=unavailable&return_page=listings&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/a.jpg" border=0 HEIGHT="16" WIDTH="16" alt="Available Listing" title="Available Listing">
<?php if ($user_level>0 AND $rowGetListings['CLI']!="1075") {?>
</a>
<?php }?>



</CENTER>
			    <?php  } else { ?>
<CENTER>
<?php if ($user_level>0 AND $rowGetListings['CLI']!="1075") {?>
	<a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetListings['CID'] . "&turn=available&return_page=listings&return_page_div=" . $k;?>">
<?php } ?>
<img src="../assets/images/icons/u.jpg" border=0 HEIGHT="16" WIDTH="16" alt="Unavailable Listing" title="Unavailable Listing">
<?php if ($user_level>0 AND $rowGetListings['CLI']!="1075") {?>
</a>
<?php } ?><?php } ?></FONT>
</TD>
<TD>&nbsp;</TD>
<TD>

<CENTER>


<?php if($rowGetListings['STATUS_PENDING']=="1")
			   { ?>

<?php if ($user_level>0 AND $rowGetListings['CLI']!="1075") {?>

                              <a href="<?php echo "$PHP_SELF?op=mark_status_pending&cid=".$rowGetListings['CID'] . "&turn=pendingno&return_page=listings&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="16" WIDTH="16" alt="Pending Status - Yes" title="Pending Status - YES - Check Status">
<?php if ($user_level>0 AND $rowGetListings['CLI']!="1075") {?>
</a>
<?php }?>



</CENTER>
			    <?php  } else { ?>
<CENTER>

<?php if ($rowGetListings['CLI']!="1075") { ?>

<?php if ($user_level>0) {?>
	<a href="<?php echo "$PHP_SELF?op=mark_status_pending&cid=".$rowGetListings['CID'] . "&turn=pending&return_page=listings&return_page_div=" . $k;?>">
<?php } ?>
<img src="../assets/images/icons/pending-no.gif" border=0 HEIGHT="16" WIDTH="16" alt="Pending Status - No" title="Pending Status - No">
<?php if ($user_level>0) {?>
</a>
<?php } } } ?></FONT>






</CENTER>
</TD>

</TR></TABLE>
</CENTER>


<?php if ($rowGetListings['PIC']!=0) {

      $quStrGetPics = "SELECT * FROM PICTURE WHERE CID=".$rowGetListings['CID']." ORDER BY PICORDER, PID LIMIT 1";
      $quGetPics = mysqli_query($dbh, $quStrGetPics);
      $rowGetPics = mysqli_fetch_object($quGetPics);
         $thumb="<IMG SRC=https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT HEIGHT=60 WIDTH=60 BORDER=0 TITLE=\"Click for Company Display Ad\">";

 	}
else
	{	$thumb="<FONT SIZE=-2 color=#BDBDBD>No Photo</FONT>";	}

if ($rowGetListings['THUMBNAIL']) {
	$thumb = "<a href=https://www.BostonApartments.com/homepage.php?cli=".$rowGetListings['CLI']."&ad=".$rowGetListings['CID']." target=_NEW><IMG SRC=https://www.BostonApartments.com/pics/".$rowGetListings['THUMBNAIL']." BORDER=0 HEIGHT=60 WIDTH=60 TITLE=\"Click for Company Display Ad\"></A>";
}

if ($rowGetListings['EXTERNALPIC']) {

$thumb="<IMG SRC=".$rowGetListings['EXTERNALPIC']." border=0 HEIGHT=60 width=60 ALIGN=RIGHT VALIGN=TOP>";

}




echo "<CENTER><a href=https://www.BostonApartments.com/homepage.php?cli=".$rowGetListings['CLI']."&ad=".$rowGetListings['CID']." target=_NEW BORDER=0  HEIGHT=60 WIDTH=60 TITLE=\"Click for Company Display Ad\">$thumb</A><BR><FONT SIZE=-1>";

	   if ($rowGetListings['PIC']>0) { echo "<FONT SIZE=-1>x " .$rowGetListings['PIC']."</FONT>"; }
	   elseif ($rowGetListings['EXTERNALPIC_NUM']>0) { echo "<FONT SIZE=-1>x " .$rowGetListings['EXTERNALPIC_NUM']."</FONT>"; }

	   ?>



<?php if ($rowGetListings['CLI']!="1075") { ?>


	   <BR><NOBR><a href="<?php echo "$PHP_SELF?op=managePics&cid=" . $rowGetListings['CID'] . "&return_page=listings&return_page_div=$k"; ?>"><img src="../images/pic.gif" alt="View and Edit Photos" title="View and Edit Photos" border=0></a>&nbsp;<?php
		      if ($rowGetListings['STREET_NUM'] !="" AND $rowGetListings['STREET'] !="") {


$quStrGetstatusp = "SELECT `PIC` FROM `CLASS` WHERE `CLI`='$grid' AND `LANDLORD`='$rowGetListings[LID]' AND `STREET`='$rowGetListings[STREET]' AND `STREET_NUM`='$rowGetListings[STREET_NUM]' AND PIC>='1' LIMIT 1";

$result3 = mysqli_query($dbh, $quStrGetstatusp);
$test3 = mysqli_num_rows($result3);
if ($test3 >0) {

		       echo "&nbsp;<a href=\"$PHP_SELF?op=pics-building&street_num=" . $rowGetListings['STREET_NUM'] . "&street=" . $rowGetListings['STREET'] . "&lid=" . $rowGetListings['LANDLORD'] . "\" target=\"_NEW\"><img border=\"0\" src=\"../assets/images/pic-gallery.jpeg\" HEIGHT=\"17\" WIDTH=\"24\"  alt=\"Building Picture Gallery\" title=\"Building Picture Gallery\"></a>";

} else {
echo "&nbsp;";
}
}
?>

</NOBR><BR>

<CENTER>


<NOBR><A HREF="<?php echo "$PHP_SELF?op=createshowing&cid=".$rowGetListings['CID']."&return_page=listings";?>"><img border="0" src="../assets/images/showings.jpg" alt="edit" vspace="0" hspace="0" HEIGHT="16" WIDTH="16" TITLE="Create A Showing"></A>

<A HREF="<?php echo "$PHP_SELF?op=showinghistoryunit&cid=".$rowGetListings['CID']."&return_page=listings";?>"><img border="0" src="../assets/images/showings-history.jpg" alt="edit" vspace="0" hspace="0" HEIGHT="16" WIDTH="16" TITLE="Showing History"></A>
</NOBR>

<?php } ?>


<BR><BR>
<input id="<?php echo $rowGetListings['CID'];?>" type="checkbox" name="sel_ids[]" value="<?php echo $rowGetListings['CID'];?>" TITLE="Check to select listing for a multi-listing action"></CENTER>


</CENTER>

</TD><TD WIDTH="225" VALIGN="TOP"><FONT SIZE="-1" VALIGN="TOP">
<?php echo $rowGetListings[LOCNAME];?><BR>
<NOBR><B><?php echo $rowGetListings[STREET_NUM];?> <?php echo $rowGetListings[STREET];?>
<?php if ($rowGetListings[APT]!="") { echo "# $rowGetListings[APT]"; } ?>
</B></NOBR><BR>
<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD><FONT SIZE="-1">
# Beds: </FONT></TD><TD>&nbsp;</TD><TD ALIGN="LEFT"><FONT SIZE="-1"> <?php

if ($rowGetListings['ROOMS'] == '0.25') {
echo "LOFT";
}
if ($rowGetListings['ROOMS'] == '0.50') {
echo "STUDIO";
}
if ($rowGetListings['ROOMS'] == '0.75') {
echo "STU/ALC";
}
if ($rowGetListings['ROOMS'] == '0.76') {
echo "STU/2RM";
}
if ($rowGetListings['ROOMS'] == '0.79') {
echo "STU/LFTBD";
}
if ($rowGetListings['ROOMS'] == '1.00') {
echo "<NOBR>1 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '1.50') {
echo "<NOBR>1 BD SPLT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '1.75') {
echo "<NOBR>1 BD PLUS</NOBR>";
}
if ($rowGetListings['ROOMS'] == '1.78') {
echo "<NOBR>1 BD LOFT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '2.00') {
echo "<NOBR>2 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '2.50') {
echo "<NOBR>2 BD SPLT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '2.75') {
echo "<NOBR>2 BD PLUS</NOBR>";
}
if ($rowGetListings['ROOMS'] == '2.78') {
echo "<NOBR>2 BD LOFT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '3.00') {
echo "<NOBR>3 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '3.50') {
echo "<NOBR>3 BD SPLT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '3.75') {
echo "<NOBR>3 BD PLUS</NOBR>";
}
if ($rowGetListings['ROOMS'] == '3.78') {
echo "<NOBR>3 BD LOFT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '4.00') {
echo "<NOBR>4 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '4.50') {
echo "<NOBR>4 BD SPLT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '4.75') {
echo "<NOBR>4 BD PLUS</NOBR>";
}
if ($rowGetListings['ROOMS'] == '4.78') {
echo "<NOBR>4 BD LOFT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '5.00') {
echo "<NOBR>5 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '5.50') {
echo "<NOBR>5 BD SPLT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '5.75') {
echo "<NOBR>5 BD PLUS</NOBR>";
}
if ($rowGetListings['ROOMS'] == '5.78') {
echo "<NOBR>5 BD LOFT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '6.00') {
echo "<NOBR>6 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '7.00') {
echo "<NOBR>7 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '8.00') {
echo "<NOBR>8 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '9.00') {
echo "<NOBR>9 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '10.00') {
echo "<NOBR>10 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '11.00') {
echo "<NOBR>11 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '12.00') {
echo "<NOBR>12 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '13.00') {
echo "<NOBR>13 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '14.00') {
echo "<NOBR>14 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '15.00') {
echo "<NOBR>15 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '16.00') {
echo "<NOBR>16 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '17.00') {
echo "<NOBR>17 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '18.00') {
echo "<NOBR>18 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '19.00') {
echo "<NOBR>19 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '20.00') {
echo "<NOBR>20 BED</NOBR>";
}?></FONT></TD></TR><TR><TD><FONT SIZE="-1">
# Baths: </FONT></TD><TD>&nbsp;</TD><TD ALIGN="LEFT"><FONT SIZE="-1">

<?php
if ($rowGetListings['BATHBATH'] == '0.00') {
echo "";
} elseif ($rowGetListings['BATH'] == '99.00'){
 echo "Shared";
} else {

$rowGetListings['BATH'] = str_replace(".00", "", $rowGetListings['BATH']);
$rowGetListings['BATH'] = str_replace(".50", ".5", $rowGetListings['BATH']);
$rowGetListings['BATH'] = str_replace("0.75", ".75", $rowGetListings['BATH']);

echo  substr ($rowGetListings['BATH'], 0,3) ;
}
?>


</FONT></TD></TR><TR><TD><FONT SIZE="-1">
# Parking: </FONT></TD><TD>&nbsp;</TD><TD ALIGN="LEFT"><FONT SIZE="-1"><?php
if (!$rowGetListings['PARKING_NUM']) {
			    echo "";
			} elseif ($rowGetListings['PARKING_NUM']=="9") {
			    echo "Avail";
			} elseif ($rowGetListings['PARKING_NUM']=="0") {
			    echo "";
			} else {
			echo $rowGetListings['PARKING_NUM'];
			} ?>



<?php if (!$rowGetListings['PARKING_COST']) {
			    echo "";
			} else { echo "$ $rowGetListings[PARKING_COST]"; }  ?>




			</FONT></TD></TR></TABLE>

		
<?php if ($rowGetListings[CLI]=="1075")  {
if ($rowGetListings[CLI]=="1075" AND $rowGetListings[MLS_AGENCY]!="") { echo "<NOBR><FONT COLOR=RED><B>MLS Listing Agency:</B></FONT> <FONT COLOR=BLUE><B>".$rowGetListings[MLS_AGENCY]."</B></FONT></NOBR><BR>"; }
if ($rowGetListings[CLI]=="1075" AND $rowGetListings[MLS_AGENT]!="") { echo "<NOBR><FONT COLOR=RED></B>MLS Listing Agent:</B></FONT> <FONT COLOR=BLUE><B>".$rowGetListings[MLS_AGENT]."</B></FONT></NOBR><BR>"; }
if ($rowGetListings[CLI]=="1075" AND $rowGetListings[MLS_CONTACT]!="") { echo "<NOBR><FONT COLOR=RED>Listing Email:</B></FONT> <FONT COLOR=BLUE><B><A HREF=mailto:".$rowGetListings[MLS_CONTACT].">".$rowGetListings[MLS_CONTACT]."</A></B></FONT></NOBR><BR>"; }
if (($rowGetListings[CLI]=="1075" AND $rowGetListings[MLS_PHONE]!="") AND ($rowGetListings[MLS_PHONE]!=$rowGetListings[MLS_CONTACT])) { echo "<NOBR><FONT COLOR=RED>Listing Phone:</B></FONT> <FONT COLOR=BLUE><B>".$rowGetListings[MLS_PHONE]."</B></FONT></NOBR><BR>"; }
if (($rowGetListings[CLI]=="1075" AND $rowGetListings[MLS_PHONEOFFICE]!="")) { echo "<NOBR><FONT COLOR=RED>Listing Office Phone:</B></FONT> <FONT COLOR=BLUE><B>".$rowGetListings[MLS_PHONEOFFICE]."</B></FONT></NOBR><BR>"; }
if (($rowGetListings[CLI]=="1075" AND $rowGetListings[EXTERNALID]!="")) { echo "<NOBR><FONT COLOR=RED>MLS ID #:</B></FONT> <FONT COLOR=BLUE><B>".$rowGetListings[EXTERNALID]."</B></FONT></NOBR><BR>"; }




} 
else { ?>


LL: <B><A HREF="<?php echo $PHP_SELF;?>?op=editLandlord&lid=<?php echo $rowGetListings['LANDLORD'];?>" target="_ll"><?php echo $rowGetListings['SHORT_NAME'];?></A></B><BR>

<?php

if ($rowGetListings[OFF_PHONE]=="" AND $rowGetListings[MOBILE_PHONE]=="" AND $rowGetListings[HOME_PHONE]=="" AND $rowGetListings[SUPER_PHONE]=="") {
echo "<font color=#AOAOAO>no phone</FONT>";
} else {

if ($rowGetListings[OFF_PHONE]!="") {
echo "<NOBR>O: " . $rowGetListings[OFF_PHONE] . " | ";
} else {
echo "<NOBR>O: <font color=#AOAOAO>none</FONT> | ";
}

if ($rowGetListings[MOBILE_PHONE]!="") {
echo "M: " . $rowGetListings[MOBILE_PHONE] . "</NOBR><BR>";
} else {
echo "M: <font color=#AOAOAO>none</FONT></NOBR><BR>";
}

if ($rowGetListings[HOME_PHONE]!="") {
echo "<NOBR>H: " . $rowGetListings[HOME_PHONE] . "<BR>";
} else {
echo "<NOBR><font color=#AOAOAO>none</FONT></NOBR><BR>";
}



if (($rowGetListings[HOME_SPOUSE_FIRST]!="") OR ($rowGetListings[HOME_SPOUSE_LAST]!="")) {
echo "<NOBR>Spouse: " . $rowGetListings[HOME_SPOUSE_FIRST] . " " . $rowGetListings[HOME_SPOUSE_LAST] ."<BR>";
}

if (($rowGetListings[SPOUSE_CELL]!="") AND ($rowGetListings[SPOUSE_OFFICE]!=""))  {
echo "<NOBR>M: " . $rowGetListings[SPOUSE_CELL] . " O: " . $rowGetListings[SPOUSE_OFFICE] ."</NOBR><BR>";
}

if (($rowGetListings[SPOUSE_CELL]!="") AND ($rowGetListings[SPOUSE_OFFICE]==""))  {
echo "<NOBR>Spouse Mobile: " . $rowGetListings[SPOUSE_CELL] . "</NOBR><BR>";
}

if (($rowGetListings[SPOUSE_CELL]=="") AND ($rowGetListings[SPOUSE_OFFICE]!=""))  {
echo "<NOBR>Spouse Office: " . $rowGetListings[SPOUSE_OFFICE] ."</NOBR><BR>";
}



if ($rowGetListings[SUPER_PHONE]!="") {
echo "<NOBR>Super: " . $rowGetListings[SUPER_PHONE] . "</NOBR><BR>";
}

}


if ($rowGetListings[OFF_EMAIL]!="") {?>
<a href="<?php echo "$PHP_SELF?op=mail_landlord&lid=". $rowGetListings['LID'] . "&e=2"; ?>" target="_email">email</A> | <?php
} elseif ($rowGetListings[LL_EMAIL]!="") { ?>
<a href="<?php echo "$PHP_SELF?op=mail_landlord&lid=". $rowGetListings['LID'] . "&e=1"; ?>" target="_email">email</A> | <?php } else { echo "<font color=#AOAOAO>no email</FONT> | ";} ?>



<?php if ($rowGetListings[OFF_WEBSITE]!="") {?>
<A HREF="<?php echo $rowGetListings[OFF_WEBSITE];?>" target="_web">Website</A><?php } else { echo "<font color=#AOAOAO>no web</FONT>";} ?>  | <?php if ($rowGetListings[OFF_WEBLISTINGS]!="") {?><A HREF="<?php echo $rowGetListings[OFF_WEBLISTINGS];?>" target="_webl">Web list</A><?php } else { echo "<font color=#AOAOAO>no web list</FONT>";} ?><BR>



<?php if ($rowGetListings[LAST_CONTACTED]) { ?>

Last Contact: <?php echo $rowGetListings[LAST_CONTACTED];

if ($rowGetListings['LAST_CONTACT_ACTION'] == "1") { echo "<BR>Contact/Updated" ;}
if ($rowGetListings['LAST_CONTACT_ACTION'] == "2") { echo "<BR>Left Message" ;}
if ($rowGetListings['LAST_CONTACT_ACTION'] == "3") { echo "<BR>No Answer" ;}
if ($rowGetListings['LAST_CONTACT_ACTION'] == "4") { echo "<BR>Call later" ;}
if ($rowGetListings['LAST_CONTACT_ACTION'] == "5") { echo "<BR>Emailed" ;}
if ($rowGetListings['LAST_CONTACT_ACTION'] == "6") { echo "<BR>Landlord Feed" ;}
if ($rowGetListings['LAST_CONTACT_ACTION'] == "7") { echo "<BR>Don't Contact" ;}
if ($rowGetListings['LAST_CONTACT_ACTION'] == "8") { echo "<BR>Other" ;}

?><BR>
<?php } } ?>




<IMG SRC="https://www.BostonApartments.com/spacer.gif" HEIGHT="1" WIDTH="350" BORDER="0">
</FONT></TD><TD>
&nbsp;
</TD><TD WIDTH="150" VALIGN="TOP">
<FONT SIZE="-1">
<NOBR><B>$<?php echo $rowGetListings[PRICE];?></B>

<?php if ($rowGetListings['NOFEE']=="1" or $rowGetListings['NOFEE']=="3" or $rowGetListings['NOFEE']=="10") { echo "<FONT COLOR=red>NO FEE</FONT>"; } ?>
<?php if ($rowGetListings['NOFEE']=="4") { echo "<FONT COLOR=red>1/4 FEE</FONT>"; } ?>
<?php if ($rowGetListings['NOFEE']=="2") { echo "<FONT COLOR=red>1/2 FEE</FONT>"; } ?>
<?php if ($rowGetListings['NOFEE']=="5") { echo "<FONT COLOR=red>3/4 FEE</FONT>"; } ?>
<?php if ($rowGetListings['NOFEE']=="6") { echo "<FONT COLOR=red>FEE NEG</FONT>"; } ?>
<?php if ($rowGetListings['NOFEE']=="7" or $rowGetListings['NOFEE']=="8" or $rowGetListings['NOFEE']=="9") { echo "FEE"; } ?>

<?php if ($rowGetListings[STATUS_SALE]=="1") {
echo "<FONT SIZE=-1>U/AGREEMENT";
} elseif ($rowGetListings[STATUS_SALE]=="2") {
echo "SOLD";
} elseif ($rowGetListings[STATUS_SALE]=="3") {
echo "OFF MARKET";
} else { echo ""; }

?>
</NOBR>

<BR>
<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD ALIGN=LEFT><FONT SIZE="-1">
Heat: </FONT></TD><TD ALIGN=RIGHT><FONT SIZE="-1"><?php if ($rowGetListings['HEATING_RESP']=="1") { echo "Tenant"; } ?>
<?php if ($rowGetListings['HEATING_RESP']=="2") { echo "Owner"; } ?>
<?php if ($rowGetListings['HEATING_RESP']=="3") { echo "Both"; } ?>
<?php if ($rowGetListings['HEATING_RESP']=="4") { echo "Condo Fee"; } ?>
</TD></TR><TR><TD ALIGN=LEFT><FONT SIZE="-1">

<NOBR>Hot Water:&nbsp;</NOBR></FONT></TD><TD ALIGN=RIGHT><FONT SIZE="-1"><?php if ($rowGetListings['HOT_WATER_RESP']=="1") { echo "Tenant"; } ?>
<?php if ($rowGetListings['HOT_WATER_RESP']=="2") { echo "Owner"; } ?>
<?php if ($rowGetListings['HOT_WATER_RESP']=="3") { echo "Both"; } ?>
<?php if ($rowGetListings['HOT_WATER_RESP']=="4") { echo "Condo Fee"; } ?>



</TD></TR><TR><TD ALIGN=LEFT><FONT SIZE="-1">
Pets:

</FONT></TD><TD ALIGN=RIGHT><FONT SIZE="-1">

<?php
if ($rowGetListings['PETSA']=="") { echo ""; }
elseif ($rowGetListings['PETSA']=="1") { echo "<NOBR><FONT COLOR=red>N0 PETS</FONT></NOBR>"; }
elseif ($rowGetListings['PETSA']=="2") { echo "<NOBR>small pet</NOBR>"; }
elseif ($rowGetListings['PETSA']>="3" AND $rowGetListings['PETSA']<"4") { echo "<NOBR>Cat OK</NOBR>"; }
elseif ($rowGetListings['PETSA']=="4") { echo "<NOBR>Small Dog</NOBR>"; }
elseif ($rowGetListings['PETSA']=="5") { echo "<NOBR>Pets OK</NOBR>"; }
elseif ($rowGetListings['PETSA']=="6") { echo "<NOBR>Pet Friendly</NOBR>"; }
elseif ($rowGetListings['PETSA']=="7") { echo "<NOBR>Negotiable</NOBR>"; }
?>



</FONT>
</TD></TR><TR><TD ALIGN=LEFT><NOBR><FONT SIZE="-1">Avail:&nbsp;</NOBR></FONT></TD><TD ALIGN=RIGHT><FONT SIZE="-1"> <B><?php  echo fuzDate ($rowGetListings['AVAIL']); ?></B></FONT></TD></TR><TR><TD ALIGN=LEFT><FONT SIZE="-1">
<NOBR>Modified:&nbsp;</NOBR></FONT></TD><TD ALIGN=RIGHT><FONT SIZE="-1"> <?php echo $rowGetListings['MOD']; ?> </FONT></TD></TR>


<?php if ($rowGetListings['DATEONMARKET'] != "0000-00-00" AND $rowGetListings['DATEONMARKET'] != "") { ?>

<TR><TD ALIGN=LEFT><FONT SIZE="-1">
<NOBR>Days/Market:&nbsp;</NOBR></FONT></TD><TD ALIGN=RIGHT><FONT SIZE="-1"> <?php

$start_ts = strtotime($rowGetListings['DATEONMARKET']);
$end_ts = strtotime($now);
$diff = $end_ts - $start_ts;
$DOM = round($diff / 86400);
echo $DOM;

?> </FONT></TD></TR>

<?php } ?>


<TR><TD ALIGN=LEFT><FONT SIZE="-1">
<NOBR>Mod by:&nbsp;</NOBR></FONT></TD><TD ALIGN=RIGHT><FONT SIZE="-1"> <?php echo $rowGetListings['MODBY']; ?> </FONT></TD></TR>
<TR><TD ALIGN=LEFT><FONT SIZE="-1">
<NOBR>Created:&nbsp;</NOBR></FONT></TD><TD ALIGN=RIGHT><FONT SIZE="-1"> <?php echo $rowGetListings['HANDLE']; ?> </FONT></TD></TR>
<TR><TD ALIGN=LEFT><FONT SIZE="-1">
ID#: &nbsp;</FONT></TD><TD ALIGN=RIGHT><FONT SIZE="-1"> <a href="/lacms/clients/AgencyArea2.php?op=adlEdit&cid=<?php echo $rowGetListings['CID'];?>&return_page=listings&return_page_div=<?php echo $k;?>" target="_new<?php echo $k;?>"><?php echo $rowGetListings['CID']; ?></A> </FONT></TD></TR>


</TABLE>

</CENTER>

</FONT>
<IMG SRC="https://www.BostonApartments.com/spacer.gif" HEIGHT="1" WIDTH="150" BORDER="0">
</TD><TD>
<FONT SIZE="-3">&nbsp;</FONT>
</TD>

<TD WIDTH="425" VALIGN="TOP"><FONT SIZE="-1">
<div class="descviewad">
<?php

if ($rowGetListings['AD_TITLE']!="" AND $rowGetListings['BODY']!="") {
echo "<I>Alt. Title: &nbsp;</I>".$rowGetListings['AD_TITLE']."<BR><I>Ad Copy: &nbsp;</I>";
} elseif ($rowGetListings['AD_TITLE']!="" AND $rowGetListings['BODY']=="") {
echo "<I>Alt. Title: &nbsp;</I>".$rowGetListings['AD_TITLE'];
} elseif ($rowGetListings['AD_TITLE']=="" AND $rowGetListings['BODY']!="") {
echo "<I>Ad Copy: &nbsp;</I>";
} else { echo ""; }


if ($col[0]=='descriptive') {
 echo $rowGetListings[BODY];
} elseif ($col[0]=='descriptive-agent') {

$cid = $rowGetListings[CID];

	$quStrGetAgentAd = "SELECT * FROM CLASS_AGENTS WHERE CID=$cid AND CLI=$grid AND UID=$uid";
	$quGetAgentAd = mysqli_query($dbh, $quStrGetAgentAd);
	$rowGetAgentAd = mysqli_fetch_object($quGetAgentAd);

echo "$rowGetAgentAd->BODY_AGENT";

}

if (($rowGetListings['SCHOOL_DISTRICT']) OR ($rowGetListings['ELEMENTARY_SCHOOL']) OR ($rowGetListings['MIDDLE_SCHOOL']) OR ($rowGetListings['HIGH_SCHOOL'])) { echo "<BR><B>Schools:</B>";}

if ($rowGetListings['SCHOOL_DISTRICT']) { echo " District: ".$rowGetListings['SCHOOL_DISTRICT'].""; }

if ($rowGetListings['ELEMENTARY_SCHOOL']) { echo " Elem.: ".$rowGetListings['ELEMENTARY_SCHOOL'].""; }

if ($rowGetListings['MIDDLE_SCHOOL']) { echo " Middle: ".$rowGetListings['MIDDLE_SCHOOL'].""; }

if ($rowGetListings['HIGH_SCHOOL']) { echo " High: ".$rowGetListings['HIGH_SCHOOL'].""; }

if (($rowGetListings['SCHOOL_DISTRICT']) OR ($rowGetListings['ELEMENTARY_SCHOOL']) OR ($rowGetListings['MIDDLE_SCHOOL']) OR ($rowGetListings['HIGH_SCHOOL'])) { echo "<BR>";}


if ($rowGetListings['AUTO_WRITE'] !="1") {

if ($rowGetListings['AMENITIES_OWNER_OCCUPIED'] == "1") { echo " | Owner Occupied Property "; }
if ($rowGetListings['AMENITIES_SUPERINTENDANT'] == "1") { echo " | Superintendent "; }
if ($rowGetListings['AMENITIES_ON_SITE_MANAGEMENT'] == "1") { echo " | On Site Management "; }
if ($rowGetListings['AMENITIES_CONCIEARGE'] == "1") { echo " | Concierge "; }
if ($rowGetListings['AMENITIES_SECURITY'] == "1") { echo " | Security "; }
if ($rowGetListings['FEATURES_ALARM'] == "1") { echo " | Alarm "; }
if ($rowGetListings['FEATURES_FURNISHED'] == "1") { echo " | Furnished "; }
if ($rowGetListings['FEATURES_NON_SMOKING'] == "1") { echo " | Non Smoking "; }
if ($rowGetListings['AMENITIES_ELEVATOR'] == "1") { echo " | Elevator "; }
if ($rowGetListings['FEATURES_MODERN_KITCHEN'] == "1") { echo " | Modern Kitchen "; }
if ($rowGetListings['FEATURES_KITCHEN_GALLEY'] == "1") { echo " | Galley Kitchen "; }
if ($rowGetListings['FEATURES_KITCHENETTE'] == "1") { echo " | Kitchenette "; }
if ($rowGetListings['FEATURES_EAT_IN_KITCHEN'] == "1") { echo " | Eat in Kitchen "; }
if ($rowGetListings['FEATURES_GAS_RANGE'] == "1") { echo " | Gas Range "; }
if ($rowGetListings['FEATURES_ELEC_RANGE'] == "1") { echo " | Elec. Range "; }
if ($rowGetListings['FEATURES_DISPOSAL'] == "1") { echo " | Disposal "; }
if ($rowGetListings['FEATURES_DISHWASHER'] == "1") { echo " | Dishwasher "; }
if ($rowGetListings['FEATURES_SKYLIGHT'] == "1") { echo " | Skylight "; }
if ($rowGetListings['FEATURES_CENTRAL_AC'] == "1") { echo " | Central A/C "; }
if ($rowGetListings['FEATURES_AC'] == "1") { echo " | A/C "; }
if ($rowGetListings['FEATURES_MODERN_BATH'] == "1") { echo " | Mod. Bath "; }
if ($rowGetListings['FEATURES_DINNING_ROOM'] == "1") { echo " | Dining Room "; }
if ($rowGetListings['FEATURES_PANTRY'] == "1") { echo " | Pantry "; }
if ($rowGetListings['FEATURES_MICROWAVE'] == "1") { echo " | Microwave "; }
if ($rowGetListings['FEATURES_INTERNET'] == "1") { echo " | High Speed Internet "; }
if ($rowGetListings['FEATURES_DUPLEX'] == "1") { echo " | Duplex "; }
if ($rowGetListings['FEATURES_WHIRLPOOL'] == "1") { echo " | Whirlpool/Spa "; }
if ($rowGetListings['FEATURES_FIREPLACE_WORKING'] == "1") { echo " | Wkng FP "; }
if ($rowGetListings['FEATURES_FIREPLACE_DECOR'] == "1") { echo " | Dec. FP "; }
if ($rowGetListings['FEATURES_CARPET'] == "1") { echo " | W/W Carpet "; }
if ($rowGetListings['FEATURES_HWFI'] == "1") { echo " | Hardwood Floors "; }
if ($rowGetListings['AMENITIES_ATTIC'] == "1") { echo " | Attic "; }
if ($rowGetListings['AMENITIES_BASEMENT'] == "1") { echo " | Basement "; }
if ($rowGetListings['AMENITIES_BIN'] == "1") { echo " | Storage Bin "; }
if ($rowGetListings['AMENITIES_ROOF_DECK'] == "1") { echo " | Roof Deck "; }
if ($rowGetListings['AMENITIES_GARDEN'] == "1") { echo " | Garden "; }
if ($rowGetListings['AMENITIES_YARD'] == "1") { echo " | Yard "; }
if ($rowGetListings['AMENITIES_CLUBHOUSE'] == "1") { echo " | Club House "; }
if ($rowGetListings['AMENITIES_BUSINESSCENTER'] == "1") { echo " | Business Center "; }
if ($rowGetListings['AMENITIES_HEALTH_CLUB'] == "1") { echo " | Health Club "; }
if ($rowGetListings['AMENITIES_POOL'] == "1") { echo " | Pool "; }
if ($rowGetListings['AMENITIES_TENNIS'] == "1") { echo " | Tennis "; }
if ($rowGetListings['AMENITIES_LOUNGE'] == "1") { echo " | Lounge "; }
if ($rowGetListings['AMENITIES_SAUNA'] == "1") { echo " | Sauna "; }
if ($rowGetListings['AMENITIES_HIGH_CEILINGS'] == "1") { echo " | High Ceilings "; }
if ($rowGetListings['FEATURES_PORCH'] == "1") { echo " | Porch "; }
if ($rowGetListings['FEATURES_ENCLOSED_PORCH'] == "1") { echo " | Enclosed Porch "; }
if ($rowGetListings['FEATURES_BALCONY'] == "1") { echo " | Balcony "; }
if ($rowGetListings['FEATURES_DECK'] == "1") { echo " | Deck "; }
if ($rowGetListings['AMENITIES_DECK'] == "1") { echo " | Deck "; }
if ($rowGetListings['FEATURES_PATIO'] == "1") { echo " | Patio "; }
if ($rowGetListings['FEATURES_WALK_IN_CLOSET'] == "1") { echo " | Walk-in Closet "; }
if ($rowGetListings['AMENITIES_WHEELCHAIR'] == "1") { echo " | Wheelchair Access "; }
if ($rowGetListings['AMENITIES_SUBWAY'] == "1") { echo " | Subway "; }
if ($rowGetListings['AMENITIES_CRAIL'] == "1") { echo " | CRail "; }
if ($rowGetListings['AMENITIES_BUS'] == "1") { echo " | Bus "; }
if ($rowGetListings['AMENITIES_SHUTTLE'] == "1") { echo " | Shuttle Bus "; }

}




?>
</FONT>
<IMG SRC="https://www.BostonApartments.com/spacer.gif" HEIGHT="1" WIDTH="425" BORDER="0">
</DIV>
</TD><TD VALIGN="TOP">

<CENTER><a href="<?php echo "https://www.BostonApartments.com/clpost.php?ad=".$rowGetListings['CID']."&cli=".$rowGetListings['CLI']."&uid=$uid"."\" target=\"_CL".$rowGetListings['CID']."\"";?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/cl.gif" alt="Post to Craigslist" title="Post to Craigslist"></A><BR>
<FONT SIZE="-3">&nbsp;<BR></FONT>
<a href="<?php echo "https://www.BostonApartments.com/kijijipost.php?ad=".$rowGetListings['CID']."&cli=".$rowGetListings['CLI']."&uid=$uid"."\" target=\"_KIJ".$rowGetListings['CID']."\"";?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/kijiji.gif" alt="Post to Kijiji" title="Post to Kijiji"></A><BR>
<FONT SIZE="-3">&nbsp;<BR></FONT>
<a href="<?php echo "http://www.facebook.com/sharer.php?u=http%3A%2F%2Fbostonapartments.com%2Fhomepage.php%3Fcli%3D".$rowGetListings['CLI']."%26ad%3D".$rowGetListings['CID'];?>" target="_FB<?php echo $rowGetListings['CID'];?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/facebook.gif" alt="Post to Facebook" title="Post to Facebook"></A><BR>
<FONT SIZE="-3">&nbsp;<BR></FONT>
<a href="<?php echo "http://twitter.com/home?status=http%3A%2F%2Fbostonapartments.com%2Fhomepage.php%3Fcli%3D".$rowGetListings['CLI']."%26ad%3D".$rowGetListings['CID']."%20title%3DListing%23".$rowGetListings['CID']."%20%24".$rowGetListings['PRICE']."%20".$rowGetListings['LOCNAME']."%20".$rowGetListings['ROOMS']."%20Bed";?>" target="_tweet<?php echo $rowGetListings['CID'];?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../assets/images/twitter.jpeg" alt="Post to Twitter" title="Post to Twitter"></a><BR>

<FONT SIZE="-3">&nbsp;<BR></FONT>

<script type="text/javascript">
function GetThis(T, C, U, L)
{
   var targetUrl = 'http://www.myspace.com/index.cfm?fuseaction=postto&' + 't=' + encodeURIComponent(T)
   + '&c=' + encodeURIComponent(C) + '&u=' + encodeURIComponent(U) + '&l=' + L;
   window.open(targetUrl);
}
</script>
<a href="javascript:GetThis('<?php
if ($rowGetListings['AD_TITLE'] !="") {
echo $rowGetListings['AD_TITLE'];
} else {
echo $rowGetListings['LOCNAME']." - ".$rowGetListings['PRICE']." - ".$rowGetListings['ROOMS']."%20Bed";
} ;?>','<?php echo htmlspecialchars($rowGetListings['BODY']); ?>','<?php echo "http%3A%2F%2Fbostonapartments.com%2Fhomepage.php%3Fcli%3D".$rowGetListings['CLI']."%26ad%3D".$rowGetListings['CID'];?>','1')"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/myspace.gif" alt="Post to MySpace" title="Post to MySpace"></a>

</CENTER>

</TD>
<TD VALIGN="TOP">
<CENTER>
<a href="/lacms/clients/AgencyArea2.php?op=adlEdit&cid=<?php echo $rowGetListings['CID'];?>&return_page=listings&return_page_div=<?php echo $k;?>" target="_new<?php echo $k;?>" TITLE="Edit"><img border=0 src="../images/icons/edit.gif" alt="Edit" title="Edit"></a><BR>
<FONT SIZE="-3">&nbsp;<BR></FONT>


<a href="/lacms/clients/AgencyArea2.php?op=delete&cid=<?php echo $rowGetListings['CID'];?>&return_page=listings&return_page_div=<?php echo $k;?>" TITLE="Delete"><img border=0 src="../images/icons/delete.gif" alt="Delete" title="Delete"></a><BR>
<FONT SIZE="-3">&nbsp;<BR></FONT>
<a href="<?php echo "$PHP_SELF?op=hot_list_add&item_type=1&item_id=$rowGetListings[CID]&return_page=listings&return_page_rid=$rowGetListings[CID]&return_page_div=$k";?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../assets/images/hot.gif" alt="Add to Hot List" title="Add to Hot List"></a>


<FONT SIZE="-3"><BR><BR></FONT>
<a href="<?php echo "$PHP_SELF?op=mark_status_updated&cid=$rowGetListings[CID]&return_page=listings&return_page_rid=$rowGetListings[CID]&return_page_div=$k";?>"><img border="0" vspace="0" hspace="0" src="https://www.BostonApartments.com/images/newIcon.gif" alt="Mark As Updated" title="Mark As Updated"></a>
<FONT SIZE="-3">&nbsp;<BR></FONT>



<A HREF="<?php echo "$PHP_SELF?op=openhouse-add&CID=$rowGetListings[CID]&return_page=listings";?>"><IMG SRC="../assets/images/openhouse.jpg" height="16" WIDTH="16" BORDER="0"></A>

<FONT SIZE="-3">&nbsp;<BR></FONT>

<?php } ?>

<?php if($rowGetListings['STATUS_VACANT']=="1")
			   { ?>
<?php if ($user_level>0) {?>
                              <a href="<?php echo "$PHP_SELF?op=mark_status_vacant&cid=".$rowGetListings['CID'] . "&turn=occupied&return_page=listings&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/vacant.jpg" border=0 height=16 width=16 alt="Vacant Unit" title="Vacant Unit">
<?php if ($user_level>0) {?>
</a>
<?php }?>
			    <?php  } else { ?>
<?php if ($user_level>0) {?>
			      <a href="<?php echo "$PHP_SELF?op=mark_status_vacant&cid=".$rowGetListings['CID'] . "&turn=vacant&return_page=listings&return_page_div=" . $k;?>">
<?php } ?>
<img src="../assets/images/icons/occupied.jpg" border=0 height=16 width=16 alt="Occupied Unit" title="Occupied Unit
<?php
if ($rowGetListings['TENANT_NAME'] ) { echo " - ".$rowGetListings['TENANT_NAME']." "; }
if ($rowGetListings['TENANT_PHONE'] ) { echo $rowGetListings['TENANT_PHONE']." " ; }
if ($rowGetListings['SHOW_INSTRUCT'] ) { echo $rowGetListings['SHOW_INSTRUCT']." " ; }
?>

">
<?php if ($user_level>0) {?>
</a>
<?php } ?>
			<?php } ?>


<BR>

</CENTER>
</TD>
<TD VALIGN="TOP">
<CENTER>
<a href="/lacms/clients/AgencyArea2.php?op=mail_listing&cid=<?php echo $rowGetListings['CID'];?>&return_page=listings&return_page_div=<?php echo $k;?>" target="_email<?php echo $rowGetListings['CID'];?>"><img border=0 src="../images/icons/email.gif" alt="Email Listing" title="Email Listing"></a><BR>
<FONT SIZE="-4">&nbsp;<BR></FONT>



<a href="javascript:popUpPrintOut('./printout_agent.php?cid=<?php echo $rowGetListings['CID'];?>');"><img src="../assets/images/agent-ss.gif" vspace="0" hspace="0" border="0" height="18" width="18" alt="Agent Show Sheet" title="Agent Show Sheet  <?php if ($rowGetListings['SHOW_INSTRUCT']) { echo  " - ".$rowGetListings['SHOW_INSTRUCT']; }?><?php if ($rowGetListings['LISTING_NOTES']) { echo  " - ".$rowGetListings['LISTING_NOTES']; }?>"></a><BR>
<FONT SIZE="-3">&nbsp;<BR></FONT>

<?php if ($rowGetListings[PIC]>0) { ?>
<a href="javascript:popUpPrintOut('./printout_agent_pic.php?cid=<?php echo $rowGetListings[CID];?>');"><img src="../assets/images/agent-ss-pic.gif" vspace="0" hspace="0" border="0" height="18" width="18" alt="Agent Show Sheet With Pictures" title="Agent Show Sheet With Pictures <?php if ($rowGetListings['SHOW_INSTRUCT']) { echo  " - ".$rowGetListings['SHOW_INSTRUCT']; }?><?php if ($rowGetListings['LISTING_NOTES']) { echo  " - ".$rowGetListings['LISTING_NOTES']; }?>"></a><BR>
<?php  } else {
echo "&nbsp;";
} ?>

<FONT SIZE="-3">&nbsp;<BR></FONT>

<a href="javascript:popUpPrintOut('./printout_client.php?cid=<?php echo $rowGetListings[CID];?>');"><img src="../assets/images/doc.gif" vspace="0" hspace="0" border="0" height="18" width="18" alt="Client Printout" title="Client Printout"></a><BR>
<FONT SIZE="-3">&nbsp;<BR></FONT>

<?php if ($rowGetListings[PIC]>0) { ?>
<a href="javascript:popUpPrintOut('./printout_client_pic.php?cid=<?php echo $rowGetListings[CID];?>');"><img src="../assets/images/doc-pic.gif" vspace="0" hspace="0" border="0" height="18" width="18" alt="Client Printout with Pictures" title="Client Printout with Pictures"></a><BR>
<?php  } else {
echo "&nbsp;";
}  ?>

</CENTER>
</TD></TR></TABLE>



                        <?php }elseif ($col[0]=='new') { ?>
<a href="<?php echo "$PHP_SELF?op=mark_status_updated&cid=$rowGetListings[CID]&return_page=listings&return_page_rid=$rowGetListings[CID]&return_page_div=$k";?>"><img border="0" vspace="0" hspace="0" src="https://www.BostonApartments.com/images/newIcon.gif" alt="Mark as Updated" title="Mark as Updated"></a>





                        <?php }elseif ($col[0]=='pets') {

if ($rowGetListings['PETSA']=="") { echo ""; }
elseif ($rowGetListings['PETSA']=="1") { echo "<FONT COLOR=red>N0 PETS</FONT>"; }
elseif ($rowGetListings['PETSA']=="2") { echo "small pet"; }
elseif ($rowGetListings['PETSA']>="3" AND $rowGetListings['PETSA']<"4") { echo "Cat OK"; }
elseif ($rowGetListings['PETSA']=="4") { echo "Small Dog"; }
elseif ($rowGetListings['PETSA']=="5") { echo "Pets OK"; }
elseif ($rowGetListings['PETSA']=="6") { echo "Pet Friendly"; }
elseif ($rowGetListings['PETSA']=="7") { echo "Negotiable"; }
?>

                        <?php }elseif ($col[0]=='hot') { ?>

<CENTER><a href="<?php echo "$PHP_SELF?op=hot_list_add&item_type=1&item_id=$rowGetListings[CID]&return_page=listings&return_page_rid=$rowGetListings[CID]&return_page_div=$k";?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../assets/images/hot.gif" alt="Add to Hot List" title="Add to Hot List"></a></CENTER>


                        <?php }elseif ($col[0]=='cl') { ?>

<CENTER><a href="<?php echo "https://www.BostonApartments.com/clpost.php?ad=".$rowGetListings['CID']."&cli=".$rowGetListings['CLI']."&uid=$uid"."\" target=\"_CL".$rowGetListings['CID']."\"";?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/cl.gif" alt="Post to Craigslist" title="Post to Craigslist"></A></CENTER>


                        <?php }elseif ($col[0]=='kijiji') { ?>
<CENTER><a href="<?php echo "https://www.BostonApartments.com/kijijipost.php?ad=".$rowGetListings['CID']."&cli=".$rowGetListings['CLI']."&uid=$uid"."\" target=\"_KIJ".$rowGetListings['CID']."\"";?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/kijiji.gif" alt="Post to Kijiji" title="Post to Kijiji"></A></CENTER>

                        <?php } elseif ($col[0]=='weblist') {

if ($rowGetListings['OFF_WEBLISTINGS']!="") {
echo "<A HREF=".$rowGetListings['OFF_WEBLISTINGS']." target=\"_WL".$rowGetListings['CID']."\"><NOBR>Web List</A></NOBR><BR>";
}

if ($rowGetListings['OFF_WEBSITE']!="") {
echo "<A HREF=".$rowGetListings['OFF_WEBSITE']." target=_\"WS".$rowGetListings['CID']."\">Website</A>";
}
?>



                        <?php }elseif ($col[0]=='dig') { ?>

<CENTER><a href="<?php echo "https://www.BostonApartments.com/digpost.php?ad=".$rowGetListings['CID']."&cli=".$rowGetListings['CLI']."&uid=$uid"."\" target=\"_DIG".$rowGetListings['CID']."\"";?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/dig.gif" alt="Post to The Dig" title="Post to The Dig"></A></CENTER>

                        <?php }elseif ($col[0]=='facebook') { ?>

<a href="<?php echo "http://www.facebook.com/sharer.php?u=http%3A%2F%2Fbostonapartments.com%2Fhomepage.php%3Fcli%3D".$rowGetListings['CLI']."%26ad%3D".$rowGetListings['CID'];?>" target="_face<?php echo $rowGetListings['CID'];?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/facebook.gif" alt="Post to Facebook" title="Post to Facebook"></A><BR>

                        <?php }elseif ($col[0]=='twitter') { ?>

<a href="<?php echo "http://twitter.com/home?status=http%3A%2F%2Fbostonapartments.com%2Fhomepage.php%3Fcli%3D".$rowGetListings['CLI']."%26ad%3D".$rowGetListings['CID']."%20title%3DListing%23".$rowGetListings['CID']."%20%24".$rowGetListings['PRICE']."%20".$rowGetListings['LOCNAME']."%20".$rowGetListings['ROOMS']."%20Bed";?>" target="_tweet<?php echo $rowGetListings['CID'];?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../assets/images/twitter.jpeg" alt="Post to Twitter" title="Post to Twitter"></a>


                        <?php }elseif ($col[0]=='ckbox') { ?>

<CENTER><input id="<?php echo $rowGetListings['CID'];?>" type="checkbox" name="sel_ids[]" value="<?php echo $rowGetListings['CID'];?>"></CENTER>


                        <?php }elseif ($col[0]=='beds') {
if ($rowGetListings['ROOMS'] == '0.25') {
echo "LOFT";
}
if ($rowGetListings['ROOMS'] == '0.50') {
echo "STUDIO";
}
if ($rowGetListings['ROOMS'] == '0.75') {
echo "STU/ALC";
}
if ($rowGetListings['ROOMS'] == '0.76') {
echo "STU/2RM";
}
if ($rowGetListings['ROOMS'] == '0.79') {
echo "STU/LFTBD";
}
if ($rowGetListings['ROOMS'] == '1.00') {
echo "<NOBR>1 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '1.50') {
echo "<NOBR>1 BD SPLT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '1.75') {
echo "<NOBR>1 BD PLUS</NOBR>";
}
if ($rowGetListings['ROOMS'] == '1.78') {
echo "<NOBR>1 BD LOFT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '2.00') {
echo "<NOBR>2 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '2.50') {
echo "<NOBR>2 BD SPLT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '2.75') {
echo "<NOBR>2 BD PLUS</NOBR>";
}
if ($rowGetListings['ROOMS'] == '2.78') {
echo "<NOBR>2 BD LOFT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '3.00') {
echo "<NOBR>3 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '3.50') {
echo "<NOBR>3 BD SPLT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '3.75') {
echo "<NOBR>3 BD PLUS</NOBR>";
}
if ($rowGetListings['ROOMS'] == '3.78') {
echo "<NOBR>3 BD LOFT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '4.00') {
echo "<NOBR>4 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '4.50') {
echo "<NOBR>4 BD SPLT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '4.75') {
echo "<NOBR>4 BD PLUS</NOBR>";
}
if ($rowGetListings['ROOMS'] == '4.78') {
echo "<NOBR>4 BD LOFT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '5.00') {
echo "<NOBR>5 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '5.50') {
echo "<NOBR>5 BD SPLT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '5.75') {
echo "<NOBR>5 BD PLUS</NOBR>";
}
if ($rowGetListings['ROOMS'] == '5.78') {
echo "<NOBR>5 BD LOFT</NOBR>";
}
if ($rowGetListings['ROOMS'] == '6.00') {
echo "<NOBR>6 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '7.00') {
echo "<NOBR>7 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '8.00') {
echo "<NOBR>8 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '9.00') {
echo "<NOBR>9 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '10.00') {
echo "<NOBR>10 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '11.00') {
echo "<NOBR>11 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '12.00') {
echo "<NOBR>12 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '13.00') {
echo "<NOBR>13 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '14.00') {
echo "<NOBR>14 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '15.00') {
echo "<NOBR>15 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '16.00') {
echo "<NOBR>16 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '17.00') {
echo "<NOBR>17 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '18.00') {
echo "<NOBR>18 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '19.00') {
echo "<NOBR>19 BED</NOBR>";
}
if ($rowGetListings['ROOMS'] == '20.00') {
echo "<NOBR>20 BED</NOBR>";
}

 ?>


                        <?php }elseif ($col[0]=='change') { ?>

<TABLE CELLPADDING=0 CELLSPACING=0 BORDER=0 style="font-size:10px;"><TR><TD>
<form id="changeprice" name="changeprice" action="<?php echo "$PHP_SELF?op=changepricedateDo";?>" method="POST">
<input type="hidden" name="cid" value="<?php echo $rowGetListings['CID'];?>">
<input id="adlEditFormNav" type="hidden" name="adlEditNav" value="listings">
<NOBR>$<input type="text" id="PRICE" name="price" size="6" value="<?php echo $rowGetListings['PRICE'];?>">


<?php
$getMon = subStr ($rowGetListings['AVAIL'], 5, 2);
$getDay = subStr ($rowGetListings['AVAIL'], 8, 2);
$getYear = subStr ($rowGetListings['AVAIL'], 0, 4);
	$getLEMon = subStr ($rowGetListings['LEASE_EXPIRE'], 5, 2);
	$getLEDay = subStr ($rowGetListings['LEASE_EXPIRE'], 8, 2);
	$getLEYear = subStr ($rowGetListings['LEASE_EXPIRE'], 0, 4);
?>
Avl:<select name="bbbMonth" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<option value="01" <?php if ($getMon == "01") { echo " selected "; } ?>>Jan</option>
	<option value="02" <?php if ($getMon == "02") { echo " selected "; } ?>>Feb</option>
	<option value="03" <?php if ($getMon == "03") { echo " selected "; } ?>>Mar</option>
	<option value="04" <?php if ($getMon == "04") { echo " selected "; } ?>>Apr</option>
	<option value="05" <?php if ($getMon == "05") { echo " selected "; } ?>>May</option>
	<option value="06" <?php if ($getMon == "06") { echo " selected "; } ?>>Jun</option>
	<option value="07" <?php if ($getMon == "07") { echo " selected "; } ?>>Jul</option>
	<option value="08" <?php if ($getMon == "08") { echo " selected "; } ?>>Aug</option>
	<option value="09" <?php if ($getMon == "09") { echo " selected "; } ?>>Sep</option>
	<option value="10" <?php if ($getMon == "10") { echo " selected "; } ?>>Oct</option>
	<option value="11" <?php if ($getMon == "11") { echo " selected "; } ?>>Nov</option>
	<option value="12" <?php if ($getMon == "12") { echo " selected "; } ?>>Dec</option>
</select>
 <select name="bbbDay" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php for ($i=1;$i<=31;$i++) {
		if ($i<=9) {
			$j = "0".$i;
		} else {
			$j = $i;
		}
	?>
	<option value="<?php echo $j;?>" <?php if ($getDay == $j) { echo " selected "; } ?>><?php echo $j;?></option>
	<?php } ?>
</select>
 <select name="bbbYear" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php
	$thisYear = date ("Y") - 1;
	for ($i=0;$i<=4;$i++) {?>
	<option value="<?php echo ($thisYear + $i);?>" <?php if ($getYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
	<?php }?>
</select>

Exp:<select name="bbbLEMonth" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<option value="01" <?php if ($getLEMon == "01") { echo " selected "; } ?>>Jan</option>
				<option value="02" <?php if ($getLEMon == "02") { echo " selected "; } ?>>Feb</option>
				<option value="03" <?php if ($getLEMon == "03") { echo " selected "; } ?>>Mar</option>
				<option value="04" <?php if ($getLEMon == "04") { echo " selected "; } ?>>Apr</option>
				<option value="05" <?php if ($getLEMon == "05") { echo " selected "; } ?>>May</option>
				<option value="06" <?php if ($getLEMon == "06") { echo " selected "; } ?>>Jun</option>
				<option value="07" <?php if ($getLEMon == "07") { echo " selected "; } ?>>Jul</option>
				<option value="08" <?php if ($getLEMon == "08") { echo " selected "; } ?>>Aug</option>
				<option value="09" <?php if ($getLEMon == "09") { echo " selected "; } ?>>Sep</option>
				<option value="10" <?php if ($getLEMon == "10") { echo " selected "; } ?>>Oct</option>
				<option value="11" <?php if ($getLEMon == "11") { echo " selected "; } ?>>Nov</option>
				<option value="12" <?php if ($getLEMon == "12") { echo " selected "; } ?>>Dec</option>
			</select>
				<select name="bbbLEDay" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php for ($i=1;$i<=31;$i++) {
					if ($i<=9) {
						$j = "0".$i;
					} else {
						$j = $i;
					}
				?>
				<option value="<?php echo $j;?>" <?php if ($getLEDay == $j) { echo " selected "; } ?>><?php echo $j;?></option>
				<?php } ?>
			</select>
				<select name="bbbLEYear" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php
				$thisYear = date ("Y");
				for ($i=0;$i<=4;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($getLEYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
				<?php }?>
			</select>

</TD><TD VALIGN=top><input type="IMAGE" src="../assets/images/update.jpg" NAME="UPDATE" TITLE="Click to Update Changes to <?php echo $rowGetListings['STREET_NUM']." ".$rowGetListings['STREET']." ".$rowGetListings['APT'];?>">
</TD></TR></TABLE>
</FORM>
</NOBR>


                        <?php }elseif ($col[0]=='fee') { ?>

<TABLE CELLPADDING=0 CELLSPACING=0 BORDER=0 style="font-size:8px;"><TR><TD WIDTH=30 VALIGN=MIDDLE ALIGN=CENTER>
<?php if ($rowGetListings['NOFEE']=="1" or $rowGetListings['NOFEE']=="3" or $rowGetListings['NOFEE']=="10") { echo "<CENTER><FONT COLOR=red>NO FEE</FONT></CENTER>"; } ?>
<?php if ($rowGetListings['NOFEE']=="4") { echo "<CENTER><FONT COLOR=red>1/4 FEE</FONT></CENTER>"; } ?>
<?php if ($rowGetListings['NOFEE']=="2") { echo "<CENTER><FONT COLOR=red>1/2 FEE</FONT></CENTER>"; } ?>
<?php if ($rowGetListings['NOFEE']=="5") { echo "<CENTER><FONT COLOR=red>3/4 FEE</FONT></CENTER>"; } ?>
<?php if ($rowGetListings['NOFEE']=="6") { echo "<CENTER><FONT COLOR=red>FEE NEG</FONT></CENTER>"; } ?>
<?php if ($rowGetListings['NOFEE']=="7" or $rowGetListings['NOFEE']=="8" or $rowGetListings['NOFEE']=="9") { echo "<CENTER>FEE</CENTER>"; } ?>
</TD></TR></TABLE>




                        <?php }elseif ($col[0]=='vacant') {
			   if($rowGetListings['STATUS_VACANT']=="1")
			   { ?>
<?php if ($user_level>0) {?>
                              <a href="<?php echo "$PHP_SELF?op=mark_status_vacant&cid=".$rowGetListings['CID'] . "&turn=occupied&return_page=listings&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/vacant.jpg" border=0 height=15 width=15 alt="Vacant Unit" title="Vacant Unit">
<?php if ($user_level>0) {?>
</a>
<?php }?>
			    <?php  } else { ?>
<?php if ($user_level>0) {?>
			      <a href="<?php echo "$PHP_SELF?op=mark_status_vacant&cid=".$rowGetListings['CID'] . "&turn=vacant&return_page=listings&return_page_div=" . $k;?>">
<?php } ?>
<img src="../assets/images/icons/occupied.jpg" border=0 height=15 width=15 alt="Occupied Unit" title="Occupied Unit
<?php
if ($rowGetListings['TENANT_NAME'] ) { echo " - ".$rowGetListings['TENANT_NAME']." "; }
if ($rowGetListings['TENANT_PHONE'] ) { echo $rowGetListings['TENANT_PHONE']." " ; }
if ($rowGetListings['SHOW_INSTRUCT'] ) { echo $rowGetListings['SHOW_INSTRUCT']." " ; }
?>">
<?php if ($user_level>0) {?>
</a>
<?php } ?>
			<?php } ?>





                        <?php }elseif ($col[0]=='thumb') {

	if ($rowGetListings['PIC']!=0)

	{

      $quStrGetPics = "SELECT * FROM PICTURE WHERE CID=".$rowGetListings['CID']." ORDER BY PID LIMIT 1";
      $quGetPics = mysqli_query($dbh, $quStrGetPics);
      $rowGetPics = mysqli_fetch_object($quGetPics);
         $thumb="<IMG SRC=https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT HEIGHT=70 WIDTH=70 BORDER=0>";
 	}
		 else { $thumb="<CENTER><FONT SIZE=-2 color=#BDBDBD>No Photo</FONT></CENTER>";	}

if ($rowGetListings['EXTERNALPIC']) {
$thumb="<IMG SRC=".$rowGetListings['EXTERNALPIC']." border=0 HEIGHT=60 width=60 ALIGN=RIGHT VALIGN=TOP>";
}

echo "<CENTER><a href=https://www.BostonApartments.com/homepage.php?cli=".$rowGetListings['CLI']."&ad=".$rowGetListings['CID']." target=_NEW ALT=\"Click for Display Ad\" TITLE=\"Click for Display Ad\">$thumb</A>";


	   if ($rowGetListings['PIC']>0) { echo "<FONT SIZE=-1>x " .$rowGetListings['PIC']."</FONT></CENTER>"; }


	;?>



                        <?php }elseif ($col[0]=='status') { ?>




<CENTER>



<?php

if ($rowGetListings['CLI']=="1075") { echo "<FONT COLOR=BLUE><B>MLS</B></FONT>"; } else {


if ($rowGetListings['STATUS']=="STO") { ?>


<?php if ($user_level>0) {?>
		<a href="<?php echo "$PHP_SELF?op=activate_a&cid=". $rowGetListings['CID'] . "&return_page=listings&return_page_div=" . $k; ?>">
<?php } ?>

<img src="../assets/images/inact.jpg" border=0 alt="Deactivated Ad" title="Deactivated Ad">
<?php if ($user_level>0) {?>
</a>
<?php } ?></CENTER>
				<?php } elseif ($rowGetListings['STATUS']=="ACT") { ?>
<CENTER>
<?php if ($user_level>0) {?>
				<a href="<?php echo "$PHP_SELF?op=deactivate_a&cid=" . $rowGetListings['CID'] . "&return_page=listings&return_page_div=" . $k; ?>">
<?php } ?>
<img src="../assets/images/act.gif" border=0 alt="Activated Ad" title="Activated Ad">
<?php if ($user_level>0) {?>
</a>
<?php } ?>
			<?php	}else{ echo "ERROR"; } }?>
                        <?php }elseif ($col[0]=='ad') {
			   if($rowGetListings['STATUS_ACTIVE']=="1")
			   { ?>

<?php if ($user_level>0) {?>

                              <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetListings['CID'] . "&turn=unavailable&return_page=listings&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/a.jpg" border=0 alt="Available" title="Available">
<?php if ($user_level>0) {?>
</a>
<?php }?>
</CENTER>
			    <?php  } else { ?>
<CENTER>
<?php if ($user_level>0) {?>
			      <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetListings['CID'] . "&turn=available&return_page=listings&return_page_div=" . $k;?>">
<?php } ?>
<img src="../assets/images/icons/u.jpg" border=0 alt="unavailable" title="unavailable">
<?php if ($user_level>0) {?>
</a>
<?php } ?>
</CENTER>


			<?php } ?>
			<?php
			}elseif ($col[0]=='ud') {
				//
			}elseif ($col[0]=='uc') {
				//
			}?>
			</td>

		<?php } ?>
		</tr>

	<?php } ?>
	<!--END RECORDS-->

	</table>

	<FONT SIZE="-3"><br></FONT>

	<table border="0" cellspacing="0" cellpadding="0" height="10" BGCOLOR="lightgrey">
		<tr><FORM></FORM>
		<td width="230" align="center" VALIGN="TOP">
		<form action="<?php echo "$PHP_SELF";?>" method="GET" name="listings_view_form2"><input type="hidden" name="op" value="listings">
			<div class="controltext"><NOBR>View:<select name="vid" style="background-color:white" onchange="JavaScript:document.listings_view_form2.submit();">
			<?php
			mysqli_data_seek ($quGetViews, 0);
			while ($rowGetViews = mysqli_fetch_object($quGetViews)) {?>
				<option value="<?php echo $rowGetViews->ID;?>" <?php if ($vid==$rowGetViews->ID) { echo " selected "; }?>><?php echo $rowGetViews->NAME;?></option>
			<?php } ?>
			</select></NOBR></div>
			</form>
		</td>
		<td width="1">&nbsp;</td>
		<td align="center"><form action="<?php echo "$PHP_SELF";?>" method="GET" name="limitNForm"><input type="hidden" name="op" value="listings"><div class="controltext">Show<input type="text" size="2" name="limitN" value="<?php echo $limitN;?>" onchange="JavaScript:document.limitNForm.submit();">listings per page.</div></form></td>
		<td width="1">&nbsp;</td>
		<td align="center">
		<form action="<?php echo $PHP_SELF;?>" method="GET" name="pageFlipForm2">
		<input type="hidden" name="op" value="listings">
		<div class="controltext">View page:<select name="start"  style="background-color:white" onchange="JavaScript:document.pageFlipForm2.submit();" >
		<?php for ($i=1;$i<=$numPages;$i++) {
		    	$thisCalc = $limitN * ($i-1);
		    	if (!$thisCalc) {
		    		$thisCalc = "z";
		    	}?>		    	?>
		    	<option value="<?php echo $thisCalc;?>" <?php if ($thisCalc==$start) {echo " selected ";}?>><?php echo $i;?></option>
		<?php }?>
		</select></div>
		</form>
		</td>
		</tr>
		<tr>
		<td colspan="5" bgcolor="#FFFFFF" align="center">
		<div class="controltext">
		 <a href="<?php echo "$PHP_SELF?op=listings&start=z&limitN=$num_rows&filterChange=1";?>">Show all listings</a> -
		    <?php
		    if ($userFilter) { ?>
		    	<a href="<?php echo "$PHP_SELF?op=listings&start=z&userFilter=n";?>">Show all listings for <?php echo $group;?></a>
		    <?php } else { ?>
		    	<a href="<?php echo "$PHP_SELF?op=listings&start=z&userFilter=1";?>">Show only <?php echo $handle;?>'s listings</a>
		    <?php } ?>
		   -
		    <?php
		    if ($activeFilter) { ?>
		    	<a href="<?php echo "$PHP_SELF?op=listings&start=z&activeFilter=n";?>">Show all active and inactive listings</a>
		    <?php } else { ?>
		    	<a href="<?php echo "$PHP_SELF?op=listings&start=z&activeFilter=1";?>">Show only active listings</a>
		    <?php } ?>

		    </div>
		</td>
		</tr>

	</table>


<FONT SIZE="-3">&nbsp;<br></FONT>
	</center>
	<?php if ($return_page_div) {?>
	<SCRIPT FOR=window EVENT=onload LANGUAGE="JScript">
		return_scroll(<?php echo $return_page_div;?>);
	</script>
	<?php }?>

<!--END listings -->
