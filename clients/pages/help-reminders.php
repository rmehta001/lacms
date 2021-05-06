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

<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor;?>;padding:15px;margin:10px;width:1200px;height:730px;">
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
        <TD><B style="color:#1296db;font-size:30px;">HELP WITH EMAIL REMINDERS</B></TD></TR>
</TABLE>
</CENTER>
<BR>
<ul>
<Li>The purpose of this function is to send an email reminder to any email address you have with a message to remind you of an upcoming or perpetual event. Besides using it to remind you about appointments, feel free to use this part of the service to send you a reminder in advance for any personal purpose as well.<BR>
    <p>
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
    <TD><B style="color:#1296db;font-size:25px;">How do I set-up my Email Address?</B></TD></TR>
</TABLE>
</CENTER>
<BR>
<li>The first time you use the E-reminder function, simply enter your E-mail address, leave everything else blank, and select "Save." You will get a generated password in your mail within about 5 minutes, and you can use that password from that point on, or change the password to whatever you'd like to use to send messages to your address.<BR>
<P>
    <BR>
<FONT COLOR=RED><B>NOTE: Passwords are case sensitive.</B><BR>
The E-reminder passwords are different from your database login password.</FONT><BR>
<P>
<li>The validation process is so this function can not be used as a spam generator.</FONT>
    <BR>
    <p>
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
    <TD><B style="color:#1296db;font-size:25px;">How do I use this?</B></TD></TR>
</TABLE>
</CENTER>
<BR>
<li>Simply pick the date, time and timezone for your reminder, enter an E-mail
address and password, then enter the event name and message you'd like
to get. If the date and time you enter is before the today's date and time,
a reminder will be sent out (almost) immediately.

<br>&nbsp;

<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
    <TD><B style="color:#1296db;font-size:25px;">What do the advanced option mean?</B></TD></TR>
</TABLE>
</CENTER>

<p> 
<li>Well, sometimes you don't want to just get one reminder. What if you have
to remind yourself about a birthday once a year? To do that, you would
set the reminder to recur every 1 year.
 
<p><li>What if you want to be reminded 2 days in advance about this birthday? 
    You could set advance notice of two days to allow this. <br><p>
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
    <TD><B style="color:#1296db;font-size:25px;">Anything else I should know?</B></TD></TR>
</TABLE>
</CENTER>
<p>
<li>You can change your password and list pending reminders via the "Account
Options" page off of the initial reminder page.

<BR>
<P><BR>
<P>

<CENTER>
<B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR>
</CENTER>
<P>





</UL>
</div>
</TD></TR></TABLE>
</CENTER>




