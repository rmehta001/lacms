<?php
//BEGIN select_and_delete //
	$sel_ids = $_POST['sel_ids'];
	$conf = $_POST['conf'];
	$numIDs = count($sel_ids);


	switch ($numIDs) {
		case 0:
			$selWHERE = " WHERE 1=2";
			$hots_where = " WHERE 1=2";
			break;
		case 1: $selWHERE = " WHERE CID=$sel_ids[0] AND CLI='$grid'";
			$hots_where = "WHERE ITEM_TYPE=1 AND ITEM_ID=$sel_ids[0] AND GRID='$grid'";
			break;
		default:
			$selWHERE = " WHERE (CID=$sel_ids[0]";
			$hots_where = "WHERE ITEM_TYPE=1 AND (ITEM_ID=$sel_ids[0]";
			for ($i=1;$i<$numIDs;$i++){
				$string2Cat.= " OR CID=$sel_ids[$i] ";
				$string2CatHots.= " OR ITEM_ID=$sel_ids[$i] ";
			}
			$string2Cat.=" )AND CLI=$grid ";
			$string2CatHots.=" )AND GRID='$grid' ";
			$selWHERE.= $string2Cat;
			$hots_where.= $string2CatHots;
	}
	if ($conf=='y' or $conf=='Y') {
		$quStrDelHots = "DELETE FROM HOTS $hots_where";
		$quDelHots = mysqli_query($dbh, $quStrDelHots);
		
		$quStrSelAndDel = "DELETE FROM CLASS $selWHERE";
		$quSelAndDel = mysqli_query($dbh, $quStrSelAndDel) or die (dieNice ("Sorry, Multi-delete failed.", "E-116"));
		
		
		
		$page = "$return_page";

		
		$disData = "ads";
		$msg = "$numIDs ad(s) deleted by $handle.";
		$title = "Selected";
	}else {
		$page = "select_and_delete";
		$msg = "No action taken,  please type 'y'";
		$msg_error = true;
		$title = "Select and Delete";
	}
//END select_and_delete //
?>