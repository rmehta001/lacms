<!--BEGIN editClient -->

<?php
include ("../assets/buttons.php");

if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>


	<?php
	//Preferences reverse//
	$type_pref = string_to_array($rowGetClient->TYPE_PREF, ",");
	$loc_pref = string_to_array($rowGetClient->LOC_PREF, ",");
	$rooms_pref = string_to_array($rowGetClient->ROOMS_PREF, ",");
	$bath_pref = string_to_array($rowGetClient->BATH_PREF, ",");
	$pets_pref = string_to_array($rowGetClient->PETS_PREF, ",");
	$building_pref = string_to_array($rowGetClient->BUILDING_PREF, ",");
	?>
	<br>
	
	<table border="0" cellspacing="0" cellpadding="0"width="85%">
	<tr>
	<td colspan="7" valign="top" width="100%" height="10" bgcolor="#FFFFFF"><div class="ad">
	<nobr>
	<a href="<?php echo "$PHP_SELF?op=hot_list_add&item_type=3&item_id=$clid&return_page=$op&return_page_rid=$clid";?>"><img border="0" hspace="0" vspace="0" width="96" height="23" src="../assets/images/addToHotList.jpg"></a>  &nbsp; | &nbsp; <a href="<?php echo "$PHP_SELF?op=listings&client_id_filter=$rowGetClient->CLID";?>" target="_<?php echo $rowGetClient->CLID;?>"><img border="0" hspace="0" vspace="0" width="19" height="19" src="../assets/images/matchlistings.gif" TITLE="Match Client to Listings" ALT="Match Client to Listings"> Match Client to Listings</a> &nbsp; | &nbsp; <A HREF="<?php echo "$PHP_SELF?op=editClientReassign&clid=$rowGetClient->CLID&fname=$rowGetClient->NAME_FIRST&lname=$rowGetClient->NAME_LAST";?>"><FONT SIZE="-2"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/client-reassign.gif" TITLE="Reassign Client" ALT="Reassign Client"> Reassign Client</FONT></A> 

| <a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowGetClient->CLID";?>" TITLE="Showing History for <?php echo $rowGetClient->NAME_FIRST.$rowGetClient->NAME_LAST;?>" target="_sh<?php echo $rowGetClient->CLID;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History" ALT="Showing History"> Showing History</A>

 | <a href="<?php echo "$PHP_SELF?op=createshowingentry&clid=$rowGetClient->CLID";?>" TITLE="Add Showing History Entry for <?php echo $rowGetClient->NAME_FIRST.$rowGetClient->NAME_LAST;?>" target="_sh<?php echo $rowGetClient->CLID;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings.jpg" TITLE="Showing History" ALT="Showing History"> Add Showing Entry</A>



<?php
if ( $rowGetClient->CLIENT_EMAIL != "" ) {
	echo " | <A HREF=\"$PHP_SELF?op=mail_client&clid=$clid\" target=\"_new\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A> Email Client";
}
; ?>


<?php if ($user_level>1) { ?>

| <a href="<?php echo "$PHP_SELF?op=deleteClient&clid=$rowGetClient->CLID";?>"><img border='0' vspace='0' hspace='0' src='../images/icons/delete.gif'> Delete Client</a>

<?php } ?>

</nobr>
</div></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<form action="<?php echo "$PHP_SELF?op=editClientDo";?>" method="POST">
	<input type="hidden" name="clid" value="<?php echo $rowGetClient->CLID;?>">
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">



<table>
<tr>

<TD COLSPAN=6><div class="controltext">
<NOBR><FONT SIZE="+1">Client Information:</FONT> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Status: <select name="CLIENT_STATUS2" ID="CLIENT_STATUS2" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['CLIENT_STATUS2'] as $cskey => $csValue) { 
						$selected = ($rowGetClient->CLIENT_STATUS2==$cskey) ? " selected " : "";?>
					<option value="<?php echo $cskey;?>" <?php echo $selected;?>><?php echo $csValue;?></option>
					<?php } ?>
				</select>  &nbsp; <?php if ($rowGetClient->STATUS_CLIENT==1) {echo "<B>";}?>Active<?php if ($rowGetClient->STATUS_CLIENT==1) {echo "</B>";}?><img border="0" hspace="2" vspace="0" width="16" height="16" src="../assets/images/client-active.jpg"><input type="radio" name="status_client" value="1" <?php if ($rowGetClient->STATUS_CLIENT==1) {echo "checked";}?>> <?php if ($rowGetClient->STATUS_CLIENT==2) {echo "<B>";}?>Inactive<?php if ($rowGetClient->STATUS_CLIENT==2) {echo "</B>";}?><img border="0" hspace="1" vspace="0" width="16" height="16" src="../assets/images/client-inactive.jpg"><input type="radio" name="status_client" value="2" <?php if ($rowGetClient->STATUS_CLIENT==2) {echo "checked";}?>> 
				

<button class="button-green pure-button">Save</button>
<!-- <input type="image" src="../assets/images/save.gif" alt="SAVE"> -->



</NOBR></DIV>


		<?php 
		$mi_year = substr ($rowGetClient->DATE_MOVEIN, 0, 4);
		$mi_month = substr ($rowGetClient->DATE_MOVEIN, 5,2);
		$mi_day = substr ($rowGetClient->DATE_MOVEIN, 8,2);
		?>


		<?php 
		$mie_year = substr ($rowGetClient->DATE_MOVEIN_END, 0, 4);
		$mie_month = substr ($rowGetClient->DATE_MOVEIN_END, 5,2);
		$mie_day = substr ($rowGetClient->DATE_MOVEIN_END, 8,2);
		?>


<TABLE><TR><TD>

<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0><TR>


	
<TD>

<?php
	if ($rowGetClient->TYPE_PREF=="2" || $rowGetClient->TYPE_PREF=="3" || $rowGetClient->TYPE_PREF=="5" || $rowGetClient->TYPE_PREF=="6" || $rowGetClient->TYPE_PREF=="7" || $rowGetClient->TYPE_PREF=="8" || $rowGetClient->TYPE_PREF=="9" || $rowGetClient->TYPE_PREF=="10" || $rowGetClient->TYPE_PREF=="11" || $rowGetClient->TYPE_PREF=="12" || $rowGetClient->TYPE_PREF=="13") {
	
	$foo= "Bar";

	}else{
?>
		
<NOBR>
<div class="controltext">Move In Date: <FONT SIZE=-3>(begin)</FONT></NOBR></TD><TD>

<NOBR>
<select name="mi_month" STYLE="Background-Color : #FFFFFF">
						<option value="1" <?php if ($mi_month=='01') { echo "selected";}?>>Jan</option>
						<option value="2" <?php if ($mi_month=='02') { echo "selected";}?>>Feb</option>
						<option value="3" <?php if ($mi_month=='03') { echo "selected";}?>>Mar</option>
						<option value="4" <?php if ($mi_month=='04') { echo "selected";}?>>April</option>
						<option value="5" <?php if ($mi_month=='05') { echo "selected";}?>>May</option>
						<option value="6" <?php if ($mi_month=='06') { echo "selected";}?>>Jun</option>
						<option value="7" <?php if ($mi_month=='07') { echo "selected";}?>>Jul</option>
						<option value="8" <?php if ($mi_month=='08') { echo "selected";}?>>Aug</option>
						<option value="9" <?php if ($mi_month=='09') { echo "selected";}?>>Sep</option>
						<option value="10" <?php if ($mi_month=='10') { echo "selected";}?>>Oct</option>
						<option value="11" <?php if ($mi_month=='11') { echo "selected";}?>>Nov</option>
						<option value="12" <?php if ($mi_month=='12') { echo "selected";}?>>Dec</option>
						</select> 
			<select name="mi_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($mi_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>
			<select name="mi_year" STYLE="Background-Color : #FFFFFF">

<?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>

<option value="<?php echo $i+6;?>" <?php if ($mi_year==$i+6) { echo "selected";}?>>
<?php echo $i+6;?>
</option>

<option value="<?php echo $i+5;?>" <?php if ($mi_year==$i+5) { echo "selected";}?>>
<?php echo $i+5;?>
</option>

<option value="<?php echo $i+4;?>" <?php if ($mi_year==$i+4) { echo "selected";}?>>
<?php echo $i+4;?>
</option>

<option value="<?php echo $i+3;?>" <?php if ($mi_year==$i+3) { echo "selected";}?>>
<?php echo $i+3;?>
</option>

<option value="<?php echo $i+2;?>" <?php if ($mi_year==$i+2) { echo "selected";}?>>
<?php echo $i+2;?>
</option>

<option value="<?php echo $i+1;?>" <?php if ($mi_year==$i+1) { echo "selected";}?>>
<?php echo $i+1;?>
</option>

<option value="<?php echo $i;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
<?php echo $i;?>
</option>

<option value="<?php echo $i-1;?>" <?php if ($mi_year==$i-1) { echo "selected";}?>>
<?php echo $i-1;?>
</option>

<option value="<?php echo $i-2;?>" <?php if ($mi_year==$i-2) { echo "selected";}?>>
<?php echo $i-2;?>
</option>

<option value="<?php echo $i-3;?>" <?php if ($mi_year==$i-3) { echo "selected";}?>>
<?php echo $i-3;?>
</option>


						<?php } ?>
						</select>

</NOBR>
<?php } ?>
</TD></TR><TR><TD>

<?php
	if ($rowGetClient->TYPE_PREF=="2" || $rowGetClient->TYPE_PREF=="3" || $rowGetClient->TYPE_PREF=="5" || $rowGetClient->TYPE_PREF=="6" || $rowGetClient->TYPE_PREF=="7" || $rowGetClient->TYPE_PREF=="8" || $rowGetClient->TYPE_PREF=="9" || $rowGetClient->TYPE_PREF=="10" || $rowGetClient->TYPE_PREF=="11" || $rowGetClient->TYPE_PREF=="12" || $rowGetClient->TYPE_PREF=="13") {
	
	$foo= "Bar";

	}else{
?>

<NOBR>
<div class="controltext">Move In Date: <FONT SIZE=-3>(end)</NOBR></FONT>

</TD><TD>
<NOBR>
<select name="mie_month" STYLE="Background-Color : #FFFFFF">
						<option value="1" <?php if ($mie_month=='01') { echo "selected";}?>>Jan</option>
						<option value="2" <?php if ($mie_month=='02') { echo "selected";}?>>Feb</option>
						<option value="3" <?php if ($mie_month=='03') { echo "selected";}?>>Mar</option>
						<option value="4" <?php if ($mie_month=='04') { echo "selected";}?>>April</option>
						<option value="5" <?php if ($mie_month=='05') { echo "selected";}?>>May</option>
						<option value="6" <?php if ($mie_month=='06') { echo "selected";}?>>Jun</option>
						<option value="7" <?php if ($mie_month=='07') { echo "selected";}?>>Jul</option>
						<option value="8" <?php if ($mie_month=='08') { echo "selected";}?>>Aug</option>
						<option value="9" <?php if ($mie_month=='09') { echo "selected";}?>>Sep</option>
						<option value="10" <?php if ($mie_month=='10') { echo "selected";}?>>Oct</option>
						<option value="11" <?php if ($mie_month=='11') { echo "selected";}?>>Nov</option>
						<option value="12" <?php if ($mie_month=='12') { echo "selected";}?>>Dec</option>
						</select> 
			<select name="mie_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($mie_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>
			<select name="mie_year" STYLE="Background-Color : #FFFFFF">

<?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>

<option value="<?php echo $i+7;?>" <?php if ($mie_year==$i+7) { echo "selected";}?>>
<?php echo $i+7;?>
</option>

<option value="<?php echo $i+6;?>" <?php if ($mie_year==$i+6) { echo "selected";}?>>
<?php echo $i+6;?>
</option>

<option value="<?php echo $i+5;?>" <?php if ($mie_year==$i+5) { echo "selected";}?>>
<?php echo $i+5;?>
</option>

<option value="<?php echo $i+4;?>" <?php if ($mie_year==$i+4) { echo "selected";}?>>
<?php echo $i+4;?>
</option>

<option value="<?php echo $i+3;?>" <?php if ($mie_year==$i+3) { echo "selected";}?>>
<?php echo $i+3;?>
</option>

<option value="<?php echo $i+2;?>" <?php if ($mie_year==$i+2) { echo "selected";}?>>
<?php echo $i+2;?>
</option>

<option value="<?php echo $i+1;?>" <?php if ($mie_year==$i+1) { echo "selected";}?>>
<?php echo $i+1;?>
</option>

<option value="<?php echo $i;?>" <?php if ($mie_year==$i) { echo "selected";}?>>
<?php echo $i;?>
</option>

<option value="<?php echo $i-1;?>" <?php if ($mie_year==$i-1) { echo "selected";}?>>
<?php echo $i-1;?>
</option>

<option value="<?php echo $i-2;?>" <?php if ($mie_year==$i-2) { echo "selected";}?>>
<?php echo $i-2;?>
</option>

<option value="<?php echo $i-3;?>" <?php if ($mie_year==$i-3) { echo "selected";}?>>
<?php echo $i-3;?>
</option>
						<?php } ?>
						</select>

</NOBR>
</div>
<?php } ?>
</TD></TR></TABLE>

</DIV>



</TD><TD>
 &nbsp; 
</TD><TD><div class="controltext">
<NOBR>Created: &nbsp;<?php echo $rowGetClient->DATE_CREATED;?> by <?php 

if($rowGetClient->CREATED_BY)
{ echo $rowGetClient->CREATED_BY; }

elseif($rowGetClient->HANDLE)
{ echo $rowGetClient->HANDLE; }
else
{ echo $rowGetClient->UID; }
?></NOBR>
<NOBR>Last Mod: <?php echo $rowGetClient->DATE_MODIFIED;?> by <?php 
if($rowGetClient->MODIFIED_LAST)
{ echo $rowGetClient->MODIFIED_LAST; }
else
{ echo $rowGetClient->UID; }
?></NOBR>
<BR><NOBR>
Share Client with WHOLE OFFICE? <input type="checkbox" name="public" value="1" <?php if ($rowGetClient->PUBLIC != "0") { echo " checked "; } ?>>



<?php 
if ($rowGetClient->SHARE_WITH) {


$quStrGetname2 = "SELECT HANDLE FROM USERS WHERE `GROUP`='$grid' AND `UID`='$rowGetClient->SHARE_WITH' LIMIT 1";
	$quGetname2 = mysqli_query($dbh, $quStrGetname2) or die ("No Agent");

$rowGetname2=mysqli_fetch_object($quGetname2);
	
echo "<B>Shared with ". $rowGetname2->HANDLE; ?></B>&nbsp;<a href="<?php echo "$PHP_SELF?op=editClientShare&clid=$clid&cluid=$rowGetClient->SHARE_WITH&cluid1=$rowGetClient->UID&fname=$rowGetClient->NAME_FIRST&lname=$rowGetClient->NAME_LAST";?>"><font color=green>Change</font></a>

<?php } else { ?>

<B>&nbsp;<a href="<?php echo "$PHP_SELF?op=editClientShare&clid=$clid&cluid1=$rowGetClient->UID&fname=$rowGetClient->NAME_FIRST&lname=$rowGetClient->NAME_LAST";?>"><font color=green>Share Client with Agent</font></a></B>

<?php } ?>
</NOBR>
</DIV>
</TD><TD>
 &nbsp; 
</TD><TD>



		<?php 
		$nc_year = substr ($rowGetClient->DATE_NEXT_CONTACT, 0, 4);
		$nc_month = substr ($rowGetClient->DATE_NEXT_CONTACT, 5,2);
		$nc_day = substr ($rowGetClient->DATE_NEXT_CONTACT, 8,2);
		?>
		
<NOBR>
<div class="controltext">Next Contact Date: </div>
</NOBR>
<NOBR>
<select name="nc_month" STYLE="Background-Color : #FFFFFF">
		<option value="1" <?php if ($nc_month=='01') { echo "selected";}?>>Jan</option>
		<option value="2" <?php if ($nc_month=='02') { echo "selected";}?>>Feb</option>
		<option value="3" <?php if ($nc_month=='03') { echo "selected";}?>>Mar</option>
		<option value="4" <?php if ($nc_month=='04') { echo "selected";}?>>April</option>
		<option value="5" <?php if ($nc_month=='05') { echo "selected";}?>>May</option>
		<option value="6" <?php if ($nc_month=='06') { echo "selected";}?>>Jun</option>
		<option value="7" <?php if ($nc_month=='07') { echo "selected";}?>>Jul</option>
		<option value="8" <?php if ($nc_month=='08') { echo "selected";}?>>Aug</option>
		<option value="9" <?php if ($nc_month=='09') { echo "selected";}?>>Sep</option>
		<option value="10" <?php if ($nc_month=='10') { echo "selected";}?>>Oct</option>
		<option value="11" <?php if ($nc_month=='11') { echo "selected";}?>>Nov</option>
		<option value="12" <?php if ($nc_month=='12') { echo "selected";}?>>Dec</option>
		</select> 
			<select name="nc_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($nc_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>
			<select name="nc_year" STYLE="Background-Color : #FFFFFF">

<?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>



<option value="<?php echo $i+7;?>" <?php if ($nc_year==$i+7) { echo "selected";}?>>
<?php echo $i+7;?>
</option>
<option value="<?php echo $i+6;?>" <?php if ($nc_year==$i+6) { echo "selected";}?>>
<?php echo $i+6;?>
</option>
<option value="<?php echo $i+5;?>" <?php if ($nc_year==$i+5) { echo "selected";}?>>
<?php echo $i+5;?>
</option>
<option value="<?php echo $i+4;?>" <?php if ($nc_year==$i+4) { echo "selected";}?>>
<?php echo $i+4;?>
</option>
<option value="<?php echo $i+3;?>" <?php if ($nc_year==$i+3) { echo "selected";}?>>
<?php echo $i+3;?>
</option>
<option value="<?php echo $i+2;?>" <?php if ($nc_year==$i+2) { echo "selected";}?>>
<?php echo $i+2;?>
</option>
<option value="<?php echo $i+1;?>" <?php if ($nc_year==$i+1) { echo "selected";}?>>
<?php echo $i+1;?>
</option>
<option value="<?php echo $i;?>" <?php if ($nc_year==$i) { echo "selected";}?>>
<?php echo $i;?>
</option>

<option value="<?php echo $i;?>" <?php if ($nc_year==$i) { echo "selected";}?>>
<?php echo $i;?>
</option>

<option value="<?php echo $i-1;?>" <?php if ($nc_year==$i-1) { echo "selected";}?>>
<?php echo $i-1;?>
</option>
<option value="<?php echo $i-2;?>" <?php if ($nc_year==$i-2) { echo "selected";}?>>
<?php echo $i-2;?>
</option>
<option value="<?php echo $i-3;?>" <?php if ($nc_year==$i-3) { echo "selected";}?>>
<?php echo $i-3;?>
</option>
<option value="<?php echo $i-4;?>" <?php if ($nc_year==$i-4) { echo "selected";}?>>
<?php echo $i-4;?>
</option>

						<?php } ?>
						</select>

&nbsp; &nbsp; &nbsp; 						
		Subscribed to Daily Emails &amp; Newsletters: <input type="checkbox" name="newsletter_subscribe" <?php if ($rowGetClient->NEWSLETTER_SUBSCRIBE=='2') { echo checked;} ?> value="2">
</DIV>
						
</NOBR>


</DIV>
</TD></TR></TABLE>




</TD>
</TR><TR>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>First Name:</NOBR></div><input type="text" name="name_first" size="20" value="<?php echo $rowGetClient->NAME_FIRST;?>"></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Last Name:</NOBR></div><input type="text" name="name_last" size="20" value="<?php echo $rowGetClient->NAME_LAST;?>"></td>

			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>

			
			<TD><TABLE BORDER=0><TR>
			
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Interested in:</NOBR></div>
			
			<select name="type_pref" STYLE="Background-Color : #FFFFFF" SIZE="2" >
			<?php while ($rowTypes = mysqli_fetch_object($quTypes)) {?>
			<option value="<?php echo $rowTypes->TYPE;?>"  <?php
			if ($rowGetClient->TYPE_PREF== $rowTypes->TYPE) { echo " selected "; }
			?> ><?php echo $rowTypes->TYPENAME;?></option>
			<?php }?>
			</select>
			

			</TD>
			
					<td rowspan="2" valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">
<nobr>Building Pref:</NOBR></div>
<select name="building_pref[]" multiple SIZE=3 STYLE="Background-Color : #FFFFFF">
				<?php foreach ($DEFINED_VALUE_SETS['BUILDING_TYPE'] as $bkey => $bval) { ?>
				<option value="<?php echo $bkey;?>" <?php if (in_array($bkey, $building_pref)) { echo " selected "; }?>><?php echo $bval;?></option>
				<?php }?>
				</select><br>
			</TD>
			
			</TR><TR>
			
<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">
<nobr>Sub Type:</NOBR></div><select name="client_subtype" STYLE="Background-Color : #FFFFFF">
<option value="">--</option>
			<option value="3" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="3") { echo " selected "; }
			?>>Accessories</option>
					<option value="4" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="4") { echo " selected "; }
			?>>Apparel - Men</option>
			<option value="5" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="5") { echo " selected "; }
			?>>Apparel - Women</option>
			<option value="6" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="6") { echo " selected "; }
			?>>Apparel - Kids</option>
			<option value="7" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="7") { echo " selected "; }
			?>>Apparel - Baby</option>
			<option value="8" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="8") { echo " selected "; }
			?>>Art</option>
			<option value="72" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="72") { echo " selected "; }
			?>>Attorney</option>
			<option value="9" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="9") { echo " selected "; }
			?>>Auto Dealerships</option>
			<option value="10" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="10") { echo " selected "; }
			?>>Auto Supply</option>
			<option value="1" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="1") { echo " selected "; }
			?>>Banks</option>		
			<option value="11" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="11") { echo " selected "; }
			?>>Beauty Salons</option>
			<option value="12" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="12") { echo " selected "; }
			?>>Bridal</option>
			<option value="75" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="75") { echo " selected "; }
			?>>Broker-Business</option>
			<option value="76" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="76") { echo " selected "; }
			?>>Broker-Industrial</option>
			<option value="77" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="77") { echo " selected "; }
			?>>Broker-Investment Sales</option>
			<option value="78" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="78") { echo " selected "; }
			?>>Broker-Office</option>
			<option value="79" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="79") { echo " selected "; }
			?>>Broker-Residential</option>
			<option value="80" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="80") { echo " selected "; }
			?>>Broker-Restaurants</option>
			<option value="13" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="13") { echo " selected "; }
			?>>Candy</option>
				<option value="14" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="14") { echo " selected "; }
			?>>Cards</option>
				<option value="15" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="15") { echo " selected "; }
			?>>Check Cashing/Pawn</option>	
			<option value="16" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="16") { echo " selected "; }
			?>>Childcare</option>
				<option value="17" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="17") { echo " selected "; }
			?>>Coffee</option>
				<option value="18" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="18") { echo " selected "; }
			?>>Computer</option>
				<option value="19" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="19") { echo " selected "; }
			?>>Convenience</option>
				<option value="89" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="89") { echo " selected "; }
			?>>Contractor</option>
				<option value="20" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="20") { echo " selected "; }
			?>>Cosmetics</option>	
			<option value="21" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="21") { echo " selected "; }
			?>>Cutlery</option>
			<option value="67" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="67") { echo " selected "; }
			?>>Dentist</option>
			<option value="88" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="88") { echo " selected "; }
			?>>Dance Studio</option>
			<option value="22" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="22") { echo " selected "; }
			?>>Department Store</option>
			<option value="81" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="81") { echo " selected "; }
			?>>Developer-Residential</option>
			<option value="82" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="82") { echo " selected "; }
			?>>Developer-Commercial</option>
			<option value="83" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="83") { echo " selected "; }
			?>>Developer-Retail</option>	
			<option value="23" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="23") { echo " selected "; }
			?>>Discount Store</option>
			<option value="68" <?php 
			if ($rowGetClient->CLIENT_SUBTYPE=="68") { echo " selected "; }
			?>>Doctor</option>
				<option value="24" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="24") { echo " selected "; }
			?>>Drug Store</option>	
			<option value="25" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="25") { echo " selected "; }
			?>>Dry cleaning</option>
				<option value="26" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="26") { echo " selected "; }
			?>>Educational</option>	
			<option value="27" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="27") { echo " selected "; }
			?>>Fabrics</option>
				<option value="28" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="28") { echo " selected "; }
			?>>Fast Food</option>
				<option value="29" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="29") { echo " selected "; }
			?>>Fine Jewelry</option>	
			<option value="30" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="30") { echo " selected "; }
			?>>Fitness Equipment</option>
				<option value="31" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="31") { echo " selected "; }
			?>>Flooring</option>
				<option value="32" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="32") { echo " selected "; }
			?>>Florist</option>
				<option value="33" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="33") { echo " selected "; }
			?>>Furniture</option>
				<option value="34" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="34") { echo " selected "; }
			?>>Gas</option>
				<option value="35" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="35") { echo " selected "; }
			?>>Gifts</option>
				<option value="36" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="36") { echo " selected "; }
			?>>Hardware/Home Improvement</option>
				<option value="37" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="37") { echo " selected "; }
			?>>Health clubs/gyms</option>
				<option value="38" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="38") { echo " selected "; }
			?>>Home Decor</option>
				<option value="39" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="39") { echo " selected "; }
			?>>Housewares</option>
				<option value="84" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="84") { echo " selected "; }
			?>>Investor-Office</option>
			<option value="85" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="85") { echo " selected "; }
			?>>Investor-Retail</option>
			<option value="86" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="86") { echo " selected "; }
			?>>Investor-Residential</option>			
			<option value="74" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="74") { echo " selected "; }
			?>>Laundromat</option>
				<option value="40" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="40") { echo " selected "; }
			?>>Leather/luggage</option>
				<option value="41" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="41") { echo " selected "; }
			?>>Liquor</option>
				<option value="42" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="42") { echo " selected "; }
			?>>Major appliance</option>
				<option value="72" <?php 
			if ($rowGetClient->CLIENT_SUBTYPE=="72") { echo " selected "; }
			?>>Massage</option>
				<option value="43" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="43") { echo " selected "; }
			?>>Medical equipment</option>
				<option value="44" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="44") { echo " selected "; }
			?>>Movie Theaters</option>
			<option value="45" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="45") { echo " selected "; }
			?>>Music instruments</option>
			<option value="46" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="46") { echo " selected "; }
			?>>Nutrition</option>
			<option value="47" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="47") { echo " selected "; }
			?>>Office Supply</option>
			<option value="69" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="69") { echo " selected "; }
			?>>Office Use</option>
			<option value="48" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="48") { echo " selected "; }
			?>>Optical/eye-ware</option>
			<option value="49" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="49") { echo " selected "; }
			?>>Outdoor pool/patio</option>
			<option value="50" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="50") { echo " selected "; }
			?>>Paper/Party Store</option>
			<option value="51" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="51") { echo " selected "; }
			?>>Pet Supply</option>
			<option value="52" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="52") { echo " selected "; }
			?>>Photocopies/printing</option>
			<option value="87" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="87") { echo " selected "; }
			?>>Pizza</option>
			<option value="90" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="90") { echo " selected "; }
			?>>Property Management/Vendor</option>

			<option value="91" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="91") { echo " selected "; }
			?>>Property Management/Tenant</option>

			<option value="66" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="66") { echo " selected "; }
			?>>Psychologist</option>
			<option value="70" <?php	
			if ($rowGetClient->CLIENT_SUBTYPE=="70") { echo " selected "; }
			?>>Real Estate Office</option>
			<option value="53" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="53") { echo " selected "; }
			?>>Rental Center</option>
			<option value="2" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="2") { echo " selected "; }
			?>>Restaurants/Bars</option>
			<option value="73" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="73") { echo " selected "; }
			?>>Salon</option>
			<option value="55" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="55") { echo " selected "; }
			?>>Seasonal</option>
			<option value="56" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="56") { echo " selected "; }
			?>>Shoes</option>
			<option value="57" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="57") { echo " selected "; }
			?>>Signs</option>
			<option value="58" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="58") { echo " selected "; }
			?>>Specialty foods</option>
			<option value="59" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="59") { echo " selected "; }
			?>>Sporting Goods</option>
			<option value="60" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="60") { echo " selected "; }
			?>>Supermarkets</option>
			<option value="61" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="61") { echo " selected "; }
			?>>Tobacco</option>
			<option value="62" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="62") { echo " selected "; }
			?>>Toys/Games/Video Games</option>
			<option value="63" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="63") { echo " selected "; }
			?>>Wall coverings/pain</option>
			<option value="64" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="64") { echo " selected "; }
			?>>Warehouses/Wholesale Clubs</option>
		<option value="65" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="65") { echo " selected "; }
			?>>Wireless Communications</option>
		<option value="54" <?php
			if ($rowGetClient->CLIENT_SUBTYPE=="54") { echo " selected "; }
			?>>Yogurt</option>
		
			</select>

			</td>
			

			

			
			
			</TD></TR></TABLE>
			
			</TD></TR></TABLE>


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
			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Email:</div><NOBR><input type="text" name="client_email" size="20" value="<?php echo htmlspecialchars($rowGetClient->CLIENT_EMAIL);?>">
<?php
if ( $rowGetClient->CLIENT_EMAIL != "" ) {

	echo "<A HREF=\"$PHP_SELF?op=mail_client&clid=$clid\" target=\"_new\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A>";

} else {
	echo " &nbsp; ";
}
; ?>
</NOBR>
</td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">
			
&nbsp;
</td>
			<td valign="bottom" height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">


<div class="controltext">Email (Alternate):</div><NOBR><input type="text" name="client_email2" size="20" value="<?php echo htmlspecialchars($rowGetClient->CLIENT_EMAIL2);?>">

<?php
if ( $rowGetClient->CLIENT_EMAIL2 != "" ) {
	echo "<A HREF=\"$PHP_SELF?op=mail_client&clid=$clid\" target=\"_new\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A>";
} else {
	echo " &nbsp; ";
}
; ?>

</NOBR>

</td>



<td valign="bottom" height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
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

<div class="controltext"><NOBR>Price Minimum:</div><NOBR><NOBR>$<input type="text" name="pricemin" value="<?php echo $rowGetClient->PRICEMIN;?>">
</NOBR>
</td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">
<div class="controltext"><NOBR>Price Maximum:</NOBR></div><NOBR>$<input type="text" name="pricemax" value="<?php echo $rowGetClient->PRICEMAX;?>">
</NOBR>
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
			
			<td valign="top" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">



<div class="controltext"><NOBR>Location preference(s):</NOBR></div><select name="loc_pref[]" multiple SIZE=8 STYLE="Background-Color : #FFFFFF">
				
					<?php while ($rowFavLocs = mysqli_fetch_object($quFavLocs)) { ?>
	<option value="<?php echo $rowFavLocs->LOCID;?>" <?php if ($rowGetAd->LOC==$rowFavLocs->LOCID) {echo " selected"; $locSeled = true; }?>><?php echo $rowFavLocs->LOCNAME;?></option>
	<?php } ?>
<option value="0">--------------------</option>
				
				<?php while ($rowLocs = mysqli_fetch_object($quLocs)) { ?>
				<option value="<?php echo $rowLocs->LOCID;?>" <?php if (in_array($rowLocs->LOCID, $loc_pref)) { echo " selected "; }?>><?php echo $rowLocs->LOCNAME;?></option>
				<?php } ?>
				</select>




</td>
			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td valign="top" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">




<div class="controltext"><NOBR># of Bedrooms:</NOBR></div><select name="rooms_pref[]" multiple SIZE=8 STYLE="Background-Color : #FFFFFF"> 


				<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $roomkey => $roomval) { ?>
				<option value="<?php echo $roomkey;?>" <?php if (in_array($roomkey, $rooms_pref)) { echo " selected "; }?>><?php echo $roomval;?></option>
				<?php }?>

				</select>

</td>


			<td height="30" width="1" bgcolor="<?php echo $pagebgcolor;?>">&nbsp;</td>
			<td valign="top" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">



<div class="controltext"><NOBR># of Baths:</NOBR></div><select name="bath_pref[]" multiple SIZE=3 STYLE="Background-Color : #FFFFFF"> 
				<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bathkey => $bathval) { ?>
				<option value="<?php echo $bathkey;?>" <?php if (in_array($bathkey, $bath_pref)) { echo " selected "; }?>><?php echo $bathval;?></option>
				<?php }?>

				</select>


<FONT SIZE="-3"><BR></FONT>
<div class="controltext"><NOBR>Pets preference:</NOBR></div><select name="pets_pref[]" multiple SIZE=3 STYLE="Background-Color : #FFFFFF"> 



				<?php foreach ($DEFINED_VALUE_SETS['PETSA'] as $petskey => $petsval) { ?>
				<option value="<?php echo $petskey;?>" <?php if (in_array($petskey, $pets_pref)) { echo " selected "; }?>><?php echo $petsval;?></option>
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

<a name="appointment"></a>

			<table>
			<tr>
			
			<td valign="bottom" height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">

<TABLE BORDER="1" BORDERCOLOR="#000000" CELLPADDING="2"><TR><TD>
<TABLE><TR><TD><NOBR>
<B>Appointment on:</B>
</NOBR></TD><TD><NOBR>
<INPUT TYPE="TEXT" NAME="SHOW_DATE" id="SHOW_DATE" class="w16em dateformat-Y-ds-m-ds-d" value="<?php 

if ($rowGetClient->SHOW_DATE !="0000-00-00")
{ echo $rowGetClient->SHOW_DATE; } else { echo "";}?>" SIZE="10">
</NOBR></TD></TR><TR><TD><NOBR>
<B>Time:</B> 
</NOBR></TD><TD><NOBR>
<select name="SHOW_TIME" id="SHOW_TIME">

<option value="00:00:00" 
<?php if ($rowGetClient->SHOW_TIME == "00:00:00" ) { echo " selected=\"selected\" "; } ?>
>12:00am</option>
<option value="00:30:00" <?php if ($rowGetClient->SHOW_TIME == "00:30:00" ) { echo " selected=\"selected\" "; } ?>
>12:30am</option>
<option value="01:00:00" <?php if ($rowGetClient->SHOW_TIME == "01:00:00" ) { echo " selected=\"selected\" "; } ?>
>1:00am</option>
<option value="01:30:00" <?php if ($rowGetClient->SHOW_TIME == "01:30:00" ) { echo " selected=\"selected\" "; } ?>
>1:30am</option>
<option value="02:00:00" <?php if ($rowGetClient->SHOW_TIME == "02:00:00" ) { echo " selected=\"selected\" "; } ?>
>2:00am</option>
<option value="02:30:00" <?php if ($rowGetClient->SHOW_TIME == "02:30:00" ) { echo " selected=\"selected\" "; } ?>
>2:30am</option>
<option value="03:00:00" <?php if ($rowGetClient->SHOW_TIME == "03:00:00" ) { echo " selected=\"selected\" "; } ?>
>3:00am</option>
<option value="03:30:00" <?php if ($rowGetClient->SHOW_TIME == "03:30:00" ) { echo " selected=\"selected\" "; } ?>
>3:30am</option>
<option value="04:00:00" <?php if ($rowGetClient->SHOW_TIME == "04:00:00" ) { echo " selected=\"selected\" "; } ?>
>4:00am</option>
<option value="04:30:00" <?php if ($rowGetClient->SHOW_TIME == "04:30:00" ) { echo " selected=\"selected\" "; } ?>
>4:30am</option>
<option value="05:00:00" <?php if ($rowGetClient->SHOW_TIME == "05:00:00" ) { echo " selected=\"selected\" "; } ?>
>5:00am</option>
<option value="05:30:00" <?php if ($rowGetClient->SHOW_TIME == "05:30:00" ) { echo " selected=\"selected\" "; } ?>
>5:30am</option>
<option value="06:00:00" <?php if ($rowGetClient->SHOW_TIME == "06:00:00" ) { echo " selected=\"selected\" "; } ?>
>6:00am</option>
<option value="06:30:00" <?php if ($rowGetClient->SHOW_TIME == "06:30:00" ) { echo " selected=\"selected\" "; } ?>
>6:30am</option>
<option value="07:00:00" <?php if ($rowGetClient->SHOW_TIME == "07:00:00" ) { echo " selected=\"selected\" "; } ?>
>7:00am</option>
<option value="07:30:00" <?php if ($rowGetClient->SHOW_TIME == "07:30:00" ) { echo " selected=\"selected\" "; } ?>
>7:30am</option>
<option value="08:00:00" <?php if ($rowGetClient->SHOW_TIME == "08:00:00" ) { echo " selected=\"selected\" "; } ?>
>8:00am</option>
<option value="08:30:00" <?php if ($rowGetClient->SHOW_TIME == "08:30:00" ) { echo " selected=\"selected\" "; } ?>
>8:30am</option>
<option value="08:45:00" <?php if ($rowGetClient->SHOW_TIME == "08:45:00" ) { echo " selected=\"selected\" "; } ?>
>8:45am</option>
<option value="09:00:00" <?php if ($rowGetClient->SHOW_TIME == "09:00:00" ) { echo " selected=\"selected\" "; } ?>>9:00am</option>
<option value="09:15:00" <?php if ($rowGetClient->SHOW_TIME == "09:15:00" ) { echo " selected=\"selected\" "; } ?>>9:15am</option>
<option value="09:30:00" <?php if ($rowGetClient->SHOW_TIME == "09:30:00" ) { echo " selected=\"selected\" "; } ?>>9:30am</option>
<option value="09:45:00" <?php if ($rowGetClient->SHOW_TIME == "09:45:00" ) { echo " selected=\"selected\" "; } ?>>9:45am</option>
<option value="10:00:00" <?php if ($rowGetClient->SHOW_TIME == "10:00:00" ) { echo " selected=\"selected\" "; } ?>>10:00am</option>
<option value="10:15:00" <?php if ($rowGetClient->SHOW_TIME == "10:15:00" ) { echo " selected=\"selected\" "; } ?>>10:15am</option>
<option value="10:30:00" <?php if ($rowGetClient->SHOW_TIME == "10:30:00" ) { echo " selected=\"selected\" "; } ?>>10:30am</option>
<option value="10:45:00" <?php if ($rowGetClient->SHOW_TIME == "10:45:00" ) { echo " selected=\"selected\" "; } ?>>10:45am</option>
<option value="11:00:00" <?php if ($rowGetClient->SHOW_TIME == "11:00:00" ) { echo " selected=\"selected\" "; } ?>>11:00am</option>
<option value="11:15:00" <?php if ($rowGetClient->SHOW_TIME == "11:15:00" ) { echo " selected=\"selected\" "; } ?>>11:15am</option>
<option value="11:30:00" <?php if ($rowGetClient->SHOW_TIME == "11:30:00" ) { echo " selected=\"selected\" "; } ?>>11:30am</option>
<option value="11:45:00" <?php if ($rowGetClient->SHOW_TIME == "11:45:00" ) { echo " selected=\"selected\" "; } ?>>11:45am</option>
<option value="12:00:00" <?php if ($rowGetClient->SHOW_TIME == "12:00:00" ) { echo " selected=\"selected\" "; } ?>>12:00pm</option>
<option value="12:15:00" <?php if ($rowGetClient->SHOW_TIME == "12:15:00" ) { echo " selected=\"selected\" "; } ?>>12:15pm</option>
<option value="12:30:00" <?php if ($rowGetClient->SHOW_TIME == "12:30:00" ) { echo " selected=\"selected\" "; } ?>>12:30pm</option>
<option value="12:45:00" <?php if ($rowGetClient->SHOW_TIME == "12:45:00" ) { echo " selected=\"selected\" "; } ?>>12:45pm</option>
<option value="13:00:00" <?php if ($rowGetClient->SHOW_TIME == "13:00:00" ) { echo " selected=\"selected\" "; } ?>>1:00pm</option>
<option value="13:15:00" <?php if ($rowGetClient->SHOW_TIME == "13:15:00" ) { echo " selected=\"selected\" "; } ?>>1:15pm</option>
<option value="13:30:00" <?php if ($rowGetClient->SHOW_TIME == "13:30:00" ) { echo " selected=\"selected\" "; } ?>>1:30pm</option>
<option value="13:45:00" <?php if ($rowGetClient->SHOW_TIME == "13:45:00" ) { echo " selected=\"selected\" "; } ?>>1:45pm</option>
<option value="14:00:00" <?php if ($rowGetClient->SHOW_TIME == "14:00:00" ) { echo " selected=\"selected\" "; } ?>>2:00pm</option>
<option value="14:15:00" <?php if ($rowGetClient->SHOW_TIME == "14:15:00" ) { echo " selected=\"selected\" "; } ?>>2:15pm</option>
<option value="14:30:00" <?php if ($rowGetClient->SHOW_TIME == "14:30:00" ) { echo " selected=\"selected\" "; } ?>>2:30pm</option>
<option value="14:45:00" <?php if ($rowGetClient->SHOW_TIME == "14:45:00" ) { echo " selected=\"selected\" "; } ?>>2:45pm</option>
<option value="15:00:00" <?php if ($rowGetClient->SHOW_TIME == "15:00:00" ) { echo " selected=\"selected\" "; } ?>>3:00pm</option>
<option value="15:15:00" <?php if ($rowGetClient->SHOW_TIME == "15:15:00" ) { echo " selected=\"selected\" "; } ?>>3:15pm</option>
<option value="15:30:00" <?php if ($rowGetClient->SHOW_TIME == "15:30:00" ) { echo " selected=\"selected\" "; } ?>>3:30pm</option>
<option value="15:45:00" <?php if ($rowGetClient->SHOW_TIME == "15:45:00" ) { echo " selected=\"selected\" "; } ?>>3:45pm</option>
<option value="16:00:00" <?php if ($rowGetClient->SHOW_TIME == "16:00:00" ) { echo " selected=\"selected\" "; } ?>>4:00pm</option>
<option value="16:15:00" <?php if ($rowGetClient->SHOW_TIME == "16:15:00" ) { echo " selected=\"selected\" "; } ?>>4:15pm</option>
<option value="16:30:00" <?php if ($rowGetClient->SHOW_TIME == "16:30:00" ) { echo " selected=\"selected\" "; } ?>>4:30pm</option>
<option value="16:45:00" <?php if ($rowGetClient->SHOW_TIME == "16:45:00" ) { echo " selected=\"selected\" "; } ?>>4:45pm</option>
<option value="17:00:00" <?php if ($rowGetClient->SHOW_TIME == "17:00:00" ) { echo " selected=\"selected\" "; } ?>>5:00pm</option>
<option value="17:15:00" <?php if ($rowGetClient->SHOW_TIME == "17:15:00" ) { echo " selected=\"selected\" "; } ?>>5:15pm</option>
<option value="17:30:00" <?php if ($rowGetClient->SHOW_TIME == "17:30:00" ) { echo " selected=\"selected\" "; } ?>>5:30pm</option>
<option value="17:45:00" <?php if ($rowGetClient->SHOW_TIME == "17:45:00" ) { echo " selected=\"selected\" "; } ?>>5:45pm</option>
<option value="18:00:00" <?php if ($rowGetClient->SHOW_TIME == "18:00:00" ) { echo " selected=\"selected\" "; } ?>>6:00pm</option>
<option value="18:15:00" <?php if ($rowGetClient->SHOW_TIME == "18:15:00" ) { echo " selected=\"selected\" "; } ?>>6:15pm</option>
<option value="18:30:00" <?php if ($rowGetClient->SHOW_TIME == "18:30:00" ) { echo " selected=\"selected\" "; } ?>>6:30pm</option>
<option value="18:45:00" <?php if ($rowGetClient->SHOW_TIME == "18:45:00" ) { echo " selected=\"selected\" "; } ?>>6:45pm</option>
<option value="19:00:00" <?php if ($rowGetClient->SHOW_TIME == "19:00:00" ) { echo " selected=\"selected\" "; } ?>>7:00pm</option>
<option value="19:15:00" <?php if ($rowGetClient->SHOW_TIME == "19:15:00" ) { echo " selected=\"selected\" "; } ?>>7:15pm</option>
<option value="19:30:00" <?php if ($rowGetClient->SHOW_TIME == "19:30:00" ) { echo " selected=\"selected\" "; } ?>>7:30pm</option>
<option value="19:45:00" <?php if ($rowGetClient->SHOW_TIME == "19:45:00" ) { echo " selected=\"selected\" "; } ?>>7:45pm</option>
<option value="20:00:00" <?php if ($rowGetClient->SHOW_TIME == "20:00:00" ) { echo " selected=\"selected\" "; } ?>>8:00pm</option>
<option value="20:30:00" <?php if ($rowGetClient->SHOW_TIME == "20:30:00" ) { echo " selected=\"selected\" "; } ?>>8:30pm</option>
<option value="21:00:00" <?php if ($rowGetClient->SHOW_TIME == "21:00:00" ) { echo " selected=\"selected\" "; } ?>>9:00pm</option>
<option value="21:30:00" <?php if ($rowGetClient->SHOW_TIME == "21:30:00" ) { echo " selected=\"selected\" "; } ?>>9:30pm</option>
<option value="22:00:00" <?php if ($rowGetClient->SHOW_TIME == "22:00:00" ) { echo " selected=\"selected\" "; } ?>>10:00pm</option>
<option value="22:30:00" <?php if ($rowGetClient->SHOW_TIME == "22:30:00" ) { echo " selected=\"selected\" "; } ?>>10:30pm</option>
<option value="23:00:00" <?php if ($rowGetClient->SHOW_TIME == "23:00:00" ) { echo " selected=\"selected\" "; } ?>>11:00pm</option>
<option value="23:30:00" <?php if ($rowGetClient->SHOW_TIME == "23:30:00" ) { echo " selected=\"selected\" "; } ?>>11:30pm</option>
</select>
</NOBR></TD><TD></TR><TR><TD>
<NOBR><B>Appointment Length:</B> </NOBR>
</TD><TD><NOBR>
<select name="SHOW_LENGTH" id="SHOW_LENGTH">
<option value="15" <?php if ($rowGetClient->SHOW_LENGTH == "15" ) { echo " selected=\"selected\" "; } ?>>15 minutes</option>
<option value="30" <?php if ($rowGetClient->SHOW_LENGTH == "30" ) { echo " selected=\"selected\" "; } ?>>30 minutes</option>
<option value="45" <?php if ($rowGetClient->SHOW_LENGTH == "45" ) { echo " selected=\"selected\" "; } ?>>45 minutes</option>
<option value="60" <?php if ($rowGetClient->SHOW_LENGTH == "60" ) { echo " selected=\"selected\" "; } ?>>1 hour</option>
<option value="90" <?php if ($rowGetClient->SHOW_LENGTH == "90" ) { echo " selected=\"selected\" "; } ?>>1.5 hours</option>
<option value="120" <?php if ($rowGetClient->SHOW_LENGTH == "120" ) { echo " selected=\"selected\" "; } ?>>2 hours</option>
<option value="180" <?php if ($rowGetClient->SHOW_LENGTH == "180" ) { echo " selected=\"selected\" "; } ?>>3 hours</option>
<option value="240" <?php if ($rowGetClient->SHOW_LENGTH == "240" ) { echo " selected=\"selected\" "; } ?>>4 hours</option>
</select>
</NOBR></TD>
<TD ROWSPAN="3"><NOBR>
&nbsp;&nbsp;&nbsp;&nbsp;
</NOBR></TD>
<TD ROWSPAN="3">
<button class="button-green pure-button">Save</button>
<!-- <input type="image" src="../assets/images/save.gif" alt="SAVE"> -->
</TD>
</TR></TABLE>
</TD></TR></TABLE>

<B><a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowGetClient->CLID";?>#appointment" TITLE="Edit/View <?php echo $rowGetClient->NAME_FIRST.$rowGetClient->NAME_LAST;?>" target="_sh<?php echo $rowGetClient->CLID;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History" ALT="Showing History"> Client Showing History</A></B><BR>


	<table>
			<tr>
			
			<td height="40" width="100" bgcolor="<?php echo $pagebgcolor;?>" COLSPAN="5">

<div class="controltext">Additional Comments:</div><textarea name="client_notes" rows="5" cols="75"><?php echo $rowGetClient->CLIENT_NOTES;?></textarea></td>
			</tr>
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
			<TD WIDTH="120"> &nbsp; </TD>
			<TD><div class="controltext"><B>Paperwork:</B></DIV></TD>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000">
<img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td width="400" bgcolor="<?php echo $pagebgcolor;?>">


<TABLE><TR><TD bgcolor="<?php echo $pagebgcolor;?>" VALIGN="TOP">

			<table width="100%">
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Tenant fee paid:</NOBR></div>$<input type="text" name="tenant_fee_paid" size="5" value="<?php echo $rowGetClient->TENANT_FEE_PAID;?>"></td>
			</tr>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>First month paid:</NOBR></div>$<input type="text" name="payment_first_paid"  size="5" value="<?php echo $rowGetClient->PAYMENT_FIRST_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Last month paid:</NOBR></div>$<input type="text" name="payment_last_paid" size="5" value="<?php echo $rowGetClient->PAYMENT_LAST_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Security deposit paid:</NOBR></div>$<input type="text" name="payment_sec_paid" size="5" value="<?php echo $rowGetClient->PAYMENT_SEC_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Key deposit paid:</NOBR></div>$<input type="text" name="key_dep_paid" size="5" value="<?php echo $rowGetClient->KEY_DEP_PAID;?>"></td>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><NOBR>Cleaning deposit paid:</NOBR></div>$<input type="text" name="clean_dep_paid" size="5" value="<?php echo $rowGetClient->CLEAN_DEP_PAID;?>"></td>
			</tr>
			</table>


</TD><TD bgcolor="<?php echo $pagebgcolor;?>">
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</TD><TD VALIGN="TOP" bgcolor="<?php echo $pagebgcolor;?>" align="left">

<div class="menu">Application status:</div><select name="client_app_status" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['CLIENT_APP_STATUS'] as $askey => $asValue) { 
						$selected = ($rowGetClient->CLIENT_APP_STATUS==$askey) ? " selected " : "";?>
					<option value="<?php echo $askey;?>" <?php echo $selected;?>><?php echo $asValue;?></option>
					<?php } ?>
				</select><br>

<LI><A HREF="<?php echo "$PHP_SELF?op=editClientapp&clid=$clid"; ?>">Edit Application</A><BR>
<LI><A HREF="javascript:popUpapp('./printout_application.php?clid=<?php echo $rowGetClient->CLID;?>');"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Application</A><BR>
<LI><A HREF="http://www.criminalpages.com/state-criminal-records-directory/state-of-massachusetts-criminal-records/" target="_criminal">Criminal History Check</A><BR>

<NOBR><div class="menu">Credit Check Completed? &nbsp; <input type="checkbox" name="client_credit_check" value="1" <?php if ($rowGetClient->CLIENT_CREDIT_CHECK) { echo " checked "; } ?>></DIV><br>

<NOBR><div class="menu">Fee Disclosure Given? &nbsp; <input type="checkbox" name="fee_disclosure" value="1" <?php if ($rowGetClient->FEE_DISCLOSURE) { echo " checked "; } ?>></NOBR></DIV>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/rentips-fee-disclosure.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Fee Disclosure</A></NOBR></DIV><BR>

<NOBR><div class="menu">Agency Disclosure Given? &nbsp; <input type="checkbox" name="agency_disclosure" value="1" <?php if ($rowGetClient->AGENCY_DISCLOSURE) { echo " checked "; } ?>></NOBR></DIV>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/agencydisclosure.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Agency Disclosure</A></NOBR></DIV><BR>

<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/leadlaw.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Lead law Notice - Rentals</A></NOBR></DIV>
<div class="menu"><NOBR><A HREF="https://www.BostonApartments.com/rentips-leadlaw-notification-sale.htm" target="_NEW"><img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18">Print Lead law Notice - Sales</A></NOBR></DIV><BR>


<P>
</TD>
<TD VALIGN="TOP"><div class="menu">
<NOBR>Client Source:
<select name="SOURCE" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['SOURCE'] as $skey => $sValue) { 
						$selected = ($rowGetClient->SOURCE==$skey) ? " selected " : "";?>
					<option value="<?php echo $skey;?>" <?php echo $selected;?>><?php echo $sValue;?></option>
					<?php } ?>
				</select>
</NOBR>
<br>
</DIV>
</TD>
</TR>
</TABLE>



	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td bgcolor="<?php echo $pagebgcolor;?>">
			<table>
			<tr>
			
			<td height="30" width="20" bgcolor="<?php echo $pagebgcolor;?>">


<!-- placeholder -->

</td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	<td  align="center" bgcolor="<?php echo $pagebgcolor;?>">
			<table width="100%">
			<tr>
			
			<td height="30" align="center" bgcolor="<?php echo $pagebgcolor;?>">


<button class="button-green pure-button">Save</button>
<!-- <input type="image" src="../assets/images/save.gif" alt="SAVE"> -->


</td>
			</tr>
			</table>
	</td>
	<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="80%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
	<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	</form>

<!--END editClient -->
