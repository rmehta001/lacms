<?php 
//multiupload.php


$cid = $HTTP_GET_VARS['cid'];

?>
Multiple Picture Upload to Listing <?php echo $cid;?><BR>

<TABLE WIDTH="80%" BGCOLOR="#FFFFFF" CELLPADDING="4" BORDER="1" BORDERCOLOR="#000000"><TR><TD>


This form will upload multiple pictures to listing <?php echo $cid;?> (up to 10 at a time).<BR>You may choose a large or small size and whether to watermark the final images.<BR>
	</p>
	<p>
	
		<form enctype="multipart/form-data" action="<?php echo "$PHP_SELF?op=multiuploadDo&cid=$cid"; ?>" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value=" 20240000">
<center>
<TABLE><TR><TD VALIGN="TOP">
<CENTER>
<TABLE>
<TR><TD>
<NOBR><B>Image #1:</b></NOBR></td><TD>&nbsp;</TD></TR><TR>
<td valign="top" class="footer" align="right"><NOBR><b>*File Path:</b></NOBR></td>
    <td valign="top">
	<input id="userfile[]" name="userfile[]" type="file">
	</td>
  </tr>

<TR><TD>
<NOBR><B>Image #2:</b></NOBR></td><TD>&nbsp;</TD></TR><TR>
<td valign="top" class="footer" align="right"><NOBR><b>*File Path:</b></NOBR></td>
    <td valign="top">
	<input id="userfile[]" name="userfile[]" type="file">
	</td>
  </tr>

<TR><TD>
<NOBR><B>Image #3:</b></NOBR></td><TD>&nbsp;</TD></TR><TR>
<td valign="top" class="footer" align="right"><NOBR><b>*File Path:</b></NOBR></td>
    <td valign="top">
	<input id="userfile[]" name="userfile[]" type="file">
	</td>
  </tr>


<TR><TD>
<NOBR><B>Image #4:</b></NOBR></td><TD>&nbsp;</TD></TR><TR>
<td valign="top" class="footer" align="right"><NOBR><b>*File Path:</b></NOBR></td>
    <td valign="top">
	<input id="userfile[]" name="userfile[]" type="file">
	</td>
  </tr>

<TR><TD>
<NOBR><B>Image #5:</b></NOBR></td><TD>&nbsp;</TD></TR><TR>
<td valign="top" class="footer" align="right"><NOBR><b>*File Path:</b></NOBR></td>
    <td valign="top">
	<input id="userfile[]" name="userfile[]" type="file">
	</td>
  </tr>
</TABLE>

</TD><TD VALIGN="TOP">
&nbsp;&nbsp;&nbsp;&nbsp;
</TD><TD VALIGN="TOP">

<TABLE>
<TR><TD>
<NOBR><B>Image #6:</b></NOBR></td><TD>&nbsp;</TD></TR><TR>
<td valign="top" class="footer" align="right"><NOBR><b>*File Path:</b></NOBR></td>
    <td valign="top">
	<input id="userfile[]" name="userfile[]" type="file">
	</td>
  </tr>

<TR><TD>
<NOBR><B>Image #7:</b></NOBR></td><TD>&nbsp;</TD></TR><TR>
<td valign="top" class="footer" align="right"><NOBR><b>*File Path:</b></NOBR></td>
    <td valign="top">
	<input id="userfile[]" name="userfile[]" type="file">
	</td>
  </tr>

<TR><TD>
<NOBR><B>Image #8:</b></NOBR></td><TD>&nbsp;</TD></TR><TR>
<td valign="top" class="footer" align="right"><NOBR><b>*File Path:</b></NOBR></td>
    <td valign="top">
	<input id="userfile[]" name="userfile[]" type="file">
	</td>
  </tr>


<TR><TD>
<NOBR><B>Image #9:</b></NOBR></td><TD>&nbsp;</TD></TR><TR>
<td valign="top" class="footer" align="right"><NOBR><b>*File Path:</b></NOBR></td>
    <td valign="top">
	<input id="userfile[]" name="userfile[]" type="file">
	</td>
  </tr>

<TR><TD>
<NOBR><B>Image #10:</b></NOBR></td><TD>&nbsp;</TD></TR><TR>
<td valign="top" class="footer" align="right"><NOBR><b>*File Path:</b></NOBR></td>
    <td valign="top">
	<input id="userfile[]" name="userfile[]" type="file">
	</td>
  </tr>
</TABLE>

</TD></TR></TABLE>

<BR><cEnter>
<TABLE><TR><TD>

<span style="font-size:10px;">Picture size:

<?php

if ($rowGetGroup->PIC_CUSTOM_WIDTH) {
?>

Large<input type="radio" name="picsize" id="picsize" value="1"> Small<input type="radio" name="picsize" id="picsize" value="0"> Custom Width:<input type="radio" name="picsize" id="picsize" value="2" checked> <input id="pic_custom_width" type="text" name="pic_custom_width" size="5" value="<?php echo $rowGetGroup->PIC_CUSTOM_WIDTH;?>"></span>

<?php } else { ?>

Large<input type="radio" name="picsize" id="picsize" value="1" checked> Small<input type="radio" name="picsize" id="picsize" value="0"> Custom Width (px): <input type="radio" name="picsize" id="picsize" value="2"> <input id="pic_custom_width" type="text" name="pic_custom_width" size="5" value="<?php echo $rowGetGroup->PIC_CUSTOM_WIDTH;?>">

<?php } ?>

</span>

</TD><TD>
<span style="font-size:10px;">Watermark:  <NOBR><input type="checkbox" name="watermarkon" <?php if  ($watermark_on=="1") {echo " checked ";} ?>></SPAN>

</TD><TD>&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD>
<input type="submit" value="upload"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo "$PHP_SELF?op=managePics&cid=$cid";?>"><B><FONT COLOR="RED"><B><FONT COLOR="RED">Cancel Upload</FONT></B></FONT></B></A><BR>
</TD></TR></TABLE>
</CENTER>
</form>

</TD></TR></TABLE>
<BR>

<!-- end multiupload.php -->