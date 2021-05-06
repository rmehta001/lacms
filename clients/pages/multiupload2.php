<?php 
//multiupload.php


$cid = $HTTP_GET_VARS['cid'];

?>
Multiple Picture Upload to Listing <?php echo $cid;?><BR>

<TABLE WIDTH="80%" BGCOLOR="#FFFFFF" CELLPADDING="4" BORDER="1" BORDERCOLOR="#000000"><TR><TD>



    <form id="fileupload" action="<?php echo "$PHP_SELF?op=multiuploadDo2&cid=$cid"; ?>" method="POST" enctype="multipart/form-data">

	
<CENTER>
<B>
This form will upload multiple pictures to listing <?php echo $cid;?>.</B><BR>

<BR>


	<p><strong>Upload Files:</strong> <input type="file" multiple name="userfile[]" id="userfile[]" onChange="makeFileList();" />
	
	<BR><BR>
	<span style="font-size:10px;">Picture size:

<?php

if ($rowGetGroup->PIC_CUSTOM_WIDTH) {
?>

Large<input type="radio" name="picsize" id="picsize" value="1"> Small<input type="radio" name="picsize" id="picsize" value="0"> Custom Width:<input type="radio" name="picsize" id="picsize" value="2" checked> <input id="pic_custom_width" type="text" name="pic_custom_width" size="5" value="<?php echo $rowGetGroup->PIC_CUSTOM_WIDTH;?>"></span>

<?php } else { ?>

Large<input type="radio" name="picsize" id="picsize" value="1" checked> Small<input type="radio" name="picsize" id="picsize" value="0"> Custom Width (px): <input type="radio" name="picsize" id="picsize" value="2"> <input id="pic_custom_width" type="text" name="pic_custom_width" size="5" value="<?php echo $rowGetGroup->PIC_CUSTOM_WIDTH;?>">

<?php } ?>

</span>

<span style="font-size:10px;">Watermark:  <NOBR><input type="checkbox" name="watermarkon" <?php if  ($watermark_on=="1") {echo " checked ";} ?>></SPAN>


<TABLE WIDTH="600"><TR><TD VALIGN="TOP">


		<strong>Files You Selected:</strong>
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
				li.innerHTML = 'No Files Selected';
				ul.appendChild(li);
			}
		}
	</script>


	</TD>
	
	
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD>
<input type="submit" value="Upload Picture(s)" STYLE="Background-Color : #adffad"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo "$PHP_SELF?op=managePics&cid=$cid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel Upload</FONT></B></FONT></B></A><BR>
</TD>
	</TD></TR></TABLE>
	
	

<BR><cEnter>
</form>	
	

</TD></TR></TABLE>

<BR>

<!-- end multiupload.php -->