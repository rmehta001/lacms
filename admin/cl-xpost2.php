<html>
<HEAD>

 <STYLE>
 .box{
    width:200px;
    float:left; 
}
 
  .box2{
    width:800px;
    float:left; 
}
 
 
 #myElement {
    background-color:blue;
    cursor:pointer;
    text-align:center;
    line-height: 40px;
    padding: 6px
    border-radius: 4px;
    width: 50%;
    margin: auto;
    color:white;
}
 
 
 </STYLE>
 
 

 
 </HEAD>
<BODY>
 
 <TABLE><TR><TD WIDTH=200>


<div class="box">
 

 <?php
session_start();                 
include("../inc/global.php");    
include("../inc/local_info.php");

mysqli_select_db($dbh, "$DBNAME");

set_time_limit(0);

$co = $HTTP_GET_VARS['cli'];
$ad = $HTTP_GET_VARS['ad'];
$sort = $HTTP_GET_VARS['sort'];
$uid = $HTTP_GET_VARS['uid'];
$style = $HTTP_GET_VARS['style'];


include("./lacms/inc/local_info.php");
include("./lacms/inc/global.php");

mysqli_select_db($dbh, $DBNAME);

if ((!$co) OR (!$ad) OR (!$uid)) {
die ("You are not authorized to use this file!");
}


// DB CONNECT //

mysqli_select_db($dbh, $DBNAME);


if (!isset($ad)) {
	$quStrGetAd = "SELECT * FROM CLASS INNER JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE CLI=$co $agency_where";
}else {
	$quStrGetAd = "SELECT * FROM CLASS INNER JOIN LOC ON CLASS.LOC=LOC.LOCID WHERE CID=$ad $agency_where";
}
$quGetAd = mysqli_query($dbh, $quStrGetAd) or die ("<H3>Sorry, the listing requested no longer exists.</H3>");
$rowGetAd = mysqli_fetch_object($quGetAd);


 
 $page = file_get_contents('http://bostonapartments.com/cl-boston-form.htm');




$postwhere = "Craigslist";
$quStrAddPOSTTO = "INSERT INTO POSTTO (UID, CLI, CID, POSTWHERE) VALUES ('$uid', '$co', '$ad', '$postwhere')";
$quAddPOSTTO = mysqli_query($dbh, $quStrAddPOSTTO) or die ($quStrAddPOSTTO);



if(isset($_POST['agency']))
{
//        $agency_where="AND AGENCY_HEADERS=".$_POST['agency'];
        $agency=$_POST['agency'];
}
if(isset($HTTP_GET_VARS['agency']))
{
//        $agency_where="AND AGENCY_HEADERS=".$HTTP_GET_VARS['agency'];
        $agency=$HTTP_GET_VARS['agency'];
}

if(isset($HTTP_GET_VARS['usig']))
        { $usig="yes"; }
elseif(isset($_POST['usig']))
        { $usig="yes";}
else
        { $usig=""; }


//DEFINED VALUE SETS //
$quStrGetValueDefs = "SELECT * FROM VALUE_DEFINE";
$quGetValueDefs = mysqli_query($dbh, $quStrGetValueDefs);

while ($rowGetValueDefs = mysqli_fetch_object($quGetValueDefs)) {
	$string = $rowGetValueDefs->DEFINE;
	$values = split (",", $string);
	foreach ($values as $key => $value) {
		$values2[$key] = split ("_", $value);
	}
	foreach ($values2 as $values3) {
		$offset = $values3[0];
		$DEFINED_VALUE_SETS[$rowGetValueDefs->CLASS_NAME][$offset] = $values3[1];
	}
	
	$string = false;
	$values = false;
	$values2 = false;
	$values3 = false;
	$offset = false;
	
	
}

$quStrGetGr = "SELECT * FROM `GROUP` WHERE GRID=$co";
$quGetGr = mysqli_query($dbh, $quStrGetGr) or die ("can't get group");
$rowGetGr = mysqli_fetch_object($quGetGr);


$quStrGetUr = "SELECT * FROM `USERS` WHERE UID=$uid";
$quGetUr = mysqli_query($dbh, $quStrGetUr) or die ("can't get user .. testing");
$rowGetUr = mysqli_fetch_object($quGetUr);




//
	$avail = ($rowGetAd->AVAIL !== "0000-00-00") ? " Available: $rowGetAd->AVAIL " : "";
	if ($rowGetAd->AVAIL == "0000-00-00") {
		$avail = "";	
	}else {
		
		$today = date ("Ymd");
		$avail_all = str_replace ("-", "", $rowGetAd->AVAIL);
		if (($today - $avail_all) >= 0) {
			$avail = " Available: Now. ";
		}else {
			$avail_year = substr ($rowGetAd->AVAIL, 2,2);
			$avail_month = substr ($rowGetAd->AVAIL, 5,2);
			$avail_day = substr ($rowGetAd->AVAIL, 8,2);
			$avail = " Available: $avail_month/$avail_day/$avail_year. ";
		}
	}



   //DEFINED VALUE SETS //
   $quStrGetValueDefs = "SELECT * FROM VALUE_DEFINE";
   $quGetValueDefs = mysqli_query($dbh, $quStrGetValueDefs);

   while ($rowGetValueDefs = mysqli_fetch_object($quGetValueDefs)) {
        $string = $rowGetValueDefs->DEFINE;
        $values = split (",", $string);
        foreach ($values as $key => $value) {
                $values2[$key] = split ("_", $value);
        }
        foreach ($values2 as $values3) {
                $offset = $values3[0];
                $DEFINED_VALUE_SETS[$rowGetValueDefs->CLASS_NAME][$offset] = $values3[1];
        }

        $string = false;
        $values = false;
        $values2 = false;
        $values3 = false;
        $offset = false;
   }


	$rooms = ($RowGetAd->ROOMS) ? $thisDEFINED_VALUE_SETS['ROOMS'][$RowGetAd->ROOMS] . " - " : "";
	$baths = ($RowGetAd->BATH) ? $thisDEFINED_VALUE_SETS['BATH'][$RowGetAd->BATH] . " - " : "";




	if ($rowGetAd->AUTO_WRITE) {

		$features_array['FEATURES_DELEADED']		= $thisRowGetAd->FEATURES_DELEADED          ;
		$features_array['FEATURES_FURNISHED']           = $thisRowGetAd->FEATURES_FURNISHED         ;
		$features_array['FEATURES_NON_SMOKING']         = $thisRowGetAd->FEATURES_NON_SMOKING       ;
		$features_array['FEATURES_ALARM']               = $thisRowGetAd->FEATURES_ALARM             ;
		$features_array['FEATURES_HEAT']                = $thisRowGetAd->FEATURES_HEAT              ;
		$features_array['FEATURES_HOT_WATER']           = $thisRowGetAd->FEATURES_HOT_WATER         ;
		$features_array['FEATURES_HT_AND_HW']           = $thisRowGetAd->FEATURES_HT_AND_HW         ;
		$features_array['FEATURES_ALL_UTILITIES']       = $thisRowGetAd->FEATURES_ALL_UTILITIES     ;
		$features_array['FEATURES_ELECTRICITY']       = $thisRowGetAd->FEATURES_ELECTRICITY     ;
		$features_array['FEATURES_GAS_HEAT']            = $thisRowGetAd->FEATURES_GAS_HEAT          ;
		$features_array['FEATURES_OIL_HEAT']            = $thisRowGetAd->FEATURES_OIL_HEAT          ;
		$features_array['FEATURES_ELEC_HEAT']           = $thisRowGetAd->FEATURES_ELEC_HEAT         ;
		$features_array['FEATURES_HWFI']                = $thisRowGetAd->FEATURES_HWFI              ;
		$features_array['FEATURES_FIREPLACE_WORKING']   = $thisRowGetAd->FEATURES_FIREPLACE_WORKING ;
		$features_array['FEATURES_FIREPLACE_DECOR']     = $thisRowGetAd->FEATURES_FIREPLACE_DECOR   ;
		$features_array['FEATURES_CARPET']              = $thisRowGetAd->FEATURES_CARPET            ;
		$features_array['FEATURES_MODERN_KITCHEN']      = $thisRowGetAd->FEATURES_MODERN_KITCHEN    ;
		$features_array['FEATURES_KITCHEN_GALLEY']      = $thisRowGetAd->FEATURES_KITCHEN_GALLEY    ;
		$features_array['FEATURES_KITCHENETTE']         = $thisRowGetAd->FEATURES_KITCHENETTE       ;
		$features_array['FEATURES_EAT_IN_KITCHEN']      = $thisRowGetAd->FEATURES_EAT_IN_KITCHEN    ;
		$features_array['FEATURES_GAS_RANGE']           = $thisRowGetAd->FEATURES_GAS_RANGE         ;
		$features_array['FEATURES_ELEC_RANGE']          = $thisRowGetAd->FEATURES_ELEC_RANGE        ;
		$features_array['FEATURES_DISPOSAL']            = $thisRowGetAd->FEATURES_DISPOSAL          ;
		$features_array['FEATURES_DISHWASHER']          = $thisRowGetAd->FEATURES_DISHWASHER        ;
		$features_array['FEATURES_SKYLIGHT']            = $thisRowGetAd->FEATURES_SKYLIGHT          ;
		$features_array['FEATURES_PORCH']               = $thisRowGetAd->FEATURES_PORCH             ;
		$features_array['FEATURES_BALCONY']             = $thisRowGetAd->FEATURES_BALCONY           ;
		$features_array['FEATURES_PATIO']               = $thisRowGetAd->FEATURES_PATIO             ;
		$features_array['FEATURES_CENTRAL_AC']          = $thisRowGetAd->FEATURES_CENTRAL_AC        ;
		$features_array['FEATURES_AC']                  = $thisRowGetAd->FEATURES_AC                ;
		$features_array['FEATURES_DECK']                = $thisRowGetAd->FEATURES_DECK              ;
		$features_array['FEATURES_MODERN_BATH']         = $thisRowGetAd->FEATURES_MODERN_BATH       ;
		$features_array['FEATURES_WHIRLPOOL']           = $thisRowGetAd->FEATURES_WHIRLPOOL         ;
		$features_array['FEATURES_DINNING_ROOM']        = $thisRowGetAd->FEATURES_DINNING_ROOM      ;
		$features_array['FEATURES_WALK_IN_CLOSET']      = $thisRowGetAd->FEATURES_WALK_IN_CLOSET    ;
		$features_array['AMENITIES_HIGH_CEILINGS']      = $thisRowGetAd->AMENITIES_HIGH_CEILINGS    ;
		$features_array['FEATURES_ENCLOSED_PORCH']      = $thisRowGetAd->FEATURES_ENCLOSED_PORCH    ;
		$features_array['FEATURES_MICROWAVE']           = $thisRowGetAd->FEATURES_MICROWAVE         ;
		$features_array['FEATURES_PANTRY']              = $thisRowGetAd->FEATURES_PANTRY            ;
		$features_array['FEATURES_INTERNET'] = $thisRowGetAd->FEATURES_INTERNET        ;
		$features_array['FEATURES_DUPLEX']              = $thisRowGetAd->FEATURES_DUPLEX            ;
		$features_array['FEATURES_CABLETV']              = $thisRowGetAd->FEATURES_CABLETV            ;
		$features_array['FEATURES_STAINLESS']              = $thisRowGetAd->FEATURES_STAINLESS            ;
		$features_array['FEATURES_GRANITEC']              = $thisRowGetAd->FEATURES_GRANITEC            ;
		$features_array['FEATURES_BAYWINDOWS']              = $thisRowGetAd->FEATURES_BAYWINDOWS            ;
		$features_array['FEATURES_INTERCOM']              = $thisRowGetAd->FEATURES_INTERCOM            ;
		$features_array['FEATURES_CEILINGFAN']              = $thisRowGetAd->FEATURES_CEILINGFAN            ;

		
		foreach ($features_array as $name => $value) {
			if ($value) {
				$feature_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$feature_string .= " - ";
			}
		}
		if ($feature_string) {
			$feature_string = " <strong>Features:</strong> " . $feature_string;
		}
		
		$amenities_array['AMENITIES_CONCIEARGE']         = $thisRowGetAd->AMENITIES_CONCIEARGE       ;
		$amenities_array['AMENITIES_ELEVATOR']           = $thisRowGetAd->AMENITIES_ELEVATOR         ;
		$amenities_array['AMENITIES_DECK']               = $thisRowGetAd->AMENITIES_DECK             ;
		$amenities_array['AMENITIES_ROOF_DECK']          = $thisRowGetAd->AMENITIES_ROOF_DECK        ;
		$amenities_array['AMENITIES_GARDEN']             = $thisRowGetAd->AMENITIES_GARDEN           ;
		$amenities_array['AMENITIES_YARD']               = $thisRowGetAd->AMENITIES_YARD             ;
		$amenities_array['AMENITIES_SECURITY']           = $thisRowGetAd->AMENITIES_SECURITY         ;
		$amenities_array['AMENITIES_BUSINESSCENTER']        = $thisRowGetAd->AMENITIES_BUSINESSCENTER      ;
		$amenities_array['AMENITIES_CLUBHOUSE']        = $thisRowGetAd->AMENITIES_CLUBHOUSE      ;
		$amenities_array['AMENITIES_HEALTH_CLUB']        = $thisRowGetAd->AMENITIES_HEALTH_CLUB      ;
		$amenities_array['AMENITIES_POOL']               = $thisRowGetAd->AMENITIES_POOL             ;
		$amenities_array['AMENITIES_TENNIS']             = $thisRowGetAd->AMENITIES_TENNIS           ;
		$amenities_array['AMENITIES_LOUNGE']             = $thisRowGetAd->AMENITIES_LOUNGE           ;
		$amenities_array['AMENITIES_SAUNA']              = $thisRowGetAd->AMENITIES_SAUNA            ;
		$amenities_array['AMENITIES_BALCONY']            = $thisRowGetAd->AMENITIES_BALCONY          ;
		$amenities_array['AMENITIES_DECK2']              = $thisRowGetAd->AMENITIES_DECK2            ;
		$amenities_array['AMENITIES_ELEVATOR_BUILDING']  = $thisRowGetAd->AMENITIES_ELEVATOR_BUILDING;
		$amenities_array['AMENITIES_ATTIC']              = $thisRowGetAd->AMENITIES_ATTIC            ;
		$amenities_array['AMENITIES_BASEMENT']           = $thisRowGetAd->AMENITIES_BASEMENT         ;
		$amenities_array['AMENITIES_BIN']                = $thisRowGetAd->AMENITIES_BIN              ;
		$amenities_array['AMENITIES_SUPERINTENDANT']     = $thisRowGetAd->AMENITIES_SUPERINTENDANT   ;
		$amenities_array['AMENITIES_ON_SITE_MANAGEMENT'] = $thisRowGetAd->AMENITIES_ON_SITE_MANAGEMENT   ;
		$amenities_array['AMENITIES_OWNER_OCCUPIED'] = $thisRowGetAd->AMENITIES_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_NOT_OWNER_OCCUPIED'] = $thisRowGetAd->AMENITIES_NOT_OWNER_OCCUPIED   ;
		$amenities_array['AMENITIES_WHEELCHAIR'] = $thisRowGetAd->AMENITIES_WHEELCHAIR   ;
		$amenities_array['AMENITIES_SUBWAY']              = $thisRowGetAd->AMENITIES_SUBWAY            ;
		$amenities_array['AMENITIES_CRAIL']              = $thisRowGetAd->AMENITIES_CRAIL            ;
		$amenities_array['AMENITIES_BUS']              = $thisRowGetAd->AMENITIES_BUS            ;
		$amenities_array['AMENITIES_SHUTTLE']              = $thisRowGetAd->AMENITIES_SHUTTLE            ;		
		$amenities_array['AMENITIES_BIKEROOM']         = $thisRowGetAd->AMENITIES_BIKEROOM       ;
		$amenities_array['AMENITIES_PLAYGROUND']         = $thisRowGetAd->AMENITIES_PLAYGROUND       ;
		$amenities_array['AMENITIES_BASKETBALL']         = $thisRowGetAd->AMENITIES_BASKETBALL       ;
		$amenities_array['AMENITIES_BBQ']         = $thisRowGetAd->AMENITIES_BBQ       ;
		$amenities_array['AMENITIES_ZIPCAR']         = $thisRowGetAd->AMENITIES_ZIPCAR       ;

		
		foreach ($amenities_array as $name => $value) {
			if ($value) {
				$amenity_string .= $thisDEFINED_VALUE_SETS[$name][$value];
				$amenity_string .= " - ";
			}
		}
		
		if ($amenity_string) {
			$amenity_string = " <strong>Amenities:</strong> " . $amenity_string;
		}
	}



$bodyurl = "https://www.BostonApartments.com/clstrip.php?cli=$co&ad=$ad&uid=$uid&style=$style";
$bodypage = file_get_contents($bodyurl);


if (($rowGetAd->AD_TITLE !="") AND ($style =="")){


        $page = str_replace("  value=\"\">", "size=\"30\" maxlength=\"70\" value=\"$rowGetAd->AD_TITLE\">", $page);



		
		} elseif ($rowGetAd->AD_TITLE !="") {


if ($rowGetAd->ROOMS == "0.25") {


	if ($style =="2") {
        $page = str_replace("   value=\"\">", "  value=\"Loft - $rowGetAd->LOCNAME - $$rowGetAd->PRICE - $rowGetAd->BATH  Bath - $avail  $noFee \">", $page);
		
} elseif ($style=="3") {

      $page = str_replace("   value=\"\">", "  value=\"Loft - $rowGetAd->LOCNAME $avail  $noFee \">", $page);
	  
} elseif ($style=="4") {

      $page = str_replace("   value=\"\">", "  value=\"$rowGetAd->LOCNAME LOFT $avail  $noFee \">", $page);

	  }

}


if ($rowGetAd->ROOMS == "0.50") {

	if ($style =="2") {
        $page = str_replace("   value=\"\">", "  value=\"Studio - $rowGetAd->LOCNAME - $rowGetAd->BATH  Bath - $avail  $noFee $$rowGetAd->PRICE\">", $page);

} elseif ($style=="3") {

        $page = str_replace("   value=\"\">", "  value=\"Studio - $rowGetAd->LOCNAME $avail  $noFee \">", $page);

} elseif ($style=="4") {

        $page = str_replace("   value=\"\">", "  value=\"$rowGetAd->LOCNAME STUDIO $avail  $noFee \">", $page);
		}

}

if ($rowGetAd->ROOMS == "0.75") {

			if ($style =="2") {
        $page = str_replace("   value=\"\">", "  value=\"Studio w/ Alcove - $rowGetAd->LOCNAME - $rowGetAd->BATH  Bath - $avail - $noFee - $$rowGetAd->PRICE\">", $page);

} elseif ($style=="3") {

        $page = str_replace("   value=\"\">", "  value=\"Studio with Alcove - $rowGetAd->LOCNAME $avail  $noFee \">", $page);
		

} elseif ($style=="4") {

        $page = str_replace("   value=\"\">", "  value=\"$rowGetAd->LOCNAME STUDIO WITH ALCOVE $avail  $noFee \">", $page);

		
	}

}



if ($rowGetAd->ROOMS == "0.76") {


		if ($style =="2") {
        $page = str_replace("   value=\"\">", "  value=\"2 Room Studio - $rowGetAd->LOCNAME - $rowGetAd->BATH  Bath - $avail - $noFee - $$rowGetAd->PRICE\">", $page);

} elseif ($style=="3") {

        $page = str_replace("   value=\"\">", "  value=\"2 room Studio - $rowGetAd->LOCNAME $avail  $noFee \">", $page);
		

} elseif ($style=="4") {

        $page = str_replace("   value=\"\">", "  value=\"$rowGetAd->LOCNAME 2 ROOM STUDIO $avail  $noFee \">", $page);

}

}



if ($rowGetAd->ROOMS == "0.79") {

	if ($style =="2") {
        $page = str_replace("   value=\"\">", "  value=\"Studio w/ Loft Bed - $rowGetAd->LOCNAME - $rowGetAd->BATH  Bath - $avail - $noFee - $$rowGetAd->PRICE\">", $page);


} elseif ($style=="3") {

        $page = str_replace("   value=\"\">", "  value=\"Studio with Loft Bed - $rowGetAd->LOCNAME $avail  $noFee \">", $page);

		
} elseif ($style=="4") {

        $page = str_replace("   value=\"\">", "  value=\"$rowGetAd->LOCNAME STUDIO w/ LOFT BED $avail  $noFee \">", $page);

		
}

}



if ($rowGetAd->ROOMS >= "1.00") {


			if ($style =="2") {
        $page = str_replace("   value=\"\">", "  value=\"$rowGetAd->ROOMS Bed - $rowGetAd->LOCNAME - $rowGetAd->BATH  Bath - $avail - $noFee - $$rowGetAd->PRICE\">", $page);

} elseif ($style=="3") {

        $page = str_replace("   value=\"\">", "  value=\"$rowGetAd->ROOMS Bed - $rowGetAd->LOCNAME $avail  $noFee \">", $page);

} elseif ($style=="4") {


        $page = str_replace("   value=\"\">", "  value=\"$rowGetAd->AD_TITLE\">", $page);

}


}

} else {
        $page = str_replace("   value=\"\">", " value=\"$rowGetAd->LOCNAME - $rowGetAd->ROOMS BEDROOM - $rowGetAd->BATH BATHROOM - $$rowGetAd->PRICE $noFee - $avail\">", $page);
}

if (!$rowGetAd->ROOMS) {

if ($rowGetAd->AD_TITLE !="") {



				if ($style =="2") {
				
					if ($rowGetAd->TYPE=="5") {
					
					     $page = str_replace("  value=\"\">", " value=\"Parking Space - $rowGetAd->LOCNAME  $$rowGetAd->PRICE $noFee - $avail\">", $page);
						 
		
					} else {

       $page = str_replace("   value=\"\">", "  value=\"$rowGetAd->AD_TITLE\">", $page);

}


} else {
	

       $page = str_replace("  value=\"\">", "  value=\"$rowGetAd->AD_TITLE\">", $page);
	   
	}


}  else {




if ($rowGetAd->TYPE=="5") {

       $page = str_replace("  value=\"\">", " value=\"$rowGetAd->LOCNAME - Parking Space - $$rowGetAd->PRICE $noFee - $avail\">", $page);

		
} else {

       $page = str_replace("  value=\"\">", " value=\"$rowGetAd->LOCNAME $$rowGetAd->PRICE $noFee - $avail\">", $page);

}


}

} else {


       $page = str_replace("  value=\"\">", "  value=\"$rowGetAd->AD_TITLE\">", $page);


}


//* specific location *//
        $page = str_replace("size=\"20\" maxlength=\"40\" value=\"\">", "size=\"20\" maxlength=\"40\" value=\"$rowGetAd->LOCNAME\">", $page);




        $page = str_replace("class=\"req df\"", " ", $page);


if ($rowGetUr->CL_EMAILU != "" AND $rowGetGr->CL_AGENTS == "1") {


        $page = str_replace("size=\"80\" value=\"\" maxlength=\"60\"><br><span", "size=\"80\" value=\"$rowGetUr->CL_EMAILU\" maxlength=\"60\"><br><span", $page);


        $page = str_replace("value=\"Your email address\"", "value=\"$rowGetUr->CL_EMAILU\"", $page);


        $page = str_replace("value=\"Type email address again\"", "value=\"$rowGetUr->CL_EMAILU\"", $page);



        $page = str_replace("size=\"80\" value=\"\" maxlength=\"60\"><br> <label>", "size=\"80\" value=\"$rowGetUr->CL_EMAILU\" maxlength=\"60\"><br> <label>", $page);


} else {



        $page = str_replace("value=\"Your email address\"", "value=\"$rowGetGr->GROUP_EMAIL\"", $page);

        $page = str_replace("value=\"Type email address again\"", "value=\"$rowGetGr->GROUP_EMAIL\"", $page);


        $page = str_replace("size=\"80\" value=\"\" maxlength=\"60\"><br><span", "size=\"80\" value=\"$rowGetGr->GROUP_EMAIL\" maxlength=\"60\"><br><span", $page);



        $page = str_replace("size=\"80\" value=\"\" maxlength=\"60\"><br> <label>", "size=\"80\" value=\"$rowGetGr->GROUP_EMAIL\" maxlength=\"60\"><br> <label>", $page);


}


        $page = str_replace("<input tabindex=\"1\" name=\"xstreet0\" size=\"20\" maxlength=\"80\" value=\"\">", "<input tabindex=\"1\" name=\"xstreet0\" size=\"20\" maxlength=
\"80\" value=\"\">", $page);





        $page = str_replace("<input tabindex=\"1\" name=\"xstreet1\" size=\"20\" maxlength=\"80\" value=\"\">", "<input tabindex=\"1\" name=\"xstreet1\" size=\"20\" maxlength=
\"80\" value=\"$rowGetAd->xstreet\">", $page);

        $page = str_replace("<input tabindex=\"1\" name=\"city\"     size=\"20\" maxlength=\"80\" value=\"\">", "<input tabindex=\"1\" name=\"city\"     size=\"20\" maxlength=
\"80\" value=\"$rowGetAd->LOCNAME\">", $page);



        $page = str_replace("value=\"\">\n\t\t\t</div>", "value=\"$rowGetAd->PRICE\">\n			</td>", $page);

// non anon set to show email

$page = str_replace("value=\"C\" checked", "value=\"C\" ", $page);
$page = str_replace("value=\"P\"", "value=\"P\" checked", $page);


// *$cl_sig = "$rowGetGr->NAME $rowGetGr->CL_PHONE $rowGetGr->CL_EMAIL";

if($rowGetAd->AGENCY_HEADERS)
{
		$agcyStr="SELECT * FROM AGENCIES WHERE AGENCY_ID=$rowGetAd->AGENCY_HEADERS AND GID=$co";
                $agcyGet=mysqli_query($dbh, $agcyStr);
                $agcy=mysqli_fetch_object($agcyGet);


}

else {

$foo="bar";

// $group_sig = "$rowGetGr->NAME $rowGetGr->GROUP_PHONE $rowGetGr->GROUP_EMAIL";
// $cl_sig = "$rowGetGr->NAME $rowGetGr->CL_PHONE $rowGetGr->CL_EMAIL<BR>";

}

if ($rowGetGr->CL_USE_SIG !="1") {
                $group_sig = $agcy->CUSTOM_SIGNATURE;
				$cl_sig = $agcy->CUSTOM_SIGNATURE;
				$agent_sig = "$rowGetGr->NAME - $rowGetUr->FNAME $rowGetUr->NAME $rowGetUr->CL_PHONEU $rowGetUr->CL_EMAILU";
} else {
                $group_sig = "";
				$cl_sig = "";
				$agent_sig = "";
}



if ($rowGetUr->CL_HEADERU)
{       $page = str_replace("</textarea>", "$agent_sig<BR> $bodypage</textarea>", $page);}

elseif(($rowGetUr->CL_EMAILU) OR ($rowGetUr->CL_PHONEU))
{       $page = str_replace("</textarea>", "$cl_sig <BR>$bodypage</textarea>", $page);}


elseif(($rowGetGr->CL_HEADER) AND ($rowGetUr->CL_HEADERU==""))
{       $page = str_replace("</textarea>", "$cl_sig<BR> $bodypage</textarea>", $page);}


elseif(($rowGetGr->CL_EMAIL) AND ($rowGetUr->CL_HEADERU==""))
{       $page = str_replace("</textarea>", "$cl_sig<BR> $bodypage</textarea>", $page);}

elseif(($rowGetGr->CL_PHONE) AND ($rowGetUr->CL_HEADERU==""))
{       $page = str_replace("</textarea>", "$cl_sig<BR> $bodypage</textarea>", $page);}

else { 



$page = str_replace("</textarea>", "$group_sig<BR>$bodypage</textarea>", $page);


}


        $page = str_replace("<option value=\"0\" selected>0", "<option value=\"0\">0", $page);



if($rowGetAd->ROOMS < 1)
{	$page = str_replace("<option value=\"0\">0", "<option value=\"0\" selected>0", $page);	}

elseif($rowGetAd->ROOMS >= 1 AND $rowGetAd->ROOMS < 2)
{	$page = str_replace("<option value=\"1\">1", "<option value=\"1\" selected>1", $page);	}

elseif($rowGetAd->ROOMS >= 2 AND $rowGetAd->ROOMS < 3)
{	$page = str_replace("<option value=\"2\">2", "<option value=\"2\" selected>2", $page);	}

elseif($rowGetAd->ROOMS >= 3 AND $rowGetAd->ROOMS < 4)
{	$page = str_replace("<option value=\"3\">3", "<option value=\"3\" selected>3", $page);	}

elseif($rowGetAd->ROOMS >= 4 AND $rowGetAd->ROOMS < 5)
{	$page = str_replace("<option value=\"4\">4", "<option value=\"4\" selected>4", $page);	}

elseif($rowGetAd->ROOMS >= 5 AND $rowGetAd->ROOMS < 6)
{	$page = str_replace("<option value=\"5\">5", "<option value=\"5\" selected>5", $page);	}

elseif($rowGetAd->ROOMS >= 6 AND $rowGetAd->ROOMS < 7)
{	$page = str_replace("<option value=\"6\">6", "<option value=\"6\" selected>6", $page);	}

elseif($rowGetAd->ROOMS >= 7 AND $rowGetAd->ROOMS < 8)
{	$page = str_replace("<option value=\"7\">7", "<option value=\"7\" selected>7", $page);	}

elseif($rowGetAd->ROOMS >= 8 AND $rowGetAd->ROOMS < 9)
{	$page = str_replace("<option value=\"8\">8", "<option value=\"8\" selected>8", $page);	}

elseif($rowGetAd->ROOMS  >= 9)
{	$page = str_replace("<option value=\"9\">9", "<option value=\"9\" selected>9", $page); }



if ($rowGetAd->NOFEE=="8") { $page = str_replace("FULL FEE (Don't Print)", "", $page);   }

		        $page = str_replace(".00 BEDROOM", " Bedroom", $page);
				$page = str_replace(".50 BEDROOM", ".5 Bedroom", $page);
				$page = str_replace("99.00 BATHROOM", "Shared Bath", $page);
				$page = str_replace(".50 BATHROOM", ".5 Bath", $page);
				$page = str_replace(".00 BATHROOM", " Bath", $page);
				$page = str_replace("0.75 BATHROOM", " 3/4 Bath", $page);
				$page = str_replace("0.50 BATHROOM", " 1/2 Bath", $page);
				$page = str_replace("0.75 BATH", " 3/4 Bath", $page);
				$page = str_replace("0.50 BATH", " 1/2 Bath", $page);
				$page = str_replace("99.00  Bathroom", " Shared Bath", $page);
				$page = str_replace("0.75  Bath", " 3/4 Bath", $page);
				$page = str_replace("0.75 Bath", " 3/4 Bath", $page);
				$page = str_replace("- 0 Bath -", "", $page);
				$page = str_replace(".78 BEDROOM", " BED LOFT", $page);
				$page = str_replace("0.75 BEDROOM", " STUDIO + ALCOVE", $page);
				$page = str_replace("0.76 BEDROOM", " 2 ROOM STUDIO", $page);
				$page = str_replace("0.79 BEDROOM", " STUDIO + LOFT BED", $page);				
				$page = str_replace(".00 Bed", "  Bed", $page);
				$page = str_replace(".00 Bath", "  Bath", $page);
				$page = str_replace(".00  Bath", "  Bath", $page);
				$page = str_replace(" 0.5 BEDROOM", "Studio", $page);

$sqlgetState="SELECT * FROM STATES WHERE STATE_ID=$rowGetAd->STATE";
                $getState=mysqli_query($dbh, $sqlgetState);
                $State=mysqli_fetch_object($getState);




$page = str_replace("ATTLEBOROUGH", "ATTLEBORO", $page);
$page = str_replace("Attleborough", "Attleboro", $page);


$page = str_replace("<button type=\"button\" style=\"display:none;\" id=\"imgbtn\">Add / Edit Images</button>", "", $page);




$page = str_replace("name=\"postal\" size=\"6\" maxlength=\"15\" value=\"\">", "name=\"postal\" size=\"6\" maxlength=\"15\" value=\"$rowGetAd->ZIP\">", $page);

/* $page = str_replace("name=\"postal\"   size=\"10\"  maxlength=\"15\" value=\"\">", "name=\"postal\"   size=\"10\"  maxlength=\"15\" value=\"$rowGetAd->ZIP\">", $page);

/*		$page = str_replace("name=\"region\"   size=\"3\"  maxlength=\"10\" value=\"\"", "name=\"region\"   size=\"3\"  maxlength=\"10\" value=\"$State->ABV\"", $page);
        $page = str_replace("name=\"region\"   size=\"2\"  maxlength=\"2\" value=\"\">", "name=\"region\"   size=\"2\"  maxlength=\"2\" value=\"MA\">", $page);
		$page = str_replace("name=\"city\"     size=\"20\" maxlength=\"80\" value=\"\">", "name=\"city\"     size=\"20\" maxlength=\"80\" value=\"$rowGetAd->LOCNAME\">", $page);
*/

		$page = str_replace("name=\"city\" size=\"20\" maxlength=\"80\" value=\"\">", "name=\"city\" size=\"20\" maxlength=\"80\" value=\"$rowGetAd->LOCNAME\">", $page);
		$page = str_replace("name=\"region\" size=\"2\" maxlength=\"2\" value=\"\">", "name=\"region\" size=\"2\" maxlength=\"2\" value=\"MA\">", $page);
		$page = str_replace("name=\"postal\" size=\"10\" maxlength=\"15\" value=\"\">", "name=\"postal\" size=\"10\" maxlength=\"15\" value=\"$rowGetAd->ZIP\">", $page);

				
// fill in cl street and x-street

if ($rowGetAd->CLI =="1024" AND $rowGetAd->MAP =="8")
{	
        $page = str_replace("name=\"xstreet0\" size=\"20\" maxlength=\"80\" value=\"\">", "name=\"xstreet0\" size=\"20\" maxlength=\"80\" value=\"$rowGetAd->STREET_NUM $rowGetAd->STREET\">", $page);

}


if (($rowGetAd->MAP =="3" || $rowGetAd->MAP =="8") AND $rowGetAd->CLI !="1024")
{	



        $page = str_replace("name=\"xstreet0\" size=\"20\" maxlength=\"80\" value=\"\">", "name=\"xstreet0\" size=\"20\" maxlength=\"80\" value=\"$rowGetAd->STREET_NUM $rowGetAd->STREET\">", $page);

}




if ($rowGetAd->MAP =="2" || $rowGetAd->MAP =="5" || $rowGetAd->MAP =="7" || $rowGetAd->MAP =="9" || $rowGetAd->MAP=="10")
{	

$page = str_replace("name=\"xstreet0\" size=\"20\" maxlength=\"80\" value=\"\">", "name=\"xstreet0\" size=\"20\" maxlength=\"80\" value=\"$rowGetAd->STREET\">", $page);


	}


if ($rowGetAd->MAP =="3" || $rowGetAd->MAP =="5" || $rowGetAd->MAP =="8" || $rowGetAd->MAP =="9" || $rowGetAd->MAP=="10")
{	


        $page = str_replace("name=\"xstreet1\" size=\"20\" maxlength=\"80\" value=\"\">", "name=\"xstreet1\" size=\"20\" maxlength=\"80\" value=\"$rowGetAd->xstreet\">", $page);

		
		
		}

// shrinks the cl disclaimer
$page = str_replace("<div class=\"highlight\">", "<div class=\"highlight\"><div style=\"margin:5px;font-size:10px;\">", $page);
$page = str_replace("housing law</a>\n\t</ul>\n</div>", "housing law</a>\n\t</ul>\n</div></DIV>", $page);



// clean up form form for looks
// $page = str_replace("Rent:</span><br>", "Rent:", $page);

$page = str_replace("<br>\n\n\n<div>
", "<div>", $page);

$page = str_replace("<br><br>", "<br>", $page);
$page = str_replace("<hr>", "", $page);
$page = str_replace("Available: Now.", "Available Now", $page);
$page = str_replace("Available:", "Available ", $page);

$page = str_replace("  ", " ", $page);
$page = str_replace("  ", " ", $page);

$page = str_replace("NO FEE (Don't print)", "", $page);
$page = str_replace("FULL FEE (Don't Print)", "", $page);
$page = str_replace("FEE (Don't Print)", "", $page);


// PRICE form fill in

preg_match('/.*maxlength="11" name="(.*)" value="".*/',$page,$matches);
$clprice = $matches[1];
$page = str_replace("maxlength=\"11\" name=\"$clprice\" value=\"\"", "maxlength=\"11\" name=\"$clprice\" value=\"$rowGetAd->PRICE\"", $page);

// Bath fill in


$page = str_replace("<option selected value =\"0\"></option>\n<option value =\"1\">shared</option>", "<option value =\"0\"></option>\n<option value =\"1\">shared</option>", $page);

if($rowGetAd->BATH=="0.50"){
$page = str_replace("<option value =\"3\">1</option>", "<option selected value =\"3\">1</option>", $page);
}
if($rowGetAd->BATH=="0.75"){
$page = str_replace("<option value =\"3\">1</option>", "<option selected value =\"3\">1</option>", $page);
}
if($rowGetAd->BATH=="1.00"){
$page = str_replace("<option value =\"3\">1</option>", "<option selected value =\"3\">1</option>", $page);
}
if($rowGetAd->BATH=="1.50"){
$page = str_replace("<option value =\"4\">1.5</option>", "<option selected value =\"4\">1.5</option>", $page);
}
if($rowGetAd->BATH=="2.00"){
$page = str_replace("<option value =\"5\">2</option>", "<option selected value =\"5\">2</option>", $page);
}
if($rowGetAd->BATH=="2.5"){
$page = str_replace("<option value =\"6\">2.5</option>", "<option selected value =\"6\">2.5</option>", $page);
}
if($rowGetAd->BATH=="3.00"){
$page = str_replace("<option value =\"7\">3</option>", "<option selected value =\"7\">3</option>", $page);
}
if($rowGetAd->BATH=="3.50"){
$page = str_replace("<option value =\"8\">3.5</option>", "<option selected value =\"8\">3.5</option>", $page);
}
if($rowGetAd->BATH=="4.00"){
$page = str_replace("<option value =\"9\">4</option>", "<option selected value =\"9\">4</option>", $page);
}
if($rowGetAd->BATH=="4.50"){
$page = str_replace("<option value =\"10\">4.5</option>", "<option selected value =\"0\">4.5</option>", $page);
}
if($rowGetAd->BATH=="5.00"){
$page = str_replace("<option value =\"11\">5</option>", "<option selected value =\"11\">5</option>", $page);
}
if($rowGetAd->BATH=="5.50"){
$page = str_replace("<option value =\"12\">5.5</option>", "<option selected value =\"12\">5.5</option>", $page);
}
if($rowGetAd->BATH=="6.00"){
$page = str_replace("<option value =\"13\">6</option>", "<option selected value =\"13\">6</option>", $page);
}
if($rowGetAd->BATH=="6.50"){
$page = str_replace("<option value =\"14\">6.5</option>", "<option selected value =\"14\">6.5</option>", $page);
}
if($rowGetAd->BATH=="7.00"){
$page = str_replace("<option value =\"15\">7</option>", "<option selected value =\"15\">7</option>", $page);
}
if($rowGetAd->BATH=="7.50"){
$page = str_replace("<option value =\"16\">7.5</option>", "<option selected value =\"16\">7.5</option>", $page);
}
if($rowGetAd->BATH=="8.00"){
$page = str_replace("<option value =\"17\">8</option>", "<option selected value =\"17\">8</option>", $page);
}
if($rowGetAd->BATH=="8.50"){
$page = str_replace("<option value =\"18\">8.5</option>", "<option selected value =\"18\">8.5</option>", $page);
}
if($rowGetAd->BATH >= "9.00"){
$page = str_replace("<option value =\"19\">9+</option>", "<option selected value =\"19\">9+</option>", $page);
}
if($rowGetAd->BATH=="99.00"){
$page = str_replace("<option value =\"1\">shared</option>", "<option selected value =\"1\">shared</option>", $page);
}



// laundry

$page = str_replace("<option selected value =\"0\"></option>\n<option value =\"1\">w/d in unit</option>", "<option value =\"0\"></option>\n<option value =\"1\">w/d in unit</option>", $page);

if($rowGetAd->LAUNDRY_ROOM=="1" OR $rowGetAd->LAUNDRY_ROOM=="2" OR $rowGetAd->LAUNDRY_ROOM=="8"){
$page = str_replace("<option value =\"2\">laundry in bldg", "<option selected value =\"2\">laundry in bldg", $page);
}
if($rowGetAd->LAUNDRY_ROOM=="7"){
$page = str_replace("<option value =\"3\">laundry on site", "<option selected value =\"3\">laundry on site", $page);
}
if($rowGetAd->LAUNDRY_ROOM=="4" OR $rowGetAd->LAUNDRY_ROOM=="6"){
$page = str_replace("<option value =\"4\">w/d hookups", "<option selected value =\"4\">w/d hookups", $page);
}
if($rowGetAd->LAUNDRY_ROOM=="5"){
$page = str_replace("<option value =\"1\">w/d in unit", "<option selected value =\"1\">w/d in unit", $page);
}
if($rowGetAd->LAUNDRY_ROOM=="99"){
$page = str_replace("<option value =\"0\"></option>\n<option value =\"1\">w/d in unit</option>", "<option selected value =\"0\"></option>\n<option value =\"1\">w/d in unit</option>", $page);
}



//  parking

$page = str_replace("<option selected value =\"0\"></option>\n<option value =\"1\">carport</option>", "<option selected value =\"0\"></option>\n<option value =\"1\">carport</option>", $page);

if($rowGetAd->PARKING_TYPE=="1" OR $rowGetAd->PARKING_TYPE=="4" OR $rowGetAd->PARKING_TYPE=="5" OR $rowGetAd->PARKING_TYPE=="6" OR $rowGetAd->PARKING_TYPE=="8" OR $rowGetAd->PARKING_TYPE=="11" OR $rowGetAd->PARKING_TYPE=="12" OR $rowGetAd->PARKING_TYPE=="14" OR $rowGetAd->PARKING_TYPE=="15"){
$page = str_replace("<option value =\"4\">off-street parking", "<option selected value =\"4\">off-street parking", $page);
}
if($rowGetAd->PARKING_TYPE=="9"){
$page = str_replace("<option value =\"1\">carport", "<option selected value =\"1\">carport", $page);
}
if($rowGetAd->PARKING_TYPE=="10"){
$page = str_replace("<option value =\"6\">valet parking", "<option selected value =\"6\">valet parking", $page);
}
if($rowGetAd->PARKING_TYPE=="3" OR $rowGetAd->PARKING_TYPE=="13" OR $rowGetAd->PARKING_TYPE=="18"){
$page = str_replace("<option value =\"3\">detached garage", "<option selected value =\"3\">detached garage", $page);
}
if($rowGetAd->PARKING_TYPE=="2" OR $rowGetAd->PARKING_TYPE=="7" OR $rowGetAd->PARKING_TYPE=="16"){
$page = str_replace("<option value =\"5\">street parking", "<option selected value =\"5\">street parking", $page);
}

//  SQFT

if($rowGetAd->SQFT !=NULL){
preg_match('/.*size="3" maxlength="6" name="(.*)" id="(.*)" value="".*/',$page,$matches);
$clsq1 = $matches[1];
$clsq2 = $matches[2];
$page = str_replace("size=\"3\" maxlength=\"6\" name=\"$clsq1\" id=\"$clsq2\" value=\"\"", "size=\"3\" maxlength=\"6\" name=\"$clsq1\" id=\"$clsq2\" value=\"$rowGetAd->SQFT\"", $page);
}


$page = str_replace("(e.g. '<b>hispanic area</b>'), religion (e.g. '<b>christian home</b>'), age / familial status (e.g. '<b>no kids</b>'), disability, sexual orientation, or source of income", "", $page);


echo "<div style=\"margin:5px;font-size:10px;font-family:Verdana,Arial,Helvetica;width:99%;border:1px solid black;background-color:#FFE87C;align:center;\">&nbsp; <I>Make sure you are logged into Craigslist when using <B>BostonApartments.com</B> to post. Navigate to the proper posting page in Craigslist on the right. When at the final posting form, click the copy button to fill in the fields in the Craigslist window and continue posting from there.</I><BR></B></DIV>"; 

echo "<div style=\"margin:5px;font-size:8px;font-family:Verdana,Arial,Helvetica;>";


$page = str_replace("www.bostonapartments.com", "www.bostonrealty.com", $page);

$page = str_replace("<div style=\"margin:5px;font-size:8px;font-family:Verdana,Arial,Helvetica;>", "<div style=\"margin:5px;font-size:8px;font-family:Verdana,Arial,Helvetica;width: 450px;>", $page);




$page = str_replace("<button tabindex", "<font color=red size=+1>Use the picture codes in the other tab after you hit continue</font><BR><button tabindex", $page);
 
 
echo $page;



?>

 </div>

 </TD><TD VALIGN=TOP HEIGHT=1200px>

<div class="box2">
 <!--   <button id="send-data-to-iframe">Send data to iframe</button> -->


<script type="text/javascript">
function notEmpty(){
	var myFromEMail = document.getElementById('FromEMail');
	var myConfirmEMail = document.getElementById('ConfirmEMail');
	if(myFromEMail.value != "")

		alert("FromEMail: " + myFromEMail.value + "ConfrimEMail" +myConfirmEMail.value)

	else
		alert("Would you please enter some text?")		
}
</script>
<!-- input type='text' id='myText' /> -->
<input type='button' onclick='notEmpty()' value='Form Checker' />



 
	  <div id="myElement">Click Me</div>
	  
	  
	
    <br /><br />


  <iframe name="clframe" id="clframe" src="https://post.craigslist.org/c/bos?lang=en" frameborder="2" scrolling="yes" width="800" height="1400">
  </iframe>

  <script>

  

  
  
 var iframe = document.getElementById('clframe'),
 iframedoc = iframe.contentDocument || iframe.contentWindow.document;
	
iframedoc.body.innerHTML = 'Hello world'; 



function addEvent(element, evnt, funct){
    if (element.attachEvent)
        return element.attachEvent('on'+evnt, funct);
    else
        return element.addEventListener(evnt, funct, false);
}

// example
addEvent(
    document.getElementById('myElement'),
    'click',
    function () { alert('hi!'); }
);

	  
</SCRIPT>






  
  </div>

</TD></TR></TABLE>

</BODY>
</html>