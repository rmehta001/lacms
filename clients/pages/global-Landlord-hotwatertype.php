<!--BEGIN global -->

	<center>
<BR>
<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
  ?>
	<font color="#000000" face="Verdana">
	This form will change the Hot Water Type in ALL<BR>
the listings for this landlord in ALL Buildings<BR><BR>
<P>

	<form action="<?php echo "$PHP_SELF?op=global-Landlord-hotwatertypeDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Pick the NEW Hot Water Type settings and click the button below.<BR>
<P>

<select name="HOT_WATER_TYPE" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['HOT_WATER_TYPE'] as $hwtkey => $hwtVal) { ?>
	<option value="<?php echo $hwtkey;?>"><?php echo $hwtVal;?></option>
	<?php }?>
</select>




<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Hot Water Type in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->