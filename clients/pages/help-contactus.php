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

<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor;?>;padding:15px;margin:10px;width:800px;height:300px;">
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
        <TD><B style="color:#1296db;font-size:30px;">CONTACT US FOR HELP</B></TD></TR>
</TABLE>
</CENTER>
<BR>

<ul>
<li>The Help function is designed to give aid on using pretty much all aspects of the BostonApartments.com database system. Due to the tremendous amount of features, this can become overwhelming.<BR>
<P>
<li>Please feel free <B><A HREF="mailto:Webmaster@BostonApartments.com">email Webmaster@BostonApartments.com</A></B> or <B>call (617) 254-5501</B> anytime for tech support or for suggestions to make the system even better!<BR>
    </ul>
    <P>
<BR>

<CENTER>
<B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR>
</CENTER>
</DIV>
</TD></TR></TABLE>
</CENTER>




