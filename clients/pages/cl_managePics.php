<!--BEGIN managePics -->
<?php

include ("../assets/buttons.php");

if ($pref_pagebg=="") {
$pagebgcolor="#F5F5DC";
} else {
$pagebgcolor="$pref_pagebg";
} 



?>

<span style="font-size:5px;"><BR></span>
<div align="left" style="padding:0px;margin:px;border:1px solid black;width:1000;background-color:#FFFFFF;font-family:Verdana,Arial,Helvetica;font-size:15px;color:black;">





<center>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
		<tr width=100%>
		<td align="left" colspan="8" valign="top"  height="1" bgcolor="#FFFFFF">
		
		<input type="hidden" name="cid" value="<?php echo "$cid";?>">





<CENTER>

<TABLE BGCOLOR="#FFFFFF" BORDER=0 WIDTH="90%"><TR>
<TD VALIGN="MIDDLE" ALIGN="CENTER">
<NOBR>

<?php

echo "<button onclick=\"window.open('https://www.BostonApartments.com/clpost.php?ad=$cid&cli=$grid&uid=$uid', 'asdas', 'toolbars=0,left=20,top=20,height=1200,width=1600,scrollbars=1,resizable=1');\" class=\"button-green pure-button\">CLICK HERE to Post To Craigslist</button>";


// echo "<input type=\"button\" STYLE=\"Background-Color : #ff0000\" onclick=\"window.open('https://www.BostonApartments.com/clpost.php?ad=$cid&cli=$grid&uid=$uid', 'asdas', 'toolbars=0,left=20,top=20,height=1200,width=1000,scrollbars=1,resizable=1');\" value=\"CLICK HERE to Post To Craigslist\">";
?>


 (in a new window) <I>if you use pop-up blockers, turn them off or allow pop-ups from BostonApartments.com</I>)</NOBR><BR>
It appears that craigslist sometimes blocks then unblocks the form filler above depending on the volume posting.

<?php


$file3 = "http://bostonapartments.com/clpost-htmlmaker.php?cli=".$grid."&ad=".$cid."&uid=".$uid;



// $file2 = file_get_contents('$file3');


/// echo "<iframe seamless height=250 width=100% scrolling=no src=".$file3."></iframe>"; 
?>


<BR>
<NOBR><B>THE PICTURES & LOCATION CODES FOR CRAIGSLIST ARE BELOW</NOBR>
<FONT SIZE="-1"><NOBR>You may cut and paste the address of the picture in CL when you hit the ADD IMAGES BUTTON</B></NOBR><BR>
<FONT COLOR=red><B>A quicker way to upload pictures is to save this page on your desktop.</B></font> (<i><font size=-2>ALT-F (File), Save or SaveAs from your browser to your desktop.</I>)</font> Within the new folder on your desktop will be a folder with all the images. Images can be selected (even multiple at the same time) and dragged to the Craigslist's drag area for multiple file upload vs. the uploading 1 at a time by copying the URL of the remote images.<BR>

<I>Some Browsers & Systems let your drag images between the windows, some don't.</I><BR></font>

</TD>
</TR></TABLE>






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

		
<img style="width:150;height:150;" id="img_<?php echo $rowGetPics->PID;?>" onClick="reveal_size('img_<?php echo $rowGetPics->PID;?>',<?php echo $real_width;?>, <?php echo $real_height;?>);" width="150" height="150" src="../../pics/<?php echo "$rowGetPics->PID.$rowGetPics->EXT"; ?>">



<BR><NOBR><FONT SIZE="-3">Code/File/Location<BR>(<I>Hit the Add Photo button on CL and copy and paste this into the file box on craigslist</I>):</NOBR></FONT><BR>
<NOBR><INPUT NAME="mytext<?php echo "$rowGetPics->PID";?>" TYPE="TEXT" SIZE="75" VALUE="http://www.bostonrealty.com/pics/<?php echo "$rowGetPics->PID.$rowGetPics->EXT"; ?>"></NOBR>
<BR>
</td></tr></table>
		<?php
		$counter++;
		if ((fmod($counter, 2))==0) {

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

<?php if (!($rowGetAd->EXTERNALPIC)) { ?>

<?php if ($user_level>0) {?>

<?php if ($rowGetAd->CLI==$grid AND $rowGetAd->CSOURCE==0) { ?>


<?php }}} ?>


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
echo "<tr align=\"center\" valign=\"top\"><td height=\"200\"><div align=\"center\" style=\"padding-left: 2px; padding-right: 2px; padding-top: 2px; padding-bottom: 2px;\">";
}
if ($k%2) {
echo "</TD><td height=\"200\"><div align=\"center\" style=\"padding-left: 2px; padding-right: 2px; padding-top: 2px; padding-bottom: 2px;\">";
}


list($width, $height, $type, $attr) = getimagesize("$MLSPIC");

if ($height >="200") {
				echo "<CENTER>

<A HREF='$MLSPIC' target='_bigpic'><img src='$MLSPIC' HEIGHT='200' BORDER=0></A></CENTER>";
} else {
				echo "<CENTER><A HREF='$MLSPIC' target='_bigpic'><img src='$MLSPIC' BORDER=0></A></CENTER>";
}

$k++;
}
echo "</TD></TR></TABLE></TD></TR></TABLE>";


if ($rowGetAd->PIC == "0"){
$foo = "bar";
} else { 

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
