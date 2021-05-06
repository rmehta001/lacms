<?php
$PHP_SELF = $_SERVER['PHP_SELF'];
if ($_SESSION['pref_pagebg'] == "") {
    $pagebgcolor = "#F5F5DC";
} else {
    $pagebgcolor = $_SESSION['pref_pagebg'];
}
$pagebgcolor = "#e2effa";
?>

<CENTER>
    <TABLE BGCOLOR="#FFFFFF" WIDTH="600" CELLPADDING=8><TR><TD>

                <div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:15px;background-color:<?php echo $pagebgcolor; ?>;padding:15px;margin:10px;width:1200px;height:1300px;">
                    <CENTER>
                        <TABLE style="text-align:center" WIDTH="500"><TR>
                                <TD><B style="color:#1296db;font-size:30px;">Help with Compose/Edit</B></TD></TR>
                        </TABLE>
                    </CENTER>
                    <BR>

                    <ul>
                        <li>When you enter the Compose / Edit Screen for a listing a secondary tab menu which has choices of:<BR>
                            <P>
                                <B>Ad</B> <img src="../assets/images/simple.gif" width="15" height="15">  | <B>Listing</B> <img src="../assets/images/full.gif" width="15" height="15"> | <B>Photos</B> | <B>Deal Sheets</B> | <B>Printouts</B><BR>
                            <P>
                        <li>You may flip through the variuos screens by clicking the menu tab.<BR>
                            <P>
                                <B>Ad</B> <img src="../assets/images/simple.gif" width="15" height="15"> is the basic, bare minimum needed to post an ad on BostonApartments.com.<BR>
                            <P>
                        <li> Pick the Type of ad you are creating (e.g. Rental, Sale, Commercial Rental, Parking Space, etc.)<BR>
                            <P>
                        <li> Choose from the pick lists the location, number of bedrooms, and whatever information you have to place in the ad.<BR>
                            <P>
                        <li> Since Massachusetts has many towns and cities, it can be hard to scroll up and down to find your city. One tip that can help you is to use shortcut keys. For example, if your city is Charlestown, after you bring up the city selection box, simply press on the C key on your keyboard, the first city starts with C will be highlighted, just press the C a few times until Charlestown is highlighted, then hit ENTER on your keyboard. Yeah!!! Your city is now selected. The more you use the system, your most commonly used locations float to the top of the list.<BR>

                            <P>
                        <li> Use the pick list for the availability date and DO NOT put the date within the body of the advertisement. When publishing to the public, the  system publishes any date in the past as "Available NOW" istead of having the ad look stale. Putting dates in the body of the ad makes editing the ad necessary to keep it up-to-date. Using the date function provided does all the work for you.<BR>
                            <P>
                        <li> You can spell check your ad after placing it in the box provided.<BR>
                            <P>
                        <li> If you want the personalized signature (created under preferences) to appear in the advertisement, select yes where it says "Display Personal Signature?:".<BR>
                            <P>

                        <li>  The Alternative Ad Body allows full HTML coding. If the Alternative Ad Body is filled, it will replace the regular line ad copy in those places where full HTML ads are allowed. (E.g. Googlebase.com does not allow HTML, but clicking for more details at BostonApartments.com does, as well as posting to Craigslist and the Dig/BackPage.com, the HTML Ad Maker, etc.)<BR>
                            <P>
                        <li>  The Agent Ad Body allows full HTML coding. If the Agent Ad Body is filled, it will replace the regular line ad copy in those places where full HTML ads are allowed. (E.g. Googlebase.com does not allow HTML, but clicking for more details at BostonApartments.com does, as well as posting to Craigslist and the Dig/BackPage.com, the HTML Ad Maker, etc.)<BR>
                            <P>
                        <li> When selecting a map link, the only way proprietary information will be disclosed to the public is if "FULL street Address" is selected. The map provided by Yahoo, Google or Mapquest would display the full address. A minimum of the zip code must be entered at the bottom of the ad view in order for a map link to work.<BR>
                            <P>
                        <li> If you have a virtual tour you may put the address of the tour and a link will appear in the ad.<BR>
                            <P>
                        <li>  If you have a Video at YouTube or a similar site, you may put the address of the video and a link will appear in the ad. if you enter the embed code from the site hosting your video, the video will embed itself in display ads on BostonApartments.com and any site fed from it.<BR>
                            <P>
                        <li>  Select a landlord from the pick list (if you have populated your landlords section of the database) and the landlord information will appear at the top of the listing when edited after it has been created and saved. This also allows for easy updates, sorts and other features to work.<BR>
                            <P>

                                <B>Listing</B> <img src="../assets/images/full.gif" width="15" height="15"> The Listing Tab gives you more detailed information about the listing. There is a section of features and amenities that can be checked for search purposes and to be auto written into an ad. To enable the Auto-Write feature check the box above the features checklist that says "Check to Automatically List Features and Amenities in the advertisement".<BR>
                            <P>
                                <B>Photos</B> To add photograhs, drawings and floor plans to a listing click the photo tab. A message will appear asking "Click ok to save your work and navigate to Pictures" or "Would you like to save your changes?" depending on your browser. If OK is clicked the last modified date will be set to that time. if Cancel is clicked the modified date will be left intact. In either case you will proceed to Manage Photos section for that listing.<BR>
                            <P>
                        <li>  To select a picture to upload, click the browse button and select the file you want to upload. You may watermark the photo <BR>
                            <P>
                        <li> For help with watermarking <a href="<?php echo "$PHP_SELF?op=help-watermark"; ?>">click here</A>.<BR>
                            <P>
                        <li>  By default the first photgraph uploaded is the thumbnail displayed. You may select a different picture by clicking "Set as Thumbnail" above the picture you would like.<BR>
                            <P>
                        <li>  You may rorate and watermark and picture after it has been uploaded.<BR>
                            <P>
                        <li>  You may change the order of the pictures display. If 2 pictures have the same order value, they will then sort by upload order. If left blank for all pictures, then they will display in the order in which they were uploaded.<BR>
                            <P>

                                <B>Deal Sheets</B> This tab allows you to create Deal Sheets which track paperwork and moeney owed on listing. You create a new deal, select the clients from the system and create a deal. You may have as many deals as you need for any listing.<BR>
                            <P>
                                <B>Printouts</B> Clicking this tab brings you a menu of printouts for the listing. Three are also forms. In the near future, when you create a Deal Sheet and have a landlord selected, all the forms on printouts will auto-fill.<BR>
                            <P>
                        <li>  When editing a listing a cyan menu appears that allows you to Copy the listing with all pictures and information (clone the listing) make a change and save it as another listing. This sopeed up the process of getting your inventory into the system.<BR>

                    </UL>
                    <P>
                    <CENTER><B><a class="btn btn-default" STYLE="Background-Color : #F5A9A9" href="#" onClick="history.go(-1)">Click to go back to the previous page</a></B><BR></CENTER>
                    <P>
                </DIV>
            </TD></TR></TABLE>
</CENTER>