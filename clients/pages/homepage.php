<?php
include("./lacms/inc/global.php");
include("./lacms/inc/local_info.php");

$uid = $HTTP_GET_VARS['uid'];
$co = $HTTP_GET_VARS['cli'];
$ad = $HTTP_GET_VARS['ad'];
$sort = $HTTP_GET_VARS['sort'];

if(isset($_POST['agency']))
{
//        $agency_where="AND AGENCY_HEADERS=".$_POST['agency'];
        $agency=$_POST['agency'];
}
if(isset($HTTP_GET_VARS['agency']))
{
//        $agency_where="AND AGENCY_HEADERS=".$HTTP_GET_VARS['agency'];
        $agency=$HTTP_GET_VARS['agency'];
}

if(isset($HTTP_GET_VARS['usig']))
        { $usig="yes"; }
elseif(isset($_POST['usig']))
        { $usig="yes";}
else
        { $usig=""; }




// DB CONNECT //

mysqli_select_db($dbh, $DBNAME);


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

$quStrGetGr = "SELECT * FROM `GROUP` WHERE GRID=$co";
$quGetGr = mysqli_query($dbh, $quStrGetGr) or die ("can't get group");
$rowGetGr = mysqli_fetch_object($quGetGr);

if (!isset($ad)) {
	$quStrGetAd = "SELECT * FROM CLASS INNER JOIN LOC ON CLASS.LOC=LOC.LOCID LEFT JOIN USERS ON CLASS.UID=USERS.UID WHERE CLI=$co $agency_where";
}else {
	$quStrGetAd = "SELECT * FROM CLASS INNER JOIN LOC ON CLASS.LOC=LOC.LOCID LEFT JOIN USERS ON CLASS.UID=USERS.UID WHERE CID=$ad $agency_where";
}

$quGetAd = mysqli_query($dbh, $quStrGetAd) or die ("<br><CENTER><TABLE WIDTH=300 BGCOLOR=#FFFFFF CELLPADDING=0 CELLSPACING=0><TR><TD><IMG height=65 alt=Boston Apartments.com Logo src=https://www.BostonApartments.com/smlogo.gif width=300></TD></TR></TABLE><H3>Sorry, the listing requested no longer exists.<BR><P>You can <a href=javascript: history.go(-1)>click here</a> to go back to the previous page you were on<BR>or look at the up to date listings by clicking the Listing/Ads button below.</H3><A HREF=https://www.BostonApartments.com/listings.htm><IMG SRC=https://www.BostonApartments.com/listings.gif ALT=Listings BORDER=0 HEIGHT=50 WIDTH=160></A><A HREF=https://www.BostonApartments.com/around.htm><IMG SRC=https://www.BostonApartments.com/city.gif ALT=Around Boston BORDER=0 HEIGHT=50 WIDTH=160></A><A HREF=https://www.BostonApartments.com/info.htm><IMG SRC=https://www.BostonApartments.com/info.gif ALT=Info Center BORDER=0 HEIGHT=50 WIDTH=160></A><BR><A HREF=https://www.BostonApartments.com/roomates.htm><IMG SRC=https://www.BostonApartments.com/roomates.gif ALT=Roommates BORDER=0 HEIGHT=50 WIDTH=160></A><A HREF=https://www.BostonApartments.com/rentips.htm><IMG SRC=https://www.BostonApartments.com/tips.gif ALT=Renting Tips BORDER=0 HEIGHT=50 WIDTH=160></A><A HREF=https://www.BostonApartments.com/services.htm><IMG SRC=https://www.BostonApartments.com/services.gif ALT=Services BORDER=0 HEIGHT=50 WIDTH=160></A><BR><A HREF=https://www.BostonApartments.com/hotlinks.htm><IMG SRC=https://www.BostonApartments.com/hotlinks.gif ALT=Hotlinks & Internet Search BORDER=0 HEIGHT=50 WIDTH=160></A><A HREF=https://www.BostonApartments.com/disclaim.htm><IMG SRC=https://www.BostonApartments.com/disclaim.gif ALT=Disclaimer BORDER=0 HEIGHT=50 WIDTH=160></A><A HREF=mailto:webmaster@bostonapartments.com><IMG SRC=https://www.BostonApartments.com/email.gif ALT=Email BORDER=0 HEIGHT=50 WIDTH=160></A><BR><A HREF=https://www.BostonApartments.com/advert.htm><IMG SRC=https://www.BostonApartments.com/advert01.gif ALT=Advertising Rates BORDER=0 HEIGHT=50 WIDTH=160></a><A HREF=https://www.BostonApartments.com/editor.htm><IMG SRC=https://www.BostonApartments.com/editor1.gif ALT=Ask the Editor BORDER=0 HEIGHT=50 WIDTH=160></a><A HREF=https://www.BostonApartments.com/awards.htm><IMG SRC=https://www.BostonApartments.com/awards-button.gif HEIGHT=50 WIDTH=160 BORDER=0 ALT=Boston Apartments's Awards></A><BR><P><IMG SRC=https://www.BostonApartments.com/pinkbar.gif ALT=Boston Apartments Pink horizontal rule HEIGHT=9 WIDTH=597 BORDER=0><BR><P><B><I>&copy; Copyright 1995-<SCRIPT>
<!--var dt = new Date();
var y = dt.getYear();
if (y < 1000) y +=1900;
document.write(y);
// -->
</SCRIPT> Boston Apartments.com</I></B><SUP><FONT size=-1><I>sm</I></FONT></SUP> - <B>All rights reserved.</B><BR></CENTER></UL></BODY></HTML>");
$rowGetAd = mysqli_fetch_object($quGetAd);

if ($rowGetAd->MAP == 1 OR $rowGetAd->MAP == 6 OR $rowGetAd->MAP == 11) {

$address2 = "$rowGetAd->ZIP";
$mbta = "$rowGetAd->ZIP";

} elseif ($rowGetAd->MAP == 2 OR $rowGetAd->MAP == 7) {

$address2 = "$rowGetAd->STREET $rowGetAd->ZIP";
$mbta = "$rowGetAd->STREET+$rowGetAd->ZIP";

} elseif ($rowGetAd->MAP == 4 OR $rowGetAd->MAP == 9) {

$address2 = "$rowGetAd->xstreet $rowGetAd->ZIP";
$mbta = "$rowGetAd->xstreet+$rowGetAd->ZIP";

} elseif ($rowGetAd->MAP == 5 OR $rowGetAd->MAP == 10) {

$address2 = "$rowGetAd->STREET at $rowGetAd->xstreet $rowGetAd->ZIP";
$mbta = "$rowGetAd->STREET+at+$rowGetAd->xstreet $rowGetAd->ZIP";

} elseif ($rowGetAd->MAP == 3 OR $rowGetAd->MAP == 8) {

$address2 = "$rowGetAd->STREET_NUM $rowGetAd->STREET $rowGetAd->ZIP";
$mbta = "$rowGetAd->STREET_NUM+$rowGetAd->STREET+$rowGetAd->ZIP";

} else { $mbta = ""; $address2 = ""; }



//Determine proper heading and footing to use//
if ($ad) {

	if($rowGetAd->AGENCY_HEADERS)
	{                
		$agcyStr="SELECT * FROM AGENCIES WHERE AGENCY_ID=$rowGetAd->AGENCY_HEADERS AND GID=$co";
                $agcyGet=mysqli_query($dbh, $agcyStr);
                $agcy=mysqli_fetch_object($agcyGet);
                $aheading_1=$agcy->HEADER_1;
                $afooting_1=$agcy->FOOTER_1;
		$aheading_2=$agcy->HEADER_2;
		$afooting_2=$agcy->FOOTER_2;
		$agency_sig=$agcy->CUSTOM_SIGNATURE;
	}

	if ( $rowGetAd->TYPE == 1 && ($aheading_1 | $afooting_1) ) {
                $heading=$aheading_1;
                $footing=$afooting_1;
	}elseif ($rowGetAd->TYPE == 2 && ($aheading_2 | $afooting_2)) {
                $heading=$aheading_2;
                $footing=$afooting_2;
	}elseif ($rowGetAd->TYPE == 1 && $rowGetGr->TYPE1_HEAD) {
		$heading = $rowGetGr->TYPE1_HEAD;
		$footing = $rowGetGr->TYPE1_FOOT;
	}elseif ($rowGetAd->TYPE == 2 && $rowGetGr->TYPE2_HEAD) {
		$heading = $rowGetGr->TYPE2_HEAD;
		$footing = $rowGetGr->TYPE2_FOOT;
	}elseif ($rowGetAd->TYPE == 3 && $rowGetGr->TYPE3_HEAD) {
		$heading = $rowGetGr->TYPE3_HEAD;
		$footing = $rowGetGr->TYPE3_FOOT;
	}elseif ($rowGetAd->TYPE == 4 && $rowGetGr->TYPE4_HEAD) {
		$heading = $rowGetGr->TYPE4_HEAD;
		$footing = $rowGetGr->TYPE4_FOOT;
	}elseif ($rowGetAd->TYPE == 5 && $rowGetGr->TYPE5_HEAD) {
		$heading = $rowGetGr->TYPE5_HEAD;
		$footing = $rowGetGr->TYPE5_FOOT;
	}elseif ($rowGetAd->TYPE == 6 && $rowGetGr->TYPE6_HEAD) {
		$heading = $rowGetGr->TYPE6_HEAD;
		$footing = $rowGetGr->TYPE6_FOOT;
	}elseif ($rowGetAd->TYPE == 7 && $rowGetGr->TYPE7_HEAD) {
		$heading = $rowGetGr->TYPE7_HEAD;
		$footing = $rowGetGr->TYPE7_FOOT;
	}elseif ($rowGetAd->TYPE == 8 && $rowGetGr->TYPE8_HEAD) {
		$heading = $rowGetGr->TYPE8_HEAD;
		$footing = $rowGetGr->TYPE8_FOOT;
	}elseif ($rowGetAd->TYPE == 9 && $rowGetGr->TYPE9_HEAD) {
		$heading = $rowGetGr->TYPE9_HEAD;
		$footing = $rowGetGr->TYPE9_FOOT;
	}elseif ($rowGetAd->TYPE == 10 && $rowGetGr->TYPE10_HEAD) {
		$heading = $rowGetGr->TYPE10_HEAD;
		$footing = $rowGetGr->TYPE10_FOOT;
	}elseif ($rowGetAd->TYPE == 11 && $rowGetGr->TYPE11_HEAD) {
		$heading = $rowGetGr->TYPE11_HEAD;
		$footing = $rowGetGr->TYPE11_FOOT;
	}elseif ($rowGetAd->TYPE == 12 && $rowGetGr->TYPE12_HEAD) {
		$heading = $rowGetGr->TYPE12_HEAD;
		$footing = $rowGetGr->TYPE12_FOOT;
	}else {
		if ($rowGetGr->HEAD) {
			$heading = $rowGetGr->HEAD;
			$footing = $rowGetGr->FOOT;
		}else {
			$quStrGetBSTAPTSHeadFoot = "SELECT HEAD, FOOT FROM `GROUP` WHERE GRID=1";
			$quGetBSTAPTSHeadFoot = mysqli_query($dbh, $quStrGetBSTAPTSHeadFoot);
			$rowGetHeadFoot = mysqli_fetch_object($quGetBSTAPTSHeadFoot);
			$heading = $rowGetHeadFoot->HEAD;
			$footing = $rowGetHeadFoot->FOOT;
			$noHead = true;
		}
	}
}else {
        if ($agency) {
                $agcyStr="SELECT * FROM AGENCIES WHERE AGENCY_ID=$agency AND GID=$co";
                $agcyGet=mysqli_query($dbh, $agcyStr);
                $agcy=mysqli_fetch_object($agcyGet);
                $heading=$agcy->HEADER_1;
                $footing=$agcy->FOOTER_1;
		$agency_sig=$agcy->CUSTOM_SIGNATURE;

	}elseif ($rowGetGr->HEAD) {
		$heading = $rowGetGr->HEAD;
		$footing = $rowGetGr->FOOT;
	}else {
		$quStrGetBSTAPTSHeadFoot = "SELECT HEAD, FOOT FROM `GROUP` WHERE GRID=1";
		$quGetBSTAPTSHeadFoot = mysqli_query($dbh, $quStrGetBSTAPTSHeadFoot)or die (mysqli_error($dbh));
		$rowGetHeadFoot = mysqli_fetch_object($quGetBSTAPTSHeadFoot);
		$heading = $rowGetHeadFoot->HEAD;
		$footing = $rowGetHeadFoot->FOOT;
		$noHead = true;
	}
}	

echo "$heading";
if ($noHead) {

if ($agency) {
echo "<center><h3>$agency_sig</h3></CENTER>";
} else {
echo "<center><h3>$rowGetGr->SIG</h3></CENTER>";
}


}

		echo "<CENTER><TABLE WIDTH=575><TR><TD>";


if ($rowGetAd->STATUS == STO) {
echo "<center><h3><FONT COLOR=#FF0000>This listing is no longer being advertised.</FONT></h3></CENTER>";
}

echo "<CENTER>$address2</CENTER>";

//* GET AGENT BODY if uid
if(isset($HTTP_GET_VARS['uid'])) { 
$quStrGetAA = "SELECT BODY_AGENT FROM CLASS_AGENTS WHERE CID=$ad AND CLI=$co AND UID=$uid LIMIT 1";
$quGetAA = mysqli_query($dbh, $quStrGetAA);

while ($rowGetAA = mysqli_fetch_object($quGetAA)) {
$BA = $rowGetAA->BODY_AGENT ;
}}
if ($BA!="") {
echo $BA ;
}
//* GET AGENT BODY if uid END

elseif ($rowGetAd->BODY_ALT) {
echo $rowGetAd->BODY_ALT ;
} else {
		echo format_ad_homepage($rowGetAd, $DEFINED_VALUE_SETS);
}

		echo "</TD></TR></TABLE></CENTER>";


if ($rowGetAd->YOUTUBE) {
echo "<CENTER><P> $rowGetAd->YOUTUBE <BR></CENTER>";
}


if ($rowGetAd->PIC != 0) {

?>

<CENTER>
<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr> <td valign="top" align="center">
<!-- <hr size="1" noshade style="border-top: 1px solid #BDBCAB;"> --><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr align="center" valign="top">
<CENTER><TABLE BORDER="0">

<?php

$i = 0;

mysqli_data_seek ($quGetAd, 0);
$rowGetAd = "";
while ($rowGetAd = mysqli_fetch_object($quGetAd)) {
		if (isset($ad)) {
			$quStrGetPics = "SELECT * FROM PICTURE WHERE CID=$ad ORDER BY PICORDER, PID";
			$quGetPics = mysqli_query($dbh, $quStrGetPics);

$num_pics = mysqli_num_rows($quGetPics);





		while ($rowGetPics = mysqli_fetch_object ($quGetPics)) {

$i++;

if ($i%2){
echo "<tr align=\"center\" valign=\"top\"><td height=\"262\"><div align=\"center\" style=\"padding-left: 2px; padding-right: 2px; padding-top: 2px; padding-bottom: 2px;\">";
}
if (!($i%2)) {
echo "</TD><td height=\"262\"><div align=\"center\" style=\"padding-left: 2px; padding-right: 2px; padding-top: 2px; padding-bottom: 2px;\">";
}


list($width, $height, $type, $attr) = getimagesize("https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT");

if ($height >="262") {
				echo "<CENTER>

<A HREF='https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT' target='_bigpic'><img src='https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT' alt='$rowGetPics->DESCRIPT' HEIGHT='262' BORDER=0></A></CENTER>";
} else {
				echo "<CENTER><A HREF='https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT' target='_bigpic'><img src='https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT' alt='$rowGetPics->DESCRIPT' BORDER=0></A></CENTER>";
}
}
}
}

echo "</TD></TR></TABLE>";

//if (($rowGetGr->PIC_CUSTOM_WIDTH) OR ($rowGetGr->PIC_CUSTOM_HEIGHT)) {
echo "<FONT SIZE=\"-2\">Click any picture to enlarge it.<BR><BR></FONT>";
// }

echo "</CENTER>";
}





if ($mbta =="") { $foo="bar"; } 
else  {
echo "<P><CENTER><A HREF=\"http://www.mbta.com/rider_tools/servicenearby/?saServiceNearBy=$mbta&sLocationServiceNearBy=&selectedPoint=&Hour=1&Minute=50&M=PM\" target=\"_MBTA\">Click for a map of nearby Public Transportation</A></CENTER>";


?>

<!-- GOOGLE MAP INSERT SECTION -->
<?php
//Set up our variables
$longitude = "";
$latitude = "";
$precision = "";

//Three parts to the querystring: q is address, output is the format (
$key = "ABQIAAAAbOGSq7X62Ltt4DjKFTyJKxQv5E0jSDRFMKL1geOCPao0Skb1sBT-YUhlDREVhEFMb1tWYc_sqi2IVQ";

$address = urlencode("$address2");
$url = "http://maps.google.com/maps/geo?q=".$address."&output=csv&key=".$key;
 
$ch = curl_init();
 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER,0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$data = curl_exec($ch);
curl_close($ch);

// echo "Data: ". $data."<br>";
//Check our Response code to ensure success
if (substr($data,0,3) == "200")
{
$data = explode(",",$data);

$precision = $data[1];
$latitude = $data[2];
$longitude = $data[3];

// echo "Latutide: ".$latitude."<br>";
// echo "Longitude: ".$longitude."<br>";

echo "<CENTER>$address2<BR>";
?>


<TABLE BGCOLOR="#000000" WIDTH="566" BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD><CENTER>

<iframe style="width:565px;height:475px;padding:0;border:solid 1px black" src="http://data.mapchannels.com/mm/dual2/map.htm?x=<?php echo $longitude ;?>&y=<?php echo $latitude ;?>&z=16&gm=0&ve=3&gc=0&xb=<?php echo $longitude ;?>&yb=<?php echo $latitude ;?>&zb=1&db=0&bar=1&mw=1&sv=1&svb=0" marginwidth="0" marginheight="0" frameborder="0" scrolling="no"></iframe>




<TABLE BGCOLOR="#000000" WIDTH="565" BORDER="0" CELLPADDING="0"><TABLE BGCOLOR="#000000" WIDTH="566" BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD><CENTER>
<IFRAME SRC="http://bostonapartments.com/gmap?longitude=<?php echo $longitude ;?>&latitude=<?php echo $latitude ;?>" HEIGHT="220" WIDTH="540" BORDER="0" MARGINWIDTH="0" MARGINHEIGHT="0" SCROLLING="no">
Sorry, your browser does not support IFrames and the map is not displaying.
</IFRAME></CENTER></TD></TR></TABLE>
</CENTER></TD></TR></TABLE>


<?php

}
}

// else { echo "Error in geocoding! $address2 Http error ".substr($data,0,3); }
// no map display on error and no error display

?>
<!-- END MAP INSERT SECTION -->


<?php

// if ($agency_sig!="") {
// echo "<BR><center><B>$agency_sig</B></CENTER>";
// } else {
// echo "<BR><center><B>$rowGetGr->SIG</B></CENTER>";
// }


echo $footing;

?>