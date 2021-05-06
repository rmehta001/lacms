<!--BEGIN global -->

	<center>
<BR>
<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
  ?>
	<font color="#000000" face="Verdana">
	This form will change the YourTube Embed URL in ALL<BR>
the listings for this landlord in ALL Buildings<BR><BR>
<P>
<I>Clicking change without entering anything will clear ALL the YouTube Embed URLs</I><BR>
<P>
	<form action="<?php echo "$PHP_SELF?op=global-Landlord-ytembDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Enter the NEW YouTube Embed URL and click the button below.<BR>
<I>Use the full address - e.g. http://www.123.com</I><BR>
<P>

		<input type="text" name="YOUTUBE" size="40">

<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the YouTube Embed URL in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->