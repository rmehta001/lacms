<?php
//BEGIN createllcommentDo //

  $PHP_SELF = $_SERVER['PHP_SELF']; 
	if ($_SESSION["level"]>4) {
	
	
	
	
		$llid = $_POST['llid'];
		$llcomment = $_POST['llcomment'];
		$llcomment_date = $now;


		
		$quStrAddllcomment = "INSERT INTO LANDLORD_COMMENTS (CLI, UID, HANDLE, LLID, LLCOMMENT_DATE, LLCOMMENT) VALUES ('$grid', '$uid', '$handle', '$llid', '$llcomment_date', '$llcomment')";
		$quAddllcomment = mysqli_query($dbh, $quStrAddllcomment) or die ($quStrAddllcomment);
		$page = "manageLandlords";

$quStrGC = "select * from LANDLORD where `LID`='$llid' AND `GRID`='$grid' LIMIT 1";
$quGC = mysqli_query($dbh, $quStrGC) or die (mysqli_error($dbh)); 
	while ($rowGC = mysqli_fetch_object($quGC)) {
$name_short = $rowGC->SHORT_NAME;
	$home_name_first = $rowGC->HOME_NAME_FIRST;
$home_name_last =  $rowGC->HOME_NAME_LAST;
	
}

		$msg = "New Landlord Comment Entry created for $name_short - $home_name_first $home_name_last by $handle.
				
		&nbsp;&nbsp;
		
		<a href=\"$PHP_SELF?op=editLandlord&lid=$llid\"><INPUT TYPE=\"SUBMIT\" VALUE=\"Edit $name_short - $home_name_first $home_name_last\"></a>

</NOBR>
	
		" ;
		
		
		$title = "manageLandlord";

		$sec_op = "manageLandlord";
		

		
	}else {		
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
	
	
//END createllcommentsDo //
?>