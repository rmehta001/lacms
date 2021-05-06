<?php
//BEGIN editClientDo //
//changes done by Tanvi//
	if ($_SESSION ["level"]>4) {
		$clid = $_POST['clid'];
		$public = $_POST['public'];
		$status_client = $_POST['status_client'];
		$name_first = $_POST['name_first'];
		$name_last = $_POST['name_last'];
		$phone_work = $_POST['work_phone'];
		$phone_home = $_POST['home_phone'];
		$phone_mobile = $_POST['mobile_phone'];
	$newsletter_subscribe  = $_POST['newsletter_subscribe'];

		$num_people = $_POST['num_people'];


		$social = $_POST['SOCIAL'];
		$CLDOB = $_POST['CLDOB'];
		$curremploy = $_POST['CURREMPLOY'];
		$curremployaddress = $_POST['CURREMPLOYADDRESS'];
		$curremployphone = $_POST['CURREMPLOYPHONE'];
		$curremploycontact = $_POST['CURREMPLOYCONTACT'];
		$curremploypos = $_POST['CURREMPLOYPOS'];
		$curremploysalary = $_POST['CURREMPLOYSALARY'];



		$prevemploy = $_POST['PREVEMPLOY'];
		$prevemployaddress = $_POST['PREVEMPLOYADDRESS'];
		$prevemployphone = $_POST['PREVEMPLOYPHONE'];
		$prevemploycontact = $_POST['PREVEMPLOYCONTACT'];
		$prevemploypos = $_POST['PREVEMPLOYPOS'];
		$prevemploysalary = $_POST['PREVEMPLOYSALARY'];



		$creditref = $_POST['CREDITREF'];
		$creditaccount = $_POST['CREDITACCOUNT'];
		$persref = $_POST['PERSREF'];
		$persrefcontact = $_POST['PERSREFCONTACT'];



		$currll = $_POST['CURRLL'];
		$currlladdress = $_POST['CURRLLADDRESS'];
		$currllphone = $_POST['CURRLLPHONE'];
		$currllrent = $_POST['CURRLLRENT'];


		$prevll = $_POST['PREVLL'];
		$prevlladdress = $_POST['PREVLLADDRESS'];
		$prevllphone = $_POST['PREVLLPHONE'];
		$prevllrent = $_POST['PREVLLRENT'];

		$curaddress = $_POST['curaddress'];
		$curcity = $_POST['curcity'];
		$curstate = $_POST['curstate'];
		$curzip = $_POST['curzip'];


	$date_created = $_POST['dc_year'] ."-". $_POST['dc_month'] ."-". $_POST['dc_day'];
	$date_next_contact = $_POST['nc_year'] ."-". $_POST['nc_month'] ."-". $_POST['nc_day'];
	$date_movein = $_POST['mi_year'] ."-". $_POST['mi_month'] ."-". $_POST['mi_day'];
	$date_movein_end = $_POST['mie_year'] ."-". $_POST['mie_month'] ."-". $_POST['mie_day'];

if ($date_movein_end == "0000-00-00")
{
$date_movein_end = $date_movein;
}

		$pricemin = $_POST['pricemin'];
		$pricemax = $_POST['pricemax'];
		$type_pref = $_POST['type_pref'];
		
		//$type_pref = array_to_string ($_POST['type_pref'], ",");
		$loc_pref = array_to_string ($_POST['loc_pref'], ",");
		$rooms_pref = array_to_string ($_POST['rooms_pref'], ",");
		$bath_pref = array_to_string ($_POST['bath_pref'], ",");
		$pets_pref = array_to_string ($_POST['pets_pref'], ",");

	$client_furnished = $_POST['client_furnished'];
	$client_shortterm = $_POST['client_shortterm'];

	$client_app_status  =  $_POST['client_app_status'];
	$client_credit_check = $_POST['client_credit_check'];
	$fee_disclosure = $_POST['fee_disclosure'];
	$agency_disclosure = $_POST['agency_disclosure'];

	$client_type = $_POST['client_type'];
	$client_employment = $_POST['client_employment'];

		
		$tenant_fee_paid = $_POST['tenant_fee_paid'];
		$payment_first_paid = $_POST['payment_first_paid'];
		$payment_last_paid = $_POST['payment_last_paid'];
		$payment_sec_paid = $_POST['payment_sec_paid'];
		$key_dep_paid = $_POST['key_dep_paid'];
		$clean_dep_paid = $_POST['clean_dep_paid'];
		$client_notes = prepareAdBody($_POST['client_notes'], false);
		
//*		$verifyUID = mysqli_fetch_object(mysqli_query("SELECT UID FROM CLIENTS WHERE CLID='$clid'")) or die (dieNice("can't verify client record", "E-455")); *//




//*		$updatePublic = ($isAdmin || ($verifyUID->UID==$uid)) ? " PUBLIC='$public', " : " "; *//



		$client_update_where = ($isAdmin) ? "WHERE CLID='$clid' AND GRID='$grid'" : "WHERE CLID='$clid' AND GRID='$grid' AND (PUBLIC!=0 OR UID='$uid')";
		$quStrUpdateClient = "UPDATE CLIENTS SET PUBLIC='$public', NAME_FIRST='$name_first', NAME_LAST='$name_last', STATUS_CLIENT='$status_client', HOME_PHONE='$phone_home', WORK_PHONE='$phone_work', MOBILE_PHONE='$phone_mobile', CLIENT_EMAIL='$client_email', CURADDRESS='$curaddress', CURCITY='$curcity', CURSTATE='$curstate', CURZIP='$curzip', PRICEMIN='$pricemin', DATE_NEXT_CONTACT='$date_next_contact', PRICEMAX='$pricemax', TYPE_PREF='$type_pref', LOC_PREF='$loc_pref', ROOMS_PREF='$rooms_pref', BATH_PREF='$bath_pref', NUM_PEOPLE='$num_people', SOCIAL='$social', CLDOB='$CLDOB', CURREMPLOY='$curremploy', CURREMPLOYADDRESS='$curremployaddress', CURREMPLOYPHONE='$curremployphone', CURREMPLOYCONTACT='$curremploycontact', CURREMPLOYPOS='$curremploypos', CURREMPLOYSALARY='$curremploysalary', PREVEMPLOY='$prevemploy', PREVEMPLOYADDRESS='$prevemployaddress', PREVEMPLOYPHONE='$prevemployphone', PREVEMPLOYCONTACT='$prevemploycontact', PREVEMPLOYPOS='$prevemploypos', PREVEMPLOYSALARY='$prevemploysalary', CURRLL='$currll', CURRLLADDRESS='$currlladdress', CURRLLPHONE='$currllphone', CURRLLRENT='$currllrent', PREVLL='$prevll', PREVLLADDRESS='$prevlladdress', PREVLLPHONE='$prevllphone', PREVLLRENT='$prevllrent', CREDITREF='$creditref', CREDITACCOUNT='$creditaccount', PERSREF='$persref', PERSREFCONTACT='$persrefcontact', CLIENT_TYPE='$client_type', CLIENT_EMPLOYMENT='$client_employment', PETS_PREF='$pets_pref', CLIENT_FURNISHED='$client_furnished', CLIENT_SHORTTERM='$client_shortterm', FEE_DISCLOSURE='$fee_disclosure', DATE_MOVEIN='$date_movein', DATE_MOVEIN_END='$date_movein_end', DATE_NEXT_CONTACT='$date_next_contact', AGENCY_DISCLOSURE='$agency_disclosure', CLIENT_CREDIT_CHECK='$client_credit_check', CLIENT_APP_STATUS='$client_app_status', TENANT_FEE_PAID='$tenant_fee_paid', PAYMENT_FIRST_PAID='$payment_first_paid', PAYMENT_LAST_PAID='$payment_last_paid', PAYMENT_SEC_PAID='$payment_sec_paid', KEY_DEP_PAID='$key_dep_paid', CLEAN_DEP_PAID='$clean_dep_paid', CLIENT_NOTES='$client_notes', NEWSLETTER_SUBSCRIBE='$newsletter_subscribe' $client_update_where";
		$quUpdateClient = mysqli_query($dbh, $quStrUpdateClient) or die ($quStrUpdateClient);
		
		$page = "clientThanks";
		$msg = "Client $name_first $name_last updated by $handle." ;
		$disData = "clients";
		$title = "Manage Clients";
		$sec_op = "manageClients";
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
//END editClientDo //
?>