

<?php

$query = $_POST['query'];
$cat = $_POST['cat'];

$url="http://boston.craigslist.org/search/hhh?catAbb=hhh&query=$query";

$page = file_get_contents($url);



preg_match('/.*(.*).html.*/',$post_page1,$matches);


$matches_count = count($matches);


echo "M:".$matches_count;



$flagad1=$matches[1];
$flagad2=$matches[2];
$flagad3=$matches[3];
$flagad4=$matches[4];
$flagad5=$matches[5];
$flagad6=$matches[6];
$flagad7=$matches[7];
$flagad8=$matches[8];
$flagad9=$matches[9];
$flagad10=$matches[10];


$flagad11=$matches[11];
$flagad12=$matches[12];
$flagad13=$matches[13];
$flagad14=$matches[14];
$flagad15=$matches[15];
$flagad16=$matches[16];
$flagad17=$matches[17];
$flagad18=$matches[18];
$flagad19=$matches[19];
$flagad20=$matches[20];

$flagad21=$matches[21];
$flagad22=$matches[22];
$flagad23=$matches[23];
$flagad24=$matches[24];
$flagad25=$matches[25];
$flagad26=$matches[26];
$flagad27=$matches[27];
$flagad28=$matches[28];
$flagad29=$matches[29];
$flagad30=$matches[30];

$flagad31=$matches[31];
$flagad32=$matches[32];
$flagad33=$matches[33];
$flagad34=$matches[34];
$flagad35=$matches[35];
$flagad36=$matches[36];
$flagad37=$matches[37];
$flagad38=$matches[38];
$flagad39=$matches[39];
$flagad40=$matches[40];

$flagad41=$matches[41];
$flagad42=$matches[42];
$flagad43=$matches[43];
$flagad44=$matches[44];
$flagad45=$matches[45];
$flagad46=$matches[46];
$flagad47=$matches[47];
$flagad48=$matches[48];
$flagad49=$matches[49];
$flagad50=$matches[50];




$flagad51=$matches[51];
$flagad52=$matches[52];
$flagad53=$matches[53];
$flagad54=$matches[54];
$flagad55=$matches[55];
$flagad56=$matches[56];
$flagad57=$matches[57];
$flagad58=$matches[58];
$flagad59=$matches[59];
$flagad60=$matches[60];
$flagad61=$matches[61];
$flagad62=$matches[62];
$flagad63=$matches[63];
$flagad64=$matches[64];
$flagad65=$matches[65];
$flagad66=$matches[66];
$flagad67=$matches[67];
$flagad68=$matches[68];
$flagad69=$matches[69];
$flagad70=$matches[70];
$flagad71=$matches[71];
$flagad72=$matches[72];
$flagad73=$matches[73];
$flagad74=$matches[74];
$flagad75=$matches[75];
$flagad76=$matches[76];
$flagad77=$matches[77];
$flagad78=$matches[78];
$flagad79=$matches[79];
$flagad80=$matches[80];
$flagad81=$matches[81];
$flagad82=$matches[82];
$flagad83=$matches[83];
$flagad84=$matches[84];
$flagad85=$matches[85];
$flagad86=$matches[86];
$flagad87=$matches[87];
$flagad88=$matches[88];
$flagad89=$matches[89];
$flagad90=$matches[90];
$flagad91=$matches[91];
$flagad92=$matches[92];
$flagad93=$matches[93];
$flagad94=$matches[94];
$flagad95=$matches[95];
$flagad96=$matches[96];
$flagad97=$matches[97];
$flagad98=$matches[98];
$flagad99=$matches[99];
$flagad1000=$matches[100];







$url1="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad1";
$url2="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad2";
$url3="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad3";
$url4="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad4";
$url5="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad5";
$url6="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad6";
$url7="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad7";
$url8="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad8";
$url9="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad9";
$url10="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad10";

$url11="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad11";
$url12="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad12";
$url13="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad13";
$url14="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad14";
$url15="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad15";
$url16="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad16";
$url17="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad17";
$url18="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad18";
$url19="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad19";
$url20="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad20";

$url21="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad21";
$url22="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad22";
$url23="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad23";
$url24="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad24";
$url25="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad25";
$url26="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad26";
$url27="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad27";
$url28="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad28";
$url29="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad29";
$url30="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad30";


$url31="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad31";
$url32="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad32";
$url33="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad33";
$url34="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad34";
$url35="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad35";
$url36="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad36";
$url37="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad37";
$url38="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad38";
$url39="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad39";
$url40="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad40";

$url41="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad41";
$url42="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad42";
$url43="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad43";
$url44="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad44";
$url45="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad45";
$url46="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad46";
$url47="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad47";
$url48="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad48";
$url49="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad49";
$url50="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad50";



$url51="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad51";
$url52="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad52";
$url53="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad53";
$url54="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad54";
$url55="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad55";
$url56="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad56";
$url57="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad57";
$url58="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad58";
$url59="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad59";
$url60="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad60";
$url61="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad61";
$url62="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad62";
$url63="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad63";
$url64="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad64";
$url65="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad65";
$url66="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad66";
$url67="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad67";
$url68="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad68";
$url69="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad69";
$url70="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad70";
$url71="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad71";
$url72="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad72";
$url73="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad73";
$url74="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad74";
$url75="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad75";
$url76="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad76";
$url77="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad77";
$url78="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad78";
$url79="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad79";
$url80="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad80";
$url81="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad81";
$url82="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad82";
$url83="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad83";
$url84="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad84";
$url85="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad85";
$url86="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad86";
$url87="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad87";
$url88="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad88";
$url89="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad89";
$url90="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad90";
$url91="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad91";
$url92="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad92";
$url93="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad93";
$url94="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad94";
$url95="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad95";
$url96="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad96";
$url97="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad97";
$url98="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad98";
$url99="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad99";
$url100="https://post.craigslist.org/flag?flagCode=$cat&amp;postingID=$flagad100";







echo $page1;
// echo $page2;
// echo $page3;
// echo $page4;
// echo $page5;
// echo $page6;
// echo $page7;
// echo $page8;
// echo $page9;
// echo $page10;


echo  " <br>operation complete";

?>
