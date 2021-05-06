<?php
//   if( $degrees > 0 && is_file("$picsDirectory/$pid.$ext"))
//   {
//      $command="/usr/bin/convert -rotate $degrees $picsDirectory/$pid.$ext /tmp/$pid.$ext";
//      $output=exec($command);
  $groupSqlStr="SELECT * FROM `GROUP` WHERE GRID=$grid";
  $groupSqlObj=mysqli_query($dbh, $groupSqlStr);
  $groupArr=mysqli_fetch_object($groupSqlObj);
  $name=preg_replace('/\n/','', $groupArr->NAME);
  $watermark=preg_replace('/\n/','', $groupArr->WATERMARK);


$watermark_placement=preg_replace('/\n/','', $groupArr->WATERMARK_PLACEMENT);



  if ($watermark!="")
  {
$name=$watermark;
   }


if ($name!="")

  {
     $mklogo="/usr/bin/convert -size 250x50 xc:grey30 -pointsize 24 -gravity center -draw ".'"'."fill grey70 text 0,0 '".$name."'\" $picsTempDir/stamp_fgrnd_$grid.png";
     $mklogo2="/usr/bin/convert -size 250x50 xc:black -pointsize 24 -gravity center -draw \"fill white  text  1,1  '".$name."' text  0,0  '".$name."' fill black  text -1,-1 '".$name."'\" +matte $picsTempDir/stamp_mask_$grid.png";
     $mklogo3="/usr/bin/composite -compose CopyOpacity $picsTempDir/stamp_mask_$grid.png $picsTempDir/stamp_fgrnd_$grid.png  $picsTempDir/stamp_final_$grid.png ; rm $picsTempDir/stamp_mask_$grid.png $picsTempDir/stamp_fgrnd_$grid.png";
     exec($mklogo);
     exec($mklogo2);
     exec($mklogo3);
//	echo "$mklogo<hr>$mklogo2<hr>$mklogo3<hr>";

if ($watermark_placement =="1") {
$wmark_cmd="/usr/bin/composite -gravity center -geometry +0+5 -compose src-over $picsTempDir/stamp_final_$grid.png $picsDirectory/$pid.$ext /tmp/$pid.$ext";
} elseif ($watermark_placement =="2") {
$wmark_cmd="/usr/bin/composite -gravity northwest -geometry +0+5 -compose src-over $picsTempDir/stamp_final_$grid.png $picsDirectory/$pid.$ext /tmp/$pid.$ext";
} elseif ($watermark_placement =="3") {
$wmark_cmd="/usr/bin/composite -gravity northeast -geometry +0+5 -compose src-over $picsTempDir/stamp_final_$grid.png $picsDirectory/$pid.$ext /tmp/$pid.$ext";
} elseif ($watermark_placement =="4") {
$wmark_cmd="/usr/bin/composite -gravity east -geometry +0+5 -compose src-over $picsTempDir/stamp_final_$grid.png $picsDirectory/$pid.$ext /tmp/$pid.$ext";
} elseif ($watermark_placement =="5") {
$wmark_cmd="/usr/bin/composite -gravity west -geometry +0+5 -compose src-over $picsTempDir/stamp_final_$grid.png $picsDirectory/$pid.$ext /tmp/$pid.$ext";
} elseif ($watermark_placement =="6") {
$wmark_cmd="/usr/bin/composite -gravity north -geometry +0+5 -compose src-over $picsTempDir/stamp_final_$grid.png $picsDirectory/$pid.$ext /tmp/$pid.$ext";
} elseif ($watermark_placement =="7") {
$wmark_cmd="/usr/bin/composite -gravity southeast -geometry +0+5 -compose src-over $picsTempDir/stamp_final_$grid.png $picsDirectory/$pid.$ext /tmp/$pid.$ext";
} elseif ($watermark_placement =="8") {
$wmark_cmd="/usr/bin/composite -gravity southwest -geometry +0+5 -compose src-over $picsTempDir/stamp_final_$grid.png $picsDirectory/$pid.$ext /tmp/$pid.$ext";
} else {
$wmark_cmd="/usr/bin/composite -gravity south -geometry +0+5 -compose src-over $picsTempDir/stamp_final_$grid.png $picsDirectory/$pid.$ext /tmp/$pid.$ext";
}

//	echo "<hr>$wmark_cmd<hr>";
     $wmark_cleanup_cmd="rm $picsTempDir/stamp_mask_$grid.png $picsTempDir/stamp_fgrnd_$grid.png  $picsTempDir/stamp_final_$grid.png";
     exec($wmark_cmd);
     exec($wmark_cleanup_cmd);
     if(is_file("/tmp/$pid.$ext"))
     {
		$command="/bin/mv /tmp/$pid.$ext $picsDirectory/$pid.$ext";
		$output=exec($command);
     }
     $page = "watermarkRedirect";
     $msg = "Watermarking picture # $pid for ad # $cid";
   } else {
	$page = "watermarkRedirect";
	$msg="<font color=red>error while watermarking picture # $pid for ad # $cid</font>";
	$msg_err = true;
   }
?>
