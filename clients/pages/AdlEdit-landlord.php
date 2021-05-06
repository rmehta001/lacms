<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change the Landlord / Owner this listing # <?php echo "$cid";?><BR><BR>
<P>

	<form action="<?php echo "$PHP_SELF?op=AdlEdit-landlordDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">
<input TYPE="HIDDEN" NAME="cid" value="<?php echo "$cid";?>">

Pick the NEW Landlord / Owner and click the button below.<BR>
<P>

<select name="LANDLORD" STYLE="Background-Color : #FFFFFF" SIZE=4>
	<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
	<option value="<?php echo $rowGetLandlord->LID; ?>"><?php echo $rowGetLandlord->SHORT_NAME;?></option>
	<?php } ?>
</select>

<BR><P>
This will change the landlord at <?php echo "$street_num";?> <?php echo "$street";?> and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Landlord / Owner for this listing." STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-ListingsEdit&lid=$lid&street_num=$street_num&street=$street";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->