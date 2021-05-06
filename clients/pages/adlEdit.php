<!--Begin adlEdit -->

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=184503242198185&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<meta property="og:type"               content="article" />

<FONT SIZE="-4"><br></FONT>
<div align="left" style="padding:0px;margin:px;border:1px solid black;width:100%;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:14px;color:black;">
<?php include "../assets/buttons.php";?>

<!--Tabs-->
<TABLE WIDTH="100%" CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD>



<?php include "folderTabs2.php";

$SaveAd = "tabNav('adlEdit1', $cid);";
?>
<!--/Tabs-->
</TD><TD>


<table border="0" height="15">
<table border="0" height="15">
	<tr>
	<td>

<span style="font-size:15px;">VIEW:</span></td>
	<td width="15" height="15"><img style="cursor:hand;" onClick="selectView('simple');"  src="../assets/images/simple.gif" width="15" height="15"></td>
	<td width="15" height="15"><img style="cursor:hand;" onClick="selectView('full');" src="../assets/images/full.gif" width="15" height="15"></td>
	</tr>
	<tr>
	<tr>
	<?php
if ($_SESSION["pref_adl_view"] == 1) {
    $simpleSel = "select.gif";
    $fullSel = "wht_spacer.gif";
    $selTitle = "simple_t.gif";
} elseif ($_SESSION["pref_adl_view"] == 2) {
    $simpleSel = "wht_spacer.gif";
    $fullSel = "select.gif";
    $selTitle = "full_t.gif";
}
?>

	<td align="center" width="15" height="10"><img src="../assets/images/wht_spacer.gif" width="0" height="0"></td>
	<td align="center" width="15" height="5"><img id="simpleSel" name="simpleSel" src="../assets/images/<?php echo $simpleSel; ?>" width="5" height="5"></td>
	<td align="center" width="15" height="5"><img id="fullSel" name="fullSel" src="../assets/images/<?php echo $fullSel; ?>" width="5" height="5"></td>
	</tr>
	<tr>
	<td colspan="3" align="right"><img id="selTitle" name="selTitle" height="13" width="37" src="../assets/images/<?php echo $selTitle; ?>"></td>
	</tr>
</table>
</TD></TR></TABLE>



<table width="100%" border="0">
<tr>
<td valign="top" colspan=2>
<?php if ($cid) {?>
<span align="left" style="padding:5px;margin:2px;font-size:11px;text-align:left;color:black;Background-Color : #CCFFFF"><NOBR>
<?php if ($_SESSION["user_level"] > 1 and $rowGetAd->CLI == "$grid") {?><a href="<?php echo "$PHP_SELF?op=delete&cid=$cid"; ?>"><span style="" ><img border="0" src="../images/icons/delete.gif" alt="delete" title="DELETE this Listing FOREVER" vspace="0" hspace="0"></span></a> | <?php }?>
<?php if ($_SESSION["user_level"] > "0" and ($rowGetAd->CLI == "$grid" or $rowGetAd->CLI == "1075")) {?><a href="<?php echo "$PHP_SELF?op=copy&cid=$cid"; ?>"><span style="" >Copy</span><a> | <a href="<?php echo "$PHP_SELF?op=hot_list_add&item_type=1&item_id=$rowGetAd->CID&return_page=sel&return_page_rid=$rowGetAd->CID"; ?>"><span style="" ><img width="16" height="16" border="0" vspace="0" hspace="0" src="../assets/images/hot.gif" alt="Add to Hot List" title="Add to Hot List"></span></a> | <?php }?> <a href="<?php echo "$PHP_SELF?op=mail_listing&cid=$rowGetAd->CID"; ?>"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22 alt="Email Listing" title="Email Listing"></A> | <a href="<?php echo "$PHP_SELF?op=manageClients&clients_filter=1&clients_filter_agent=" . $uid . "&clients_filter_type=" . $rowGetAd->TYPE . "&clients_filter_loc_pref=" . $rowGetAd->LOC . "&clients_filter_status_client=1"; ?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../assets/images/matchlistings.gif" alt="Match Listing to Clients" title="Match Listing to Clients"></a> <?php if ($_SESSION["user_level"] > "0" and $rowGetAd->CLI == "$grid") {?><?php if ($rowGetAd->LID) {?> | <a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$rowGetAd->LANDLORD"; ?>" target="_EL<?php echo "$rowGetAd->LANDLORD"; ?>"><img border=0 src="../images/icons/edit.gif" alt="edit">Landlord</a><?php }?> | <?php if ($_SESSION["user_level"] > 0 and $rowGetAd->CLI == "$grid") {?> <A HREF="<?php echo "$PHP_SELF?op=openhouse-add&CID=$rowGetAd->CID&return_page=adlEdit"; ?>"><IMG SRC="../assets/images/openhouse.jpg" height="16" WIDTH="16" BORDER="0">Create Open House</A> | <?php }?> <?php if (isset($rowGetAd) and $rowGetAd->CLI == "$grid") {?><A HREF="<?php echo "$PHP_SELF?op=createshowing&cid=$rowGetAd->CID&return_page=adlEdit"; ?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings.jpg" TITLE="Create Showing" ALT="Create Showing"></A> | <A HREF="<?php echo "$PHP_SELF?op=showinghistoryunit&cid=$rowGetAd->CID&return_page=adlEdit"; ?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Showing History" ALT="Showing History"></A><?php }?> | <?php }?> <a href="javascript:popUpPrintOut('./printout_agent.php?cid=<?php echo isset($rowGetAd) ? $rowGetAd->CID : ""; ?>');"><img src="../assets/images/agent-ss.gif" vspace="0" hspace="0" border="0" height="18" width="18" alt="Agent Show Sheet" title="Agent Show Sheet <?php if (isset($rowGetAd) and $rowGetAd->SHOW_INSTRUCT) {echo " - " . $rowGetAd->SHOW_INSTRUCT;}?><?php if (isset($rowGetAd) and $rowGetAd->LISTING_NOTES) {echo " - " . $rowGetAd->LISTING_NOTES;}?>"></a> <?php if (isset($rowGetAd) and $rowGetAd->PIC > 0) {?>  | <a href="javascript:popUpPrintOut('./printout_agent_pic.php?cid=<?php echo isset($rowGetAd) ? $rowGetAd->CID : ""; ?>');"><img src="../assets/images/agent-ss-pic.gif" vspace="0" hspace="0" border="0" height="18" width="18" alt="Agent Show Sheet with Pictures" title="Agent Show Sheet with Pictures <?php if (isset($rowGetAd) and $rowGetAd->SHOW_INSTRUCT) {echo " - " . $rowGetAd->SHOW_INSTRUCT;}?><?php if (isset($rowGetAd) and $rowGetAd->LISTING_NOTES) {echo " - " . $rowGetAd->LISTING_NOTES;}?>"></a><?php }?> | <a href="javascript:popUpPrintOut('./printout_client.php?cid=<?php echo isset($rowGetAd) ? $rowGetAd->CID : ""; ?>');"><img src="../assets/images/doc.gif" vspace="0" hspace="0" border="0" height="18" width="18" alt="Client Printout" title="Client Printout"></a><?php if (isset($rowGetAd) and $rowGetAd->PIC > 0) {?> | <a href="javascript:popUpPrintOut('./printout_client_pic.php?cid=<?php echo isset($rowGetAd) ? $rowGetAd->CID : ""; ?>');"><img src="../assets/images/doc-pic.gif" vspace="0" hspace="0" border="0" height="18" width="18" alt="Client Printout with Pictures" title="Client Printout with Pictures"></a><?php }?>

<?php if (($_SESSION["user_level"] >= "3") or ($_SESSION["user_level"] < "3" and $rowGetAd->STATUS == "ACT")) {?>


| <a href=" <?php echo "https://www.BostonApartments.com/plugin/?ad=$rowGetAd->CID&cli=$rowGetAd->CLI&uid=$uid\" target=\"_CL$rowGetAd->CID\""; ?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/cl.gif" alt="Post to Craigslist" title="Post to Craigslist"></A>



 <?php }?>

 | <a href="<?php echo "http://www.facebook.com/sharer.php?u=http://bostonapartments.com?homepage-fb.php&cli=$rowGetAd->CLI&ad=$rowGetAd->CID"; ?>" target="_FB<?php echo isset($rowGetAd) ? $rowGetAd->CID : ""; ?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/facebook.gif" alt="Post to Facebook" title="Post to Facebook"></A> | <a href="<?php echo "http://twitter.com/home?status=http%3A%2F%2Fbostonapartments.com%2Fhomepage.php%3Fcli%3D$rowGetAd->CLI%26ad%3D$rowGetAd->CID%20title%3DListing%23$rowGetAd->CID%20%24$rowGetAd->PRICE%20$rowGetAd->LOCNAME%20$rowGetAd->ROOMS%20Bed"; ?>" target="_tweet<?php echo isset($rowGetAd) ? $rowGetAd->CID : ""; ?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../assets/images/twitter.jpeg" alt="Post to Twitter" title="Post to Twitter"></a>


  </center></NOBR></SPAN>
<br></span>
<?php } else {?>
<span align="left" style="padding:5px;margin:2px;font-size:15px;text-align:left;color:white;">
<span style="" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> |
<span style="" >&nbsp;&nbsp;&nbsp;&nbsp;</span> |
<span style="" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>
<?php }?>
</td>
</tr>
<tr>
<td style="font-size:15px;margin:5px;padding:10px;" VALIGN="TOP">
<?php if ($cid) {
    ?>


<?php

    if (isset($rowGetAd) and $rowGetAd->CSOURCE == "1") {

        echo "<center><h3><FONT COLOR=#FF0000>This is RJ Listing # " . $rowGetAd->EXTERNALID . "</FONT></h3></CENTER>";

    } elseif (isset($rowGetAd) and $rowGetAd->CSOURCE == "2") {

        echo "<center><h3><FONT COLOR=#FF0000>This is YGL Listing # " . $rowGetAd->EXTERNALID . "</FONT></h3></CENTER>";

    }

    if (($rowGetAd->STATUS == "STO") and ($rowGetAd->CLI != "1075")) {
        echo "<center><h3><FONT COLOR=#FF0000>This listing is not being advertised.</FONT></h3></CENTER>";
    }?>


<?php if (isset($rowGetAd) and $rowGetAd->CLI == "1075") {echo "<FONT COLOR=BLUE><FONT SIZE='+1'><B>MLS LISTING</B></FONT><BR><FONT COLOR=#FF0000>This is MLS Listing # " . $rowGetAd->EXTERNALID . "</FONT></FONT><BR>";}?>
<?php if (isset($rowGetAd) and $rowGetAd->CLI == "1075" and $rowGetAd->MLS_AGENCY != "") {echo "<NOBR><FONT COLOR=RED><B>MLS Listing Agency:</B></FONT> <FONT COLOR=BLUE><B>" . $rowGetAd->MLS_AGENCY . "</B></FONT></NOBR><BR>";}?>
<?php if (isset($rowGetAd) and $rowGetAd->CLI == "1075" and $rowGetAd->MLS_AGENT != "") {echo "<NOBR><FONT COLOR=RED></B>MLS Listing Agent:</B></FONT> <FONT COLOR=BLUE><B>" . $rowGetAd->MLS_AGENT . "</B></FONT></NOBR><BR>";}?>

<?php if (isset($rowGetAd) and $rowGetAd->CLI == "1075" and $rowGetAd->MLS_CONTACT != "") {echo "<NOBR><FONT COLOR=RED>Listing Email:</B></FONT> <FONT COLOR=BLUE><B><A HREF=mailto:" . $rowGetAd->MLS_CONTACT . ">" . $rowGetAd->MLS_CONTACT . "</A></B></FONT></NOBR><BR>";}?>


<?php if (($rowGetAd->CLI == "1075" and $rowGetAd->MLS_PHONE != "") and ($rowGetAd->MLS_PHONE != $rowGetAd->MLS_CONTACT)) {echo "<NOBR><FONT COLOR=RED>Listing Phone:</B></FONT> <FONT COLOR=BLUE><B>" . $rowGetAd->MLS_PHONE . "</B></FONT></NOBR><BR>";}?>


<?php if (isset($rowGetAd) and $rowGetAd->CLI != "1075" and $rowGetAd->CLI != $grid) {
        echo "<FONT COLOR=BLUE SIZE='+1'><B>BOSTONAPARTMENTS.COM NETWORK LISTING</B></FONT><BR>";

        echo "<FONT SIZE+1><B>Contact:</B> <FONT COLOR=BLUE>";

        if (isset($rowGetAd) and $rowGetAd->ALTSIG != "") {echo isset($rowGetAd) ? $rowGetAd->ALTSIG : "";} else {

            $qustrgetsig = "SELECT `SIG` FROM `GROUP` WHERE `GRID`='$rowGetAd->CLI' LIMIT 1";
            @$qugetsig = mysqli_query($GLOBALS['dbh'], $qustrgetsig);
            $rowgetsig = mysqli_fetch_object($qugetsig);
            echo $rowgetsig->SIG . "</FONT><BR></FONT><BR>";
        }

    }?>


 <?php

    if ($rowGetAd->CSOURCE != "0" or $rowGetAd->CSOURCE != "" and $rowGetAd->CLI == "$grid") {

        if (($rowGetAd->CSOURCE != "0" or $rowGetAd->CSOURCE != "") and $rowGetAd->MLS_AGENCY != "") {echo "<NOBR><FONT COLOR=RED><B>Listing Agency:</B></FONT> <FONT COLOR=BLUE><B>" . $rowGetAd->MLS_AGENCY . "</B></FONT></NOBR><BR>";}?>
<?php if (($rowGetAd->CSOURCE != "0" or $rowGetAd->CSOURCE != "") and $rowGetAd->MLS_AGENT != "") {echo "<NOBR><FONT COLOR=RED></B>Listing Agent:</B></FONT> <FONT COLOR=BLUE><B>" . $rowGetAd->MLS_AGENT . "</B></FONT></NOBR><BR>";}?>

<?php if (($rowGetAd->CSOURCE != "0" or $rowGetAd->CSOURCE != "") and $rowGetAd->MLS_CONTACT != "") {echo "<NOBR><FONT COLOR=RED>Listing Email:</B></FONT> <FONT COLOR=BLUE><B><A HREF=mailto:" . $rowGetAd->MLS_CONTACT . ">" . $rowGetAd->MLS_CONTACT . "</A></B></FONT></NOBR><BR>";}?>

<?php if (($rowGetAd->CSOURCE != "0" or $rowGetAd->CSOURCE != "") and $rowGetAd->MLS_PHONE != "" and ($rowGetAd->MLS_PHONE != $rowGetAd->MLS_CONTACT)) {echo "<NOBR><FONT COLOR=RED>Listing Phone:</B></FONT> <FONT COLOR=BLUE><B>" . $rowGetAd->MLS_PHONE . "</B></FONT></NOBR><BR>";}?>
<?php }?>




Ad ID#: <?php echo "$rowGetAd->ABV"; ?>-<?php echo "$rowGetAd->CID"; ?> <br>
Created by: <?php echo "$rowGetAd->HANDLE"; ?> <br>
On: <?php echo "$rowGetAd->DATEIN"; ?> <br>

<?php if (($rowGetAd->CSOURCE == "0" or $rowGetAd->CSOURCE == "") and ($rowGetAd->CLI != "1075")) {?>

Last Modifed on: <?php echo "$rowGetAd->MOD"; ?><br>
Last Modifed by: <?php echo "$rowGetAd->MODBY"; ?><br>
<?php }?>
Status:
<?php if (isset($rowGetAd) and $rowGetAd->CLI != "1075") {
        ?>


<?php if (isset($rowGetAd) and $rowGetAd->STATUS == "ACT") {
            echo "Active Ad";
        } else {
            echo "Inactive Ad";
        }?>


 / <?php }?> Unit is <?php if (isset($rowGetAd) and $rowGetAd->STATUS_ACTIVE == "1") {
        echo "Available<BR><BR>";
    } else {
        echo "Unavailable<BR><BR>";
    }?>
<?php } else {?>
	&nbsp;



<?php }?>

&nbsp;&nbsp;<a href="<?php echo "$PHP_SELF?op=return_page_op"; ?>"><img hspace="0" vspace="0" border="0" width="62" height="20" src="../assets/images/return.jpg"></a>


</td>
<td VALIGN="TOP">

	<div class="ad" align="left">

<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD style="font-size:15px;margin:5px;padding:10px;" VALIGN="TOP">


<?php if (isset($rowGetAd) and $rowGetAd->CLI == "$grid") {
    ?>

<?php if (isset($rowGetAd) and $rowGetAd->LANDLORD) {
        ?>

	<?php echo display_landlord($rowGetAd); ?>


<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD>
	<form action="<?php echo "$PHP_SELF?op=listings&listing_filter_display=none&vid=7&availFilter=n&sortD=ASC&sort=STREET,%20STREET_NUM,%20APT"; ?>" method="POST" target="_NEW">
	<input type="hidden" name="filterChange" value="1">
	<input type="hidden" name="landlord" value="<?php echo isset($rowGetAd) ? $rowGetAd->LANDLORD : ""; ?>">
<!--	<input type="submit" value="All Listings For This Landlord" STYLE="Background-Color : #CCFFFF;"> -->

<button class="button-blue pure-button">All Listings For This Landlord</button>

	</form>

</TD><TD VALIGN="TOP">&nbsp;

</TD><TD VALIGN="TOP">
<CENTER>
<?php

        echo "<A HREF=$PHP_SELF?op=buildings&lid=$rowGetAd->LID&llname=$rowGetAd->SHORT_NAME target=\"_NEW\"><IMG src=../assets/images/buildings.jpg BORDER=0><BR><FONT SIZE=1px>Buildings</FONT></A>";

        ?>


</CENTER>

</TD></TR></TABLE>

<A HREF="<?php echo "$PHP_SELF?op=llcomments&llid=$rowGetAd->LID"; ?>" TITLE="View Landlord Comments" target="_newvlc">View Landlord Comments</A> | <A HREF="<?php echo "$PHP_SELF?op=createllcomments&llid=$rowGetAd->LID"; ?>" TITLE="Add Landlord Comment" target="_newclc">Create Landlord Comment</A><BR><A HREF="<?php echo "$PHP_SELF?op=showingsLandlord&llid=$rowGetAd->LID"; ?>" TITLE="View Landlord Showing History" target="_newlsh">View Landlord Showing History</A><BR>

</div>

<?php }?>

<?php } elseif (isset($rowGetAd) and ($rowGetAd->CLI == "1075") and ($rowGetAd->SHOW_INSTRUCT != "")) {?>


<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD VALIGN="TOP">
<div class="ad" align="left">
<?php echo isset($rowGetAd) ? $rowGetAd->SHOW_INSTRUCT : ""; ?>
<BR><IMG SRC="../assets/images/spacer.gif" WIDTH="270" HEIGHT="1">
</DIV></TD></TR></TABLE>


<?php } else {?>

 <IMG SRC="../assets/images/spacer.gif" WIDTH="270" HEIGHT="1">
	<?php }?>

	</TD>
<TD> &nbsp;&nbsp;&nbsp;&nbsp; </TD>

<TD VALIGN="TOP">

<?php if (isset($rowGetAd->CID)) {
    ?>

<?php

    if (isset($rowGetAd->THUMBNAIL)) {

        $thumb = "<IMG SRC=https://www.BostonApartments.com/pics/$rowGetAd->THUMBNAIL HEIGHT=115 WIDTH=115 BORDER=0>";

        echo "<CENTER><a href=https://www.BostonApartments.com/homepage.php?cli=$rowGetAd->CLI&ad=$rowGetAd->CID&uid=$rowGetAd->UID target=_NEW>$thumb</A><BR>";

        if (isset($rowGetAd) and $rowGetAd->PIC != "0" and $rowGetAd->PIC >= "2") {echo isset($rowGetAd) ? $rowGetAd->PIC : "" . "&nbsp;";}
        echo "Pics</CENTER>";

    } else {

        $quStrGetPics = "SELECT * FROM PICTURE WHERE `CID`=$rowGetAd->CID ORDER BY PICORDER, PID LIMIT 1";
        $quGetPics = mysqli_query($GLOBALS['dbh'], $quStrGetPics);
        $rowGetPics = mysqli_fetch_object($quGetPics);

        if ($rowGetPics) {
            $thumb = "<IMG SRC=https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT HEIGHT=115 WIDTH=115 BORDER=0>";

        } elseif (isset($rowGetAd) and $rowGetAd->EXTERNALPIC) {
            $thumb = "<IMG SRC=$rowGetAd->EXTERNALPIC HEIGHT=115 WIDTH=115 BORDER=0>";
        } else { $thumb = "<CENTER>No Pictures<BR>Click For Display Ad</CENTER>";}

        if (isset($rowGetAd) and $rowGetAd->CLI == "1075") {

            echo "<CENTER><a href=https://www.BostonApartments.com/homepage-MLS.php?cli=$rowGetAd->CLI&ad=$rowGetAd->CID&uid=$rowGetAd->UID target=_NEW>$thumb</A><BR>$rowGetAd->EXTERNALPIC_NUM";
            if (isset($rowGetAd) and $rowGetAd->EXTERNALPIC_NUM != "0" and $rowGetAd->EXTERNALPIC_NUM >= "2") {echo " Additional ";}

            echo " Pics</CENTER>";
        }

        if (isset($rowGetAd) and $rowGetAd->CLI == "$grid" and $rowGetAd->CSOURCE > '0') {
            echo "<CENTER><a href=https://www.BostonApartments.com/homepage.php?cli=$rowGetAd->CLI&ad=$rowGetAd->CID&uid=$rowGetAd->UID target=_NEW>$thumb</A><BR>";

            if (isset($rowGetAd) and $rowGetAd->PIC != "0" and $rowGetAd->PIC >= "2") {echo isset($rowGetAd) ? $rowGetAd->PIC : "" . "&nbsp;";}
            echo "Pics</CENTER>";
        }
    }

    ?>
<?php }?>
</TD><TD>&nbsp;

</TD></TR></TABLE>
</td>
</tr>
</table>


<form id="adlEditForm" name="adlEditForm" action="<?php echo "$PHP_SELF?op=adlEditDo"; ?>" method="POST">
<input type="hidden" name="cid" value="<?php echo $cid; ?>">
<input id="adlEditFormNav" type="hidden" name="adlEditNav" value="">
<?php
if ($_SESSION["pref_adl_view"] == 1) {
    $display = "block";
} elseif ($_SESSION["pref_adl_view"] == 2) {
    $display = "none";
}?>






<?php
if ($_SESSION["pref_pagebg"] == "") {
    $pagebgcolor = "#F5F5DC";
} else {
    $pagebgcolor = $_SESSION["pref_pagebg"];
}
?>

<div id="simpleArea" style="width:98%; margin:0px auto; padding:8px; background-color:<?php echo $pagebgcolor; ?>; border:1px solid black; display:<?php echo $display; ?>;">

<CENTER>
<table width="100%" BORDER="0">
<tr>
<td align="left">

<span style="font-size:15px;">
Type:<br><select class="form-control" id="simpleTYPE" name="TYPE" onChange="setFlagFee(this.options[this.selectedIndex].value);" STYLE="Background-Color : #FFFFFF">
	<?php while ($rowTypes = mysqli_fetch_object($quTypes)) {
    ?>
	<option value="<?php echo $rowTypes->TYPE; ?>" <?php if (isset($rowGetAd) and $rowGetAd->TYPE == $rowTypes->TYPE) {
        echo " selected";}?> >
	<?php echo $rowTypes->TYPENAME; ?></option>
	<?php }?>
</select>
</span>
</TD><td align="left">
<span style="font-size:15px;">
Location:<br><select class="form-control" id="simpleLOC" name='LOC' onChange="(syncMeSelect('simpleLOC', 'fullLOC'));" STYLE="Background-Color : #FFFFFF">
	<option value="--">Please choose a location:</option>
	<?php while ($rowFavLocs = mysqli_fetch_object($quFavLocs)) {
    ?>
	<option value="<?php echo $rowFavLocs->LOCID; ?>" <?php if (isset($rowGetAd) and $rowGetAd->LOC == $rowFavLocs->LOCID) {
        echo " selected";
        $locSeled = true;}?>><?php echo $rowFavLocs->LOCNAME; ?></option>
	<?php }?>
	<option value="0">--------------------</option>

	<?php while ($rowLocs = mysqli_fetch_object($quLocs)) {?>
		<option value="<?php echo $rowLocs->LOCID; ?>" <?php if (isset($rowGetAd) and $rowGetAd->LOC == $rowLocs->LOCID && $locSeled == false) {echo " selected";}?> >
		<?php echo $rowLocs->LOCNAME; ?></option>
	<?php }?>
</select>
</SPAN>

</TD><TD align="left">

<?php if (($_SESSION["user_level"] > "0" and isset($rowGetAd) and $rowGetAd->LOCKED == "0") or (isset($rowGetAd) and $rowGetAd->LOCKED == "1" and $_SESSION["user_level"] >= "4") or ((!($cid)) and $_SESSION["user_level"] > "0")) {

    ?>
<!-- <input onClick="validateAdlEdit('simple');" type="button" value="Save" STYLE="Background-Color : #adffad"> -->


<!-- <button  onClick="validateAdlEdit('simple');" class="button-green pure-button">Save</button> -->
<span>
<button  onClick="validateAdlEdit('simple');" class="btn btn-success mt-2" style="width:100%">Save</button>
</span>

<!-- <A HREF="javascript: void 0" ONCLICK="validateAdlEdit('simple');"><IMG SRC="../assets/images/save.gif" BORDER="0"></A> -->
<?php } else {echo "<font color=red>Listing Locked</font>";}?>

</TD></TR></TABLE>
</CENTER>

<table width="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD>
<table BORDER="0" width="100%"><tr>
<td align="left">
<span style="font-size:15px;">
Bedrooms:<br>
<select class="form-control" id="simpleROOMS" name="ROOMS" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $key => $roomsValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->ROOMS == $key) ? " selected " : "";?>
	<option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $roomsValue; ?></option>
	<?php }?>
</select>
</span>
</TD><td align="left">

</TD><td align="left">
<span style="font-size:15px;">
Bathrooms:<br>
<select class="form-control" id="simpleBATH" name="BATH" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bkey => $bathValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->BATH == $bkey) ? " selected " : "";?>
	<option value="<?php echo $bkey; ?>" <?php echo $selected; ?>><?php echo $bathValue; ?></option>
	<?php }?>
</select>
</SPAN>

</TD><td align="left">

<TD >
<span style="font-size:15px;">
Pets:<BR><select class="form-control" id="simplePETSA" name="PETSA" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['PETSA'] as $petkey => $petVal) {?>
	<option value="<?php echo $petkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->PETSA == $petkey) {echo " selected ";}?>><?php echo $petVal; ?></option>
	<?php }?>
</select>
</SPAN>
</TD>

<td align="left" height="30">
<span style="font-size:15px;">
<NOBR># of Parking Spaces:</NOBR><BR>
<select class="form-control" id="simplePARKING_NUM" name="PARKING_NUM" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['PARKING_NUM'] as $pknkey => $pknValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->PARKING_NUM == $pknkey) ? " selected " : "";?>
						<option value="<?php echo $pknkey; ?>" <?php echo $selected; ?>><?php echo $pknValue; ?></option>
					<?php }?>
			</select>

</SPAN>
</td>
<td align="left" height="30" >
<span style="font-size:15px;">
<NOBR>Parking Space Type:</NOBR><BR>

<select class="form-control" id="simplePARKING_TYPE" name="PARKING_TYPE" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['PARKING_TYPE'] as $parkkey => $parkVal) {?>
					<option value="<?php echo $parkkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->PARKING_TYPE == $parkkey) {echo " selected ";}?> > <?php echo $parkVal; ?> </option>
				<?php }?>
			</select>
</SPAN>
</td>
<td align="left" height="30" >
<span style="font-size:15px;">
<!-- <NOBR>Cost per Space:</NOBR> -->

					<nobr>Cost per Space:</nobr>
					<div class="input-group ">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">$</span>
					  </div>
					  <input class="form-control" id="simplePARKING_COST" type="text" name="PARKING_COST" size="5" value="<?php echo isset($rowGetAd) ? $rowGetAd->PARKING_COST : ""; ?>">
					</div>

<!-- $<input class="form-control" id="simplePARKING_COST" type="text" name="PARKING_COST" size="5" value="<?php echo isset($rowGetAd) ? $rowGetAd->PARKING_COST : ""; ?>"> -->

</SPAN>

</td></tr></table>
</td></tr></table>


<table width="95%" BORDER=0>
<tr>
<td>

<span style="font-size:15px;">

Price:<BR>
<div class="input-group ">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">$</span>
  </div>
	<input class="form-control" id="simplePRICE" type="text" name="PRICE" size="8" value="<?php echo isset($rowGetAd) ? $rowGetAd->PRICE : ""; ?>"  onChange="(syncMeSelect('simplePRICE', 'fullPRICE'));">
</div>

<!-- <b>$</b> -->

<!-- <input id="simplePRICE" type="text" name="PRICE" size="8" value="<?php echo isset($rowGetAd) ? $rowGetAd->PRICE : ""; ?>"  onChange="(syncMeSelect('simplePRICE', 'fullPRICE'));"> -->
</SPAN>

</td>

<td align="left">

<span style="font-size:15px;">
<?php
if (isset($rowGetAd)) {
    if (isset($rowGetAd) and $rowGetAd->TYPE == 1 || $rowGetAd->TYPE == 4 || $rowGetAd->TYPE == 5 || $rowGetAd->TYPE == 7 || $rowGetAd->TYPE == 8 || $rowGetAd->TYPE == 9 || $rowGetAd->TYPE == 10 || $rowGetAd->TYPE == 11 || (!$rowGetAd->TYPE)) {
        $sale_display = "none";
        $rental_display = "inline";
    } else if (isset($rowGetAd) and $rowGetAd->TYPE == 2 || $rowGetAd->TYPE == 3 || $rowGetAd->TYPE == 6 || $rowGetAd->TYPE == 12 || $rowGetAd->TYPE == 13) {
        $sale_display = "inline";
        $rental_display = "none";
    }}?>


<span id="simpleSTATUS_SALEspan" style="display:<?php echo isset($sale_display) ? $sale_display : ""; ?>;">

Sale Status:<br><select class="form-control" id="simpleSTATUS_SALE" name="STATUS_SALE" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['STATUS_SALE'] as $sskey => $ssValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->STATUS_SALE == $sskey) ? " selected " : "";?>
	<option value="<?php echo $sskey; ?>" <?php echo $selected; ?>><?php echo $ssValue; ?></option>
	<?php }?>
</select>
</span>
</span>
</td>

<td align="left">
<span style="font-size:15px;">

<span id="simpleNOFEEspan" style="display:<?php echo isset($rental_display) ? $rental_display : ""; ?>;">
<NOBR>Fee:</NOBR><br><select class="form-control" name="NOFEE" id="simpleNOFEE" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php foreach ($DEFINED_VALUE_SETS['NOFEE'] as $fkey => $fValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->NOFEE == $fkey) ? " selected " : "";?>
	<option value="<?php echo $fkey; ?>" <?php echo $selected; ?>><?php echo $fValue; ?></option>
	<?php }?>
</select>
</span>
</span>
</td>

</TD>
<TD>
<span style="font-size:15px;">Fee Comments (agent eyes only):</span><br><input class="form-control" type="text" id="simpleFEE_COMMENTS" name="FEE_COMMENTS" size="45" value="<?php echo isset($rowGetAd) ? $rowGetAd->FEE_COMMENTS : ""; ?>">
</TD>

<td align="center">
<span style="font-size:15px;"><NOBR>
Availability Date:  <?php
if (isset($rowGetAd->CID)) {

    if ($_SESSION["user_level"] > "0") {

        if (isset($rowGetAd) and $rowGetAd->CSOURCE == "0" and $rowGetAd->CLI == "$grid") {
            ?>

<!-- <span onClick="<?php echo $SaveAd; ?>">
<a href="<?php // echo $PHP_SELF;?>?op=dateavailablenowdo&amp;cid=<?php // echo isset($rowGetAd) ? $rowGetAd->CID;?>&amp;grid=<?php // echo $grid;?>&amp;next_contact=<?php // echo isset($rowGetAd) ? $rowGetAd->AVAIL;?>" target="_datechange"><FONT SIZE="-3" COLOR="green">Make Now</FONT></A>
</SPAN> -->



<?php }}}
?>
</NOBR><BR>





<?php
$getMon = null;
$getDay = null;
$getYear = null;
if (isset($rowGetAd->CID)) {
    $getMon = subStr($rowGetAd->AVAIL, 5, 2);
    $getDay = subStr($rowGetAd->AVAIL, 8, 2);
    $getYear = subStr($rowGetAd->AVAIL, 0, 4);
}
?>
<div class="input-group">
<span style="font-size:15px;">Month:</span><select class="form-control"  id="simplebbbMonth" name="bbbMonth" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<option value="01" <?php if ($getMon == "01") {echo " selected ";}?>>Jan</option>
	<option value="02" <?php if ($getMon == "02") {echo " selected ";}?>>Feb</option>
	<option value="03" <?php if ($getMon == "03") {echo " selected ";}?>>Mar</option>
	<option value="04" <?php if ($getMon == "04") {echo " selected ";}?>>Apr</option>
	<option value="05" <?php if ($getMon == "05") {echo " selected ";}?>>May</option>
	<option value="06" <?php if ($getMon == "06") {echo " selected ";}?>>Jun</option>
	<option value="07" <?php if ($getMon == "07") {echo " selected ";}?>>Jul</option>
	<option value="08" <?php if ($getMon == "08") {echo " selected ";}?>>Aug</option>
	<option value="09" <?php if ($getMon == "09") {echo " selected ";}?>>Sep</option>
	<option value="10" <?php if ($getMon == "10") {echo " selected ";}?>>Oct</option>
	<option value="11" <?php if ($getMon == "11") {echo " selected ";}?>>Nov</option>
	<option value="12" <?php if ($getMon == "12") {echo " selected ";}?>>Dec</option>
</select>
<span style="font-size:15px;">Day:</span><select class="form-control" id="simplebbbDay" name="bbbDay" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php for ($i = 1; $i <= 31; $i++) {
    if ($i <= 9) {
        $j = "0" . $i;
    } else {
        $j = $i;
    }
    ?>
	<option value="<?php echo $j; ?>" <?php if ($getDay == $j) {echo " selected ";}?>><?php echo $j; ?></option>
	<?php }?>
</select>
<span style="font-size:15px;">Year</span><select class="form-control" id="simplebbbYear" name="bbbYear" STYLE="Background-Color : #FFFFFF">
	<option value="--">--</option>
	<?php
$thisYear = date("Y") - 2;
for ($i = 0; $i <= 6; $i++) {?>
	<option value="<?php echo ($thisYear + $i); ?>" <?php if ($getYear == ($thisYear + $i)) {echo " selected ";}?>><?php echo ($thisYear + $i); ?></option>
	<?php }?>
</select>
</SPAN>
</div>
</td>
</tr>
</table>



<table width="100%">
<tr><TD><NOBR>
<CENTER>

<span style="font-size:15px;">

<input type="hidden" name="STATUS" value="STO"><input id="simpleSTATUS" type="checkbox" name="STATUS" value="ACT" TITLE="Check to Activate Ad"

 <?php if (isset($rowGetAd) and (($rowGetAd->STATUS == "STO") or (($rowGetAd->CID == "") and ($actsto == "STO")))) {echo "";} else {echo " checked ";}?>

  onClick="(syncMeSelect('simpleSTATUS', 'fullSTATU'));">Advertising? <img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/act.gif' TITLE="Check the box to activate the ad"> | <img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/inact.jpg' TITLE="Uncheck the box to deactivate the ad"> &nbsp; &nbsp; &nbsp; &nbsp;
<input type="hidden" name="STATUS_ACTIVE" value="0"><input id="simpleSTATUS_ACTIVE" type="checkbox"  onClick="syncMeSelect('simpleSTATUS_ACTIVE', 'fullSTATUS_ACTIVE');" name="STATUS_ACTIVE" value="1" TITLE="Check to Activate Ad"  <?php if (isset($rowGetAd) and $rowGetAd->STATUS_ACTIVE != '0') {echo " checked ";} else {echo "";}?>>Available? <img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/icons/a.jpg' TITLE="Check the box to mark the listing available."> | <img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/icons/u.jpg' TITLE="Uncheck the box to mark the listing unavailable.">


 &nbsp; &nbsp; &nbsp; &nbsp;
Syndicate? <select id="SYNDICATION" name="SYNDICATION">
<option value="1" <?php if (isset($rowGetAd) and $rowGetAd->SYNDICATION == '1') {echo " selected";}?>>Yes</option>
<option value="0" <?php if (isset($rowGetAd) and $rowGetAd->SYNDICATION == '0') {echo " selected";}?>>No</option>
</select>


</SPAN>
</NOBR>



</TD></TR><TR><TD>
<span style="font-size:15px;">Ad Title:<BR></SPAN>
<input class="form-control" type="text" size="100" name="AD_TITLE" id="simpleAD_TITLE" value="<?php echo isset($rowGetAd) ? $rowGetAd->AD_TITLE : ""; ?>">

</TD></TR><TR><TD>

<span style="font-size:15px;">Ad Body:<BR></SPAN>
<?php $adBody = (isset($rowGetAd) and $rowGetAd->BODY) ? $rowGetAd->BODY : "Type your ad here.";?>
<textarea class="form-control" name="BODY" id="simpleBODY" cols="100" rows="7" onFocus=clear_textbox() value="Type your ad here."><?php echo $adBody; ?></textarea>
</TD></TR></TABLE>

<table width="85%" CELLPADDING="0" CELLSPACING="0">
<TR><TD>&nbsp;</TD><TD WIDTH="20">
<IMG src="../assets/images/spellcheck.png" value="Check Spelling" onClick="openSpellChecker();"/>
</TD><TD>
<input type="button" value="Check Spelling" onClick="openSpellChecker();"/>
</td><TD>

<span style="font-size:15px;" onClick="<?php echo $photoClick; ?>">
<a href="<?php echo "$PHP_SELF?op=adlEdit-wysiwyg&cid=" . ($rowGetAd->CID) . "&return_page=sel&return_page_rid=" . ($rowGetAd->CID) . ""; ?>">CLICK HERE to use a WYSIWYG editor</A>
</SPAN>

</TD>

<td>
<?php
if ($rowGetGroup->ALLOW_PERSONAL_SIG != "1") {?>

<span style="font-size:15px;">Display Personal Signature?: No<input type="radio" name="USE_USER_SIG" id="simpleUSE_USER_SIG" value="0"  checked> Yes<input type="radio" name="USE_USER_SIG" id="simpleUSE_USER_SIG" value="1" <?php if (isset($rowGetAd) and $rowGetAd->USE_USER_SIG) {echo " checked ";}?>></span>

<?php }?>

</td>

</TD>
</tr>
</table>

<TABLE Border=0 WIDTH="100%"><TR><TD VALIGN="TOP">
<span style="font-size:15px;">Alternative HTML Ad Body for the office: (<I>This will show in the more details and other places that the regular line ads above can be replaced.</I>) <a href="<?php echo "$PHP_SELF?op=adlEdit-wysiwyg&cid=" . ($rowGetAd->CID) . "&return_page=sel&return_page_rid=" . ($rowGetAd->CID) . ""; ?>"><span style="font-size:15px;">Use WYSIWYG editor</SPAN></A>
</SPAN><BR>

<textarea class="form-control" name="BODY_ALT" id="BODY_ALT" cols="90" rows="7" value="<?php echo isset($rowGetAd) ? htmlspecialchars($rowGetAd->BODY_ALT) : ""; ?>"><?php echo isset($rowGetAd) ? $rowGetAd->BODY_ALT : ""; ?></textarea>



</TD></TR></TABLE>


<?php
// join Agent ads with company ads query

if (!isset($rowGetAd->CID)) {
    $foo = "bar";
} else {

    $num_rows = mysqli_num_rows($quGetAgentAd);

}

if (isset($num_rows) and $num_rows > 0) {
    $BodyAgent = htmlspecialchars($rowGetAgentAd->BODY_AGENT);
} else {
    $BodyAgent = "";
    echo "<INPUT TYPE=HIDDEN NAME=NEW_AGENT_AD VALUE=1>";
}
?>

<TABLE Border=0 WIDTH="100%"><TR><TD VALIGN="TOP">
<span style="font-size:15px;">Alternative Agent Ad Body: (<I>Posts as the ad copy instead of the Office's Alternative HTML Ad Body, or regular Ad Body depending on what fields are filled in. This also works on the HTML Ad Maker and is agent specific for agent listings and searches. HTML IS OK!</I>) <a href="<?php echo "$PHP_SELF?op=adlEdit-wysiwyg&cid=" . ($rowGetAd->CID) . "&return_page=sel&return_page_rid=" . ($rowGetAd->CID) . ""; ?>">Use WYSIWYG editor</A>
</SPAN>

<textarea class="form-control" name="BODY_AGENT" id="BODY_AGENT" cols="90" rows="7"><?php echo $BodyAgent; ?></textarea>

</TD></TR></TABLE>

</CENTER>

<TABLE CELLPADDING=0 CELLSPACING=0 width="90%" BORDER=0><TR><TD ROWSPAN="6" ALIGN="LEFT" WIDTH="128">
<IMG src="../assets/images/movie.png">
</TD><TD>

<NOBR>Virtual Tour URL:</NOBR>

</TD><TD>

<input class="form-control" type="text" size="40" name="VIRT_TOUR" id="simpleVIRT_TOUR" value="<?php echo isset($rowGetAd) ? $rowGetAd->VIRT_TOUR : ""; ?>">

</TD></TR><TR><TD COLSPAN=2 VALIGN=TOP>

<span style="font-size:8px;"><NOBR>(Include "http://",  example:  http://www.example.com/my_virtual_tour.htm)</NOBR></span>

</TD></TR><TR><TD>

<NOBR>YouTube URL:</NOBR>

</TD><TD>
<NOBR>
<input class="form-control" type="text" size="40" name="YOUTUBEURL" id="simpleYOUTUBEURL" value="<?php echo isset($rowGetAd) ? $rowGetAd->YOUTUBEURL : ""; ?>">  &nbsp;&nbsp; <span style="font-size:8px;"><A HREF="http://www.youtube.com/my_videos_upload" target="_NEW">Upload to <IMG SRC="https://www.BostonApartments.com/images/youtube.gif" BORDER="0"></A></SPAN>
</NOBR>
</TD></TR><TR><TD COLSPAN=2 VALIGN=TOP>

<span style="font-size:8px;"><NOBR>(Include "http://",  this is the page URL at YouTube)</NOBR></span>

</TD></TR><TR><TD>

<NOBR>YouTube Embed Code:</NOBR>

</TD><TD>



<input class="form-control" type="text" size="40" name="YOUTUBE" id="simpleYOUTUBE" value="<?php echo isset($rowGetAd) ? htmlspecialchars($rowGetAd->YOUTUBE) : ""; ?>">
</TR><TR><TD COLSPAN=2 VALIGN=TOP>
<span style="font-size:8px;"><NOBR>(The code to embed a YouTube video on a page)</NOBR></span>

</TD></TR></TABLE>

<hr noshade color="black">

<table width="100%">
<tr>
<td WIDTH="50">
<IMG src="../assets/images/map.png">
</TD><TD>
<span style="font-size:15px;">Offer Map in Ad (must fill in at least the ZIP code below):</span><br><select class="form-control" name="MAP" STYLE="Background-Color : #FFFFFF" id="simpleMAP">
<option value="0">No Map</option>
<?php
$quStrGetMaps = "select * from MAP_OFFER";
$quGetMaps = mysqli_query($GLOBALS['dbh'], $quStrGetMaps) or die(mysqli_error());
while ($rowGetMaps = mysqli_fetch_object($quGetMaps)) {
    ?><option value="<?php echo $rowGetMaps->id; ?>" <?php if (isset($rowGetAd) and $rowGetAd->MAP == $rowGetMaps->id) {echo "selected";}?>><?php echo $rowGetMaps->title; ?></option>
<?php }?>
</select>
</td>
</tr>
</table>

<hr noshade color="black">
<table width="90%">
<tr>
<td>Information not displayed in Ad:</td> <TD>&nbsp;  </TD><TD align=center>
<span style="font-size:15px;"><NOBR>
<input  type="checkbox" value=1 name="LUXURY_APT" <?php if (isset($rowGetAd) and $rowGetAd->LUXURY_APT > 0) {
    echo " checked ";}
;?>>Luxury Apt. &nbsp; | &nbsp; <input type="checkbox" value=1 name="FEATURED" <?php if (isset($rowGetAd) and $rowGetAd->FEATURED > 0) {
    echo " checked ";}
;?>>Featured Listing &nbsp; | &nbsp; <input type="checkbox" value=1 name="COBROKE" <?php if (isset($rowGetAd) and $rowGetAd->COBROKE > 0) {
    echo " checked ";}
;?>><B><FONT COLOR="blue">BA Network/Co-Broke Listing</FONT></B></span>
</NOBR></span>
</TD>
</tr>
</table>


<TABLE Border=0 WIDTH="100%"><TR><TD VALIGN="TOP">

<table Border=0>
<tr>
<td>Address:</td>
</tr>
<tr>
<td>
<span style="font-size:15px;">Number:</span><br><input class="form-control" type="text" id="simpleSTREET_NUM" name="STREET_NUM" size="4" value="<?php echo isset($rowGetAd) ? $rowGetAd->STREET_NUM : ""; ?>"></td><td><span style="font-size:15px;">Street:</span><br><input class="form-control" type="text" id="simpleSTREET" name="STREET" size="24" value="<?php echo isset($rowGetAd) ? $rowGetAd->STREET : ""; ?>"></td>
</tr>
<tr>
<td><span style="font-size:15px;">Apt:</span><br><input class="form-control" type="text" id="simpleAPT" name="APT" size="4" value="<?php echo isset($rowGetAd) ? $rowGetAd->APT : ""; ?>"></td><td><span style="font-size:15px;">Floor:</span><br><input class="form-control" type="text" id="simpleFLOOR" name="FLOOR" size="4" value="<?php echo isset($rowGetAd) ? $rowGetAd->FLOOR : ""; ?>"></td>
</tr>
<tr>
<td><span style="font-size:15px;">Zip:</span><br><input class="form-control" type="text" id="simpleZIP" name="ZIP" size="11" value="<?php echo isset($rowGetAd) ? $rowGetAd->ZIP : ""; ?>"></td>
<td><span style="font-size:15px;">Cross Street:</span><br><input class="form-control" type="text" id="simplexstreet" name="xstreet" size="24" value="<?php echo isset($rowGetAd) ? $rowGetAd->xstreet : ""; ?>"></td>
</tr>
<tr>
<td colspan="2"><span style="font-size:15px;">Building Name:</span><br><input class="form-control" type="text" id="simpleBUILDING_NAME" name="BUILDING_NAME" size="50" value="<?php echo isset($rowGetAd) ? $rowGetAd->BUILDING_NAME : ""; ?>"></td>
</tr>

</table>

<TABLE><TR><TD VALIGN="TOP">

<div class="ad" align="left">

<?php

if (isset($LLID)) {?>
Landlord:<BR>
<select class="form-control"  id="simpleLANDLORD" name="LANDLORD"  STYLE="Background-Color : #FFFFFF; width: 160px">
	<option value="--">--</option>
	<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) {?>
	<option value="<?php echo $rowGetLandlord->LID; ?>" <?php if ($LLID == $rowGetLandlord->LID) {echo " selected ";}?>><?php echo $rowGetLandlord->SHORT_NAME; ?></option>
	<?php }?>
</select>

<?php } else {?>
Landlord:<BR>
<select class="form-control" id="simpleLANDLORD" name="LANDLORD" STYLE="Background-Color : #FFFFFF; width: 160px">
	<option value="--">--</option>
	<?php while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) {?>
	<option value="<?php echo $rowGetLandlord->LID; ?>" <?php if (isset($rowGetAd) and $rowGetAd->LANDLORD == $rowGetLandlord->LID) {echo " selected ";}?>><?php echo $rowGetLandlord->SHORT_NAME; ?></option>
	<?php }?>
</select>

<?php }?>



<BR>

<a href="<?php echo "$PHP_SELF?op=createLandlord"; ?>" target="_NEW">Create New Landlord</a><BR>
<a href="<?php echo "$PHP_SELF?op=editLandlord&lid=" . (isset($rowGetAd) ? $rowGetAd->LANDLORD : ""); ?>." target="_NEW">Edit Landlord</a>
</DIV>


</TD><TD VALIGN="TOP">
<?php
if ($_SESSION["isAdmin"] or $_SESSION["user_level"] >= "4") {?>
	<td align="right" VALIGN="TOP">
<div class="ad" align="left">
Change Agent:<br>
	<select class="form-control" name="UID" STYLE="Background-Color : #FFFFFF">
		<?php while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) {?>
		<option value="<?php echo $rowGetUsers->UID; ?>"<?php if (isset($rowGetAd) and $rowGetAd->UID == $rowGetUsers->UID) {echo "selected ";} elseif (isset($rowGetAd) and $rowGetAd->UID == null and $rowGetUsers->UID == $uid) {echo "selected ";}?>><?php echo $rowGetUsers->HANDLE; ?></option>
		<?php }?>
	</select></td>
<?php }?>
</DIV>
<TD  VALIGN="TOP">
<img src="../assets/images/wht_spacer.gif" width="15" height="0">
</TD><TD align="right"  VALIGN="TOP">

<?php
if (($_SESSION["isAdmin"] && $_SESSION["agcy"] > 0) or ($_SESSION["user_level"] >= "4" && $_SESSION["agcy"] > 0)) {
    $quStrGetAgencies = "SELECT * FROM AGENCIES WHERE GID=$grid";
    $quGetAgencies = mysqli_query($GLOBALS['dbh'], $quStrGetAgencies) or die($quStrGetAgencies);
    $num_agencies = mysqli_num_rows($quGetAgencies);
    if ($num_agencies > 0) {
        while ($rowAgency = mysqli_fetch_object($quGetAgencies)) {
            $arrayAgency[$rowAgency->AGENCY_ID] = $rowAgency->AGENCY_NAME;
        }
        echo "<div class=ad align=left>Change Agency:<br><select class='form-control' name=AGENCY_HEADERS1 STYLE=Background-Color : #FFFFFF>";
        ?>
        <option value=0 <?php if ($key = 0) {echo " selected ";}?>
                >Main Agency</option>
        <?php foreach ($arrayAgency as $key => $value) {
            ?>
                <option value="<?php echo $key; ?>"
        <?php if (isset($rowGetAd) and $key == $rowGetAd->AGENCY_HEADERS) {echo " selected ";}
            ?> >
                <?php echo $value; ?></option>
        <?php
//             echo "$key $value";
        }
        echo "</select></DIV>";
    }?>
<?php }?>


</TD></TR></TABLE>


</TD><TD WIDTH="10"> <img src="../assets/images/wht_spacer.gif" width="10" height="0"> </TD><TD VALIGN="TOP" <?php if (isset($rowGetAd) and $rowGetAd->CLI != "") {?> BGCOLOR="#FFFFCC" <?php }?> ALIGN=LEFT WIDTH="210">



<?php if (isset($rowGetAd) and $rowGetAd->CLI != "") {?>

<TABLE CELLPADDING="5" WIDTH="210" BORDER="1"><TR><TD>
<CENTER><B>Helpful Tools</B></CENTER>

<span style="font-size:12px;">

<B>NEARBY:</B><BR>

<LI><A HREF="https://mbta.com/transit-near-me?_utf8=✓&location%5Baddress%5D=<?php echo isset($rowGetAd) ? $rowGetAd->STREET_NUM : "" . "" . $rowGetAd->STREET . " " . $rowGetAd->ZIP; ?>" target="_NEW">MBTA</A><LI><A HREF="http://maps.google.com/maps?hl=en&um=1&ie=UTF-8&q=laundromat&near=<?php echo isset($rowGetAd) ? $rowGetAd->STREET_NUM : ""; ?>+<?php echo isset($rowGetAd) ? $rowGetAd->STREET : ""; ?>+<?php echo isset($rowGetAd) ? $rowGetAd->ZIP : ""; ?>&fb=1&sa=X&oi=local_group&resnum=1&ct=image" target="_NEW">Laundry</A><BR>
<LI>
<A HREF="http://maps.google.com/maps?hl=en&um=1&ie=UTF-8&q=supermarket&near=<?php echo isset($rowGetAd) ? $rowGetAd->STREET_NUM : ""; ?>+<?php echo isset($rowGetAd) ? $rowGetAd->STREET : ""; ?>+<?php echo isset($rowGetAd) ? $rowGetAd->ZIP : ""; ?>&fb=1&sa=X&oi=local_group&resnum=1&ct=image" target="_NEW">Supermarket</A><BR>
<LI><A HREF="http://maps.google.com/maps?hl=en&um=1&ie=UTF-8&q=convenience+store&near=<?php echo isset($rowGetAd) ? $rowGetAd->STREET_NUM : ""; ?>+<?php echo isset($rowGetAd) ? $rowGetAd->STREET : ""; ?>+<?php echo isset($rowGetAd) ? $rowGetAd->ZIP : ""; ?>&fb=1&sa=X&oi=local_group&resnum=1&ct=image" target="_NEW">Convenience Store</A></NOBR><BR>

<LI><A HREF="http://maps.google.com/maps?f=&hl=&q=+<?php echo isset($rowGetAd) ? $rowGetAd->STREET_NUM : ""; ?>+<?php echo isset($rowGetAd) ? $rowGetAd->STREET : ""; ?>+<?php echo isset($rowGetAd) ? $rowGetAd->ZIP : ""; ?>" target="_NEW">Google Map</A><BR>


<LI><A HREF="https://www.walkscore.com/score/<?=$rowGetAd->STREET_NUM?>-<?=$rowGetAd->STREET?>-<?=$rowGetAd->ZIP?>" target="_Walk">Walk Score</A><SUP><FONT SIZE="-2">TM</FONT></SUP><BR>


<LI><A HREF="http://www.zillow.com/search/RealEstateSearch.htm?dg=dg2&addrstrthood=<?php echo isset($rowGetAd) ? $rowGetAd->STREET_NUM : ""; ?>+<?php echo isset($rowGetAd) ? $rowGetAd->STREET : ""; ?>&citystatezip=<?php echo isset($rowGetAd) ? $rowGetAd->ZIP : ""; ?>&GOButton=" target="_NEW">Zillow Zestimate</A><SUP><FONT SIZE="-2">TM</FONT></SUP><BR>

<LI><A HREF="http://massachusetts.schooltree.org/<?php echo isset($rowGetAd) ? $rowGetAd->ZIP : ""; ?>.html" target="_NEW">School Information</A><BR>

<LI><a href="https://www.BostonApartments.com/listing.php?cli=<?php echo $grid; ?>&ad=<?php echo $cid; ?>" target="_NEW">Preview Ad</a><BR>

<LI><a href="https://www.BostonApartments.com/viewsource.php?u=homepage.php?cli=<?php echo $grid; ?>%26ad=<?php echo $cid; ?>%26uid=<?php echo $uid; ?>" target="_NEW">HTML Ad Maker - Office</A><BR>

<LI><A HREF="https://www.BostonApartments.com/clpost-htmlmaker.php?ad=<?php echo $cid; ?>&cli=<?php echo $grid; ?>&uid=<?php echo $uid; ?>" target="_NEWHTML">HTML Ad Maker - Agent</A><BR>


<LI><a href="https://www.BostonApartments.com/digpost.php?cli=<?php echo isset($rowGetAd) ? $rowGetAd->CLI : ""; ?>&amp;ad=<?php echo $cid; ?>&amp;uid=<?php echo $uid; ?>" target="_NEW">Post To Dig/Backpage.com</A><BR>

<LI><a href="http://crimereports.com/map?search=<?php echo isset($rowGetAd) ? $rowGetAd->STREET_NUM : ""; ?>+<?php echo isset($rowGetAd) ? $rowGetAd->STREET : ""; ?>%2C+<?php echo isset($rowGetAd) ? $rowGetAd->LOCNAME : ""; ?>%2C+<?php echo isset($rowGetAd) ? $rowGetAd->ZIP : ""; ?>&searchButton.x=0&searchButton.y=0&searchButton=SEARCH" target="_NEW">CrimeReports.com</A><BR>


</SPAN>
</TD></TR></TABLE>

<?php }?>

</TD></TR></TABLE>
<CENTER>

<?php if (isset($rowGetAd) and $rowGetAd->CLI == "1") {?>

<BR>
<TABLE><TR><TD>Alternative Signature:<BR>
<textarea name="ALTSIG" id="ALTSIG" cols="60" rows="5" value="<?php echo htmlspecialchars($rowGetAd->ALTSIG); ?>"><?php echo isset($rowGetAd) ? $rowGetAd->ALTSIG : ""; ?></textarea>
</TD><TD>&nbsp;

</TD><TD>
Special Order:<BR>
<input type="text" size="5" id="SPORDER" name="sporder" value="<?php echo isset($rowGetAd) ? $rowGetAd->SPORDER : ""; ?>">
</TD></TR></TABLE>

<!-- <div class="col-md-4">
<div class="panel">
<div class="panel-heading">
Test
</div>
<div class="panel-body">
Body
</div>
</div>
</div>
-->

<?php }?>



<table width="90%" BORDER=0>
<tr>
<td align="center">
<?php if (($_SESSION["user_level"] > "0" and isset($rowGetAd) and $rowGetAd->LOCKED == "0") or (isset($rowGetAd) and $rowGetAd->LOCKED == "1" and $_SESSION["user_level"] >= "4") or ((!($cid)) and $_SESSION["user_level"] > "0")) {

    ?>
<!-- <A HREF="javascript: void 0" ONCLICK="validateAdlEdit('simple');"><IMG SRC="../assets/images/save.gif" BORDER="0"></A> -->

<!-- <button onClick="validateAdlEdit('simple');" class="button-green pure-button">Save</button> -->
<button onClick="validateAdlEdit('simple');" class="btn btn-success">Save</button>

<!-- <input onClick="validateAdlEdit('simple');" type="button" value="Save" STYLE="Background-Color : #adffad"> -->


<?php } else {echo "<font color=red>Listing Locked</font>";}?>
</td>
</tr>
</table></CENTER>
</div>


<?php
if ($_SESSION["pref_adl_view"] == 1) {
    $display = "none";
} elseif ($_SESSION["pref_adl_view"] == 2) {
    $display = "block";
}?>
<div id="fullArea" style="width:98%; margin:0px auto; padding:8px; background-color:<?php echo $pagebgcolor; ?>; border:1px solid black;display:<?php echo $display; ?>;">



<table width="100%" BORDER=0>
			<tr>

	<td height="30" width="20"><span style="font-size:15px;">Landlord/Owner:<BR>
<select class="form-control" id="fullLANDLORD" name="LANDLORD" STYLE="Background-Color : #FFFFFF; width: 160px" onChange="syncMeSelect2('fullLANDLORD', 'simpleLANDLORD');">

<?php if (isset($LLID)) {
    ?>

	<option value="--">--</option>
	<?php
mysqli_data_seek($quLandlord, 0);
    while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) {?>
	<option value="<?php echo $rowGetLandlord->LID; ?>" <?php if ($LLID == $rowGetLandlord->LID) {echo " selected ";}?>><?php echo $rowGetLandlord->SHORT_NAME; ?></option>
	<?php }?>
</select>

<?php } else {
    ?>
			<option value="--">--</option>
			<?php
mysqli_data_seek($quLandlord, 0);
    while ($rowGetLandlord = mysqli_fetch_object($quLandlord)) {?>
			<option value="<?php echo $rowGetLandlord->LID; ?>" <?php if (isset($rowGetAd) and $rowGetAd->LANDLORD == $rowGetLandlord->LID) {echo " selected ";}?>><?php echo $rowGetLandlord->SHORT_NAME; ?></option>
			<?php }?>

<?php }?>

</select></td>
			<td height="30">

<span style="font-size:15px;">Location:<BR></span><select class="form-control" id="fullLOC" name='LOC' STYLE="Background-Color : #FFFFFF" onChange="syncMeSelect2('fullLOC', 'simpleLOC');">
			<option value="--">Please choose a location:</option>
			<?php
mysqli_data_seek($quFavLocs, 0);
mysqli_data_seek($quLocs, 0);
while ($rowFavLocs = mysqli_fetch_object($quFavLocs)) {?>
			<option value="<?php echo $rowFavLocs->LOCID; ?>"><?php echo $rowFavLocs->LOCNAME; ?></option>
			<?php }?>
			<option value="0">--------------------</option>

			<?php while ($rowLocs = mysqli_fetch_object($quLocs)) {?>
				<option value="<?php echo $rowLocs->LOCID; ?>" <?php if (isset($rowGetAd) and $rowGetAd->LOC == $rowLocs->LOCID) {echo " selected";}?> >
				<?php echo $rowLocs->LOCNAME; ?></option>
			<?php }?>
			</select>

</td>
			<td height="30"><span style="font-size:15px;">Type:<BR></span><select class="form-control" id="fullTYPE" name="TYPE" onChange="setFlagFee(this.options[this.selectedIndex].value);" STYLE="Background-Color : #FFFFFF">
			<?php
mysqli_data_seek($quTypes, 0);
while ($rowTypes = mysqli_fetch_object($quTypes)) {
    ?>
				<option value="<?php echo $rowTypes->TYPE; ?>" <?php if (isset($rowGetAd) and $rowGetAd->TYPE == $rowTypes->TYPE) {
        echo " selected";}?> >
				<?php echo $rowTypes->TYPENAME; ?></option>
			<?php }?>
			</select></td>
<TD>
<!-- <A HREF="javascript: void 0" ONCLICK="validateAdlEdit('full');"><IMG SRC="../assets/images/save.gif" BORDER="0"></A> -->
<?php if (($_SESSION["user_level"] > "0" and isset($rowGetAd) and $rowGetAd->LOCKED == "0") or (isset($rowGetAd) and $rowGetAd->LOCKED == "1" and $_SESSION["user_level"] >= "4") or ((!($cid)) and $_SESSION["user_level"] > "0")) {
    ?>

<!-- <button  onClick="validateAdlEdit('full');" class="button-green pure-button">Save</button> -->
<button  onClick="validateAdlEdit('full');" class="btn btn-success mt-2" style="width: 100%">Save</button>

<!-- <input onClick="validateAdlEdit('full');" type="button" value="Save" STYLE="Background-Color : #adffad"> -->

<?php } else {echo "<font color=red>Listing Locked</font>";}?>
</TD>
			</tr>
</TABLE>


<TABLE WIDTH="100%" BORDER=0>
			<tr>
			<td height="30" width="20">



<TABLE BORDER=0><TR><TD>
<span style="font-size:15px;">Bedrooms:<BR></span><select class="form-control" id="fullROOMS" name="ROOMS" STYLE="Background-Color : #FFFFFF" onChange="syncMeSelect2('fullROOMS', 'simpleROOMS');">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['ROOMS'] as $key => $roomsValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->ROOMS == $key) ? " selected " : "";?>
					<option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $roomsValue; ?></option>
				<?php }?>
			</select>

</TD><TD>
			<span style="font-size:15px;">Bathrooms:<BR></span><select class="form-control" id="fullBATH" name="BATH" STYLE="Background-Color : #FFFFFF" onChange="syncMeSelect2('fullBATH', 'simpleBATH');">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['BATH'] as $bkey => $bathValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->BATH == $bkey) ? " selected " : "";?>
				<option value="<?php echo $bkey; ?>" <?php echo $selected; ?>><?php echo $bathValue; ?></option>
				<?php }?>
			</select>

</TD>
		<td align="left">

<span style="font-size:15px;"><NOBR>Tot. # Rooms:</NOBR><BR></span><input class="form-control" type="text" size="5" id="fullTOTAL_NUM_ROOMS" name="TOTAL_NUM_ROOMS" value="<?php echo isset($rowGetAd) ? $rowGetAd->TOTAL_NUM_ROOMS : ""; ?>">
</TD>
<TD align="left">
<span style="font-size:15px;"><NOBR>Interior SqFt:</NOBR><BR></span>

<input class="form-control" type="text" size="5" name="SQFT" value="<?php echo isset($rowGetAd) ? $rowGetAd->SQFT : ""; ?>">

</td>


    <td align="left">
<div id="saleSpec3" style="display:<?php echo isset($sale_display) ? $sale_display : ""; ?>;">
<span style="font-size:15px;"><NOBR>Lot Size:</NOBR><br></span>
	<input class="form-control" id="LOT_SIZE" name="LOT_SIZE" type="text" size="6" value="<?php echo isset($rowGetAd) ? $rowGetAd->LOT_SIZE : ""; ?>" onchange="javascript:ChangeAcres();">

</DIV>
	</td>



    <td align="left">
<div id="saleSpec4" style="display:<?php echo isset($sale_display) ? $sale_display : ""; ?>;">
<span style="font-size:15px;"><NOBR>Acres:</NOBR><br></span>
	<input class="form-control" id="ACRES" name="ACRES" type="text" size="6" value="<?php echo isset($rowGetAd) ? $rowGetAd->ACRES : ""; ?>" onchange="javascript:ChangeLot_Size();">
</DIV>
</TD>



<td height="30"><span style="font-size:15px;">


<div id="saleSpec2" style="display:<?php echo isset($sale_display) ? $sale_display : ""; ?>;">

<CENTER>
<span style="font-size:15px;">Sale Status:</span> <select class="form-control" id="fullSTATUS_SALE" name="STATUS_SALE" STYLE="Background-Color : #FFFFFF" onChange="setFlagFee(this.selectedIndex); syncMeSelect2('fullSTATUS_SALE', 'simpleSTATUS_SALE');">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['STATUS_SALE'] as $sskey => $ssValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->STATUS_SALE == $sskey) ? " selected " : "";?>
						<option value="<?php echo $sskey; ?>" <?php echo $selected; ?>><?php echo $ssValue; ?></option>
					<?php }?>
			</select>
</CENTER>
</DIV>




<NOBR>&nbsp; Advertising:<input type="hidden" name="STATUS" value="STO"><input id="fullSTATUS" type="checkbox" value="ACT"  TITLE="Check to mark listing Active/Advertised" name="STATUS" <?php if (isset($rowGetAd) and (($rowGetAd->STATUS == "STO") or (($rowGetAd->CID == "") and ($actsto == "STO")))) {echo "";} else {echo " checked ";}?> onClick="(syncMeSelect('fullSTATUS', 'simpleSTATUS'));">


&nbsp;

Occupied:<input type="hidden" name="VACANT" value="0"><input type="checkbox" value="1"  TITLE="Check to mark unit Occupied" name="VACANT" <?php if (isset($rowGetAd) and $rowGetAd->VACANT) {echo " checked ";}?>>

&nbsp;

 Available:<input type="hidden" name="STATUS_ACTIVE" value="0"><input id="fullSTATUS_ACTIVE" type="checkbox" onClick="adlEditView='full';syncMeSelect2('fullSTATUS_ACTIVE', 'simpleSTATUS_ACTIVE');" value="1"  TITLE="Check to mark Listing Available" name="STATUS_ACTIVE" <?php if (!$cid) {echo "checked";} elseif (isset($rowGetAd) and $rowGetAd->STATUS_ACTIVE) {echo " checked ";}?>>
&nbsp;
Pending:<input type="hidden" name="STATUS_PENDING" value="0"><input id="STATUS_PENDING" type="checkbox" value="1" TITLE="Check to mark Listing Pending" name="STATUS_PENDING" <?php if (isset($rowGetAd) and $rowGetAd->STATUS_PENDING == "1") {echo " checked ";}?>>
&nbsp;

Priority:<input type="hidden" name="PRIORITY" value="0"><input id="PRIORITY" type="checkbox" value="1" TITLE="Check to mark it a Priority Listing" name="PRIORITY" <?php if (isset($rowGetAd) and $rowGetAd->PRIORITY == "1") {echo " checked ";}?>>

&nbsp;

<?php
if (($_SESSION["isAdmin"]) or ($_SESSION["user_level"] >= "4")) {?>

Locked:<input type="hidden" name="LOCKED" value="0"><input id="LOCKED" type="checkbox" value="1" TITLE="Check to LOCK Listing for Admin" name="LOCKED" <?php if (isset($rowGetAd) and $rowGetAd->LOCKED == "1") {echo " checked ";}?>>
<?php } else {
    if (isset($rowGetAd) and $rowGetAd->LOCKED == "1") {
        echo "<FONT COLOR=RED>LOCKED</FONT>";
    }}?>

</NOBR></SPAN></td>


</TR></TABLE>



</td>
</tr>
</TABLE>

<CENTER>



<TABLE WIDTH="100%" BORDER=0><TR>

			<td height="30"  ALIGN="LEFT">

<CENTER>
				<TABLE BORDER=0 CELLPADDING="0" CELLSPACING="0">
				<tr>
				<td><span style="font-size:15px;">Heating:<BR></span> <select class="form-control" name="HEATING_RESP" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['HEATING_RESP'] as $hskey => $hsValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->HEATING_RESP == $hskey) ? " selected " : "";?>
						<option value="<?php echo $hskey; ?>" <?php echo $selected; ?>><?php echo $hsValue; ?></option>
					<?php }?>
			</select></CENTER></td>
				<td><span style="font-size:15px;">Fuel:<BR></span><select class="form-control" name="HEATING_TYPE" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['HEATING_TYPE'] as $htkey => $htValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->HEATING_TYPE == $htkey) ? " selected " : "";?>
						<option value="<?php echo $htkey; ?>" <?php echo $selected; ?>><?php echo $htValue; ?></option>
					<?php }?>
			</select></td>

				<td><span style="font-size:15px;">Type:<BR></span><select class="form-control" name="HEATING_TYPE2" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['HEATING_TYPE2'] as $ht2key => $ht2Value) {
    $selected = (isset($rowGetAd) and $rowGetAd->HEATING_TYPE2 == $ht2key) ? " selected " : "";?>
						<option value="<?php echo $ht2key; ?>" <?php echo $selected; ?>><?php echo $ht2Value; ?></option>
					<?php }?>
			</select></td>
</tr></TABLE>

</td>
<td colspan="2" align="left">

<table BORDER=0 CELLPADDING="0" CELLSPACING="0"><tr>
				 <td><span style="font-size:15px;">Hot Water:<BR></span> <select class="form-control" name="HOT_WATER_RESP" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['HOT_WATER_RESP'] as $hwkey => $hwValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->HOT_WATER_RESP == $hwkey) ? " selected " : "";?>
						<option value="<?php echo $hwkey; ?>" <?php echo $selected; ?>><?php echo $hwValue; ?></option>
					<?php }?>
			</select></td>

				<td><span style="font-size:15px;">Fuel:<BR></span><select class="form-control" name="HOT_WATER_TYPE" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['HOT_WATER_TYPE'] as $hwkey => $hwValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->HOT_WATER_TYPE == $hwkey) ? " selected " : "";?>
					<option value="<?php echo $hwkey; ?>" <?php echo $selected; ?>><?php echo $hwValue; ?></option>
					<?php }?>
			</select></td>


				 <td><span style="font-size:15px;">Electricity:<BR></span> <select class="form-control" name="ELECTRICITY_RESP" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['ELECTRICITY_RESP'] as $elekey => $eleValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->ELECTRICITY_RESP == $elekey) ? " selected " : "";?>
						<option value="<?php echo $elekey; ?>" <?php echo $selected; ?>><?php echo $eleValue; ?></option>
					<?php }?>
			</select></td>


				 <td><span style="font-size:15px;">Water Resp:<BR></span> <select class="form-control" name="WATER_RESP" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['WATER_RESP'] as $waterkey => $waterValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->WATER_RESP == $waterkey) ? " selected " : "";?>
						<option value="<?php echo $waterkey; ?>" <?php echo $selected; ?>><?php echo $waterValue; ?></option>
					<?php }?>
			</select></td>


</tr></table>
</td>

			<td align="left" valign="bottom"><span style="font-size:15px;">Pets:<BR></span>
<select class="form-control" id="fullPETSA" name="PETSA" STYLE="Background-Color : #FFFFFF" onChange="syncMeSelect('fullPETSA', 'simplePETSA');">
			<option value="--">--</option>
			<?php foreach ($DEFINED_VALUE_SETS['PETSA'] as $petkey => $petVal) {?>
			<option value="<?php echo $petkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->PETSA == $petkey) {echo " selected ";}?>><?php echo $petVal; ?></option>
			<?php }?>
			</select></td>




		</tr>
		</table>

		<hr noshade size="1" color="black">


<table BORDER="0" CELLPADDING="0" CELLSPACING="0">
			<tr>
			<td height="30" align="left"><span style="font-size:15px;"><NOBR>Street #:</NOBR><BR></SPAN><input class="form-control" type="text" id="fullSTREET_NUM" name="STREET_NUM" size="4" value="<?php echo isset($rowGetAd) ? $rowGetAd->STREET_NUM : ""; ?>" STYLE="Background-Color : #FFFFFF" onChange="syncMeSelect2('fullSTREET_NUM', 'simpleSTREET_NUM');"></td>
			<td height="30" colspan="3" width="1">&nbsp;</td>
			<td height="30" ><span style="font-size:15px;">Street Address:<BR></span><input class="form-control" type="text" id="fullSTREET" name="STREET" size="22" value="<?php echo isset($rowGetAd) ? $rowGetAd->STREET : ""; ?>" STYLE="Background-Color : #FFFFFF" onChange="syncMeSelect2('fullSTREET', 'simpleSTREET');"></td>
			<td height="30" width="1">&nbsp;</td>
			<td height="30" ><span style="font-size:15px;"><NOBR>Apt #:</NOBR><BR></span><input class="form-control" type="text" id="fullAPT" name="APT" size="4" value="<?php echo isset($rowGetAd) ? $rowGetAd->APT : ""; ?>" onChange="syncMeSelect2('fullAPT', 'simpleAPT');"></td>
			<td height="30" width="1">&nbsp;</td>
			<td height="30" ><span style="font-size:15px;">Floor:<BR></span><input class="form-control" type="text" id="fullFLOOR" name="FLOOR" size="2" value="<?php echo isset($rowGetAd) ? $rowGetAd->FLOOR : ""; ?>" onChange="syncMeSelect2('fullFLOOR', 'simpleFLOOR');"></td>
			<td height="30" width="1">&nbsp;</td>
			<td align="left" height="30" ><span style="font-size:15px;">Zip:<BR></span><input class="form-control" type="text" id="fullZIP" name="ZIP" size="10" value="<?php echo isset($rowGetAd) ? $rowGetAd->ZIP : ""; ?>" STYLE="Background-Color : #FFFFFF" onChange="syncMeSelect2('fullZIP', 'simpleZIP');"></td>
			<td height="30" width="1">&nbsp;</td>
    			<td>
<span style="font-size:15px;">Cross Street:</span><br><input class="form-control" type="text" id="fullxstreet" name="xstreet" size="22" value="<?php echo isset($rowGetAd) ? $rowGetAd->xstreet : ""; ?>" STYLE="Background-Color : #FFFFFF"  onChange="syncMeSelect2('fullxstreet', 'simplexstreet');">

			</td>

						<td height="30" width="1">&nbsp;</td>
    			<td><NOBR>
<span style="font-size:15px;">Building Name:</span><br><input class="form-control" type="text" id="fullBUILDING_NAME" name="BUILDING_NAME" size="35" value="<?php echo isset($rowGetAd) ? $rowGetAd->BUILDING_NAME : ""; ?>" STYLE="Background-Color : #FFFFFF"  onChange="syncMeSelect2('fullBUILDING_NAME', 'simpleBUILDING_NAME');">
</NOBR>
			</td>


			</tr>
</table>
		<hr noshade size="1" color="black">


<table BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
<tr><TD>

		<table BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
			<tr>
			<td align="center" valign="middle" colspan=1><span style="font-size:11px;"><B>Price</B></span></td>
			<TD ROWSPAN="2" WIDTH="25"><FONT SIZE="-4">&nbsp;</FONT></TD>
			<TD ROWSPAN="2" WIDTH="1"><FONT SIZE="-4">&nbsp;</FONT></TD>
			<TD ROWSPAN="2" WIDTH="1"><FONT SIZE="-4">&nbsp;</FONT></TD>
			<TD ROWSPAN="2" WIDTH="25"><FONT SIZE="-4">&nbsp;</FONT></TD>
			</TD><TD ALIGN="CENTER" COLSPAN=3><span style="font-size:11px;"><NOBR><B>Available</B> <?php
if (isset($rowGetAd->CID)) {
    if ($_SESSION["user_level"] > "0") {

        ?>
<!-- <span onClick="<?php echo $SaveAd; ?>">
<a href="<?php // echo $PHP_SELF;?>?op=dateavailablenowdo&amp;cid=<?php // echo isset($rowGetAd) ? $rowGetAd->CID;?>&amp;grid=<?php // echo $grid;?>&amp;next_contact=<?php // echo isset($rowGetAd) ? $rowGetAd->AVAIL;?>" target="_datechange"><FONT SIZE="-3" COLOR="green">Make Now</FONT></A>
</SPAN> -->

<?php }}
?>
</NOBR><br>

</SPAN></TD>
			<TD ROWSPAN="2" WIDTH="25"><FONT SIZE="-4">&nbsp;</FONT></TD>
			<TD ROWSPAN="2" WIDTH="1"><FONT SIZE="-4">&nbsp;</FONT></TD>
			<TD ROWSPAN="2" WIDTH="1"><FONT SIZE="-4">&nbsp;</FONT></TD>
			<TD ROWSPAN="2" WIDTH="25"><FONT SIZE="-4">&nbsp;</FONT></TD>
			<TD COLSPAN="3" align="center"><span style="font-size:11px;"><B>Parking</B></SPAN></CENTER></TD></TR><TR>


			<td height="30">

<TABLE><TR><TD VALIGN="BOTTOM">
<span style="font-size:15px;">Price:<BR></SPAN><NOBR>
	<div class="controltext input-group ">
						<!-- <BR> -->
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="basic-addon1">$</span>
						  </div>
<input class="form-control" type="text" id="fullPRICE" name="PRICE" size="8" value="<?php echo isset($rowGetAd) ? $rowGetAd->PRICE : ""; ?>" onChange="(syncMeSelect2('fullPRICE', 'simplePRICE'));">

						</div>

<!-- <input type="text" id="fullPRICE" name="PRICE" size="8" value="<?php echo isset($rowGetAd) ? $rowGetAd->PRICE : ""; ?>" onChange="(syncMeSelect2('fullPRICE', 'simplePRICE'));"> -->

</NOBR></td><TD VALIGN="BOTTOM">
<span style="font-size:15px;"><NOBR>Price negotiable:</NOBR><br><NOBR>No&nbsp; <input type="radio" value="0" name="PRICE_NEG" <?php if (isset($rowGetAd) and !$rowGetAd->PRICE_NEG) {echo "checked";}?> > Yes <input type="radio" value="1" name="PRICE_NEG" <?php if (isset($rowGetAd) and $rowGetAd->PRICE_NEG) {echo "checked";}?> >
</NOBR></SPAN>
</TD></TR></TABLE>


</TD><TD>

<?php
$getMon = null;
$getDay = null;
$getYear = null;
if (isset($rowGetAd->CID)) {
    $getMon = subStr($rowGetAd->AVAIL, 5, 2);
    $getDay = subStr($rowGetAd->AVAIL, 8, 2);
    $getYear = subStr($rowGetAd->AVAIL, 0, 4);
}
?>

			<span style="font-size:15px;">Month:<BR></span><select class="form-control" id="fullbbbMonth" name="bbbMonth" STYLE="Background-Color : #FFFFFF"  onChange="syncMeSelect('fullbbbMonth', 'simplebbbMonth');">
				<option value="--">--</option>
				<option value="01" <?php if ($getMon == "01") {echo " selected ";}?>>Jan</option>
				<option value="02" <?php if ($getMon == "02") {echo " selected ";}?>>Feb</option>
				<option value="03" <?php if ($getMon == "03") {echo " selected ";}?>>Mar</option>
				<option value="04" <?php if ($getMon == "04") {echo " selected ";}?>>Apr</option>
				<option value="05" <?php if ($getMon == "05") {echo " selected ";}?>>May</option>
				<option value="06" <?php if ($getMon == "06") {echo " selected ";}?>>Jun</option>
				<option value="07" <?php if ($getMon == "07") {echo " selected ";}?>>Jul</option>
				<option value="08" <?php if ($getMon == "08") {echo " selected ";}?>>Aug</option>
				<option value="09" <?php if ($getMon == "09") {echo " selected ";}?>>Sep</option>
				<option value="10" <?php if ($getMon == "10") {echo " selected ";}?>>Oct</option>
				<option value="11" <?php if ($getMon == "11") {echo " selected ";}?>>Nov</option>
				<option value="12" <?php if ($getMon == "12") {echo " selected ";}?>>Dec</option>
			</select></td>
			<td height="30" ><span style="font-size:15px;">Day:<BR></span><select class="form-control" id="fullbbbDay" name="bbbDay" STYLE="Background-Color : #FFFFFF" onChange="syncMeSelect('fullbbbDay', 'simplebbbDay');">
				<option value="--">--</option>
				<?php for ($i = 1; $i <= 31; $i++) {
    if ($i <= 9) {
        $j = "0" . $i;
    } else {
        $j = $i;
    }
    ?>
				<option value="<?php echo $j; ?>" <?php if ($getDay == $j) {echo " selected ";}?>><?php echo $j; ?></option>
				<?php }?>
			</select></td>
			<td height="30" ><span style="font-size:15px;">Year:<BR></span><select class="form-control" id="fullbbbYear" name="bbbYear" STYLE="Background-Color : #FFFFFF" onChange="syncMeSelect('fullbbbYear', 'simplebbbYear');">
				<option value="--">--</option>
				<?php
$thisYear = date("Y") - 2;
for ($i = 0; $i <= 6; $i++) {?>
				<option value="<?php echo ($thisYear + $i); ?>" <?php if ($getYear == ($thisYear + $i)) {echo " selected ";}?>><?php echo ($thisYear + $i); ?></option>
				<?php }?>
			</select></td>


</TD>

			<td height="30"><span style="font-size:15px;"># of spaces:<BR></span>
<select class="form-control" id="fullPARKING_NUM" name="PARKING_NUM" STYLE="Background-Color : #FFFFFF" onChange="syncMeSelect('fullPARKING_NUM', 'simplePARKING_NUM');">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['PARKING_NUM'] as $pknkey => $pknValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->PARKING_NUM == $pknkey) ? " selected " : "";?>
						<option value="<?php echo $pknkey; ?>" <?php echo $selected; ?>><?php echo $pknValue; ?></option>
					<?php }?>
			</select></td>

			<td height="30"><span style="font-size:15px;">Type:<BR></span>
<select class="form-control" id="fullPARKING_TYPE" name="PARKING_TYPE" STYLE="Background-Color : #FFFFFF"  onChange="syncMeSelect('fullPARKING_TYPE', 'simplePARKING_TYPE');">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['PARKING_TYPE'] as $parkkey => $parkVal) {?>
					<option value="<?php echo $parkkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->PARKING_TYPE == $parkkey) {echo " selected ";}?> > <?php echo $parkVal; ?> </option>
				<?php }?>
			</select></td>

	<td height="30"><span style="font-size:15px;"><NOBR>Cost/Space:</NOBR><BR></span>

	<div class=" input-group ">
						<!-- <BR> -->
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="basic-addon1">$</span>
						  </div>

	<input class="form-control" type="text" id="fullPARKING_COST" name="PARKING_COST" size="5" value="<?php echo isset($rowGetAd) ? $rowGetAd->PARKING_COST : ""; ?>" onFocus="syncMeSelect('fullPARKING_COST', 'simplePARKING_COST');">
						</div>
</td>


			</tr>
			</table>

</TD></TR></TABLE>



<div id="rentalSpec" style="display:<?php echo isset($rental_display) ? $rental_display : ""; ?>;">
			<table WIDTH="100%" BORDER=0>
			<tr>
			<td height="30" width="20" VALIGN="TOP"><span style="font-size:15px;"><nobr>Fee (tenant):</nobr><BR></span><select  class="form-control" id="fullNOFEE" name="NOFEE" STYLE="Background-Color : #FFFFFF" onChange="syncMeSelect('fullNOFEE', 'simpleNOFEE');">

					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['NOFEE'] as $fkey => $fValue) {
    $selected = (isset($rowGetAd) and $rowGetAd->NOFEE == $fkey) ? " selected " : "";?>
						<option value="<?php echo $fkey; ?>" <?php echo $selected; ?>><?php echo $fValue; ?></option>
					<?php }?>
			</select></td>

			<td height="30" width="10">&nbsp;  </TD>

			<td height="30" VALIGN="TOP">
			<span style="font-size:15px;"><nobr>Fee Comments (agent eyes only):</nobr><BR></span>
			<input  class="form-control" type="text" id="fullFEE_COMMENTS" name="FEE_COMMENTS" size="50" value="<?php echo isset($rowGetAd) ? $rowGetAd->FEE_COMMENTS : ""; ?>" STYLE="Background-Color : #FFFFFF" onChange="syncMeSelect2('fullFEE_COMMENTS', 'simpleFEE_COMMENTS');">

			</td>
			<td height="30" width="1">&nbsp;</td>
			<td height="30" VALIGN="TOP"><span style="font-size:15px;">Lease type:<BR></SPAN><select  class="form-control" name="LEASE_TYPE" STYLE="Background-Color : #FFFFFF">
					<option value="--">--</option>
					<?php foreach ($DEFINED_VALUE_SETS['LEASE_TYPE'] as $lkey => $lVal) {?>
					<option value="<?php echo $lkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->LEASE_TYPE == $lkey) {echo " selected ";}?> > <?php echo $lVal; ?></option>
					<?php }?>
			</select></td>
			<td height="30" width="1">&nbsp;</td>
			<td height="30" VALIGN="TOP" align="center"><span style="font-size:15px;">Term (months):<BR></SPAN><input  class="form-control" type="text" size="3" name="TERMS" value="<?php echo isset($rowGetAd) ? $rowGetAd->TERMS : ""; ?>"></td>




			<td height="30" width="1">&nbsp;</td>
			<td height="30" VALIGN="TOP"><span style="font-size:15px;">Tax Clause:<BR></span><select  class="form-control" name="TAX_CLAUSE" STYLE="Background-Color : #FFFFFF">
				<option value="">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['TAX_CLAUSE'] as $taxKey => $taxVal) {?>
					<option value="<?php echo $taxKey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->TAX_CLAUSE == $taxKey) {echo " selected ";}?>><?php echo $taxVal; ?></option>
				<?php }?>
				</select></td>
			<td height="30" width="1">&nbsp;</td>
		</tr>
		</table>
</DIV>


<div id="rentalSpec3" style="display:<?php echo isset($rental_display) ? $rental_display : ""; ?>;">


		<hr noshade size="1" color="black">

<TABLE><TR>
  <td rowspan="2" align="center">
<span style="font-size:12px;"><B>School Info</B></span>
  </td>
<TD>&nbsp;  </TD>
    <td><span style="font-size:15px;">Students:<BR></span>

<select  class="form-control" name="STUDENTS" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['STUDENTS'] as $studentKey => $studentVal) {?>
				<option value="<?php echo $studentKey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->STUDENTS == $studentKey) {echo " selected ";}?>><?php echo $studentVal; ?></option>
				<?php }?>
				</select>
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td>
<span style="font-size:15px;"><NOBR>Colleges Nearby:</NOBR><BR></span><select  class="form-control" name="SCHOOL" STYLE="Background-Color : #FFFFFF">
			<option value="--">--</option>
			<?php foreach ($DEFINED_VALUE_SETS['SCHOOL'] as $schkey => $schVal) {?>
			<option value="<?php echo $schkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->SCHOOL == $schkey) {echo " selected ";}?>><?php echo $schVal; ?></option>
			<?php }?>
			</select>
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td>
	<span style="font-size:15px;">School District:<BR></span>
	<input  class="form-control" name="SCHOOL_DISTRICT" type="text" size="16" value="<?php echo isset($rowGetAd) ? $rowGetAd->SCHOOL_DISTRICT : ""; ?>">
	</td>
  </tr>
  <tr>
<TD>&nbsp;  </TD>
    <td>
	<span style="font-size:15px;">Elementary School:<BR></span>
	<input  class="form-control" name="ELEMENTARY_SCHOOL" type="text" size="20" value="<?php echo isset($rowGetAd) ? $rowGetAd->ELEMENTARY_SCHOOL : ""; ?>">
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td>
	<span style="font-size:15px;">Middle School:<BR></span>
	<input  class="form-control" name="MIDDLE_SCHOOL" type="text" size="20" value="<?php echo isset($rowGetAd) ? $rowGetAd->MIDDLE_SCHOOL : ""; ?>">
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td>
	<span style="font-size:15px;">High School:<BR></span>
	<input  class="form-control" name="HIGH_SCHOOL" type="text" size="16" value="<?php echo isset($rowGetAd) ? $rowGetAd->HIGH_SCHOOL : ""; ?>">
	</td>
  </tr>
</table>

</DIV>


		<hr noshade size="1" color="black">



		<table width="100%">
			<tr>
			<td colspan="10" height="30">


<TABLE><TR><TD>
<span style="font-size:12px;"><B>Features:</B></span>
</TD><TD WIDTH="30"> &nbsp;&nbsp;&nbsp; </TD>
<TD>
<input type="hidden" name="AUTO_WRITE" value="0">
<div class="controltext"><input type="checkbox" name="AUTO_WRITE" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AUTO_WRITE) {echo " checked ";}?>> Check to Automatically List Features and Amenities in the advertisement</div></td>

<td align="left" height="30">&nbsp; </td>

</tr>
</TABLE>




</td>
			</tr>
			<tr>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="FEATURES_DELEADED" value="0">
				<tr><td align="right" class="controltext">Lead Safe</td><td align="left"><input type="checkbox" name="FEATURES_DELEADED" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_DELEADED) {echo "checked";}?> ></td></tr>
				<tr><td align="right" class="controltext"><NOBR>Not Deleaded</NOBR></td><td align="left"><input type="checkbox" name="NOT_DELEADED" value="1" TITLE="Does NOT print in Ads" <?php if (isset($rowGetAd) and $rowGetAd->NOT_DELEADED) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_FURNISHED" value="0">
				<tr><td align="right" class="controltext">Furnished</td><td align="left"><input type="checkbox" name="FEATURES_FURNISHED" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_FURNISHED) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_NON_SMOKING" value="0">
				<tr><td align="right" class="controltext">Non-smoking</td><td align="left"><input type="checkbox" name="FEATURES_NON_SMOKING" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_NON_SMOKING) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_ALARM" value="0">
				<tr><td align="right" class="controltext">Alarm</td><td align="left"><input type="checkbox" name="FEATURES_ALARM" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_ALARM) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_INTERCOM" value="0">
				<tr><td align="right" class="controltext">Intercom</td><td align="left"><input type="checkbox" name="FEATURES_INTERCOM" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_INTERCOM) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="AMENITIES_HIGH_CEILINGS" value="0">
				<tr><td align="right" class="controltext"><NOBR>High Ceilings</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_HIGH_CEILINGS" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_HIGH_CEILINGS) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_CENTRAL_AC" value="0">
				<tr><td align="right" class="controltext">Central A/C </td><td align="left"><input type="checkbox" name="FEATURES_CENTRAL_AC" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_CENTRAL_AC) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_AC" value="0">
				<tr><td align="right" class="controltext">A/C </td><td align="left"><input type="checkbox" name="FEATURES_AC" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_AC) {echo "checked";}?> ></td></tr>
				</td></tr>
				</table>
			</CENTER></td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="FEATURES_HOT_WATER" value="0">
				<tr><td align="right" class="controltext">Hot Water</td><td align="left"><input type="checkbox" name="FEATURES_HOT_WATER" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_HOT_WATER) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_HT_AND_HW" value="0">
				<tr><td align="right" class="controltext"><NOBR>Heat &amp; Hot Water</NOBR></td><td align="left"><input type="checkbox" name="FEATURES_HT_AND_HW" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_HT_AND_HW) {echo "checked";}?> ></td></tr>

				<input type="hidden" name="FEATURES_ELECTRICITY" value="0">
				<tr><td align="right" class="controltext">Electricity</td><td align="left"><input type="checkbox" name="FEATURES_ELECTRICITY" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_ELECTRICITY) {echo "checked";}?> ></td></tr>

				<input type="hidden" name="FEATURES_ALL_UTILITIES" value="0">
				<tr><td align="right" class="controltext">All Utilities</td><td align="left"><input type="checkbox" name="FEATURES_ALL_UTILITIES" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_ALL_UTILITIES) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_INTERNET" value="0">
				<tr><td align="right" class="controltext"><NOBR>High Speed Internet</NOBR></td><td align="left"><input type="checkbox" name="FEATURES_INTERNET" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_INTERNET) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_WALK_IN_CLOSET" value="0">
				<tr><td align="right" class="controltext">Walk-in Closet </td><td align="left"><input type="checkbox" name="FEATURES_WALK_IN_CLOSET" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_WALK_IN_CLOSET) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_MODERN_BATH" value="0">
				<tr><td align="right" class="controltext">Modern Bath </td><td align="left"><input type="checkbox" name="FEATURES_MODERN_BATH" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_MODERN_BATH) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_WHIRLPOOL" value="0">
				<tr><td align="right" class="controltext">Whirlpool Tub </td><td align="left"><input type="checkbox" name="FEATURES_WHIRLPOOL" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_WHIRLPOOL) {echo "checked";}?> ></td></tr>


				</table>
			</td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="FEATURES_FIREPLACE_WORKING" value="0">
				<tr><td align="right" class="controltext">Working Fireplace</td><td align="left"><input type="checkbox" name="FEATURES_FIREPLACE_WORKING" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_FIREPLACE_WORKING) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_FIREPLACE_DECOR" value="0">
				<tr><td align="right" class="controltext"><NOBR>Decorative Fireplace</NOBR></td><td align="left"><input type="checkbox" name="FEATURES_FIREPLACE_DECOR" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_FIREPLACE_DECOR) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_HWFI" value="0">
				<tr><td align="right" class="controltext">Hardwood Floors</td><td align="left"><input type="checkbox" name="FEATURES_HWFI" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_HWFI) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_CARPET" value="0">
				<tr><td align="right" class="controltext">Carpet</td><td align="left"><input type="checkbox" name="FEATURES_CARPET" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_CARPET) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_BAYWINDOWS" value="0">
				<tr><td align="right" class="controltext">Bay Windows</td><td align="left"><input type="checkbox" name="FEATURES_BAYWINDOWS" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_BAYWINDOWS) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_MODERN_KITCHEN" value="0">				<tr><td align="right" class="controltext">Modern Kitchen</td><td align="left"><input type="checkbox" name="FEATURES_MODERN_KITCHEN" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_MODERN_KITCHEN) {echo "checked";}?> ></td></tr>


				<input type="hidden" name="FEATURES_KITCHEN_GALLEY" value="0">				<tr><td align="right" class="controltext">Galley Kitchen</td><td align="left"><input type="checkbox" name="FEATURES_KITCHEN_GALLEY" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_KITCHEN_GALLEY) {echo "checked";}?> ></td></tr>


				<input type="hidden" name="FEATURES_KITCHENETTE" value="0">
				<tr><td align="right" class="controltext">Kitchenette </td><td align="left"><input type="checkbox" name="FEATURES_KITCHENETTE" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_KITCHENETTE) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_EAT_IN_KITCHEN" value="0">
				<tr><td align="right" class="controltext">Eat-in-Kitchen </td><td align="left"><input type="checkbox" name="FEATURES_EAT_IN_KITCHEN" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_EAT_IN_KITCHEN) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_MICROWAVE" value="0">
				</table>
			</td>
			<td valign="top">
				<table border="0">
				<tr><td align="right" class="controltext">Microwave </td><td align="left"><input type="checkbox" name="FEATURES_MICROWAVE" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_MICROWAVE) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_PANTRY" value="0">
				<tr><td align="right" class="controltext">Pantry</td><td align="left"><input type="checkbox" name="FEATURES_PANTRY" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_PANTRY) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_GAS_RANGE" value="0">
				<tr><td align="right" class="controltext">Gas Range</td><td align="left"><input type="checkbox" name="FEATURES_GAS_RANGE" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_GAS_RANGE) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_ELEC_RANGE" value="0">
				<tr><td align="right" class="controltext"><NOBR>Electric Range</NOBR></td><td align="left"><input type="checkbox" name="FEATURES_ELEC_RANGE" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_ELEC_RANGE) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_DISPOSAL" value="0">
				<tr><td align="right" class="controltext">Disposal </td><td align="left"><input type="checkbox" name="FEATURES_DISPOSAL" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_DISPOSAL) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_DISHWASHER" value="0">
				<tr><td align="right" class="controltext">Dishwasher </td><td align="left"><input type="checkbox" name="FEATURES_DISHWASHER" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_DISHWASHER) {echo "checked";}?> ></td></tr>


				<input type="hidden" name="FEATURES_STAINLESS" value="0">
				<tr><td align="right" class="controltext"><NOBR>Stainless Apps</NOBR></td><td align="left"><input type="checkbox" name="FEATURES_STAINLESS" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_STAINLESS) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_GRANITEC" value="0">
				<tr><td align="right" class="controltext"><NOBR>Granite Counters</NOBR></td><td align="left"><input type="checkbox" name="FEATURES_GRANITEC" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_GRANITEC) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_DINNING_ROOM" value="0">
				<tr><td align="right" class="controltext"><NOBR>Dining Room</NOBR></td><td align="left"><input type="checkbox" name="FEATURES_DINNING_ROOM" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_DINNING_ROOM) {echo "checked";}?> ></td></tr>


				</table>
			</td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="FEATURES_CEILINGFAN" value="0">
				<tr><td align="right" class="controltext"><NOBR>Ceiling Fan</NOBR></td><td align="left"><input type="checkbox" name="FEATURES_CEILINGFAN" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_CEILINGFAN) {echo "checked";}?> ></td></tr>


				<input type="hidden" name="FEATURES_SKYLIGHT" value="0">
				<tr><td align="right" class="controltext">Skylight </td><td align="left"><input type="checkbox" name="FEATURES_SKYLIGHT" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_SKYLIGHT) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_BALCONY" value="0">
				<tr><td align="right" class="controltext">Balcony </td><td align="left"><input type="checkbox" name="FEATURES_BALCONY" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_BALCONY) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_PATIO" value="0">
				<tr><td align="right" class="controltext">Patio </td><td align="left"><input type="checkbox" name="FEATURES_PATIO" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_PATIO) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_PORCH" value="0">
				<tr><td align="right" class="controltext">Porch </td><td align="left"><input type="checkbox" name="FEATURES_PORCH" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_PORCH) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_ENCLOSED_PORCH" value="0">
				<tr><td align="right" class="controltext">Enclosed Porch</td><td align="left"><input type="checkbox" name="FEATURES_ENCLOSED_PORCH" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_ENCLOSED_PORCH) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_DECK" value="0">
				<tr><td align="right" class="controltext">Deck </td><td align="left"><input type="checkbox" name="FEATURES_DECK" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_DECK) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_DUPLEX" value="0">
				<tr><td align="right" class="controltext">Duplex </td><td align="left"><input type="checkbox" name="FEATURES_DUPLEX" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_DUPLEX) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="FEATURES_CABLETV" value="0">
				<tr><td align="right" class="controltext"><NOBR>Cable TV</NOBR></td><td align="left"><input type="checkbox" name="FEATURES_CABLETV" value="1" <?php if (isset($rowGetAd) and $rowGetAd->FEATURES_CABLETV) {echo "checked";}?> ></td></tr>

				</table>
			</td>
			</tr>
			</table>
			<table width="100%" BORDER=0>
			<tr>
			<td colspan="10" height="30">
<span style="font-size:12px;"><B>Amenities:</B></span>
</td>
			</tr>
			<tr>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="AMENITIES_CONCIEARGE" value="0">
				<tr><td align="right" class="controltext">Concierge </td><td align="left"><input type="checkbox" name="AMENITIES_CONCIEARGE" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_CONCIEARGE) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="AMENITIES_SECURITY" value="0">
				<tr><td align="right" class="controltext">Security </td><td align="left"><input type="checkbox" name="AMENITIES_SECURITY" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_SECURITY) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="AMENITIES_SUPERINTENDANT" value="0">
				<tr><td align="right" class="controltext">Superintendent </td><td align="left"><input type="checkbox" name="AMENITIES_SUPERINTENDANT" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_SUPERINTENDANT) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="AMENITIES_ON_SITE_MANAGEMENT" value="0">
				<tr><td align="right" class="controltext"><NOBR>On Site Management</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_ON_SITE_MANAGEMENT" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_ON_SITE_MANAGEMENT) {echo "checked";}?> ></td></tr>

				<input type="hidden" name="AMENITIES_OWNER_OCCUPIED" value="0">
				<tr><td align="right" class="controltext"><NOBR>Owner Occupied</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_OWNER_OCCUPIED" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_OWNER_OCCUPIED) {echo "checked";}?> ></td></tr>




				<input type="hidden" name="AMENITIES_NOT_OWNER_OCCUPIED" value="0">
				<tr><td align="right" class="controltext"><NOBR>NOT Owner Occupied</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_NOT_OWNER_OCCUPIED" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_NOT_OWNER_OCCUPIED) {echo "checked";}?> TITLE="Does NOT print in Ads"></td></tr>

				<input type="hidden" name="AMENITIES_WHEELCHAIR" value="0">
				<tr><td align="right" class="controltext">Wheelchair Access</td><td align="left"><input type="checkbox" name="AMENITIES_WHEELCHAIR" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_WHEELCHAIR) {echo "checked";}?> ></td></tr>




				</table>
			</td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="AMENITIES_ROOF_DECK" value="0">
				<tr><td align="right" class="controltext"><NOBR>Roof Deck</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_ROOF_DECK" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_ROOF_DECK) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="AMENITIES_GARDEN" value="0">
				<tr><td align="right" class="controltext">Garden </td><td align="left"><input type="checkbox" name="AMENITIES_GARDEN" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_GARDEN) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="AMENITIES_YARD" value="0">
				<tr><td align="right" class="controltext">Yard </td><td align="left"><input type="checkbox" name="AMENITIES_YARD" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_YARD) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="AMENITIES_ELEVATOR" value="0">
				<tr><td align="right" class="controltext">Elevator </td><td align="left"><input type="checkbox" name="AMENITIES_ELEVATOR" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_ELEVATOR) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="AMENITIES_CLUBHOUSE" value="0">
				<tr><td align="right" class="controltext">Club House</td><td align="left"><input type="checkbox" name="AMENITIES_CLUBHOUSE" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_CLUBHOUSE) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="AMENITIES_HEALTH_CLUB" value="0">
				<tr><td align="right" class="controltext"><NOBR>Health Club</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_HEALTH_CLUB" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_HEALTH_CLUB) {echo "checked";}?> ></td></tr>
				</table>
			</td>
			<td valign="top">
				<table border="0">
				<input type="hidden" name="AMENITIES_PLAYGROUND" value="0">
				<tr><td align="right" class="controltext"><NOBR>Playground</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_PLAYGROUND" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_PLAYGROUND) {echo "checked";}?> ></td></tr>

				<input type="hidden" name="AMENITIES_BASKETBALL" value="0">
				<tr><td align="right" class="controltext"><NOBR>Basketball</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_BASKETBALL" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_BASKETBALL) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="AMENITIES_POOL" value="0">
				<tr><td align="right" class="controltext">Pool </td><td align="left"><input type="checkbox" name="AMENITIES_POOL" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_POOL) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="AMENITIES_SAUNA" value="0">
				<tr><td align="right" class="controltext">Sauna </td><td align="left"><input type="checkbox" name="AMENITIES_SAUNA" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_SAUNA) {echo "checked";}?> ></td></tr>

				<input type="hidden" name="AMENITIES_TENNIS" value="0">
				<tr><td align="right" class="controltext">Tennis </td><td align="left"><input type="checkbox" name="AMENITIES_TENNIS" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_TENNIS) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="AMENITIES_LOUNGE" value="0">
				<tr><td align="right" class="controltext">Lounge </td><td align="left"><input type="checkbox" name="AMENITIES_LOUNGE" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_LOUNGE) {echo "checked";}?> ></td></tr>


				</table>
			</td>
			<td  valign="top">
				<table border="0">

				<input type="hidden" name="AMENITIES_BUSINESSCENTER" value="0">
				<tr><td align="right" class="controltext">Business Center</td><td align="left"><input type="checkbox" name="AMENITIES_BUSINESSCENTER" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_BUSINESSCENTER) {echo "checked";}?> ></td></tr>


				<input type="hidden" name="AMENITIES_ATTIC" value="0">
				<tr><td align="right" class="controltext">Storage in Attic</td><td align="left"> <input type="checkbox" name="AMENITIES_ATTIC" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_ATTIC) {echo "checked";}?> > </td></tr>
				<input type="hidden" name="AMENITIES_BASEMENT" value="0">
				<tr><td align="right" class="controltext"><NOBR>Storage in Basement</NOBR></td><td align="left"><input type="checkbox" name="AMENITIES_BASEMENT" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_BASEMENT) {echo "checked";}?> > </td></tr>
				<input type="hidden" name="AMENITIES_BIN" value="0">
				<tr><td align="right" class="controltext">Storage in Bin</td><td align="left"><input type="checkbox" name="AMENITIES_BIN" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_BIN) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="AMENITIES_BIKEROOM" value="0">
				<tr><td align="right" class="controltext">Bike Storage</td><td align="left"><input type="checkbox" name="AMENITIES_BIKEROOM" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_BIKEROOM) {echo "checked";}?> ></td></tr>

				<input type="hidden" name="AMENITIES_BBQ" value="0">
				<tr><td align="right" class="controltext">BBQ</td><td align="left"><input type="checkbox" name="AMENITIES_BBQ" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_BBQ) {echo "checked";}?> ></td></tr>


				</table>
			</td>



			<td  valign="top">
				<table border="0">

				<input type="hidden" name="AMENITIES_ZIPCAR" value="0">
				<tr><td align="right" class="controltext">Zip Car</td><td align="left"><input type="checkbox" name="AMENITIES_ZIPCAR" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_ZIPCAR) {echo "checked";}?> ></td></tr>

				<input type="hidden" name="AMENITIES_SUBWAY" value="0">
				<tr><td align="right" class="controltext">Subway </td><td align="left"><input type="checkbox" name="AMENITIES_SUBWAY" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_SUBWAY) {echo "checked";}?> ></td></tr>
				<input type="hidden" name="AMENITIES_CRAIL" value="0">
				<tr><td align="right" class="controltext"><NOBR>Commuter Rail</NOBR></td><td align="left"> <input type="checkbox" name="AMENITIES_CRAIL" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_CRAIL) {echo "checked";}?> > </td></tr>
				<input type="hidden" name="AMENITIES_BUS" value="0">
				<tr><td align="right" class="controltext">Bus</td><td align="left"><input type="checkbox" name="AMENITIES_BUS" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_BUS) {echo "checked";}?> > </td></tr>
				<input type="hidden" name="AMENITIES_SHUTTLE" value="0">
				<tr><td align="right" class="controltext">Shuttle bus</td><td align="left"><input type="checkbox" name="AMENITIES_SHUTTLE" value="1" <?php if (isset($rowGetAd) and $rowGetAd->AMENITIES_SHUTTLE) {echo "checked";}?> ></td></tr>

				<tr><td align="left" class="controltext" colspan=2>
<span style="font-size:15px;">Laundry:<BR></span><select name="LAUNDRY_ROOM" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['LAUNDRY_ROOM'] as $launkey => $launVal) {?>
					<option value="<?php echo $launkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->LAUNDRY_ROOM == $launkey) {echo " selected ";}?> ><?php echo $launVal; ?></option>
				<?php }?>
			</select>
 				</td></tr>

				</table>
			</td>


			</tr>
			</table>



<hr noshade SIZE="1" color="black">

<span style="font-size:12px;"><B>Structural Information</B></span>


			<table>
			<tr>
			<td height="30"><span style="font-size:15px;">Building Type:<BR></span><select  class="form-control" name="BUILDING_TYPE" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['BUILDING_TYPE'] as $btkey => $btVal) {?>
					<option value="<?php echo $btkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->BUILDING_TYPE == $btkey) {echo " selected ";}?> ><?php echo $btVal; ?></option>
				<?php }?>
			</select></td>
			<td height="30"><span style="font-size:15px;">Building Style:<BR></span><select  class="form-control" name="BUILDING_STYLE" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['BUILDING_STYLE'] as $bskey => $bsVal) {?>
					<option value="<?php echo $bskey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->BUILDING_STYLE == $bskey) {echo " selected ";}?> ><?php echo $bsVal; ?></option>
				<?php }?>
			</select></td>


<TD>
<span style="font-size:15px;">Exterior:</span><br>
	<select  class="form-control" name="EXTERIOR" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['EXTERIOR'] as $exkey => $exval) {?>
		<option value="<?php echo $exkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->EXTERIOR == $exkey) {echo "selected ";}?> ><?php echo $exval; ?></option>
	<?php }?>
	</select>


</TD><TD>
<span style="font-size:15px;">Stories:<BR></span>
		<select  class="form-control" name="STORIES" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['STORIES'] as $stkey => $stval) {?>
		<option value="<?php echo $stkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->STORIES == $stkey) {echo "selected ";}?> ><?php echo $stval; ?></option>
	<?php }?>
	</select>

</TD>

<TD>
<span style="font-size:15px;">Frontage:<BR></span>
	<input  class="form-control" name="FRONTAGE" type="text" size="8" value="<?php echo isset($rowGetAd) ? $rowGetAd->FRONTAGE : ""; ?>">

</TD>

			</tr>
			</table>


<div id="saleSpec" class="controltext" style="display:<?php echo isset($sale_display) ? $sale_display : ""; ?>;">

<table width="100%" border="0">
<TR><TD>


<span style="font-size:15px;">Roof Type:</span>
	<br>
	<select  class="form-control" name="ROOF_TYPE" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['ROOF_TYPE'] as $rtkey => $rtval) {?>
		<option value="<?php echo $rtkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->ROOF_TYPE == $rtkey) {echo "selected ";}?> ><?php echo $rtval; ?></option>
	<?php }?>
	</select>


</TD><TD>

<span style="font-size:15px;">Insulation:<BR></span>
	<select  class="form-control" id="INSULATION" name="INSULATION" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['INSULATION'] as $inskey => $insval) {?>
		<option value="<?php echo $inskey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->INSULATION == $inskey) {echo "selected ";}?> ><?php echo $insval; ?></option>
	<?php }?>
	</select>

</TD><TD>

<span style="font-size:15px;">Foundation Size:</span><br>
<input  class="form-control" type="text" id="FOUNDATION_SIZE" name="FOUNDATION_SIZE" value="<?php echo isset($rowGetAd) ? $rowGetAd->FOUNDATION_SIZE : ""; ?>" SIZE=8>


</TD><TD>

<span style="font-size:15px;"># Garage Spaces:</span><br>
			<input  class="form-control" type="text" name="GARAGE_SPACES" value="<?php echo isset($rowGetAd) ? $rowGetAd->GARAGE_SPACES : ""; ?>" SIZE=3>

</TD></TR><TR><TD>

<span style="font-size:15px;">Pool Type:</span>
	<br>
	<select  class="form-control" name="POOL_TYPE" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['POOL_TYPE'] as $ptkey => $ptval) {?>
		<option value="<?php echo $ptkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->POOL_TYPE == $ptkey) {echo "selected ";}?> ><?php echo $ptval; ?></option>
	<?php }?>
	</select>

</TD><TD>

<span style="font-size:15px;">Insulation Type:<BR></span>
	<select  class="form-control" id="INSULATION_TYPE" name="INSULATION_TYPE" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['INSULATION_TYPE'] as $instkey => $instval) {?>
		<option value="<?php echo $instkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->INSULATION_TYPE == $instkey) {echo "selected ";}?> ><?php echo $instval; ?></option>
	<?php }?>
	</select>

</TD><TD>

<span style="font-size:15px;">Foundation Type:<BR></span>
	<select  class="form-control" id="FOUNDATION_TYPE" name="FOUNDATION_TYPE" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['FOUNDATION_TYPE'] as $ftkey => $ftval) {?>
		<option value="<?php echo $ftkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->FOUNDATION_TYPE == $ftkey) {echo "selected ";}?> ><?php echo $ftval; ?></option>
	<?php }?>
	</select>

</TD><TD>

<span style="font-size:15px;"># Garage Type:</span><BR>
			<select  class="form-control" id="GARAGE_TYPE" name="GARAGE_TYPE" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['GARAGE_TYPE'] as $gartkey => $gartval) {?>
		<option value="<?php echo $gartkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->GARAGE_TYPE == $gartkey) {echo "selected ";}?> ><?php echo $gartval; ?></option>
	<?php }?>
	</select>

</TD></TR></TABLE>




<TABLE WIDTH="100%" BORDER=0><TR><TD ALIGN="TOP">


<table WIDTH="100%" BORDER=0><tr><td>


<span style="font-size:15px;">Year Built:</span><br><input  class="form-control" type="text" id="YEAR_BUILT" name="YEAR_BUILT" size="4" value="<?php echo isset($rowGetAd) ? $rowGetAd->YEAR_BUILT : ""; ?>">


</td></tr><tr><td>

<span style="font-size:15px;">Year Built Source:</span><BR>
			<select  class="form-control" id="YEAR_BUILT_SOURCE" name="YEAR_BUILT_SOURCE" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['YEAR_BUILT_SOURCE'] as $ybskey => $ybsval) {?>
		<option value="<?php echo $ybskey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->YEAR_BUILT_SOURCE == $ybskey) {echo "selected ";}?> ><?php echo $ybsval; ?></option>
	<?php }?>
	</select>

</td></tr><tr><td>

<span style="font-size:15px;">Year Built Descriptio:</span><BR>
			<select  class="form-control" id="YEAR_BUILT_DESC" name="YEAR_BUILT_DESC" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['YEAR_BUILT_DESC'] as $ybdkey => $ybdval) {?>
		<option value="<?php echo $ybdkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->YEAR_BUILT_DESC == $ybdkey) {echo "selected ";}?> ><?php echo $ybdval; ?></option>
	<?php }?>
	</select>

</td></tr></table>


</TD><TD>


<?php $lotdesc = (isset($rowGetAd) and $rowGetAd->LOT_DESCRIPTION) ? $rowGetAd->LOT_DESCRIPTION : "Type the Lot Description here.";?>
<span style="font-size:15px;">Lot Description:</span><br>
<textarea   class="form-control" name="LOT_DESCRIPTION" id="LOT_DESCRIPTION" cols="40" rows="4" onFocus=clear_textbox() value="Type the Lot Description here."><?php echo $lotdesc; ?></textarea>



</TD></TR></TABLE>


<hr noshade size="1" color="black">

<span style="font-size:12px;"><B>Utility Information &amp; Other Expenses</B></span>
<TABLE border=0><tr>

    <td align="left" valign="top"><span style="font-size:15px;">Water:<BR></span>
	<select  class="form-control" name="WATER" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['WATER'] as $wkey => $wval) {?>
		<option value="<?php echo $wkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->WATER == $wkey) {echo "selected ";}?> ><?php echo $wval; ?></option>
	<?php }?>
	</select>
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td align="left" valign="top"><span style="font-size:15px;">Sewer:<BR></span>
	<select  class="form-control" name="SEWER" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['SEWER'] as $swkey => $swval) {?>
		<option value="<?php echo $swkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->WATER == $swkey) {echo "selected ";}?> ><?php echo $swval; ?></option>
	<?php }?>
	</select>
	</td>
    <td><img src="../assets/images/spacer.gif" width="10" height="1" border="0"></td>
    <td align="left" valign="top">
	<span style="font-size:15px;">Condo/Association Fees:<BR></span>
	<div class="controltext input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">$</span>
					  </div>
<input class="form-control"  type="text" name="CONDO_FEES" value="<?php echo isset($rowGetAd) ? $rowGetAd->CONDO_FEES : ""; ?>" SIZE=14>

					</div>
<!-- $<input  type="text" name="CONDO_FEES" value="<?php echo isset($rowGetAd) ? $rowGetAd->CONDO_FEES : ""; ?>" SIZE=14> -->
	</td>




 </tr>
</TABLE>

<hr noshade size="1" color="black">

<TABLE><TR><TD>

<CENTER><span style="font-size:12px;"><B>Zoning Information</B></span></CENTER>

<TABLE><TR><TD>
<span style="font-size:15px;">Book:</SPAN><BR>
<input class="form-control"   type="text" id="BOOK" name="BOOK" value="<?php echo isset($rowGetAd) ? $rowGetAd->BOOK : ""; ?>" SIZE=8>
</TD><TD>
<span style="font-size:15px;">Page:</SPAN><BR>
<input class="form-control"   type="text" id="PAGE" name="PAGE" value="<?php echo isset($rowGetAd) ? $rowGetAd->PAGE : ""; ?>" SIZE=8>
</TD><TD>
<span style="font-size:15px;">Map:</SPAN><BR>
<input class="form-control"  type="text" id="MAPOFFICIAL" name="MAPOFFICIAL" value="<?php echo isset($rowGetAd) ? $rowGetAd->MAPOFFICIAL : ""; ?>" SIZE=8>
</TD>
<td><span style="font-size:15px;">County:<BR></span>

<select class="form-control"  name="COUNTY" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['COUNTY'] as $countykey => $countyval) {?>
		<option value="<?php echo $countykey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->COUNTY == $countykey) {echo "selected ";}?> ><?php echo $countyval; ?></option>
	<?php }?>
	</select>


</td>

</TR><TR><TD>
<span style="font-size:15px;">Block:</SPAN><BR>
<input class="form-control"  type="text" id="BLOCK" name="BLOCK" value="<?php echo isset($rowGetAd) ? $rowGetAd->BLOCK : ""; ?>" SIZE=8>
</TD><TD>
<span style="font-size:15px;">Lot:</SPAN><BR>
<input class="form-control"  type="text" id="LOT" name="LOT" value="<?php echo isset($rowGetAd) ? $rowGetAd->LOT : ""; ?>" SIZE=8>
</TD><TD>
<span style="font-size:15px;">Parcel:</SPAN><BR>
<input class="form-control"  type="text" id="PARCEL" name="PARCEL" value="<?php echo isset($rowGetAd) ? $rowGetAd->PARCEL : ""; ?>" SIZE=8>
</TD>
    <td><span style="font-size:15px;">Zoning:<BR></span>
	<select class="form-control"  name="ZONING" STYLE="Background-Color : #FFFFFF">
	<option>--</option>
	<?php foreach ($DEFINED_VALUE_SETS['ZONING'] as $zkey => $zval) {?>
		<option value="<?php echo $zkey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->ZONING == $zkey) {echo "selected ";}?> ><?php echo $zval; ?></option>
	<?php }?>
	</select>
	</td></TR></TABLE>

</TD><TD>

</TD><TD VALIGN="TOP">

<CENTER><span style="font-size:12px;"><B>Tax &amp; Assessment Information</B></span></CENTER>


<TABLE><TR><TD>

<span style="font-size:15px;">Property Tax:</SPAN><BR>
<div class="controltext input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">$</span>
					  </div>

<input class="form-control" type="text" id="PROPERTYTAX" name="PROPERTYTAX" value="<?php echo isset($rowGetAd) ? $rowGetAd->PROPERTYTAX : ""; ?>" SIZE=12>
					</div>

</TD><TD>
<span style="font-size:15px;">Assessment:</SPAN><BR>

<div class="controltext input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">$</span>
					  </div>

<input class="form-control" type="text" id="ASSESSMENT" name="ASSESSMENT" value="<?php echo isset($rowGetAd) ? $rowGetAd->ASSESSMENT : ""; ?>" SIZE=12>
					</div>



</td><td>
			<span style="font-size:15px;">Tax Year:</SPAN><BR>
<input  class="form-control" type="text" id="TAX_YEAR" name="TAX_YEAR" value="<?php echo isset($rowGetAd) ? $rowGetAd->TAX_YEAR : ""; ?>" SIZE=5>


</TD></TR></TABLE>

</TD></TR></TABLE>



		</div>


<CENTER>

<div id="rentalSpec2" style="display:<?php echo isset($rental_display) ? $rental_display : ""; ?>;">

	<hr noshade size="1" color="black">
		<table width="90%">
		<tr>
		<td valign="top" align="center">


<span style="font-size:12px;"><B>Fees</B></SPAN>

		<table BORDER=0 CELLPADDING="0" CELLSPACING="0">
			<tr>
			<td height="30"><span style="font-size:15px;">Tenant Fee:</span></td>
			<td align="right" height="30"><NOBR>

				<div class="controltext input-group mb-3">
									  <div class="input-group-prepend">
									    <span class="input-group-text" id="basic-addon1">$</span>
									  </div>

				<input class="form-control" type="text" size="5" name="TENANT_FEE" value="<?php echo isset($rowGetAd) ? $rowGetAd->TENANT_FEE : ""; ?>">
				</div>




			</NOBR></td>

<td height="30" WIDTH="30">&nbsp;  </td>

			<td height="30"><span style="font-size:15px;">First:</span></td>
			<td align="right" height="30"><NOBR>

				<div class="controltext input-group mb-3">
									  <div class="input-group-prepend">
									    <span class="input-group-text" id="basic-addon1">$</span>
									  </div>

				<input class="form-control" type="text" size="5" name="PAYMENT_FIRST" value="<?php echo isset($rowGetAd) ? $rowGetAd->PAYMENT_FIRST : ""; ?>">
				</div>


			</NOBR></td>


<td height="30" WIDTH="30">&nbsp;  </td>

			<td height="30"><span style="font-size:15px;">Security:</span></td>
			<td align="right" height="30"><NOBR>
			<div class="controltext input-group mb-3">
								  <div class="input-group-prepend">
								    <span class="input-group-text" id="basic-addon1">$</span>
								  </div>

				<input class="form-control" type="text" size="5" name="PAYMENT_SEC" value="<?php echo isset($rowGetAd) ? $rowGetAd->PAYMENT_SEC : ""; ?>">
			</div>



			</NOBR></td>
			</tr>

			<tr>
			<td height="30"><span style="font-size:15px;">Landlord Fee:</span></td>
			<td align="right" height="30"><NOBR>

			<div class="controltext input-group mb-3">
								  <div class="input-group-prepend">
								    <span class="input-group-text" id="basic-addon1">$</span>
								  </div>

				<input class="form-control"  type="text" size="5" name="LANDLORD_FEE" value="<?php echo isset($rowGetAd) ? $rowGetAd->LANDLORD_FEE : ""; ?>">
			</div>


			</NOBR></td>

<td height="30" WIDTH="30">&nbsp;  </td>

			<td height="30"><span style="font-size:15px;">Last:</span></td>
			<td align="right" height="30"><NOBR>
				<div class="controltext input-group mb-3">
								  <div class="input-group-prepend">
								    <span class="input-group-text" id="basic-addon1">$</span>
								  </div>

				<input class="form-control" type="text" name="PAYMENT_LAST" size="5" value="<?php echo isset($rowGetAd) ? $rowGetAd->PAYMENT_LAST : ""; ?>">
			</div>

			</NOBR></td>

<td height="30" WIDTH="30">&nbsp;  </td>

			<td height="30"><span style="font-size:15px;">Key Deposit:</span></td>
			<td align="right" height="30"><NOBR>
				<div class="controltext input-group mb-3">
								  <div class="input-group-prepend">
								    <span class="input-group-text" id="basic-addon1">$</span>
								  </div>

				<input class="form-control" type="text" name="KEY_DEPOSIT" size="5" value="<?php echo isset($rowGetAd) ? $rowGetAd->KEY_DEPOSIT : ""; ?>">
			</div>


			</NOBR></td>
			</tr>
			<tr>


			<td height="30"><span style="font-size:15px;">Cleaning Deposit:</span></td>
			<td align="right" height="30"><NOBR>
			<div class="controltext input-group mb-3">
								  <div class="input-group-prepend">
								    <span class="input-group-text" id="basic-addon1">$</span>
								  </div>

				<input class="form-control" type="text" name="CLEAN_DEPOSIT" size="5" value="<?php echo isset($rowGetAd) ? $rowGetAd->CLEAN_DEPOSIT : ""; ?>">
			</div>

			</NOBR></td>

<td height="30" WIDTH="30">&nbsp;  </td>

<!-- 			<td height="30"><span style="font-size:15px;">Fee Comments (agent eyes only):</span></td>
			<td colspan="4" align="right" height="30"><input type="text" name="FEE_COMMENTS" value="<?php echo isset($rowGetAd) ? $rowGetAd->FEE_COMMENTS : ""; ?>" SIZE="30"></td>

			-->
			<TD COLSPAN="5">&nbsp;  </TD>
			</tr>
			</table>
		</td>
		</tr>
		</table>
</DIV>

			<hr noshade size="1" color="black">

<table width="100%">
<tr>
<?php $adBody = (isset($rowGetAd) and $rowGetAd->BODY) ? $rowGetAd->BODY : "Type your ad here.";?>
<td>

<TABLE WIDTH="100%" BORDER=0><TR><TD VALIGN="TOP">
<span style="font-size:12px;"><B>Ad Title:</B> </SPAN><BR><P>
<span style="font-size:12px;"><B>Ad Body</B></SPAN><BR><P><BR>
<input  type="button" value="Check Spelling" onClick="openSpellChecker();"/>
<BR><BR>

<a href="<?php echo "$PHP_SELF?op=adlEdit-wysiwyg&cid=" . (isset($rowGetAd) ? $rowGetAd->CID : "") . "&return_page=sel&return_page_rid=" . (isset($rowGetAd) ? $rowGetAd->CID : ""); ?>">Use WYSIWYG editor</A>
</SPAN>
</TD><TD >

 <input class="form-control" type="text" size="100" name="AD_TITLE" id="fullAD_TITLE" value="<?php echo $rowGetAd->AD_TITLE; ?>" onChange="syncMeSelect2('fullAD_TITLE', 'simpleAD_TITLE');"><BR>
<P>

<textarea class="form-control" name="BODY" id="fullBODY" cols="100" rows="7" onFocus="clear_textbox();" value="Type your ad here." onChange="syncMeSelect2('fullBODY', 'simpleBODY');"><?php echo $adBody; ?></textarea>
</TD></TR></TABLE>
</TD></TR></TABLE>



<hr noshade SIZE="1" color="black">
<?php
if (isset($rowGetAd) and $rowGetAd->EXCLUSIVE == "1") {
    echo "<CENTER><B><FONT COLOR=red>Exclusive Landlord</FONT></B></CENTER>";
}?>

<TABLE><TR><TD>
<span style="font-size:11px;"><B>Showing Instructions:</B><BR></span><textarea class="form-control" name="SHOW_INSTRUCT" rows="5" cols="42"><?php echo isset($rowGetAd) ? $rowGetAd->SHOW_INSTRUCT : ""; ?></textarea>
</TD><TD>
<span style="font-size:11px;"><B>Landlord Notes:</B> <I>(view only - global for this landlord)</I>

<a href="<?php echo $PHP_SELF; ?>?op=editllnote&amp;llid=<?php echo isset($rowGetAd) ? $rowGetAd->LANDLORD : ""; ?>" target="_editlnote"><img border=0 src="../images/icons/edit.gif" alt="edit" title="edit" vspace="0" hspace="0" ></a><BR></span><textarea class="form-control" rows="5" cols="42"><?php echo isset($rowGetAd) ? $rowGetAd->LLNOTES : ""; ?></textarea>
</TD></TR></TABLE>
<TABLE><TR><TD>
<span style="font-size:15px;">Key Info:<BR></span><select class="form-control" name="KEY_INFO" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['KEY_INFO'] as $keyKey => $keyVal) {?>
					<option value="<?php echo $keyKey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->KEY_INFO == $keyKey) {echo " selected ";}?>><?php echo $keyVal; ?></option>
				<?php }?>
				</select>
</TD><TD>&nbsp; </TD>
<TD>
<span style="font-size:15px;">Alarm Code:<BR></span>
<input class="form-control" type="text" name="ALARM" value="<?php echo isset($rowGetAd) ? $rowGetAd->ALARM : ""; ?>" SIZE=12>
</TD><TD>&nbsp; </TD>

<TD><span style="font-size:15px;">Tenant Name:<BR></span>
<input class="form-control" type="input" name="TENANT_NAME" value="<?php echo isset($rowGetAd) ? $rowGetAd->TENANT_NAME : ""; ?>" SIZE="18">
</TD><TD>&nbsp; </TD>
<TD><span style="font-size:15px;">Tenant Phone:<BR></span>
<input class="form-control" type="input" name="TENANT_PHONE" value="<?php echo isset($rowGetAd) ? $rowGetAd->TENANT_PHONE : ""; ?>" size="18">
</TD></TR></TABLE>




		<hr noshade size="1" color="black">
		<table width="90%">
		<tr>



			<td height="30">

		<table>
		<tr>
			<td height="40" ><span style="font-size:15px;">Additional Office Notes (for this unit):<BR></span><textarea class="form-control" name="LISTING_NOTES" rows="6" cols="40"><?php echo isset($rowGetAd) ? $rowGetAd->LISTING_NOTES : ""; ?></textarea></td>
		</tr>
		</table>
</TD>

			<td VALIGN="TOP">


<CENTER>
<table border="0"><TR><TD>
<CENTER><div class="controltext"><B>Lease Expires:</B>

<TABLE> <tr>
			<td height="30" ><span style="font-size:15px;">Month:<BR></span><select class="form-control" name="bbbLEMonth" STYLE="Background-Color : #FFFFFF">


			<?php
$getLEMon = null;
$getLEDay = null;
$getLEYear = null;
if (isset($rowGetAd)) {
    $getLEMon = subStr($rowGetAd->LEASE_EXPIRE, 5, 2);
    $getLEDay = subStr($rowGetAd->LEASE_EXPIRE, 8, 2);
    $getLEYear = subStr($rowGetAd->LEASE_EXPIRE, 0, 4);
}

?>




				<option value="--">--</option>
				<option value="01" <?php if ($getLEMon == "01") {echo " selected ";}?>>Jan</option>
				<option value="02" <?php if ($getLEMon == "02") {echo " selected ";}?>>Feb</option>
				<option value="03" <?php if ($getLEMon == "03") {echo " selected ";}?>>Mar</option>
				<option value="04" <?php if ($getLEMon == "04") {echo " selected ";}?>>Apr</option>
				<option value="05" <?php if ($getLEMon == "05") {echo " selected ";}?>>May</option>
				<option value="06" <?php if ($getLEMon == "06") {echo " selected ";}?>>Jun</option>
				<option value="07" <?php if ($getLEMon == "07") {echo " selected ";}?>>Jul</option>
				<option value="08" <?php if ($getLEMon == "08") {echo " selected ";}?>>Aug</option>
				<option value="09" <?php if ($getLEMon == "09") {echo " selected ";}?>>Sep</option>
				<option value="10" <?php if ($getLEMon == "10") {echo " selected ";}?>>Oct</option>
				<option value="11" <?php if ($getLEMon == "11") {echo " selected ";}?>>Nov</option>
				<option value="12" <?php if ($getLEMon == "12") {echo " selected ";}?>>Dec</option>
			</select></td>
			<td height="30" width="1">&nbsp;</td>
			<td height="30" ><span style="font-size:15px;">Day:<BR></span><select class="form-control" name="bbbLEDay" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php for ($i = 1; $i <= 31; $i++) {
    if ($i <= 9) {
        $j = "0" . $i;
    } else {
        $j = $i;
    }
    ?>
				<option value="<?php echo $j; ?>" <?php if ($getLEDay == $j) {echo " selected ";}?>><?php echo $j; ?></option>
				<?php }?>
			</select></td>
			<td height="30" width="1">&nbsp;</td>
			<td height="30" ><span style="font-size:15px;">Year:<BR></span><select class="form-control" name="bbbLEYear" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php
$thisYear = date("Y");
for ($i = 0; $i <= 4; $i++) {?>
				<option value="<?php echo ($thisYear + $i); ?>" <?php if ($getLEYear == ($thisYear + $i)) {echo " selected ";}?>><?php echo ($thisYear + $i); ?></option>
				<?php }?>
			</select></td></TR></TABLE>



<CENTER><div class="controltext"><NOBR><B>Placed On Market:

<?php
if (isset($rowGetAd->CID)) {
    ?>
<a href="<?php echo $PHP_SELF; ?>?op=dateonmarketdo&amp;cid=<?php echo isset($rowGetAd) ? $rowGetAd->CID : ""; ?>&amp;grid=<?php echo $grid; ?>&amp;next_contact=<?php echo isset($rowGetAd) ? $rowGetAd->DATEONMARKET : ""; ?>"><FONT SIZE="-3" COLOR="green">Make Today</FONT></A>
<?php }
?>




</B></NOBR>

<?php
if (isset($rowGetAd->CID)) {
    $pomMon = subStr($rowGetAd->DATEONMARKET, 5, 2);
    $pomDay = subStr($rowGetAd->DATEONMARKET, 8, 2);
    $pomYear = subStr($rowGetAd->DATEONMARKET, 0, 4);
} else {
    $pomMon = date("m");
    $pomDay = date("d");
    $pomYear = date("Y");
}
?>

<TABLE> <tr>
			<td height="30" ><span style="font-size:15px;">Month:<BR></span><select class="form-control" name="pomMonth" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<option value="01" <?php if ($pomMon == "01") {echo " selected ";}?>>Jan</option>
				<option value="02" <?php if ($pomMon == "02") {echo " selected ";}?>>Feb</option>
				<option value="03" <?php if ($pomMon == "03") {echo " selected ";}?>>Mar</option>
				<option value="04" <?php if ($pomMon == "04") {echo " selected ";}?>>Apr</option>
				<option value="05" <?php if ($pomMon == "05") {echo " selected ";}?>>May</option>
				<option value="06" <?php if ($pomMon == "06") {echo " selected ";}?>>Jun</option>
				<option value="07" <?php if ($pomMon == "07") {echo " selected ";}?>>Jul</option>
				<option value="08" <?php if ($pomMon == "08") {echo " selected ";}?>>Aug</option>
				<option value="09" <?php if ($pomMon == "09") {echo " selected ";}?>>Sep</option>
				<option value="10" <?php if ($pomMon == "10") {echo " selected ";}?>>Oct</option>
				<option value="11" <?php if ($pomMon == "11") {echo " selected ";}?>>Nov</option>
				<option value="12" <?php if ($pomMon == "12") {echo " selected ";}?>>Dec</option>
			</select></td>
			<td height="30" width="1">&nbsp;</td>
			<td height="30"><span style="font-size:15px;">Day:<BR></span><select class="form-control" name="pomDay" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php for ($i = 1; $i <= 31; $i++) {
    if ($i <= 9) {
        $j = "0" . $i;
    } else {
        $j = $i;
    }
    ?>
				<option value="<?php echo $j; ?>" <?php if ($pomDay == $j) {echo " selected ";}?>><?php echo $j; ?></option>
				<?php }?>
			</select></td>
			<td height="30" width="1">&nbsp;</td>
			<td height="30" ><span style="font-size:15px;">Year:<BR></span><select class="form-control" name="pomYear" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php
$thisYear = date("Y");
for ($i = 0; $i <= 4; $i++) {?>
				<option value="<?php echo ($thisYear + $i); ?>" <?php if ($pomYear == ($thisYear + $i)) {echo " selected ";}?>><?php echo ($thisYear + $i); ?></option>
				<?php }?>
			</select></td></TR></TABLE>


</CENTER>
</TD><TD>


<span style="font-size:15px;">Listing type:<BR></SPAN><select class="form-control" name="LISTING_TYPE" STYLE="Background-Color : #FFFFFF">
						<option value="--">--</option>
						<?php foreach ($DEFINED_VALUE_SETS['LISTING_TYPE'] as $lskey => $lsVal) {?>
						<option value="<?php echo $lskey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->LISTING_TYPE == $lskey) {echo " selected ";}?> ><?php echo $lsVal; ?></option>
						<?php }?>
			</select>
<BR>
<span style="font-size:15px;">Listing Status:<BR></SPAN><select class="form-control" name="RENTED_BY" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php foreach ($DEFINED_VALUE_SETS['RENTED_BY'] as $rentedKey => $rentedVal) {?>
				<option value="<?php echo $rentedKey; ?>" <?php if (isset($rowGetAd) and $rowGetAd->RENTED_BY == $rentedKey) {echo " selected ";}?>><?php echo $rentedVal; ?></option>
				<?php }?>
				</select>
<table cellpadding="0" cellspacing="0" border="0"><tr><td>
<span style="font-size:15px;">Listing Agent:<BR></SPAN>
</td><td>
<span style="font-size:15px;"><NOBR>Listing Agent Fee:</NOBR><BR></SPAN>
</td></tr><tr><td>

	<select class="form-control" name="AGENTLISTING" STYLE="Background-Color : #FFFFFF">
<option value="">--</option>
		<?php

$quStrGetLA = "SELECT * FROM USERS WHERE `GROUP`=$grid";
$quGetLA = mysqli_query($GLOBALS['dbh'], $quStrGetLA);

while ($rowGetLA = mysqli_fetch_object($quGetLA)) {?>
		<option value="<?php echo $rowGetLA->UID; ?>" <?php if (isset($rowGetAd) and $rowGetAd->AGENTLISTING == $rowGetLA->UID) {echo "selected ";}?>><?php echo $rowGetLA->HANDLE; ?></option>
		<?php }?>
	</select>
</td><td>
<input class="form-control" type="input" name="AGENTFEE" value="<?php echo isset($rowGetAd) ? $rowGetAd->AGENTFEE : ""; ?>" size="10">
</td></tr>
<tr><td colspan=2>
<span style="font-size:15px;"><NOBR>Source:

<select class="form-control" name="CSOURCE" STYLE="Background-Color : #FFFFFF">
				<option value="0" <?php if (isset($rowGetAd) and $rowGetAd->CSOURCE == "0") {echo " selected ";}?>>Our Office</option>
				<option value="1" <?php if (isset($rowGetAd) and $rowGetAd->CSOURCE == "1") {echo " selected ";}?>>YGL</option>
				<option value="2" <?php if (isset($rowGetAd) and $rowGetAd->CSOURCE == "2") {echo " selected ";}?>>RJ</option>
			</select>
</NOBR></SPAN></td></tr>

</table>

</TD></TR>




<!--

<CENTER><div class="controltext"><B>Date Off Market:</B>


<?php
$doffmMon = null;
$doffmDay = null;
$doffmYear = null;
if (isset($rowGetAd)) {
    $doffmMon = subStr($rowGetAd->DATEOFFMARKET, 5, 2);
    $doffmDay = subStr($rowGetAd->DATEOFFMARKET, 8, 2);
    $doffmYear = subStr($rowGetAd->DATEOFFMARKET, 0, 4);
}
?>

<TABLE> <tr>
			<td height="30" ><span style="font-size:15px;">Month:<BR></span><select name="doffmMonth" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<option value="01" <?php if ($doffmMon == "01") {echo " selected ";}?>>Jan</option>
				<option value="02" <?php if ($doffmMon == "02") {echo " selected ";}?>>Feb</option>
				<option value="03" <?php if ($doffmMon == "03") {echo " selected ";}?>>Mar</option>
				<option value="04" <?php if ($doffmMon == "04") {echo " selected ";}?>>Apr</option>
				<option value="05" <?php if ($doffmMon == "05") {echo " selected ";}?>>May</option>
				<option value="06" <?php if ($doffmMon == "06") {echo " selected ";}?>>Jun</option>
				<option value="07" <?php if ($doffmMon == "07") {echo " selected ";}?>>Jul</option>
				<option value="08" <?php if ($doffmMon == "08") {echo " selected ";}?>>Aug</option>
				<option value="09" <?php if ($doffmMon == "09") {echo " selected ";}?>>Sep</option>
				<option value="10" <?php if ($doffmMon == "10") {echo " selected ";}?>>Oct</option>
				<option value="11" <?php if ($doffmMon == "11") {echo " selected ";}?>>Nov</option>
				<option value="12" <?php if ($doffmMon == "12") {echo " selected ";}?>>Dec</option>
			</select></td>
			<td height="30" width="1">&nbsp;</td>
			<td height="30" width="20"><span style="font-size:15px;">Day:<BR></span><select name="doffmDay" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php for ($i = 1; $i <= 31; $i++) {
    if ($i <= 9) {
        $j = "0" . $i;
    } else {
        $j = $i;
    }
    ?>
				<option value="<?php echo $j; ?>" <?php if ($doffmDay == $j) {echo " selected ";}?>><?php echo $j; ?></option>
				<?php }?>
			</select></td>
			<td height="30" width="1">&nbsp;</td>
			<td height="30" width="20"><span style="font-size:15px;">Year:<BR></span><select name="doffmYear" STYLE="Background-Color : #FFFFFF">
				<option value="--">--</option>
				<?php
$thisYear = date("Y");
for ($i = 0; $i <= 4; $i++) {?>
				<option value="<?php echo ($thisYear + $i); ?>" <?php if ($doffmYear == ($thisYear + $i)) {echo " selected ";}?>><?php echo ($thisYear + $i); ?></option>
				<?php }?>
			</select></td></TR></TABLE>
-->

</center>
</TD></TR>




			</table>


</td>
		</tr>
		</table>


			<hr noshade size="1" color="black">
<CENTER><table width="90%" BORDER=0><tr>
			<td height="30" align="center">
<?php if (($_SESSION["user_level"] > "0" and isset($rowGetAd) and $rowGetAd->LOCKED == "0") or (isset($rowGetAd) and $rowGetAd->LOCKED == "1" and $_SESSION["user_level"] >= "4") or ((!($cid)) and $_SESSION["user_level"] > "0")) {

    ?>
<!-- <A HREF="javascript: void 0" ONCLICK="validateAdlEdit('full');"><IMG SRC="../assets/images/save.gif" BORDER="0"></A> -->
<!-- <input onClick="validateAdlEdit('full');" type="button" value="Save" STYLE="Background-Color : #adffad"> -->
<!-- <button  onClick="validateAdlEdit('full');" class="button-green pure-button">Save</button> -->
<button  onClick="validateAdlEdit('full');" class="btn btn-success">Save</button>


 <?php } else {echo "<font color=red>Listing Locked</font>";}?>
</td></tr>
</table></CENTER>
		</div>
</form>
</div>
<br>

<!--End adlEdit -->
