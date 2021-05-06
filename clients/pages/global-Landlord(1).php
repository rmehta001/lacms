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
<IMG src="../assets/images/global.jpeg" BORDER="0" TITLE="Make Global changes to ALL Listings in ALL Buildings for this Landlord">&nbsp;This page is to make changes to ALL Listings for All Buildings for Landlord #<?php echo "$lid $llname"; ?>.</TD></tr><tr><td>

<CENTER>

	
	<div class="ad">

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD VALIGN="TOP">


<div style="width:790px; margin:8px; padding:8px; background-color:<?php echo $pagebgcolor;?>; border:1px solid black;?>;">

<FONT style="font-size:15px;">Click on the detail listed below which you would like to change.</FONT>

<BR>



<P>


<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD VALIGN="TOP">

<FONT style="font-size:12px;">

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-fee&lid=$lid&return_page=editLandlord";?>">Fee</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-makeadvertised&lid=$lid&return_page=editLandlord";?>">Make Advertised</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-makeunadvertised&lid=$lid&return_page=editLandlord";?>">Un-Advertised</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-markavailable&lid=$lid&return_page=editLandlord";?>">Mark Available</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-markunavailable&lid=$lid&return_page=editLandlord";?>">Mark Unavailable</A><BR>
</LI>


<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-avail&lid=$lid&return_page=editLandlord";?>">Availability Date</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-parkingcost&lid=$lid&return_page=editLandlord";?>">Parking - Cost Per Space</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-parkingnum&lid=$lid&return_page=editLandlord";?>">Parking - # of spaces per unit</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-parkingtype&lid=$lid&return_page=editLandlord";?>">Parking - Type of Parking</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-pets&lid=$lid&return_page=editLandlord";?>">Pets</A><BR>
</LI>
<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-priority&lid=$lid&return_page=editLandlord";?>">Priority Listing</A><BR>
</LI>



<BR>________<BR>
<BR>
<FONT style="font-size:15px;"><B>Showing:</B><BR></FONT>
<BR>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-showinginstructions&lid=$lid&return_page=editLandlord";?>">Showing Instructions</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-keyinfo&lid=$lid&return_page=editLandlord";?>">Key Information</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-alarmcode&lid=$lid&return_page=editLandlord";?>">Alarm Code</A><BR>
</LI>

<BR>________<BR>
<BR>
<FONT style="font-size:15px;"><B>Advertisement:</B><BR></FONT>
<BR>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-map&lid=$lid&return_page=editLandlord";?>">Map View in Ads</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-autowrite&lid=$lid&return_page=editLandlord";?>">Auto-write Features &amp; Amenities in Ads</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-persig&lid=$lid&return_page=editLandlord";?>">Display Personal Signatures of Agents</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-agent&lid=$lid&return_page=editLandlord";?>">Change Creating Agent (effects Personal Signatures)</A><BR>
</LI>


<LI> <A HREF="<?php echo "$PHP_SELF?op=global-change-agency&lid=$lid&return_page=editLandlord";?>">Change Office/Agency (effects Office/Agency Signatures)</A><BR>
</LI>


<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-cobroke&lid=$lid&return_page=editLandlord";?>">Set Co-Broke Status</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-adtitle&lid=$lid&return_page=editLandlord";?>">Optional Ad Title (Clear or Change)</A><BR>
</LI>

<?php if($isAdmin) { ?>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-body&lid=$lid&return_page=editLandlord";?>">Ad Body Text (Clear or Change - whole ad)</A><BR>
</LI>

<?php } ?>


<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-vt&lid=$lid&return_page=editLandlord";?>">Virtual Tour (Set, Change or Clear)</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-yturl&lid=$lid&return_page=editLandlord";?>">YouTube Video URL</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-ytemb&lid=$lid&return_page=editLandlord";?>">YouTube Video Embed Video URL</A><BR>
</LI>

<LI> <a href="<?php echo $PHP_SELF;?>?op=changeLLListingsdo&amp;lid=<?php echo $rowGetLandlord->LID;?>&amp;grid=<?php echo $grid;?>&amp;next_contact=<?php echo $rowGetLandlord->NEXT_CONTACT;?>">Set All Listings to Updated Today (NEW)</A>
</LI>


<BR>________<BR>
<BR>
<FONT style="font-size:15px;"><B>Miscellaneous:</B><BR></FONT>
<BR>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-ll&lid=$lid&return_page=editLandlord";?>">Change Landlord / Owner</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-streetname&lid=$lid&return_page=editLandlord";?>">Street Name</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-xstreet&lid=$lid&return_page=editLandlord";?>">Cross Street Name</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-location&lid=$lid&return_page=editLandlord";?>">Location (City/Town)</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-zipcode&lid=$lid&return_page=editLandlord";?>">Zip Code</A><BR>
</LI>

<BR>________<BR>
<BR>
<FONT style="font-size:15px;"><B>Structural:</B><BR></FONT>
<BR>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-heat&lid=$lid&return_page=editLandlord";?>">Heating Responsibility</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-heatfuel&lid=$lid&return_page=editLandlord";?>">Heating Fuel</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-heattype&lid=$lid&return_page=editLandlord";?>">Heating Type</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-hotwaterresp&lid=$lid&return_page=editLandlord";?>">Hot Water Responsibility</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-hotwatertype&lid=$lid&return_page=editLandlord";?>">Hot Water Type</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-buildtype&lid=$lid&return_page=editLandlord";?>">Building Type</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-buildstyle&lid=$lid&return_page=editLandlord";?>">Building Style</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-exterior&lid=$lid&return_page=editLandlord";?>">Exterior</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-stories&lid=$lid&return_page=editLandlord";?>">Stories</A><BR>
</LI>


</TD><TD><NOBR> &nbsp;&nbsp;&nbsp;</NOBR>


</TD><TD VALIGN="TOP">
<FONT style="font-size:15px;">
<B>FEATURES:</B><BR></FONT>
<BR>
<FONT style="font-size:12px;">
<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-deleaded&lid=$lid&return_page=editLandlord";?>">De-Leaded</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-furnished&lid=$lid&return_page=editLandlord";?>">Furnished</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-smoker&lid=$lid&return_page=editLandlord";?>">Non-Smoking</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-alarm&lid=$lid&return_page=editLandlord";?>">Alarm</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-highceil&lid=$lid&return_page=editLandlord";?>">High Ceilings</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-cac&lid=$lid&return_page=editLandlord";?>">Central A/C</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-ac&lid=$lid&return_page=editLandlord";?>">A/C</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-hw&lid=$lid&return_page=editLandlord";?>">Hot Water</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-hhw&lid=$lid&return_page=editLandlord";?>">Heat &amp; Hot Water</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-elec&lid=$lid&return_page=editLandlord";?>">Electricity</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-allutil&lid=$lid&return_page=editLandlord";?>">All Utilities</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-hsi&lid=$lid&return_page=editLandlord";?>">High-Speed Internet</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-wicl&lid=$lid&return_page=editLandlord";?>">Walk-in Closet</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-modbath&lid=$lid&return_page=editLandlord";?>">Modern Bath</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-whirl&lid=$lid&return_page=editLandlord";?>">Whirlpool Tub</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-fpwkg&lid=$lid&return_page=editLandlord";?>">Working Fireplace</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-fpdec&lid=$lid&return_page=editLandlord";?>">Decorative Fireplace</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-hwf&lid=$lid&return_page=editLandlord";?>">Hardwood Floors</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-carpet&lid=$lid&return_page=editLandlord";?>">Carpet</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-kitmod&lid=$lid&return_page=editLandlord";?>">Modern Kitchen</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-kitg&lid=$lid&return_page=editLandlord";?>">Galley Kitchen</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-kitk&lid=$lid&return_page=editLandlord";?>">Kitchenette</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-kiteik&lid=$lid&return_page=editLandlord";?>">Eat-in Kitchen</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-mwave&lid=$lid&return_page=editLandlord";?>">Microwave</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-pantry&lid=$lid&return_page=editLandlord";?>">Pantry</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-rangegas&lid=$lid&return_page=editLandlord";?>">Gas Range</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-rangeelec&lid=$lid&return_page=editLandlord";?>">Electric Range</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-disp&lid=$lid&return_page=editLandlord";?>">Disposal</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-dish&lid=$lid&return_page=editLandlord";?>">Dishwasher</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-diningr&lid=$lid&return_page=editLandlord";?>">Dining Room</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-skylight&lid=$lid&return_page=editLandlord";?>">Skylight</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-balcony&lid=$lid&return_page=editLandlord";?>">Balcony</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-patio&lid=$lid&return_page=editLandlord";?>">Patio</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-porch&lid=$lid&return_page=editLandlord";?>">Porch</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-porche&lid=$lid&return_page=editLandlord";?>">Enclosed Porch</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-deck&lid=$lid&return_page=editLandlord";?>">Deck</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-duplex&lid=$lid&return_page=editLandlord";?>">Duplex</A><BR>
</LI>

<BR>________<BR>
<BR>
<FONT style="font-size:15px;"><B>Schools:</B><BR></FONT>
<BR>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-s-students&lid=$lid&return_page=editLandlord";?>">Students</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-s-college&lid=$lid&return_page=editLandlord";?>">College</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-s-district&lid=$lid&return_page=editLandlord";?>">School District</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-s-elem&lid=$lid&return_page=editLandlord";?>">Elementary School</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-s-mid&lid=$lid&return_page=editLandlord";?>">Middle School</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-s-high&lid=$lid&return_page=editLandlord";?>">High School</A><BR>
</LI>




</FONT>

</TD><TD><NOBR> &nbsp;&nbsp;&nbsp;&nbsp; </NOBR></TD><TD VALIGN="TOP">
<FONT style="font-size:15px;">
<B>AMENITIES:</B><BR>
<BR>
<FONT style="font-size:12px;">


<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-concierge&lid=$lid&return_page=editLandlord";?>">Concierge</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-security&lid=$lid&return_page=editLandlord";?>">Security</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-super&lid=$lid&return_page=editLandlord";?>">Superintendent</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-osman&lid=$lid&return_page=editLandlord";?>">On-site Management</A><BR>
</LI>


<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-oocc&lid=$lid&return_page=editLandlord";?>">Owner Occupied</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-roofd&lid=$lid&return_page=editLandlord";?>">Roof Deck</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-garden&lid=$lid&return_page=editLandlord";?>">Garden</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-yard&lid=$lid&return_page=editLandlord";?>">Yard</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-elevator&lid=$lid&return_page=editLandlord";?>">Elevator</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-clubh&lid=$lid&return_page=editLandlord";?>">Club House</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-healthc&lid=$lid&return_page=editLandlord";?>">Health Club</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-pool&lid=$lid&return_page=editLandlord";?>">Pool</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-sauna&lid=$lid&return_page=editLandlord";?>">Sauna</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-tennis&lid=$lid&return_page=editLandlord";?>">Tennis</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-lounge&lid=$lid&return_page=editLandlord";?>">Lounge</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-busc&lid=$lid&return_page=editLandlord";?>">Business Center</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-attic&lid=$lid&return_page=editLandlord";?>">Attic</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-basement&lid=$lid&return_page=editLandlord";?>">Basement</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-bin&lid=$lid&return_page=editLandlord";?>">Storage Bin</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-wheelc&lid=$lid&return_page=editLandlord";?>">Wheelchair Access</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-subway&lid=$lid&return_page=editLandlord";?>">Subway</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-crail&lid=$lid&return_page=editLandlord";?>">Commuter Rail</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-bus&lid=$lid&return_page=editLandlord";?>">Bus</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-sbus&lid=$lid&return_page=editLandlord";?>">Shuttle Bus</A><BR>
</LI>

<LI> <A HREF="<?php echo "$PHP_SELF?op=global-Landlord-f-laundry&lid=$lid&return_page=editLandlord";?>">Laundry</A><BR>
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
