<?php
//BEGIN manageLandlord //
//session_start();


       if (isset($_SESSION["landlords_page"]))
       {
            $landlords_page = $_SESSION["landlords_page"];
       };
       
        if (isset($_SESSION["landlords_sort"]))
       {
         $landlords_sort = $_SESSION["landlords_sort"];
       };
//        

       
         if (isset($_SESSION["landlords_filter_lc_month"]))
       {
            $landlords_filter_lc_month = $_SESSION["landlords_filter_lc_month"];
       };
       
         if (isset($_SESSION["landlords_filter_lc_day"]))
       {
            $landlords_filter_lc_day = $_SESSION["landlords_filter_lc_day"];
       };
        if (isset($_SESSION["landlords_filter_lc_off_name"]))
       {
            $landlords_filter_off_name = $_SESSION["landlords_filter_off_name"];
       };
       if (isset($_SESSION["landlords_filter_nc_month"]))
       {
            $landlords_filter_nc_month = $_SESSION["landlords_filter_nc_month"];
       };
       if (isset($_SESSION["landlords_filter_nc_day"]))
       {
            $landlords_filter_nc_day = $_SESSION["landlords_filter_nc_day"];
       };
       if (isset($_SESSION["landlords_filter_nc_year"]))
       {
            $landlords_filter_nc_year = $_SESSION["landlords_filter_nc_year"];
       };
       if (isset($_SESSION["landlords_filter_phone"]))
       {
            $landlords_filter_phone = $_SESSION["landlords_filter_phone"];
       };
       if (isset($_SESSION["landlords_filter_email"]))
       {
            $landlords_filter_email = $_SESSION["landlords_filter_email"];
       };
       
       if (isset($_SESSION["LLRANK"]))
       {
            $LLRANK = $_SESSION["LLRANK"];
       };
       
       
 
       // session_register("landlords_page");
      
//	session_register("landlords_sort");
////	session_register("landlords_filter_lc_month");
//	session_register("landlords_filter_lc_day");
//	session_register("landlords_filter_lc_year");
//	session_register("landlords_filter_nc_month");
//	session_register("landlords_filter_nc_day");
//	session_register("landlords_filter_nc_year");
//	session_register("landlords_filter_phone");
//	session_register("landlords_filter_email");
//	session_register("LLRANK");
//	session_register("landlords_filter_off_name");	
//	
	//if ($HTTP_GET_VARS['landlords_page']) {
        if(isset ($_GET['landlords_page'])){
		$landlords_page = $_GET['landlords_page'];
		if (!$landlords_page || $landlords_page < 0) {
			$landlords_page = 1;
		}
	}else {
		if (!isset($_SESSION["landlords_page"])) {
			$landlords_page = 1;
		}
	
	}

	
	$landlords_limit_n = 20;
	$landlords_limit_start = ($landlords_page * $landlords_limit_n) - $landlords_limit_n;
	$landlords_limit = "limit $landlords_limit_start, $landlords_limit_n";
	if (isset($_GET['show_all_landlords']) && !empty($_GET['show_all_landlords'])) {
		$landlords_limit = "";
	}
       
	
	//if ($_GET['landlords_sort']) {
        if(isset($_GET['landlords_sort'])) {
		$landlords_sort = $_GET['landlords_sort'];
//                echo "landlords sort", $landlords_sort;
	}else {
		if (!isset($_SESSION["landlords_sort"])) {
			$landlords_sort = "SHORT_NAME";
		}
	}
	$landlords_order_by = "order by $landlords_sort";
	
	
//	if ($_GET['landlords_filter']) {
        if (isset($_GET['landlords_filter'])) {
		$landlords_filter_lc_month = isset($_GET['landlords_filter_lc_month'])? $_GET['landlords_filter_lc_month'] : "0";
		$landlords_filter_lc_day = isset($_GET['landlords_filter_lc_day'])? $_GET['landlords_filter_lc_day']: "0";
		$landlords_filter_lc_year = isset($_GET['landlords_filter_lc_year'])? $_GET['landlords_filter_lc_year']: "0";
		$landlords_filter_nc_month = isset($_GET['landlords_filter_nc_month'])? $_GET['landlords_filter_nc_month']: "0";
		$landlords_filter_nc_day = isset($_GET['landlords_filter_nc_day'])? $_GET['landlords_filter_nc_day']: "0";
		$landlords_filter_nc_year = isset($_GET['landlords_filter_nc_year'])? $_GET['landlords_filter_nc_year']: "0";
		$landlords_filter_phone = isset($_GET['landlords_filter_phone'])? $_GET['landlords_filter_phone']: "";
		$landlords_filter_email = isset($_GET['landlords_filter_email'])? $_GET['landlords_filter_email']: "";
		$landlords_filter_off_name = isset($_GET['landlords_filter_off_name'])? $_GET['landlords_filter_off_name']: "";
		$landlords_filter_llrank = isset($_GET['LLRANK'])? $_GET['LLRANK']: "";
		
		
	}
	
	$landlords_where = "where GRID='$grid'";
        
	if (isset($_GET["landlords_filter_off_name"]) && $landlords_filter_off_name) {

		$landlords_where .= " and SHORT_NAME like \"%$landlords_filter_off_name%\" OR GRID=$grid and HOME_NAME_FIRST like \"$landlords_filter_off_name%\" OR GRID=$grid AND HOME_SPOUSE_FIRST like \"$landlords_filter_off_name%\" OR GRID=$grid and HOME_NAME_LAST like \"$landlords_filter_off_name%\" OR GRID=$grid AND HOME_SPOUSE_LAST like \"$landlords_filter_off_name%\" OR GRID=$grid and OFF_NAME like \"$landlords_filter_off_name%\"";

}
	if ((isset($landlords_filter_lc_month) && $landlords_filter_lc_month != "0") 
                && (isset($landlords_filter_lc_day) && $landlords_filter_lc_day != "0") 
                && (isset($landlords_filter_lc_year) && $landlords_filter_lc_year != "0")) {
            
		$lc = "$landlords_filter_lc_year-$landlords_filter_lc_month-$landlords_filter_lc_day";
		$landlords_where .= " and LAST_CONTACTED >='$lc'";
	}
        
        
	if ((isset($landlords_filter_nc_month) && $landlords_filter_nc_month != "0")  
                && (isset($landlords_filter_nc_day) && $landlords_filter_nc_day != "0") 
                && (isset($landlords_filter_nc_year) && $landlords_filter_nc_year != "0")) {
		$nc = "$landlords_filter_nc_year-$landlords_filter_nc_month-$landlords_filter_nc_day";
		$landlords_where .= " and NEXT_CONTACT <='$nc'";
	}

	if (isset($_GET["landlords_filter_phone"]) && $landlords_filter_phone) {
$landlords_where .= " and HOME_PHONE like \"%$landlords_filter_phone%\" OR GRID=$grid AND OFF_PHONE like \"%$landlords_filter_phone%\" OR GRID=$grid AND SUPER_PHONE like \"%$landlords_filter_phone%\" OR GRID=$grid AND MOBILE_PHONE like \"%$landlords_filter_phone%\" OR GRID=$grid AND SPOUSE_CELL like \"%$landlords_filter_phone%\" OR GRID=$grid AND SPOUSE_OFFICE like \"%$landlords_filter_phone%\" OR GRID=$grid AND HOME_FAX like \"%$landlords_filter_phone%\" OR GRID=$grid AND OFF_FAX like \"%$landlords_filter_phone%\" OR GRID=$grid AND LLNOTES like \"%$landlords_filter_phone%\"";
          

}


//	if ($landlords_filter_llnotes) {
//$landlords_where .= " and LLNOTES like \"%$landlords_filter_llnotes%\"";
//			}
//


if (isset($landlords_filter_llrank) && $landlords_filter_llrank != "") {
    $landlords_where .= " and LLRANK = $landlords_filter_llrank";			}







	if ((isset($_SESSION["landlords_filter_email"])) && $landlords_filter_email) {
$landlords_where .= " and LL_EMAIL like \"%$landlords_filter_email%\" OR GRID=$grid AND OFF_EMAIL like \"%$landlords_filter_email%\" OR GRID=$grid AND LLNOTES like \"%$landlords_filter_email%\" OR GRID=$grid AND SPOUSE_EMAIL like \"%$landlords_filter_email%\"";

}	


	
	$app = "home";
	$appLink = "home";
	$page = "manageLandlord";
	$disData = "landlords";
	$title = "Manage Landlords";
	$needOptions = true;
        
         if (isset($landlords_page))
      $_SESSION['landlords_page'] = $landlords_page ;
        if (isset($landlords_limit_start))
      $_SESSION['landlords_limit_start'] =  $landlords_limit_start;
        if (isset($landlords_limit_start))
      $_SESSION['landlords_limit_n'] =  $landlords_limit_n;
        
//END manageLandlord //
?>