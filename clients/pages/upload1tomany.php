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
<!--Tabs-->
<FONT SIZE="-4"><BR></FONT>
<?php include ("folderTabs2.php"); ?>
<!--/Tabs-->
<br>
<br>
<center>
		
		<?php
		$quStrLookup = "SELECT * FROM `CLASS` WHERE CID=$cid";
		$quLookup = mysqli_query($dbh, $quStrLookup) or die ("building look up failure  - insert picture query failed");
		$Lookup = mysqli_fetch_object($quLookup)
	?>
		
		
		<table border="0" cellspacing="0" cellpadding="0" align="center" width="200">
		<tr>
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td align="center" bgcolor="<?php echo $pagebgcolor; ?>" width="50%">
				<table>
				<tr>
				
				<td align="center" height="30" bgcolor="<?php echo $pagebgcolor; ?>"><div class="controltext">Upload Picture for the WHOLE building at<BR><?php echo "$Lookup->STREET_NUM $Lookup->STREET";?><BR> For landlord # <?php echo "$Lookup->LANDLORD";?></div><div class="ad"><?php echo $abv;?>-<?php echo $cid;?></div></td>
				</tr>
				</table>
		</td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<form enctype="multipart/form-data" action="<?php echo "$PHP_SELF?op=uploadPreview1tomany";?>" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="10750000">
		<input type="hidden" name="cid" value="<?php echo $cid; ?>">
		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td width="50%" bgcolor="<?php echo $pagebgcolor; ?>" align="center">


<table align="center" border="0" bgcolor="<?php echo $pagebgcolor; ?>">
			<tr>
			<td height="30" align="right">

<?php if ($user_level>0) {?>

<div class="controltext">Send this file:</DIV></td><td>
<input name="userfile" type="file" size="30">

</td>
			</tr>
			<tr>

			<td height="30" align="right"><div class="controltext">Watermark: </td><td><NOBR><input type=checkbox name=watermark> &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; <FONT SIZE="-2"><A HREF="<?php echo "$PHP_SELF?op=watermarkprefs"; ?>" target="_NEW">Set Watermark Preferences</A></FONT></NOBR></DIV>



</td></tr><tr><td align=right><div class="controltext">Description:</DIV> </td><td><input type="text" name="desc" size="30"></td>
			</tr>
			<tr>
			<td align="center" height="30"></td><td>
<NOBR>
<input type="submit" value="Send File" STYLE="Background-Color : #A9F5A9"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <A HREF="<?php echo $PHP_SELF."?op=managePics&cid=".$cid;?>"><FONT COLOR="RED">Cancel Upload</FONT></A></NOBR>
<?php }?>

</td>
			</tr>
			</table>
			
			
			</td>
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
	<br>

<!-- END upload -->
