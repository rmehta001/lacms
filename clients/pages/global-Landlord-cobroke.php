<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change whether to Co-Broke Status in the listing's ads in ALL the listings for this landlord in ALL Buildings<BR><BR>
<P>
<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
  ?>
	<form action="<?php echo "$PHP_SELF?op=global-Landlord-cobrokeDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Pick the NEW Co-Broke Status and click the button below.<BR>
<P>

<span style="font-size:10px;">
Co-Broke Status:<br></span>
<select name="COBROKE" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>                                                      
	<option value="1">Yes</option>
	<option value="0">No</option>
	</select>



<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Co-Broke Status in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->