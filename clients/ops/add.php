<?php
//BEGIN add //
//DEPRICIATED//
die();


$body= prepareAdBody($_POST['body'], 0);
$loc=$_POST['loc'];
$type = $_POST['type'];
$street = $_POST['street'];
$street_num = $_POST['street_num'];
$apt = $_POST['apt'];
$floor = $_POST['floor'];
$city = $_POST['city'];

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
$pets = $_POST['pets'];
if ($pets=="--") {
	$pets = 0;
}

if ($body!=="" & $loc!=="--") {
	
	$quStrCountActive = "SELECT count(CID) AS ACTIVECOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid'";
	$quCountActive = mysqli_query($dbh, $quStrCountActive);
	$rowCountActive= mysqli_fetch_object ($quCountActive);
	if ($rowCountActive->ACTIVECOUNT < $maxAct) {
		$now = date("Ymd");
		$quStrInsAd = "INSERT INTO CLASS (BODY, STATUS, LOC, UID, CLI, DATEIN, MOD, TYPE, NOFEE, AVAIL, PRICE, STREET_NUM, STREET, APT, FLOOR, USE_USER_SIG, LANDLORD, ROOMS, BATH, PETSA ) VALUES ('$body', 'ACT', '$loc', '$uid', '$grid', '$now', '$now', '$type', '$noFee', '$avail', '$price', '$street_num', '$street', '$apt', '$floor', '$use_user_sig', '$landlord', '$rooms', '$bath', '$pets')";
		$quInsAd = mysqli_query($dbh, $quStrInsAd) or die ($quStrInsAd);//(dieNice ("Sorry, couldn't insert that ad.", "E-104"));
		if ($upload) {
			
			$cid = mysqli_insert_id($dbh);
			$title = "Upload Picture";
			$msg = "New Ad Created, $abv-$cid,  upload pics here.";
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
		$quStrInsAd = "INSERT INTO CLASS (BODY, STATUS, LOC, UID, CLI, DATEIN, MOD, TYPE, NOFEE, AVAIL, PRICE, STREET_NUM, STREET, APT, FLOOR, USE_USER_SIG, LANDLORD, ROOMS, BATH, PETSA ) VALUES ('$body', 'STO', '$loc', '$uid', '$grid', '$now', '$now', '$type', '$noFee', '$avail', '$price', '$street_num', '$street', '$apt', '$floor', '$use_user_sig', '$landlord', '$rooms', '$bath', '$pets')";
		$quInsAd = mysqli_query($dbh, $quStrInsAd) or die ($quStrInsAd);// (dieNice ("Sorry, couldn't insert that ad.", "E-104"));
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
	$msg_err = true;
}            
//END add //  
?>