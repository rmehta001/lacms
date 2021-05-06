<!--BEGIN deleteDeal -->
<BR>
	<!--FOLDER TABS -->
	<?php include ("folderTabs2.php"); ?>
	<!--END FOLDER TABS -->
<BR><P><BR>	
	<table border="0" cellspacing="0" cellpadding="0" align="center" width="50%">
		<tr>
		<td colspan="4" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td align="center" bgcolor="#FFFF99">
				<table>
				<tr>
				
				<td align="center" height="30" bgcolor="#FFFF99"><div class="controltext">Are you sure you want to delete this dealsheet? </div><div class="ad">note: deleting the dealsheet does not delete the listing or the client(s).</div></td>
				</tr>
				</table>
		</td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td colspan="4" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		
		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td  bgcolor="#FFFF99" align="center"><table align="center" border="0">
			<form action="<?php echo "$PHP_SELF?op=deleteDealDo"; ?>" method="POST">
			<input type="hidden" name="did" value="<?php echo $did;?>">
			<input type="hidden" name="cid" value="<?php echo $cid;?>">
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Please type 'y' to confirm: <input type="text" size="3" name="conf"></td>
			</tr>
			<tr>
			<td align="center" height="30" bgcolor="#FFFF99"><div class="controltext"><input type="submit" value="Delete"></div></td>
			</tr>
			</table></td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		</form>
		<tr>
		<td colspan="4" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		</table>
		<br>
	<br>
	<br>
	<a href="<?php echo "$PHP_SELF?op=return_page_op";?>"><img border="0" hspace="0" vspace="0" src="../assets/images/return.jpg"></a>
	<br>
	<br>
<!--END deleteDeal -->
	
	