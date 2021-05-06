<!--BEGIN deletePic -->
<br>

<div align="left" style="padding:0px;margin:px;border:1px solid black;width:585;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:15px;color:black;">
<!--Tabs-->
<?php include ("folderTabs2.php"); ?>
<!--/Tabs-->
<br>
<br>
<center>
		
		<table border="0" cellspacing="0" cellpadding="0" align="center" width="200">
		<tr>
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td align="center" bgcolor="#FFFF99" width="50%">
				<table>
				<tr>
				
				<td align="center" height="30" bgcolor="#FFFF99"><div class="controltext">Delete Picture for:</div><div class="ad"><?php echo $abv;?>-<?php echo $cid;?></div></td>
				</tr>
				</table>
		</td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<form action="<?php echo "$PHP_SELF?op=deletePicDo"; ?>" method="POST">
		<input type="hidden" name="pid" value="<?php echo $pid;?>">
		<input type="hidden" name="cid" value="<?php echo $cid;?>">
		<input type="hidden" name="ext" value="<?php echo "$rowGetPic->EXT"; ?>">
		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td width="50%" bgcolor="#FFFF99" align="center">
			<table align="center" border="0">
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext"><img src="../../pics/<?php echo "$pid.$rowGetPic->EXT"; ?>"></td>
			</tr>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="ad"><?php echo $rowGetPic->DESCRIPT;?></div></td>
			</tr>
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
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		</table>
	<br>
	<br>
	<br>
	</center>
	</div>
	<br>
	<br>
		

<!--END deletePic -->