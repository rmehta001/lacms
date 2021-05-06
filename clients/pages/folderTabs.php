<!--BEGIN folderTabs -->

<?php 

$adTabColor = "#FFFF99";
$picTabColor = "#FFFF99";
$listTabColor = "#FFFF99";
$dealTabColor = "#FFFF99";
$printTabColor = "#FFFF99";


if ($page=="edit") {
	$adTabColor = "#FFFFFF";
	$nav_funct = "select_tab_sens";
}elseif ($page=="editPic" || $page=="managePics" || $page=="deletePic" || $page=="upload") {
	$picTabColor = "#FFFFFF";
	$nav_funct = "select_tab_insens";
}elseif ($page=="editListing") {
	$listTabColor = "#FFFFFF";
	$nav_funct = "select_tab_sens";
}elseif ($page=="manageListingDeals" || $page=="createDeal" || $page=="editDeal" || $page=="editDealAccounting" || $page=="deleteDeal") {
	$dealTabColor = "#FFFFFF";
	$nav_funct = "select_tab_insens";
}elseif ($page=="printOuts") {
	$printTabColor = "#FFFFFF";
	$nav_funct = "select_tab_insens";
}
?>


	<br>
	<table border="0" cellspacing="0" cellpadding="0" width="40%">
	<tr>
	<td>
	<table border="0" cellspacing="0" cellpadding="0" width="100%" height="30">
	<tr>
		<td colspan="21" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
		<td valign="top" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td> 
		<td bgcolor="<?php echo $adTabColor;?>">&nbsp;</td>
		<td height="30" width="50" bgcolor="<?php echo $adTabColor;?>"><div class="menu" style="cursor:hand;" onClick="<?php echo $nav_funct;?>('<?php echo "$PHP_SELF?op=edit&cid=$cid";?>');">Advertisement</div></td>
		<td bgcolor="<?php echo $adTabColor;?>">&nbsp;</td>
		<td valign="top" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td> 
		<td bgcolor="<?php echo $picTabColor;?>">&nbsp;</td>
		<td height="30" width="50" bgcolor="<?php echo $picTabColor;?>"><div class="menu" style="cursor:hand;" onClick="<?php echo $nav_funct;?>('<?php echo "$PHP_SELF?op=managePics&cid=$cid";?>');">Pictures</a></div></td>
		<td bgcolor="<?php echo $picTabColor;?>">&nbsp;</td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td bgcolor="<?php echo $listTabColor;?>">&nbsp;</td>
		<td height="30" width="50" bgcolor="<?php echo $listTabColor;?>"><div class="menu"  style="cursor:hand;" onClick="<?php echo $nav_funct;?>('<?php echo "$PHP_SELF?op=editListing&cid=$cid";?>');">Listing<a/></div></td>
		<td bgcolor="<?php echo $listTabColor;?>">&nbsp;</td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td bgcolor="<?php echo $dealTabColor;?>">&nbsp;</td>
		<td height="30" width="50" bgcolor="<?php echo $dealTabColor;?>"><div class="menu" style="cursor:hand;" onClick="<?php echo $nav_funct;?>('<?php echo "$PHP_SELF?op=manageListingDeals&cid=$cid";?>');">Dealsheets</a></div></td>
		<td bgcolor="<?php echo $dealTabColor;?>">&nbsp;</td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td bgcolor="<?php echo $printTabColor;?>">&nbsp;</td>
		<td height="30" width="50" bgcolor="<?php echo $printTabColor;?>"><div class="menu" style="cursor:hand;" onClick="<?php echo $nav_funct;?>('<?php echo "$PHP_SELF?op=printOuts&cid=$cid";?>');">Printouts</a></div></td>
		<td bgcolor="<?php echo $printTabColor;?>">&nbsp;</td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<?php if ($user_level > 1) { ?>
	<tr>
		<td colspan="21" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td colspan="19" height="30" bgcolor="#FFFF99"  align="center"><div class="controlText"><a href="<?php echo "$PHP_SELF?op=delete&cid=$cid";?>">Delete this listing.</a></td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	<?php } ?>
	<tr>
		<td colspan="21" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	<br>
	<br>
<!--END folderTabs -->