<?php
//BEGIN createLandlordDo //
$PHP_SELF = $_SERVER['PHP_SELF'];
	$short_name  = mysqli_real_escape_string( $dbh, $_POST['short_name']);
	$home_name_first = mysqli_real_escape_string( $dbh, $_POST['home_name_first']);
	$home_name_last = mysqli_real_escape_string( $dbh, $_POST['home_name_last']);

	$home_spouse_first = mysqli_real_escape_string( $dbh, $_POST['home_spouse_first']);
	$home_spouse_last = mysqli_real_escape_string( $dbh, $_POST['home_spouse_last']);

	$home_street = mysqli_real_escape_string( $dbh, $_POST['home_street']);
	$home_street2 = mysqli_real_escape_string( $dbh, $_POST['home_street2']);
	$home_city   = mysqli_real_escape_string( $dbh, $_POST['home_city']);
	$home_state  = $_POST['home_state']; 
	$home_zip    = $_POST['home_zip'];
	$home_phone  = $_POST['home_phone']; 
	$mobile_phone  = $_POST['mobile_phone']; 
	$home_fax    = $_POST['home_fax'];
	$careof    = mysqli_real_escape_string( $dbh, $_POST['careof']);
        //print_r($_POST);
        $spouse_cell = false;
        if(isset($_POST['spouse_cell'])){
            $spouse_cell = $_POST['spouse_cell'];
        }
	//$spouse_cell = $_POST['spouse_cell'];
	$spouse_office  = $_POST['spouse_office'];
	$spouse_email  = $_POST['spouse_email'];

	$off_name    = mysqli_real_escape_string( $dbh, $_POST['off_name']);
	$off_street  = mysqli_real_escape_string( $dbh, $_POST['off_street']); 
	$off_street2  = mysqli_real_escape_string( $dbh, $_POST['off_street2']); 
	$off_city    = mysqli_real_escape_string( $dbh, $_POST['off_city']);
	$off_state   = $_POST['off_state'];  
	$off_zip     = $_POST['off_zip'];
	$off_phone   = $_POST['off_phone'];
	$off_fax     = $_POST['off_fax'];
	$off_email     = $_POST['off_email'];
	$off_website     = $_POST['off_website'];
	$off_weblistings = $_POST['off_weblistings'];
	$super_name  = mysqli_real_escape_string( $dbh, $_POST['super_name']);	
	$super_phone  = $_POST['super_phone'];
        $newsletter_subscribe = null;
        //echo $_POST['newsletter_subscribe'];
        if(isset($_POST['newsletter_subscribe'])){
            $newsletter_subscribe = $_POST['newsletter_subscribe'];
        }
        else{
            $newsletter_subscribe = 1;
        }
        
	//$newsletter_subscribe  = $_POST['newsletter_subscribe'];


	$addendum    = mysqli_real_escape_string( $dbh, $_POST['addendum']);   
	$llnotes       = mysqli_real_escape_string( $dbh, $_POST['llnotes']);
        $pets = null;
        if(isset($_POST['pets'])){
            $pets = $_POST['pets'];
        }
	//$pets = $_POST['pets'];     
	$ll_email = $_POST['ll_email'];
	$lc = $_POST['lc_year'] ."-". $_POST['lc_month'] ."-". $_POST['lc_day'];
	$nc = $_POST['nc_year'] ."-". $_POST['nc_month'] ."-". $_POST['nc_day'];
	$lca = $_POST['last_contact_action'];
        $handle = $_SESSION['handle'];
	$exclusive = mysqli_real_escape_string( $dbh, $_POST['EXCLUSIVE']);
	$llrank = mysqli_real_escape_string( $dbh, $_POST['LLRANK']);

if  ($short_name == "") {

	$page = "createLandlord";
	$msg = "<FONT COLOR=red>landlord NOT created. Please make a SHORT NAME before saving.</FONT>";

} else {

	$quStrCreateLandlord = "INSERT INTO LANDLORD (GRID, SHORT_NAME, HOME_NAME_FIRST, HOME_NAME_LAST, HOME_SPOUSE_FIRST, HOME_SPOUSE_LAST, HOME_STREET, HOME_STREET2, HOME_CITY, HOME_STATE, HOME_ZIP, HOME_PHONE, HOME_FAX, CAREOF, SPOUSE_CELL, SPOUSE_OFFICE, SPOUSE_EMAIL, OFF_NAME, OFF_STREET, OFF_STREET2, OFF_CITY, OFF_STATE, OFF_ZIP, OFF_PHONE, OFF_FAX, OFF_EMAIL, OFF_WEBSITE, OFF_WEBLISTINGS, SUPER_NAME, SUPER_PHONE, ADDENDUM, LLNOTES, PETS, MOBILE_PHONE, LL_EMAIL, NEWSLETTER_SUBSCRIBE, EXCLUSIVE, LLRANK, DATE_CREATED, LAST_CONTACTED, NEXT_CONTACT, LAST_CONTACT_ACTION, LAST_MOD, LAST_MOD_BY, EXTERNAL_LID) VALUES ($grid, '$short_name', '$home_name_first', '$home_name_last', '$home_spouse_first', '$home_spouse_last', '$home_street', '$home_street2', '$home_city', '$home_state', '$home_zip', '$home_phone', '$home_fax', '$careof', '$spouse_cell', '$spouse_office','$spouse_email', '$off_name', '$off_street', '$off_street2', '$off_city', '$off_state', '$off_zip', '$off_phone', '$off_fax', '$off_email','$off_website','$off_weblistings','$super_name','$super_phone','$addendum','$llnotes','$pets','$mobile_phone','$ll_email', '$newsletter_subscribe','$exclusive','$llrank','$now','$lc','$nc','$lca','$now','$handle','0')";
        //echo $quStrCreateLandlord;
	
	$quCreateLandlord = mysqli_query($dbh, $quStrCreateLandlord) or die (dieNice("Sorry, couldn't create landlord record.", "E-7000"));

$llid = mysqli_insert_id($dbh);


$newll = "<A HREF=\"$PHP_SELF?op=adlEdit&LLID=$llid\"><img border=\"0\" vspace=\"0\" hspace=\"0\" SRC=\"../images/edit-new-listing-ll.gif\" ALT=\"Create a new listing for $llid\" TITLE=\"Create A New Listing For $llid\" ALT=\"Create A New Listing For $llid\">

<INPUT TYPE=\"SUBMIT\" VALUE=\"Create a New listing for $short_name\"></A> &nbsp; <a href=\"$PHP_SELF?op=editLandlord&lid=$llid\"><img border=0 src=\"../images/icons/edit.gif\" alt=\"edit\" title=\"edit $short_name\" vspace=\"0\" hspace=\"0\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Edit $short_name\"></a>";







	$disData = "landlords";
	$page = "manageLandlord";
	$needOptions = true;

$msg = "Landlord record $short_name created. $newll";

$title = "Manage Landlords";
	$sec_op = "manageLandlord";


}

//END createLandlordDo //
?>