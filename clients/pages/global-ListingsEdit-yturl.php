<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change the YourTube URL in ALL<BR>
the listings at <?php echo "$street_num";?> <?php echo "$street";?><BR><BR>
<P>
<I>Clicking change without entering anything will clear ALL the YouTube URLs</I><BR>
<P>
	<form action="<?php echo "$PHP_SELF?op=global-ListingsEdit-yturlDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">
<input TYPE="HIDDEN" NAME="street_num" value="<?php echo "$street_num";?>">
<input TYPE="HIDDEN" NAME="street" value="<?php echo "$street";?>">

Enter the NEW YouTube URL and click the button below.<BR>
<I>Use the full address - e.g. http://www.123.com</I><BR>
<P>

		<input type="text" name="YOUTUBEURL" size="40">

<BR><P>
This change will change EVERY LISTING at <?php echo "$street_num";?> <?php echo "$street";?> for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the YouTube URL in ALL the listings at this building" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-ListingsEdit&lid=$lid&street_num=$street_num&street=$street";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->