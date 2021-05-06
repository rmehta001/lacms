<!--BEGIN global -->

	<center>
<BR>

	<font color="#000000" face="Verdana">
	This form will change whether the price is negotiable in ALL the listings at <?php echo "$street_num";?> <?php echo "$street";?><BR><BR>
<P>

	<form action="<?php echo "$PHP_SELF?op=global-ListingsEdit-pricenegDo";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">
<input TYPE="HIDDEN" NAME="lid" value="<?php echo "$lid";?>">
<input TYPE="HIDDEN" NAME="street_num" value="<?php echo "$street_num";?>">
<input TYPE="HIDDEN" NAME="street" value="<?php echo "$street";?>">

Pick the NEW Price is negotiable setting and click the button below.<BR>
<P>

<span style="font-size:10px;">
Price Negotiable Setting:<br></span>
<select name="PRICE_NEG" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>                                                      
	<option value="1">Yes</option>
	<option value="0">No</option>
	</select>



<BR><P>
This change will change EVERY LISTING at <?php echo "$street_num";?> <?php echo "$street";?> for this landlord and cannot be reversed.<BR>
<P>

<input type="submit" value="Change Price is negotiable setting in ALL the listings at this building" STYLE="Background-Color : #A9F5A9"></form>
<br>
<P>
<P>&nbsp;<BR>
<a href="<?php echo "$PHP_SELF?op=global-ListingsEdit&lid=$lid&street_num=$street_num&street=$street";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel</FONT></B></FONT></B></A><BR>
<P>&nbsp;<BR>

<!--END global -->