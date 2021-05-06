<?php
session_start();
include("../inc/global.php");
include("../inc/local_info.php");
$HTTP_GET_VARS = &$_GET;

if (isset($HTTP_GET_VARS['debug'])) {
	error_reporting(E_ALL);
}

		/*///////////////////////////////////////////////////////////////////////////
		//bstapts client interface 1.0. �2002 Chris Hinkle Legacy-Adaptive Systems //
		//////////////////////////////////////////////////////////////////////////*/


//DB CONNECT//
mysqli_select_db ($dbh, "LACMS");
$now = date("Ymd");




//DEFAULT OP VALUE//
if (isset($HTTP_GET_VARS['op'])) {
	$op = $HTTP_GET_VARS['op'];
}else {
	$op = "home";
}

//REQUIRE PROPER SESSION//
if (!$handle) {
	die (dieNice ("You are not correctly logged in or have been logged out.  Please click <a href=\"../\">here</a> to login.", "E-1"));
}

//USABILITY DATA RECORD//
$usa_req_num++;
$usa_req_delta = (time() - $usa_req_delta_start);
$quStrRecordUSA = "INSERT INTO USA (SIDNUM, REQNUM, OP, DELTA, STATUS, MSG) VALUES ('$usa_sid_num', '$usa_req_num', '$op', '$usa_req_delta', '0', '')";
$quRecordUSA = mysqli_query($dbh, $quStrRecordUSA); 
//usa end//



$needOptions = false;
$dontPrintHeader = $HTTP_GET_VARS['dontPrintHeader'];
$scroll_return = $HTTP_GET_VARS['scroll_return'];

session_register ("groupFilterIsSet");
session_register ("groupFilter");
session_register ("sort");
session_register ("sortD");
session_register ("typeFilter");
session_register ("app");
session_register ("start");
session_register ("limitN");
session_register ("userFilter");
session_register ("activeFilter");
session_register ("vid");
session_register ("WHERE");


//DEFAULT SESSION VALUES//



if (!$HTTP_GET_VARS['app']) {
	if (!$app) {
		$app = "home";
	}
} else {
	$app = $HTTP_GET_VARS['app'];
}

if (!$HTTP_GET_VARS['typeFilter']) {
	if (!$typeFilter) {
		$typeFilter = 1;
	}
} else {
	$typeFilter = $HTTP_GET_VARS['typeFilter'];
}

if (!$HTTP_GET_VARS['limitN']) {
	if (!$limitN) {
		$limitN = $user_num_ads;
	}
} else {
	$limitN = $HTTP_GET_VARS['limitN'];
}


if (!$HTTP_GET_VARS['start']) {
	if ($HTTP_GET_VARS['start']=="z") {
		$start = 0;
	}elseif (!$start) {
		$start = 0;
	}
} else {
	$start = $HTTP_GET_VARS['start'];
	if ($start == "z") {
		$start = 0;
	}
}

if (!$HTTP_GET_VARS['userFilter']) {
	if ($HTTP_GET_VARS['userFilter']=="n") {
		$userFilter = false;
	}elseif (!$userFilter) {
		$userFilter = false;
	}
} else {
	$userFilter = $HTTP_GET_VARS['userFilter'];
	if ($userFilter == "n") {
		$userFilter = false;
	}
}

if (!$HTTP_GET_VARS['activeFilter']) {
	if ($HTTP_GET_VARS['activeFilter']=="n") {
		$activeFilter = false;
	}elseif (!$activeFilter) {
		$activeFilter = false;
	}
} else {
	$activeFilter = $HTTP_GET_VARS['activeFilter'];
	if ($activeFilter == "n") {
		$activeFilter = false;
	}
}


if (!$HTTP_GET_VARS['vid']) {
	if (!$vid) {
		$vid = 1; //$default_vid;
	}
} else {
	$vid = $HTTP_GET_VARS['vid'];
}





//Where builder //
$userFilterStr = ($userFilter) ? " AND CLASS.UID=$uid " : " ";
$activeFilterStr = ($activeFilter) ? " AND CLASS.STATUS='ACT' " : " ";

if ($op=="listings") {
	//FILTERS (WHERE CLAUSE)//
	if ($_POST['filterChange']) {	
		
		$bbbmonth = $_POST['bbbmonth'];
		$bbbday = $_POST['bbbday'];
		$bbbyear = $_POST['bbbyear'];
		$bbemonth = $_POST['bbemonth'];
		$bbeday = $_POST['bbeday'];
		$bbeyear = $_POST['bbeyear'];
		
		$begin_date = $bbbyear ."-". $bbbmonth ."-". $bbbday;
		$end_date = $bbeyear ."-". $bbemonth ."-". $bbeday;
		
		
		$preFilters = array();
		$preFilters[1] = array($_POST['type'], "CLASS.TYPE", "=", "Type");
		$preFilters[2] = array($_POST['loc'], "LOC.LOCID", "=", "Location");
		$preFilters[3] = ($_POST['priceStart'][0]) ? array($_POST['priceStart'], "PRICE", ">=", "Price Min") : "";
		$preFilters[4] = ($_POST['priceEnd'][0]) ? array($_POST['priceEnd'], "PRICE", "<=", "Price Max") : "";
		$preFilters[5] = array($_POST['rooms'], "ROOMS", "=", "Bedrooms");
		$preFilters[6] = array($_POST['bath'], "BATH", "=", "Bathrooms");
		$preFilters[7] = array($_POST['pets'], "PETSA", "=", "Pets");
		$preFilters[8] = ($_POST['status'][0]) ? array($_POST['status'], "CLASS.STATUS", "=", "Advertising") : "";
		$preFilters[9] = ($_POST['status_vacant'][0]) ? array($_POST['status_vacant'], "STATUS_VACANT", "=", "Vacant") : "";
		$preFilters[10] = ($_POST['status_active'][0]) ? array($_POST['status_active'], "STATUS_ACTIVE", "=", "Active") : "";
		$preFilters[11] = array($begin_date, "CLASS.AVAIL", ">", "Available begin date");
		$preFilters[12] = array($end_date, "CLASS.AVAIL", "<", "Available end date");
		
		
		$filters = array();
		$i = 0;
		foreach ($preFilters as $preFilter) {
			if ($preFilter[0]) {
				if (is_array($preFilter[0])) {
					$tempArr = $preFilter[0];
					$numTempArr = count($tempArr);
					$tempStr .= "(";
					foreach ($tempArr as $key => $value) {
						if ($preFilter[1] == "PRICE") {
							if ($preFilter[2] == ">=") {
								$value-=150;
							}else {
								$value+=150;
							}
						}
						$tempStr.= " $preFilter[1]$preFilter[2]'$value' ";
						if ($key < ($numTempArr-1)) {
							$tempStr.= " OR ";
						}
					}
					$tempStr .= ")";
					$filters[$i] = $tempStr;
					
					$tempStr = "";
					$i++;
				}else{
					$filters[$i] = " ($preFilter[1]$preFilter[2]'$preFilter[0]') ";
					$i++;
				}
			}
		}
		
		
		$numFilters = count($filters);
		
		switch ($numFilters) {
			case 0:
				$WHERE = " WHERE CLI='$grid' ";
				break;
			case 1:
				$WHERE = " WHERE " . $filters[0] . " AND CLI='$grid' ";
				break;
			default:
				$WHERE = " WHERE ";
				for ($i=0;$i<=($numFilters-1);$i++) {
					$WHERE .= $filters[$i] . " AND ";
				}
				$WHERE .= " CLI='$grid' ";
				break;
		}
	}else {
		if ($_POST['clear_filter']) {
			$WHERE = " WHERE CLI='$grid' ";
		}
	}
}elseif ($op=="sel" || $op=="app_sel") {
	$WHERE = "WHERE CLI=$grid AND TYPES.TYPE=$typeFilter $userFilterStr $activeFilterStr";
}

if (!$WHERE) {
	$WHERE = " WHERE CLI='$grid' ";
}





//Sort section //




if (!$HTTP_GET_VARS['sortD']) {
	if (!$sortD) {
		$sortD = "ASC";
	}
} else {
	$sortD = $HTTP_GET_VARS['sortD'];
}



if (!$HTTP_GET_VARS['sort']) {
	if (!$sort) {
		$sort = "LOCNAME";
	}
} else {
	$sort = $HTTP_GET_VARS['sort'];
}

$antiSortD = ($sortD=="ASC") ? "DESC" : "ASC";

$ORDERBY = " ORDER BY $sort $sortD ";

$LISTINGS_ORDERBY = " ORDER BY $sort $sortD, LOCNAME, AVAIL, ROOMS, PRICE  ";

$LIMIT = " LIMIT $start, $limitN ";


//DEFINED VALUE SETS //
$quStrGetValueDefs = "SELECT * FROM VALUE_DEFINE";
$quGetValueDefs = mysqli_query($dbh, $quStrGetValueDefs);

while ($rowGetValueDefs = mysqli_fetch_object($quGetValueDefs)) {
	$string = $rowGetValueDefs->DEFINE;
	$values = split (",", $string);
	foreach ($values as $key => $value) {
		$values2[$key] = split ("_", $value);
	}
	foreach ($values2 as $values3) {
		$offset = $values3[0];
		$DEFINED_VALUE_SETS[$rowGetValueDefs->CLASS_NAME][$offset] = $values3[1];
	}
	
	$string = false;
	$values = false;
	$values2 = false;
	$values3 = false;
	$offset = false;
	
	
}




//OPERATIONS SWITCH --- APPLICATION LAYER//
if ($op=="home") {
	$app = "home";
	$now = date("Ymd");
	$page="home";
	$needOptions = true;
	$title = "Home";
}elseif ($op=="app_sel") {
	$app_sel = "ads";
	$typeFilter = $HTTP_GET_VARS['typeFilter'];
	//$op = "sel"; 
	$app = "ad";
	$page = "sel";
	$disData = "ads";
	$title = "Selected";
	$msg = "Ads selected,  operate from here.";
	$needOptions = true;
	
}elseif ($op=="sel") {
	$app = "ad";
	$page = "sel";
	$disData = "ads";
	$title = "Selected";
	$msg = "Ads selected,  operate from here.";
	$needOptions = true;
}elseif ($op=="edit") {
	$app = "ad";
	$appLink = "sel";
	$cid = $HTTP_GET_VARS['cid'];
	$page= ($popup_pref) ? "popup_edit" : "edit";
	if (!$dontPrintHeader) {
		$dontPrintHeader = ($popup_pref) ? true : false;
	}
	$disData="ad";
	$needOptions = true;
	$msg = "Make Changes, or deactivate ad.";
	$title = "Edit Ad";
} elseif ($op=="editDo") {

	$cid=$_POST['cid'];
	$body= prepareAdBody($_POST['body'], 0);
	$loc=$_POST['loc'];
	$type =$_POST['type'];
	$street = $_POST['street'];
	$apt = $_POST['apt'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$nofee = $_POST['nofee'];
	$now = date("Ymd");
	$use_user_sig = $_POST['use_user_sig'];
	$landlord = $_POST['landlord'];
	if ($landlord=="--") {
		$landlord = 0;
	}	
	if (!$nofee) {
		$nofee = 0;
	}
	$aMonth = $_POST['aMonth'];
	$aDay   = $_POST['aDay'];
	$aYear  = $_POST['aYear'];
	if ($aMonth !== "--" && $aDay !== "--" && $aYear !== "--") {
		$avail = $aYear.$aMonth.$aDay;
	} else {
		$avail = 0;
	}
	$price = $_POST['price'];	
	$priceA = preg_split ("[\D]", $price);
	$countPrice = count($priceA);
	$own_uid = $_POST['own_uid'];
	switch ($countPrice) {
		case 1:
			$price = $priceA[0];
			break;
		default:
			$price = $priceA[0];
			for ($i=1;$i<=$countPrice;$i++) {
				$price.= $priceA[$i];
			}
	}
	
	
	if (!$price) {
		$price = 0;
	}
	$rooms = $_POST['rooms'];
	if ($rooms=="--") {
		$rooms = 0;
	}
	$bath = $_POST['bath'];
	if ($bath=="--") {
		$bath = 0;
	}
	
	$quStrCheckAd = "SELECT SAFETY FROM CLASS WHERE CID=$cid";
	
	$quCheckAd = mysqli_query($dbh, $quStrCheckAd) or die (dieNice ("Sorry,  couldn't lookup that ad.", "E-100"));
	$rowCheckAd = mysqli_fetch_object ($quCheckAd);
	if ($rowCheckAd->SAFETY) {
		$page = "safetyerr";
		$msg = "Error,  the ad is locked for editing";
		$title = "Can't Edit";
	} else {

		$quStrUpdateAd = ($isAdmin) ? "UPDATE CLASS SET BODY='$body', TYPE=$type, LOC='$loc', MOD=$now, MODBY='$handle',  NOFEE=$nofee, AVAIL=$avail, PRICE=$price, STREET='$street', APT='$apt', CITY='$city', STATE='$state', ZIP='$zip', USE_USER_SIG=$use_user_sig, LANDLORD=$landlord, ROOMS=$rooms, BATH=$bath, UID=$own_uid WHERE CID=$cid AND CLI=$grid" : "UPDATE CLASS SET BODY='$body', TYPE=$type, LOC='$loc', MOD=$now, MODBY='$handle',  NOFEE=$nofee, AVAIL=$avail, PRICE=$price, STREET='$street', APT='$apt', CITY='$city', STATE='$state', ZIP='$zip', USE_USER_SIG=$use_user_sig, LANDLORD=$landlord, ROOMS=$rooms, BATH=$bath WHERE CID=$cid AND CLI=$grid";
		$quUpdateAd = mysqli_query($dbh, $quStrUpdateAd) or die (dieNice ("Sorry,  couldn't update the ad.", "E-101"));
	
		if ($popup_pref) {
			$page = "window_close";
			$dontPrintHeader = true;
		}else {
			$page = "sel";
		}
		$title = "Selected";
		$disData="ads";
		$msg = "Changes saved to database.";
	}
}elseif ($op=="delete") {
	$cid = $HTTP_GET_VARS['cid'];
	$page = "delete";
	$disData = "ad";
	$title = "Delete Ad Confirmation";
	$msg = "Are you sure you want to delete this ad?";
}elseif ($op=="deleteDo") {
	$cid = $_POST['cid'];
	$conf = $_POST['conf'];
	if ($conf=="y" || $conf=="Y") {
		$quStrDelAd = "DELETE FROM CLASS WHERE CID=$cid AND CLI=$grid";
		$quDelAd = mysqli_query($dbh, $quStrDelAd) or die (dieNice("Sorry, couldn't delete that ad", "E-102"));
		$quStrGetPics = "SELECT PID, EXT FROM PICTURE WHERE CID=$cid";
		$quGetPics = mysqli_query($dbh, $quStrGetPics);
		while ($rowGetPics = mysqli_fetch_object($quGetPics)) {
			unlink ("../pics/$rowGetPics->PID.$rowGetPics->EXT");
		}
		$quStrDelPics = "DELETE FROM PICTURE WHERE CID=$cid";
		$quDelPics = mysqli_query($dbh, $quStrDelPics) or die (dieNice ("Sorry, couldn't delete the picture(s)", "E-103"));
		$page = "sel";
		$disData = "ads";
		$title = "Selected";
		$msg = "Ad deleted.";

	}else {
		$page = "delete";
		$title = "Delete Ad Confirmation";
		$disData = "ad";
		$msg = "Ad not deleted,  you must type 'yes' to comfirm.";
	}
}elseif ($op=="compose") {
	$page = "compose";
	$needOptions = true;
	$title = "Compose";
	$msg = "Compose a new ad.";
}elseif ($op=="add") {
	$body= prepareAdBody($_POST['body'], 0);
	$loc=$_POST['loc'];
	$type = $_POST['type'];
	$street = $_POST['street'];
	$apt = $_POST['apt'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$aMonth = $_POST['aMonth'];
	$aDay   = $_POST['aDay'];
	$aYear  = $_POST['aYear'];
	if ($aMonth !== "--" && $aDay !== "--" && $aYear !== "--") {
		$avail = $aYear.$aMonth.$aDay;
	} else {
		$avail = 0;
	}
	$price = $_POST['price'];	
	$priceA = preg_split ("[\D]", $price);
	$countPrice = count($priceA);
	
	switch ($countPrice) {
		case 1:
			$price = $priceA[0];
			break;
		default:
			$price = $priceA[0];
			for ($i=1;$i<=$countPrice;$i++) {
				$price.= $priceA[$i];
			}
	}
	
	
	if (!$price) {
		$price = 0;
	}
	$noFee = $_POST['noFee'];
	if (!$noFee) {
		$noFee = 0;
	}
	$upload = $_POST['upload'];
	$use_user_sig = $_POST['use_user_sig'];
	$landlord = $_POST['landlord'];
	if ($landlord == "--") {
		$landlord = 0;
	}
	$rooms = $_POST['rooms'];
	if ($rooms=="--") {
		$rooms = 0;
	}
	$bath = $_POST['bath'];
	if ($bath=="--") {
		$bath = 0;
	}
	if ($body!=="") {
		
		$quStrCountActive = "SELECT count(CID) AS ACTIVECOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid'";
		$quCountActive = mysqli_query($dbh, $quStrCountActive);
		$rowCountActive= mysqli_fetch_object ($quCountActive);
		if ($rowCountActive->ACTIVECOUNT < $maxAct) {
			$now = date("Ymd");
			$quStrInsAd = "INSERT INTO CLASS (BODY, STATUS, LOC, UID, CLI, DATEIN, MOD, TYPE, NOFEE, AVAIL, PRICE, STREET, APT, CITY, STATE, ZIP, USE_USER_SIG, LANDLORD, ROOMS, BATH ) VALUES ('$body', 'ACT', '$loc', $uid, $grid, $now, $now, $type, $noFee, $avail, $price, '$street', '$apt', '$city', '$state', '$zip', $use_user_sig, $landlord, $rooms, $bath)";
			$quInsAd = mysqli_query($dbh, $quStrInsAd) or die (dieNice ("Sorry, couldn't insert that ad.", "E-104"));
			if ($upload) {
				
				$cid = mysqli_insert_id($dbh);
				$title = "Upload Picture";
				$msg = "New Ad Created,  $cid,  upload pics here.";
				$page = "upload";
			}else {
				$page = "sel";
				$disData = "ads";
				$title = "Home";
				$msg = "New ad created.";
				$needOptions = true;
                	}
                }else { // MAKE STATUS=STO
                	$now = date("Ymd");
			$quStrInsAd = "INSERT INTO CLASS (BODY, STATUS, LOC, UID, CLI, DATEIN, MOD, TYPE, NOFEE, AVAIL, PRICE, STREET, APT, CITY, STATE, ZIP, USE_USER_SIG, LANDLORD, ROOMS ) VALUES ('$body', 'STO', '$loc', $uid, $grid, $now, $now, $type, $noFee, $avail, $price, '$street', '$apt', '$city', '$state', '$zip', $use_user_sig, $landlord, $rooms)";
			$quInsAd = mysqli_query($dbh, $quStrInsAd) or die (dieNice ("Sorry, couldn't insert that ad.", "E-104"));
			if ($upload) {
				
				$cid = mysqli_insert_id($dbh);
				$title = "Upload Picture";
				$msg = "New Ad Created, but not active (Maximum number active ads exceeded),  $cid,  upload pics here.";
				$page = "upload";
			}else {
				$page = "sel";
				$disData = "ads";
				$title = "Home";
				$msg = "New ad created, but not active (Maximum number active ads exceeded), you must Deactivate an before you can activate this one.";
				$needOptions = true;
                	}
                }
	}else {         
		$page = "compose";
		$title = "Compose";
		$msg = "Please fill out the form completley";
	}               
}elseif ($op=="upload") {
	$cid = $HTTP_GET_VARS['cid'];
	$page = "upload";
	$title = "Upload Picture";
	$msg = "upload pictures for ad $cid.";
}elseif ($op=="uploadDo") {
	$mime = trim($userfile_type);
	$cid = $_POST['cid'];
	$desc = strip_tags($_POST['desc']);
	                
	$fileNameSplit = split ("\.", $userfile_name);
	
	$ext = $fileNameSplit[1];
		

	
	//switch ($userfile_type) {
	//case "image/gif" :
	//	$ext = "gif";
	//	break;
	//case "image/pjpeg" :
	//	$ext = "jpeg";
	//	break;
	//default:
	//	$ext = "jpeg";
	//	break;
	//}
	if ($ext=="jpg" | $ext=="gif" | $ext=="jpeg" | $ext=="png" | $ext=="JPG" | $ext=="GIF" | $ext=="JPEG" | $ext=="PNG")  {
		$quStrAddPic = "INSERT INTO PICTURE (CID, EXT, DESCRIPT, UID) VALUES ($cid , '$ext', '$desc', $uid)";
		$quAddPic = mysqli_query($dbh, $quStrAddPic) or die ("insert picture query failed");
		$newPid = mysqli_insert_id($dbh);
		$quStrUpClass = "UPDATE CLASS SET PIC=PIC+1 WHERE CID=$cid";
		$quUpClass = mysqli_query($dbh, $quStrUpClass) or die ("can't update class");
		$newFileName = "$picsDirectory/$newPid.$ext";
	
		move_uploaded_file($userfile, $newFileName) or die (dieNice ("Your Picture has not been uploaded,  please try resizing (&lt;2mb) and be sure to use a proper extension (.jpg, .gif)", "E-5000"));
		$pid = $newPid;
		$page = "editPic";
		$title = "Edit Picture";
		$disData = "pic";
		$msg = "New Picture Uploaded.";
	}else {
		$page = "uploadError";
		$msg = "Your picture has not been uploaded.";
	}
}elseif ($op=="managePics") {
	$cid = $HTTP_GET_VARS['cid'];
	$page = "managePics";
	$title = "Manage Pictures";
	$disData = "pics";
	$msg = "Manage Pictures for ad $abv-$cid.";
}elseif ($op=="editPic") {
	$pid = $HTTP_GET_VARS['pid'];
	$cid = $HTTP_GET_VARS['cid'];
	$page = "editPic";
	$title = "Edit Picture";
	$disData = "pic";
	$msg = "Edit picture description here.";
}elseif ($op=="editPicDo") {
	$pid = $_POST['pid'];
	$cid = $_POST['cid'];
	$another = $_POST['another'];
	$desc = $_POST['desc'];
	$quStrUpdatePic = "UPDATE PICTURE SET DESCRIPT='$desc' WHERE PID=$pid";
	$quUpdatePic = mysqli_query($dbh, $quStrUpdatePic) or die (dieNice("Sorry, couldn't update picture record.", "E-108"));
	if ($another) {
		$page = "upload";
		$title = "Upload Picture";
		$msg = "Upload another pic for ad # $cid";
	}else {
		$page = "managePics";
		$title = "Manage Pictures";
		$disData = "pics";
		$msg = "Picture Info updated.";
	}


}elseif ($op=="deletePic") {
	$pid = $HTTP_GET_VARS['pid'];
	$cid = $HTTP_GET_VARS['cid'];
	$page = "deletePic";
	$title = "Delete Picture Confirmation";
	$disData = "pic";
	$msg = "Are you sure you want to delete this picture?";
}elseif ($op=="deletePicDo" ) {
	$pid = $_POST['pid'];
	$cid = $_POST['cid'];
	$conf = $_POST['conf'];
	$ext = $_POST['ext'];
	if ($conf=="y") {
		$quStrDeletePic = "DELETE FROM PICTURE WHERE PID=$pid";
		$quDeletePic = mysqli_query($dbh, $quStrDeletePic) or die (dieNice ("Sorry, couldn't delete picture record.", "E-109"));
		$quStrUpdateAd = "UPDATE CLASS SET PIC=PIC-1 WHERE CID=$cid AND CLI=$grid";
		$quUpdateAd = mysqli_query($dbh, $quStrUpdateAd) or die (dieNice ("Sorry, couldn't unlink the picture from the ad, contact tech suppor with details.", "E-110"));
		$picture = "$picsDirectory/$pid.$ext";
		unlink ($picture) or die (dieNice ("Sorry, couldn't erase the picture from memory.", "E-111"));
		$page = "managePics";
		$disData = "pics";
		$msg = "Picture Deleted.";
	}else {
		$page = "deletePic";
		$disData = "pic";
		$title = "Delete Picture Confirmation";
		$msg = "Picture not deleted,  you must type 'yes' to confirm";
	}
}elseif ($op=="changePassword") {
	$page = "changePassword";
	$title = "Change Password";
	$msg = "Change your password here.";
}elseif ($op=="changePasswordDo") {
	$oldPass = $_POST['oldPass'];
	$newPass = $_POST['newPass'];
	$newPassConf = $_POST['newPassConf'];
	if ($oldPass==$pass) {
		if ($newPass==$newPassConf) {
			$quStrUpdateUser = "UPDATE USERS SET PASS='$newPass' WHERE UID=$uid AND `GROUP`=$grid";
			$quUpdateUser = mysqli_query($dbh, $quStrUpdateUser) or die (dieNice("Sorry, couldn't update your pass word.", "E-112"));
			$pw = new PwFile($PASSWORD_FILE);
			$usr_ID = $handle;
			$usr_passwd = $newPass;
			$pw->updateUser($usr_ID, $usr_passwd);
			$page = "home";
			$disData = "ads";
			$msg = "Password Changed";
		}else {
			$page = "changePassword";
			$msg = "Passwords do not match,  please try again.";
		}
	}else {
		$page = "changePassword";
		$msg = "Password incorrect password,  please try again.";
	}
}elseif ($op=="activate") {
		
		$cid = $HTTP_GET_VARS['cid'];
		$quStrCountActive = "SELECT count(CID) AS ACTIVECOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid'";
		$quCountActive = mysqli_query($dbh, $quStrCountActive);
		$rowCountActive= mysqli_fetch_object ($quCountActive);
		if ($rowCountActive->ACTIVECOUNT <= $maxAct) {
			$quStrUpdateAd = "UPDATE CLASS SET STATUS='ACT' WHERE CID=$cid AND CLI=$grid";
			$quUpdateAd = mysqli_query($dbh, $quStrUpdateAd) or die (dieNice ("Sorry, Couldn't update ad.", "E-113"));
			$page = "sel";
			$title = "Selected";
			$disData = "ads";
			$msg = "Ad $cid activated.";
		}else {
			$page = "sel";
			$title = "Selected";
			$disData = "ads";
			$msg = "Ad $cid activated not activated,  maximum number ($maxAct) of active ads exceeded. You must deactivate " . ($rowCountActive->ACTIVECOUNT-$maxAct) . " ad(s) first to activate this one.";
		}

}elseif ($op=="deactivate") {

	$cid = $HTTP_GET_VARS['cid'];
	$quStrUpdateAd = "UPDATE CLASS SET STATUS='STO' WHERE CID=$cid AND CLI=$grid";;
	$quUpdateAd = mysqli_query($dbh, $quStrUpdateAd) or die (dieNice ("Sorry, Couldn't update ad.", "E-114"));
	$page = "sel";
	$title = "Selected";
	$disData = "ads";
	$msg = "Ad $cid deactivated.";

}elseif ($op=="myInfo") {
	$page = "myInfo";
	$msg = "Information for $group";
	$title = "Info";
}elseif ($op=="select_and_do") {
	$sop = $_POST['sop'];
	$sel_ids = $_POST['sel_ids'];
	
	$numIDs = count($sel_ids);

	switch ($numIDs) {
		case 0:
			$selWHERE = " WHERE 1=2";
			break;
		case 1: $selWHERE = " WHERE CID=$sel_ids[0] AND CLI=$grid";
			break;
		default:
			$selWHERE = " WHERE CID=$sel_ids[0]";
			for ($i=1;$i<$numIDs;$i++){
				$string2Cat.= " OR CID=$sel_ids[$i] ";
			}
			$string2Cat.= " AND CLI=$grid ";
			$selWHERE.= $string2Cat;
		}
	if ($sop=="delete") {
		if (!$numIDs) {
			$page = "sel";
			$disData = "ads";
			$msg = "No action taken,  no ads selected.";
			$title = "Selected";
		} else {			
			$page = "select_and_delete";
			$msg = "Please confirm the deletion of $numIDs ad(s).";
			$title = "Select and Delete";
		}
	}elseif ($sop=="deactivate") {
		$quStrSelAndDo = "UPDATE CLASS SET STATUS='STO' $selWHERE";
		if ($debug) {echo $quStrSelAndDo; }
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die (dieNice ("can't multi update", "E-126"));
		$page = "sel";
		$disData = "ads";
		$msg = "$numIDs ad(s) deactivated.";
		$title = "Selected";
	}elseif ($sop=="activate") {
		$quStrCountActive = "SELECT count(CID) AS ACTIVECOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid'";
		$quCountActive = mysqli_query($dbh, $quStrCountActive);
		$rowCountActive= mysqli_fetch_object ($quCountActive);
		if ($rowCountActive->ACTIVECOUNT <= $maxAct) {
			$quStrSelAndDo = "UPDATE CLASS SET STATUS='ACT' $selWHERE";
			$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die("can't muli update");
			$page = "sel";
			$disData = "ads";
			$msg = "$numIDs ad(s) activated.";
			$title = "Selected";
		} else {
			$page = "sel";
			$disData = "ads";
			$msg = "$numIDs ad(s) not activated. Maximum number ($maxAct) of active ads exceeded.  You must deactivate " . ($rowCountActive->ACTIVECOUNT-$maxAct) ." ad(s) before you can activate these $numIDs.";
			$title = "Selected";
		}
	}elseif ($sop=="nofee") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=1 $selWHERE";
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die("can't muli update");
		$page = "sel";
		$msg = "$numIDs ad(s) switched to 'NO FEE'.";
		$disData = "ads";
		$title = "Selected";
	}elseif ($sop=="fee") {
		$quStrSelAndDo = "UPDATE CLASS SET NOFEE=0 $selWHERE";
		$quSelAndDo = mysqli_query($dbh, $quStrSelAndDo) or die("can't muli update");
		$page = "sel";
		$msg = "$numIDs ad(s) 'NO FEE' value negated.";
		$disData = "ads";
		$title = "Selected";
	}
	$needOptions = true;
}elseif ($op=="select_and_deleteDO") {
	$sel_ids = $_POST['sel_ids'];
	$conf = $_POST['conf'];
	$numIDs = count($sel_ids);

	switch ($numIDs) {
		case 0:
			$selWHERE = " WHERE 1=2";
			break;
		case 1: $selWHERE = " WHERE CID=$sel_ids[0]";
			break;
		default:
			$selWHERE = " WHERE CID=$sel_ids[0]";
			for ($i=1;$i<$numIDs;$i++){
				$string2Cat.= " OR CID=$sel_ids[$i] ";
			}
			$string2Cat.=" AND CLI=$grid ";
			$selWHERE.= $string2Cat;
	}
	if ($conf=='y') {
		$quStrSelAndDel = "DELETE FROM CLASS $selWHERE";
		$quSelAndDel = mysqli_query($dbh, $quStrSelAndDel) or die (dieNice ("Sorry, Multi-delete failed.", "E-116"));
		$page = "sel";
		
		$disData = "ads";
		$msg = "$numIDs ad(s) deleted.";
		$title = "Selected";
	}else {
		$page = "select_and_delete";
		$msg = "No action taken,  please type 'y'";
		$title = "Select and Delete";
	}
	
}elseif ($op=="editPrefs") {
	$page = "editPrefs";
	$msg = "Edit your personal preferences here.";
	$title = "Edit Preferences";
	$app = "home";
	$disData = "user";
}elseif ($op=="editPrefsDo") {
	$user_num_ads = $_POST['num_ads'];
	if (!$user_num_ads) {
		$user_num_ads = 10;
	}
	$user_sig = prepareAdBody($_POST['user_sig'], 0);
	$pref_popup = $_POST['pref_popup'];
	$use_version = $_POST['use_version'];
	
	$quStrEditPrefs = "UPDATE USERS SET NUM_ADS=$user_num_ads, USER_SIG='$user_sig', PREF_POPUP='$pref_popup', USE_VERSION='$use_version' WHERE UID=$uid";
	$quEditPrefs = mysqli_query($dbh, $quStrEditPrefs);
	$page = "home";
	$msg = "Personal settings saved.";
	$title = "Home";
	$limitN = $user_num_ads;
}elseif ($op=="manageLandlord") {
	$app = "home";
	$appLink = "home";
	$page = "manageLandlord";
	$msg = "Manage, edit and create landlord records here.";
	$title = "Manage Landlords";
	$needOptions = true;
}elseif ($op=="createLandlord") {
	$page = "createLandlord";
	$msg = "Create new Landlord record here.";
	$title = "Create Landlord";
}elseif ($op=="createLandlordDo") {
	$short_name  = $_POST['short_name'];
	$home_name_first = $_POST['home_name_first'];
	$home_name_last = $_POST['home_name_last'];
	$home_street = $_POST['home_street'];
	$home_city   = $_POST['home_city'];
	$home_state  = $_POST['home_state']; 
	$home_zip    = $_POST['home_zip'];
	$home_phone  = $_POST['home_phone']; 
	$home_fax    = $_POST['home_fax'];
	$off_name    = $_POST['off_name'];
	$off_street  = $_POST['off_street']; 
	$off_city    = $_POST['off_city'];
	$off_state   = $_POST['off_state'];  
	$off_zip     = $_POST['off_zip'];
	$off_phone   = $_POST['off_phone'];
	$off_fax     = $_POST['off_fax'];
	$addendum    = $_POST['addendum'];   
	$llnotes       = $_POST['llnotes'];
	$pets        = $_POST['pets'];     

	$quStrCreateLandlord = "INSERT INTO LANDLORD (GRID, SHORT_NAME, HOME_NAME_FIRST, HOME_NAME_LAST, HOME_STREET, HOME_CITY, HOME_STATE, HOME_ZIP, HOME_PHONE, HOME_FAX, OFF_NAME, OFF_STREET, OFF_CITY, OFF_STATE, OFF_ZIP, OFF_PHONE, OFF_FAX, ADDENDUM, LLNOTES, PETS) VALUES ($grid, '$short_name', '$home_name_first', '$home_name_last', '$home_street', '$home_city', '$home_state', '$home_zip', '$home_phone', '$home_fax', '$off_name', '$off_street', '$off_city', '$off_state', '$off_zip', '$off_phone', '$off_fax', '$addendum', '$llnotes', '$pets')";
	
	$quCreateLandlord = mysqli_query($dbh, $quStrCreateLandlord) or die (dieNice("Sorry,  couldn't create landlord record.", "E-7000"));
	
	$page = "manageLandlord";
	$needOptions = true;
	$msg = "New landlord record, $short_name, created.";
	$title = "Manage Landlords";
}elseif ($op=="editLandlord") {
	$lid = $HTTP_GET_VARS['lid'];
	$quStrGetLandLord = "SELECT * FROM LANDLORD WHERE LID=$lid AND GRID=$grid";
	$quGetLandlord = mysqli_query($dbh, $quStrGetLandLord) or die(dieNice("Sorry,  couldn't find that landord", "E-8000"));
	$rowGetLandlord = mysqli_fetch_object($quGetLandlord);
	$page = "editLandlord";
	$msg = "Edit landlord info here.";
	$title = "Edit Landlord";
}elseif ($op=="editLandlordDo") { 
	$lid = $_POST['lid'];
	$short_name  = $_POST['short_name'];
	$home_name_first   = $_POST['home_name_first'];
	$home_name_last   = $_POST['home_name_last'];
	$home_street = $_POST['home_street'];
	$home_city   = $_POST['home_city'];
	$home_state  = $_POST['home_state']; 
	$home_zip    = $_POST['home_zip'];
	$home_phone  = $_POST['home_phone']; 
	$home_fax    = $_POST['home_fax'];
	$off_name    = $_POST['off_name'];
	$off_street  = $_POST['off_street']; 
	$off_city    = $_POST['off_city'];
	$off_state   = $_POST['off_state'];  
	$off_zip     = $_POST['off_zip'];
	$off_phone   = $_POST['off_phone'];
	$off_fax     = $_POST['off_fax'];
	$addendum    = $_POST['addendum'];   
	$llnotes       = $_POST['llnotes'];
	$pets        = $_POST['pets'];  
	
	$quStrUpdateLandlord = "UPDATE LANDLORD SET SHORT_NAME='$short_name', HOME_NAME_FIRST='$home_name_first', HOME_NAME_LAST='$home_name_last', HOME_STREET='$home_street', HOME_CITY='$home_city', HOME_STATE='$home_state', HOME_ZIP='$home_zip', HOME_PHONE='$home_phone', HOME_FAX='$home_fax', OFF_NAME='$off_name', OFF_STREET='$off_street', OFF_CITY='$off_city', OFF_STATE='$off_state', OFF_ZIP='$off_zip', OFF_PHONE='$off_phone', OFF_FAX='$off_fax', ADDENDUM='$addendum', LLNOTES='$llnotes', PETS='$pets' WHERE LID=$lid AND GRID=$grid";
	$quUpdateLandlord = mysqli_query($dbh, $quStrUpdateLandlord) or die (dieNice("Sorry,  couldn't update that landlord record", "E-8001"));

	$page = "manageLandlord";
	$msg = "Changes saved to database";
	$needOptions = true;
	$title = "Manage Landlord";
}elseif ($op=="deleteLandlord") {
	$lid = $HTTP_GET_VARS['lid'];
	$quStrGetLL = "SELECT * FROM LANDLORD WHERE LID=$lid";
	$quGetLL = mysqli_query($dbh, $quStrGetLL) or die (dieNice ("Sorry,  Couldn't find that landlord.", "E-7005"));
	$rowGetLL = mysqli_fetch_object($quGetLL);
	$page = "deleteLandlord";
	$msg = "Are you sure you want to delete this landlord record?";
	$title = "Delete Landlord";
}elseif ($op=="deleteLandlordDo") {
	$lid = $_POST['lid'];
	$conf = $_POST['conf'];
	if ($conf=="y" || $conf=="Y") {
		$quStrUpdateClass = "UPDATE CLASS SET LANDLORD=0 WHERE LANDLORD=$lid";
		$quUpdateClass = mysqli_query($dbh, $quStrUpdateClass);
		$quStrDeleteLandlord = "DELETE FROM LANDLORD WHERE LID=$lid";
		$quDeleteLandlord = mysqli_query($dbh, $quStrDeleteLandlord);
		$page = "manageLandlord";
		$needOptions = true;
		$msg = "Landlord deleted.";
	}else {
		$page = "deleteLandlord";
		$msg = "Please type 'y' to confirm,  no action taken.";
	}
}elseif ($op=="manageUsers") {
	if (!$isAdmin) {
		die (dieNice("Sorry,  you are not the admin user.", "E-10000"));
	}
	$page = "manageUsers";
	$msg = "Create and Terminate agents here.";
	$title = "Manage Agents";
	$needOptions = true;
}elseif ($op=="createUser") {
	if (!$isAdmin) {
		die (dieNice("Sorry,  you are not the admin user.", "E-10000"));
	}
	$page = "createUser";
	$msg = "Create a new agent here.";
	$title = "Create User";
}elseif ($op=="createUserDo") { 
	if (!$isAdmin) {
		die (dieNice("Sorry,  you are not the admin user.", "E-10000"));
	}
	$new_handle = $_POST['new_handle'];
	$new_passwd = $_POST['new_passwd'];
	$conf_new_passwd = $_POST['conf_new_passwd'];
	$new_email = $_POST['new_email'];
	
	if ($new_passwd !== $conf_new_passwd) {
		$page = "createUser";
		$msg = "Passwords did not match,  please try again";
		$title = "Create User";
	}else {
		$quStrInsUser = "INSERT INTO USERS (`GROUP`, HANDLE, PASS, EMAIL) VALUES ($grid, '$new_handle', '$new_passwd', '$new_email')";
		
		$quInsUser = mysqli_query($dbh, $quStrInsUser);
		if (!$quInsUser) {
			$page = "createUser";
			$msg = "Sorry, that name is already taken";
			$title = "Create User";
		}else {
			$pw = new PwFile($PASSWORD_FILE);
			$usr_ID = $new_handle;
			$usr_passwd = $new_passwd;
			$pw->addUser($usr_ID, $usr_passwd);
			$page = "manageUsers";
			$msg = "New user, $new_handle, created.";
			$title = "Manage Agents";
			$needOptions = true;
		}
	}
}elseif ($op=="termUser") {
	if (!$isAdmin) {
		die (dieNice("You are not the admin user.", "E-1"));
	}
	$term_uid = $HTTP_GET_VARS['uid'];
	$quStrGetUser = "SELECT * FROM USERS WHERE UID=$term_uid";
	$quGetUser = mysqli_query($dbh, $quStrGetUser);
	$rowGetUser = mysqli_fetch_object($quGetUser);
	$page = "termUser";
	$msg = "Terminate user: deny access to the system, remove from database, and transfer ads to another user.";
	$title = "Terminate User";
	$needOptions = true;
}elseif ($op=="termUserDo") {
	if (!$isAdmin) {
		die (dieNice("You are not the admin user.", "E-1"));
	}
	$term_uid = $_POST['term_uid'];
	if ($term_uid==$uid) {
		die (dieNice ("Sorry, Dave,  I cannot let you do that.  -hal", "E-20000"));
	}
	$conf = $_POST['conf'];
	$transfer_uid = $_POST['transfer_uid'];
	
	if ($conf=='y' | $conf=='Y') {
		$quStrGetUser = "SELECT * FROM USERS WHERE UID=$term_uid";
		$quGetUser = mysqli_query($dbh, $quStrGetUser);
		$rowGetUser = mysqli_fetch_object($quGetUser);
		$quStrDeleteUser = "DELETE FROM USERS WHERE UID=$term_uid AND `GROUP`=$grid"; 
		$quDeleteUser = mysqli_query($dbh, $quStrDeleteUser) or die (dieNice("Sorry,  That user could not be deleted", "E-12000"));
		$pw = new PwFile($PASSWORD_FILE);
		$usr_ID = $rowGetUser->HANDLE;
		$pw->deleteUser($usr_ID);
		$quStrTransferAds = "UPDATE CLASS SET UID=$transfer_uid WHERE UID=$term_uid";	
		$quTransferAds = mysqli_query($dbh, $quStrTransferAds);
		$page = "manageUsers";
		$msg = "Agent, $rowGetUser->HANDLE, has been terminated.";
		$title = "Manage Agents";
		$needOptions = true;
	} else {
		$page = "termUser";
		$msg = "Please type 'y' to confirm,  no action taken.";
		$title = "Terminate Agent";
	}
}elseif ($op=="listings") { 
	$needOptions = true;
	$app = "listings";
	$appLink = "listings";
	if ($level>4) {
		$quStrGetViews = "SELECT * FROM VIEWS WHERE GRID=$grid OR PUBLIC=1 ORDER BY UID";
		$quGetViews = mysqli_query($dbh, $quStrGetViews) or die ($quStrGetViews);
		$quStrGetView = "SELECT * FROM VIEWS WHERE ID=$vid and GRID=$grid";
		$quGetView = mysqli_query($dbh, $quStrGetView);
		$rowGetView = mysqli_fetch_array($quGetView);
		
		//$LISTINGS_FILTER = $rowGetView['FILTER'] . " AND CLI=$grid";
		//$ORDERBY = $rowGetView['SORT'];
		
		$actions['edit'] = "editListing";
		$actions['edit ad'] = "edit";
		$actions['view'] = "viewListing";
		$actions['map'] = "map";
		$actions['delete'] = "deleteListing";
		
		
		$cols = split (",", $rowGetView['COLUMNS']);
		
		$numCols = count ($cols);
		
		
		for ($i=0;$i<$numCols;$i++) {
			$cols[$i] = split ("~", $cols[$i]);        
		}
		$disData = "listings";
		$page = "listings";
		$msg = "Listings View.";
		$title = "Listings View";
	}else {
		$page = "upgrade";
		$msg = "This feature is not available to you at this time.";
	}
	
}elseif ($op=="viewListing") {
	$app = "listings";
	$cid = $HTTP_GET_VARS['cid'];
	$page = "viewListing";
	$disData = "ad";
	$title = "View Listing: $abv-$cid";
}elseif ($op=="editListing") {
	$needOptions = true;
	$app = "listings";
	$cid = $HTTP_GET_VARS['cid'];
	$page = "editListing";
	$disData = "ad";
	$title = "Edit Listing: $abv-$cid";
}elseif ($op=="editListingDo") {
	$postedCount = count($_POST);
	$i = 0;
	$now = date ("Ymd");
	$bbbMonth = $_POST['bbbMonth'];
	$bbbDay   = $_POST['bbbDay'];
	$bbbYear  = $_POST['bbbYear'];
	if ($bbbMonth !== "--" && $bbbDay !== "--" && $bbbYear !== "--") {
		$avail = $bbbYear.$bbbMonth.$bbbDay;
	} else {
		$avail = 0;
	}
	$body = prepareAdBody($_POST['bbbBODY'], false);
	
	$UPDATESTR = "UPDATE CLASS SET `MOD`='$now', MODBY='$handle', AVAIL='$avail', BODY='$body', ";
	foreach ($_POST as $field => $value) {
		if ($i==($postedCount-1)) {
			if ($value=="--") {
				$UPDATESTR .= "`$field`='' ";
			} else {
				$UPDATESTR .= "`$field`='$value' ";
			}
		}elseif(strstr($field, "bbb")) {
			$foo = "bar";
		}else {
			if ($value=="--") {
				$UPDATESTR .= "`$field`='', ";
			} else {
				$UPDATESTR .= "`$field`='$value', ";
			}
		}
		$i++;
	}
	$UPDATESTR .= " WHERE CID=" . $_POST['CID'] . " AND CLI=$grid";
	//die ($UPDATESTR);
	$quUpdateClass = mysqli_query($dbh, $UPDATESTR) or die ($UPDATESTR);
	$page = "window_close";
	$disData = "ad";
	$msg = "Listing updated.";
	$cid = $_POST['CID'];
	$title = "View Listing - $abv-$cid";
	$needOptions = true;
	
}elseif ($op=="restrict_ip") {
	if ($isAdmin) {
		$page = "restrict_ip";
		$msg = "Restrict login location here.";
		$app = "home";
		$applink = "home";	
		$disData = "group";
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
	}
}elseif ($op=="restrict_ip_do") {
	if ($isAdmin) {
		$restrict_ip = $_POST['restrict_ip'];
		$ip_address = $_POST['ip_address'];
		$quStrUpdateGroup = "UPDATE `GROUP` SET RESTRICT_IP='$restrict_ip', IP_ADDRESS='$ip_address' WHERE GRID='$grid'";
		$quUpdateGroup = mysqli_query($dbh, $quStrUpdateGroup);
		$page = "manageUsers";
		$msg = "Restricted login enabled.";
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
	}
}elseif ($op=="editUser") {
	if ($isAdmin) {
		$page = "editUser";
		$euid = $HTTP_GET_VARS['uid'];
		$msg = "Edit Agent Settings here.";
		$title = "Edit Agent";
		$disData = "euser";
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
	}
}elseif ($op=="editUserDo") {
	if ($isAdmin) {
		$euid = $_POST['uid'];
		$eemail = $_POST['email'];
		$elevel = $_POST['level'];
		$erestrict_ip = $_POST['restrict_ip'];
		$quStrUpdateUser = "UPDATE USERS SET EMAIL='$eemail', USER_LEVEL='$elevel', USER_RESTRICT_IP='$erestrict_ip' WHERE UID='$euid'";
		$quUpdateUser = mysqli_query($dbh, $quStrUpdateUser);
		$page = "manageUsers";
		$msg = "User updated.";
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
	}
}elseif ($op=="manageClients") { 
	if ($level>4) {
		$page = "manageClients";
		$title = "Manage Clients";
		$msg = "Manage and Create new client contacts here.";
		$disData = "clients";
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
	}
}elseif ($op=="createClient") {
	if ($level>4) {
		$page = "createClient";
		$title = "Create Client";
		$msg = "Create new client contacts here.";
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
	}
}elseif ($op=="createClientDo") { 
	if ($level>4) {
		$public = $_POST['public'];
		$name_first = $_POST['name_first'];
		$name_last = $_POST['name_last'];
		$phone = $_POST['phone'];
		$client_email = $_POST['client_email'];
		$pricemin = $_POST['pricemin'];
		$pricemax = $_POST['pricemax'];
		
		$type_pref = array_to_string ($_POST['type_pref'], ",");
		$loc_pref = array_to_string ($_POST['loc_pref'], ",");
		$rooms_pref = array_to_string ($_POST['rooms_pref'], ",");
		$bath_pref = array_to_string ($_POST['bath_pref'], ",");
		$pets_pref = array_to_string ($_POST['pets_pref'], ",");
		
				
		$broker_fee_paid = $_POST['broker_fee_paid'];
		$payment_first_paid = $_POST['payment_first_paid'];
		$payment_last_paid = $_POST['payment_last_paid'];
		$payment_sec_paid = $_POST['payment_sec_paid'];
		$key_dep_paid = $_POST['key_dep_paid'];
		$clean_dep_paid = $_POST['clean_dep_paid'];
		$client_notes = prepareAdBody($_POST['client_notes'], false);
		
		$quStrAddClient = "INSERT INTO CLIENTS (GRID, UID, PUBLIC, NAME_FIRST, NAME_LAST, PHONE, CLIENT_EMAIL, PRICEMIN, PRICEMAX, AVAIL_PREF, TYPE_PREF, LOC_PREF, ROOMS_PREF, BATH_PREF, PETS_PREF, BROKER_FEE_PAID, PAYMENT_FIRST_PAID, PAYMENT_LAST_PAID, PAYMENT_SEC_PAID, KEY_DEP_PAID, CLEAN_DEP_PAID, CLIENT_NOTES) VALUES ('$grid', '$uid', '$public', '$name_first', '$name_last', '$phone', '$client_email', '$pricemin', '$pricemax', '$avail_pref', '$type_pref', '$loc_pref', '$rooms_pref', '$bath_pref', '$pets_pref', '$broker_fee_paid', '$payment_first_paid', '$payment_last_paid', '$payment_sec_paid', '$key_dep_paid', '$clean_dep_paid', '$client_notes')";
		$quAddClient = mysqli_query($dbh, $quStrAddClient) or die ($quStrAddClient);
		$page = "manageClients";
		$msg = "New Client contact created.";
		$title = "Manage Clients";
		$disData = "clients";
		
		
		
	}else {		
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
	}
}elseif ($op=="editClient") {
	if ($level>4) {
		$clid = $HTTP_GET_VARS['clid'];
		$page = "editClient";
		$disData = "client";
		$msg = "Edit client contact here.";
		$title = "Edit Client";
		$needOptions = true;
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
	}
}elseif ($op=="editClientDo") {
	if ($level>4) {
		$clid = $_POST['clid'];
		$public = $_POST['public'];
		$name_first = $_POST['name_first'];
		$name_last = $_POST['name_last'];
		$phone = $_POST['phone'];
		$client_email = $_POST['client_email'];
		$pricemin = $_POST['pricemin'];
		$pricemax = $_POST['pricemax'];
		
		$type_pref = array_to_string ($_POST['type_pref'], ",");
		$loc_pref = array_to_string ($_POST['loc_pref'], ",");
		$rooms_pref = array_to_string ($_POST['rooms_pref'], ",");
		$bath_pref = array_to_string ($_POST['bath_pref'], ",");
		$pets_pref = array_to_string ($_POST['pets_pref'], ",");
		
		$broker_fee_paid = $_POST['broker_fee_paid'];
		$payment_first_paid = $_POST['payment_first_paid'];
		$payment_last_paid = $_POST['payment_last_paid'];
		$payment_sec_paid = $_POST['payment_sec_paid'];
		$key_dep_paid = $_POST['key_dep_paid'];
		$clean_dep_paid = $_POST['clean_dep_paid'];
		$client_notes = prepareAdBody($_POST['client_notes'], false);
		
		$verifyUID = mysqli_fetch_object(mysqli_query($dbh, "SELECT UID FROM CLIENTS WHERE CLID='$clid'")) or die (dieNice("can't verify client record", "E-455"));
		$updatePublic = ($isAdmin || ($verifyUID->UID==$uid)) ? " PUBLIC='$public', " : " ";
		$client_update_where = ($isAdmin) ? "WHERE CLID='$clid' AND GRID='$grid'" : "WHERE CLID='$clid' AND GRID='$grid' AND (PUBLIC=1 OR UID='$uid')";
		$quStrUpdateClient = "UPDATE CLIENTS SET $updatePublic NAME_FIRST='$name_first', NAME_LAST='$name_last', PHONE='$phone', CLIENT_EMAIL='$client_email', PRICEMIN='$pricemin', PRICEMAX='$pricemax', TYPE_PREF='$type_pref', LOC_PREF='$loc_pref', ROOMS_PREF='$rooms_pref', BATH_PREF='$bath_pref', PETS_PREF='$pets_pref', BROKER_FEE_PAID='$broker_fee_paid', PAYMENT_FIRST_PAID='$payment_first_paid', PAYMENT_LAST_PAID='$payment_last_paid', PAYMENT_SEC_PAID='$payment_sec_paid', KEY_DEP_PAID='$key_dep_paid', CLEAN_DEP_PAID='$clean_dep_paid', CLIENT_NOTES='$client_notes' $client_update_where";
		$quUpdateClient = mysqli_query($dbh, $quStrUpdateClient) or die ($quStrUpdateClient);
		
		$page = "manageClients";
		$msg = "Client contact updated." ;
		$disData = "clients";
		$title = "Manage Clients";
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
	}
}elseif ($op=="createDeal") {
	if ($level>4) {
		$clid = $HTTP_GET_VARS['clid'];
		$cid = $HTTP_GET_VARS['cid'];
		$page = "createDeal";
		$msg = "Create new deal or link to existing one.";
		$title = "Create Deal";
		if ($HTTP_GET_VARS['clid']) {
			$disData = "client";
			$disData2 = "deals";
		}elseif ($HTTP_GET_VARS['cid']) {
			$disData = "clients";
			$disData2 = "ad";
			
		}
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
	}
}elseif ($op=="createDealDo") {
	if ($level>4) {
		$cid = $_POST['cid'];
		$clid = $_POST['clid'];
		
		//VERIFY THAT CLIENT and LISTING are real and grid matchs// 
		$quStrVerifyDeal = "SELECT count(CID) as VERIFY FROM CLASS INNER JOIN CLIENTS ON CLASS.CLI=CLIENTS.GRID WHERE CID='$cid' AND CLID='$clid'";
		$quVerifyDeal = mysqli_query($dbh, $quStrVerifyDeal);
		$rowVerifyDeal = mysqli_fetch_object($quVerifyDeal);
		if ($rowVerifyDeal->VERIFY==1) {
					
			$quStrInsertDeal = "INSERT INTO DEALS (GRID, UID, CID) VALUES ('$grid', '$uid', '$cid')";
			$quInsertDeal = mysqli_query($dbh, $quStrInsertDeal);
			
			$did = mysqli_insert_id($dbh);
			
			$quStrInsertDealClient = "INSERT INTO DEALCLIENTS (DID, DCLID) VALUES ('$did', '$clid')";
			$quInsertDealClient = mysqli_query($dbh, $quStrInsertDealClient);
			
			$page = "viewDeal";
			$msg = "New deal sheet created.";
			$title = "View Deal Sheet";
			$disdata = "deal";
		}else {
			$page = "createDeal";
			$msg = "Sorry,  I couldn't find that listing to link to.";
			$title = "Create Deal Sheet";
			$disData = "clients";
			$disData2 = "ad";
		}
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
	}	
}       
	        
		





//RECORDSET SWITCH -- DATABASE LAYER//
if ($disData=="ads" || $disData2=="ads" || $disData3=="ads") {
	$quStrGetAds = "SELECT * FROM ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID  $WHERE $ORDERBY $LIMIT";
	$quGetAds = mysqli_query($dbh, $quStrGetAds);
	//echo "$quStrGetAds";
}
if ($disData=="ad" || $disData2=="ad" || $disData3=="ad") {
	$quStrGetAd = "SELECT * FROM ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID WHERE CID=$cid AND CLI=$grid";
	$quGetAd = mysqli_query($dbh, $quStrGetAd) or die (dieNice("Sorry, couldn't lookup that ad.", "E-117"));
	echo "<!--RECORDSET ad $quGetAd -->";
	$rowGetAd = mysqli_fetch_object($quGetAd);
	
}
if ($disData=="pics" || $disData2=="pics" || $disData3=="pics") {
	$quStrGetPics = "SELECT * FROM PICTURE WHERE CID=$cid $sortOrder";
	$quGetPics = mysqli_query($dbh, $quStrGetPics) or die (dieNice ("Sorry, couldn't find any pictures.", "E-118"));
	echo "<!--RECORDSET pics $quGetPics -->";
}
if ($disData=="pic" || $disData2=="pic" || $disData3=="pic") {
	$quStrGetPic = "SELECT * FROM PICTURE WHERE PID=$pid";
	$quGetPic = mysqli_query($dbh, $quStrGetPic) or die (dieNice ("Sorry, couldn't fin that picture.", "E-119"));
	echo "<!--RECORDSET pic $quGetPic -->";
	$rowGetPic = mysqli_fetch_object($quGetPic);
}
if ($disData=="user" || $disData2=="user" || $disData3=="user") {
	$quStrGetUser = "SELECT * FROM USERS WHERE UID=$uid";
	$quGetUser = mysqli_query($dbh, $quStrGetUser);
	$rowGetUser = mysqli_fetch_object($quGetUser);
}
if ($disData=="euser" || $disData2=="euser" || $disData3=="euser") {
	$quStrGetUser = "SELECT * FROM USERS WHERE UID=$euid";
	$quGetUser = mysqli_query($dbh, $quStrGetUser);
	$rowGetUser = mysqli_fetch_object($quGetUser);
}
if ($disData=="listings" || $disData2=="listings" || $disData3=="listings") {
	$quStrGetListings = "SELECT * FROM ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID $WHERE $LISTINGS_ORDERBY $LIMIT";
	$quGetListings = mysqli_query($dbh, $quStrGetListings);
	//echo "<font color=\"#000000\"> $quStrGetListings</font>";
}
if ($disData=="group" || $disData2=="group" || $disData3=="group") {
	$quStrGetGroup = "SELECT * FROM `GROUP` WHERE GRID=$grid";
	$quGetGroup = mysqli_query($dbh, $quStrGetGroup);
	$rowGetGroup = mysqli_fetch_object($quGetGroup);
}
if ($disData=="clients" || $disData2=="clients" || $disData3=="clients") {
	if ($isAdmin) { 
		$clientsFilter = " WHERE GRID='$grid' ";
	}else {
		$clientsFilter = " WHERE GRID='$grid' AND PUBLIC=1 OR CLIENTS.UID='$uid'";
	}
	$quStrGetClients = "SELECT * FROM (CLIENTS INNER JOIN USERS ON CLIENTS.UID=USERS.UID) LEFT JOIN DEALCLIENTS ON CLIENTS.CLID=DEALCLIENTS.DCLID $clientsFilter ORDER BY NAME_LAST";
	$quGetClients = mysqli_query($dbh, $quStrGetClients);
}
if ($disData=="client" || $disData2=="client" || $disData3=="client") {
	if ($isAdmin) { 
		$clientsFilter = " WHERE GRID='$grid' AND CLID='$clid' ";
	}else {
		$clientsFilter = " WHERE GRID='$grid' AND CLID='$clid' AND (CLIENTS.UID='$uid' OR PUBLIC=1)";
	}
	$quStrGetClient = "SELECT * FROM CLIENTS LEFT JOIN DEALCLIENTS ON CLIENTS.CLID=DEALCLIENTS.DCLID $clientsFilter ";
	$quGetClient = mysqli_query($dbh, $quStrGetClient);
	$rowGetClient = mysqli_fetch_object($quGetClient);
}
if ($disData=="deals" || $disData2=="deals" || $disData3=="deals") {
	$quStrGetDeals = "SELECT * FROM DEALS LEFT JOIN CLASS ON DEALS.CID=CLASS.CID WHERE DEALS.GRID='$grid'";
	$quGetDeals = mysqli_query($dbh, $quStrGetDeals);
}
if ($disData=="deal" || $disData2=="deal" || $disData3=="deal") {
	$quStrGetDeal = "SELECT * FROM DEALS INNER JOIN CLASS ON DEALS.GRID=CLASS.CLI WHERE CLASS.CLI='$grid' AND DID='$did'";
	$quGetDeal = mysqli_query($dbh, $quStrGetDeal);
	$rowGetDeal = mysqli_fetch_object($quGetDeal);
	
	$quStrGetDealClients = "SELECT * FROM DEALCLIENTS INNER JOIN CLIENTS ON DEALCLIENTS.DCLID=CLIENTS.CLID WHERE DID='$did' AND CLIENTS.GRID='$grid'";
	$quGetDealClients = mysqli_query($dbh, $quStrGetDealClients);
	
}


if ($page=="sel" || $page=="compose" || $page=="edit" || $page=="home" || $page=="listings") {
	$needOptions = true;
}



//FORM OPTIONS LOOKUP SWITCH//
if ($needOptions) {


	$quStrLocs = "SELECT * FROM LOC ORDER BY LOCNAME";
	$quLocs = mysqli_query($dbh, $quStrLocs) or die (dieNice ("Sorry, couldn't find locations table.", "E-120"));
	$quLocs2 = mysqli_query($dbh, $quStrLocs) or die (dieNice ("Sorry, couldn't find locations table.", "E-120"));
	while ($rowLocArray = mysqli_fetch_object ($quLocs2)) {
		$LOC_ARRAY[$rowLocArray->LOCID] = $rowLocArray->LOCNAME;
	}
	$quStrTypes = "SELECT * FROM TYPES";
	$quTypes = mysqli_query($dbh, $quStrTypes) or die (dieNice("Sorry, couldn't find types table.", "E-121"));
	$quTypes2 = mysqli_query($dbh, $quStrTypes) or die (dieNice("Sorry, couldn't find types table.", "E-121"));
	while ($rowTypeArray = mysqli_fetch_object ($quTypes2)) {
		$TYPE_ARRAY[$rowTypeArray->TYPE] = $rowTypeArray->TYPENAME;
	}
	$quStrLandlord = "SELECT * FROM LANDLORD WHERE GRID=$grid ORDER BY SHORT_NAME";
	$quLandlord = mysqli_query($dbh, $quStrLandlord);
	if ($isAdmin) {
		$quStrGetUsers = "SELECT * FROM USERS WHERE `GROUP`=$grid";
		$quGetUsers = mysqli_query($dbh, $quStrGetUsers);
	}
	

}
$quStrIntf = "SELECT * FROM INTERFACE";
$quIntf = mysqli_query($dbh, $quStrIntf);



if ($app=="home") {
	$appLink = "home";
} elseif ($app=="ad") {
	$appLink = "sel";
}

?>

		<html>

		<head>
		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php if ($title) { $title = " - " . $title; }; ?>
		<title>BostonApartments.com<?php echo $title;?></title>
		<!-- MAIN JAVASCRIPT LAYER -->
		<script Language="JavaScript">
		window.setTimeout("window.navigate('../logout.php')", 1800000);
 		
 		function popUp(url) {
			window.open(url, 'subwin', 'width=560,height=495,resizable,scrollbars');
			//name.moveTo(screen.width/2-250,screen.height/2-250);
			//name.focus;
		}
 		
 		function scrollIt (_y) {
 			window.scrollTo (0, _y);
 		}
 		
 		 		
 		function print_screen(){                                       
 			if (!window.print){                                      
 				alert("You need newer browser to use this print button!")
 				return                                                   
 			}                                                        	
                	window.print()                                           
		}                                                        
		function close_window() {
			window.close();
		}                                            
                </script>
                </head>                                                
		<body bgcolor="#FFFFFF" text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" alink="##FFFFFF" topmargin="0" leftmargin="0" <?php if ($scroll_return) { echo " onLoad=\"scrollIt($scroll_return)\" "; }?> >
<style type="text/css">
<!--
body {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt}
th   {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: bold; background-color: #D3DCE3;}
p    {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt; color: black}
td   {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt; color: black}
test.td   {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt;}
form   {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt}
h1   {  font-family: Arial, Helvetica, sans-serif; font-size: 16pt; font-weight: bold; color: black}
h2   {  font-family: Arial, Helvetica, sans-serif; font-size: 14pt; font-weight: bold; color: black}
A:link    {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt; text-decoration: none; color: black}
A:visited {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt; text-decoration: none; color: black}
A:hover   {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt; text-decoration: underline; color: grey}
A:link.nav {  font-family: Arial, Helvetica, sans-serif; color: #000000}
A:visited.nav {  font-family: Arial, Helvetica, sans-serif; color: #000000}
A:hover.nav {  font-family: Arial, Helvetica, sans-serif; color: red;}
.nav {  font-family: Arial, Helvetica, sans-serif; color: #000000}
-->

</style>
<?php 

// DON'T PRINT HEADER SWITCH //
if (!$dontPrintHeader) {
?>		
<table width="100%" border="0" cellspaceing="0" cellpadding="0">
<tr>
<td valign="top"><a href="<?php echo "$PHP_SELF?op=$appLink";?>"><img src="../images/logo<?php echo "_$app";?>.jpg"></a></td> <td valign="top" align="right"><a href="<?php echo "$PHP_SELF?op=compose"; ?>"><img src="../images/compose.jpg"></td></tr>
<tr>
<td>
<font size="-1"><?php echo $handle;?> logged in<?php if ($isAdmin) { echo " as admin"; }?>.<br>
Welcome, <?php echo $group;?>.<br></font>
<?php if ($msg) { $msg.="<br>"; } ?>
<b><?php echo $msg;?></b>
<!-- BEGIN MENU -->
<a href="<?php echo "$PHP_SELF?op=home";?>">Home</a> | <a href="<?php echo "$PHP_SELF?op=changePassword";?>">Password</a> | <a href="<?php echo "$PHP_SELF?op=editPrefs";?>">Preferences</a> | <a href="<?php echo "$PHP_SELF?op=manageLandlord"?>">Landlords</a> | <a href="../logout.php">Logout</a> <?php if ($isAdmin) { echo "| <a href='$PHP_SELF?op=manageUsers'>Manage Agents</a>"; } ?> <?php  if ($level>4) { echo "| <a href='$PHP_SELF?op=listings'>Listings</a>"; } ?> <?php  if ($level>6) { echo "| <a href='$PHP_SELF?op=manageClients'>Manage Clients</a>"; } ?>
<!-- END MENU -->
</td>
<td>&nbsp</td>
</tr>
</table>
<table width="100%" border="0" cellspaceing="0" cellpadding="0">
<tr>
<td width="60">&nbsp;</td>
<td>
<br>
<?php 
} //End dontPrintHeader block //
?>


<?php  //DISPLAY LAYER// 
?>
<!--BEGIN SELECTED CONTENT-->
<?php if ($page=="home") { ?>
<!--BEGIN home -->
		
		<?php include("./welcome.php"); ?>
		
		<hr>
		<form action="<?php echo "$PHP_SELF";?>" name="form_app_sel" method="GET">
		<input type="hidden" name="op" value="app_sel">
		<center>Choose app:
		<!-- This selector will come later:
		<select name="app_name">
		<option value="listings">Listings View</option>
		<option value="ads">Ads View</option>
		</select> 
		--> Ads Admin for
		<select name="typeFilter">
		<?php while ($rowTypes = mysqli_fetch_object($quTypes)) { ?>
		<option value="<?php echo $rowTypes->TYPE;?>"><?php echo $rowTypes->TYPENAME;?></option>
		<?php } ?>
		</select>
		<input type="submit" value="Go">
		</form>
		<?php if ($level > 4) { ?>
		<table>
		<tr>
		<td align="right" valign="middle"><form action="<?php echo "$PHP_SELF";?>" method="GET"><input type="hidden" name="op" value="viewListing">Jump to Listing #
		<?php echo $abv;?>-<input type="text" name="cid" size="8"> <input type="submit" value="Go"></form></td>
		</tr>
		</table>
		<?php } ?>
		</center>
		
		<?php echo $rowIntf->TEXT; ?>
		<?php while ($rowTypes = mysqli_fetch_object($quTypes)) { ?>
		Ads Admin: <a href="<?php echo "$PHP_SELF?op=sel&typeFilter=$rowTypes->TYPE";?>"><font color="#000000" face="Verdana" size="1"> <?php echo $rowTypes->TYPENAME;?></a><br>
		<?php } ?>
		
<!--END home -->
<?php } elseif ($page=="sel") {?>
<!--BEGIN sel -->
<?php 
$quStrLimitCount = "SELECT count(CID) AS COUNTOF FROM CLASS WHERE CLI=$grid AND TYPE=$typeFilter $userFilterStr $activeFilterStr ";
$quLimitCount = mysqli_query($dbh, $quStrLimitCount) or die (dieNice("Sorry,  couldn;t pagenate your ads", "E-200"));
$rowLimitCount = mysqli_fetch_object($quLimitCount);
$numPages = ceil($rowLimitCount->COUNTOF / $limitN);
?>
			
				<center>
		<table border="1" cellpadding="0" cellspacing="0" width="100%">
		  <tr>
		    <td width="100%" align="center">
		    <form action="<?php echo $PHP_SELF;?>" method="GET" name="typeFilterForm">
		     <input type="hidden" name="op" value="sel">
		     <input type="hidden" name="start" value="z">
		     View:<select size="1" name="typeFilter" onchange="JavaScript:document.typeFilterForm.submit();">
		     <?php while ($rowTypes = mysqli_fetch_object($quTypes)) { ?>
		        <option value="<?php echo $rowTypes->TYPE;?>" <?php if ($rowTypes->TYPE==$typeFilter) { echo "selected"; } ?>><?php echo "$rowTypes->TYPENAME"."s";?></option>
		        <?php } ?>
		        </select></form>
		    Show <form action="<?php echo "$PHP_SELF";?>" method="GET" name="limitNForm"><input type="hidden" name="op" value="sel"><input type="text" size="4" name="limitN" value="<?php echo $limitN;?>"> ads per page.<input type="submit" value="Go"></form>
		    View page:
		    <?php for ($i=1;$i<=$numPages;$i++) { 
		    	$thisCalc = $limitN * ($i-1);
		    	if (!$thisCalc) {
		    		$thisCalc = "z";
		    	}
		    	$bold = ($thisCalc==$start) ? "<b>" : " ";
		    	$endBold = ($thisCalc==$start) ? "</b>" : " ";
		    	?>
		    <a href="<?php echo "$PHP_SELF?op=sel&start=$thisCalc";?>"><?php echo $bold;?><?php echo $i;?><?php echo $endBold;?></a> <?php if ($i<$numPages) { echo " | ";} ?>
		    <?php }?>
		    &nbsp;| <a href="<?php echo "$PHP_SELF?op=sel&start=z&limitN=$rowLimitCount->COUNTOF";?>">Show all ads</a> | 
		    <?php 
		    if ($userFilter) { ?>
		    	<a href="<?php echo "$PHP_SELF?op=sel&start=z&userFilter=n";?>">Show all ads for <?php echo $group;?></a>
		    <?php } else { ?>
		    	<a href="<?php echo "$PHP_SELF?op=sel&start=z&userFilter=1";?>">Show only <?php echo $handle;?>'s ads</a>
		    <?php } ?>
		   |
		    <?php 
		    if ($activeFilter) { ?>
		    	<a href="<?php echo "$PHP_SELF?op=sel&start=z&activeFilter=n";?>">Show all active and inactive ads</a>
		    <?php } else { ?>
		    	<a href="<?php echo "$PHP_SELF?op=sel&start=z&activeFilter=1";?>">Show only active ads</a>
		    <?php } ?>
		    
		    </td> 
		    
		  </tr>
		  <tr>
		    <td width="100%" height="24" align="right">
		    </td>
		  </tr>
		  <tr>
		    <td width="100%" height="50" align="center">
		      <div align="center">
		        <table border="0" cellpadding="0" cellspacing="0" width="300" height="48">
		          <tr>
		            <td width="294" height="48" bgcolor="#FFFFFF">
		            
		            <table width="300" border="0">
		            <tr>
		            
		            <td width="50%" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/sort.jpg"></td>
		            <td width="50%" align="left"><?php if($sortD=="DESC") { echo "<a href='$PHP_SELF?op=sel&sortD=ASC'><img src='../images/sort_desc.jpg'></a>"; } else { echo "<a href='$PHP_SELF?op=sel&sortD=DESC'><img src='../images/sort_asc.jpg'></a>"; }?> </td>
		            
		            </tr>
		            </table>
		            <table width="100%" border="0">
		            <tr>
		            <td><a href="<?php echo "$PHP_SELF?op=sel&sort=STATUS&sortD=ASC";?>"><img src="../images/sort_status<?php if ($sort=="STATUS") {echo "_act"; } ?>.jpg"></a></td>
		            <td><a href="<?php echo "$PHP_SELF?op=sel&sort=CID";?>"><img src="../images/sort_id<?php if ($sort=="CID") {echo "_act"; } ?>.jpg"></a></td>
		            <td><a href="<?php echo "$PHP_SELF?op=sel&sort=DATEIN";?>"><img src="../images/sort_cr<?php if ($sort=="DATEIN") {echo "_act"; } ?>.jpg"></a></td>
		            <td><a href="<?php echo "$PHP_SELF?op=sel&sort=MOD";?>"><img src="../images/sort_mod<?php if ($sort=="MOD") {echo "_act"; } ?>.jpg"></a></td>
		            <td><a href="<?php echo "$PHP_SELF?op=sel&sort=LOCNAME";?>"><img src="../images/sort_loc<?php if ($sort=="LOCNAME") {echo "_act"; } ?>.jpg"></a></td>
		            <td><a href="<?php echo "$PHP_SELF?op=sel&sort=LID";?>"><img src="../images/sort_lid<?php if ($sort=="LID") {echo "_act"; } ?>.jpg"></a></td>
		            <td><a href="<?php echo "$PHP_SELF?op=sel&sort=HANDLE";?>"><img src="../images/sort_user<?php if ($sort=="HANDLE") {echo "_act"; } ?>.jpg"></a></td>
		            <td><a href="<?php echo "$PHP_SELF?op=sel&sort=PIC&sortD=DESC";?>"><img src="../images/sort_pic<?php if ($sort=="PIC") {echo "_act"; } ?>.jpg"></a></td>
		            </tr>
		            </table>
		            
		            </td>
		          </tr>
		        </table>
		      </div>
		    </td>
		  </tr>
		  <tr>
		    <td width="100%" height="23" align="right">
		    </td>
		  </tr>
		  <tr>
		    <td width="100%" height="32" bgcolor="#FFFFFF">
		      <form action="<?php echo "$PHP_SELF?op=select_and_do";?>" method="POST" name="moveform">
		      <select size="1" name="sop">
		  		<?php if ($user_level >= 3) { echo "<option value='delete'>Delete...</option>";} ?>
		  		<option value="deactivate" selected>Deactivate..</option>
		  		<option value="activate">Activate...</option>
		  		<option value="nofee">Make NO FEE</option>
		  		<option value="fee">Negate NO FEE</option>
		        
		        </select><br>
		        <input type="submit" value="Submit" name="B1"><br>
		  	Select All:<input type="checkbox" name="allbox" value="sel_all" onClick="CheckAll();"></td>
		  </tr>
		  <tr>
		    <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
		    
		<?php while ($rowGetAds = mysqli_fetch_object($quGetAds)) {?>
		    <?php $landlord = ($rowGetAds->LANDLORD) ? "<b>LANDLORD: $rowGetAds->SHORT_NAME</b>" : "";?>
		    <tr>
		      <td width="100" height="1" colspan="8" bgcolor="#000000">
		      <img src="./images/px_blk.jpg" height="1" width="100%">
		      </td>
		    </tr>
		    <tr>
		      <td width="89" align="right" bgcolor="#FFFFFF" rowspan="2"><font color="#000000" face="Verdana" size="1"><?php echo "$abv-$rowGetAds->CID";?></td>
		      <td width="1" bgcolor="#FFFFFF" rowspan="2"><input type="checkbox" name="sel_ids[]" value="<?php echo $rowGetAds->CID;?>">
		      </td>
		      <td width="369" height="26" bgcolor="#FFFFFF"><font color="#000000" face="Verdana" size="1">
		      <?php if ($rowGetAds->STATUS=="ACT") { echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetAds->CID'><img src='../images/act.gif'></a>";} else {echo "<a href='$PHP_SELF?op=activate&cid=$rowGetAds->CID'><img src='../images/inact.gif'></a>";} ?>
		      <?php if ($popup_pref) { ?>
		      	<a href="javascript:popUp('<?php echo "$PHP_SELF?op=edit&cid=$rowGetAds->CID&dontPrintHeader=1";?>')"><img src="../images/edit.jpg"></a>
		      <?php } else { ?>
		      	<a href="<?php echo "$PHP_SELF?op=edit&cid=$rowGetAds->CID";?>"><img src="../images/edit.jpg"></a>  
		      <?php } ?>
		      <?php if ($user_level >= 2) { echo "<a href='$PHP_SELF?op=delete&cid=$rowGetAds->CID'><img src='../images/delete.jpg'></a>"; } ?>
		      <a href="<?php echo "$PHP_SELF?op=upload&cid=$rowGetAds->CID";?>"><img src="../images/upload.jpg"></a>
		      <?php if ($rowGetAds->PIC) {echo "<a href='$PHP_SELF?op=managePics&cid=$rowGetAds->CID'><img src='../images/pic.gif'></a>"; }?>
		      </td>
		      <td width="368" height="26" align="right" bgcolor="#FFFFFF"><?php echo $landlord;?> &nbsp<i>created <?php echo fuzDate($rowGetAds->DATEIN); ?>&nbsp; modified <?php echo fuzDate($rowGetAds->MOD); ?></i></td>
		    </tr>
		    <tr>
		      <td width="739"  colspan="2" bgcolor="#FFFFFF" valign="top"><?php
		        
		       
		        
		        echo format_ad ($rowGetAds, $DEFINED_VALUE_SETS);
		        
		      
		      
		      ?>
		      </td>
		    </tr>
		    <tr>
		      <td width="115" height="26" bgcolor="#FFFFFF" colspan="2"></td>
		      <td width="369" height="26" bgcolor="#FFFFFF">&nbsp;</td>
		      <td width="368" height="26" align="right" bgcolor="#FFFFFF"><i>created by <?php echo $rowGetAds->HANDLE;?></i></td>
		    </tr>
		    <?php } ?>
		    <tr>
		      <td width="856" height="21" colspan="4" bgcolor="#FFFFFF">
		      <hr noshade size="1" color="#000000" align="right">
		      </td>
		      
		    </tr>
		   
		  </table></td>
		  </tr>
		 <tr>
		    <td width="100%" align="center">
		    Show <form action="<?php echo "$PHP_SELF";?>" method="GET" name="limitNForm"><input type="hidden" name="op" value="sel"><input type="text" size="4" name="limitN" value="<?php echo $limitN;?>"> ads per page.<input type="submit" value="Go"></form>
		    View page:
		    <?php for ($i=1;$i<=$numPages;$i++) { 
		    	$thisCalc = $limitN * ($i-1);
		    	if (!$thisCalc) {
		    		$thisCalc = "z";
		    	}
		    	$bold = ($thisCalc==$start) ? "<b>" : " ";
		    	$endBold = ($thisCalc==$start) ? "</b>" : " ";
		    	?>
		    <a href="<?php echo "$PHP_SELF?op=sel&start=$thisCalc";?>"><?php echo $bold;?><?php echo $i;?><?php echo $endBold;?></a> <?php if ($i<$numPages) { echo " | ";} ?>
		    <?php }?>
		    &nbsp;| <a href="<?php echo "$PHP_SELF?op=sel&start=z&limitN=$rowLimitCount->COUNTOF";?>">Show all ads</a> | 
		    <?php 
		    if ($userFilter) { ?>
		    	<a href="<?php echo "$PHP_SELF?op=sel&start=z&userFilter=n";?>">Show all ads for <?php echo $group;?></a>
		    <?php } else { ?>
		    	<a href="<?php echo "$PHP_SELF?op=sel&start=z&userFilter=1";?>">Show only <?php echo $handle;?>'s ads</a>
		    <?php } ?>
		    </td> 
		    
		  </tr>
		</table>
		</form>
		</center>


<!--END sel -->
<?php }elseif ($page=="managePics") { ?>
<!--BEGIN managePics -->

		<center> Manage Pictures for <a href="<?php echo "$PHP_SELF?op=edit&cid=$cid";?>"> Ad# <?php echo "$abv-$cid";?></font></a></font><br>
		<a href="https://www.BostonApartments.com/homepage.php?cli=<?php echo $grid;?>&ad=<?php echo $cid;?>">See Pictures in ad.</a><br></center>

		<table border="0" cellpadding="2" cellspacing="0" width="100%">
	    	<tr>
	      <td width="3%" height="28" bgcolor="#45659A">&nbsp;</td>
	      <td width="14%" height="28" bgcolor="#45659A" align="center"><font color="#FFFFFF" face="Verdana" size="1"><a href="<?php echo "$PHP_SELF?op=managePics&cid=$cid&sort=PID";?>">ID</a></font></td>
	      <td width="15%" height="28" bgcolor="#45659A" align="center"><font color="#FFFFFF" face="Verdana" size="1"><a href="<?php echo "$PHP_SELF?op=managePics&cid=$cid&sort=DESCRIPT";?>">Description</a></font></td>
	      <td width="4%" height="28" bgcolor="#45659A" align="center">&nbsp;</td>
	       <td width="4%" height="28" bgcolor="#45659A" align="center">&nbsp;</td>
	      </tr>
    <?php while ($rowGetPics = mysqli_fetch_object($quGetPics)) { ?>
    		<tr>
    		  <td width="3%" height="26" nowrap nowrap bgcolor="#D3D3D3"> <a href="<?php echo "$PHP_SELF?op=editPic&pid=$rowGetPics->PID&cid=$cid"; ?>"><img src='../images/pic.gif' width=20 height=18 border=0 hspace=5></a></td>
    		  <td width="3%" height="26" nowrap><?php echo "$abv-$cid:p$rowGetPics->PID"; ?>&nbsp;</font></td>
    		  <td width="4%" height="26" nowrap bgcolor="#D3D3D3"><?php echo $rowGetPics->DESCRIPT; ?>&nbsp;</font></td>
    		  <td width="4%" height="26"><a href="<?php echo "$PHP_SELF?op=editPic&pid=$rowGetPics->PID&cid=$cid"; ?>">edit</font></a></a></td>
    		  <td width="4%" height="26" nowrap bgcolor="#D3D3D3"><a href="<?php echo "$PHP_SELF?op=deletePic&pid=$rowGetPics->PID&cid=$cid"; ?>">delete</font></a></td>
    		  </tr>
    <?php } ?>
		<tr><td align="center" colspan="5"><center><a href="<?php echo "$PHP_SELF?op=sel";?>">Return</a></td></tr>
  		</table>

<!--END managePics -->
<?php }elseif ($page=="edit") {?>
<!--BEGIN edit -->
		<center>
		
		Created by : <?php echo "$rowGetAd->HANDLE";?> <br>
		Created On: <?php echo "$rowGetAd->DATEIN";?> <br>
		Last Modifed on : <?php echo "$rowGetAd->MOD";?><br>
		Status : <?php if ($rowGetAd->STATUS=="ACT") {
				echo "Active";
			}else {
				echo "Inactive";
			} ?><br>
		
		<form action="<?php echo "$PHP_SELF?op=editDo";?>" method="POST">
		<input type="hidden" name="nofee" value="0">
		<input type="hidden" name="cid" value="<?php echo $rowGetAd->CID;?>">

		<select name="type">
	<?php while ($rowTypes=mysqli_fetch_object($quTypes)) {	?>
		<option value="<?php echo $rowTypes->TYPE;?>" <?php if ($rowGetAd->TYPE==$rowTypes->TYPE) {
																echo " selected"; }?> >
																<?php echo $rowTypes->TYPENAME; ?>
																</option>
	<?php }	?>
		</select><br>
		<select name='loc'>
	<?php while ($rowLocs = mysqli_fetch_object($quLocs)) {	?>
		<option value="<?php echo $rowLocs->LOCID; ?>" <?php if ($rowGetAd->LOC==$rowLocs->LOCID) {echo " selected"; }?> >
															<?php echo $rowLocs->LOCNAME; ?>
															</option>

	<?php }	?>
		</select><br>



		<textarea name="body" cols=70 rows=10 ><?php echo $rowGetAd->BODY;?></textarea><br>
		<br>
		
		
	Number of Bedrooms: <select name="rooms">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $key => $roomsValue) { ?>
		<?php 
		$selected = ($rowGetAd->ROOMS==$key) ? " selected " : "";
		?>
		<option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $roomsValue;?></option>
	<?php } ?>	
	</select><br>
	Number of Bathrooms: <select name="bath">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bkey => $bathValue) { ?>
		<?php 
		$selected = ($rowGetAd->BATH==$bkey) ? " selected " : "";
		?>
		<option value="<?php echo $bkey;?>" <?php echo $selected;?>><?php echo $bathValue;?></option>
	<?php } ?>	
	</select><br>
		<font face="Verdana" size="1" color="#000000">
	<?php 
	$getMon = subStr ($rowGetAd->AVAIL, 5, 2);
	$getDay = subStr ($rowGetAd->AVAIL, 8, 2);
	$getYear = subStr ($rowGetAd->AVAIL, 0, 4);
	?>
	Available: Month <select name="aMonth">
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
	</select> Day <select name="aDay"> 
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
	</select> Year <select name="aYear">
	<option value="--">--</option>
	<?php 
	$thisYear = date ("Y");
	for ($i=0;$i<=4;$i++) {?>
	<option value="<?php echo ($thisYear + $i);?>" <?php if ($getYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
	<?php }?>
	</select> for 
	<font face="Verdana" size="1" color="#000000">Price:<b>$</b><input type="text" name="price" size="8" value="<?php echo $rowGetAd->PRICE;?>">Do <b>NOT</b> include cents.<br>	
		<b>NO FEE :</b><input type="checkbox" name="nofee" value="1" <?php if ($rowGetAd->NOFEE) { echo " checked "; } ?> ><br>
		Display Personal Signature? No<input type="radio" name="use_user_sig" value="0" checked > &nbsp;
		Yes<input type="radio" name="use_user_sig" value="1" <?php if ($rowGetAd->USE_USER_SIG) {echo " checked "; } ?>><br>
		<input type="submit" value="Save"><hr>
		<hr>
		<table>
		<tr>
		<td align="right" colspan="1">Landlord:</td>
		<td colspan="5"><select name="landlord">
		<option value="--">--</option>
		<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
		<option value="<?php echo $rowGetLandlord->LID; ?>" <?php if ($rowGetAd->LANDLORD==$rowGetLandlord->LID) { echo " selected "; } ?>><?php echo $rowGetLandlord->SHORT_NAME;?></option>
		<?php } ?>
		</select></td>
		</tr>
		<tr>
		<td colspan="6">Address:</td>
		</tr>
		<tr>
		<td align="right">Street</td>
		<td><input type="text" name="street" size="14" value="<?php echo $rowGetAd->STREET;?>"></td>
		<td align="right">Apt</td>
		<td colspan="3"><input type="text" name="apt" size="4" value="<?php echo $rowGetAd->APT;?>"></td>
		</tr>
		<tr>
		<td align="right">City</td>
		<td><input type="text" name="city" size="12" value="<?php echo $rowGetAd->CITY;?>"></td>
		<td align="right">State</td>
		<td><input type="text" name="state" size="3" value="<?php echo $rowGetAd->STATE;?>"></td>
		<td align="right">Zip</td>
		<td><input type="text" name="zip" size="5" value="<?php echo $rowGetAd->ZIP;?>"></td>
		</tr>
		</table>
		<?php if ($isAdmin) { ?>
			<hr>
			Change Agent: <select name="own_uid">
			<?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) { ?>
			<option value="<?php echo $rowGetUsers->UID;?>" <?php if ($rowGetAd->UID==$rowGetUsers->UID) { echo "selected "; }?>><?php echo $rowGetUsers->HANDLE; ?></option>
			<?php } ?> 
			</select>
		<?php } ?>
		</form>


<!--END edit -->
<?php }elseif ($page=="popup_edit") {?>
<!--BEGIN popup_edit -->
		<center>
		<?php if ($level> 4 ) {?>
		Listing: <a href="<?php echo "$PHP_SELF?op=editListing&cid=$cid";?>">switch to edit mode</a> |<a href="<?php echo "$PHP_SELF?op=viewListing&cid=$cid";?>">switch to view mode</a> | <a href="<?php echo "$PHP_SELF?op=viewListing&cid=$cid&dontPrintHeader=1";?>">switch to print mode</a><br><br>
		<?php } ?><font color="#000000">
		Created by : <?php echo "$rowGetAd->HANDLE";?> <br>
		Created On: <?php echo "$rowGetAd->DATEIN";?> <br>
		Last Modifed on : <?php echo "$rowGetAd->MOD";?><br>
		Status : <?php if ($rowGetAd->STATUS=="ACT") {
				echo "Active";
			}else {
				echo "Inactive";
			} ?><br>
		
		<form action="<?php echo "$PHP_SELF?op=editDo";?>" method="POST">
		<input type="hidden" name="nofee" value="0">
		<input type="hidden" name="cid" value="<?php echo $rowGetAd->CID;?>">

		<select name="type">
	<?php while ($rowTypes=mysqli_fetch_object($quTypes)) {	?>
		<option value="<?php echo $rowTypes->TYPE;?>" <?php if ($rowGetAd->TYPE==$rowTypes->TYPE) {
																echo " selected"; }?> >
																<?php echo $rowTypes->TYPENAME; ?>
																</option>
	<?php }	?>
		</select><br>
		<select name='loc'>
	<?php while ($rowLocs = mysqli_fetch_object($quLocs)) {	?>
		<option value="<?php echo $rowLocs->LOCID; ?>" <?php if ($rowGetAd->LOC==$rowLocs->LOCID) {echo " selected"; }?> >
															<?php echo $rowLocs->LOCNAME; ?>
															</option>

	<?php }	?>
		</select><br>



		<textarea name="body" cols=40 rows=10 ><?php echo $rowGetAd->BODY;?></textarea><br>
		<br>
		
		
	Number of Bedrooms: <select name="rooms">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $key => $roomsValue) { ?>
		<?php 
		$selected = ($rowGetAd->ROOMS==$key) ? " selected " : "";
		?>
		<option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $roomsValue;?></option>
	<?php } ?>	
	</select><br>
	Number of Bathrooms: <select name="bath">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bkey => $bathValue) { ?>
		<?php 
		$selected = ($rowGetAd->BATH==$bkey) ? " selected " : "";
		?>
		<option value="<?php echo $bkey;?>" <?php echo $selected;?>><?php echo $bathValue;?></option>
	<?php } ?>	
	</select><br>
		<font face="Verdana" size="1" color="#000000">
	<?php 
	$getMon = subStr ($rowGetAd->AVAIL, 5, 2);
	$getDay = subStr ($rowGetAd->AVAIL, 8, 2);
	$getYear = subStr ($rowGetAd->AVAIL, 0, 4);
	?>
	Available: Month <select name="aMonth">
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
	</select> Day <select name="aDay"> 
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
	</select> Year <select name="aYear">
	<option value="--">--</option>
	<?php 
	$thisYear = date ("Y");
	for ($i=0;$i<=4;$i++) {?>
	<option value="<?php echo ($thisYear + $i);?>" <?php if ($getYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
	<?php }?>
	</select> for 
	<font face="Verdana" size="1" color="#000000">Price:<b>$</b><input type="text" name="price" size="8" value="<?php echo $rowGetAd->PRICE;?>">Do <b>NOT</b> include cents.<br>	
		<b>NO FEE :</b><input type="checkbox" name="nofee" value="1" <?php if ($rowGetAd->NOFEE) { echo " checked "; } ?> ><br>
		Display Personal Signature? No<input type="radio" name="use_user_sig" value="0" checked > &nbsp;
		Yes<input type="radio" name="use_user_sig" value="1" <?php if ($rowGetAd->USE_USER_SIG) {echo " checked "; } ?>><br>

		<input type="submit" value="Save"><hr>
		<hr>
		<table>
		<tr>
		<td align="right" colspan="1">Landlord:</td>
		<td colspan="5"><select name="landlord">
		<option value="--">--</option>
		<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
		<option value="<?php echo $rowGetLandlord->LID; ?>" <?php if ($rowGetAd->LANDLORD==$rowGetLandlord->LID) { echo " selected "; } ?>><?php echo $rowGetLandlord->SHORT_NAME;?></option>
		<?php } ?>
		</select></td>
		</tr>
		<tr>
		<td colspan="6">Address:</td>
		</tr>
		<tr>
		<td align="right">Street</td>
		<td><input type="text" name="street" size="14" value="<?php echo $rowGetAd->STREET;?>"></td>
		<td align="right">Apt</td>
		<td colspan="3"><input type="text" name="apt" size="4" value="<?php echo $rowGetAd->APT;?>"></td>
		</tr>
		<tr>
		<td align="right">City</td>
		<td><input type="text" name="city" size="12" value="<?php echo $rowGetAd->CITY;?>"></td>
		<td align="right">State</td>
		<td><input type="text" name="state" size="3" value="<?php echo $rowGetAd->STATE;?>"></td>
		<td align="right">Zip</td>
		<td><input type="text" name="zip" size="5" value="<?php echo $rowGetAd->ZIP;?>"></td>
		</tr>
		</table>
		<?php if ($isAdmin) { ?>
			<hr>
			Change Agent: <select name="own_uid">
			<?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) { ?>
			<option value="<?php echo $rowGetUsers->UID;?>" <?php if ($rowGetAd->UID==$rowGetUsers->UID) { echo "selected "; }?>><?php echo $rowGetUsers->HANDLE; ?></option>
			<?php } ?> 
			</select>
		<?php } ?>
		</form>


<!--END popup_edit -->
<?php }elseif ($page=="delete") { ?>
<!--BEGIN delete -->

		<center>		
		Created by : <?php echo "$rowGetAd->HANDLE";?> <br>
		Created On: <?php echo "$rowGetAd->DATEIN";?> <br>
		Last Modifed on : <?php echo "$rowGetAd->MOD";?><br>
		Status : <?php if ($rowGetAd->STATUS=="ACT") {
				echo "Active";
			}else {
				echo "Inactive";
			} ?><br><br>
		<?php echo $rowGetAd->BODY; ?><br>
		<form action="<?php echo "$PHP_SELF?op=deleteDo";?>" method="POST">
		<input type="hidden" name="cid" value="<?php echo $rowGetAd->CID;?>">
		Please type 'y' to confirm.

		<input type="text" name="conf" size="3">
		<br>
		<input type="submit" value="Delete Ad"></form>
		<br><a href="<?php echo "$PHP_SELF?op=sel"; ?>">Cancel</a>
		</font>
		</center>

<!--END delete -->
<?php } elseif ($page=="compose") { ?>
<!-- BEGIN compose -->

		<center>
		
		
		<form action="<?php echo "$PHP_SELF?op=add";?>" method="POST">
		<input type="hidden" name="nofee" value="0">
		<input type="hidden" name="cid" value="<?php echo $rowGetAd->CID;?>">
		<select name="type">
	<?php while ($rowTypes=mysqli_fetch_object($quTypes)) {	?>
		<option value="<?php echo $rowTypes->TYPE;?>" <?php if ($rowGetAd->TYPE==$rowTypes->TYPE) {
																echo " selected"; }?> >
																<?php echo $rowTypes->TYPENAME; ?>
																</option>
	<?php }	?>
		</select><br>
		<select name='loc'>
	<?php while ($rowLocs = mysqli_fetch_object($quLocs)) {	?>
		<option value="<?php echo $rowLocs->LOCID; ?>" <?php if ($rowGetAd->LOC==$rowLocs->LOCID) {echo " selected"; }?> >
															<?php echo $rowLocs->LOCNAME; ?>
															</option>

	<?php }	?>
		</select><br>



		<textarea name="body" cols=70 rows=10 ><?php echo $rowGetAd->BODY;?></textarea><br>
		<br>
		
		
	Number of Bedrooms: <select name="rooms">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $key => $roomsValue) { ?>
		<?php 
		$selected = ($rowGetAd->ROOMS==$key) ? " selected " : "";
		?>
		<option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $roomsValue;?></option>
	<?php } ?>	
	</select><br>
	Number of Bathrooms: <select name="bath">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bkey => $bathValue) { ?>
		<?php 
		$selected = ($rowGetAd->BATH==$bkey) ? " selected " : "";
		?>
		<option value="<?php echo $bkey;?>" <?php echo $selected;?>><?php echo $bathValue;?></option>
	<?php } ?>	
	</select><br>
		<font face="Verdana" size="1" color="#000000">
	<?php 
	$getMon = subStr ($rowGetAd->AVAIL, 5, 2);
	$getDay = subStr ($rowGetAd->AVAIL, 8, 2);
	$getYear = subStr ($rowGetAd->AVAIL, 0, 4);
	?>
	Available: Month <select name="aMonth">
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
	</select> Day <select name="aDay"> 
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
	</select> Year <select name="aYear">
	<option value="--">--</option>
	<?php 
	$thisYear = date ("Y");
	for ($i=0;$i<=4;$i++) {?>
	<option value="<?php echo ($thisYear + $i);?>" <?php if ($getYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
	<?php }?>
	</select> for 
	<font face="Verdana" size="1" color="#000000">Price:<b>$</b><input type="text" name="price" size="8" value="<?php echo $rowGetAd->PRICE;?>">Do <b>NOT</b> include cents.<br>	
		<b>NO FEE :</b><input type="checkbox" name="noFee" value="1" <?php if ($rowGetAd->NOFEE) { echo " checked "; } ?> ><br>
		Display Personal Signature? No<input type="radio" name="use_user_sig" value="0" checked > &nbsp;
		Yes<input type="radio" name="use_user_sig" value="1" <?php if ($rowGetAd->USE_USER_SIG) {echo " checked "; } ?>><br>
		Do you have pictures for this ad?<input type="checkbox" name="upload" value="1"><br>
		<input type="submit" value="Save"><hr>
		<hr>
		Landlord:<select name="landlord">
		<option value="--">--</option>
		<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
		<option value="<?php echo $rowGetLandlord->LID; ?>" <?php if ($rowGetAd->LANDLORD==$rowGetLandlord->LID) { echo " selected "; } ?>><?php echo $rowGetLandlord->SHORT_NAME;?></option>
		<?php } ?>
		</select><br>
		Address: Street<input type="text" name="street" size="14" value="<?php echo $rowGetAd->STREET;?>"> Apt<input type="text" name="apt" size="4" value="<?php echo $rowGetAd->APT;?>"><br>
		City<input type="text" name="city" size="12" value="<?php echo $rowGetAd->CITY;?>"> State<input type="text" name="state" size="3" value="<?php echo $rowGetAd->STATE;?>"> Zip<input type="text" name="zip" size="5" value="<?php echo $rowGetAd->ZIP;?>"><br>
		</form>
		</center>

<!--END compose -->
<?php } elseif ($page=="upload") { ?>
<!--BEGIN upload -->
		
		<center> <h4> upload picture for ad ref# <?php echo "$abv-$cid"; ?>. </h4> <br><br>
		<form enctype="multipart/form-data" action="<?php echo "$PHP_SELF?op=uploadDo";?>" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="300000">
		Send this file: <input name="userfile" type="file"><br>
		Description: <input type="text" name="desc" size="40">
		<input type="hidden" name="cid" value="<?php echo $cid; ?>">
		<input type="submit" value="Send File">
		</form>
		</font>
		<center>

<!-- END upload -->
<?php } elseif ($page=="editPic") { ?>
<!--BEGIN editPic -->
		<center>
		<a href="https://www.BostonApartments.com/homepage.php?cli=<?php echo $grid;?>&ad=<?php echo $cid;?>">See pictures in Ad.</a><br>
		<img src="https://www.BostonApartments.com/pics/<?php echo "$pid.$rowGetPic->EXT"; ?>"><br>
		<form action="<?php echo "$PHP_SELF?op=editPicDo"; ?>" method="POST">
		<input type="hidden" name="pid" value="<?php echo $pid;?>">
		<input type="hidden" name="cid" value="<?php echo $cid;?>">
		<input type="text" size="40" name="desc" value="<?php echo $rowGetPic->DESCRIPT; ?>"><br>
		Would you like to upload another?:<input type="checkbox" name="another" value="1">
		<input type="submit" value="Save">
		</form></center>

<!--END editPic -->
<?php } elseif ($page=="deletePic") { ?>
<!--BEGIN editPic -->
		
		<center>
		<img src="https://www.BostonApartments.com/pics/<?php echo "$pid.$rowGetPic->EXT"; ?>"><br>
		<form action="<?php echo "$PHP_SELF?op=deletePicDo"; ?>" method="POST">
		<input type="hidden" name="pid" value="<?php echo $pid;?>">
		<input type="hidden" name="cid" value="<?php echo $cid;?>">
		<input type="hidden" name="ext" value="<?php echo "$rowGetPic->EXT"; ?>">
		Please type 'y' to confirm:
		<input type="text" size="3" name="conf"><br>
		<input type="submit" value="Delete">
		</form></center>
		</font>

<!--END deletePic -->
<?php } elseif ($page=="changePassword") { ?>
<!--BEGIN changePassword -->
		
		<center>
		<table border="1" cellpadding="5">
		<tr>
		<td align="center">Passwords should be a minimum of 4 characters, maximum of 8, using only a-z, A-Z, 0-9 and no spaces.<br>
		Both login names and passwords are case-sensitive.
		</td>
		</tr>
		</table>
		<br>
		<br>
		<form action="<?php echo "$PHP_SELF?op=changePasswordDo"; ?>" method="POST">
		<table border="0">
		<tr>
		<td align="right">Old Password:</td>
		<td><input type="password" size="10" name="oldPass"></td>
		</tr>
		<tr>
		<td align="right">New Password:</td>
		<td><input type="password" size="10" name="newPass"></td>
		</tr>
		<tr>
		<td align="right">Retype New Password:</td>
		<td><input type="password" size="10" name="newPassConf"></td>
		</tr>
		<tr>
		<td colspan="2" align="center"><input type="submit" value="Change"></td>
		</tr>
		</table>
		</form>

<!--End changePassword -->
<?php } elseif ($page=="continue") { ?>
<!-- BEGIN continue -->
<center><br><br><br> <a href="<?php echo "$PHP_SELF?op=sel"; ?>"><font color="#000000" face="Verdana" size="1">Continue</a></center>
<!--END continue -->
<?php }elseif ($page=="select_and_delete") { ?>
<!--BEGIN select_and_delete -->

	<center>
	<font color="#000000" face="Verdana" size="1">
	Are you sure you want to delete these <?php echo $numIDs;?> ad(s)?
	<form action="<?php echo "$PHP_SELF?op=select_and_deleteDO";?>" method="POST">
	<?php foreach ($sel_ids as $sel_id) {?>
	<input type="hidden" name="sel_ids[]" value="<?php echo $sel_id;?>">
	<?php } ?>
	Please type 'y' to confirm:<input type="text" size="3" name="conf"><br>
	<input type="submit" value="Delete">
	</form>
	</font>
	<center>


<!--END select_and_delete -->	
<?php }elseif ($page=="editPrefs") { ?>
<!--BEGIN editPrefs -->

	<center>
	<form action="<?php echo "$PHP_SELF?op=editPrefsDo"; ?>" method="POST">
	<table border="1" width="450">
	<tr>
	<td align="center">
	<table cellspacing="5" cellpadding="3">
	<tr>
	<td align="right" valign="top">Default number of ads to display on page:</td>
	<td valign="top"><input type="text" size="3" name="num_ads" value="<?php echo $rowGetUser->NUM_ADS;?>"></td>
	</tr>
	<tr>
	<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
	<td align="right" width="50%" valign="top">Personal Signature (to be displayed optionally in the body of each ad. (e.g. Call Pat: (617) 123-4567.)</td>
	<td valign="top"><textarea name="user_sig" rows="5" cols="30"><?php echo $rowGetUser->USER_SIG;?></textarea><br><center>(No HTML accepted.)</center></td>
	</tr>
	<tr>
	<td colspan="2">&nbsp;</td>
	</tr>
	
	<tr>
	<td align="right" valign="top">Direct edits screens into a new window (requires IE 5 or greater)</td>
	<td valign="top">No<input type="radio" name="pref_popup" value="0" checked > Yes<input type="radio" name="pref_popup" value="1" <?php if ($rowGetUser->PREF_POPUP) { echo " checked "; }?>></td>
	</tr>
	
	<tr>
	<td align="right" valign="top">Use software Version</td>
	<td valign="top">1.0<input type="radio" name="use_version" value="1" <?php if ($rowGetUser->USE_VERSION==1) { echo " checked "; }?> > 2.0<input type="radio" name="use_version" value="2" <?php if ($rowGetUser->USE_VERSION==2) { echo " checked "; }?>></td>
	</tr>
	
	<tr>
	<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
	<td colspan="2" align="center"><input type="submit" value="Save"></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</form>
	</center>
<!--END editPrefs -->
<?php }elseif ($page=="manageLandlord") { ?>
<!--BEGIN manageLandlord -->
	<center> Manage Landlords for <?php echo $group;?> <br>
	<a href="<?php echo "$PHP_SELF?op=createLandlord"; ?>">Create new Landlord</a>
		

		<table border="0" cellpadding="2" cellspacing="0" width="100%">
	    	<tr>
	      <td width="3%" height="28" bgcolor="#45659A">&nbsp;</td>
	      <td width="14%" height="28" bgcolor="#45659A" align="center"><font color="#FFFFFF" face="Verdana" size="1">Short Name<font></td>
	      <td width="15%" height="28" bgcolor="#45659A" align="center"><font color="#FFFFFF" face="Verdana" size="1">Office Name</font></td>
	      <td width="4%" height="28" bgcolor="#45659A" align="center">&nbsp;</td>
	       <td width="4%" height="28" bgcolor="#45659A" align="center">&nbsp;</td>
	      </tr>
    <?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
    		<tr>
    		  <td width="3%" height="26" nowrap bgcolor="#D3D3D3"> <a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$rowGetLandlord->LID"; ?>"></td>
    		  <td width="3%" height="26" nowrap><?php echo $rowGetLandlord->SHORT_NAME;?></font></td>
    		  <td width="4%" height="26" nowrap bgcolor="#D3D3D3"><?php echo $rowGetLandlord->OFF_NAME; ?></font></td>
    		  <td width="4%" height="26"><a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$rowGetLandlord->LID"; ?>">edit</font></a></a></td>
    		  <td width="4%" height="26" nowrap bgcolor="#D3D3D3"><a href="<?php echo "$PHP_SELF?op=deleteLandlord&lid=$rowGetLandlord->LID"; ?>">delete</font></a></td>
    		  </tr>
    <?php } ?>
		<tr><td align="center" colspan="5"><center><a href="<?php echo "$PHP_SELF?op=home";?>">Return</a></td></tr>
  		</table>


<!--END manageLanlord -->
<?php }elseif ($page=="createLandlord") { ?>
<!--BEGIN createLandlord -->

	<center>
	<form action="<?php echo "$PHP_SELF?op=createLandlordDo";?>" method="POST">
	<table border="1" width="75%">
	<tr>
	<td width="100%" align="center" colspan="2">Short Name:<input type="text" name="short_name" size="10"></td>
	</tr>
	<tr>
	<td width="50%" align="center">Personal</td><td width="50%" align="center">Business</td>
	</tr>
	<tr>
	<td width="50%" align="left">&nbsp;<br>
	<table width="100%" border="0">
	<tr><td align="right">First Name:</td><td align="left"> <input type="text" name="home_name_first" size="15"></td></tr>
	<tr><td align="right">Last Name:</td><td align="left"> <input type="text" name="home_name_last" size="15"></td></tr>
	<tr><td align="right">Street:</td><td align="left"><input type="text" name="home_street" size="15"></td></tr>
	<tr><td align="right">City:</td><td align="left"><input type="text" name="home_city" size="15"></td></tr>
	<tr><td align="right">State:</td><td align="left"><input type="text" name="home_state" size="3"></td></tr>
	<tr><td align="right">ZIP:</td><td align="left"><input type="text" name="home_zip" size="10"></td></tr>
	<tr><td align="right">Phone:</td><td align="left"> <input type="text" name="home_phone" size="15"></td></tr>
	<tr><td align="right">Fax:</td><td align="left"><input type="text" name="home_fax" size="15"></td></tr>
	</table>
	</td>
	<td width="50%" align="left">&nbsp;<br>
	<table width="100%" border="0">
	<tr><td align="right">Official Name:</td><td align="left"> <input type="text" name="off_name" size="15"></td></tr>
	<tr><td align="right">Street:</td><td align="left"><input type="text" name="off_street" size="15"></td></tr>
	<tr><td align="right">City:</td><td align="left"><input type="text" name="off_city" size="15"></td></tr>
	<tr><td align="right">State:</td><td align="left"><input type="text" name="off_state" size="3"></td></tr>
	<tr><td align="right">ZIP:</td><td align="left"><input type="text" name="off_zip" size="10"></td></tr>
	<tr><td align="right">Phone:</td><td align="left"><input type="text" name="off_phone" size="15"></td></tr>
	<tr><td align="right">Fax:</td><td align="left"><input type="text" name="off_fax" size="15"></td></tr>
	</table>
	</td>
	<tr>
	<td colspan="2" align="center">
	Addendum:<br>
	<textarea cols="50" rows="15" name="addendum"></textarea>
	</td>
	</tr>
	<tr>
	<td colspan="2" align="center">
	Additional Comments:<br>
	<textarea cols="50" rows="15" name="llnotes"></textarea>
	</td>
	</tr>
	<tr>
	<td colspan="2" align="center">
	Pets? Yes:<input type="radio" name="pets" value="YES"> No:<input type="radio" name="pets" value="NO">
	<td colspan="2" align="center">
	<input type="submit" value="Save">
	</td>
	</table>
	</form>
	</center>

<!--END createLandlord -->
<?php }elseif ($page=="editLandlord") { ?>
<!--BEGIN editLandlord -->

	<center>
	<form action="<?php echo "$PHP_SELF?op=editLandlordDo";?>" method="POST">
	<input type="hidden" name="lid" value="<?php echo $lid; ?>">
	<table border="1" width="75%">
	<tr>
	<td width="100%" align="center" colspan="2">Short Name:<input type="text" name="short_name" size="10" value="<?php echo $rowGetLandlord->SHORT_NAME;?>"></td>
	</tr>
	<tr>
	<td width="50%" align="center">Personal</td><td width="50%" align="center">Business</td>
	</tr>
	<tr>
	<td width="50%" align="left">&nbsp;<br>
	<table width="100%" border="0">
	<tr><td align="right">First Name:</td><td align="left"><input type="text" name="home_name_first" size="15" value="<?php echo $rowGetLandlord->HOME_NAME_FIRST;?>"></td></tr>
	<tr><td align="right">Last Name:</td><td align="left"><input type="text" name="home_name_last" size="15" value="<?php echo $rowGetLandlord->HOME_NAME_LAST;?>"></td></tr>
	<tr><td align="right">Street:</td><td align="left"><input type="text" name="home_street" size="15" value="<?php echo $rowGetLandlord->HOME_STREET;?>"></td></tr>
	<tr><td align="right">City:</td><td align="left"><input type="text" name="home_city" size="15" value="<?php echo $rowGetLandlord->HOME_CITY;?>"></td></tr>
	<tr><td align="right">State:</td><td align="left"><input type="text" name="home_state" size="3" value="<?php echo $rowGetLandlord->HOME_STATE;?>"></td></tr>
	<tr><td align="right">ZIP:</td><td align="left"><input type="text" name="home_zip" size="10" value="<?php echo $rowGetLandlord->HOME_ZIP;?>"></td></tr>
	<tr><td align="right">Phone:</td><td align="left"><input type="text" name="home_phone" size="15" value="<?php echo $rowGetLandlord->HOME_PHONE;?>"></td></tr>
	<tr><td align="right">Fax:</td><td align="left"><input type="text" name="home_fax" size="15" value="<?php echo $rowGetLandlord->HOME_FAX;?>"></td></tr>
	</table>
	</td>
	<td width="50%" align="left">&nbsp;<br>
	<table width="100%" border="0">
	<tr><td align="right">Name:</td><td align="left"><input type="text" name="off_name" size="15" value="<?php echo $rowGetLandlord->OFF_NAME;?>"></td></tr>
	<tr><td align="right">Street:</td><td align="left"><input type="text" name="off_street" size="15" value="<?php echo $rowGetLandlord->OFF_STREET;?>"></td></tr>
	<tr><td align="right">City:</td><td align="left"><input type="text" name="off_city" size="15" value="<?php echo $rowGetLandlord->OFF_CITY;?>"></td></tr>
	<tr><td align="right">State:</td><td align="left"><input type="text" name="off_state" size="3" value="<?php echo $rowGetLandlord->OFF_STATE;?>"></td></tr>
	<tr><td align="right">ZIP:</td><td align="left"><input type="text" name="off_zip" size="10" value="<?php echo $rowGetLandlord->OFF_ZIP;?>"></td></tr>
	<tr><td align="right">Phone:</td><td align="left"><input type="text" name="off_phone" size="15" value="<?php echo $rowGetLandlord->OFF_PHONE;?>"></td></tr>
	<tr><td align="right">Fax:</td><td align="left"><input type="text" name="off_fax" size="15" value="<?php echo $rowGetLandlord->OFF_FAX;?>"></td></tr>
	</table>
	</td>
	</tr>
	<tr>
	<td colspan="2" align="center">
	Addendum:<br>
	<textarea cols="50" rows="15" name="addendum"><?php echo $rowGetLandlord->ADDENDUM;?></textarea>
	</td>
	</tr>
	<tr>
	<td colspan="2" align="center">
	Additional Comments:<br>
	<textarea cols="50" rows="15" name="llnotes"><?php echo $rowGetLandlord->LLNOTES;?></textarea>
	</td>
	</tr>
	<tr>
	<td colspan="2" align="center">
	Pets? Yes:<input type="radio" name="pets" value="YES" <?php if ($rowGetLandlord->PETS=="YES") { echo " checked "; }?>> No:<input type="radio" name="pets" value="NO" <?php if ($rowGetLandlord->PETS=="NO") { echo " checked "; }?>>
	<td colspan="2" align="center">
	<input type="submit" value="Save">
	</td>
	</table>
	</form>
	</center>

<!--END createLandlord -->
<?php }elseif ($page=="deleteLandlord") { ?>
<!--BEGIN deleteLandlord -->

	<center>Are you sure you want to delete this landlord record?<br>
	<?php echo "$rowGetLL->SHORT_NAME $rowGetLL->HOME_NAME $rowGetLL->OFF_NAME";?>
	<form action="<?php echo "$PHP_SELF?op=deleteLandlordDo";?>" method="POST">
	<input type="hidden" name="lid" value="<?php echo $rowGetLL->LID;?>">
	Please type 'y' to confirm: <input type="text" name="conf" size="3"><br>
	<input type="submit" value="Delete">
	</form>
	
<!--END deleteLandlord -->
<?php }elseif ($page=="manageUsers") { ?>
<!--BEGIN manageUsers -->

	<center>
	Manage Agents for <?php echo $group;?><br>
	<a href="<?php echo "$PHP_SELF?op=createUser"; ?>">Create new Agent</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo "$PHP_SELF?op=restrict_ip";?>">Restrict Login</a>
		

		<table border="0" cellpadding="2" cellspacing="0" width="100%">
	    	<tr>
	      <td width="3%" height="28" bgcolor="#45659A">&nbsp;</td>
	      <td width="14%" height="28" bgcolor="#45659A" align="center"><font color="#FFFFFF" face="Verdana" size="1">Name<font></td>
	      <td width="15%" height="28" bgcolor="#45659A" align="center"><font color="#FFFFFF" face="Verdana" size="1">Email</font></td>
	      <td width="4%" height="28" bgcolor="#45659A" align="center">&nbsp;</td>
	      <td width="4%" height="28" bgcolor="#45659A" align="center">&nbsp;</td>
	      </tr>
    <?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) { ?>
    		<tr>
    		  <td width="3%" height="26" nowrap bgcolor="#D3D3D3">&nbsp;</td>
    		  <td width="3%" height="26" nowrap><?php echo $rowGetUsers->HANDLE;?></font></td>
    		  <td width="4%" height="26" nowrap bgcolor="#D3D3D3"><?php echo $rowGetUsers->EMAIL; ?></font></td>
    		  <td width="4%" height="26" nowrap bgcolor="#D3D3D3"><?php if ($rowGetUsers->UID !== $uid) { echo "<a href='$PHP_SELF?op=termUser&uid=$rowGetUsers->UID'>terminate</font></a>"; } else { echo "&nbsp;"; } ?></td>
    		  <td width="4%" height="26" nowrap bgcolor="#D3D3D3"><a href="<?php echo "$PHP_SELF?op=editUser&uid=$rowGetUsers->UID";?>">Edit Agent</a></td>
    		  </tr>
    <?php } ?>
		<tr><td align="center" colspan="5"><center><a href="<?php echo "$PHP_SELF?op=home";?>">Return</a></td></tr>
  		</table>


<!--END manageUsers -->
<?php }elseif ($page=="createUser") { ?>
<!--BEGIN createUser -->

	<center>
	<table border="1" cellpadding="5">
	<tr>
	<td align="center">Agent login names should be at least 5 characters long, but a maximum of 15. One may use only alphanumeric characters; all letters, upper and lower case (a-z, A-Z) and digits 0-9 and no spaces.<br>
	Passwords should be a minimum of 4 characters, maximum of 8, using only a-z, A-Z, 0-9 and no spaces.<br>
	Both login names and passwords are case-sensitive.
	</td>
	</tr>
	</table>
	<br>
	<br>
	<br>
	<form action="<?php echo "$PHP_SELF?op=createUserDo";?>" method="POST">
	<table>
	<tr>
	<td align="right">Agent Name:</td>
	<td><input type="text" name="new_handle" size="10" value="<?php echo $new_handle; ?>"></td>
	</tr>
	<tr>
	<td align="right">Password:</td>
	<td><input type="password" name="new_passwd" size="10"></td>
	</tr>
	<tr>
	<td align="right">Re-type Password:</td>
	<td><input type="password" name="conf_new_passwd" size="10"></td>
	</tr>
	<tr>
	<td align="right">Email:</td>
	<td><input type="text" name="new_email" size="20" value="<?php echo $new_email; ?>"></td>
	</tr>
	<tr>
	<td align="right">Access Level:<br><font size="-2" color="#999999">See below for explanation</td>
	<td>1<input type="radio" name="level" value="1"> 2<input type="radio" name="level" value="2" checked > 3<input type="radio" name="level" value="3"></td>
	</tr>
	<tr>
	<td colspan="2" align="center"><input type="submit" value="Create"></td>
	</tr>
	</table>
	</form>
	<br>
	<br>
	<br>
	<table border="1" width="504" height="212">
    <tr>
      <td width="62" height="18">Level</td>
      <td width="426" height="18">Access Rights:</td>
    </tr>
    <tr>
      <td width="62" height="44">1</td>
      <td width="426" height="44">Can compose, edit, activate and deactivate
        ads, landlords and listings.</td>
    </tr>
    <tr>
      <td width="62" height="67">2</td>
      <td width="426" height="67">Can compose, edit, activate, deactivate and
        delete ads, landlords and listings one at a time.</td>
    </tr>
    <tr>
      <td width="62" height="60">3</td>
      <td width="426" height="60">Can compose, edit, activate, deactivate and
        delete ads, landlords and listings one at a time, or in groups.</td>
    </tr>
  </table>
	</center>

<!--END createUser -->	
<?php } elseif ($page=="termUser") { ?>
<!--BEGIN termUser -->

	<center>
	Are you sure you want to terminate <?php echo $rowGetUser->HANDLE; ?>?</br>
	<form action="<?php echo "$PHP_SELF?op=termUserDo"; ?>" method="POST">
	<input type="hidden" name="term_uid" value="<?php echo $term_uid;?>">
	Please type 'y' to confirm:<input type="text" name="conf" size="3"><br><br>
	Transfer all ads to: <select name="transfer_uid">
	<?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) {
		if ($rowGetUsers->UID!==$term_uid) { ?>
			<option value="<?php $rowGetUsers->UID;?>"><?php echo $rowGetUsers->HANDLE;?></option>
		<?php }
	 } ?>
	</select><br>
	<input type="submit" value="terminate">
	</form>
	</center>

<!--END termUser -->
<?php } elseif ($page=="listings") { ?>
<!--BEGIN listings -->
<?php 
$quStrLimitCount = "SELECT * FROM ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID $WHERE ";
$quLimitCount = mysqli_query($dbh, $quStrLimitCount) or die (dieNice("Sorry,  couldn't pagenate your ads", "E-200"));
$num_rows = mysqli_num_rows($quLimitCount);

$numPages = ceil($num_rows / $limitN);


//Filter Display String //
session_register ("switch_remember");
session_register ("filter_string_display");



if ($_POST['filterChange']) {	
	$bbbmonth = $_POST['bbbmonth'];
	$bbbday = $_POST['bbbday'];
	$bbbyear = $_POST['bbbyear'];
	$bbemonth = $_POST['bbemonth'];
	$bbeday = $_POST['bbeday'];
	$bbeyear = $_POST['bbeyear'];
	
	$begin_date = array(($bbbyear ."-". $bbbmonth ."-". $bbbday));
	$end_date = array(($bbeyear ."-". $bbemonth ."-". $bbeday));
	
	
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
	$preFilters_str[11] = array($begin_date, "CLASS.AVAIL", ">", "Available begin date");
	$switch_remember['bbbmonth'] = $_POST['bbbmonth'];
	$switch_remember['bbbday'] = $_POST['bbbday'];
	$switch_remember['bbbyear'] = $_POST['bbbyear'];
	$preFilters_str[12] = array($end_date, "CLASS.AVAIL", "<", "Available end date");
	$switch_remember['bbemonth'] = $_POST['bbemonth'];
	$switch_remember['bbeday'] = $_POST['bbeday'];
	$switch_remember['bbeyear'] = $_POST['bbeyear'];
	
	
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
					}elseif ($preFilter_str[1] == "PRICE") {
						$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $value_str  . "' ");
					
					}elseif ($preFilter_str[1] == "CLASS.STATUS" || $preFilter_str[1] == "STATUS_VACANT" || $preFilter_str[1] == "STATUS_ACTIVE" ||$preFilter_str[1] == "CLASS.AVAIL") {
						$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $value_str  . "' ");
					
					}else {
						$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $DEFINED_VALUE_SETS[$preFilter_str[1]][$value_str] . "' ");
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
				}elseif ($preFilter_str[1] == "PRICE") {
					$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $value_str  . "' ");
				
				}elseif ($preFilter_str[1] == "CLASS.STATUS" || $preFilter_str[1] == "STATUS_VACANT" || $preFilter_str[1] == "STATUS_ACTIVE" ||$preFilter_str[1] == "CLASS.AVAIL") {
					$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $value_str  . "' ");
				
				}else {
					$tempStr_str.=  (" " . $preFilter_str[3] . " " . $preFilter_str[2] . " '" . $DEFINED_VALUE_SETS[$preFilter_str[1]][$value_str] . "' ");
				}
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
	<center>
	<br>
	<form action="<?php echo "$PHP_SELF";?>" method="GET"><input type="hidden" name="op" value="viewListing">Jump to Listing #<?php echo $abv;?>-<input type="text" name="cid" size="8"> <input type="submit" value="Go"></form>
	<table border="1">
	<tr>
	<td bordercolorlight="#000000">
	<table border="0" width="500">
    <tr>
      <td width="828" height="13" colspan="8">
        <p align="center"><form action="<?php echo "$PHP_SELF";?>" method="GET" name="listings_form" onReset="clear_listings_form()"><input type="hidden" name="op" value="listings">View: 
	<select name="vid">
	<?php while ($rowGetViews = mysqli_fetch_object($quGetViews)) {?>
		<option value="<?php echo $rowGetViews->ID;?>" <?php if ($vid==$rowGetViews->ID) { echo " selected "; }?>><?php echo $rowGetViews->NAME;?></option>
	<?php } ?>
	</select>
	<input type="submit" value="View"></form></td>
    </tr>
  </center>
 <form action="<?php echo "$PHP_SELF?op=listings";?>" method="POST">
 <input type="hidden" name="filterChange" value="1">
  <tr>
 
    <td width="87" height="51">
      <p align="right">Listing Type(s):</td>
    <center>
    <td width="131" height="51"><select name="type[]" multiple size="2">
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
    </center>
    
    <td width="75" height="60" align="right">Price Min:</td>
    <td width="112" height="60">$<input type="text" name="priceStart[]" size="4" value="<?php echo $switch_remember['priceStart'];?>"></td>
    <td width="75" align="right">Price Max:</td>
    <td width="112">$<input type="text" name="priceEnd[]" size="4" value="<?php echo $switch_remember['priceEnd'];?>"></td>
    
    
    <td width="122" height="51">
      <p align="right">Location(s):</td>
    <center>
    <td width="112" height="51"><select name="loc[]" multiple size="2">   
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
  </center>
  <tr>
    <td colspan="10" align="center"><table><tr><td> Advertising: <input type="checkbox" name="status[]" <?php if ($switch_remember['status']=='ACT') { echo checked;} ?> value="ACT"></td><td>Vacant:<input type="checkbox" name="status_vacant[]" value="1" <?php if ($switch_remember['status_vacant']) { echo " checked "; } ?> ></td><td> Available:<input type="checkbox" name="status_active[]" value="1" <?php if ($switch_remember['status_active']) {echo " checked "; }?> ></td></tr></table></td>
    
    </tr>
  <tr>
  <td colspan="3" align="center">
  <?php 
	$getMon = date (m);
	$getDay = date (d);
	$getYear = date (Y);
	?>

Available begin date:<br> Month <select name="bbbmonth">
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
	</select> Day <select name="bbbday"> 
	<?php for ($i=1;$i<=31;$i++) {
		if ($i<=9) {
			$j = "0".$i;
		} else {
			$j = $i;
		}
	?>
	<option value="<?php echo $j;?>" <?php if ($getDay == $j) { echo " selected "; } ?>><?php echo $j;?></option>
	<?php } ?>
	</select> Year <select name="bbbyear">
	<?php 
	$thisYear = date ("Y");
	for ($i=0;$i<=4;$i++) {?>
	<option value="<?php echo ($thisYear + $i);?>" <?php if ($getYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
	<?php }?>
	</select>
	</td>
	<td>&nbsp;</td>
	<td colspan="4" align="center">
	Available end date:<br>
	Month <select name="bbemonth">
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
	</select> Day <select name="bbeday"> 
	<?php for ($i=1;$i<=31;$i++) {
		if ($i<=9) {
			$j = "0".$i;
		} else {
			$j = $i;
		}
	?>
	<option value="<?php echo $j;?>" <?php if ($getDay == $j) { echo " selected "; } ?>><?php echo $j;?></option>
	<?php } ?>
	</select> Year <select name="bbeyear">
	<?php 
	$thisYear = date ("Y");
	for ($i=0;$i<=4;$i++) {?>
	<option value="<?php echo ($thisYear + $i);?>" <?php if (($getYear+1) == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
	<?php }?>
	</select>
	</td>
</tr>
  <tr>
    <td width="87" height="57">
      <p align="right">Bedrooms:</td>
    <center>
    <td width="131" height="57"><select name="rooms[]" multiple size="2">
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
    </center>
    <td width="122" height="57">
      <p align="right">Bath:</td>
    <center>
    <td width="112" height="57"><select name="bath[]" multiple size="2">
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
    <td width="104" height="60" align="right">Pets:</td>
      <td width="95" height="60"><select name="pets[]" multiple size="2">
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
    <td width="112" align="center" colspan="2"><input type="submit" value="Filter"></form>  <form action="<?php echo "$PHP_SELF?op=listings";?>" method="POST"><input type="submit" value="Clear"><input type="hidden" name="clear_filter" value="1"></td>
    </tr>
    </form>
    <tr>
      
      
    </tr>

  </table>
  </td>
  </tr>
  <tr>
  <td align="center"><font size="-2" color="#999999"><i>Use CTR+click to select multiple items.</i></font></td>
  </tr>
  <tr>
  <td align="center"><font size="-2" color="#999999">
  <?php echo $filter_string_display;?>
  </td>
  </tr>
  </table>
  
	<form action="<?php echo "$PHP_SELF";?>" method="GET" name="limitNForm">Show <input type="hidden" name="op" value="listings"><input type="text" size="4" name="limitN" value="<?php echo $limitN;?>"> records per page.<input type="submit" value="Show"></form>
	View page:
		    <?php for ($i=1;$i<=$numPages;$i++) { 
		    	$thisCalc = $limitN * ($i-1);
		    	if (!$thisCalc) {
		    		$thisCalc = "z";
		    	}
		    	$bold = ($thisCalc==$start) ? "<b>" : " ";
		    	$endBold = ($thisCalc==$start) ? "</b>" : " ";
		    	?>
		    <a href="<?php echo "$PHP_SELF?op=listings&start=$thisCalc";?>"><?php echo $bold;?><?php echo $i;?><?php echo $endBold;?></a> <?php if ($i<$numPages) { echo " | ";} ?>
		    <?php }?>
		    &nbsp;| <a href="<?php echo "$PHP_SELF?op=listings&start=z&limitN=$num_rows";?>">Show all listings</a> 	    
	<table border="0" cellpadding="2" cellspacing="4">
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
		
		
		<td width="<?php echo $col[2]; ?>" height="28" bgcolor="<?php echo $bgcolor;?>" align="middle"><a href="<?php echo "$PHP_SELF?op=listings&sort=$col[1]&sortD=$antiSortD";?>"><font color="<?php echo $rowGetView['COLOR1'];?>"><?php echo $col[3];?><?php echo $sortImage;?></font></a></td>
	
	<?php } ?>
	<!--END TOP COLUMN-->
	</tr>
	
	<!--RECORDS -->
	<?php while ($rowGetListings = mysqli_fetch_array($quGetListings)) { ?>
	
		<tr>
		<?php 
		$i = 0;
		foreach ($cols as $col) { 
			
			
			
			?>
		
			<td width="<?php echo $col[2]; ?>" height="28" bgcolor="<?php echo $rowGetView['COLOR2'];?>" align="center" nowrap>
			<?php if ($col[0]=='f') { 
				if ($col[5]) { //use images;
					if (!$rowGetListings[$col[1]]) {
						echo "<img src='../images/icons/" . $col[4] . "' border='0' alt='" . $col[3] . "=" . $rowGetListings[$col[1]] . "'>";
					}elseif ($rowGetListings[$col[1]] >= 5) {                          
						echo "<img src='../images/icons/" . $col[9] . "' border='0'alt='" . $col[3] . "=" . $rowGetListings[$col[1]] . "'>";
					}elseif ($rowGetListings[$col[1]] >= 4) {                          
						echo "<img src='../images/icons/" . $col[8] . "' border='0' alt='" . $col[3] . "=" . $rowGetListings[$col[1]] . "'>";
					}elseif ($rowGetListings[$col[1]] >= 3) {                          
						echo "<img src='../images/icons/" . $col[7] . "' border='0' alt='" . $col[3] . "=" . $rowGetListings[$col[1]] . "'>";
					}elseif ($rowGetListings[$col[1]] >= 2) {                          
						echo "<img src='../images/icons/" . $col[6] . "' border='0' alt='" . $col[3] . "=" . $rowGetListings[$col[1]] . "'>";
					}elseif ($rowGetListings[$col[1]] >= 1) {                          
						echo "<img src='../images/icons/" . $col[5] . "' border='0' alt='" . $col[3] . "=" . $rowGetListings[$col[1]] . "'>";
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
			}elseif ($col[0]=='a') { 
				echo "<a href=\"javascript:popUp('$PHP_SELF?op=" . $actions[$col[1]] . "&cid=" . $rowGetListings['CID'] . "&dontPrintHeader=1')\">" . $col[1] ."</a>";
				//echo  "<a href=\"$PHP_SELF?op=" . $actions[$col[1]] . "&cid=". $rowGetListings['CID'] ."\">". $col[1] ."</a>"; 
			} ?>
			</td>
	
		<?php } ?>
		</tr>
	
	<?php } ?>
	<!--END RECORDS-->
	<tr>
	<td colspan="100" align="center">
	<hr>
	View page: 
		    <?php for ($i=1;$i<=$numPages;$i++) { 
		    	$thisCalc = $limitN * ($i-1);
		    	if (!$thisCalc) {
		    		$thisCalc = "z";
		    	}
		    	$bold = ($thisCalc==$start) ? "<b>" : " ";
		    	$endBold = ($thisCalc==$start) ? "</b>" : " ";
		    	?>
		    <a href="<?php echo "$PHP_SELF?op=listings&start=$thisCalc";?>"><?php echo $bold;?><?php echo $i;?><?php echo $endBold;?></a> <?php if ($i<$numPages) { echo " | ";} ?>
		    <?php }?>
		    &nbsp;| <a href="<?php echo "$PHP_SELF?op=listings&start=z&limitN=$rowLimitCount->COUNTOF";?>">Show all listings</a> 
		    
	</td>
	</tr>
	</table>
	</center>

<!--END listings -->
<?php } elseif ($page=="viewListing") { ?>
<!--BEGIN viewListing -->
	<?php
	$avail = ($rowGetAd->AVAIL=="0000-00-00") ? "" : "$rowGetAd->AVAIL";
	$availb = ($rowGetAd->AVAILB) ? "Yes" : "No";
	$status = ($rowGetAd->STATUS=="ACT") ? "Active" : "Inactive";
	$price = ($rowGetAd->PRICE) ? "$" . number_format ($rowGetAd->PRICE) : "";
	
	?>	
	
	<div align="center">
	<p>
	<center><h2>View Listing <?php echo "$abv-$cid";?></h2>
	<?php if ($dontPrintHeader) { ?>
		<a href="<?php echo "$PHP_SELF?op=editListing&cid=$cid";?>">switch to edit mode</a> | <a href="javascript:print_screen();">Print Screen</a> | <a href="javascript:close_window();">Close Window</a>
	<?php } else { ?>
	<a href="<?php echo "$PHP_SELF?op=editListing&cid=$cid";?>">switch to edit mode</a> | <a href="<?php echo "$PHP_SELF?op=viewListing&cid=$cid&dontPrintHeader=1";?>">switch to print mode</a> | <a href="<?php echo "$PHP_SELF?op=edit&cid=$cid";?>">edit advertisment</a></center>
	<?php } ?>
	
	<table cellpadding="4" cellspacing ="0" border=0>
	<tr>
		<td colspan=3>
		<p>
		<?php echo $rowGetAd->SIG;?>
		</p>
		</td>
		
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td >
		<p>
		Landlord:<br>
		<b><?php echo $rowGetAd->HOME_NAME_FIRST;?> <?php echo $rowGetAd->HOME_NAME_LAST;?>,<br> <?php echo $rowGetAd->OFF_NAME;?></b>
		</td>
		<td align="center" width="50%">
		<p>
		<b>
		<?php echo $rowGetAd->LOCNAME;?><br>
		<?php echo $rowGetAd->STREET;?> <?php if ($rowGetAd->APT) { echo", Apt. $rowGetAd->APT"; }?><br>
		<?php echo $DEFINED_VALUE_SETS['ROOMS'][$rowGetAd->ROOMS];?> / <?php echo $DEFINED_VALUE_SETS['BATH'][$rowGetAd->BATH];?>
		
		<br>
		<?php if ($rowGetAd->PETSA) { echo $DEFINED_VALUE_SETS['PETSA'][$rowGetAd->PETSA]; } ?>
		</b>
		</p>
		</td>
		<td align="right" >
		<p>
		<b><?php echo $rowGetAd->NAME;?></b>
		<br>
		entry date:
		<br>
		<?php echo $rowGetAd->DATEIN;?>
		<br>
		last modified:
		<br>
		<?php echo $rowGetAd->MOD;?><br>
		By:<?php echo $rowGetAd->MODBY;?>
		
		</p>
		</td>
	</tr>
	<tr> 
		<td colspan="3" align="center" width="50%">
		<br>Available: <?php echo $rowGetAd->AVAIL;?>
		<br>Price: <?php echo $price;?>
		</td>
	<tr>
		<td ><img src="spacer.gif" width="100%" height="1"></td>
		<td ><img src="spacer.gif" width="100%" height="1"></td>
		<td ><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
		<b>Status:</b>
		<br>
		Advertising: <?php if ($rowGetAd->STATUS=="ACT") { echo "Active"; } else { echo "Inactive"; }?> &nbsp;&nbsp;|&nbsp;&nbsp; 
		Vacancy: <?php if ($rowGetAd->VACANT) { echo "Vacant"; } else { echo "Occupied"; }?> &nbsp;&nbsp;|&nbsp;&nbsp; 
		Available: <?php if ($rowGetAd->STATUS_ACTIVE) { echo "Available"; } else { echo "Not available"; }?><br>  
		</td>
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="left">
		<b>Advertisement:</b>
		<br>
		<?php echo format_ad($rowGetAd, $DEFINED_VALUE_SETS);?>
		</td>
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan=3>
		<b>Notes:</b>
		<br>
		<?php echo $rowGetAd->LISTING_NOTES;?>
		</td>
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	</table>
	</p>
	<p>
	<table cellpadding="4" cellspacing ="0" border=0>
	<tr>
		<td colspan="4">
		<b></b>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>listing type:</b>
		</td>
		<td width="25%">
		<?php echo $DEFINED_VALUE_SETS['LISTING_TYPE'][$rowGetAd->LISTING_TYPE];?>
		</td>
		<td width="25%" align="right">
		<b>date listed</b>
		</td>
		<td width="25%">
		<?php echo $rowGetAd->DATEIN;?>
		</td>
	</tr>
		<td width="25%" align="right">
		<b>lease type:</b>
		</td>
		<td width="25%">
		<?php echo $DEFINED_VALUE_SETS['LEASE_TYPE'][$rowGetAd->LEASE_TYPE];?>
		</td>
		<td width="25%" align="right">
		<b>terms:</b>
		</td>
		<td width="25%">
		<?php echo $rowGetAd->TERMS;?>
		</td>
	</tr>
	</tr>
		<td width="25%" align="right">
		<b>price negotiable:</b>
		</td>
		<td width="25%">
		<?php if ($rowGetAd->PRICE_NEG) { echo "Yes"; } else { echo "No."; } ?>
		</td>
		<td width="25%" align="right">
		&nbsp;
		</td>
		<td width="25%">
		&nbsp;
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<b>Fee</b>
		</td>
	</tr>
		<td width="25%" align="right">
		<b>Broker Fee:</b>
		</td>
		<td width="25%">
		<?php echo "\$" . $rowGetAd->BROKER_FEE;?> 
		</td>
		<td width="25%" align="right">
		<b></b>
		</td>
		<td width="25%">
		&nbsp;
		</td>
	</tr>
		<td width="25%" align="right">
		<b>First:</b>
		</td>
		<td width="25%">
		<?php echo "\$" . $rowGetAd->PAYMENT_FIRST;?> 
		</td>
		<td width="25%" align="right">
		<b>&nbsp</b>
		</td>
		<td width="25%">
		
		</td>
		<td width="25%" align="right">
		
		
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Last:</b>
		</td>
		<td width="25%">
		<?php echo "\$" . $rowGetAd->PAYMENT_LAST;?>  
		</td>
		<td width="25%" align="right">
		&nbsp;
		</td>
		<td width="25%">
		&nbsp;
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Security:</b>
		</td>
		<td width="25%">
		<?php echo "\$" . $rowGetAd->PAYMENT_SEC;?> 
		</td>
		<td width="25%" align="right">
		<b>&nbsp;</b>
		</td>
		<td width="25%">
		&nbsp;
		</td>
		
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Key Deposit:</b>
		</td>
		<td width="25%">
		<?php echo "\$" . $rowGetAd->KEY_DEPOSIT;?> 
		</td>
		
		
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Cleaning Deposit:</b>
		</td>
		<td width="25%">
		<?php echo "\$" . $rowGetAd->CLEAN_DEPOSIT;?> 
		</td>
		
		
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Total:</b>
		</td>
		<td width="25%">
		<?php 
			$totalDue = ($rowGetAd->PAYMENT_LAST + $rowGetAd->PAYMENT_FIRST + $rowGetAd->PAYMENT_SEC + $rowGetAd->BROKER_FEE + $rowGetAd->KEY_DEPOSIT + $rowGetAd->CLEAN_DEPOSIT );
			
		?>
		<?php echo "\$" . $totalDue;?> 
		</td>
	</tr>
	
	<tr>
		<td width="25%" align="right">
		<b>Fee Comments:</b>
		</td>
		<td width="25%">
		<?php echo $rowGetAd->FEE_COMMENTS;?>
		</td>
		
	<tr>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	
	<tr>
		<td colspan="4">
		<b>Parking</b>
		</td>
	</tr>
		<td width="25%" align="right">
		<b>Number of spaces:</b>
		</td>
		<td width="25%">
		<?php echo $rowGetAd->PARKING_NUM;?>
		</td>
		<td width="25%" align="right">
		<b>Cost per space</b>
		</td>
		<td width="25%">
		<?php echo "\$" . $rowGetAd->PARKING_COST;?>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Type:</b>
		</td>
		<td width="25%">
		<?php echo $DEFINED_VALUE_SETS['PARKING_TYPE'][$rowGetAd->PARKING_TYPE];?>
		</td>
		<td width="25%" align="right">
		<b>&nbsp</b>
		</td>
		<td width="25%">
		
		</td>
		<td width="25%" align="right">
		
		
	</tr>
	<tr>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<b>Key Info</b>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Key is:</b>
		</td>
		<td width="25%">
		<?php echo $rowGetAd->KEY_INFO;?>
		</td>
		<td width="25%" align="right">
		<b>&nbsp</b>
		</td>
		
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Show instructions:</b>
		</td>
		<td colspan="2">
		<?php echo $rowGetAd->SHOW_INSTRUCT;?>
		</td>
		
		
	</tr>
	<tr>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<b>Laundry/Storage</b>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Laundry:</b>
		</td>
		<td width="25%">
		<?php echo $DEFINED_VALUE_SETS['LAUNDRY_ROOM'][$rowGetAd->LAUNDRY_ROOM];?>
		</td>
		<td width="25%" align="right" valign="top">
		<b>Storage:</b>
		</td>
		<td width="25%">
		Attic: <?php if ($rowGetAd->STORAGE_ATTIC) { echo "Yes."; } else { echo "No.";}?><br>
		Basement: <?php if ($rowGetAd->STORAGE_BASEMENT) {echo "Yes."; }else { echo "No.";}?><br>
		Bin: <?php if ($rowGetAd->STORAGE_BIN) {echo "Yes."; }else { echo "No."; }?><br>
		</td>
		
	</tr>
	<tr>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="%100" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	</table>
	<p>
	<table cellpadding="4" cellspacing ="0" border=0>
	<tr>
		<td colspan="4">
		<b>Features:</b>
		</td>
	</tr>
	<?php 
	 
	?>
	<tr>
		<td colspan="3">
		<?php 
		
		if ($rowGetAd->FEATURES_DELEADED        ) { echo "Deleaded"         ; }
		if ($rowGetAd->FEATURES_FURNISHED       ) { echo " &nbsp;&nbsp;Furnished"     ; }
		if ($rowGetAd->FEATURES_NON_SMOKING     ) { echo " &nbsp;&nbsp;Non-smoking"   ; }
		if ($rowGetAd->FEATURES_ALARM           ) { echo " &nbsp;&nbsp;Alarm"         ; }
		if ($rowGetAd->FEATURES_HEAT            ) { echo " &nbsp;&nbsp;Heat"          ; }
		if ($rowGetAd->FEATURES_HOT_WATER       ) { echo " &nbsp;&nbsp;Hot Water"     ; }
		if ($rowGetAd->FEATURES_HT_AND_HW       ) { echo " &nbsp;&nbsp;Heat & Hot Water"       ; }
		if ($rowGetAd->FEATURES_ALL_UTILITIES   ) { echo " &nbsp;&nbsp;All Utilities" ; }
		if ($rowGetAd->FEATURES_GAS_HEAT        ) { echo " &nbsp;&nbsp;Gas Heat"      ; }
		if ($rowGetAd->FEATURES_OIL_HEAT        ) { echo " &nbsp;&nbsp;Oil Heat"      ; }
		if ($rowGetAd->FEATURES_ELEC_HEAT       ) { echo " &nbsp;&nbsp;Electric Heat"     ; }
		if ($rowGetAd->FEATURES_HWFI            ) { echo " &nbsp;&nbsp;Hardwood floors"          ; }
		if ($rowGetAd->FEATURES_FIREPLACE       ) { echo " &nbsp;&nbsp;Fireplace"     ; }
		if ($rowGetAd->FEATURES_CARPET          ) { echo " &nbsp;&nbsp;Carpet"        ; }
		if ($rowGetAd->FEATURES_MODERN_KITCHEN  ) { echo " &nbsp;&nbsp;Modern Kitchen"; }
		if ($rowGetAd->FEATURES_KITCHENETTE     ) { echo " &nbsp;&nbsp;Kitchenette"   ; }
		if ($rowGetAd->FEATURES_EAT_IN_KITCHEN  ) { echo " &nbsp;&nbsp;Eat-in-Kitchen"; }
		if ($rowGetAd->FEATURES_GAS_RANGE       ) { echo " &nbsp;&nbsp;Gas Range"     ; }
		if ($rowGetAd->FEATURES_ELEC_RANGE      ) { echo " &nbsp;&nbsp;Elec Range"    ; }
		if ($rowGetAd->FEATURES_DISPOSAL        ) { echo " &nbsp;&nbsp;Disposal"      ; }
		if ($rowGetAd->FEATURES_DISHWASHER      ) { echo " &nbsp;&nbsp;Dishwasher"    ; }
		if ($rowGetAd->FEATURES_SKYLIGHT        ) { echo " &nbsp;&nbsp;Skylight"      ; }
		if ($rowGetAd->FEATURES_PORCH           ) { echo " &nbsp;&nbsp;Porch"         ; }
		if ($rowGetAd->FEATURES_BALCONY         ) { echo " &nbsp;&nbsp;Balcony"       ; }
		if ($rowGetAd->FEATURES_PATIO           ) { echo " &nbsp;&nbsp;Patio"         ; }
		if ($rowGetAd->FEATURES_CENTRAL_AC      ) { echo " &nbsp;&nbsp;Central AC"    ; }
		if ($rowGetAd->FEATURES_AC              ) { echo " &nbsp;&nbsp;AC"            ; }
		if ($rowGetAd->FEATURES_DECK            ) { echo " &nbsp;&nbsp;Deck"          ; }
		if ($rowGetAd->FEATURES_MODERN_BATH     ) { echo " &nbsp;&nbsp;Modern Bath"   ; }
		if ($rowGetAd->FEATURES_DINNING_ROOM    ) { echo " &nbsp;&nbsp;Dining Room"  ; }
		
		
		
		?>
		</td>
		
	</tr>   
	<tr>    
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>   
	<tr>    
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>   
	<tr>    
		<td colspan="4">
		<b>Amenities:</b>
		</td>
	</tr>   
	<?php //divide by three here and list $Amenities; 
	?>      
	<tr>    
		<td colspan="3">
		
		<?php 
		if ($rowGetAd->AMENITIES_CONCIEARGE ) { echo "Concierge"    ; }
		if ($rowGetAd->AMENITIES_ELEVATOR   ) { echo " &nbsp;&nbspElevator"   ; }
		if ($rowGetAd->AMENITIES_DECK       ) { echo " &nbsp;&nbspDeck"       ; }
		if ($rowGetAd->AMENITIES_ROOF_DECK  ) { echo " &nbsp;&nbspRoof Deck"  ; }
		if ($rowGetAd->AMENITIES_GARDEN     ) { echo " &nbsp;&nbspGarden"     ; }
		if ($rowGetAd->AMENITIES_YARD       ) { echo " &nbsp;&nbspYard"       ; }
		if ($rowGetAd->AMENITIES_SECURITY   ) { echo " &nbsp;&nbspSecurity"   ; }
		if ($rowGetAd->AMENITIES_HEALTH_CLUB) { echo " &nbsp;&nbspHealth Club"; }
		if ($rowGetAd->AMENITIES_POOL       ) { echo " &nbsp;&nbspPool"       ; }
		if ($rowGetAd->AMENITIES_TENNIS     ) { echo " &nbsp;&nbspTennis"     ; }
		if ($rowGetAd->AMENITIES_LOUNGE     ) { echo " &nbsp;&nbspLounge"     ; }
		if ($rowGetAd->AMENITIES_SAUNA      ) { echo " &nbsp;&nbspSauna"      ; }
		if ($rowGetAd->AMENITIES_HIGH_CEILINGS      ) { echo " &nbsp;&nbspHigh Ceilings"      ; }
		if ($rowGetAd->AMENITIES_WALK_IN_CLOSET      ) { echo " &nbsp;&nbspWalk-in Closet"      ; }
		if ($rowGetAd->AMENITIES_BALCONY      ) { echo " &nbsp;&nbspBalcony"      ; }
		


		?>                                                                
		
		</td>
		
	</tr>
	<?php if ($rowGetAd->BUILDING_TYPE) { ?>
	<tr>
		<td width="25%"><img src="spacer.gif" width=151 height="1"></td>
		<td width="25%"><img src="spacer.gif" width=151 height="1"></td>
		<td width="25%"><img src="spacer.gif" width=151 height="1"></td>
		<td width="25%"><img src="spacer.gif" width=151 height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	<tr>
		<td colspan="4">
		<b>Building Type:</b>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<?php echo $DEFINED_VALUE_SETS['BUILDING_TYPE'][$rowGetAd->BUILDING_TYPE]; ?>
		</td>
		
	</tr>
	<?php }?>
	
	<tr>
	
	
	
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	<tr>
		<td colspan="4">
		<b>Misc:</b>
		</td>
	</tr>
	<tr>
		
		<td width="25%" align="right" valign="top">
		Students:
		</td>
		<td width="25%">
		<?php  echo $rowGetAd->STUDENTS;?>
		</td>
		
	</tr>
	<tr>
		<td width="25%" align="right">
		Tax Clause:
		</td>
		<td width="25%">
		<?php echo $rowGetAd->TAX_CLAUSE;?>
		</td>
		<td width="25%" align="right" valign="top">
		Alarm:
		</td>
		<td width="25%">
		<?php  echo $rowGetAd->ALARM;?>
		</td>
		
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<?php if ($rowGetAd->LANDLORD) { ?>
	<tr>
		<td colspan="4">
		<b>Landlord</b>
		</td>
	</tr>
	
	
	<tr>
		<td width="25%" align="right" valign="top" >
		<?php echo $rowGetAd->HOME_NAME_FIRST;?>  <?php echo $rowGetAd->HOME_NAME_LAST;?><br><br>
		
			<?php
			if ($rowGetAd->HOME_STREET) {
				echo "Home Address:<br> \n";
				echo "$rowGetAd->HOME_STREET <br> \n $rowGetAd->HOME_STATE $rowGetAd->HOME_ZIP <br><br>";
			}
			if ($rowGetAd->HOME_PHONE) {
				echo "Home Phone: $rowGetAd->HOME_PHONE <br> \n";
			}
			if ($rowGetAd->HOME_FAX) {
				echo "Home Fax: $rowGetAd->HOME_FAX <br> \n";
			}
			?>
		
		
		
		</td>
		<td width="25%" align="right" valign="top" >
		<?php echo $rowGetAd->OFF_NAME;?><br><br>
		
		<?php
			if ($rowGetAd->OFF_STREET) {
				echo "Business Address:<br> \n";
				echo "$rowGetAd->OFF_STREET <br> \n";
				echo "$rowGetAd->OFF_CITY, $rowGetAd->OFF_STATE $rowGetAd->OFF_ZIP<br><br>";
			}
			if ($rowGetAd->OFF_PHONE) {
				echo "Business Phone: $rowGetAd->OFF_PHONE <br> \n";
			}
			if ($rowGetAd->OFF_FAX) {
				echo "Business Fax: $rowGetAd->OFF_FAX <br><br> \n";
			}
			
			?>
		</td>
	</tr>
	<tr>
		<td  colspan="2">
		
			<?php 
			if ($rowGetAd->LLNOTES) {
				echo "<br><br>COMMENTS: $rowGetAd->LLNOTES <br> \n";
			}
			if ($rowGetAd->ADDENDUM) {
				echo "<br><br>ADDENDUM: $rowGetAd->ADDENDUM <br> \n";
			}
			?>
		</td>
	</tr>
	
	<? } ?>
	
		<tr>
		<td colspan="3" align="center">
		&nbsp;
		</td>
	</tr>
	</table>
	</p>
	</div>
	
	
	


<!--END viewListing -->
<?php } elseif ($page=="editListing") { ?>
<!--BEGIN editListing -->
	<?php
	$avail = ($rowGetAd->AVAIL=="0000-00-00") ? "" : "$rowGetAd->AVAIL";
	$availb = ($rowGetAd->AVAILB) ? "Yes" : "No";
	$status = ($rowGetAd->STATUS=="ACT") ? "Active" : "Inactive";
	$price = ($rowGetAd->PRICE) ? "$" . number_format ($rowGetAd->PRICE) : "";
	?>
	
	<div align="center">
	<p>
	<center><h2>Edit Listing <?php echo "$abv-$cid";?></h2>
	<font size="-2" color="#999999">(changes not saved until 'Update' is pressed)</font><br><br>
	<a href="<?php echo "$PHP_SELF?op=viewListing&cid=$cid&dontPrintHeader=1";?>">switch to view mode</a> | <a href="<?php echo "$PHP_SELF?op=viewListing&cid=$cid&dontPrintHeader=1";?>">switch to print mode</a> | <a href="<?php echo "$PHP_SELF?op=edit&cid=$cid";?>">edit advertisement</a></center>
	<table width="100%" cellpadding="4" cellspacing ="0" border=0>
	<form action="<?php echo "$PHP_SELF?op=editListingDo";?>" method="POST">
	<input type="hidden" name="CID" value="<?php echo $rowGetAd->CID;?>">
	<tr>
		<td colspan=3>
		<p>
		<?php echo $rowGetAd->SIG;?>
		</p>
		</td>
		
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td>
		<p>
		<table border="0">
		<tr>
		<td colspan="4">
		<b>Landlord</b>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<select name="LANDLORD"> 
		<option value="--">--</option>
		<?php while ($rowLandlord = mysqli_fetch_object($quLandlord)) { ?>
			<option value="<?php echo $rowLandlord->LID;?>" <?php if ($rowGetAd->LID==$rowLandlord->LID) { echo " selected "; } ?>><?php echo $rowLandlord->SHORT_NAME;?></option>
		<?php } ?>
		</select>
		</td>
		
	</tr>
	</table>
		</p>
		</td>
		<td align="center">
		<p>
		<b>
		<table border="0">
		<tr>
			<td align="right">
			Location: 
			</td>
			<td align="left">
			<select name="LOC">
			<?php while ($rowLoc = mysqli_fetch_object($quLocs)) { ?>
				<option value="<?php echo $rowLoc->LOCID;?>" <?php if ($rowGetAd->LOC==$rowLoc->LOCID) { echo "selected "; }?>><?php echo $rowLoc->LOCNAME;?></option>
			<?php } ?>
			</select>
			</td>
		</tr>
		<tr>
			<td align="right">
			Street Address:
			</td>
			<td align="left">
			<input type="text" name="STREET" size="14" value="<?php echo $rowGetAd->STREET;?>">
			</td>
		</tr>
		<tr>
			 <td align="right">
			 Apartment #: 
			 </td>
			 <td align="left">
			 <input type="text" size="3" name="APT" value="<?php echo $rowGetAd->APT;?>">
			 </td>
		</tr>
		<tr>
			<td align="right">
			Bedrooms:
			</td>
			<td align="left">
			<select name="ROOMS">
			<option value="--">--</option>
			<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $roomkey => $roomVal) {?>
			<option value="<?php echo $roomkey;?>" <?php if ($rowGetAd->ROOMS==$roomkey) { echo " selected "; }?>><?php echo $roomVal;?></option>
			<?php } ?> 
			</select>
			</td>
		</tr>
		<tr>
			<td align="right">
			Baths:
			</td>
			<td align="left">
			<select name="BATH">
			<option value="--">--</option>
			<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bathkey => $bathVal) { ?>
			<option value="<?php echo $bathkey;?>" <?php if ($rowGetAd->BATH==$bathkey) { echo " selected "; }?>><?php echo $bathVal;?></option>
			<?php }?>
			</select>
			</td>
		</tr>
		<tr>
			<td align="right">
			Pets:
			</td>
			<td align="left">
			<select name="PETSA">
			<option value="--">--</option>
			<?php foreach ($DEFINED_VALUE_SETS['PETSA'] as $petkey => $petVal) { ?>
			<option value="<?php echo $petkey;?>" <?php if ($rowGetAd->PETSA==$petkey) { echo " selected "; }?>><?php echo $petVal;?></option>
			<?php }?>
			</select>
			</td>
		</tr>
		</table>
		
		</b>
		</p>
		</td>
		<td align="right">
		<p>
		<b><?php echo $rowGetAd->NAME;?></b>
		<br>
		entry date:
		<br>
		<?php echo $rowGetAd->DATEIN;?>
		<br>
		last modified:
		<br>
		<?php echo $rowGetAd->MOD;?><br>
		By:<?php echo $rowGetAd->MODBY;?>
		
		</p>
		</td>
	</tr>
	<tr>
	<td colspan="4" align="center">
	<?php 
	$getMon = subStr ($rowGetAd->AVAIL, 5, 2);
	$getDay = subStr ($rowGetAd->AVAIL, 8, 2);
	$getYear = subStr ($rowGetAd->AVAIL, 0, 4);
	?>
	Available: Month <select name="bbbMonth">
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
	</select> Day <select name="bbbDay"> 
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
	</select> Year <select name="bbbYear">
	<option value="--">--</option>
	<?php 
	$thisYear = date ("Y");
	for ($i=0;$i<=4;$i++) {?>
	<option value="<?php echo ($thisYear + $i);?>" <?php if ($getYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
	<?php }?>
	</select>
	<br>
	Price: $<input type="text" size="5" name="PRICE" value="<?php echo $rowGetAd->PRICE;?>">
	
	</td>
	<tr>
		<td><img src="spacer.gif" width="100%" height="1"></td>
		<td><img src="spacer.gif" width="100%" height="1"></td>
		<td><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="5" align="right">
		<input type="submit" value="Update">
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
		<b>Status:</b>
		<br>
		Advertising: <input type="hidden" name="STATUS" value="STO"><input type="checkbox" value="ACT" name="STATUS" <?php if ($rowGetAd->STATUS=="ACT") { echo " checked "; } ?>> &nbsp;&nbsp;|&nbsp;&nbsp; 
		Vacancy: <input type="hidden" name="VACANT" value="0"><input type="checkbox" value="1" name="VACANT" <?php if ($rowGetAd->VACANT) { echo " checked "; } ?>> &nbsp;&nbsp;|&nbsp;&nbsp; 
		Available: <input type="hidden" name="STATUS_ACTIVE" value="0"><input type="checkbox" value="1" name="STATUS_ACTIVE" <?php if ($rowGetAd->STATUS_ACTIVE) { echo " checked "; } ?>><br>  
		</td>
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="5" align="right">
		<input type="submit" value="Update">
		</td>
	</tr>
	<tr>
		<td colspan="3" >
		<b>Advertisement:</b>
		<br>
		<textarea name="bbbBODY" rows="10" cols="50"><?php echo $rowGetAd->BODY;?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="5" align="right">
		<input type="submit" value="Update">
		</td>
	</tr>
	<tr>
		<td colspan=3>
		<b>Notes:</b>
		<br>
		<textarea name="LISTING_NOTES" rows="4" cols="40"><?php echo $rowGetAd->LISTING_NOTES;?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan=3>
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="5" align="right">
		<input type="submit" value="Update">
		</td>
	</tr>
	</table>
	</p>
	<p>
	<table cellpadding="4" cellspacing ="0" border=0>
	<tr>
		<td colspan="4">
		<b></b>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>listing type:</b>
		</td>
		<td width="25%">
		<select name="LISTING_TYPE">
		<option value="--">--</option>
		<?php foreach ($DEFINED_VALUE_SETS['LISTING_TYPE'] as $lskey => $lsVal) { ?>
			<option value="<?php echo $lskey;?>" <?php if ($rowGetAd->LISTING_TYPE==$lskey) { echo " selected "; } ?> ><?php echo $lsVal;?></option>
		<?php } ?>
		</select>
		</td>
		<td width="25%" align="right">
		<b>date listed</b>
		</td>
		<td width="25%">
		<?php echo $rowGetAd->DATEIN;?>
		</td>
	</tr>
		<td width="25%" align="right">
		<b>lease type:</b>
		</td>
		<td width="25%">
		<select name="LEASE_TYPE">
		<option value="--">--</option>
		<?php foreach ($DEFINED_VALUE_SETS['LEASE_TYPE'] as $lkey => $lVal) { ?>
			<option value="<?php echo $lkey;?>" <?php if ($rowGetAd->LEASE_TYPE==$lkey) { echo " selected "; }?> > <?php echo $lVal;?></option>
		<?php } ?>
		</select>
		
		</td>
		<td width="25%" align="right">
		<b>terms:</b>
		</td>
		<td width="25%">
		<input type="text" size="3" name="TERMS" value="<?php echo $rowGetAd->TERMS;?>">
		</td>
	</tr>
	</tr>
		<td width="25%" align="right">
		<b>price negotiable:</b>
		</td>
		<td width="25%">
		No <input type="radio" value="0" name="PRICE_NEG" <?php if (!$rowGetAd->PRICE_NEG) { echo "checked"; }?> > Yes <input type="radio" value="1" name="PRICE_NEG" <?php if ($rowGetAd->PRICE_NEG) { echo "checked"; }?> >
		</td>
		<td width="25%" align="right">
		&nbsp;
		</td>
		<td width="25%">
		&nbsp;
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="5" align="right">
		<input type="submit" value="Update">
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<b>Fee</b>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Broker Fee:</b>
		</td>
		<td width="25%">
		$<input type="text" size="5" name="BROKER_FEE" value="<?php echo $rowGetAd->BROKER_FEE;?>">&nbsp;&nbsp;&nbsp; 
		</td>
		<td width="25%" align="right">
		<b></b>
		</td>
		<td width="25%">
		&nbsp;
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>First:</b>
		</td>
		<td width="25%">
		$<input type="text" size="5" name="PAYMENT_FIRST" value="<?php echo $rowGetAd->PAYMENT_FIRST;?>">&nbsp;&nbsp;&nbsp; 
		</td>
		<td width="25%" align="right">
		<b>&nbsp</b>
		</td>
		<td width="25%">
		
		</td>
		<td width="25%" align="right">
		
		
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Last:</b>
		</td>
		<td width="25%">
		$<input type="text" name="PAYMENT_LAST" size="5" value="<?php echo $rowGetAd->PAYMENT_LAST;?>">&nbsp;&nbsp;&nbsp; 
		</td>
		<td width="25%" align="right">
		&nbsp;
		</td>
		<td width="25%">
		&nbsp;
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Security:</b>
		</td>
		<td width="25%">
		$<input type="text" size="5" name="PAYMENT_SEC" value="<?php echo $rowGetAd->PAYMENT_SEC;?>">&nbsp;&nbsp;&nbsp; 
		</td>
		<td width="25%" align="right">
		<b>&nbsp;</b>
		</td>
		<td width="25%">
		&nbsp;
		</td>
		
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Key Deposit:</b>
		</td>
		<td width="25%">
		$<input type="text" name="KEY_DEPOSIT" size="5" value="<?php echo $rowGetAd->KEY_DEPOSIT;?>">&nbsp;&nbsp;&nbsp; 
		</td>
		<td width="25%" align="right">
		<b>&nbsp;</b>
		</td>
		<td width="25%">
		&nbsp;
		</td>
		
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Cleaning Deposit:</b>
		</td>
		<td width="25%">
		$<input type="text" name="CLEAN_DEPOSIT" size="5" value="<?php echo $rowGetAd->CLEAN_DEPOSIT;?>">&nbsp;&nbsp;&nbsp; 
		</td>
		<td width="25%" align="right">
		<b>&nbsp;</b>
		</td>
		<td width="25%">
		&nbsp;
		</td>
		
	</tr>
	<tr>
		<td width="25%" align="right">
		Fee Comments:
		</td>
		<td width="25%">
		<input type="text" name="FEE_COMMENTS" value="<?php echo $rowGetAd->FEE_COMMENTS;?>">
		</td>
	</tr>
	<tr>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="5" align="right">
		<input type="submit" value="Update">
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<b>Parking</b>
		</td>
	</tr>
		<td width="25%" align="right">
		<b>Number of spaces:</b>
		</td>
		<td width="25%">
		<input type="text" name="PARKING_NUM" size="5" value="<?php echo $rowGetAd->PARKING_NUM;?>">
		</td>
		<td width="25%" align="right">
		<b>Cost per space</b>
		</td>
		<td width="25%">
		$<input type="text" name="PARKING_COST" size="5" value="<?php echo $rowGetAd->PARKING_COST;?>">
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Type:</b>
		</td>
		<td width="25%">
		<select name="PARKING_TYPE">
		<option value="--">--</option>
		<?php foreach ($DEFINED_VALUE_SETS['PARKING_TYPE'] as $parkkey => $parkVal) { ?>
			<option value="<?php echo $parkkey;?>" <?php if ($rowGetAd->PARKING_TYPE==$parkkey) { echo " selected "; }?> > <?php echo $parkVal;?> </option>
		<?php } ?>
		</select>
		</td>
		<td width="25%" align="right">
		<b>&nbsp</b>
		</td>
		<td width="25%">
		
		</td>
		<td width="25%" align="right">
		
		
	</tr>
	<tr>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="5" align="right">
		<input type="submit" value="Update">
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<b>Key Info</b>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Key is:</b>
		</td>
		<td width="25%">
		<input type="text" name="KEY_INFO" value="<?php echo $rowGetAd->KEY_INFO;?>"> <font size="-1" color="999999"><i>Here or Elsewhere...</i></font>
		</td>
		<td width="25%" align="right">
		<b>&nbsp</b>
		</td>
		
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Show instructions:</b>
		</td>
		<td width="25%">
		<textarea name="SHOW_INSTRUCT" rows="5" cols="30"><?php echo $rowGetAd->SHOW_INSTRUCT;?></textarea>
		</td>
		<td width="25%" align="right">
		<b>&nbsp</b>
		</td>
		
	</tr>
	<tr>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="5" align="right">
		<input type="submit" value="Update">
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<b>Laundry/Storage</b>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<b>Laundry:</b>
		</td>
		<td width="25%">
		<select name="LAUNDRY_ROOM">
		<option value="--">--</option>
		<?php foreach ($DEFINED_VALUE_SETS['LAUNDRY_ROOM'] as $launkey => $launVal) {?>
			<option value="<?php echo $launkey; ?>" <?php if ($rowGetAd->LAUNDRY_ROOM==$launkey) { echo " selected "; }?> ><?php echo $launVal;?></option>
		<?php } ?>
		</select>
		</td>
		<td width="25%" align="right" valign="top">
		<b>Storage:</b>
		</td>
		<td width="25%">
		<input type="hidden" name="STORAGE_ATTIC" value="0">
		Attic: <input type="checkbox" name="STORAGE_ATTIC" value="1" <?php if ($rowGetAd->STORAGE_ATTIC) { echo "checked"; }?> ><br>
		<input type="hidden" name="STORAGE_BASEMENT" value="0">
		Basement: <input type="checkbox" name="STORAGE_BASEMENT" value="1" <?php if ($rowGetAd->STORAGE_BASEMENT) {echo "checked"; } ?> ><br>
		<input type="hidden" name="STORAGE_BIN" value="0">
		Bin: <input type="checkbox" name="STORAGE_BIN" value="1" <?php if ($rowGetAd->STORAGE_BIN) {echo "checked"; }?> ><br>
		</td>
		
	</tr>
	<tr>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="5" align="right">
		<input type="submit" value="Update">
		</td>
	</tr>
	</table>
	<p>
	<table cellpadding="4" cellspacing ="0" border=0>
	<tr>
		<td colspan="4">
		<b>Features:</b>
		</td>
	</tr>
	<?php 
	 
	?>
	<tr>
		<td valign="top">
		<table border="0">
		<input type="hidden" name="FEATURES_DELEADED" value="0">
		<tr><td align="right">Deleaded</td><td align="left"><input type="checkbox" name="FEATURES_DELEADED" value="1" <?php if ($rowGetAd->FEATURES_DELEADED) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_FURNISHED" value="0">
		<tr><td align="right">Furnished</td><td align="left"><input type="checkbox" name="FEATURES_FURNISHED" value="1" <?php if ($rowGetAd->FEATURES_FURNISHED) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_NON_SMOKING" value="0">
		<tr><td align="right">Non-smoking</td><td align="left"><input type="checkbox" name="FEATURES_NON_SMOKING" value="1" <?php if ($rowGetAd->FEATURES_NON_SMOKING) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_ALARM" value="0">
		<tr><td align="right">Alarm</td><td align="left"><input type="checkbox" name="FEATURES_ALARM" value="1" <?php if ($rowGetAd->FEATURES_ALARM) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_HEAT" value="0">
		<tr><td align="right">Heat</td><td align="left"><input type="checkbox" name="FEATURES_HEAT" value="1" <?php if ($rowGetAd->FEATURES_HEAT) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_HOT_WATER" value="0">
		<tr><td align="right">Hot Water</td><td align="left"><input type="checkbox" name="FEATURES_HOT_WATER" value="1" <?php if ($rowGetAd->FEATURES_HOT_WATER) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_HT_AND_HW" value="0">
		<tr><td align="right">Heat & Hot Water</td><td align="left"><input type="checkbox" name="FEATURES_HT_AND_HW" value="1" <?php if ($rowGetAd->FEATURES_HT_AND_HW ) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_ALL_UTILITIES" value="0">
		<tr><td align="right">All Utilities</td><td align="left"><input type="checkbox" name="FEATURES_ALL_UTILITIES" value="1" <?php if ($rowGetAd->FEATURES_ALL_UTILITIES) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_GAS_HEAT" value="0">
		<tr><td align="right">Gas Heat</td><td align="left"><input type="checkbox" name="FEATURES_GAS_HEAT" value="1" <?php if ($rowGetAd->FEATURES_GAS_HEAT) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_OIL_HEAT" value="0">
		<tr><td align="right">Oil Heat</td><td align="left"><input type="checkbox" name="FEATURES_OIL_HEAT" value="1" <?php if ($rowGetAd->FEATURES_OIL_HEAT) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_ELEC_HEAT" value="0">
		<tr><td align="right">Electric Heat</td><td align="left"><input type="checkbox" name="FEATURES_ELEC_HEAT" value="1" <?php if ($rowGetAd->FEATURES_ELEC_HEAT) { echo "checked"; } ?> ></td></tr>
		</table>
		</td>
		<td valign="top">
		<table border="0">
		<input type="hidden" name="FEATURES_HWFI" value="0">
		<tr><td align="right">Hardwood Floors</td><td align="left"><input type="checkbox" name="FEATURES_HWFI" value="1" <?php if ($rowGetAd->FEATURES_HWFI) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_FIREPLACE" value="0">
		<tr><td align="right">Fireplace</td><td align="left"><input type="checkbox" name="FEATURES_FIREPLACE" value="1" <?php if ($rowGetAd->FEATURES_FIREPLACE) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_CARPET" value="0">
		<tr><td align="right">Carpet</td><td align="left"><input type="checkbox" name="FEATURES_CARPET" value="1" <?php if ($rowGetAd->FEATURES_CARPET) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name=" FEATURES_MODERN_KITCHEN" value="0">
		<tr><td align="right">Kitchen</td><td align="left"><input type="checkbox" name=" FEATURES_MODERN_KITCHEN" value="1" <?php if ($rowGetAd-> FEATURES_MODERN_KITCHEN) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_KITCHENETTE" value="0">
		<tr><td align="right">Kitchenette </td><td align="left"><input type="checkbox" name="FEATURES_KITCHENETTE" value="1" <?php if ($rowGetAd->FEATURES_KITCHENETTE) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_EAT_IN_KITCHEN" value="0">
		<tr><td align="right">Eat-in-Kitchen </td><td align="left"><input type="checkbox" name="FEATURES_EAT_IN_KITCHEN" value="1" <?php if ($rowGetAd->FEATURES_EAT_IN_KITCHEN) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_GAS_RANGE" value="0">
		<tr><td align="right">Gas Range</td><td align="left"><input type="checkbox" name="FEATURES_GAS_RANGE" value="1" <?php if ($rowGetAd->FEATURES_GAS_RANGE) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_ELEC_RANGE" value="0">
		<tr><td align="right">Electric Range </td><td align="left"><input type="checkbox" name="FEATURES_ELEC_RANGE" value="1" <?php if ($rowGetAd->FEATURES_ELEC_RANGE) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_DISPOSAL" value="0">
		<tr><td align="right">Disposal </td><td align="left"><input type="checkbox" name="FEATURES_DISPOSAL" value="1" <?php if ($rowGetAd->FEATURES_DISPOSAL) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_DISHWASHER" value="0">
		<tr><td align="right">Dishwasher </td><td align="left"><input type="checkbox" name="FEATURES_DISHWASHER" value="1" <?php if ($rowGetAd->FEATURES_DISHWASHER) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_SKYLIGHT" value="0">
		<tr><td align="right">Skylight </td><td align="left"><input type="checkbox" name="FEATURES_SKYLIGHT" value="1" <?php if ($rowGetAd->FEATURES_SKYLIGHT) { echo "checked"; } ?> ></td></tr>
		</table>
		</td>
		<td valign="top">
		<table border="0">
		<input type="hidden" name="FEATURES_PORCH" value="0">
		<tr><td align="right">Porch </td><td align="left"><input type="checkbox" name="FEATURES_PORCH" value="1" <?php if ($rowGetAd->FEATURES_PORCH) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_BALCONY" value="0">
		<tr><td align="right">Balcony </td><td align="left"><input type="checkbox" name="FEATURES_BALCONY" value="1" <?php if ($rowGetAd->FEATURES_BALCONY) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_PATIO" value="0">
		<tr><td align="right">Patio </td><td align="left"><input type="checkbox" name="FEATURES_PATIO" value="1" <?php if ($rowGetAd->FEATURES_PATIO) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_CENTRAL_AC" value="0">
		<tr><td align="right">Central AC </td><td align="left"><input type="checkbox" name="FEATURES_CENTRAL_AC" value="1" <?php if ($rowGetAd->FEATURES_CENTRAL_AC) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_AC" value="0">
		<tr><td align="right">AC </td><td align="left"><input type="checkbox" name="FEATURES_AC" value="1" <?php if ($rowGetAd->FEATURES_AC) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_DECK" value="0">
		<tr><td align="right">Deck </td><td align="left"><input type="checkbox" name="FEATURES_DECK" value="1" <?if ($rowGetAd->FEATURES_DECK) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_MODERN_BATH" value="0">
		<tr><td align="right">Modern Bath </td><td align="left"><input type="checkbox" name="FEATURES_MODERN_BATH" value="1" <?if ($rowGetAd->FEATURES_MODERN_BATH) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="FEATURES_DINNING_ROOM" value="0">
		<tr><td align="right">Dining Room </td><td align="left"><input type="checkbox" name="FEATURES_DINNING_ROOM" value="1" <?if ($rowGetAd->FEATURES_DINNING_ROOM) { echo "checked"; } ?> ></td></tr>
		</table>	
		
		</td>
		
	</tr>
	<tr>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="5" align="right">
		<input type="submit" value="Update">
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<b>Building Type:</b>
		</td>
	</tr>
	<tr>
		<td width="25%" align="right">
		<select name="BUILDING_TYPE">
		<option value="--">--</option>
		<?php foreach ($DEFINED_VALUE_SETS['BUILDING_TYPE'] as $btkey => $btVal) { ?>
			<option value="<?php echo $btkey;?>" <?php if ($rowGetAd->BUILDING_TYPE==$btkey) { echo " selected "; } ?> ><?php echo $btVal;?></option>
		<?php } ?>
		</select>
		</td>
		
	</tr>
	<tr>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="5" align="right">
		<input type="submit" value="Update">
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<b>Amenities:</b>
		</td>
	</tr>
	<?php //divide by three here and list $Amenities; 
	?>
	<tr>
		<td >
		<table border="0">
		<input type="hidden" name="AMENITIES_CONCIEARGE" value="0">
		<tr><td align="right">Concierge </td><td align="left"><input type="checkbox" name="AMENITIES_CONCIEARGE" value="1" <?php if ($rowGetAd->AMENITIES_CONCIEARGE) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="AMENITIES_ELEVATOR" value="0">
		<tr><td align="right">Elevator </td><td align="left"><input type="checkbox" name="AMENITIES_ELEVATOR" value="1" <?php if ($rowGetAd->AMENITIES_ELEVATOR) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="AMENITIES_DECK" value="0">
		<tr><td align="right">Deck </td><td align="left"><input type="checkbox" name="AMENITIES_DECK" value="1" <?php if ($rowGetAd->AMENITIES_DECK) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="AMENITIES_ROOF_DECK" value="0">
		<tr><td align="right">Roof Deck </td><td align="left"><input type="checkbox" name="AMENITIES_ROOF_DECK" value="1" <?php if ($rowGetAd->AMENITIES_ROOF_DECK) { echo "checked"; } ?> ></td></tr>
		</table>
		</td>
		<td >
		<table border="0">
		<input type="hidden" name="AMENITIES_GARDEN" value="0">
		<tr><td align="right">Garden </td><td align="left"><input type="checkbox" name="AMENITIES_GARDEN" value="1" <?php if ($rowGetAd->AMENITIES_GARDEN) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="AMENITIES_YARD" value="0">
		<tr><td align="right">Yard </td><td align="left"><input type="checkbox" name="AMENITIES_YARD" value="1" <?php if ($rowGetAd->AMENITIES_YARD) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="AMENITIES_SECURITY" value="0">
		<tr><td align="right">Security </td><td align="left"><input type="checkbox" name="AMENITIES_SECURITY" value="1" <?php if ($rowGetAd->AMENITIES_SECURITY) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="AMENITIES_HEALTH_CLUB" value="0">
		<tr><td align="right">Health Club </td><td align="left"><input type="checkbox" name="AMENITIES_HEALTH_CLUB" value="1" <?php if ($rowGetAd->AMENITIES_HEALTH_CLUB) { echo "checked"; } ?> ></td></tr>
		</table>
		</td>
		<td >
		<table border="0">
		<input type="hidden" name="AMENITIES_POOL" value="0">
		<tr><td align="right">Pool </td><td align="left"><input type="checkbox" name="AMENITIES_POOL" value="1" <?php if ($rowGetAd->AMENITIES_POOL ) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="AMENITIES_TENNIS" value="0">
		<tr><td align="right">Tennis </td><td align="left"><input type="checkbox" name="AMENITIES_TENNIS" value="1" <?php if ($rowGetAd->AMENITIES_TENNIS) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="AMENITIES_LOUNGE" value="0">
		<tr><td align="right">Lounge </td><td align="left"><input type="checkbox" name="AMENITIES_LOUNGE" value="1" <?php if ($rowGetAd->AMENITIES_LOUNGE) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="AMENITIES_SAUNA" value="0">
		<tr><td align="right">Sauna </td><td align="left"><input type="checkbox" name="AMENITIES_SAUNA" value="1" <?php if ($rowGetAd->AMENITIES_SAUNA) { echo "checked"; } ?> ></td></tr>
		</table>
		<td  valign="top">
		<table border="0">
		<input type="hidden" name="AMENITIES_HIGH_CEILINGS" value="0">
		<tr><td align="right">High Ceilings </td><td align="left"><input type="checkbox" name="AMENITIES_HIGH_CEILINGS" value="1" <?php if ($rowGetAd->AMENITIES_HIGH_CEILINGS ) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="AMENITIES_BALCONY" value="0">
		<tr><td align="right">Balcony </td><td align="left"><input type="checkbox" name="AMENITIES_BALCONY" value="1" <?php if ($rowGetAd->AMENITIES_BALCONY ) { echo "checked"; } ?> ></td></tr>
		<input type="hidden" name="AMENITIES_WALK_IN_CLOSET" value="0">
		<tr><td align="right">Walk-in Closet </td><td align="left"><input type="checkbox" name="AMENITIES_WALK_IN_CLOSET" value="1" <?php if ($rowGetAd->AMENITIES_WALK_IN_CLOSET ) { echo "checked"; } ?> ></td></tr>
		</table>

		</td>
		
	</tr>
	
	<tr>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
		<td width="25%"><img src="spacer.gif" width="100%" height="1"></td>
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	<tr>
		<td colspan="5" align="right">
		<input type="submit" value="Update">
		</td>
	</tr>
	<tr>
	
		<td colspan="4">
		<b>Misc:</b>
		</td>
	</tr>
	<tr>
		
		<td width="25%" align="right" valign="top">
		Students:
		</td>
		<td width="25%">
		<input type="text" name="STUDENTS" value="<?php  echo $rowGetAd->STUDENTS;?>" >
		</td>
		
	</tr>
	<tr>
		<td width="25%" align="right">
		Tax Clause:
		</td>
		<td width="25%">
		<input type="text" name="TAX_CLAUSE" value="<?php echo $rowGetAd->TAX_CLAUSE;?>">
		</td>
		<td width="25%" align="right" valign="top">
		Alarm:
		</td>
		<td width="25%">
		<input type="text" name="ALARM" value="<?php  echo $rowGetAd->ALARM;?>" >
		</td>
		
	</tr>
	<tr>
		<td colspan="4">
		<hr size=1 noshade>
		</td>
	</tr>
	
	
	
		<tr>
		<td colspan="3" align="center">
		<input type="submit" value="Update">
		</td>
	</tr>
	</table>
	</form>
	</p>
	</div>
	
	


<!--END viewListing -->
<?php }elseif ($page=="restrict_ip") { ?>
<!--BEGIN restrict_ip -->
	<center>
  <table border="1" width="484" height="274" cellpadding="5">
    <tr>
      <td width="484" height="28">
        <p align="center">Please read before using this feature.</td>
    </tr>
    <tr>
      <td width="484" height="137">The &quot;Restrict Login&quot; feature is
        designed to deny access to the system to agents unless they are in the
        office.&nbsp; This may or may not be the desire of your agency.&nbsp;
        The feature works by checking the IP address of the agent trying to
        login and comparing it to the one you set here.&nbsp; This feature
        may not work for your office's network configuration.&nbsp; If you are
        unsure, please consult your Network Administrator or other responsible
        staff.&nbsp; If your network has only one internet connection, and uses
        a <i>router </i>to share the connection, this feature should work
        fine without any other changes.&nbsp;&nbsp;
        <p>By default, when you activate this setting,&nbsp; all agents are
        affected.&nbsp; You may turn the feature on or off for individual agents
        on the &quot;Edit Agent&quot; screen.&nbsp; The administrator is
        never restricted from logging in for contingency purposes.&nbsp;
        <p>The address in the field below is the one detected right now for this browser. 
        You should be at the location you wish to authorize, in order to correclty set this value.&nbsp;
        <p>Once the feature is enabled,  you must re-login for it to take effect.</td>
    </tr>
    <tr>
      <td width="444" height="112">
        <form action="<?php echo "$PHP_SELF?op=restrict_ip_do";?>" method="POST">
        <p align="center">Enable Restricted Login<input type="checkbox" name="restrict_ip" value="1" <?php if ($rowGetGroup->RESTRICT_IP) { echo " checked "; } ?>>&nbsp;
        </p>
        <?php if ($rowGetGroup->IP_ADDRESS) {?>
        	<p align="center"><font size="-2" color="red">Previous IP address: <?php echo $rowGetGroup->IP_ADDRESS; ?></font></p>
        <?php } ?>
        <p align="center">Detected IP address:<input type="text" name="ip_address" size="13" value="<?php echo $_SERVER['REMOTE_ADDR'];?>"></p>
        <p align="center"><input type="submit" value="Submit"></form></p>
        <p align="center">&nbsp;</td>
    </tr>
  </table>
  </center>
	


<!--END restrict_ip --> 
<?php }elseif ($page=="editUser") { ?>
<!--BEGIN editUser -->
	<center>
	Edit agent: <?php echo $rowGetUser->HANDLE;?><br>
	<form action="<?php echo "$PHP_SELF?op=editUserDo";?>" method="POST">
	<input type="hidden" name="uid" value="<?php echo $euid;?>">
	<table border="0">
	<tr>
	<td align="right">Email:</td>
	<td><input type="text" name="email" value="<?php echo $rowGetUser->EMAIL;?>"></td>
	</tr>
	<tr>
	<td align="right">Access Level:<br><font size="-2" color="#999999">See below for explanation</td>
	<td>1<input type="radio" name="level" value="1" <?php if ($rowGetUser->USER_LEVEL==1) { echo " checked "; }?>> 2<input type="radio" name="level" value="2" <?php if ($rowGetUser->USER_LEVEL==2) { echo " checked "; } ?>> 3<input type="radio" name="level" value="3" <?php if ($rowGetUser->USER_LEVEL==3) { echo " checked "; }?>></td>
	</tr>
	<?php if ($ip_restrict) { ?>
	<tr>
	<td align="right">Restrict Login:</td>
	<td><input type="hidden" name="restrict_ip" value="0"> <input type="checkbox" name="restrict_ip" value="1" <?php if ($rowGetUser->USER_RESTRICT_IP) { echo " checked "; } ?>></td>
	</tr>
	<?php } ?>
	<tr>
	<td colspan="2" align="center"><input type="submit" value="Save"></form>
	</tr>
	</table>
	<br>
	<br>
	<br>
	<table border="1" width="504" height="212">
    <tr>
      <td width="62" height="18">Level</td>
      <td width="426" height="18">Access Rights:</td>
    </tr>
    <tr>
      <td width="62" height="44">1</td>
      <td width="426" height="44">Can compose, edit, activate and deactivate
        ads, landlords and listings.</td>
    </tr>
    <tr>
      <td width="62" height="67">2</td>
      <td width="426" height="67">Can compose, edit, activate, deactivate and
        delete ads, landlords and listings one at a time.</td>
    </tr>
    <tr>
      <td width="62" height="60">3</td>
      <td width="426" height="60">Can compose, edit, activate, deactivate and
        delete ads, landlords and listings one at a time, or in groups.</td>
    </tr>
  </table>

<!--END editUser -->
<?php } elseif ($page=="window_close") { ?>
<!--BEGIN window_close -->

	<script>
					
		
		var page_y = window.opener.document.body.scrollTop;
		var sURL = unescape(window.opener.location.pathname);
		<?php 
		if ($op=="editDo") {
			$js_op = "sel";
		}elseif ($op=="editListingDo") {
			$js_op = "listings";
		}
		?>
		sURL += "?op=<?php echo $js_op;?>";
		sURL += ("&scroll_return=" + page_y);
		
		window.opener.location.href = sURL;
		window.close();
		
		
	
	</script>
	<br>
	<br>
	<br>
	<br>
	<center><font color="#000000" size="4">Updating Database</font></center>

	



<!--END window_close -->
<?php }elseif ($page=="manageClients") { ?>
<!--BEGIN manageClients -->
	<center> Manage Clients for <?php echo $group;?> <br>
	<a href="<?php echo "$PHP_SELF?op=createClient"; ?>">Create new Client</a> | <a href="<?php echo "$PHP_SELF?op=createDeal"; ?>">Create new Deal Sheet</a>
		

		<table border="0" cellpadding="2" cellspacing="0" width="100%">
	    	<tr>
	      <td width="3%" height="28" bgcolor="#45659A"></td>
	      <td width="14%" height="28" bgcolor="#45659A" align="center"><font color="#FFFFFF" face="Verdana" size="1">Name<font></td>
	      <td width="15%" height="28" bgcolor="#45659A" align="center"><font color="#FFFFFF" face="Verdana" size="1">Phone</font></td>
	      <td width="15%" height="28" bgcolor="#45659A" align="center"><font color="#FFFFFF" face="Verdana" size="1">Email</font></td>
	      <td width="15%" height="28" bgcolor="#45659A" align="center"><font color="#FFFFFF" face="Verdana" size="1">Agent</font></td>
	      <td width="4%" height="28" bgcolor="#45659A" align="center">&nbsp;</td>
	       <td width="4%" height="28" bgcolor="#45659A" align="center">&nbsp;</td>
	       <td width="4%" height="28" bgcolor="#45659A" align="center">&nbsp;</td>
	      </tr>
    <?php while ($rowGetClients = mysqli_fetch_object($quGetClients)) { ?>
    		<tr>
    		  <td width="3%" height="26" nowrap bgcolor="#D3D3D3"><?php 
	      if ($rowGetClients->DID) {
	      		echo "<a href=\"$PHP_SELF?op=viewDeal&did=$rowGetClients->DID\"><img src=\"../images/handshake.gif\"></a>";
	      }else {
	      		echo "&nbsp;";
	      }?></td>
    		  <td width="3%" height="26" nowrap><?php echo "$rowGetClients->NAME_LAST, $rowGetClients->NAME_FIRST";?></font></td>
    		  <td width="4%" height="26" nowrap bgcolor="#D3D3D3"><?php echo $rowGetClients->PHONE; ?></font></td>
    		  <td width="4%" height="26" nowrap bgcolor="#D3D3D3"><?php echo $rowGetClients->CLIENT_EMAIL; ?></font></td>
    		  <td width="4%" height="26" nowrap bgcolor="#D3D3D3"><?php echo $rowGetClients->HANDLE; ?><?php if (!$rowGetClients->PUBLIC) { echo "<font size=\"-2\" color=\"999999\"> (private) </font>"; }?></font></td>
    		  <td width="4%" height="26"><a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetClients->CLID"; ?>">edit</font></a></a></td>
    		  <td width="4%" height="26"><a href="<?php echo "$PHP_SELF?op=createDeal&clid=$rowGetClients->CLID"; ?>">deal</font></a></a></td>
    		  <td width="4%" height="26" nowrap bgcolor="#D3D3D3"><a href="<?php echo "$PHP_SELF?op=deleteClient&clid=$rowGetClients->CLID"; ?>">delete</font></a></td>
    		  </tr>
    <?php } ?>
		<tr><td align="center" colspan="7"><center><a href="<?php echo "$PHP_SELF?op=home";?>">Return</a></td></tr>
  		</table>

	
<!--END manageClients -->
<?php }elseif ($page=="createClient") {?>
<!--BEGIN createClient -->

	<center>
	<form action="<?php echo "$PHP_SELF?op=createClientDo";?>" method="POST">
	<table border="1" width="75%">
	
	<tr>
	<td>
	<table width="100%" border="0">
	<tr><td align="center" colspan="2">Share this client contact with the rest of <?php echo $group;?>? <input type="hidden" name="public" value="0"><input type="checkbox" name="public" value="1"></td></tr>
	<tr><td align="right">First Name:</td><td align="left"> <input type="text" name="name_first" size="15"></td></tr>
	<tr><td align="right">Last Name:</td><td align="left"> <input type="text" name="name_last" size="15"></td></tr>
	<tr><td align="right">Phone:</td><td align="left"> <input type="text" name="phone" size="15"></td></tr>
	<tr><td align="right">Email:</td><td align="left"><input type="text" name="client_email" size="20"></td></tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<table width="100%" border="0">
	<tr>
	<td align="right">
	Price Minimum:</td>
	<td>$<input type="text" name="pricemin"></td>
	</tr>
	<tr>
	<td align="right">Price Maximum:</td>
	<td>$<input type="text" name="pricemax">
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<table width="100%" border="0">
	<tr>
	<td align="right">Interested in:</td> 
	<td><select name="type_pref[]" multiple >
	<?php while ($rowTypes = mysqli_fetch_object($quTypes)) {?>
	<option value="<?php echo $rowTypes->TYPE;?>"><?php echo $rowTypes->TYPENAME;?>s</option>
	<?php }?>
	</select>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<table width="100%" border="0">
	<tr>
	<td align="right">
	Location preference(s):</td>
	<td><select name="loc_pref[]" multiple >
	<?php while ($rowLocs = mysqli_fetch_object($quLocs)) { ?>
	<option value="<?php echo $rowLocs->LOCID;?>"><?php echo $rowLocs->LOCNAME;?></option>
	<?php } ?>
	</select>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<table width="100%" border="0">
	<tr>
	<td align="right">
	Number of Bedrooms preference: <select name="rooms_pref[]" multiple > 
	<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $roomkey => $roomval) { ?>
	<option value="<?php echo $roomkey;?>"><?php echo $roomval;?></option>
	<?php }?>
	</select>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<table width="100%" border="0">
	<tr>
	<td align="right">
	Number of Bathrooms preference: <select name="bath_pref[]" multiple > 
	<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bathkey => $bathval) { ?>
	<option value="<?php echo $bathkey;?>"><?php echo $bathval;?></option>
	<?php }?>
	</select>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<table width="100%" border="0">
	<tr>
	<td align="right">
	Pets preference: <select name="pets_pref[]" multiple > 
	<?php foreach ($DEFINED_VALUE_SETS['PETSA'] as $petkey => $petval) { ?>
	<option value="<?php echo $petkey;?>"><?php echo $petval;?></option>
	<?php }?>
	</select>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>Accounting:
	<table width="100%" border="0">
	<tr>
	<td align="right">
	Broker fee paid:</td>
	<td>$<input type="text" name="broker_fee_paid" size="5"></td>
	</tr>
	<tr>
	<td align="right">
	First month paid:</td>
	<td>$<input type="text" name="payment_first_paid"  size="5"></td>
	</tr>
	<tr>
	<td align="right">
	Last month paid:</td>
	<td>$<input type="text" name="payment_last_paid" size="5"></td>
	</tr>
	<td align="right">
	Security deposit paid:</td>
	<td>$<input type="text" name="payment_sec_paid" size="5"></td>
	</tr>
	<td align="right">
	Key deposit paid:</td>
	<td>$<input type="text" name="key_dep_paid" size="5"></td>
	</tr>
	<td align="right">
	Cleaning deposit paid:</td>
	<td>$<input type="text" name="clean_dep_paid" size="5"></td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<table width="100%" border="0">
	<tr>
	<td align="right">
	Additional Comments:</td>
	<td><textarea name="client_notes" rows="5" cols="30"></textarea></td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td colspan="2" align="center">
	<input type="submit" value="Save">
	</td>
	</tr>
	</table>
	</form>
	</center>


<!--END createClient -->
<?php }elseif ($page=="editClient") {?>
<!--BEGIN editClient -->
	<?php
	//Preferences reverse//
	$type_pref = string_to_array($rowGetClient->TYPE_PREF, ",");
	$loc_pref = string_to_array($rowGetClient->LOC_PREF, ",");
	$rooms_pref = string_to_array($rowGetClient->ROOMS_PREF, ",");
	$bath_pref = string_to_array($rowGetClient->BATH_PREF, ",");
	$pets_pref = string_to_array($rowGetClient->PETS_PREF, ",");
	?>
	
	<center>
	<form action="<?php echo "$PHP_SELF?op=editClientDo";?>" method="POST">
	<input type="hidden" name="clid" value="<?php echo $rowGetClient->CLID;?>">
	<table border="1" width="75%">
	
	<tr>
	<td>
	<table width="100%" border="0">
	<?php 
	if ($isAdmin || ($rowGetClient->UID==$uid)) { ?>
	<tr><td align="center" colspan="2">Share this client contact with the rest of <?php echo $group;?>? <input type="hidden" name="public" value="0"><input type="checkbox" name="public" value="1" <?php if ($rowGetClient->PUBLIC) { echo " checked "; }?>></td></tr>
	<?php }?>
	<tr><td align="right">First Name:</td><td align="left"> <input type="text" name="name_first" size="15" value="<?php echo $rowGetClient->NAME_FIRST;?>"></td></tr>
	<tr><td align="right">Last Name:</td><td align="left"> <input type="text" name="name_last" size="15" value="<?php echo $rowGetClient->NAME_LAST;?>"></td></tr>
	<tr><td align="right">Phone:</td><td align="left"> <input type="text" name="phone" size="15" value="<?php echo $rowGetClient->PHONE;?>"></td></tr>
	<tr><td align="right">Email:</td><td align="left"><input type="text" name="client_email" size="20" value="<?php echo $rowGetClient->CLINT_PHONE;?>"></td></tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<table width="100%" border="0">
	<tr>
	<td align="right">
	Price Minimum:</td>
	<td>$<input type="text" name="pricemin" value="<?php echo $rowGetClient->PRICEMIN;?>"></td>
	</tr>
	<tr>
	<td align="right">Price Maximum:</td>
	<td>$<input type="text" name="pricemax" value="<?php echo $rowGetClient->NAME_FIRST;?>">
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<table width="100%" border="0">
	<tr>
	<td align="right">Interested in:</td> 
	<td><select name="type_pref[]" multiple >
	<?php while ($rowTypes = mysqli_fetch_object($quTypes)) {?>
	<option value="<?php echo $rowTypes->TYPE;?>" <?php if (in_array($rowTypes->TYPE, $type_pref)) { echo " selected "; }?>><?php echo $rowTypes->TYPENAME;?>s</option>
	<?php }?>
	</select>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<table width="100%" border="0">
	<tr>
	<td align="right">
	Location preference(s):</td>
	<td><select name="loc_pref[]" multiple >
	<?php while ($rowLocs = mysqli_fetch_object($quLocs)) { ?>
	<option value="<?php echo $rowLocs->LOCID;?>" <?php if (in_array($rowLocs->LOCID, $loc_pref)) { echo " selected "; }?>><?php echo $rowLocs->LOCNAME;?></option>
	<?php } ?>
	</select>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<table width="100%" border="0">
	<tr>
	<td align="right">
	Number of Bedrooms preference: <select name="rooms_pref[]" multiple > 
	<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $roomkey => $roomval) { ?>
	<option value="<?php echo $roomkey;?>" <?php if (in_array($roomkey, $rooms_pref)) { echo " selected "; }?>><?php echo $roomval;?></option>
	<?php }?>
	</select>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<table width="100%" border="0">
	<tr>
	<td align="right">
	Number of Bathrooms preference: <select name="bath_pref[]" multiple > 
	<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bathkey => $bathval) { ?>
	<option value="<?php echo $bathkey;?>" <?php if (in_array($bathkey, $bath_pref)) { echo " selected "; }?>><?php echo $bathval;?></option>
	<?php }?>
	</select>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<table width="100%" border="0">
	<tr>
	<td align="right">
	Pets preference: <select name="pets_pref[]" multiple > 
	<?php foreach ($DEFINED_VALUE_SETS['PETSA'] as $petkey => $petval) { ?>
	<option value="<?php echo $petkey;?>" <?php if (in_array($petskey, $pets_pref)) { echo " selected "; }?>><?php echo $petval;?></option>
	<?php }?>
	</select>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>Accounting:
	<table width="100%" border="0">
	<tr>
	<td align="right">
	Broker fee paid:</td>
	<td>$<input type="text" name="broker_fee_paid" size="5" value="<?php echo $rowGetClient->BROKER_FEE_PAID;?>"></td>
	</tr>
	<tr>
	<td align="right">
	First month paid:</td>
	<td>$<input type="text" name="payment_first_paid"  size="5" value="<?php echo $rowGetClient->PAYMENT_FIRST_PAID;?>"></td>
	</tr>
	<tr>
	<td align="right">
	Last month paid:</td>
	<td>$<input type="text" name="payment_last_paid" size="5" value="<?php echo $rowGetClient->PAYMENT_LAST_PAID;?>"></td>
	</tr>
	<td align="right">
	Security deposit paid:</td>
	<td>$<input type="text" name="payment_sec_paid" size="5" value="<?php echo $rowGetClient->PAYMENT_SEC_PAID;?>"></td>
	</tr>
	<td align="right">
	Key deposit paid:</td>
	<td>$<input type="text" name="key_dep_paid" size="5" value="<?php echo $rowGetClient->KEY_DEP_PAID;?>"></td>
	</tr>
	<td align="right">
	Cleaning deposit paid:</td>
	<td>$<input type="text" name="clean_dep_paid" size="5" value="<?php echo $rowGetClient->CLEAN_DEP_PAID;?>"></td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<table width="100%" border="0">
	<tr>
	<td align="right">
	Additional Comments:</td>
	<td><textarea name="client_notes" rows="5" cols="30"><?php echo $rowGetClient->CLIENT_NOTES;?></textarea></td>
	</tr>
	</table>
	</td>
	</tr>
	<tr>
	<td colspan="2" align="center">
	<input type="submit" value="Save">
	</td>
	</tr>
	</table>
	</form>
	</center>

<!--END editClient -->
<?php }elseif ($page=="createDeal") {?>
<!--BEGIN createDeal -->
	
	<?php
	if ($clid) {?>
	<center>
	<table border="1">
	<tr>
	<td>
	<table width="410" border="0" cellspacing="5" cellpadding="3">
	<tr>
	<td align="center">Create new deal sheet for <?php echo $rowGetClient->NAME_FIRST;?> <?php echo $rowGetClient->NAME_LAST;?>
	<table>
	<form action="<?php echo "$PHP_SELF?op=createDealDo";?>" method="POST">
	<input type="hidden" name="clid" value="<?php echo $rowGetClient->CLID;?>">
	<tr>
	<td align="center"><br>Link to listing #: <?php echo $abv;?><input type="text" name="cid"><br><br><input type="submit" value="Create New">
	</td>
	</tr>
	</form>
	</table>
	</td>
	</tr>
	<tr>
	<td><hr></td>
	</tr>
	<tr>
	<td align="center">Or link <?php echo $rowGetClient->NAME_FIRST;?> <?php echo $rowGetClient->NAME_LAST;?> to existing deal sheet.
	<table>
	<form action="<?php echo "$PHP_SELF?op=linkToDeal";?>" method="POST">
	<input type="hidden" name="clid" value="<?php echo $rowGEtClient->CLID;?>">
	<tr>
	<td align="center"><br><select name="did"><?php while ($rowGetDeals = mysqli_fetch_object($quGetDeals)) {?>
						<option value="<?php echo $rowGetDeals->DID;?>"><?php echo "$rowGetDeals->CID :: $rowGetDeals->STREET";?></option>
						<?php } ?>
						</select><br><br>
	<input type="submit" value="Link">
	</td>
	</tr>
	</form>
	</table>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</center>
	
	<?php } elseif ($cid) {?>
	
	<center>
	<table border="1">
	<tr>
	<td>
	<table width="410" border="0" cellspacing="5" cellpadding="3">
	<tr>
	<td align="center">Create new deal sheet for <?php echo $rowGetAd->STREET;?> <?php if ($rowGetAd->APT) { echo "#$rowGetAd->APT"; }?> (listing #<?php echo "$abv-$cid";?>)
	<table>
	<form action="<?php echo "$PHP_SELF?op=createDealDo";?>" method="POST">
	<input type="hidden" name="clid" value="<?php echo $rowGetClient->CLID;?>">
	<tr>
	<td align="center"><br>Link to client: <select name="clid"><?php while ($rowGetClients = mysqli_fetch_object($quGetClients)) {?>
									<option value="<?php echo $rowGetClients->CLID;?>"><?php echo $rowGetClients->NAME_LAST;?>, <?php echo $rowGetClients->NAME_FIRST;?></option>
									<?php }?>
									</select> <br><br><input type="submit" value="Create New">
	</td>
	</tr>
	</form>
	</table>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</center>
	<?php }?>
	
<!--END createDeal -->	
<?php } ?>
<!--END SELECTED CONTENT -->

				</td>
		    <td width="60">&nbsp;</td>
		    </tr>
		  </table>
		  
<script language="JavaScript">                             
   <!--                                                    
   function CheckAll()                                     
   {                                                       
      for (var i=0;i<document.moveform.elements.length;i++)		
      {                                                    
         var e = document.moveform.elements[i];            		
         if (e.name != "allbox")                           
            e.checked = document.moveform.allbox.checked;  
      }                                                    
   }                                                       
   //-->                                                   
</script>       
 
</body>
</html>                                        