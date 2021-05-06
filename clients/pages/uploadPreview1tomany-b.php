<!--BEGIN uploadPicPreview -->
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
		<td align="center" bgcolor="<?php echo $pagebgcolor;?>" width="50%">
				<table>
				<tr>
				
				<?php

		$lid = $_POST['lid'];
		$street_num = $_POST['street_num'];		
		$street = $_POST['street'];



				?>
				
				<td align="center" height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Choose the size for picture to be added to ALL UNITS at<BR>
				<?php echo "$street_num $street"; ?>
				<BR>For Landlord # <?php echo "$lid";?></div></td>
				</tr>
				</table>
		</td>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<tr>
		<td colspan="7" valign="top" width="100%" height="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="100%" height="1" src="../assets/images/blk_spacer.gif"></td>
		</tr>
		<form action="<?php echo "$PHP_SELF?op=upload1tomanyDo"; ?>" method="POST">
		<input type="hidden" name="pid" value="<?php echo $pid;?>">
		<input type="hidden" name="cid" value="<?php echo $cid;?>">
		<input type="hidden" name="file" value="<?php echo $display; ?>">

		<input type="hidden" name="cli" value="<?php echo $Lookup->CLI;?>">
		<input type="hidden" name="landlord" value="<?php echo $lid;?>">
		<input type="hidden" name="street" value="<?php echo $street;?>">
		<input type="hidden" name="street_num" value="<?php echo $street_num;?>">
				
		
		<tr>
		<td valign="top" height="30" width="1" bgcolor="#000000"><img border="0" hspace="0" vspace="0" width="1" height="100%" src="../assets/images/blk_spacer.gif"></td>
		<td width="50%" bgcolor="<?php echo $pagebgcolor;?>" align="center">

			<TABLE><tr>
			<td align="center" height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><input name=do type="submit" value="Save" STYLE="Background-Color : #A9F5A9">
			<input name=do type="submit" value="Cancel" STYLE="Background-Color : #F5A9A9;">

			</div></td>
			</tr><TABLE>

<table border="0" align="center">
			<tr>
			<td bgcolor="<?php echo $pagebgcolor;?>">
			<table border=0>
			<tr><td bgcolor="<?php echo $pagebgcolor;?>">
			<input type=radio name="size" value=<?php echo $display_medium; ?> checked>
			</td>
			<td  height="30" bgcolor="<?php echo $pagebgcolor;?>">
			<img src="../preview/<?php echo $display_medium; ?>">
			</td></tr>
			<tr>
			<td bgcolor="<?php echo $pagebgcolor;?>">
                        <input type=radio name="size" value=<?php echo $display_small; ?>>
                        </td>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>">
			<img src="../preview/<?php echo $display_small; ?>">
			</td>
			</tr>
			</table>
			</td></tr>
			<tr>
			<td height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext">Description: <input type="text" size="40" name="desc" value="<?php echo $desc; ?>"><br></div></td>
			</tr>
			<tr>
			<td align="center" height="30" bgcolor="<?php echo $pagebgcolor;?>"><div class="controltext"><input name=do type="submit" value="Save" STYLE="Background-Color : #A9F5A9">
			<input name=do type="submit" value="Cancel" STYLE="Background-Color : #F5A9A9;">

			</div></td>
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
		</center>
		</div>
		<br>
		<br>
		
		
		

<!--END -->
