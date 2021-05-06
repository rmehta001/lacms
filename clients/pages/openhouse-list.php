<?php

echo '<table style="text-align:center" height="70"class="table table-info">

        <tr>
            <td align="CENTER">
                <font size="5">  <B>OPEN HOUSE LISTINGS</B></font><br>
            </td>
        </tr>
    </table>

<TABLE class="container bg-light text-lg-left" BGCOLOR="#FFFFFF" WIDTH=650><TR><TD align=left>
<br>
<table class="container bg-light text-lg-left" cellpadding="2">
<tr>
<td width="65"><b>Date</b></td>
<td width="65"><b>Start Time</b></td>
<td width="65"><b>End Time</b></td>
<td width="65"><b>Listing ID #</b></td>
<td width="65"><b>Comments</b></td>
<td width="65"><b>View | Edit Listing</b></td>
<td width="65"><b>Edit Open House</b></td>
<td width="65"><b>Delete Open House</b></td>
</tr>
<tr><td><BR></td></tr>';
$query = "SELECT * FROM OPENHOUSE WHERE CLI=$grid ORDER BY DATE";

$res = mysqli_query($dbh, $query) or die(mysqli_error($dbh));
if ($res) {
    while ($r = mysqli_fetch_assoc($res)) {
        echo '<tr>
            <td nowrap>' . $r['DATE'] . '</td>
            <td nowrap>' . $r['START_HOUR'] . ':' . $r['START_MINS'] . ' ' . $r['START_MER'] . '</td>
            <td nowrap>' . $r['END_HOUR'] . ':' . $r['END_MINS'] . ' ' . $r['END_MER'] . '</td>
            <td nowrap><a href="' . $PHP_SELF . '?op=adlEdit&cid=' . $r['CID'] . '">' . $r['CID'] . '</A></td>
            <td nowrap>' . $r['COMMENTS'] . '</td>

            <td><a href="' . $PHP_SELF . '?op=adlEdit&cid=' . $r['CID'] . '"><NOBR><img src="../assets/images/full.gif" width="15" height="20" Border=0 align=left>View</NOBR><BR>Listing</a></td>




            <td><a href="' . $PHP_SELF . '?op=openhouse-edit&ID=' . $r['ID'] . '&CID=' . $r['CID'] . '"><img border=0 src="../images/icons/edit.gif" alt="edit">Edit</a></td>
            <td><a href="' . $PHP_SELF . '?op=openhouse-delete&ID=' . $r['ID'] . '"><img border=0 src="../images/icons/delete.gif" alt="delete">Delete</a></td>
            </tr>';
    }
}

echo '</table></TD></TR></TABLE><BR>

<CENTER>
            <TABLE><TR><TD VALIGN="MIDDLE" ALIGN="CENTER">    
<a class="btn btn-primary" href="?op=openhouse-add">Add An Open House</a><BR></td>
<TD VALIGN="MIDDLE" ALIGN="CENTER"><a class="btn btn-dark text-white" href="' . $PHP_SELF . '?op=openhouse">Back to the Open House Main Menu</a>
</td></tr></TABLE>
</center>
';
?>
