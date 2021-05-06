<!--BEGIN managePics -->
<?php 
include ("../assets/buttons.php");


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
		
		<input type="hidden" name="MAX_FILE_SIZE" value="20480000">
		<input type="hidden" name="cid" value="<?php echo "$cid";?>">





<CENTER>

<TABLE BGCOLOR="#FFFFFF" BORDER=0><TR>
<TD VALIGN="MIDDLE" ALIGN="CENTER">
<img border="0" src="../assets/images/managephotos.jpg" HEIGHT="35" WIDTH="68">
</TD>
<TD VALIGN="MIDDLE" ALIGN="CENTER">
&nbsp;&nbsp;&nbsp;<B><FONT SIZE="+1"><NOBR>
<?php if ($rowGetAd->CLI==$grid AND $rowGetAd->CSOURCE==0) { ?>
MANAGE <?php }?>PICTURES

<?php if ($rowGetAd->STREET_NUM != "" AND $rowGetAd->STREET != "") { ?>

FOR <?php echo $rowGetAd->STREET_NUM;?> <?php echo $rowGetAd->STREET;?> # <?php echo $rowGetAd->APT;?>

<?php } ?>

</NOBR></FONT></B>
</TD></TR></TABLE>

<?php if ($rowGetAd->CLI==$grid) { ?>



<form id="fileupload" action="<?php echo "$PHP_SELF?op=multiuploadDo&cid=$cid"; ?>" method="POST" enctype="multipart/form-data">
<TABLE WIDTH="550" CELLPADDING="0" CELLSPACING="0" BORDER="1"><TR><TD bgcolor="<?php echo $pagebgcolor; ?>">

			<table align="center" border="0" bgcolor="<?php echo $pagebgcolor; ?>">
			<tr>
			<td height="30" align="CENTER">

<?php if ($user_level>0) {?>

<NOBR><B>Upload Picture(s):</B></DIV>
<input type="file" multiple name="userfile[]" id="userfile[]" onChange="makeFileList();" />
 &nbsp;&nbsp;  <!--<input type="submit" value="Send File(s)" STYLE="Background-Color : #A9F5A9">-->
 
 <button class="button-green pure-button">Send File(s)</button>
 
 </NOBR>
 <FONT SIZE="1"><br><I>Use the Control Key/Apple Key to select multiple files or type the URL of a picture.</I></FONT><br>
</td>
</tr>
<tr>

			<td height="30" align="right"><div class="controltext"><BR>
	<span style="font-size:10px;"><NOBR>&nbsp;<B>Picture size:</B>

<?php

if ($rowGetGroup->PIC_CUSTOM_WIDTH) {
?>

Large<input type="radio" name="picsize" id="picsize" value="1"> Small<input type="radio" name="picsize" id="picsize" value="0"> Custom Width:<input type="radio" name="picsize" id="picsize" value="2" checked> <input id="pic_custom_width" type="text" name="pic_custom_width" size="5" value="<?php echo $rowGetGroup->PIC_CUSTOM_WIDTH;?>"></span>

<?php } else { ?>

Large<input type="radio" name="picsize" id="picsize" value="1" checked> Small<input type="radio" name="picsize" id="picsize" value="0"> Custom Width (px): <input type="radio" name="picsize" id="picsize" value="2"> <input id="pic_custom_width" type="text" name="pic_custom_width" size="5" value="<?php echo $rowGetGroup->PIC_CUSTOM_WIDTH;?>">

<?php } ?>

 Watermark:  <NOBR><input type="checkbox" name="watermarkon" <?php if  ($watermark_on=="1") {echo " checked ";} ?>></SPAN> | <FONT SIZE="-2"><A HREF="<?php echo "$PHP_SELF?op=watermarkprefs"; ?>" target="_NEW">Set Watermark Preferences</A></FONT>&nbsp;</NOBR></DIV>

<?php }?>

</td></tr></form>

<tr><td><span style="font-size:9px;">
		<strong>Files You Selected For Upload:</strong>
	</p>
	<ul id="fileList"><li>No Files Selected</li></ul>
	
	<script type="text/javascript">
		function makeFileList() {
			var input = document.getElementById("userfile[]");
			var ul = document.getElementById("fileList");
			while (ul.hasChildNodes()) {
				ul.removeChild(ul.firstChild);
			}
			for (var i = 0; i < input.files.length; i++) {
				var li = document.createElement("li");
				li.innerHTML = input.files[i].name;
				ul.appendChild(li);
			}
			if(!ul.hasChildNodes()) {
				var li = document.createElement("li");
				li.innerHTML = 'No Files Selected -  <B>DRAG PICS HERE</B>';
				ul.appendChild(li);
			}
		}
	</script>
	</SPAN>
</td></tr>


<tr><td ALIGN="CENTER">
<?php if ($rowGetAd->STREET_NUM!="" OR $rowGetAd->STREET!="") { ?>
<B><A HREF="<?php echo "$PHP_SELF?op=upload1tomany&cid=$cid" ;?>"><FONT COLOR="GREEN" size="2">Upload 1 Picture to ALL UNITS @ <?php echo $rowGetAd->STREET_NUM;?> <?php echo $rowGetAd->STREET;?></FONT> - <FONT  SIZE="-3" COLOR="#999999">Click Here</FONT></A></B><BR>
<?php } ?>
</td></tr>
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



<?php
if ($rowGetAd->PIC == "0"){
$foo = "bar";
} else { ?>

<FONT SIZE="-1">Click on images to see them full size. Click them again to return them to thumbnail size.<br></FONT>



<a href="<?php echo "$PHP_SELF?op=managePics-reorder&cid=$cid"; ?>">Change Picture Order</a></NOBR><BR>


<?php } ?>

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

				
				
				
<?php  } ?>




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

			<font size=-3>
			
			<?php if ($user_level>0 AND $rowGetAd->CLI==$grid) {?>
			
			<a href="<?php echo "$PHP_SELF?op=makeThumb&pid=$rowGetPics->PID&cid=$cid&pic=$rowGetPics->PID.$rowGetPics->EXT&state=off"; ?>">Set as Thumbnail</a><br>
<?php } ?>
		<?php } ?>

<img style="width:150;height:150;" id="img_<?php echo $rowGetPics->PID;?>" onClick="reveal_size('img_<?php echo $rowGetPics->PID;?>',<?php echo $real_width;?>, <?php echo $real_height;?>);" width="150" height="150" src="../../pics/<?php echo "$rowGetPics->PID.$rowGetPics->EXT"; ?>">


<br>




			<?php if ($user_level>0 AND $rowGetAd->CLI==$grid) {?>
			
<?php if ($user_level>0) {?>
<NOBR><a href="<?php echo "$PHP_SELF?op=editPic&pid=$rowGetPics->PID&cid=$cid"; ?>"><img border="0" vspace="0" hspace="0" src="../images/icons/edit.gif">Edit</a> &nbsp;|&nbsp; <a href="<?php echo "$PHP_SELF?op=watermarkPic&pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid"; ?>">Watermark</a> &nbsp;<?php if ($user_level>1) {?> |&nbsp; <input name="pid[]" type="checkbox" value="<?php echo $rowGetPics->PID;?>">Delete <?php } ?></NOBR><br>
<NOBR><B>Rotate:</B> <a href="<?php echo "$PHP_SELF?op=rotatePic&pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid&degrees=90"; ?>">90&deg; <img border="0" vspace="0" hspace="0" src="../images/icons/rotate-right.gif" ALT="rotate 90 degrees" HEIGHT="16" WIDTH="16" ALIGN="BOTTOM"></a> | <a href="<?php echo "$PHP_SELF?op=rotatePic&pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid&degrees=270"; ?>">270&deg; <img border="0" vspace="0" hspace="0" src="../images/icons/rotate-left.gif" ALT="rotate 270 degrees" HEIGHT="16" WIDTH="16" ALIGN="BOTTOM"></a> | <a href="<?php echo "$PHP_SELF?op=rotatePic&pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid&degrees=180"; ?>">180&deg;<img border="0" vspace="0" hspace="0" src="../images/icons/rotate-180.gif" ALT="rotate 180 degrees" HEIGHT="16" WIDTH="16" ALIGN="BOTTOM"></a></NOBR>
<FONT SIZE="-4"><BR></FONT>
<NOBR><a href="javascript:popUpPicCode('<?php echo "./pages/picturelinks?pid=$rowGetPics->PID&ext=$rowGetPics->EXT&cid=$cid"; ?>');">HTML &amp; Links Picture Codes</A></NOBR><br>

<?php
if ($rowGetPics->DESCRIPT) { echo "<B>Desc:</B> $rowGetPics->DESCRIPT <br>"; } else { echo "<BR>"; }
?>

<NOBR><?php if  ($rowGetPics->AGENTONLY=="1") { ?>

<A HREF="<?php echo "$PHP_SELF?op=picmakepublic&pid=$rowGetPics->PID&cid=$rowGetPics->CID";?>">Agent Eyes Only</A><BR> <?php } else { ?> <A HREF="<?php echo "$PHP_SELF?op=picmakeagentonly&pid=$rowGetPics->PID&cid=$rowGetPics->CID"; ?>">Publicly Viewable</A><BR> <?php } ?></NOBR>




		<font size="1"><b>Pic ID:</b>
		<?php  echo "$abv-$cid:p$rowGetPics->PID"; ?>



<?php }} ?>

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

<?php if ($rowGetAd->CLI==$grid AND $rowGetAd->CSOURCE==0) { ?>

<NOBR><input type="checkbox" name="allbox" value="sel_all" onClick="CheckAlldel();"><FONT COLOR=red> &#9745;All for deletion

&nbsp;</FONT>


<!-- <input type="button" onClick="delete_pictures_form_submit();" value="Delete Selected Pictures" STYLE="Background-Color : #F5A9A9; text : 6px;">-->
<button onClick="delete_pictures_form_submit();" class="button-red pure-button">Delete Selected Pictures</button>

</FORM></NOBR>

 
 
<?php }} ?>


<?php if ($rowGetAd->EXTERNALPIC) { ?>


<CENTER>
<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr> <td valign="top" align="center">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<CENTER><TABLE BORDER="0"><tr align="center" valign="top"><TD>

<?php

$i = 0;
$k = 0;

$num_pics = $rowGetAd->EXTERNALPIC_NUM;

for ($j=0; $j<$num_pics; $j++) {



$MLSPIC = "http://mlsa-images.s3.amazonaws.com/cf740c3b1c01e4ec4d2058311e1583b8/".$rowGetAd->EXTERNALID."_".$k.".jpg";




if (!($k%2)){
echo "<tr align=\"center\" valign=\"top\"><td height=\"262\"><div align=\"center\" style=\"padding-left: 2px; padding-right: 2px; padding-top: 2px; padding-bottom: 2px;\">";
}
if ($k%2) {
echo "</TD><td height=\"262\"><div align=\"center\" style=\"padding-left: 2px; padding-right: 2px; padding-top: 2px; padding-bottom: 2px;\">";
}


list($width, $height, $type, $attr) = getimagesize("$MLSPIC");

if ($height >="262") {
				echo "<CENTER>

<A HREF='$MLSPIC' target='_bigpic'><img src='$MLSPIC' HEIGHT='262' BORDER=0></A></CENTER>";
} else {
				echo "<CENTER><A HREF='$MLSPIC' target='_bigpic'><img src='$MLSPIC' BORDER=0></A></CENTER>";
}

$k++;
}
echo "</TD></TR></TABLE></TD></TR></TABLE>";


if ($rowGetAd->PIC == "0"){
$foo = "bar";
} else { 

echo "<FONT SIZE=\"-2\">Click any picture to enlarge it.<BR><BR></FONT>";
}

echo "</CENTER>";
}



  ?>

<br> 
<br>
</center>
</div>
<br>
<!--END managePics -->
