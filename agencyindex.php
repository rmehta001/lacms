<?php
session_start();
$user = trim($_POST['username']);
$pass = trim($_POST['password']);
include ("./inc/local_info.php");
include ("./inc/global.php");
date_default_timezone_set("America/New_York");
// Check connection
if(isset($_POST['login']))
{
    if(empty($user) || empty($pass))
    {
        header('Location: agencylogin.php?wrong2');
        die();
    }
    else{
        $qu="SELECT * FROM USERS WHERE HANDLE = '$user' AND PASS = '$pass'";
        $result=  $dbh->query($qu);
        if(mysqli_num_rows($result)==0)
        {
            header('Location: agencylogin.php?wrong');
            die();
        }
        else if(mysqli_num_rows($result)!=0 && $user=="eboyer")
        {
            header('Location: agencylogin.php?wrong3');
            die();
        }
       
    }
           
}

//Lookup User PHP7 //	
$quStrUsr = "SELECT * FROM USERS INNER JOIN `GROUP` ON USERS.`GROUP`=`GROUP`.GRID WHERE HANDLE='$user'";
$quUsr = $dbh->query($quStrUsr);
$rowUsr=$quUsr->fetch_assoc();
if ($rowUsr["UID"] !== $rowUsr["ADMIN"]) {
    
    if ($rowUsr["USER_RESTRICT_IP"] =="1") {
        $ip = $_SERVER['REMOTE_ADDR'];
        if ($ip !== $rowUsr["USER_RESTRICT_IP_ADDRESS"]) {
            die (error_ip($user));
        }
    }
}

$_SESSION['uid']=$rowUsr["UID"];

$_SESSION ["grid"]= $rowUsr["GRID"];

$_SESSION ["group"]= $rowUsr["NAME"];
$_SESSION["agcy"]= $rowUsr["AGENCIES"];
$_SESSION["assigned_agency"]=$rowUsr["AGENCY"];

$_SESSION ["abv"]= $rowUsr["ABV"];

$_SESSION ["handle"]= $user;
$_SESSION ["level"] = $rowUsr["LEVEL"];

$_SESSION ["email"] = $rowUsr["EMAIL"];

$_SESSION ["pass"] = $rowUsr["PASS"];

$_SESSION ["maxAct"]= $rowUsr["MAXACT"];


if ($rowUsr["ADMIN"]==$rowUsr["UID"]) {
    $_SESSION["isAdmin"] = True;
}else {
    $_SESSION["isAdmin"] = False;
}
    
$_SESSION["user_num_ads"] = $rowUsr["NUM_ADS"];                 

$_SESSION["ip_restrict"] = $rowUsr["RESTRICT_IP"];
    
$_SESSION["user_level"] = $rowUsr["USER_LEVEL"];

$_SESSION["popup_pref"]= $rowUsr["PREF_POPUP"];
    
$_SESSION["pref_adl_view"]= $rowUsr["PREF_ADL_VIEW"];
    
$_SESSION["pref_auto_update_landlord"] = $rowUsr["PREF_AUTO_UPDATE_LANDLORD"];
    
$_SESSION["pref_all_clients"] = $rowUsr["PREF_ALL_CLIENTS"];
    
$_SESSION["listview"] = $rowUsr["LISTVIEW"];
    
$_SESSION["listsearch"] = $rowUsr["LISTSEARCH"];

$_SESSION["listsearchshow"] = $rowUsr["LISTSEARCHSHOW"];

$_SESSION["listactive"]= $rowUsr["LISTACTIVE"];

$_SESSION["mls_town_pref"] = $rowUsr["MLS_TOWN_PREF"];

$_SESSION["pref_row_color"] = $rowUsr["PREF_ROW_COLOR"];

$_SESSION["pref_pagebg"]= $rowUsr["PREF_PAGEBG_COLOR"];

$_SESSION["pref_coltit"] = $rowUsr["PREF_COLTIT_COLOR"];

$_SESSION["pref_topbar"]= $rowUsr["PREF_TOPBAR_COLOR"];

$_SESSION["pref_topmenu"]= $rowUsr["PREF_TOPMENU_COLOR"];

$_SESSION["pref_pagetrim"]= $rowUsr["PREF_PAGETRIM_COLOR"];

$_SESSION["watermark_on"] = $rowUsr["WATERMARK_ON"];


$_SESSION["actsto"] = $rowUsr["ACTSTO"];

$_SESSION["sourcepref"] = $rowUsr["SOURCEPREF"];


$sid = session_id();
$now = date ("YmdHis");
$uid=$_SESSION['uid'];
$grid=$_SESSION['grid'];

$quStrChkSession = "SELECT ID, count(SID) AS COUNTOF FROM SESSIONS WHERE SID='$sid' GROUP BY ID";
$quChkSession = $dbh->query($quStrChkSession) or die ("can't check session   $quStrChkSession");
$rowChkSession =$quChkSession->fetch_assoc();

if (empty($rowChkSession["SID"])) {
    $quStrRecordSession = "INSERT INTO SESSIONS (SID, UID, GRID, TIMEIN) VALUES ('$sid', $uid, $grid, $now)";
   
    $quRecordSession = $dbh->query($quStrRecordSession) or die ("can't record session");
    
    $sidnum = mysqli_insert_id($dbh);
}else {
    $sidnum = $rowChkSession["ID"];
}


$quStrActiveCount = "SELECT count(CID) as myCount FROM CLASS WHERE STATUS='ACT' AND CLI=$grid";
$quActiveCount = $dbh->query ($quStrActiveCount) or die ("can't crapped out");
$rowActiveCount = $quActiveCount->fetch_assoc();

$active = $rowActiveCount["myCount"];
$_SESSION["active"] = $active;
$use_version = $rowUsr["USE_VERSION"];
if ($user=="eboyer") {
    header("Location: ./admin/");
}else {
    header("Location: ./clients/AgencyArea$use_version.php");
}

//Usability session create //

$_SESSION["usa_req_num"]=0;
$_SESSION["usa_req_delta_start"] = time();
$_SESSION["usa_sid_num"]= $sidnum;


if(isset($_SESSION['uid']))
{
    header('Location: ./clients/AgencyArea2.php');
    die();
}




?>

