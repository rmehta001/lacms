<?php
if ($_SESSION["level"] > 4) {
    
    $dropdown_placeholder = "--";
    
    $public = $_POST['public'] ?? 0;
    $handle = $_POST['handle'] ?? "";
    $home_phone = $_POST['home_phone'] ?? "";
    $name_first = $_POST['name_first'] ?? "";
    $name_last = $_POST['name_last'] ?? "";
    $work_phone = $_POST['work_phone'] ?? "";
    $mobile_phone = $_POST['mobile_phone'] ?? "";
    $client_email = $_POST['client_email'] ?? "";
    $client_email2 = $_POST['client_email2'] ?? "";
    $pricemin = (int)($_POST['pricemin'] ?? 0);
    $pricemax = (int)($_POST['pricemax'] ?? 0);
    $curaddress = $_POST['curaddress'] ?? "";
    $curcity = $_POST['curcity'] ?? "";
    $curstate = $_POST['curstate'] ?? "";
    $curzip = $_POST['curzip'] ?? "";
    $source = $_POST['SOURCE'] ?? 0;
    if($source == $dropdown_placeholder){
        $source = 0;
    }
    $client_status2 = $_POST['CLIENT_STATUS2'] ?? "";
    if($client_status2 == $dropdown_placeholder){
        $client_status2 = 0;
    }
    
    $show_date = !empty($_POST['SHOW_DATE']) ? $_POST['SHOW_DATE'] : date("0000-00-00") ;
    $show_time = $_POST['SHOW_TIME'] ?? "";
    $show_length = $_POST['SHOW_LENGTH'] ?? "";
    $num_people = (int)($_POST['num_people'] ?? 1);
    $status_client = (int)($_POST['status_client'] ?? 0);
    $client_subtype = $_POST['client_subtype'] ?? "";
    $curremploy = $_POST['curremploy'] ?? "";
    $client_leadsafe = (int)($_POST['client_leadsafe'] ?? 0);
    $newsletter_subscribe = !empty($_POST['$newsletter_subscribe']) ? (int)$_POST['$newsletter_subscribe']  : 0;
    $date_created = $_POST['dc_year'] . "-" . $_POST['dc_month'] . "-" . $_POST['dc_day'];

    //$type_pref = array_to_string($_POST['type_pref'], ",");
    $type_pref = $_POST['type_pref'];
    $date_created = $_POST['dc_year'] . "-" . $_POST['dc_month'] . "-" . $_POST['dc_day'];
    $date_modified = "$date_created";

    $date_next_contact = $_POST['nc_year'] . "-" . $_POST['nc_month'] . "-" . $_POST['nc_day'];

    if (isset($type_pref) && ($type_pref == "2" || $type_pref == "3" || $type_pref == "5" || $type_pref == "6" || $type_pref == "7" || $type_pref == "8" || $type_pref == "9" || $type_pref == "10" || $type_pref == "11" || $type_pref == "12" || $type_pref == "13")) {

        $date_movein = "0000-00-00";
        $date_movein_end = "0000-00-00";
    } else {

        $date_movein = $_POST['mi_year'] . "-" . $_POST['mi_month'] . "-" . $_POST['mi_day'];

        $date_movein_end = $_POST['mie_year'] . "-" . $_POST['mie_month'] . "-" . $_POST['mie_day'];

        if ($date_movein_end == "0000-00-00") {
            $date_movein_end = $date_movein;
        }
    }
    $loc_pref = !empty($_POST['loc_pref']) ? array_to_string($_POST['loc_pref'], ",") : "";
    $rooms_pref = !empty($_POST['rooms_pref']) ? array_to_string($_POST['rooms_pref'], ",") : "";
    $bath_pref = !empty($_POST['bath_pref']) ? array_to_string($_POST['bath_pref'], ",") : "";
    $pets_pref = !empty($_POST['pets_pref']) ? array_to_string($_POST['pets_pref'], ",") : "";
    $building_pref = !empty($_POST['building_pref']) ? array_to_string($_POST['building_pref'], ",") : "";
    $client_furnished = !empty($_POST['$client_furnished']) ? (int)$_POST['$client_furnished']  : 0;
    $client_shortterm = !empty($_POST['$client_shortterm']) ? (int)$_POST['$client_shortterm']  : 0;
    $client_credit_check = !empty($_POST['client_credit_check']) ? (int)$_POST['client_credit_check']  : 0;
    $fee_disclosure = !empty($_POST['$fee_disclosure']) ? (int)$_POST['$fee_disclosure']  : 0;
    $agency_disclosure = !empty($_POST['$agency_disclosure']) ? (int)$_POST['$agency_disclosure']  : 0;
    $client_type = !empty($_POST['client_type']) ? array_to_string($_POST['client_type'], ",") : "";
    $client_employment = !empty($_POST['client_employment']) ? array_to_string($_POST['client_employment'], ",") : "";
    $avail_pref = !empty($_POST['avail_pref']) ? array_to_string($_POST['avail_pref'], ",") : date("0000-00-00");
    $client_app_status = !empty($_POST['$client_app_status']) ? (int)$_POST['$client_app_status']  : 0;
    $tenant_fee_paid = !empty($_POST['$tenant_fee_paid']) ? (int)$_POST['$tenant_fee_paid']  : 0;
    $payment_first_paid = !empty($_POST['$payment_first_paid']) ? (int)$_POST['$payment_first_paid']  : 0;
    $payment_last_paid = !empty($_POST['$payment_last_paid']) ? (int)$_POST['$payment_last_paid']  : 0;
    $payment_sec_paid = !empty($_POST['$payment_sec_paid']) ? (int)$_POST['$payment_sec_paid']  : 0;
    $key_dep_paid = !empty($_POST['$key_dep_paid']) ? (int)$_POST['$key_dep_paid']  : 0;
    $clean_dep_paid = !empty($_POST['$clean_dep_paid']) ? (int)$_POST['$clean_dep_paid']  : 0;
    $client_notes = $_POST['client_notes'] ?? "";

    //$quStrAddClient = "INSERT INTO CLIENTS (GRID, UID, CREATED_BY, PUBLIC, STATUS_CLIENT, NAME_FIRST, NAME_LAST, HOME_PHONE, WORK_PHONE, MOBILE_PHONE, CLIENT_EMAIL, CLIENT_EMAIL2, CURADDRESS, CURCITY, CURSTATE, CURZIP, PRICEMIN, PRICEMAX, AVAIL_PREF, TYPE_PREF, LOC_PREF, BUILDING_PREF, ROOMS_PREF, BATH_PREF, NUM_PEOPLE, CLIENT_TYPE, CLIENT_EMPLOYMENT, PETS_PREF, CLIENT_FURNISHED, CLIENT_SHORTTERM, FEE_DISCLOSURE, AGENCY_DISCLOSURE, CLIENT_CREDIT_CHECK, CLIENT_APP_STATUS, TENANT_FEE_PAID, PAYMENT_FIRST_PAID, PAYMENT_LAST_PAID, PAYMENT_SEC_PAID, KEY_DEP_PAID, CLEAN_DEP_PAID, CLIENT_NOTES, NEWSLETTER_SUBSCRIBE, DATE_CREATED, DATE_MODIFIED, DATE_NEXT_CONTACT, DATE_MOVEIN, DATE_MOVEIN_END, SOURCE, SHOW_DATE, SHOW_TIME, SHOW_LENGTH, CLIENT_STATUS2, CLIENT_SUBTYPE, CURREMPLOY, LEADSAFE) VALUES ('$grid', '$uid', '$handle', '$public', '$status_client', '$name_first', '$name_last', '$home_phone', '$work_phone', '$mobile_phone', '$client_email', '$client_email2', '$curaddress', '$curcity', '$curstate', '$curzip', '$pricemin', '$pricemax', '$avail_pref', '$type_pref', '$loc_pref', '$building_pref', '$rooms_pref', '$bath_pref', '$num_people', '$client_type', '$client_employment', '$pets_pref', '$client_furnished', '$client_shortterm', '$fee_disclosure', '$agency_disclosure', '$client_credit_check', '$client_app_status', '$tenant_fee_paid', '$payment_first_paid', '$payment_last_paid', '$payment_sec_paid', '$key_dep_paid', '$clean_dep_paid', '$client_notes', '$newsletter_subscribe', '$date_created', '$date_modified', '$date_next_contact', '$date_movein', '$date_movein_end', '$source', '$show_date', '$show_time', '$show_length', '$client_status2', '$client_subtype', '$curremploy', '$client_leadsafe')";
    $quStrAddClient = "INSERT INTO CLIENTS (GRID, UID, CREATED_BY, PUBLIC, STATUS_CLIENT, NAME_FIRST, NAME_LAST, HOME_PHONE, WORK_PHONE, MOBILE_PHONE, CLIENT_EMAIL, CLIENT_EMAIL2, CURADDRESS, CURCITY, CURSTATE, CURZIP, PRICEMIN, PRICEMAX, AVAIL_PREF, TYPE_PREF, LOC_PREF, BUILDING_PREF, ROOMS_PREF, BATH_PREF, NUM_PEOPLE, CLIENT_TYPE, CLIENT_EMPLOYMENT, PETS_PREF, CLIENT_FURNISHED, CLIENT_SHORTTERM, FEE_DISCLOSURE, AGENCY_DISCLOSURE, CLIENT_CREDIT_CHECK, CLIENT_APP_STATUS, TENANT_FEE_PAID, PAYMENT_FIRST_PAID, PAYMENT_LAST_PAID, PAYMENT_SEC_PAID, KEY_DEP_PAID, CLEAN_DEP_PAID, CLIENT_NOTES, NEWSLETTER_SUBSCRIBE, DATE_CREATED, DATE_MODIFIED, DATE_NEXT_CONTACT, DATE_MOVEIN, DATE_MOVEIN_END, SOURCE, SHOW_DATE, SHOW_TIME, SHOW_LENGTH, CLIENT_STATUS2, CLIENT_SUBTYPE, CURREMPLOY, LEADSAFE) VALUES ('$grid', '$uid', '$handle', '$public', '$status_client', '$name_first', '$name_last', '$home_phone', '$work_phone', '$mobile_phone', '$client_email', '$client_email2', '$curaddress', '$curcity', '$curstate', '$curzip', '$pricemin', '$pricemax', '$avail_pref', '$type_pref', '$loc_pref', '$building_pref', '$rooms_pref', '$bath_pref', '$num_people', '$client_type', '$client_employment', '$pets_pref', '$client_furnished', '$client_shortterm', '$fee_disclosure', '$agency_disclosure', '$client_credit_check', '$client_app_status', '$tenant_fee_paid', '$payment_first_paid', '$payment_last_paid', '$payment_sec_paid', '$key_dep_paid', '$clean_dep_paid', '$client_notes', '$newsletter_subscribe', '$date_created', '$date_modified', '$date_next_contact', '$date_movein', '$date_movein_end', '$source', '$show_date', '$show_time', '$show_length', '$client_status2', '$client_subtype', '$curremploy', '$client_leadsafe')";
    $quAddClient = mysqli_query($dbh, $quStrAddClient) or die(mysqli_error($dbh));
    
    $clid = mysqli_insert_id($dbh);
    echo "CLID is : " . $clid;
    $action = "Client created by $_SESSION[handle]";
    $quStrAddClientH = "INSERT INTO CLIENTS_HISTORY (UID, HANDLE, CLI, CLID, ACTION) VALUES ('$uid', '$_SESSION[handle]', '$grid', '$clid', '$action')";
    $quAddClientH = mysqli_query($dbh, $quStrAddClientH) or die(mysqli_error($dbh));

    $page = "manageClients";
    $msg = "<NOBR>New Client $name_first $name_last created by $_SESSION[handle].
		
		&nbsp;&nbsp;

		
		<a href=\"?op=editClient&clid=$clid\" TITLE=\"Edit $name_first $name_last\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Edit $name_first $name_last\"></a>

		&nbsp;&nbsp;

<a href=\"op=listings&client_id_filter=$clid\"><img border=\"0\" hspace=\"2\" vspace=\"0\" width=\"19\" height=\"19\" src=\"../assets/images/matchlistings.gif\" TITLE=\"Match $name_first $name_last to Listings\" ALT=\"Match $name_first $name_last to Listings\"></a>

&nbsp;&nbsp;

<A HREF=\"?op=mail_client&clid=$clid\" target=\"_email$clid\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22 TITLE=\"Email $name_first $name_last\" ALT=\"Email $name_first $name_last\"></A>

&nbsp;&nbsp;

<A HREF=\"?op=editClientReassign&clid=$clid&fname=$name_first&lname=$name_last\"><FONT SIZE=\"-2\"><img border=\"0\" hspace=\"0\" vspace=\"0\" width=\"16\" height=\"16\" src=\"../assets/images/client-reassign.gif\" TITLE=\"Reassign Client\" ALT=\"Reassign Client\"> Reassign $name_first $name_last</FONT></A>
		
		
		</NOBR>";
       
    $title = "Manage Clients";
    $disData = "clients";
    $sec_op = "manageClients";
} else {
    $page = "home";
    $msg = "Sorry, that functionality isn't available";
    $msg_error = true;
}
//END createClientDo //
?>
