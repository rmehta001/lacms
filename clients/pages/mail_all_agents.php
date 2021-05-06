<TABLE class="table table-info "WIDTH="50%" CELLPADDING="0" BORDER="0">
    <TR>
        <TD ALIGN="CENTER">
            <TABLE WIDTH="300" CELLPADDING="0" CELLPADDING="0" BORDER="0">
                <TR>
                    <TD ALIGN="CENTER">
                      <span style="font-size: 40px; color: black;">
                        <i class="fa fa-mail-bulk"></i>
                      </span>
                    </TD>
                    <TD>
                        <FONT SIZE="+2"><B>Email All Agents</B></FONT>
                    </TD>
                </TR>
            </TABLE>
        </TD>
        <TD WIDTH="80"&nbsp;>
        </TD>
    </TR>
</TABLE>


<CENTER>

<TABLE class="table-active" border="2" cellspacing="0" cellpadding="5" WIDTH="50%"><TR><TD><CENTER>

<form action="mailall.php" method="POST" enctype="multipart/form-data" name="mail_listing">
<TABLE WIDTH="500"><TR><TD>
<TABLE><TR><TD>

To: 

</TD><TD>

<input type="text" name="to" value="Undisclosed-Recipients &lt;<?php if(isset($rowGetUser)) echo $rowGetUser->EMAIL;?>&gt;, " /><br />

</TD></TR><TR><TD>

<TR><TD>

Bcc: 

</TD><TD>

<?php		$quStrGetUsers = "SELECT * FROM USERS WHERE `GROUP`=$grid AND `UID`!=$uid";
		$quGetUsers = mysqli_query($dbh, $quStrGetUsers); 
?>

<input type="text" name="bcc" value="
<?php
 while ($rowGetUsers = mysqli_fetch_object($quGetUsers)) {?>
<?php if ($rowGetUsers->EMAIL) {?>
<?php echo $rowGetUsers->EMAIL;?>, <?php } ?>
<?php } ?>
" /><br />

</TD></TR><TR><TD>

From: 
</TD><TD>

<input type="text" name="from" value="<?php if(isset($rowGetUser)) echo "$rowGetUser->EMAIL";?>" /><br />
</TD></TR><TR><TD>

Subject: </TD><TD>

<input type="text" name="subject" value="Subject <?php if(isset($rowGetUser)) echo "$rowGetUser->FNAME";?> <?php if(isset($rowGetUser)) echo "$rowGetUser->LNAME";?>" />

</TD></TR></TABLE>


    </TD></TR>
    
    <TD>
        <BR><BR>


<FONT SIZE=-1>
This email will be sent to ALL AGENTS in the office who have email adresses set up in their preferences or if the admin set an email address for the user when the agent account was set up.
You may remove any addresses from the Bcc field. Be sure to remove the "comma and space" separator
for any email address you remove. You will get an email copy.

</FONT>
</TD></TABLE>


<p>



<p>Message:<br />

<textarea cols="70" rows="20" name="message" id="message" value="">

<BR><BR>
<?php if(isset($rowGetUser)) echo  "$rowGetUser->FNAME";?> <?php if(isset($rowGetUser)) echo "$rowGetUser->LNAME";?><BR>
<?php if(isset($rowGetUser)) if ($rowGetUser->POSITION) {?>
<?php echo "$rowGetUser->POSITION";?><BR>
<?php }?>

<?php if(isset($rowGetUser)) if ($rowGetUser->PICEXT != "" and $rowGetUser->SHOWPIC_SIG=="1") {?>
<IMG SRC="https://www.BostonApartments.com/pics/<?php if(isset($rowGetUser)) echo $rowGetUser->HANDLE;?>.<?php if(isset($rowGetUser)) echo $rowGetUser->PICEXT;?>"><BR>
<?php }?>

<?php if(isset($rowGetUser)) if ($rowGetUser->DIRECTLINE) {?>
Direct Line: <?php echo "$rowGetUser->DIRECTLINE";?><BR>
<?php }?>
<?php if(isset($rowGetUser)) if ($rowGetUser->CELLPHONE) {?>
Mobile: <?php echo "$rowGetUser->CELLPHONE";?><BR>
<?php }?>
<?php if(isset($rowGetUser)) if ($rowGetUser->EMAIL) {?><BR>
Email: <A HREF="mailto:<?php echo "$rowGetUser->EMAIL";?>"><?php echo "$rowGetUser->EMAIL";?></A><BR>
<?php }?>
<?php if(isset($rowGetUser)) if ($rowGetUser->PERSONAL_WEBSITE) {?>
Website: <A HREF="<?php echo "$rowGetUser->PERSONAL_WEBSITE";?>"><?php echo "$rowGetUser->PERSONAL_WEBSITE";?></A><BR>
<?php }?>


<?php if(isset($rowGetUser)) if ($rowGetUser->FACEBOOK) {?>
Facebook: <A HREF="<?php echo "$rowGetUser->FACEBOOK";?>"><?php echo "$rowGetUser->FACEBOOK";?></A><BR>
<?php }?>
<?php if(isset($rowGetUser)) if ($rowGetUser->TWITTER) {?>
Twitter: <A HREF="<?php echo "$rowGetUser->TWITTER";?>"><?php echo "$rowGetUser->TWITTER";?></A><BR>
<?php }?>
<?php if(isset($rowGetUser)) if ($rowGetUser->MYSPACE) {?>
MySpace: <A HREF="<?php echo "$rowGetUser->MYSPACE";?>"><?php echo "$rowGetUser->MYSPACE";?></A><BR>
<?php }?>
<?php if(isset($rowGetUser)) if ($rowGetUser->LINKEDIN) {?>
LinkedIn: <A HREF="<?php echo "$rowGetUser->LINKEDIN";?>"><?php echo "$rowGetUser->LINKEDIN";?></A><BR>
<?php }?>







</textarea>
<script language="JavaScript">
   generate_wysiwyg('message');
 </script>
 </p>


<p>File Attachment: <input type="file" name="fileatt" /></p>


<TABLE><TR><TD VALIGN="MIDDLE" ALIGN="CENTER">

<input type="submit" value=" SUBMIT " STYLE="Background-Color : #A9F5A9" />

  <input TYPE="button" VALUE="CANCEL"
  onClick="history.go(-1)" STYLE="Background-Color : #F5A9A9">

  </form>
        </TD></TR></TABLE>

</form>

<BR><BR>
</CENTER></TD></TR></TABLE></CENTER>

</body>
</html>
