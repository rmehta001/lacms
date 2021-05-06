<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change the Features &amp; Amenities Health Club setting in Ads in ALL the listings for this landlord in ALL Buildings<BR><BR>
<P>

<form action="<?php echo "$PHP_SELF?op=global-Landlord-f-healthcDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Pick the NEW Health Club setting and click the button below.<BR>
<P>

<span style="font-size:10px;">
Health Club Setting:<br></span>
<select name="AMENITIES_HEALTH_CLUB" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>                                                      
	<option value="1">Yes</option>
	<option value="0">No</option>
	</select>

<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Health Club setting in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->