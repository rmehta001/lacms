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

<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor;?>;padding:15px;margin:10px;width:1200px;height:750px;">
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
        <TD><B style="color:#1296db;font-size:30px;">HELP WITH CO-BROKES</B></TD></TR>
</TABLE>
</CENTER>
<BR>
<ul>
<li>The Co-Broke function is designed so you can have distribution lists of co-brokes, broker listings from management companies and landlords distributed privately through your website or shared with the other agencies that use BostonApartments.com. You can use the url for emailing up-to-date co-brokes to your mailing list to other brokers too!<BR>
<P>
<li>In order to use the Co-Broker feature the Admin of the Agency must log in and under the Admin menu  click Co-Broke Preferences (or under Co-Brokes if you are logged in as Admin as well).<BR>
<P>
<li>Once a Co-Broke password is set up  (Passwords should be a minimum of 1 characters, maximum of 10, using only a-z, A-Z, 0-9 and no spaces.) the output screens will work for your company and Only listings marked as "Co-Broke this listing" (found on the simple form above Helpful Tools) and marked Available <img src="../assets/images/icons/a.jpg" border=0 height=14 width=14> will show on this list.<BR>
<P>

<CENTER><B>Example output url:</B><BR>
<P>
<A HREF="http://bostonapartments.com/cobrokes.php?cli=392&amp;p=1111" target="_NEW">http://bostonapartments.com/cobrokes.php?cli=392&amp;p=1111</A><BR>
<P>
( p=password | cli=your Group ID ). Your cli (a.k.a. Group ID) is <?php echo $grid;?><BR>
<P>
</CENTER><BR>
<li>Without a password and corresponding cli the output will not work and the data is secure. Setting the password to nothing/blank will disable the ability to show co-broke listings.<BR>
<P>
<li>Again Only listings marked as "Co-Broke this listing" AND marked Available <img src="../assets/images/icons/a.jpg" border=0 height=14 width=14> will show on this list. If you do not set a password, your listing information can not be seen by this new feature.<BR>
<P>
<li>You may choose a <B>sterilized</B> or <B>detailed</B> view for the list output.<BR>
<P>
<li>The sterilized view shows only information that normally show on a public advertisement.<BR>
    <p>
<li>If you use the sterilized view to protect the proprietary information of a listing, password protection to the results is not necessary if used on a website.<BR>
<P>
<li>The Detailed view will give out more information than the public should see and should only be used for exclusive listings you want to co-broke and let agents see details like keys, tenants, full address. Access should only be made accessible to licensed real estate agents. It is suggested that the page should be behind some sort of password protection if used on your website. You may also use a custom template with your co-broke list.<BR>
<P>
<li>If you choose to Co-Broke a listing with BostonApartments.com, the information displayed is governed by the co-broke view selected by the Admin on the Co-Broke Preferences Menu<BR>
<P>
</UL>    
<BR>

<CENTER>
<B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR>
</CENTER>
<P>
</DIV>
</TD></TR></TABLE>
</CENTER>