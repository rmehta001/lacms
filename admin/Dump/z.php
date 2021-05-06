<?php
include("../../inc/global.php");
include("../../inc/local_info.php");
set_time_limit(0);

$liveDataDir="/www/lacms/test/";

$il = $HTTP_GET_VARS['il'];
$o = $HTTP_GET_VARS['o'];
$t = $HTTP_GET_VARS['t'];
$all = $HTTP_GET_VARS['all'];

$now = date("D M j G:i:s T Y");
$nowYYYYMMDD = date("Ymd");


//open log file and write Header//
$logFile = fopen ("./log/type9dumplog.txt", 'w');
fwrite ($logFile, "BSTAPTS HTML DUMP LOG FILE");
fwrite ($logFile, "\n$now\n");
fwrite ($logFile, "-----------------------------------------------------------");
fwrite ($logFile, "\n\n\n");





// DB CONNECT //
mysqli_select_db($dbh, $DBNAME);
echo "DB CONNECT $dbh \n <br>";


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


$quStrTypes = "SELECT * FROM TYPES WHERE TYPE=9";
$quTypes = mysqli_query($dbh, $quStrTypes) or die ("error, Types query failed,  dump aborted");



//Create loc unspecifiec pages (1's) //
$locations="AND (LOC.STATE=21 OR LOC.STATE=29 OR LOC.STATE=40)";
$locations_loc="WHERE STATE=21 OR STATE=29 OR STATE=40";

while ($rowTypes = mysqli_fetch_object($quTypes)) {
        $thisFileCount = 0;
	$filename = "$liveDataDir$rowTypes->FNAME" . "1.htm";
	$dumpFile = fopen ($filename, 'w');
	fwrite ($dumpFile, "$rowTypes->LOCHEAD \n");
	fwrite ($dumpFile, "\n\n");
	fwrite ($dumpFile, "<!-- DATA DUMPED $now  -->\n");
	$quStrGetAds = "SELECT * FROM ((CLASS INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN USERS ON CLASS.UID=USERS.UID WHERE TYPE=$rowTypes->TYPE AND STATUS='ACT' $locations ORDER BY LOCNAME, SPORDER ASC, RAND()";
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
		
		fwrite($dumpFile, format_ad($rowGetAds, $DEFINED_VALUE_SETS));

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



$quStrTypes = "SELECT * FROM TYPES WHERE TYPE=9";
$quTypes = mysqli_query($dbh, $quStrTypes) or die ("error, Types query failed,  dump aborted");
$quStrLocs = "SELECT * FROM LOC $locations_loc";
$quLocs = mysqli_query($dbh, $quStrLocs) or die ("error, Locs query faild, dunp aborted");



//Create loc specific pages //
$locHasAds = array ();

while ($rowTypes = mysqli_fetch_object($quTypes)) {
        $thisFileCount = 0;
	$quStrLocs = "SELECT * FROM LOC $locations_loc";
	$quLocs = mysqli_query($dbh, $quStrLocs) or die ("error, Locs query faild, dunp aborted");
	$locHasAds[$rowTypes->TYPE] = array();
	while ($rowLocs = mysqli_fetch_object($quLocs)) {
		$filename = "$liveDataDir$rowTypes->ALTNAME-$rowLocs->LOCNAME.htm";
		$dumpFile = fopen ($filename, 'w');


        	fwrite ($dumpFile, "\n\n");
		if (!$rowLocs->HTML_HEAD) {
			$html_head = $rowTypes->LOCHEAD;
    		fwrite ($dumpFile, "<!-- DATA DUMPED $now  -->\n");
		}else {
			$html_head = $rowLocs->HTML_HEAD;
    		fwrite ($dumpFile, "<!-- DATA DUMPED $now  -->\n");
		}
		fwrite ($dumpFile, "$html_head \n \n");
       		$quStrGetAds = "SELECT * FROM ((CLASS INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN USERS ON CLASS.UID=USERS.UID WHERE TYPE=$rowTypes->TYPE AND STATUS='ACT' AND LOC=$rowLocs->LOCID ORDER BY SPORDER ASC, RAND()";
		$quGetAds = mysqli_query($dbh, $quStrGetAds) or die("error,  locations query failed, dump aborted");
		$numGetAds = mysqli_num_rows($quGetAds);
		$locHasAds[$rowTypes->TYPE][$rowLocs->LOCID] = $numGetAds;
		//echo "$rowTypes->TYPE : $rowLocs->LOCID = $numGetAds <br>";
		while ($rowGetAds = mysqli_fetch_object($quGetAds)) {

			fwrite($dumpFile, format_ad($rowGetAds, $DEFINED_VALUE_SETS));
			
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




$quStrTypes = "SELECT * FROM TYPES WHERE TYPE = 9";
$quTypes = mysqli_query($dbh, $quStrTypes) or die ("error, Types query failed,  dump aborted");



//Create Type Index pages.//

while ($rowTypes = mysqli_fetch_object($quTypes)) {
        $thisFileCount = 0;
	$dumpFile = fopen ("$liveDataDir$rowTypes->FNAME.htm", 'w');
	$html_head = $rowTypes->HTML_HEAD;
	fwrite ($dumpFile, "$html_head \n \n");
	fwrite ($dumpFile, "<TABLE BORDER=\"6\" BORDERCOLOR=\"$rowTypes->BORDERCOLOR\" CELLPADDING=\"2\" BGCOLOR=\"$rowTypes->BGCOLOR\"><TR> \n");
	$colCount = 1;
	$quStrLocs = "SELECT * FROM LOC $locations_loc ORDER BY LOCNAME";
	$quLocs = mysqli_query($dbh, $quStrLocs) or die ("error, Locs query faild, dunp aborted");
	while ($rowLocs = mysqli_fetch_object($quLocs)) {
		$shitsplits = split (" ", "$rowLocs->LOCNAME");
		foreach ($shitsplits as $shitsplit) {
			$titleCased.= " ";
			$titleCased.= ucfirst(strtolower($shitsplit));
		}
		$thisLocHasAds = $locHasAds[$rowTypes->TYPE][$rowLocs->LOCID];
		if ($thisLocHasAds) {

//			$cell = "<TD width='200'><font size='-1'><a href=\"./$rowTypes->ALTNAME-$rowLocs->LOCNAME.htm\">$titleCased</a></font></TD> \n"; //

				if ($rowTypes->TYPE =="2") {

		$cell = "<TD width='200'><font size='-1'><a href=\"http://www.bostonapartments.com/cli-class.php?TYPE=$rowTypes->TYPE&LOC=$rowLocs->LOCNAME&template=ba-sales&sig=yes&usig=on&htype=ba-sales&tablewidth=830\">$titleCased</a></font></TD> \n"; 

				} elseif ($rowTypes->TYPE =="3") {

		$cell = "<TD width='200'><font size='-1'><a href=\"http://www.bostonapartments.com/cli-class.php?TYPE=$rowTypes->TYPE&LOC=$rowLocs->LOCNAME&template=ba-sales&sig=yes&usig=on&htype=bacomm&tablewidth=830\">$titleCased</a></font></TD> \n"; 

				} elseif ($rowTypes->TYPE =="4") {

		$cell = "<TD width='200'><font size='-1'><a href=\"http://www.bostonapartments.com/cli-class.php?TYPE=$rowTypes->TYPE&LOC=$rowLocs->LOCNAME&template=ba&sig=yes&usig=on&htype=bacomm&tablewidth=830\">$titleCased</a></font></TD> \n"; 

				} elseif ($rowTypes->TYPE =="10") {

		$cell = "<TD width='200'><font size='-1'><a href=\"http://www.bostonapartments.com/cli-class.php?TYPE=$rowTypes->TYPE&LOC=$rowLocs->LOCNAME&template=ba&sig=yes&usig=on&htype=ba-busop&tablewidth=830\">$titleCased</a></font></TD> \n"; 

				} elseif ($rowTypes->TYPE =="11") {

		$cell = "<TD width='200'><font size='-1'><a href=\"http://www.bostonapartments.com/cli-class.php?TYPE=$rowTypes->TYPE&LOC=$rowLocs->LOCNAME&template=ba&sig=yes&usig=on&htype=ba-seniorr&tablewidth=830\">$titleCased</a></font></TD> \n"; 

				} elseif ($rowTypes->TYPE =="12") {

		$cell = "<TD width='200'><font size='-1'><a href=\"http://www.bostonapartments.com/cli-class.php?TYPE=$rowTypes->TYPE&LOC=$rowLocs->LOCNAME&template=ba-sales&sig=yes&usig=on&htype=ba-seniors&tablewidth=830\">$titleCased</a></font></TD> \n"; 

				} elseif ($rowTypes->TYPE =="13") {

		$cell = "<TD width='200'><font size='-1'><a href=\"http://www.bostonapartments.com/cli-class.php?TYPE=$rowTypes->TYPE&LOC=$rowLocs->LOCNAME&template=ba-sales&sig=yes&usig=on&htype=ba-bankowned&tablewidth=830\">$titleCased</a></font></TD> \n"; 

				} else {

		$cell = "<TD width='200'><font size='-1'><a href=\"http://www.bostonapartments.com/cli-class.php?TYPE=$rowTypes->TYPE&LOC=$rowLocs->LOCNAME&template=ba&sig=yes&usig=on&htype=baapt&tablewidth=830\">$titleCased</a></font></TD> \n"; 
				}



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


//CREATE 2's for crappy cgi's



$quStrTypes = "SELECT * FROM TYPES WHERE TYPE =9 ";
$quTypes = mysqli_query($dbh, $quStrTypes) or die ("error, Types query failed,  dump aborted");

while ($rowTypes = mysqli_fetch_object($quTypes)) {
	//create file
	$filename = "$liveDataDir$rowTypes->FNAME" . "2.htm";
	$dumpFile = fopen ($filename, 'w');

	$quStrGetAds = "SELECT * FROM ((CLASS INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN USERS ON CLASS.UID=USERS.UID WHERE TYPE=$rowTypes->TYPE AND STATUS='ACT' $locations ORDER BY LOCNAME, SPORDER ASC, RAND()";
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
		
		fwrite($dumpFile, format_ad_2($rowGetAds, $DEFINED_VALUE_SETS));
		
		$thisFileCount++;


                if ($thisFileCount==$numGetAds) {
                	fwrite ($dumpFile, "<!-- $rowGetAds->LOCNAME END --> \n\n");
    			fwrite ($dumpFile, "<!-- DATA DUMPED $now  -->\n");
		}

        }
        mysqli_free_result($quGetAds);
	fclose ($dumpFile);
	$dumpFile ="";




/*  BAD MEMORY EATER -- THIS IS MOVED TO THE NEW FUNCTION format_ad_2() 

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
*/

}



fclose ($logFile);


echo "HTML Dump(s) completed successfully \n";
echo "View the Log for more details.";
?>





