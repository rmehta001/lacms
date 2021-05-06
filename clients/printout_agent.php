<?php
session_start();                 
include("../inc/global.php");    
include("../inc/local_info.php");

$cid = $_GET['cid'];
$grid = $_GET['grid'];
$quStrGetAd = "SELECT * FROM ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID WHERE CID=$cid AND (CLI='$grid' OR CLI=1075)";
$quGetAd = mysqli_query($GLOBALS['dbh'], $quStrGetAd) or die (dieNice("Sorry, couldn't lookup that ad.", "E-117"));
$rowGetAd = mysqli_fetch_object($quGetAd);
if ($rowGetAd == null) {
    dieNice("Sorry, couldn't lookup that ad.", "E-117");
    return;
}

//DEFINED VALUE SETS //
$quStrGetValueDefs = "SELECT * FROM VALUE_DEFINE";
$quGetValueDefs = mysqli_query($GLOBALS['dbh'], $quStrGetValueDefs);

while ($rowGetValueDefs = mysqli_fetch_object($quGetValueDefs)) {
	$string = $rowGetValueDefs->DEFINE;
	$values = explode (",", $string);
	foreach ($values as $key => $value) {
		$values2[$key] = explode ("_", $value);
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

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/style.css">

		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php if (isset($title)) { $title = " - " . $title; }; ?>
		<title>BostonApartments.com<?php echo $title;?></title>
		<!-- MAIN JAVASCRIPT LAYER -->
		<?php include ("../assets/main.js"); ?>
		<!--END MAIN JAVASCRIPT LAYER -->

<!-- Google Map Script -->
    <script src="https://maps.google.com/maps?file=api&v=2&key=ABQIAAAAbOGSq7X62Ltt4DjKFTyJKxQv5E0jSDRFMKL1geOCPao0Skb1sBT-YUhlDREVhEFMb1tWYc_sqi2IVQ"
      type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[
   var geocoder;
   var map;
   var address = "<?php echo $rowGetAd->STREET_NUM;?> <?php echo $rowGetAd->STREET;?>, <?php echo $rowGetAd->LOCNAME;?> <?php echo $rowGetAd->ZIP;?>";

   // On page load, call this function
   function load()
   {
      // Create new map object
      map = new GMap2(document.getElementById("map"));

      // Create new geocoding object
      geocoder = new GClientGeocoder();

      // Retrieve location information, pass it to addToMap()
      geocoder.getLocations(address, addToMap);
   }

   // This function adds the point to the map

   function addToMap(response)
   {
      // Retrieve the object
      place = response.Placemark[0];

      // Retrieve the latitude and longitude
      point = new GLatLng(place.Point.coordinates[1],
                          place.Point.coordinates[0]);

      // Center the map on this point
      map.setCenter(point, 16);

      // Create a marker
      marker = new GMarker(point);

      // Add the marker to map
      map.addOverlay(marker);

      // Add address information to marker
      marker.openInfoWindowHtml(place.address);

    // set map type to satellite
    // Types: G_NORMAL_MAP or G_SATELLITE_MAP or G_HYBRID_MAP
    // map.setMapType(G_HYBRID_MAP);
    
    // add maps controls
    map.addControl(new GSmallMapControl());
    map.addControl(new GMapTypeControl());

   }
    //]]>
    </script>
<!-- End GOOGLE MAP SCRIPT -->


</head>
<body topmargin="10" leftmargin="10" onload="load()" onunload="GUnload()">
<div align="left" style="position:relative;">
<table border="0" cellspacing="0" cellpadding="0" width="98%">
<tr>
<td colspan="3" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
</tr>
<tr>
<td valign="top" height="30" width="1"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>


<td bgcolor="#FFFF99" valign="top">

<table width="100%" align="center" BORDER="0">
		<tr>
		<td align="left" height="30" width="50%" bgcolor="#FFFF99"><div class="menu"><?php echo $rowGetAd->NAME;?><br><?php echo $rowGetAd->SIG;?></div></td>		
		<td align="right" width="50%" bgcolor="#FFFF99"><img border="0" hspace="0" vspace="0" width="135" height="32" src="../assets/images/logo.jpg"></td>
		</tr>
		<tr>
		<td height="15" width="100%" bgcolor="#FFFF99" valign="bottom" align="left"><div class="ad">printed by <?php echo $_SESSION["handle"];?></div></td>
		<td height="15" width="100%" bgcolor="#FFFF99" valign="bottom" align="right"><NOBR><div class="controltext"><a href="javascript:close_window();">Close Window</a> || <a href="javascript:print_screen();">Send to Printer</a></div></NOBR></td>
		</tr>
		
		</table>
		</td>
<td valign="top" height="100%" width="1"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
</tr>

<tr>
<td colspan="3" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
</tr>
<tr>
<td valign="top" height="30" width="1"></td>
<td height="500" bgcolor="#FFFFFF" valign="top">
	<table width="100%" align="center"  border="0">
	<tr>
	<td colspan="3" align="left" height="30" width="100%" bgcolor="#FFFFFF"><NOBR><DIV class="ad"><B><a href="/lacms/clients/AgencyArea2.php?op=adlEdit&cid=<?php echo $rowGetAd->CID;?>&return_page=listings" target="_new<?php echo $k;?>">Listing #<?php echo $_SESSION["abv"]."-$cid";?></A>
	
		<?php if ($rowGetAd->EXTERNALID) { echo " EXT ID: " . $rowGetAd->EXTERNALID ; } ?>
	
	</B> - Created:  <?php echo $rowGetAd->DATEIN ;?> Last Modified: <?php echo $rowGetAd->MOD ; ?> 

<?php if ($rowGetAd->DATEONMARKET != "0000-00-00" AND $rowGetAd->DATEONMARKET != "") { 
$now = date ("Ymd");

$start_ts = strtotime($rowGetAd->DATEONMARKET);
$end_ts = strtotime($now);
$diff = $end_ts - $start_ts;
$DOM = round($diff / 86400);
echo "DOM: $DOM ";
} ?>

by <?php echo $rowGetAd->MODBY ; ?>




<?php if ($rowGetAd->STATUS=="STO") { ?>

<?php if ($_SESSION["user_level"]>0) {?>
		<a href="<?php echo $_SERVER['PHP_SELF']."?op=activate_a&cid=". $rowGetAd->CID . "&return_page=listings&return_page_div=" . ($k); ?>">
<?php } ?>

<img src="../assets/images/inact.jpg" border=0 HEIGHT="16" WIDTH="16" alt="Deactivated Ad" title="Deactivated Ad">
<?php if ($_SESSION["user_level"]>0) {?>
</a>
<?php } ?>


				<?php } elseif ($rowGetAd->STATUS=="ACT") { ?>
<?php if ($_SESSION["user_level"]>0) {?>
				<a href="<?php echo "$PHP_SELF?op=deactivate_a&cid=" . $rowGetAd->CID . "&return_page=listings&return_page_div=" . $k; ?>">
<?php } ?>
<img src="../assets/images/act.gif" border=0 HEIGHT="16" WIDTH="16" alt="Activated Ad" title="Activated Ad">
<?php if ($_SESSION["user_level"]>0) {?>
</a>
<?php } ?>
			<?php	}else{ echo "ERROR"; }?>



<?php if($rowGetAd->STATUS_ACTIVE=="1")
			   { ?>

<?php if ($_SESSION["user_level"]>0) {?>

                              <a href="<?php echo $_SERVER['PHP_SELF']."?op=mark_status_active&cid=".$rowGetAd->CID . "&turn=unavailable&return_page=listings&return_page_div=" . ($k);?>">
<?php }?>
<img src="../assets/images/icons/a.jpg" border=0 HEIGHT="16" WIDTH="16" alt="Available Listing" title="Available Listing">
<?php if ($_SESSION["user_level"]>0) {?>
</a>
<?php }?>

</CENTER>
			    <?php  } else { ?>
<CENTER>
<?php if ($_SESSION["user_level"]>0) {?>
	<a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetAd->CID . "&turn=available&return_page=listings&return_page_div=" . $k;?>">
<?php } ?>
<img src="../assets/images/icons/u.jpg" border=0 HEIGHT="16" WIDTH="16" alt="Unavailable Listing" title="Unavailable Listing">
<?php if ($_SESSION["user_level"]>0) {?>
</a>
<?php } ?><?php } ?>


<?php if($rowGetAd->STATUS_PENDING=="1")
			   { ?>

<?php if ($_SESSION["user_level"]>0) {?>

                              <a href="<?php echo "$PHP_SELF?op=mark_status_pending&cid=".$rowGetAd->CID . "&turn=pendingno&return_page=listings&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="16" WIDTH="16" alt="Pending Status - Yes" title="Pending Status - YES - Check Status">
<?php if ($_SESSION["user_level"]>0) {?>
</a>
<?php }}?></NOBR>
</DIV>







</td>

</tr>
	<tr>
	
	
		<?php if ($rowGetAd->CLI=="1075")  {
	
	echo "	<TD>";
	
if ($rowGetAd->CLI=="1075" AND $rowGetAd->MLS_AGENCY!="") { echo "<NOBR><FONT COLOR=RED><B>MLS Listing Agency:</B></FONT> <FONT COLOR=BLUE><B>".$rowGetAd->MLS_AGENCY."</B></FONT></NOBR><BR>"; }
if ($rowGetAd->CLI=="1075" AND $rowGetAd->MLS_AGENT!="") { echo "<NOBR><FONT COLOR=RED></B>MLS Listing Agent:</B></FONT> <FONT COLOR=BLUE><B>".$rowGetAd->MLS_AGENT."</B></FONT></NOBR><BR>"; }
if ($rowGetAd->CLI=="1075" AND $rowGetAd->MLS_CONTACT!="") { echo "<NOBR><FONT COLOR=RED>Listing Email:</B></FONT> <FONT COLOR=BLUE><B><A HREF=mailto:".$rowGetAd->MLS_CONTACT.">".$rowGetAd->MLS_CONTACT."</A></B></FONT></NOBR><BR>"; }
if (($rowGetAd->CLI=="1075" AND $rowGetAd->MLS_PHONE!="") AND ($rowGetAd->MLS_PHONE!=$rowGetAd->MLS_CONTACT)) { echo "<NOBR><FONT COLOR=RED>Listing Phone:</B></FONT> <FONT COLOR=BLUE><B>".$rowGetAd->MLS_PHONE."</B></FONT></NOBR><BR>"; }
if (($rowGetAd->CLI=="1075" AND $rowGetAd->MLS_PHONEOFFICE!="")) { echo "<NOBR><FONT COLOR=RED>Listing Office Phone:</B></FONT> <FONT COLOR=BLUE><B>".$rowGetAd->MLS_PHONEOFFICE."</B></FONT></NOBR><BR>"; }
if (($rowGetAd->CLI=="1075" AND $rowGetAd->EXTERNALID!="")) { echo "<NOBR><FONT COLOR=RED>MLS ID #:</B></FONT> <FONT COLOR=BLUE><B>".$rowGetAd->EXTERNALID."</B></FONT></NOBR><BR>"; }
	
	
echo "</TD></TR><TR>";
	} ?>
	
	
	
	
	
	
	<td colspan="3" align="left" height="30" width="100%" bgcolor="#FFFFFF"><div class="ad"><?php echo format_ad_homepage ($rowGetAd, $DEFINED_VALUE_SETS);?></td>
	</tr>


<tr>
<td colspan="3" align="left" height="30" width="100%" bgcolor="#FFFFFF"><div class="ad"> 

<?php

if($rowGetAd->HEATING_RESP)
{
	echo "Heat Resp.: ".$DEFINED_VALUE_SETS['HEATING_RESP'][$rowGetAd->HEATING_RESP];
}

if($rowGetAd->HEATING_TYPE)
{
	echo " Fuel: ".$DEFINED_VALUE_SETS['HEATING_TYPE'][$rowGetAd->HEATING_TYPE];
}

if($rowGetAd->HEATING_TYPE2)
{
	echo " - ".$DEFINED_VALUE_SETS['HEATING_TYPE2'][$rowGetAd->HEATING_TYPE2];
}

if($rowGetAd->HOT_WATER_RESP)
{
	echo " | Hot H20 Resp.: ".$DEFINED_VALUE_SETS['HOT_WATER_RESP'][$rowGetAd->HOT_WATER_RESP];
}

if($rowGetAd->HOT_WATER_TYPE)
{
	echo " Fuel: ".$DEFINED_VALUE_SETS['HOT_WATER_TYPE'][$rowGetAd->HOT_WATER_TYPE];
} 

if($rowGetAd->ELECTRICITY_RESP)
{
	echo " | Electricity: ".$DEFINED_VALUE_SETS['ELECTRICITY_RESP'][$rowGetAd->ELECTRICITY_RESP];
}

if($rowGetAd->WATER_RESP)
{
	echo " | Water Resp: ".$DEFINED_VALUE_SETS['WATER_RESP'][$rowGetAd->WATER_RESP];
}

if ($rowGetAd->NOT_DELEADED =="1") { echo "<BR>Not Deleaded / Not Lead Safe"; }
if ($rowGetAd->FEATURES_DELEADED =="1") { echo "<BR>Deleaded / Lead Safe"; }
if (($rowGetAd->NOT_DELEADED !="1") AND ($rowGetAd->FEATURES_DELEADED !="1")) { echo "<BR>Lead Paint Status Unknown"; }

if ($rowGetAd->CONDO_FEES!="0") { echo " Condo Fees: $rowGetAd->CONDO_FEES"; }
if ($rowGetAd->CONDO_FEES_INCLUDE) { echo " Condo Fees include: $rowGetAd->CONDO_FEES_INCLUDE"; }


if ($rowGetAd->AUTO_WRITE !="1") { 

if ($rowGetAd->AMENITIES_OWNER_OCCUPIED == "1") { echo " | Owner Occupied Property "; }
if ($rowGetAd->AMENITIES_SUPERINTENDANT == "1") { echo " | Superintendent "; }
if ($rowGetAd->AMENITIES_ON_SITE_MANAGEMENT == "1") { echo " | On Site Management "; }
if ($rowGetAd->AMENITIES_CONCIEARGE == "1") { echo " | Concierge "; }
if ($rowGetAd->AMENITIES_SECURITY == "1") { echo " | Security "; }
if ($rowGetAd->FEATURES_ALARM == "1") { echo " | Alarm "; }
if ($rowGetAd->FEATURES_FURNISHED == "1") { echo " | Furnished "; }
if ($rowGetAd->FEATURES_NON_SMOKING == "1") { echo " | Non Smoking "; }
if ($rowGetAd->AMENITIES_ELEVATOR == "1") { echo " | Elevator "; }
if ($rowGetAd->FEATURES_MODERN_KITCHEN == "1") { echo " | Modern Kitchen "; }
if ($rowGetAd->FEATURES_KITCHEN_GALLEY == "1") { echo " | Galley Kitchen "; }
if ($rowGetAd->FEATURES_KITCHENETTE == "1") { echo " | Kitchenette "; }
if ($rowGetAd->FEATURES_EAT_IN_KITCHEN == "1") { echo " | Eat in Kitchen "; }
if ($rowGetAd->FEATURES_GAS_RANGE == "1") { echo " | Gas Range "; }
if ($rowGetAd->FEATURES_ELEC_RANGE == "1") { echo " | Elec. Range "; }
if ($rowGetAd->FEATURES_DISPOSAL == "1") { echo " | Disposal "; }
if ($rowGetAd->FEATURES_DISHWASHER == "1") { echo " | Dishwasher "; }
if ($rowGetAd->FEATURES_SKYLIGHT == "1") { echo " | Skylight "; }
if ($rowGetAd->FEATURES_CENTRAL_AC == "1") { echo " | Central A/C "; }
if ($rowGetAd->FEATURES_AC == "1") { echo " | A/C "; }
if ($rowGetAd->FEATURES_MODERN_BATH == "1") { echo " | Mod. Bath "; }
if ($rowGetAd->FEATURES_DINNING_ROOM == "1") { echo " | Dining Room "; }
if ($rowGetAd->FEATURES_PANTRY == "1") { echo " | Pantry "; }
if ($rowGetAd->FEATURES_MICROWAVE == "1") { echo " | Microwave "; }
if ($rowGetAd->FEATURES_INTERNET == "1") { echo " | High Speed Internet "; }
if ($rowGetAd->FEATURES_DUPLEX == "1") { echo " | Duplex "; }
if ($rowGetAd->FEATURES_WHIRLPOOL == "1") { echo " | Whirlpool/Spa "; }
if ($rowGetAd->FEATURES_FIREPLACE_WORKING == "1") { echo " | Wkng FP "; }
if ($rowGetAd->FEATURES_FIREPLACE_DECOR == "1") { echo " | Dec. FP "; }
if ($rowGetAd->FEATURES_CARPET == "1") { echo " | W/W Carpet "; }
if ($rowGetAd->FEATURES_HWFI == "1") { echo " | Hardwood Floors "; }
if ($rowGetAd->AMENITIES_ATTIC == "1") { echo " | Attic "; }
if ($rowGetAd->AMENITIES_BASEMENT == "1") { echo " | Basement "; }
if ($rowGetAd->AMENITIES_BIN == "1") { echo " | Storage Bin "; }
if ($rowGetAd->AMENITIES_ROOF_DECK == "1") { echo " | Roof Deck "; }
if ($rowGetAd->AMENITIES_GARDEN == "1") { echo " | Garden "; }
if ($rowGetAd->AMENITIES_YARD == "1") { echo " | Yard "; }
if ($rowGetAd->AMENITIES_CLUBHOUSE == "1") { echo " | Club House "; }
if ($rowGetAd->AMENITIES_BUSINESSCENTER == "1") { echo " | Business Center "; }
if ($rowGetAd->AMENITIES_HEALTH_CLUB == "1") { echo " | Health Club "; }
if ($rowGetAd->AMENITIES_POOL == "1") { echo " | Pool "; }
if ($rowGetAd->AMENITIES_TENNIS == "1") { echo " | Tennis "; }
if ($rowGetAd->AMENITIES_LOUNGE == "1") { echo " | Lounge "; }
if ($rowGetAd->AMENITIES_SAUNA == "1") { echo " | Sauna "; }
if ($rowGetAd->AMENITIES_HIGH_CEILINGS == "1") { echo " | High Ceilings "; }
if ($rowGetAd->FEATURES_PORCH == "1") { echo " | Porch "; }
if ($rowGetAd->FEATURES_ENCLOSED_PORCH == "1") { echo " | Enclosed Porch "; }
if ($rowGetAd->FEATURES_BALCONY == "1") { echo " | Balcony "; }
if ($rowGetAd->FEATURES_DECK == "1") { echo " | Deck "; }
if ($rowGetAd->AMENITIES_DECK == "1") { echo " | Deck "; }
if ($rowGetAd->FEATURES_PATIO == "1") { echo " | Patio "; }
if ($rowGetAd->FEATURES_WALK_IN_CLOSET == "1") { echo " | Walk-in Closet "; }
if ($rowGetAd->AMENITIES_WHEELCHAIR == "1") { echo " | Wheelchair Access "; }
if ($rowGetAd->AMENITIES_SUBWAY == "1") { echo " | Subway "; }
if ($rowGetAd->AMENITIES_CRAIL == "1") { echo " | CRail "; }
if ($rowGetAd->AMENITIES_BUS == "1") { echo " | Bus "; }
if ($rowGetAd->AMENITIES_SHUTTLE == "1") { echo " | Shuttle Bus "; }

}


if (($rowGetAd->SCHOOL_DISTRICT) OR ($rowGetAd->ELEMENTARY_SCHOOL) OR ($rowGetAd->MIDDLE_SCHOOL) OR ($rowGetAd->HIGH_SCHOOL) OR ($rowGetAd->SCHOOL)) { echo "<BR><B>Schools:</B>";}

if ($rowGetAd->SCHOOL_DISTRICT) { echo " District: $rowGetAd->SCHOOL_DISTRICT"; }
if ($rowGetAd->ELEMENTARY_SCHOOL) { echo " Elem.: $rowGetAd->ELEMENTARY_SCHOOL"; }
if ($rowGetAd->MIDDLE_SCHOOL) { echo " Middle: $rowGetAd->MIDDLE_SCHOOL"; }
if ($rowGetAd->HIGH_SCHOOL) { echo " High: $rowGetAd->HIGH_SCHOOL"; }
if ($rowGetAd->SCHOOL) { echo " <B>College/Univ.:</B> ".$DEFINED_VALUE_SETS['SCHOOL'][$rowGetAd->SCHOOL]; }

if (($rowGetAd->SCHOOL_DISTRICT) OR ($rowGetAd->ELEMENTARY_SCHOOL) OR ($rowGetAd->MIDDLE_SCHOOL) OR ($rowGetAd->HIGH_SCHOOL) OR ($rowGetAd->SCHOOL)) { echo "<BR>";}




?>


	</td>
	</tr>



	<tr> 
	<td colspan="3" align="left" height="30" width="100%" bgcolor="#FFFFFF"><div class="menu"><NOBR><B>Address:</B> <?php echo $rowGetAd->STREET_NUM;?> <?php echo $rowGetAd->STREET;?> <?php if ($rowGetAd->APT) { echo  "Apt $rowGetAd->APT"; }?>, <?php echo $rowGetAd->LOCNAME;?> - <?php echo $rowGetAd->ZIP;?></div></NOBR></td>
	</tr>
<tr>
	<td align="left" height="30" width="60%" bgcolor="#FFFFFF" border="1"><div class="menu"><?php echo display_landlord ($rowGetAd, $DEFINED_VALUE_SETS);?></td>
	<td align="left" height="30" width="10%" bgcolor="#FFFFFF"><div class="ad">&nbsp;</td>
	<td align="left" height="30" width="30%" bgcolor="#FFFFFF"><div class="menu"><B>Key Info:</B><BR><?php echo $DEFINED_VALUE_SETS['KEY_INFO'][$rowGetAd->KEY_INFO]; ?><BR>
<B>Tenant Name:</B><BR><?php echo $rowGetAd->TENANT_NAME;?><BR>
<B>Tenant Phone:</B><BR><?php echo $rowGetAd->TENANT_PHONE;?><BR>
<B>Alarm Code:</B><BR><?php echo $rowGetAd->ALARM;?><BR>
	
	</td>
	</tr>
	<tr>
	<td colspan="3" align="left" height="30" width="100%" bgcolor="#FFFFFF"><div class="controltextimp">Show Instructions:</div><div class="menu"><?php echo $rowGetAd->SHOW_INSTRUCT;?></div></td>
	</tr>
	<tr>
	<td colspan="3" align="left" height="30" width="100%" bgcolor="#FFFFFF"><div class="controltextimp">LISTING NOTES:</div><div class="menu"><?php echo $rowGetAd->LISTING_NOTES;?></div></td>
	</tr>
	
		<tr>
	<td colspan="3" align="left" height="30" width="100%" bgcolor="#FFFFFF"><div class="controltextimp">LANDLORD NOTES:</div><div class="menu"><?php echo $rowGetAd->LLNOTES;?></div></td>
	</tr>

<TR><TD COLSPAN=3>
<div id="map" style="width: 450px; height: 300px"></div>
</TD></TR>

	</table></td>

<td valign="top" height="30" width="1"></td>

</tr>

</table>

</div>
</body>
</html>
