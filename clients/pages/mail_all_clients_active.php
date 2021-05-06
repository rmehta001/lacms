<?php
	$quStrGetHead = "SELECT AGENT_EMAIL_HEADER, AGENT_EMAIL_FOOTER FROM USERS WHERE UID=$uid";
	$quGetHead = mysqli_query($dbh, $quStrGetHead);
	if($rowGetHead = mysqli_fetch_object($quGetHead)) {
	$email_head = "$rowGetHead->AGENT_EMAIL_HEADER";
	$email_foot = "$rowGetHead->AGENT_EMAIL_FOOTER";
	}
	
if (($email_head == "") and ($email_foot =="")) {

	$quStrGetHead2 = "SELECT `EMAIL_HEADER` , `EMAIL_FOOTER` FROM `GROUP` WHERE `GRID` = $grid";
	$quGetHead2 = mysqli_query($dbh, $quStrGetHead2);
	if($rowGetHead2 = mysqli_fetch_object($quGetHead2)) {
	$email_head = "$rowGetHead2->EMAIL_HEADER";
	$email_foot = "$rowGetHead2->EMAIL_FOOTER";
	}
}
?>
<CENTER>
<TABLE BGCOLOR="#FFFFFF"><TR><TD><CENTER>

<h1>Email All Clients</h1>


<form action="mailall.php" method="POST" enctype="multipart/form-data" name="mail_listing">
<TABLE WIDTH="500"><TR><TD>
<TABLE><TR><TD>

To: 

</TD><TD>

<input type="text" name="to" value="Undisclosed-Recipients &lt;<?php if(isset($rowGetUser)) echo "$rowGetUser->EMAIL";?>&gt;, " /><br />

</TD></TR><TR><TD>

<TR><TD>

Bcc: 

</TD><TD>

<input type="text" name="bcc" value="
<?php while ($rowGetClients = mysqli_fetch_object($quGetClients)) {?>
<?php if ($rowGetClients->CLIENT_EMAIL AND $rowGetClients->STATUS_CLIENT !=2) {?>
<?php echo $rowGetClients->CLIENT_EMAIL;?>, <?php } ?>
<?php } ?>
" /><br />

</TD></TR><TR><TD>



From: 
</TD><TD>


<input type="text" name="from" value="<?php if(isset($rowGetUser)) echo "$rowGetUser->EMAIL";?>" /><br />
</TD></TR><TR><TD>

Subject: </TD><TD>

<input type="text" name="subject" value="Listing from <?php if(isset($rowGetUser)) echo "$rowGetUser->FNAME";?> 
    <?php if(isset($rowGetUser)) echo "$rowGetUser->LNAME";?>" />

</TD></TR></TABLE>


</TD><TD>


<FONT SIZE=-1>
This email will be sent to ALL CLIENTS
who have email adresses.
You may remove any addresses from the Bcc field.
Be sure to remove the "comma and space" separator
for any email address you remove. You will get an email copy.

</FONT>
</TD></TR></TABLE>


<p>



<p>Message:<br />




<textarea cols="70" rows="20" name="message" id="message" value="">

<?php echo $email_head; ?>

<BR><BR>
<?php if(isset($rowGetUser)) echo "$rowGetUser->FNAME";?> 
<?php if(isset($rowGetUser)) echo "$rowGetUser->LNAME";?><BR />


<?php if(isset($rowGetUser)) if ($rowGetUser->POSITION) {?>
<?php echo "$rowGetUser->POSITION";?><BR>
<?php }?>

<?php if(isset($rowGetUser)){if ($rowGetUser->PICEXT != "" and $rowGetUser->SHOWPIC_SIG=="1") {?>
<IMG SRC="https://www.BostonApartments.com/pics/<?php echo $rowGetUser->HANDLE;?>.<?php echo $rowGetUser->PICEXT;?>"><BR>
<?php }}?>

<?php if(isset($rowGetUser)) if ($rowGetUser->DIRECTLINE) {?>
Direct Line: <?php echo "$rowGetUser->DIRECTLINE";?><BR>
<?php }?>
<?php if(isset($rowGetUser)) if ($rowGetUser->CELLPHONE) {?>
Mobile: <?php echo "$rowGetUser->CELLPHONE";?><BR>
<?php }?>
<?php if(isset($rowGetUser)) if ($rowGetUser->EMAIL) {?>
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

<BR><BR>
<?php echo $email_foot; ?>

</textarea>
<script language="JavaScript">
   generate_wysiwyg('message');
 </script>
 </p>


<p>File Attachment: <input type="file" name="fileatt" /></p>
<p>

<TABLE><TR><TD VALIGN="MIDDLE" ALIGN="CENTER">
<input type="submit" value=" SEND EMAIL " STYLE="Background-Color : #A9F5A9" /></p>
</TD><TD> &nbsp;&nbsp;&nbsp;&nbsp;
</TD><TD VALIGN="MIDDLE" ALIGN="CENTER">
<form>
<button onClick="window.close()" STYLE="Background-Color : #F5A9A9">CANCEL</button>
</form>
</TD></TR></TABLE>

</form>

<BR><BR>

</CENTER></TD></TR></TABLE></CENTER>

</body>
</html>
