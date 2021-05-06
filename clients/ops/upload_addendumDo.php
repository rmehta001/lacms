<?php
//BEGIN uploadDo //
$mime = trim($userfile_type);
$lid = $_POST['lid'];
$desc = strip_tags($_POST['desc']);

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
		$quStrAddPic = "INSERT INTO LANDLORD_ADDENDUM_FILE (LID, EXT, DESCRIPT, GID) VALUES ($lid , '$ext', '$desc', $grid)";
		$quAddPic = mysqli_query($dbh, $quStrAddPic) or die ("insert picture query failed");
		$newPid = $handle;
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
			$msg = "Document Upload Successful.";
			} else {
				$msg="ERROR - Document Upload was Unsuccessful.";
			}

		}

		$page = "home";
		
	}
	elseif($_POST['do']=="Cancel")
	{
		$m=$picsTempDir.$_POST['size'];
		$f=$picsTempDir.$_POST['file'];
		unlink($picsTempDir.$s);
		unlink($m);
		unlink($f);
		$msg = "action canceled"; 
		$page = "editPrefs";
	}
}
else
{
	$page = "editPrefs";
	$msg = "upload_addendumDo operation error";
	$msg_err = true;
}
//END uploadDo //
?>
