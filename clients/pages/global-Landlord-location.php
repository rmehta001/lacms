<!--BEGIN global street name -->

	<center>
<BR>
<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
  ?>
	<font color="#000000" face="Verdana">
	This form will change the Location (City/Town) in ALL<BR>
the listings for this landlord in ALL Buildings<BR><BR>
<P>

	<form action="<?php echo "$PHP_SELF?op=global-Landlord-locationDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Select the NEW Location and click the button below.<BR>
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
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Location in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->