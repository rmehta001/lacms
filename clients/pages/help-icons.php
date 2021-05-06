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
<TABLE BGCOLOR="#FFFFFF" WIDTH="620" CELLPADDING=5><TR><TD>
<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor;?>;padding:15px;margin:10px;width:1200px;height:3160px;">
<CENTER>
<TABLE style="text-align:center" WIDTH="500"><TR>
        <TD><B style="color:#1296db;font-size:30px;">HELP WITH ICONS</B></TD></TR>
</TABLE>
</CENTER>
    <BR><CENTER>
        <B style="color:#1296db;font-size:20px;"> The following is a list of icons found in the system and their definitions:</B></CENTER><BR>

<table style="background-color:<?php echo $pagebgcolor;?>; text-align:left" class="table table-borderless" WIDTH="1000" CELLPADDING=0>
  <tr>
    <th>Icon</th>
    <th>Icon Name</th>
    <th>Icon Description</th>
  </tr>
  <tr>
    <td><img src="../assets/images/compose.jpg" HEIGHT=30 width=30></td>
    <td><B>Compose</B></td>
    <td>Clicking it will put you in the compose page for a new ad/listing</td>
  </tr>
  <tr>
    <td><img border=0 src="../images/icons/edit.gif" alt="edit"></td>
    <td><B>Edit</B></td>
    <td>Clicking it will put you in the edit mode of what is selected such as a Client, Listing or Deal Sheet</td>
  </tr>
  <tr>
    <td><img border=0 src="../images/edit-new-listing-ll.gif" alt="edit"></td>
    <td><B>Create a New Listing with a Pre-selected Landlord</B></td>
    <td>You will find this on the Manage Landlords page and within a Landlord's Details page. Clicking it will put you in the edit mode of a new listing with that landlord pre-selected</td>
  </tr>
    <tr>
    <td><img border=0 src="../images/icons/delete.gif" alt="delete"></td>
    <td><B>Delete From the System</B></td>
    <td>Clicking it will <FONT COLOR=red>DELETE</FONT> what is selected such as a Client, Listing or Deal Sheet <FONT COLOR=red>from the database completely</FONT> including any pictures associated with it if it is a listing.</FONT></td>
  </tr>
   <tr>
    <td><img border=0 src="../assets/images/icons/hotlist-del.gif" alt="delete from hot list"></td>
    <td><B>Delete from the Hot List</B></td>
    <td>Clicking it on the Hot list Page will remove what is selected such as a Client, Listing or Deal Sheet from the Hot List page and leave the Listing, Client or Deal Sheet intact in the database</td>
  </tr>
  <tr>
    <td><img border=0 src="../assets/images/hot.gif" alt="add to hot list"></td>
    <td><B>Add to the Hot List</B></td>
    <td>Clicking it will add to the Hot list Page what is selected such as a Client, Listing or Deal Sheet from the Hot List page</td>
  </tr>

  <tr>
    <td><img border="0" hspace="0" vspace="0" width="19" height="19" src="../images/clock.gif" TITLE="Make an Appointment" ALT="Make an Appointment"></td>
    <td><B>Make an Appointment</B></td>
    <td>Clicking it on Manage Clients will bring you to the Appointment Schedule screen portion for that client. All appointments in the future show up in the calendar sync</td>
  </tr>

  <tr>
    <td><img border="0" hspace="0" vspace="0" width="19" height="19" src="../images/clock_delete.gif" TITLE="Delete Reminder" ALT="Delete A Reminder"></td>
    <td><B>Deletes a Reminder</B></td>
    <td> Clicking it on the Hot List will remove a reminder from the system and from the calendar sync</td>
  </tr>

  <tr>
    <td><?php echo  "<a href=\"$PHP_SELF?op=agentreport\"><IMG SRC=\"../assets/images/agentreport-lg.gif\" TITLE=\"Agent  Report\" ALT=\"Agent Report\" BORDER=\"0\">"; ?></A></td>
    <td><B>Agent Activity Report</B></td>
    <td> Clicking it on the Hot list Page will show the Agent Activity Report for the user that is logged in. If the Admin clicks the icon on the Manage Agents page, it will give the Agent Activity Report for the associated agent account. <font size="-1"><I>(Clicking it <?php echo  "<a href=\"$PHP_SELF?op=agentreport\">";?>here</A> will show you your Agent Activity Report.)</I></FONT></td>
  </tr>

   <tr>
    <td><img border='0' vspace='0' hspace='0' src='../assets/images/act.gif'></td>
    <td><B>Activated Ad</B></td>
    <td>Shows that the ad/listing is activated. Clicking it will Deactivate the ad/listing so it will be removed from the ads on BostonApartments.com</td>
  </tr>

   <tr>
    <td><img border='0' vspace='0' hspace='0' src='../assets/images/inact.jpg'></td>
    <td><B>Deactivated Ad</B></td>
    <td>Shows that the ad/listing is deactivated. Clicking it will Activate the ad/listing to appear on BostonApartments.com</td>
  </tr>

   <tr>
    <td><img src="../assets/images/icons/a.jpg" border=0></td>
    <td><B>Available Listing</B></td>
    <td>Shows that the ad/listing is Available. Clicking it will change the status to Unavailable</td>
  </tr>
  
   <tr>
    <td><img src="../assets/images/icons/u.jpg" border=0></td>
    <td><B>Unavailable Listing</B></td>
    <td>Shows that the ad/listing is Unavailable. Clicking it will change the status to Available</td>
  </tr>

   <tr>
    <td><img src="../assets/images/icons/vacant.jpg" border=0></td>
    <td><B>Vacant Unit</B></td>
    <td>Shows that the unit is Vacant. Clicking it will change the status to Occupied</td>
  </tr>

   <tr>
    <td><img src="../assets/images/icons/occupied.jpg" border=0></td>
    <td><B>Occupied Unit</B></td>
    <td>Shows that the unit is Occupied. Clicking it will change the status to Vacant</td>
  </tr>
  
  <tr>
    <td><img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="16" WIDTH="16" alt="Pending Status - Yes" title="Pending Status - YES - Check Status"></td>
    <td><B>Pending Listing</B></td>
    <td>Used for marking listings that have paperwork pending (e.g. applications, Offers to Purchase)</td>
  </tr>
  
   <tr>
    <td><img src="../assets/images/icons/pending-no.gif" border=0 HEIGHT="16" WIDTH="16" alt="Pending Status - Nothing Pending" title="Pending Status - Nothing Pending"></td>
    <td><B>Listing with Nothing Pending </B></td>
    <td>Used for marking listings that have no paperwork pending</td>
  </tr>
  
   <tr>
    <td><img src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22></td>
    <td><B>Email</B></td>
    <td>Depending on what page you are on, clicking the icon will pre-address and fill out pertinent information in an email. Email from this system does not require access to an email program or a mail server</td>
  </tr>
  
   <tr>
    <td><img src="../assets/images/simple.gif" vspace="0" hspace="0" border="0" height="18" width="18"></td>
    <td><B>Simple View of the Listing</B></td>
    <td>(a.k.a. Ad View) - Clicking the icon brings the the simple view of the listing vs. the full ad view of the listing. Found in the tabular menu when editing or creating a listing</td>
  </tr>
  
  <tr>
    <td><img src="../assets/images/full.gif" vspace="0" hspace="0" border="0" height="18" width="18"></td>
    <td><B>Full View of the Listing</B></td>
    <td>(a.k.a. Listing View) Clicking the icon brings the the full view of the listing vs. the simple ad view of the listing. Found in the tabular menu when editing or creating a listing</td>
  </tr>
  
  <tr>
    <td><img src="../assets/images/doc.gif" vspace="0" hspace="0" border="0" height="18" width="18"></td>
    <td><B>Client Show Sheet without Pictures</B></td>
    <td>Clicking the icon will pop open a new window with the Client Show Sheet without pictures</td>
  </tr>
  
  <tr>
    <td><img src="../assets/images/doc-pic.gif" vspace="0" hspace="0" border="0" height="18" width="18"></td>
    <td><B>Client Show Sheet with Pictures</B></td>
    <td>Clicking the icon will pop open a new window with the Agent Show Sheet or Client Show Sheet with pictures</td>
  </tr>
  
  <tr>
    <td><img src="../assets/images/agent-ss.gif" vspace="0" hspace="0" border="0" height="18" width="18"></td>
    <td><B>Agent Show Sheet without Pictures</B></td>
    <td>Clicking the icon will pop open a new window with the Agent Show Sheet without pictures</td>
  </tr>
  
  <tr>
    <td><img src="../assets/images/agent-ss-pic.gif" vspace="0" hspace="0" border="0" height="18" width="18"></td>
    <td><B>Agent Show Sheet with Pictures</B></td>
    <td>Clicking the icon will pop open a new window with the Agent Show Sheet with pictures</td>
  </tr>
  
  <tr>
    <td><img width="16" height="16" border="0" vspace="0" hspace="0" src="../assets/images/upload.jpeg"></td>
    <td><B>Upload a Picture</B></td>
    <td>Clicking this icon will put you in the manage pictures section of the corresponding listing</td>
  </tr>
  
  <tr>
    <td><img src="../images/pic.gif" alt="view and edit photos" border=0></td>
    <td><B>Pictures</B></td>
    <td>Clicking the camera icon will put you in the photos section of the corresponding listing. In the listings mode, if the camera shows on a listing, then the listing contains pictures and clicking it will put you in the Manage Photos Page for that listing. If there are no pictures for that listing then "add pic" is displayed where the camera icon would appear.<BR>
Clicking the camera icon within the body of the advertisement will open the display ad of the listing with pictures as the public would see it</td>
  </tr>
  
  <tr>
    <td><img border="0" src="../assets/images/pic-gallery.jpeg" HEIGHT="30" WIDTH="35" align="left"></td>
    <td><B>Building Photo Gallery</B></td>
    <td>Click on Photos in any listing (or the camera to Manage Photos) and click the Building Photo Gallery to see all the photos (by unit) that your office has on line for the building the listing is associated. You can edit a whole building's unit's pictures from this one page. The option appears when at least 1 listing for a unit in a building has at least one picture</td>
  </tr>
  
  <tr>
    <td><img border="0" hspace="0" vspace="0" src="../assets/images/buildings.jpg"></td>
    <td><B>Buildings Icon</B></td>
    <td>Found on the Manage Landlords Page and on the Simple and Full view of a listing in the top landlord's information area next to the "All this Landlord's Listings" Button. Clicking the icon brings you to a page that lists each building address a landlord has a listing. You may click to see all the listings in that building in an editable view; or you may click to make global changes to information at ALL listings for that landlord at that particular building</td>
  </tr>
  
  <tr>
    <td><img border="0" hspace="0" vspace="0" src="../assets/images/global.jpeg"></td>
    <td><B>Global Icon</B></td>
    <td>Found on the Manage Landlords Page, Edit View Landlord Page, Buildings Page and other associated pages. Clicking the icon brings you to a page that lists every aspect of a listing.  You may make GLOBAL changes to EVERY LISTING at EVERY BUILDING for that Landlord</td>
  </tr>
  
  <tr>
    <td><img border="0" src="../assets/images/showings.jpg" alt="edit" vspace="0" hspace="0" HEIGHT="16" WIDTH="16" TITLE="Create A Showing"></td>
    <td><B>Create a Showing</B></td>
    <td>Click it to create a showing for the listing & client</td>
  </tr>
  
  <tr>
    <td><img border="0" src="../assets/images/showings-history.jpg" alt="edit" vspace="0" hspace="0" HEIGHT="16" WIDTH="16" TITLE="Showing History"></td>
    <td><B>Showing History</B></td>
    <td>Click it to display the showing history for a unit or client</td>
  </tr>
  
  <tr>
    <td><img SRC="../assets/images/openhouse.jpg" height="16" WIDTH="16" BORDER="0"></td>
    <td><B>Create an Open House</B></td>
    <td>Found on the Ads, Listings, Compose/Edit a listing. Clicking the icon will put you in page that creates an open house listing</td>
  </tr>
  
  <tr>
    <td><img border="0" hspace="0" vspace="0" height="12" src="../assets/images/icons/electric.jpeg"></td>
    <td><B>Set up Utilities</B></td>
    <td>Found on the Manage Clients Page. Clicking the icon will put you in page that has links for U.S. Mail change of Address, Cable, Telephone and other utilities</td>
  </tr>
  
  <tr>
    <td><img border="0" hspace="0" vspace="0" width="19" height="19" src="../assets/images/matchlistings.gif" TITLE="Match Client to Listings" ALT="Match Client to Listings"></td>
    <td><B>Match Clients to Listings</B></td>
    <td>Found on Manage Clients. When clicked will search your listings and the result will be listings that matching your client's requirements</td>
  </tr>
  
  <tr>
    <td><img border="0" hspace="0" vspace="0" width="19" height="19" src="../assets/images/client-reassign.gif" TITLE="Reassign Client" ALT="Reassign Client"></td>
    <td><B>Reassign Client</B></td>
    <td>Found on Manage Clients and Edit/View Client. When clicked will allow the transfer of a client from one agent to another</td>
  </tr>
  
  <tr>
    <td><img border="0" hspace="0" vspace="0" width="19" height="19" src="../assets/images/client-active.jpg" TITLE="Active Client" ALT="Active Client"></td>
    <td><B>Active Client</B></td>
    <td>Found on Manage Clients and Edit/View Client. Shows the Status of the client to be active and when clicked will toggle the client status to inactive</td>
  </tr>
  
  <tr>
    <td><img border="0" hspace="0" vspace="0" width="19" height="19" src="../assets/images/client-inactive.jpg" TITLE="Inactive Client" ALT="Inactive Client"></td>
    <td><B>Inactive Client</B></td>
    <td>Found on Manage Clients and Edit/View Client. Shows the Status of the client to be inactive and when clicked will toggle the client status to active</td>
  </tr>
  
  <tr>
    <td><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/cl.gif"></td>
    <td><B>Post to Craigslist</B></td>
    <td>When clicked will fill out the appropriate Craigslist submission form for the corresponding listing. You should be logged into Craigslist in another window or tab when using this option for better performance with email address field fill-ins, etc</td>
  </tr>
   
   <tr>
    <td><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/dig_new.gif"></td>
    <td><B>Post to Backpage.com / The Dig</B></td>
    <td>When clicked will fill out the appropriate Backpage.com/The Dig submission form for the corresponding listing. You should be logged into your Backpage/The Dig account in another window or tab when using this option for better performance with email address field fill-ins, etc</td>
  </tr>
  
   <tr>
    <td><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/kijiji_new.gif"></td>
    <td><B>Post to Kijiji.com</B></td>
    <td>When clicked will fill out the appropriate Backpage.com/The Dig submission form for the corresponding listing. If you are not logged into a Kijiji account when you post, a confirmation email will be sent to the email used in the form. If you are logged into your Kijiji.com account in another window or tab when using this option the confirmation email step is avoided</td>
  </tr>
  
   <tr>
    <td><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/myspace_new.gif"></td>
    <td><B>Post to MySpace.com</B></td>
    <td>When clicked will fill out the appropriate MySpace.com submission form with a default of a blog post. You may change it to a "bulletin post" or any other type of post you want. If you are not logged into a MySpace account when you post, you will need to log in on the form that is autofilled by the BostonApartments.com database</td>
  </tr>

</table>

<P>

<CENTER><B><FONT SIZE="+1" COLOR="darkblue">Holding your mouse over an icon while using<BR>the system will display help on that item as well.</FONT></B></CENTER><BR>

<BR>
<CENTER>
<B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR>
</CENTER>
<BR>
</DIV>
</TD></TR></TABLE>
</CENTER>