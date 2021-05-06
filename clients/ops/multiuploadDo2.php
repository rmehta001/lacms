<?php
//BEGIN multiuploadDo //


$pic_custom_width = $_POST['pic_custom_width'];

$picsize = $_POST['picsize'];
if(isset($_POST['watermarkon']))
{ $watermark="1"; }
$page = "multiupload";
$title = "Manage Pictures";
$disData = "pics";
$disData2 = "group";


if($_POST['picsize']=="2") {
	$target_size=$pic_custom_width;


} elseif($_POST['picsize']=="1")
{
	$target_size=450;
} else {
       $target_size=250;
}


$watermark_string="";
if($watermark=="1")
{
   $groupSqlStr="SELECT * FROM `GROUP` WHERE GRID=$grid";
   $groupSqlObj=mysqli_query($dbh, $groupSqlStr);
   $groupArr=mysqli_fetch_object($groupSqlObj);


if(!preg_match('/\S+/',$groupArr->WATERMARK))
   {
      $watermark_string=preg_replace('/\n/','', $groupArr->NAME);
   } else {
     $watermark_string=preg_replace('/\n/','', $groupArr->WATERMARK);
   }
}

function mkwmark($watermark_string,$picsTempDir,$grid)
{
   $mklogo="/usr/bin/convert -size 250x50 xc:grey30 -pointsize 24 -gravity center -draw ".'"'."fill grey70 text 0,0 '".$watermark_string."'\" $picsTempDir/stamp_fgrnd_$grid.png";
   $mklogo2="/usr/bin/convert -size 250x50 xc:black -pointsize 24 -gravity center -draw \"fill white  text  1,1  '".$watermark_string."' text  0,0  '".$watermark_string."' fill black  text -1,-1 '".$watermark_string."'\" +matte $picsTempDir/stamp_mask_$grid.png";
   $mklogo3="/usr/bin/composite -compose CopyOpacity $picsTempDir/stamp_mask_$grid.png $picsTempDir/stamp_fgrnd_$grid.png  $picsTempDir/stamp_final_$grid.png ; rm $picsTempDir/stamp_mask_$grid.png $picsTempDir/stamp_fgrnd_$grid.png";
   exec($mklogo);
   exec($mklogo2);
   exec($mklogo3);


   $groupSqlStr2="SELECT * FROM `GROUP` WHERE GRID=$grid";
   $groupSqlObj2=mysqli_query($dbh, $groupSqlStr2);
   $groupArr2=mysqli_fetch_object($groupSqlObj2);

$watermark_placement=preg_replace('/\n/','', $groupArr2->WATERMARK_PLACEMENT);

if ($watermark_placement == "1" ) {
$wmark_cmd="/usr/bin/composite -gravity center -geometry +0+5  -compose src-over $picsTempDir/stamp_final_$grid.png";
} elseif ($watermark_placement =="2") {
	$wmark_cmd="/usr/bin/composite -gravity northwest -geometry +0+5  -compose src-over $picsTempDir/stamp_final_$grid.png";
} elseif ($watermark_placement =="3") {
	$wmark_cmd="/usr/bin/composite -gravity northeast -geometry +0+5  -compose src-over $picsTempDir/stamp_final_$grid.png";
} elseif ($watermark_placement =="4") {
	$wmark_cmd="/usr/bin/composite -gravity east -geometry +0+5  -compose src-over $picsTempDir/stamp_final_$grid.png";
} elseif ($watermark_placement =="5") {
	$wmark_cmd="/usr/bin/composite -gravity west -geometry +0+5  -compose src-over $picsTempDir/stamp_final_$grid.png";
} elseif ($watermark_placement =="6") {
	$wmark_cmd="/usr/bin/composite -gravity north -geometry +0+5  -compose src-over $picsTempDir/stamp_final_$grid.png";
} elseif ($watermark_placement =="7") {
	$wmark_cmd="/usr/bin/composite -gravity southeast -geometry +0+5  -compose src-over $picsTempDir/stamp_final_$grid.png";
} elseif ($watermark_placement =="8") {
	$wmark_cmd="/usr/bin/composite -gravity southwest -geometry +0+5  -compose src-over $picsTempDir/stamp_final_$grid.png";

} else {
$wmark_cmd="/usr/bin/composite -gravity south -geometry +0+5  -compose src-over $picsTempDir/stamp_final_$grid.png";
}

   
   exec($wmark_cmd);
   $wmark_cleanup_cmd="rm $picsTempDir/stamp_final_$grid.png";
   return $wmark_cmd;
}

if($watermark_string!="")
{
	$wmark_cmd=mkwmark($watermark_string,$picsTempDir,$grid);
}

if($_FILES)
{


   while(list($key,$value) = each($_FILES[userfile][name]))
   {
      if(!empty($value))
      { 
	 $tmp_filename=$_FILES[userfile][tmp_name][$key];
	 $filename=$_FILES[userfile][name][$key];
	 $fileNameSplit = preg_split ('/\./', $filename);
	 $arr_int=count($fileNameSplit)-1;
	 $ext = $fileNameSplit[$arr_int];
	 $result=false;
	 if ($ext=="jpg" | $ext=="gif" | $ext=="jpeg" | $ext=="png" | $ext=="JPG" | $ext=="GIF" | $ext=="JPEG" | $ext=="PNG")  
	 {
	    $output=exec("/usr/bin/identify ".$tmp_filename);
	    $x=0;
	    $y=0;
	    preg_match('/\/tmp\/(php\S+) (\S+)\s+(\d+)x(\d+)\D+(.*)/', $output, $matches);
	    $tmpbasename=$matches[1];
	    $tmpextention=$matches[2];
	    $x=$matches[3];
            $y=$matches[4];
	    $target_tmp_file=$picsTempDir."original_".$tmpbasename.".".$ext;
	    if($x>0 && $y>0)
	    {
	      move_uploaded_file($tmp_filename, $target_tmp_file);
	      $x_target="";
	      $y_target="";
	      if (($x < $y) |( $x == $y))
	      {
		if($y > $target_size)
		{
		   $ratio=$y/$target_size;
		   $y_target=$target_size;
		   $x_target = floor ($x/$ratio);
		} 
	      } else {
	      	$ratio=$x/$target_size;
		$x_target=$target_size;
		$y_target = floor ($y/$ratio);
	      }
	      $target_tmp_resize=$picsTempDir."resized_".$tmpbasename.".".$ext;
	      if($x_target!="" && $y_target!="")
	      {
		$resize_cmd="/usr/bin/convert -resize "
		     .$x_target."x".$y_target.
		     " $target_tmp_file $target_tmp_resize";
	      } else {
	      	$resize_cmd="/bin/cp $target_tmp_file $target_tmp_resize";
	      }
	      $resize_output=exec($resize_cmd);
	      if(!is_file($picsTempDir."/stamp_final_".$gid.".png"))
	      {
		$wmark_cmd=mkwmark($watermark_string,$picsTempDir,$grid);
	      }
	      if($watermark_string!="" && $wmark_cmd!="")
	      {
		$tmp_mark_file=$picsTempDir."tmp_".$tmpbasename.".".$ext;
		$wmark_cmd1="cp $target_tmp_resize $tmp_mark_file";
		$wmark_cmd2="$wmark_cmd $tmp_mark_file $target_tmp_resize";
		$wmark_cmd3="rm $tmp_mark_file";
		exec($wmark_cmd1);
		exec($wmark_cmd2);
		exec($wmark_cmd3);
	      }
	      if(is_file($target_tmp_resize))
	      {
	         $quStrAddPic = "INSERT INTO PICTURE (CID, EXT, UID) VALUES ($cid , '$ext', $uid)";
		 $quAddPic = mysqli_query($dbh, $quStrAddPic);
		 $newPid = mysqli_insert_id($dbh);
		 $quStrUpClass = "UPDATE CLASS SET PIC=PIC+1 WHERE CID=$cid";
		 $quUpClass = mysqli_query($dbh, $quStrUpClass);
		 $newFileName = "$picsDirectory/$newPid.$ext";
		 copy($target_tmp_resize, $newFileName);
		 unlink($target_tmp_resize);
		 unlink($target_tmp_file);
		 $page="managePics";
	      } else {
	      	$msg.=$filename." can not be processed. ";
		$msg_err="true";
	      }
	    } else {
	      $msg.=$filename." can not be processed. ";
	      $msg_err="true";
	    }
	 } else {
	   $msg="unsuported file type";
	   $msg_err=true;
	 }  
      }
   }
}
if(is_file("$picsTempDir/stamp_final_$grid.png"))
{
	unlink("$picsTempDir/stamp_final_$grid.png");
}

//END uploadDo //
?>
