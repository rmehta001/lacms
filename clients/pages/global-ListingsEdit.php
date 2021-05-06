<!--Begin adlEdit -->

<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>

<span style="font-size:5px;"><BR></span>
<div align="left" style="padding:0px;margin:px;border:1px solid black;width:850;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:14px;color:black;">
<!--Tabs-->

<table width=100% border=0>
<tr>
<td style="font-size:15px;margin:5px;padding:10px;" VALIGN="TOP">
This page is to make changes to ALL Listings for <?php echo "$street_num $street"; ?></TD></tr><tr><td>

<CENTER>

	
	<div class="ad">

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD VALIGN="TOP">


<div style="width:790px; margin:8px; padding:8px; background-color:<?php echo $pagebgcolor;?>; border:1px solid black;?>;">

<FONT style="font-size:15px;">Click on the detail listed below that you would like to change.</FONT><BR>
<P>


<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD VALIGN="TOP">

<FONT style="font-size:12px;">

<LI> <A HREF="<?php echo "$PHP_SELF?op=upload1tomany-b&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Add a Picture to All Units</A><BR>
</LI>
<BR>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-fee&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Fee</A><BR>
</LI>



<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-advertised&lid=$lid&return_page=editLandlord";?>">Make Advertised</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-unadvertised&lid=$lid&return_page=editLandlord";?>">Un-Advertised</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-available&lid=$lid&return_page=editLandlord";?>">Mark Available</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-unavailable&lid=$lid&return_page=editLandlord";?>">Mark Unavailable</A><BR>
</LI>





<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-avail&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Availability Date</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-parkingcost&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Parking - Cost Per Space</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-parkingnum&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Parking - # of spaces per unit</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-parkingtype&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Parking - Type of Parking</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-pets&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Pets</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-priority&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Priority Listing</A><BR>
</LI>


<BR>________<BR>
<BR>
<FONT style="font-size:15px;"><B>Showing:</B><BR></FONT>
<BR>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-showinginstructions&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Showing Instructions</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-keyinfo&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Key Information</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-alarmcode&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Alarm Code</A><BR>
</LI>

<BR>________<BR>
<BR>
<FONT style="font-size:15px;"><B>Advertisement:</B><BR></FONT>
<BR>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-map&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Map View in Ads</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-autowrite&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Auto-write Features &amp; Amenities in Ads</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-persig&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Display Personal Signatures of Agents</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-agent&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Change Creating Agent (effects Personal Signatures)</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-change-agency&lid=$lid&return_page=editLandlord";?>">Change Office (effects Agency Signature)</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-cobroke&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Set Co-Broke Status</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-adtitle&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Optional Ad Title (Clear or Change)</A><BR>
</LI>

<?php if($isAdmin) { ?>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-body&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Ad Body Text (Clear or Change - whole ad)</A><BR>
</LI>

<?php } ?>


<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-vt&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Virtual Tour (Set, Change or Clear)</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-yturl&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">YouTube Video URL</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-ytemb&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">YouTube Video Embed Video URL</A><BR>
</LI>

<BR>________<BR>
<BR>
<FONT style="font-size:15px;"><B>Miscellaneous:</B><BR></FONT>
<BR>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-ll&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Change Landlord / Owner</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-buildingname&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Building Name</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-streetname&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Street Name</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-xstreet&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Cross Street Name</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-location&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Location (City/Town)</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-zipcode&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Zip Code</A><BR>
</LI>

<BR>________<BR>
<BR>
<FONT style="font-size:15px;"><B>Structural:</B><BR></FONT>
<BR>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-heat&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Heating Responsibility</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-heatfuel&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Heating Fuel</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-heattype&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Heating Type</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-hotwaterresp&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Hot Water Responsibility</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-hotwatertype&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Hot Water Type</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-buildtype&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Building Type</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-buildstyle&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Building Style</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-exterior&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Exterior</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-stories&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Stories</A><BR>
</LI>


</TD><TD><NOBR> &nbsp;&nbsp;&nbsp;</NOBR>


</TD><TD VALIGN="TOP">
<FONT style="font-size:15px;">
<B>FEATURES:</B><BR></FONT>
<BR>
<FONT style="font-size:12px;">
<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-deleaded&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">De-Leaded</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-furnished&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Furnished</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-smoker&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Non-Smoking</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-alarm&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Alarm</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-highceil&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">High Ceilings</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-cac&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Central A/C</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-ac&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">A/C</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-hw&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Hot Water</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-hhw&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Heat &amp; Hot Water</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-elec&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Electricity</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-allutil&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">All Utilities</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-hsi&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">High-Speed Internet</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-wicl&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Walk-in Closet</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-modbath&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Modern Bath</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-whirl&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Whirlpool Tub</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-fpwkg&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Working Fireplace</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-fpdec&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Decorative Fireplace</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-hwf&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Hardwood Floors</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-carpet&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Carpet</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-kitmod&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Modern Kitchen</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-kitg&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Galley Kitchen</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-kitk&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Kitchenette</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-kiteik&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Eat-in Kitchen</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-mwave&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Microwave</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-pantry&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Pantry</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-rangegas&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Gas Range</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-rangeelec&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Electric Range</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-disp&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Disposal</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-dish&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Dishwasher</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-diningr&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Dining Room</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-skylight&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Skylight</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-balcony&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Balcony</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-patio&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Patio</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-porch&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Porch</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-porche&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Enclosed Porch</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-deck&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Deck</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-duplex&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Duplex</A><BR>
</LI>

<BR>________<BR>
<BR>
<FONT style="font-size:15px;"><B>Schools:</B><BR></FONT>
<BR>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-s-students&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Students</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-s-college&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">College</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-s-district&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">School District</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-s-elem&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Elementary School</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-s-mid&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Middle School</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-s-high&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">High School</A><BR>
</LI>




</FONT>

</TD><TD><NOBR> &nbsp;&nbsp;&nbsp;&nbsp; </NOBR></TD><TD VALIGN="TOP">
<FONT style="font-size:15px;">
<B>AMENITIES:</B><BR>
<BR>
<FONT style="font-size:12px;">


<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-concierge&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Concierge</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-security&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Security</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-super&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Superintendent</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-osman&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">On-site Management</A><BR>
</LI>


<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-oocc&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Owner Occupied</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-roofd&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Roof Deck</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-garden&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Garden</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-yard&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Yard</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-elevator&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Elevator</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-clubh&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Club House</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-healthc&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Health Club</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-pool&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Pool</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-sauna&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Sauna</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-tennis&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Tennis</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-lounge&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Lounge</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-busc&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Business Center</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-attic&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Attic</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-basement&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Basement</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-bin&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Storage Bin</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-wheelc&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Wheelchair Access</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-subway&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Subway</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-crail&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Commuter Rail</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-bus&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Bus</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-sbus&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Shuttle Bus</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-laundry&street_num=$street_num&street=$street&lid=$lid&return_page=editLandlord";?>">Laundry</A><BR>
</LI>


<BR>________<BR>

<BR>

<LI>
<a href="#" onclick="javascript:history.go(-1);"><B><FONT COLOR="RED" SIZE="+1">Cancel</FONT></B></A><BR>
</LI>


</TD></TR></TABLE>

</FONT>


</CENTER>

</TD></TR></TABLE>




</TD></TR></TABLE>


		</div>
</div>
<br>

<!--End -->
