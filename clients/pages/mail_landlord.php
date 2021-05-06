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

<h1>Email A Landlord</h1>
<form action="mail.php" method="POST" enctype="multipart/form-data">
<TABLE><TR><TD>
<TABLE><TR><TD>

To: 

</TD><TD>

<input type="text" name="to" value="





<?php
if ( $rowGetLandlord->LL_EMAIL != ""  && $e == "1" or $e == "3" ) {
	echo "$rowGetLandlord->LL_EMAIL";
} else {
	echo "";
}


if ( $rowGetLandlord->LL_EMAIL != "" && $e == "3" && $rowGetLandlord->LL_EMAIL != "" ) {
	echo ", ";
} else {
	echo "";
}


if ( $rowGetLandlord->OFF_EMAIL != "" && $e == "2" or $e == "3" && $rowGetLandlord->OFF_EMAIL != "" ) {
	echo "$rowGetLandlord->OFF_EMAIL";
} else {
	echo "";
}


if ( $rowGetLandlord->OFFICE_EMAIL != "" && $e == "3" && $rowGetLandlord->OFFICE_EMAIL != "" ) {
	echo ", ";
} else {
	echo "";
}


if ( $rowGetLandlord->OFF_EMAIL != "" && $e == "4") {
	echo "$rowGetLandlord->SPOUSE_EMAIL";
} else {
	echo "";
}






if ($rowGetUser->EMAILBCC !="n"){
$bcc = $rowGetUser->EMAIL;
}else{
$bcc = "";
}


; ?>





" /><br />

</TD></TR><TR><TD>

From: 
</TD><TD>


<input type="text" name="from" value="<?php echo "$rowGetUser->EMAIL";?>" /><br />
</TD></TR><TR><TD>

Subject: </TD><TD>

<input type="text" name="subject" value="Message from <?php echo "$rowGetUser->FNAME";?> <?php echo "$rowGetUser->LNAME";?>" />

</TD></TR></TABLE>


</TD><TD>

&nbsp;

</TD></TR></TABLE>


<p>



<p>Message:<br />




<textarea cols="70" rows="20" name="message" id="message" value="">

<?php echo $email_head; ?>
<BR><BR>

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
Email: <A HREF="mailto:<?php echo "$rowGetUser->EMAIL";?>"><?php echo "$rowGetUser->EMAIL";?></A><BR>
<?php }?>
<?php if ($rowGetUser->PERSONAL_WEBSITE) {?>
Website: <A HREF="<?php echo "$rowGetUser->PERSONAL_WEBSITE";?>"><?php echo "$rowGetUser->PERSONAL_WEBSITE";?></A><BR>
<?php }?>
<?php if ($rowGetUser->FACEBOOK) {?>
Facebook: <A HREF="<?php echo "$rowGetUser->FACEBOOK";?>"><?php echo "$rowGetUser->FACEBOOK";?></A><BR>
<?php }?>
<?php if ($rowGetUser->TWITTER) {?>
Twitter: <A HREF="<?php echo "$rowGetUser->TWITTER";?>"><?php echo "$rowGetUser->TWITTER";?></A><BR>
<?php }?>
<?php if ($rowGetUser->MYSPACE) {?>
MySpace: <A HREF="<?php echo "$rowGetUser->MYSPACE";?>"><?php echo "$rowGetUser->MYSPACE";?></A><BR>
<?php }?>
<?php if ($rowGetUser->LINKEDIN) {?>
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

<!--

<BR><BR>



				<table align="center">
				<tr>
				<td height="30" width="160" bgcolor="#FFFF99"><div class="controltext">Client List</div></td>
				<td align="center" height="30" width="90" bgcolor="#FFFF99">&nbsp;</td>
				<td align="center" height="30" width="160" bgcolor="#FFFF99"><div class="controltext">Clients to add to deal</div></td></tr>
				<tr>
				<td align="center" height="30" bgcolor="#FFFF99"><select name="client_list" multiple="multiple" size="10" style="width:200px">
					<option value="">* Please select client(s) *</option>
					<?php while ($rowGetClients = mysqli_fetch_object($quGetClients)) {?>
						<option value="<?php echo $rowGetClients->CLID;?>"><?php echo $rowGetClients->NAME_LAST;?>, <?php echo $rowGetClients->NAME_FIRST;?> - <?php echo $rowGetClients->CLIENT_EMAIL;?></option>
					<?php } ?>
					</select>
				</td>
				<td align="center" height="30" bgcolor="#FFFF99"><input type="button" class="button" style="width:90px" onclick="addClient();" value="Add &gt;&gt;" /><br><br><input type="button" class="button" style="width:90px" onclick="removeClient();" value="&lt;&lt; Remove" /></td>
				<td align="center" height="30" bgcolor="#FFFF99"> <select id="5" name="selected_clients[]" multiple="multiple" size="10" style="width:200px">
                      		</select></td>
                		</tr>
                		</table>

-->
</CENTER></TD></TR></TABLE></CENTER>

</body>
</html>
