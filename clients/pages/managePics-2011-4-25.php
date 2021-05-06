<!--BEGIN managePics -->
<?php
if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 
?>

<?php

$mode = $HTTP_GET_VARS['mode'];
$page2 = "$PHP_SELF?op=managePics&cid=$cid";

if ($mode=='delete') {
	$listing_id = $cid;
	$pids = $_POST['pid'];

if (!$pids) {
echo "<BR><BR><B><FONT COLOR=RED>0 IMAGES DELETED</FONT> (no pictures were selected)</B><BR><P><A HREF=$page2><FONT COLOR=GREEN>Click to continue</FONT></A><BR><BR><BR>";
exit;
} else {



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



echo "<BR><BR><B>IMAGE(S) DELETED</B><BR><P><A HREF=$page2><FONT COLOR=GREEN>Click to continue</FONT></A><BR><BR><BR>";
exit;
	}
}
?>


<span style="font-size:5px;"><BR></span>
<div align="left" style="padding:0px;margin:px;border:1px solid black;width:865;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:15px;color:black;">

<FONT SIZE=-4><BR></FONT>
<!--Tabs-->
<?php include ("folderTabs2.php"); ?>
<!--/Tabs-->
<br>




<center>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
		<tr width=100%>
		<td align="left" colspan="8" valign="top"  height="1" bgcolor="#FFFFFF">
		<form enctype="multipart/form-data" action="<?php echo "$PHP_SELF?op=uploadPreview"; ?>" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value=" 10750000">
		<input type="hidden" name="cid" value="<?php echo "$cid";?>">





<CENTER>

<TABLE BGCOLOR="#FFFFFF" BORDER=0><TR>
<TD VALIGN="MIDDLE" ALIGN="CENTER">
<img border="0" src="../assets/images/managephotos.jpg" HEIGHT="35" WIDTH="68">
</TD>
<TD VALIGN="MIDDLE" ALIGN="CENTER">
&nbsp;&nbsp;&nbsp;<B><FONT SIZE="+1"><NOBR>MANAGE PICTURES

<?php if ($rowGetAd->STREET_NUM != "" AND $rowGetAd->STREET != "") { ?>

FOR <?php echo $rowGetAd->STREET_NUM;?> <?php echo $rowGetAd->STREET;?> # <?php echo $rowGetAd->APT;?>

<?php } ?>

</NOBR></FONT></B>
</TD></TR></TABLE>


<B><A HREF="<?php echo "$PHP_SELF?op=multiupload&cid=$cid" ;?>"><FONT COLOR="GREEN">Multiple Picture Uploads</FONT><FONT  SIZE="-3" COLOR="#999999"> - Click Here</FONT></A></B><BR>


<B><A HREF="<?php echo "$PHP_SELF?op=upload1tomany&cid=$cid" ;?>"><FONT COLOR="GREEN">Upload 1 Picture to ALL UNITS @ <?php echo $rowGetAd->STREET_NUM;?> <?php echo $rowGetAd->STREET;?></FONT> - <FONT  SIZE="-3" COLOR="#999999">Click Here</FONT></A></B><BR>




<TABLE WIDTH="550"><TR><TD>

			<table align="center" border="0" bgcolor="<?php echo $pagebgcolor; ?>">
			<tr>
			<td height="30" align="right">

<?php if ($user_level>0) {?>

<div class="controltext">Send this file:</DIV></td><td>
<input name="userfile" type="file" size="30">

</td>
			</tr>
			<tr>

			<td height="30" align="right"><div class="controltext">Watermark: </td><td><NOBR><input type=checkbox name=watermark <?php if  ($watermark_on=="1") {echo " checked ";} ?>> &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; <FONT SIZE="-2"><A HREF="<?php echo "$PHP_SELF?op=watermarkprefs"; ?>" target="_NEW">Set Watermark Preferences</A></FONT></NOBR></DIV>



</td></tr><tr><td align=right><div class="controltext">Description:</DIV> </td><td><input type="text" name="desc" size="30"></td>
			</tr>
			<tr>
			<td align="center" height="30"></td><td>

<input type="submit" value="Send File" STYLE="Background-Color : #A9F5A9">
<?php }?>


</td></tr></form>
</table>


</TD><TD>


<CENTER>

<?php if ($rowGetAd->STREET_NUM=="" OR $rowGetAd->STREET=="") {
echo "<FONT COLOR=\"RED\" SIZE=\"-2\">No address for this listing. No Building Photo Gallery is available.";
} else {
?>

<a href="<?php echo "$PHP_SELF?op=pics-building&street_num=$rowGetAd->STREET_NUM&street=$rowGetAd->STREET&lid=$rowGetAd->LANDLORD";?>" target="_NEW"><img border="0" src="../assets/images/pic-gallery.jpeg" HEIGHT="79" WIDTH="112" TITLE="Building Photo Gallery" ALT="Building Photo Gallery"></a><BR><FONT SIZE="-1">
<a href="<?php echo "$PHP_SELF?op=pics-building&street_num=$rowGetAd->STREET_NUM&street=$rowGetAd->STREET";?>" target="_NEW">Building<BR>Photo<BR>Gallery</A></FONT>

<?php } ?>



</CENTER>

</td></tr></table>






<FONT SIZE="-1">Click on images to see them full size. Click them again to return them to thumbnail size.<br></FONT>


				<script language="javascript">
				<!--
				function delete_pictures_form_submit() {
					if (confirm("Are you sure you want to delete the selected pictures?")) {
						document.forms.delete_pictures_form.submit();
					}
				}
				
				
				function CheckAlldel() {                                                       
      			for (var i=0;i<document.delete_pictures_form.elements.length;i++){                                                    
         			var e = document.delete_pictures_form.elements[i];            		
         			if (e.name != "allbox"){
            				e.checked = document.delete_pictures_form.allbox.checked;  
            			}
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




<form name="delete_pictures_form" action="<?php echo $PHP_SELF . "?op=managePics&cid=$cid&mode=delete";?>" method="POST">
<input type="hidden" name="listing_id" value="<?php echo $cid;?>">


</td>
		</tr>
	<?php $cellColor = "#F5F5DC";?>
	<tr align=left >
	<td>
	<?php $counter=0; ?>
    	<?php while ($rowGetPics = mysqli_fetch_object($quGetPics)) { 

if ($cellColor=="#FFFFFF") {
$cellColor="#F5F5DC";
}else {
$cellColor="#FFFFFF";
}

$picture_path = "../../pics/$rowGetPics->PID.$rowGetPics->EXT";
$image_size = getimagesize ($picture_path);
$real_width = $image_size[0];
$real_height = $image_size[1];
?>
	
		<table width="100%" border=0><tr align="center"><td bgcolor="<?php echo $cellColor;?>">
		<?php
		if ($rowGetAd->THUMBNAIL=="$rowGetPics->PID.$rowGetPics->EXT")
		{  ?>
		<b><font size=-3>Thumbnail Image</b><br>
		<?php } else { ?>

<?php if ($user_level>0) {?>

			<font size=-3><a href="<?php echo "$PHP_SELF?op=makeThumb&pid=$rowGetPics->PID&cid=$cid&pic=$rowGetPics->PID.$rowGetPics->EXT&state=off"; ?>">Set as Thumbnail</a><br>
<?php } ?>
		<?php } ?>

<img style="width:150;height:150;" id="img_<?php echo $rowGetPics->PID;?>" onClick="reveal_size('img_<?php echo $rowGetPics->PID;?>',<?php echo $real_width;?>, <?php echo $real_height;?>);" width="150" height="150" src="../../pics/<?php echo "$rowGetPics->PID.$rowGetPics->EXT"; ?>">


<br>





<?php if ($user_level>0) {?>
<NOBR><a href="<?php echo "$PHP_SELF?op=editPic&pid=$rowGetPics->PID&cid=$cid"; ?>"><img border="0" vspace="0" hspace="0" src="../images/icons/edit.gif">Edit</a> &nbsp;|&nbsp; <a href="<?php echo "$PHP_SELF?op=watermarkPic&pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid"; ?>">Watermark</a> &nbsp;|&nbsp; <input name="pid[]" type="checkbox" value="<?php echo $rowGetPics->PID;?>">Delete</NOBR><br>
<NOBR><B>Rotate:</B> <a href="<?php echo "$PHP_SELF?op=rotatePic&pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid&degrees=90"; ?>">90&deg; <img border="0" vspace="0" hspace="0" src="../images/icons/rotate-right.gif" ALT="rotate 90 degrees" HEIGHT="16" WIDTH="16" ALIGN="BOTTOM"></a> | <a href="<?php echo "$PHP_SELF?op=rotatePic&pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid&degrees=270"; ?>">270&deg; <img border="0" vspace="0" hspace="0" src="../images/icons/rotate-left.gif" ALT="rotate 270 degrees" HEIGHT="16" WIDTH="16" ALIGN="BOTTOM"></a> | <a href="<?php echo "$PHP_SELF?op=rotatePic&pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid&degrees=180"; ?>">180&deg;<img border="0" vspace="0" hspace="0" src="../images/icons/rotate-180.gif" ALT="rotate 180 degrees" HEIGHT="16" WIDTH="16" ALIGN="BOTTOM"></a></NOBR>
<FONT SIZE="-4"><BR></FONT>
<NOBR><B>Picture Order:</B> 
<?php
if ($rowGetPics->PICORDER AND $rowGetPics->PICORDER!='99') {
 echo $rowGetPics->PICORDER ; 
} else {
 echo "None" ;
}?>
&nbsp; <a href="<?php echo "$PHP_SELF?op=editPic&pid=$rowGetPics->PID&cid=$cid"; ?>">Change Order</a></NOBR><BR>
<NOBR><a href="javascript:popUpPicCode('<?php echo "./pages/picturelinks?pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid"; ?>');">HTML &amp; Links Picture Codes</A></NOBR><br>

<?php
if ($rowGetPics->DESCRIPT) { echo "<B>Desc:</B> $rowGetPics->DESCRIPT <br>"; } else { echo "<br>"; }?>

		<font size="1"><b>Pic ID:</b>
		<?php  echo "$abv-$cid:p$rowGetPics->PID"; ?>



<?php } ?>

<!--
-->
<BR><br>
		</td></tr></table>
		<?php
		$counter++;
		if ((fmod($counter, 4))==0) {

$cellColor = "#FFFFFF";
		 	echo "</td></tr><tr halign='left'><td>" ; 
}
		else {
			echo "</td><td>";
}		?>
    	<?php } ?>
	</td>
	</tr>
	</table>
<br>
<?php if ($user_level>0) {?>

<NOBR><input type="checkbox" name="allbox" value="sel_all" onClick="CheckAlldel();"><FONT COLOR=red> &#9745;All for deletion

&nbsp;</FONT>
 <input type="button" onClick="delete_pictures_form_submit();" value="Delete Selected Pictures" STYLE="Background-Color : #F5A9A9; text : 6px;"></FORM></NOBR>

<?php } ?>

<br> 
<br>
</center>
</div>
<br>
<!--END managePics -->