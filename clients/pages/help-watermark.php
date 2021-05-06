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
        <TD><B style="color:#1296db;font-size:30px;">HELP WITH WATERMARK</B></TD></TR>
</TABLE>
</CENTER>
<BR>
<ul>
<li>The Watermark function is designed to put your company name or some other identifiable mark on a photograph to protect it from theft and to brand your photographs.<BR>
<P>
<li>In the Admin menu under Watermark Settings for Photos you can enter a custom watermark. A link to the watermark preferences is also located next to the watermark checkbox on the "Manage Pictures" upload picture section.<BR>
<P>
<li>When uploading a photo to a listing, if the Watermark box is checked, the pictures will be watermarked upon upload.<BR>
<P>
<li>If you did not watermark your pictures when you uploaded them, you can watermark them by clicking "watermark" below the thumbnail of the picture you want to watermark.<BR>
<P>
<li>There may be times that you may want to wait to watermark a picture until after upload. For example, uploading a picture that need rotating.<BR>
<P>
<FONT COLOR=RED>Once a picture is watermarked, the watermark cannot be removed</FONT>.
<P>
<li>You may also set the default settings to watermark on upload. This setting is found under Watermark preferences. If set to yes, there's no need to check the box to watermark the pictures. Default is no.<BR>
<P>
<CENTER>    
<B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR>
</CENTER>
<P>
    </ul>    
</DIV>
</TD></TR></TABLE>
</CENTER>