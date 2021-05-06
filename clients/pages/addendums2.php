<!--BEGIN Addendums -->

<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 

if ($pref_coltit=="") {
$coltitcolor="#3DB1FF";
} else {
$coltitcolor="$pref_coltit";
}

if ($pref_row_color){
$rowColor = "$pref_row_color";
} else {
$rowColor = "#F5F5DC";
}
?>

	<TABLE BORDER=0 WIDTH=450><TR><TD VALIGN=TOP ALIGN="CENTER"><B>ADDITIONAL ADDENDA &amp; DOCUMENTS</B></TD>
</TR></TABLE>



	<table border="1" cellspacing="0" cellpadding="5" BGCOLOR="<?php echo $pagebgcolor;?>" BORDERCOLOR="#00000" WIDTH="450">
	<tr>
	<td>


<?php

	$quStrGetLandLordA = "SELECT * FROM `LANDLORD_ADDENDUM_FILE` WHERE `LID`=$lid AND `GID`=$grid";
	$quGetLandlordA = mysqli_query($dbh, $quStrGetLandLordA) or die(dieNice("Sorry,  couldn't find that landord's additional addenda", "E-Addendum"));



echo "<TABLE CELLPADDING=0 CELLSPACING=0 BGCOLOR=#FFFFFF><TR><TD><FONT SIZE=\"-1\"><A HREF=\"$PHP_SELF?op=createAddendum&lid=$lid\">Add New Addendum/Document as TEXT</A><BR>
<A HREF=\"$PHP_SELF?op=upload_addendum&lid=$lid\">Add New Addendum/Document as a FILE</A> <FONT SIZE=-1>(.doc .pdf .gif .jpg, etc.)</FONT><BR>

<BR></FONT></TD</TR><TR><TD>";


echo "<TABLE WIDTH=\"450\" BORDER=\"0\" CELLSPACING=\"0\" ><TR BGCOLOR=\"$coltitcolor\"><td align=\"left\" WIDTH=\"80%\">Uploaded Document Name - (file)</TD><td align=\"left\">Edit</TD><td align=\"left\">Delete</TD></TR>";

while ($rowGetLandlordA = mysqli_fetch_object($quGetLandlordA)) {

echo "<TR BGCOLOR=\"$rowColor\"><TD>";

if ($rowGetLandlordA->DESCRIPT) {

echo $rowGetLandlordA->DESCRIPT;
} else {

echo "No name - Doc # $rowGetLandlordA->PID";

}

echo "</TD><TD> 

<A HREF=\"../clients/documents/$rowGetLandlordA->PID.$rowGetLandlordA->EXT\" target=\"_new\">View/Print</a></TD><TD>
<A HREF=\"$PHP_SELF?op=deleteAddendumFile&lid=$lid&lid=$rowGetLandlordA->LID&ext=$rowGetLandlordA->EXT&pid=$rowGetLandlordA->PID&desc=$rowGetLandlordA->DESCRIPT\"><img border=0 src=\"../images/icons/delete.gif\" alt=\"delete\"></a></TD></TR>";


if ($rowColor=="#F5F5DC" OR $rowColor=="$pref_row_color") {
    		$rowColor="#FFFFFF";
    }else {

 		if ($pref_row_color=="") {
    		$rowColor="#F5F5DC";
		}else {
    		$rowColor="$pref_row_color";
    		}
}


}
echo "</TABLE></TD></TR></TABLE>";
?>



</TD></TR><TR><TD>

<?php

	$quStrGetLandLordAs = "SELECT * FROM `LANDLORD_ADDENDUMS` WHERE `LID`=$lid AND `CLI`=$grid";
	$quGetLandlordAs = mysqli_query($dbh, $quStrGetLandLordAs) or die(dieNice("Sorry,  couldn't find that landord's additional addenda", "E-Addendum"));




echo "<TABLE CELLPADDING=0 CELLSPACING=0 BGCOLOR=#FFFFFF><TR><TD><TD>";



echo "<TABLE WIDTH=\"450\" BORDER=\"0\" CELLSPACING=\"0\" ><TR BGCOLOR=\"$coltitcolor\"><td align=\"left\" WIDTH=\"80%\">Document Name - (text)</TD><td align=\"left\">Edit</TD><td align=\"left\">Delete</TD></TR>";

while ($rowGetLandlordAs = mysqli_fetch_object($quGetLandlordAs)) {

echo "<TR BGCOLOR=\"$rowColor\"><TD>$rowGetLandlordAs->ADDENDUM_NAME</TD><TD>

<A HREF=\"$PHP_SELF?op=editAddendum&lid=$lid&ll_addendum_id=$rowGetLandlordAs->LL_ADDENDUM_ID\"><img border=0 src=\"../images/icons/edit.gif\" alt=\"edit\"></a></TD><TD>
<A HREF=\"$PHP_SELF?op=deleteAddendum&lid=$lid&ll_addendum_id=$rowGetLandlordAs->LL_ADDENDUM_ID\"><img border=0 src=\"../images/icons/delete.gif\" alt=\"delete\"></a></TD></TR>";


if ($rowColor=="#F5F5DC" OR $rowColor=="$pref_row_color") {
    		$rowColor="#FFFFFF";
    }else {

 		if ($pref_row_color=="") {
    		$rowColor="#F5F5DC";
		}else {
    		$rowColor="$pref_row_color";
    		}
}


}
echo "</TABLE></TD></TR></TABLE>";
?>

			</TD></tr>
		</table>
	<br>



<!--END editAddendums -->