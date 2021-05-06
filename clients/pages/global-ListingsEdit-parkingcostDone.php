<!--BEGIN Hotlist -->
 <BR>
<TABLE BGCOLOR="#FFFFFF" WIDTH="600" BORDER=1><TR><TD>
<CENTER>
		<B>  TESTING COST DONE </B><br>
<HR>
</CENTER>


<?php
if($_SESSION['show_hot_list']) {
	$_showHot = "n";
	$icon = "minus.gif";
}else {
	$_showHot = 1;
	$icon = "plus.gif";
}?>
<table width="100%" BORDER="0">
<tr>
<td style="font-size:14px;"><B>Ads/Listings Hot List</B><br><div class="controltext"><P>


<TABLE BORDER=0 WIDTH="400"><TR>

<?php if($_SESSION['show_hot_list']) {
	$quStrGetHotList = "select * from HOTS where ITEM_TYPE='1' and UID='$uid' and GRID='$grid'";
	$quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die (mysqli_error($dbh));
	while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {?>

<TD WIDTH="340">

		<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetHotList->ITEM_ID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetHotList->ITEM_NAME;?></a>

</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD ALIGN=RIGHT WIDTH="25">

<?php if($rowGetHotList->PUBLIC != "0") { echo "Shared"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } ?> 

</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="25">

<a href="<?php echo "$PHP_SELF?op=hot_list_remove&hots_id=$rowGetHotList->ID&return_page=$op&cid=$cid&clid=$clid&did=$did&lid=$lid&pid=$pid";?>"><img border=0 src="../images/icons/delete.gif" alt="delete"></a>

</TD></TR><TR>

	<?php }?>
<?php } ?>

</TR></TABLE>

<BR>

Ads/Listings From Others in the office:<BR>

<TABLE BORDER=0 WIDTH="400"><TR>

<?php if($_SESSION['show_hot_list']) {
	$quStrGetHotList = "select * from HOTS where ITEM_TYPE='1' and UID!='$uid' and GRID='$grid' and PUBLIC!='0'";
	$quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die (mysqli_error($dbh));
	while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {?>

<TD WIDTH="340">

		<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetHotList->ITEM_ID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetHotList->ITEM_NAME;?></a>

</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD ALIGN=RIGHT WIDTH="25">

<?php if($rowGetHotList->PUBLIC != "0") { echo "Shared"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; }?>

</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="25">

&nbsp;

</TD></TR><TR>
		
	<?php }?>
<?php } ?>

</TR></TABLE>

</DIV>
<P><BR>
</td>
</tr>
</table>



<table width="100%" BORDER="0">
<tr>
<td style="font-size:14px;"><B>Clients Hot List</B><br><div class="controltext"><P>

<TABLE BORDER=0 WIDTH="400"><TR>

<?php if($_SESSION['show_hot_list']) {
	$quStrGetHotList = "select * from HOTS where ITEM_TYPE='3' and UID='$uid' and GRID='$grid'";
	$quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die (mysqli_error($dbh));
	while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {?>

<TD WIDTH="340">

		<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetHotList->ITEM_ID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetHotList->ITEM_NAME;?></a>

</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD ALIGN=RIGHT WIDTH="25">

		<?php if($rowGetHotList->PUBLIC != "0") { echo "Shared"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } ?>

</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="25">
<a href="<?php echo "$PHP_SELF?op=hot_list_remove&hots_id=$rowGetHotList->ID&return_page=hotlist&cid=$cid&clid=$clid&did=$did&lid=$lid&pid=$pid";?>"><img border=0 src="../images/icons/delete.gif" alt="delete"></a>

</TD></TR><TR>
		
	<?php }?>
<?php } ?>

</TR></TABLE>

<BR>
Clients Shared From Others in the office:<BR>

<TABLE BORDER=0 WIDTH="400"><TR>

<?php if($_SESSION['show_hot_list']) {
	$quStrGetHotList = "select * from HOTS where ITEM_TYPE='3' and UID!='$uid' and GRID='$grid' and PUBLIC!='0'";
	$quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die (mysqli_error($dbh));
	while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {?>

<TD WIDTH="340">

		<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowGetHotList->ITEM_ID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetHotList->ITEM_NAME;?></a>
</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="25" ALIGN="right">
<?php if($rowGetHotList->PUBLIC != "0") { echo "Shared"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } ?>
</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="25">
&nbsp;
</TD></TR><TR>		
	<?php }?>
<?php } ?>
</TR></TABLE>
<BR>





</DIV>
<P><BR>
</td>
</tr>
</table>


<table width="100%" BORDER="0">
<tr>
<td style="font-size:14px;"><B>Deals Hot List</B><br><div class="controltext"><P>

<TABLE BORDER=0 WIDTH="400"><TR>

<?php if($_SESSION['show_hot_list']) {
	$quStrGetHotList = "select * from HOTS where ITEM_TYPE='2' and UID='$uid' and GRID='$grid'";
	$quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die (mysqli_error($dbh));
	while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {?>

<TD WIDTH="340">

		<a href="<?php echo "$PHP_SELF?op=editDeal&did=$rowGetHotList->ITEM_ID&cid=$rowGetHotList->ITEM_ID2";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetHotList->ITEM_NAME;?></a>
</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD ALIGN=RIGHT WIDTH="25">

<?php if($rowGetHotList->PUBLIC != "0") { echo "Shared"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } ?> 

</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="25">

<a href="<?php echo "$PHP_SELF?op=hot_list_remove&hots_id=$rowGetHotList->ID&return_page=hotlist&cid=$cid&clid=$clid&did=$did&lid=$lid&pid=$pid";?>"><img border=0 src="../images/icons/delete.gif" alt="delete"></a><br>

</TD></TR><TR>
	
	<?php }?>
<?php } ?>

</TR></TABLE>

<BR>
Deal Sheets Shared From Others in the office:<BR>

<TABLE BORDER=0 WIDTH="400"><TR>
<?php if($_SESSION['show_hot_list']) {
	$quStrGetHotList = "select * from HOTS where ITEM_TYPE='2' and UID!='$uid' and GRID='$grid' and PUBLIC!='0'";
	$quGetHotList = mysqli_query($dbh, $quStrGetHotList) or die (mysqli_error($dbh));
	while ($rowGetHotList = mysqli_fetch_object($quGetHotList)) {?>

<TD WIDTH="340">

		<a href="<?php echo "$PHP_SELF?op=editDeal&did=$rowGetHotList->ITEM_ID&cid=$rowGetHotList->ITEM_ID2";?>"><img border=0 src="../images/icons/edit.gif" alt="edit"><?php echo $rowGetHotList->ITEM_NAME;?></a>
</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD ALIGN=RIGHT WIDTH="25">
<?php if($rowGetHotList->PUBLIC != "0") { echo "Shared"; } else { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } ?>
</TD><TD WIDTH="5">
&nbsp;&nbsp;&nbsp;
</TD><TD WIDTH="25">
&nbsp;
</TD></TR><TR>	
	<?php }?>
<?php } ?>
</TR></TABLE>

<BR>

<HR>
<P>


<FONT style="font-size:14px;"><B>TODAY'S LISTING ADDITIONS <img src="../assets/images/icons/a.jpg" border=0 height=12 width=12> &amp; <img src="../assets/images/icons/u.jpg" border=0 height=12 width=12>:</B></FONT><BR>
<P>

<a href="<?php echo "$PHP_SELF?op=hotlist-3days";?>">Last 3 Day's Listings</A><BR>
<a href="<?php echo "$PHP_SELF?op=hotlist-1week";?>">Current Week's Listings</A><BR>
<P>




<TABLE BORDER=0 WIDTH="100%"><TR>
<?php 
$quStrGetTodays = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where DATEIN='$now' and CLI='$grid' ORDER BY CLASS.TYPE, LANDLORD, LOC, STREET, STREET_NUM, APT";
	$quGetTodays = mysqli_query($dbh, $quStrGetTodays) or die (mysqli_error($dbh));
	while ($rowGetTodays = mysqli_fetch_object($quGetTodays)) {?>
<TD>
<FONT style="font-size:9px;">
		<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetTodays->CID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit">&nbsp;
<?php echo "$rowGetTodays->TYPENAME";?> - <?php echo $rowGetTodays->LOCNAME;?>&nbsp;
<?php echo $rowGetTodays->ROOMS;?> Beds-<?php echo $rowGetTodays->BATH;?> Bath - <?php echo $rowGetTodays->STREET_NUM;?> <?php echo $rowGetTodays->STREET;?> <?php echo $rowGetTodays->APT;?> -
$<?php echo $rowGetTodays->PRICE;?> by: <?php echo $rowGetTodays->HANDLE;?></a>
</FONT>
</TD></TR><TR>
	<?php }?>
</TR></TABLE>
<BR>

<FONT style="font-size:14px;"><B>TODAY'S MODIFIED AVAILABLE <img src="../assets/images/icons/a.jpg" border=0 height=12 width=12> LISTINGS:</B></FONT><BR>
<TABLE BORDER=0 WIDTH="100%"><TR>
<?php 
$quStrGetTodays = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where CLASS.MOD='$now' and DATEIN!='$now' and CLI='$grid' AND STATUS_ACTIVE='1' ORDER BY CLASS.TYPE, LANDLORD, LOC, STREET, STREET_NUM, APT";
	$quGetTodays = mysqli_query($dbh, $quStrGetTodays) or die (mysqli_error($dbh));
	while ($rowGetTodays = mysqli_fetch_object($quGetTodays)) {?>
<TD>
<FONT style="font-size:9px;">
		<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetTodays->CID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit">&nbsp;
<?php echo "$rowGetTodays->TYPENAME";?> - <?php echo $rowGetTodays->LOCNAME;?>&nbsp;
<?php echo $rowGetTodays->ROOMS;?> Beds-<?php echo $rowGetTodays->BATH;?> Bath - <?php echo $rowGetTodays->STREET_NUM;?> <?php echo $rowGetTodays->STREET;?> <?php echo $rowGetTodays->APT;?> -
$<?php echo $rowGetTodays->PRICE;?> by: <?php echo $rowGetTodays->HANDLE;?></A>
</FONT>
</TD></TR><TR>
	<?php }?>
</TR></TABLE>

<BR>
<FONT style="font-size:14px;"><B>TODAY'S MODIFIED <FONT COLOR="RED">UN</FONT>AVAILABLE <img src="../assets/images/icons/u.jpg" border=0 height=12 width=12> LISTINGS:</B></FONT><BR>
<TABLE BORDER=0 WIDTH="100%"><TR>
<?php 
$quStrGetTodays = "select * from ((((CLASS INNER JOIN USERS ON CLASS.UID=USERS.UID) INNER JOIN LOC ON CLASS.LOC=LOC.LOCID) INNER JOIN `GROUP` ON CLASS.CLI=`GROUP`.GRID) INNER JOIN TYPES ON CLASS.TYPE=TYPES.TYPE) LEFT JOIN LANDLORD ON CLASS.LANDLORD=LANDLORD.LID where CLASS.MOD='$now' and DATEIN!='$now' and CLI='$grid' AND STATUS_ACTIVE!='1' ORDER BY CLASS.TYPE, LANDLORD, LOC, STREET, STREET_NUM, APT";
	$quGetTodays = mysqli_query($dbh, $quStrGetTodays) or die (mysqli_error($dbh));
	while ($rowGetTodays = mysqli_fetch_object($quGetTodays)) {?>
<TD>
<FONT style="font-size:9px;">
		<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetTodays->CID";?>"><img border=0 src="../images/icons/edit.gif" alt="edit">&nbsp;
<?php echo "$rowGetTodays->TYPENAME";?> - <?php echo $rowGetTodays->LOCNAME;?>&nbsp;
<?php echo $rowGetTodays->ROOMS;?> Beds-<?php echo $rowGetTodays->BATH;?> Bath - <?php echo $rowGetTodays->STREET_NUM;?> <?php echo $rowGetTodays->STREET;?> <?php echo $rowGetTodays->APT;?> -
$<?php echo $rowGetTodays->PRICE;?> - <?php echo $rowGetTodays->SHORT_NAME;?> by: <?php echo $rowGetTodays->HANDLE;?></a>
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