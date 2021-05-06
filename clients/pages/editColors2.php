<!--BEGIN editColors -->
<CENTER>

<TABLE BGCOLOR="#FFFFFF" WIDTH="800"><TR><TD WIDTH="45">
<img src="../images/preferences.jpg" border=0 height=45 width=70>
</TD><TD>
	<CENTER><B>Edit Color Preferences for <?php echo $handle;?> from <?php echo $group;?></B></CENTER></TD><TD WIDTH="45">
<img src="../images/preferences.jpg" border=0 height=45 width=70>
</TD></TR></TABLE>

	<form action="<?php echo "$PHP_SELF?op=editColorsDo"; ?>" method="POST">
	<input type="hidden" name="use_version" value="2">
<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} ?>
	<div class="controltext" style="background-color:<?php echo $pagebgcolor;?>;border:1px solid black;width:800px;">
	<table cellspacing="5" cellpadding="3" border=0>

<TR><TD WIDTH="70%">
<FONT SIZE="-1" color=red><I>(You have to log out an log back in for some of the changes to your preferences to take place after you save. In some cases you may have to close your browser,)</I></FONT> 
</TD><TD><input type="submit" value=" Save Color Preferences " STYLE="Background-Color : #adffad ;">
</TD></TR>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>

<tr>
	<td align="right" valign="top"><span class="controltext"><NOBR><B>Row Color For Alternating lines on lists:</B></NOBR></span></td>
	<td valign="top">
<span class="controltext">
<NOBR>Default<input type="radio" name="pref_row_color" value="" <?php if ($rowGetUser->PREF_ROW_COLOR=="") { echo " checked "; }?> > 

Yellow<input type="radio" name="pref_row_color" value="#FFFF99" <?php if ($rowGetUser->PREF_ROW_COLOR=="#FFFF99") { echo " checked "; }?>> 

Blue<input type="radio" name="pref_row_color" value="#CCFFFF" <?php if ($rowGetUser->PREF_ROW_COLOR=="#CCFFFF") { echo " checked "; }?>>

Green<input type="radio" name="pref_row_color" value="#CCFFCC" <?php if ($rowGetUser->PREF_ROW_COLOR=="#CCFFCC") { echo " checked "; }?>>

White<input type="radio" name="pref_row_color" value="#FFFFFF" <?php if ($rowGetUser->PREF_ROW_COLOR=="#FFFFFF") { echo " checked "; }?>>
</NOBR></SPAN></td>
	</tr>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
	<tr>
	<td align="right" valign="top"><span class="controltext"><NOBR><B>Row Color For Column Titles on lists:</B></NOBR></span></td>
	<td valign="top">
<span class="controltext">
<NOBR>Default<input type="radio" name="pref_coltit_color" value="" <?php if ($rowGetUser->PREF_COLTIT_COLOR=="") { echo " checked "; }?> > 

Yellow<input type="radio" name="pref_coltit_color" value="#FFFF99" <?php if ($rowGetUser->PREF_COLTIT_COLOR=="#FFFF99") { echo " checked "; }?>> 

Green<input type="radio" name="pref_coltit_color" value="#CCFFCC" <?php if ($rowGetUser->PREF_COLTIT_COLOR=="#CCFFCC") { echo " checked "; }?>>

Orange<input type="radio" name="pref_coltit_color" value="#FFCC66" <?php if ($rowGetUser->PREF_COLTIT_COLOR=="#FFCC66") { echo " checked "; }?>>

Pink<input type="radio" name="pref_coltit_color" value="#FF8FFF" <?php if ($rowGetUser->PREF_COLTIT_COLOR=="#FF8FFF") { echo " checked "; }?>>

White<input type="radio" name="pref_coltit_color" value="#FFFFFF" <?php if ($rowGetUser->PREF_COLTIT_COLOR=="#FFFFFF") { echo " checked "; }?>>
</NOBR></SPAN></td>
	</tr>



	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
	<tr>
	<td align="right" valign="top"><span class="controltext"><B>Page &amp; Search Box Background Color:</B></span></td>
	<td valign="top"><span class="controltext"><NOBR>
Default<input type="radio" name="pref_pagebg_color" value="" <?php if ($rowGetUser->PREF_PAGEBG_COLOR=="") { echo " checked "; }?> > 

Gray<input type="radio" name="pref_pagebg_color" value="#DCDCDC" <?php if ($rowGetUser->PREF_PAGEBG_COLOR=="#DCDCDC") { echo " checked "; }?>> 

Yellow<input type="radio" name="pref_pagebg_color" value="#FFFF99" <?php if ($rowGetUser->PREF_PAGEBG_COLOR=="#FFFF99") { echo " checked "; }?>> 

Blue<input type="radio" name="pref_pagebg_color" value="#AFDCEC" <?php if ($rowGetUser->PREF_PAGEBG_COLOR=="#CCFFFF") { echo " checked "; }?>>

Green<input type="radio" name="pref_pagebg_color" value="#CCFFCC" <?php if ($rowGetUser->PREF_PAGEBG_COLOR=="#CCFFCC") { echo " checked "; }?>>

White<input type="radio" name="pref_pagebg_color" value="#FFFFFF" <?php if ($rowGetUser->PREF_PAGEBG_COLOR=="#FFFFFF") { echo " checked "; }?>>
</NOBR></SPAN></td>
	</tr>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
	<tr>
	<td align="right" valign="top"><span class="controltext"><B>Top Bar Background Color:</B></span></td>
	<td valign="top"><NOBR><span class="controltext">
Default<input type="radio" name="pref_topbar_color" value="" <?php if ($rowGetUser->PREF_TOPBAR_COLOR=="") { echo " checked "; }?> > 

Gray <input type="radio" name="pref_topbar_color" value="#DCDCDC" <?php if ($rowGetUser->PREF_TOPBAR_COLOR=="#DCDCDC") { echo " checked "; }?>> 

Blue<input type="radio" name="pref_topbar_color" value="#CCFFFF" <?php if ($rowGetUser->PREF_TOPBAR_COLOR=="#CCFFFF") { echo " checked "; }?>>

Green<input type="radio" name="pref_topbar_color" value="#CCFFCC" <?php if ($rowGetUser->PREF_TOPBAR_COLOR=="#CCFFCC") { echo " checked "; }?>>

Orange<input type="radio" name="pref_topbar_color" value="#FFCC66" <?php if ($rowGetUser->PREF_TOPBAR_COLOR=="#FFCC66") { echo " checked "; }?>>

White<input type="radio" name="pref_topbar_color" value="#FFFFFF" <?php if ($rowGetUser->PREF_TOPBAR_COLOR=="#FFFFFF") { echo " checked "; }?>>
</NOBR></SPAN></td>
	</tr>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
	<tr>
	<td align="right" valign="top"><span class="controltext"><B>Top Menu Color:</B></span></td>
	<td valign="top"><NOBR><span class="controltext">
Default<input type="radio" name="pref_topmenu_color" value="" <?php if ($rowGetUser->PREF_TOPMENU_COLOR=="") { echo " checked "; }?> > 

Gray<input type="radio" name="pref_topmenu_color" value="#D5D5D5" <?php if ($rowGetUser->PREF_TOPMENU_COLOR=="#D5D5D5") { echo " checked "; }?>>

Green<input type="radio" name="pref_topmenu_color" value="#CCFFCC" <?php if ($rowGetUser->PREF_TOPMENU_COLOR=="#CCFFCC") { echo " checked "; }?>> 

Orange<input type="radio" name="pref_topmenu_color" value="#FFCC66" <?php if ($rowGetUser->PREF_TOPMENU_COLOR=="#FFCC66") { echo " checked "; }?>> 

Pink<input type="radio" name="pref_topmenu_color" value="#FF8FFF" <?php if ($rowGetUser->PREF_TOPMENU_COLOR=="#FF8FFF") { echo " checked "; }?>> 

White<input type="radio" name="pref_topmenu_color" value="#FFFFFF" <?php if ($rowGetUser->PREF_TOPMENU_COLOR=="#FFFFFF") { echo " checked "; }?>>

</NOBR></SPAN></td>
	</tr>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
	<tr>
	<td align="right" valign="top"><span class="controltext"><B>Outer Page Trim Background Color:</B></span></td>
	<td valign="top"><NOBR><span class="controltext">
Default<input type="radio" name="pref_pagetrim_color" value="" <?php if ($rowGetUser->PREF_PAGETRIM_COLOR=="") { echo " checked "; }?> > 

Gray<input type="radio" name="pref_pagetrim_color" value="#D5D5D5" <?php if ($rowGetUser->PREF_PAGETRIM_COLOR=="#D5D5D5") { echo " checked "; }?>>

Lt. Green<input type="radio" name="pref_pagetrim_color" value="#CCFFCC" <?php if ($rowGetUser->PREF_PAGETRIM_COLOR=="#CCFFCC") { echo " checked "; }?>> 

Orange<input type="radio" name="pref_pagetrim_color" value="#FFCC66" <?php if ($rowGetUser->PREF_PAGETRIM_COLOR=="#FFCC66") { echo " checked "; }?>> 

Pink<input type="radio" name="pref_pagetrim_color" value="#FF8FFF" <?php if ($rowGetUser->PREF_PAGETRIM_COLOR=="#FF8FFF") { echo " checked "; }?>> 

White<input type="radio" name="pref_pagetrim_color" value="#FFFFFF" <?php if ($rowGetUser->PREF_PAGETRIM_COLOR=="#FFFFFF") { echo " checked "; }?>> 
</NOBR></SPAN></td>
	</tr>

	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>


	<tr>
	<td colspan="2" align="center">

<FONT SIZE="-1" color=red><I>(You have to log out an log back in for some of the changes<BR>to your preferences to take place after you save.)</I></FONT><BR>
<input type="submit" value=" Save Color Preferences " STYLE="Background-Color : #adffad ;"></td>
	</tr>
	</table>
	</form>

<P>





	</div>
	</center>
	<br>
<!--END editPrefs -->