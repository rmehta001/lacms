<!--BEGIN editColors -->

<script type="text/javascript" src="../assets/jscolor/jscolor.js"></script>

<CENTER>

<TABLE BGCOLOR="#FFFFFF" WIDTH="800" BORDER="1"><TR><TD WIDTH="45">
<img src="../images/preferences.jpg" border=0 height=45 width=70>
</TD><TD>
	<CENTER><B>Edit Color Preferences for <?php echo $_SESSION["handle"];?> from <?php echo $_SESSION["group"];?></B></CENTER></TD><TD WIDTH="45">
<img src="../images/preferences.jpg" border=0 height=45 width=70>
</TD></TR></TABLE>

	<form action="<?php echo "$PHP_SELF?op=editColorsDo"; ?>" method="POST" name="colors">
	<input type="hidden" name="use_version" value="2">
<?php
$pref_pagebg = $_SESSION["pref_pagebg"];
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} ?>
	<div class="controltext" style="background-color:<?php echo $pagebgcolor;?>;border:1px solid black;width:800px;">
	<table cellspacing="5" cellpadding="3" border="0">

<TR><TD WIDTH="65%">
<FONT SIZE="-1" color=red><I>(You have to log out an log back in for some of the changes to your preferences to take place after you save. In some cases you may have to close your browser,)</I></FONT> 
</TD><TD><input type="submit" value=" Save Color Preferences " STYLE="Background-Color : #adffad ;">
</TD></TR>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>

<tr>
	<td align="right" valign="middle"><span class="controltext"><NOBR><B>Row Color For Alternating lines on lists:</B></NOBR></span></td>
	<td valign="top">
<span class="controltext">


<NOBR>

<TABLE><TR><TD>

<input class="color" type="text" value="<?php echo $rowGetUser->PREF_ROW_COLOR;?>" name="pref_row_color">




</TD><TD BGCOLOR="#F5F5DC">Default<BR>#F5F5DC</TD></TR></TABLE>


</NOBR></SPAN>




</td>
	</tr>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
	<tr>
	<td align="right" valign="middle"><span class="controltext"><NOBR><B>Row Color For Column Titles on lists:</B></NOBR></span></td>
	<td valign="top">
<span class="controltext">

<TABLE><TR><TD>
<input class="color" type="text" value="<?php echo $rowGetUser->PREF_COLTIT_COLOR;?>" name="pref_coltit_color">

</TD><TD BGCOLOR="#3DB1FF">Default<BR>#3DB1FF</TD></TR></TABLE>


</NOBR></SPAN></td>
	</tr>



	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
	<tr>
	<td align="right" valign="middle"><span class="controltext"><B>Page &amp; Search Box Background Color:</B></span></td>
	<td valign="top"><span class="controltext"><NOBR>

<TABLE><TR><TD>
<input class="color" type="text" value="<?php echo $rowGetUser->PREF_PAGEBG_COLOR;?>" name="pref_pagebg_color">

</TD><TD BGCOLOR="#F5F5DC">Default<BR>#F5F5DC</TD></TR></TABLE>


</NOBR></SPAN></td>
	</tr>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
	<tr>
	<td align="right" valign="middle"><span class="controltext"><B>Top Bar Background Color:</B></span></td>
	<td valign="top"><NOBR><span class="controltext">

<TABLE><TR><TD>

<input class="color" type="text" value="<?php echo $rowGetUser->PREF_TOPBAR_COLOR;?>" name="pref_topbar_color">
</TD><TD BGCOLOR="#FFFF99">Default<BR>#FFFF99</TD></TR></TABLE>

</NOBR></SPAN></td>
	</tr>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
	<tr>
	<td align="right" valign="middle"><span class="controltext"><B>Top Menu Color:</B></span></td>
	<td valign="top"><NOBR><span class="controltext">

<TABLE><TR><TD>

<input class="color" type="text" value="<?php echo $rowGetUser->PREF_TOPMENU_COLOR;?>" name="pref_topmenu_color">
</TD><TD BGCOLOR="#75b9ff">Default<BR>#75b9ff</TD></TR></TABLE>

</NOBR></SPAN></td>
	</tr>


	<tr>
	<td colspan="2"><hr noshade color="black" size="1"></td>
	</tr>
	<tr>
	<td align="right" valign="middle"><span class="controltext"><B>Outer Page Trim Background Color:</B></span></td>
	<td valign="top"><NOBR><span class="controltext">


<TABLE><TR><TD>

<input class="color" type="text" value="<?php echo $rowGetUser->PREF_PAGETRIM_COLOR;?>" name="pref_pagetrim_color">
</TD><TD BGCOLOR="#AFDCEC">Default<BR>#AFDCEC</TD></TR></TABLE>




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