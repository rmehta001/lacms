<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change the Key Information in ALL<BR>
the listings at <?php echo "$street_num";?> <?php echo "$street";?><BR><BR>


<form action="<?php echo "$PHP_SELF?op=global-ListingsEdit-keyinfoDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">
<input TYPE="HIDDEN" NAME="street_num" value="<?php echo "$street_num";?>">
<input TYPE="HIDDEN" NAME="street" value="<?php echo "$street";?>">

Pick the NEW Key Information setting and click the button below.<BR>
<P>
	
Key Info setting:<br>

	<select name="KEY_INFO" STYLE="Background-Color : #FFFFFF">
		<option value="--">--</option>
		<?php foreach ($DEFINED_VALUE_SETS['KEY_INFO'] as $keyKey => $keyVal) {?>
		<option value="<?php echo $keyKey;?>"><?php echo $keyVal;?></option>
		<?php } ?>
		</select>


<BR><P>
This change will change EVERY LISTING at <?php echo "$street_num";?> <?php echo "$street";?> for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Key Information in ALL the listings at this building" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-ListingsEdit&lid=$lid&street_num=$street_num&street=$street";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->