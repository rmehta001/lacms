<!--BEGIN createClient -->
<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>

<B>CREATE A NEW CLIENT</B><br>
	
	
	<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<form action="<?php echo "$PHP_SELF?op=createClientDo";?>" method="POST">
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">


<table>
<tr>

<TD COLSPAN=6>
	<NOBR><FONT SIZE="+1"> Client Information: </FONT>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client Status: 
	
	<select name="CLIENT_STATUS2" ID="CLIENT_STATUS2" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['CLIENT_STATUS2'] as $cskey => $csValue) { ?>
					<option value="<?php echo $cskey;?>"><?php echo $csValue;?></option>
					<?php } ?>
				</select>
	&nbsp; Active <input type="radio" name="status_client" value="1" checked > Inactive <input type="radio" name="status_client" value="2" > &nbsp;&nbsp;
&nbsp;&nbsp;&nbsp; <input type="image" src="../assets/images/save.gif" alt="SAVE"></NOBR>

<BR>



<TABLE WIDTH="100%"><TR><TD>


			<?php 
		$dc_year = date("Y");
		$dc_month = date("n");
		$dc_day = date("j");
		?>

			<?php 
		$nc_year = date("Y");
		$nc_month = date("n");
		$nc_day = date("j");
		?>








<div class="controltext"><NOBR>MOVE IN DATE <FONT SIZE=-3>(begin)</FONT>:</NOBR></div><NOBR><select name="mi_month" STYLE="Background-Color : #FFFFFF">
						<option value="1" <?php if ($dc_month==1) { echo "selected";}?>>Jan</option>
						<option value="2" <?php if ($dc_month==2) { echo "selected";}?>>Feb</option>
						<option value="3" <?php if ($dc_month==3) { echo "selected";}?>>Mar</option>
						<option value="4" <?php if ($dc_month==4) { echo "selected";}?>>April</option>
						<option value="5" <?php if ($dc_month==5) { echo "selected";}?>>May</option>
						<option value="6" <?php if ($dc_month==6) { echo "selected";}?>>Jun</option>
						<option value="7" <?php if ($dc_month==7) { echo "selected";}?>>Jul</option>
						<option value="8" <?php if ($dc_month==8) { echo "selected";}?>>Aug</option>
						<option value="9" <?php if ($dc_month==9) { echo "selected";}?>>Sep</option>
						<option value="10" <?php if ($dc_month==10) { echo "selected";}?>>Oct</option>
						<option value="11" <?php if ($dc_month==11) { echo "selected";}?>>Nov</option>
						<option value="12" <?php if ($dc_month==12) { echo "selected";}?>>Dec</option>
						</select> 
			<select name="mi_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($mi_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>


			<select name="mi_year" STYLE="Background-Color : #FFFFFF">

<?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>

<option value="<?php echo $i;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
<?php echo $i;?>
</option>

<option value="<?php echo $i+1;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
<?php echo $i+1;?>
</option>



						<?php } ?>
						</select>

</NOBR><BR>


<div class="controltext"><NOBR>MOVE IN DATE <FONT SIZE=-3>(end)</FONT>:</NOBR></div><NOBR><select name="mie_month" STYLE="Background-Color : #FFFFFF">
						<option value="1" <?php if ($dc_month==1) { echo "selected";}?>>Jan</option>
						<option value="2" <?php if ($dc_month==2) { echo "selected";}?>>Feb</option>
						<option value="3" <?php if ($dc_month==3) { echo "selected";}?>>Mar</option>
						<option value="4" <?php if ($dc_month==4) { echo "selected";}?>>April</option>
						<option value="5" <?php if ($dc_month==5) { echo "selected";}?>>May</option>
						<option value="6" <?php if ($dc_month==6) { echo "selected";}?>>Jun</option>
						<option value="7" <?php if ($dc_month==7) { echo "selected";}?>>Jul</option>
						<option value="8" <?php if ($dc_month==8) { echo "selected";}?>>Aug</option>
						<option value="9" <?php if ($dc_month==9) { echo "selected";}?>>Sep</option>
						<option value="10" <?php if ($dc_month==10) { echo "selected";}?>>Oct</option>
						<option value="11" <?php if ($dc_month==11) { echo "selected";}?>>Nov</option>
						<option value="12" <?php if ($dc_month==12) { echo "selected";}?>>Dec</option>
						</select> 
			<select name="mie_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($mi_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>


			<select name="mie_year" STYLE="Background-Color : #FFFFFF">

<?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>


<option value="<?php echo $i;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
<?php echo $i;?>
</option>

<option value="<?php echo $i+1;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
<?php echo $i+1;?>
</option>



						<?php } ?>
						</select>

</NOBR>



	</TD>




<TD>


<div class="controltext">Date Created:<BR>
<NOBR>

<select name="dc_month" STYLE="Background-Color : #FFFFFF">
						<option value="1" <?php if ($dc_month==1) { echo "selected";}?>>Jan</option>
						<option value="2" <?php if ($dc_month==2) { echo "selected";}?>>Feb</option>
						<option value="3" <?php if ($dc_month==3) { echo "selected";}?>>Mar</option>
						<option value="4" <?php if ($dc_month==4) { echo "selected";}?>>April</option>
						<option value="5" <?php if ($dc_month==5) { echo "selected";}?>>May</option>
						<option value="6" <?php if ($dc_month==6) { echo "selected";}?>>Jun</option>
						<option value="7" <?php if ($dc_month==7) { echo "selected";}?>>Jul</option>
						<option value="8" <?php if ($dc_month==8) { echo "selected";}?>>Aug</option>
						<option value="9" <?php if ($dc_month==9) { echo "selected";}?>>Sep</option>
						<option value="10" <?php if ($dc_month==10) { echo "selected";}?>>Oct</option>
						<option value="11" <?php if ($dc_month==11) { echo "selected";}?>>Nov</option>
						<option value="12" <?php if ($dc_month==12) { echo "selected";}?>>Dec</option>
						</select> 
			<select name="dc_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($dc_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>
			<select name="dc_year" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=(date("Y")-4);$i<=date("Y");$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($dc_year==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>

</NOBR><BR>
		Subscribed to Daily Emails &amp; Newsletters: <input type="checkbox" name="newsletter_subscribe" <?php if ($rowGetClient->NEWSLETTER_SUBSCRIBE=='2') { echo checked;} ?> value="2">
</td><td>

<div class="controltext"><NOBR>Next Contact Date:</NOBR></div><NOBR><select name="nc_month" STYLE="Background-Color : #FFFFFF">
						<option value="1" <?php if ($nc_month==1) { echo "selected";}?>>Jan</option>
						<option value="2" <?php if ($nc_month==2) { echo "selected";}?>>Feb</option>
						<option value="3" <?php if ($nc_month==3) { echo "selected";}?>>Mar</option>
						<option value="4" <?php if ($nc_month==4) { echo "selected";}?>>April</option>
						<option value="5" <?php if ($nc_month==5) { echo "selected";}?>>May</option>
						<option value="6" <?php if ($nc_month==6) { echo "selected";}?>>Jun</option>
						<option value="7" <?php if ($nc_month==7) { echo "selected";}?>>Jul</option>
						<option value="8" <?php if ($nc_month==8) { echo "selected";}?>>Aug</option>
						<option value="9" <?php if ($nc_month==9) { echo "selected";}?>>Sep</option>
						<option value="10" <?php if ($nc_month==10) { echo "selected";}?>>Oct</option>
						<option value="11" <?php if ($nc_month==11) { echo "selected";}?>>Nov</option>
						<option value="12" <?php if ($nc_month==12) { echo "selected";}?>>Dec</option>
						</select> 
			<select name="nc_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($nc_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>



			<select name="nc_year" STYLE="Background-Color : #FFFFFF">

<?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>

<option value="<?php echo $i+1;?>" <?php if ($nc_year==$i) { echo "selected";}?>>
<?php echo $i+1;?>
</option>

<option value="<?php echo $i;?>" <?php if ($nc_year==$i) { echo "selected";}?>>
<?php echo $i;?>
</option>

						<?php } ?>
						</select>

</NOBR>
<BR>
<NOBR><div class="menu">Share Client? &nbsp; <input type="checkbox" name="public" value="1" <?php if ($rowGetClient->PUBLIC) { echo " checked "; } ?>></NOBR>


	</TD></TR></TABLE>



</TD>

</TR><TR>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>First Name:</NOBR></div><input type="text" name="name_first" size="20" value="<?php echo $rowGetClient->NAME_FIRST;?>"></td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Last Name:</NOBR></div><input type="text" name="name_last" size="20" value="<?php echo $rowGetClient->NAME_LAST;?>"></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Interested in:</NOBR></div><select name="type_pref" STYLE="Background-Color : #FFFFFF">
<!-- <?php while ($rowTypes = mysqli_fetch_object($quTypes)) {?>
<option value="<?php echo $rowTypes->TYPE;?>"><?php echo $rowTypes->TYPENAME;?></option>
<?php }?>
-->

<option value="1">Rental</option>
<option value="2">Sale</option>
<option value="3">Commercial Sale</option>
<option value="4">Commercial Rental</option>
<option value="5">Parking Spaces - Rent</option>
<option value="6">Parking Spaces - Sale</option>
<option value="7">Parking Spaces - Wanted</option>
<option value="8">Vacation Rental</option>
<option value="9">Rent To Own</option>
<option value="10">Business Opportunities</option>
<option value="11">Senior Living Rental</option>
<option value="12">Senior Living Sale</option>
<option value="13">Bank Owned</option>

			</select></td>

			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Sub Type:</NOBR></div><select name="client_subtype" STYLE="Background-Color : #FFFFFF">
		<option value="">--</option>
<option value="3">Accessories</option>
<option value="4">Apparel - Men</option>
<option value="5">Apparel - Women</option>
<option value="6">Apparel - Kids</option>
<option value="7">Apparel - Baby</option>
<option value="8">Art</option>
<option value="71">Attorney</option>
<option value="9">Auto Dealerships</option>
<option value="10">Auto Supply</option>
<option value="1">Banks</option>
<option value="11">Beauty Salons</option>
<option value="12">Bridal</option>
<option value="75">Broker-Business</option>
<option value="76">Broker-Industrial</option>
<option value="77">Broker-Investment Sales</option>
<option value="78">Broker-Office</option>
<option value="79">Broker-Residential</option>
<option value="80">Broker-Restaurants</option>
<option value="13">Candy</option>
<option value="14">Cards</option>
<option value="15">Check Cashing/Pawn</option>
<option value="16">Childcare</option>
<option value="17">Coffee</option>
<option value="18">Computer</option>
<option value="89">Contractor</option>
<option value="19">Convenience</option>
<option value="20">Cosmetics</option>
<option value="21">Cutlery</option>
<option value="67">Dentist</option>
<option value="22">Department Store</option>
<option value="81">Developer-Residential</option>
<option value="82">Developer-Commercial</option>
<option value="83">Developer-Retail</option>
<option value="23">Discount Store</option>
<option value="68">Doctor</option>
<option value="24">Drug Store</option>
<option value="25">Dry cleaning</option>
<option value="26">Educational</option>
<option value="27">Fabrics</option>
<option value="28">Fast Food</option>
<option value="29">Fine Jewelry</option>
<option value="30">Fitness Equipment</option>
<option value="31">Flooring</option>
<option value="32">Florist</option>
<option value="33">Furniture</option>
<option value="34">Gas</option>
<option value="35">Gifts</option>
<option value="36">Hardware/Home Improvement</option>
<option value="37">Health clubs/gyms</option>
<option value="38">Home Decor</option>
<option value="39">Housewares</option>
<option value="84">Investor-Office</option>
<option value="85">Investor-Retail</option>
<option value="86">Investor-Residential</option>
<option value="74">Laundromat</option>
<option value="40">Leather/luggage</option>
<option value="41">Liquor</option>
<option value="42">Major appliance</option>
<option value="72">Massage</option>
<option value="43">Medical equipment</option>
<option value="44">Movie Theaters</option>
<option value="45">Music instruments</option>
<option value="46">Nutrition</option>
<option value="47">Office Supply</option>
<option value="69">Office Use</option>
<option value="48">Optical/eye-ware</option>
<option value="49">Outdoor pool/patio</option>
<option value="50">Paper/Party Store</option>
<option value="51">Pet Supply</option>
<option value="52">Photocopies/printing</option>
<option value="87">Pizza</option>
<option value="90">Property Management/Vendor</option>
<option value="91">Property Management/Tenant</option>
<option value="66">Psychologist</option>
<option value="70">Real Estate Office</option>
<option value="53">Rental Center</option>
<option value="54">Restaurants/Bars</option>
<option value="73">Salon</option>
<option value="55">Seasonal</option>
<option value="56">Shoes</option>
<option value="57">Signs</option>
<option value="58">Specialty foods</option>
<option value="59">Sporting Goods</option>
<option value="60">Supermarkets</option>
<option value="61">Tobacco</option>
<option value="62">Toys/Games/Video Games</option>
<option value="63">Wall coverings/pain</option>
<option value="64">Warehouses/Wholesale Clubs</option>
<option value="65">Wireless Communications</option>
<option value="54">Yogurt</option>
	</select>
			</td>

			
			
					<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">
<nobr>Building Pref:</NOBR></div><select name="building_pref[]" multiple SIZE="1" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['BUILDING_TYPE'] as $bldkey => $bldValue) { 
						$selected = ($rowGetClient->BUILDING_PREF==$bldkey) ? " selected " : "";?>
					<option value="<?php echo $bldkey;?>" <?php echo $selected;?>><?php echo $bldValue;?></option>
					<?php } ?>
				</select><br>
</nobr>			
			</TD>
			
			
</tr>
</table>



	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>

	<tr>


	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>

			<td height="30" width="28" bgcolor="<?php echo $pagebgcolor;?>">

			<table>
			<tr>
			
			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Home Phone:</NOBR></div><input type="text" name="home_phone" size="15" value="<?php echo $rowGetClient->HOME_PHONE;?>"></td>
			<td valign="bottom" height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Work Phone:</NOBR></div><input type="text" name="work_phone" size="15" value="<?php echo $rowGetClient->WORK_PHONE;?>"></td>
			<td valign="bottom" height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Mobile Phone:</NOBR></div><input type="text" name="mobile_phone" size="15" value="<?php echo $rowGetClient->MOBILE_PHONE;?>"></td>
			<td valign="bottom" height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Email:</div><input type="text" name="client_email" size="20" value="<?php echo $rowGetClient->CLIENT_EMAIL;?>"></td>
			<td valign="bottom" height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Email: (Alternative)</div><input type="text" name="client_email2" size="20" value="<?php echo $rowGetClient->CLIENT_EMAIL2;?>"></td>
			</tr>
			</table>


</td>

	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
</TR><TR>

	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>




	<td bgcolor="<?php echo $pagebgcolor;?>">


<table><tr><td>

<div class="controltext">Address:</div><input type="text" name="curaddress" size="28" value="<?php echo $rowGetClient->CURADDRESS;?>"></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">City:</div><input type="text" name="curcity" size="28" value="<?php echo $rowGetClient->CURCITY;?>"></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>


			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">State:</div><input type="text" name="curstate" size="2" value="<?php echo $rowGetClient->CURSTATE;?>"></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>


			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Zip:</div><input type="text" name="curzip" size="10" value="<?php echo $rowGetClient->CURZIP;?>"></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>


</tr>
</table>


	</td>


	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>

<TR>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">

<TABLE><TR><TD>
<div class="controltext"><NOBR># of people:</NOBR></div><input type="text" SIZE="2" name="num_people" value="<?php echo $rowGetClient->NUM_PEOPLE;?>">
</td>


			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td height="30" width="2" bgcolor="<?php echo $pagebgcolor;?>">
<div class="controltext"><NOBR>Client Type:</NOBR></div><select name="client_type" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['CLIENT_TYPE'] as $ctkey => $ctValue) { 
						$selected = ($rowGetClient->CLIENT_TYPE==$ctkey) ? " selected " : "";?>
					<option value="<?php echo $ctkey;?>" <?php echo $selected;?>><?php echo $ctValue;?></option>
					<?php } ?>
				</select><br>
			</TD>
<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="2" bgcolor="<?php echo $pagebgcolor;?>">
<div class="controltext">Employment:</div><select name="client_employment" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['CLIENT_EMPLOYMENT'] as $cekey => $ceValue) { 
						$selected = ($rowGetClient->CLIENT_EMPLOYMENT==$cekey) ? " selected " : "";?>
					<option value="<?php echo $cekey;?>" <?php echo $selected;?>><?php echo $ceValue;?></option>
					<?php } ?>
				</select><br>
			</TD>
			<td height="30" width="2" bgcolor="<?php echo $pagebgcolor;?>">
<div class="controltext">Company Name:</div><input type="text" name="curremploy" value="<?php echo $rowGetClient->CURREMPLOY;?>">
</td>


</TR>
</TABLE>



</TD>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>


</TR>

	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">

			<table>
			<tr>
			
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">

<div class="controltext"><NOBR>Price Minimum:</NOBR></div><NOBR>$<input type="text" name="pricemin" value="<?php echo $rowGetClient->PRICEMIN;?>">
</NOBR>
</td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">
<div class="controltext"><NOBR>Price Maximum:</NOBR></div><NOBR>$<input type="text" name="pricemax" value="<?php echo $rowGetClient->PRICEMAX;?>"> </NOBR>
</td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>


			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">
<NOBR><div class="menu">Furnished</DIV></NOBR>
<input type="checkbox" name="client_furnished" value="1" <?php if ($rowGetClient->CLIENT_FURNISHED) { echo " checked "; } ?>><br>
</TD>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">
<NOBR><div class="menu">Short-Term</DIV></NOBR>
<input type="checkbox" name="client_shortterm" value="1" <?php if ($rowGetClient->CLIENT_SHORTTERM) { echo " checked "; } ?>><br>
</TD>
<TD>&nbsp;</TD>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>"><NOBR><div class="menu">Lead Safe</DIV></nobr>
			
<input type="checkbox" name="client_leadsafe" value="1" <?php if ($rowGetClient->LEADSAFE) { echo " checked "; } ?>></td>

			</tr>
			</table>

	</td>

	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>

	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>

	<td bgcolor="<?php echo $pagebgcolor;?>">

			<table>
			<tr>
			
			<td valign="top" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">





<div class="controltext"><NOBR>Location preference(s):</NOBR></div><select name="loc_pref[]" multiple SIZE=8 STYLE="Background-Color : #FFFFFF">


	<?php while ($rowFavLocs = mysqli_fetch_object($quFavLocs)) { ?>
	<option value="<?php echo $rowFavLocs->LOCID;?>" <?php if ($rowGetAd->LOC==$rowFavLocs->LOCID) {echo " selected"; $locSeled = true; }?>><?php echo $rowFavLocs->LOCNAME;?></option>
	<?php } ?>
<option value="0">--------------------</option>	
	<?php while ($rowLocs = mysqli_fetch_object($quLocs)) {	?>
		<option value="<?php echo $rowLocs->LOCID; ?>" <?php if ($rowGetAd->LOC==$rowLocs->LOCID && $locSeled == false) {echo " selected"; }?> >
		<?php echo $rowLocs->LOCNAME; ?></option>
	<?php }	?>
</select>



</td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td valign="top" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">




<div class="controltext"><NOBR># of Bedrooms:</NOBR></div><select name="rooms_pref[]" multiple SIZE=8 STYLE="Background-Color : #FFFFFF"> 
				<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $roomkey => $roomval) { ?>
				<option value="<?php echo $roomkey;?>" ><?php echo $roomval;?></option>
				<?php }?>
				</select>

</td>


			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td valign="top" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">



<div class="controltext"><NOBR># of Baths:</NOBR></div><select name="bath_pref[]" multiple  SIZE=3 STYLE="Background-Color : #FFFFFF"> 
				<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bathkey => $bathval) { ?>
				<option value="<?php echo $bathkey;?>" ><?php echo $bathval;?></option>
				<?php }?>
				</select>


<FONT SIZE="-3"><BR></FONT>

<div class="controltext"><NOBR>Pets preference:</NOBR></div><select name="pets_pref[]" multiple  SIZE=3 STYLE="Background-Color : #FFFFFF"> 

				<?php foreach ($DEFINED_VALUE_SETS['PETSA'] as $petskey => $petsval) { ?>
				<option value="<?php echo $petskey;?>" ><?php echo $petsval;?></option>
				<?php }?>
				</select>


</TD>




			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>





			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">
			<table>
			<tr>
			
			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">



			<table>
<TR>
<TD bgcolor="<?php echo $pagebgcolor;?>">
<NOBR>Client Source:
<select name="SOURCE" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['SOURCE'] as $skey => $sValue) { 
						$selected = ($rowGetClient->SOURCE==$skey) ? " selected " : "";?>
					<option value="<?php echo $skey;?>" <?php echo $selected;?>><?php echo $sValue;?></option>
					<?php } ?>
				</select>
</NOBR></DIV>
</TD>
</TR>

<tr>
			
			<td height="60" width="100%" bgcolor="<?php echo $pagebgcolor;?>" COLSPAN="6"><div class="controltext"><NOBR>Additional Comments:</NOBR></div><textarea name="client_notes" rows="5" cols="118"><?php echo $rowGetClient->CLIENT_NOTES;?></textarea></td>
			</tr>
			

<TD>

<TABLE BORDER="1" BORDERCOLOR="#000000" CELLPADDING="2"><TR><TD>
<TABLE><TR><TD>
<NOBR>Appointment on:</NOBR>
</TD><TD><NOBR>
<INPUT TYPE="TEXT" NAME="SHOW_DATE" id="SHOW_DATE" class="w16em dateformat-Y-ds-m-ds-d" SIZE="10"></NOBR>
</TD></TR><TR><TD>
Time: 
</TD><TD>
<select name="SHOW_TIME" id="SHOW_TIME">


<option value="00:00:00">12:00am</option>
<option value="00:30:00">12:30am</option>
<option value="01:00:00">1:00am</option>
<option value="01:30:00">1:30am</option>
<option value="02:00:00">2:00am</option>
<option value="02:30:00">2:30am</option>
<option value="03:00:00">3:00am</option>
<option value="03:30:00">3:30am</option>
<option value="04:00:00">4:00am</option>
<option value="04:30:00">4:30am</option>
<option value="05:00:00">5:00am</option>
<option value="05:30:00">5:30am</option>
<option value="06:00:00">6:00am</option>
<option value="06:30:00">6:30am</option>
<option value="07:00:00">7:00am</option>
<option value="07:30:00">7:30am</option>
<option value="08:00:00">8:00am</option>
<option value="08:30:00">8:30am</option>
<option value="08:45:00">8:45am</option>
<option value="09:00:00">9:00am</option>
<option value="09:15:00">9:15am</option>
<option value="09:30:00">9:30am</option>
<option value="09:45:00">9:45am</option>
<option value="10:00:00">10:00am</option>
<option value="10:15:00">10:15am</option>
<option value="10:30:00">10:30am</option>
<option value="10:45:00">10:45am</option>
<option value="11:00:00">11:00am</option>
<option value="11:15:00">11:15am</option>
<option value="11:30:00">11:30am</option>
<option value="11:45:00">11:45am</option>
<option value="12:00:00">12:00pm</option>
<option value="12:15:00">12:15pm</option>
<option value="12:30:00">12:30pm</option>
<option value="12:45:00">12:45pm</option>
<option value="13:00:00">1:00pm</option>
<option value="13:15:00">1:15pm</option>
<option value="13:30:00">1:30pm</option>
<option value="13:45:00">1:45pm</option>
<option value="14:00:00">2:00pm</option>
<option value="14:15:00">2:15pm</option>
<option value="14:30:00">2:30pm</option>
<option value="14:45:00">2:45pm</option>
<option value="15:00:00">3:00pm</option>
<option value="15:15:00">3:15pm</option>
<option value="15:30:00">3:30pm</option>
<option value="15:45:00">3:45pm</option>
<option value="16:00:00">4:00pm</option>
<option value="16:15:00">4:15pm</option>
<option value="16:30:00">4:30pm</option>
<option value="16:45:00">4:45pm</option>
<option value="17:00:00">5:00pm</option>
<option value="17:15:00">5:15pm</option>
<option value="17:30:00">5:30pm</option>
<option value="17:45:00">5:45pm</option>
<option value="18:00:00">6:00pm</option>
<option value="18:15:00">6:15pm</option>
<option value="18:30:00">6:30pm</option>
<option value="18:45:00">6:45pm</option>
<option value="19:00:00">7:00pm</option>
<option value="19:15:00">7:15pm</option>
<option value="19:30:00">7:30pm</option>
<option value="19:45:00">7:45pm</option>
<option value="20:00:00">8:00pm</option>
<option value="20:30:00">8:30pm</option>
<option value="21:00:00">9:00pm</option>
<option value="21:30:00">9:30pm</option>
<option value="22:00:00">10:00pm</option>
<option value="22:30:00">10:30pm</option>
<option value="23:00:00">11:00pm</option>
<option value="23:30:00">11:30pm</option>
</select>
</TD><TD></TR><TR><TD>
<NOBR>Appointment Length:</NOBR> 
</TD><TD>
<select name="SHOW_LENGTH" id="SHOW_LENGTH">
<option value="15">15 minutes</option>
<option value="30">30 minutes</option>
<option value="45">45 minutes</option>
<option value="60">1 hour</option>
<option value="90">1.5 hours</option>
<option value="120">2 hours</option>
<option value="180">3 hours</option>
<option value="240">4 hours</option>
</select>
</TD></TR></TABLE>
</TD></TR></TABLE>


</TD></TR>

</table>




</td>


			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">




			<table>
			<tr>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><B>Accounting:</B></div></td>
			</tr>
			</table>

	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>

	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td width="400" bgcolor="<?php echo $pagebgcolor;?>">


<TABLE><TR><TD bgcolor="<?php echo $pagebgcolor;?>" valign="top">

			<table width="100%">
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Tenant fee paid:</div>$<input type="text" name="tenant_fee_paid" size="5" value="<?php echo $rowGetClient->TENANT_FEE_PAID;?>"></td>
			</tr>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">First month paid:</div>$<input type="text" name="payment_first_paid"  size="5" value="<?php echo $rowGetClient->PAYMENT_FIRST_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Last month paid:</div>$<input type="text" name="payment_last_paid" size="5" value="<?php echo $rowGetClient->PAYMENT_LAST_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Security deposit paid:</div>$<input type="text" name="payment_sec_paid" size="5" value="<?php echo $rowGetClient->PAYMENT_SEC_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Key deposit paid:</div>$<input type="text" name="key_dep_paid" size="5" value="<?php echo $rowGetClient->KEY_DEP_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Cleaning deposit paid:</div>$<input type="text" name="clean_dep_paid" size="5" value="<?php echo $rowGetClient->CLEAN_DEP_PAID;?>"></td>
			</tr>
			</table>

</TD><TD bgcolor="<?php echo $pagebgcolor;?>">
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</TD><TD VALIGN="TOP" bgcolor="<?php echo $pagebgcolor;?>" align="left">


<NOBR><div class="menu">Fee Disclosure Given? &nbsp; <input type="checkbox" name="fee_disclosure" value="1" <?php if ($rowGetClient->FEE_DISCLOSURE) { echo " checked "; } ?>></NOBR></DIV>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/rentips-fee-disclosure.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Fee Disclosure</A></NOBR></DIV><BR>

<NOBR><div class="menu">Agency Disclosure Given? &nbsp; <input type="checkbox" name="agency_disclosure" value="1" <?php if ($rowGetClient->AGENCY_DISCLOSURE) { echo " checked "; } ?>></NOBR></DIV>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/agencydisclosure.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Agency Disclosure</A></NOBR></DIV><BR>

<NOBR><div class="menu">Credit Check Completed? &nbsp; <input type="checkbox" name="client_credit_check" value="1" <?php if ($rowGetClient->CLIENT_CREDIT_CHECK) { echo " checked "; } ?>></DIV><br>


<div class="menu">Application status:</div><select name="client_app_status" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['CLIENT_APP_STATUS'] as $askey => $asValue) { 
						$selected = ($rowGetClient->CLIENT_APP_STATUS==$askey) ? " selected " : "";?>
					<option value="<?php echo $askey;?>" <?php echo $selected;?>><?php echo $asValue;?></option>
					<?php } ?>
				</select><br>

<P>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/leadlaw.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Lead law Notice - Rentals</A></NOBR></DIV>

</TD><TD>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/rentips-leadlaw-notification-sale.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Lead law Notice - Sales</A></NOBR></DIV><BR>




</DIV>

</TD></TR></TABLE>


	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">



<!-- Old comments -->



	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td  align="center" bgcolor="<?php echo $pagebgcolor;?>">
			<table width="100%">
			<tr>
			
			<td height="30" align="center" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><input type="image" src="../assets/images/save.gif" alt="SAVE"></td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	</form>

<!--END createClient -->
