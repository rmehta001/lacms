<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change the Features &amp; Amenities Furnished setting in Ads in ALL the listings at <?php echo "$street_num";?> <?php echo "$street";?><BR><BR>
<P>

	<form action="<?php echo "$PHP_SELF?op=global-ListingsEdit-f-furnishedDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">
<input TYPE="HIDDEN" NAME="street_num" value="<?php echo "$street_num";?>">
<input TYPE="HIDDEN" NAME="street" value="<?php echo "$street";?>">

Pick the NEW Furnished setting and click the button below.<BR>
<P>

<span style="font-size:10px;">
Furnished Setting:<br></span>
<select name="FEATURES_FURNISHED" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>                                                      
	<option value="1">Yes</option>
	<option value="0">No</option>
	</select>

<BR><P>
This change will change EVERY LISTING at <?php echo "$street_num";?> <?php echo "$street";?> for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Furnished setting in ALL the listings at this building" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-ListingsEdit&lid=$lid&street_num=$street_num&street=$street";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->