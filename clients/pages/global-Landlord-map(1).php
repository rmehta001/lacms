<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change the Map Type in Ads in ALL<BR>
the listings for this landlord in ALL Buildings<BR><BR>
<P>

	<form action="<?php echo "$PHP_SELF?op=global-Landlord-mapDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Pick the NEW Map Type in Ads and click the button below.<BR>
<P>

<select name="MAP" STYLE="Background-Color : #FFFFFF">
<option value="0">No Map</option>
<?php
$quStrGetMaps = "select * from MAP_OFFER";
$quGetMaps = mysqli_query($dbh, $quStrGetMaps) or die (mysqli_error($dbh));
while ($rowGetMaps = mysqli_fetch_object($quGetMaps)) {
	?><option value="<?php echo $rowGetMaps->id;?>"><?php echo $rowGetMaps->title;?></option>
<?php } ?>
</select>




<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Map Type in Ad in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->