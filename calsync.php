<?php
include("libcli/client_db.php");
include("libcli/functions.php");

// initialize config var keys and configure defaults 

	$grid = $HTTP_GET_VARS['cli'];
	$auid = $HTTP_GET_VARS['uid'];

// headers
header("Content-Type: text/x-vCalendar");
echo "\r\n";
header("Content-Disposition: inline; filename=BosApts.vcs");
echo "\r\n";
echo "BEGIN: VCALENDAR \r\n";
echo "VERSION: 2.0 \r\n";
echo "PRODID: -//bosapt/cal//NONSGML v1.0//EN \r\n";
echo "CALSCALE:GREGORIAN \r\n";
echo "X-WR-TIMEZONE;VALUE=TEXT:US/Eastern \r\n";
// echo "METHOD:PUBLISH \r\n";
echo "X-WR-CALNAME: BostonApts \r\n";

//DEFINED VALUE SETS //

$quStrGetappoint = "SELECT * FROM `CLIENTS` WHERE `SHOW_DATE` >= NOW() AND `GRID`=\"$grid\" AND `UID`=\"$auid\" ORDER BY `SHOW_DATE` ASC";

// Client appointments 

	$StrGetappoint = mysqli_query($dbh, $quStrGetappoint) or die (mysqli_error($dbh));
	while ($rowappointget = mysqli_fetch_object($StrGetappoint)) {

$rowappointget->SHOW_DATE = str_replace("-", "", $rowappointget->SHOW_DATE);
$rowappointget->SHOW_TIME = str_replace(":", "", $rowappointget->SHOW_TIME);


echo "BEGIN: VEVENT \r\n";
echo "UID: BAcalevent \r\n";
echo "DTSTAMP: ".$rowappointget->SHOW_DATE."T".$rowappointget->SHOW_TIME."Z \r\n";
echo "DTSTART: ".$rowappointget->SHOW_DATE."T".$rowappointget->SHOW_TIME."Z \r\n";
echo "DTEND: ".$rowappointget->SHOW_DATE."T".$rowappointget->SHOW_TIME."Z \r\n";
echo "SUMMARY: ".$rowappointget->NAME_FIRST." ".$rowappointget->NAME_LAST." for ".$rowappointget->SHOW_LENGTH." minutes \r\n";
echo "END: VEVENT \r\n";
  }
// end client appointments

//Begin other reminders


$quStrGetremind = "SELECT * FROM `REMINDERS` WHERE `REMIND_DATE` >= NOW() AND `CLI`=\"$grid\" AND `UID`=\"$uid\" ORDER BY `REMIND_DATE` ASC";

	$StrGetremind = mysqli_query($dbh, $quStrGetremind) or die (mysqli_error($dbh));
	while ($rowremindget = mysqli_fetch_object($StrGetremind)) {
		
$rowremindget->REMIND_DATE = str_replace("-", "", $rowremindget->REMIND_DATE);
$remindt = "$rowremindget->REMIND_TIME";
$rowremindget->REMIND_TIME = str_replace(":", "", $rowremindget->REMIND_TIME);

echo "BEGIN: VEVENT \r\n";
echo "UID: BAcalevent \r\n";
echo "DTSTAMP: ".$rowremindget->REMIND_DATE."T".$rowremindget->REMIND_TIME."Z \r\n";
echo "DTSTART: ".$rowremindget->REMIND_DATE."T".$rowremindget->REMIND_TIME."Z \r\n";
echo "DTEND: ".$rowremindget->REMIND_DATE."T".$rowremindget->REMIND_TIME."Z \r\n";
echo "SUMMARY: ".$remindt." Reminder \r\n";
echo "DESCRIPTION: ".$rowremindget->REMIND." \r\n";
echo "END: VEVENT \r\n";
  }
//End other reminders
   echo "END: VCALENDAR \r\n";
?>
