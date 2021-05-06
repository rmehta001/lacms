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
<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor;?>;padding:15px;margin:10px;width:1200px;height:320px;">

<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
        <TD><B style="color:#1296db;font-size:30px;">HELP WITH HOTLIST</B></TD></TR>
</TABLE>
</CENTER>
<BR>
<ul>
<li>The Hot List function is designed to keep an agent's top Listings, Clients and Deal Sheets in an easy to find place with quick shortcuts to their details.<BR>
<P>
<LI>All Hot Lists are private to the agent that creates them.  If the checkbox to share this client is checked, the Hot List item is shared with all agents in the office.<BR>
<P>
<li>Clicking the <img border=0 src="../images/icons/edit.gif" alt="edit"> icon or the short cut name will put you in the edit mode of that Client, Listing or Deal Sheet selected.<BR>
<P>
<li>Clicking the <img border=0 src="../images/icons/delete.gif" alt="delete"> icon will remove the shortcut to the Client, Listing or Deal Sheet from the Hot List page. It will not delete the actual Client, Listing or Deal Sheet from the Database. <B>This is the only place that the delete function will leave the data intact in the database.</B><BR>
<P>
</UL>    
    <BR>
<CENTER>    
<B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR>
</CENTER>
</DIV>
</TD></TR></TABLE>
</CENTER>