<?php

	$quStrGetCRemind = "SELECT * FROM CLIENTS WHERE CLID='$clid' AND GRID='$grid'";
	$quGetCRemind = mysqli_query($dbh, $quStrGetCRemind);
	if($rowGetCRemind = mysqli_fetch_object($quGetCRemind))


$action = "Appointment Reminder sent for $rowGetCRemind->SHOW_DATE at $rowGetCRemind->SHOW_TIME";
$quStrAddClientH = "INSERT INTO CLIENTS_HISTORY (UID, HANDLE, CLI, CLID, ACTION) VALUES ('$uid', '$handle', '$grid', '$clid', '$action')";
$quAddClientH = mysqli_query($dbh, $quStrAddClientH) or die ($quStrAddClientH);


if ($rowGetUser->EMAILBCC != "n") {
$bcc = $rowGetUser->EMAIL;
} else {
$bcc = "";
}

?>
<CENTER>
<TABLE BGCOLOR="#FFFFFF"><TR><TD><CENTER>

<h1>Email An Appointment Reminder</h1>
<form action="mail.php" method="POST" enctype="multipart/form-data">

<INPUT TYPE="HIDDEN" NAME="bcc" VALUE="<?php echo $bcc;?>">

<TABLE BORDER=0><TR><TD>

<TABLE BORDER=0><TR><TD>

To: 

</TD><TD>

<input type="text" name="to" value="<?php echo $rowGetCRemind->CLIENT_EMAIL;?>" /><br />

</TD></TR><TR><TD>

From: 
</TD><TD>


<input type="text" name="from" value="<?php echo "$rowGetUser->EMAIL";?>" /><br />

</TD></TR><TR><TD VALIGN="TOP">

Subject: 

</TD><TD>

<input type="text" name="subject" value="Appointment Reminder with <?php echo "$rowGetUser->FNAME";?> <?php echo "$rowGetUser->LNAME";?>" />

</TD></TR></TABLE>

</TD><TD>


<?php if ($clid) { echo "&nbsp;"; } else {?>
	
<FONT COLOR="#FF0000">Not a valid Client Appointment</FONT>.

<?php }?>

</TD></TR></TABLE>


<p>



<p>Message:<br />




<textarea cols="60" rows="60" name="message" id="message" value="" STYLE="Background-Color : #FFFFFF">
<?php echo $email_head;?>
Dear <?php echo $rowGetCRemind->NAME_FIRST;?>,<BR>
<BR>
This message is a reminder that we have an appointment scheduled on:<BR><BR>
<?php echo fuzDate($rowGetCRemind->SHOW_DATE);?> at <?php echo $rowGetCRemind->SHOW_TIME;?><BR><BR>
Please let me know if you can not attend.<BR><BR>


Sincerely,<BR>
</CENTER>
<BR>
<?php echo "$rowGetUser->FNAME";?> <?php echo "$rowGetUser->LNAME";?><BR>

<?php if ($rowGetUser->POSITION) {?>
<?php echo "$rowGetUser->POSITION";?><BR>
<?php }?>

<?php if ($rowGetUser->PICEXT != "" and $rowGetUser->SHOWPIC_SIG=="1") {?>
<IMG SRC="https://www.BostonApartments.com/pics/<?php echo $rowGetUser->HANDLE;?>.<?php echo $rowGetUser->PICEXT;?>"><BR>
<?php }?>

<?php if ($rowGetUser->DIRECTLINE) {?>
Direct Line: <?php echo "$rowGetUser->DIRECTLINE";?><BR>
<?php }?>
<?php if ($rowGetUser->CELLPHONE) {?>
Mobile: <?php echo "$rowGetUser->CELLPHONE";?><BR>
<?php }?>
<?php if ($rowGetUser->EMAIL) {?>
Email: <A HREF=mailto:<?php echo "$rowGetUser->EMAIL";?>><?php echo "$rowGetUser->EMAIL";?></A><BR>
<?php }?>
<?php if ($rowGetUser->PERSONAL_WEBSITE) {?>
Website: <A HREF=<?php echo "$rowGetUser->PERSONAL_WEBSITE";?>><?php echo "$rowGetUser->PERSONAL_WEBSITE";?></A><BR>
<?php }?>
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

</CENTER></TD></TR></TABLE></CENTER>

</body>
</html>
