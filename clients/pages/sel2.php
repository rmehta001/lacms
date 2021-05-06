<!--BEGIN sel -->

<?php 
$quStrLimitCount = "SELECT count(CID) AS COUNTOF FROM $ads_table_set $WHERE $ORDERBY";
$quLimitCount = mysqli_query($dbh, $quStrLimitCount) or die (dieNice("Sorry,  could not pagenate your ads", "E-200"));
$rowLimitCount = mysqli_fetch_object($quLimitCount);
$numPages = ceil($rowLimitCount->COUNTOF / $limitN);
$k = 1;

?>


		<table border="0" cellspacing="0" cellpadding="0" height="6" BGCOLOR="lightgrey">
		<tr>
		<td align="center">
		<form action="<?php echo $PHP_SELF;?>" method="GET" name="typeFilterForm">
		<input type="hidden" name="op" value="sel">
		<input type="hidden" name="start" value="z">
		<div class="controltext">View:<select size="1" name="typeFilter" style="background-color:white" onchange="JavaScript:document.typeFilterForm.submit();">
		<?php while ($rowTypes = mysqli_fetch_object($quTypes)) { ?>
			<option value="<?php echo $rowTypes->TYPE;?>" <?php if ($rowTypes->TYPE==$typeFilter) { echo "selected"; } ?>><?php echo "$rowTypes->TYPENAME"." ";?></option>
		<?php } ?>
		</select>
		</form>
		</td>
		<td width="1">&nbsp;</td>
		<td align="center" width="170"><NOBR><form action="<?php echo "$PHP_SELF";?>" method="GET" name="limitNForm"><input type="hidden" name="op" value="sel"><div class="controltext">Show<input type="text" size="2" name="limitN" value="<?php echo $limitN;?>" onchange="JavaScript:document.limitNForm.submit();">ads per page.</NOBR></div></form></td>
<TD>&nbsp;</TD>
		<td align="center">
		<form action="<?php echo $PHP_SELF;?>" method="GET" name="pageFlipForm">
		<input type="hidden" name="op" value="sel">
		<div class="controltext">View page:<select name="start" style="background-color:white" onchange="JavaScript:document.pageFlipForm.submit();" >
		<?php for ($i=1;$i<=$numPages;$i++) { 
		    	$thisCalc = $limitN * ($i-1);
		    	if (!$thisCalc) {
		    		$thisCalc = "z";
		    	}?>		    	?>
		    	<option value="<?php echo $thisCalc;?>" <?php if ($thisCalc==$start) {echo " selected ";}?>><?php echo $i;?></option>
		<?php }?>
		</select>
		</form>
		</td></div>
		</tr>
		<tr>
		<td colspan="5" bgcolor="#FFFFFF" align="center">
		<div class="controltext">
		 <a href="<?php echo "$PHP_SELF?op=sel&start=z&limitN=$rowLimitCount->COUNTOF";?>">Show all ads</a> - 
		    <?php 
		    if ($userFilter) { ?>
		    	<a href="<?php echo "$PHP_SELF?op=sel&start=z&userFilter=n";?>">Show all ads for <?php echo $group;?></a>
		    <?php } else { ?>
		    	<a href="<?php echo "$PHP_SELF?op=sel&start=z&userFilter=1";?>">Show only <?php echo $handle;?>'s ads</a>
		    <?php } ?>
		   -
		    <?php 
		    if ($activeFilter) { ?>
		    	<a href="<?php echo "$PHP_SELF?op=sel&start=z&activeFilter=n";?>">Show all active and inactive ads</a>
		    <?php } else { ?>
		    	<a href="<?php echo "$PHP_SELF?op=sel&start=z&activeFilter=1";?>">Show only active ads</a>
		    <?php } ?>
		    </div>
		</td>
		</tr>
		</table>


		<table border="0" width="100%" cellspacing="0" cellpadding="0" height="15">
		<tr>
		    <td bgcolor="FFFFFF" WIDTH="10%">
<CENTER>
<?php if ($user_level>0) {?>

		      <form action="<?php echo "$PHP_SELF?op=select_and_do&return_page=sel";?>" method="POST" name="moveform">
		      <select size="1" name="sop" style="background-color:white">
		  		<?php if ($user_level >= 3) { echo "<option value='delete'>Delete...</option>";} ?>
		  		<option value="deactivate" selected>Deactivate Ad(s)</option>
		  		<option value="activate">Activate Ad(s)</option>
				<option value="available">Mark Available</option>
				<option value="act-avail">Mark Avail+Active</option>
				<option value="unavailable">Mark Unavailable</option>
				<option value="deact-unavail">Mark Unavl+Deactive</option>
		  		<option value="updtd">Mark as Updated</option>
		  		<option value="vacant">Mark Vacant</option>
		  		<option value="occupied">Mark Occupied</option>
		  		<option value="pending">Mark Pending</option>
				<option value="pendingno">Mark Not Pending</option>
		  		<option value="nofee">Make NO FEE</option>
		  		<option value="fee">Remove NO FEE</option>
		  		<option value="feehalf">Make 1/2 FEE</option>
		  		<option value="feeneg">FEE Negotiable</option>
		  		<option value="email">Email Listing(s)</option>
		  		<option value="dom">Reset Days on Market</option>
		  		<option value="print">.</option>

			        </select><br>
		        <INPUT TYPE=IMAGE SRC="../images/dotochecked.gif" NAME="SUBMIT"><br>
		  	<div class="controltext">Select All: <input type="checkbox" name="allbox" value="sel_all" onClick="CheckAll();" TITLE="Check to select ALL listings for a multi-listing action"></div>
				</CENTER>
				</td>

		    <td bgcolor="#000000">
&nbsp;
<?php }?>

</TD><TD WIDTH="80%">

<CENTER>
<table border="0" cellspacing="0" cellpadding="0" height="6">
			<tr>
			<td colspan="40" align="center"> <FONT SIZE="-3">

<?php echo "Total # of matching listings $rowLimitCount->COUNTOF"; ?>

<br></FONT>
			<div class="controltext"><?php if($sortD=="DESC") { echo "<a href='$PHP_SELF?op=sel&sortD=ASC'><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/down.gif'><B><FONT COLOR=GREEN>Sort</FONT></B></a>"; } else { echo "<a href='$PHP_SELF?op=sel&sortD=DESC'><img width='12' height='12' border='0' hspace='0' vspace='0' src='../assets/images/up.gif'><B><FONT COLOR=GREEN>Sort</FONT></B></a>"; }?></div>
			</td>
			</tr>
			<tr>
			<td class="controltext" bgcolor="<?php if ($sort=="STATUS") {echo "#FFFFFF"; } else { echo "#FFFF99";} ?>">&nbsp;<a href="<?php echo "$PHP_SELF?op=sel&sort=STATUS&sortD=ASC";?>">Status</a>&nbsp;</td>
<TD BGCOLOR=#FFFF99><FONT COLOR=#808080>|</FONT></TD>
			<td class="controltext" bgcolor="<?php if ($sort=="CID") {echo "#FFFFFF"; } else { echo "#FFFF99";} ?>">&nbsp;<a href="<?php echo "$PHP_SELF?op=sel&sort=CID&sortD=ASC";?>">ID#</a>&nbsp;</td>
<TD BGCOLOR=#FFFF99><FONT COLOR=#808080>|</FONT></TD>
			<td class="controltext" bgcolor="<?php if ($sort=="DATEIN") {echo "#FFFFFF"; } else { echo "#FFFF99";} ?>">&nbsp;<a href="<?php echo "$PHP_SELF?op=sel&sort=DATEIN&sortD=ASC";?>">Created</a>&nbsp;</td>
<TD BGCOLOR=#FFFF99><FONT COLOR=#808080>|</FONT></TD>
			<td class="controltext" bgcolor="<?php if ($sort=="MOD") {echo "#FFFFFF"; } else { echo "#FFFF99";} ?>">&nbsp;<a href="<?php echo "$PHP_SELF?op=sel&sort=MOD&sortD=ASC";?>">Modified</a>&nbsp;</td>
<TD BGCOLOR=#FFFF99><FONT COLOR=#808080>|</FONT></TD>
			<td class="controltext" bgcolor="<?php if ($sort=="LOCNAME") {echo "#FFFFFF"; } else { echo "#FFFF99";} ?>">&nbsp;<a href="<?php echo "$PHP_SELF?op=sel&sort=LOCNAME&sortD=ASC";?>">Location</a>&nbsp;</td>
<TD BGCOLOR=#FFFF99><FONT COLOR=#808080>|</FONT></TD>
			<td class="controltext" bgcolor="<?php if ($sort=="LANDLORD.SHORT_NAME") {echo "#FFFFFF"; } else { echo "#FFFF99";} ?>">&nbsp;<a href="<?php echo "$PHP_SELF?op=sel&sort=LANDLORD.SHORT_NAME&sortD=ASC";?>">Landlord</a>&nbsp;</td>
<TD BGCOLOR=#FFFF99><FONT COLOR=#808080>|</FONT></TD>

			<td class="controltext" bgcolor="<?php if ($sort=="PRICE") {echo "#FFFFFF"; } else { echo "#FFFF99";} ?>">&nbsp;<a href="<?php echo "$PHP_SELF?op=sel&sort=PRICE&sortD=ASC";?>">Price</a>&nbsp;</td>
<TD BGCOLOR=#FFFF99><FONT COLOR=#808080>|</FONT></TD>


			<td class="controltext" bgcolor="<?php if ($sort=="PRICE") {echo "#FFFFFF"; } else { echo "#FFFF99";} ?>">&nbsp;<a href="<?php echo "$PHP_SELF?op=sel&sort=ROOMS&sortD=ASC";?>">Size</a>&nbsp;</td>
<TD BGCOLOR=#FFFF99><FONT COLOR=#808080>|</FONT></TD>

			<td class="controltext" bgcolor="<?php if ($sort=="AVAIL") {echo "#FFFFFF"; } else { echo "#FFFF99";} ?>">&nbsp;<a href="<?php echo "$PHP_SELF?op=sel&sort=AVAIL&sortD=ASC";?>">Available</a>&nbsp;</td>
<TD BGCOLOR=#FFFF99><FONT COLOR=#808080>|</FONT></TD>

			<td class="controltext" bgcolor="<?php if ($sort=="HANDLE") {echo "#FFFFFF"; } else { echo "#FFFF99";} ?>">&nbsp;<a href="<?php echo "$PHP_SELF?op=sel&sort=HANDLE&sortD=ASC";?>">Agent</a>&nbsp;</td>
<TD BGCOLOR=#FFFF99><FONT COLOR=#808080>|</FONT></TD>
			<td class="controltext" bgcolor="<?php if ($sort=="PIC") {echo "#FFFFFF"; } else { echo "#FFFF99";} ?>">&nbsp;<a href="<?php echo "$PHP_SELF?op=sel&sort=PIC&sortD=ASC";?>">Pictures</a>&nbsp;</td>
			</div>
			</tr>
			</table>

</CENTER>

</TD>

<TD WIDTH="10%">
&nbsp;
</TD>


		  </tr>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
		  <tr>
		    <td colspan=2><table border="0" cellpadding="0" cellspacing="0" width="100%">
		    
		<?php while ($rowGetAds = mysqli_fetch_object($quGetAds)) {?>
		    



		    <?php $landlord = ($rowGetAds->LANDLORD) ? "<b>LANDLORD: $rowGetAds->SHORT_NAME</b>" : "";?>
		    <tr>
		      <td width="100%" height="1" colspan="8" bgcolor="#000000"><img width="100%" height="1" vspace="0" hspace="0" border="0" src="../assets/images/blk_spacer.gif"></td>
		    </tr>
		    
		    <tr>
		     
		      <td width="8%" align="right" bgcolor="#FFFFFF" rowspan="2" VALIGN="TOP"><FONT SIZE="-4"><BR></FONT><NOBR><font color="#000000" face="Verdana" size="1"><?php echo "$abv-$rowGetAds->CID";?>&nbsp; <input tabindex="2" id="ad<?php echo $k++;?>k" type="checkbox" name="sel_ids[]" value="<?php echo $rowGetAds->CID;?>" TITLE="Check to select listing for a multi-listing action"></NOBR><BR><BR><CENTER>

<?php if ($rowGetAds->PIC!=0) {

      $quStrGetPics = "SELECT * FROM PICTURE WHERE CID=$rowGetAds->CID ORDER BY PICORDER, PID LIMIT 1";
      $quGetPics = mysqli_query($dbh, $quStrGetPics);
      $rowGetPics = mysqli_fetch_object($quGetPics);
         $thumb="<IMG SRC=https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT HEIGHT=60 WIDTH=60 BORDER=0 TITLE=\"Click for Company Display Ad\">"; 

 	}
else
	{	$thumb="<FONT SIZE=-2 color=#BDBDBD>No Photo</FONT>";	}  


if ($rowGetAds->THUMBNAIL) {
	$thumb = "<a href=https://www.BostonApartments.com/homepage.php?cli=".$rowGetAds->CLI."&ad=".$rowGetAds->CID." target=_NEW><IMG SRC=https://www.BostonApartments.com/pics/".$rowGetAds->THUMBNAIL." BORDER=0 HEIGHT=60 WIDTH=60 TITLE=\"Click for Company Display Ad\"></A>";
}







echo "<a href=https://www.BostonApartments.com/homepage.php?cli=".$rowGetAds->CLI."&ad=".$rowGetAds->CID." target=_NEW BORDER=0  HEIGHT=60 WIDTH=60 TITLE=\"Click for Company Display Ad\">$thumb</A><BR><FONT SIZE=-1>";

if ($rowGetAds->PIC>"0") {
echo "x$rowGetAds->PIC";
}
?>
</FONT>
</CENTER>
</td>
		      <td width="1%" bgcolor="#FFFFFF" rowspan="2" VALIGN="TOP"><FONT SIZE="-4"><BR></FONT>
		      


		      </td>
		      <td width="400" height="26" bgcolor="#FFFFFF"><font color="#000000" face="Verdana" size="1">


<?php if ($user_level>0) {?>

		      <?php if ($rowGetAds->STATUS=="ACT") { echo "<a href='$PHP_SELF?op=deactivate&cid=$rowGetAds->CID&return_page_div=$k'><img border='0' vspace='0' hspace='0' width='16' height='16' src='../assets/images/act.gif'></a>";} else {echo "<a href='$PHP_SELF?op=activate&cid=$rowGetAds->CID'><img border='0' vspace='0' hspace='0' width='16' height='16' src='../assets/images/inact.jpg'></a>";} ?>


<?php if($rowGetAds->STATUS_ACTIVE =="1")  { ?>

<?php if ($user_level>0) {?>

                              <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetAds->CID . "&turn=unavailable&return_page=sel&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/a.jpg" border=0 height=16 width=16 alt="available" title="Available">
<?php if ($user_level>0) {?>
</a>
<?php }?>

			    <?php  } else { ?>
<?php if ($user_level>0) {?>
			      <a href="<?php echo "$PHP_SELF?op=mark_status_active&cid=".$rowGetAds->CID . "&turn=available&return_page=sel&return_page_div=" . $k;?>">
<?php } ?>
<img src="../assets/images/icons/u.jpg" border=0 height=16 width=16 alt="unavailable" title="Unavailable">
<?php if ($user_level>0) {?>
</a>
<?php } ?>
			<?php } ?>




<?php if($rowGetAds->STATUS_PENDING=="1")
			   { ?>
<?php if ($user_level>0) {?>
                              <a href="<?php echo "$PHP_SELF?op=mark_status_pending&cid=".$rowGetAds->CID . "&turn=pendingno&return_page=sel&return_page_div=" . $k;?>">
<?php }?>
<img src="../assets/images/icons/pending-yes.gif" border=0 HEIGHT="16" WIDTH="16" alt="Pending Status - Yes" title="Pending Status - YES - Check Status">
<?php if ($user_level>0) {?>
</a>
<?php }?>
			    <?php  } else { ?>
<?php if ($user_level>0) {?>
	<a href="<?php echo "$PHP_SELF?op=mark_status_pending&cid=".$rowGetAds->CID . "&turn=pending&return_page=sel&return_page_div=" . $k;?>">
<?php } ?>
<img src="../assets/images/icons/pending-no.gif" border=0 HEIGHT="16" WIDTH="16" alt="Pending Status - No" title="Pending Status - No">
<?php if ($user_level>0) {?>
</a>
<?php } ?><?php } ?></FONT>



		      	<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=$rowGetAds->CID&return_page=sel&return_page_rid=$rowGetAds->CID&return_page_div=$k";?>"><img border=0 src="../images/icons/edit.gif" alt="edit" title="edit" vspace="0" hspace="0" ></a>
		      <?php if ($user_level >= 2) { echo "<a href='$PHP_SELF?op=delete&cid=$rowGetAds->CID'><img border=\"0\" src=\"../images/icons/delete.gif\" alt=\"delete\" title=\"delete\" vspace=\"0\" hspace=\"0\"></a>"; } ?>

<?php }?>



<?php if ($user_level==0) {?>

		      <?php if ($rowGetAds->STATUS=="ACT") { echo "<img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/act.gif'>";} else {echo "<img border='0' vspace='0' hspace='0' width='12' height='12' src='../assets/images/inact.jpg'>";} ?>

<?php }?>




<?php if ($user_level>0) {?>
		      <a href="<?php echo "$PHP_SELF?op=managePics&cid=$rowGetAds->CID&return_page=sel&return_page_rid=$rowGetAds->CID&return_page_div=$k";?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../assets/images/upload.jpeg" alt="upload a picture" title="upload a picture"></a>
<?php }?>



		      <?php if ($rowGetAds->PIC) {
		      
		      echo "<a href='$PHP_SELF?op=managePics&cid=$rowGetAds->CID&return_page_div=$k'><img border='0' vspace='0' hspace='0' src='../images/pic.gif' alt='manage pictures' title='manage pictures'></a>"; 

		      if ($rowGetAds->STREET_NUM !="" AND $rowGetAds->STREET !="") {
		       echo "&nbsp;<a href=\"$PHP_SELF?op=pics-building&street_num=$rowGetAds->STREET_NUM&street=$rowGetAds->STREET&lid=$rowGetAds->LANDLORD\" target=\"_NEW\"><img border=\"0\" src=\"../assets/images/pic-gallery.jpeg\" HEIGHT=\"17\" WIDTH=\"24\" alt=\"Building Picture Gallery\" title=\"Building Picture Gallery\"></a>"; }
		      
		      }?>
		      
		      <a href="<?php echo "$PHP_SELF?op=hot_list_add&item_type=1&item_id=$rowGetAds->CID&return_page=sel&return_page_rid=$rowGetAds->CID&return_page_div=$k";?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../assets/images/hot.gif" alt="Add to Hot List" title="Add to Hot List"></a>

<a href="<?php echo "$PHP_SELF?op=mark_status_updated&cid=$rowGetAds->CID&return_page=sel&return_page_rid=$rowGetAds->CID&return_page_div=$k";?>"><img border="0" vspace="0" hspace="0" src="https://www.BostonApartments.com/images/newIcon.gif" alt="Mark Listing as New" title="Mark Listing as New"></a>


                        <?php if($rowGetAds->STATUS_VACANT=="1")
			   { ?>
<?php if ($user_level>0) {?>
                              <a href="<?php echo "$PHP_SELF?op=mark_status_vacant&cid=$rowGetAds->CID&turn=occupied&return_page=sel&return_page_div=$k";?>">
<?php }?>
<img src="../assets/images/icons/vacant.jpg" border=0 height=14 width=14  alt="vacant" title="Vacant Unit">
<?php if ($user_level>0) {?>
</a>
<?php }?>
			    <?php  } else { ?>
<?php if ($user_level>0) {?>
			      <a href="<?php echo "$PHP_SELF?op=mark_status_vacant&cid=$rowGetAds->CID&turn=vacant&return_page=sel&return_page_div=$k";?>">
<?php } ?>
<img src="../assets/images/icons/occupied.jpg" border=0 height=14 width=14 alt="occupied" title="Occupied Unit
<?php
if ($rowGetAds->TENANT_NAME) { echo " - ".$rowGetAds->TENANT_NAME." "; }
if ($rowGetAds->TENANT_PHONE) { echo $rowGetAds->TENANT_PHONE." " ; }
if ($rowGetAds->SHOW_INSTRUCT) { echo $rowGetAds->SHOW_INSTRUCT." " ; }
?>
">
<?php if ($user_level>0) {?>
</a>
<?php } ?>
	
<?php } ?>

<A HREF="<?php echo "$PHP_SELF?op=createshowing&cid=$rowGetAds->CID&return_page=sel";?>"><img border=0 src="../assets/images/showings.jpg" alt="edit" vspace="0" hspace="0" HEIGHT="16" WIDTH="16" TITLE="Create A Showing"></A>

<A HREF="<?php echo "$PHP_SELF?op=showinghistoryunit&cid=$rowGetAds->CID&return_page=adlEdit";?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings-history.jpg" TITLE="Listing Showing History" ALT="Listing Showing History"></A>

<A HREF="<?php echo "$PHP_SELF?op=openhouse-add&CID=$rowGetAds->CID&return_page=adlEdit";?>"><IMG SRC="../assets/images/openhouse.jpg" height="16" WIDTH="16" BORDER="0" ALT="Create Open House" TITLE="Create an Open House"></A>

<a href="<?php echo "$PHP_SELF?op=mail_listing&cid=$rowGetAds->CID";?>" target="_new"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22 alt="Email Listing" title="Email Listing"></A>

<a href="<?php echo "https://www.BostonApartments.com/clpost.php?ad=$rowGetAds->CID&cli=$rowGetAds->CLI&uid=$uid\" target=\"_CL$rowGetAds->CID\"";?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/cl.gif" alt="Post to Craigslist" title="Post to Craigslist"></A>

<a href="<?php echo "https://www.BostonApartments.com/kijijipost.php?ad=$rowGetAds->CID&cli=$rowGetAds->CLI&uid=$uid\" target=\"_KIJ$rowGetAds->CID\"";?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/kijiji.gif" alt="Post to Kijiji" title="Post to Kijiji"></A>

<a href="<?php echo "http://www.facebook.com/sharer.php?u=http%3A%2F%2Fbostonapartments.com%2Fhomepage.php%3Fcli%3D$rowGetAds->CLI%26ad%3D$rowGetAds->CID";?>" target="_FB<?php echo $rowGetAds->CID;?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/facebook.gif" alt="Post to Facebook" title="Post to Facebook"></A>

<a href="<?php echo "http://twitter.com/home?status=http%3A%2F%2Fbostonapartments.com%2Fhomepage.php%3Fcli%3D$rowGetAds->CLI%26ad%3D$rowGetAds->CID%20title%3DListing%23$rowGetAds->CID%20%24$rowGetAds->PRICE%20$rowGetAds->LOCNAME%20$rowGetAds->ROOMS%20Bed";?>" target="_tweet<?php echo $rowGetAds->CID;?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../assets/images/twitter.jpeg" alt="Post to Twitter" title="Post to Twitter"></a>
</nobr>

<A HREF="http://www.myspace.com/index.cfm?fuseaction=postto&t=<?php 
if ($rowGetAds->AD_TITLE !="") {
echo "$rowGetAds->AD_TITLE";
} else {
echo "$rowGetAds->LOCNAME - $rowGetAds->PRICE - $rowGetAds->ROOMS%20Bed";
} ;?>&c=<?php  echo htmlspecialchars($rowGetAds->BODY); ?>&u=http://bostonapartments.com/homepage.php?cli=<?php  echo "$rowGetAds->CLI"; ?>&ad=<?php  echo "$rowGetAds->CID"; ?>&l=1" TARGET="_myspace<?php echo $rowGetAds->CID;?>"><img width="16" height="16" border="0" vspace="0" hspace="0" src="../images/icons/myspace.gif" alt="Post to MySpace" title="Post to MySpace"></A>


</td>

		      <td width="368" height="26" align="right" bgcolor="#FFFFFF"><div class="ad"><?php echo $landlord;?> &nbsp <i>address: <?php echo $rowGetAds->STREET_NUM;?> <?php echo $rowGetAds->STREET;?> Apt# <?php echo $rowGetAds->APT;?></i>&nbsp;</div></td>
		    </tr>

		    <tr>
		      <td colspan="2" bgcolor="#FFFFFF" valign="top">
<TABLE BORDER="0" CELLPADDING="0" WIDTH="100%"><TR><TD VALIGN="TOP">
<div class="ad">

<?php echo format_ad ($rowGetAds, $DEFINED_VALUE_SETS);?>

</div>


</TD></TR></TABLE>

		      </td>
		    </tr>
		    <tr>
		      <td width="115" height="26" bgcolor="#FFFFFF" colspan="2"></td>
		      <td width="369" height="26" bgcolor="#FFFFFF">&nbsp;</td>
		      <td width="368" height="26" align="right" bgcolor="#FFFFFF"><div class="ad"><i>created <?php echo fuzDate($rowGetAds->DATEIN); ?> by <?php echo $rowGetAds->HANDLE;?> &nbsp; modified <?php echo fuzDate($rowGetAds->MOD); ?> by <?php echo $rowGetAds->MODBY; ?></i>&nbsp;</div></td>
		    </tr>
		    </div>
		    <?php } ?>
		    <tr>
		      <td width="856" height="21" colspan="4" bgcolor="#FFFFFF">
		      <hr noshade size="1" color="#000000" align="right">
		      </td>
		      
		    </tr>
		   
		  </table></td>
		  </tr>
		  
		
		</div>
		</table>
		<table BGCOLOR="lightgrey"><FORM></FORM>
		<tr>
		<td align="left" VALIGN="TOP">
<form action="<?php echo "$PHP_SELF";?>" method="GET" name="limitNForm"><input type="hidden" name="op" value="sel"><div class="controltext">Show<input type="text" size="2" name="limitN" value="<?php echo $limitN;?>" onchange="JavaScript:document.limitNForm.submit();">ads per page.</div></form></td>
		<td align="right" VALIGN="TOP">
		<form action="<?php echo $PHP_SELF;?>" method="GET" name="pageFlipForm2">
		<input type="hidden" name="op" value="sel">
		<div class="controltext">View page:<select name="start" style="background-color:white" onchange="JavaScript:document.pageFlipForm2.submit();" >
		<?php for ($i=1;$i<=$numPages;$i++) { 
		    	$thisCalc = $limitN * ($i-1);
		    	if (!$thisCalc) {
		    		$thisCalc = "z";
		    	}?>		    	?>
		    	<option value="<?php echo $thisCalc;?>" <?php if ($thisCalc==$start) {echo " selected ";}?>><?php echo $i;?></option>
		<?php }?>
		</select></div>
		</form>
		</td>
		</tr>
		<tr>
		<td colspan="5" bgcolor="#FFFFFF" align="center">
		<div class="controltext">
		 <a href="<?php echo "$PHP_SELF?op=sel&start=z&limitN=$rowLimitCount->COUNTOF";?>">Show all ads</a> - 
		    <?php 
		    if ($userFilter) { ?>
		    	<a href="<?php echo "$PHP_SELF?op=sel&start=z&userFilter=n";?>">Show all ads for <?php echo $group;?></a>
		    <?php } else { ?>
		    	<a href="<?php echo "$PHP_SELF?op=sel&start=z&userFilter=1";?>">Show only <?php echo $handle;?>'s ads</a>
		    <?php } ?>
		   -
		    <?php 
		    if ($activeFilter) { ?>
		    	<a href="<?php echo "$PHP_SELF?op=sel&start=z&activeFilter=n";?>">Show all active and inactive ads</a>
		    <?php } else { ?>
		    	<a href="<?php echo "$PHP_SELF?op=sel&start=z&activeFilter=1";?>">Show only active ads</a>
		    <?php } ?>
		    </div>
		</td>
		</tr>
		</table>
		</div>

<?php if ($return_page_div) {?>
	<SCRIPT FOR=window EVENT=onload LANGUAGE="JScript">
		return_scroll(<?php echo $return_page_div;?>);
	</script>
<?php }?>
</FORM>
<!--END sel -->
