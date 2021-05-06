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

<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor;?>;padding:15px;margin:10px;width:1200px;height:400px;">
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
        <TD><B style="color:#1296db;font-size:30px;">HELP WITH OPENHOUSES</B></TD></TR>
</TABLE>
</CENTER>
<BR>

    <ul>
<li>This function creates an Open House Listing on BostonApartments.com as well as the ability to generate them on any agency website as well. It makes maintaining an Open House Listing Page for your website a breeze. You may have a custom template for that page which may be entered in the "BostonApartments.com Templates" option on the Admin menu.<BR>
<P>
<li>The Admin may edit and agent Under the Admin menu -> Manage Agents and select whether an agent should appear on the page and in what order.<BR>
<P>
<li>To use the option on your website, a link needs to be added to your site:<NR>
<P>
https://www.BostonApartments.com/openhouse.php?cli=<?php echo $grid;?>
<P>
<li>For an sample output click:<BR>
<P>
<A HREF="https://www.BostonApartments.com/openhouse.php?cli=392" target="_NEW">https://www.BostonApartments.com/openhouse.php?cli=392</A><BR>
<P>
<li>To Add an Open Hosue Listing you can click "Create Open House" in the cyan colored where your find "copy | delete | email this listing ..."  You may also click on the top blue menu on Open Houses and click Add an Open House Listing.<BR>
<BR>
<BR>
</ul>
<CENTER>
<B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9"  href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR>
</CENTER>
<P>
    </div>
</TD></TR></TABLE>
</CENTER>




