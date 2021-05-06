<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')

{
		$nl_name = $_POST['nl_name'];
	$nl_content = $_POST['nl_content'];
	$nl_id = $_POST['nl_id'];
	$nl_type = $_POST['nl_type'];


		$nowMon = date ('m');
		$nowDay = date ('d');
		$nowYear = date ('Y');

$date_modified = "$nowYear-$nowMon-$nowDay";



	$query = "UPDATE NEWSLETTERS SET `NL_NAME`='$nl_name',`NL_CONTENT`='$nl_content',`NL_TYPE`='$nl_type',`DATE_MODIFIED`='$date_modified' WHERE NL_ID='$nl_id' AND GRID='$grid'";
	$res = mysqli_query($dbh, $query) or die(mysqli_error($dbh));
	if ($res)
	die("Newsletter has been updated.<BR><BR><a href='?op=newsletters'>Newsletters Main Menu</a><BR><P><BR>");



}
else
{
	$nl_id = preg_replace("/'\/<>\"/","",$_GET['NL_ID']);
	if (empty($nl_id))
	die("Invalid ID");
	$query = "SELECT * FROM NEWSLETTERS WHERE NL_ID='$nl_id'";
	$res = mysqli_query($dbh, $query) or die(mysqli_error($dbh));
	$r = mysqli_fetch_assoc($res);

?>
	<form action="#" method="POST">


<table height="70" class="table table-info">

        <tr>
            <td align="CENTER">
                <font size="5">  <B>EDIT A NEWSLETTER</B></font><br>
            </td>
        </tr>
    </table>
        <CENTER>
<TABLE class="container bg-light text-dark"><TR><TD>Newsletter Name:</TD><TD><input type="text" name="nl_name" size="45" value=" <?php echo $r['NL_NAME'] ?>"> </TD></TR>
<TR><td>
                        <br>
                    </td></tr>
    <TR><TD>Date Created:</TD><TD><?php echo $r['DATE_CREATED']; ?></TD></TR>
    <TR><td>
                        <br>
                    </td></tr>
<TR><TD>Recipient Type:</TD><TD>
<select size="1" name="nl_type">
			<option value="Clients" <?php if ($r['NL_TYPE']=='Clients') { echo "selected"; } ?> >Clients</option>
			<option value="Landlords" <?php if ($r['NL_TYPE']=='Landlords') { echo "selected"; } ?> >Landlords</option>
			<option value="Everyone" <?php if ($r['NL_TYPE']=='Everyone') { echo "selected"; } ?> >Everyone</option>

<!-- 			<option value="Contacts" <?php if ($r['NL_TYPE']=='Contacts') { echo "selected"; } ?> >Contacts</option> -->
        	</select>
</TD></TR></TABLE>
            
            
       
<P>
	<textarea name="nl_content" cols="100" rows="10"><?php echo $r['NL_CONTENT'] ;?></textarea><br /><br />
	<input type="hidden" name="nl_id" value="<?php echo $r['NL_ID'] ;?>">
	
        
	</form>
 </center>
<BR>
          
         <CENTER>
                <TABLE class="container bg-light text-lg-left"><TR><TD VALIGN="MIDDLE" ALIGN="CENTER">    
                            <input type="submit" value="Update Newsletter" class="btn btn-primary" >



                        <a class="btn btn-dark text-white" href="?op=newsletters">Back to the Newsletters Main Menu</A><BR><BR>
       

                        </td></tr>
                    </TD></TR>
                </TABLE>     

                <br>

                </form>

            </CENTER>
<?php } ?>
