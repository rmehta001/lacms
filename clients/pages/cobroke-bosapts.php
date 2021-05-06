<?php

$quStrGetAd = "SELECT * FROM (CLASS INNER JOIN `GROUP` ON `CLASS`.CLI=`GROUP`.GRID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE CLASS.COBROKE = 1 AND GROUP.COBROKE_BOS = 1 AND CLASS.STATUS_ACTIVE = '1' AND `CLASS`.CLI!='392' AND `CLASS`.CLI!='1075' ORDER BY LOCNAME, STREET, STREET_NUM, APT";
$quGetAd = mysqli_query($dbh, $quStrGetAd) or die ("I'm sorry. No Co-brokes Available. Please check back later");
$rowGetAds = mysqli_fetch_object($quGetAd);




if (@ mysqli_data_seek ($quGetAd, 0)) {


mysqli_data_seek ($quGetAd, 0);
$rowGetAds = "";

while ($rowGetAds = mysqli_fetch_object($quGetAd)) {
		echo "<CENTER><TABLE WIDTH=600><TR><TD VALIGN=TOP>";




echo "<HR>";


	if ($rowGetAds->PIC!=0)
	{	$thumb=get_thumb_pic($rowGetAds);
echo "<IMG SRC=$thumb border=0 HEIGHT=150 width=150 ALIGN=RIGHT VALIGN=TOP>";

} else { $thumb=""; }

if ($rowGetAds->EXTERNALPIC !="") {

$thumb="$rowGetAds->EXTERNALPIC";
echo "<IMG SRC=$thumb border=0 HEIGHT=150 width=150 ALIGN=RIGHT VALIGN=TOP>";
}

echo $rowGetAds->LOCNAME . " - " . Avail($rowGetAds) . "$" . $rowGetAds->PRICE . "<BR>";


if ($rowGetGroup->COBROKE_VIEW =="1")
{
echo $rowGetAds->STREET_NUM . "&nbsp;";
}

echo $rowGetAds->STREET . "&nbsp;";

if ($rowGetGroup->COBROKE_VIEW =="1")
{
echo " Apt# " . $rowGetAds->APT . " &nbsp;";
}
echo " <B>Ad# " . $rowGetAds->CID . "</B><BR>" ;


echo $rowGetAds->ROOMS . " Bedrooms - " . $rowGetAds->BATH . " Bath<BR>" ;

if ($rowGetGroup->COBROKE_VIEW =="1")
{
echo "<B>Tenant Name:</B> " . $rowGetAds->TENANT_NAME . "<BR><B>Tenant Phone:</B> " . $rowGetAds->TENANT_PHONE . "<BR><B>Super Name:</B> " . $rowGetLandlord->SUPER_NAME . "<BR><B>Super Phone:</B> " . $rowGetLandlord->SUPER_PHONE . "<BR>" ;


if ($rowGetAds->MLS_AGENCY) {
echo "<B>Listing Agency:</B> " .  $rowGetAds->MLS_AGENCY . "<BR>";
}
if ($rowGetAds->MLS_AGENT) {
echo "<B>Listing Agent:</B> " .  $rowGetAds->MLS_AGENT . "<BR>";
}
if ($rowGetAds->MLS_CONTACT) {
echo "<B>Listing Agency Contact:</B> " .  $rowGetAds->MLS_CONTACT . "<BR>";
}

echo "<B>Showing Instructions:</B> " . $rowGetAds->SHOW_INSTRUCT . "<BR>";
echo "<B>Alarm Code:</B> " . $rowGetAds->ALARM . "<BR>";
echo "<B>Keys:</B> " . keys($rowGetAds, $DEFINED_VALUE_SETS) . "<BR>";
}
echo "<B>Description:</B> " . $rowGetAds->BODY;

echo features($rowGetAds, $DEFINED_VALUE_SETS);
echo icons($rowGetAds) . "<BR>";
echo sig($rowGetAds);

echo "</TD></TR></TABLE>";


}

echo "<HR width=600> </TD></TR></TABLE></CENTER>";


} else {echo "<CENTER><P><FONT COLOR=RED>Sorry, No Co-Brokes Available at this time.</FONT><BR>Please check back later as other agencies are always changing their listings.<BR><P></CENTER>";}


?>