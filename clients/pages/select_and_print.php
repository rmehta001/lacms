<!--BEGIN select_and_email-->

<center>
<BR>
<?php if ($numIDs >"0") { ;?>


<?php function get_thumb2 ($sel_id)
{
	$quStrGetPics = "SELECT * FROM PICTURE $selWHERE ORDER BY PID LIMIT 1";
	$quGetPics = mysqli_query($dbh, $quStrGetPics);
	if($rowGetPics = mysqli_fetch_object($quGetPics))
	{	$rowGetPics="<a href=\"https://www.BostonApartments.com/homepage.php?cli=$thisRowGetAds->CLI&ad=$rowGetAd->CID\"><img border=0 src='https://www.BostonApartments.com/pics/$rowGetPics->PID.$rowGetPics->EXT' width='125' alt='$rowGetPics->DESCRIPT'></a><br>"; }
	return $rowGetPics;
} ?>


	<font color="#000000" face="Verdana">


<?php if ($numIDs=="1") { echo "<h1>Email 1 Listing</h1>"; } else { echo "<h1>Email $numIDs Listings</h1>";  }?>
<form action="mail.php" method="POST" enctype="multipart/form-data">

<TABLE BORDER=0><TR><TD>

<TABLE BORDER=0><TR><TD>

To: 

</TD><TD>

<input type="text" name="to" value="" /><br />

</TD></TR><TR><TD>

From: 
</TD><TD>


<input type="text" name="from" value="<?php echo "$rowGetUser->EMAIL";?>" /><br />

</TD></TR><TR><TD VALIGN="TOP">

Subject: 

</TD><TD>


<?php if ($numIDs=="1") { ?> echo "<input type="text" name="subject" value="Listing from <?php echo "$rowGetUser->FNAME";?> <?php echo "$rowGetUser->LNAME";?>" />"; <?php } else { ?><input type="text" name="subject" value="Listings from <?php echo "$rowGetUser->FNAME";?> <?php echo "$rowGetUser->LNAME";?>" /><?php }?>



</TD></TR></TABLE>

</TD><TD>


&nbsp;

</TD></TR></TABLE>


<p>

<p>Message:<br />


<textarea cols="70" rows="20" name="message" value="">

	<?php 
	
	$selWHERE = "INNER JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE (CID=$sel_ids[0]";
	
	foreach ($sel_ids as $sel_id) {

for ($i=1;$i<$numIDs;$i++){
				$selWHERE.= " OR CID=$sel_ids[$i] ";
			}
			$selWHERE.=" ) AND CLI=$grid ";



$qustrads = "select * from `CLASS` $selWHERE";
$quGetAds = mysqli_query($dbh, $qustrads);

while (@ $rowGetAds = mysqli_fetch_object($quGetAds)){

$adstring= format_ad_email ($rowGetAds, $DEFINED_VALUE_SETS);
echo $adstring;
echo "-----------------------------------------------------------"; }

} ?>

<?php echo "$rowGetUser->FNAME";?> <?php echo "$rowGetUser->LNAME";?>

<?php if ($rowGetUser->DIRECTLINE) {?>

Direct Line: <?php echo "$rowGetUser->DIRECTLINE";?>
<?php }?>
<?php if ($rowGetUser->CELLPHONE) {?>

Mobile: <?php echo "$rowGetUser->CELLPHONE";?>
<?php }?>
<?php if ($rowGetUser->EMAIL) {?>

Email: <?php echo "$rowGetUser->EMAIL";?>
<?php }?>
<?php if ($rowGetUser->PERSONAL_WEBSITE) {?>

Website: <?php echo "$rowGetUser->PERSONAL_WEBSITE";?>
<?php }?>


</TEXTAREA>

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





<?php } else { ;?>
	<font color="#000000" face="Verdana">
	You can't email <?php echo $numIDs;?> listings. You need to select at least one to email.<BR>
<P>
<a href="<?php echo "$PHP_SELF?op=$return_page";?>"><B><FONT COLOR="RED">Back to the Previous Page</FONT></B></A><BR>
<P>&nbsp;<BR>

<?php  } ;?>

<!--END select_and_email -->