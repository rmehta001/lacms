<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will mark AVAILABLE all Ads in ALL the listings for this landlord in ALL Buildings<BR><BR>
<P>

<form action="<?php echo "$PHP_SELF?op=global-Landlord-f-markavailableDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

TO mark all listings for this landlord Available click the button below.<BR>
<P>

<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Mark ALL listings in ALL buildings Available" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->