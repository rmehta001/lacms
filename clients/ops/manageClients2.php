<?php
//BEGIN manageClients //
	session_register("clients_page");
	session_register("clients_sort");

	session_register("clients_filter_name_first");
	session_register("clients_filter_name_last");
	session_register("clients_filter_type");
	session_register("clients_filter_loc_pref");
	session_register("clients_price_min");
	session_register("clients_price_max");
	session_register("clients_filter_nc_month");
	session_register("clients_filter_nc_day");
	session_register("clients_filter_nc_year");
	session_register("clients_filter_phone");
	session_register("clients_filter_email");
	session_register("clients_filter_status_client");
	session_register("clients_filter_furnishedon");
	session_register("clients_filter_shorttermon");
	session_register("clients_filter_pets");
	session_register("clients_filter_beds");
	session_register("clients_filter_baths");
	session_register("clients_filter_agent");

	if ($HTTP_GET_VARS['clients_page']) {
		$clients_page = $HTTP_GET_VARS['clients_page'];
		if (!$clients_page || $clients_page < 0) {
			$clients_page = 1;
		}
	}else {
		if (!$clients_page) {
			$clients_page = 1;
		}
	
	}

	
	$clients_limit_n = 20;
	$clients_limit_start = ($clients_page * $clients_limit_n) - $clients_limit_n;
	$clients_limit = "limit $clients_limit_start, $clients_limit_n";
	if ($_GET['show_all_clients']) {
		$clients_limit = "";
	}
	
	if ($_GET['clients_sort']) {
		$clients_sort = $_GET['clients_sort'];
	}else {
		if (!$clients_sort) {
			$clients_sort = "NAME_LAST";
		}
	}


if (!$HTTP_GET_VARS['SortDir']) {
	if (!$SortDir) {
		$SortDir = "ASC";
	}
} else {
	$SortDir = $HTTP_GET_VARS['SortDir'];
}



	$clients_order_by = "order by $clients_sort $SortDir";
	
	
	if ($_GET['clients_filter']) {
		$clients_filter_name_last = $_GET['clients_filter_name_last'];
		$clients_filter_name_first = $_GET['clients_filter_name_first'];
		$clients_filter_type = $_GET['clients_filter_type'];
		$clients_filter_loc_pref = $_GET['clients_filter_loc_pref'];
		$clients_filter_price_min = $_GET['clients_filter_price_min'];
		$clients_filter_price_max = $_GET['clients_filter_price_max'];
		$clients_filter_nc_month = $_GET['clients_filter_nc_month'];
		$clients_filter_nc_day = $_GET['clients_filter_nc_day'];
		$clients_filter_nc_year = $_GET['clients_filter_nc_year'];
		$clients_filter_phone = $_GET['clients_filter_phone'];
		$clients_filter_email = $_GET['clients_filter_email'];
		$clients_filter_status_client = $_GET['clients_filter_status_client'];

		$clients_filter_furnishedon = $_GET['clients_filter_furnishedon'];
		$clients_filter_shorttermon = $_GET['clients_filter_shorttermon'];		
		$clients_filter_pets = $_GET['clients_filter_pets'];				
		$clients_filter_beds = $_GET['clients_filter_beds'];				
		$clients_filter_baths = $_GET['clients_filter_baths'];	
		
				$clients_filter_agent = $_GET['clients_filter_agent'];	
	}
	
	$clients_where = "where GRID='$grid'";

	if ($clients_filter_agent) {
		$clients_where .= " and CLIENTS.UID ='$clients_filter_agent'";
	}

	if ($clients_filter_name_last) {
		$clients_where .= " and NAME_LAST like \"$clients_filter_name_last%\" ";
	}
	
	if ($clients_filter_name_first) {
		$clients_where .= " and NAME_FIRST like \"$clients_filter_name_first%\" ";
	}
	
	if ($clients_filter_type) {
		$clients_where .= " and TYPE_PREF='$clients_filter_type'";
	}
	
	if ($clients_filter_loc_pref) {
		$clients_where .= " and LOC_PREF='$clients_filter_loc_pref'";
	}

	if ($clients_filter_price_min) {
		$clients_where .= " and PRICEMIN >= $clients_filter_price_min";
	}
	
	if ($clients_filter_price_max) {
		$clients_where .= " and PRICEMAX <= $clients_filter_price_max";
	}
	
	if ($clients_filter_nc_month && $clients_filter_nc_day && $clients_filter_nc_year) {
		$nc = "$clients_filter_nc_year-$clients_filter_nc_month-$clients_filter_nc_day";
		$clients_where .= " and DATE_NEXT_CONTACT <='$date_next_contact'";
	}


	if ($clients_filter_phone) {
$clients_where .= " and HOME_PHONE like \"%$clients_filter_phone%\" OR GRID=$grid AND WORK_PHONE like \"%$clients_filter_phone%\" OR  GRID=$grid AND MOBILE_PHONE like \"%$clients_filter_phone%\"";

}


	if ($clients_filter_email) {
$clients_where .= " and CLIENT_EMAIL like \"%$clients_filter_email%\"";
}


	if ($clients_filter_status_client) {
$clients_where .= " and STATUS_CLIENT = $clients_filter_status_client";}


	if ($clients_filter_furnishedon) {
$clients_where .= " and CLIENT_FURNISHED=\"$clients_filter_furnishedon\"";
}

	if ($clients_filter_shorttermon) {
$clients_where .= " and CLIENT_SHORTTERM=\"$clients_filter_shorttermon\"";
}

	if ($clients_filter_pets) {
$clients_where .= " and PETS_PREF>=\"2\"";
}



	if ($clients_filter_beds) {
		
if ($clients_filter_beds=="0") {
$clients_where .= " and (ROOMS_PREF>=\"0\" AND ROOMS_PREF<\"1\")";
}

if ($clients_filter_beds=="1") {
$clients_where .= " and (ROOMS_PREF>=\"1\" AND ROOMS_PREF<\"2\")";
}

if ($clients_filter_beds=="2") {
$clients_where .= " and (ROOMS_PREF>=\"2\" AND ROOMS_PREF<\"3\")";
}

if ($clients_filter_beds=="3") {
$clients_where .= " and (ROOMS_PREF>=\"3\" AND ROOMS_PREF<\"4\")";
}

if ($clients_filter_beds=="4") {
$clients_where .= " and (ROOMS_PREF>=\"4\" AND ROOMS_PREF<\"5\")";
}

if ($clients_filter_beds=="5") {
$clients_where .= " and (ROOMS_PREF>=\"5\" AND ROOMS_PREF<\"6\")";
}

if ($clients_filter_beds=="6") {
$clients_where .= " and (ROOMS_PREF>=\"6\" AND ROOMS_PREF<\"7\")";
}

if ($clients_filter_beds=="7") {
$clients_where .= " and (ROOMS_PREF>=\"7\" AND ROOMS_PREF<\"8\")";
}

if ($clients_filter_beds=="8") {
$clients_where .= " and (ROOMS_PREF>=\"8\" AND ROOMS_PREF<\"9\")";
}

if ($clients_filter_beds=="9") {
$clients_where .= " and (ROOMS_PREF>=\"9\" AND ROOMS_PREF<\"10\")";
}

if ($clients_filter_beds=="10") {
$clients_where .= " and (ROOMS_PREF>=\"10\" AND ROOMS_PREF<\"11\")";
}



}



	if ($clients_filter_baths) {
		
if ($clients_filter_baths=="0") {
$clients_where .= " and (BATH_PREF>=\"0\" AND BATH_PREF<\"1\")";
}

if ($clients_filter_baths=="1") {
$clients_where .= " and (BATH_PREF>=\"1\" AND BATH_PREF<\"2\")";
}

if ($clients_filter_baths=="2") {
$clients_where .= " and (BATH_PREF>=\"2\" AND BATH_PREF<\"3\")";
}

if ($clients_filter_baths=="3") {
$clients_where .= " and (BATH_PREF>=\"3\" AND BATH_PREF<\"4\")";
}

if ($clients_filter_baths=="4") {
$clients_where .= " and (BATH_PREF>=\"4\" AND BATH_PREF<\"5\")";
}

if ($clients_filter_baths=="5") {
$clients_where .= " and (BATH_PREF>=\"5\" AND BATH_PREF<\"6\")";
}

if ($clients_filter_baths=="6") {
$clients_where .= " and (BATH_PREF>=\"6\" AND BATH_PREF<\"7\")";
}

if ($clients_filter_baths=="99") {
$clients_where .= " and (BATH_PREF>=\"99\")";
}

}



	
	if ($level>4) {
		$page = "manageClients2";
		$title = "Manage Clients";

		$disData = "clients";
		$disData2 = "user";
		
	}else {
		$page = "home";
		$msg = "Sorry, that functionality isn't available";
		$msg_error = true;
	}
	$needOptions = true;
//END manageClients //
?>