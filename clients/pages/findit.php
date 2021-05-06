<!--BEGIN findit -->
<?php
if ($_SESSION["pref_coltit"]=="") {
$coltitcolor="#3DB1FF";
} else {
$coltitcolor=$_SESSION["pref_coltit"];
}

$findit = trim($_POST['findit'] ?? "");

$findit2 = trim($_GET['findit'] ?? "");


if ($findit=="" and $findit2!="") { $findit = $findit2; } else { $findit = trim($_POST['findit'] ?? ""); }

$SNUM = "$findit";
$SN = explode(" ", $SNUM);
if (count($SN) == 1) {
    array_push($SN, "");
}



?>


	<br>



	<table width="750" border="1" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF"><tr><TD>
<CENTER><NOBR><B>SEARCH RESULTS <?php 



if ($findit!="") {echo "FOR \"$findit\"";}
?></B></NOBR>
</CENTER>
</TD></tr></TABLE>

	<br>

<?php




if ($findit=="" and $findit2=="") {echo "<BR><B><FONT COLOR=#FF0000>Nothing entered.</FONT><BR><BR> Please enter a term to search for.</B></FONT><BR><BR>";} else {

if (($findit=="") and ($findit2!="")) { $findit = $findit2; }



echo "<TABLE BGCOLOR=#FFFFFF CELLPADDING=5 BORDER=1 BORDERCOLOR=#000000><TR><TD>


Matching Clients:<BR>";



$qustrgetclient = "SELECT * FROM CLIENTS WHERE (GRID=$grid AND ((NAME_FIRST LIKE \"%$findit%\") OR (NAME_LAST LIKE \"%$findit%\") OR (HOME_PHONE LIKE \"%$findit%\") OR (WORK_PHONE LIKE \"%$findit%\") OR (MOBILE_PHONE LIKE \"%$findit%\") OR (FAX LIKE \"%$findit%\") OR (CLIENT_EMAIL LIKE \"%$findit%\") OR (CURCITY LIKE \"%$findit%\") OR (CURSTATE LIKE \"%$findit%\") OR (CURZIP LIKE \"$findit%\") OR (CURREMPLOY LIKE \"%$findit%\") OR (CURREMPLOYADDRESS LIKE \"%$findit%\") OR (CURREMPLOYPHONE LIKE \"%$findit%\") OR (CURREMPLOYCONTACT LIKE \"%$findit%\") OR (CURREMPLOYPOS LIKE \"%$findit%\") OR (PREVEMPLOY LIKE \"%$findit%\") OR (PREVEMPLOYADDRESS LIKE \"%$findit%\") OR (PREVEMPLOYPHONE LIKE \"%$findit%\") OR (PREVEMPLOYCONTACT LIKE \"%$findit%\") OR (PREVEMPLOYPOS LIKE \"%$findit%\") OR (CURRLL LIKE \"%$findit%\") OR (CURRLLADDRESS LIKE \"%$findit%\") OR (CURRLLPHONE LIKE \"%$findit%\") OR (PREVLL LIKE \"%$findit%\") OR (PREVLLADDRESS LIKE \"%$findit%\") OR (PREVLLPHONE LIKE \"%	$findit%\") OR (CREDITREF LIKE \"%$findit%\") OR (PERSREFCONTACT LIKE \"%$findit%\")))";
$qugetclient = mysqli_query($GLOBALS['dbh'], $qustrgetclient) or die ("No clients match");
$rowgetclient = mysqli_fetch_object($qugetclient);

if (@ mysqli_data_seek ($qugetclient, 0)) {

mysqli_data_seek ($qugetclient, 0);
$rowgetclient = "";


echo "<TABLE CELLPADDING=0 CELLSPACING=0>";

while ($rowgetclient = mysqli_fetch_object($qugetclient)) {


$qustrgetname = "SELECT `HANDLE` FROM `USERS` WHERE `GROUP`='$grid' AND `UID`='$rowgetclient->UID' LIMIT 1";
$qugetname = mysqli_query($dbh, $qustrgetname);
$rowgetname = mysqli_fetch_object($qugetname);




if (($rowgetclient->UID == $uid) OR ($rowgetclient->PUBLIC=="1") OR ($rowgetclient->SHARE_WITH=="$uid") OR ($rowgetclient->SHARE_WITH=="$uid") OR ($_SESSION["isAdmin"]) OR ($user_level >= "4"))  {

echo "<TR><TD><div class=\"ad\"><a href=\"$PHP_SELF?op=editClient&clid=$rowgetclient->CLID\" target=\"_$rowgetclient->CLID\"><img border=\"0\" vspace=\"0\" hspace=\"0\" src=\"../images/icons/edit.gif\"></a></DIV></TD>";

} else {

echo "<TR><TD><div class=\"ad\">&nbsp; </DIV></TD>";

}

echo "<TD>&nbsp;&nbsp;<TD><div class=\"ad\">";


echo "</TD><TD><div class=\"ad\"><NOBR>";

if ($rowgetclient->STATUS_CLIENT=="2"){ echo "<FONT COLOR=GRAY>";}

echo $rowgetclient->NAME_FIRST . "&nbsp;" . $rowgetclient->NAME_LAST . " &nbsp;</NOBR></DIV>";

if ($rowgetclient->STATUS_CLIENT=="2"){ echo "</FONT>";}

echo "</TD><TD><div class=\"ad\"><NOBR>";

if ($rowgetclient->STATUS_CLIENT=="2"){ echo "<FONT COLOR=GRAY>";}

echo " | " . ($rowgetname->HANDLE ?? "Name Unknown") ." &nbsp;</DIV>";
if ($rowgetclient->STATUS_CLIENT=="2"){ echo "</FONT>";}
echo "</NOBR></TD><TD><div class=\"ad\"><NOBR>";





if ($rowgetclient->STATUS_CLIENT=="2"){ echo "<FONT COLOR=GRAY>";}

if ($rowgetclient->SHARE_WITH){

$qustrgetshare = "SELECT `HANDLE` FROM `USERS` WHERE `GROUP`='$grid' AND `UID`='$rowgetclient->SHARE_WITH' LIMIT 1";
@ $qugetshare = mysqli_query($GLOBALS['dbh'], $qustrgetshare);
$rowgetshare = mysqli_fetch_object($qugetshare);

echo "/ ".$rowgetshare->HANDLE;

}


if ($rowgetclient->STATUS_CLIENT=="2"){ echo "</FONT>";}


echo "</DIV></NOBR></TD><TD><div class=\"ad\"><NOBR>";




if ($rowgetclient->STATUS_CLIENT=="2"){ echo "<FONT COLOR=GRAY>";}
echo "<NOBR> | Next Contact: " . $rowgetclient->DATE_NEXT_CONTACT ;
if ($rowgetclient->STATUS_CLIENT=="2"){ echo "</FONT>";}
echo "</NOBR></TD><TD><div class=\"ad\">";
if ($rowgetclient->STATUS_CLIENT=="2"){ echo "<FONT COLOR=GRAY>";}
echo "<NOBR>&nbsp; | Last Mod: " . $rowgetclient->DATE_MODIFIED ;

if ($rowgetclient->STATUS_CLIENT=="2"){ echo "&nbsp;&nbsp;&nbsp; Inactive Client</FONT>";}

echo  "</NOBR></DIV><TD><div class=\"ad\"><NOBR>&nbsp; Match: <B><FONT COLOR=\"GREEN\">";


if (stripos($rowgetclient->NAME_FIRST, "$findit")!== false) {
    echo " First: $rowgetclient->NAME_FIRST";
}

if (stripos($rowgetclient->NAME_LAST, "$findit")!== false) {
    echo " Last: $rowgetclient->NAME_LAST";
}

if (stripos($rowgetclient->HOME_PHONE, $findit)!== false) {
    echo " Home: $rowgetclient->HOME_PHONE";
}

if (stripos($rowgetclient->WORK_PHONE, "$findit")!== false) {
    echo " Work: $rowgetclient->WORK_PHONE";
}

if (stripos($rowgetclient->MOBILE_PHONE, "$findit")!== false) {
    echo " Cell: $rowgetclient->MOBILE_PHONE";
}

if (stripos($rowgetclient->FAX, "$findit")!== false) {
    echo " Fax: $rowgetclient->FAX";
}

if (stripos($rowgetclient->CLIENT_EMAIL, "$findit")!== false) {
    echo " Email: $rowgetclient->CLIENT_EMAIL";
}

if (stripos($rowgetclient->CURCITY, "$findit")!== false) {
    echo " Current City: $rowgetclient->CURCITY";
}

if (stripos($rowgetclient->CURSTATE, "$findit")!== false) {
    echo " Current State: $rowgetclient->CURSTATE";
}

if (stripos($rowgetclient->CURZIP, "$findit")!== false) {
    echo " Current Zip: $rowgetclient->CURZIP";
}

if (stripos($rowgetclient->CURREMPLOY, "$findit")!== false) {
    echo " Current ER: $rowgetclient->CURREMPLOY";
}

if (stripos($rowgetclient->CURREMPLOYADDRESS, "$findit")!== false) {
    echo " Current ER Address: $rowgetclient->CURREMPLOYADDRESS";
}

if (stripos($rowgetclient->CURREMPLOYPHONE, "$findit")!== false) {
    echo " Current ER Phone: $rowgetclient->CURREMPLOYPHONE";
}

if (stripos($rowgetclient->CURREMPLOYCONTACT, "$findit")!== false) {
    echo " Current ER Contact: $rowgetclient->CURREMPLOYCONTACT";
}

if (stripos($rowgetclient->CURREMPLOYPOS, "$findit")!== false) {
    echo " Current Position: $rowgetclient->CURREMPLOYPOS";
}

if (stripos($rowgetclient->PREVEMPLOY, "$findit")!== false) {
    echo " Prev. Employ: $rowgetclient->PREVEMPLOY";
}

if (stripos($rowgetclient->PREVEMPLOYADDRESS, "$findit")!== false) {
    echo " Prev. Employ Address: $rowgetclient->PREVEMPLOYADDRESS";
}

if (stripos($rowgetclient->PREVEMPLOYPHONE, "$findit")!== false) {
    echo " Prev. Employ Phone: $rowgetclient->PREVEMPLOYPHONE";
}

if (stripos($rowgetclient->PREVEMPLOYCONTACT, "$findit")!== false) {
    echo " Prev. Employ Contact: $rowgetclient->PREVEMPLOYCONTACT";
}

if (stripos($rowgetclient->PREVEMPLOYPOS, "$findit")!== false) {
    echo " Prev. Employ Position: $rowgetclient->PREVEMPLOYPOS";
}

if (stripos($rowgetclient->CURRLL, "$findit") ) {
    echo " Current LL: $rowgetclient->CURRLL";
}

if (stripos($rowgetclient->CURRLLADDRESS, "$findit")!== false) {
    echo " Current LL Address: $rowgetclient->CURRLLADDRESS";
}

if (stripos($rowgetclient->CURRLLPHONE, "$findit")!== false) {
    echo " Current LL Phone: $rowgetclient->CURRLLPHONE";
}

if (stripos($rowgetclient->PREVLL, "$findit")!== false) {
    echo " Previous LL: $rowgetclient->PREVLL";
}

if (stripos($rowgetclient->PREVLLADDRESS, "$findit")!== false) {
    echo " Previous LL Address: $rowgetclient->PREVLLADDRESS";
}

if (stripos($rowgetclient->PREVLLPHONE, "$findit")!== false) {
    echo " Previous LL Phone: $rowgetclient->PREVLLPHONE";
}

if (stripos($rowgetclient->CREDITREF, "$findit")!== false) {
    echo " Credit Ref.: $rowgetclient->CREDITREF";
}

if (stripos($rowgetclient->PERSREFCONTACT, "$findit")!== false) {
    echo " Presonal Ref.: $rowgetclient->PERSREFCONTACT";
}


echo "</FONT></B></DIV></TD></TR>";

}

echo  "</TABLE>";

} else {echo "<CENTER><P><FONT COLOR=RED>No Clients match the search \"".$findit."\".<BR><P></CENTER></FONT>";}


echo "<HR width='100%'> ";

echo "Matching Landlords:<BR>";


$qustrgetll = "SELECT * FROM LANDLORD WHERE (((SHORT_NAME LIKE \"%$findit%\") OR (HOME_NAME_FIRST LIKE \"%$findit%\") OR (HOME_NAME_LAST LIKE \"%$findit%\") OR (CAREOF LIKE \"%$findit%\") OR (HOME_SPOUSE_FIRST LIKE \"%$findit%\") OR (HOME_SPOUSE_LAST LIKE \"%$findit%\") OR (HOME_STREET LIKE \"%$findit%\") OR (HOME_STREET2 LIKE \"%$findit%\") OR (HOME_CITY LIKE \"%$findit%\") OR (HOME_STATE LIKE \"%$findit%\") OR (HOME_ZIP LIKE \"%$findit%\") OR (HOME_PHONE LIKE \"%$findit%\") OR (HOME_FAX LIKE \"%$findit%\") OR (SPOUSE_CELL LIKE \"%$findit%\") OR (SPOUSE_OFFICE LIKE \"%$findit%\") OR (SPOUSE_EMAIL LIKE \"%$findit%\") OR (OFF_NAME LIKE \"%$findit%\") OR (OFF_STREET LIKE \"%$findit%\") OR (OFF_STREET2 LIKE \"%$findit%\") OR (OFF_CITY LIKE \"%$findit%\") OR (OFF_STATE LIKE \"%$findit%\") OR (OFF_ZIP LIKE \"%$findit%\") OR (OFF_PHONE LIKE \"%$findit%\") OR (OFF_FAX LIKE \"%$findit%\") OR (OFF_EMAIL LIKE \"%$findit%\") OR (OFF_WEBSITE LIKE \"%$findit%\") OR (OFF_WEBLISTINGS LIKE \"%$findit%\") OR (ADDENDUM LIKE \"%$findit%\") OR (LLNOTES LIKE \"%$findit%\") OR (PETS LIKE \"%$findit%\") OR (SUPER_NAME LIKE \"%$findit%\") OR (SUPER_PHONE LIKE \"%$findit%\") OR (LL_EMAIL LIKE \"%$findit%\") OR (MOBILE_PHONE LIKE \"%$findit%\")))";
//	$qustrgetll = "SELECT * FROM LANDLORD WHERE (GRID=$grid AND ((SHORT_NAME LIKE \"%$findit%\") OR (HOME_NAME_FIRST LIKE \"%$findit%\") OR (HOME_NAME_LAST LIKE \"%$findit%\") OR (CAREOF LIKE \"%$findit%\") OR (HOME_SPOUSE_FIRST LIKE \"%$findit%\") OR (HOME_SPOUSE_LAST LIKE \"%$findit%\") OR (HOME_STREET LIKE \"%$findit%\") OR (HOME_STREET2 LIKE \"%$findit%\") OR (HOME_CITY LIKE \"%$findit%\") OR (HOME_STATE LIKE \"%$findit%\") OR (HOME_ZIP LIKE \"%$findit%\") OR (HOME_PHONE LIKE \"%$findit%\") OR (HOME_FAX LIKE \"%$findit%\") OR (SPOUSE_CELL LIKE \"%$findit%\") OR (SPOUSE_OFFICE LIKE \"%$findit%\") OR (SPOUSE_EMAIL LIKE \"%$findit%\") OR (OFF_NAME LIKE \"%$findit%\") OR (OFF_STREET LIKE \"%$findit%\") OR (OFF_STREET2 LIKE \"%$findit%\") OR (OFF_CITY LIKE \"%$findit%\") OR (OFF_STATE LIKE \"%$findit%\") OR (OFF_ZIP LIKE \"%$findit%\") OR (OFF_PHONE LIKE \"%$findit%\") OR (OFF_FAX LIKE \"%$findit%\") OR (OFF_EMAIL LIKE \"%$findit%\") OR (OFF_WEBSITE LIKE \"%$findit%\") OR (OFF_WEBLISTINGS LIKE \"%$findit%\") OR (ADDENDUM LIKE \"%$findit%\") OR (LLNOTES LIKE \"%$findit%\") OR (PETS LIKE \"%$findit%\") OR (SUPER_NAME LIKE \"%$findit%\") OR (SUPER_PHONE LIKE \"%$findit%\") OR (LL_EMAIL LIKE \"%$findit%\") OR (MOBILE_PHONE LIKE \"%$findit%\")))";

$qugetll = mysqli_query($GLOBALS['dbh'], $qustrgetll) or die ("<FONT COLOR=#FF0000>No Landlords match \"$findit\"</FONT>");
$rowgetll = mysqli_fetch_object($qugetll);

if (@ mysqli_data_seek ($qugetll, 0)) {

mysqli_data_seek ($qugetll, 0);
$rowgetll = "";

echo "<TABLE CELLPADDING=0 CELLSPACING=0>";

while ($rowgetll = mysqli_fetch_object($qugetll)) {


echo "<TR><TD><div class=\"ad\"><a href=\"$PHP_SELF?op=editLandlord&lid=$rowgetll->LID\" target=\"_$rowgetll->LID\"><img border=\"0\" vspace=\"0\" hspace=\"0\" src=\"../images/icons/edit.gif\"></a> &nbsp;</DIV></TD>


<TD VALIGN=\"bottom\"><div class=\"ad\">"?>
<form action="<?php echo "$PHP_SELF";?>?op=listings&listing_filter_display=none&activeFilter=n&vid=7&sortD=ASC&sort=STREET,%20STREET_NUM,%20APT" method="POST" target="_NEW">
<input type="hidden" name="filterChange" value="1">
<input type="hidden" name="landlord" value="<?php echo $rowgetll->LID;?>">
<input type="image" src="../assets/images/listings.gif" name="listings" border='0' vspace='0' hspace='0' TITLE="View ALL <?php echo "$rowgetll->SHORT_NAME";?> Listings">

</DIV>
</td>
</form>


<?php echo "
<TD WIDTH=\"150\"><div class=\"ad\">$rowgetll->SHORT_NAME</DIV></TD><TD>&nbsp</TD><TD WIDTH=\"100\"><div class=\"ad\">$rowgetll->HOME_NAME_FIRST</DIV></TD><TD WIDTH=\"100\"><div class=\"ad\">$rowgetll->HOME_NAME_LAST</DIV></TD><TD WIDTH=\"100\"><div class=\"ad\">$rowgetll->OFF_NAME</DIV></TD>

<TD><div class=\"ad\"><NOBR>&nbsp; Match: <B><FONT COLOR=\"GREEN\">";


if (stripos($rowgetll->SHORT_NAME, "$findit")!== false) {
    echo " S. Name: $rowgetll->SHORT_NAME";
}

if (stripos($rowgetll->HOME_NAME_FIRST, "$findit")!== false) {
    echo " Owner F Name: $rowgetll->HOME_NAME_FIRST";
}

if (stripos($rowgetll->HOME_NAME_LAST, "$findit")!== false) {
    echo " Owner L Name: $rowgetll->HOME_NAME_LAST";
}

if (stripos($rowgetll->HOME_SPOUSE_FIRST, "$findit")!== false) {
    echo " Spouse F Name: $rowgetll->HOME_SPOUSE_FIRST";
}

if (stripos($rowgetll->HOME_SPOUSE_LAST, "$findit")!== false) {
    echo " Spouse L Name: $rowgetll->HOME_SPOUSE_LAST";
}

if (stripos($rowgetll->HOME_STREET, "$findit")!== false) {
    echo " Home St.: $rowgetll->HOME_STREET";
}

if (stripos($rowgetll->HOME_STREET2, "$findit")!== false) {
    echo " Home St.: $rowgetll->HOME_STREET2";
}

if (stripos($rowgetll->HOME_CITY, "$findit")!== false) {
    echo " Home City: $rowgetll->HOME_CITY";
}

if (stripos($rowgetll->HOME_STATE, "$findit")!== false) {
    echo " Home State: $rowgetll->HOME_STATE";
}

if (stripos($rowgetll->HOME_ZIP, "$findit")!== false) {
    echo " Home Zip: $rowgetll->HOME_ZIP";
}

if (stripos($rowgetll->HOME_PHONE, "$findit")!== false) {
    echo " Home Phone: $rowgetll->HOME_PHONE";
}

if (stripos($rowgetll->CAREOF, "$findit")!== false) {
    echo " Care of: $rowgetll->CAREOF";
}

if (stripos($rowgetll->HOME_FAX, "$findit")!== false) {
    echo " Home Fax: $rowgetll->HOME_FAX";
}

if (stripos($rowgetll->SPOUSE_CELL, "$findit")!== false) {
    echo " Spouse Cell: $rowgetll->SPOUSE_CELL";
}

if (stripos($rowgetll->SPOUSE_OFFICE, "$findit")!== false) {
    echo " Spouse Off.: $rowgetll->SPOUSE_OFFICE";
}

if (stripos($rowgetll->SPOUSE_EMAIL, "$findit")!== false) {
    echo " Spouse Email: $rowgetll->SPOUSE_EMAIL";
}

if (stripos($rowgetll->OFF_NAME, "$findit")!== false) {
    echo " Office: $rowgetll->OFF_NAME";
}

if (stripos($rowgetll->OFF_STREET, "$findit")!== false) {
    echo " Office St.: $rowgetll->OFF_STREET";
}

if (stripos($rowgetll->OFF_STREET2, "$findit")!== false) {
    echo " Office St.: $rowgetll->OFF_STREET2";
}

if (stripos($rowgetll->OFF_CITY, "$findit")!== false) {
    echo " Office City: $rowgetll->OFF_CITY";
}

if (stripos($rowgetll->OFF_STATE, "$findit")!== false) {
    echo " Office State: $rowgetll->OFF_STATE";
}

if (stripos($rowgetll->OFF_ZIP, "$findit")!== false) {
    echo " Office ZIP: $rowgetll->OFF_ZIP";
}

if (stripos($rowgetll->OFF_PHONE, "$findit")!== false) {
    echo " Office Phone: $rowgetll->OFF_PHONE";
}

if (stripos($rowgetll->OFF_FAX, "$findit")!== false) {
    echo " Office Fax: $rowgetll->OFF_FAX";
}

if (stripos($rowgetll->OFF_WEBSITE, "$findit")!== false) {
    echo " Office Website: $rowgetll->OFF_WEBSITE";
}

if (stripos($rowgetll->OFF_WEBLISTINGS, "$findit")!== false) {
    echo " Web Listings: $rowgetll->OFF_WEBLISTINGS";
}

if (stripos($rowgetll->ADDENDUM, "$findit")!== false) {
    echo " Addendum: $rowgetll->ADDENDUM";
}

if (stripos($rowgetll->LLNOTES, "$findit")!== false) {
    echo " LL Notes: $rowgetll->LLNOTES";
}

if (stripos($rowgetll->PETS, "$findit")!== false) {
    echo " Pets: $rowgetll->PETS";
}


if (stripos($rowgetll->SUPER_NAME, "$findit")!== false) {
    echo " Super: $rowgetll->SUPER_NAME";
}


if (stripos($rowgetll->SUPER_PHONE, "$findit")!== false) {
    echo " Super Phone: $rowgetll->SUPER_PHONE";
}


if (stripos($rowgetll->LL_EMAIL, "$findit")!== false) {
    echo " LL Email: $rowgetll->LL_EMAIL";
}


if (stripos($rowgetll->MOBILE_PHONE, "$findit")!== false) {
    echo " Cell: $rowgetll->MOBILE_PHONE";
}



echo "</FONT></B></TD></TR>";

}

echo "</TABLE>";


} else {echo "<CENTER><P><FONT COLOR=RED>No Landlords match the search \"".$findit."\".<BR><P></CENTER></FONT>";}


echo "<HR width='100%'> ";




echo "Matching Listings/Ads:<BR>";


$qustrgetnomls = "SELECT `SOURCEPREFQUICK` FROM `USERS` WHERE `GROUP`='Matching Landlords' AND `UID`='$uid' LIMIT 1";
$qugetnomls = mysqli_query($GLOBALS['dbh'], $qustrgetnomls);
$rowgetnomls = mysqli_fetch_object($qugetnomls);

if (isset($rowgetnomls) && $rowgetnomls->SOURCEPREFQUICK == 'NOMLS') {

$qustrgetclass = "SELECT * FROM CLASS WHERE ((CLI=$grid) AND ((CID LIKE \"$findit%\") OR (BODY LIKE \"%$findit%\") OR (BODY_ALT LIKE \"%$findit%\") OR (STREET_NUM LIKE \"%$findit%\") OR ((STREET_NUM LIKE \"%$SN[0]\") AND (STREET LIKE \"$SN[1]%\")) OR (STREET LIKE \"%$findit%\") OR (APT LIKE \"%$findit%\") OR (FLOOR LIKE \"%$findit%\") OR (CITY LIKE \"%$findit%\") OR (STATE LIKE \"%$findit%\") OR (ZIP LIKE \"%$findit%\") OR (BUILDING_NAME LIKE \"%$findit%\") OR (MODBY LIKE \"%$findit%\") OR (YOUTUBE LIKE \"%$findit%\") OR (YOUTUBEURL LIKE \"%$findit%\") OR (ZONING LIKE \"%$findit%\") OR (COUNTY LIKE \"%$findit%\") OR (SCHOOL_DISTRICT LIKE \"%$findit%\") OR (ELEMENTARY_SCHOOL LIKE \"%$findit%\") OR (MIDDLE_SCHOOL LIKE \"%$findit%\") OR (HIGH_SCHOOL LIKE \"%$findit%\") OR (LOT_DESCRIPTION LIKE \"%$findit%\") OR (BOOK LIKE \"%$findit%\") OR (PAGE LIKE \"%$findit%\") OR (MAPOFFICIAL LIKE \"%$findit%\") OR (BLOCK LIKE \"%$findit%\") OR (LOT LIKE \"%$findit%\") OR (PARCEL LIKE \"%$findit%\") OR (YEAR_BUILT LIKE \"%$findit%\") OR (TENANT LIKE \"%$findit%\") OR (KEY_INFO LIKE \"%$findit%\") OR (SHOW_INSTRUCT LIKE \"%$findit%\") OR (FEE_COMMENTS LIKE \"%$findit%\") OR (ALARM LIKE \"%$findit%\") OR (TENANT_NAME LIKE \"%$findit%\") OR (TENANT_PHONE LIKE \"%$findit%\") OR (LISTING_NOTES LIKE \"%$findit%\") OR (LEASE_EXPIRE LIKE \"%$findit%\") OR (PRICE LIKE \"$findit\") OR (AVAIL LIKE \"%$findit%\") OR (xstreet LIKE \"%$findit%\") OR (AD_TITLE LIKE \"%$findit%\") OR (MLS_AGENCY LIKE \"%$findit%\") OR (MLS_AGENT LIKE \"%$findit%\") OR (MLS_CONTACT LIKE \"%$findit%\") OR (EXTERNALID LIKE \"%$findit%\") OR (MLS_PHONE LIKE \"%$findit%\")  )) ORDER BY STREET_NUM, STREET, APT";

} else {

$qustrgetclass = "SELECT * FROM CLASS WHERE ((CLI=$grid OR CLI=1075) AND ((CID LIKE \"$findit%\") OR (BODY LIKE \"%$findit%\") OR (BODY_ALT LIKE \"%$findit%\") OR (STREET_NUM LIKE \"%$findit%\") OR ((STREET_NUM LIKE \"%$SN[0]\") AND (STREET LIKE \"$SN[1]%\")) OR (STREET LIKE \"%$findit%\") OR (APT LIKE \"%$findit%\") OR (FLOOR LIKE \"%$findit%\") OR (CITY LIKE \"%$findit%\") OR (STATE LIKE \"%$findit%\") OR (ZIP LIKE \"%$findit%\") OR (BUILDING_NAME LIKE \"%$findit%\") OR (MODBY LIKE \"%$findit%\") OR (YOUTUBE LIKE \"%$findit%\") OR (YOUTUBEURL LIKE \"%$findit%\") OR (ZONING LIKE \"%$findit%\") OR (COUNTY LIKE \"%$findit%\") OR (SCHOOL_DISTRICT LIKE \"%$findit%\") OR (ELEMENTARY_SCHOOL LIKE \"%$findit%\") OR (MIDDLE_SCHOOL LIKE \"%$findit%\") OR (HIGH_SCHOOL LIKE \"%$findit%\") OR (LOT_DESCRIPTION LIKE \"%$findit%\") OR (BOOK LIKE \"%$findit%\") OR (PAGE LIKE \"%$findit%\") OR (MAPOFFICIAL LIKE \"%$findit%\") OR (BLOCK LIKE \"%$findit%\") OR (LOT LIKE \"%$findit%\") OR (PARCEL LIKE \"%$findit%\") OR (YEAR_BUILT LIKE \"%$findit%\") OR (TENANT LIKE \"%$findit%\") OR (KEY_INFO LIKE \"%$findit%\") OR (SHOW_INSTRUCT LIKE \"%$findit%\") OR (FEE_COMMENTS LIKE \"%$findit%\") OR (ALARM LIKE \"%$findit%\") OR (TENANT_NAME LIKE \"%$findit%\") OR (TENANT_PHONE LIKE \"%$findit%\") OR (LISTING_NOTES LIKE \"%$findit%\") OR (LEASE_EXPIRE LIKE \"%$findit%\") OR (PRICE LIKE \"$findit\") OR (AVAIL LIKE \"%$findit%\") OR (xstreet LIKE \"%$findit%\") OR (AD_TITLE LIKE \"%$findit%\") OR (MLS_AGENCY LIKE \"%$findit%\") OR (MLS_AGENT LIKE \"%$findit%\") OR (MLS_CONTACT LIKE \"%$findit%\") OR (EXTERNALID LIKE \"%$findit%\") OR (MLS_PHONE LIKE \"%$findit%\")  )) ORDER BY STREET_NUM, STREET, APT";

}

$qugetclass = mysqli_query($GLOBALS['dbh'], $qustrgetclass) or die ("<CENTER><FONT COLOR=#FF0000>No Listings/Ads match \"$findit\"</FONT></CENTER><BR>");
$rowgetclass = mysqli_fetch_object($qugetclass);

if (mysqli_data_seek ($qugetclass, 0)) {

mysqli_data_seek ($qugetclass, 0);
$rowgetclass = "";

echo "<TABLE WIDTH=750 CELLPADDING=0 CELLSPACING=0 BORDER=0>";

while ($rowgetclass = mysqli_fetch_object($qugetclass)) {

$qustrgetloc = "SELECT LOCNAME FROM LOC WHERE LOCID=$rowgetclass->LOC";


$qugetloc = mysqli_query($GLOBALS['dbh'], $qustrgetloc);
$rowgetloc = $qugetloc != false ? mysqli_fetch_object($qugetloc) : null;



echo "<TR><TD WIDTH=25><div class=\"ad\"><NOBR>";


if ($rowgetclass->CLI=="1075" AND $rowgetclass->STATUS_ACTIVE=="1") { echo "<FONT COLOR=BLUE><B>MLS</B></FONT>"; }

elseif ($rowgetclass->CLI=="1075" AND $rowgetclass->STATUS_ACTIVE=="0") { echo "<FONT COLOR=GRAY><B>MLS</B></FONT>"; }

 elseif ($rowgetclass->CSOURCE=="1") {
 echo "<FONT COLOR=BLUE><B>ZR</B></FONT>";
}  elseif ($rowgetclass->CSOURCE=="2") {
 echo "<FONT COLOR=BLUE><B>YGL</B></FONT>";
}

else {


if ($rowgetclass->STATUS=="STO") { ?>

<?php if ($user_level>0) {?>
		<a href="<?php echo "$PHP_SELF?op=activate_a&cid=". $rowgetclass->CID . "&return_page=findit&return_page_div=" . $k; ?>">
<?php } ?>

<img src="../assets/images/inact.jpg" border=0 HEIGHT="14" WIDTH="14" alt="Deactivated Ad" title="Deactivated Ad">
<?php if ($user_level>0) {?>
</a>
<?php } ?>


				<?php } elseif ($rowgetclass->STATUS=="ACT") { ?>
<?php if ($user_level>0) {?>
				<a href="<?php echo "$PHP_SELF?op=deactivate_a&cid=" . $rowgetclass->CID . "&return_page=findit&return_page_div=" . $k; ?>">
<?php } ?>
<img src="../assets/images/act.gif" border=0 HEIGHT="14" WIDTH="14" alt="Activated Ad" title="Activated Ad">
<?php if ($user_level>0) {?>
</a>
<?php } ?>
			<?php	}else{ echo "ERROR"; } ?>


<?php if($rowgetclass->STATUS_ACTIVE=="1")
			   { ?>

<?php if ($user_level>0) {?>

   <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowgetclass->CID . "&turn=unavailable&return_page=findit&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/a.jpg" border=0 HEIGHT="14" WIDTH="14" alt="Available Listing" title="Available Listing">
<?php if ($user_level>0) {?>
</a>
<?php }?>

			    <?php  } else { ?>

<?php if ($user_level>0) {?>
	<a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowgetclass->CID . "&turn=available&return_page=findit&return_page_div=" . $k;?>">
<?php } ?>
<img src="../assets/images/icons/u.jpg" border=0 HEIGHT="14" WIDTH="14" alt="Unavailable Listing" title="Unavailable Listing">
<?php if ($user_level>0) {?>
</a>
<?php } ?><?php }}

echo "</NOBR></TD><TD>&nbsp;</TD><TD>";



if($rowgetclass->STATUS_PENDING=="1")
			   {
			   if ($user_level>0) {
			   $_SESSION['findit'] = $findit;
			   ?>
                              <a href="<?php echo "$PHP_SELF?op=mark_status_pending&cid=".$rowgetclass->CID . "&turn=pendingno&return_page=findit";?>">
<?php }?>
<img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="16" WIDTH="16" alt="Pending Status - Yes" title="Pending Status - YES - Check Status">
<?php if ($user_level>0) {?>
</a>
<?php }?>
			    <?php  } else { ?>
<?php if ($user_level>0) {
			   $_SESSION['findit'] = $findit;
?>
	<a href="<?php echo "$PHP_SELF?op=mark_status_pending&cid=".$rowgetclass->CID . "&turn=pending&return_page=findit";?>">
<?php } ?>
<img src="../assets/images/icons/pending-no.gif" border=0 HEIGHT="16" WIDTH="16" alt="Pending Status - No" title="Pending Status - No">
<?php if ($user_level>0) {?>
</a>
<?php } ?><?php }


echo "</TD><TD>&nbsp;</TD><TD>";
?>

<a href="<?php echo "$PHP_SELF?op=mail_listing&cid=". $rowgetclass->CID . "&return_page=listings&return_page_div=" . $k; ?>" target="_email">
<img src="../images/icons/email.gif" border=0 alt="Email Listing" title="Email Listing"></a>




<?php

echo "</TD><TD>&nbsp;</TD><TD>";
?>

<a href="<?php echo "$PHP_SELF?op=mark_status_updated&cid=$rowgetclass->CID&return_page=findit&".$findit;?>"><img border="0" vspace="0" hspace="0" src="https://www.BostonApartments.com/images/newIcon.gif" alt="Mark Listing as New" title="Mark Listing as New"></a>

<?php
echo "</TD><TD>&nbsp;</TD><TD>";

if ($rowgetclass->CLI!=1075){

 if ($user_level >= 2) { echo "<a href='$PHP_SELF?op=delete&cid=$rowgetclass->CID'><img border=\"0\" src=\"../images/icons/delete.gif\" alt=\"delete\" title=\"delete\" vspace=\"0\" hspace=\"0\"></a>"; }  else {echo "&nbsp;";}

 } else {echo "&nbsp;";}


echo "</TD><TD>&nbsp;</TD><TD>";

echo "<a href=https://www.BostonApartments.com/plugin/?ad=".$rowgetclass->CID."&cli=$grid&uid=$uid target=_CL".$rowgetclass->CID."><img width=16 height=16 border=0 vspace=0 hspace=0 src=../images/icons/cl.gif TITLE=Post to CL</A>";



echo "</TD><TD>&nbsp;</TD><TD>";

echo "<a href=\"$PHP_SELF?op=adlEdit&cid=$rowgetclass->CID\" target=\"_$rowgetclass->CID\"><img border=\"0\" vspace=\"0\" hspace=\"0\" src=\"../images/icons/edit.gif\"></a></DIV></TD><TD><NOBR><div class=\"ad\"><a href=\"$PHP_SELF?op=adlEdit&cid=$rowgetclass->CID\" target=\"_$rowgetclass->CID\">".($rowgetloc->LOCNAME ?? "Location Unknown")."</A></NOBR></DIV></TD><TD WIDTH=\"30\"><NOBR><div class=\"ad\">&nbsp; <a href=\"$PHP_SELF?op=adlEdit&cid=$rowgetclass->CID\" target=\"_$rowgetclass->CID\">$rowgetclass->STREET_NUM</A></DIV></NOBR></TD></TD><TD><div class=\"ad\">&nbsp;</DIV></TD><TD><TD WIDTH=\"120\"><div class=\"ad\"><NOBR><a href=\"$PHP_SELF?op=adlEdit&cid=$rowgetclass->CID\" target=\"_$rowgetclass->CID\">$rowgetclass->STREET</A></NOBR></DIV></TD><TD><div class=\"ad\">&nbsp;</DIV></TD><TD WIDTH=\"15\"><div class=\"ad\"><NOBR><a href=\"$PHP_SELF?op=adlEdit&cid=$rowgetclass->CID\" target=\"_$rowgetclass->CID\">Apt# $rowgetclass->APT</A></NOBR></DIV></TD><TD>&nbsp;</TD>
<TD WIDTH=\"15\"><div class=\"ad\"><NOBR><a href=\"$PHP_SELF?op=adlEdit&cid=$rowgetclass->CID\" target=\"_$rowgetclass->CID\">$$rowgetclass->PRICE</A></NOBR><TD>&nbsp;</TD><TD WIDTH=\"15\"><div class=\"ad\"><NOBR><a href=\"$PHP_SELF?op=adlEdit&cid=$rowgetclass->CID\" target=\"_$rowgetclass->CID\">$rowgetclass->AVAIL</A></NOBR><TD>&nbsp;</TD><TD WIDTH=\"200\"><div class=\"finditad\"><a href=\"$PHP_SELF?op=adlEdit&cid=$rowgetclass->CID\" target=\"_$rowgetclass->CID\"><FONT SIZE=\"-3\">$rowgetclass->AD_TITLE</FONT></A></DIV></TD><TD>&nbsp;</TD><TD WIDTH=\"30\"><div class=\"ad\"><a href=\"$PHP_SELF?op=adlEdit&cid=$rowgetclass->CID\" target=\"_$rowgetclass->CID\"><NOBR>".$_SESSION["abv"]."-$rowgetclass->CID</A></NOBR></DIV></TD><TD><div class=\"ad\"><NOBR>&nbsp; $rowgetclass->MOD &nbsp;</NOBR></DIV></TD><TD><div class=\"ad\"><NOBR>&nbsp; $rowgetclass->MODBY &nbsp;</NOBR></DIV></TD><TD><div class=\"ad\"><NOBR>&nbsp;<B><FONT COLOR=\"GREEN\">";

?>
</TD>

<TD><div class="ad"><NOBR>&nbsp; Match: <B><FONT COLOR="GREEN">
<?php

if (stripos($rowgetclass->xstreet, "$findit")!== false) {
    echo " X-Street: $rowgetclass->xstreet";
}

if (stripos($rowgetclass->AVAIL, "$findit")!== false) {
    echo " Avail: $rowgetclass->AVAIL";
}

if (stripos($rowgetclass->PRICE, "$findit")!== false) {
    echo " Price: $rowgetclass->PRICE";
}

if (stripos($rowgetclass->LEASE_EXPIRE, "$findit")!== false) {
    echo " Lease Exp.: $rowgetclass->LEASE_EXPIRE";
}

if (stripos($rowgetclass->LISTING_NOTES, "$findit")!== false) {
    echo " Notes: $rowgetclass->LISTING_NOTES";
}

if (stripos($rowgetclass->TENANT_PHONE, "$findit")!== false) {
    echo " Tenant Phone: $rowgetclass->TENANT_PHONE";
}

if (stripos($rowgetclass->TENANT_NAME, "$findit")!== false) {
    echo " Tenant: $rowgetclass->TENANT_NAME";
}

if (stripos($rowgetclass->ALARM, "$findit")!== false) {
    echo " Alarm: $rowgetclass->ALARM";
}

if (stripos($rowgetclass->FEE_COMMENTS, "$findit")!== false) {
    echo " Fee Comments: $rowgetclass->FEE_COMMENTS";
}

if (stripos($rowgetclass->BUILDING_NAME, "$findit")!== false) {
    echo " Fee Comments: $rowgetclass->BUILDING_NAME";
}

if (stripos($rowgetclass->SHOW_INSTRUCT, "$findit")!== false) {
$SI = substr($rowgetclass->SHOW_INSTRUCT,0,25);
$SI = substr($ad,0,strrpos($ad," "));
    echo " Showing: ".$SI."";
}


if (stripos($rowgetclass->KEY_INFO, "$findit")!== false) {
    echo " Keys: $rowgetclass->KEY_INFO";
}

if (stripos($rowgetclass->BODY, "$findit")!== false) {
$ad = substr($rowgetclass->BODY,0,40);
$ad = substr($ad,0,strrpos($ad," "));
    echo " Ad: ".$ad."";
}

if (stripos($rowgetclass->BODY_ALT, "$findit")!== false) {
$ad = substr($rowgetclass->BODY_ALT,0,40);
$ad = substr($ad,0,strrpos($ad," "));
    echo " Ad: ".$ad."";
}


if (stripos($rowgetclass->STREET_NUM, "$findit")!== false) {
    echo " St. #: $rowgetclass->STREET_NUM";
}

if (stripos($rowgetclass->STREET, "$findit")!== false) {
    echo " Street: $rowgetclass->STREET";
}

if (stripos($rowgetclass->APT, "$findit")!== false) {
    echo " Apt #: $rowgetclass->APT";
}

if (stripos($rowgetclass->FLOOR, "$findit")!== false) {
    echo " Floor: $rowgetclass->FLOOR";
}

if (stripos($rowgetclass->CITY, "$findit")!== false) {
    echo " City: $rowgetclass->CITY";
}

if (stripos($rowgetclass->STATE, "$findit")!== false) {
    echo " State: $rowgetclass->STATE";
}

if (stripos($rowgetclass->ZIP, "$findit")!== false) {
    echo " ZIP: $rowgetclass->ZIP";
}

if (stripos($rowgetclass->MODBY, "$findit")!== false) {
    echo " Mod By: $rowgetclass->MODBY";
}

if (stripos($rowgetclass->YOUTUBE, "$findit")!== false) {
    echo " Video: $rowgetclass->YOUTUBE";
}

if (stripos($rowgetclass->YOUTUBEURL, "$findit")!== false) {
    echo " Video URL: $rowgetclass->YOUTUBEURL";
}

if (stripos($rowgetclass->ZONING, "$findit")!== false) {
    echo " Zoning: $rowgetclass->ZONING";
}

if (stripos($rowgetclass->COUNTY, "$findit")!== false) {
    echo " County: $rowgetclass->COUNTY";
}

if (stripos($rowgetclass->SCHOOL_DISTRICT, "$findit")!== false) {
    echo " School District: $rowgetclass->SCHOOL_DISTRICT";
}

if (stripos($rowgetclass->ELEMENTARY_SCHOOL, "$findit")!== false) {
    echo " E. School: $rowgetclass->ELEMENTARY_SCHOOL";
}


if (stripos($rowgetclass->MIDDLE_SCHOOL, "$findit")!== false) {
    echo " M. School: $rowgetclass->MIDDLE_SCHOOL";
}


if (stripos($rowgetclass->TENANT, "$findit")!== false) {
    echo " Tenant: $rowgetclass->TENANT";
}


if (stripos($rowgetclass->LOT_DESCRIPTION, "$findit")!== false) {
    echo " Lot Desc.: $rowgetclass->LOT_DESCRIPTION";
}

if (stripos($rowgetclass->STREET, "$findit")!== false) {
    echo " Street: $rowgetclass->STREET";
}


if ($rowgetclass->CLI== 1075) {
    echo " MLS Agency: $rowgetclass->MLS_AGENCY";
}elseif (stripos($rowgetclass->MLS_AGENCY, "$findit")!== false) {
    echo "Agency: $rowgetclass->MLS_AGENCY";
}


if ($rowgetclass->CLI== 1075) {
if (stripos($rowgetclass->MLS_AGENT, "$findit")!== false) {
    echo " MLS Agent: $rowgetclass->MLS_AGENT";
}}elseif (stripos($rowgetclass->MLS_AGENT, "$findit")!== false) {
    echo " Agent: $rowgetclass->MLS_AGENT";
}

if ($rowgetclass->CLI== 1075) {
if (stripos($rowgetclass->MLS_CONTACT, "$findit")!== false) {
    echo " MLS Email: <A HREF=mailto:$rowgetclass->MLS_CONTACT>$rowgetclass->MLS_CONTACT</A>";
}}elseif (stripos($rowgetclass->MLS_CONTACT, "$findit")!== false) {
    echo " Email: <A HREF=mailto:$rowgetclass->MLS_CONTACT>$rowgetclass->MLS_CONTACT</A>";
}

if ($rowgetclass->CLI== 1075) {
if (stripos($rowgetclass->MLS_PHONE, "$findit")!== false) {
    echo " MLS Phone: $rowgetclass->MLS_PHONE";
}}elseif (stripos($rowgetclass->MLS_PHONE, "$findit")!== false) {
    echo " Phone: $rowgetclass->MLS_PHONE";
}

echo "</FONT></B></TD></TR>";

}

echo "</TABLE>";

 }

else {echo "<CENTER><P><FONT COLOR=RED>No Listings/Ads match the search \"".$findit."\".<BR><P></CENTER>";}



}

?>

</TD></TR></TABLE>

<BR><BR>

</TD></TR></TABLE>

<BR>
<!--END findit -->