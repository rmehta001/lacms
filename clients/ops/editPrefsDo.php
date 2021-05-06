<?php 
//BEGIN editPrefsDo //
	
	$user_num_ads = isset ($_POST['num_ads']) ? $_POST['num_ads'] : 10;
	if (!$user_num_ads) {
		$user_num_ads = 10;
	}
	$user_sig = mysqli_real_escape_string($dbh, prepareAdBody($_POST['user_sig'], 0));
        $use_version = isset ($_POST['use_version']) ? $_POST['use_version'] : 2;
        //$amit_test = mysqli_real_escape_string($HTTP_POST_VARS['fname']);
        // echo var_dump($_POST); amit s debug
        
	$fname = mysqli_real_escape_string ($dbh, isset ($_POST['fname']) ? $_POST['fname'] : '1');
	$lname = mysqli_real_escape_string($dbh, isset ($_POST['lname']) ? $_POST['lname'] : '1' );
	$position = mysqli_real_escape_string($dbh, isset ($_POST['position']) ? $_POST['position'] : '1' );
	$email = isset ($_POST['email']) ? $_POST['email'] : '1';
	$cellphone = isset ($_POST['cellphone']) ? $_POST['cellphone'] : '1';
	$directline = isset ($_POST['directline']) ? $_POST['directline'] : '1';
	$personal_website = isset ($_POST['personal_website']) ? $_POST['personal_website'] : '1';
	$pref_adl_view = isset ($_POST['pref_adl_view']) ? $_POST['pref_adl_view'] : 1;
	$pref_auto_update_landlord = isset ($_POST['pref_auto_update_landlord']) ? $_POST['pref_auto_update_landlord'] : 1;
	$bio = isset ($_POST['bio']) ? $_POST['bio'] : '1';
	$listview = isset ($_POST['listview']) ? $_POST['listview'] : '1';
	$listsearch = isset ($_POST['listsearch']) ? $_POST['listsearch'] : '1'  ;
	$listsearchshow = isset ($_POST['listsearchshow']) ? $_POST['listsearchshow'] : '1';
	$listactive = isset ($_POST['listactive']) ?$_POST['listactive'] : '1' ;
	$listsharedc = isset ($_POST['listsharedc']) ? $_POST['listsharedc'] : '1';
	$listsharedl = isset ($_POST['listsharedl']) ?$_POST['listsharedl'] : '1' ;
	$agent_type = isset ($_POST['agent_type']) ? $_POST['agent_type'] : '1';
	$sourcepref = isset ($_POST['sourcepref']) ?$_POST['sourcepref'] : '1' ;
	$sourceprefquick = isset ($_POST['sourceprefquick']) ? $_POST['sourceprefquick'] : '1';

	$pref_show_ll_search = isset ($_POST['pref_show_ll_search']) ? $_POST['pref_show_ll_search'] : '1';

	$mls_town_pref = isset ($_POST['mls_town_pref']) ? $_POST['mls_town_pref'] : '1';

	$pref_show_pending_hotlist = isset ($_POST['pref_show_pending_hotlist']) ? $_POST['pref_show_pending_hotlist'] : '1';


	$facebook = isset ($_POST['facebook']) ? $_POST['facebook'] : '1';
	$twitter = isset ($_POST['twitter']) ? $_POST['twitter'] : '1';
	$myspace = isset ($_POST['myspace']) ? $_POST['myspace'] : '1';
	$linkedin =isset ( $_POST['linkedin']) ? $_POST['linkedin'] : '1';

$pref_show_appt_o = isset ($_POST['pref_show_appt_o']) ? $_POST['pref_show_appt_o'] : '1';

$pref_show_ll_hl = isset ($_POST['pref_show_ll_hl']) ? $_POST['pref_show_ll_hl'] : '1';
	
	$pref_all_clients = isset ($_POST['pref_all_clients'])?  $_POST['pref_all_clients']: '1';
	$emailbcc = isset ($_POST['emailbcc'])? $_POST['emailbcc'] : '1';
       
	
	$pref_client_notes = isset ($_POST['pref_client_notes']) ? $_POST['pref_client_notes'] : '1';

	$actsto = isset ($_POST['actsto']) ? $_POST['actsto'] : '1';
	$avlnew = isset ($_POST['avlnew']) ? $_POST['avlnew'] : '1';
	$showpic_sig = isset ($_POST['showpic_sig']) ? $_POST['showpic_sig'] : 'NA';
	$quStrEditPrefs = "UPDATE USERS SET NUM_ADS=$user_num_ads, USER_SIG='$user_sig', POSITION='$position', EMAIL='$email', EMAILBCC='$emailbcc', PERSONAL_WEBSITE='$personal_website', FNAME='$fname', LNAME='$lname', CELLPHONE='$cellphone', DIRECTLINE='$directline', AGENT_TYPE='$agent_type', LISTVIEW='$listview', LISTSEARCH='$listsearch', LISTSEARCHSHOW='$listsearchshow', LISTACTIVE='$listactive', ACTSTO='$actsto', SOURCEPREF='$sourcepref', SOURCEPREFQUICK='$sourceprefquick', LISTSHAREDC='$listsharedc', PREF_SHOW_LL_HL='$pref_show_ll_hl', LISTSHAREDL='$listsharedl', MLS_TOWN_PREF='$mls_town_pref', USE_VERSION='$use_version', PREF_ADL_VIEW='$pref_adl_view', PREF_AUTO_UPDATE_LANDLORD='$pref_auto_update_landlord', PREF_SHOW_LL_SEARCH='$pref_show_ll_search', BIO='$bio', PREF_ALL_CLIENTS='$pref_all_clients', PREF_SHOW_PENDING_HOTLIST='$pref_show_pending_hotlist', PREF_SHOW_APPT_O='$pref_show_appt_o', PREF_CLIENT_NOTES='$pref_client_notes', FACEBOOK='$facebook', TWITTER='$twitter', MYSPACE='$myspace', LINKEDIN='$linkedin', AVLNEW='$avlnew', SHOWPIC_SIG='$showpic_sig' WHERE UID=$uid";
	
        //echo $quStrEditPrefs; debug amit sharma
        
        $quEditPrefs = mysqli_query($dbh, $quStrEditPrefs);
	$page = "home";
	$msg = "Personal settings saved.";
	$title = "Home";
	$limitN = $user_num_ads;
	
//END editPrefsDo //
?>