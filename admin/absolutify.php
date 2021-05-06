<?php
$now = date ("Ymd");
include("../inc/global.php");
set_time_limit(0);
//modify file
	$fileToRead = "$liveDataDir/class2.htm";
	$fp = fopen ($fileToRead, 'r') or die ("fuck");
	$readFile = fread ($fp, filesize($fileToRead));

	$readFile = preg_replace ("<A HREF=\"", "<A HREF=\"https://www.BostonApartments.com/", $readFile);
	$readFile = preg_replace ("<A HREF=\"https://www.BostonApartments.com/https://www.BostonApartments.com/", "<A HREF=\"https://www.BostonApartments.com/", $readFile);
	$readFile = preg_replace ("<A HREF=\"https://www.BostonApartments.com/mailto:", "<A HREF=\"mailto:", $readFile);
	$readFile = preg_replace ("https://www.BostonApartments.com/http:", "http:", $readFile);
	fclose ($fp);
	$fileToRead = "$liveDataDir$rowTypes->FNAME" . "2.htm";
	$dumpFile = fopen ($fileToRead, 'w');
	fwrite ($dumpFile, "<!--URLS ABSOLUTIFIED $now -->");
	fwrite ($dumpFile, $readFile);
	fclose ($dumpFile);

//modify file
	$fileToRead = "$liveDataDir/forsale2.htm";
	$fp = fopen ($fileToRead, 'r') or die ("fuck");
	$readFile = fread ($fp, filesize($fileToRead));

	$readFile = preg_replace ("<A HREF=\"", "<A HREF=\"https://www.BostonApartments.com/", $readFile);
	$readFile = preg_replace ("<A HREF=\"https://www.BostonApartments.com/https://www.BostonApartments.com/", "<A HREF=\"https://www.BostonApartments.com/", $readFile);
	$readFile = preg_replace ("<A HREF=\"https://www.BostonApartments.com/mailto:", "<A HREF=\"mailto:", $readFile);
	$readFile = preg_replace ("https://www.BostonApartments.com/http:", "http:", $readFile);
	fclose ($fp);
	$fileToRead = "$liveDataDir$rowTypes->FNAME" . "2.htm";
	$dumpFile = fopen ($fileToRead, 'w');
	fwrite ($dumpFile, "<!--URLS ABSOLUTIFIED $now -->");
	fwrite ($dumpFile, $readFile);
	fclose ($dumpFile);
	
//modify file
	$fileToRead = "$liveDataDir/classcommr2.htm";
	$fp = fopen ($fileToRead, 'r') or die ("fuck");
	$readFile = fread ($fp, filesize($fileToRead));

	$readFile = preg_replace ("<A HREF=\"", "<A HREF=\"https://www.BostonApartments.com/", $readFile);
	$readFile = preg_replace ("<A HREF=\"https://www.BostonApartments.com/https://www.BostonApartments.com/", "<A HREF=\"https://www.BostonApartments.com/", $readFile);
	$readFile = preg_replace ("<A HREF=\"https://www.BostonApartments.com/mailto:", "<A HREF=\"mailto:", $readFile);
	$readFile = preg_replace ("https://www.BostonApartments.com/http:", "http:", $readFile);
	fclose ($fp);
	$fileToRead = "$liveDataDir$rowTypes->FNAME" . "2.htm";
	$dumpFile = fopen ($fileToRead, 'w');
	fwrite ($dumpFile, "<!--URLS ABSOLUTIFIED $now -->");
	fwrite ($dumpFile, $readFile);
	fclose ($dumpFile);

//modify file
	$fileToRead = "$liveDataDir/classcomms2.htm";
	$fp = fopen ($fileToRead, 'r') or die ("fuck");
	$readFile = fread ($fp, filesize($fileToRead));

	$readFile = preg_replace ("<A HREF=\"", "<A HREF=\"https://www.BostonApartments.com/", $readFile);
	$readFile = preg_replace ("<A HREF=\"https://www.BostonApartments.com/https://www.BostonApartments.com/", "<A HREF=\"https://www.BostonApartments.com/", $readFile);
	$readFile = preg_replace ("<A HREF=\"https://www.BostonApartments.com/mailto:", "<A HREF=\"mailto:", $readFile);
	$readFile = preg_replace ("https://www.BostonApartments.com/http:", "http:", $readFile);
	fclose ($fp);
	$fileToRead = "$liveDataDir$rowTypes->FNAME" . "2.htm";
	$dumpFile = fopen ($fileToRead, 'w');
	fwrite ($dumpFile, "<!--URLS ABSOLUTIFIED $now -->");
	fwrite ($dumpFile, $readFile);
	fclose ($dumpFile);

?>
abosolutified
