<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change all Listings to PRIORITY STATUS<BR>in ALL Buildings for the landlord<BR><BR>
<P>
<I>Clicking change without entering anything will clear ALL titles</I><BR>
<P>
	<form action="<?php echo "$PHP_SELF?op=global-Landlord-priorityDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Pick the NEW Priority setting and click the button below.<BR>
<P>

<select name="PRIORITY" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>           	<option value="1">Yes</option>
	<option value="0">No</option>
	</select>


<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change or Clear the AD TITLE in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->