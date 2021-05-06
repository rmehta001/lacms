<!--BEGIN global street name -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change the Location (Town/City) Settings in ALL<BR>
the listings at <?php echo "$street_num";?> <?php echo "$street";?><BR><BR>
<P>

	<form action="<?php echo "$PHP_SELF?op=global-ListingsEdit-locationDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">
<input TYPE="HIDDEN" NAME="street_num" value="<?php echo "$street_num";?>">
<input TYPE="HIDDEN" NAME="street" value="<?php echo "$street";?>">

Select the new Location and click the button below.<BR>
<P>


New Location: 
<select name="LOC" size="2" STYLE="Background-Color : #FFFFFF">
			<?php while($rowLocs = mysqli_fetch_object($quLocs)) { ?>
				<option value="<?php echo $rowLocs->LOCID;?>" 
			<?php if (is_array($switch_remember['loc'])) {
				if (in_array($rowLocs->LOCID, $switch_remember['loc'])) { 
					echo " selected ";
				} 
				} elseif ($switch_remember['loc']) {
				  echo " selected ";
			}?>>
				<?php echo $rowLocs->LOCNAME;?></option>
			<?php } ?>
			</select>







<BR><P>
This change will change EVERY LISTING at <?php echo "$street_num";?> <?php echo "$street";?> for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Location in ALL the listings at this building" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-ListingsEdit&lid=$lid&street_num=$street_num&street=$street";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->