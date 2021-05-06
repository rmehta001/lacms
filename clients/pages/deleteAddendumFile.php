<!--BEGIN deletePic -->
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
<br>
<center>
		
		<table border="1" bordercolor="#000000" cellspacing="0" cellpadding="0" align="center" width="400" BGCOLOR="<?php echo $pagebgcolor;?>">
		<tr>
		<td align="center" width="100%">



			<table BORDER="0" WIDTH="375"><tr>
			<td align="center" height="30"><div class="controltext"><B><FONT SIZE="+1">Delete document <?php
if ($desc!="") {
echo $desc;
} else {
echo "Doc # $pid";
}
?>
</FONT></B>

</div></td></tr>
		<form action="<?php echo "$PHP_SELF?op=deleteAddendumFileDo"; ?>" method="POST">
		<input type="hidden" name="pid" value="<?php echo $pid;?>">
		<input type="hidden" name="lid" value="<?php echo $lid;?>">
		<input type="hidden" name="ext" value="<?php echo $ext; ?>">
			<tr>
			<td height="30"><div class="ad"><?php echo $rowGetPic->DESCRIPT;?></div></td>
			</tr>
			<tr>
			<td height="30" align=center><div class="controltext">Please type 'y' to confirm: <input type="text" size="3" name="conf"></td>
			</tr>
			<tr>
			<td align="center" height="30"><div class="controltext"><input type="submit" value="Delete"></div></td>
			</tr>
			</table>

</td></tr>
		</form>
		</table>
	<br>
	<br>
	</center>
	</div>
	<br>
	<br>
		

<!--END deletePic -->