<!--BEGIN global parking cost -->

	<center>
<BR>
<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
  ?>

	<font color="#000000" face="Verdana">
	This form will change a specific string in BODY OF THE AD and replace it with something else in ALL<BR>
the listings for this landlord in ALL Buildings<BR><BR>
<P>
<I>This is a great way to correct spelling. e.g. replace "dinning" with "dining".<BR>
<P>
<FONT COLOR=red>BE CAREFUL..</FONT>  You can replace something you thought was unique and is common changing more than you want.<BR>
<P>
<form action="<?php echo "$PHP_SELF?op=global-Landlord-bodyDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Enter the Ad Body Text You are looking to change.<BR>
<P>
<textarea name="bodyfind" rows="5" cols="30"></textarea><BR>
<P>
Enter the Ad Body Text You want to swap it with.<BR>
<P>
<textarea name="bodyreplace" rows="5" cols="30"></textarea>

<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the AD BODY TEXT in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->