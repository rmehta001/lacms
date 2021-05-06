
<?php


$adstring= format_ad_email ($rowGetAd, $DEFINED_VALUE_SETS);

$co = $rowGetAd->CLI;

if ($co !="1075") {


	$quStrGetPics = "SELECT * FROM PICTURE WHERE CID=$cid ORDER BY PID LIMIT 1";
	$quGetPics = mysqli_query($dbh, $quStrGetPics);
	if($rowGetPics = mysqli_fetch_object($quGetPics))
	$thumb="<a href='https://www.BostonApartments.com/homepage.php?cli=$co&ad=$rowGetPics->CID'><img border=0 src=https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT width='125' alt='$rowGetPics->DESCRIPT'></a><br>";

	} else {
	$thumb="<a href='https://www.BostonApartments.com/homepage-MLS.php?cli=$co&ad=$rowGetAd->CID'><img border=0 src=https://www.BostonApartments.com/pics/$rowGetAd->EXTERNALPIC width='125'></a><br>";
	}
	
	
if ($rowGetAd->EXTERNALPIC) {
$thumb = "<img SRC=$rowGetAd->EXTERNALPIC WIDTH=125>";
}


if ($rowGetUser->EMAILBCC != "n") {
$bcc = $rowGetUser->EMAIL;
} else {
$bcc = "";
}

?>
<CENTER>
<TABLE BGCOLOR="#FFFFFF"><TR><TD><CENTER>


<B><FONT SIZE="+2">Email Listing</B></FONT><BR>
<form action="mail.php" method="POST" enctype="multipart/form-data">
<TABLE><TR><TD VALIGN="MIDDLE" ALIGN="CENTER">
<input type="submit" value=" SEND EMAIL " STYLE="Background-Color : #A9F5A9" /></TD><TD> &nbsp;&nbsp;&nbsp;&nbsp;</TD><TD><button onClick="window.close()" STYLE="Background-Color : #F5A9A9">CANCEL</button></TD></TR></TABLE>



<INPUT TYPE="HIDDEN" NAME="bcc" VALUE="<?php echo $bcc;?>">
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
if (($rowGetClients->CLIENT_EMAIL) AND ($rowGetClients->STATUS_CLIENT !="2")){ ?>
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

<input type="text" name="subject" value="Listing from <?php echo "$rowGetUser->FNAME";?> <?php echo "$rowGetUser->LNAME";?>" />

</TD></TR><TR><TD COLSPAN="2">
<TABLE><TR><TD><div class="controltext">
<?php if ($cid) {?>
<FONT SIZE=-1>
<NOBR>Ad ID#: <?php echo "$rowGetAd->ABV";?>-<?php echo "$rowGetAd->CID";?> <br></NOBR>
<NOBR>Created by: <?php echo "$rowGetAd->HANDLE";?> on <?php echo "$rowGetAd->DATEIN";?> <br></NOBR>
<NOBR>Last Modifed on: <?php echo "$rowGetAd->MOD";?> by <?php echo "$rowGetAd->MODBY";?><br></NOBR>
<NOBR>Status: <?php if ($rowGetAd->STATUS=="ACT") {
				echo "Active Ad";
			}else {
				echo "Inactive Ad";
			} ?>

 / Unit is <?php if ($rowGetAd->STATUS_ACTIVE=="1") {
				echo "Available";
			}else {
				echo "Unavailable</NOBR></FONT>";
			} ?>
<?php }else {?>
Not a valid listing number.
<?php }?>
</DIV></TD></TR></TABLE>


</TD></TR></TABLE>

</TD></TR></TABLE>






<p>



<p>Message:<br />




<textarea cols="60" rows="90" name="message" id="message" value="" STYLE="Background-Color : #FFFFFF">

<?php echo $email_head;?>

<?php echo $thumb;?>

<?php echo $adstring;?>

<?php
if ($rowGetAd->PIC != 0) {
echo "<CENTER><TABLE><TR><TD>";
$i = 0;

mysqli_data_seek ($quGetAd, 0);
$rowGetAd = "";
while ($rowGetAd = mysqli_fetch_object($quGetAd)) {
		if (isset($ad)) {
			$quStrGetPics = "SELECT * FROM PICTURE WHERE CID=$ad ORDER BY PICORDER, PID";
			$quGetPics = mysqli_query($dbh, $quStrGetPics);

$num_pics = mysqli_num_rows($quGetPics);

		while ($rowGetPics = mysqli_fetch_object ($quGetPics)) {

$i++;

if ($i%2){
echo "<tr><TD>";
}
if (!($i%2)) {
echo "</TD><TD>";
}

echo "<CENTER><img src='https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT' alt=\"$rowGetPics->DESCRIPT\"></CENTER>";
		}

	}
}
echo "</TD></TR></TABLE>";
}
?>

</CENTER>
<BR>
<?php echo "$rowGetUser->FNAME";?> <?php echo "$rowGetUser->LNAME";?><BR>

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

</textarea>
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
<button onClick="window.close()" STYLE="Background-Color : #F5A9A9">CANCEL</button>
</TD></TR></TABLE>

</form>
</form>

</CENTER></TD></TR></TABLE></CENTER>






</body>
</html>
