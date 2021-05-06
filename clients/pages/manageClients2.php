<!--BEGIN manageClients -->
<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}

if ($pref_coltit=="") {
$coltitcolor="#3DB1FF";
} else {
$coltitcolor="$pref_coltit";
}
?>

<TABLE WIDTH="95%" CELLPADDING="0" CELLPADDING="0" BORDER="0"><TR><TD WIDTH="80"><a href="<?php echo "$PHP_SELF?op=createClient";?>"><img border="0" hspace="0" vspace="0" width="80" height="45" src="../assets/images/newClient.gif"></a></TD>
<TD ALIGN="CENTER">


<TABLE WIDTH="250" CELLPADDING="0" CELLPADDING="0" BORDER="0"><TR>
<TD ALIGN="CENTER"><img border="0" width="48" height="48" src="../assets/images/icons/Address-Book-icon.png"></TD><TD> <FONT SIZE="+1"><B>MANAGE CLIENTS</B></FONT>
</TD></TR></TABLE>

</TD>
<TD WIDTH="80">&nbsp;</TR></TABLE>
	
	<table border="1" BORDERCOLOR="#000000" cellspacing="0" cellpadding="2" WIDTH="95%" BGCOLOR="#FFFFFF"><TR><TD><CENTER>

	<div style="border:1px solid black;width:920px;height:110px;background-color:<?php echo $pagebgcolor;?>;padding:5px;">

<table border="1" cellspacing="0" cellpadding="5" WIDTH="100%">
<form action="<?php echo "$PHP_SELF";?>" method="GET">
<input type="hidden" name="op" value="manageClients">
<input type="hidden" name="clients_filter" value="1">

<TR><td style="font-size:14px;" VALIGN="TOP">

<NOBR>

<TABLE CELLPADDING="0" CELLSPACING="1" WIDTH="100%"><TR><TD VALIGN="MIDDLE">
<NOBR><IMG SRC="../images/search.gif" border="0"></TD><TD ALIGN="CENTER" style="font-size:10px;" VALIGN="BOTTOM"><NOBR><input type="image" src="../assets/images/button-searchclients.png" alt="Search Clients">&nbsp; <A HREF="<?php echo "$PHP_SELF";?>?op=manageClients&clients_filter=1&clients_filter_name_first=&clients_filter_name_last=&clients_filter_price_min=&clients_filter_price_max=&clients_filter_type=0&clients_filter_phone=&clients_filter_email="><img src="../assets/images/button-searchclear.png" alt="Clear Search" BORDER="0" HEIGHT="25"></A></SPAN>
</NOBR></TD><td style="font-size:10px;" VALIGN="BOTTOM" ALIGN="RIGHT"><NOBR>
&nbsp; <?php 	$quStrGetUsers = "select * from USERS where `GROUP`=$grid ORDER BY `HANDLE`";
	$quGetUsers = mysqli_query($dbh, $quStrGetUsers) or die (mysqli_error($dbh)); ?>
Agent:  <select name="clients_filter_agent" STYLE="Background-Color : #FFFFFF" SIZE=1>
		<?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) { ?>
		<option value="<?php echo $rowGetUsers->UID;?>" <?php if ($uid =="$rowGetUsers->UID") { echo 'selected';}?>><?php echo $rowGetUsers->HANDLE; ?></option>
		<?php } ?> 
	</select>
</NOBR>
</TD></TR></TABLE>

</td>
<td align="right" style="font-size:10px;" VALIGN="BOTTOM">

<NOBR>First Name: <input type="text" name="clients_filter_name_first" value="<?php echo $clients_filter_name_first;?>"></NOBR>

</TD>
<td align="right" style="font-size:10px;" VALIGN="BOTTOM">

<NOBR>Last Name: <input type="text" SIZE="21" name="clients_filter_name_last" value="<?php echo $clients_filter_name_last;?>"></NOBR>

</TD>
</TR><tr>

	<td align="right" style="font-size:10px;">

<NOBR>Price Min: &nbsp;<input type="text" name="clients_filter_price_min" value="<?php echo $clients_filter_price_min;?>" SIZE="5"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
 Price Max: &nbsp;<input type="text" name="clients_filter_price_max" value="<?php echo $clients_filter_price_max;?>" SIZE="5"></NOBR>


</td>

	<td align="right" style="font-size:10px;">
<NOBR>
Beds:  <select name="clients_filter_beds" STYLE="Background-Color : #FFFFFF">
	<option value="">--</option>
	<option value="0">Studio/Loft</option>
	<option value="1">1 Bedroom</option>
	<option value="2">2 Bedroom</option>
	<option value="3">3 Bedroom</option>
	<option value="4">4 Bedroom</option>
	<option value="5">5 Bedroom</option>
	<option value="6">6 Bedroom</option>
	<option value="7">7 Bedroom</option>
	<option value="8">8 Bedroom</option>
	<option value="9">9 Bedroom</option>
	<option value="10">10 Bedroom</option>
	</select>

&nbsp;&nbsp;
	
	Baths:  <select name="clients_filter_baths" STYLE="Background-Color : #FFFFFF">
	<option value="">--</option>
	<option value="0">.5-3/4</option>
	<option value="1">1 Bath</option>
	<option value="2">2 Bath</option>
	<option value="3">3 Bath</option>
	<option value="4">4 Bath</option>
	<option value="5">5 Bath</option>
	<option value="6">6 Bath</option>
	<option value="99">Shared</option>
	</select>
	
	
	
	
	</NOBR>
	</td>

	<td align="right" style="font-size:10px;"><NOBR>Type Preference:
<select name="clients_filter_type" STYLE="Background-Color : #FFFFFF">
	<option value="0">All</option>
	<?php while ($rowGetTypes = mysqli_fetch_object($quTypes)) {?>
		<option value="<?php echo $rowGetTypes->TYPE;?>" <?php if ($rowGetTypes->TYPE==$clients_filter_type) { echo " selected";}?>><?php echo $rowGetTypes->TYPENAME;?></option>
	<?php } ?>
	</select></td>



	</tr>
	<tr>

	<td  align="right" style="font-size:10px;">

<NOBR>Partial Phone #: <input type="text"  SIZE="5" name="clients_filter_phone" value="<?php echo $clients_filter_phone;?>">

&nbsp;

Partial Email: <input type="text"  SIZE="8" name="clients_filter_email" value="<?php echo $clients_filter_email;?>"></NOBR>



 </td>

	<td align="right" style="font-size:10px;">


Furnished: <input type="checkbox" name="clients_filter_furnishedon" value="1"> | Short-Term: <input type="checkbox" name="clients_filter_shorttermon" value="1"> | Pets: <input type="checkbox" name="clients_filter_pets" value="1">




</td>

	<td align="right" style="font-size:10px;">


Status: &nbsp; All <input type="radio" name="clients_filter_status_client" value="0"> Active <input type="radio" name="clients_filter_status_client" value="1"> Inactive <input type="radio" name="clients_filter_status_client" value="2">

</td>

	</tr>
	</form>
	</table>
	</div>
<FONT SIZE="-3"><BR></FONT>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<TD colspan="25"><center>
<NOBR>
<FONT SIZE="-2"><B>

<A HREF="http://www.criminalpages.com/state-criminal-records-directory/state-of-massachusetts-criminal-records/" target="_criminal">Criminal History Check</A> &nbsp; | &nbsp; <A HREF="./pages/ssn_verify_form.php" target="_SSN">SS# Checker</A> &nbsp; | &nbsp; <A HREF="<?php echo "$PHP_SELF";?>?op=utilities"><img border="0" hspace="0" vspace="0" height="12" src="../assets/images/icons/electric.jpeg"> Set up Utilities</A>  &nbsp; | &nbsp; <a href="<?php echo "$PHP_SELF?op=mail_all_clients";?>" target="_new"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22> Email ALL Clients</A>  &nbsp; | &nbsp; <a href="<?php echo "$PHP_SELF?op=mail_all_clients_active";?>" target="_new"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22> Email All Active Clients</A>  &nbsp; | &nbsp; <a href="<?php echo "$PHP_SELF?op=mail_all_clients_inactive";?>" target="_new"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22> Email All Inactive Clients</A></B></FONT>
</NOBR>
</CENTER>
</td>
	</tr><tr>
	<td align="left" colspan="28" valign="bottom" bgcolor="#FFFFFF" style="font-size:10px;">

	
	
	<CENTER>
<TABLE border=0><TR><TD style="font-size:10px;">

<NOBR>Viewing Clients 
	<?php
if (!$_GET['show_all_clients']) {
		$display_bunch = $clients_limit_start + $clients_limit_n;
		if ($display_bunch > $clients_count) {
			$display_bunch = $clients_count;
		}
		$display_start = $clients_limit_start;
		if ($display_start == 0) {
			$display_start = 1;
		}
		?>
		<b><?php echo $display_start;?> - <?php echo $display_bunch;?></b> of <b><?php echo $clients_count;?></b>
		<?php if ($clients_count > $clients_limit_n) {?>

</NOBR></TD><TD style="font-size:10px;">

		&nbsp;&nbsp;&nbsp; go to page  

</TD><FORM><TD style="font-size:10px;">


<select name="URL" onchange="window.location.href= this.form.URL.options[this.form.URL.selectedIndex].value">
		<?php $pageTop = ceil($clients_count / $clients_limit_n);
		for ($i=1;$i <= $pageTop;$i++) {
		
?>
<OPTION VALUE="<?php echo "$PHP_SELF?op=manageClients&clients_page=$i";?>" <?php if ($clients_page == $i) { echo " selected ";}?>><?php echo $i;?></OPTION>

		<?php } ?>
</select>

</TD>
</form>
<TD style="font-size:10px;">
		&nbsp;&nbsp;&nbsp;<?php if (($clients_page) < ($clients_count / $clients_limit_n)) {
			$nextPage = $clients_page + 1;


					if ($clients_page != 1) {
		$prevPage = $clients_page - 1;
		}else{ $prevPage = ""; }
			
				
			if ($clients_page !="1") {
			?>
	<a href="<?php echo "$PHP_SELF?op=manageClients&clients_page=$prevPage";?>"><-Back</a> &nbsp;&nbsp;&nbsp; 
	<?php } ?>
	<a href="<?php echo "$PHP_SELF?op=manageClients&clients_page=$nextPage";?>">Next-></a> 

		<?php } ?> &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo "$PHP_SELF?op=manageClients&show_all_clients=1";?>">Show all Clients</a></NOBR>
		<?php }
	}?>
	
	</TD></TR></TABLE>
	</CENTER>
	
	
	
	
	</td>
		</tr>
	<tr>
	<td colspan="31" valign="top"  height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>

	<td valign="top" height="15" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>


	<td align="LEFT" bgcolor="<?php echo $coltitcolor;?>">

<?php if (!$clients_sort=="NAME_LAST") { ?>

<a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=NAME_LAST";?>"><div class="controltext" <?php if ($clients_sort=="NAME_LAST") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=-3>Name</FONT></div></a>
	
	<?php } else {

if ($SortDir == "DESC") { ?>

<a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=NAME_LAST&SortDir=ASC";?>"><div <?php if ($clients_sort=="NAME_LAST") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=-3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'>Name</FONT></div></a>
	
	<?php } else { ?>
	
<a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=NAME_LAST&SortDir=DESC";?>"><div <?php if ($clients_sort=="NAME_LAST") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=-3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'>Name</FONT></div></a>

	<?php }} ?>
</div></td>


<TD bgcolor="<?php echo $coltitcolor;?>"> &nbsp; </TD>

	<td align="LEFT" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=HOME_PHONE";?>"><div class="controltext" <?php if ($clients_sort=="HOME_PHONE") { echo "style=\"text-decoration:underline\"";}?>><NOBR>Home Phone</NOBR></div></a></td>

<TD bgcolor="<?php echo $coltitcolor;?>"> &nbsp; </TD>

	<td align="LEFT" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=WORK_PHONE";?>"><div class="controltext" <?php if ($clients_sort=="WORK_PHONE") { echo "style=\"text-decoration:underline;\"";}?>><NOBR>Work Phone</NOBR></div></a></td>

<TD bgcolor="<?php echo $coltitcolor;?>"> &nbsp; </TD>

	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=TYPE";?>"><div class="controltext" <?php if ($clients_sort=="TYPE") { echo "style=\"text-decoration:underline;\"";}?>>Type</div></a></td>

<TD bgcolor="<?php echo $coltitcolor;?>"> &nbsp; </TD>

	<td align="center" width="75" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=LOC_PREF";?>"><div class="controltext" <?php if ($clients_sort=="LOC_PREF") { echo "style=\"text-decoration:underline;\"";}?>>Location</div></a></td>



	<td align="left" bgcolor="<?php echo $coltitcolor;?>"><NOBR><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=ROOMS_PREF";?>"><div class="controltext" <?php if ($clients_sort=="ROOMS_PREF") { echo "style=\"text-decoration:underline;\"";}?>>Beds</a></NOBR></div></td>
<TD bgcolor="<?php echo $coltitcolor;?>">&nbsp;</TD>


	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=PRICEMIN";?>"><div class="controltext" <?php if ($clients_sort=="PRICEMIN") { echo "style=\"text-decoration:underline;\"";}?>><FONT SIZE=-3>Price<BR>Min</FONT></div></a></td>

<TD bgcolor="<?php echo $coltitcolor;?>"> &nbsp; </TD>

	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=PRICEMAX";?>"><div class="controltext" <?php if ($clients_sort=="PRICEMAX") { echo "style=\"text-decoration:underline;\"";}?>><FONT SIZE=-3>Price<BR>Max</FONT></div></a></td>

<TD bgcolor="<?php echo $coltitcolor;?>"> &nbsp; </TD>

<td align="LEFT" bgcolor="<?php echo $coltitcolor;?>">

<?php if (!$clients_sort=="DATE_NEXT_CONTACT") { ?>

<NOBR><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_NEXT_CONTACT";?>"><div class="controltext" <?php if ($clients_sort=="DATE_NEXT_CONTACT") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=-3>Next Contact</A></NOBR><BR>
	
	<?php } else {

if ($SortDir == "DESC") { ?>

<NOBR><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_NEXT_CONTACT&SortDir=ASC";?>"><div class="controltext" <?php if ($clients_sort=="DATE_NEXT_CONTACT") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=-3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'>Next Contact</A></NOBR><BR>
	
	<?php } else { ?>
	
<a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_NEXT_CONTACT&SortDir=DESC";?>"><div class="controltext" <?php if ($clients_sort=="DATE_NEXT_CONTACT") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=-3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'>Next Contact</A><BR>

	<?php }} ?>





<?php if ($SortDir == "DESC") { ?>

<NOBR><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_MODIFIED&SortDir=ASC";?>"><div class="controltext" <?php if ($clients_sort=="DATE_MODIFIED") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=-3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'>Last Modified</A></NOBR>
	
	<?php } else { ?>
	
<NOBR><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_MODIFIED&SortDir=DESC";?>"><div class="controltext" <?php if ($clients_sort=="DATE_MODIFIED") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=-3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'>Last Modified</A></NOBR>

	<?php } ?>




</FONT></div>
</td>




<TD bgcolor="<?php echo $coltitcolor;?>"> &nbsp; </TD>

<td align="center" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_MOVEIN";?>"><div class="controltext"><FONT SIZE=-3><?php if ($clients_sort=="DATE_MOVEIN") { echo "style=\"text-decoration:underline;\"";}?><NOBR>Move In</NOBR><BR><NOBR>Date Range</NOBR></FONT></div></a></td>

	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
<td align="center" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=CLIENT_EMAIL";?>"><div class="controltext" <?php if ($clients_sort=="CLIENT_EMAIL") { echo "style=\"text-decoration:underline;\"";}?>><FONT SIZE="-2">Email</FONT></div></a></td>
<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td colspan="2" align="center" bgcolor="<?php echo $coltitcolor;?>">
	

<?php if (!$clients_sort=="DATE_CREATED") { ?>

	<a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_CREATED";?>"><div class="controltext" <?php if ($clients_sort=="DATE_CREATED") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=-3>Date Created</FONT></div></a>
	
	<?php } else {

if ($SortDir == "DESC") { ?>

<CENTER><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_CREATED&SortDir=ASC";?>"><div class="controltext" <?php if ($clients_sort=="DATE_CREATED") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=-3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'>Date</NOBR> Created</FONT></div></a></CENTER>
	
	<?php } else { ?>
	
<CENTER><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=DATE_CREATED&SortDir=DESC";?>"><div class="controltext" <?php if ($clients_sort=="DATE_CREATED") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=-3><NOBR><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'>Date</NOBR> Created</FONT></div></a></CENTER>
		
	<?php }} ?>

</td>

	<td align="center" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=USERS.HANDLE";?>"><div class="controltext" <?php if ($clients_sort=="USERS.HANDLE") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=-3>Agent&nbsp;</FONT> </div></a></td>
	<td COLSPAN="2" align="left" bgcolor="<?php echo $coltitcolor;?>"><a href="<?php echo "$PHP_SELF?op=manageClients&clients_sort=STATUS_CLIENT";?>"><div class="controltext" <?php if ($clients_sort=="STATUS_CLIENT") { echo "style=\"text-decoration:underline\"";}?>><FONT SIZE=-3>Status</FONT></div></a></td>

	<td align="center" bgcolor="<?php echo $coltitcolor;?>">&nbsp;</td>
	<td valign="top" height="15" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>

	<td colspan="31" valign="top"  height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>	

<?php
if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} ?>


    <?php while ($rowGetClients = mysqli_fetch_object($quGetClients)) { ?>
    		
    		
    	<tr>
	<td valign="top" height="31" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>





	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><NOBR>
<?php 

if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=GRAY>";}
}

echo "&nbsp;<a href=\"$PHP_SELF?op=editClient&clid=$rowGetClients->CLID\" TITLE=\"Created ";

if ($rowGetClients->HANDLE) {
echo "by: ".$rowGetClients->HANDLE;
}
echo " on ". $rowGetClients->DATE_CREATED ." - Click to Edit/View\">";


if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=GRAY>";}
}
echo $rowGetClients->NAME_FIRST." ".$rowGetClients->NAME_LAST;

if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}

echo "</A>";

if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<BR>&nbsp; Inactive</FONT>";}

?></DIV></NOBR></td>

<TD bgcolor="<?php echo $rowColor;?>"> &nbsp; </TD>

	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><?php
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}
 echo "$rowGetClients->HOME_PHONE";
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></div></td>

<TD bgcolor="<?php echo $rowColor;?>"> &nbsp; </TD>

	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><?php
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}
 echo "$rowGetClients->WORK_PHONE";
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></div></td>

<TD bgcolor="<?php echo $rowColor;?>"> &nbsp; </TD>

	<td bgcolor="<?php echo $rowColor;?>" align=center><div class="ad"><?php
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}

echo "$rowGetClients->TYPENAME";


if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></div></td>

<TD bgcolor="<?php echo $rowColor;?>"> &nbsp; </TD>


	<td bgcolor="<?php echo $rowColor;?>"><div class="clientlocation"><div class="ad">
<?php 
//echo "$rowGetClients->LOC_PREF";
$client_location_ids=split(",", $rowGetClients->LOC_PREF);
$client_location_names="";
foreach ($client_location_ids as $client_location => $client_location_id)
{
  $client_location_names.="<br><NOBR>".$LOC_ARRAY[$client_location_id];
}
$client_location_names=preg_replace('/^<br>/',"" ,$client_location_names);

if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}

$client_location_names = str_replace("BOSTON - ", "", $client_location_names);

echo $client_location_names;
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></DIV>
</div></td>



	<td bgcolor="<?php echo $rowColor;?>">
	<div class="clientrooms">
	
	<div class="ad">
	
	
	<?php $rprefs = split(",", $rowGetClients->ROOMS_PREF);
	foreach ($rprefs as $rpref) {

if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}


if ($rpref == '0.25') {
echo "<NOBR>LOFT</NOBR><BR>";
} elseif ($rpref == '0.50') {
echo "<NOBR>STUDIO</NOBR><BR>";
} elseif ($rpref == '0.75') {
echo "<NOBR>STU/ALC</NOBR><BR>";
} elseif ($rpref == '0.76') {
echo "<NOBR>STU/2RM</NOBR><BR>";
} elseif ($rpref == '0.79') {
echo "<NOBR>STU/LFTBD</NOBR><BR>";
} elseif ($rpref == '1.0') {
echo "<NOBR>1 BED</NOBR><BR>";
} elseif ($rpref == '1.5') {
echo "<NOBR>1 BD SPLT</NOBR><BR>";
} elseif ($rpref == '1.75') {
echo "<NOBR>1 BD PLUS</NOBR><BR>";
} elseif ($rpref == '2.0') {
echo "<NOBR>2 BED</NOBR><BR>";
} elseif ($rpref == '2.5') {
echo "<NOBR>2 BD SPLT</NOBR><BR>";
} elseif ($rpref == '2.75') {
echo "<NOBR>2 BD PLUS</NOBR><BR>";
} elseif ($rpref == '3.0') {
echo "<NOBR>3 BED</NOBR><BR>";
} elseif ($rpref == '3.5') {
echo "<NOBR>3 BD SPLT</NOBR><BR>";
} elseif ($rpref == '3.75') {
echo "<NOBR>3 BD PLUS</NOBR><BR>";
} elseif ($rpref == '4.0') {
echo "<NOBR>4 BED</NOBR><BR>";
} elseif ($rpref == '4.5') {
echo "<NOBR>4 BD SPLT</NOBR><BR>";
} elseif ($rpref == '4.75') {
echo "<NOBR>4 BD PLUS</NOBR><BR>";
} elseif ($rpref == '5.0') {
echo "<NOBR>5 BED</NOBR><BR>";
} elseif ($rpref == '5.5') {
echo "<NOBR>5 BD SPLT</NOBR><BR>";
} elseif ($rpref == '5.75') {
echo "<NOBR>5 BD PLUS</NOBR><BR>";
} elseif ($rpref == '6.0') {
echo "<NOBR>6 BED</NOBR><BR>";
} elseif ($rpref == '7.0') {
echo "<NOBR>7 BED</NOBR><BR>";
} elseif ($rpref == '8.0') {
echo "<NOBR>8 BED</NOBR><BR>";
} elseif ($rpref == '9.0') {
echo "<NOBR>9 BED</NOBR><BR>";
} elseif ($rpref == '10.0') {
echo "<NOBR>10 BED</NOBR><BR>";
} elseif ($rpref == '11.0') {
echo "<NOBR>11 BED</NOBR><BR>";
} elseif ($rpref == '12.0') {
echo "<NOBR>12 BED</NOBR><BR>";
} elseif ($rpref == '13.0') {
echo "<NOBR>13 BED</NOBR><BR>";
} elseif ($rpref == '14.0') {
echo "<NOBR>14 BED</NOBR><BR>";
} elseif ($rpref == '15.0') {
echo "<NOBR>15 BED</NOBR><BR>";
} elseif ($rpref == '16.0') {
echo "<NOBR>16 BED</NOBR><BR>";
} elseif ($rpref == '17.0') {
echo "<NOBR>17 BED</NOBR><BR>";
} elseif ($rpref == '18.0') {
echo "<NOBR>18 BED</NOBR><BR>";
} elseif ($rpref == '19.0') {
echo "<NOBR>19 BED</NOBR><BR>";
} elseif ($rpref == '20.0') {
echo "<NOBR>20 BED</NOBR><BR>";
}







if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT></FONT>";}
}

	}?>
</div>
</div>
</td>

<TD bgcolor="<?php echo $rowColor;?>"> &nbsp; </TD>

	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><?php 
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}
echo "$rowGetClients->PRICEMIN";
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></div></td>

<TD bgcolor="<?php echo $rowColor;?>"> &nbsp; </TD>

	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><?php
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}
 echo "$rowGetClients->PRICEMAX";
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?>
</div></td>

<TD bgcolor="<?php echo $rowColor;?>"> &nbsp; </TD>

	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><CENTER>
<?php
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}
	
 echo "<B>".$rowGetClients->DATE_NEXT_CONTACT."</B><BR>";


foreach ($DEFINED_VALUE_SETS['CLIENT_STATUS2'] as $cskey => $csValue) { 

if ($rowGetClients->CLIENT_STATUS2 == "$cskey") {
echo $csValue;
}
}

 echo "<BR>".$rowGetClients->DATE_MODIFIED."<BR>";



if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></CENTER></DIV></td>

<TD bgcolor="<?php echo $rowColor;?>"> &nbsp; </TD>

	<td bgcolor="<?php echo $rowColor;?>"><div class="ad"><CENTER><NOBR><FONT SIZE=-3><?php
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}
 echo "$rowGetClients->DATE_MOVEIN";
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></NOBR><BR><NOBR>


<?php if ($rowGetClients->DATE_MOVEIN > $rowGetClients->DATE_MOVEIN_END ) {echo "<font color=red>";} ?>

<?php 
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=LIGHTGRAY>";}
}
echo "$rowGetClients->DATE_MOVEIN_END";
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}
?></NOBR>
<?php if ($rowGetClients->DATE_MOVEIN > $rowGetClients->DATE_MOVEIN_END ) {echo "</font>";} ?>
</FONT></CENTER></DIV></td>


<TD bgcolor="<?php echo $rowColor;?>"> &nbsp; </TD>

<td bgcolor="<?php echo $rowColor;?>"><CENTER>

<?php
if ( $rowGetClients->CLIENT_EMAIL != "" ) {
echo "<A HREF=\"$PHP_SELF?op=mail_client&clid=$rowGetClients->CLID\" target=\"_email$rowGetClients->CLID\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A>";
} else {
	echo " &nbsp; ";
}
; ?>

</CENTER></td>

<td bgcolor="<?php echo $rowColor;?>" ALIGN=CENTER><div class="ad">
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetClients->CLID";?>#appointment" TITLE="Make an Appointment with <?php echo $rowGetClients->NAME_FIRST.$rowGetClients->NAME_LAST;?>"><img border="0" hspace="0" vspace="0" width="19" height="19" src="../images/clock.gif" TITLE="Make an Appointment" ALT="Make an Appointment"></A>
</TD>


<td bgcolor="<?php echo $rowColor;?>" ALIGN=CENTER><div class="ad">

<a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowGetClients->CLID";?>" TITLE="Showing History for <?php echo $rowGetClients->NAME_FIRST.$rowGetClients->NAME_LAST;?>" target="_sh<?php echo $rowGetClients->CLID;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History" ALT="Showing History"></A>
</TD>


<td bgcolor="<?php echo $rowColor;?>" ALIGN=CENTER><div class="ad"><a href="<?php echo "$PHP_SELF?op=listings&client_id_filter=$rowGetClients->CLID";?>"><img border="0" hspace="2" vspace="0" width="19" height="19" src="../assets/images/matchlistings.gif" TITLE="Match Client to Listings" ALT="Match Client to Listings"></a></div></td>

	<td bgcolor="<?php echo $rowColor;?>"><CENTER>

<?php if ($rowGetClients->UID!="$uid") {?>
<?php
if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=GRAY>";}
}
 echo "<div class=ad><CENTER><NOBR> &nbsp;" . $rowGetClients->HANDLE . "'s</NOBR><BR><NOBR> &nbsp; Client</NOBR></CENTER></DIV>";

if ($clients_filter_status_client!=2) {
if ($rowGetClients->STATUS_CLIENT=="2"){ echo "</FONT>";}
}

?>

<?php }?><div class="ad"><a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetClients->CLID";?>" TITLE="Edit/View <?php echo $rowGetClients->NAME_FIRST.$rowGetClients->NAME_LAST;?>"><img border="0" vspace="0" hspace="0" src="../images/icons/edit.gif"></a></CENTER>
</td>

	<td bgcolor="<?php echo $rowColor;?>"><?php
if ($rowGetClients->STATUS_CLIENT=="2"){
if ($user_level >"1") { ?><a href="<?php echo "$PHP_SELF?op=client-active&clid=$rowGetClients->CLID&cluid=$rowGetClients->UID";?>"><?php }?><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/client-inactive.jpg"><?php if ($user_level >"1") { ?></a><?php }?><?php }
if ($rowGetClients->STATUS_CLIENT!="2"){
		if ($user_level >"1") { ?><a href="<?php echo "$PHP_SELF?op=client-inactive&clid=$rowGetClients->CLID&cluid=$rowGetClients->UID";?>"><?php }?><img border="0" hspace="2" vspace="0" width="16" height="16" src="../assets/images/client-active.jpg"><?php if ($user_level >"1") { ?></a><?php }?>
<?php } ?>
</td>

	<td bgcolor="<?php echo $rowColor;?>"><?php if ((($user_level>1) AND ($rowGetClients->UID=="$uid")) OR ((($isAdmin) OR ($user_level >="4")) AND ($rowGetClients->UID!="$uid"))){ ?><A HREF="<?php echo "$PHP_SELF?op=editClientReassign&clid=$rowGetClients->CLID&fname=$rowGetClients->NAME_FIRST&lname=$rowGetClients->NAME_LAST";?>"><?php }?><img border="0" hspace="0" vspace="2" width="16" height="16" src="../assets/images/client-reassign.gif" TITLE="Reassign Client" ALT="Reassign Client"><?php if ((($user_level>1) AND ($rowGetClients->UID=="$uid")) OR ((($isAdmin) OR ($user_level >="4")) AND ($rowGetClients->UID!="$uid"))){ ?></A><?php }?></td>
<td bgcolor="<?php echo $rowColor;?>"><?php if ($user_level>1) { ?><?php if ($rowGetClients->UID=="$uid") {?><div class="ad"><a href="<?php echo "$PHP_SELF?op=deleteClient&clid=$rowGetClients->CLID";?>"><img border='0' vspace='0' hspace='0' src='../images/icons/delete.gif'></a></div><?php }?><?php }?><?php if (($isAdmin) OR ($user_level >="4")){?><?php if ($rowGetClients->UID!="$uid") {?><div class="ad"><a href="<?php echo "$PHP_SELF?op=deleteClient&clid=$rowGetClients->CLID";?>"><img border='0' vspace='0' hspace='0' src='../images/icons/delete.gif'></a></div><?php }?><?php }?></td>
	<td valign="top" height="31" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>

<?php 

if ($rowGetUser->PREF_CLIENT_NOTES =="1") { 

if ($rowGetClients->CLIENT_NOTES) {
?>


<tr><td valign="top" height="31" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td><TD COLSPAN=27" bgcolor="<?php echo $rowColor;?>"><div class="ad">

<?php if ($rowGetClients->STATUS_CLIENT=="2"){ echo "<FONT COLOR=GRAY>";} ?>

&nbsp;&nbsp;&nbsp; <?php echo $rowGetClients->CLIENT_NOTES;?>

<?php if ($rowGetClients->STATUS_CLIENT=="2"){echo "</FONT>";}?>

</DIV>
</TD><td valign="top" height="31" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td></TR>

<?php }} ?>



<TR>

    	<?php
 if ($rowColor=="#F5F5DC" OR $rowColor=="$pref_row_color") {
    		$rowColor="#FFFFFF";
    	}else {

if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} 
    }
    }?>
	<td colspan="31" valign="top"  height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>

</CENTER>
</TD></TR></TABLE>



	
	
	
	
	
	
	
		<CENTER>
<TABLE border=0><TR><TD style="font-size:10px;">

<NOBR>Viewing Clients 
	<?php
if (!$_GET['show_all_clients']) {
		$display_bunch = $clients_limit_start + $clients_limit_n;
		if ($display_bunch > $clients_count) {
			$display_bunch = $clients_count;
		}
		$display_start = $clients_limit_start;
		if ($display_start == 0) {
			$display_start = 1;
		}
		?>
		<b><?php echo $display_start;?> - <?php echo $display_bunch;?></b> of <b><?php echo $clients_count;?></b>
		<?php if ($clients_count > $clients_limit_n) {?>

</NOBR></TD><TD style="font-size:10px;">

		&nbsp;&nbsp;&nbsp; go to page  

</TD><FORM><TD style="font-size:10px;">


<select name="URL" onchange="window.location.href= this.form.URL.options[this.form.URL.selectedIndex].value">
		<?php $pageTop = ceil($clients_count / $clients_limit_n);
		for ($i=1;$i <= $pageTop;$i++) {
?>		
			
			
<OPTION VALUE="<?php echo "$PHP_SELF?op=manageClients&clients_page=$i";?>" <?php if ($clients_page == $i) { echo " selected ";}?>><?php echo $i;?></OPTION>


		<?php } ?>
</select>

</TD>
</form>
<TD style="font-size:10px;">
		&nbsp;&nbsp;&nbsp;<?php if (($clients_page) < ($clients_count / $clients_limit_n)) {
			$nextPage = $clients_page + 1;


					if ($clients_page != 1) {
		$prevPage = $clients_page - 1;
		}else{ $prevPage = ""; }
			
				
			if ($clients_page !="1") {
			?>
	<a href="<?php echo "$PHP_SELF?op=manageClients&clients_page=$prevPage";?>"><-Back</a> &nbsp;&nbsp;&nbsp; 
	<?php } ?>
	<a href="<?php echo "$PHP_SELF?op=manageClients&clients_page=$nextPage";?>">Next-></a> 

		<?php } ?> &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo "$PHP_SELF?op=manageClients&show_all_clients=1";?>">Show all Clients</a></NOBR>
		<?php }
	}?>
	
	</TD></TR></TABLE>
	</CENTER>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	</CENTER>


<FONT SIZE="-3"><BR></FONT>
<!--END manageClients -->