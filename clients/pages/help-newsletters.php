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
<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor;?>;padding:15px;margin:10px;width:1200px;height:350px;">
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
        <TD><B style="color:#1296db;font-size:30px;">HELP WITH NEWSLETTERS</B></TD></TR>
</TABLE>
</CENTER>
    <BR>
    <UL>
<li>The Newsletter function is designed to to save newsletters and send them out.<BR>
<P>
<li>Recipients may unsubscribe from the newsletters themselves.<BR>
    <p>    
<li>You may have newsletters catered to Clients, Landlords and both. When you select send on a newsletter, it will go out to any recipient that has "Newsletter Subcribed" checked in their details sheet.<BR>
<P>
<li>You can create, edit, send and delete a newsletter from the "Show Newsletters" option.
<P>
<li>The Admin for the agency can view and send all Newsletters.<BR>
    <p>
<li>An Agent can only see and send their own newsletters to their own clients or any landlord.<BR>
    </UL>
<P>
<CENTER><B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B></CENTER><BR>
<P>
</DIV>
</TD></TR></TABLE>
</CENTER>