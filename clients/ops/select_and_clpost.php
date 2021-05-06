<?php
//BEGIN select_and_clpost //
	$sel_ids = $_POST['sel_ids'];
	$conf = $_POST['conf'];
	$numIDs = count($sel_ids);

	
	
	
	
		switch ($numIDs) {
		case 0:
	echo "case 0";
			break;
		case 1: 	echo "case 1";
		break;
		default:
	echo "case default";
			}

			
	
	
	if ($conf=='y' or $conf=='Y') {

		for ($i=1;$i<$numIDs;$i++){
			
	//		printf("<script>location.href='https://www.BostonApartments.com/clpost.php?ad=$sel_ids[$i]&cli=$grid&uid=$uid%20target=$sel_ids[$i]'</script>");
		
echo "test".$sel_ids[$i];

		
			}

		$page = "$return_page";

		
		$disData = "ads";
		$msg = "$numIDs ad(s) posted to Craigslist by $handle.";
		$title = "Selected";
	} else {
		$page = "listings";
		$msg = "No action taken,  please type 'y'";
		$msg_error = true;
		$title = "Select and Post to Craigslist";
	}
//END select_and_delete //
?>