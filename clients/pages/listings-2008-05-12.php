<!--BEGIN listings -->
<?php 
$quStrGetViews = "SELECT * FROM VIEWS WHERE GRID=$grid OR PUBLIC=1 ORDER BY NAME";
$quGetViews = mysqli_query($dbh, $quStrGetViews) or die ($quStrGetViews);
$quStrGetView = "SELECT * FROM VIEWS WHERE ID=$vid AND (GRID='$grid' OR PUBLIC=1)";
$quGetView = mysqli_query($dbh, $quStrGetView);
$rowGetView = mysqli_fetch_array($quGetView);

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


$cols = split (",", $rowGetView['COLUMNS']);

$numCols = count ($cols);


for ($i=0;$i<$numCols;$i++) {
	$cols[$i] = split ("~", $cols[$i]);        
}




$quStrLimitCount = "SELECT COUNT(CID) as count FROM ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID $WHERE ";
$quLimitCount = mysqli_query($dbh, $quStrLimitCount) or die (dieNice("Sorry,  could not pagenate your listings", "E-200"));
//$num_rows = mysqli_num_rows($quLimitCount);
$nRowsQ = mysqli_fetch_object($quLimitCount);
$num_rows=$nRowsQ->count;

$numPages = ceil($num_rows / $limitN);


//Filter Display String //
session_register ("switch_remember");
session_register ("filter_string_display");



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
	$preFilters_str[11] = ($begin_date) ? array($begin_date, "CLASS.AVAIL", ">", "Available begin date") : "";
	$switch_remember['bbbmonth'] = $_POST['bbbmonth'];
	$switch_remember['bbbday'] = $_POST['bbbday'];
	$switch_remember['bbbyear'] = $_POST['bbbyear'];
	$preFilters_str[12] = ($end_date) ? array($end_date, "CLASS.AVAIL", "<", "Available end date") : "";
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
	$preFilters_str[87] =  array($_POST['rented_by'], "CLASS.RENTED_BY","=", "Rented By");
	$switch_remember['rented_by'] = $_POST['rented_by'];
	$preFilters_str[88] = array($_POST['nofee'], "CLASS.NOFEE", "=", "Fee");
	$switch_remember['nofee'] = $_POST['nofee'];
	$preFilters_str[89] = array($_POST['school'], "CLASS.SCHOOL", "=", "Colleges");
	$switch_remember['school'] = $_POST['school'];
	$preFilters_str[90] = array($_POST['status_not_active'], "STATUS_ACTIVE", "!=", "Available");
	$switch_remember['status_not_active'] = $_POST['status_not_active'][0];
	$preFilters_str[91] =  ($_POST['street_num'][0]) ? array($_POST['street_num'], "CLASS.STREET_NUM", "=", "Street Number") : "";
	$switch_remember['street_num'] = $_POST['street_num'];
	$preFilters_str[92] =  array($_POST['street'], "CLASS.STREET", "=", "Street Name");
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
	$preFilters_str[102] =  array($_POST['uid'], "CLASS.UID", "=", "uid");
	$preFilters_str[103] =  array($_POST['features_not_furnished'], "CLASS.FEATURES_FURNISHED", "!=", "Not Furnished");
	$switch_remember['features_not_furnished'] = $_POST['features_not_furnished'][0];

	$switch_remember['uid'] = $_POST['uid'];





	
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
					}elseif ($preFilter_str[1] == "PRICE" || $preFilter_str[1] == "CLASS.TENANT_FEE" || $preFilter_str[1] == "CLASS.LANDLORD_FEE" || $preFilter_str[1] == "CLASS.PAYMENT_FIRST" || $preFilter_str[1] == "CLASS.PAYMENT_LAST" || $preFilter_str[1] == "CLASS.PAYMENT_SEC" || $preFilter_str[1] == "CLASS.KEY_DEPOSIT" || $preFilter_str[1] == "CLASS.CLEAN_DEPOSIT" || $preFilter_str[1] == "CLASS.FEE_COMMENTS" || $preFilter_str[1] == "CLASS.PARKING_NUM" || $preFilter_str[1] == "CLASS.PARKING_COST" || $preFilter_str[1] == "CLASS.TENANT_NAME" || $preFilter_str[1] == "CLASS.TENANT_PHONE" || $preFilter_str[1] == "CLASS.ALARM" || $preFilter_str[1] == "CLASS.TERMS" || $preFilter_str[1] == "CLASS.STREET" || $preFilter_str[1] == "CLASS.STREET_NUM") {
						$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $value_str  . "' ");
					}elseif ($preFilter_str[1] == "CLASS.STATUS" || $preFilter_str[1] == "STATUS_VACANT" || $preFilter_str[1] == "STATUS_ACTIVE" || $preFilter_str[1] == "CLASS.STORAGE_BIN" || $preFilter_str[1] == "CLASS.STORAGE_ATTIC" || $preFilter_str[1] == "CLASS.STORAGE_BASEMENT") {
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
				if ($preFilter_str[1] == "LOC.LOCID") {
					$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $LOC_ARRAY[$value_str] . "' ");
				}elseif ($preFilter_str[1] == "CLASS.TYPE") {
					$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $TYPE_ARRAY[$value_str] . "' ");
				}elseif ($preFilter_str[1] == "CLASS.LANDLORD") {
					$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $LL_ARRAY[$preFilter_str[0]] . "' ");
				}elseif ($preFilter_str[1] == "PRICE" || $preFilter_str[1] == "CLASS.TENANT_FEE" || $preFilter_str[1] == "CLASS.LANDLORD_FEE" || $preFilter_str[1] == "CLASS.PAYMENT_FIRST" || $preFilter_str[1] == "CLASS.PAYMENT_LAST" || $preFilter_str[1] == "CLASS.PAYMENT_SEC" || $preFilter_str[1] == "CLASS.KEY_DEPOSIT" || $preFilter_str[1] == "CLASS.CLEAN_DEPOSIT" || $preFilter_str[1] == "CLASS.FEE_COMMENTS" || $preFilter_str[1] == "CLASS.PARKING_NUM" || $preFilter_str[1] == "CLASS.PARKING_COST" || $preFilter_str[1] == "CLASS.TENANT_NAME" || $preFilter_str[1] == "CLASS.TENANT_PHONE" || $preFilter_str[1] == "CLASS.ALARM" || $preFilter_str[1] == "CLASS.TERMS" || $preFilter_str[1] == "CLASS.STREET" || $preFilter_str[1] == "CLASS.STREET_NUM") {
					$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $value_str  . "' ");
				}elseif ($preFilter_str[1] == "CLASS.STATUS" || $preFilter_str[1] == "STATUS_VACANT" || $preFilter_str[1] == "STATUS_ACTIVE" || $preFilter_str[1] == "CLASS.STORAGE_BIN" || $preFilter_str[1] == "CLASS.STORAGE_ATTIC" || $preFilter_str[1] == "CLASS.STORAGE_BASEMENT") {
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
			$filter_string_display = "<br><font color=\"#000000\">Filter set:</font> " . $filters_str[0];
			break;
		default:
			$filter_string_display = "<br><font color=\"#000000\">Filter set:</font> ";
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
	<br>
	
	
	<?php if ($listing_filter_display == "small") {?>
	<table border="0" cellspacing="0" cellpadding="0" width="40%">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<form action="<?php echo "$PHP_SELF";?>" method="GET">	
	<input type="hidden" name="op" value="editListing">
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99" align="center">
		<table>
			<tr>
			
			<td height="30" width="160" bgcolor="#FFFF99"><div class="controltext">Jump to Listing</div> #<?php echo $abv;?>-<input type="text" name="cid" size="8"> <input type="submit" value="Go"></form></td>
			</tr>
		</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>	
	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>" method="POST">
	<input type="hidden" name="filterChange" value="1">                
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99" align="center">
		<table>
			<tr>
			
			<td height="30" width="110" bgcolor="#FFFF99"><div class="controltext">Listing Type(s)</div><select name="type[]" multiple size="4">
				<?php while($rowTypes = mysqli_fetch_object($quTypes)) { ?>
					<option value="<?php echo $rowTypes->TYPE;?>" 
					<?php if (is_array($switch_remember['type'])) { 
						if (in_array($rowTypes->TYPE, $switch_remember['type'])) { 
							echo " selected ";
						}
					}?>>
					<?php echo $rowTypes->TYPENAME;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="80" bgcolor="#FFFF99"><div class="controltext">Price Min:</div>$<input type="text" name="priceStart[]" size="4" value="<?php echo $switch_remember['priceStart'];?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="80" bgcolor="#FFFF99"><div class="controltext">Price Max:</div>$<input type="text" name="priceEnd[]" size="4" value="<?php echo $switch_remember['priceEnd'];?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="90" bgcolor="#FFFF99"><div class="controltext">Location(s):</div><select name="loc[]" multiple size="4">
			<?php while($rowLocs = mysqli_fetch_object($quLocs)) { ?>
				<option value="<?php echo $rowLocs->LOCID;?>" 
			<?php if (is_array($switch_remember['loc'])) {
				if (in_array($rowLocs->LOCID, $switch_remember['loc'])) { 
					echo " selected ";
				} 
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
	<td bgcolor="#FFFF99" align="center">
		<table>
			<tr>
			
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Advertising: <input type="checkbox" name="status[]" <?php if ($switch_remember['status']=='ACT') { echo checked;} ?> value="ACT"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Vacant:<input type="checkbox" name="status_vacant[]" value="1" <?php if ($switch_remember['status_vacant']) { echo " checked "; } ?> ></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Available:<input type="checkbox" name="status_active[]" value="1" <?php if ($switch_remember['status_active']) {echo " checked "; }?> ></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="30" bgcolor="#FFFF99"><div class="controltext">Not&nbsp;Available:<input type="checkbox" name="status_not_active[]" value="1" <?php if ($switch_remember['status_not_active']) {echo " checked "; }?> ></td>
			</tr>
		</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99" align="center">
		<?php 
		$getMon = date (m);
		$getDay = date (d);
		$getYear = date (Y);
		?>
	
		<table>
			<tr>
			
			<td height="30" width="200" bgcolor="#FFFF99"><div class="controltext">Available begin date:</div></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="200" bgcolor="#FFFF99"><div class="controltext">Available end date:</div></td>
			 </tr>
			 </table></td>
	
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99" align="center">
	
		<table>
			<tr>
			
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Month</div> <select name="bbbmonth">
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Day</div><select name="bbbday">
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Year</div><select name="bbbyear">
				<option value="--" <?php if ($switch_remember['bbbyear']=="--") { echo " selected "; }?>>--</option>
				<?php 
				$thisYear = date ("Y")-1;
				for ($i=0;$i<=4;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($switch_remember['bbbyear']== ($thisYear + $i)) { echo " selected "; }?>><?php echo ($thisYear + $i);?></option>
				<?php }?>
				</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Month</div><select name="bbemonth">
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Day</div><select name="bbeday"> 
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Year</div><select name="bbeyear">
				<option value="--" <?php if ($switch_remember['bbeyear'] == "--") { echo " selected ";}?>>--</option>
				<?php 
				$thisYear = date ("Y")-1;
				for ($i=0;$i<=4;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($switch_remember['bbeyear'] == ($thisYear + $i)) { echo " selected ";}?> ><?php echo ($thisYear + $i);?></option>
				<?php }?>
				</select></td>
			</tr>
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">
			<table align="center">
			<tr>
			
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Bedrooms:</div><select name="rooms[]" multiple size="4">
			<?php foreach($DEFINED_VALUE_SETS['ROOMS'] as $roomKey => $roomVal) { ?>
				<option value="<?php echo $roomKey;?>" 
				<?php if (is_array($switch_remember['rooms'])) {
						if (in_array($roomKey, $switch_remember['rooms'])) { 
							echo " selected ";
						} 
					}?>>
					<?php echo $roomVal; ?></option>
			<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Bath:</div><select name="bath[]" multiple size="4">
				<?php foreach($DEFINED_VALUE_SETS['BATH'] as $bathKey => $bathVal) { ?>
				<option value="<?php echo $bathKey;?>" 
				<?php if (is_array($switch_remember['bath'])) {
						if (in_array($bathKey, $switch_remember['bath'])) { 
							echo " selected ";
						} 
					}?>>
					<?php echo $bathVal; ?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Pets:</div><select name="pets[]" multiple size="4">
				<?php foreach($DEFINED_VALUE_SETS['PETSA'] as $petKey => $petVal) { ?>
					<option value="<?php echo $petKey;?>" 
					<?php if (is_array($switch_remember['pets'])) {
						if (in_array($petKey, $switch_remember['pets'])) { 
							echo " selected ";
						} 
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
	<td bgcolor="#FFFF99">
			<table align="center">
			<tr>
			
			<td height="30" width="20" bgcolor="#FFFF99"><input type="submit" value="Filter"></form><form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>" method="POST"><input type="hidden" name="clear_filter" value="1"><input type="hidden" name="filter_change" value="1"><input type="submit" value="Clear All"></form></td>
			</tr>
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">
			<table width="100%" align="center">
			<tr>
			
			<td height="30" width="100%" bgcolor="#FFFF99"><div class="ad"><?php echo $filter_string_display;?></div></td>
			</tr>
			<tr>
			<td height="30" width="100%" bgcolor="#FFFF99" valign="bottom" align="right"><div class="controltext">Search Listings:<a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>">Hide</a>&nbsp;<a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=big";?>">full</a></td>
			</tr>
			
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	
	
<?php } elseif ($listing_filter_display == "big") {?>
	
	
	<table border="0" cellspacing="0" cellpadding="0" width="50%">
	<tr>
	<td colspan="3" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>" method="POST">
	<input type="hidden" name="filterChange" value="1">     
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">
			<table width="100%" align="center">
				
			<tr>
			<td height="30" width="110" bgcolor="#FFFF99"><div class="controltext"><NOBR>Landlord(s):</NOBR><select name="landlord[]" multiple size="4">
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>                                        
			<td height="30" width="110" bgcolor="#FFFF99"><div class="controltext">Listing Type(s)</div><select name="type[]" multiple size="4">
				<?php while($rowTypes = mysqli_fetch_object($quTypes)) { ?>
					<option value="<?php echo $rowTypes->TYPE;?>" 
					<?php if (is_array($switch_remember['type'])) { 
						if (in_array($rowTypes->TYPE, $switch_remember['type'])) { 
							echo " selected ";
						}
					}?>>
					<?php echo $rowTypes->TYPENAME;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="80" bgcolor="#FFFF99"><div class="controltext">Price Min:</div>$<input type="text" name="priceStart[]" size="4" value="<?php echo $switch_remember['priceStart'];?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="80" bgcolor="#FFFF99"><div class="controltext">Price Max:</div>$<input type="text" name="priceEnd[]" size="4" value="<?php echo $switch_remember['priceEnd'];?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="90" bgcolor="#FFFF99"><div class="controltext">Location(s):</div><select name="loc[]" multiple size="4">
			<?php while($rowLocs = mysqli_fetch_object($quLocs)) { ?>
				<option value="<?php echo $rowLocs->LOCID;?>" 
			<?php if (is_array($switch_remember['loc'])) {
				if (in_array($rowLocs->LOCID, $switch_remember['loc'])) { 
					echo " selected ";
				} 
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
	<td bgcolor="#FFFF99" align="center">
		<table>
			<tr>
			
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Advertising: <input type="checkbox" name="status[]" <?php if ($switch_remember['status']=='ACT') { echo checked;} ?> value="ACT"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Vacant:<input type="checkbox" name="status_vacant[]" value="1" <?php if ($switch_remember['status_vacant']) { echo " checked "; } ?> ></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Available:<input type="checkbox" name="status_active[]" value="1" <?php if ($switch_remember['status_active']) {echo " checked "; }?> ></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext"><NOBR>Not Available:</NOBR><input type="checkbox" name="status_not_active[]" value="1" <?php if ($switch_remember['status_not_active']) {echo " checked "; }?> >
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
                        <td height="30" width="20" bgcolor="#FFFF99">
<div class="controltext"><NOBR>Not Furnished:</NOBR><input type="checkbox" name="features_not_furnished[]" value="1" <?php if ($switch_remember['features_not_furnished']) {echo " checked "; }?> > 


</td>

			<td height="30" width="45" bgcolor="#FFFF99">&nbsp;</td>


			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Colleges:</div><select name="school[]" multiple size="4">
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
		</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99" align="center">
		<?php 
		$getMon = date (m);
		$getDay = date (d);
		$getYear = date (Y);
		?>
	
		<table>
			<tr>
			
			<td height="30" width="200" bgcolor="#FFFF99"><div class="controltext">Available begin date:</div></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="200" bgcolor="#FFFF99"><div class="controltext">Available end date:</div></td>
			 </tr>
			 </table></td>
	
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99" align="center">
	
		<table>
			<tr>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Month</div> <select name="bbbmonth">
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Day</div><select name="bbbday">
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Year</div><select name="bbbyear">
				<option value="--" <?php if ($switch_remember['bbbyear']=="--") { echo " selected "; }?>>--</option>
				<?php 
				$thisYear = date ("Y")-1;
				for ($i=0;$i<=4;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($switch_remember['bbbyear']== ($thisYear + $i)) { echo " selected "; }?>><?php echo ($thisYear + $i);?></option>
				<?php }?>
				</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Month</div><select name="bbemonth">
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Day</div><select name="bbeday"> 
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Year</div><select name="bbeyear">
				<option value="--" <?php if ($switch_remember['bbeyear'] == "--") { echo " selected ";}?>>--</option>
				<?php 
				$thisYear = date ("Y")-1;
				for ($i=0;$i<=4;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($switch_remember['bbeyear'] == ($thisYear + $i)) { echo " selected ";}?> ><?php echo ($thisYear + $i);?></option>
				<?php }?>
				</select></td>
			</tr>
			</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">
			<table align="center">
			<tr>
			
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Bedrooms:</div><select name="rooms[]" multiple size="4">
			<?php foreach($DEFINED_VALUE_SETS['ROOMS'] as $roomKey => $roomVal) { ?>
				<option value="<?php echo $roomKey;?>" 
				<?php if (is_array($switch_remember['rooms'])) {
						if (in_array($roomKey, $switch_remember['rooms'])) { 
							echo " selected ";
						} 
					}?>>
					<?php echo $roomVal; ?></option>
			<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Bath:</div><select name="bath[]" multiple size="4">
				<?php foreach($DEFINED_VALUE_SETS['BATH'] as $bathKey => $bathVal) { ?>
				<option value="<?php echo $bathKey;?>" 
				<?php if (is_array($switch_remember['bath'])) {
						if (in_array($bathKey, $switch_remember['bath'])) { 
							echo " selected ";
						} 
					}?>>
					<?php echo $bathVal; ?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="1" bgcolor="#FFFF99"><table>
			<tr><td align="right" class="controltext">Heat</td><td align="left"><input type="checkbox" name="features_heat[]" value="1" <?php if ($switch_remember['features_heat']) { echo "checked"; } ?> ></td>
			<td align="right" class="controltext">Gas Heat</td><td align="left"><input type="checkbox" name="features_gas_heat[]" value="1" <?php if ($switch_remember['features_gas_heat']) { echo "checked"; } ?> ></td></tr>
			<tr><td align="right" class="controltext">Oil Heat</td><td align="left"><input type="checkbox" name="features_oil_heat[]" value="1" <?php if ($switch_remember['features_OIL_HEAT']) { echo "checked"; } ?> ></td>
			<td align="right" class="controltext">Electric Heat</td><td align="left"><input type="checkbox" name="features_elec_heat[]" value="1" <?php if ($switch_remember['features_elec_heat']) { echo "checked"; } ?> ></td></tr>
			</table></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Fee:</div><select name="nofee[]" multiple size="4">
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
	<td align="center" bgcolor="#FFFF99">
		<table>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Street Number: <input type="text" size="5" name="street_num" value="<?php echo $switch_remember['street_num']; ?>"> Street:<input type="text" size="35" name="street" value="<?php echo $switch_remember['street']; ?>"></td>
			</tr>
		</table></td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="3" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">
		<table>
			<tr>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext"><NOBR>Listing type:</NOBR><select name="listing_type[]"  multiple size="4">
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext"><NOBR>Lease type:</NOBR><select name="lease_type[]"  multiple size="4">
					<?php foreach ($DEFINED_VALUE_SETS['LEASE_TYPE'] as $lkey => $lVal) { ?>
					<option value="<?php echo $lkey;?>" 
					<?php if (is_array($switch_remember['lease_type'])) {
						if (in_array($lkey, $switch_remember['lease_type'])) { 
							echo " selected ";
						} 
					}?>>
					<?php echo $lVal;?></option>
					<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" valign="TOP" bgcolor="#FFFF99"><div class="controltext">Terms (months):<input type="text" size="3" name="terms[]" value="<?php echo $switch_remember['terms'];?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30"  valign="bottom" bgcolor="#FFFF99"><div class="controltext">Tax Clause:</div><select name="tax_clause[]"  multiple size="4">
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			
		</tr>
		</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="#FFFF99">
		<table BORDER="0">
		<tr>
		<td valign="top" align="center">




<CENTER>

<TABLE><TR>
<TD COLSPAN="4"><div class="controltext"><CENTER><strong>Parking:</strong></CENTER></div></TD><TD>
&nbsp; &nbsp; &nbsp; </TD><TD><div class="controltext"><CENTER><strong>Pets:</strong></CENTER></div></TD></TR>

</TR>
<TR>

<TD VALIGN="TOP"><div class="controltext">Number of spaces: </DIV></TD>
<TD>
<select name="parking_num[]" multiple size="4">
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
<TD VALIGN="TOP"><div class="controltext">Type:</DIV></TD><TD>



<select name="parking_type[]"  multiple size="4">
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
</TD><TD>
&nbsp; &nbsp; &nbsp; 
</TD><TD>
<select name="pets[]" multiple size="4">
				<?php foreach($DEFINED_VALUE_SETS['PETSA'] as $petKey => $petVal) { ?>
					<option value="<?php echo $petKey;?>" 
					<?php if (is_array($switch_remember['pets'])) {
						if (in_array($petKey, $switch_remember['pets'])) { 
							echo " selected ";
						} 
					}?>>
					<?php echo $petVal; ?></option>
			<?php } ?>
			</select>
</TD></TR></TABLE>
</CENTER>





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
	<td bgcolor="#FFFF99">
		<table>
			<tr>
			<td colspan="10" height="30" bgcolor="#FFFF99"><div class="controltext"><strong>Features:</strong></div></td>
			</tr>
			<tr>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Deleaded</td><td align="left"><input type="checkbox" name="features_deleaded[]" value="1" <?php if ($switch_remember['features_deleaded']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Furnished</td><td align="left"><input type="checkbox" name="features_furnished[]" value="1" <?php if ($switch_remember['features_furnished']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Non-smoking</td><td align="left"><input type="checkbox" name="features_non_smoking[]" value="1" <?php if ($switch_remember['features_non_smoking']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Alarm</td><td align="left"><input type="checkbox" name="features_alarm[]" value="1" <?php if ($switch_remember['features_alarm']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">High Ceilings </td><td align="left"><input type="checkbox" name="amenities_high_ceilings[]" value="1" <?php if ($switch_remember['amenities_high_ceilings']) { echo "checked"; } ?> ></td></tr>

				<tr><td align="right" class="controltext">Central AC </td><td align="left"><input type="checkbox" name="features_central_ac[]" value="1" <?php if ($switch_remember['features_central_ac']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">AC </td><td align="left"><input type="checkbox" name="features_ac[]" value="1" <?php if ($switch_remember['features_ac']) { echo "checked"; } ?> ></td></tr>
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
				<tr><td align="right" class="controltext">Galley Kitchen</td><td align="left"><input type="checkbox" name="features_modern_kitchen[]" value="1" <?php if ($switch_remember[' features_modern_kitchen']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Kitchenette </td><td align="left"><input type="checkbox" name="features_kitchenette[]" value="1" <?php if ($switch_remember['features_kitchenette']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Eat-in-Kitchen </td><td align="left"><input type="checkbox" name="features_eat_in_kitchen[]" value="1" <?php if ($switch_remember['features_eat_in_kitchen']) { echo "checked"; } ?> ></td></tr>
				</table>
			</td>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Microwave </td><td align="left"><input type="checkbox" name="features_microwave[]" value="1" <?php if ($switch_remember['features_microwave']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Pantry</td><td align="left"><input type="checkbox" name="features_pantry[]" value="1" <?php if ($switch_remember['features_pantry']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Gas Range</td><td align="left"><input type="checkbox" name="features_gas_range[]" value="1" <?php if ($switch_remember['features_gas_range']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Electric Range</td><td align="left"><input type="checkbox" name="features_elec_range[]" value="1" <?php if ($switch_remember['features_elec_range']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Disposal</td><td align="left"><input type="checkbox" name="features_disposal[]" value="1" <?php if ($switch_remember['features_disposal']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Dishwasher</td><td align="left"><input type="checkbox" name="features_dishwasher[]" value="1" <?php if ($switch_remember['features_dishwasher']) { echo "checked"; } ?> ></td></tr>

				<tr><td align="right" class="controltext">Dining Room </td><td align="left"><input type="checkbox" name="features_dinning_room[]" value="1" <?if ($switch_remember['features_dinning_room']) { echo "checked"; } ?> ></td></tr>


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
	<td bgcolor="#FFFF99">
		<table>
			<tr>
			<td colspan="10" height="30" bgcolor="#FFFF99"><div class="controltext"><strong>Amenities:</strong></div></td>
			</tr>
			<tr>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Concierge </td><td align="left"><input type="checkbox" name="amenities_conciearge[]" value="1" <?php if ($switch_remember['amenities_conciearge']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Security </td><td align="left"><input type="checkbox" name="amenities_security[]" value="1" <?php if ($switch_remember['amenities_security']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Superintendent </td><td align="left"><input type="checkbox" name="amenities_superintendant[]" value="1" <?php if ($switch_remember['amenities_superintendant']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">On Site Management</td><td align="left"><input type="checkbox" name="amenities_on_site_management[]" value="1" <?php if ($switch_remember['amenities_on_site_management']) { echo "checked"; } ?> ></td></tr>
				</table>
			</td>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Roof Deck </td><td align="left"><input type="checkbox" name="amenities_roof_deck[]" value="1" <?php if ($switch_remember['amenities_roof_deck']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Garden </td><td align="left"><input type="checkbox" name="amenities_garden[]" value="1" <?php if ($switch_remember['amenities_garden']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Yard </td><td align="left"><input type="checkbox" name="amenities_yard[]" value="1" <?php if ($switch_remember['amenities_yard']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Elevator </td><td align="left"><input type="checkbox" name="amenities_elevator[]" value="1" <?php if ($switch_remember['amenities_elevator']) { echo "checked"; } ?> ></td></tr>
				</table>
			</td>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Health Club </td><td align="left"><input type="checkbox" name="amenities_health_club[]" value="1" <?php if ($switch_remember['amenities_health_club']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Pool </td><td align="left"><input type="checkbox" name="amenities_pool[]" value="1" <?php if ($switch_remember['amenities_pool']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Tennis </td><td align="left"><input type="checkbox" name="amenities_tennis[]" value="1" <?php if ($switch_remember['amenities_tennis']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Lounge </td><td align="left"><input type="checkbox" name="amenities_lounge[]" value="1" <?php if ($switch_remember['amenities_lounge']) { echo "checked"; } ?> ></td></tr>
				</table>
			</td>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Sauna </td><td align="left"><input type="checkbox" name="amenities_sauna[]" value="1" <?php if ($switch_remember['amenities_sauna']) { echo "checked"; } ?> ></td></tr>
				<tr><td align="right" class="controltext">Storage in Attic </td><td align="left"><input type="checkbox" name="amenities_attic[]" value="1" <?php if ($switch_remember['amenities_attic']) { echo "checked"; }?> >  </td></tr>
				<tr><td align="right" class="controltext">Storage in Basement </td><td align="left"><input type="checkbox" name="amenities_basement[]" value="1" <?php if ($switch_remember['amenities_basement']) {echo "checked"; } ?> >  </td></tr>
				<tr><td align="right" class="controltext">Storage in Bin </td><td align="left"><input type="checkbox" name="amenities_bin[]" value="1" <?php if ($switch_remember['amenities_bin']) {echo "checked"; }?> ></td></tr>
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
	<td align="center" bgcolor="#FFFF99">
		<table>
		<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Building Type:</div><select name="building_type[]"  multiple size="4">
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
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Building Style:</div><select name="building_style[]"  multiple size="4">
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30"  width="100" bgcolor="#FFFF99"><div class="controltext">Laundry</div><select name="laundry_room[]"  multiple size="4">
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			
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
	<td align="center" bgcolor="#FFFF99">
		<table>
		<tr>
			<td height="30"  colspan="10" align="center" bgcolor="#FFFF99"><div class="controltext"><strong>Misc:<strong></div></td>
		</tr>
		
		</table>
	</td>
	<td valign="top" width="1" height="100%" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td align="center" bgcolor="#FFFF99">
		<table>
		<tr>
			<td height="30"  bgcolor="#FFFF99"><div class="controltext">Key Info:</div><select name="key_info[]"  multiple size="4">
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Students:</div><select name="students[]"  multiple size="4">
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			
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
	<td align="center" bgcolor="#FFFF99">
		<table border="0">
		<?php 
			$getLEMon = $switch_remember['bbbLEMonth'];
			$getLEDay = $switch_remember['bbbLEDay'];
			$getLEYear = $switch_remember['bbbLEYear'];
			?>
		<tr>
		<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30"  bgcolor="#FFFF99">



<TABLE><TR><TD COLSPAN=5>

<div class="controltext">Lease Expire:<br></DIV>


</TD></TR><TR><TD>


 <div class="controltext">Month:</div><select name="bbbLEMonth">
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
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>




</TD><TD>


			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Day</div><select name="bbbLEDay"> 
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


</TD><TD>

			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Year</div><select name="bbbLEYear">
				<option value="--">--</option>
				<?php 
				$thisYear = date ("Y")-1;
				for ($i=0;$i<=4;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($getLEYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
				<?php }?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>


</TD></TR></TABLE>



			<td height="30" width="30" bgcolor="#FFFF99"><div class="controltext">Rented&nbsp;By:<select name="rented_by[]" multiple size="2">
				<?php foreach ($DEFINED_VALUE_SETS['RENTED_BY'] as $rentedKey => $rentedVal) {?>
				<option value="<?php echo $rentedKey;?>" 
				<?php if (is_array($switch_remember['rented_by'])) {
						if (in_array($rentedkey, $switch_remember['rented_by'])) { 
							echo " selected ";
						} 
					}?>>
				<?php echo $rentedVal;?></option>
				<?php }?>
				</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>



			</tr>
			<tr>
			
			<td colspan="10" height="30" width="100%" bgcolor="#FFFF99" align="center">
<P><BR>

<input type="submit" value="Filter"></form><form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>" method="POST"><input type="hidden" name="clear_filter" value="1"><input type="hidden" name="filter_change" value="1"><input type="submit" value="Clear All"></form></td>
			</tr>
					
			
			<tr>
			<td height="30" width="100%" colspan="10" bgcolor="#FFFF99"><div class="ad"><?php echo $filter_string_display;?></div></td>
			</tr>
			<tr>
			<td height="30" width="100%" colspan="10" bgcolor="#FFFF99" valign="bottom" align="right"><div class="controltext"><a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none";?>">Hide Search Form</a></td>
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
	<td bgcolor="#FFFF99">
			<table width="100%" align="center">
			<tr>
			
			<td height="30" width="100%" bgcolor="#FFFF99"><div class="ad"><?php echo $filter_string_display;?></div></td>
			</tr>
			<tr>
			<td height="30" width="100%" bgcolor="#FFFF99" valign="bottom" align="right"><div class="controltext">










<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD ALIGN="MIDDLE" BGCOLOR="#FFFFFF" style="font-size:12px;">

<a href="<?php echo "$PHP_SELF?op=listings&listing_filter_display=big";?>"><IMG SRC="../images/search.gif" border="0"> Search Listings</a> &nbsp;

</TD><TD VALIGN="MIDDLE" ALIGN="CENTER" BGCOLOR="#CCCCCC">

<form action="/lacms/clients/AgencyArea2.php?op=listings&listing_filter_display=none" method="POST"><input type="hidden" name="clear_filter" value="1"><input type="hidden" name="filter_change" value="1"><input type="submit" value="Clear Search"></form>

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
	
	
	
	
	
	
	
	
	
	
	
	<br>
	<table border="0" cellspacing="0" cellpadding="0" height="10">
		<tr>
		<td width="230" align="center">
		<form action="<?php echo "$PHP_SELF";?>" method="GET" name="listings_view_form"><input type="hidden" name="op" value="listings">
			<div class="controltext">View:<select name="vid" onchange="JavaScript:document.listings_view_form.submit();">
			<?php 
			mysqli_data_seek ($quGetViews, 0);
			while ($rowGetViews = mysqli_fetch_object($quGetViews)) {?>
			<?php if ($rowGetViews->ID!=9 || $agcy>0) { ?>
				<option value="<?php echo $rowGetViews->ID;?>" <?php if ($vid==$rowGetViews->ID) { echo " selected "; }?>><?php echo $rowGetViews->NAME;?></option>
			<?php } ?>
			<?php } ?>
			</select></div>
			</form>
		</td>
		<td width="1">&nbsp;</td>
		<td align="center"><form action="<?php echo "$PHP_SELF";?>" method="GET" name="limitNForm"><input type="hidden" name="op" value="listings"><div class="controltext">Show<input type="text" size="2" name="limitN" value="<?php echo $limitN;?>" onchange="JavaScript:document.limitNForm.submit();">listings per page.</div></form></td>
		<td width="1">&nbsp;</td>
		<td align="center">
		<form action="<?php echo $PHP_SELF;?>" method="GET" name="pageFlipForm">
		<input type="hidden" name="op" value="listings">
		<div class="controltext">View page:<select name="start" onchange="JavaScript:document.pageFlipForm.submit();" >
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
		 <a href="<?php echo "$PHP_SELF?op=listings&start=z&limitN=$rowLimitCount->COUNTOF&filterChange=1";?>">Show all listings</a> - 
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
<?php if( $vid==9 && $agcy>0 ) { // AGENCY ?>
        <tr><td width=100%>
        <center>
        <?php if ($isAdmin || $handle=="chinkle")
        { ?>
        <table border=1 width=320><tr><td><font size=-1>
                <a href=<?php echo "$PHP_SELF?op=createAgency&return_page=listings";?>>Create New Agency</a><br>
        <?php   foreach ($arrayAgency as $key => $value) 
                {
                        echo "<b>$value</b>&nbsp;&nbsp;&nbsp;<a href=\"$PHP_SELF?op=editAgency&agency_id=$key&return_page=$page&return_page_div=$k\">edit</a>&nbsp;<a href=\"$PHP_SELF?op=deleteAgency&agency_id=$key&return_page=$page&return_page_div=$k\">delete</a> (agency id:=$key)<br>";
                }
        } ?>
        </td></tr></table>
        </td></tr>
<?php } ?>		
		
	</table>
	
	
	<br>
	
	
	
	
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
		
		
		<td class="controltext" width="<?php echo $col[2]; ?>" height="28" bgcolor="<?php echo $bgcolor;?>" align="middle"><a href="<?php echo "$PHP_SELF?op=listings&sort=$col[1]&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo $col[3];?><?php echo $sortImage;?></font></a></td>
	
	<?php } ?>
	<!--END TOP COLUMN-->
	</tr>
	
	<!--RECORDS -->
	<?php while ($rowGetListings = mysqli_fetch_array($quGetListings)) { ?>
        <?php if ($rowColor=="#FFFFFF") {
                $rowColor="#FFFF99";
        }else {
                $rowColor="#FFFFFF";
        } ?>
	
		<tr tabindex="2" id="ad<?php echo $k++;?>k">
		<?php 
		$i = 0;
		foreach ($cols as $col) { 
			
			
			
			?>
		
			<td class="ad" width="<?php echo $col[2]; ?>" height="28" bgcolor="<?php echo $rowColor; ?>" align="center" nowrap>
			<?php if ($col[0]=='f') { 
				if ($col[5]) { //use images;
					if (!$rowGetListings[$col[1]]) {
						echo "<img src='../assets/images/icons/" . $col[4] . "' border='0' alt='" . $col[3] . "=" . $rowGetListings[$col[1]] . "'>";
					}elseif ($rowGetListings[$col[1]] >= 5) {                          
						echo "<img src='../assets/images/icons/" . $col[9] . "' border='0'alt='" . $col[3] . "=" . $rowGetListings[$col[1]] . "'>";
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
                                        <a href="<?php echo "$PHP_SELF?op=managePics&cid=" . $rowGetListings['CID'] . "&return_page=listings&return_page_div=$k"; ?>"><img src="../images/pic.gif" alt="view and edit photos" border=0></a>
                                <? }else { ?>
                                        <a href="<?php echo "$PHP_SELF?op=managePics&cid=" . $rowGetListings['CID'] . "&return_page=listings&return_page_div=$k"; ?>">add pic</a>
				<?php } ?>

                        <?php }elseif ($col[0]=='status') { ?>
				<?php if ($rowGetListings['STATUS']=="STO") { ?>
				<a href="<?php echo "$PHP_SELF?op=activate_a&cid=". $rowGetListings['CID'] . "&return_page=listings&return_page_div=" . $k; ?>"><img src="../assets/images/inact.jpg" border=0></a>
				<?php } elseif ($rowGetListings['STATUS']=="ACT") { ?>
				<a href="<?php echo "$PHP_SELF?op=deactivate_a&cid=" . $rowGetListings['CID'] . "&return_page=listings&return_page_div=" . $k; ?>"><img src="../assets/images/act.gif" border=0></a>
			<?php	}else{ echo "ERROR"; }?>
                        <?php }elseif ($col[0]=='ad') {
			   if($rowGetListings['STATUS_ACTIVE']=="1")
			   { ?>
                              <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetListings['CID'] . "&turn=unavailable&return_page=listings&return_page_div=" . $k;?>"><img src="../assets/images/icons/a.jpg" border=0></a>
			    <?php  } else { ?>
			      <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetListings['CID'] . "&turn=available&return_page=listings&return_page_div=" . $k;?>"><img src="../assets/images/icons/u.jpg" border=0></a>
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
	
	<br>
	<table border="0" cellspacing="0" cellpadding="0" height="10">
		<tr>
		<td width="230" align="center">
		<form action="<?php echo "$PHP_SELF";?>" method="GET" name="listings_view_form2"><input type="hidden" name="op" value="listings">
			<div class="controltext">View:<select name="vid" onchange="JavaScript:document.listings_view_form2.submit();">
			<?php 
			mysqli_data_seek ($quGetViews, 0);
			while ($rowGetViews = mysqli_fetch_object($quGetViews)) {?>
				<option value="<?php echo $rowGetViews->ID;?>" <?php if ($vid==$rowGetViews->ID) { echo " selected "; }?>><?php echo $rowGetViews->NAME;?></option>
			<?php } ?>
			</select></div>
			</form>
		</td>
		<td width="1">&nbsp;</td>
		<td align="center"><form action="<?php echo "$PHP_SELF";?>" method="GET" name="limitNForm"><input type="hidden" name="op" value="listings"><div class="controltext">Show<input type="text" size="2" name="limitN" value="<?php echo $limitN;?>" onchange="JavaScript:document.limitNForm.submit();">listings per page.</div></form></td>
		<td width="1">&nbsp;</td>
		<td align="center">
		<form action="<?php echo $PHP_SELF;?>" method="GET" name="pageFlipForm2">
		<input type="hidden" name="op" value="listings">
		<div class="controltext">View page:<select name="start" onchange="JavaScript:document.pageFlipForm2.submit();" >
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
		 <a href="<?php echo "$PHP_SELF?op=listings&start=z&limitN=$rowLimitCount->COUNTOF";?>">Show all listings</a> - 
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
	
	
	<br>
	</center>
	<?php if ($return_page_div) {?>
	<SCRIPT FOR=window EVENT=onload LANGUAGE="JScript">
		return_scroll(<?php echo $return_page_div;?>);
	</script>
	<?php }?>

<!--END listings -->
