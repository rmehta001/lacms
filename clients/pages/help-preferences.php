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
<div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor;?>;padding:15px;margin:10px;width:1200px;height:540px;">
<CENTER>
<TABLE style="text-align:center"  WIDTH="500"><TR>
        <TD><B style="color:#1296db;font-size:30px;">HELP WITH PREFERENCES</B></TD></TR>
</TABLE>
</CENTER>
    <BR>
    <ul>
<li>This function stores an Agents preferences and personal information for the Meet The Agents Page, Signatures for generated email and other similar uses.<BR>
<P>
<li>Default number of ads/listings to display on page is the number of ads or listings used to paginate long lists of results. You may change that number on any screen for a temporary change and always select "show all ads" or "show all listings" and have all the results in one long list.<BR>
<P>
<li>Personal Signature is what an agent who creates an ad can optionally display in the body of each ad.<BR>
<P>
<li>Default View for editing and composing Ads and Listings. Here you can choose the simple "Ad" view" of a listing or the "Listing" view of the listing as a default preference when Compose or Edit is clicked for a listing.<BR>
<P>
<li>In the personal information section, the email address and personal website should not have html in it and should just be the clean addresses. The database will convert the email and website to clickable links on the output pages, emails, etc.
<P>
<li>The Bio section is for display in the meet the agents output page.<BR>
<P>
<li>Craigslist Preferences is where the agent may enter phone and email addresses that correspond to their own Craigslist account along with custom agent templates for Craigslist.<BR>
<P>
<li>Upload Agent Picture function is for the "Meet the Agents" function. Each agent may upload a picture by clicking the browse button and then selecting the photograph. After selection, clicking the "Upload / Update Agent Picture" button will upload the picture. You do not have to delete the picture to upload a replacement photograph. Upon uploading the photograph, you will arrive at a page that will show it is two different sizes. Select the size you want and click save.<BR>

<P>
    </UL>    
<BR>

<CENTER>
<B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR>
</CENTER>
<P>

</DIV>
</TD></TR></TABLE>
</CENTER>




