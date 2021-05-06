<?php
//BEGIN uploadDo //
$mime = trim($userfile_type);
$uid = $_POST['uid'];
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
		$quStrAddPic = "UPDATE USERS SET PICEXT='$ext' WHERE UID=$uid";
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
			$msg = "Agent Picture Upload Successful.";
			} else {
				$msg="ERROR - Agent Picture Upload was Unsuccessful.";
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
	$msg = "uploadagentDo operation error";
	$msg_err = true;
}
//END uploadDo //
?>
