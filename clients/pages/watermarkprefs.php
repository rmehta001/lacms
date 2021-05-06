<!--BEGIN Watermark settings -->
<?php
$pref_pagebg = $_SESSION["pref_pagebg"]; 
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}
?>
	<CENTER><B>Edit Watermark &amp Picture Settings for <?php echo $_SESSION["group"];?></B><br>

	<form action="<?php echo "$PHP_SELF?op=watermarkprefsDo"; ?>" method="POST">
	<div class="controltext" style="background-color:<?php echo $pagebgcolor;?>;border:1px solid black;width:700px;">

	<table cellspacing="5" cellpadding="3">

<TR>
<TD  align="center">


		<table WIDTH="400">
			<tr>
			<td height="30"><div class="controltext"><NOBR>Default Watermark:</NOBR>
</DIV>
</TD><TD BGCOLOR="#FFFFFF">
<?php if (isset ($rowGetGroup)) echo $rowGetGroup->NAME;?>
</td>
</tr>
			<tr>
			<td height="30"><div class="controltext"><NOBR>Custom Watermark:</NOBR></DIV>
</TD><TD BGCOLOR="#FFFFFF">

<INPUT TYPE="TEXT" id="watermark" name="watermark" value="<?php if (isset ($rowGetGroup))  echo $rowGetGroup->WATERMARK;?>">
</td>
</tr>

			<tr>
			<td height="30"><div class="controltext"><NOBR>Watermark Default On:</NOBR></DIV>
</TD><TD BGCOLOR="#FFFFFF">

<select style="background-color:white" name="watermark_on">
<OPTION VALUE="0" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->WATERMARK_ON=="0") { echo " selected "; }?>>No</OPTION>
<OPTION VALUE="1" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->WATERMARK_ON=="1") { echo " selected "; }?>>Yes</OPTION>
</select></NOBR></div>

</td>
</tr>


			<tr>
			<td height="30"><div class="controltext"><NOBR>Watermark Placement:</NOBR></DIV>
</TD><TD BGCOLOR="#FFFFFF">

<select style="background-color:white" name="watermark_placement">
<OPTION VALUE="0" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->WATERMARK_PLACEMENT=="0") { echo " selected "; }?>>Bottom (default)</OPTION>
<OPTION VALUE="1" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->WATERMARK_PLACEMENT=="1") { echo " selected "; }?>>Centered (middle)</OPTION>
<OPTION VALUE="6" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->WATERMARK_PLACEMENT=="6") { echo " selected "; }?>>Top Center</OPTION>
<OPTION VALUE="2" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->WATERMARK_PLACEMENT=="2") { echo " selected "; }?>>Top Left</OPTION>
<OPTION VALUE="3" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->WATERMARK_PLACEMENT=="3") { echo " selected "; }?>>Top Right</OPTION>
<OPTION VALUE="5" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->WATERMARK_PLACEMENT=="5") { echo " selected "; }?>>Middle Left</OPTION>
<OPTION VALUE="4" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->WATERMARK_PLACEMENT=="4") { echo " selected "; }?>>Middle Right</OPTION>
<OPTION VALUE="8" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->WATERMARK_PLACEMENT=="8") { echo " selected "; }?>>Bottom Left</OPTION>
<OPTION VALUE="7" <?php if (isset ($rowGetGroup)) if ($rowGetGroup->WATERMARK_PLACEMENT=="7") { echo " selected "; }?>>Bottom Right</OPTION>
</select></NOBR></div>

</td>
</tr>
			<tr>
			<td height="30"><div class="controltext"><NOBR>Picture Custom Width:</NOBR></DIV>
</TD><TD BGCOLOR="#FFFFFF">
<INPUT TYPE="TEXT" id="pic_custom_width" name="pic_custom_width" value="<?php if (isset ($rowGetGroup)) echo $rowGetGroup->PIC_CUSTOM_WIDTH;?>">
</td>
</tr>

			<tr>
			<td height="30"><div class="controltext"><NOBR>Picture Custom Height:</NOBR></DIV>
</TD><TD BGCOLOR="#FFFFFF">
<INPUT TYPE="TEXT" id="pic_custom_height" name="pic_custom_height" value="<?php if (isset ($rowGetGroup)) echo $rowGetGroup->PIC_CUSTOM_HEIGHT;?>">
</td>
</tr>

			<tr>
			<td height="30"><div class="controltext"><NOBR>Watermark Custom Font Size:</NOBR></DIV>
</TD><TD BGCOLOR="#FFFFFF">
<INPUT TYPE="TEXT" id="watermark_font" name="watermark_font" value="<?php if (isset ($rowGetGroup)) echo $rowGetGroup->WATERMARK_FONT;?>">
</td>
</tr>

</table>



</TD></TR>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>

	<tr>
	<td colspan="2" align="center"><input type="submit" value="Save Watermark & Picture Preferences" STYLE="Background-Color : #E0FFFF"><BR>
<P>
</td>
	</tr>
	</table>
</form>

<TABLE WIDTH="550"><TR><TD>
<FONT SIZE="-1">You do not have to fill in the watermark Field if you want to use your company's default watermark. If you fill out the custom watermark, the custom watermark will be used on photos you choose to watermark.<BR>
<P><BR>
</TD></TR></TABLE>
	</div>
	</center>
<P><BR>
<!--END edit Watermark Settings -->