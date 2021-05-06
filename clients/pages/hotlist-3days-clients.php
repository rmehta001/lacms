<!--BEGIN Hotlist -->
 <BR>
<TABLE BGCOLOR="#FFFFFF" WIDTH="650" BORDER=1><TR><TD>
<CENTER>
		<B>LAST 3 DAY'S NEW LEADS</B><br>
<HR>

<P>
<FONT SIZE="-1"><a href="<?php echo "$PHP_SELF?op=hotlist-1week-clients";?>">Current Week's New Leads - Click Here</A><BR></FONT>
<P>

</CENTER>

<table width="100%" BORDER="0">
<tr>
<td style="font-size:14px;">
<P>

<FONT style="font-size:14px;"><B>LAST 3 DAY'S NEW CLIENT LEADS:</B></FONT><BR>
<TABLE BORDER=0 WIDTH="100%">

<?php 
$quStrGet3daysClients = "select * from CLIENTS where (DATE_CREATED BETWEEN DATE_SUB(CURDATE() ,INTERVAL 3 DAY) AND CURDATE()) and GRID='$grid' AND UID='$uid' ORDER BY NAME_LAST";
	$quGet3daysClients = mysqli_query($GLOBALS['dbh'], $quStrGet3daysClients) or die (mysqli_error($GLOBALS['dbh']));
	while ($rowGet3daysClients = mysqli_fetch_object($quGet3daysClients)) {

	$quStrGetClientH = "select * from CLIENTS where CLID='$rowGet3daysClients->CLID' and UID='$uid' and GRID='$grid' LIMIT 1";
	$quGetClientH = mysqli_query($GLOBALS['dbh'], $quStrGetClientH) or die (mysqli_error($GLOBALS['dbh']));

WHILE ($rowGetClientH = mysqli_fetch_object($quGetClientH)) {
?>

<TR><TD WIDTH="300">

		<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGet3daysClients->CLID";?>" target="_<?php echo $rowGet3daysClients->CLID;?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo "$rowGet3daysClients->NAME_FIRST $rowGet3daysClients->NAME_LAST";?></a>

</TD>

<td WIDTH="16"><CENTER>

<?php
if ($rowGetClientH->CLIENT_EMAIL !="") {
echo "<A HREF=\"$PHP_SELF?op=mail_client&clid=$rowGetClientH->CLID\" target=\"_email$rowGetClientH->CLID\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></A>";
}else {
echo "&nbsp;";
}; ?>

</CENTER></td>

<td ALIGN=CENTER  WIDTH="16"><div class="ad">
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetClientH->CLID";?>#appointment" TITLE="Make Appointment with <?php echo "$rowGetClientH->NAME_FIRST $rowGetClientH->NAME_LAST";?>"><img border="0" hspace="0" vspace="0" width="19" height="19" src="../images/clock.gif" TITLE="Make an Appointment" ALT="Make an Appointment"></A>
</TD>


<td ALIGN=CENTER WIDTH="16"><div class="ad">

<a href="<?php echo "$PHP_SELF?op=showingsClient&clid=$rowGetClientH->CLID";?>" TITLE="Showing History for <?php echo "$rowGetClientH->NAME_FIRST $rowGetClientH->NAME_LAST";?>" target="_sh<?php echo $rowGetClientH->CLID;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History" ALT="Showing History"></A>
</TD>

<td ALIGN=CENTER WIDTH="19"><div class="ad"><a href="<?php echo "$PHP_SELF?op=listings&client_id_filter=$rowGetClientH->CLID";?>"><img border="0" hspace="2" vspace="0" width="19" height="19" src="../assets/images/matchlistings.gif" TITLE="Match Client to Listings" ALT="Match Client to Listings"></a></div></td>

<TD  style="font-size:14px;" WIDTH="25">
<div class="controltext">
<NOBR><?php echo $rowGetClientH->DATE_NEXT_CONTACT;?></NOBR></DIV>
</TD>
<TD ALIGN=RIGHT WIDTH="20">

		<?php if($rowGetClientH->PUBLIC != "0") { echo "<div class=\"controltext\"><FONT COLOR='#999999'>Shared</FONT></DIV>"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } ?>

</TD>


<TD WIDTH="16">
<?php if (($rowGetClientH->UID=="$uid") OR ((($isAdmin) OR ($user_level >="4")) AND ($rowGetClientH->UID!="$uid"))){ ?><A HREF="<?php echo "$PHP_SELF?op=editClientReassign&clid=$rowGetClientH->CLID&fname=$rowGetClientH->NAME_FIRST&lname=$rowGetClientH->NAME_LAST";?>"><?php }?><img border="0" hspace="0" vspace="2" width="16" height="16" src="../assets/images/client-reassign.gif" TITLE="Reassign Client" ALT="Reassign Client"><?php if (($rowGetClientH->UID=="$uid") OR ((($isAdmin) OR ($user_level >="4")) AND ($rowGetClientH->UID!="$uid"))){ ?></A><?php }?>
</TD>


<TD WIDTH="16">

<?php if ($rowGet3daysClients->UID=="$uid") {?>
<div class="ad"><a href="<?php echo "$PHP_SELF?op=deleteClient&clid=$rowGet7daysClients->CLID&return_page=hotlist";?>"><img border='0' vspace='0' hspace='0' src='../images/icons/delete.gif'></a></div>
<?php }?>


</TD></TR>
		
	<?php }?>
<?php }?>

</TABLE>

</DIV>
<P><BR>
</td>
</tr>
</table>

</font>
</center>
</TD></TR></TABLE>
<BR>
<!--END Hotlist -->
