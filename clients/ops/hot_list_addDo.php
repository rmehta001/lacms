<?php
//BEGIN hot_list_addDo //
	$return_page = isset($_GET['return_page']) ? $_GET['return_page'] : "";
	$item_type = isset($_GET['item_type']) ? $_GET['item_type'] : "";
	$item_id = isset($_GET['item_id']) ? $_GET['item_id'] : "";
	$item_id2 = isset($_GET['item_id2']) ? $_GET['item_id2'] : "";
	$item_name = isset($_GET['item_name']) ? $_GET['item_name'] : "";

	$public = isset($_GET['public']) ? $_GET['public'] : "";
	
	$quStrHotListAdd = "INSERT INTO HOTS (UID, GRID, PUBLIC, ITEM_TYPE, ITEM_ID, ITEM_ID2, ITEM_NAME) VALUES ('$uid', '$grid', '$public', '$item_type', '$item_id', '$item_id2', '$item_name')";
	$quHotListAdd = mysqli_query($GLOBALS['dbh'], $quStrHotListAdd);
	switch ($item_type) {
		case 1:
			$hot_list_cat = "listings";
			break;
		case 2: 
			$hot_list_cat = "deals";
			break;
		case 3: 
			$hot_list_cat = "clients";
	}
	
	$return_page_go = true;
//END hot_list_addDo //
?>