<!--BEGIN managePics -->
<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>
<span style="font-size:5px;"><BR></span>
<div align="left" style="padding:0px;margin:px;border:1px solid black;width:630;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:15px;color:black;">

<CENTER>
PICTURE LINKS &amp; HTML CODES FOR<BR>

<IMG SRC=https://www.BostonApartments.com/pics/<?php echo $pid; ?>.<?php echo $ext; ?> HEIGHT=150><BR>





<FONT SIZE=-4><BR></FONT>
<!--/Tabs-->
<center>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
		<tr width=100%>
		<td valign="top"  height="1" bgcolor="#FFFFFF">

			<table align="center" border="0" bgcolor="<?php echo $pagebgcolor; ?>">
			<tr>
			<td height="30" align="right">

<BR>
<NOBR><FONT SIZE="-1"><B>Embedded/Show Picture Code: <INPUT TYPE="TEXT" SIZE="50" NAME="" VALUE="<IMG SRC=https://www.BostonApartments.com/pics/<?php echo $pid; ?>.<?php echo $ext; ?>>"></NOBR><BR>

<NOBR>Address to Picture: <INPUT TYPE="TEXT" SIZE="50" NAME="" VALUE="https://www.BostonApartments.com/pics/<?php echo $pid; ?>.<?php echo $ext; ?>"></NOBR><BR>

<NOBR>Clickable Link to Picture Code: <INPUT TYPE="TEXT" SIZE="50" NAME="" VALUE="<A HREF=https://www.BostonApartments.com/pics/<?php echo $pid; ?>.<?php echo $ext; ?>>Click for a picture</A>"></NOBR><BR>
</B></FONT>
</TD></TR><TR><TD>
<FONT SIZE="-1">
<BR>
Links &amp; embedded codes may be in email as well as web pages.<BR>
<BR>
<LI>Use the embedded to display the picture.
<LI>Use the "Clickable Link to Picture Code" where you do not want to display the picture but want a link to the picture.
<LI>Use the "Address to Picture" when you just want to show the location of the picture file, do not want to display and don't want a clickable link.<BR>
<P>
To use the codes, click in the code box you want, Select All (Highlight the code - Control-A), then copy the code with Control-C. You can past the code in the appropriate place by licking Control-V.</FONT>

<BR>


</td></tr></table>

	</td>
	</tr>
	</table>
	
</center>
</div>
<!--END managePics -->
