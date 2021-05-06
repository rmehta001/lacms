<!--BEGIN showings -->
<?php
if ($_SESSION["pref_row_color"] == "") {
    $pagebgcolor = "#F5F5DC";
} else {
    $pagebgcolor = $_SESSION["pref_row_color"];
}
?>

<CENTER>
<TABLE BGCOLOR="#FFFFFF" WIDTH="90%" BORDER="0" class="mt-4" bordercolor="#000000"><TR><TD>
<CENTER>

<TABLE BGCOLOR="#FFFFFF" BORDER=0><TR>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/hotlist-pads.jpg" HEIGHT="54" WIDTH="120">
</TD>
<TD VALIGN="middle" ALIGN="CENTER">
<b><font size="+2">AGENT SHOWING HISTORY FOR<BR>
<?php echo $_SESSION["handle"]; ?></font></b>
</TD>
<TD VALIGN="BOTTOM" ALIGN="CENTER">
<img border="0" src="../assets/images/hotlist-pen.jpg" HEIGHT="54" WIDTH="120">
</TD></TR></TABLE>

<HR>
<CENTER>


<table width="100%" BORDER="0" class = "med-shadow rounded-lg">
<tr>
<td>
<CENTER>





<CENTER>

<TABLE BORDER="0"  BORDERCOLOR="#000000" CELLPADDING="5" BGCOLOR="#FFFFFF" WIDTH="98%"><TR><TD>



<?php
$quStrShow = "SELECT * FROM `SHOWINGS` WHERE `CLI`=\"$grid\" AND `UID`=\"$uid\" ORDER BY SHOWING_DATE DESC";
$StrGetShow = mysqli_query($GLOBALS['dbh'], $quStrShow) or die(mysqli_error());
if (mysqli_num_rows($StrGetShow) != 0) {
    ?>





<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="5" WIDTH="100%"><TR><TD><NOBR><FONT SIZE="-1"><B>SHOW DATE</B></FONT></NOBR></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>LISTING</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>OWNER</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>CLIENT</B></FONT></TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>RATING</TD><TD>&nbsp;</TD><TD><FONT SIZE="-1"><B>COMMENTS</B></FONT></TD></TR>

<?php
if ($_SESSION["pref_row_color"]) {
        $rowColor = $_SESSION["pref_row_color"];
    } else {
        $rowColor = "#F5F5DC";
    }?>

<?php
while ($rowshow = mysqli_fetch_object($StrGetShow)) {
        ?>

<TR bgcolor="<?php echo $rowColor; ?>"><TD><NOBR>
<FONT SIZE="3">
<a href="<?php echo "$PHP_SELF?op=editshowing&showid=$rowshow->SHOWID"; ?>" TITLE="Edit Showing Info"><img class="p-2" border=0 src="../images/icons/edit.gif" alt="edit" vspace="0" hspace="0" TITLE="Edit Showing"><?php echo $rowshow->SHOWING_DATE; ?>
</A>

</FONT>
</NOBR></TD>
<TD>&nbsp;</TD>
<TD>


<?php
$quStrclass = "SELECT STREET_NUM, STREET, APT FROM `CLASS` WHERE `CLI`=\"$grid\" AND `CID`=\"$rowshow->CID\"";
        $StrGetclass = mysqli_query($GLOBALS['dbh'], $quStrclass) or die(mysqli_error());

        while ($rowclass = mysqli_fetch_object($StrGetclass)) {
            ?>
<NOBR><FONT SIZE="3">
<a href="<?php echo "$PHP_SELF?op=adlEdit&cid=" . ($rowshow->CID) . "&return_page=sel&return_page_rid=$rowshow->CID&return_page_div=" . ($k ?? "") . ""; ?>" target="_show<?php echo $rowclass->CID; ?>" TITLE="Edit/View Listing"><?php echo $rowclass->STREET_NUM; ?> <?php echo $rowclass->STREET; ?> #<?php echo $rowclass->APT; ?></a>
</FONT></NOBR>
<?php }?>


</TD><TD>&nbsp;</TD>
<TD>
<?php
$quStrll = "SELECT SHORT_NAME FROM `LANDLORD` WHERE `GRID`=\"$grid\" AND `LID`=\"$rowshow->LID\"";
        $StrGetll = mysqli_query($GLOBALS['dbh'], $quStrll) or die(mysqli_error());

        while ($rowll = mysqli_fetch_object($StrGetll)) {

            if (mysqli_num_rows($StrGetll) != 0) {
                ?>
<NOBR><FONT SIZE="3"><a href="<?php echo "$PHP_SELF?op=editLandlord&lid=" . ($rowll->LID) . ""; ?>" TITLE="Edit/View <?php echo "$rowll->SHORT_NAME"; ?>'s Info" target="_sll<?php echo $rowll->LID; ?>"><?php echo $rowll->SHORT_NAME; ?></A></FONT></NOBR>
<?php

            } else {
                echo "<CENTER><FONT COLOR=\"#FF0000\">No Landlord</FONT></CENTER><BR>";
            }
        }?>



</TD><TD>&nbsp;</TD><TD>
<?php
$quStrcl = "SELECT NAME_FIRST, NAME_LAST FROM `CLIENTS` WHERE `GRID`=\"$grid\" AND `CLID`=\"$rowshow->CLID\"";
        $StrGetcl = mysqli_query($GLOBALS['dbh'], $quStrcl) or die(mysqli_error());

        while ($rowcl = mysqli_fetch_object($StrGetcl)) {

            if (mysqli_num_rows($StrGetcl) != 0) {
                ?>
<NOBR>
<FONT SIZE="3">
<a href="<?php echo "$PHP_SELF?op=editClient&clid=" . $rowshow->CLID . "\" TITLE=\"Edit/View " . $rowcl->NAME_FIRST . " " . $rowcl->NAME_LAST; ?>" TARGET="_Client<?php echo $rowcl->CLID; ?>"><?php echo $rowcl->NAME_FIRST . " " . $rowcl->NAME_LAST; ?></A>
</FONT>
</NOBR>

<?php
} else {
                echo "<CENTER><FONT COLOR=\"#FF0000\">No Client</FONT></CENTER><BR>";
            }
        }?>


</TD><TD>&nbsp;</TD><TD><CENTER>
<FONT SIZE="3"><a href="<?php echo "$PHP_SELF?op=editshowing&showid=$rowshow->SHOWID"; ?>" TITLE="Edit Showing Info"><?php echo $rowshow->RATING; ?></A></FONT>
</CENTER></TD><TD>&nbsp;</TD><TD><FONT SIZE="2">
<a href="<?php echo "$PHP_SELF?op=editshowing&showid=$rowshow->SHOWID"; ?>" TITLE="Edit Showing Info"><?php echo $rowshow->SHOWCOMMENT; ?></A></FONT>
</TD></TR>

    	<?php
if ($rowColor == "#F5F5DC" or $rowColor == $_SESSION["pref_row_color"]) {
            $rowColor = "#FFFFFF";
        } else {

            if ($_SESSION["pref_row_color"]) {
                $rowColor = $_SESSION["pref_row_color"];
            } else {
                $rowColor = "#F5F5DC";
            }
        }
    }?>
</TABLE>

<?php
} else {
    echo "<CENTER><FONT COLOR=\"#FF0000\">Sorry, there is no showing history for this agent</FONT></CENTER><BR>";
}?>


</TD></TR></TABLE>

<hr>
<a  class="p-2 d-block" href="<?php echo "$PHP_SELF?op=hotlist"; ?>" TITLE="Dashboard Stats & Shortcuts to Favorite Clients, Listings & more"><FONT SIZE="3">Go to the Hot List to see all your appointments, reminders, &amp; showing history.</FONT></A><BR>
</td></TR></TABLE>


</TD></TR></TABLE>

</font>
</center>
</TD></TR></TABLE>
<!--END editReminders -->