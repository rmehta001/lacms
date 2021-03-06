<?php
  	
  	/*///////////////////////////////////////////////////////////////////////////
	//bstapts login routine 2.0.   Copyright 2010 BostonApartments.com //
	//////////////////////////////////////////////////////////////////////////*/
     session_start();
  	
  	
  	session_cache_limiter ('private');
  	$user = trim($PHP_AUTH_USER);
	$pass = trim($PHP_AUTH_PW);

	
	include ("./inc/global.php");
  	include ("./inc/local_info.php");
	mysqli_select_db ($dbh, $DBNAME);




	//Lookup User //
	
	$quStrUsr = "SELECT * FROM USERS INNER JOIN `GROUP` ON USERS.`GROUP`=`GROUP`.GRID WHERE HANDLE='$user'";
	
	$quUsr = mysqli_query($dbh, $quStrUsr);
	$rowUsr = mysqli_fetch_object($quUsr)or die ("can't fetch row");
	
	//RESTRICT IP//
	if ($rowUsr->UID !== $rowUsr->ADMIN) {
		if ($rowUsr->RESTRICT_IP) {
			if ($rowUsr->USER_RESTRICT_IP) {
				$ip = $_SERVER['REMOTE_ADDR'];
				if ($ip !== $rowUsr->IP_ADDRESS) {
					die (error_ip($user));
				}
			}
		}
	}
	
	
	if(!isset($PHP_AUTH_USER)) {
    	header("WWW-Authenticate: Basic realm=\"Boston Apartments Dev\"");
    	header("HTTP/1.0 401 Unauthorized");
    	exit();
	} else {


  		//Register Session Vars  uid,  group, handle, level, perm, isAdmin
		//session_register ("uid");
                $_SESSION['uid'] = $rowUsr->UID; //changed by barkha
		//$uid = $rowUsr->UID;

		//session_register ("grid");
		//$grid = $rowUsr->GRID;
                 $_SESSION['grid'] = $rowUsr->GRID; //changed by Barkha

    //		session_register ("group");
    //		$group = $rowUsr->NAME;
                $_SESSION['group'] = $rowUsr->NAME;//changed by Barkha
                 
                 
//		session_register("agcy");
//		$agcy = $rowUsr->AGENCIES;
                $_SESSION['agcy'] = $rowUsr->AGENCIES;//changed by Barkha

//		session_register("assigned_agency");
//		$assigned_agency = $rowUsr->AGENCY;
                $_SESSION['assigned_agency'] = $rowUsr->AGENCY;
        
		session_register ("abv");
		$abv = $rowUsr->ABV;

                 $_SESSION['handle'] = $rowUsr->HANDLE;
//		session_register ("handle");
		$handle = $user;

		session_register ("level");
		$level = $rowUsr->LEVEL;

		session_register ("email");
		$email = $rowUsr->EMAIL;
		
		session_register ("pass");
		$email = $rowUsr->PASS;
		
		session_register ("maxAct");
		$maxAct = $rowUsr->MAXACT;
		
		session_register("isAdmin");
		if ($rowUsr->ADMIN==$rowUsr->UID) {
			$isAdmin = True;
		}else {
			$isAdmin = False;
		}
		
		session_register("user_num_ads");
		$user_num_ads = $rowUsr->NUM_ADS;
		
		session_register("ip_restrict");
		$ip_restrict = $rowUsr->RESTRICT_IP;
		
		session_register("user_level");
		$user_level = $rowUsr->USER_LEVEL;
		
		session_register("popup_pref");
		$popup_pref = $rowUsr->PREF_POPUP;
		
		session_register("pref_adl_view");
		$pref_adl_view = $rowUsr->PREF_ADL_VIEW;
		
		session_register("pref_auto_update_landlord");
		$pref_auto_update_landlord = $rowUsr->PREF_AUTO_UPDATE_LANDLORD;
		
		session_register("pref_all_clients");
		$pref_all_clients = $rowUsr->PREF_ALL_CLIENTS;		
		
		session_register("listview");
		$listview = $rowUsr->LISTVIEW;

		session_register("listsearch");
		$listsearch = $rowUsr->LISTSEARCH;
		
		session_register("listsearchshow");
		$listsearchshow = $rowUsr->LISTSEARCHSHOW;

		session_register("listactive");
		$listactive = $rowUsr->LISTACTIVE;

		session_register("mls_towns-pref");
		$mls_towns_pref = $rowUsr->MLS_TOWN_PREF;
		
		
		$_SESSION['pref_row_color'];
		$pref_row_color = $rowUsr->PREF_ROW_COLOR;
		
		session_register("pref_pagebg");
		$pref_pagebg = $rowUsr->PREF_PAGEBG_COLOR;

//		session_register("pref_coltit");
//		$pref_coltit = $rowUsr->PREF_COLTIT_COLOR;
                $_SESSION['pref_coltit'] = $rowUsr->PREF_COLTIT_COLOR;
                $pref_coltit = $_SESSION['pref_coltit'];
                
		session_register("pref_topbar");
		$pref_topbar = $rowUsr->PREF_TOPBAR_COLOR;

		session_register("pref_topmenu");
		$pref_topmenu = $rowUsr->PREF_TOPMENU_COLOR;

		session_register("pref_pagetrim");
		$pref_pagetrim = $rowUsr->PREF_PAGETRIM_COLOR;

		session_register("watermark_on");
		$watermark_on = $rowUsr->WATERMARK_ON;
		

		session_register("actsto");
		$actsto = $rowUsr->ACTSTO;

		session_register("sourcepref");
		$sourcepref = $rowUsr->SOURCEPREF;
		
		

		$sid = session_id();
		$now = date ("YmdHis");
		
		$quStrChkSession = "SELECT ID, count(SID) AS COUNTOF FROM SESSIONS WHERE SID='$sid' GROUP BY ID";
		$quChkSession = mysqli_query($dbh, $quStrChkSession) or die ("can't check session   $quStrChkSession");
		$rowChkSession = mysqli_fetch_object ($quChkSession);
		
		if (!$rowChkSession->COUNTOF) { 
			$quStrRecordSession = "INSERT INTO SESSIONS (SID, UID, GRID, TIMEIN) VALUES ('$sid', $uid, $grid, $now)";
		
			$quRecordSession = mysqli_query($dbh, $quStrRecordSession) or die ("can't record session");
			$sidnum = mysqli_insert_id($dbh);
		}else {
			$sidnum = $rowChkSession->ID;
		}
		
		
		$quStrActiveCount = "SELECT count(CID) as myCount FROM CLASS WHERE STATUS='ACT' AND CLI=$grid";
		$quActiveCount = mysqli_query($dbh, $quStrActiveCount) or die ("can't crapped out");
		$rowActiveCount = mysqli_fetch_object ($quActiveCount);
		session_register ("active");
		$active = $rowActiveCount->myCount;
		$use_version = $rowUsr->USE_VERSION;
		if ($user=="eboyer") {
			header("Location: ./admin/");
		}else {
			header("Location: ./clients/AgencyArea$use_version.php");
		}
	
		//Usability session create //
		
		session_register ("usa_req_num");
		session_register ("usa_req_delta_start");
		session_register ("usa_req_delta");
		session_register ("usa_sid_num");
		
		$usa_sid_num = $sidnum;
		$usa_req_num = 0;
		$usa_req_delta_start = time();
		
		
		
	
	}
	

?>
