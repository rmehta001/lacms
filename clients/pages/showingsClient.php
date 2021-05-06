<!--BEGIN showings -->
<?php
$pref_pagebg = $_SESSION["pref_pagebg"]; 

$pref_pagebg='';
if (isset($pref_pagebg) ){
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>

<CENTER>
<TABLE BGCOLOR="#FFFFFF" WIDTH="800" BORDER="1" bordercolor="#000000"><TR><TD>
<CENTER>

<TABLE BGCOLOR="#FFFFFF" BORDER=0><TR>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/hotlist-pads.jpg" HEIGHT="54" WIDTH="120">
</TD>
<TD VALIGN="middle" ALIGN="CENTER">
<b><font size="+2">CLIENT HISTORY</font></b>
</TD>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/hotlist-pen.jpg" HEIGHT="54" WIDTH="120">
</TD></TR></TABLE>

<HR>
<CENTER>


<table width="100%" BORDER="0">
<tr>
<td>
<CENTER>





<CENTER>

<TABLE BORDER="1" BORDERCOLOR="#000000" CELLPADDING="2" BGCOLOR="#FFFFFF" WIDTH="95%"><TR><TD>
<CENTER><B><FONT SIZE="+1">CLIENT SHOWING / COMMENT HISTORY</FONT></B>
<div class="controltext">
<a href="<?php echo "$PHP_SELF?op=createshowingentry&clid=$clid";?>" TITLE="Add Showing History / Comment Entry" target="_sh<?php if (isset($clid)) echo $clid;?>"><img border="0" hspace="0" vspace="0" width="16" height="16" src="../assets/images/showings.jpg" TITLE="Add Showing History / Comment" ALT="Add Showing Client Showing History / Comment"> Add Showing History / Comment Entry</A>
</div>
</CENTER>

<?php
$quStrShow = "SELECT * FROM `SHOWINGS` WHERE `CLI`=\"$grid\" AND `CLID`=\"$clid\" ORDER BY SHOWING_DATE DESC";
$StrGetShow = mysqli_query($dbh, $quStrShow) or die (mysqli_error());
      if(mysqli_num_rows($StrGetShow)!=0){
?>

<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%"><TR><TD><NOBR><FONT SIZE="-1"><B>SHOW DATE</B></FONT></NOBR></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>LISTING</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>OWNER</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>CLIENT</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>RATING</TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>COMMENTS</B></FONT></TD></TR>


<?php
$pref_pagebg = $_SESSION["pref_pagebg"]; 
$pref_coltit = $_SESSION["pref_coltit"];
    

$pref_pagebg='';
if (isset($pref_pagebg) ){
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
}
if ($pref_coltit=="") {
$coltitcolor="#3DB1FF";
} else {
$coltitcolor="$pref_coltit";
}?>


<?php
while ($rowshow = mysqli_fetch_object($StrGetShow)) {
?>



<TR bgcolor="<?php if(isset($rowColor)) echo $rowColor;?>"><TD><NOBR>
<A HREF="<?php if(isset($rowShow)) echo "$PHP_SELF?op=editshowing&cid=$rowshow->CID&showid=$rowshow->SHOWID";?>"><FONT SIZE="-1"><?php if(isset($rowShow)) echo $rowshow->SHOWING_DATE;?></FONT></A>
</NOBR></TD>
<TD>&nbsp;</TD>
<TD>


<?php

$quStrclass = "SELECT STREET_NUM, STREET, APT, LANDLORD FROM `CLASS` WHERE `CLI`=\"$grid\" AND `CID`=\"$rowshow->CID\"";
$StrGetclass = mysqli_query($dbh, $quStrclass) or die (mysqli_error($dbh));

while ($rowclass = mysqli_fetch_object($StrGetclass)) {
?>
<NOBR><FONT SIZE="-1">
<a href="<?php if(isset($rowShow)) echo "$PHP_SELF?op=adlEdit&cid=$rowshow->CID&return_page=sel&return_page_rid=$rowshow->CID&return_page_div=$k";?>" target="_show<?php if(isset($rowShow)) echo $rowshow->CID;?>"><?php if(isset($rowClass)) echo $rowclass->STREET_NUM;?> <?php if(isset($rowClass)) echo $rowclass->STREET;?> #<?php if(isset($rowClass)) echo $rowclass->APT;?></a>
</FONT></NOBR>

<?php } ?>


</TD><TD>&nbsp;</TD>
<TD>
<?php
$quStrll = "SELECT SHORT_NAME FROM `LANDLORD` WHERE `GRID`=\"$grid\" AND `LID`=\"$rowshow->LID\"";
$StrGetll = mysqli_query($dbh, $quStrll) or die (mysqli_error($dbh));


while ($rowll = mysqli_fetch_object($StrGetll)) {
	
			      if(mysqli_num_rows($StrGetll)!=0){
?>
<NOBR><FONT SIZE="-1"><a href="<?php echo "$PHP_SELF?op=editLandlord&lid=$rowshow->LID";?>" TITLE="Edit/View <?php echo "$rowll->SHORT_NAME";?>'s Info" target="_sll<?php echo $rowll->LID;?>"><?php echo $rowll->SHORT_NAME;?></A></FONT></NOBR>
<?php 
      } else {
echo "<FONT COLOR=\"#FF0000\">No Landlord</FONT>";
}
} ?>



</TD><TD>&nbsp;</TD><TD>
<?php
$quStrcl = "SELECT NAME_FIRST, NAME_LAST FROM `CLIENTS` WHERE `GRID`=\"$grid\" AND `CLID`=\"$rowshow->CLID\"";
$StrGetcl = mysqli_query($dbh, $quStrcl) or die (mysqli_error($dbh));

while ($rowcl = mysqli_fetch_object($StrGetcl)) {
	
			      if(mysqli_num_rows($StrGetcl)!=0){
	
?>
<NOBR>
<FONT SIZE="-1">
<a href="<?php echo "$PHP_SELF?op=editClient&clid=$rowcl->CLID\" TITLE=\"Edit/View".$rowcl->NAME_FIRST.$rowcl->NAME_LAST;?>" TARGET="_Client<?php echo $rowcl->CLID;?>"><?php echo $rowcl->NAME_FIRST." ".$rowcl->NAME_LAST; ?></A>
</FONT>
</NOBR>
<?php 
      } else {
echo "<FONT COLOR=\"#FF0000\">No Client</FONT>";
}
} ?>


</TD><TD>&nbsp;</TD><TD><CENTER>
<FONT SIZE="-1"><?php echo $rowshow->RATING;?></FONT>
</CENTER></TD><TD>&nbsp;</TD><TD><FONT SIZE="-2">
<?php echo $rowshow->SHOWCOMMENT;?></FONT>
</TD></TR>



    	<?php $pref_row_color = $_SESSION["pref_row_color"];
 if (isset($rowColor)) if ($rowColor=="#F5F5DC" OR $rowColor=="$pref_row_color") {
    		$rowColor="#FFFFFF";
    	}else {

if (isset($pref_row_color)){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} 
    }
    }?>
	
	
<?php 
      } else {
echo "<CENTER><FONT COLOR=\"#FF0000\">Sorry, there is no showing history for this client</FONT></CENTER><BR>";
} ?>
</TABLE>






<TABLE BORDER="0" BORDERCOLOR="#000000" CELLPADDING="2" BGCOLOR="#FFFFFF" WIDTH="100%"><TR><TD>
<FONT SIZE=-3><BR></FONT>
<CENTER><B><FONT SIZE="+1">CLIENT ACTION HISTORY</FONT></B></CENTER>
<FONT SIZE=-3><BR></FONT>
<?php
$quStrCHist = "SELECT * FROM `CLIENTS_HISTORY` WHERE `CLI`=\"$grid\" AND `CLID`=\"$clid\" ORDER BY CLHIST_DATE DESC";
$StrGetCHist = mysqli_query($dbh, $quStrCHist) or die (mysqli_error($dbh));
      if(mysqli_num_rows($StrGetCHist)!=0){
?>

<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%"><TR><TD><NOBR><FONT SIZE="-1"><B>DATE</B></FONT></NOBR></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>AGENT</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>ACTION</B></FONT></TD></TR>


<?php
$pref_row_color = $_SESSION["pref_row_color"]; 
if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} ?>


<?php
while ($rowCHist = mysqli_fetch_object($StrGetCHist)) {
?>

<TR bgcolor="<?php echo $rowColor;?>">
<TD>
<NOBR>
<FONT SIZE="-1"><?php echo $rowCHist->CLHIST_DATE;?></FONT>
</NOBR></TD>
<TD>&nbsp;</TD>

<TD>
<NOBR>
<FONT SIZE="-1"><?php echo $rowCHist->HANDLE;?></FONT>
</NOBR>
</TD><TD>&nbsp;</TD>
<TD>
<NOBR>
<FONT SIZE="-1"><?php echo $rowCHist->ACTION;?></FONT>
</NOBR>
</TD></TR>

    	<?php $pref_row_color = $_SESSION["pref_row_color"]; 
 if ($rowColor=="#F5F5DC" OR $rowColor=="$pref_row_color") {
    		$rowColor="#FFFFFF";
    	}else {

if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
} 
    }
    }?>
	
<?php 
      } else {
echo "<CENTER><FONT COLOR=\"#FF0000\">Sorry, there is no history for this client. </FONT></CENTER><BR>";
} ?>
</TABLE>
</TD></TR></TABLE>

</TD></TR></TABLE>


<a href="<?php echo "$PHP_SELF?op=hotlist";?>" TITLE="Dashboard Stats & Shortcuts to Favorite Clients, Listings & more"><FONT SIZE="-1">Go to the Hot List to see all your appointments, reminders, &amp; showing history.</FONT></A><BR>
</td></TR>



</TABLE>


</TD></TR></TABLE>

</font>
</center>
</TD></TR></TABLE>
<!--END editReminders -->