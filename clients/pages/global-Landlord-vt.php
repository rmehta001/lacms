<!--BEGIN global -->

	<center>
<BR>
<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
  ?>
	<font color="#000000" face="Verdana">
	This form will change the Virtual Tour address in ALL<BR>
the listings for this landlord in ALL Buildings<BR><BR>
<P>
<I>Clicking change without entering anything will clear ALL virtual tour addresses</I><BR>
<P>
	<form action="<?php echo "$PHP_SELF?op=global-Landlord-vtDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Enter the NEW Virtual Tour and click the button below.<BR>
<I>Use the full address - e.g. http://www.123.com</I><BR>
<P>

		<input type="text" name="VIRT_TOUR" size="40">

<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the VIRTUAL TOUR ADDRESS in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->