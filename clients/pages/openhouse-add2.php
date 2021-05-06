<?php

$cid = $HTTP_GET_VARS['CID'];


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$oh_date = $_POST['oh_year'] ."-". $_POST['oh_month'] ."-". $_POST['oh_day'];
	$oh_start_hour = htmlentities($_POST['START_HOUR']);
	$oh_start_mins = htmlentities($_POST['START_MINS']);
	$oh_start_mer = htmlentities($_POST['START_MER']);
	$oh_end_hour = htmlentities($_POST['END_HOUR']);
	$oh_end_mins = htmlentities($_POST['END_MINS']);
	$oh_end_mer = htmlentities($_POST['END_MER']);
	$oh_comments = htmlentities($_POST['COMMENTS']);


		$nowMon = date (m);
		$nowDay = date (d);
		$nowYear = date (Y);

$date_created = "$nowYear-$nowMon-$nowDay";
$date_modified = "$nowYear-$nowMon-$nowDay";

$cid = $_POST['CID'];
$cli = $grid;

	
	if (empty($oh_date))
	die("<BR><P><BR><FONT COLOR=red>Please fill out the date section.</FONT><BR><P><a href=\"#\" onClick=\"history.go(-1)\">Back to Form</a><BR><P><BR>");


	if (empty($oh_start_hour))
	die("<BR><P><BR><FONT COLOR=red>Please pick a start time.</FONT><BR><P><a href=\"#\" onClick=\"history.go(-1)\">Back to Form</a><BR><P><BR>");



	if (empty($oh_end_hour))
	die("<BR><P><BR><FONT COLOR=red>Please pick an end time.</FONT><BR><P><a href=\"#\" onClick=\"history.go(-1)\">Back to Form</a><BR><P><BR>");

	if (empty($cid))
	die("<BR><P><BR><FONT COLOR=red>Please enter a Listing ID #.</FONT><BR><P><a href=\"#\" onClick=\"history.go(-1)\">Back to Form</a><BR><P><BR>");


	
	$link = "INSERT INTO OPENHOUSE (DATE, START_HOUR, START_MINS, START_MER, END_HOUR, END_MINS, END_MER, COMMENTS, CID, CLI) VALUES ('$oh_date','$oh_start_hour','$oh_start_mins','$oh_start_mer','$oh_end_hour','$oh_end_mins','$oh_end_mer','$oh_comments','$cid','$cli')";
	$res = mysqli_query($dbh, $link) or die(mysqli_error($dbh));
	if ($res)
	die("<BR><P>Open House Succesfully Saved.<br>
<P>
<a href='?op=openhouse'>Click for the Open House  Main Menu</a><BR><P><BR>");
}
else
{

?>
<h2>ADD AN OPEN HOUSE</h2>
<a href="?op=newsletters">Back to the Open House Main Menu</a><BR><BR>


	<form action="" method="POST">

<TABLE><TR><TD>


Listing ID#

</TD><TD>

<?php if ($cid) {echo $cid ;} else { ?>


<input type="text" name="CID" size="22" value="<?php echo $cid ;?>">

<?php } ?>


</TD></TR><TR><TD>


Open House Date:

</TD><TD>

<select name="oh_month" STYLE="Background-Color : #FFFFFF">
						<option value="1" <?php if ($oh_month==1) { echo "selected";}?>>Jan</option>
						<option value="2" <?php if ($oh_month==2) { echo "selected";}?>>Feb</option>
						<option value="3" <?php if ($oh_month==3) { echo "selected";}?>>Mar</option>
						<option value="4" <?php if ($oh_month==4) { echo "selected";}?>>April</option>
						<option value="5" <?php if ($oh_month==5) { echo "selected";}?>>May</option>
						<option value="6" <?php if ($oh_month==6) { echo "selected";}?>>Jun</option>
						<option value="7" <?php if ($oh_month==7) { echo "selected";}?>>Jul</option>
						<option value="8" <?php if ($oh_month==8) { echo "selected";}?>>Aug</option>
						<option value="9" <?php if ($oh_month==9) { echo "selected";}?>>Sep</option>
						<option value="10" <?php if ($oh_month==10) { echo "selected";}?>>Oct</option>
						<option value="11" <?php if ($oh_month==11) { echo "selected";}?>>Nov</option>
						<option value="12" <?php if ($oh_month==12) { echo "selected";}?>>Dec</option>
						</select> 
			<select name="oh_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($oh_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>



			<select name="oh_year" STYLE="Background-Color : #FFFFFF">

<?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>

<option value="<?php echo $i+1;?>" <?php if ($oh_year==$i) { echo "selected";}?>>
<?php echo $i+1;?>
</option>

<option value="<?php echo $i;?>" <?php if ($oh_year==$i) { echo "selected";}?>>
<?php echo $i;?>
</option>

						<?php } ?>
						</select>

</TD></TR><TR><TD>

Start Time:
</TD><TD>
<select name="START_HOUR" STYLE="Background-Color : #FFFFFF">

						<option value="1" <?php if ($START_HOUR=='1') { echo "selected";}?>>1</option>
						<option value="2" <?php if ($START_HOUR=='2') { echo "selected";}?>>2</option>
						<option value="3" <?php if ($START_HOUR=='3') { echo "selected";}?>>3</option>
						<option value="4" <?php if ($START_HOUR=='4') { echo "selected";}?>>4</option>
						<option value="5" <?php if ($START_HOUR=='5') { echo "selected";}?>>5</option>
						<option value="6" <?php if ($START_HOUR=='6') { echo "selected";}?>>6</option>
						<option value="7" <?php if ($START_HOUR=='7') { echo "selected";}?>>7</option>
						<option value="8" <?php if ($START_HOUR=='8') { echo "selected";}?>>8</option>
						<option value="9" <?php if ($START_HOUR=='9') { echo "selected";}?>>9</option>
						<option value="10" <?php if ($START_HOUR=='10') { echo "selected";}?>>10</option>
						<option value="11" <?php if ($START_HOUR=='11') { echo "selected";}?>>11</option>
						<option value="12" <?php if ($START_HOUR=='12') { echo "selected";}?>>12</option>
</SELECT>


<select name="START_MINS" STYLE="Background-Color : #FFFFFF">

						<option value="00" <?php if ($START_MINS=='00') { echo "selected";}?>>00</option>
						<option value="05" <?php if ($START_MINS=='05') { echo "selected";}?>>05</option>
						<option value="10" <?php if ($START_MINS=='10') { echo "selected";}?>>10</option>
						<option value="15" <?php if ($START_MINS=='15') { echo "selected";}?>>15</option>
						<option value="20" <?php if ($START_MINS=='20') { echo "selected";}?>>20</option>
						<option value="25" <?php if ($START_MINS=='25') { echo "selected";}?>>25</option>
						<option value="30" <?php if ($START_MINS=='30') { echo "selected";}?>>30</option>
						<option value="35" <?php if ($START_MINS=='35') { echo "selected";}?>>35</option>
						<option value="40" <?php if ($START_MINS=='40') { echo "selected";}?>>40</option>
						<option value="45" <?php if ($START_MINS=='45') { echo "selected";}?>>45</option>
						<option value="50" <?php if ($START_MINS=='50') { echo "selected";}?>>50</option>
						<option value="55" <?php if ($START_MINS=='55') { echo "selected";}?>>55</option>
</SELECT>

<select name="START_MER" STYLE="Background-Color : #FFFFFF">
						<option value="AM" <?php if ($START_MER=='AM') { echo "selected";}?>>AM</option>
						<option value="PM" <?php if ($START_MER=='PM') { echo "selected";}?>>PM</option>


</TD></TR><TR><TD>

End Time:
</TD><TD>

<select name="END_HOUR" STYLE="Background-Color : #FFFFFF">

						<option value="1" <?php if ($END_HOUR=='1') { echo "selected";}?>>1</option>
						<option value="2" <?php if ($END_HOUR=='2') { echo "selected";}?>>2</option>
						<option value="3" <?php if ($END_HOUR=='3') { echo "selected";}?>>3</option>
						<option value="4" <?php if ($END_HOUR=='4') { echo "selected";}?>>4</option>
						<option value="5" <?php if ($END_HOUR=='5') { echo "selected";}?>>5</option>
						<option value="6" <?php if ($END_HOUR=='6') { echo "selected";}?>>6</option>
						<option value="7" <?php if ($END_HOUR=='7') { echo "selected";}?>>7</option>
						<option value="8" <?php if ($END_HOUR=='8') { echo "selected";}?>>8</option>
						<option value="9" <?php if ($END_HOUR=='9') { echo "selected";}?>>9</option>
						<option value="10" <?php if ($END_HOUR=='10') { echo "selected";}?>>10</option>
						<option value="11" <?php if ($END_HOUR=='11') { echo "selected";}?>>11</option>
						<option value="12" <?php if ($END_HOUR=='12') { echo "selected";}?>>12</option>
</SELECT>


<select name="END_MINS" STYLE="Background-Color : #FFFFFF">

						<option value="00" <?php if ($END_MINS=='00') { echo "selected";}?>>00</option>
						<option value="05" <?php if ($END_MINS=='05') { echo "selected";}?>>05</option>
						<option value="10" <?php if ($END_MINS=='10') { echo "selected";}?>>10</option>
						<option value="15" <?php if ($END_MINS=='15') { echo "selected";}?>>15</option>
						<option value="20" <?php if ($END_MINS=='20') { echo "selected";}?>>20</option>
						<option value="25" <?php if ($END_MINS=='25') { echo "selected";}?>>25</option>
						<option value="30" <?php if ($END_MINS=='30') { echo "selected";}?>>30</option>
						<option value="35" <?php if ($END_MINS=='35') { echo "selected";}?>>35</option>
						<option value="40" <?php if ($END_MINS=='40') { echo "selected";}?>>40</option>
						<option value="45" <?php if ($END_MINS=='45') { echo "selected";}?>>45</option>
						<option value="50" <?php if ($END_MINS=='50') { echo "selected";}?>>50</option>
						<option value="55" <?php if ($END_MINS=='55') { echo "selected";}?>>55</option>
</SELECT>

<select name="END_MER" STYLE="Background-Color : #FFFFFF">
						<option value="AM" <?php if ($END_MER=='AM') { echo "selected";}?>>AM</option>
						<option value="PM" <?php if ($END_MER=='PM') { echo "selected";}?>>PM</option>

</TD></TR><TR><TD VALIGN=top>

Comments:

</TD><TD>

 <textarea name="COMMENTS" cols="70" rows="20" onFocus=clear_textbox()
 value="Type your comments here.">
</textarea>

</TD></TR></TABLE>

	<input type="submit" value="Add Open House" STYLE="Background-Color : #A9F5A9">
	</form>
<?php } ?>

<BR>