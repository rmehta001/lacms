<?php
//BEING sel//

$app = "ad";


$page = "sel";
$disData = "ads";
$disData2 = "group";

$title = "Ad View";
$needOptions = true;
//END sel//



	if ($_SESSION ["level"]>0) {
		



	}else {
		$page = "upgrade";
		$msg = "This feature is not available to you at this time.";
		$msg_error = true;
	}



?>



