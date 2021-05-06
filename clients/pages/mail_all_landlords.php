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

<h1>Email ALL Landlords</h1>
<form action="mailall.php" method="POST" enctype="multipart/form-data">


<br />
<TABLE WIDTH="540"><TR><TD>
<TABLE><TR><TD>
<TABLE><TR><TD>

To: 

</TD><TD>

<input type="text" name="to" value="Undisclosed-Recipients &lt;<?php if(isset($rowGetUser)) echo "$rowGetUser->EMAIL";?>&gt;" /><br />

</TD></TR><TR><TD>

Bcc: 

</TD><TD>

<input type="text" name="bcc" value="<?php while ($rowGetLandlord = mysqli_fetch_object($quGetLandlord)) {?>

<?php
if(isset($rowGetUser)){
if ($rowGetUser->EMAILBCC !="n"){
	echo "$rowGetUser->EMAIL, ";
}
}

if(isset($rowGetLandlord))
if ( $rowGetLandlord->LL_EMAIL != ""  && $e == "1" && $e == "3" ) {
	echo "$rowGetLandlord->LL_EMAIL, ";

} else {
	echo "";
}

if ( $rowGetLandlord->OFF_EMAIL != "" && $e == "2" or $rowGetLandlord->OFF_EMAIL != "" && $e == "3" ) {
	echo "$rowGetLandlord->OFF_EMAIL, ";

} else {
	echo "";
}
; ?>
<?php } ?>" /><BR />

</TD></TR><TR><TD>



From: 
</TD><TD>


<input type="text" name="from" value="<?php if(isset($rowGetUser)) echo " $rowGetUser->EMAIL ";?>" /><br />
</TD></TR><TR><TD>

Subject: </TD><TD>

<input type="text" name="subject" value="Message from <?php if(isset($rowGetUser)) echo "$rowGetUser->FNAME";?> <?php if(isset($rowGetUser)) echo "$rowGetUser->LNAME";?>" />

</TD></TR></TABLE>


</TD><TD>

&nbsp;

</TD></TR></TABLE>

</TD><TD>

<FONT SIZE=-1>
This email will be sent to ALL LANDLORDS
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

Dear Landlord,<BR />


<BR />
<?php if(isset($rowGetUser)) echo "$rowGetUser->FNAME";?> <?php if(isset($rowGetUser)) echo "$rowGetUser->LNAME";?><BR />
<?php if(isset($rowGetUser)){ if ($rowGetUser->POSITION) {?>
<?php echo "$rowGetUser->POSITION";?><BR>
<?php } }?>

<?php if(isset($rowGetUser)){if ($rowGetUser->PICEXT != "" and $rowGetUser->SHOWPIC_SIG=="1") {?>
<IMG SRC="https://www.BostonApartments.com/pics/<?php echo $rowGetUser->HANDLE;?>.<?php echo $rowGetUser->PICEXT;?>"><BR>
<?php }}?>

<?php if(isset($rowGetUser)) if ($rowGetUser->DIRECTLINE) {?>
Direct Line: <?php echo "$rowGetUser->DIRECTLINE";?><BR />
<?php }?>
<?php if(isset($rowGetUser)) if ($rowGetUser->CELLPHONE) {?>
Mobile: <?php echo "$rowGetUser->CELLPHONE";?><BR />
<?php }?>
<?php if(isset($rowGetUser)) if ($rowGetUser->EMAIL) {?>
Email: <?php echo "$rowGetUser->EMAIL";?><BR />
<?php }?>
<?php if(isset($rowGetUser)) if ($rowGetUser->PERSONAL_WEBSITE) {?><BR />
Website: <?php echo "$rowGetUser->PERSONAL_WEBSITE";?>
<?php }?>
<?php  if(isset($rowGetUser)) if ($rowGetUser->FACEBOOK) {?>
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
  <input TYPE="button" VALUE="STOP GO BACK"
  onClick="history.go(-1)" STYLE="Background-Color : #F5A9A9">
</form>
</TD></TR></TABLE>

</form>

</CENTER></TD></TR></TABLE></CENTER>

</body>
</html>
