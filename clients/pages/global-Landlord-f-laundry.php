<!--BEGIN global -->

	<center>
<BR>
<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
  ?>
	<font color="#000000" face="Verdana">
	This form will change the Features &amp; Amenities Laundry setting in Ads in ALL the listings for this landlord in ALL Buildings<BR><BR>
<P>

<form action="<?php echo "$PHP_SELF?op=global-Landlord-f-laundryDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Pick the NEW Laundry setting and click the button below.<BR>
<P>

<span style="font-size:10px;">
Laundry Setting:<br></span>

	<select name="LAUNDRY_ROOM" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['LAUNDRY_ROOM'] as $launkey => $launVal) {?>
	<option value="<?php echo $launkey; ?>"><?php echo $launVal;?></option>
	<?php } ?>
	</select>

<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Laundry setting in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->