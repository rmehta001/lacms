<?php
//BEGIN hot_list_add //
	$return_page = isset($_GET['return_page']) ? $_GET['return_page'] : "";
	$item_type = isset($_GET['item_type']) ? $_GET['item_type'] : "";
	$item_id = isset($_GET['item_id']) ? $_GET['item_id'] : "";
	$item_id2 = isset($_GET['item_id2']) ? $_GET['item_id2'] : "";
	$page = "hot_list_add";
	switch ($item_type) {
		case 1:
			$item_icon = "home.gif";
			$disData2 = "ad";
			$cid = $item_id;
			break;
		case 2: 
			$item_icon = "handshake.gif";
			$disData2 = "deal";
			$did = $item_id;
			$cid = $item_id2;
			break;
		case 3: 
			$item_icon = "people.gif";
			$disData2 = "client";
			$clid = $item_id;
			break;
		
	}
//END hot_list_add //
?>