<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change Availability Date in ALL<BR>
the listings for this landlord in ALL Buildings<BR><BR>
<P>

	<form action="<?php echo "$PHP_SELF?op=global-Landlord-availDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">

Pick the NEW Availability Date and click the button below.<BR>
<P>


Availability date:<br>
<span style="font-size:10px;">Month:</span><select name="bbbMonth" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>                                                      
	<option value="01">Jan</option>
	<option value="02">Feb</option>
	<option value="03">Mar</option>
	<option value="04">Apr</option>
	<option value="05">May</option>
	<option value="06">Jun</option>
	<option value="07">Jul</option>
	<option value="08">Aug</option>
	<option value="09">Sep</option>
	<option value="10">Oct</option>
	<option value="11">Nov</option>
	<option value="12">Dec</option>
</select>
<span style="font-size:10px;">Day:</span><select name="bbbDay" STYLE="Background-Color : #FFFFFF"> 
	<option value="--">--</option>
	<?php for ($i=1;$i<=31;$i++) {
		if ($i<=9) {
			$j = "0".$i;
		} else {
			$j = $i;
		}
	?>
	<option value="<?php echo $j;?>"><?php echo $j;?></option>
	<?php } ?>
</select>
<span style="font-size:10px;">Year</span><select name="bbbYear" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php 
	$thisYear = date ("Y") - 1;
	for ($i=0;$i<=4;$i++) {?>
	<option value="<?php echo ($thisYear + $i);?>" <?php if ($getYear == ($thisYear+$i)) { echo " selected "; } ?>><?php echo ($thisYear + $i);?></option>
	<?php }?>
</select>
</SPAN>



<BR><P>
This change will change EVERY LISTING for this landlord in ALL Buildings for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change the Availability Date in ALL listings in ALL buildings" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-Landlord&lid=$lid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->