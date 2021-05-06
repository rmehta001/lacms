<?php
//BEGIN uploadDo //
$mime = trim($userfile_type);
$cid = $_POST['cid'];
$cli = $_POST['cli'];
$desc = strip_tags($_POST['desc']);

$landlord = $_POST['landlord'];
$street_num = $_POST['street_num'];
$street = $_POST['street'];


$file=$picsTempDir.$_POST['file'].$_POST['size'];


if (($landlord =="") or ($street_num =="") or ($street =="")){

if ($landlord =="") {
		$msg = "<font color=\"red\">Upload Unsuccessful - Missing Landlord</FONT>";
} elseif ($street_num =="")  {
			$msg = "<font color=\"red\">Upload Unsuccessful - Missing Street #</FONT>";
} elseif ($street =="")  {
			$msg = "<font color=\"red\">Upload Unsuccessful - Missing Street Name</FONT>";
	} else {
$msg = "<font color=\"red\">Upload Unsuccessful - Missing Landlord or Street Name or Street #</FONT>";
}
		$page = "managePics";
		
} else {

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
		
		
		
	
	$quStrGetUnits = "SELECT * FROM `CLASS` WHERE `LANDLORD`=\"$landlord\" AND `STREET_NUM`=\"$street_num\" AND `STREET`=\"$street\" AND `CLI`=\"$cli\"";



	$StrGetUnits = mysqli_query($dbh, $quStrGetUnits) or die (mysqli_error($dbh));
	while ($rowUnits = mysqli_fetch_object($StrGetUnits)) {



		$cid2 = $rowUnits->CID;
		
		
		$quStrAddPic = "INSERT INTO PICTURE (CID, EXT, DESCRIPT, UID) VALUES ($cid2 , '$ext', '$desc', $uid)";
		$quAddPic = mysqli_query($dbh, $quStrAddPic) or die ("insert picture query failed");
		$newPid = mysqli_insert_id($dbh);
	        $quStrUpClass = "UPDATE CLASS SET PIC=PIC+1 WHERE CID=$cid2";
		$quUpClass = mysqli_query($dbh, $quStrUpClass) or die ("can't update class");
		
		
	        $newFileName = "$picsDirectory/$newPid.$ext";




			if(copy("$picsTempDir".$_POST['size'], $newFileName))
			{
			$msg = "Upload Successful - copied";
			} else {
				$msg="ERROR";
			}

		}




}


		$page = "managePics";
		$msg = "Upload Successful Picture to all units at $street_num $street";
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

else
{
	$page = "upload";
	$msg = "uploadDo operation error";
	$msg_err = true;
}

}
//END uploadDo //
?>
