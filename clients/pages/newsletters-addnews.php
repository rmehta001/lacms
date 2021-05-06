<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nl_name = htmlentities($_POST['nl_name']);
    $nl_content = htmlentities($_POST['nl_content']);
    $nl_type = htmlentities($_POST['nl_type']);



    $nowMon = date('m');
    $nowDay = date('d');
    $nowYear = date('Y');

    $date_created = "$nowYear-$nowMon-$nowDay";
    $date_modified = "$nowYear-$nowMon-$nowDay";




    if (empty($nl_name))
        die("<BR><P><BR><FONT COLOR=red>Please fill out the name section.</FONT><BR><P><a href=\"#\" onClick=\"history.go(-1)\">Back to Form</a><BR><P><BR>");


    if (empty($nl_type))
        die("<BR><P><BR><FONT COLOR=red>Please pick a recipient type.</FONT><BR><P><a href=\"#\" onClick=\"history.go(-1)\">Back to Form</a><BR><P><BR>");



    if (empty($nl_content))
        die("<BR><P><BR><FONT COLOR=red>Please fill out the content section.</FONT><BR><P><a href=\"#\" onClick=\"history.go(-1)\">Back to Form</a><BR><P><BR>");




    $query = "INSERT INTO NEWSLETTERS (NL_NAME, NL_CONTENT, NL_TYPE, GRID, UID, DATE_CREATED, DATE_MODIFIED) VALUES ('$nl_name','$nl_content','$nl_type','$grid','$uid','$date_created','$date_modified')";
    $res = mysqli_query($dbh, $query) or die(mysqli_error($dbh));
    if ($res)
        die("<BR><P>Newsletter Succesfully Saved.<br>
<P>
<a href='?op=newsletters'>Click for the Newletters Main Menu</a><BR><P><BR>");
} else {
    ?>
    <table height="70"class="table table-info">

        <tr>
            <td align="CENTER">
                <font size="5">  <B>ADD A NEWSLETTER</B></font><br>
            </td>
        </tr>
    </table>



    <CENTER>
        <form action="" method="POST">
            <TABLE class="container bg-light text-dark" >
                <TR>
                    <TD>Newsletter Name:</TD><TD><input type="text" name="nl_name" size="45">
                    </TD>
                </TR>
                <TR><td>
                        <br>
                    </td></tr>
                <TR>
                    <TD>Recipient Type:</TD>
                    <TD>
                        <select name="nl_type" STYLE="Background-Color : #FFFFFF">
                            <option value="Clients">Clients</option>
                            <option value="Landlords">Landlords</option>
                            <option value="Everyone">Everyone</option>
                            <!-- <option value="Contacts">Contacts</option> -->
                        </select>
                    </TD>
                </TR>
                <TR><td>
                        <br>
                    </td></tr>
                <TR>
                    <TD VALIGN=TOP>
                        Content:
                    </TD>
                    <TD VALIGN=TOP>
                        <textarea name="nl_content" cols="100" rows="10" onFocus=clear_textbox()
                                  value="Type or paste your newsletter here.">
                        </textarea>
                    </TD>
                </TR>

            </TABLE>
            <table class="container bg-light text-lg-left"><tr><td><BR></td></tr></table>
            <CENTER>
                <TABLE class="container bg-light text-lg-left"><TR><TD VALIGN="MIDDLE" ALIGN="CENTER">    
                            <input type="submit" value="Add Newsletter" class="btn btn-primary" >



                            <a class="btn btn-dark text-white" href="?op=newsletters">Back to the Newsletters Main Menu</A><BR><BR>


                        </td></tr>
                    </TD></TR>
                </TABLE>     

                <br>

                </form>

            </CENTER>
        <?php } ?>
        <BR>

