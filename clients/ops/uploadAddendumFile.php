<?php
//BEGIN Addendum //
	$lid = $_POST['lid'];

	$title = "Landlord Addenda";
	$mime = trim($userfile_type);
	$desc = strip_tags($_POST['desc']);
	$needOptions = true;
	$disData = "landlord";
	$page = "addendums";


// ==============

$uploaddir = "documents"; 

// Where you want the files to upload to 

//Important: Make sure this folders permissions is 0777!

$allowed_ext = "jpg, jpeg, gif, png, pdf, doc, txt, csv, zip, odt, docx, JPG, JPEG, GIF, PNG, PDF, DOC, TXT, CSV, ZIP, ODT, DOCX"; 

// These are the allowed extensions of the files that are uploaded

$max_size = "4000000"; 

// 50000 is the same as 50kb

$max_height = ""; 

// This is in pixels - Leave this field empty if you don't want to upload images

$max_width = ""; 

// This is in pixels - Leave this field empty if you don't want to upload images



// Check Entension

$extension = pathinfo($_FILES['file']['name']);

$extension = $extension[extension];

$allowed_paths = explode(", ", $allowed_ext);

for($i = 0; $i < count($allowed_paths); $i++) {

if ($allowed_paths[$i] == "$extension") {

$ok = "1";

}

}



// Check File Size

if ($ok == "1") {

if($_FILES['file']['size'] > $max_size)

{

	$msg = "<FONT COLOR=red>File size is too big!</FONT>";

exit;

}


// Check Height & Width

if ($max_width && $max_height) {

list($width, $height, $type, $w) = getimagesize($_FILES['file']['tmp_name']);

if($width > $max_width || $height > $max_height)

{

	$msg = "<FONT COLOR=red>File height and/or width are too big!</FONT>";
exit;
}

}



// The Upload Part

if(is_uploaded_file($_FILES['file']['tmp_name']))

{


$quStrAddPic = "INSERT INTO LANDLORD_ADDENDUM_FILE (LID, EXT, DESCRIPT, GID) VALUES ($lid , '$extension', '$desc', $grid)";
$quAddPic = mysqli_query($dbh, $quStrAddPic) or die ("insert picture query failed lid-$lid ext: $extension - PID: $newPid - GR: $grid - D:");
$newPid = mysqli_insert_id($dbh);

$newFileName = "$newPid.$extension";



move_uploaded_file($_FILES['file']['tmp_name'],$uploaddir.'/'.$newFileName);

}

$msg = "Your document was uploaded successfully";

} else {

	$msg = "<FONT COLOR=red>Incorrect file extension or other error with your chosen upload file.</FONT>";

}



//END Addendums //
?>