<?php
 session_start();
 include("../inc/global.php");
 include("../inc/local_info.php");
 
if (isset($_GET['debug'])) {
error_reporting(E_ALL);
}
if(isset($_SESSION["active"])){
$active = $_SESSION["active"];}

$handle=$_SESSION["handle"];
$PHP_SELF=$_SERVER['PHP_SELF'];
$handle=$_SESSION["handle"];
$group=$_SESSION ["group"];
$uid=$_SESSION['uid'];
$pass=$_SESSION['pass'];

// Get the variable op method, $op="home" as the default
if (isset($_GET['op'])) {
	$op = $_GET['op'];
}else {
	$op = "home";
}
// If the $handle is empty thenn not correctly login 
if (!$handle) {
	die (dieNice ("You are not correctly logged in or have been logged out.  Please click <a href=\"../\">here</a> to login.", "E-1"));
}
// default some variables as the session 
$needOptions = false;


//DEFINED VALUE SETS //
$quStrGetValueDefs = "SELECT * FROM VALUE_DEFINE";
$quGetValueDefs = $dbh->query($quStrGetValueDefs);

while (($rowGetValueDefs = mysqli_fetch_object($quGetValueDefs)) ){

	$string = $rowGetValueDefs->DEFINE;
	$values = explode (",", $string);
	foreach ($values as $key => $value) {
	    $values2[$key] = explode("_", $value);
	}
	foreach ($values2 as $values3) {
		$offset = $values3[0];
		$DEFINED_VALUE_SETS[$rowGetValueDefs->CLASS_NAME][$offset] = isset($values3[1])?$values3[1]:null;
	}

	$string = false;
    $values = false;
    $values2 = false;
    $values3 = false;
    $offset = false;
    

}
$now = date("Ymd");

//OPERATIONS SWITCH//
if ($op=="home") {
    // when op == home, it working on home page and show you the UI
    $filterIsSet = false;
    $now = date("Ymd");
    $page="home";
    $needOptions = true;
    $title = "Home";   
    $msg ="This is the Home page of admin";

    
}
//
elseif ($op=="setWhere") {
    $title="SetWHere";
    $msg ="This is the setWhere page";
    $now = date("Ymd");
    if(isset($_POST['sort'])){
     $sort= $_POST['sort'];
    }
    else{
        $sort="";
    }
    
    if( isset($_POST["qGroup"])){
    $qGroup = $_POST["qGroup"];}
    else{
        $qGroup="";
    }
    if(  isset( $_POST['qGroupV'])){
    $qGroupV = $_POST['qGroupV'];}
    else{
        $qGroupV="";
    }
    if(isset($_POST['qUser'])){
    $qUser = $_POST['qUser'];}
    else{
        $qUser="";
    }
    if( isset( $_POST['qUserV'])){
    $qUserV = $_POST['qUserV'];}
    else{
        $qUserV="";
    }
    
    if( isset($_POST['qStartCr'])){
    $qStartCr = $_POST['qStartCr'];}
    else{
        $qStartCr="";
    }
    if(isset($_POST['qStartCrV'])){
    $qStartCrV = $_POST['qStartCrV'];}
    else{
        $qStartCrV="";
    }  
    if(isset($_POST['qEndCr'])){
        $qEndCr= $_POST['qEndCr'];}
        else{
            $qEndCr="";
        }
    if(isset($_POST['qEndCrV'])){
    $qEndCrV = $_POST['qEndCrV'];}
    else{
        $qEndCrV="";
    }
    if(isset($_POST['qStartMod'])){
    $qStartMod = $_POST['qStartMod'];}
    else{
        $qStartMod="";
    }
    if( isset( $_POST['qStartModV'])){
    $qStartModV = $_POST['qStartModV'];}
    else{
        $qStartModV="";
    }
    if(isset($_POST['qEndMod'])){
    $qEndMod = $_POST['qEndMod'];}
    else{
        $qEndMod="";
    }
    if(isset( $_POST['qEndModV'])){
    $qEndModV = $_POST['qEndModV'];}
    else{
        $qEndModV="";
    }
    if( isset( $_POST['qLoc'])){
    $qLoc = $_POST['qLoc'];}
    else{
        $qLoc="";
    }
    if(  isset($_POST['qLocV'])){
    $qLocV = $_POST['qLocV'];}
    else{
        $qLocV="";
    }
    if(  isset($_POST['qType'])){
    $qType = $_POST['qType'];}
    else{
        $qType="";
    }
    if(isset( $_POST['qTypeV'])){
    $qTypeV = $_POST['qTypeV'];}
    else{
        $qTypeV="";
    }
    
    if (!isset($sort)) {
        $ORDER = "";
    }else {
        $ORDER = "ORDER BY `" . $sort . "` ";
    }
    unset($_SESSION['where']);

      // The elements of options function
    $qkeys = array ();
    $qkeys[0] = new filterMember ($qGroup, "`CLI`", "INT", "EQ", $qGroupV);
    $qkeys[1] = new filterMember ($qUser, "`CLASS`.`UID`", "INT", "EQ", $qUserV);
    $qkeys[2] = new filterMember ($qStartCr, "`DATEIN`", "INT", "GTEQ", $qStartCrV);
    $qkeys[3] = new filterMember ($qEndCr, "`DATEIN`", "INT", "LTEQ", $qEndCrV);
    $qkeys[4] = new filterMember ($qStartMod, "`MOD`", "INT", "GTEQ", $qStartModV);
    $qkeys[5] = new filterMember ($qEndMod, "`MOD`", "INT", "LTEQ", $qEndModV);
    $qkeys[6] = new filterMember ($qLoc, "`LOC`", "STR", "EQ", $qLocV);
    $qkeys[7] = new filterMember ($qType, "`CLASS`.`TYPE`", "INT", "EQ", $qTypeV);
    
 
    $fragments = array();
    $countKeys = count($qkeys);
    $numActKeys = 0;
           
    for ($i=0;$i<$countKeys;$i++) {
        
        if ($qkeys[$i]->isActive()) {
            $fragments[$numActKeys]= $qkeys[$i]->makeFrag();
            $numActKeys++;
        }
        
        
    }   
    $numFrags = count($fragments);    
    switch ($numFrags) {
        case 0:
            $WHERE = "";
            break;
        case 1: $WHERE = " WHERE (". $fragments[0] . ")";
        break;
        default:
            $WHERE= " WHERE (" . $fragments[0] . ")";
            for ($i=1;$i<$numFrags;$i++){
                $string2Cat.= " AND (" . $fragments[$i] . ")";
            }
            
            $WHERE.= $string2Cat;
         
    } 
    
    $_SESSION['where']= $WHERE;
   if ($qGroup=="ON") {
      
           $groupFilterIsSet= 1;  
           $_SESSION['groupFilterIsSet']=$groupFilterIsSet;
           $_SESSION['SelgroupID']=$qGroupV;
           $groupFilter=$_SESSION['SelgroupID'];
        
    }else {
        $groupFilterIsSet = 0;
        $_SESSION['groupFilterIsSet']=$groupFilterIsSet;
        $groupFilter = "";
        $_SESSION['SelgroupID']=$groupFilter;
    }
    
    $filterIsSet = true; 
    $page="continue";
  

}
elseif($op=="sel") {
    $page = "sel";
    $disData = "ads";
    $title = "Selected";
    $msg = "Ads selected,  operate from here.";
    if(isset($_SESSION['SelgroupID'])) {
        $groupFilter = $_SESSION['SelgroupID'];
    }
    
}elseif ($op=="edit") {
    $cid = $_GET['cid'];
    $page="edit";
    $disData="ad";
    $needOptions = true;
    $msg = "Make Changes, or deactivate ad.";
    $title = "Edit Ad";
} elseif ($op=="editDo") {
    if(isset($_POST['ad_title'])) {
        $ad_title = $_POST['ad_title'];
    }
    else{
        $ad_title="";
    }
    if(isset($_POST['ggrid'])) {
        $ggrid = $_POST['ggrid'];}
    else{
        $ggrid="";
    }
    if(isset($_POST['cid'])) {
        $cid = $_POST['cid'];
    }
    else{
        $cid="";
    }
    if(isset($_POST['body'])) {
        $body=mysqli_real_escape_string($dbh,$_POST['body']);}
    else{
        $body="";
    }
    if(isset($_POST['loc'])) {
        $loc=$_POST['loc'];}
    else{
        $loc="";
    }
    if(isset($_POST['type'])) {
        $type =$_POST['type'];}
    else{
        $type="";
    }
    if(isset($_POST['nofee'])) {
        $nofee = $_POST['nofee'];
    }
    else{
        $nofee="";
    }
if(isset($_POST['sporder'])) {
    $sporder = $_POST['sporder'];}
else{
    $sporder="";
}

    $now = date("Ymd");

if(isset($_POST['altSig'])) {
    $altSig = mysqli_real_escape_string($dbh,$_POST['altSig']);}
else{
    $altSig="";
}
if(isset($_POST['sporder'])){
    $sporder = $_POST['sporder'];}
    if (!isset($sporder)) {
        $sporder = 99;
    }
    if (!isset($nofee)) {
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
    if(isset($_POST['PAYMENT_REC'])){
    $payment = $_POST['PAYMENT_REC'];}
    else{
        $payment="";
    }
    
    
    
    $quStrUpdateAd = "UPDATE CLASS SET CLI='$ggrid', AD_TITLE='$ad_title', BODY='$body', TYPE=$type, LOC='$loc', `MOD`=$now, NOFEE=$nofee, ALTSIG='$altSig', SPORDER=$sporder, AVAIL=$avail, PRICE=$price, ROOMS='$rooms', BATH='$bath', PAYMENT_REC='$payment' WHERE CID=$cid";
    
    $quUpdateAd = mysqli_query($dbh,$quStrUpdateAd) or die ("please update at admin2");
    
    //FAVLOC STUFF//
    $loc = $_POST['loc'];
    $quStrCheckRecFavLoc = "SELECT * FROM FAVLOC WHERE UID='$uid' AND LOC='$loc'";
    $quCheckRecFavLoc = mysqli_query($dbh,$quStrCheckRecFavLoc);
    $numRows = mysqli_num_rows($quCheckRecFavLoc);
    if (!$numRows) {
        $quStrInsFavLoc = "INSERT INTO FAVLOC (LOC, UID, SCORE) VALUES ('$loc', '$uid', 1)";
        $quInsFavLoc = mysqli_query($dbh,$quStrInsFavLoc);
    }else {
        $quStrUpdateFavLoc = "UPDATE FAVLOC SET SCORE = SCORE + 1 WHERE LOC='$loc' AND UID='$uid'";
        $quUpdateFavLoc = mysqli_query($dbh,$quStrUpdateFavLoc);
    }
    
    if($filterIsSet=true) {
        $page = "sel";
        $title = "Selected";
        $disData="ads";
    }else {
        $page = "home";
        $title = "Home";
        $needOptions = true;
    }
    $msg = "Changes saved to database.";
    
}elseif ($op=="delete") {
    $cid = $_GET['cid'];
    $page = "delete";
    $disData = "ad";
    $title = "Delete Ad Confirmation";
    $msg = "Are you sure you want to delete this ad?";

}elseif ($op=="deleteDo") {
    if(isset($_POST['cid'])){
    $cid = $_POST['cid'];}
    if(isset($_POST['conf'])){
    $conf = $_POST['conf'];}

    if ($conf=="y" || $conf=="Y") {
        $quStrDelAd = "DELETE FROM CLASS WHERE CID=$cid";
        $quDelAd = mysqli_query($dbh,$quStrDelAd) or die ("can't delete ad");
        $quStrGetPics = "SELECT PID, EXT FROM PICTURE WHERE CID=$cid";
        $quGetPics = mysqli_query($dbh,$quStrGetPics);
        while ($rowGetPics = mysqli_fetch_object($quGetPics)) {
            unlink ("../pics/$rowGetPics->PID.$rowGetPics->EXT");
        }
        $quStrDelPics = "DELETE FROM PICTURE WHERE CID=$cid";
        $quDelPics = mysqli_query($dbh,$quStrDelPics) or die ("can't delete pics");
        if ($filterIsSet=true) {
            $page = "sel";
            $disData = "ads";
            $title = "Selected";
        }else {
            $page = "home";
            $needOptions = true;
            $msg = "Ad deleted.";
        }
        
        
        
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
    if(isset($_POST['ggrid'])){
    $ggrid = $_POST['ggrid'];}

    if(isset($_POST['body'])){
        $body= mysqli_real_escape_string(prepareAdBody($dbh,$_POST['body'], 1));}
    if(isset($_POST['aMonth'])){
        $aMonth = $_POST['aMonth'];}
    if(isset($_POST['aDay'])){
        $aDay   = $_POST['aDay'];}
    if(isset($_POST['aYear'])){
        $aYear  = $_POST['aYear'];}
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
    $loc=$_POST['loc'];
    $type = $_POST['type'];
    $altSig = $_POST['altSig'];
    $noFee = $_POST['noFee'];
    $sporder = $_POST['sporder'];
    $nofee=$_POST['nofee'];
    if (!$sporder) {
        $sporder = 99;
    }
    if (!$noFee) {
        $noFee = 0;
    }
    $upload = $_POST['upload'];
    $rooms = $_POST['rooms'];
    if ($rooms=="--") {
        $rooms = 0;
    }
    $bath = $_POST['bath'];
    if ($bath=="--") {
        $bath = 0;
    }
    if ($body!=="") {
        $now = date("Ymd");
        $quStrInsAd = "INSERT INTO CLASS (BODY, STATUS, LOC, UID, CLI, DATEIN, `MOD`, TYPE, ALTSIG, NOFEE, SPORDER, AVAIL, PRICE, ROOMS, BATH) VALUES ('$body', 'ACT', '$loc', '$uid', '$ggrid', '$now', '$now', '$type', '$altSig', '$nofee', '$sporder', '$avail', '$price', '$rooms', '$bath')";
        $quInsAd = mysqli_query ($dbh,$quStrInsAd) or die ("can't insert ad $quStrInsAd");
        $cid = mysqli_insert_id($dbh);
        //FAVLOC STUFF//
        $loc = $_POST['loc'];
        $quStrCheckRecFavLoc = "SELECT * FROM FAVLOC WHERE UID='$uid' AND LOC='$loc'";
        $quCheckRecFavLoc = mysqli_query($dbh,$quStrCheckRecFavLoc);
        $numRows = mysqli_num_rows($dbh,$quCheckRecFavLoc);
        if (!$numRows) {
            $quStrInsFavLoc = "INSERT INTO FAVLOC (LOC, UID, SCORE) VALUES ('$loc', '$uid', 1)";
            $quInsFavLoc = mysqli_query($dbh,$quStrInsFavLoc);
        }else {
            $quStrUpdateFavLoc = "UPDATE FAVLOC SET SCORE = SCORE + 1 WHERE LOC='$loc' AND UID='$uid'";
            $quUpdateFavLoc = mysqli_query($dbh,$quStrUpdateFavLoc);
        }
        if ($upload) {
            $title = "Upload Picture";
            $msg = "New Ad Created,  $cid,  upload pics here.";
            $page = "upload";
        }else {
            $page = "home";
            $disData = "ads";
            $title = "Home";
            $msg = "New ad created.";
            $needOptions = true;
        }
    }else {
        $page = "compose";
        $title = "Compose";
        $msg = "Please fill out the form completley";
    }
}elseif ($op=="upload") {
    $cid = $_GET['cid'];
    $abv=$_GET['abv'];
    $page = "upload";
    $title = "Upload Picture";
    $msg = "upload pictures for ad $cid.";
}elseif ($op=="uploadDo") {
//     need to debug
  //  $mime = trim($userfile_type);
    $cid = $_POST['cid'];
    $desc = strip_tags($_POST['desc']);
    
  //  $fileNameSplit = str_split ("\.", $userfile_name);
   // $ext = $fileNameSplit[1];
    $ext="jpg";
    if ($ext=="jpg" | $ext=="gif" | $ext=="jpeg" | $ext=="png")  {
        $quStrAddPic = "INSERT INTO PICTURE (CID, EXT, DESCRIPT, UID) VALUES ($cid , '$ext', '$desc', $uid)";
        $quAddPic = mysqli_query ($dbh,$quStrAddPic) or die ("insert picture query failed");
        $newPid = mysqli_insert_id($dbh);
        $quStrUpClass = "UPDATE CLASS SET PIC=PIC+1 WHERE CID=$cid";
        $quUpClass = mysqli_query($dbh,$quStrUpClass) or die ("can't update class");
        $newFileName = "$picsDirectory/$newPid.$ext";
        echo "$newFileName<br>";
    //    move_uploaded_file($userfile, $newFileName) or die ("one or more opperations (there are like ten here) failed.");
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
    $cid = $_GET['cid'];

    $page = "managePics";
    $title = "Manage Pictures";
    $disData = "pics";
    $msg = "Manage Pictures for ad $cid.";
}elseif ($op=="editPic") {
    $pid = $_GET['pid'];
    $cid = $_GET['cid'];
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
    $quUpdatePic = mysqli_query ($dbh,$quStrUpdatePic) or die ("can't update pic");
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
    $pid = $_GET['pid'];
    $cid = $_GET['cid'];
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
        $quDeletePic = mysqli_query ($dbh,$quStrDeletePic) or die ("can't delete picture record");
        $quStrUpdateAd = "UPDATE CLASS SET PIC=PIC-1 WHERE CID=$cid";
        $quUpdateAd = mysqli_query ($dbh,$quStrUpdateAd) or die ("please update at admin2");
        $picture = "$picsDirectory/$pid.$ext";
        unlink ($picture) or die ("can't unlink picture");
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
    $grid=$_SESSION['grid'];
    
    if ($oldPass==$pass) {
        if ($newPass==$newPassConf) {
            $quStrUpdateUser = "UPDATE USERS SET PASS='$newPass' WHERE UID=$uid AND `GROUP`=$grid";
            $quUpdateUser = mysqli_query($dbh,$quStrUpdateUser) or die ("can't update user");
           // $pw = new PwFile($PASSWORD_FILE);
            $usr_ID = $handle;
            $usr_passwd = $newPass;
           // $pw->updateUser($usr_ID, $usr_passwd);
            $page = "newpassword";
            $disData = "ads";
            $msg = "Password Changed";
            $title="password status";

        }else {
            $page = "changePassword";
            $msg = "Passwords do not match,  please try again.";
        }
    }else {
        $page = "changePassword";
        $msg = "Password incorrect password,  please try again.";
    }
}elseif ($op=="activate") {
    
    $cid = $_GET['cid'];
    $quStrUpdateAd = "UPDATE CLASS SET STATUS='ACT' WHERE CID=$cid";
    $quUpdateAd = mysqli_query($dbh,$quStrUpdateAd) or die ("please update at admin2");
    $page = "sel";
    $title = "Selected";
    $disData = "ads";
    $msg = "Ad $cid activated.";
    
    
}elseif ($op=="deactivate") {
    
    $cid = $_GET['cid'];
    $quStrUpdateAd = "UPDATE CLASS SET STATUS='STO' WHERE CID=$cid";
    $quUpdateAd = mysqli_query($dbh,$quStrUpdateAd) or die ("please update at admin2");
    $page = "sel";
    $title = "Selected";
    $disData = "ads";
    $msg = "Ad $cid deactivated.";
    
}elseif ($op=="myInfo") {
    $page = "myInfo";
    $msg = "Information for $group";
    $title = "Info";
}elseif ($op=="manageGroups") {
    $page = "manageGroups";
    $title = "Manage Groups";
    $disData = "groups";
    $msg="These are details of group";
}elseif ($op=="addGroup") {
    $page = "addGroup";
    $title = "Add Group";
    $msg="Create a new group page";
}elseif ($op=="addGroupDo") {
    $name = mysqli_real_escape_string($dbh,$_POST['name']);
    $abv =  $_POST['abv'];
    $group_phone=$_POST['group_phone'];
    $group_email=$_POST['group_email'];
    $group_url=$_POST['group_url'];
    $sig =  mysqli_real_escape_string($dbh,$_POST['sig']);
    $HTML_HEADER = mysqli_real_escape_string($dbh,$_POST['HTML_HEADER']);
    $HTML_FOOTER = mysqli_real_escape_string($dbh,$_POST['HTML_FOOTER']);
    $TYPE1_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE1_HEAD']);
    $TYPE1_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE1_FOOT']);
    $TYPE2_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE2_HEAD']);
    $TYPE2_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE2_FOOT']);
    $TYPE3_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE3_HEAD']);
    $TYPE3_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE3_FOOT']);
    $TYPE4_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE4_HEAD']);
    $TYPE4_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE4_FOOT']);
    $maxAct = $_POST['maxAct'];
    $level =  $_POST['level'];
    $quStrAddGr = "INSERT INTO `GROUP` (NAME, ABV, SIG, GROUP_PHONE, GROUP_EMAIL, GROUP_URL, `HEAD`, `FOOT`, MAXACT, LEVEL, GRSTATUS, TYPE1_HEAD, TYPE1_FOOT, TYPE2_HEAD, TYPE2_FOOT, TYPE3_HEAD, TYPE3_FOOT, TYPE4_HEAD, TYPE4_FOOT) VALUES ('$name', '$abv', '$sig', '$group_phone', '$group_email', '$group_url', '$HTML_HEADER', '$HTML_FOOTER', $maxAct, $level, 'ACT', '$TYPE1_HEAD', '$TYPE1_FOOT', '$TYPE2_HEAD', '$TYPE2_FOOT', '$TYPE3_HEAD', '$TYPE3_FOOT', '$TYPE4_HEAD', '$TYPE4_FOOT')";
    $quAddGr = mysqli_query($dbh,$quStrAddGr);
    $newGrid = mysqli_insert_id($dbh); 
    $_SESSION['newGrid']= $newGrid;
    $page = "createAdmin";
    $msg = "New Group created, Please create an admin user.";
    $title = "Create Admin";
}elseif ($op=="createAdminDo") {
    $title="Create Admin";
    if(isset($_POST['newGrid'])){
    $newGrid = $_POST['newGrid'];}
if(isset($_POST['crHandle'])){
    $crHandle = $_POST['crHandle'];  }
if(isset($_POST['email'])){
    $email = $_POST['email'];  }
if(isset($_POST['crPass'])){
    $crPass = $_POST['crPass'];}

    $quStrCreateAdmin = "INSERT INTO USERS (`GROUP`, HANDLE, PASS, EMAIL, USER_LEVEL) VALUES ($newGrid, '$crHandle', '$crPass', '$email', 3)";
    $quCreateAdmin = mysqli_query($dbh,$quStrCreateAdmin);
    $newUID = mysqli_insert_id($dbh);
//    $result = mysqli_affected_rows($dbh);
//
//    echo $result;
    
    if ($quCreateAdmin) {
        $newUID = mysqli_insert_id($dbh);
        $quStrUpdateGroup = "UPDATE `GROUP` SET ADMIN=$newUID WHERE GRID=$newGrid";
        $quUpdateGroup = mysqli_query($dbh,$quStrUpdateGroup) or die ("can't set admin for group");
       // $pw = new PwFile($PASSWORD_FILE);
        $usr_ID = $crHandle;
        $usr_passwd = $crPass;
       // $pw->addUser($usr_ID, $usr_passwd);
        $page = "manageGroups";
        $msg = "New Group and Admin user created";
        $disData = "groups";
    }else {
        $page = "createAdmin";
        $msg = "Sorry,  that user name is already taken,  please try another.";
    }
}elseif ($op=="editGroup") {
    $ggrid = $_GET['getGRID'];
    $page = "editGroup";
    $title = "Edit Group";
    $disData = "group";
    $msg ="Edit group ";
    $getGRID=$_GET['getGRID'];

}elseif ($op=="editGroupDo") {
    $ggrid = $_POST['getGRID'];
    if (isset($_POST["name"])) {
        $name = mysqli_real_escape_string($dbh,$_POST["name"]);
    }
    else{
        $name="";
    }
    if(isset($_POST['abv'])){
    $abv =  $_POST['abv'];}
    else{
        $abv="";
    }
    if(isset($_POST['sig'])){
    $sig =  mysqli_real_escape_string($dbh,$_POST['sig']);}
    else{
        $sig="";
    }
    if(isset($_POST['group_phone'])){
    $group_phone= $_POST['group_phone'];}
    else{
        $group_phone="";
    }
    if(isset($_POST['group_email'])){
    $group_email=$_POST['group_email'];}
    else{
        $group_email="";
    }
    if(isset($_POST['group_url'])){
    $group_url=$_POST['group_url'];}
    else{
        $group_url="";
    }
    if(isset($_POST['HTML_HEADER'])){
    $HTML_HEADER = mysqli_real_escape_string($dbh,$_POST['HTML_HEADER']);}
    else{
        $HTML_HEADER="";
    }
    if(isset($_POST['HTML_FOOTER'])){
    $HTML_FOOTER = mysqli_real_escape_string($dbh,$_POST['HTML_FOOTER']);}
    else{
        $HTML_FOOTER="";
    }
    if(isset($_POST['maxact'])){
    $maxAct = $_POST['maxact'];}
    else{
        $maxAct="";
    }
    if(isset($_POST['TYPE1_HEAD'])){
    $TYPE1_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE1_HEAD']);}
    else{
        $TYPE1_HEAD="";
    }
    if(isset($_POST['TYPE1_FOOT'])){
        $TYPE1_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE1_FOOT']);}
    else{
        $TYPE1_FOOT="";
    }
    if(isset($_POST['TYPE2_HEAD'])){
    $TYPE2_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE2_HEAD']);}
    else{
        $TYPE2_HEAD="";
    }
    if(isset($_POST['TYPE2_FOOT'])){
    $TYPE2_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE2_FOOT']);}
    else{
        $TYPE2_FOOT="";
    }
    if(isset($_POST['TYPE3_HEAD'])){
    $TYPE3_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE3_HEAD']);}
    else{
        $TYPE3_HEAD="";
    }
    if(isset($_POST['TYPE3_FOOT'])){
    $TYPE3_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE3_FOOT']);}
    else{
        $TYPE3_FOOT="";
    }
    if(isset($_POST['TYPE4_HEAD'])){
    $TYPE4_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE4_HEAD']);}
    else{
        $TYPE4_HEAD="";
    }
    if(isset($_POST['TYPE4_FOOT'])){
    $TYPE4_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE4_FOOT']);}
    else{
        $TYPE4_FOOT="";
    }
    if(isset($_POST['TYPE5_HEAD'])){
    $TYPE5_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE5_HEAD']);}
    else{
        $TYPE5_HEAD="";
    }
    if(isset($_POST['TYPE5_FOOT'])){
    $TYPE5_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE5_FOOT']);}
    else{
        $TYPE5_FOOT="";
    }
    if(isset($_POST['TYPE6_HEAD'])){
    $TYPE6_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE6_HEAD']);}
    else{
        $TYPE6_HEAD="";
    }
    if(isset($_POST['TYPE6_FOOT'])){
    $TYPE6_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE6_FOOT']);}
    else{
        $TYPE6_FOOT="";
    }
    if(isset($_POST['TYPE7_HEAD'])){
    $TYPE7_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE7_HEAD']);}
    else{
        $TYPE7_HEAD="";
    }
    if(isset($_POST['TYPE7_FOOT'])){
    $TYPE7_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE7_FOOT']);}
    else{
        $TYPE7_FOOT="";
    }
    if(isset($_POST['TYPE8_HEAD'])){
    $TYPE8_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE8_HEAD']);}
    else{
        $TYPE8_HEAD="";
    }
    if(isset($_POST['TYPE9_FOOT'])){
    $TYPE8_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE9_FOOT']);}
    else{
        $TYPE8_FOOT="";
    }
    if(isset($_POST['TYPE9_HEAD'])){
    $TYPE9_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE9_HEAD']);}
    else{
        $TYPE9_HEAD="";
    }
    if(isset($_POST['TYPE9_FOOT'])){
    $TYPE9_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE9_FOOT']);}
    else{
        $TYPE9_FOOT="";
    }
    if(isset($_POST['TYPE10_HEAD'])){
    $TYPE10_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE10_HEAD']);}
    else{
        $TYPE10_HEAD="";
    }
    if(isset($_POST['TYPE10_FOOT'])){
    $TYPE10_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE10_FOOT']);}
    else{
        $TYPE10_FOOT="";
    }
    if(isset($_POST['TYPE11_HEAD'])){
    $TYPE11_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE11_HEAD']);}
    else{
        $TYPE11_HEAD="";
    }
    if(isset($_POST['TYPE11_FOOT'])){
    $TYPE11_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE11_FOOT']);}
    else{
        $TYPE11_FOOT="";
    }
    if(isset($_POST['TYPE12_HEAD'])){

    $TYPE12_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE12_HEAD']);}
    else{
        $TYPE12_HEAD="";
    }
    if(isset($_POST['TYPE12_FOOT'])){
    $TYPE12_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE12_FOOT']);}
    else{
        $TYPE12_FOOT="";
    }
    if(isset($_POST['TYPE13_HEAD'])){
    $TYPE13_HEAD = mysqli_real_escape_string($dbh,$_POST['TYPE13_HEAD']);}
    else{
        $TYPE13_HEAD="";
    }
    if(isset($_POST['TYPE13_FOOT'])){
    $TYPE13_FOOT = mysqli_real_escape_string($dbh,$_POST['TYPE13_FOOT']);}
    else{
        $TYPE13_FOOT="";
    }
    if(isset($_POST['MEETAGENTS_HEAD'])){
    $MEETAGENTS_HEAD = mysqli_real_escape_string($dbh,$_POST['MEETAGENTS_HEAD']);}
    else{
        $MEETAGENTS_HEAD="";
    }
    if(isset($_POST['MEETAGENTS_FOOT'])){
    $MEETAGENTS_FOOT = mysqli_real_escape_string($dbh,$_POST['MEETAGENTS_FOOT']);}
    else{
        $MEETAGENTS_FOOT="";
    }
    if(isset($_POST['HOMEPAGE_HEAD'])){
    $HOMEPAGE_HEAD = mysqli_real_escape_string($dbh,$_POST['HOMEPAGE_HEAD']);}
    else{
        $HOMEPAGE_HEAD="";
    }
    if(isset($_POST['HOMEPAGE_FOOT'])){
    $HOMEPAGE_FOOT = mysqli_real_escape_string($dbh,$_POST['HOMEPAGE_FOOT']);}
    else{
        $HOMEPAGE_FOOT="";
    }
    if(isset($_POST['COBROKE_HEAD'])){
    $COBROKE_HEAD = mysqli_real_escape_string($dbh,$_POST['COBROKE_HEAD']);}
    else{
        $COBROKE_HEAD="";
    }
    if(isset($_POST['COBROKE_FOOT'])){
    $COBROKE_FOOT = mysqli_real_escape_string($dbh,$_POST['COBROKE_FOOT']);}
    else{
        $COBROKE_FOOT="";
    }
    if(isset($_POST['EMAIL_HEADER'])){
    $EMAIL_HEADER = mysqli_real_escape_string($dbh,$_POST['EMAIL_HEADER']);}
    else{
        $EMAIL_HEADER="";
    }
    if(isset($_POST['EMAIL_FOOTER'])){
    $EMAIL_FOOTER = mysqli_real_escape_string($dbh,$_POST['EMAIL_FOOTER']);}
    else{
        $EMAIL_FOOTER="";
    }
    if(isset($_POST['CL_HEADER'])){
    $CL_HEADER = mysqli_real_escape_string($dbh,$_POST['CL_HEADER']);}
    else{
        $CL_HEADER="";
    }
    if(isset($_POST['CL_FOOTER'])){
    $CL_FOOTER = mysqli_real_escape_string($dbh,$_POST['CL_FOOTER']);}
    else{
        $CL_FOOTER="";
    }
    if(isset($_POST['REGKEY'])){
    $REGKEY = $_POST['REGKEY'];}
    else{
        $REGKEY="";
    }
    if(isset($_POST['REGEXP'])){
    $REGEXP = $_POST['REGEXP'];}
    else{
        $REGEXP="";
    }
    if(isset($_POST['REGFEE'])){
    $REGFEE = $_POST['REGFEE'];}
    else{
        $REGFEE="";
    }
    if(isset($_POST['AGENCIES'])){
    $AGENCIES = $_POST['AGENCIES'];}
    else{
        $AGENCIES="";
    }
    if(isset($_POST['level'])){
    $level =  $_POST['level'];}
    else{
        $level="";
    }
    $quStrUpdateGr = "UPDATE `GROUP` SET NAME='$name', ABV='$abv', SIG='$sig', GROUP_PHONE='$group_phone', GROUP_EMAIL='$group_email', GROUP_URL='$group_url', HEAD='$HTML_HEADER', FOOT='$HTML_FOOTER', MAXACT=$maxAct, LEVEL=$level, TYPE1_HEAD='$TYPE1_HEAD', TYPE1_FOOT='$TYPE1_FOOT', TYPE2_HEAD='$TYPE2_HEAD', TYPE2_FOOT='$TYPE2_FOOT', TYPE3_HEAD='$TYPE3_HEAD', TYPE3_FOOT='$TYPE3_FOOT', TYPE4_HEAD='$TYPE4_HEAD', TYPE4_FOOT='$TYPE4_FOOT', TYPE5_HEAD='$TYPE5_HEAD', TYPE5_FOOT='$TYPE5_FOOT', TYPE6_HEAD='$TYPE6_HEAD', TYPE6_FOOT='$TYPE6_FOOT', TYPE7_HEAD='$TYPE7_HEAD', TYPE7_FOOT='$TYPE7_FOOT', TYPE8_HEAD='$TYPE8_HEAD', TYPE8_FOOT='$TYPE8_FOOT', TYPE9_HEAD='$TYPE9_HEAD', TYPE9_FOOT='$TYPE9_FOOT', TYPE10_HEAD='$TYPE10_HEAD', TYPE10_FOOT='$TYPE10_FOOT', TYPE11_HEAD='$TYPE11_HEAD', TYPE11_FOOT='$TYPE11_FOOT', TYPE12_HEAD='$TYPE12_HEAD', TYPE12_FOOT='$TYPE12_FOOT', TYPE13_HEAD='$TYPE13_HEAD', TYPE13_FOOT='$TYPE13_FOOT', MEETAGENTS_HEAD='$MEETAGENTS_HEAD', MEETAGENTS_FOOT='$MEETAGENTS_FOOT', HOMEPAGE_HEAD='$HOMEPAGE_HEAD', HOMEPAGE_FOOT='$HOMEPAGE_FOOT', COBROKE_HEAD='$COBROKE_HEAD', COBROKE_FOOT='$COBROKE_FOOT', EMAIL_HEADER='$EMAIL_HEADER', EMAIL_FOOTER='$EMAIL_FOOTER', CL_HEADER='$CL_HEADER', CL_FOOTER='$CL_FOOTER', REGKEY='$REGKEY', REGFEE='$REGFEE', AGENCIES='$AGENCIES' WHERE GRID=$ggrid";
    $quUpdateGr = mysqli_query($dbh,$quStrUpdateGr) or die ("$quStrUpdateGr");
    $page = "manageGroups";
    $msg = "Group Updated";
    $title = "Manage Groups";
    $disData = "groups";
}elseif ($op=="deactivateGroup") {
    $ggrid = $_GET['ggrid'];
    $quStrDeActAds = "UPDATE CLASS SET STATUS='STO' WHERE CLI=$ggrid";
    $quDeActAds = mysqli_query ($dbh,$quStrDeActAds) or die ("can't deactivate ads");
    $quStrDeActGr = "UPDATE `GROUP` SET STATUS='STO' WHERE GRID=$ggrid";
    $quDeActGr = mysqli_query ($dbh,$quStrDeActGr) or die ("can't deactivate group");
    $page = "manageGroups";
    $msg = "Group deactivated";
    $disData = "groups";
    $title = "Manage Groups";
}elseif ($op=="activateGroup") {
    $ggrid = $_GET['ggrid'];
    $quStrDeActAds = "UPDATE CLASS SET STATUS='ACT' WHERE CLI=$ggrid";
    $quDeActAds = mysqli_query ($dbh,$quStrDeActAds) or die ("can't deactivate ads");
    $quStrDeActGr = "UPDATE `GROUP` SET STATUS='ACT' WHERE GRID=$ggrid";
    $quDeActGr = mysqli_query ($dbh,$quStrDeActGr) or die ("can't deactivate group");
    $page = "manageGroups";
    $msg = "Group activated.";
    $disData = "groups";
    $title = "Manage Groups";
}elseif ($op=="DTIn") {
    $page="DTIn";
    $needOptions = true;
    $title = "Delimited Text Input";
    $msg="Delimitied Text Input Page";
}elseif ($op=="DTInDo") {
    if(isset( $_POST['dChr'])){
    $dChr = $_POST['dChr'];}
    if(isset( $_POST['type'])){
    $type = $_POST['type'];}
    if(isset( $_POST['groupID'])){
    $groupID = $_POST['groupID'];}
    if(isset($_POST['filename'])){
    $filename = $_POST['filename'];}

    $msg="Delimitied Text Input Page execute";
    $myLog = fopen ("./DTInLog.txt", 'w');
    $fp = fopen ($filename, 'r');
    $errFile = fopen ("$filename-errors.txt", 'w');
    $lineErrors = array();
    $line = 0;
    $success = 0;
    $failed = 0;
    $now = date ("Ymd");
    fwrite ($myLog, "############################################################################################ \n");
    fwrite ($myLog, "Log for DT Input ran on $now. for group ID $groupID.  dChar = $dChr, filename=$filename \n");
    fwrite ($myLog, "Errors are dumped into $filename-errors.txt \n");
    fwrite ($myLog, "-------------------------------------------------------------------------------------------- \n");
    
    while ($data = fgetcsv ($fp, 10000, $dChr)) {
        $line++;
        if(isset( $data[0])){
        $loc = $data[0];}
        else{
            $loc="";
        }
          if(isset( $data[2])){
        $body = $data[2];}
          else{
              $body="";
          }
            if(isset( $data[4])){
        $avail = $data[4];}
            else{
                $avail="";
            }
        if (!isset($avail)) {
            $avail = 0;
        }else {
            if (strpos($avail, "-")) {
                $dateParts = explode("-",$avail);
                $avail = $dateParts[2] . $dateParts[0] . $dateParts[1];
            }elseif (strpos($avail, "/")) {
                $dateParts = explode("/",$avail);
                $avail = $dateParts[2] . $dateParts[0] . $dateParts[1];
            }else {
                $month = substr ($avail, 0 , 2);
                $day = substr ($avail, 2,2);
                $year = substr ($avail, 5,4);
                $avail = $year . $month . $day;
            }
        }
            if(isset( $data[4])){
        $price = $data[6];}

        if (!isset($price)) {
            $price = 0;
        }
        
        
        $strRepSingle = addslashes ("'");
        $strRepDouble = addslashes ("\"");
        if(isset($body)) {
            $body = str_replace("^^", $strRepDouble, $body);}
             if(isset($body)) {
            $body = str_replace("^", $strRepSingle, $body);}

        
        //try to get the LOCID from name//
        $quStrGetLOCID = "SELECT LOCID FROM LOC WHERE LOCNAME='$loc'";
        $quGetLOCID = mysqli_query($dbh,$quStrGetLOCID);
        $rowGetLOCID = mysqli_fetch_object ($quGetLOCID);
       // $locID = $rowGetLOCID->LOCID;
        $locID="";
     if (!isset($locID)) {
            $errorMessage = "--LocID not fournd for $loc";
       }
        else{
            $errorMessage="";
        }
        
        $quStrInsAd = "INSERT INTO CLASS (CLI, LOC, AD_TITLE, BODY, TYPE, UID, STATUS, DATEIN, `MOD`, AVAIL, PRICE) VALUES ($groupID, $locID, '$body', $type, $uid, 'ACT', $now, $now, $avail, $price)";
        if (!$quInsAd = mysqli_query($dbh,$quStrInsAd)) {
            fwrite ($myLog, "problem with line # $line.  record not inserted. $errorMessage \n");
            fwrite ($errFile, $loc.$dChr.$body."\n");
            $failed++;
            continue;
        }$success++;
    }
    fclose($fp);
    fwrite ($myLog, "-------------------------------------------------------------------------------------------- \n");
    fwrite ($myLog, "$success completed, $failed failed, $line total lines. \n");
    fwrite ($myLog, "############################################################################################ \n");
    fclose ($myLog);
    fclose ($errFile);
    $page = "DTIn";
    $needOptions = true;
    $msg = "Import Complete,  $success completed, $failed failed, $line total lines.";
    $fin = true;
    
}elseif ($op=="export") {
    
    $quStrSetSafety = "INSERT INTO SAFETY (TIME, UID, STATUS) VALUES (now(), $uid, 0)";

    
    $quInsSafety = mysqli_query("INSERT INTO SAFETY (TIME,UID, STATUS) VALUES (now(), $uid, 0)");
    
    $newSafeID = mysqli_insert_id();
    
    $filename = "./ex/$handle-$newSafeID.csv";
    $export = fopen ($filename, 'a');
    
    $quStrGetAdsForEx = "SELECT * FROM CLASS ";
    $quGetAdsForEx = mysqli_query ($dbh,$quStrGetAdsForEx);
    $numAds = mysqli_num_rows($quGetAdsForEx);
    
    while ($rowGetAdsForEx = mysqli_fetch_object($quGetAdsForEx)) {
        $quStrSafetyAd = "UPDATE CLASS SET SAFETY=1 WHERE CID=$rowGetAdsForEx->CID";
        $quSafetyAd = mysqli_query($dbh,$quStrSafetyAd);
        $bodyCarrat = str_replace ("'" , "^", $rowGetAdsForEx->BODY);
        $bodyCarrat = str_replace ("\"", "^^", $bodyCarrat);
        fwrite($export, "$rowGetAdsForEx->CID,\"$bodyCarrat\" \n");
    }
    fclose ($export);
    $exDir = dir("./ex");
    
    
    
    
    $page="import";
    $title ="Export - Import";
    $msg = "Export Competed, $numAds locked for editing";
}elseif ($op=="import") {
    $exDir = dir("./ex");
    $page="import";
    $title ="Import";
    $msg = "Import previously exported file";
}elseif ($op=="importDo") {
    
    $filename = $_POST['filename'];
    
    $myLog = fopen ("./ex/EXInLog.txt", 'w');
    $fp = fopen ("./ex/$filename", 'r');
    $errFile = fopen ("./ex/$filename-errors.txt", 'w+');
    $lineErrors = array();
    $line = 0;
    $success = 0;
    $failed = 0;
    $now = date ("Ymd");
    fwrite ($myLog, "############################################################################################ \n");
    fwrite ($myLog, "Log for Export Import ran on $now. filename=$filename \n");
    fwrite ($myLog, "Errors are dumped into $filename-errors.txt \n");
    fwrite ($myLog, "-------------------------------------------------------------------------------------------- \n");
    
    while ($data = fgetcsv ($fp, 10000)) {
        $line++;
        $cid = $data[0];
        $body = $data[1];
        
        $quStrInsAd = "UPDATE CLASS SET BODY='$body', `MOD`=$now, SAFETY=0 WHERE CID=$cid";
        if (!$quInsAd = mysqli_query($dbh,$quStrInsAd)) {
            fwrite ($myLog, "problem with line # $line.  record not updated.  \n");
            $failed++;
            continue;
        }
        
        $success++;
    }
    fclose($fp);
    fwrite ($myLog, "-------------------------------------------------------------------------------------------- \n");
    fwrite ($myLog, "$success completed, $failed failed, $line total lines. \n");
    fwrite ($myLog, "############################################################################################ \n");
    fclose ($myLog);
    fclose ($errFile);
    $page = "home";
    $msg = "Import Complete,  $success completed, $failed failed, $line total lines.";
    $needOptions = true;
    $fin = true;
    
}elseif ($op=="addGroupUser") {
    $newHandle = $_POST['newHandle'];
    $newPass = $_POST['newPass'];
    $newEmail = $_POST['newEmail'];
    $ggrid = $_POST['ggrid'];
    $quStrAddGroupUser = "INSERT INTO USERS (HANDLE, PASS, EMAIL, `GROUP`, USER_LEVEL) VALUES ('$newHandle', '$newPass', '$newEmail', $ggrid, 3)";
    $quAddGroupUser = mysqli_query($dbh,$quStrAddGroupUser);
    if ($quAddGroupUser) {
//        $pw = new PwFile($PASSWORD_FILE);
//        $usr_ID = $newHandle;
//        $usr_passwd = $newPass;
//        $pw->addUser($usr_ID, $usr_passwd);
        $page = "editGroup";
        $disData = "group";
        $title = "Edit Group";
        $msg = "New User, $newHandle added successfully";
    } else {
        $page = "editGroup";
        $msg = "Sorry,  that user name is already taken, please try another.";
        $disData = "group";
    }
}elseif ($op=="termUser") {
    $termUID = $_GET['uid'];
    $termHandle = $_GET['handle'];
    $getGrid = $_GET['getGrid'];
    $quStrUpdateUser = "UPDATE USERS SET HANDLE='term$termUID', PASS='', EMAIL='' WHERE UID=$termUID AND `GROUP`=$getGrid";
    $quUpdateUser = mysqli_query($dbh,$quStrUpdateUser) or die ("can't remove user from table");
//    $pw = new PWFile($PASSWORD_FILE);
//    $pw->deleteUser ($termHandle);
    $page="home";
    $ggrid = $getGrid;
    $title = "Edit Group";
    $msg = "User terminated, name changed access denied.";
    
    
}elseif ($op=="manPub") {
    $page= "manPub";
    $title = "Manual Publish";
    $msg = "Define the scope of your publish";
}elseif ($op=="select_and_do") {
    if(isset($_POST['sop'])){
    $sop = $_POST['sop'];}
    if(isset($_POST['sel_ids'])){
    $sel_ids = $_POST['sel_ids'];}
    
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
            $selWHERE.= $string2Cat;
    }
    if ($sop=="delete") {
        if (!$numIDs) {
            $page = "home";
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
        $quSelAndDo = mysqli_query($dbh,$quStrSelAndDo) or die("can't muli update");
        $page = "home";
        $disData = "ads";
        $msg = "$numIDs ad(s) deactivated.";
        $title = "Selected";
    }elseif ($sop=="activate") {
        $quStrSelAndDo = "UPDATE CLASS SET STATUS='ACT' $selWHERE";
        $quSelAndDo = mysqli_query($dbh,$quStrSelAndDo) or die("can't muli update");
        $page = "home";
        $disData = "ads";
        $msg = "$numIDs ad(s) activated.";
        $title = "Selected";
    }elseif ($sop=="nofee") {
        $quStrSelAndDo = "UPDATE CLASS SET NOFEE=1 $selWHERE";
        $quSelAndDo = mysqli_query($dbh,$quStrSelAndDo) or die("can't muli update");
        $page = "home";
        $msg = "$numIDs ad(s) switched to 'NO FEE'.";
        $disData = "ads";
        $title = "Selected";
    }elseif ($sop=="fee") {
        $quStrSelAndDo = "UPDATE CLASS SET NOFEE=0 $selWHERE";
        $quSelAndDo = mysqli_query($dbh,$quStrSelAndDo) or die("can't muli update");
        $page = "home";
        $msg = "$numIDs ad(s) 'NO FEE' value negated.";
        $disData = "ads";
        $title = "Selected";
    }
    
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
            $selWHERE.= $string2Cat;
    }
    if ($conf==1) {
        $quStrSelAndDel = "DELETE FROM CLASS $selWHERE";
        $quSelAndDel = mysqli_query($dbh,$quStrSelAndDel) or die ("can't multi-delete");
        $page = "home";
        $disData = "ads";
        $msg = "$numIDs ad(s) deleted.";
        $title = "Selected";
    }else {
        $page = "select_and_delete";
        $msg = "No action taken,  please type 'y'";
        $title = "Select and Delete";
    }
    
}elseif ($op=="ftSel") {
    if(isset($_POST['ftSearchTerm'])){
    $ftSearchTerm = $_POST['ftSearchTerm'];}
    $title = "Selected";
    $msg = "Ads selected,  operate from here.";
    $disData = "ftAds";
    $ftSearch = true;
    $page = "sel";
}elseif ($op=="clearQuery") {
    $filterIsSet = false;
    $page = "home";
    $title="Destory Query";
    $msg="Query search is be reset!";
    $needOptions = true;
    $_SESSION['where']="";
}


//sortOrder builder //
if (isset($_GET['sort'])) {
    $sort = "`".$_GET['sort']."`";
    $sortOrder = " ORDER BY $sort";
}else {
    $sortOrder = "";
}


//RECORDSET SWITCH//
if(isset($disData))
{  
if ($disData=="ads") {
    
    if( isset($_SESSION['where'] ))
    {
        if($_SESSION['where'] =="") {
            $limit = "LIMIT 50";
            $message= "can't display all ads, query limited to the 1st 50.";
            echo "<script type='text/javascript'>alert('can not display all ads, limited to the 1st 50');</script>";
            $where=$_SESSION['where'];
        }
        else{
            $where=$_SESSION['where'];
            $limit=null;
        }
    }
    else {
        $limit = "LIMIT 50";
        $where="";
    }

    $quStrGetAds = "SELECT * FROM (((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE  $where $sortOrder $limit";
    $quGetAds = mysqli_query($dbh,$quStrGetAds) or die ($quStrGetAds);

}elseif ($disData=="ad") {
    $quStrGetAd = "SELECT * FROM ((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID WHERE CID=$cid";
    $quGetAd = mysqli_query($dbh,$quStrGetAd) or die ("can't get ad");
    $rowGetAd = mysqli_fetch_object($quGetAd);
//    search query
}elseif ($disData=="ftAds") {
    $quStrGetAds = "SELECT  * ,  MATCH ( ALTSIG, BODY ) AGAINST (  '$ftSearchTerm' ) AS SCORE FROM ((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID WHERE  MATCH ( ALTSIG, BODY ) AGAINST ('$ftSearchTerm') ORDER  BY SCORE DESC LIMIT 10";
    $quGetAds = mysqli_query($dbh,$quStrGetAds);

}elseif ($disData=="pics") {
    $quStrGetPics = "SELECT * FROM PICTURE WHERE CID=$cid $sortOrder";
    $quGetPics = mysqli_query($dbh,$quStrGetPics) or die ("can't get pics");
}elseif ($disData=="pic") {
    $quStrGetPic = "SELECT * FROM PICTURE WHERE PID=$pid";
    $quGetPic = mysqli_query($dbh,$quStrGetPic) or die ("can't get pic");
    $rowGetPic = mysqli_fetch_object($quGetPic);
}elseif ($disData=="groups") {
    $quStrGetGroups = "SELECT * FROM `GROUP` $sortOrder";
    $quGetGroups = mysqli_query($dbh,$quStrGetGroups) or die ("can't get users");
//    echo "<!--RECORDSET users $quGetUsers -->";
}elseif ($disData=="group") {
    $quStrGetGroup = "SELECT * FROM `GROUP` WHERE GRID=$ggrid";
    $quGetGroup = mysqli_query($dbh,$quStrGetGroup) or die ("can't get group");
    $rowGetGroup = mysqli_fetch_object($quGetGroup);
    $quStrGetGroupUsers = "SELECT * FROM USERS WHERE `GROUP`=$ggrid ORDER BY HANDLE";
    $quGetGroupUsers = mysqli_query($dbh,$quStrGetGroupUsers) or die ("can't get users");
//    echo "<!--RECORDSET user $quGetUser -->";
}

}


if ($page=="home") {
    $needOptions = true;
}

//FORM OPTIONS LOOKUP SWITCH//
if ($needOptions) {
    
    $quStrFavLocs = "SELECT * FROM FAVLOC INNER JOIN LOC ON FAVLOC.LOC=LOC.LOCID WHERE UID='$uid' ORDER BY SCORE DESC LIMIT 10";
    $quFavLocs = mysqli_query($dbh,$quStrFavLocs);
    $quStrLocs = "SELECT * FROM LOC ORDER BY LOCNAME";
    $quLocs = mysqli_query($dbh,$quStrLocs) or die ("can't get locs");
    $quStrTypes = "SELECT * FROM TYPES";
    $quTypes = mysqli_query($dbh,$quStrTypes) or die ("can't get types");
    $quStrGroups = "SELECT GRID, NAME FROM `GROUP` ORDER BY NAME";
    $quGroups = mysqli_query($dbh,$quStrGroups) or die ("can't get groups");
    $quStrGetUsers = "SELECT UID, HANDLE FROM USERS ORDER BY HANDLE ";
    $quGetUsers = mysqli_query($dbh,$quStrGetUsers) or die ("can't get users");
    
    
}

?>


<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Boston Apartments Ad Management</title>
<link rel="stylesheet" href="layout/layui/css/layui.css">
<link rel="stylesheet" href="css/calendar.css">
<script src="js/jquery.min.js"></script>
<!-- Source the JavaScript spellChecker object -->
<script  type="text/javascript" src="/speller/spellChecker.js">
</script>
<!-- jquery of password -->
<script type="text/javascript" src="js/passwordjs/jquery.min.js"></script>
<!-- Call a function like this to handle the spell check command -->
<script  type="text/javascript">
function openSpellChecker() {
        // get the textarea we're going to check
        var txt = document.adlEditForm.body;
        // give the spellChecker object a reference to our textarea
        // pass any number of text objects as arguments to the constructor:
        var speller = new spellChecker( txt );
        // kick it off
        speller.openChecker();
}
</script>
<!-- password weak-medium-strong --> 
<script type="text/javascript"> 
// new password weak medium or strong detection
$(function(){ 
	$('#pass').keyup(function () { 
		var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g"); 
		var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g"); 
		var enoughRegex = new RegExp("(?=.{6,}).*", "g");

		if (false == enoughRegex.test($(this).val())) {
			$('#level').removeClass('pw-weak');
			$('#level').removeClass('pw-medium');
			$('#level').removeClass('pw-strong');
			$('#level').addClass(' pw-defule');

		}
		else if (strongRegex.test($(this).val())) {
			$('#level').removeClass('pw-weak');
			$('#level').removeClass('pw-medium');
			$('#level').removeClass('pw-strong');
			$('#level').addClass(' pw-strong');

		}
		else if (mediumRegex.test($(this).val())) {
			$('#level').removeClass('pw-weak');
			$('#level').removeClass('pw-medium');
			$('#level').removeClass('pw-strong');
			$('#level').addClass(' pw-medium');

		}
		else {
			$('#level').removeClass('pw-weak');
			$('#level').removeClass('pw-medium');
			$('#level').removeClass('pw-strong');
			$('#level').addClass('pw-weak');

		}
		return true;
	}); 
}) 
</script>
<!-- delete verification -->


<style type="text/css">
 .body{
		background: url(img/backgroundofadmin.jpg)no-repeat;
 	    text:white;
 	    link:white;
 	    vlink:white£»
 	    alink:white£»
 	    topmargin:0em£»
 	    leftmargin:0em£»
 	
	 }
.font2 {
	background: #EEE url(data:image/gif;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAIAAAAmkwkpAAAAHklEQVQImWNkYGBgYGD4//8/A5wF5SBYyAr+//8PAPOCFO0Q2zq7AAAAAElFTkSuQmCC) repeat;
	text-shadow: 5px -5px black, 4px -4px white;
	font-weight: bold;
	-webkit-text-fill-color: transparent;
	-webkit-background-clip: text}
	
 .div1
	{  font-size: 30px;
	  	
    }
.pw-strength {clear: both;position: relative;top: 8px;width: 180px;}
.pw-bar{background: url(img/pwd-1.png) no-repeat;height: 14px;overflow: hidden;width: 179px;}
.pw-bar-on{background:  url(img/pwd-2.png) no-repeat; width:0px; height:14px;position: absolute;top: 1px;left: 2px;transition: width .5s ease-in;-moz-transition: width .5s ease-in;-webkit-transition: width .5s ease-in;-o-transition: width .5s ease-in;}
.pw-weak .pw-defule{ width:0px;}
.pw-weak .pw-bar-on {width: 60px;}
.pw-medium .pw-bar-on {width: 120px;}
.pw-strong .pw-bar-on {width: 179px;}
.pw-txt {padding-top: 2px;width: 180px;overflow: hidden;}
.pw-txt span {color: #707070;float: left;font-size: 12px;text-align: center;width: 58px;}


</style>
</head>

<div class="layui-layout-body">


<div class="layui-layout layui-layout-admin">
  <div class="layui-header" style="background-color: #4d90fe;">
      <div class="layui-logo"><a style="color: white">Admin administration</a> </div>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="https://www.choicehotels.com/cms/images/choice-hotels/citys/405167-Boston/405167-Boston.jpg" class="layui-nav-img">
          	<i><?php echo $handle; ?></i>         	
        </a>
          <span class="layui-nav-more"></span>
          <dl class="layui-nav-child">
         
          <dd><a>Group:  <?php echo $group;?></a></dd>

        </dl>
      </li>
      <li class="layui-nav-item"><a href="../logout.php">logout</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black" >
    <div class="layui-side-scroll" >
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item"><a class="layui-this" href="<?php echo "$PHP_SELF?op=home"; ?>">Home</a></li>
        <li class="layui-nav-item">
          <a class="" href="javascript:;">System</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo "$PHP_SELF?op=changePassword"; ?>">Change password</a></dd>
            
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">Query Options</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo "$PHP_SELF?op=sel"; ?>">Last Query</a></dd>
            <dd><a href="<?php echo "$PHP_SELF?op=clearQuery";?>">Destroy</a></dd>
<!--            <dd> <a href="--><?php //echo "$PHP_SELF?op=DTIn"; ?><!--">Delimited Text Input</a></dd>-->
          </dl>
        </li>
        <li class="layui-nav-item">
            <a href="javascript:;">Group</a>
            <dl class="layui-nav-child">
                <dd> <a href="<?php echo "$PHP_SELF?op=addGroup"; ?>">Create Group</a></dd>
                <dd> <a href="<?php echo "$PHP_SELF?op=manageGroups"; ?>">Manage Group</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item">
             <a href="javascript:;">Tools</a>
             <dl class="layui-nav-child">
                <dd> <a href="<?php echo "$PHP_SELF?op=manPub"; ?>">Manual Publish</a></dd>
<!--                <dd> <a href="--><?php //echo "$PHP_SELF?op=import"; ?><!--">Import Tool</a></dd>-->
            </dl>
                
            </li>
        <li class="layui-nav-item">
            <a href="javascript:;">ListAPT</a>
            <dl class="layui-nav-child">
                <dd><A HREF="https://www.BostonApartments.com/listapt-o.htm" target="_NEW">ListAPT-0</a></dd>
                <dd><a href="https://www.bostonapartments.com/findapt-o.htm" target="_new">findapt-o</a></dd>
            </dl>
        </li>
          <li class="layui-nav-item">
              <a href="javascript:;">Admin2 Jump</a>
              <dl class="layui-nav-child">
                  <dd><A HREF="../admin2/index.php" target="_NEW">Admin2 page</a></dd>
              </dl>
          </li>

      </ul>
    </div>
  </div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="layout/layui/layui.js"></script>
<script type="text/javascript" src="js/index.js"></script>


  <<div class="layui-body" >

    <div style="padding: 15px;">
        <fieldset class="layui-elem-field">
            <legend><b><?php echo $title;?></b></legend>
            <div class="layui-field-box">
                <table class="layui-table">
				<tr>
               <td width="100%"  valign="middle" align="center" >
					<b><a class="div1"  href="<?php echo "$PHP_SELF?op=compose"; ?>">Compose</a></b>	
							
		       </td>
				</tr>
				<tr>
					<td width="100%"  valign="middle" align="center"  >
					
					<div class="div1"><a class="font2"> Detail:</a></div>	
					<br></br>
					<div ><b class="div1" style="color: red"><?php echo $msg; ?></b></div>
					
			   </tr>			   		   
                </table>
            </div>
        </fieldset>
        
<?php if ($page=="home") { ?>
	
           <fieldset class="layui-elem-field">
          <legend><b>Listing</b></legend>
          <div class="layui-field-box">
              <table class="layui-table">
              <tbody>
				<tr  >    			
					<td  style="text-align: center">
						<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">

                            <b>jump to listing #</b>
                            <br>
                        <input type="text" name="cid" size="30" value="">
                            <br> <input type="radio" name="op" value="edit" selected><b>edit:</b>
                            <input type="radio" name="op" value="delete"> <b>delete:</b><br>
                        <input  style="width: 3cm" type="submit" value="go">
                        </font> 
                        </form>                        
					</td>
					<td style="text-align: center ">
                        <dd><A style="font-size: large" HREF="../admin2/manage_listings.php" target="_NEW">Admin2 listing page</a></dd>
                    </td>
                    <td >
                    <a href="https://www.bostonapartments.com/lacms/clients/agencyarea2" style="color: orangered">
                    client<br>interface<br>view</a>
                    </td>	
				</tr>
				</tbody>\
              </table>
          </div>
      </fieldset>
      
                <fieldset class="layui-elem-field" ">
          <legend><b>Query Section</b></legend>
          <div class="layui-field-box">
          <form action="index.php?op=setWhere" method="POST">
              <table class="layui-table" style="border:4px solid ">  
              <tbody>
				<tr  >   
				<td style="border:2px solid " width="23" height="31" align="center"></td>
                    <td style="border:2px solid " width="153" height="31" align="center">
                   <p align="center"> <font color="#000000" face="Verdana" size="2">Group</font></td>
                    <td style="border:2px solid " width="29" height="31" align="center"></td>
                    <td style="border:2px solid " width="126" height="31" align="center">
                   <p align="center"><font color="#000000" face="Verdana" size="2">Created Start date</font></td>
                    <td style="border:2px solid " width="24" height="31" align="center"></td>
                    <td style="border:2px solid " width="139" height="31" align="center">
                   <p align="center"><font color="#000000" face="Verdana" size="2">Created End Date</font></td> 
				</tr>
		
				<tr>
				<td style="border:2px solid " width="23" height="16"><input type="checkbox"  value="ON"  name="qGroup"></td>
				<td style="border:2px solid " width="153" height="16">
                <select size="1" name="qGroupV">
                
                		<?php while ($rowGroups = mysqli_fetch_object ($quGroups)) { ?>
                
                			<option value="<?php echo $rowGroups->GRID; ?>" > <?php echo $rowGroups->NAME; ?> </option>
                			
                			
                		<?php } ?>
                
                </select>
                </td>
                
                <td style="border:3px solid " width="129" height="16" align="right"><input type="checkbox" name="qStartCr"   value="ON"></td>
                <!--  add the calender Ui into created start date part -->
                
                <td style="border:3px solid "width="126" height="16"><p align="center"> <input  type="text" class="room"  name="qStartCrV" id="date" value=" <?php echo $now; ?>" size="10" onclick=""></td>                
                <td style="border:3px solid " width="20" height="16" align="right"><input type="checkbox" name="qEndCr"  value="ON"></td>                
                <td style="border:3px solid " width="139" height="16"><p align="center"><input type="text" class="room" name="qEndCrV" id="date2" value="<?php echo $now; ?>" size="10"></td>
				</tr>
				
				
                <tr >
                    <td style="border:3px solid " width="23" height="24"></td>
                    <td style="border:3px solid " width="153" height="24">
                    <p align="center"><p align="center"><font color="#000000" face="Verdana" size="2">User</td>
                    <td style="border:3px solid " width="129" height="24"></td>
                    <td style="border:3px solid " width="126" height="24"><p align="center"><font color="#000000" face="Verdana" size="2">Modified Start Date</td>
                    <td style="border:3px solid " width="24" height="24"></td>
                    <td style="border:3px solid " width="139" height="24"><p align="center"><font color="#000000" face="Verdana" size="2">Modified End Date</td>
                </tr>
                
                <tr>
                    <td style="border:3px solid " width="23" height="30"><input type="checkbox" value="ON"   name="qUser"></td>
                    <td style="border:3px solid " width="153" height="30">
                          	<select size="1" name="qUserV">
                    		<?php 
                    		
                    		while ($rowGetUsers = mysqli_fetch_object ($quGetUsers)) { ?>
                    
                    			<option value="<?php echo $rowGetUsers->UID; ?>" > <?php echo $rowGetUsers->HANDLE; ?> </option>
                    		<?php } ?>
                    
                    </select>
                    </td>
                    <td style="border:3px solid " width="129" height="30" align="right"><input type="checkbox" name="qStartMod" value="ON"   value="ON"></td>
                    <td style="border:3px solid " width="126" height="30" ><p align="center"><input type="text" class="room" name="qStartModV" id="date3"  value="<?php echo $now; ?>" size="10"></td>
                    <td style="border:3px solid " width="20" height="16" align="right"><input type="checkbox" name="qEndMod" value="ON"  ></td>
                    
                    <td style="border:3px solid " width="139" height="30"><p align="center"><input type="text" class="room" name="qEndModV" id="date4"  value="<?php echo $now; ?>" size="10"></td>
               </tr>
             
                <tr >
                    <td style="border:3px solid " width="23" height="13"></td>
                    <td style="border:3px solid " width="153" height="13"> <p align="center"><font color="#000000" face="Verdana" size="2">Location</td></p>
                    <td style="border:3px solid " width="129" height="13"></td>
                    <td  style="border:3px solid "width="126" height="13"><p align="center"><font  color="#000000" face="Verdana" size="2">Type</td>
                    <td style="border:3px solid " width="24" height="13"></td>
                    <td style="border:3px solid " width="139" height="13"></td>
                </tr>    
                
                <tr>
                    <td width="23" height="24"><input type="checkbox" name="qLoc"  value="ON"></td>
                    <td width="153" height="24"><select size="1" name="qLocV">
                    <?php while ($rowLocs = mysqli_fetch_object($quLocs)) { ?>
                    
                    <option value="<?php echo $rowLocs->LOCID; ?>"  > <?php echo $rowLocs->LOCNAME; ?> </option>
                    
                    <?php } ?>
                    
                    </select></td>
                    <td width="129" height="24" align="right"><input type="checkbox" name="qType" value="ON"></td>
                    <td width="126" height="24"><select size="1" name="qTypeV">
                    <?php while ($rowTypes = mysqli_fetch_object($quTypes)) { ?>
                    
                    <option value="<?php echo $rowTypes->TYPE; ?>" > <?php echo $rowTypes->TYPENAME;?> </option>
                    <?php } ?>
                    </select></td>
                    <td width="24" height="24"></td>
                    <td width="139" height="24"><input type="submit" value="Select" name="B1">
                    </td>
                </tr>          
                <script src="js/calendar.js"></script>                
                <!--Method call of calendar-->
                <script>
                $('.room').datePicker({
                	okFunc: function (date) {
                		console.log(date);
                	}
                });
                </script>
				
				</tbody>
			
              </table>


              </form>
          </div>
                </fieldset>
        <form action="<?php echo "$PHP_SELF?op=ftSel";?>" method="POST">
        <fieldset class="layui-elem-field" >
            <legend><b>Full Text Search</b></legend>
            <div class="layui-field-box">
                <table class="layui-table">
                    <tbody>

                    <div style="text-align: left">

                    <textarea name="ftSearchTerm" rows="5" cols="200"></textarea>
                        <input type="submit"  style="width:130px;height:30px value="Search">
                    </div>

                    </tbody>
                </table>
            </div>
        </fieldset>
        </form>




      <?php }  elseif ($page=="continue") {?>
	  	
     		 <form action="<?php echo $PHP_SELF;?>" method="GET">
      			<div style="text-align:center; color:#6495ED"> 
      				<input type="submit" value="              Continue                 " style =' height: 50px' >
      				<input type="hidden" name="op" value="sel">
      			</div>
      		</form>
      
      

      <?php } elseif ($page=="sel") {?>
      <!--  This is the tile of the list    -->
      		<div style="text-align:center"> 
      			<?php if (isset($ftSearch)&&$ftSearch=true){ ?>

						<b>This is a full text search query.  You searched for:</b?<br> <span style="font-size:10px;"><br><b style="font-size: 20px; font-weight: 700"><?php echo $ftSearchTerm;?></b>

				<?php }elseif ( isset($_SESSION['groupFilterIsSet'])&&$_SESSION['groupFilterIsSet']==1) {
			    		    
			     $groupInfo = getGroupInfo ($groupFilter);
			     ?>
						Group Filter Set:<br>
						<?php echo $groupInfo['name'];?><br>
						Admin: <?php echo $groupInfo['admin'];?> <br>
						Active Limit: <?php echo $groupInfo['limit']; ?><br>
						Total Ads: <?php echo $groupInfo['total']; ?><br>
						Total Active: <?php echo $groupInfo['active']; ?><br><br>
				<?php }?>    

      		</div>
      		
      		<fieldset class="layui-elem-field">
            <legend><b>Listing</b></legend>
              <div class="layui-field-box">
            	<form action="<?php echo "$PHP_SELF?op=select_and_do";?>" method="POST" enctype="application/x-www-form-urlencoded" name="moveform">
            	<table class="layui-table" style="border:4px solid ">  
            	   <tbody>
                     <tr>
                    
                      <td width="6%" height="28"  align="center" style="border:3px solid "><span
                                  style="color: #FFFFFF; font-family: Verdana; font-size: small; "><a href="<?php echo "$PHP_SELF?op=sel&sort=TYPEABV";?>">Type</a></span></td>
                      <td width="3%" height="28"  align="center" style="border:3px solid "><span
                                  style="color: #FFFFFF; font-family: Verdana; font-size: small; "><a href="<?php echo "$PHP_SELF?op=sel&sort=NOFEE";?>">Fee</a></span></td>
                      <td width="3%" height="28"  align="center" style="border:3px solid "><span
                                  style="color: #FFFFFF; font-family: Verdana; font-size: small; "><a href="<?php echo "$PHP_SELF?op=sel&sort=CID";?>">ID</a></span></td>
                      <td width="10%" height="28" align="center" style="border:3px solid "><span
                                  style="color: #FFFFFF; font-family: Verdana; font-size: small; "><a href="<?php echo "$PHP_SELF?op=sel&sort=LOC";?>">Location</a></span></td>
                      <td width="25%" height="28" align="center" style="border:3px solid "><span
                                  style="color: #FFFFFF; font-family: Verdana; font-size: small; "><a href="<?php echo "$PHP_SELF?op=sel&sort=CLI";?>">Client</a></span></td>
                   
                      <td width="8%" height="28"  align="center" style="border:3px solid "><span
                                  style="color: #FFFFFF; font-family: Verdana; font-size: small; "><a href="<?php echo "$PHP_SELF?op=sel&sort=DATEIN";?>">Created</a></span></td>
                      <td width="8%" height="28"  align="center" style="border:3px solid "><span
                                  style="color: #FFFFFF; font-family: Verdana; font-size: small; "><a href="<?php echo "$PHP_SELF?op=sel&sort=MOD";?>">Modified</a></span></td>
                      <td width="10%" height="28" align="center" style="border:3px solid "><span
                                  style="color: #FFFFFF; font-family: Verdana; font-size: small; "><a href="<?php echo "$PHP_SELF?op=sel&sort=PIC";?>">Photos</a></span></td>
                      <td width="9%" height="28"  align="center" style="border:3px solid "><span
                                  style="color: #FFFFFF; font-family: Verdana; font-size: small; "><a href="<?php echo "$PHP_SELF?op=sel&sort=HANDLE";?>">User</a></span></td>
                      <td width="9%" height="28"  align="right" style="border:3px solid "  >
                      <select name="sop" >
                      <option value="delete">Delete...</option>
                      <option value="deactivate" selected>Deactivate..</option>
                      <option value="activate">Activate...</option>
                      <option value="nofee">Make NO FEE</option>
                      <option value="fee">Negate NO FEE</option>
                      </select>
                        <input type="submit" value="   Operate   ">
                        <br>Select All:<input type="checkbox" name="allbox" value="sel_all" onClick="CheckAll();">
                       </td>
                   <?php while ($rowGetAds = mysqli_fetch_object($quGetAds)) { ?>

					<tr>
					
                       <td width="6%" height="26" >
                       <?php if ($rowGetAds->STATUS=="ACT") {
                        		echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetAds->CID'><img src='../assets/images/act.gif' width=20 height=18 border=0 alt='Deactivate' hspace=5></a>";
                        	}else {
                        		echo "<a href='$PHP_SELF?op=activate&cid=$rowGetAds->CID'><img src='../assets/images/inact.gif' width=20 height=18 border=0 alt='Activate' hspace=5></a>";
                        } ?>

<!--                        --><?php //echo $rowGetAds->TYPEABV; ?>

                       </td>
                        
                        <td width="3%" height="26"  style="text-align: center"><?php echo "$rowGetAds->NOFEE"; ?></td>
                        <td width="3%" height="26"   style="text-align: center"><?php echo "$rowGetAds->CID"; ?></td>
                        <td width="10%" height="26" style="text-align: center"><?php echo "$rowGetAds->LOCNAME"; ?></td>
                        <td width="25%" height="26" style="text-align: center"><?php echo "$rowGetAds->NAME";?></td>
                        <td width="8%" height="26" style="text-align: center"><?php echo (fuzDate($rowGetAds->DATEIN)); ?></td>
                        <td width="8%" height="26" style="text-align: center"><?php echo (fuzDate($rowGetAds->MOD)); ?></td>
                        <td width="10%" height="26"style="text-align: center" ><?php if ($rowGetAds->PIC) { echo "<a href='$PHP_SELF?op=managePics&cid=$rowGetAds->CID'>
                        <img src='../images/pic.gif' width=20 height=18 border=0 alt='Manage Pics' hspace=5></a><br>"; } ?><a href="<?php echo "$PHP_SELF?op=upload&cid=$rowGetAds->CID&abv=$rowGetAds->ABV";?>">Upload</a></td>
                        <td width="9%" height="26"  style="text-align: center"><?php echo $rowGetAds->HANDLE;?></td>
                        <td width="5%" height="26"style="text-align: center;border-right:4px solid" ><a href="<?php echo "$PHP_SELF?op=edit&cid=$rowGetAds->CID"; ?>" style="color: red;font-size: medium">Edit</a>
                       	<div align="right" >
                   		<input type="checkbox" name="sel_ids[]" value="<?php echo $rowGetAds->CID;?>" />        
                   		</div>
                        </td>                 
                     </tr>
                     <tr><td width="100%" bgcolor="#D3D3D3" colspan="13" height="2"></td>
                     </tr>
                     
                     <tr>	  
                        <td width="100%"  colspan="13"><font face="Verdana" size="2" color="#000000">
                        
                        <?php if (isset($ftSearch)) { echo format_ad_ft ($rowGetAds, $DEFINED_VALUE_SETS, $ftSearchTerm); } 
                        else { echo format_ad ($rowGetAds, $DEFINED_VALUE_SETS); }?></font></td>
                        
                     </tr>
                     
                    <?php }?>
                    
<!--                    <a href="--><?php //echo "$PHP_SELF?op=export";?><!--"><font color="#000000" face="Verdana" size="1">Export this view to CSV</a></font>-->
                   </tbody>  
                 </table>
                </form>

               </div>
            </fieldset>

      <?php } elseif ($page=="changePassword") { ?>
<!--BEGIN changePassword -->
<form action="<?php echo "$PHP_SELF?op=changePasswordDo"; ?>" method="POST">
<table style="width:320px;margin:40px auto;">
	<tr>
		<td>Old Password</td>
		<td><input style="border:3px solid;height:30px " type="password" size="30" name="oldPass" required></td>

	</tr>
	<tr>
		<td>New Password</td>
		<td><span ><input style="border:3px solid; height:30px " id="pass" class="input-style" size="30" maxlength="30" name="newPass" type="password" required/></span></td>
	</tr>
	<tr>    
		<th></th>       
		<td id="level" class="pw-strength">           	
			<div class="pw-bar"></div>
			<div class="pw-bar-on"></div>
			<div class="pw-txt">
			<span>Weak</span>
			<span>Medium</span>
			<span>Strong</span>
			</div>
		</td>	
	</tr>
	<tr>
	<td>Retype New Password</td>
	<td><input style="border:3px solid;height:30px " type="password" size="30" name="newPassConf"required></td>
	
	</tr>
	
</table>
<div style="text-align:center">
	<input  type="submit" value="Change">
</div>	
</form>
<!--End changePassword -->
<?php } 
elseif ($page=="select_and_delete") { ?>
<!--BEGIN select_and_delete -->
            <link href="css/deleteverification.css" rel="stylesheet" type="text/css"/>
            <script src="js/passwordjs/jquery-verification.min.js" type="text/javascript"></script>
            <script src="js/passwordjs/deleteverification.js" type="text/javascript"></script>
            <form action="<?php echo "$PHP_SELF?op=select_and_deleteDO";?>" method="POST">
        		<div style="text-align:center">
        			<font color="#000000" face="Verdana" size="5">
        			<a>Are you sure you want to delete these <?php echo $numIDs;?> ad(s)?</a></font>
        	
        				<?php foreach ($sel_ids as $sel_id) {?>
        					<input type="hidden" name="sel_ids[]" value="<?php echo $sel_id;?>">
        				<?php } ?>
	
        		</div> 
        		
        		   <center><div  id="drag"  ></div></center>
        		   
               			 <script type="text/javascript">
               				 $('#drag').drag();		             				 
                </script> 	
                
               <input id="s1" type="hidden" name="conf" value="" >        
              <center> <input type="submit" value="Submit form"> </center>
			</form>

<?php } elseif ($page=="delete") { ?>
        <!--BEGIN delete -->

        <font face="Verdana" size="1" color="#000000">
            <div style="text-align: center">
                <b>Created by :</b> <?php if(isset($rowGetAd)){echo "$rowGetAd->HANDLE";}?> <br>
                <b>Created On:</b> <?php if(isset($rowGetAd)){echo "$rowGetAd->DATEIN";}?> <br>
                <b>Last Modifed on :</b> <?php if(isset($rowGetAd)) {echo"$rowGetAd->MOD";}?><br>
                <b>Status :</b> <?php if (isset($rowGetAd)&&$rowGetAd->STATUS=="ACT") {
                    echo "Active";
                }else {
                    echo "Inactive";
                } ?>
                <br>
                <br>
<!--           <?php //echo format_ad($rowGetAd, $DEFINED_VALUE_SETS); ?> -->
            <form action="<?php echo "$PHP_SELF?op=deleteDo";?>" method="POST">
                <input type="hidden" name="cid" value="<?php echo $rowGetAd->CID;?>">
                Please type 'y' to confirm.

                <input type="text" name="conf" size="3">
                <br>
                <input type="submit" value="Delete Ad"></form>
            <br><a href="<?php echo "$PHP_SELF?op=home"; ?>">Cancel</a>


        <!--END delete -->

<!--END select_and_delete -->	
<?php }elseif ($page=="addGroup") { ?>
<!--BEGIN addGroup -->
		
		<form action="<?php echo "$PHP_SELF?op=addGroupDo";?>" method="POST">
		 <div style="margin-left:16cm">
        	
        	<table style="border-collapse:separate; border-spacing:3px;">        	
            	<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">Name:</td>
            		<td style="border:0px solid " width="20" height="31" "><input type="text" name="name" size="40" required></td>
            	</tr>
            	<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">Abrv:</td>
            		<td style="border:0px solid " width="20" height="31" "><input type="text" name="abv" size="40"></td>
            	</tr>
            	<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">Signature:</td>
            		<td style="border:0px solid " width="20" height="31" "><textarea cols="70" rows="5" name="sig"></textarea></td>
            	</tr>
            	<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">Phone:</td>
            		<td style="border:0px solid " width="20" height="31" "><input type="text" name="group_phone" size="40"></td>
            	</tr>
            	<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">Email:</td>
            		<td style="border:0px solid " width="20" height="31" "><input type="text" name="group_email" size="25"></td>
            		
            	</tr>
            	<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">URL:</td>
            		<td style="border:0px solid " width="20" height="31" "><input type="text" name="group_url" size="25"></td>
            		
            	</tr>
            	<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">HTML Header:</td>
            		<td style="border:0px solid " width="20" height="31" "><textarea cols="70" rows="5" name="HTML_HEADER"></textarea></td>
            	</tr>
            	<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">HTML Footer:</td>
            		<td style="border:0px solid " width="20" height="31" "><textarea cols="70" rows="5" name="HTML_FOOTER"></textarea></td>
            	</tr>
            	<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">TYPE1 HTML HEADER:</td>
            		<td style="border:0px solid " width="20" height="31" > <textarea cols="70" rows="5" name="TYPE1_HEAD"></textarea></td>

            	</tr>
            	<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">TYPE1 HTML FOOTER:</td>
            		<td style="border:0px solid " width="20" height="31" "><textarea name="TYPE1_FOOT" cols="70" rows="5"></textarea></td>
            		
            	</tr>
            	<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">TYPE2 HTML HEADER</td>
            		<td style="border:0px solid " width="20" height="31" "><textarea name="TYPE2_HEAD" cols="70" rows="5"></textarea></td>
            		
            	</tr>
            	<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">TYPE2 HTML FOOTER:</td>
            		<td style="border:0px solid " width="20" height="31" "> <textarea name="TYPE2_FOOT" cols="70" rows="5"></textarea></td>
            		
            	</tr>
            	<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">TYPE3 HTML HEADER:</td>
            		<td style="border:0px solid " width="20" height="31" "><textarea name="TYPE3_HEAD" cols="70" rows="5"></textarea></td>
            		
            	</tr>
            	<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">TYPE3 HTML FOOTER:</td>
            		<td style="border:0px solid " width="20" height="31" "> <textarea name="TYPE3_FOOT" cols="70" rows="5"></textarea></td>
            		
            	</tr>
            		<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">TYPE4 HTML HEADER:</td>
            		<td style="border:0px solid " width="20" height="31" "><textarea name="TYPE4_HEAD" cols="70" rows="5"></textarea></td>
            		
            	</tr>
            	
            		<tr>
            		<td style="border:0px solid " width="20" height="31" align="left">TYPE4 HTML FOOTER:</td>
            		<td style="border:0px solid " width="20" height="31" "> <textarea name="TYPE4_FOOT" cols="70" rows="5"></textarea></td>
            		
            	</tr>
            	<tr>
            	     <td style="border:0px solid " width="20" height="31" align="left">Ad Limit:</td>
            		<td style="border:0px solid " width="20" height="31"><input type="text" name="maxAct" size="5" required></td>
            	</tr>
            	   	
            	 <tr>
            	   <td style="border:0px solid " width="20" height="31" align="left">Ad Limit:</td>
            		<td  width="20" height="31" "> <input type="text" name="level" size="1" required></td>
            	</tr>
           </table>   
           </div>
           <div style="margin-left: 16cm">
        	<input type="submit" value="Save" style="width: 18cm;height:1cm;">
        </div>
		</form>
<!--END addGroup -->
<?php }
elseif ($page=="createAdmin") { ?>
<!--BEGIN createAdmin -->
	<form action="<?php echo "$PHP_SELF?op=createAdminDo";?>" method="POST">
	 <input type="hidden" name="newGrid" value="<?php echo  $_SESSION['newGrid'] ?>">
        <div style="text-align: center;">
        <a style="font-size:30PX">Please Create and Admin User:</a> <br><br><br>
        </div>
            <div style="margin-left:16.5cm">
                <table style="border-collapse:separate; border-spacing:3px;">
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">UserName:</td>
                        <td style="border:0px solid " width="20" height="31" "><input type="text" name="crHandle" size="40" required></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Password:</td>
                        <td style="border:0px solid " width="20" height="31" "><input type="text" name="crPass" size="40" required></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Email:</td>
                        <td style="border:0px solid " width="20" height="31" "><input type="text" name="email" size="40" required></td>
                    </tr>
                </table>
                <br>
			<input style="width: 11.5cm" type="submit" value="Save">
		</div>
	</form>


<!--End createAdmin -->
<?php } ?>


<!--END sel -->
<?php if ($page=="manageGroups") { ?>

    <!--BEGIN manageGroups -->.
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="width:40%;text-align: center">
                <a href="./pwSync.php">
                    <button>Sync Users table and Password file (HTACCESS)</button>
                </a></td>

            <td style="width:40%;text-align: center"
            ">
            <a style="text-align: center" href="./userList.php">
                <button>Username & password list.</button>
            </a>

            </td>

            <td style="width:40%;text-align: center"
            ">
            <a href="./lastlogin.php">
                <button>Lastlogin</button>
            </a>
            </td>
        </tr>

    </table>
    <tr><br></tr>
<table  width="100%">
    <tr>
        <td style="width:5%; heigh:26; text-align:center;background-color: #01AAED">&nbsp;</td>
        <td style="width:20%; heigh:26; text-align:center;background-color: #01AAED"><a style="color: #000000;"
                                                                        href="<?php echo "$PHP_SELF?op=manageGroups&sort=GRID"; ?>">ID</a>
        </td>
        <td style="width:50%; heigh:26; text-align:center;background-color: #01AAED"><a style="color: #000000;"
                                                                        href="<?php echo "$PHP_SELF?op=manageGroups&sort=NAME"; ?>">Name</a>
        </td>
        <td style="width:20%; heigh:26; text-align:center;background-color: #01AAED"><a style="color: #000000;"
                                                                        href="<?php echo "$PHP_SELF?op=manageGroups&sort=MAXACT"; ?>">MaxAct</a>
        </td>
        <td style="width:5%; heigh:26; text-align:center;background-color: #01AAED">&nbsp;</td>
    </tr>
</table>

 <table width="100%">
    <?php while ($rowGetGroups = mysqli_fetch_object($quGetGroups)) { ?>

        <tr>
            <td style="width:5%; heigh:26; text-align:center" nowrap></td>
            <td style="width:20%; heigh:26; text-align:center" nowrap><a
                        href="/lacms/admin2/agency_edit.php?agency_id=<?php echo $rowGetGroups->GRID; ?>"><?php echo "$rowGetGroups->GRID"; ?></A>
            </td>

            <td style="width:50%; heigh:26; text-align:center;background-color: #9d9c99" nowrap><a
                        href="<?php echo "$PHP_SELF?op=editGroup&getGRID=$rowGetGroups->GRID"; ?>"><?php echo "$rowGetGroups->NAME"; ?></A>
            </td>
            <td style="width:20%; heigh:26; text-align:center" nowrap><?php echo "$rowGetGroups->MAXACT"; ?></font></td>
            <td width="4%" height="26" nowrap bgcolor="#D3D3D3"><a
                        href="<?php echo "$PHP_SELF?op=editGroup&getGRID=$rowGetGroups->GRID"; ?>">edit</a></td>
        </tr>


    <?php }
}
elseif ($page=="manPub") { ?>
        <div style="text-align: center ">

                <a style="color: #eb7350;font-size: x-large">Publish only these types of files:</a>

                <form action="./dump.php" method="GET">
                  <a style="color: burlywood;font-size: large">  Index pages and location=specific pages.</a> <input style="zoom:150%;" type="checkbox" name="il" value="1"><br>
                  <a style="color: burlywood;font-size: large">  Type one (i.e. class1.htm) pages.</a> <input style="zoom:150%;" type="checkbox" name="o" value="1"><br>
                  <a style="color: burlywood;font-size: large">  Type two (i.e. class2.htm) pages. </a><input style="zoom:150%;" type="checkbox" name="t" value="1"><br><br>

                    <input style="width:100px;zoom:150%;" type="submit" value="Publish">
                </form>


    </div>



<!--END manageUsers -->
<?php } elseif ($page=="DTIn") { ?>
    <!--BEGIN DTIn -->
    <form action="<?php echo "$PHP_SELF?op=DTInDo";?>" method="POST">
        <div style="text-align: left; margin-left: 19cm">
            <a style="font-weight:bold;font-size: large" >File to Insert:</a><input type="text" name="filename" size="15" value="./dt/input.txt"><br><br>
            <a style="font-weight:bold;font-size: large" > Charactor to delimit:</a> <input type="text" size="3" name="dChr" value="``"><br><br>
            <a style="font-weight:bold;font-size: large" > Group to insert into:</a><select size="1" name="groupID"><br>
                <?php while ($rowGroups = mysqli_fetch_object ($quGroups)) { ?>

                    <option value="<?php echo $rowGroups->GRID; ?>" > <?php echo $rowGroups->NAME; ?> </option>

                <?php } ?>
            </select><br><br>

                  <a style="font-weight:bold;font-size: large" >Type:</a>  <select name="type">
                        <?php while ($rowTypes=mysqli_fetch_object($quTypes)) {?>

                            <option value="<?php echo $rowTypes->TYPE;?>"><?php echo $rowTypes->TYPENAME; ?></option>

                        <?php }?></select>

                    <br><br>
                    <input type="submit" value="Execute"></form>

            <?php if ($fin=true) {
                $myLogDone = fopen ("./DTInLog.txt", 'r');
                $logOutput = fread ($myLogDone, 100000);
//                echo "<pre>$logOutput</pre>";
            } ?>

        </div>

    <!--END DTIn -->
<?php }




elseif ($page=="managePics") { ?>
<!--BEGIN managePics -->

		<div style="text-align: center"> Manage Pictures for <a href="<?php echo "$PHP_SELF?op=edit&cid=$cid";?>"> Ad# <?php echo "$cid";?></a></div>
		<span style="font-size:10px;font-family:Verdana;color:black;"><a href="<?php echo "$PHP_SELF?op=upload&cid=$cid";?>">Upload new picture</a> | <a href="https://www.BostonApartments.com/hompage.php?ad=<?php echo $cid;?>">View Homepage.php output</a><br></span>

		<table border="0" cellpadding="2" cellspacing="0" width="100%">
	    	<tr>
	      <td width="3%" height="28" bgcolor="#45659A">&nbsp;</td>
	      <td width="14%" height="28" bgcolor="#45659A" align="center"><a href="<?php echo "$PHP_SELF?op=managePics&cid=$cid&sort=PID";?>">ID</a></td>
	      <td width="15%" height="28" bgcolor="#45659A" align="center"><a href="<?php echo "$PHP_SELF?op=managePics&cid=$cid&sort=DESCRIPT";?>">Description</a></td>
	      <td width="4%" height="28" bgcolor="#45659A" align="center">&nbsp;</td>
	       <td width="4%" height="28" bgcolor="#45659A" align="center">&nbsp;</td>
	      </tr>
    <?php while ($rowGetPics = mysqli_fetch_object($quGetPics)) { ?>
    		<tr>
    		  <td width="3%" height="26" nowrap nowrap bgcolor="#D3D3D3"> <a href="<?php echo "$PHP_SELF?op=editPic&pid=$rowGetPics->PID&cid=$cid"; ?>"><img src='../images/pic.gif' width=20 height=18 border=0 hspace=5></a></td>
    		  <td width="3%" height="26" nowrap><?php echo "$cid:p$rowGetPics->PID"; ?>&nbsp;</td>
    		  <td width="4%" height="26" nowrap bgcolor="#D3D3D3"><?php echo $rowGetPics->DESCRIPT; ?>&nbsp;</td>
    		  <td width="4%" height="26"><a href="<?php echo "$PHP_SELF?op=editPic&pid=$rowGetPics->PID&cid=$cid"; ?>">edit</a></a></td>
    		  <td width="4%" height="26" nowrap bgcolor="#D3D3D3"><a href="<?php echo "$PHP_SELF?op=deletePic&pid=$rowGetPics->PID&cid=$cid"; ?>">delete</a></td>
    		  </tr>
    <?php } ?>

  		</table>

<!--END managePics -->
<?php }

elseif ($page=="edit") {?>
<!--BEGIN edit -->
    <div style="text-align: center">
            <b>Created by :</b> <?php if(isset($rowGetAd)){echo "$rowGetAd->HANDLE";}?> <br>
            <b>Created On:</b> <?php if(isset($rowGetAd)){echo "$rowGetAd->DATEIN";}?> <br>
            <b>Last Modifed on :</b> <?php if(isset($rowGetAd)) {echo"$rowGetAd->MOD";}?><br>
            <b>Status :</b> <?php if (isset($rowGetAd)&&$rowGetAd->STATUS=="ACT") {
                        echo "Active";
                    }else {
                        echo "Inactive";
                    } ?>
        <br>
        <br>
    </div>

    <form action="<?php echo "$PHP_SELF?op=editDo";?>" method="POST">
        <div style="margin-left:600px">
        <b>Group:</b>
		<input type="hidden" name="nofee" value="0">
		<input type="hidden" name="cid" value="<?php echo $rowGetAd->CID;?>">
		<select name="ggrid">
		<?php while ($rowGroups = mysqli_fetch_object($quGroups)) {?>
			<option value="<?php if(isset($rowGroups))echo $rowGroups->GRID; ?>" <?php if (isset($rowGetAd)&&$rowGetAd->CLI==$rowGroups->GRID) { echo "selected"; } ?> ><?php echo $rowGroups->NAME;?></option>
		<?php } ?>
		</select><br><br>
            <b>Type:</b>
		<select name="type">
        	<?php while ($rowTypes=mysqli_fetch_object($quTypes)) {	?>
		<option value="<?php if(isset($rowTypes)){echo $rowTypes->TYPE;}?>" <?php if (isset($rowGetAd)&&$rowGetAd->TYPE==$rowTypes->TYPE) {
																echo " selected"; }?> >
																<?php echo $rowTypes->TYPENAME; ?>
																</option>
	<?php }	?>
		</select><br><br>
            <b>Location</b>
		<select name='loc'>
		<?php while ($rowFavLocs = mysqli_fetch_object($quFavLocs)) { ?>
		<option value="<?php echo $rowFavLocs->LOCID;?>" <?php if (isset($rowGetAd)&&$rowGetAd->LOC==$rowFavLocs->LOCID) {echo " selected";  }?>><?php echo $rowFavLocs->LOCNAME;?></option>
		<?php } ?>
		<option value="0">--------------------</option>
		<?php while ($rowLocs = mysqli_fetch_object($quLocs)) {	?>
		<option value="<?php echo $rowLocs->LOCID; ?>" <?php if (isset($rowGetAd)&&$rowGetAd->LOC==$rowLocs->LOCID && $locSeled == false) {echo " selected"; }?> >
		<?php echo $rowLocs->LOCNAME; ?></option>
		<?php }	?>
		</select><br><br>
        <b>Title:</b> <textarea name="ad_title" cols=50 rows="1" ><?php if(isset($rowGetAd)){echo $rowGetAd->AD_TITLE;}?></textarea></nobr><BR>
        <b></b><br>
		<textarea name="body" cols=70 rows=10 ><?php if(isset($rowGetAd)){echo $rowGetAd->BODY;}?></textarea><br>
		<br>

        <b>Number of Bedrooms:</b> <select name="rooms">
	    <option value="--">--</option>
	    <?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $key => $roomsValue) { ?><?php
		$selected = ($rowGetAd->ROOMS==$key) ? " selected " : "";
		?>
		<option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $roomsValue;?></option>
	<?php } ?>	
	</select><br><br>
        <b>Number of Bathrooms: </b><select name="bath">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bkey => $bathValue) { ?>
		<?php 
		$selected = ($rowGetAd->BATH==$bkey) ? " selected " : "";
		?>
		<option value="<?php echo $bkey;?>" <?php echo $selected;?>><?php echo $bathValue;?></option>
	<?php } ?>	
	</select><br><br>

	<?php
    if(isset($rowGetAd)) {
        $getMon = subStr($rowGetAd->AVAIL, 5, 2);
        $getDay = subStr($rowGetAd->AVAIL, 8, 2);
        $getYear = subStr($rowGetAd->AVAIL, 0, 4);
    }
	?>
        <b>Available: Month</b> <select name="aMonth">
	<option value="--">--</option>
	<option value="01" <?php if (isset($getMon)&&$getMon == "01") { echo " selected "; } ?>>Jan</option>
	<option value="02" <?php if (isset($getMon)&&$getMon == "02") { echo " selected "; } ?>>Feb</option>
	<option value="03" <?php if (isset($getMon)&&$getMon == "03") { echo " selected "; } ?>>Mar</option>
	<option value="04" <?php if (isset($getMon)&&$getMon == "04") { echo " selected "; } ?>>Apr</option>
	<option value="05" <?php if (isset($getMon)&&$getMon == "05") { echo " selected "; } ?>>May</option>
	<option value="06" <?php if (isset($getMon)&&$getMon == "06") { echo " selected "; } ?>>Jun</option>
	<option value="07" <?php if (isset($getMon)&&$getMon == "07") { echo " selected "; } ?>>Jul</option>
	<option value="08" <?php if (isset($getMon)&&$getMon == "08") { echo " selected "; } ?>>Aug</option>
	<option value="09" <?php if (isset($getMon)&&$getMon == "09") { echo " selected "; } ?>>Sep</option>
	<option value="10" <?php if (isset($getMon)&&$getMon == "10") { echo " selected "; } ?>>Oct</option>
	<option value="11" <?php if (isset($getMon)&&$getMon == "11") { echo " selected "; } ?>>Nov</option>
	<option value="12" <?php if (isset($getMon)&&$getMon == "12") { echo " selected "; } ?>>Dec</option>
	</select> Day <select name="aDay"> 
	<option value="--">--</option>
	<?php for ($i=1;$i<=31;$i++) {
		if ($i<=9) {
			$j = "0".$i;
		} else {
			$j = $i;
		}
	?>
	<option value="<?php echo $j;?>" <?php if (isset($getDay)&&$getDay == $j) { echo " selected "; } ?>><?php echo $j;?></option>
	<?php } ?>
	</select> Year <select name="aYear">
	<option value="--">--</option>
	<?php 
	$thisYear = date ("Y") - 1;
	for ($i=0;$i<=4;$i++) {?>
	<option value="<?php echo ($thisYear + $i);?>" <?php if (isset($getYear)&&$getYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
	<?php }?>
	</select> <br><br>
        <b>for Price:</b><b>$</b><input type="text" name="price" size="8" value="<?php echo $rowGetAd->PRICE;?>">Do <b>NOT</b> include cents.<br><br>
		<b>FEE STATUS:</b><br><br>
			<select name="nofee">
			<option value="--">--</option>
			<?php foreach ($DEFINED_VALUE_SETS['NOFEE'] as $nfkey => $nfValue) {
							$selected = ($rowGetAd->NOFEE==$nfkey) ? " selected " : ""; ?>
							<option value="<?php echo $nfkey;?>" <?php echo $selected;?>><?php echo $nfValue;?></option>
			<?php } ?>
            </select>

        <BR><br></P>
<P>

<a>Display Personal Signature? No</a><input type="radio" name="use_user_sig" value="0" checked > &nbsp;
    <a>Yes</a><input type="radio" name="use_user_sig" value="1" <?php if (isset($rowGetAd)&&$rowGetAd->USE_USER_SIG) {echo " checked "; } ?>><br>
    <a>Do you have pictures for this ad?</a><input type="checkbox" name="upload" value="1"><br>
		<input type="submit" value="Save"><hr>
		<hr>
        </div>
<!--		Landlord:<select name="landlord">-->
<!--		<option value="--">--</option>-->
<!--		--><?php //while ($rowGetLandlord = mysqli_fetch_object($dbh,$quLandlord)) { ?>
<!--		<option value="--><?php //echo $rowGetLandlord->LID; ?><!--" --><?php //if ($rowGetAd->LANDLORD==$rowGetLandlord->LID) { echo " selected "; } ?><!-->--><?php //echo $rowGetLandlord->SHORT_NAME;?><!--</option>-->
<!--		--><?php //} ?>
<!--		</select><br>-->
<!--		Address: Street<input type="text" name="street" size="14" value="--><?php //echo $rowGetAd->STREET;?><!--"> Apt<input type="text" name="apt" size="4" value="--><?php //echo $rowGetAd->APT;?><!--"><br>-->
<!--		City<input type="text" name="city" size="12" value="--><?php //echo $rowGetAd->CITY;?><!--"> State<input type="text" name="state" size="3" value="--><?php //echo $rowGetAd->STATE;?><!--"> Zip<input type="text" name="zip" size="5" value="--><?php //echo $rowGetAd->ZIP;?><!--"><br>-->
<!--		<font face="Verdana" size="1" color="#000000">Special Order:<input type="text" size="5" name="sporder" value="--><?php //echo $rowGetAd->SPORDER;?><!--"><br>-->
<!--		<font face="Verdana" size="1" color="#000000">AltSig:<textarea name="altSig" cols=70 rows=4>--><?php //echo $rowGetAd->ALTSIG;?><!--</textarea>-->
<!--		<font face="Verdana" size="1" color="#000000">Payment:  <input type="checkbox" name="PAYMENT_REC" value="1" --><?php //if ($rowGetAd->PAYMENT_REC) { echo "checked"; }?><!-- ><br>-->
  </form>
		</div>
<!--END edit -->
<?php  } elseif ($page=="compose") { ?>
<!-- BEGIN compose -->
        <form name="adlEditForm" action="<?php echo "$PHP_SELF?op=add";?>" method="POST">
		<input type="hidden" name="nofee" value="0">
		<input type="hidden" name="cid" value="<?php echo $rowGetAd->CID;?>">
		<select name="ggrid">
		<?php while ($rowGroups = mysqli_fetch_object($quGroups)) {?>
			<option value="<?php echo $rowGroups->GRID; ?>" <?php
						if (isset($groupFilter)) {
							if ($groupFilter == $rowGroups->GRID) {
								echo " selected ";
							}
						}else {
							if ($rowGroups->GRID==1) {
								echo " selected ";
							}
						}
						 ?>><?php echo $rowGroups->NAME;?></option>
		<?php } ?>
		</select><br>

		<select name="type">
	    <?php while ($rowTypes=mysqli_fetch_object($quTypes)) {	?>
		<option value="<?php echo $rowTypes->TYPE;?>" <?php
        if(isset($rowGetAd))
        {
        if ($rowGetAd->TYPE==$rowTypes->TYPE) {
																echo " selected"; }}?> >
																<?php echo $rowTypes->TYPENAME; ?>
																</option>
	<?php }	?>
		</select><br>
		<select name='loc'>
	<?php while ($rowFavLocs = mysqli_fetch_object($quFavLocs)) { ?>
		<option value="<?php echo $rowFavLocs->LOCID;?>" <?php
        if(isset($rowGetAd))
        {
        if ($rowGetAd->LOC==$rowFavLocs->LOCID) {echo " selected"; $locSeled = ture; }?>><?php echo $rowFavLocs->LOCNAME;?></option>
		<?php } }?>
		<option value="0">--------------------</option>
		<?php while ($rowLocs = mysqli_fetch_object($quLocs)) {	?>

		<option value="<?php echo $rowLocs->LOCID; ?>" <?php
        if(isset($rowGetAd)){
        if ($rowGetAd->LOC==$rowLocs->LOCID && $locSeled == false) {echo " selected"; }}?> >
		<?php echo $rowLocs->LOCNAME; ?></option>
		<?php }	?>
		</select><br>
            <a>Title:</a> <textarea name="ad_title" cols="50" rows="1">
                <?php
                if(isset($rowGetAd)){
                echo $rowGetAd->AD_TITLE;}?></textarea><br>

            <textarea name="body" cols="70" rows="10" ><?php
                if(isset($rowGetAd)){
                     echo $rowGetAd->BODY;}?></textarea><br>
             <input type="button" value="Check Spelling" onClick="openSpellChecker();"/>
		    <br>



            <a>umber of Bedrooms:</a> <select name="rooms">
	        <option value="--">--</option>
	        <?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $key => $roomsValue) { ?>
		    <?php
		    $selected = ($rowGetAd->ROOMS==$key) ? " selected " : "";
		    ?>
		    <option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $roomsValue;?></option>
	        <?php } ?>
    	</select><br><br>

    <a>Number of Bathrooms:</a> <select name="bath">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bkey => $bathValue) { ?>
		<?php 
		$selected = ($rowGetAd->BATH==$bkey) ? " selected " : "";
		?>
		<option value="<?php echo $bkey;?>" <?php echo $selected;?>><?php echo $bathValue;?></option>
	<?php } ?>	
	</select><br>
	<?php
    if(isset($rowGetAd)) {
        $getMon = subStr($rowGetAd->AVAIL, 5, 2);
        $getDay = subStr($rowGetAd->AVAIL, 8, 2);
        $getYear = subStr($rowGetAd->AVAIL, 0, 4);
    }
	?>
            <a>Available: Month</a> <select name="aMonth">
            <option value="--">--</option>
            <option value="01" <?php if (isset($getMon)&&$getMon == "01") { echo " selected "; } ?>>Jan</option>
            <option value="02" <?php if (isset($getMon)&&$getMon == "02") { echo " selected "; } ?>>Feb</option>
            <option value="03" <?php if (isset($getMon)&&$getMon == "03") { echo " selected "; } ?>>Mar</option>
            <option value="04" <?php if (isset($getMon)&&$getMon == "04") { echo " selected "; } ?>>Apr</option>
            <option value="05" <?php if (isset($getMon)&&$getMon == "05") { echo " selected "; } ?>>May</option>
            <option value="06" <?php if (isset($getMon)&&$getMon == "06") { echo " selected "; } ?>>Jun</option>
            <option value="07" <?php if (isset($getMon)&&$getMon == "07") { echo " selected "; } ?>>Jul</option>
            <option value="08" <?php if (isset($getMon)&&$getMon == "08") { echo " selected "; } ?>>Aug</option>
            <option value="09" <?php if (isset($getMon)&&$getMon == "09") { echo " selected "; } ?>>Sep</option>
            <option value="10" <?php if (isset($getMon)&&$getMon == "10") { echo " selected "; } ?>>Oct</option>
            <option value="11" <?php if (isset($getMon)&&$getMon == "11") { echo " selected "; } ?>>Nov</option>
            <option value="12" <?php if (isset($getMon)&&$getMon == "12") { echo " selected "; } ?>>Dec</option>
            </select> Day <select name="aDay">
            <option value="--">--</option>
	<?php for ($i=1;$i<=31;$i++) {
		if ($i<=9) {
			$j = "0".$i;
		} else {
			$j = $i;
		}
	?>
	<option value="<?php echo $j;?>" <?php if ( isset($getDay)&&$getDay == $j) { echo " selected "; } ?>><?php echo $j;?></option>
	<?php } ?>
	</select> Year <select name="aYear">
	<option value="--">--</option>
	<?php 
	$thisYear = date ("Y");
	for ($i=0;$i<=4;$i++) {?>
	<option value="<?php echo ($thisYear + $i);?>" <?php if (isset($getYear)&&$getYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
	<?php }?>
	</select> for 
            <a>Price:</a><b>$</b><input type="text" name="price" size="8" value="<?php if(isset($rowGetAd)){echo$rowGetAd->PRICE;}?>">Do <b>NOT</b> include cents.<br>
		
        <b>FEE STATUS:</b>
			<select name="nofee">
			<option value="--">--</option>
			<?php foreach ($DEFINED_VALUE_SETS['NOFEE'] as $nfkey => $nfValue) {
							$selected = ($rowGetListing->NOFEE==$nfkey) ? " selected " : ""; ?>
							<option value="<?php echo $nfkey;?>" <?php echo $selected;?>><?php echo $nfValue;?></option>
			<?php } ?>

                <b>Display Personal Signature? No</b><input type="radio" name="use_user_sig" value="0" checked > &nbsp;
                <b>Yes</b><input type="radio" name="use_user_sig" value="1" <?php if (isset($rowGetAd->USE_USER_SIG)) {echo " checked "; } ?>><br>

                <a>Do you have pictures for this ad?</a><input type="checkbox" name="upload" value="1"><br>
		<input type="submit" value="Save"><hr>
		<hr>
                <b>Landlord:</b><select name="landlord">
		<option value="--">--</option>
		<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
		<option value="<?php echo $rowGetLandlord->LID; ?>" <?php if ($rowGetAd->LANDLORD==$rowGetLandlord->LID) { echo " selected "; } ?>><?php echo $rowGetLandlord->SHORT_NAME;?></option>
		<?php } ?>
		</select><br>
		Address: Street<input type="text" name="street" size="14" value="<?php echo $rowGetAd->STREET;?>"> Apt<input type="text" name="apt" size="4" value="<?php echo $rowGetAd->APT;?>"><br>
		City<input type="text" name="city" size="12" value="<?php echo $rowGetAd->CITY;?>"> State<input type="text" name="state" size="3" value="<?php echo $rowGetAd->STATE;?>"> Zip<input type="text" name="zip" size="5" value="<?php echo $rowGetAd->ZIP;?>"><br>
		<font face="Verdana" size="1" color="#000000">Special Order:<input type="text" size="5" name="sporder"><br>
		<font face="Verdana" size="1" color="#000000">AltSig:<textarea name="altSig" cols=70 rows=4><?php echo $rowGetAd->ALTSIG;?></textarea>
		</form>

<?php } elseif ($page=="newpassword") { ?>

    </>
  </div>
<!--END compose -->
<!--    Upload pictures-->
<?php } elseif ($page=="upload") { ?>
<!--BEGIN upload -->
<!-- still not work-->

		<form enctype="multipart/form-data" action="<?php echo "$PHP_SELF?op=uploadDo";?>" method="POST">
            <div style="text-align: center">
                <b> upload picture for ad ref# <?php echo "$cid"; ?>. </b> <br><br>
                <input type="hidden" name="MAX_FILE_SIZE" value="300000">
                Send this file: <input name="userfile" type="file"><br><br>
                Description: <input type="text" name="desc" size="40">
                <input type="hidden" name="cid" value="<?php echo $cid; ?>">
                <input type="submit" value="Send File">
            </div>
		</form>


<!-- END upload -->
<?php } elseif ($page=="editPic") { ?>
<!--BEGIN editPic -->
		<center>
		<a href="https://www.BostonApartments.com/hompage.php?ad=<?php echo $cid;?>">View Homepage.php output</a><br>
		<img src="https://www.BostonApartments.com/pics/<?php echo "$pid.$rowGetPic->EXT"; ?>"><br>
		<form action="<?php echo "$PHP_SELF?op=editPicDo"; ?>" method="POST">
		<input type="hidden" name="pid" value="<?php echo $pid;?>">
		<input type="hidden" name="cid" value="<?php echo $cid;?>">
		<input type="text" size="40" name="desc" value="<?php echo $rowGetPic->DESCRIPT; ?>"><br>
		<font face="Verdana" size="1" color="#000000">Would you like to upload another?:<input type="checkbox" name="another" value="1">
		<input type="submit" value="Save">
		</form></center>

<!--END editPic -->
<?php } elseif ($page=="deletePic") { ?>
<!--BEGIN editPic -->
		<font face="Verdana" size="1" color="#000000">
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
<?php } elseif ($page=="addUser") { ?>
<!--BEGIN addUser -->
		<font face="Verdana" size="1" color="#000000">
		<center>
		<form action="<?php echo "$PHP_SELF?op=addUserDo"; ?>" method="POST">
		Username:<input type="text" size="10" name="crHandle"><br>
		Password:<input type="password" size="10" name="pass"><br>
		Retype Password:<input type="password" size="10" name="rpass"><br>
		Email:<input type="text" size="40" name="newEmail"><br>
		<input type="submit" value="Add User"></form>

<!--END addUser -->
<?php } elseif ($page=="editGroup") { ?>
<!--BEGIN editGroup -->
		<form action="<?php echo "$PHP_SELF?op=editGroupDo"; ?>" method="POST">
		<input type="hidden" name="getGRID" value="<?php echo $getGRID;?>">
            <div style="margin-left: 16cm">

                <table style="border-collapse:separate; border-spacing:3px;">
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Name:</td>
                        <td style="border:0px solid " width="20" height="31" "><input type="text" size="20" name="name" value="<?php echo $rowGetGroup->NAME;?>"></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Abrevation:</td>
                        <td style="border:0px solid " width="20" height="31" "> <input type="text" size="20" name="abv" value="<?php echo $rowGetGroup->ABV;?>"></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Maximum Ads:</td>
                        <td style="border:0px solid " width="20" height="31" "><input type="text" size="3" name="maxact" value="<?php echo $rowGetGroup->MAXACT;?>"></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Signature:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="sig" cols="60" rows="3"><?php echo $rowGetGroup->SIG;?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Phone:</td>
                        <td style="border:0px solid " width="20" height="31" "><input type="text" name="group_phone" size="25" value="<?php echo $rowGetGroup->GROUP_PHONE;?>"></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Email:</td>
                        <td style="border:0px solid " width="20" height="31" "><input type="text" name="group_email" size="25" value="<?php echo $rowGetGroup->GROUP_EMAIL;?>"></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">URL:</td>
                        <td style="border:0px solid " width="20" height="31" "> <input type="text" name="group_url" size="25" value="<?php echo $rowGetGroup->GROUP_URL;?>"></td>
                    </tr>

                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">DEFAULT HTML HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="HTML_HEADER" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->HEAD);?></textarea></td>
                    </tr>


                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">DEFAULT HTML FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="HTML_FOOTER" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->FOOT);?></textarea></td>
                    </tr>

                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Rentals: TYPE1 HTML HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE2_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE1_HEAD);?></textarea></td>
                    </tr>

                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Rentals: TYPE1 HTML FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE1_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE1_FOOT);?></textarea></td>
                    </tr>

                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Sales - Res. TYPE2 HTML HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE2_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE2_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Sales - Res. TYPE2 HTML FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE2_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE2_FOOT);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Comm Sales TYPE3 HTML HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE3_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE3_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">	Comm Sales TYPE3 HTML FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE3_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE3_FOOT);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Comm Rentals TYPE4 HTML HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE4_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE4_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Comm Rentals TYPE4 HTML FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE4_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE4_FOOT);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Parking Rentals TYPE5 HTML HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE5_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE5_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Parking Rentals TYPE5 HTML FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE5_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE5_FOOT);?></textarea></td>
                    </tr>

                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Parking Sales TYPE6 HTML HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE6_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE6_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Parking Sales TYPE6 HTML FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE6_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE6_FOOT);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Parking Wanted TYPE7 HTML HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE7_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE7_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Parking Wanted TYPE7 HTML FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE7_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE7_FOOT);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Vacation Rentals TYPE8 HTML HEADER :</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE8_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE8_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Vacation Rentals TYPE8 HTML FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE8_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE8_FOOT);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Rent-To-Own TYPE9 HTML HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="HTML_HEADER" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE9_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Rent-To-Own TYPE9 HTML FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE9_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE9_FOOT);?></textarea></td>
                    </tr>

                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Business Opportunities TYPE10 HTML HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE10_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE10_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Business Opportunities TYPE10 HTML FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE10_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE10_FOOT);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Senior Living Rentals TYPE11 HTML HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE11_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE11_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Senior Living Rentals TYPE11 HTML FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE11_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE11_FOOT);?></textarea></td>
                    </tr>

                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Senior Living Sales TYPE12 HTML HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE12_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE12_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Senior Living Sales TYPE12 HTML FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE12_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE12_FOOT);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Bank Owned TYPE13 HTML HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE13_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE13_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">Bank Owned TYPE13 HTML FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="TYPE13_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->TYPE13_FOOT);?></textarea></td>
                    </tr>

                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">MEET AGENTS HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="MEETAGENTS_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->MEETAGENTS_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">MEET AGENTS FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="MEETAGENTS_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->MEETAGENTS_FOOT);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">HOMEPAGE HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="HOMEPAGE_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->HOMEPAGE_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">HOMEPAGE FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="HOMEPAGE_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->HOMEPAGE_FOOT);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">	CO-BROKE HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="COBROKE_HEAD" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->COBROKE_HEAD);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">CO-BROKE FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="COBROKE_FOOT" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->COBROKE_FOOT);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">	EMAIL HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="EMAIL_HEADER" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->EMAIL_HEADER);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">EMAIL FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="EMAIL_FOOTER" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->EMAIL_FOOTER);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">	CL HEADER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="CL_HEADER" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->CL_HEADER);?></textarea></td>
                    </tr>
                    <tr>
                        <td style="border:0px solid " width="20" height="31" align="left">CL FOOTER:</td>
                        <td style="border:0px solid " width="20" height="31" "><textarea name="CL_FOOTER" cols="60" rows="3"><?php echo htmlspecialchars($rowGetGroup->CL_FOOTER);?></textarea></td>
                    </tr>

                </table>
            <b>--------------------------------------------------------------------------------------------------------</b>
            <TABLE><TR></TR><TD style="width: 4cm">
            Level : <input type="text" name="level" size="3" value="<?php echo $rowGetGroup->LEVEL;?>"><br>
            </TD>
            <TD style="width: 3cm">&nbsp;  </TD>
                    <TD style="width: 4cm">
            Agencies: <input type="text" name="AGENCIES" size="3" value="<?php echo $rowGetGroup->AGENCIES;?>"></FONT>
            </TD><TD style="width: 3cm">&nbsp;</TD>
            <TD style="width: 4cm">
            Group ID: <?php echo $rowGetGroup->GRID;?></FONT>
            </TD></TR></TABLE>
            <BR>

<table style="border-collapse:separate; border-spacing:3px;">
    <TR><TD VALIGN="LEFT">Reg Code:</TD>
        <TD VALIGN="LEFT"><input type="text" name="REGKEY" size="30" value="<?php echo $rowGetGroup->REGKEY;?>"></TD>
    </TR>

    <TR><TD VALIGN="LEFT">Reg Expire:</TD>
        <TD VALIGN="LEFT"><input type="text" name="REGEXP" size="8" value="<?php echo $rowGetGroup->REGEXP;?>">
        </TD>
    </TR>

    <TR><TD VALIGN="LEFT">Reg Fee:</TD>
        <TD VALIGN="LEFT">$<input type="text" name="REGFEE" size="6" value="<?php echo $rowGetGroup->REGFEE;?>"></TD>
    </TR>
</TABLE>
<br>

		<input style="width: 18cm" type="submit" value="Save">
</div>

		</form>
    <div style="margin-left: 14cm">
<b>------------------------------------------------------------------------------------------------------------------------------</b>

		<table >
		<tr><td><font face="Verdana" size="1" color="#000000">USERNAME</td><td><font face="Verdana" size="1" color="#000000">PASSWORD</td><td><font face="Verdana" size="1" color="#000000">EMAIL</td><td>&nbsp;</td></tr>
		<tr><td VALIGN="TOP"><form action="<?php echo "$PHP_SELF?op=addGroupUser"; ?>" method="POST">
                    <input type="hidden" name="ggrid" value="<?php echo $getGRID; ?>">
                    <input type="text" name="newHandle" required></td><td VALIGN="TOP">
                <input type="text" name="newPass" required></td><td VALIGN="TOP">
                <input type="text" size="40" name="newEmail"></td>
            <td VALIGN="TOP"><input type="submit" value="Add User"></form></td></tr><?php while ($rowGetGroupUsers = mysqli_fetch_object($quGetGroupUsers)) {?>
		<?php if($rowGetGroup->ADMIN==$rowGetGroupUsers->UID) {
			$bold = "<b>";
			$endBold = "</b>";
		} else {
			$bold = "";
			$endBold = "";
		}?>
		<tr>
            <td>
                <?php echo "<FONT SIZE=\"-1\" COLOR=\"#000000\">uid: $rowGetGroupUsers->UID |</FONT> $bold <a target=\"new\" href=\"http://$rowGetGroupUsers->HANDLE:$rowGetGroupUsers->PASS@www.bostonapartments.com/lacms/\"><font face=\"Verdana\" size=\"1\" color=\"#000000\">$rowGetGroupUsers->HANDLE</font></a> $endBold"; ?></td><td><font face="Verdana" size="1" color="#000000"><?php echo $rowGetGroupUsers->PASS;?></td><td><font face="Verdana" size="1" color="#000000"><?php echo $rowGetGroupUsers->EMAIL;?></td><td>&nbsp;
                <a href="<?php echo "$PHP_SELF?op=termUser&uid=$rowGetGroupUsers->UID&handle=$rowGetGroupUsers->HANDLE&getGrid=$ggrid";?>">
                    <font face="Verdana" size="1" color="#000000"> terminate</a></td></tr>
		<?php } ?>
            </div>
<!--END editUser -->
<?php }  elseif ($page=="myInfo") { ?>

<!--BEGIN myInfo -->

		<?php echo $group;?><br>
		Maximum Number of Active Ads Allowed: <?php echo $maxAct;?><br>
		Current Number of Active Ads:<?php echo $active;?><br>
<!--END myInfo -->
<?php } elseif ($page=="coue") { ?>
<!-- BEGIN continue -->

<center><br><br><br> <form action="<?php echo $PHP_SELF;?>" method="GET"><input type="submit" value="   Continue    "><input type="hidden" name="op" value="sel"></form></center>
<!--END continue -->

<?php }elseif ($page=="import") { ?>
<!--BEGIN import -->

	<center>
        Available Directories:
	<pre>
	<?php
	while (false !== ($entry = $exDir->read())) {
	    echo $entry."<br>\n";
	} ?>
	</pre>
	<form action="<?php echo "$PHP_SELF?op=importDo"; ?>" method="POST">
	<font color="#000000" face="Verdana" size="1">
	Filename: <input type="text" name="filename"><br>
	<input type="submit" value="Finish"></form><br><br>
	<a href="./unlockAllAds.php"><font color="#FFFFFF" face="Verdana" size="1">Unlock All ads.</font></a>

<!--END import -->
<?php }elseif ($page=="select_and_delete") { ?>
<!--BEGIN select_and_delete -->

<!--END select_and_delete -->
<?php } ?>
<!--END SELECTED CONTENT -->

				</td>
		    </tr>
		  </table>
		  </center>
		</div>
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
</div>   
 
</body>
</html>                                         
