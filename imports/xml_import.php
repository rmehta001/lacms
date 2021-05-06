<?php
include ("../inc/local_info.php");
mysqli_select_db($dbh, $DBNAME);
$now = date("Y-m-d");
$time = date("H:i:s");

$headers = getallheaders();


if ($headers['Content-Type'] == "application/x-www-form-urlencoded") {
	$log = fopen ("badlog.log", "w+");
	fwrite ($log, "test");
	fclose ($log);
	die("Error: Wrong headers sent,  please specify content-type as text/xml,  you sent ".$headers['Content-Type']);
}

$xml = file_get_contents( $_FILES['userfile']['tmp_name'] );

if (!$xml) {
	die ("Error: no xml sent.");
}

$wierdChar = chr (11);
$xml = str_replace ($wierdChar, "", $xml);

$parser = xml_parser_create();

if (!xml_parse($parser, $xml)) {
	$xml = addslashes($xml);
	$quStrUpdateTrans = "INSERT INTO TRANSLOG (STATUS, USER) VALUES ('$xml', '$HTTP_AUTH_USER')";
	$quUpdateTrans = mysqli_query($dbh, $quStrUpdateTrans) or die ("Error:  Internal Error has occured,  please notify BostonApartments.com software team. Internal Error Number 8.");
	die ("Error:The xml document you sent is not valid.");
}
xml_parser_free($parser);


$SENSITIVE_FIELDS = Array ("CID",
"CLI",
"USERNAME",
"STATUS",
"DATEIN",
"MOD",
"MODBY",
"SPORDER",
"SAFETY",
"ALTSIG",
"HINKLE",
"PAYMENT_REC",
"LEGID",
"LEGLL",
"TRANSDEL",
"TRANSIN");

//Account Info
$accountStart = strpos ($xml, "<account");
$accountEnd = strpos ($xml, "</account>");
$accountLength = $accountEnd - $accountStart;
$account = substr ($xml, $accountStart, $accountLength);

$userStart = strpos($account, "user=\"") + 6;
$userEnd = strpos ($account, "\"", $userStart);
$userLength = $userEnd - $userStart;
$user = substr ($account, $userStart, $userLength);

$passStart = strpos($account, "pass=\"") + 6;
$passEnd = strpos ($account, "\"", $passStart);
$passLength = $passEnd - $passStart;
$pass = substr ($account, $passStart, $passLength);

$gridStart = strpos($account, "grid=\"") + 6;       
$gridEnd = strpos ($account, "\"", $gridStart); 
$gridLength = $gridEnd - $gridStart;
$grid = substr ($account, $gridStart, $gridLength);

$regkeyStart = strpos($account, "regkey=\"") + 8;       
$regkeyEnd = strpos ($account, "\"", $regkeyStart);
$regkeyLength = $regkeyEnd - $regkeyStart;
$regkey = substr ($account, $regkeyStart, $regkeyLength);

$quStrAuth = "SELECT * FROM USERS INNER JOIN `GROUP` ON USERS.`GROUP`=`GROUP`.GRID WHERE (USERS.HANDLE='$user' AND USERS.PASS='$pass' AND `GROUP`.`REGEXP` > '$now')";

$quAuth = mysqli_query($dbh, $quStrAuth) or die ("Error: There was a problem with your account information.");
$rowAuth = mysqli_fetch_object($quAuth);

if (!$rowAuth->UID) {
	die ("Failure:  Invaild User.");
}




//Transaction Info
$number_of_recordsStart = strpos ($xml, "<number-of-listings>") + 20;
$number_of_recordsEnd = strpos ($xml, "</number-of-listings>");
$number_of_recordsLength = $number_of_recordsEnd - $number_of_recordsStart;
$number_of_records = substr ($xml, $number_of_recordsStart, $number_of_recordsLength);

$dateStart = strpos ($xml, "<date-of-export>") + 16;
$dateEnd = strpos ($xml, "</date-of-export>");
$dateLength = $dateEnd - $dateStart;
$date = substr ($xml, $dateStart, $dateLength);

$timeStart = strpos ($xml, "<time-of-export>") + 16;
$timeEnd = strpos ($xml, "</time-of-export>");
$timeLength = $timeEnd - $timeStart;
$mtime = substr ($xml, $timeStart, $timeLength);

$quStrRecordTrans = "INSERT INTO TRANSLOG (USER, PASS, GRID, REGKEY, DATE, TIME, NUMBEROFRECORDS) VALUES ('$user', '$pass', '$grid', '$regkey', '$now', '$time', '$number_of_records')";
$quRecordTrans = mysqli_query($dbh, $quStrRecordTrans) or die ("Error: There was a problem with your account information.");
$translog = mysqli_insert_id($dbh);


$quStrCount = "SELECT count(CID) AS FCOUNT from CLASS where CLI='$grid'";
$quCount = mysqli_query($dbh, $quStrCount) or die("Error:  Internal Error has occured,  please notify BostonApartments.com software team. Internal Error Number 1.");
$rowGetCount = mysqli_fetch_object($quCount);
$firstCount = $rowGetCount->FCOUNT;


$quStrMarkForDel = "UPDATE CLASS SET TRANSDEL='1' WHERE CLI='$grid'";
$quMarkForDel = mysqli_query($dbh, $quStrMarkForDel) or die ("Error:  Internal Error has occured,  please notify BostonApartments.com software team. Internal Error Number 2.");


//echo "$quStrAuth<hr>$quStrRecordTrans<br>$quStrCount<br>$quStrMarkForDel<br>";

//Listings

$listingsStart = strpos($xml, "<listings>") + 10;
$listingsEnd = strpos($xml, "</listings>");
$listingsLength = $listingsEnd - $listingsStart;
$listings = substr ($xml, $listingsStart, $listingsLength);
$listings = split ("<listing>", $listings);
$numListings = count ($listings);


$num_to_insert =( $numListings = $rowAuth->MAXACT) ? $rowAuth->MAXACT : $numListings;
// = $numListings;
// > $rowAuth->MAXACT) ? $rowAuth->MAXACT : $numListings;
//echo "<br>Read $num_to_insert records.<br>";

for ($i=1;$i<$num_to_insert;$i++) {
	$listing = $listings[$i];
	$fields = split ("<field", $listing);
	$num_fields = count($fields);
	if ($num_fields < 1) {
		$insErr++;
		continue;
	}
	
	$field_list = "(`DATEIN`, `CLI`, `TRANSIN`, STATUS";
	$value_list = "('$now', '$grid', '1', 'ACT'";
	//'ACT'" ;
	
	for($j=1;$j<$num_fields;$j++) {
		$field = $fields[$j];
		$nameStart = strpos($field, "name=\"")+6;
		$nameEnd = strpos ($field, "\"", $nameStart);
		$nameLength = $nameEnd - $nameStart;
		$name = substr ($field, $nameStart, $nameLength);
		if (in_array($name, $SENSITIVE_FIELDS)) {
			continue;
		}
		if ($name == "UID") {
			$personalUIDSent = true;
		}
		$valueStart = strpos($field, ">")+ 1;
		$valueEnd = strpos($field, "</field>");
		$valueLength = $valueEnd - $valueStart;
		$value = substr ($field, $valueStart, $valueLength);
		$field_list .= ", `$name`";
		$value_list .= ", '". urldecode(addslashes($value)) ."'";
		
		
	}
	if (!$personalUIDSent) {
		$field_list .= ", `UID`";
		$value_list .= ", '$rowAuth->UID'";
	}
	$field_list .= ")";
	$value_list .= ")";
	
	$quStrInsertListing = "INSERT INTO CLASS $field_list VALUES $value_list";
//	echo "<hr>$quStrInsertListing<hr>";
	$quInsertListing = mysqli_query($dbh, $quStrInsertListing) or $insErr++;

}

$quStrCountNow = "SELECT count(CID) AS COUNTNOW FROM CLASS WHERE CLI='$grid'";
$quCountNow = mysqli_query($dbh, $quStrCountNow) or die ("Error:  Internal Error has occured,  please notify BostonApartments.com software team. Internal Error Number 3.");
$rowCountNow = mysqli_fetch_object($quCountNow);
$num_inserted = ($i - 1) - $insErr;


if ($rowCountNow->COUNTNOW == ($firstCount + ($num_inserted))) {;
	$quStrDelMarked = "DELETE FROM CLASS WHERE (CLI='$grid' AND TRANSDEL=1)";
	$quDelMarked = mysqli_query($dbh, $quStrDelMarked) or die ("Error:  Internal Error has occured,  please notify BostonApartments.com software team. Internal Error Number 4.");
	$msg = "Success: $num_inserted  listing(s) inserted.";
	if ($insErr) {
		$msg .= "Warning: $insErr listing(s) did not make it into the system because they were not formated correctly or had illegal values.";
	}
	$quStrUpdateTrans = "UPDATE TRANSLOG SET STATUS='Success', NUMBEROFRECORDS='$num_inserted' WHERE ID='$translog'";
	$quUpdateTrans = mysqli_query($dbh, $quStrUpdateTrans) or die ("Error:  Internal Error has occured,  please notify BostonApartments.com software team. Internal Error Number 5.");
	
}else {
	$quStrDelIn = "DELETE FROM CLASS WHERE (CLI='$grid' AND TRANSIN=1)";
	$quDelIn = mysqli_query($dbh, $quStrDelIn) or die("Error:  Internal Error has occured,  please notify BostonApartments.com software team. Internal Error Number 6.");
	
	$quStrUpdateMarked = "UPDATE CLASS SET TRANSDEL=0 WHERE CLI=1";
	$quUpdateMarked = mysqli_query($dbh, $quStrUpdateMarked) or die ("Error:  Internal Error has occured,  please notify BostonApartments.com software team. Internal Error Number 7.");
	$msg = "Failure: 1 or more rules have been broken.";
	
	$quStrUpdateTrans = "UPDATE TRANSLOG SET STATUS='Failure', NUMBEROFRECORDS=0 WHERE ID='$translog'";
	$quUpdateTrans = mysqli_query($dbh, $quStrUpdateTrans) or die ("Error:  Internal Error has occured,  please notify BostonApartments.com software team. Internal Error Number 8.");
}


// Relocationality MLS feed ad shut-off //
$quUpdateRelo = "UPDATE `CLASS` SET `STATUS`='STO', `UID`='6976' WHERE `CLI`='1024'";
$UpdateRelo = mysqli_query($dbh, $quUpdateRelo) or die ("Error:  Could not clean up Relocationality.");
// Relocationality MLS feed ad shut-off end //


// RJ Client turn on ads when dumped //

$quUpdateRelo = "UPDATE `CLASS` SET `STATUS`='ACT' WHERE `CLI`='1059'";
$UpdateRelo = mysqli_query($dbh, $quUpdateRelo) or die ("Error:  Could not activate RJ Ads.");

// RJ Client turn on ads when dumped end //


echo $msg;

?>

	



