<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change Fee Type in ALL<BR>
the listings for this landlord in ALL Buildings<BR><BR>
<P>
<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
  ?>
	<form action="<?php echo "$PHP_SELF?op=global-Landlord-feeDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Pick the NEW Parking Type and click the button below.<BR>
<P>


<select name="NOFEE" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['NOFEE'] as $nfkey => $nfValue) { ?>
	<option value="<?php echo $nfkey;?>"><?php echo $nfValue;?></option>
	<?php } ?>
</select>

<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Fee Type in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->