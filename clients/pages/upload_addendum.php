<!--BEGIN upload -->

<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>
<br>

<div align="left" style="padding:0px;margin:px;border:1px solid black;width:585;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:15px;color:black;">

<br>
<center>
		<table border="0" cellspacing="0" cellpadding="0" align="center" width="400" BGCOLOR="<?php echo $pagebgcolor;?>">
		<tr>
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td align="center" width="100%">
				<table>
				<tr>
				
				<td align="center" height="30"><div class="controltext"><FONT SIZE="+1"><B>Upload An Additional Addundum or Document</B></FONT></div></td>
				</tr>
				</table>
		</td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>


		<form enctype="multipart/form-data" action="<?php echo "$PHP_SELF?op=uploadAddendumFile";?>" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="3840000">
		<input type="hidden" name="lid" value="<?php echo $lid; ?>">
		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td width="50%" align="center">
			<table align="center" border="0">
			<tr>
			<td height="30"><BR><div class="controltext">Send this file: <input name="file" type="file" STYLE="Background-Color : #E0FFFF" ></div></td>
			</tr>
			<tr>
			<td height="30"><div class="controltext"><NOBR>Name of Document: <input type="text" name="desc" size="30" STYLE="Background-Color : #E0FFFF"></NOBR></div></td>
			</tr>
			<tr>
			<td align="center" height="30"><div class="controltext"><input type="submit" value="Send File"></div></td>
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

<!-- END upload -->
