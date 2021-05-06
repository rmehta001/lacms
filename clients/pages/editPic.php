<!--BEGIN editPic -->
<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>
<FONT SIZE="-4"><br></FONT>

<div align="left" style="padding:0px;margin:px;border:1px solid black;width:585;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:15px;color:black;">

<FONT SIZE="-4"><br></FONT>
<!--Tabs-->
<?php include ("folderTabs2.php"); ?>
<!--/Tabs-->
<br>
<center>
		
		<table border="0" cellspacing="0" cellpadding="0" align="center" width="550" bgcolor="<?php echo $pagebgcolor;?>">
		<tr>
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td align="center" width="100%">
				<table>
				<tr>
				
				<td align="center" height="30"><div class="controltext">Edit Picture for:</div><div class="ad"><?php echo $abv;?>-<?php echo $cid;?></div></td>
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
		<td width="100%" align="center">
			<table align="center" border="0">
			<TR>
			<td height="30"><div class="controltext"><CENTER><NOBR>Display Order of Picture: <input type="text" size="4" name="picorder" value="<?php echo $rowGetPic->PICORDER; ?>">&nbsp;&nbsp; <FONT SIZE-1><I>(Enter 99 for no order)</I></FONT></NOBR><br></CENTER></div></td>
			</tr>

			<tr>
			<td height="30"><div class="controltext"><CENTER><img src="../../pics/<?php echo "$pid.$rowGetPic->EXT"; ?>"></CENTER></td>
			</tr>
			<tr>
			<td height="30"><div class="controltext"><CENTER><NOBR>Description for ALT tag: <input type="text" size="30" name="desc" value="<?php echo $rowGetPic->DESCRIPT; ?>"></NOBR></CENTER><br></div></td>
			</tr>


			<tr>
			<td align="center" height="30"><div class="controltext"><input type="submit" value="Save" STYLE="Background-Color : #adffad"></div></td>
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
		</center>
		</div>
		<br>
<!--END editPic -->
