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
        <TD><B style="color:#1296db;font-size:30px;">HELP WITH LANDLORDS</B></TD></TR>
</TABLE>
</CENTER>
<BR>
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
    <TD><B style="color:#1296db;font-size:25px;">Manage Landlords</B></TD></TR>
</TABLE>
</CENTER>
<BR>
<ul>
<li>The Landlords function is designed to keep your landlord information in an organized fashion that allows you to:<BR>
    <p>
<ul>
    1. See all listings for a particular landlord.<BR>
    2. Keep in touch with emails and mass emails to all your landlords.<BR>
    3.and coming soon... auto fill of forms, leases, etc. when a listing turns into a deal sheet.<BR>
</UL>
    <BR>
<P>
<li>All landlords information is private to the agency. No other agency can see your landlord information.<BR>
<P>
<li>Clicking the <img border=0 src="../images/icons/edit.gif" alt="edit"> will put you in the edit mode of that Landlord.<BR>
<P>
<li>Clicking the <img border=0 src="../images/icons/delete.gif" alt="delete"> will remove the Landlord from the system. It is not recommended to delete a landlord unless you are not doing anymore business with that party and are deleting all their listings as well.<BR>
<P>
<li>When you click on Landlords in the top menu, you go to the Manage Landlords Page. Here you can do a search to narrow the display of the list of landlords on that page. Names, emails, phone numbers are partial match searches. The Phone number search looks at all the phone numbers including the fax for a match. It will also search the "Additional Comments" box for additional telephone numbers that may be stored. Email will search all email fields as well as the "Addicitonal Comments" box.<BR>
<P>
<li>All column titles are clickable and will sort the clients based on the title of the column.<BR>
<P>
<li>To create a new landlord you click the <img border="0" hspace="0" vspace="0" width="89" height="22" src="../assets/images/newLandlord.jpg"> icon.<BR>
<P>
<li>If you click listings button link on each landlord row, it will put you in the Listings mode where the listings that will show are those of that particular landlord.<BR>
</ul>

<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
    <TD><B style="color:#1296db;font-size:25px;">Edit/Create Landlords</B></TD></TR>
</TABLE>
</CENTER>
<BR>
<ul>
<li>Clicking the <img border="0" hspace="0" vspace="0" width="89" height="22" src="../assets/images/newLandlord.jpg"> or the <img border=0 src="../images/icons/edit.gif" alt="edit"> next to a landlord will put you in a screen where you can save the landlord information.<BR>
<P>
<li>When editing or creating the landlord is complete, clicking the <input type="submit" value="Save" STYLE="Background-Color : #A9F5A9"> button will return you to the Manage Landlords Page.<BR>
</UL>
    <P>
<BR>
<CENTER>
<B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR>
</CENTER>
<P>






    </div>
</TD></TR></TABLE>
</CENTER>




