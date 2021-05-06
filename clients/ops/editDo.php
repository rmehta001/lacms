<?php
//BEGIN editDo//
$cid=$_POST['cid'];
$body= prepareAdBody($_POST['body'], 0);
$loc=$_POST['loc'];
$type =$_POST['type'];
$street = $_POST['street'];
$xstreet = $_POST['xstreet'];
$street_num = $_POST['street_num'];
$apt = $_POST['apt'];
$floor = $_POST['floor'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$nofee = $_POST['nofee'];
$status_sale = $_POST['status_sale'];
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
$petsa = $_POST['PETSA'];
if ($petsa == "--") {
	$petsa = 0;
}

$status = $_POST['status'];
if ($status=='ACT') {
	$quStrCheckAct = "SELECT count(CID) AS ACTCOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid'";
	$quCheckAct = mysqli_query($dbh, $quStrCheckAct);
	$rowCheckAct = mysqli_fetch_object($quCheckAct);
	if (($rowCheckAct->ACTCOUNT + 1) > $maxAct) {
		$status = "STO";
	}
}
//Count active and determine status//

$quStrCheckAd = "SELECT SAFETY, TYPE FROM CLASS WHERE CID=$cid";

$quCheckAd = mysqli_query($dbh, $quStrCheckAd) or die (dieNice ("Sorry,  couldn't lookup that ad.", "E-100"));
$rowCheckAd = mysqli_fetch_object ($quCheckAd);
if ($rowCheckAd->TYPE=="2") {
	$fee_or_status_sale = "STATUS_SALE='" . $status_sale . "'";
}else {
	$fee_or_status_sale = "NOFEE='" . $nofee . "'";
}
if ($rowCheckAd->SAFETY) {
	$page = "safetyerr";
	$msg = "Error,  the ad is locked for editing";
	$msg_error = true;
	$title = "Can't Edit";
} else {

	$quStrUpdateAd = ($isAdmin) ? "UPDATE CLASS SET STATUS='$status',BODY='$body', TYPE='$type', LOC='$loc', MOD='$now', MODBY='$handle',  $fee_or_status_sale, AVAIL='$avail', PRICE='$price', STREET='$street', xstreet='$xstreet', STREET_NUM='$street_num', APT='$apt', FLOOR='$floor', CITY='$city', STATE='$state', ZIP='$zip', USE_USER_SIG='$use_user_sig', LANDLORD='$landlord', ROOMS='$rooms', BATH='$bath', PETSA='$petsa', UID='$own_uid' WHERE CID='$cid' AND CLI='$grid'" : "UPDATE CLASS SET STATUS='$status', BODY='$body', TYPE='$type', LOC='$loc', MOD='$now', MODBY='$handle',  NOFEE='$nofee', AVAIL='$avail', PRICE='$price', STREET='$street', xstreet='$xstreet', STREET_NUM='$street_num', APT='$apt', FLOOR='$floor', CITY='$city', STATE='$state', ZIP='$zip', USE_USER_SIG='$use_user_sig', LANDLORD='$landlord', ROOMS='$rooms', BATH='$bath', PETSA='$petsa' WHERE CID='$cid' AND CLI='$grid'";
	$quUpdateAd = mysqli_query($dbh, $quStrUpdateAd) or die ($quStrUpdateAd); // (dieNice ("Sorry,  couldn't update the ad.", "E-101"));

	$page = "sel";
	$title = "Selected";
	$disData="ads";
	$msg = "Changes saved to database.";
}
//END editDo//
?>
