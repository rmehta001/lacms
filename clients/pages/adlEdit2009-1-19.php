<!--Begin adlEdit -->
<BR>
<div align="left" style="padding:0px;margin:px;border:1px solid black;width:745;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:14px;color:black;">
<!--Tabs-->

<TABLE WIDTH="100%"><TR><TD>

<?php include ("folderTabs2.php"); ?>
<!--/Tabs-->

</TD><TD>

<table border="0" height="15">
	<tr>
	<td>

<span style="font-size:10px;">VIEW:</span></td>
	<td width="15" height="15"><img style="cursor:hand;" onClick="selectView('simple');"  src="../assets/images/simple.gif" width="15" height="15"></td>
	<td width="15" height="15"><img style="cursor:hand;" onClick="selectView('full');" src="../assets/images/full.gif" width="15" height="15"></td>
	</tr>
	<tr>
	<?php 
	if ($pref_adl_view==1) {
		$simpleSel = "select.gif";
		$fullSel = "wht_spacer.gif";
		$selTitle ="simple_t.gif";
	}elseif ($pref_adl_view==2) {
		$simpleSel = "wht_spacer.gif";
		$fullSel = "select.gif";
		$selTitle ="full_t.gif";
	}
	?>
	
	<td align="center" width="15" height="10"><img src="../assets/images/wht_spacer.gif" width="0" height="0"></td>  
	<td align="center" width="15" height="5"><img id="simpleSel" name="simpleSel" src="../assets/images/<?php echo $simpleSel;?>" width="5" height="5"></td>
	<td align="center" width="15" height="5"><img id="fullSel" name="fullSel" src="../assets/images/<?php echo $fullSel;?>" width="5" height="5"></td>  
	</tr>
	<tr>
	<td colspan="3" align="right"><img id="selTitle" name="selTitle" height="13" width="37" src="../assets/images/<?php echo $selTitle;?>"></td>
	</tr>
</table>
</TD></TR></TABLE>



<table width=100% border=0>
<tr>
<td valign="top" colspan=2>
<?php if($cid) {?>
<span align="left" style="padding:5px;margin:2px;font-size:11px;text-align:left;color:black;Background-Color : #CCFFFF">
<?php if ($user_level>1) { ?><a href="<?php echo "$PHP_SELF?op=delete&cid=$cid";?>"><span style="" >Delete</span></a> | <?php }?>
<a href="<?php echo "$PHP_SELF?op=copy&cid=$cid";?>"><span style="" >Copy</span><a> | 
<a href="<?php echo "$PHP_SELF?op=hot_list_add&item_type=1&item_id=$rowGetAd->CID&return_page=sel&return_page_rid=$rowGetAd->CID";?>"><span style="" >Add to Hot List</span></a> | <a href="<?php echo "$PHP_SELF?op=mail_listing&cid=$rowGetAd->CID";?>">Email Listing</A> <?php if 
($user_level>0) {?>
<?php if($rowGetAd->LID) {?>
| <a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$rowGetAd->LANDLORD";?>" target="_NEW"><img border=0 src="../images/icons/edit.gif" alt="edit">Edit Landlord</a> | <A HREF="<?php echo "$PHP_SELF?op=openhouse-add&CID=$rowGetAd->CID&return_page=adlEdit";?>">Create Open House</A>
</SPAN>



<?php }?>
<?php }?>


<br></span> 
<?php }else {?>
<span align="left" style="padding:5px;margin:2px;font-size:10px;text-align:left;color:white;">
<span style="" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> | 
<span style="" >&nbsp;&nbsp;&nbsp;&nbsp;</span> | 
<span style="" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span> 
<?php }?>

</td>
</tr>
<tr>
<td style="font-size:10px;margin:5px;padding:10px;" VALIGN="TOP">
<?php if ($cid) {?>
Ad ID#: <?php echo "$rowGetAd->ABV";?>-<?php echo "$rowGetAd->CID";?> <br>
Created by: <?php echo "$rowGetAd->HANDLE";?> <br>
On: <?php echo "$rowGetAd->DATEIN";?> <br>
Last Modifed on: <?php echo "$rowGetAd->MOD";?><br>
Last Modifed by: <?php echo "$rowGetAd->MODBY";?><br>
Status: <?php if ($rowGetAd->STATUS=="ACT") {
				echo "Active Ad";
			}else {
				echo "Inactive Ad";
			} ?>


 / Unit is <?php if ($rowGetAd->STATUS_ACTIVE=="1") {
				echo "Available";
			}else {
				echo "Unavailable";
			} ?>
<?php }else {?>
	&nbsp;



<?php }?>
<BR>
<P>
&nbsp;&nbsp;<a href="<?php echo "$PHP_SELF?op=return_page_op";?>"><img hspace="0" vspace="0" border="0" width="62" height="20" src="../assets/images/return.jpg"></a>


</td>
<td>




	
	<div class="ad" align="left">

<TABLE CELLPADDING="0" CELLSPACING="3" BORDER="0"><TR><TD VALIGN="TOP">

<?php if ($rowGetAd->LANDLORD) {?>

<div class="ad" align="left">

	<?php echo display_landlord($rowGetAd);?>

<P>

	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none&vid=7&sortD=ASC&sort=STREET,%20STREET_NUM,%20APT";?>" method="POST" target="_NEW">
	<input type="hidden" name="filterChange" value="1">
	<input type="hidden" name="landlord" value="<?php echo $rowGetAd->LANDLORD;?>">
	<input type="submit" value="View All Listings For This Landlord" STYLE="Background-Color : #CCFFFF">
	</form>

	</div>
	<?php }else {?>
 <IMG SRC="../assets/images/spacer.gif" WIDTH="270" HEIGHT="1">
	<?php } ?>
</TD>
<TD> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </TD>

<TD VALIGN="TOP">

<?php if ($rowGetAd->CID) {?>

<?php 
      $quStrGetPics = "SELECT * FROM PICTURE WHERE `CID`=$rowGetAd->CID ORDER BY PID LIMIT 1";
      $quGetPics = mysqli_query($dbh, $quStrGetPics);
      $rowGetPics = mysqli_fetch_object($quGetPics);

if ($rowGetPics)
{
      $thumb="<IMG SRC=http://www.bostonapartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT HEIGHT=115 WIDTH=115 BORDER=0>";

 
} else {$thumb="";}



echo "<a href=http://www.bostonapartments.com/homepage.php?cli=$rowGetAd->CLI&ad=$rowGetAd->CID target=_NEW>$thumb</A>";



;?>

<?php }?>



</TD></TR></TABLE>




</td>


</tr>
</table>

			

<form id="adlEditForm" name="adlEditForm" action="<?php echo "$PHP_SELF?op=adlEditDo";?>" method="POST">
<input type="hidden" name="cid" value="<?php echo $cid;?>">
<input id="adlEditFormNav" type="hidden" name="adlEditNav" value="">
<?php
if ($pref_adl_view==1) {
	$display = "block";
}elseif ($pref_adl_view==2) {
	$display = "none";
}?>
<div id="simpleArea" style="margin:10px; padding:10px; background-color:#ffff99; border:1px solid black; display:<?php echo $display;?>;">

<CENTER>
<table width="95%" BORDER="0">
<tr>
<td><span style="font-size:10px;">
Type:<br><select id="simpleTYPE" name="TYPE" onChange="setFlagFee(this.selectedIndex); syncMeSelect('simpleTYPE', 'fullTYPE');" STYLE="Background-Color : #FFFFFF">
	<?php while ($rowTypes=mysqli_fetch_object($quTypes)) {	?>
	<option value="<?php echo $rowTypes->TYPE;?>" <?php if ($rowGetAd->TYPE==$rowTypes->TYPE) {
	echo " selected"; }?> >
	<?php echo $rowTypes->TYPENAME; ?></option>
	<?php }	?>
</select><br>
Location:<br><select id="simpleLOC" name='LOC' onChange="(syncMeSelect('simpleLOC', 'fullLOC'));" STYLE="Background-Color : #FFFFFF">
	<option value="--">Please choose a location:</option>
	<?php while ($rowFavLocs = mysqli_fetch_object($quFavLocs)) { ?>
	<option value="<?php echo $rowFavLocs->LOCID;?>" <?php if ($rowGetAd->LOC==$rowFavLocs->LOCID) {echo " selected"; $locSeled = ture; }?>><?php echo $rowFavLocs->LOCNAME;?></option>
	<?php } ?>
	<option value="0">--------------------</option>
	
	<?php while ($rowLocs = mysqli_fetch_object($quLocs)) {	?>
		<option value="<?php echo $rowLocs->LOCID; ?>" <?php if ($rowGetAd->LOC==$rowLocs->LOCID && $locSeled == false) {echo " selected"; }?> >
		<?php echo $rowLocs->LOCNAME; ?></option>
	<?php }	?>
</select>
</SPAN>
</td>
<td align="right">
<span style="font-size:10px;">
Bedrooms:<br><select id="simpleROOMS" name="ROOMS" onChange="syncMeSelect('simpleROOMS', 'fullROOMS');" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $key => $roomsValue) {  
	$selected = ($rowGetAd->ROOMS==$key) ? " selected " : ""; ?>
	<option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $roomsValue;?></option>
	<?php } ?>	
</select><br>
Bathrooms:<br><select id="simpleBATH" name="BATH" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bkey => $bathValue) { 
	$selected = ($rowGetAd->BATH==$bkey) ? " selected " : "";?>
	<option value="<?php echo $bkey;?>" <?php echo $selected;?>><?php echo $bathValue;?></option>
	<?php } ?>	
</select>
</SPAN>
</td>
</tr>
</table>
<table width="95%" BORDER=0>
<tr>
<td><span style="font-size:10px;">
<?php
if ($rowGetAd->TYPE == 1 ||$rowGetAd->TYPE == 4 || $rowGetAd->TYPE == 5 || (!$rowGetAd->TYPE)) {
	$sale_display = "none";
	$rental_display = "inline";
}else if ($rowGetAd->TYPE == 2 || $rowGetAd->TYPE == 3) {
	$sale_display = "inline";
	$rental_display = "none";
}?>
<span id="simpleSTATUS_SALEspan" style="display:<?php echo $sale_display;?>;">
Flag:<br><select id="simpleSTATUS_SALE" name="STATUS_SALE" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['STATUS_SALE'] as $sskey => $ssValue) { 
	$selected = ($rowGetAd->STATUS_SALE==$sskey) ? " selected " : "";?>
	<option value="<?php echo $sskey;?>" <?php echo $selected;?>><?php echo $ssValue;?></option>
	<?php } ?>
</select>
</span>
<span id="simpleNOFEEspan" style="display:<?php echo $rental_display;?>;">
Fee:<br><select name="NOFEE" id="simpleNOFEE" onChange="syncMeSelect('simpleNOFEE', 'fullNOFEE');" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['NOFEE'] as $fkey => $fValue) { 
	$selected = ($rowGetAd->NOFEE==$fkey) ? " selected " : "";?>
	<option value="<?php echo $fkey;?>" <?php echo $selected;?>><?php echo $fValue;?></option>
	<?php } ?>
</select>
</span>
</SPAN>
</td>

<td align="left">

<span style="font-size:10px;">
Price:<BR><b>$</b><input id="simplePRICE" type="text" name="PRICE" size="8" value="<?php echo $rowGetAd->PRICE;?>">
</SPAN>

</TD>

<td align="right">
<span style="font-size:10px;">
Availability date:<br>
<?php 
$getMon = subStr ($rowGetAd->AVAIL, 5, 2);
$getDay = subStr ($rowGetAd->AVAIL, 8, 2);
$getYear = subStr ($rowGetAd->AVAIL, 0, 4);
?>
<span style="font-size:10px;">Month:</span><select id="simplebbbMonth" name="bbbMonth" onChange="syncMeSelect('simplebbbMonth', 'fullbbbMonth');" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>                                                      
	<option value="01" <?php if ($getMon == "01") { echo " selected "; } ?>>Jan</option>
	<option value="02" <?php if ($getMon == "02") { echo " selected "; } ?>>Feb</option>
	<option value="03" <?php if ($getMon == "03") { echo " selected "; } ?>>Mar</option>
	<option value="04" <?php if ($getMon == "04") { echo " selected "; } ?>>Apr</option>
	<option value="05" <?php if ($getMon == "05") { echo " selected "; } ?>>May</option>
	<option value="06" <?php if ($getMon == "06") { echo " selected "; } ?>>Jun</option>
	<option value="07" <?php if ($getMon == "07") { echo " selected "; } ?>>Jul</option>
	<option value="08" <?php if ($getMon == "08") { echo " selected "; } ?>>Aug</option>
	<option value="09" <?php if ($getMon == "09") { echo " selected "; } ?>>Sep</option>
	<option value="10" <?php if ($getMon == "10") { echo " selected "; } ?>>Oct</option>
	<option value="11" <?php if ($getMon == "11") { echo " selected "; } ?>>Nov</option>
	<option value="12" <?php if ($getMon == "12") { echo " selected "; } ?>>Dec</option>
</select>
<span style="font-size:10px;">Day:</span><select id="simplebbbDay" name="bbbDay" onChange="syncMeSelect('simplebbbDay', 'fullbbbDay');" STYLE="Background-Color : #FFFFFF"> 
	<option value="--">--</option>
	<?php for ($i=1;$i<=31;$i++) {
		if ($i<=9) {
			$j = "0".$i;
		} else {
			$j = $i;
		}
	?>
	<option value="<?php echo $j;?>" <?php if ($getDay == $j) { echo " selected "; } ?>><?php echo $j;?></option>
	<?php } ?>
</select>
<span style="font-size:10px;">Year</span><select id="simplebbbYear" name="bbbYear" onChange="syncMeSelect('simplebbbYear', 'fullbbbYear');" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php 
	$thisYear = date ("Y") - 1;
	for ($i=0;$i<=4;$i++) {?>
	<option value="<?php echo ($thisYear + $i);?>" <?php if ($getYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
	<?php }?>
</select>
</SPAN>
</td>
</tr>
</table>


<table width="95%" BORDER=0>
<tr>


<TD width="25%">
<span style="font-size:10px;">
Pets:<BR><select id="simplePETSA" name="PETSA" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['PETSA'] as $petkey => $petVal) { ?>
	<option value="<?php echo $petkey;?>" <?php if ($rowGetAd->PETSA==$petkey) { echo " selected "; }?>><?php echo $petVal;?></option>
	<?php }?>
</select>
</SPAN>
</TD>

<td align="center" height="30" bgcolor="#FFFF99" width="25%">
<span style="font-size:10px;">
Number of Parking spaces:<BR>
<select id="simplePARKING_NUM" name="PARKING_NUM" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['PARKING_NUM'] as $pknkey => $pknValue) { 
						$selected = ($rowGetAd->PARKING_NUM==$pknkey) ? " selected " : "";?>
						<option value="<?php echo $pknkey;?>" <?php echo $selected;?>><?php echo $pknValue;?></option>
					<?php } ?>
			</select>

</SPAN>
</td>
<td align="center" height="30" bgcolor="#FFFF99" width="25%">
<span style="font-size:10px;">
Parking Space Type:<BR>

<select id="simplePARKING_TYPE" name="PARKING_TYPE" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['PARKING_TYPE'] as $parkkey => $parkVal) { ?>
					<option value="<?php echo $parkkey;?>" <?php if ($rowGetAd->PARKING_TYPE==$parkkey) { echo " selected "; }?> > <?php echo $parkVal;?> </option>
				<?php } ?>
			</select>
</SPAN>
</td>
<td align="center" height="30" bgcolor="#FFFF99" width="25%">
<span style="font-size:10px;">
Cost per Parking Space:<BR>
$<input id="simplePARKING_COST" type="text" name="PARKING_COST" size="5" value="<?php echo $rowGetAd->PARKING_COST;?>">

</SPAN>
</TD>
</tr></TABLE>


<table width="90%">
<tr>
<?php $adBody = ($rowGetAd->BODY) ? $rowGetAd->BODY : "Type your ad here.";?>
<td><textarea name="BODY" id="simpleBODY" cols="85" rows="6" onFocus=clear_textbox() value="Type your ad here."><?php echo $adBody;?></textarea>
</TD></TR></TABLE>

<table width="90%">
<TR><TD>
<input type="button" value="Check Spelling" onClick="openSpellChecker();"/>
</td><TD>


<td><span style="font-size:10px;">Display Personal Signature?: No<input type="radio" name="USE_USER_SIG" id="simpleUSE_USER_SIG" value="0"  checked> Yes<input type="radio" name="USE_USER_SIG" id="simpleUSE_USER_SIG" value="1" <?php if ($rowGetAd->USE_USER_SIG) {echo " checked "; } ?>></span></td>

</TD><TD>
<span style="font-size:10px;">
<input type="hidden" name="STATUS" value="STO"><input id="simpleSTATUS" type="checkbox" name="STATUS" value="ACT"
 <?php if ($rowGetAd->STATUS!=='STO') { echo " checked "; }?>>Advertising? (green light) </SPAN></td>

</tr>
</table>


<table width="90%">
<tr>
<td><span style="font-size:10px;">Offer Map in Ad (must fill in at least the ZIP code below):</span><br><select name="MAP" STYLE="Background-Color : #FFFFFF">
<option value="0">No Map</option>
<?php
$quStrGetMaps = "select * from MAP_OFFER";
$quGetMaps = mysqli_query($dbh, $quStrGetMaps) or die (mysqli_error($dbh));
while ($rowGetMaps = mysqli_fetch_object($quGetMaps)) {
	?><option value="<?php echo $rowGetMaps->id;?>" <?php if ($rowGetAd->MAP==$rowGetMaps->id) { echo "selected";}?>><?php echo $rowGetMaps->title;?></option>
<?php } ?>
</select>
<script>

</script>

</td>
<td align="right">

<?php if ($user_level>0) {?>

<input onClick="validateAdlEdit('simple');" type="button" value="Save" STYLE="Background-Color : #E0FFFF">

<?php }?>
</td>

</tr>
</table>

<TABLE CELLPADDING=0 CELLSPACING=0 width="90%"><TR><TD>

Virtual Tour URL:

</TD><TD>

<input type="text" size="40" name="VIRT_TOUR" value="<?php echo $rowGetAd->VIRT_TOUR;?>">

</TD></TR><TR><TD COLSPAN=2 VALIGN=TOP>

<span style="font-size:8px;">(Include "http://",  example:  http://www.example.com/my_virtual_tour.htm)</span>

</TD></TR><TR><TD>

YouTube URL:

</TD><TD>

<input type="text" size="40" name="YOUTUBEURL" value="<?php echo $rowGetAd->YOUTUBEURL;?>">

</TD></TR><TR><TD COLSPAN=2 VALIGN=TOP>

<span style="font-size:8px;">(Include "http://",  this is the page URL at YouTube)</span>

</TD></TR><TR><TD>

YouTube Embed Code:

</TD><TD>



<input type="text" size="40" name="YOUTUBE" value="<?php echo htmlspecialchars($rowGetAd->YOUTUBE);?>">
</TR><TR><TD COLSPAN=2 VALIGN=TOP>
<span style="font-size:8px;">(The code to embed a YouTube video on a page)</span>

</TD></TR></TABLE>


<hr noshade color="black">
<table width="90%">
<tr>
<td>Information not displayed in Ad:</td> <TD> &nbsp; </TD><TD align=center>
<span style="font-size:10px;">
<input type="checkbox" value=1 name="FEATURED" <?php if ($rowGetAd->FEATURED>0) {
echo " checked "; } ;?>>Featured Listing &nbsp; | &nbsp; <input type="checkbox" value=1 name="COBROKE" <?php if ($rowGetAd->COBROKE>0) {
echo " checked "; } ;?>>Co-Broke this Listing</span>



</span>
</TD>
</tr>
</table>

<table width="90%" border=0><tr><td>


<TABLE Border=0><TR><TD VALIGN="TOP">

<table Border=0>
<tr>
<td>Address:</td>
</tr>
<tr>
<td>
<span style="font-size:10px;">Number:</span><br><input type="text" id="simpleSTREET_NUM" name="STREET_NUM" size="4" value="<?php echo $rowGetAd->STREET_NUM;?>"></td><td><span style="font-size:10px;">Street:</span><br><input type="text" id="simpleSTREET" name="STREET" size="24" value="<?php echo $rowGetAd->STREET;?>"></td>
</tr>
<tr>
<td><span style="font-size:10px;">Apt:</span><br><input type="text" id="simpleAPT" name="APT" size="4" value="<?php echo $rowGetAd->APT;?>"></td><td><span style="font-size:10px;">Floor:</span><br><input type="text" id="simpleFLOOR" name="FLOOR" size="4" value="<?php echo $rowGetAd->FLOOR;?>"></td>
</tr>
<tr>
<td><span style="font-size:10px;">Zip:</span><br><input type="text" id="simpleZIP" name="ZIP" size="11" value="<?php echo $rowGetAd->ZIP;?>"></td>
<td><span style="font-size:10px;">Cross Street:</span><br><input type="text" id="xstreet" name="xstreet"" size="24" value="<?php echo $rowGetAd->xstreet;?>"></td>
</tr>
</table>

<TABLE><TR><TD VALIGN="TOP">

<div class="ad" align="left">
Change Landlord:<BR>
<select id="simpleLANDLORD" name="LANDLORD" onChange="syncMeSelect('simpleLANDLORD', 'fullLANDLORD');" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
	<option value="<?php echo $rowGetLandlord->LID; ?>" <?php if ($rowGetAd->LANDLORD==$rowGetLandlord->LID) { echo " selected "; } ?>><?php echo $rowGetLandlord->SHORT_NAME;?></option>
	<?php } ?>
</select>
<BR>
<a href="<?php echo "$PHP_SELF?op=createLandlord";?>" target="_NEW">Create New Landlord</a><BR>
<a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$rowGetAd->LANDLORD";?>" target="_NEW">Edit Landlord</a>
</DIV>


</TD><TD VALIGN="TOP">
<?php 
if ($isAdmin) {?>
	<td align="right" VALIGN="TOP">
<div class="ad" align="left">
Change Agent:<br>
	<select name="UID" STYLE="Background-Color : #FFFFFF">
		<?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) { ?>
		<option value="<?php echo $rowGetUsers->UID;?>" <?php if ($rowGetAd->UID==$rowGetUsers->UID) { echo "selected "; }?>><?php echo $rowGetUsers->HANDLE; ?></option>
		<?php } ?> 
	</select></td>
<?php }?>
</DIV>
<TD  VALIGN="TOP">
<img src="../assets/images/wht_spacer.gif" width="15" height="0">
</TD><TD align="right"  VALIGN="TOP">

<?php
if ($isAdmin && $agcy>0) {
$quStrGetAgencies = "SELECT * FROM AGENCIES WHERE GID=$grid";
$quGetAgencies = mysqli_query($dbh, $quStrGetAgencies) or die ($quStrGetAgencies);
$num_agencies=mysqli_num_rows($quGetAgencies);
if($num_agencies>0)
{
        while($rowAgency = mysqli_fetch_object($quGetAgencies))
        {
                $arrayAgency[$rowAgency->AGENCY_ID]=$rowAgency->AGENCY_NAME;
        }
        echo "<div class=ad align=left>Change Agency:<br><select name=AGENCY_HEADERS STYLE=Background-Color : #FFFFFF>";
?>
        <option value=0 <?php if ($key>0)
                {       echo " selected "; } ?>
                >Main Agency</option>
        <?php foreach($arrayAgency as $key => $value)
        { ?>
                <option value="<?php echo $key; ?>"
        <?php if ($key==$rowGetAd->AGENCY_HEADERS)
                { echo " selected ";}
        ?> >
                <?php echo $value; ?></option>
        <?php
//             echo "$key $value";
        }
        echo "</select></DIV>";
} ?>
<?php }?>


</TD></TR></TABLE>


</TD><TD WIDTH="10"> <img src="../assets/images/wht_spacer.gif" width="10" height="0"> </TD><TD VALIGN="TOP" BGCOLOR="#FFFFCC">



<?php if ($rowGetAd->CLI != "") { ?>


<TABLE CELLPADDING="3" WIDTH="210" BORDER="1"><TR><TD>
<CENTER><B>Helpful Tools</B></CENTER>

<span style="font-size:12px;">

<LI><B>NEARBY:</B>  &nbsp;&nbsp;&nbsp; <A HREF="http://mbta.com/rider_tools/servicenearby/?saServiceNearBy=<?php echo $rowGetAd->STREET_NUM;?>+<?php echo $rowGetAd->STREET;?>%2C++<?php echo $rowGetAd->ZIP;?>&sLocationServiceNearBy" target="_NEW">MBTA</A> | <A HREF="http://maps.google.com/maps?hl=en&um=1&ie=UTF-8&q=laundromat&near=<?php echo $rowGetAd->STREET_NUM;?>+<?php echo $rowGetAd->STREET;?>+<?php echo $rowGetAd->ZIP;?>&fb=1&sa=X&oi=local_group&resnum=1&ct=image" target="_NEW">Laundry</A><BR>

<A HREF="http://maps.google.com/maps?hl=en&um=1&ie=UTF-8&q=supermarket&near=<?php echo $rowGetAd->STREET_NUM;?>+<?php echo $rowGetAd->STREET;?>+<?php echo $rowGetAd->ZIP;?>&fb=1&sa=X&oi=local_group&resnum=1&ct=image" target="_NEW">Supermarket</A> | <A HREF="http://maps.google.com/maps?hl=en&um=1&ie=UTF-8&q=convenience+store&near=<?php echo $rowGetAd->STREET_NUM;?>+<?php echo $rowGetAd->STREET;?>+<?php echo $rowGetAd->ZIP;?>&fb=1&sa=X&oi=local_group&resnum=1&ct=image" target="_NEW">Convenience Store</A><BR>

<LI><A HREF="http://maps.google.com/maps?f=&hl=&q=+<?php echo $rowGetAd->STREET_NUM;?>+<?php echo $rowGetAd->STREET;?>+<?php echo $rowGetAd->ZIP;?>" target="_NEW">Google Map</A> | <A HREF="http://maps.yahoo.com/#mvt=m&lat=42.350119&lon=-71.160553&mag=3&q1=<?php echo $rowGetAd->STREET_NUM;?>%20<?php echo $rowGetAd->STREET;?>%20<?php echo $rowGetAd->ZIP;?>" target="_NEW">Yahoo Map</A><BR>

<LI><A HREF="http://www.rentometer.com/?country=US&citystatezip=<?php echo $rowGetAd->ZIP;?>&show=results&beds=<?php echo $rowGetAd->ROOMS;?>&rent_amount=<?php echo $rowGetAd->PRICE;?>&address=<?php echo $rowGetAd->STREET_NUM;?>+<?php echo $rowGetAd->STREET;?>" target="_NEW">RentoMeter</A><SUP><FONT SIZE="-2">TM</FONT></SUP><BR>

<LI><A HREF="http://www.zilpy.com/US/Massachusetts/z/z/Zipcode_<?php echo $rowGetAd->ZIP;?>" target="_NEW">Zilpy Info</A><BR>

<LI><A HREF="http://www.zillow.com/search/RealEstateSearch.htm?dg=dg2&addrstrthood=<?php echo $rowGetAd->STREET_NUM;?>+<?php echo $rowGetAd->STREET;?>&citystatezip=<?php echo $rowGetAd->ZIP;?>&GOButton=" target="_NEW">Zillow Zestimate</A><SUP><FONT SIZE="-2">TM</FONT></SUP><BR>

<LI><A HREF="http://massachusetts.schooltree.org/<?php echo $rowGetAd->ZIP;?>.html" target="_NEW">School Information</A><BR>

<LI><a href="http://www.bostonapartments.com/homepage.php?cli=<?php echo $grid;?>&ad=<?php echo $cid;?>" target="_NEW">Preview Ad</a><BR>

<LI><a href="http://www.bostonapartments.com/viewsource.php?u=homepage.php?cli=<?php echo $grid;?>%26ad=<?php echo $cid;?>" target="_NEW">HTML Ad Maker</A><BR>

<LI><a href="http://www.bostonapartments.com/clpost.php?cli=<?php echo $rowGetAd->CLI;?>&amp;ad=<?php echo $cid;?>&amp;uid=<?php echo $rowGetAd->UID;?>" target="_NEW">Post To Craigslist</A><BR>
</SPAN>
</TD></TR></TABLE>


<?php } ?>


</TD></TR></TABLE>

<CENTER><table width="90%" BORDER=0>
<tr>
<td align="center">
<?php if ($user_level>0) {?>
<input onClick="validateAdlEdit('simple');" type="button" value="Save" STYLE="Background-Color : #E0FFFF">
<?php }?>
</td>
</tr>
</table></CENTER>
</td><td valign=top align=right>

&nbsp;


</td></tr>
</table>
</div>

<?php
if ($pref_adl_view==1) {
	$display = "none";
}elseif ($pref_adl_view==2) {
	$display = "block";
}?>
<div id="fullArea" style="display:none;height:100%; margin:8px; padding:8px; background-color:#ffff99; border:1px solid black;display:<?php echo $display;?>;">

<CENTER>

<table width="100%" BORDER=0>
			<tr>
			
			<td height="30" width="20" bgcolor="#FFFF99"><span style="font-size:10px;">Landlord:<BR><select id="fullLANDLORD" name="LANDLORD" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php 
				mysqli_data_seek($quLandlord, 0);
				while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
				<option value="<?php echo $rowGetLandlord->LID; ?>" <?php if ($rowGetAd->LANDLORD==$rowGetLandlord->LID) { echo " selected "; } ?>><?php echo $rowGetLandlord->SHORT_NAME;?></option>
				<?php } ?>
			</select></td>
			<td height="30" bgcolor="#FFFF99">

<span style="font-size:10px;">Location:<BR></span><select id="fullLOC" name='LOC' STYLE="Background-Color : #FFFFFF">
			<option value="--">Please choose a location:</option>
			<?php 
			mysqli_data_seek($quFavLocs, 0);
			mysqli_data_seek($quLocs, 0);
			while ($rowFavLocs = mysqli_fetch_object($quFavLocs)) { ?>
			<option value="<?php echo $rowFavLocs->LOCID;?>"><?php echo $rowFavLocs->LOCNAME;?></option>
			<?php } ?>
			<option value="0">--------------------</option>
			
			<?php while ($rowLocs = mysqli_fetch_object($quLocs)) {	?>
				<option value="<?php echo $rowLocs->LOCID; ?>" <?php if ($rowGetAd->LOC==$rowLocs->LOCID) {echo " selected"; }?> >
				<?php echo $rowLocs->LOCNAME; ?></option>
			<?php }	?>
			</select>

</td>
			<td height="30" bgcolor="#FFFF99"><span style="font-size:10px;">Type:<BR></span><select id="fullTYPE" name="TYPE" onChange="setFlagFee(this.selectedIndex); syncMeSelect('simpleTYPE', 'fullTYPE');" STYLE="Background-Color : #FFFFFF">
			<?php 
			mysqli_data_seek($quTypes, 0);
			while ($rowTypes=mysqli_fetch_object($quTypes)) {	?>
				<option value="<?php echo $rowTypes->TYPE;?>" <?php if ($rowGetAd->TYPE==$rowTypes->TYPE) {
					echo " selected"; }?> >
				<?php echo $rowTypes->TYPENAME; ?></option>
			<?php }	?>
			</select></td>
			</tr>
</TABLE>


<TABLE WIDTH="100%" BORDER=0>
			<tr>
			<td height="30" width="20" bgcolor="#FFFF99">



<TABLE BORDER=0><TR><TD>
<span style="font-size:10px;">Bedrooms:<BR></span><select id="fullROOMS" name="ROOMS" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $key => $roomsValue) {  
					$selected = ($rowGetAd->ROOMS==$key) ? " selected " : ""; ?>
					<option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $roomsValue;?></option>
				<?php } ?>	
			</select>

</TD><TD>
			<span style="font-size:10px;">Bathrooms:<BR></span><select id="fullBATH" name="BATH" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bkey => $bathValue) { 
					$selected = ($rowGetAd->BATH==$bkey) ? " selected " : "";?>
				<option value="<?php echo $bkey;?>" <?php echo $selected;?>><?php echo $bathValue;?></option>
				<?php } ?>	
			</select>

</TD>
		<td bgcolor="#FFFF99" align="left">

<span style="font-size:10px;"><NOBR>Total # Rooms:</NOBR><BR></span><input type="text" size="5" id="fullTOTAL_NUM_ROOMS" name="TOTAL_NUM_ROOMS" value="<?php echo $rowGetAd->TOTAL_NUM_ROOMS;?>">
</TD>
<TD align="left">
<span style="font-size:10px;">SqFt:<BR></span>

<input type="text" size="5" name="SQFT" value="<?php echo $rowGetAd->SQFT;?>">

</td>
</TR></TABLE>



</td>
<TD>&nbsp;</TD>

			<td height="30" bgcolor="#FFFF99"><span style="font-size:10px;"><NOBR>Colleges Nearby:</NOBR><BR></span><select name="SCHOOL" STYLE="Background-Color : #FFFFFF">
			<option value="--">--</option>
			<?php foreach ($DEFINED_VALUE_SETS['SCHOOL'] as $schkey => $schVal) { ?>
			<option value="<?php echo $schkey;?>" <?php if ($rowGetAd->SCHOOL==$schkey) { echo " selected "; }?>><?php echo $schVal;?></option>
			<?php }?>
			</select></td>
			</tr>

</TABLE>


<TABLE WIDTH="100%" BORDER=0><TR>
			
			<td height="30" width="1" bgcolor="#FFFF99" ALIGN="LEFT">

<CENTER>
				<TABLE BORDER=0 CELLPADDING="0" CELLSPACING="0">
				<tr>
				<td><span style="font-size:10px;">Heating:<BR></span> <select name="HEATING_RESP" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['HEATING_RESP'] as $hskey => $hsValue) { 
						$selected = ($rowGetAd->HEATING_RESP==$hskey) ? " selected " : "";?>
						<option value="<?php echo $hskey;?>" <?php echo $selected;?>><?php echo $hsValue;?></option>
					<?php } ?>
			</select></CENTER></td>
<TD WIDTH="1">&nbsp;</TD>
				<td><span style="font-size:10px;">Type:<BR></span><select name="HEATING_TYPE" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['HEATING_TYPE'] as $htkey => $htValue) { 
						$selected = ($rowGetAd->HEATING_TYPE==$htkey) ? " selected " : "";?>
						<option value="<?php echo $htkey;?>" <?php echo $selected;?>><?php echo $htValue;?></option>
					<?php } ?>
			</select></td></tr></TABLE>

</td>			
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td colspan="2" bgcolor="#FFFF99" align="left">

<table BORDER=0 CELLPADDING="0" CELLSPACING="0"><tr>
				 <td><span style="font-size:10px;">Hot Water:<BR></span> <select name="HOT_WATER_RESP" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['HOT_WATER_RESP'] as $hwkey => $hwValue) { 
						$selected = ($rowGetAd->HOT_WATER_RESP==$hwkey) ? " selected " : "";?>
						<option value="<?php echo $hwkey;?>" <?php echo $selected;?>><?php echo $hwValue;?></option>
					<?php } ?>
			</select></td>

<TD WIDTH="1">&nbsp;</TD>
				<td><span style="font-size:10px;">Type:<BR></span><select name="HOT_WATER_TYPE" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['HOT_WATER_TYPE'] as $hwkey => $hwValue) { 
						$selected = ($rowGetAd->HOT_WATER_TYPE==$hwkey) ? " selected " : "";?>
					<option value="<?php echo $hwkey;?>" <?php echo $selected;?>><?php echo $hwValue;?></option>
					<?php } ?>
			</select></td>
				</tr></table>
</td>

			<td bgcolor="#FFFF99" align="left" valign="bottom"><span style="font-size:10px;">Pets:<BR></span>
<select id="fullPETSA" name="PETSA" STYLE="Background-Color : #FFFFFF">
			<option value="--">--</option>
			<?php foreach ($DEFINED_VALUE_SETS['PETSA'] as $petkey => $petVal) { ?>
			<option value="<?php echo $petkey;?>" <?php if ($rowGetAd->PETSA==$petkey) { echo " selected "; }?>><?php echo $petVal;?></option>
			<?php }?>
			</select></td>



			<td bgcolor="#FFFF99" align="left" valign="bottom"><span style="font-size:10px;">Students:<BR></span>
<select name="STUDENTS" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['STUDENTS'] as $studentKey => $studentVal) {?>
				<option value="<?php echo $studentKey;?>" <?php if ($rowGetAd->STUDENTS==$studentKey) { echo " selected ";}?>><?php echo $studentVal;?></option>
				<?php }?>
				</select>

</td>




		</tr>
		</table>

		<hr noshade size="1" color="black">

<table width="100%" BORDER="0">
			<tr>
			<td colspan="11" bgcolor="#FFFF99" align="center" valign="middle"><span style="font-size:12px;"><B>Availability, Price & Address:</B></span></td>
			</tr>
			<?php 
			$getMon = subStr ($rowGetAd->AVAIL, 5, 2);
			$getDay = subStr ($rowGetAd->AVAIL, 8, 2);
			$getYear = subStr ($rowGetAd->AVAIL, 0, 4);
			?>
			<tr>
			
			<td height="30" width="20" bgcolor="#FFFF99"><span style="font-size:10px;">Month:<BR></span><select id="fullbbbMonth" name="bbbMonth" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>                                                      
				<option value="01" <?php if ($getMon == "01") { echo " selected "; } ?>>Jan</option>
				<option value="02" <?php if ($getMon == "02") { echo " selected "; } ?>>Feb</option>
				<option value="03" <?php if ($getMon == "03") { echo " selected "; } ?>>Mar</option>
				<option value="04" <?php if ($getMon == "04") { echo " selected "; } ?>>Apr</option>
				<option value="05" <?php if ($getMon == "05") { echo " selected "; } ?>>May</option>
				<option value="06" <?php if ($getMon == "06") { echo " selected "; } ?>>Jun</option>
				<option value="07" <?php if ($getMon == "07") { echo " selected "; } ?>>Jul</option>
				<option value="08" <?php if ($getMon == "08") { echo " selected "; } ?>>Aug</option>
				<option value="09" <?php if ($getMon == "09") { echo " selected "; } ?>>Sep</option>
				<option value="10" <?php if ($getMon == "10") { echo " selected "; } ?>>Oct</option>
				<option value="11" <?php if ($getMon == "11") { echo " selected "; } ?>>Nov</option>
				<option value="12" <?php if ($getMon == "12") { echo " selected "; } ?>>Dec</option>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><span style="font-size:10px;">Day:<BR></span><select id="fullbbbDay" name="bbbDay" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php for ($i=1;$i<=31;$i++) {
					if ($i<=9) {
						$j = "0".$i;
					} else {
						$j = $i;
					}
				?>
				<option value="<?php echo $j;?>" <?php if ($getDay == $j) { echo " selected "; } ?>><?php echo $j;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><span style="font-size:10px;">Year:<BR></span><select id="fullbbbYear" name="bbbYear" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php 
				$thisYear = date ("Y") - 1;
				for ($i=0;$i<=4;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($getYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
				<?php }?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" bgcolor="#FFFF99" WIDTH="30">

<CENTER><TABLE CELLPADDING="0" CELLSPACING="0"><TR><TD>
<span style="font-size:10px;">Price:<BR></SPAN>$<input type="text" id="fullPRICE" name="PRICE" size="8" value="<?php echo $rowGetAd->PRICE;?>"></div>
</TD></TR></TABLE></CENTER>

</td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" bgcolor="#FFFF99" WIDTH="120">

<CENTER><TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD>
<span style="font-size:10px;"><NOBR>Price negotiable:</NOBR><br> No&nbsp; <input type="radio" value="0" name="PRICE_NEG" <?php if (!$rowGetAd->PRICE_NEG) { echo "checked"; }?> > Yes <input type="radio" value="1" name="PRICE_NEG" <?php if ($rowGetAd->PRICE_NEG) { echo "checked"; }?> >
</SPAN></TD>
</TR></TABLE>



<TD WIDTH="40"> &nbsp; </TD>


<TD ALIGN="RIGHT" WIDTH="40">

<?php if ($user_level>0) {?>
<input onClick="validateAdlEdit('full');" type="button" value="Save" STYLE="Background-Color : #E0FFFF">
<?php }?>



</CENTER>

	</td></tr></table>


<table BORDER="0">
			<tr>
			<td height="30" align="left" bgcolor="#FFFF99"><span style="font-size:10px;"><NOBR>Street #:</NOBR><BR></SPAN><input type="text" id="fullSTREET_NUM" name="STREET_NUM" size="4" value="<?php echo $rowGetAd->STREET_NUM;?>"></td>
<td height="30" colspan="3" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="110" bgcolor="#FFFF99"><span style="font-size:10px;">Street Address:<BR></span><input type="text" id="fullSTREET" name="STREET" size="24" value="<?php echo $rowGetAd->STREET;?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><span style="font-size:10px;"><NOBR>Apt #:</NOBR><BR></span><input type="text" id="fullAPT" name="APT" size="4" value="<?php echo $rowGetAd->APT;?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><span style="font-size:10px;">Floor:<BR></span><input type="text" id="fullFLOOR" name="FLOOR" size="4" value="<?php echo $rowGetAd->FLOOR;?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td align="left" height="30" width="30" bgcolor="#FFFF99"><span style="font-size:10px;">Zip:<BR></span><input type="text" id="fullZIP" name="ZIP" size="11" value="<?php echo $rowGetAd->ZIP;?>"></td>
			</tr>
			</table>



<center><span style="font-size:12px;"><B>Fee and Status:</B></span></CENTER>

			<table border=0 CELLPADDING=0 cellspacing=0>
			<tr>
			<td height="30" width="20" bgcolor="#FFFF99">

<span style="font-size:10px;">Status:</span><BR>
<select id="fullSTATUS_SALE" name="STATUS_SALE" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['STATUS_SALE'] as $sskey => $ssValue) { 
						$selected = ($rowGetAd->STATUS_SALE==$sskey) ? " selected " : "";?>
						<option value="<?php echo $sskey;?>" <?php echo $selected;?>><?php echo $ssValue;?></option>
					<?php } ?>
			</select></td> 

			
			<td height="30" width="20" bgcolor="#FFFF99"><span style="font-size:10px;">Fee:<BR></span><select id="fullNOFEE" name="NOFEE" STYLE="Background-Color : #FFFFFF">

					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['NOFEE'] as $fkey => $fValue) { 
						$selected = ($rowGetAd->NOFEE==$fkey) ? " selected " : "";?>
						<option value="<?php echo $fkey;?>" <?php echo $selected;?>><?php echo $fValue;?></option>
					<?php } ?>
			</select></td>
			<td height="30" bgcolor="#FFFF99"><span style="font-size:10px;"><NOBR>Advertising:<input type="hidden" name="STATUS" value="STO"><input id="fullSTATUS" type="checkbox" value="ACT" name="STATUS" <?php if ($rowGetAd->STATUS=="STO") { echo "";}else{ echo " checked "; } ?>>Vacant:<input type="hidden" name="VACANT" value="0"><input type="checkbox" value="1" name="VACANT" <?php if ($rowGetAd->VACANT) { echo " checked "; } ?>> Available:<input type="hidden" name="STATUS_ACTIVE" value="0"><input type="checkbox" value="1" name="STATUS_ACTIVE" <?php if (!$cid) { echo "checked"; } elseif ($rowGetAd->STATUS_ACTIVE) { echo " checked "; } ?>></NOBR></SPAN></td>
			</tr>
			</table>
			<table>
			<tr>
			<td height="30" bgcolor="#FFFF99"><span style="font-size:10px;">Listing type:<BR></SPAN><select name="LISTING_TYPE" STYLE="Background-Color : #FFFFFF">
						<option value="--">--</option>
						<?php foreach ($DEFINED_VALUE_SETS['LISTING_TYPE'] as $lskey => $lsVal) { ?>
						<option value="<?php echo $lskey;?>" <?php if ($rowGetAd->LISTING_TYPE==$lskey) { echo " selected "; } ?> ><?php echo $lsVal;?></option>
						<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" bgcolor="#FFFF99"><span style="font-size:10px;">Lease type:<BR></SPAN><select name="LEASE_TYPE" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['LEASE_TYPE'] as $lkey => $lVal) { ?>
					<option value="<?php echo $lkey;?>" <?php if ($rowGetAd->LEASE_TYPE==$lkey) { echo " selected "; }?> > <?php echo $lVal;?></option>
					<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" valign="bottom" align="center" bgcolor="#FFFF99"><span style="font-size:10px;">Terms (months):<BR></SPAN><input type="text" size="3" name="TERMS" value="<?php echo $rowGetAd->TERMS;?>"></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30"   bgcolor="#FFFF99"><span style="font-size:10px;">Tax Clause:<BR></span><select name="TAX_CLAUSE" STYLE="Background-Color : #FFFFFF">
				<option value=="--">--</option>

				<?php foreach ($DEFINED_VALUE_SETS['TAX_CLAUSE'] as $taxKey => $taxVal) {?>
					<option value="<?php echo $taxKey;?>" <?php if ($rowGetAd->TAX_CLAUSE==$taxKey) { echo " selected "; }?>><?php echo $taxVal;?></option>
				<?php }?>
				</select></td>
			
		</tr>
		</table>
		<hr noshade size="1" color="black">

<CENTER>

			<table>
			<tr>
			<td height="30" bgcolor="#FFFF99" width="40">

<span style="font-size:12px;"><B>Parking</B></SPAN></CENTER>

</TD>
			<td height="30" bgcolor="#FFFF99" width="30"> &nbsp; </TD>



			<td height="30" bgcolor="#FFFF99"><span style="font-size:10px;"># of spaces:<BR></span>
<select id="fullPARKING_NUM" name="PARKING_NUM" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['PARKING_NUM'] as $pknkey => $pknValue) { 
						$selected = ($rowGetAd->PARKING_NUM==$pknkey) ? " selected " : "";?>
						<option value="<?php echo $pknkey;?>" <?php echo $selected;?>><?php echo $pknValue;?></option>
					<?php } ?>
			</select></td>

			<td height="30" bgcolor="#FFFF99"><span style="font-size:10px;">Type:<BR></span>
<select id="fullPARKING_TYPE" name="PARKING_TYPE" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['PARKING_TYPE'] as $parkkey => $parkVal) { ?>
					<option value="<?php echo $parkkey;?>" <?php if ($rowGetAd->PARKING_TYPE==$parkkey) { echo " selected "; }?> > <?php echo $parkVal;?> </option>
				<?php } ?>
			</select></td>
			<td height="30" bgcolor="#FFFF99"><span style="font-size:10px;">Cost per Space:<BR></span>
$<input type="text" id="fullPARKING_COST" name="PARKING_COST" size="5" value="<?php echo $rowGetAd->PARKING_COST;?>"></td>


			</tr>
			</table>


		<hr noshade size="1" color="black">


		<table width="100%">
			<tr>
			<input type="hidden" name="AUTO_WRITE" value="0">
			<td align="left" height="30" bgcolor="#FFFF99" colspan="10"><div class="controltext"><input type="checkbox" name="AUTO_WRITE" value="1" <?php if($rowGetAd->AUTO_WRITE) { echo " checked "; } ?>> Check to Automatically List Features and Amenities in the advertisement</div></td>
			<td align="left" height="30" bgcolor="#FFFF99"> &nbsp;</td>
			
			</tr>
			<tr>
			<td colspan="10" height="30" bgcolor="#FFFF99">
<span style="font-size:12px;"><B>Features:</B></span>
</td>
			</tr>
			<tr>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="FEATURES_DELEADED" value="0">
				<tr><td align="right" class="controltext">Deleaded</td><td align="left"><input type="checkbox" name="FEATURES_DELEADED" value="1" <?php if ($rowGetAd->FEATURES_DELEADED) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_FURNISHED" value="0">
				<tr><td align="right" class="controltext">Furnished</td><td align="left"><input type="checkbox" name="FEATURES_FURNISHED" value="1" <?php if ($rowGetAd->FEATURES_FURNISHED) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_NON_SMOKING" value="0">
				<tr><td align="right" class="controltext">Non-smoking</td><td align="left"><input type="checkbox" name="FEATURES_NON_SMOKING" value="1" <?php if ($rowGetAd->FEATURES_NON_SMOKING) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_ALARM" value="0">
				<tr><td align="right" class="controltext">Alarm</td><td align="left"><input type="checkbox" name="FEATURES_ALARM" value="1" <?php if ($rowGetAd->FEATURES_ALARM) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_HIGH_CEILINGS" value="0">
				<tr><td align="right" class="controltext"><NOBR>High Ceilings</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_HIGH_CEILINGS" value="1" <?php if ($rowGetAd->AMENITIES_HIGH_CEILINGS ) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_CENTRAL_AC" value="0">
				<tr><td align="right" class="controltext">Central A/C </td><td align="left"><input type="checkbox" name="FEATURES_CENTRAL_AC" value="1" <?php if ($rowGetAd->FEATURES_CENTRAL_AC) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_AC" value="0">
				<tr><td align="right" class="controltext">A/C </td><td align="left"><input type="checkbox" name="FEATURES_AC" value="1" <?php if ($rowGetAd->FEATURES_AC) { echo "checked"; } ?> ></td></tr>

				</table>
			</CENTER></td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="FEATURES_HOT_WATER" value="0">
				<tr><td align="right" class="controltext">Hot Water</td><td align="left"><input type="checkbox" name="FEATURES_HOT_WATER" value="1" <?php if ($rowGetAd->FEATURES_HOT_WATER) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_HT_AND_HW" value="0">
				<tr><td align="right" class="controltext"><NOBR>Heat &amp; Hot Water</NOBR></td><td align="left"><input type="checkbox" name="FEATURES_HT_AND_HW" value="1" <?php if ($rowGetAd->FEATURES_HT_AND_HW ) { echo "checked"; } ?> ></td></tr>

				<input type="hidden" name="FEATURES_ELECTRICITY" value="0">
				<tr><td align="right" class="controltext">Electricity</td><td align="left"><input type="checkbox" name="FEATURES_ELECTRICITY" value="1" <?php if ($rowGetAd->FEATURES_ELECTRICITY) { echo "checked"; } ?> ></td></tr>

				<input type="hidden" name="FEATURES_ALL_UTILITIES" value="0">
				<tr><td align="right" class="controltext">All Utilities</td><td align="left"><input type="checkbox" name="FEATURES_ALL_UTILITIES" value="1" <?php if ($rowGetAd->FEATURES_ALL_UTILITIES) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_INTERNET" value="0">
				<tr><td align="right" class="controltext"><NOBR>High Speed Internet</NOBR></td><td align="left"><input type="checkbox" name="FEATURES_INTERNET" value="1" <?php if ($rowGetAd->FEATURES_INTERNET) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_WALK_IN_CLOSET" value="0">
				<tr><td align="right" class="controltext">Walk-in Closet </td><td align="left"><input type="checkbox" name="FEATURES_WALK_IN_CLOSET" value="1" <?php if ($rowGetAd->FEATURES_WALK_IN_CLOSET ) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_MODERN_BATH" value="0">
				<tr><td align="right" class="controltext">Modern Bath </td><td align="left"><input type="checkbox" name="FEATURES_MODERN_BATH" value="1" <?if ($rowGetAd->FEATURES_MODERN_BATH) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_WHIRLPOOL" value="0">
				<tr><td align="right" class="controltext">Whirlpool Tub </td><td align="left"><input type="checkbox" name="FEATURES_WHIRLPOOL" value="1" <?if ($rowGetAd->FEATURES_WHIRLPOOL) { echo "checked"; } ?> ></td></tr>


				</table>
			</td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="FEATURES_FIREPLACE_WORKING" value="0">
				<tr><td align="right" class="controltext">Working Fireplace</td><td align="left"><input type="checkbox" name="FEATURES_FIREPLACE_WORKING" value="1" <?php if ($rowGetAd->FEATURES_FIREPLACE_WORKING) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_FIREPLACE_DECOR" value="0">
				<tr><td align="right" class="controltext"><NOBR>Decorative Fireplace</NOBR></td><td align="left"><input type="checkbox" name="FEATURES_FIREPLACE_DECOR" value="1" <?php if ($rowGetAd->FEATURES_FIREPLACE_DECOR) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_HWFI" value="0">
				<tr><td align="right" class="controltext">Hardwood Floors</td><td align="left"><input type="checkbox" name="FEATURES_HWFI" value="1" <?php if ($rowGetAd->FEATURES_HWFI) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_CARPET" value="0">
				<tr><td align="right" class="controltext">Carpet</td><td align="left"><input type="checkbox" name="FEATURES_CARPET" value="1" <?php if ($rowGetAd->FEATURES_CARPET) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name=" FEATURES_MODERN_KITCHEN" value="0">
				<tr><td align="right" class="controltext">Galley Kitchen</td><td align="left"><input type="checkbox" name=" FEATURES_MODERN_KITCHEN" value="1" <?php if ($rowGetAd-> FEATURES_MODERN_KITCHEN) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_KITCHENETTE" value="0">
				<tr><td align="right" class="controltext">Kitchenette </td><td align="left"><input type="checkbox" name="FEATURES_KITCHENETTE" value="1" <?php if ($rowGetAd->FEATURES_KITCHENETTE) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_EAT_IN_KITCHEN" value="0">
				<tr><td align="right" class="controltext">Eat-in-Kitchen </td><td align="left"><input type="checkbox" name="FEATURES_EAT_IN_KITCHEN" value="1" <?php if ($rowGetAd->FEATURES_EAT_IN_KITCHEN) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_MICROWAVE" value="0">
				</table>
			</td>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Microwave </td><td align="left"><input type="checkbox" name="FEATURES_MICROWAVE" value="1" <?php if ($rowGetAd->FEATURES_MICROWAVE) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_PANTRY" value="0">
				<tr><td align="right" class="controltext">Pantry</td><td align="left"><input type="checkbox" name="FEATURES_PANTRY" value="1" <?php if ($rowGetAd->FEATURES_PANTRY) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_GAS_RANGE" value="0">
				<tr><td align="right" class="controltext">Gas Range</td><td align="left"><input type="checkbox" name="FEATURES_GAS_RANGE" value="1" <?php if ($rowGetAd->FEATURES_GAS_RANGE) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_ELEC_RANGE" value="0">
				<tr><td align="right" class="controltext"><NOBR>Electric Range</NOBR></td><td align="left"><input type="checkbox" name="FEATURES_ELEC_RANGE" value="1" <?php if ($rowGetAd->FEATURES_ELEC_RANGE) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_DISPOSAL" value="0">
				<tr><td align="right" class="controltext">Disposal </td><td align="left"><input type="checkbox" name="FEATURES_DISPOSAL" value="1" <?php if ($rowGetAd->FEATURES_DISPOSAL) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_DISHWASHER" value="0">
				<tr><td align="right" class="controltext">Dishwasher </td><td align="left"><input type="checkbox" name="FEATURES_DISHWASHER" value="1" <?php if ($rowGetAd->FEATURES_DISHWASHER) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_DINNING_ROOM" value="0">
				<tr><td align="right" class="controltext"><NOBR>Dining Room</NOBR></td><td align="left"><input type="checkbox" name="FEATURES_DINNING_ROOM" value="1" <?if ($rowGetAd->FEATURES_DINNING_ROOM) { echo "checked"; } ?> ></td></tr>

				</table>
			</td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="FEATURES_SKYLIGHT" value="0">
				<tr><td align="right" class="controltext">Skylight </td><td align="left"><input type="checkbox" name="FEATURES_SKYLIGHT" value="1" <?php if ($rowGetAd->FEATURES_SKYLIGHT) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_BALCONY" value="0">
				<tr><td align="right" class="controltext">Balcony </td><td align="left"><input type="checkbox" name="FEATURES_BALCONY" value="1" <?php if ($rowGetAd->FEATURES_BALCONY) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_PATIO" value="0">
				<tr><td align="right" class="controltext">Patio </td><td align="left"><input type="checkbox" name="FEATURES_PATIO" value="1" <?php if ($rowGetAd->FEATURES_PATIO) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_PORCH" value="0">
				<tr><td align="right" class="controltext">Porch </td><td align="left"><input type="checkbox" name="FEATURES_PORCH" value="1" <?php if ($rowGetAd->FEATURES_PORCH) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_ENCLOSED_PORCH" value="0">
				<tr><td align="right" class="controltext">Enclosed Porch</td><td align="left"><input type="checkbox" name="FEATURES_ENCLOSED_PORCH" value="1" <?php if ($rowGetAd->FEATURES_ENCLOSED_PORCH) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_DECK" value="0">
				<tr><td align="right" class="controltext">Deck </td><td align="left"><input type="checkbox" name="FEATURES_DECK" value="1" <?if ($rowGetAd->FEATURES_DECK) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="FEATURES_DUPLEX" value="0">
				<tr><td align="right" class="controltext">Duplex </td><td align="left"><input type="checkbox" name="FEATURES_DUPLEX" value="1" <?if ($rowGetAd->FEATURES_DUPLEX) { echo "checked"; } ?> ></td></tr>
				
				</table>
			</td>
			</tr>
			</table>
			<table>
			<tr>
			<td colspan="10" height="30" bgcolor="#FFFF99">
<span style="font-size:12px;"><B>Amenities:</B></span>
</td>
			</tr>
			<tr>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="AMENITIES_CONCIEARGE" value="0">
				<tr><td align="right" class="controltext">Concierge </td><td align="left"><input type="checkbox" name="AMENITIES_CONCIEARGE" value="1" <?php if ($rowGetAd->AMENITIES_CONCIEARGE) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_SECURITY" value="0">
				<tr><td align="right" class="controltext">Security </td><td align="left"><input type="checkbox" name="AMENITIES_SECURITY" value="1" <?php if ($rowGetAd->AMENITIES_SECURITY) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_SUPERINTENDANT" value="0">
				<tr><td align="right" class="controltext">Superintendent </td><td align="left"><input type="checkbox" name="AMENITIES_SUPERINTENDANT" value="1" <?php if ($rowGetAd->AMENITIES_SUPERINTENDANT) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_ON_SITE_MANAGEMENT" value="0">
				<tr><td align="right" class="controltext"><NOBR>On Site Management</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_ON_SITE_MANAGEMENT" value="1" <?php if ($rowGetAd->AMENITIES_ON_SITE_MANAGEMENT) { echo "checked"; } ?> ></td></tr>

				<input type="hidden" name="AMENITIES_OWNER_OCCUPIED" value="0">
				<tr><td align="right" class="controltext"><NOBR>Owner Occupied</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_OWNER_OCCUPIED" value="1" <?php if ($rowGetAd->AMENITIES_OWNER_OCCUPIED) { echo "checked"; } ?> ></td></tr>

				</table>
			</td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="AMENITIES_ROOF_DECK" value="0">
				<tr><td align="right" class="controltext"><NOBR>Roof Deck</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_ROOF_DECK" value="1" <?php if ($rowGetAd->AMENITIES_ROOF_DECK) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_GARDEN" value="0">
				<tr><td align="right" class="controltext">Garden </td><td align="left"><input type="checkbox" name="AMENITIES_GARDEN" value="1" <?php if ($rowGetAd->AMENITIES_GARDEN) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_YARD" value="0">
				<tr><td align="right" class="controltext">Yard </td><td align="left"><input type="checkbox" name="AMENITIES_YARD" value="1" <?php if ($rowGetAd->AMENITIES_YARD) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_ELEVATOR" value="0">
				<tr><td align="right" class="controltext">Elevator </td><td align="left"><input type="checkbox" name="AMENITIES_ELEVATOR" value="1" <?php if ($rowGetAd->AMENITIES_ELEVATOR) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_CLUBHOUSE" value="0">
				<tr><td align="right" class="controltext">Club House</td><td align="left"><input type="checkbox" name="AMENITIES_CLUBHOUSE" value="1" <?php if ($rowGetAd->AMENITIES_CLUBHOUSE) { echo "checked"; } ?> ></td></tr>
				</table>
			</td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="AMENITIES_HEALTH_CLUB" value="0">
				<tr><td align="right" class="controltext"><NOBR>Health Club</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_HEALTH_CLUB" value="1" <?php if ($rowGetAd->AMENITIES_HEALTH_CLUB) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_POOL" value="0">
				<tr><td align="right" class="controltext">Pool </td><td align="left"><input type="checkbox" name="AMENITIES_POOL" value="1" <?php if ($rowGetAd->AMENITIES_POOL ) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_SAUNA" value="0">
				<tr><td align="right" class="controltext">Sauna </td><td align="left"><input type="checkbox" name="AMENITIES_SAUNA" value="1" <?php if ($rowGetAd->AMENITIES_SAUNA) { echo "checked"; } ?> ></td></tr>

				<input type="hidden" name="AMENITIES_TENNIS" value="0">
				<tr><td align="right" class="controltext">Tennis </td><td align="left"><input type="checkbox" name="AMENITIES_TENNIS" value="1" <?php if ($rowGetAd->AMENITIES_TENNIS) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_LOUNGE" value="0">
				<tr><td align="right" class="controltext">Lounge </td><td align="left"><input type="checkbox" name="AMENITIES_LOUNGE" value="1" <?php if ($rowGetAd->AMENITIES_LOUNGE) { echo "checked"; } ?> ></td></tr>


				</table>
			</td>
			<td  valign="top">
				<table border="0">

				<input type="hidden" name="AMENITIES_BUSINESSCENTER" value="0">
				<tr><td align="right" class="controltext">Business Center</td><td align="left"><input type="checkbox" name="AMENITIES_BUSINESSCENTER" value="1" <?php if ($rowGetAd->AMENITIES_BUSINESSCENTER) { echo "checked"; } ?> ></td></tr>


				<input type="hidden" name="AMENITIES_ATTIC" value="0"> 
				<tr><td align="right" class="controltext">Storage in Attic</td><td align="left"> <input type="checkbox" name="AMENITIES_ATTIC" value="1" <?php if ($rowGetAd->AMENITIES_ATTIC) { echo "checked"; }?> > </td></tr>
				<input type="hidden" name="AMENITIES_BASEMENT" value="0"> 
				<tr><td align="right" class="controltext"><NOBR>Storage in Basement</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_BASEMENT" value="1" <?php if ($rowGetAd->AMENITIES_BASEMENT) {echo "checked"; } ?> > </td></tr>
				<input type="hidden" name="AMENITIES_BIN" value="0"> 
				<tr><td align="right" class="controltext">Storage in Bin</td><td align="left"><input type="checkbox" name="AMENITIES_BIN" value="1" <?php if ($rowGetAd->AMENITIES_BIN) {echo "checked"; }?> ></td></tr>
				<input type="hidden" name="AMENITIES_WHEELCHAIR" value="0">
				<tr><td align="right" class="controltext">Wheelchair Access</td><td align="left"><input type="checkbox" name="AMENITIES_WHEELCHAIR" value="1" <?php if ($rowGetAd->AMENITIES_WHEELCHAIR) { echo "checked"; } ?> ></td></tr>
				</table>
			</td>




			<td  valign="top">
				<table border="0">
				<input type="hidden" name="AMENITIES_SUBWAY" value="0">
				<tr><td align="right" class="controltext">Subway </td><td align="left"><input type="checkbox" name="AMENITIES_SUBWAY" value="1" <?php if ($rowGetAd->AMENITIES_SUBWAY) { echo "checked"; } ?> ></td></tr>
				<input type="hidden" name="AMENITIES_CRAIL" value="0"> 
				<tr><td align="right" class="controltext"><NOBR>Commuter Rail</NOBR></td><td align="left"> <input type="checkbox" name="AMENITIES_CRAIL" value="1" <?php if ($rowGetAd->AMENITIES_CRAIL) { echo "checked"; }?> > </td></tr>
				<input type="hidden" name="AMENITIES_BUS" value="0"> 
				<tr><td align="right" class="controltext">Bus</td><td align="left"><input type="checkbox" name="AMENITIES_BUS" value="1" <?php if ($rowGetAd->AMENITIES_BUS) {echo "checked"; } ?> > </td></tr>
				<input type="hidden" name="AMENITIES_SHUTTLE" value="0"> 
				<tr><td align="right" class="controltext">Shuttle bus</td><td align="left"><input type="checkbox" name="AMENITIES_SHUTTLE" value="1" <?php if ($rowGetAd->AMENITIES_SHUTTLE) {echo "checked"; }?> ></td></tr>
				</table>
			</td>


			</tr>
			</table>
			<table>
		<tr>

			<td height="30" bgcolor="#FFFF99"><span style="font-size:10px;">Building Type:<BR></span><select name="BUILDING_TYPE" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['BUILDING_TYPE'] as $btkey => $btVal) { ?>
					<option value="<?php echo $btkey;?>" <?php if ($rowGetAd->BUILDING_TYPE==$btkey) { echo " selected "; } ?> ><?php echo $btVal;?></option>
				<?php } ?>
			</select></td>
			<td height="30" bgcolor="#FFFF99"><span style="font-size:10px;">Building Style:<BR></span><select name="BUILDING_STYLE" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['BUILDING_STYLE'] as $bskey => $bsVal) { ?>
					<option value="<?php echo $bskey;?>" <?php if ($rowGetAd->BUILDING_STYLE==$bskey) { echo " selected "; } ?> ><?php echo $bsVal;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30"  width="100" bgcolor="#FFFF99"><span style="font-size:10px;">Laundry:<BR></span><select name="LAUNDRY_ROOM" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['LAUNDRY_ROOM'] as $launkey => $launVal) {?>
					<option value="<?php echo $launkey; ?>" <?php if ($rowGetAd->LAUNDRY_ROOM==$launkey) { echo " selected "; }?> ><?php echo $launVal;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			</tr>
			</table>

		<hr noshade size="1" color="black">




		<div id="rentalSpec" style="display:<?php echo $rental_display;?>;">
		<table width="90%">
		<tr>
		<td valign="top" align="center">

<span style="font-size:12px;"><B>Fees</B></SPAN>

		<table BORDER=0 CELLPADDING="0" CELLSPACING="0">
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Tenant Fee:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99"><NOBR>$<input type="text" size="5" name="TENANT_FEE" value="<?php echo $rowGetAd->TENANT_FEE;?>"></NOBR></td>

<td height="30" WIDTH="30" bgcolor="#FFFF99"> &nbsp; </td>

			<td height="30" bgcolor="#FFFF99"><div class="controltext">First:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99"><NOBR>$<input type="text" size="5" name="PAYMENT_FIRST" value="<?php echo $rowGetAd->PAYMENT_FIRST;?>"></NOBR></td>


<td height="30" WIDTH="30" bgcolor="#FFFF99"> &nbsp; </td>

			<td height="30" bgcolor="#FFFF99"><div class="controltext">Security:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99"><NOBR>$<input type="text" size="5" name="PAYMENT_SEC" value="<?php echo $rowGetAd->PAYMENT_SEC;?>"></NOBR></td>
			</tr>

			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Landlord Fee:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99"><NOBR>$<input type="text" size="5" name="LANDLORD_FEE" value="<?php echo $rowGetAd->LANDLORD_FEE;?>"></NOBR></td>

<td height="30" WIDTH="30" bgcolor="#FFFF99"> &nbsp; </td>

			<td height="30" bgcolor="#FFFF99"><div class="controltext">Last:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99"><NOBR>$<input type="text" name="PAYMENT_LAST" size="5" value="<?php echo $rowGetAd->PAYMENT_LAST;?>"></NOBR></td>

<td height="30" WIDTH="30" bgcolor="#FFFF99"> &nbsp; </td>

			<td height="30" bgcolor="#FFFF99"><div class="controltext">Key Deposit:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99"><NOBR>$<input type="text" name="KEY_DEPOSIT" size="5" value="<?php echo $rowGetAd->KEY_DEPOSIT;?>"></NOBR></td>
			</tr>
			<tr>


			<td height="30" bgcolor="#FFFF99"><div class="controltext">Cleaning Deposit:</div></td>
			<td align="right" height="30" bgcolor="#FFFF99"><NOBR>$<input type="text" name="CLEAN_DEPOSIT" size="5" value="<?php echo $rowGetAd->CLEAN_DEPOSIT;?>"></NOBR></td>

<td height="30" WIDTH="30" bgcolor="#FFFF99"> &nbsp; </td>

			<td height="30" bgcolor="#FFFF99"><div class="controltext">Fee Comments:</div></td>
			<td colspan="4" align="right" height="30" bgcolor="#FFFF99"><input type="text" name="FEE_COMMENTS" value="<?php echo $rowGetAd->FEE_COMMENTS;?>" SIZE=30></td>
			</tr>
			</table>
		</td>
		</tr>
		</table>


<hr noshade SIZE="1" color="black">


<span style="font-size:12px;"><B>Showing Instructions</B></span>


			<table border=0 width="90%">
		<tr>
			
		<td bgcolor="#FFFF99" VALIGN="TOP">

<span style="font-size:10px;">Show Instructions:<BR></span><textarea name="SHOW_INSTRUCT" rows="4" cols="30"><?php echo $rowGetAd->SHOW_INSTRUCT;?></textarea>

<BR>
<span style="font-size:10px;">Key Info:<BR></span><select name="KEY_INFO" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['KEY_INFO'] as $keyKey => $keyVal) {?>
					<option value="<?php echo $keyKey;?>" <?php if ($rowGetAd->KEY_INFO==$keyKey) { echo " selected "; }?>><?php echo $keyVal;?></option>
				<?php } ?>
				</select>
</td>

			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;&nbsp;&nbsp;</td>
			<td height="30"  bgcolor="#FFFF99" valign="TOP">

<table border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td height="30" align="left" bgcolor="#FFFF99" valign="TOP"><span style="font-size:10px;">Tenant Name:<BR></span>

<input type="input" name="TENANT_NAME" value="<?php echo $rowGetAd->TENANT_NAME;?>"></td>
			</tr>
			<tr>
			<td height="30" align="left" bgcolor="#FFFF99"><span style="font-size:10px;">Tenant Phone:<BR></span>

<input type="input" name="TENANT_PHONE" value="<?php echo $rowGetAd->TENANT_PHONE;?>" size="30">
			</tr>
<TR><td height="30" align="left" bgcolor="#FFFF99"><span style="font-size:10px;">Alarm Code:<BR></span>

<input type="text" name="ALARM" value="<?php  echo $rowGetAd->ALARM;?>" >
			</tr>
			</table>

</td>
	</tr>
		</table>


		</div>


		<div id="saleSpec" class="controltext" style="display:<?php echo $sale_display;?>;">

		<table width="100%" border="0">
   <tr>
  <td colspan="5">

<span style="font-size:12px;"><B>Structural Information</B></span>

  </td>
  </tr>
  <tr>
    <td><span style="font-size:10px;">Stories:<BR></span>
		<select name="STORIES" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['STORIES'] as $stkey => $stval) {?>
		<option value="<?php echo $stkey;?>" <?php if ($rowGetAd->STORIES==$stkey) { echo "selected ";}?> ><?php echo $stval;?></option>
	<?php } ?>
	</select>
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td><span style="font-size:10px;">Lot Size:</span>
	<br>

	<input name="LOT_SIZE" type="text" size="20" value="<?php echo $rowGetAd->LOT_SIZE;?>">

	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td><span style="font-size:10px;">Exterior:</span>
	<br>
	<select name="EXTERIOR" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['EXTERIOR'] as $exkey => $exval) {?>
		<option value="<?php echo $exkey;?>" <?php if ($rowGetAd->STORIES==$exkey) { echo "selected ";}?> ><?php echo $exval;?></option>
	<?php } ?>
	</select>
	</td>
  </tr>
  <tr>
    <td><span style="font-size:10px;">Style:</span>
	<br>
	<select name="STYLE" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['STYLE'] as $stykey => $styval) {?>
		<option value="<?php echo $stykey;?>" <?php if ($rowGetAd->STORIES==$stykey) { echo "selected ";}?> ><?php echo $styval;?></option>
	<?php } ?>
	</select>
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td><span style="font-size:10px;">Roof Type:</span>
	<br>
	<select name="ROOF_TYPE" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['ROOF_TYPE'] as $rtkey => $rtval) {?>
		<option value="<?php echo $rtkey;?>" <?php if ($rowGetAd->STORIES==$rtkey) { echo "selected ";}?> ><?php echo $rtval;?></option>
	<?php } ?>
	</select>
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td>
	<span style="font-size:10px;">Pool Type:</span>
	<br>
	<select name="POOL_TYPE" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['POOL_TYPE'] as $ptkey => $ptval) {?>
		<option value="<?php echo $ptkey;?>" <?php if ($rowGetAd->STORIES==$ptkey) { echo "selected ";}?> ><?php echo $ptval;?></option>
	<?php } ?>
	</select>
	</td>
  </tr>
  <tr>
  <td colspan="5">

<hr noshade size="1" color="black">

  </td>
  </tr>
  <tr>
  <td colspan="5">

<span style="font-size:12px;"><B>Utility Information</B></span>

  </td>
  </tr>
  <tr>
    <td><span style="font-size:10px;">Water:<BR></span>
	<select name="WATER" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['WATER'] as $wkey => $wval) {?>
		<option value="<?php echo $wkey;?>" <?php if ($rowGetAd->STORIES==$wkey) { echo "selected ";}?> ><?php echo $wval;?></option>
	<?php } ?>
	</select>
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td><span style="font-size:10px;">Sewer:</span>
	<br>
	<select name="SEWER" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['SEWER'] as $swkey => $swval) {?>
		<option value="<?php echo $swkey;?>" <?php if ($rowGetAd->STORIES==$swkey) { echo "selected ";}?> ><?php echo $swval;?></option>
	<?php } ?>
	</select>
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td>
	<span style="font-size:10px;">Condo Fees:</span>
	<br>
	<input name="CONDO_FEES" type="text" size="20">
	</td>
  </tr>
  <tr>
  <td colspan="5">
<hr noshade size="1" color="black">
  </td>
  </tr>
  <tr>
  <td colspan="5">

<span style="font-size:12px;"><B>Zoning and School Information</B></span>

  </td>
  </tr>
   <tr>
    <td><span style="font-size:10px;">Zoning:<BR></span>
	<select name="ZONING" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['ZONING'] as $zkey => $zval) {?>
		<option value="<?php echo $zkey;?>" <?php if ($rowGetAd->STORIES==$zkey) { echo "selected ";}?> ><?php echo $zval;?></option>
	<?php } ?>
	</select>
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td><span style="font-size:10px;">County<BR></span>
	<select name="COUNTY" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['COUNTY'] as $ctkey => $ctval) {?>
		<option value="<?php echo $ctkey;?>" <?php if ($rowGetAd->COUNTY==$ctkey) { echo "selected ";}?> ><?php echo $ctval;?></option>
	<?php } ?>
	</select>
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td>
	<span style="font-size:10px;">School District<BR></span>
	<input name="SCHOOL_DISTRICT" type="text" size="20">
	</td>
  </tr>
  <tr>
    <td>
	<span style="font-size:10px;">Elementary School:<BR></span>
	<input name="ELEMENTARY_SCHOOL" type="text" size="20">
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td>
	<span style="font-size:10px;">Middle School:<BR></span>
	<input name="MIDDLE_SCHOOL" type="text" size="20">
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td>
	<span style="font-size:10px;">High School:<BR></span>
	<input name="HIGH_SCHOOL" type="text" size="20">
	</td>
  </tr>
</table>
		</div>

<CENTER>

			<hr noshade size="1" color="black">

<table width="100%">
<tr>
<?php $adBody = ($rowGetAd->BODY) ? $rowGetAd->BODY : "Type your ad here.";?>
<td>

<TABLE WIDTH="100%" BORDER=0><TR><TD>

<span style="font-size:12px;"><B>Ad Body</B></SPAN><BR><P><BR>
<input type="button" value="Check Spelling" onClick="openSpellChecker();"/>

</TD><TD align="center">

<textarea name="BODY" id="fullBODY" cols="70" rows="6" onFocus=clear_textbox() value="Type your ad here."><?php echo $adBody;?></textarea>
</TD></TR></TABLE>
</TD></TR></TABLE>


<table width="100%">
<tr>
<td>
<span style="font-size:10px;">Offer Map in Ad (must fill in at least the ZIP code):</span>

</TD><TD>

<select name="MAP" STYLE="Background-Color : #FFFFFF">
<option value="0">No Map</option>
<?php
$quStrGetMaps = "select * from MAP_OFFER";
$quGetMaps = mysqli_query($dbh, $quStrGetMaps) or die (mysqli_error($dbh));
while ($rowGetMaps = mysqli_fetch_object($quGetMaps)) {
	?><option value="<?php echo $rowGetMaps->id;?>" <?php if ($rowGetAd->MAP==$rowGetMaps->id) { echo "selected";}?>><?php echo $rowGetMaps->title;?></option>
<?php } ?>
</select>

</td>
</tr>

<TR><TD>

<span style="font-size:10px;">Virtual Tour URL:</SPAN>

</TD><TD>

<input type="text" size="40" name="VIRT_TOUR" value="<?php echo $rowGetAd->VIRT_TOUR;?>">

</TD></TR><TR>
<TD>

<span style="font-size:10px;">YouTube URL:</SPAN>

</TD><TD>

<input type="text" size="40" name="YOUTUBEURL" value="<?php echo $rowGetAd->YOUTUBEURL;?>">

</TD></TR><TR><TD>

<span style="font-size:10px;">YouTube Embed Code:</SPAN>

</TD><TD>



<input type="text" size="40" name="YOUTUBE" value="<?php echo htmlspecialchars($rowGetAd->YOUTUBE);?>">
</TR></TABLE>



		<hr noshade size="1" color="black">
		<table width="90%">
		<tr>



			<td height="30" bgcolor="#FFFF99">

		<table>
		<tr>
			<td height="30"  bgcolor="#FFFF99"><div class="controltext">Notes:</div><textarea name="LISTING_NOTES" rows="4" cols="40"><?php echo $rowGetAd->LISTING_NOTES;?></textarea></td>
		</tr>
		</table>
</TD>

			<td bgcolor="#FFFF99" VALIGN="TOP">


<CENTER>
<table border=0><TR><TD colspan="6">
<CENTER><div class="controltext"><B>Lease Expire:</B></CENTER>
</TD><TD>&nbsp;</TD></TR>
		<?php 
			$getLEMon = subStr ($rowGetAd->LEASE_EXPIRE, 5, 2);
			$getLEDay = subStr ($rowGetAd->LEASE_EXPIRE, 8, 2);
			$getLEYear = subStr ($rowGetAd->LEASE_EXPIRE, 0, 4);
			?>
		<tr>
			<td height="30"  bgcolor="#FFFF99"><div class="controltext">Month:</div><select name="bbbLEMonth" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>                                                      
				<option value="01" <?php if ($getLEMon == "01") { echo " selected "; } ?>>Jan</option>
				<option value="02" <?php if ($getLEMon == "02") { echo " selected "; } ?>>Feb</option>
				<option value="03" <?php if ($getLEMon == "03") { echo " selected "; } ?>>Mar</option>
				<option value="04" <?php if ($getLEMon == "04") { echo " selected "; } ?>>Apr</option>
				<option value="05" <?php if ($getLEMon == "05") { echo " selected "; } ?>>May</option>
				<option value="06" <?php if ($getLEMon == "06") { echo " selected "; } ?>>Jun</option>
				<option value="07" <?php if ($getLEMon == "07") { echo " selected "; } ?>>Jul</option>
				<option value="08" <?php if ($getLEMon == "08") { echo " selected "; } ?>>Aug</option>
				<option value="09" <?php if ($getLEMon == "09") { echo " selected "; } ?>>Sep</option>
				<option value="10" <?php if ($getLEMon == "10") { echo " selected "; } ?>>Oct</option>
				<option value="11" <?php if ($getLEMon == "11") { echo " selected "; } ?>>Nov</option>
				<option value="12" <?php if ($getLEMon == "12") { echo " selected "; } ?>>Dec</option>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Day</div><select name="bbbLEDay" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php for ($i=1;$i<=31;$i++) {
					if ($i<=9) {
						$j = "0".$i;
					} else {
						$j = $i;
					}
				?>
				<option value="<?php echo $j;?>" <?php if ($getLEDay == $j) { echo " selected "; } ?>><?php echo $j;?></option>
				<?php } ?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" width="20" bgcolor="#FFFF99"><div class="controltext">Year</div><select name="bbbLEYear" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php 
				$thisYear = date ("Y");
				for ($i=0;$i<=4;$i++) {?>
				<option value="<?php echo ($thisYear + $i);?>" <?php if ($getLEYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
				<?php }?>
			</select></td>
			<td height="30" width="1" bgcolor="#FFFF99">&nbsp;</td>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Rented By:<BR><select name="RENTED_BY" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['RENTED_BY'] as $rentedKey => $rentedVal) {?>
				<option value="<?php echo $rentedKey;?>" <?php if ($rowGetAd->RENTED_BY==$rentedKey) { echo " selected ";}?>><?php echo $rentedVal;?></option>
				<?php }?>
				</select></td>
			</tr>
			</table>









</td>
		</tr>
		</table>


			<hr noshade size="1" color="black">
<CENTER><table width="90%" BORDER=0><tr>
			<td height="30" align="center" bgcolor="#FFFF99">
<?php if ($user_level>0) {?>
<input onClick="validateAdlEdit('full');" type="button" value="Save" STYLE="Background-Color : #E0FFFF">
<?php }?>
</td></tr>
</table></CENTER>
		</div>
</form>
</div>
<br>

<!--End adlEdit -->
