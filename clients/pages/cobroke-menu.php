

<P><BR>
<TABLE BGCOLOR="#FFFFFF" CELLPADDING="0" CELLSPACING="0" BORDER="1" BORDERCOLOR="#000000"><TR><TD>
<TABLE><TR><TD align=center BGCOLOR=#FFFF99><IMG SRC="../images/icons/html.gif"></TD><TD align=center><B>CO-BROKE &amp; LANDLORD LISTINGS MENU</B></TD></TD><TD><img border="0" src="../assets/images/cobroke.jpg" HEIGHT="40" WIDTH="64"></TD></TR></TABLE></TD></TR></TABLE>
<P>
<TABLE WIDTH=600><TR><TD>
<NOBR><li><a href="<?php echo "$PHP_SELF?op=cobroke-bosapts";?>">Co-Broke &amp; Landlord Listings From Other BostonApartments.com Agencies</a></li></NOBR>


<?php
if ($rowGetGroup->COBROKE_PW != "") {
?>
<NOBR><li><A HREF="https://www.BostonApartments.com/cobrokes.php?cli=<?php echo $grid;?>&amp;p=<?php echo $rowGetGroup->COBROKE_PW;?>" target="_NEW"><?php echo $group;?> Current Co-Broke Listings</a></li></NOBR>

<?php } else echo "<BR><P>Have your company admin set up your co-broke password<BR>and you will see a link to your co-brokes listings<BR> instead of this message.<BR><P>"; ?>




<?php
if ($isAdmin) {
?>
<BR>
<NOBR><li><a href="<?php echo "$PHP_SELF?op=cobroke";?>"><?php echo "$group";?> Co-Broke Preferences</a></li></NOBR>

<?php } ?>

<FONT SIZE="-1"

</TD></TR></TABLE>
<P>
<BR>
