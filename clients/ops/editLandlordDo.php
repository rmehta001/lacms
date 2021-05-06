<?php
//BEGIN editLandlordDo //
        $handle = $_SESSION['handle'];
	$lid = $_POST['lid'];

  $PHP_SELF = $_SERVER['PHP_SELF']; 

	$short_name       = mysqli_real_escape_string($dbh, $_POST['short_name']);
	$home_name_first  = mysqli_real_escape_string($dbh, $_POST['home_name_first']);
	$home_name_last   = mysqli_real_escape_string($dbh, $_POST['home_name_last']);
	
	$home_spouse_first  = mysqli_real_escape_string($dbh, $_POST['home_spouse_first']);
	$home_spouse_last   = mysqli_real_escape_string($dbh, $_POST['home_spouse_last']);
	
	$home_street = mysqli_real_escape_string($dbh, $_POST['home_street']);
	$home_street2 = mysqli_real_escape_string($dbh, $_POST['home_street2']);
	$home_city   = mysqli_real_escape_string($dbh, $_POST['home_city']);
	$home_state  = $_POST['home_state']; 
	$home_zip    = $_POST['home_zip'];
	$home_phone  = $_POST['home_phone']; 
	$mobile_phone = $_POST['mobile_phone'];
	$home_fax    = $_POST['home_fax'];
	$careof    = mysqli_real_escape_string($dbh, $_POST['careof']);



	$spouse_cell    = $_POST['spouse_cell'];
	$spouse_office  = $_POST['spouse_office'];
	$spouse_email  = $_POST['spouse_email'];
	
	$off_name    = mysqli_real_escape_string($dbh, $_POST['off_name']);
	$off_street  = mysqli_real_escape_string($dbh, $_POST['off_street']); 
	$off_street2 = mysqli_real_escape_string($dbh, $_POST['off_street2']); 
	$off_city    = mysqli_real_escape_string($dbh, $_POST['off_city']);
	$off_state   = $_POST['off_state'];  
	$off_zip     = $_POST['off_zip'];
	$off_phone   = $_POST['off_phone'];
	$off_fax     = $_POST['off_fax'];
	$off_email   = $_POST['off_email'];
	$off_website = $_POST['off_website'];
	$off_weblistings = $_POST['off_weblistings'];
	$addendum    = mysqli_real_escape_string($dbh, $_POST['addendum']);   
	$llnotes     = mysqli_real_escape_string($dbh, $_POST['llnotes']);
	$pets        = $_POST['pets'] ?? "";  
	$ll_email = $_POST['ll_email'];
	$lc = $_POST['lc_year'] ."-". $_POST['lc_month'] ."-". $_POST['lc_day'];
	$nc = $_POST['nc_year'] ."-". $_POST['nc_month'] ."-". $_POST['nc_day'];
	$lca  = $_POST['last_contact_action'];
	$super_name  = mysqli_real_escape_string($dbh, $_POST['super_name']);
	$super_phone  = $_POST['super_phone'];
	$newsletter_subscribe  = $_POST['newsletter_subscribe'];
	$exclusive = $_POST['EXCLUSIVE'];  
	$llrank = $_POST['LLRANK'];
	
	
	$quStrUpdateLandlord = "UPDATE LANDLORD SET SHORT_NAME='$short_name', HOME_NAME_FIRST='$home_name_first', HOME_NAME_LAST='$home_name_last', HOME_SPOUSE_FIRST='$home_spouse_first', HOME_SPOUSE_LAST='$home_spouse_last', HOME_STREET='$home_street', HOME_STREET2='$home_street2', HOME_CITY='$home_city', HOME_STATE='$home_state', HOME_ZIP='$home_zip', HOME_PHONE='$home_phone', HOME_FAX='$home_fax', CAREOF='$careof', SPOUSE_CELL='$spouse_cell', SPOUSE_OFFICE='$spouse_office', SPOUSE_EMAIL='$spouse_email', OFF_NAME='$off_name', OFF_STREET='$off_street', OFF_STREET2='$off_street2', OFF_CITY='$off_city', OFF_STATE='$off_state', OFF_ZIP='$off_zip', OFF_PHONE='$off_phone', OFF_FAX='$off_fax', OFF_EMAIL='$off_email', OFF_WEBSITE='$off_website', OFF_WEBLISTINGS='$off_weblistings', ADDENDUM='$addendum', LLNOTES='$llnotes', PETS='$pets', MOBILE_PHONE='$mobile_phone', LL_EMAIL='$ll_email', SUPER_NAME='$super_name', NEWSLETTER_SUBSCRIBE='$newsletter_subscribe', SUPER_PHONE='$super_phone', LAST_CONTACTED='$lc', EXCLUSIVE='$exclusive', NEXT_CONTACT='$nc', LAST_CONTACT_ACTION='$lca', LAST_MOD='$now', LLRANK='$llrank', LAST_MOD_BY='$handle' WHERE LID=$lid AND GRID=$grid";
	$quUpdateLandlord = mysqli_query($dbh, $quStrUpdateLandlord) or die (mysqli_error($dbh));
	
	$disData = "landlords";
	$page = "manageLandlord";


	$msg = "
<TABLE><TR><TD>
<NOBR>

Changes saved to Landlord $short_name.


&nbsp;&nbsp;

<a href=\"$PHP_SELF?op=editLandlord&lid=$lid\"><img border=0 src=\"../images/icons/edit.gif\" alt=\"edit\" title=\"edit $short_name\" vspace=\"0\" hspace=\"0\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Edit $short_name\"></a>

&nbsp;&nbsp;
</NOBR></TD><TD><NOBR>

<A HREF=\"$PHP_SELF?op=adlEdit&LLID=$lid\"><img border=\"0\" vspace=\"0\" hspace=\"0\" SRC=\"../images/edit-new-listing-ll.gif\" ALT=\"Create a new listing for $short_name\" TITLE=\"Create A New Listing For $short_name\" ALT=\"Create A New Listing For $short_name\">
<INPUT TYPE=\"SUBMIT\" VALUE=\"Create A New Listing For $short_name\"></a>

&nbsp;&nbsp;

</NOBR></TD>


<form action=\"$PHP_SELF?op=listings&listing_filter_display=none&activeFilter=n&vid=7&sortD=ASC&sort=STREET,%20STREET_NUM,%20APT\"  method=\"POST\" target=\"_NEW\">
<TD><NOBR>

	<input type=\"hidden\" name=\"filterChange\" value=\"1\">
	<input type=\"hidden\" name=\"landlord\" value=\"$lid\">
<input type=\"image\" src=\"../assets/images/listings.gif\" name=\"listings\" border=\'0\' vspace=\'0\' hspace=\'0\' TITLE=\"View ALL $short_name Listings\">

<INPUT TYPE=\"SUBMIT\" VALUE=\"View all $short_name's listings\">

</form>


</NOBR></TD></TR></TABLE>";






	$needOptions = true;
	$title = "Manage Landlords";
	$sec_op = "manageLandlord";
//END editLandlordDo //
?>