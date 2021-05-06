<?php
//BEGIN uploadDo //
$mime = trim($userfile_type);
$cid = $_POST['cid'];
$uid = $_POST['uid'];

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

		$mklogo="/usr/bin/convert -size 250x50 xc:grey30 -pointsize 24 -gravity center -draw ".'"'."fill grey70 text 0,0 '".$name."'\" $picsTempDir/stamp_fgrnd_$grid.png";

		$mklogo2="/usr/bin/convert -size 250x50 xc:black -pointsize 24 -gravity center -draw \"fill white  text  1,1  '".$name."' text  0,0  '".$name."' fill black  text -1,-1 '".$name."'\" +matte $picsTempDir/stamp_mask_$grid.png";
		$mklogo3="/usr/bin/composite -compose CopyOpacity $picsTempDir/stamp_mask_$grid.png $picsTempDir/stamp_fgrnd_$grid.png  $picsTempDir/stamp_final_$grid.png ; rm $picsTempDir/stamp_mask_$grid.png $picsTempDir/stamp_fgrnd_$grid.png";
		exec($mklogo);
		exec($mklogo2);
		exec($mklogo3);
//		$wmark_cmd="/usr/bin/composite -gravity south -geometry +0+5 $picsTempDir/stamp_final_$grid.png";
		$wmark_cmd="/usr/bin/composite -gravity south -geometry +0+5  -compose src-over $picsTempDir/stamp_final_$grid.png";
		$wmark_cleanup_cmd="rm $picsTempDir/stamp_mask_$grid.png $picsTempDir/stamp_fgrnd_$grid.png  $picsTempDir/stamp_final_$grid.png";
		
	} else {
		$wmark_cmd="";
	}
	if ( $x <= 0 | $y <= 0 )
	{
		$msg = "Unable to process picture information";
		$msg_err = true;

if ($returnpage == "editUser") {
	$page = "editUser";
} else {
	$page = "editPrefs";
}
		$result=false;
	}
	elseif (($x < $y) |( $x == $y))
	{
		if ( $y > 225 )
		{
			$ratio=$y/225;
			$y=225;
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
		if ( $y > 125 )
		{
			$ratio=$y/125;
			$y=125;
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
		if ( $x > 225 )
		{
			$ratio=$x/225;
			$x=225;
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
		if ( $x > 125 )
                {
                        $ratio=$x/125;
                        $x=125;
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
if ($returnpage == "editUser") {
	$page = "editUser";
} else {
	$page = "editPrefs";
}
		$msg_err = true;
	}else {
		$page="uploadagentPreview";
//		$msg=$command2;
	}
}else {

if ($returnpage == "editUser") {
	$page = "editUser";
} else {
	$page = "editPrefs";
}


	$msg = "<FONT COLOR=RED>Your picture has not been uploaded.</FONT> Please make sure the file name is vaild, and the size is < 10MB.";
	$msg_err = true;
}
//END uploadDo //
?>
