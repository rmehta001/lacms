<!--BEGIN Hotlist -->
 <BR>
<TABLE BGCOLOR="#FFFFFF" WIDTH="600" BORDER=1><TR><TD>
<CENTER>
		<B>OVER 30 DAY'S OLD OFFICE LISTINGS LIST</B><br>
<HR>


<P>
<FONT SIZE="-1"><a href="<?php echo "$PHP_SELF?op=hotlist-old-60days";?>">Ad Over 60 days - Click Here</A><BR></FONT>
<FONT SIZE="-1"><a href="<?php echo "$PHP_SELF?op=hotlist-old-90days";?>">Ad Over 90 days - Click Here</A><BR></FONT>
<P>



</CENTER>


<table width="100%" BORDER="0">
<tr>
<td style="font-size:14px;">

<P>



<FONT style="font-size:14px;"><B>ADS | LISTINGS THAT ARE MARKED AVAILABLE <img src="../assets/images/icons/a.jpg" border=0 height=12 width=12> &amp; ADVERTISED:</B></FONT><BR>
<TABLE BORDER=0 WIDTH="100%"><TR>
<?php 
$quStrGetTodays = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where (CLASS.MOD < DATE_SUB(CURDATE() ,INTERVAL 30 DAY) and CLI='$grid' AND STATUS_ACTIVE='1' ORDER BY CLASS.TYPE, LANDLORD, LOC, STREET, STREET_NUM, APT";
	$quGetTodays = mysqli_query($dbh, $quStrGetTodays) or die (mysqli_error($dbh));
	while ($rowGetTodays = mysqli_fetch_object($quGetTodays)) {?>
<TD>
<FONT style="font-size:12px;">
		<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetTodays->CID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit">&nbsp;
<?php echo "$rowGetTodays->TYPENAME";?> - <?php echo $rowGetTodays->LOCNAME;?>&nbsp;
<?php echo $rowGetTodays->ROOMS;?> Beds-<?php echo $rowGetTodays->BATH;?> Bath - <?php echo $rowGetTodays->STREET_NUM;?> <?php echo $rowGetTodays->STREET;?> <?php echo $rowGetTodays->APT;?> -
$<?php echo $rowGetTodays->PRICE;?> by: <?php echo $rowGetTodays->HANDLE;?> | Mod: <?php echo $rowGetTodays->MODBY;?></A>
</FONT>
</TD></TR><TR>
	<?php }?>
</TR></TABLE>

<BR>
<FONT style="font-size:14px;"><B>LAST 3 DAY'S MODIFIED <FONT COLOR="RED">UN</FONT>AVAILABLE <img src="../assets/images/icons/u.jpg" border=0 height=12 width=12> LISTINGS:</B></FONT><BR>
<TABLE BORDER=0 WIDTH="100%"><TR>
<?php 
$quStrGetTodays = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where (CLASS.MOD BETWEEN DATE_SUB(CURDATE() ,INTERVAL 3 DAY) AND CURDATE()) and DATEIN!='$now' and CLI='$grid' AND STATUS_ACTIVE!='1' ORDER BY CLASS.TYPE, LANDLORD, LOC, STREET, STREET_NUM, APT";
	$quGetTodays = mysqli_query($dbh, $quStrGetTodays) or die (mysqli_error($dbh));
	while ($rowGetTodays = mysqli_fetch_object($quGetTodays)) {?>
<TD>
<FONT style="font-size:12px;">
		<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetTodays->CID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit">&nbsp;
<?php echo "$rowGetTodays->TYPENAME";?> - <?php echo $rowGetTodays->LOCNAME;?>&nbsp;
<?php echo $rowGetTodays->ROOMS;?> Beds-<?php echo $rowGetTodays->BATH;?> Bath - <?php echo $rowGetTodays->STREET_NUM;?> <?php echo $rowGetTodays->STREET;?> <?php echo $rowGetTodays->APT;?> -
$<?php echo $rowGetTodays->PRICE;?> - <?php echo $rowGetTodays->SHORT_NAME;?> by: <?php echo $rowGetTodays->HANDLE;?> | Mod: <?php echo $rowGetTodays->MODBY;?></a>
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