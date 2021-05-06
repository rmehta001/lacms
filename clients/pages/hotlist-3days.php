<!--BEGIN Hotlist -->
 <BR>
<TABLE BGCOLOR="#FFFFFF" WIDTH="900" BORDER=1><TR><TD>
<CENTER>
		<B>LAST 3 DAY'S OFFICE LISTINGS HOT LIST</B><br>
<HR>

<P>
<FONT SIZE="-1"><a href="<?php echo "$PHP_SELF?op=hotlist-1week";?>">Current Week's Listings - Click Here</A><BR></FONT>
<P>

</CENTER>

<table width="100%" BORDER="0">
<tr>
<td style="font-size:14px;">
<P>

<FONT style="font-size:14px;"><B>LAST 3 DAY'S LISTING ADDITIONS <img src="../assets/images/icons/a.jpg" border=0 height=12 width=12> &amp; <img src="../assets/images/icons/u.jpg" border=0 height=12 width=12>:</B></FONT><BR>
<TABLE BORDER=0 WIDTH="100%"><TR>
<?php 
$quStrGetTodays = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where (DATEIN BETWEEN DATE_SUB(CURDATE() ,INTERVAL 3 DAY) AND CURDATE()) and CLI='$grid' ORDER BY CLASS.TYPE, LANDLORD, LOC, STREET, STREET_NUM, APT";
	$quGetTodays = mysqli_query($GLOBALS['dbh'], $quStrGetTodays) or die (mysqli_error($dbh));
	while ($rowGetTodays = mysqli_fetch_object($quGetTodays)) { ?>
<TD>
<FONT style="font-size:12px;">
		<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetTodays->CID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit">&nbsp;
<?php if ($rowGetTodays->STATUS=="ACT") {
if ($user_level>0) { 	
echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetTodays->CID&return_page=hotlist-3days&return_page_div=" . ($k??"") . "'>";
}
echo "<img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/act.gif'>";
if ($user_level>0) { echo "</a>"; }
} else {
if ($user_level>0) { 
echo "<a href='$PHP_SELF?op=activate&cid=$rowGetTodays->CID&return_page=hotlist-3days&return_page_div=" . ($k??"") . "'>";
}
echo "<img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/inact.jpg'>";
if ($user_level>0) { echo "</a>"; }
}

 if ($rowGetTodays->STATUS_ACTIVE =="1")  { 
if ($user_level>0) { ?>

<a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetTodays->CID . "&turn=unavailable&return_page=hotlist-3days&return_page_div=" . ($k??"");?>">
<?php } ?>
<img src="../assets/images/icons/a.jpg" border=0 height=14 width=14>
<?php if ($user_level>0) {?>
</a>
<?php }?>

			    <?php  } else { ?>
<?php if ($user_level>0) {?>
			      <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetTodays->CID . "&turn=available&return_page=hotlist-3days&return_page_div=" . ($k??"");?>">
<?php } ?>
<img src="../assets/images/icons/u.jpg" border=0 height=14 width=14>
<?php if ($user_level>0) {?>
</a>
<?php }
		} ?>

		
<a href="<?php echo "https://www.BostonApartments.com/plugin/?ad=$rowGetTodays->CID&cli=$grid&uid=$uid\" target=\"_NEW\"";?>"><img width="12" height="12" border="0" vspace="0" hspace="0" src="../images/icons/cl.gif"></A>

&nbsp;
<?php echo "$rowGetTodays->TYPENAME";?> - &nbsp;<?php echo $rowGetTodays->LOCNAME;?>&nbsp;
<?php echo $rowGetTodays->ROOMS;?> Beds-<?php echo $rowGetTodays->BATH;?> Bath - <?php echo $rowGetTodays->STREET_NUM;?> <?php echo $rowGetTodays->STREET;?> <?php echo $rowGetTodays->APT;?> -
$<?php echo $rowGetTodays->PRICE;?> | <?php echo $rowGetTodays->SHORT_NAME;?> | Mod:<?php echo $rowGetTodays->MODBY;?></a>
</FONT>
</TD></TR><TR>
	<?php }?>
</TR></TABLE>
<BR>

<FONT style="font-size:14px;"><B>LAST 3 DAY'S MODIFIED AVAILABLE <img src="../assets/images/icons/a.jpg" border=0 height=12 width=12> LISTINGS:</B></FONT><BR>
<TABLE BORDER=0 WIDTH="100%"><TR>
<?php 
$quStrGetTodays = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where (CLASS.MOD BETWEEN DATE_SUB(CURDATE() ,INTERVAL 3 DAY) AND CURDATE()) and DATEIN!='$now' and CLI='$grid' AND STATUS_ACTIVE='1' ORDER BY CLASS.TYPE, LANDLORD, LOC, STREET, STREET_NUM, APT";
	$quGetTodays = mysqli_query($GLOBALS['dbh'], $quStrGetTodays) or die (mysqli_error($dbh));
	while ($rowGetTodays = mysqli_fetch_object($quGetTodays)) {?>
<TD>
<FONT style="font-size:12px;">
		<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetTodays->CID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit">&nbsp;
<?php if ($rowGetTodays->STATUS=="ACT") { 
if ($user_level>0) {
echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetTodays->CID&return_page=hotlist-3days&return_page_div=" . ($k??"") . "'>";
}
echo "<img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/act.gif'>";
if ($user_level>0) { echo "</a>"; }
} else {
if ($user_level>0) {
echo "<a href='$PHP_SELF?op=activate&cid=$rowGetTodays->CID&return_page=hotlist-3days&return_page_div=" . ($k??"") .  "'>";
}
echo "<img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/inact.jpg'>";
if ($user_level>0) { echo "</a>"; }
} ?>

<a href="<?php echo "https://www.BostonApartments.com/plugin/?ad=$rowGetTodays->CID&cli=$grid&uid=$uid\" target=\"_NEW\"";?>"><img width="12" height="12" border="0" vspace="0" hspace="0" src="../images/icons/cl.gif"></A>

&nbsp;
<?php echo "$rowGetTodays->TYPENAME";?> - <?php echo $rowGetTodays->LOCNAME;?>&nbsp;
<?php echo $rowGetTodays->ROOMS;?> Beds-<?php echo $rowGetTodays->BATH;?> Bath - <?php echo $rowGetTodays->STREET_NUM;?> <?php echo $rowGetTodays->STREET;?> <?php echo $rowGetTodays->APT;?> -
$<?php echo $rowGetTodays->PRICE;?> | <?php echo $rowGetTodays->SHORT_NAME;?> | Mod:<?php echo $rowGetTodays->MODBY;?></A>
</FONT>
</TD></TR><TR>
	<?php }?>
</TR></TABLE>

<BR>
<FONT style="font-size:14px;"><B>LAST 3 DAY'S MODIFIED <FONT COLOR="RED">UN</FONT>AVAILABLE <img src="../assets/images/icons/u.jpg" border=0 height=12 width=12> LISTINGS:</B></FONT><BR>
<TABLE BORDER=0 WIDTH="100%"><TR>
<?php 
$quStrGetTodays = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where (CLASS.MOD BETWEEN DATE_SUB(CURDATE() ,INTERVAL 3 DAY) AND CURDATE()) and DATEIN!='$now' and CLI='$grid' AND STATUS_ACTIVE!='1' ORDER BY CLASS.TYPE, LANDLORD, LOC, STREET, STREET_NUM, APT";
	$quGetTodays = mysqli_query($GLOBALS['dbh'], $quStrGetTodays) or die (mysqli_error($dbh));
	while ($rowGetTodays = mysqli_fetch_object($quGetTodays)) {?>
<TD>
<FONT style="font-size:12px;">
		<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetTodays->CID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit">&nbsp;
<?php if ($rowGetTodays->STATUS=="ACT") { 
if ($user_level>0) {
echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetTodays->CID&return_page=hotlist-3days&return_page_div=" . ($k??"") . "'>";
}
echo "<img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/act.gif'>";
if ($user_level>0) { echo "</a>"; }
} else {
if ($user_level>0) {
echo "<a href='$PHP_SELF?op=activate&cid=$rowGetTodays->CID&return_page=hotlist-3days&return_page_div=" . ($k??"") ."'>";
}
echo "<img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/inact.jpg'>";
if ($user_level>0) { echo "</a>"; }
} ?>
&nbsp;
<?php echo "$rowGetTodays->TYPENAME";?> - <?php echo $rowGetTodays->LOCNAME;?>&nbsp;
<?php echo $rowGetTodays->ROOMS;?> Beds-<?php echo $rowGetTodays->BATH;?> Bath - <?php echo $rowGetTodays->STREET_NUM;?> <?php echo $rowGetTodays->STREET;?> <?php echo $rowGetTodays->APT;?> -
$<?php echo $rowGetTodays->PRICE;?> | <?php echo $rowGetTodays->SHORT_NAME;?> | Mod:<?php echo $rowGetTodays->MODBY;?></a> | # <?php echo "$rowGetTodays->CID";?>
</FONT>
</TD></TR><TR>
	<?php }?>
</TR></TABLE>



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
