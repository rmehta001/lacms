<!--BEGIN select_and_delete -->

	<center>
<BR>
<?php if ($numIDs >0) { ;?>

	<font color="#000000" face="Verdana">
	Are you sure you want to post <?php echo $numIDs;?> ad(s) to Craigslist?<BR>
<P>

	<form action="<?php echo "$PHP_SELF?op=select_and_clpost";?>" method="POST">
<input TYPE="HIDDEN" NAME="return_page" value="<?php echo "$return_page";?>">

	<?php foreach ($sel_ids as $sel_id) {?>
	<input type="hidden" name="sel_ids[]" value="<?php echo $sel_id;?>">
	<?php } ?>
		<B>Please type 'y' to confirm.</B>
		<input type="text" name="conf" size="3">
		<input type="submit" value="Post to Craigslist" STYLE="Background-Color : #A9F5A9"></form>
		<br>
<a href="<?php echo "$PHP_SELF?op=$return_page";?>"><B><FONT COLOR="RED">Cancel</FONT></B></A><BR>
<P>&nbsp;<BR>


<?php } else { ;?>
	<font color="#000000" face="Verdana">
	You can't post <?php echo $numIDs;?> these ads. You need to select at least one.<BR>
<P>
<a href="<?php echo "$PHP_SELF?op=$return_page";?>"><B><FONT COLOR="RED">Back to the Previous Page</FONT></B></A><BR>
<P>&nbsp;<BR>

<?php  } ;?>

<!--END select_and_delete -->