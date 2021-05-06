<?php
//BEGIN upload1tomany //
$mime = trim($userfile_type);
$cid = $_POST['cid'];
$desc = strip_tags($_POST['desc']);
                
$fileNameSplit = preg_split ('/\./', $userfile_name);
$arr_int=count($fileNameSplit)-1;
$ext = $fileNameSplit[$arr_int];
$result=false;

if ($ext=="jpg" | $ext=="gif" | $ext=="jpeg" | $ext=="png" | $ext=="JPG" | $ext=="GIF" | $ext=="JPEG" | $ext=="PNG")  {

	//SAVE FILE
	$f=basename($userfile);
	$saved_file=$picsTempDir.$f."_lacms_saved.".$ext;
	if (!move_uploaded_file($userfile, $saved_file)) {
		$msg = "Your picture has not been uploaded. Please make sure the file name is vaild, and the size is < 10MB.";
		$result=false;
	}
	else
	{
		$result=true;
	}
	$output=exec("/usr/bin/identify ".$saved_file);
	preg_match('/\S+lacms_saved\.\S+\s+\S+\s+(\d+)x(\d+)\D+(.*)/', $output, $matches);
	$x=$matches[1];
	$y=$matches[2];
	$display=basename($saved_file);
	$medium_file=preg_replace('/lacms_saved/', 'lacms_saved_m', $saved_file);
	$display_medium = basename($medium_file);
	$small_file=preg_replace('/lacms_saved/', 'lacms_saved_s', $saved_file);
	$display_small = basename($small_file);

	if(isset($_POST['watermark']))
	{
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



		$mklogo="/usr/bin/convert -size 250x50 xc:grey30 -pointsize 24 -gravity center -draw ".'"'."fill grey70 text 0,0 '".$name."'\" $picsTempDir/stamp_fgrnd_$grid.png";

		$mklogo2="/usr/bin/convert -size 250x50 xc:black -pointsize 24 -gravity center -draw \"fill white  text  1,1  '".$name."' text  0,0  '".$name."' fill black  text -1,-1 '".$name."'\" +matte $picsTempDir/stamp_mask_$grid.png";
		$mklogo3="/usr/bin/composite -compose CopyOpacity $picsTempDir/stamp_mask_$grid.png $picsTempDir/stamp_fgrnd_$grid.png  $picsTempDir/stamp_final_$grid.png ; rm $picsTempDir/stamp_mask_$grid.png $picsTempDir/stamp_fgrnd_$grid.png";
		exec($mklogo);
		exec($mklogo2);
		exec($mklogo3);
//		$wmark_cmd="/usr/bin/composite -gravity south -geometry +0+5 $picsTempDir/stamp_final_$grid.png";


if ($watermark_placement =="1") {
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

	$wmark_cleanup_cmd="rm $picsTempDir/stamp_mask_$grid.png $picsTempDir/stamp_fgrnd_$grid.png  $picsTempDir/stamp_final_$grid.png";
		
	} else {
		$wmark_cmd="";
	}
	if ( $x <= 0 | $y <= 0 )
	{
		$msg = "Unable to process picture information";
		$msg_err = true;
		$page = "upload";
		$result=false;
	}
	elseif (($x < $y) |( $x == $y))
	{
		if ( $y > 450 )
		{
			$ratio=$y/450;
			$y=450;
			$x = floor ( $x / $ratio);
			$command = "/usr/bin/convert -resize ".$x."x".$y." ".$watermark." ";
			$command = $command.$saved_file." ".$medium_file;
			$output=exec($command);
		}
		else
		{
			if(!copy($saved_file, $medium_file))
			{	$result=flase;	}
		}
		if ( $y > 250 )
		{
			$ratio=$y/250;
			$y=250;
			 $x = floor ( $x / $ratio);
                        $command = "/usr/bin/convert -resize ".$x."x".$y." ".$watermark." ";
                        $command = $command.$saved_file." ".$small_file;
                        $output=exec($command);
		}
		else
		{
                        if(!copy($saved_file, $small_file))
                        {       $result=flase;  }
		}
	}
	elseif ($x > $y)
	{
		if ( $x > 450 )
		{
			$ratio=$x/450;
			$x=450;
			$y = floor ( $y / $ratio );
			$command = "convert -resize ".$x."x".$y." ".$watermark." ";
			$command = $command.$saved_file." ".$medium_file;
			$output=exec($command);
		}
		else
		{
			if(!copy($saved_file, $medium_file))
                        {       $result=flase;  }
		}
		if ( $x > 250 )
                {
                        $ratio=$x/250;
                        $x=250;
                        $y = floor ( $y / $ratio );
                        $command = "convert -resize ".$x."x".$y." ".$watermark." ";
                        $command = $command.$saved_file." ".$small_file;
                        $output=exec($command);
		}
		else
		{
                        if(!copy($saved_file, $small_file))
                        {       $result=flase;  }
                }
	}
	else
	{ $result=false; }
	if($wmark_cmd!="")
	{
		$command2 = "cp $small_file $saved_file; $wmark_cmd $saved_file $small_file";
		 $output=exec($command2);
		$command3 = "cp $medium_file $saved_file; $wmark_cmd $saved_file $medium_file";
		$output3=exec($command3);
		$output4=exec($wmark_cleanup_cmd);
	}
	if ($result==false)
	{
		$page = "upload1tomany";
		$msg_err = true;
	}else {
		$page="uploadPreview1tomany";
//		$msg=$command2;
	}
}else {
	$page = "upload1tomany";
	$msg = "Your picture has not been uploaded. Please make sure the file name is vaild, and the size is < 10MB.";
	$msg_err = true;
}
//END uploadDo //
?>
