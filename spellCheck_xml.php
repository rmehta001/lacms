<?php
session_start();
include ("./inc/local_info.php");
mysqli_select_db($dbh, $DBNAME);

$cid = $_GET['cid'];

$quStrGetListing = "select BODY from CLASS where CID='$cid' and CLI='$grid'";
$quGetListing = mysqli_query($dbh, $quStrGetListing) or die (mysqli_error($dbh));
$rowGetListing = mysqli_fetch_object($quGetListing);
$text = $rowGetListing->BODY;


$temptext= tempnam("/tmp", "spelltext");

if ($fd=fopen($temptext,"w")) {
        $textarray= explode("\n",$text);
        fwrite($fd,"!\n");
        foreach($textarray as $key=>$value) {
            // adding the carat to each line prevents the use of aspell commands within the text...
            fwrite($fd,"^$value\n");
            }
        fclose($fd);
}else {
	die ("can't open the temp file for writing.");
}


$aspellcommand= "cat $temptext | /usr/local/bin/aspell -a";
//die ($aspellcommand);
$return = shell_exec ($aspellcommand);

$returnlines = explode ("\n", $return);
foreach ($returnlines as $returnline) {
	$firstChar = substr ($returnline, 0,1);
	if ($firstChar == "&") {
		$num_misspellings++;
		$correction= explode(" ",$returnline);
  		$word = $correction[1];
		$near_misses = $correction[2];
		$offset_end = strpos ($correction[3], ":") -1;
		$offset_length = (strlen($correction[3]) - $offset_end);
		$offset = substr($correction[3], 0, $offset_length);
		$suggstart= strpos($returnline,":")+2;
  		$suggestions= substr($returnline,$suggstart);
		$suggestionarray= explode(", ",$suggestions);
		//put into a nice little array
		$misspellings[$num_misspellings]['word'] = $word;
		$misspellings[$num_misspellings]['near_misses'] = $near_misses;
		$misspellings[$num_misspellings]['offset'] = $offset;
		$misspellings[$num_misspellings]['suggestions'] = $suggestionarray;
	} else if ($firstChar == "#") {
		$num_misspellings++;
		$correction= explode(" ",$value);
		$word= $correction[1];
		$near_misses = $correction[2];
		$offset = $correction[3];
		$suggestionarray[0] = "No suggestions.";
		$misspellings[$num_misspellings]['word'] = $word;
		$misspellings[$num_misspellings]['near_misses'] = $near_misses;
		$misspellings[$num_misspellings]['offset'] = $offset;
		$misspellings[$num_misspellings]['suggestions'] = $suggestionarray;
	}
}

$output_xml = "<spellt>\n";
$output_xml .= "\t<info num_misspellings='$num_misspellings'/>\n";
$output_xml .= "\t<corrections>\n";
foreach ($misspellings as $misspelling) {
	$output_xml .= ("\t\t<correction word='" . $misspelling['word'] . "' near_misses='" . $misspelling['near_misses'] . "' offset='" . $misspelling['offset'] . "'>\n");
	$output_xml .= "\t\t\t<suggestions>\n";
	foreach ($misspelling['suggestions'] as $suggestion) {
		$output_xml .= "\t\t\t\t<suggestion word='$suggestion'/>\n";
	}
	$output_xml .= "\t\t\t</suggestions>\n";
	$output_xml .= "\t\t</correction>\n";
}
$output_xml .= "\t</corrections>\n";
$output_xml .= "</spellt>\n";

header ("Content-type: text/xml");
echo $output_xml;
?>