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
        <TD><B style="color:#1296db;font-size:30px;">HELP WITH PASSWORDS</B></TD></TR>
</TABLE>
</CENTER>
    <BR>
    <UL>    
<li>The Password function allows you to change your password.<BR>
<P>

<li>Passwords are a minimum of 4 characters, maximum of 10, using only a-z, A-Z, 0-9 and no spaces.<BR>
<P>
<li>Passwords are case-sensitive.<BR>
<P>


<li>To change a password, you type in the old password in the appropriate box and the new password in the "New Password" and the "Retype New Password" box to make sure you have the new password correctly entered into the system.<BR>
<P>
<li>When finished, click the <style type="text/css">
.funkybutton { background-color: #ffcccc; font-size: 120%;
                     font-weight: bold; }
</style>
<input type="submit" value="Change Password" class="funkybutton" STYLE="Background-Color : #A9F5A9"/> to save your password change.<BR>
<P>
<li>If you forget your password and you have your email entered in the system under Preferences, you can retrieve your password by going to https://www.BostonApartments.com  (the front page) and at the bottom (next to Agent Login) click "Forgotten Password". Enter the email registered to that account and an email with the password will be emailed to that address.<BR>
    <P></UL><BR>



<CENTER><B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR></CENTER>






</DIV>
</TD></TR></TABLE>
</CENTER>




