<!--BEGIN managePics -->
<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>

<?php

$mode = $_GET['mode'];

if ($mode=='delete') {
	$listing_id = $cid;
	$pids = $_POST['pid'];
	foreach ($pids as $pid) {
		$quStrGetPicture = "select * from PICTURE where PID='$pid'";
		$quGetPicture = mysqli_query($dbh, $quStrGetPicture) or die (mysqli_error($dbh));
		$rowGetPicture = mysqli_fetch_object($quGetPicture);
		
		$ext = $rowGetPicture->EXT;
		
		$picture = "../../pics/$pid.$ext";
		@unlink ($picture);
	
		$quStrDeletePicture = "delete from PICTURE where PID='$pid'";
		$quDeletePicture = mysqli_query($dbh, $quStrDeletePicture) or die (mysqli_error($dbh));
	
		$quStrUpdateListing = "update CLASS set PIC=PIC-1 where CID='$cid'";
		$quUpdateListing = mysqli_query($dbh, $quStrUpdateListing) or die (mysqli_error($dbh));
	}
	}
?>


<span style="font-size:5px;"><BR></span>
<div align="left" style="padding:0px;margin:px;border:1px solid black;width:780;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:15px;color:black;">

<FONT SIZE=-4><BR></FONT>
<!--Tabs-->
<?php include ("folderTabs2.php"); ?>
<!--/Tabs-->
<br>
<br>
<center>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
		<tr width=100%>
		<td align="left" colspan="8" valign="top"  height="1" bgcolor="#FFFFFF">
		<form enctype="multipart/form-data" action="<?php echo "$PHP_SELF?op=uploadPreview"; ?>" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value=" 10750000">
		<input type="hidden" name="cid" value="<?php echo "$cid";?>">


<CENTER><B>MANAGE PICTURES</B>


			<table align="center" border="0" bgcolor="<?php echo $pagebgcolor; ?>">
			<tr>
			<td height="30" align="right">

<?php if ($user_level>0) {?>

<div class="controltext">Send this file:</DIV></td><td>
<input name="userfile" type="file" size="30">

</td>
			</tr>
			<tr>

			<td height="30" align="right"><div class="controltext">Watermark: </td><td><NOBR><input type=checkbox name=watermark> &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; <FONT SIZE="-2"><A HREF="<?php echo "$PHP_SELF?op=watermarkprefs"; ?>" target="_NEW">Set Watermark Preferences</A></FONT></NOBR></DIV>



</td></tr><tr><td align=right><div class="controltext">Description:</DIV> </td><td><input type="text" name="desc" size="30"></td>
			</tr>
			<tr>
			<td align="center" height="30"></td><td>

<input type="submit" value="Send File" STYLE="Background-Color : #A9F5A9">
<?php }?>

</td>
			</tr>
			</table>

		</form>
<!-- <a href="<?php echo "$PHP_SELF?op=upload&cid=$cid";?>"><img border="0" hspace="0" vspace="0" width="79" height="22" src="../assets/images/newPicture.jpg"></a><br><br>
-->

<FONT SIZE="-1">Click on images to see them full size. Click them again to return them to thumbnail size.<br></FONT>


				<script language="javascript">
				<!--
				function delete_pictures_form_submit() {
					if (confirm("Are you sure you want to delete these pictures?")) {
						document.forms.delete_pictures_form.submit();
					}
				}
				
				function reveal_size (id, real_width, real_height) {
					var img = document.getElementById(id);
					width = img.style.width;
					if (img.style.width == "150px") {
						img.style.width = real_width;
						img.style.height = real_height;
					}else {
						img.style.width = 150;
						img.style.height = 150;
					}
				}
				function restore_size (id) {
					var img = document.getElementById(id);
					img.style.width = 150;
					img.style.height = 150;
				}
				
				-->
				</script>




<form name="delete_pictures_form" action="<?php echo $PHP_SELF . "?op=managePics2&mode=delete";?>" method="POST">
<input type="hidden" name="listing_id" value="<?php echo $cid;?>">


</td>
		</tr>
	<?php $rowColor = "#FFFFFF";?>
	<tr align=left >
	<td>
	<?php $counter=0; ?>
    	<?php while ($rowGetPics = mysqli_fetch_object($quGetPics)) { 
	
$picture_path = "../../pics/$rowGetPics->PID.$rowGetPics->EXT";
$image_size = getimagesize ($picture_path);
$real_width = $image_size[0];
$real_height = $image_size[1];
?>
	
		<table width="100%" border=0><tr align="center"><td>
		<?php
		if ($rowGetAd->THUMBNAIL=="$rowGetPics->PID.$rowGetPics->EXT")
		{  ?>
		<b><font size=-3>Thumbnail Image</b><br>
		<?php } else { ?>

<?php if ($user_level>0) {?>

			<font size=-3><a href="<?php echo "$PHP_SELF?op=makeThumb&pid=$rowGetPics->PID&cid=$cid&pic=$rowGetPics->PID.$rowGetPics->EXT&state=off"; ?>">Set as Thumbnail</a><br>
<?php } ?>
		<?php } ?>
		<font size="1"><b>Pic ID:</b>
		<?php echo "$abv-$cid:p$rowGetPics->PID"; ?>
		<br>


<img style="width:150;height:150;" id="img_<?php echo $rowGetPics->PID;?>" onClick="reveal_size('img_<?php echo $rowGetPics->PID;?>',<?php echo $real_width;?>, <?php echo $real_height;?>);" width="150" height="150" src="../../pics/<?php echo "$rowGetPics->PID.$rowGetPics->EXT"; ?>">


<br>
<?php echo $rowGetPics->DESCRIPT; ?><br>


<?php if ($user_level>0) {?>

		<a href="<?php echo "$PHP_SELF?op=editPic&pid=$rowGetPics->PID&cid=$cid"; ?>"><img width="28" height="15" border="0" vspace="0" hspace="0" src="../assets/images/edit.jpg"></a>
		<a href="<?php echo "$PHP_SELF?op=deletePic&pid=$rowGetPics->PID&cid=$cid"; ?>"><img width='39' height='15' border='0' vspace='0' hspace='0' src='../assets/images/delete.jpg'></a>
		
		
<!-- <input name="pid[]" type="checkbox" value="<?php echo $rowGetPics->PID;?>">Delete -->


<br>ROTATE:
<br><a href="<?php echo "$PHP_SELF?op=rotatePic&pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid&degrees=90"; ?>">90 degrees clockwise</a>
<br><a href="<?php echo "$PHP_SELF?op=rotatePic&pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid&degrees=270"; ?>">90 degrees counter clockwise</a>
<br><a href="<?php echo "$PHP_SELF?op=rotatePic&pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid&degrees=180"; ?>">180 degrees</a>
<br><a href="<?php echo "$PHP_SELF?op=watermarkPic&pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid"; ?>">watermark</a><BR>
Picture Order: 
<?php
if ($rowGetPics->PICORDER AND $rowGetPics->PICORDER!='99') {
 echo $rowGetPics->PICORDER ; 
} else {
 echo "None" ;
}?>
&nbsp; <a href="<?php echo "$PHP_SELF?op=editPic&pid=$rowGetPics->PID&cid=$cid"; ?>">Change Order</a>

<BR><a href="javascript:popUpPicCode('<?php echo "./pages/picturelinks?pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid"; ?>');">HTML &amp; Links Picture Codes</A>



<?php } ?>

<!--
-->
<br><br><br>
		</td></tr></table>
		<?php
		$counter++;
		if ((fmod($counter, 4))==0)
		 	echo "</td></tr><tr halign='left'><td>" ; 
		else
			echo "</td><td>";
		?>
    	<?php } ?>
	</td>
	</tr>
	</table>
		
	<br>
	<br>
	<br>
<!-- <input type="button" onClick="delete_pictures_form_submit();" value="delete"></FORM> -->
</center>
</div>
<br>
<br>
<!--END managePics -->