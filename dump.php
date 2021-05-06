<?php
include("../inc/global.php");
set_time_limit(0);

$il = $HTTP_GET_VARS['il'];
$o = $HTTP_GET_VARS['o'];
$t = $HTTP_GET_VARS['t'];


$now = date("D M j G:i:s T Y");
$nowYYYYMMDD = date("Ymd");


//open log file and write Header//
$logFile = fopen ("./dumplog.txt", 'w');
fwrite ($logFile, "BSTAPTS HTML DUMP LOG FILE");
fwrite ($logFile, "\n$now\n");
fwrite ($logFile, "-----------------------------------------------------------");
fwrite ($logFile, "\n\n\n");





// DB CONNECT //
mysqli_select_db($dbh, $DBNAME);
echo "DB CONNECT LACMS \n <br>";




$quStrTypes = "SELECT * FROM TYPES";
$quTypes = mysqli_query($dbh, $quStrTypes) or die ("error, Types query failed,  dump aborted");



//Create loc unspecifiec pages (1's) //
if ($o) {
while ($rowTypes = mysqli_fetch_object($quTypes)) {
        $thisFileCount = 0;
	$filename = "$liveDataDir$rowTypes->FNAME" . "1.htm";
	$dumpFile = fopen ($filename, 'w');
	fwrite ($dumpFile, "<!-- DATA DUMPED $now  -->");
	fwrite ($dumpFile, "$rowTypes->LOCHEAD \n");
	fwrite ($dumpFile, "\n\n");
	$quStrGetAds = "SELECT * FROM (CLASS INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE TYPE=$rowTypes->TYPE AND STATUS='ACT' ORDER BY `LOC`.STATE, LOCNAME, SPORDER ASC, RAND()";
	$quGetAds = mysqli_query($dbh, $quStrGetAds) or die("error,  locations query failed, dump aborted");
	$numGetAds = mysqli_num_rows($quGetAds);

	while ($rowGetAds = mysqli_fetch_object($quGetAds)) {
               if ($thisFileCount==0) {
               		fwrite ($dumpFile, "<!-- $rowGetAds->LOCNAME --> \n\n");
			$oldLoc = $rowGetAds->LOCID;
               		$oldLocName = $rowGetAds->LOCNAME;
               	}else {
               		if($oldLoc!==$rowGetAds->LOCID)  {
               			fwrite ($dumpFile, "<!-- $oldLocName END --> \n\n");
				fwrite ($dumpFile, "<!-- $rowGetAds->LOCNAME --> \n\n");
				$oldLoc = $rowGetAds->LOCID;
               			$oldLocName = $rowGetAds->LOCNAME;
               		}
               	}
		$adDateIn = ($nowYYYYMMDD - (str_replace ("-", "", $rowGetAds->DATEIN)));
		$adDateMod = ($nowYYYYMMDD - (str_replace ("-", "", $rowGetAds->MOD)));
		$isNewLog = (($adDateIn < 2) || ($adDateMod < 2)) ? 1 : 0;
		$isNew = ($isNewLog) ? "<img src='http://www.bostonapartments.com/images/newIcon.gif'>" : "";
  		$hasPics = ($rowGetAds->PIC) ? "<a href=\"http://www.bostonapartments.com/homepage.php?cli=$rowGetAds->CLI&ad=$rowGetAds->CID\"><img border='0' width='20' height='18' src='http://www.bostonapartments.com/images/pic.gif'></a>" : "";
		$noFee = ($rowGetAds->NOFEE) ? "<font color='red'><b>NO FEE</b></font> - " : "";
		$signature = ($rowGetAds->ALTSIG) ? "$rowGetAds->ALTSIG" : "$rowGetAds->SIG";
		fwrite($dumpFile, "<HR>\n$rowGetAds->LOCNAME - $noFee$rowGetAds->BODY$hasPics$isNew<BR>\n$signature<!-- Ad #<?php echo $rowGetAds->CID;?> --><BR>\n\n");

		$thisFileCount++;


                if ($thisFileCount==$numGetAds) {
                	fwrite ($dumpFile, "<!-- $rowGetAds->LOCNAME END --> \n\n");

		}

        }
        mysqli_free_result($quGetAds);
	fwrite ($dumpFile, "$rowTypes->LOCFOOT \n");
	fclose($dumpFile);
	fwrite ($logFile, "Wrote $thisFileCount records to $rowTypes->FNAME \n");

}
$rowTypes = "";
$dumpFile = "";
mysqli_free_result($quTypes);
}

if ($il) {
$quStrTypes = "SELECT * FROM TYPES";
$quTypes = mysqli_query($dbh, $quStrTypes) or die ("error, Types query failed,  dump aborted");
$quStrLocs = "SELECT * FROM LOC";
$quLocs = mysqli_query($dbh, $quStrLocs) or die ("error, Locs query faild, dunp aborted");



//Create loc specific pages //
$locHasAds = array ();

while ($rowTypes = mysqli_fetch_object($quTypes)) {
        $thisFileCount = 0;
	$quStrLocs = "SELECT * FROM LOC ORDER BY STATE, LOCNAME";
	$quLocs = mysqli_query($dbh, $quStrLocs) or die ("error, Locs query faild, dunp aborted");
	$locHasAds[$rowTypes->TYPE] = array();
	while ($rowLocs = mysqli_fetch_object($quLocs)) {
		$filename = "$liveDataDir$rowTypes->ALTNAME-$rowLocs->LOCNAME.htm";
		$dumpFile = fopen ($filename, 'w');

    		fwrite ($dumpFile, "<!-- DATA DUMPED $now  -->");
        	fwrite ($dumpFile, "\n\n");
		if (!$rowLocs->HTML_HEAD) {
			$html_head = $rowTypes->LOCHEAD;
		}else {
			$html_head = $rowLocs->HTML_HEAD;
		}
		fwrite ($dumpFile, "$html_head \n \n");
       		$quStrGetAds = "SELECT * FROM (CLASS INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE TYPE=$rowTypes->TYPE AND STATUS='ACT' AND LOC=$rowLocs->LOCID ORDER BY SPORDER ASC, RAND()";
		$quGetAds = mysqli_query($dbh, $quStrGetAds) or die("error,  locations query failed, dump aborted");
		$numGetAds = mysqli_num_rows($quGetAds);
		$locHasAds[$rowTypes->TYPE][$rowLocs->LOCID] = $numGetAds;
		//echo "$rowTypes->TYPE : $rowLocs->LOCID = $numGetAds <br>";
		while ($rowGetAds = mysqli_fetch_object($quGetAds)) {

			$adDateIn = ($nowYYYYMMDD - (str_replace ("-", "", $rowGetAds->DATEIN)));
			$adDateMod = ($nowYYYYMMDD - (str_replace ("-", "", $rowGetAds->MOD)));
			$isNewLog = (($adDateIn < 2) || ($adDateMod < 2)) ? 1 : 0;
			$isNew = ($isNewLog) ? "<img src='http://www.bostonapartments.com/images/newIcon.gif'>" : "";
              		$hasPics = ($rowGetAds->PIC) ? "<a href=\"http://www.bostonapartments.com/homepage.php?cli=$rowGetAds->CLI&ad=$rowGetAds->CID\"><img border='0' width='20' height='18' src='http://www.bostonapartments.com/images/pic.gif'></a>" : "";
			$noFee = ($rowGetAds->NOFEE) ? "<font color='red'><b>NO FEE</b></font> - " : "";
			$signature = ($rowGetAds->ALTSIG) ? "$rowGetAds->ALTSIG" : "$rowGetAds->SIG";
			fwrite($dumpFile, "<HR>\n$rowGetAds->LOCNAME - $noFee$rowGetAds->BODY$hasPics$isNew<BR>\n$signature<BR>\n\n");
			$thisFileCount++;




        	}
		if (!$rowLocs->HTML_FOOT) {
			$html_foot = $rowTypes->LOCFOOT;
		}else {
			$html_foot = $rowLocs->HTML_FOOT;
		}
		fwrite ($dumpFile, "$html_foot \n \n");
	}
        mysqli_free_result($quGetAds);
        fclose($dumpFile);


}



$rowTypes = "";
$dumpFile = "";
mysqli_free_result($quTypes);
mysqli_free_result($quLocs);
}


if ($il) {
$quStrTypes = "SELECT * FROM TYPES";
$quTypes = mysqli_query($dbh, $quStrTypes) or die ("error, Types query failed,  dump aborted");



//Create Type Index pages.//

while ($rowTypes = mysqli_fetch_object($quTypes)) {
        $thisFileCount = 0;
	$dumpFile = fopen ("$liveDataDir$rowTypes->FNAME.htm", 'w');
	$html_head = $rowTypes->HTML_HEAD;
	fwrite ($dumpFile, "$html_head \n \n");
	fwrite ($dumpFile, "<TABLE BORDER=\"6\" BORDERCOLOR=\"#FF66FF\" CELLPADDING=\"2\" BGCOLOR=\"#FFFFFF\"><TR> \n");
	$colCount = 1;
	$quStrLocs = "SELECT * FROM LOC ORDER BY `LOC.STATE`, LOCNAME";
	$quLocs = mysqli_query($dbh, $quStrLocs) or die ("error, Locs query faild, dunp aborted");
	while ($rowLocs = mysqli_fetch_object($quLocs)) {
		$shitsplits = split (" ", "$rowLocs->LOCNAME");
		foreach ($shitsplits as $shitsplit) {
			$titleCased.= " ";
			$titleCased.= ucfirst(strtolower($shitsplit));
		}
		$thisLocHasAds = $locHasAds[$rowTypes->TYPE][$rowLocs->LOCID];
		if ($thisLocHasAds) {
			$cell = "<TD width='200'><font size='-1'><a href=\"./$rowTypes->ALTNAME-$rowLocs->LOCNAME.htm\">$titleCased</a></font></TD> \n";
		}else {
			$cell = "<TD width='200'><font size='-1'>$titleCased</font></TD> \n";
		}
		fwrite ($dumpFile, $cell);
		if ($colCount >= 4) {
			fwrite ($dumpFile, "</TR><TR> \n");
			$colCount = 0;
		}
		$colCount++;
		$titleCased = "";
	}

	fwrite ($dumpFile,"</TR></TABLE> \n");
	if (!$rowLocs->HTML_FOOT) {
		$html_foot = $rowTypes->LOCFOOT;
	}else {
		$html_foot = $rowLocs->HTML_FOOT;
	}
	fwrite ($dumpFile, $html_foot);

        fclose($dumpFile);
	$rowLocs = "";

}

mysqli_free_result($quTypes);
mysqli_free_result($quLocs);
}

//CREATE 2's for crappy cgi's


if ($t) {
$quStrTypes = "SELECT * FROM TYPES";
$quTypes = mysqli_query($dbh, $quStrTypes) or die ("error, Types query failed,  dump aborted");

while ($rowTypes = mysqli_fetch_object($quTypes)) {
	//create file
	$filename = "$liveDataDir$rowTypes->FNAME" . "2.htm";
	$dumpFile = fopen ($filename, 'w');

    	fwrite ($dumpFile, "<!-- DATA DUMPED $now  -->");

	$quStrGetAds = "SELECT * FROM (CLASS INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE TYPE=$rowTypes->TYPE AND STATUS='ACT' ORDER BY `LOC`.STATE, LOCNAME, SPORDER ASC, RAND()";
	$quGetAds = mysqli_query($dbh, $quStrGetAds) or die("error,  locations query failed, dump aborted");
	$numGetAds = mysqli_num_rows($quGetAds);

	while ($rowGetAds = mysqli_fetch_object($quGetAds)) {
               if ($thisFileCount==0) {
               		fwrite ($dumpFile, "<!-- $rowGetAds->LOCNAME --> \n\n");
               		$oldLoc = $rowGetAds->LOCID;
               		$oldLocName = $rowGetAds->LOCNAME;
               	}else {
               		if($oldLoc!==$rowGetAds->LOCID)  {
               			fwrite ($dumpFile, "<!-- $oldLocName END --> \n\n");
               			fwrite ($dumpFile, "<!-- $rowGetAds->LOCNAME --> \n\n");
               			$oldLoc = $rowGetAds->LOCID;
               			$oldLocName = $rowGetAds->LOCNAME;
               		}
               	}
		$adDateIn = ($nowYYYYMMDD - (str_replace ("-", "", $rowGetAds->DATEIN)));
		$adDateMod = ($nowYYYYMMDD - (str_replace ("-", "", $rowGetAds->MOD)));
		$isNewLog = (($adDateIn < 2) || ($adDateMod < 2)) ? 1 : 0;
		$isNew = ($isNewLog) ? "<img src='http://www.bostonapartments.com/images/newIcon.gif'>" : "";
		$hasPics = ($rowGetAds->PIC) ? "<a href=\"http://www.bostonapartments.com/homepage.php?cli=$rowGetAds->CLI&ad=$rowGetAds->CID\"><img border='0' width='20' height='18' src='http://www.bostonapartments.com/images/pic.gif'></a>" : "";
		$noFee = ($rowGetAds->NOFEE) ? "<font color='red'><b>NO FEE</b></font> - " : "";
		$signature = ($rowGetAds->ALTSIG) ? "$rowGetAds->ALTSIG" : "$rowGetAds->SIG";
		fwrite($dumpFile, "<HR>\n$rowGetAds->LOCNAME - $noFee$rowGetAds->BODY$hasPics$isNew<BR>\n$signature<BR>\n\n");
		$thisFileCount++;


                if ($thisFileCount==$numGetAds) {
                	fwrite ($dumpFile, "<!-- $rowGetAds->LOCNAME END --> \n\n");
		}

        }
        mysqli_free_result($quGetAds);
	fclose ($dumpFile);
	$dumpFile ="";






	//modify file
	$fileToRead = "$liveDataDir$rowTypes->FNAME" . "2.htm";
	$fp = fopen ($fileToRead, 'r') or die ("fuck");
	$readFile = fread ($fp, filesize($fileToRead));

	$readFile = eregi_replace ("<A HREF=\"", "<A HREF=\"http://www.BostonApartments.com/", $readFile);
	$readFile = eregi_replace ("<A HREF=\"http://www.BostonApartments.com/http://www.BostonApartments.com/", "<A HREF=\"http://www.BostonApartments.com/", $readFile);
	$readFile = eregi_replace ("<A HREF=\"http://www.BostonApartments.com/mailto:", "<A HREF=\"mailto:", $readFile);
	$readFile = eregi_replace ("http://www.BostonApartments.com/http:", "http:", $readFile);
	fclose ($fp);
	$fileToRead = "$liveDataDir$rowTypes->FNAME" . "2.htm";
	$dumpFile = fopen ($fileToRead, 'w');
	fwrite ($dumpFile, "<!--URLS ABSOLUTIFIED $now -->");
	fwrite ($dumpFile, $readFile);
	fclose ($dumpFile);

}

}

fclose ($logFile);


echo "HTML Dump(s) completed successfully \n";
echo "View the Log for more details, hinkle";
?>





