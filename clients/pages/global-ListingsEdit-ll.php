<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change the Landlord / Owner in ALL<BR>
the listings at <?php echo "$street_num";?> <?php echo "$street";?><BR><BR>
<P>

	<form action="<?php echo "$PHP_SELF?op=global-ListingsEdit-llDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">
<input TYPE="HIDDEN" NAME="street_num" value="<?php echo "$street_num";?>">
<input TYPE="HIDDEN" NAME="street" value="<?php echo "$street";?>">

Pick the Landlord / Owner and click the button below.<BR>
<P>


<select name="LANDLORD" STYLE="Background-Color : #FFFFFF" SIZE=4>
	<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) { ?>
	<option value="<?php echo $rowGetLandlord->LID; ?>"><?php echo $rowGetLandlord->SHORT_NAME;?></option>
	<?php } ?>
</select>






<BR><P>
This change will change EVERY LISTING at <?php echo "$street_num";?> <?php echo "$street";?> for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Landlord / Owner in ALL the listings at this building" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-ListingsEdit&lid=$lid&street_num=$street_num&street=$street";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->