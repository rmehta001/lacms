<!--BEGIN global -->

	<center>
<BR>
<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
  ?>
	<font color="#000000" face="Verdana">
	This form will change the # of Parking Spaces per Unit in ALL<BR>
the listings for this landlord in ALL Buildings<BR><BR>
<P>

	<form action="<?php echo "$PHP_SELF?op=global-Landlord-parkingnumDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Pick the NEW # of Parking Spaces per Unit and click the button below.<BR>
<P>


<select name="PARKING_NUM" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['PARKING_NUM'] as $pknkey => $pknValue) { ?>
	<option value="<?php echo $pknkey;?>"><?php echo $pknValue;?></option>
	<?php } ?>
</select>

<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the # of Parking Spaces per Unit in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->