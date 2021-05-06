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

<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor;?>;padding:15px;margin:10px;width:1200px;height:850px;">
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
        <TD><B style="color:#1296db;font-size:30px;">HELP WITH CLIENTS</B></TD></TR>
</TABLE>
</CENTER>
<BR>
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
    <TD><B style="color:#1296db;font-size:25px;">Manage Clients</B></TD></TR>
</TABLE>
</CENTER>
<BR>

<UL>
<li>The Clients function is designed to keep your client information in an organized fashion that allows you to:<BR>
<P>  
<UL>    
    1. Match your clients to available listings.<BR>
    2. Keep in touch with emails and mass emails to all your clients.<BR>
    3. Track deposits and paperwork for deals in the deal sheets.<BR>
    4. and coming soon... auto fill of forms, leases, etc. when a client turns into a tenant in a deal sheet.<BR>
</UL>
</LI>
<P>
<li>Clients are private to the agent unless marked public. If marked public, any agent in the company can see that client. The admin account can see all clients from all agents in a company account. No other company can see any client.<BR>
<P>
<li>Clicking the <img border=0 src="../images/icons/edit.gif" alt="edit"> will put you in the edit mode of that Client.<BR>
<P>
<li>Clicking the <img border=0 src="../images/icons/delete.gif" alt="delete"> will remove the Client from the system. It is not recommended if you are using the deal sheets. You can mark a client Active or Inactive so there is no need to delete any clients. This allows for future communications as well.<BR>
<P>
<li>When you click on Clients in the top menu, you go to the Manage Clients Page. Here you can do a search to narrow the display of the list of clients on that page. Names, emails, phone numbers are partial match searches. The Phone number search looks at all the phone numbers including the fax for a match.<BR>
<P>
<li>You may also set up clients utilities and change of address forms from the Manage Clients Page.<BR>
<P>
<li>All column titles are clickable and will sort the clients based on the title of the column.<BR>
<P>
<li>To create a new client you click the <img border="0" hspace="0" vspace="0" width="72" height="22" src="../assets/images/newClient.jpg"> icon.<BR>
<P>
<li>If you click Match listings link on each client row, it will put you in the Listings mode where the listings that will show are those that match the criteria you have put into the clients file and that are marked available.<BR>
<P>
</ul>
<BR>    
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
    <TD><B style="color:#1296db;font-size:25px;">Edit/Create Clients</B></TD></TR>
</TABLE>
</CENTER>
<BR>
<ul>
<li>Clicking the <img border="0" hspace="0" vspace="0" width="72" height="22" src="../assets/images/newClient.jpg"> or the <img border=0 src="../images/icons/edit.gif" alt="edit"> next to a client will put you in a screen where you can save client information. You may pick multiple items in pick list such as location and number of bedrooms.<BR>
<P>
<li>When creating a new client, the status is automatically set to active. It may be changed to inactive in the edit client mode.<BR>
<P>
<li>When editing or creating the client is complete, clicking the <input type="submit" value="Save" STYLE="Background-Color : #A9F5A9"> button will return you to the Manage Clients Page.<BR>
<P>
</UL>    
<BR>
<CENTER>
<B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR>
</CENTER>
<P>






    </div>
</TD></TR></TABLE>
</CENTER>




