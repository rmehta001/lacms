<?php
//changes done by Tanvi//
//BEGIN manageClients //
	if(isset($_SESSION ["clients_page"]))
        {
            $clients_page=$_SESSION["clients_page"];
        }
        if(isset($_SESSION ["clients_sort"]))
        {
           $clients_sort= $_SESSION["clients_sort"];
        }
     
        $clients_filter_name_first= (isset ($_SESSION["clients_filter_name_first"]));
        $clients_filter_name_last= (isset ($_SESSION["clients_filter_name_last"]));
	$clients_filter_type= (isset ($_SESSION["clients_filter_type"]));
	$clients_filter_loc_pref= (isset ($_SESSION["clients_filter_loc_pref"]));
	$clients_filter_price_min= (isset ($_SESSION["clients_filter_price_min"]));
	$clients_filter_price_max= (isset ($_SESSION["clients_filter_price_max"]));
	$clients_filter_nc_month= (isset ($_SESSION["clients_filter_nc_month"]));
	$clients_filter_nc_day= (isset ($_SESSION["clients_filter_nc_day"]));
	$clients_filter_nc_year= (isset ($_SESSION["clients_filter_nc_year"]));
	$clients_filter_phone= (isset ($_SESSION["clients_filter_phone"]));
	$clients_filter_email= (isset ($_SESSION["clients_filter_email"]));
	$clients_filter_status_client= (isset ($_SESSION["clients_filter_status_client"]));
	$clients_filter_furnishedon= (isset ($_SESSION["clients_filter_furnishedon"]));
	$clients_filter_shorttermon= (isset ($_SESSION["clients_filter_shorttermon"]));
	$clients_filter_pets= (isset ($_SESSION["clients_filter_pets"]));
	$clients_filter_beds= (isset ($_SESSION["clients_filter_beds"]));
	$clients_filter_baths= (isset ($_SESSION["clients_filter_baths"]));
	$clients_filter_agent= (isset ($_SESSION["clients_filter_agent"]));
	$clients_filter_source= (isset ($_SESSION["clients_filter_source"]));
	$clients_filter_subtype= (isset ($_SESSION["clients_filter_subtype"]));
	$clients_filter_building_pref= (isset ($_SESSION["clients_filter_building_pref"]));
        
	$clients_leadsafe= (isset ($_SESSION ["clients_leadsafe"]));
        $SortDir= (isset ($_SESSION ["SortDir"]));

      /*  if(isset($_SESSION ["SortDir"]))
        {
           $SortDir= $_SESSION["SortDir"];
        }
        if(isset($_SESSION ["clients_leadsafe"]))
        {
           $clients_leadsafe= $_SESSION["clients_leadsafe"];
        }
       * /
       */
        
	if (isset ($_GET['clients_page'])) {
		$clients_page = $_GET['clients_page'];
		if (!$clients_page || $clients_page < 0) {
			$clients_page = 1;
		}
	}else {
		if (!isset($_SESSION["clients_page"])) {
			$clients_page = 1;
		}
	
	}

	
	$clients_limit_n = 20;
	$clients_limit_start = ($clients_page * $clients_limit_n) - $clients_limit_n;
        //$clients_limit_n = $clients_limit_start + $clients_limit_n;
	$clients_limit = "limit $clients_limit_start, $clients_limit_n";
	if (isset ($_GET['show_all_clients'])) {
		$clients_limit = "";
	}
//	echo $clients_limit;
	if (isset($_GET['clients_sort'])) {
		$clients_sort = $_GET['clients_sort'];
	}else {
		if (!isset($_SESSION["clients_sort"])) {
			$clients_sort = "NAME_LAST";
		}
	}


if (!isset ($_GET['SortDir'])) {
	if (isset ($_GET[!'SortDir'])) {
		$SortDir = "ASC";
	}
} else {
	$SortDir = (isset($_GET['SortDir']))?$_GET['SortDir']:"ASC";
}
        //echo $SortDir;


	$clients_order_by = "order by $clients_sort $SortDir";
	
	
	if (isset ($_GET['clients_filter'])) {
            $clients_filter_name_last = isset($_GET['clients_filter_name_last'])? $_GET['clients_filter_name_last'] : "";
		$clients_filter_name_first = isset($_GET['clients_filter_name_first'])? $_GET['clients_filter_name_first'] : "";
               $clients_filter_type = isset($_GET['clients_filter_type'])? $_GET['clients_filter_type'] : "";
	$clients_filter_loc_pref  = isset($_GET['clients_filter_loc_pref'])? $_GET['clients_filter_loc_pref'] : "";
	$clients_filter_price_min = isset($_GET['clients_filter_price_min'])? $_GET['clients_filter_price_min'] : "";
	$clients_filter_price_max = isset($_GET['clients_filter_price_max'])? $_GET['clients_filter_price_max'] : "";
	$clients_filter_nc_month = isset($_GET['clients_filter_nc_month'])? $_GET['clients_filter_nc_month'] : "";
	$clients_filter_nc_day = isset($_GET['clients_filter_nc_day'])? $_GET['clients_filter_nc_day'] : "";
	$clients_filter_nc_year = isset($_GET['clients_filter_nc_year'])? $_GET['clients_filter_nc_year'] : "";
	$clients_filter_phone = isset($_GET['clients_filter_phone'])? $_GET['clients_filter_phone'] : "";
	$clients_filter_email = isset($_GET['clients_filter_email'])? $_GET['clients_filter_email'] : "";
	$clients_filter_status_client = isset($_GET['clients_filter_status_client'])? $_GET['clients_filter_status_client'] : "";
        
	$clients_filter_furnishedon = isset($_GET['clients_filter_furnishedon'])? $_GET['clients_filter_furnishedon'] : "";
	$clients_filter_shorttermon = isset($_GET['clients_filter_shorttermon'])? $_GET['clients_filter_shorttermon'] : "";
	$clients_filter_pets = isset($_GET['clients_filter_pets'])? $_GET['clients_filter_pets'] : "";
	$clients_filter_beds = isset($_GET['clients_filter_beds'])? $_GET['clients_filter_beds'] : "";
	$clients_filter_baths = isset($_GET['clients_filter_baths'])? $_GET['clients_filter_baths'] : "";
	$clients_filter_source = isset($_GET['clients_filter_source'])? $_GET['clients_filter_source'] : "";
	$clients_filter_agent = isset($_GET['clients_filter_agent'])? $_GET['clients_filter_agent'] : "";
	$clients_filter_subtype = isset($_GET['clients_filter_subtype'])? $_GET['clients_filter_subtype'] : "";
	$clients_filter_building_pref = isset($_GET['clients_filter_building_pref'])? $_GET['clients_filter_building_pref'] : "";
	$clients_leadsafe = isset($_GET['clients_leadsafe'])? $_GET['clients_leadsafe'] : "";
		}
	
	$clients_where = "where GRID='$grid'";

	if ($clients_filter_agent!="") {
		$clients_where .= " and CLIENTS.UID ='$clients_filter_agent'";
	}
	
	if ($clients_filter_source!="") {
		$clients_where .= " and CLIENTS.SOURCE ='$clients_filter_source'";
	}

	if ($clients_filter_name_last!="") {
		$clients_where .= " and NAME_LAST like \"%$clients_filter_name_last%\" ";
		//echo $clients_where;
	}
	
	if ($clients_filter_name_first!="") {
		$clients_where .= " and NAME_FIRST like \"%$clients_filter_name_first%\" ";
	}
	
	if ($clients_filter_type!="" && $clients_filter_type!="0") {
		$clients_where .= " and TYPE_PREF='$clients_filter_type'";
	}
	
	if ($clients_filter_subtype!="") {
		$clients_where .= " and CLIENT_SUBTYPE='$clients_filter_subtype'";
	}
	
	if ($clients_filter_loc_pref!="") {
		$clients_where .= " and LOC_PREF LIKE '%$clients_filter_loc_pref%'";
	//* $clients_where .= " and LOC_PREF='$clients_filter_loc_pref'";
	}

	if ($clients_filter_building_pref!="") {
		$clients_where .= " and BUILDING_PREF LIKE '%$clients_filter_building_pref%'";
	}
	
	if ($clients_filter_price_min!="") {
		$clients_where .= " and PRICEMIN >= $clients_filter_price_min";
	}
	
	if ($clients_filter_price_max!="") {
		$clients_where .= " and PRICEMAX <= $clients_filter_price_max";
	}
	
	if (isset($_GET["clients_filter_nc_month"]) && $clients_filter_nc_day && $clients_filter_nc_year) {
		$nc = "$clients_filter_nc_year-$clients_filter_nc_month-$clients_filter_nc_day";
		$clients_where .= " and DATE_NEXT_CONTACT <='$date_next_contact'";
	}


	if ($clients_filter_phone!="") {
$clients_where .= " and HOME_PHONE like \"%$clients_filter_phone%\" OR GRID=$grid AND WORK_PHONE like \"%$clients_filter_phone%\" OR  GRID=$grid AND MOBILE_PHONE like \"%$clients_filter_phone%\"";

}


	if ($clients_filter_email!="") {
$clients_where .= " and CLIENT_EMAIL like \"%$clients_filter_email%\"";
}


	if ($clients_filter_status_client != "" && $clients_filter_status_client != "0") {
$clients_where .= " and STATUS_CLIENT = $clients_filter_status_client";
        }


	if (isset($_GET["clients_filter_furnishedon"])) {
$clients_where .= " and CLIENT_FURNISHED=\"$clients_filter_furnishedon\"";
}

	if (isset($_GET["clients_filter_shorttermon"])) {
$clients_where .= " and CLIENT_SHORTTERM=\"$clients_filter_shorttermon\"";
}


	if (isset ($_GET["client_leadsafe"]) and ($clients_leadsafe=="1")) {
$clients_where .= " and LEADSAFE!=\"clients_leadsafe\"";

 }



	if (isset($_GET["clients_filter_pets"])) {
$clients_where .= " and PETS_PREF>=\"2\"";
}



	if ($clients_filter_beds != "") {
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


	if ($clients_filter_baths != "") {
		
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

//echo $clients_where;

	$PHP_SELF = $_SERVER['PHP_SELF']; 
	if ($_SESSION["level"]>4) 
	{
		$page = "manageClients";
		$title = "Manage Clients";
//* $msg = "$clients_where";
		
		
		$disData = "clients";
		$disData2 = "user";
	}else {
		$page = "manageClients";
                $title = "Manage Clients";
                $disData = "clients";
		$disData2 = "user";
//		$page = "home";
//		$msg = "Sorry, that functionality isn't available";
//		$msg_error = true;
	}
	$needOptions = true;
//END manageClients //
        
?>