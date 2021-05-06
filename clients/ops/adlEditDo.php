<?php
//BEGIN adlEdit.php //


    $quStrGetCLI = "select `CLI`, `CSOURCE` from `CLASS` where `CID`=".($_POST['cid'] ?? "");
    $quGetCLI = mysqli_query($GLOBALS['dbh'], $quStrGetCLI) or die (mysqli_error($GLOBALS['dbh']));
$testCLI = null;
 while ($rowGetCLI = mysqli_fetch_object($quGetCLI)) {  
 $testCLI = $rowGetCLI->CLI;
 $testCSOURCE = $rowGetCLI->CSOURCE;
// echo $testCLI;
// echo $testCSOURCE;
 }

 
 
if ($testCLI!=$grid AND ($_POST['cid'])) {

$msg = "Network Listing - Not your listing to save";

} else {


$AH = mysqli_real_escape_string($GLOBALS['dbh'], $_POST['AGENCY_HEADERS1']);
$body_agent = mysqli_real_escape_string($GLOBALS['dbh'], $_POST['BODY_AGENT']);
$new_agent_ad = mysqli_real_escape_string($GLOBALS['dbh'], $_POST['NEW_AGENT_AD']);


$_POST['PRICE'] = str_replace(",", "", $_POST['PRICE']);


	$postedCount = count($_POST);
	$i = 0;
	$now = date ("Ymd");

	$nowDay = date ("d");
	$nowMon = date ("m");
	$nowYear = date ("Y");
        
//        foreach ($_POST as $key => $value) {
//        echo "<tr>";
//        echo "<td>";
//        echo $key;
//        echo "</td>";
//        echo "<td>";
//        echo $value;
//        echo "</td>";
//        echo "</tr>";
//        echo "<br/>";
//    }

	$bbbMonth = $_POST['bbbMonth'];
	$bbbDay   = $_POST['bbbDay'];
	$bbbYear  = $_POST['bbbYear'];
//        echo $bbbMonth;
//        echo $bbbDay;
//        echo $bbbYear;
	if ($bbbMonth !== "--" && $bbbDay !== "--" && $bbbYear !== "--") {
		$avail = $bbbYear.$bbbMonth.$bbbDay;
	} else {
		$avail = 0;
	}
//        echo 'Avail val:';
//        echo $avail;
	$bbbLEMonth = $_POST['bbbLEMonth'];
	$bbbLEDay   = $_POST['bbbLEDay'];
	$bbbLEYear  = $_POST['bbbLEYear'];
	if ($bbbLEMonth !== "--" && $bbbLEDay !== "--" && $bbbLEYear !== "--") {
		$lease_expire = $bbbLEYear.$bbbLEMonth.$bbbLEDay;
	} else {
		$lease_expire = 0;
	}
	
	$pomMonth = $_POST['pomMonth'];
	$pomDay   = $_POST['pomDay'];
	$pomYear  = $_POST['pomYear'];
	if ($pomMonth !== "--" && $pomDay !== "--" && $pomYear !== "--") {
		$dateonmarket = $pomYear.$pomMonth.$pomDay;
	} else {
		$dateonmarket = 0;
	}
	
	
	
	$body = prepareAdBody($_POST['BODY'], false);
	$body = mysqli_real_escape_string($GLOBALS['dbh'], $body);


	
	if ($_POST['cid']) {

if ($_SESSION["isAdmin"] OR ($_SESSION["user_level"] >="4")) {
		$UPDATESTR = "UPDATE CLASS SET `MOD`='$now', MODBY='".$_SESSION["handle"]."', AVAIL='$avail', LEASE_EXPIRE='$lease_expire', `DATEONMARKET`='$dateonmarket', BODY='$body', AGENCY_HEADERS='$AH', ";
} else {
		$UPDATESTR = "UPDATE CLASS SET `MOD`='$now', MODBY='".$_SESSION["handle"]."', AVAIL='$avail', LEASE_EXPIRE='$lease_expire', `DATEONMARKET`='$dateonmarket', BODY='$body', AGENCY_HEADERS='$assigned_agency', ";
}
		foreach ($_POST as $field => $value) {
                 
		$value=mysqli_real_escape_string($GLOBALS['dbh'], $value);
                
			if ($i==($postedCount-1)) {
				if ($field !== "cid" && $field !=="STATUS" && $field !=="adlEditNav" && $field !=="AGENCY_HEADERS" && $field !=="AGENCY_HEADERS1" && $field !=="BODY_AGENT" && $field !=="NEW_AGENT_AD" && $field !=="DATEONMARKET" && $field !=="pomMonth" && $field !=="pomDay" && $field !=="pomYear") {
					if ($value=="--") {
						$UPDATESTR .= "`$field`='' ";

					} else {
						$UPDATESTR .= "`$field`='$value' ";
					}
				}elseif ($field == "STATUS") {
					if ($value=='ACT') {
                                            
						$quStrCheckAct = "SELECT count(CID) AS ACTCOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid'";
                                                $quCheckAct = mysqli_query($GLOBALS['dbh'], $quStrCheckAct);
                                                
                                             
						$rowCheckAct = mysqli_fetch_object($quCheckAct);
						if (($rowCheckAct->ACTCOUNT + 1) > $maxAct) {
							$value = "STO";
						}
						
					}
					$UPDATESTR .= "`$field`='$value' ";
				}
			}elseif(strstr($field, "bbb") || $field == "BODY") {
				$foo = "bar";
			}else {
				if ($field !== "cid" && $field !=="STATUS" && $field !=="adlEditNav" && $field !=="AGENCY_HEADERS" && $field !=="AGENCY_HEADERS1" && $field !=="BODY_AGENT" && $field !=="NEW_AGENT_AD" && $field !=="DATEONMARKET" && $field !=="pomMonth" && $field !=="pomDay" && $field !=="pomYear") {
					if ($value=="--") {
						$UPDATESTR .= "`$field`='', ";
					} else {
						$UPDATESTR .= "`$field`='$value', ";
					}
				}elseif ($field == "STATUS") {
					if ($value=='ACT') {
                                    
						$quStrCheckAct = "SELECT count(CID) AS ACTCOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid'";
                                                $quCheckAct = mysqli_query($GLOBALS['dbh'], $quStrCheckAct);
						
                                                $rowCheckAct = mysqli_fetch_object($quCheckAct);
						if (($rowCheckAct->ACTCOUNT + 1) > $maxAct) {
							$value = "STO";
						}
						
					}
					$UPDATESTR .= "`$field`='$value', ";
					
				}



			}
			$i++;
                       
		}
            
		if (isset($_POST["FEATURED"]) and $_POST["FEATURED"]>0)
		{
                    
			$UPDATESTR .= ", `FEATURED`=1 ";
		} else {
                 
			$UPDATESTR .= ", `FEATURED`=0 ";
		}


		
				if (isset($_POST["LUXURY_APT"]) and $_POST["LUXURY_APT"]>0)
		{
			$UPDATESTR .= ", `LUXURY_APT`=1 ";
		} else {
			$UPDATESTR .= ", `LUXURY_APT`=0 ";
		}
		
		
		
		

		if (isset($_POST["COBROKE"]) and $_POST["COBROKE"]>0)
		{
			$UPDATESTR .= ", `COBROKE`=1 ";
		} else {
			$UPDATESTR .= ", `COBROKE`=0 ";
		}



		$UPDATESTR .= " WHERE CID=" . $_POST['cid'] . " AND CLI=$grid";
		$msg = "Listing " . $_POST['cid'] . " updated by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear. 		
		&nbsp;&nbsp;

<a href=\"".$_SERVER['PHP_SELF']."?op=adlEdit&cid=".($cid??"")."\"><img border=0 src=\"../images/icons/edit.gif\" alt=\"edit\" title=\"edit\" vspace=\"0\" hspace=\"0\"></a>


<a href=\"".$_SERVER['PHP_SELF']."?op=hot_list_add&item_type=1&item_id=".($cid??"")."\"><img width=\"16\" height=\"16\" border=\"0\" vspace=\"0\" hspace=\"0\" src=\"../assets/images/hot.gif\" alt=\"Add to Hot List\" title=\"Add to Hot List\"></a>


<a href=\"".$_SERVER['PHP_SELF']."?op=mail_listing&cid=".($cid??"")."\" target=\"_new\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22 alt=\"Email Listing\" title=\"Email Listing\"></A>



<a href=\"https://www.BostonApartments.com/plugin/?ad=".($cid??"")."&cli=$grid&uid=$uid\" target=\"_cl".($cid??"")."\"><img width=\"16\" height=\"16\" border=\"0\" vspace=\"0\" hspace=\"0\" src=\"../images/icons/cl.gif\" alt=\"Post to Craigslist\" title=\"Post to Craigslist\"></a>


<a href=\"http://www.facebook.com/sharer.php?u=http%3A%2F%2Fbostonapartments.com%2Fhomepage.php%3Fcli%3D$grid%26ad%3D".($cid??"")."\" target=\"_FB".($cid??"")."\"><img width=\"16\" height=\"16\" border=\"0\" vspace=\"0\" hspace=\"0\" src=\"../images/icons/facebook.gif\" alt=\"Post to Facebook\" title=\"Post to Facebook\"></A>


<A HREF=\"".$_SERVER['PHP_SELF']."?op=createshowing&cid=".($cid??"")."\"><img border=0 src=\"../assets/images/showings.jpg\" alt=\"edit\" vspace=\"0\" hspace=\"0\" HEIGHT=\"16\" WIDTH=\"16\" TITLE=\"Create A Showing\"></A>

<A HREF=\"".$_SERVER['PHP_SELF']."?op=openhouse-add&CID=".($cid??"")."\"><IMG SRC=\"../assets/images/openhouse.jpg\" height=\"16\" WIDTH=\"16\" BORDER=\"0\" ALT=\"Create Open House\" TITLE=\"Create an Open House\"></A><NOBR>";


	//	$msg=$UPDATESTR;
	
                
                } else {
	
	//INSERT LISTING ADD A NEW LISTING//
			//$return_page = "sel";

if ($_SESSION["isAdmin"] OR ($_SESSION["user_level"] >="4")) {
			$FIELD_LIST = "(`CLI`, `DATEIN`, `MOD`, `MODBY`, `AVAIL`, `LEASE_EXPIRE`, `DATEONMARKET`, BODY, AGENCY_HEADERS, ";
			$VALUE_LIST = "('$grid', '$now', '$now', '".$_SESSION["handle"]."', '$avail', '$lease_expire', '$now', '$body', '$AH', ";
} else {
			$FIELD_LIST = "(`CLI`, `DATEIN`, `MOD`, `MODBY`, `AVAIL`, `LEASE_EXPIRE`, `DATEONMARKET`, BODY, AGENCY_HEADERS, ";
			$VALUE_LIST = "('$grid', '$now', '$now', '".$_SESSION["handle"]."', '$avail', '$lease_expire', '$now', '$body', '$assigned_agency', ";
}
			//allow admin to post UID//
			if (($_POST['UID'] && $_SESSION["isAdmin"])  OR ($_POST['UID'] && $_SESSION["user_level"] >="4")) {

				$uid2 = $_POST['UID'];
				$FIELD_LIST .= "`UID`, ";
				$VALUE_LIST .= "'$uid2',";

			}else {
				$FIELD_LIST .= "`UID`, ";
				$VALUE_LIST .= "'$uid',";
			}
        $UPDATESTR = "";
        try{
			foreach ($_POST as $field => $value) {
			$value=mysqli_real_escape_string($GLOBALS['dbh'], $value);
				if ($i==($postedCount-1)) {
					if ($field !== "cid" && $field !=="STATUS" && $field !=="adlEditNav" && $field !=="AGENCY_HEADERS" && $field !=="AGENCY_HEADERS1" && $field !=="BODY_AGENT" && $field !=="NEW_AGENT_AD" && $field !=="DATEONMARKET" && $field !=="UID" && $field !=="pomMonth" && $field !=="pomDay" && $field !=="pomYear") {
						if ($value=="--") {
							$FIELD_LIST .= " `$field` ";
							$VALUE_LIST .= " '' ";
						} else {
							$FIELD_LIST .= " `$field` ";
							$VALUE_LIST .= " '$value' ";
						}
					}elseif ($field == "STATUS") {
						if ($value=='ACT') {
							$quStrCheckAct = "SELECT count(CID) AS ACTCOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid'";
							$quCheckAct = mysqli_query($GLOBALS['dbh'], $quStrCheckAct);
							$rowCheckAct = mysqli_fetch_object($quCheckAct);
							if (($rowCheckAct->ACTCOUNT + 1) > $maxAct) {
								$value = "STO";
								
							}
							$FIELD_LIST .= " `$field` ";
							$VALUE_LIST .= " '$value' ";
						
						}
					}
					$UPDATESTR .= "`$field`='$value' ";
				}elseif(strstr($field, "bbb") || $field == "BODY") {
					$foo = "bar";
				}else {
					if ($field !== "cid" && $field !=="STATUS" && $field !=="adlEditNav" && $field !=="AGENCY_HEADERS" && $field !=="AGENCY_HEADERS1" && $field !=="BODY_AGENT" && $field !=="NEW_AGENT_AD" && $field !=="DATEONMARKET" && $field !=="UID" && $field !=="pomMonth" && $field !=="pomDay" && $field !=="pomYear")  {
						if ($value=="--") {
							$FIELD_LIST .= " `$field`, ";
							$VALUE_LIST .= " '', ";
						} else {
							$FIELD_LIST .= " `$field`, ";
							$VALUE_LIST .= " '$value', ";
						}
					}elseif ($field == "STATUS") {
						if ($value=='ACT') {
							$quStrCheckAct = "SELECT count(CID) AS ACTCOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid'";
							$quCheckAct = mysqli_query($GLOBALS['dbh'], $quStrCheckAct);
							$rowCheckAct = mysqli_fetch_object($quCheckAct);
							if (($rowCheckAct->ACTCOUNT + 1) > $_SESSION["maxAct"]) {
								$value = "STO";
								
							}
							$FIELD_LIST .= " `$field`, ";
							$VALUE_LIST .= " '$value', ";
						
						}
					}
				}
				$i++;
        }}catch(Exception $err){
                echo 'the err';
                echo $err;
            }


// FIX FOR EMPTY STATUS
try{
		$quStrUpdatestatus = "UPDATE CLASS SET STATUS = 'STO' WHERE STATUS='' AND UID='$uid'";
		$quUpdatestatus = mysqli_query($GLOBALS['dbh'], $quStrUpdatestatus);
        }catch(Exception $err){
                echo 'the err';
                echo $err;
            }

// END FIX




			$FIELD_LIST .= ")";
			$VALUE_LIST .= ")";
			$UPDATESTR = "INSERT INTO CLASS " . $FIELD_LIST . " VALUES " . $VALUE_LIST;

//			$new_cid = mysqli_insert_id();
		
	}
	//die ($UPDATESTR);
        try{
        // culprit found
//        
//                foreach ($GLOBALS as $key => $value) {
//        echo "<tr>";
//        echo "<td>";
//        echo $key;
//        echo "</td>";
//        echo "<td>";
//        echo $value;
//        echo "</td>";
//        echo "</tr>";
//        echo "<br/>";
//    }
            //echo $UPDATESTR;
        
	$quUpdateClass = mysqli_query($GLOBALS['dbh'], $UPDATESTR) or die (mysqli_error($GLOBALS['dbh'])); //($UPDATESTR);
	
    
        }catch(Exception $err){
                echo 'the err';
                echo $err;
            }
        if(!isset($cid))
	{ 
            try{
            $cid=mysqli_insert_id($GLOBALS['dbh']);
            }catch(Exception $err){
                echo 'the err';
                echo $err;
            }
	

$msg = "<NOBR>Listing $cid created by ".$_SESSION["handle"]." on $nowMon-$nowDay-$nowYear.

&nbsp;&nbsp;

<a href=\"".$_SERVER['PHP_SELF']."?op=adlEdit&cid=$cid\"><img border=0 src=\"../images/icons/edit.gif\" alt=\"edit\" title=\"edit\" vspace=\"0\" hspace=\"0\"></a>


<a href=\"".$_SERVER['PHP_SELF']."?op=hot_list_add&item_type=1&item_id=$cid\"><img width=\"16\" height=\"16\" border=\"0\" vspace=\"0\" hspace=\"0\" src=\"../assets/images/hot.gif\" alt=\"Add to Hot List\" title=\"Add to Hot List\"></a>


<a href=\"".$_SERVER['PHP_SELF']."?op=mail_listing&cid=$cid\" target=\"_new\"><IMG src=../images/icons/email.gif BORDER=0 HEIGHT=15 WIDTH=22 alt=\"Email Listing\" title=\"Email Listing\"></A>


<a href=\"https://www.BostonApartments.com/plugin/?ad=$cid&cli=$grid&uid=$uid\" target=\"_CL$cid\"><img width=\"16\" height=\"16\" border=\"0\" vspace=\"0\" hspace=\"0\" src=\"../images/icons/cl.gif\" alt=\"Post to Craigslist\" title=\"Post to Craigslist\"></A>


<a href=\"http://www.facebook.com/sharer.php?u=http%3A%2F%2Fbostonapartments.com%2Fhomepage.php%3Fcli%3D$grid%26ad%3D$cid\" target=\"_FB$cid\"><img width=\"16\" height=\"16\" border=\"0\" vspace=\"0\" hspace=\"0\" src=\"../images/icons/facebook.gif\" alt=\"Post to Facebook\" title=\"Post to Facebook\"></A>


<A HREF=\"".$_SERVER['PHP_SELF']."?op=createshowing&cid=$cid\"><img border=0 src=\"../assets/images/showings.jpg\" alt=\"edit\" vspace=\"0\" hspace=\"0\" HEIGHT=\"16\" WIDTH=\"16\" TITLE=\"Create A Showing\"></A>

<A HREF=\"".$_SERVER['PHP_SELF']."?op=openhouse-add&CID=$cid\"><IMG SRC=\"../assets/images/openhouse.jpg\" height=\"16\" WIDTH=\"16\" BORDER=\"0\" ALT=\"Create Open House\" TITLE=\"Create an Open House\"></A>

<NOBR>";

	
	
	}

//			$msg = "Listing $cid created by $_SESSION["handle"] on $nowMon-$nowDay-$nowYear.";







// UPDATE BODY_AGENT IN CLASS_AGENTS

if ($_POST['cid'] AND $new_agent_ad!=1) {
$quStrUpdateClass_Agents = "UPDATE CLASS_AGENTS SET BODY_AGENT='$body_agent' WHERE CID='$cid' AND UID='$uid'";
try{
$UpdateClass_Agents = mysqli_query($GLOBALS['dbh'], $quStrUpdateClass_Agents);
}catch(Exception $err){
                echo 'the err';
                echo $err;
            }

} elseif ($new_agent_ad==1 AND $body_agent=="") {
$foo = "bar";
} else {
$quStrUpdateClass_Agents = "INSERT INTO CLASS_AGENTS (UID, CLI, CID, BODY_AGENT) VALUES ('$uid', '$grid', '$cid', '$body_agent')";
try{
$UpdateClass_Agents = mysqli_query($GLOBALS['dbh'], $quStrUpdateClass_Agents) or die ($quStrUpdateClass_Agents);
}catch(Exception $err){
                echo 'the err';
                echo $err;
            }
}

// fix for empty body_agent //
// $quCleanClass_Agents = "DELETE FROM CLASS_AGENTS WHERE BODY_AGENT=''";
// $CleanClass_Agents = mysqli_query($GLOBALS['dbh'], $quCleanClass_Agents);
// now checks for empty body before deciding whether to pass (foo) or create new (insert)
// END BODY_AGENT IN CLASS_AGENTS




// FIX FOR EMPTY STATUS

		$quStrUpdatestatus = "UPDATE CLASS SET STATUS = 'STO' WHERE STATUS='' AND (CID='$cid' OR UID='$uid')";
		try{
                $quUpdatestatus = mysqli_query($GLOBALS['dbh'], $quStrUpdatestatus);
                }catch(Exception $err){
                echo 'the err';
                echo $err;
            }

// END FIX



	//FAVLOC STUFF//
	$loc = $_POST['LOC'];
	$quStrCheckRecFavLoc = "SELECT * FROM FAVLOC WHERE UID='$uid' AND LOC='$loc'";
	try{
        $quCheckRecFavLoc = mysqli_query($GLOBALS['dbh'], $quStrCheckRecFavLoc);
        }catch(Exception $err){
                echo 'the err';
                echo $err;
            }
	$numRows = mysqli_num_rows($quCheckRecFavLoc);
	if (!$numRows) {
		$quStrInsFavLoc = "INSERT INTO FAVLOC (LOC, UID, SCORE) VALUES ('$loc', '$uid', 1)";
		$quInsFavLoc = mysqli_query($GLOBALS['dbh'], $quStrInsFavLoc);
	}else {
		$quStrUpdateFavLoc = "UPDATE FAVLOC SET SCORE = SCORE + 1 WHERE LOC='$loc' AND UID='$uid'";
		$quUpdateFavLoc = mysqli_query($GLOBALS['dbh'], $quStrUpdateFavLoc);
	}
	

	// FIX FOR NO LOCATION

		$quStrUpdateLOC = "UPDATE CLASS SET LOC = '8752' WHERE LOC='0' AND (CID='$cid' OR UID='$uid')";
		$quUpdateLOC = mysqli_query($GLOBALS['dbh'], $quStrUpdateLOC);

	// END FIX


	//AUTO UPDATE LANDLORD

        if(isset($_POST['pref_auto_update_landlord'])){
        $pref_auto_update_landlord = $_POST['pref_auto_update_landlord'];}
        else{
            $pref_auto_update_landlord="0";
        }
        
        if ($pref_auto_update_landlord=="1") {
		if ($_POST['LANDLORD']) {
			$lid = $_POST['LANDLORD'];
			$now_now = date ("Ymd");
			$quStrUpdateLandlord = "UPDATE LANDLORD SET LAST_CONTACTED='$now_now' WHERE LID='$lid' AND GRID='$grid'";
			$quUpdateLandlord = mysqli_query($GLOBALS['dbh'], $quStrUpdateLandlord) or die (mysqli_error($GLOBALS['dbh']));
		}
	}



}

	
	//sort out where to go//
	if (isset($adlEditNav)) {
		if ($adlEditNav=="managePics") {
			$disData = "pics";
			$page = $adlEditNav;
		}elseif ($adlEditNav=="manageListingDeals") {
			$disData = "listingdeals";
			$disData2 = "listing";
			$page = $adlEditNav;
		}elseif ($adlEditNav=="printOuts") {
			$page = $adlEditNav;
		}elseif ($adlEditNav=="listings") {
			$disData = "listings";
			$page = "listings";
		}elseif ($adlEditNav=="sel") {
			$disData = "ads";
			$page = "sel";
		}
	}else {
		if ($return_page == "adlEdit") {
			$return_page = "listings";
		}
		$return_page_go = true;
	}
	
//END editListingDo //
?>
