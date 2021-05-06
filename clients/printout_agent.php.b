<?php
session_start();                 
include("../inc/global.php");    
include("../inc/local_info.php");

mysqli_select_db($dbh, "$DBNAME");


$cid = $HTTP_GET_VARS['cid'];
$quStrGetAd = "SELECT * FROM ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID WHERE CID=$cid AND CLI=$grid";
$quGetAd = mysqli_query($dbh, $quStrGetAd) or die (dieNice("Sorry, couldn't lookup that ad.", "E-117"));
$rowGetAd = mysqli_fetch_object($quGetAd);

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

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/style.css">

		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php if ($title) { $title = " - " . $title; }; ?>
		<title>BostonApartments.com<?php echo $title;?></title>
		<!-- MAIN JAVASCRIPT LAYER -->
		<?php include ("../assets/main.js"); ?>
		<!--END MAIN JAVASCRIPT LAYER -->

<!-- Google Map Script -->
    <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAbOGSq7X62Ltt4DjKFTyJKxQv5E0jSDRFMKL1geOCPao0Skb1sBT-YUhlDREVhEFMb1tWYc_sqi2IVQ"
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
		<td height="15" width="100%" bgcolor="#FFFF99" valign="bottom" align="left"><div class="ad">printed by <?php echo $handle;?></div></td>
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
	<td colspan="3" align="left" height="30" width="100%" bgcolor="#FFFFFF"><NOBR><DIV class="ad"><B><a href="/lacms/clients/AgencyArea2.php?op=adlEdit&cid=<?php echo $rowGetAd->CID;?>&return_page=listings" target="_new<?php echo $k;?>">Listing #<?php echo "$abv-$cid";?></A></B> - Created:  <?php echo $rowGetAd->DATEIN ;?> Last Modified: <?php echo $rowGetAd->MOD ; ?> by <?php echo $rowGetAd->MODBY ; ?></DIV></NOBR></td>

</tr>
	<tr>
	<td colspan="3" align="left" height="30" width="100%" bgcolor="#FFFFFF"><div class="ad"><?php echo format_ad_homepage ($rowGetAd, $DEFINED_VALUE_SETS);?></td>
	</tr>


<tr>
<td colspan="3" align="left" height="30" width="100%" bgcolor="#FFFFFF"><div class="ad"> 

<?php
  if ($rowGetAd->HEATING_RESP=="1") {
	echo "Heat Resp.: Tenant"; 
  } elseif ($rowGetAd->HEATING_RESP=="2") {
	echo "Heat Resp.: Owner"; 
  } elseif ($rowGetAd->HEATING_RESP=="3") {
	echo "Heat Resp.:Owner &amp; Tenant"; 
  } elseif ($rowGetAd->HEATING_RESP=="4") {
	echo "Heat Resp.: Condo Fee"; 
} else { echo ""; }

echo "&nbsp;";

if ($rowGetAd->HEATING_TYPE=="1") {
	echo " Fuel: Oil"; 
  } elseif ($rowGetAd->HEATING_TYPE=="2") {
	echo "Fuel: Electric"; 
  } elseif ($rowGetAd->HEATING_TYPE=="3") {
	echo "Fuel: Gas"; 
  } elseif ($rowGetAd->HEATING_TYPE=="4") {
	echo "Fuel: Propane"; 
	
  } elseif ($rowGetAd->HEATING_TYPE=="6") {
	echo "Fuel: Wood"; 
  } elseif ($rowGetAd->HEATING_TYPE=="7") {
	echo "Fuel: Solar"; 
  } elseif ($rowGetAd->HEATING_TYPE=="8") {
	echo "Fuel: Geothermal"; 
  } elseif ($rowGetAd->HEATING_TYPE=="9") {
	echo "Fuel: Other"; 
} else { echo ""; }


echo "&nbsp;";

if ($rowGetAd->HEATING_TYPE2=="1") {
	echo "- Forced Air"; 
  } elseif ($rowGetAd->HEATING_TYPE2=="2") {
	echo "- Heat Pump"; 
  } elseif ($rowGetAd->HEATING_TYPE2=="3") {
	echo "- Hot Water"; 
  } elseif ($rowGetAd->HEATING_TYPE2=="4") {
	echo "- Radiant"; 
  } elseif ($rowGetAd->HEATING_TYPE2=="6") {
	echo "- Steam"; 
  } elseif ($rowGetAd->HEATING_TYPE2=="7") {
	echo "- Baseboard"; 
  } elseif ($rowGetAd->HEATING_TYPE2=="8") {
	echo "- Wood Stove"; 
  } elseif ($rowGetAd->HEATING_TYPE2=="9") {
	echo "- Other"; 
} else { echo ""; }



echo "&nbsp;";


if ($rowGetAd->HOT_WATER_RESP=="1") {
	echo "Hot H2O Resp.: Tenant"; 
  } elseif ($rowGetAd->HOT_WATER_RESP=="2") {
	echo "Hot H2O Resp.: Owner"; 
  } elseif ($rowGetAd->HOT_WATER_RESP=="3") {
	echo "Hot H2O Resp.:Owner &amp; Tenant"; 
  } elseif ($rowGetAd->HOT_WATER_RESP=="4") {
	echo "Hot H2O Resp.: Condo Fee"; 
} else { echo ""; }

echo "&nbsp;";

if ($rowGetAd->HOT_WATER_TYPE=="1") {
	echo " Fuel: Oil"; 
  } elseif ($rowGetAd->HOT_WATER_TYPE=="2") {
	echo "Fuel: Electric"; 
  } elseif ($rowGetAd->HOT_WATER_TYPE=="3") {
	echo "Fuel: Gas"; 
  } elseif ($rowGetAd->HOT_WATER_TYPE=="4") {
	echo "Fuel: Propane"; 
  } elseif ($rowGetAd->HOT_WATER_TYPE=="6") {
	echo "Fuel: Wood"; 
  } elseif ($rowGetAd->HOT_WATER_TYPE=="7") {
	echo "Fuel: Solar"; 
  } elseif ($rowGetAd->HOT_WATER_TYPE=="8") {
	echo "Fuel: Geothermal"; 
  } elseif ($rowGetAd->HOT_WATER_TYPE=="9") {
	echo "Fuel: Other"; 
} else { echo ""; }


echo "&nbsp;&nbsp;";

//echo $DEFINED_VALUE_SETS['ELECTRICITY_RESP'][$rowGetAd->ELECTRICITY_RESP];
if ($rowGetAd->ELECTRICITY_RESP=="1") {
	echo "Electricity: Tenant"; 
  } elseif ($rowGetAd->ELECTRICITY_RESP=="2") {
	echo "Electricity: Owner"; 
  } elseif ($rowGetAd->ELECTRICITY_RESP=="3") {
	echo "Electricity: Both"; 
  } elseif ($rowGetAd->ELECTRICITY_RESP=="4") {
	echo "Electricity: Condo Fee"; 
} else { echo ""; }

if ($rowGetAd->NOT_DELEADED =="1") { echo "<BR>Not Deleaded / Not Lead Safe"; }
if ($rowGetAd->FEATURES_DELEADED =="1") { echo "<BR>Deleaded / Lead Safe"; }
if (($rowGetAd->NOT_DELEADED !="1") AND ($rowGetAd->FEATURES_DELEADED !="1")) { echo "<BR>Lead Paint Status Unknown"; }


if ($rowGetAd->LAUNDRY_ROOM=="1") {
	echo "Basement Coin Laundry"; 
  } elseif ($rowGetAd->LAUNDRY_ROOM=="2") {
	echo "Basement Free Laundry"; 
  } elseif ($rowGetAd->LAUNDRY_ROOM=="3") {
	echo "Laundry Nearby"; 
  } elseif ($rowGetAd->LAUNDRY_ROOM=="4") {
	echo "Laundry Hook-up"; 
  } elseif ($rowGetAd->LAUNDRY_ROOM=="5") {
	echo "Laundry In Unit";
  } elseif ($rowGetAd->LAUNDRY_ROOM=="6") {
	echo "Laundry Hookup in unit"; 
  } elseif ($rowGetAd->LAUNDRY_ROOM=="7") {
	echo "Laundry"; 
} else { echo ""; }



if ($rowGetAd->AUTO_WRITE !="1") { 
if ($rowGetAd->AMENITIES_OWNER_OCCUPIED == "1") { echo " | Owner Occupied Property "; }
if ($rowGetAd->AMENITIES_SUPERINTENDANT == "1") { echo " | Superintendent "; }
if ($rowGetAd->AMENITIES_ON_SITE_MANAGEMENT == "1") { echo " | On Site Management "; }
if ($rowGetAd->FEATURES_FURNISHED == "1") { echo " | Furnished "; }
if ($rowGetAd->FEATURES_NON_SMOKING == "1") { echo " | Non Smoking "; }


}

?>


	</td>
	</tr>



	<tr> 
	<td colspan="3" align="left" height="30" width="100%" bgcolor="#FFFFFF"><div class="controltextimp">Address:</div><div class="menu"><?php echo $rowGetAd->STREET_NUM;?> <?php echo $rowGetAd->STREET;?> <?php if ($rowGetAd->APT) { echo  "Apt $rowGetAd->APT"; }?>, <?php echo $rowGetAd->LOCNAME;?> - <?php echo $rowGetAd->ZIP;?></div></td>
	</tr>
<tr>
	<td align="left" height="30" width="60%" bgcolor="#FFFFFF" border="1"><div class="menu"><?php echo display_landlord ($rowGetAd, $DEFINED_VALUE_SETS);?></td>
	<td align="left" height="30" width="10%" bgcolor="#FFFFFF"><div class="ad">&nbsp;</td>
	<td align="left" height="30" width="30%" bgcolor="#FFFFFF"><div class="controltextimp">Key Info:</div><div class="menu"> <?php echo $DEFINED_VALUE_SETS['KEY_INFO'][$rowGetAd->KEY_INFO]; ?></div><div class="controltextimp">Tenant Name:</div><div class="menu"> <?php echo $rowGetAd->TENANT_NAME;?></div><div class="controltextimp">Tenant Phone:</div> <div class="menu"><?php echo $rowGetAd->TENANT_PHONE;?></div></td>
	</tr>
	<tr>
	<td colspan="3" align="left" height="30" width="100%" bgcolor="#FFFFFF"><div class="controltextimp">Show Instructions:</div><div class="menu"><?php echo $rowGetAd->SHOW_INSTRUCT;?></div></td>
	</tr>
	<tr>
	<td colspan="3" align="left" height="30" width="100%" bgcolor="#FFFFFF"><div class="controltextimp">Alarm Code:</div><div class="menu"><?php echo $rowGetAd->ALARM;?></div></td>
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
