<?php

echo '
    
<table height="70"class="table table-info">

<tr>
  <td align="CENTER">
  <font size="5">  <B>SHOW NEWSLETTERS</B></font><br>
  </td>
</tr>
</table>


<TABLE class="container bg-light text-dark" >
    
    <TR>
       <td width="65"><b>Name</b></td>
        <td width="65"><b>Type</b></td>
        <td width="65"><b>Date Created</b></td>
        <td width="65"><b>Date Modified</b></td>
        <td width="65"><b>Edit</b></td>
        <td width="65"><b>Send</b></td>
        <td width="65"><b>Delete</b></td>
        
    </TR>
    
</tr>';
if (isset($isAdmin)) {
    $query = "SELECT * FROM NEWSLETTERS WHERE GRID=$grid";
} else {
    $query = "SELECT * FROM NEWSLETTERS WHERE GRID=$grid AND UID=$uid";
}


$res = mysqli_query($dbh, $query) or die(mysqli_error($dbh));
while ($r = mysqli_fetch_assoc($res)) {
    echo '<tr BGCOLOR="#FFFFFF">
	<td nowrap>' . $r['NL_NAME'] . '</td>
	<td nowrap>' . $r['NL_TYPE'] . '</td>
	<td nowrap>' . $r['DATE_CREATED'] . '</td>
	<td nowrap>' . $r['DATE_MODIFIED'] . '</td>

	<td><a href="' . $PHP_SELF . '?op=newsletters-edit&NL_ID=' . $r['NL_ID'] . '"><img border=0 src="../images/icons/edit.gif" alt="edit">Edit</a></td>
	<td><a href="' . $PHP_SELF . '?op=newsletters-send&nl_id=' . $r['NL_ID'] . '&nl_type=' . $r['NL_TYPE'] . '"><img border=0 src="../images/icons/email.gif" alt="email">Send</a></td>
	<td><a href="' . $PHP_SELF . '?op=newsletters-delete&NL_ID=' . $r['NL_ID'] . '"><img border=0 src="../images/icons/delete.gif" alt="delete">Delete</a></td>
	</tr>';
}
echo '</table></TD></TR></TABLE><BR><BR>
    
    <CENTER>
                <TABLE class="container bg-light text-lg-left"><TR><TD VALIGN="MIDDLE" ALIGN="CENTER">    
                           
                          
                            <a href="?op=newsletters-addnews" class="btn btn-primary">Add A Newsletter</a>
    


                            
                                <a class="btn btn-dark text-white" href="?op=newsletters">Back to the Newsletters Main Menu</A><BR><BR>



                                
                        </td></tr>
                    </TD></TR>
                </TABLE>     

                <br>

                </form>

            </CENTER>

';
?>
