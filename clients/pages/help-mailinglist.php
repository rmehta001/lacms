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

<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor;?>;padding:15px;margin:10px;width:1200px;height:450px;">
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
        <TD><B style="color:#1296db;font-size:30px;">HELP WITH MAILING LISTS, MAIL MERGE &amp; EMAILS</B></TD></TR>
</TABLE>
</CENTER>
<BR>
    
<ul>
<li>To make mailing labels for landlords or clients, go to the Admin menu, and take a .CSV backup of the landlords or clients. That file may be used for a mail merge in any word processing program to make customized letters as well as mailing labels.<BR>
<P>
<li>In Manage Landlords, you may email all the landlords at their office email, personal email or both. You can also individually email the landlords as well.<BR>
<P>
<li>In Manage Clients, you may email all the clients at once or email them individually by clicking the <IMG src=../assets/images/mail_listing.gif BORDER=0 HEIGHT=15 WIDTH=32> icon.<BR>
<P>
<li>You do not need access to your email account or an email server to send email to landlords and clients through the BostonApartments.com system.
<P>
<li>You may have email templates for Agents as well as the Company. If an agent has an email template, that will be used, if not the company's email header and footer will be used. If there is none entered for either, than none will be used.<BR>
<P>
<li>Signatures are generated by the information entered in the Preferences set by each agent.<BR>
<P>
<li>All may be edited before being sent except the nightly emails to clients that automatically match listings with clients.<BR>
</ul>
<BR>
<CENTER>
<B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR>
</CENTER>
<P>

    </div>
</TD></TR></TABLE>
</CENTER>




