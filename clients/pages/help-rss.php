<?php
  $PHP_SELF = $_SERVER['PHP_SELF']; 
if ($_SESSION['pref_pagebg']=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor=$_SESSION['pref_pagebg'];
}
$pagebgcolor="#e2effa";
?>
<CENTER>
<TABLE BGCOLOR="#FFFFFF" WIDTH="600" CELLPADDING=8><TR><TD>
<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor;?>;padding:15px;margin:10px;width:1200px;height:330px;">
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
        <TD><B style="color:#1296db;font-size:30px;">HELP WITH RSS FEED</B></TD></TR>
</TABLE>
</CENTER>
    <BR>
<ul>
<li>Do you need an <B>RSS Feed</B> of your listings? The address of your <B>Agency RSS Feed</B> is:<BR>
<U><A HREF="https://www.BostonApartments.com/cli.php?htype=xml-google&template=xml-google&type=1&cli=<?php echo $grid;?>" target="_RSS">https://www.BostonApartments.com/cli.php?htype=xml-google&template=xml-google&type=1&cli=<?php echo $grid;?></A></U><BR><P>

<li>Change the Type=2 for sales, Type=3 for commercial sales, etc.<BR>
<P>
<li>If you want to show Available listings vs. Advertised, you add: " &STATUS=avail " <BR>
eg: <U><A HREF="https://www.BostonApartments.com/cli.php?htype=xml-google&template=xml-google&type=1&cli=<?php echo $grid;?>&STATUS=avail" target="_RSS">https://www.BostonApartments.com/cli.php?htype=xml-google&template=xml-google&type=1&cli=<?php echo $grid;?>&STATUS=avail</A></U><BR>


<P>
<li><B>Agent Ad RSS Feeds</B> are created by adding &uid=<?php echo $uid; ?><BR>
eg: <U><A HREF="https://www.BostonApartments.com/cli.php?htype=xml-google&template=xml-google&type=1&cli=<?php echo $grid;?>&uid=<?php echo $uid; ?>" target="_RSS">https://www.BostonApartments.com/cli.php?htype=xml-google&template=xml-google&type=1&cli=<?php echo $grid;?>&uid=<?php echo $uid; ?></A></U><BR>
</UL>
<P>
<BR>
<CENTER>
<B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B>
</CENTER>
</div>
</TD></TR></TABLE>
</CENTER>
<BR>