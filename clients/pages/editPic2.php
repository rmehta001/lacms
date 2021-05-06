<!--BEGIN editPic -->
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
				
				<td align="center" height="30" bgcolor="#FFFF99"><div class="controltext">Edit Picture for:</div><div class="ad"><?php echo $abv;?>-<?php echo $cid;?></div></td>
				</tr>
				</table>
		</td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<form action="<?php echo "$PHP_SELF?op=editPicDo"; ?>" method="POST">
		<input type="hidden" name="pid" value="<?php echo $pid;?>">
		<input type="hidden" name="cid" value="<?php echo $cid;?>">
		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td width="50%" bgcolor="#FFFF99" align="center">
			<table align="center" border="0">
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext"><img src="../../pics/<?php echo "$pid.$rowGetPic->EXT"; ?>"></td>
			</tr>
			<tr>
			<td height="30" bgcolor="#FFFF99"><div class="controltext">Description: <input type="text" size="30" name="desc" value="<?php echo $rowGetPic->DESCRIPT; ?>"><br></div></td>
			</tr>
			<tr>
			<td align="center" height="30" bgcolor="#FFFF99"><div class="controltext"><input type="submit" value="Save"></form></div>
			<form action="<?php echo "$PHP_SELF"; ?>" method="GET">
			<input type="hidden" name="op" value="watermarkPreview">
		        <input type="hidden" name="pid" value="<?php echo $pid;?>">
			<input type="hidden" name="ext" value="<?php echo $rowGetPic->EXT; ?>">
                        <input type="hidden" name="cid" value="<?php echo $cid;?>">
			<hr>
			<input type="text" name="text">
			<br>
			<input type="text" name="size" value="24" size=4>
			<input type="submit" value="Mark">
			</form>
			</td>
			</tr>
			</table></td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		</table>
		<br>
		<br>
		</center>
		</div>
		<br>
		<br>
		
		
		

<!--END editPic -->
