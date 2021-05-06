<?php
//BEGIN uploadDo //
$mime = trim($userfile_type);
$cid = $_POST['cid'];
$desc = strip_tags($_POST['desc']);
echo $grid;

$file=$picsTempDir.$_POST['file'].$_POST['size'];

if ( $_POST['size'] && $_POST['file'] && file_exists($picsTempDir.$size) ) 
{
	$file = $picsTempDir.$_POST['size'];
	$fileNameSplit = preg_split ('/\./', $file);
        $arr_int=count($fileNameSplit)-1;
        $ext = $fileNameSplit[$arr_int];
        $s="";
        if(preg_match('/lacms_saved_m/',$size)) {
                $s=preg_replace('/lacms_saved_m/', 'lacms_saved_s', $size);
        }elseif(preg_match('/lacms_saved_s/',$size)) {
                $s=preg_replace('/lacms_saved_s/', 'lacms_saved_m', $size);
        }else{
                $msg="filename mismatch error";
        }

	if($_POST['do']=="Save")
	{
		$quStrAddPic = "INSERT INTO PICTURE (CID, EXT, DESCRIPT, UID, GRID) VALUES ($cid , '$ext', '$desc', $uid , $grid)";
		$quAddPic = mysqli_query($dbh, $quStrAddPic) or die ("insert picture query failed");
		$newPid = mysqli_insert_id($dbh);
	        $quStrUpClass = "UPDATE CLASS SET PIC=PIC+1 WHERE CID=$cid";
		$quUpClass = mysqli_query($dbh, $quStrUpClass) or die ("can't update class");
	        $newFileName = "$picsDirectory/$newPid.$ext";

		if($s!="")
		{ 
			if(copy("$picsTempDir".$_POST['size'], $newFileName))
			{
				$m=$picsTempDir.$_POST['size'];
				$f=$picsTempDir.$_POST['file'];
				unlink($picsTempDir.$s);
				unlink($m);
				unlink($f);
			$msg = "Upload Successful";
			} else {
				$msg="ERROR";
			}

		}

		$page = "managePics";
		
	}
	elseif($_POST['do']=="Cancel")
	{
		$m=$picsTempDir.$_POST['size'];
		$f=$picsTempDir.$_POST['file'];
		unlink($picsTempDir.$s);
		unlink($m);
		unlink($f);
		$msg = "action canceled"; 
		$page = "managePics";
	}
}
else
{
	$page = "upload";
	$msg = "uploadDo operation error";
	$msg_err = true;
}
//END uploadDo //
?>
