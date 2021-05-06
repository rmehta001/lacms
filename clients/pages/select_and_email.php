<!--BEGIN select_and_email-->

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


if ($rowGetUser->EMAILBCC != "n") {
$bcc = $rowGetUser->EMAIL;
} else {
$bcc = "";
}
?>


<center>
<TABLE BGCOLOR="#FFFFFF"><TR><TD><CENTER>

<?php if ($numIDs >"0") { ;?>



	<font color="#000000" face="Verdana">


<?php if ($numIDs=="1") { echo "<B><FONT SIZE=+2>Email 1 Listing</B></FONT><BR>"; } else { echo "<B><FONT SIZE=+2>Email $numIDs Listings</B></FONT><BR>";  }?>
<form action="mail-multilistings.php" method="POST" enctype="multipart/form-data">

<CENTER>
<TABLE><TR><TD VALIGN="MIDDLE" ALIGN="CENTER">
<input type="submit" value=" SEND EMAIL " STYLE="Background-Color : #A9F5A9" /></TD><TD> &nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><button onClick="window.close()" STYLE="Background-Color : #F5A9A9">CANCEL</button></TD></TR></TABLE>
</CENTER>

<TABLE BORDER=0 WIDTH="400"><TR><TD>
<div class="controltext"><FONT SIZE="-1" COLOR="#FF0000"><B>You may pick multiple clients from the Client List as well as add additional email addresses in the TO: field separated by commas.</B></FONT></div>
</TD></TR><TR><TD>
<CENTER>
<TABLE BORDER=1><TR><TD ROWSPAN="4">

				<table align="center">
				<tr>
				
				<td height="30" width="250" bgcolor="#FFFF99"><div class="controltext">Client List <FONT SIZE="-1"<I>(Active Only)</I></FONT></div></td>
</tr>
				<tr>
				<td align="center" height="30" bgcolor="#FFFF99"><select name="client_list" multiple="multiple" size="10" style="width:250px">

<?php
					while ($rowGetClients = mysqli_fetch_object($quGetClients)) {
if (($rowGetClients->CLIENT_EMAIL) AND ($rowGetClients->STATUS_CLIENT !="2")) { ?>
<option value="<?php echo $rowGetClients->CLIENT_EMAIL;?>"><?php echo $rowGetClients->NAME_LAST;?>, <?php echo $rowGetClients->NAME_FIRST;?> - <?php echo $rowGetClients->CLIENT_EMAIL;?></option>

<?php } } ?>
					</select>
				</td>
				</tr>
                </table>
</TD><TD>

To: 

</TD><TD>

<input type="text" name="to" value="" /><br />

</TD></TR><TR><TD>

From: 
</TD><TD>


<input type="text" name="from" value="<?php echo "$rowGetUser->EMAIL";?>" /><br />

</TD></TR><TR><TD>

Subject: 

</TD><TD>

<?php if ($numIDs=="1") { ?>
<input type="text" name="subject" value="Listing from <?php echo "$rowGetUser->FNAME";?> <?php echo "$rowGetUser->LNAME";?>" />
<?php } else { ?>
<input type="text" name="subject" value="<?php echo "$numIDs";?> Listings from <?php echo "$rowGetUser->FNAME";?> <?php echo "$rowGetUser->LNAME";?>" />
<?php }?>

</TD></TR></TABLE>

</TD></TR></TABLE>


<p>

<p>Message:<br />


<textarea cols="70" rows="20" name="message" id="message" value="">

<?php echo $email_head;?>
<BR><BR>

	<?php 
	
	$selWHERE = "INNER JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE (CID=$sel_ids[0]";
	
	foreach ($sel_ids as $sel_id) {

for ($i=1;$i<$numIDs;$i++){
				$selWHERE.= " OR CID=$sel_ids[$i] ";
			}
			$selWHERE.=" ) AND (CLI=$grid OR CLI=1075) ";



$qustrads = "select * from `CLASS` $selWHERE";
$quGetAds = mysqli_query($dbh, $qustrads);



while (@ $rowGetAds = mysqli_fetch_object($quGetAds)){

if ($rowGetAds->EXTERNALPIC) {
echo "<IMG SRC=$rowGetAds->EXTERNALPIC width='100' HEIGHT='100' BORDER='0'>";
} elseif ($rowGetAds->PIC>0) {


	$quStrGetPics = "SELECT * FROM PICTURE WHERE PICTURE.CID=$rowGetAds->CID ORDER BY PID LIMIT 1";
	$quGetPics = mysqli_query($dbh, $quStrGetPics);
while ($rowGetPics = mysqli_fetch_object($quGetPics)){
	$thumb="<img border=0 src='https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT' width='125' alt='$rowGetPics->DESCRIPT'><br>"; 
	echo $thumb;
	}






	}

$adstring= format_ad_email ($rowGetAds, $DEFINED_VALUE_SETS);
echo $adstring;
echo "-----------------------------------------------------------<BR>"; }

} ?>


<?php echo "$rowGetUser->FNAME";?> <?php echo "$rowGetUser->LNAME";?><BR>
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

<BR><BR>
<?php echo $email_foot;?>

</TEXTAREA>
<script language="JavaScript">
   generate_wysiwyg('message');
 </script>

</p>
<p>File Attachment: <input type="file" name="fileatt" /></p>
<p>

<TABLE><TR><TD VALIGN="TOP" ALIGN="CENTER">
<input type="submit" value=" SEND EMAIL " STYLE="Background-Color : #A9F5A9" /></p>
</TD><TD><NOBR>&nbsp;&nbsp;&nbsp;&nbsp;</NOBR>
</TD><TD VALIGN="TOP" ALIGN="CENTER">
<form>
  <input TYPE="button" VALUE="STOP GO BACK"
  onClick="history.go(-1)" STYLE="Background-Color : #F5A9A9">
</TD></TR></TABLE>
</form>
</form>

<?php } else { ;?>
	<font color="#000000" face="Verdana">
	You can't email <?php echo $numIDs;?> listings. You need to select at least one to email.<BR>
<P>
<a href="<?php echo "$PHP_SELF?op=$return_page";?>"><B><FONT COLOR="RED">Back to the Previous Page</FONT></B></A><BR>
<P>&nbsp;<BR>

<?php  } ;?>

</TD></TR></TABLE>

<!--END select_and_email -->