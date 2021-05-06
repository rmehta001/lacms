<?php
include ("../inc/local_info.php");
mysqli_select_db($dbh, $DBNAME);

$cid = $_GET['cid'];

$pspell_link = pspell_new ("en", "", "", "", (PSPELL_FAST|PSPELL_RUN_TOGETHER));
//$pspell_link = pspell_config_create("en_US");


$quStrGetAd = "select BODY from CLASS where CID='$cid'";
$quGetAd = mysqli_query($dbh, $quStrGetAd) or die (mysqli_error($dbh));
$rowGetAd = mysqli_fetch_object($quGetAd);
$words = split (" ", $rowGetAd->BODY);
foreach ($words as $word) {
	$correct = pspell_check($pspell_link, $word);
	if (!$correct) {
		$num_misspellings++;
		$misspellings[$num_misspellings]['word'] = $word;
		$misspellings[$num_misspellings]['suggestions'] = pspell_suggest($pspell_link, $word);
	}
}
$output_xml = "<spellt>\n";
$output_xml .= "<info num_misspellings='$num_misspellings'/>\n";
$output_xml .= "<misspellings> \n";
foreach ($misspellings as $misspelling) {
	$output_xml .= ("<missplelling word='" . $misspelling['word'] . "'> \n");
	$output_xml .= "<suggestions> \n";
	foreach ($misspelling['suggestions'] as $suggestion) {
		$output_xml .= "<suggestion word='$suggestion'>\n";
	}
	$output_xml .= "</suggestions> \n";
	$output_xml .= "</missplelling> \n";
}
$output_xml .= "</misspellings> \n";
$output_xml .= "</spellt>\n";

header ("Content-type: text/xml");
echo $output_xml;
?>