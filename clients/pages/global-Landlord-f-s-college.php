<!--BEGIN global -->

	<center>
<BR>
<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
  ?>
	<font color="#000000" face="Verdana">
	This form will change the Features &amp; Amenities College setting in Ads in ALL the listings for this landlord in ALL Buildings<BR><BR>
<P>

<form action="<?php echo "$PHP_SELF?op=global-Landlord-f-s-collegeDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Pick the NEW College setting and click the button below.<BR>
<P>

<span style="font-size:10px;">
College Setting:<br></span>

	<select name="SCHOOL" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['SCHOOL'] as $key => $Val) {?>
	<option value="<?php echo $key; ?>"><?php echo $Val;?></option>
	<?php } ?>
	</select>

<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the College setting in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->