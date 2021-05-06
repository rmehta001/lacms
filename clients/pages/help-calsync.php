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

<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor;?>;padding:15px;margin:10px;width:1200px;height:500px;">
<CENTER>
<TABLE style="text-align:center" WIDTH="700"><TR>
        <TD><B style="color:#1296db;font-size:30px;">HOW TO SYNC YOUR APPOINTMENTS WITH OUTLOOK, GOOGLE, IPHONE AND MORE</B></TD></TR>
</TABLE>
</CENTER>
<BR>
    <ul>
<li>To sync your appointments, different calendars, applications, and the like require a calendar file or feed location.<BR>
<P>
<li>There is a standard internet calendar format that enables users to create and share electronic calendars across different computers and different programs.<BR>
<P>

<li><B>Your Calendar feed is:</B> <NOBR><A HREF="https://www.BostonApartments.com/calsync.php?cli=<?php echo $grid; ?>&uid=<?php echo $uid; ?>" target="ical">https://www.BostonApartments.com/calsync.php?cli=<?php echo $grid; ?>&uid=<?php echo $uid; ?></A></NOBR><BR>
<P>
<li><B>For directions to sync appointments with Outlook:</B><BR>
<P>
<A HREF="http://office.microsoft.com/en-us/outlook/HA101673251033.aspx#2" target="_ms">http://office.microsoft.com/en-us/outlook/HA101673251033.aspx#2</A>
<P>
<li><B>For directions to sync appointments with the IPhone:</B><BR>
<P>
<A HREF="http://www.apple.com/findouthow/mac/#subscribeical" target="_ms">http://www.apple.com/findouthow/mac/#subscribeical</A>
<P>
<li><B>For directions to sync appointments with Google:</B><BR>
<P>
<A HREF="http://www.google.com/support/calendar/bin/answer.py?hl=en&answer=37100" target="_ms">http://www.google.com/support/calendar/bin/answer.py?hl=en&answer=37100</A><BR>
<li>When you click the link for the calendar feed address, it will as you if it should open or save the file.  Save the file.
In Google Calendar, under Other Calendars on the left sidebar, click Add, then choose "import calendar" and not by URL, choose the file you just saved and voila all the valid appointments are imported to your main calendar.<BR>
<P>
</ul>
    <BR>
    <CENTER>    
<P>
<B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR>
<P>
    </CENTER>
    </div>
</TD></TR></TABLE>
</CENTER>