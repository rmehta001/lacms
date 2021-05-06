<?php
//BEGIN editListingDo.php //
	$postedCount = count($_POST);
	$i = 0;
	$now = date ("Ymd");
	$bbbMonth = $_POST['bbbMonth'];
	$bbbDay   = $_POST['bbbDay'];
	$bbbYear  = $_POST['bbbYear'];
	if ($bbbMonth !== "--" && $bbbDay !== "--" && $bbbYear !== "--") {
		$avail = $bbbYear.$bbbMonth.$bbbDay;
	} else {
		$avail = 0;
	}
	$bbbLEMonth = $_POST['bbbLEMonth'];
	$bbbLEDay   = $_POST['bbbLEDay'];
	$bbbLEYear  = $_POST['bbbLEYear'];
	if ($bbbLEMonth !== "--" && $bbbLEDay !== "--" && $bbbLEYear !== "--") {
		$lease_expire = $bbbLEYear.$bbbLEMonth.$bbbLEDay;
	} else {
		$lease_expire = 0;
	}
	
	$body = prepareAdBody($_POST['bbbBODY'], false);
	
	if ($_POST['cid']) {
		$UPDATESTR = "UPDATE CLASS SET `MOD`='$now', MODBY='$handle', AVAIL='$avail', LEASE_EXPIRE='$lease_expire', ";
		foreach ($_POST as $field => $value) {
			if ($i==($postedCount-1)) {
				if ($field !== "cid" && $field !=="STATUS") {
					if ($value=="--") {
						$UPDATESTR .= "`$field`='' ";
					} else {
						$UPDATESTR .= "`$field`='$value' ";
					}
				}elseif ($field == "STATUS") {
					if ($value=='ACT') {
						$quStrCheckAct = "SELECT count(CID) AS ACTCOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid'";
						$quCheckAct = mysqli_query($dbh, $quStrCheckAct);
						$rowCheckAct = mysqli_fetch_object($quCheckAct);
						if (($rowCheckAct->ACTCOUNT + 1) > $maxAct) {
							$value = "STO";
						}
						
					}
					$UPDATESTR .= "`$field`='$value' ";
				}
			}elseif(strstr($field, "bbb")) {
				$foo = "bar";
			}else {
				if ($field !== "cid" && $field !=="STATUS") {
					if ($value=="--") {
						$UPDATESTR .= "`$field`='', ";
					} else {
						$UPDATESTR .= "`$field`='$value', ";
					}
				}elseif ($field == "STATUS") {
					if ($value=='ACT') {
						$quStrCheckAct = "SELECT count(CID) AS ACTCOUNT FROM CLASS WHERE STATUS='ACT' AND CLI='$grid'";
						$quCheckAct = mysqli_query($dbh, $quStrCheckAct);
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
		$UPDATESTR .= " WHERE CID=" . $_POST['cid'] . " AND CLI=$grid";
		$msg = "Listing updated.";
		$return_page_go = false;
		$page = "listings";
		$disData = "listings";
		$needOptions = true;
	}else {
		//DEPRICIATED//
		die();
			$FIELD_LIST = "(`CLI`, `DATEIN`, `UID`, `MOD`, `MODBY`, `AVAIL`, `LEASE_EXPIRE`, ";
			$VALUE_LIST = "('$grid', '$now', '$uid', '$now', '$handle', '$avail', '$lease_expire', ";
			foreach ($_POST as $field => $value) {
				if ($i==($postedCount-1)) {
					if ($field !== "cid") {
						if ($value=="--") {
							$FIELD_LIST .= " `$field` ";
							$VALUE_LIST .= " '' ";
						} else {
							$FIELD_LIST .= " `$field` ";
							$VALUE_LIST .= " '$value' ";
						}
					}
				}elseif(strstr($field, "bbb")) {
					$foo = "bar";
				}else {
					if ($field !== "cid") {
						if ($value=="--") {
							$FIELD_LIST .= " `$field`, ";
							$VALUE_LIST .= " '', ";
						} else {
							$FIELD_LIST .= " `$field`, ";
							$VALUE_LIST .= " '$value', ";
						}
					}
				}
				$i++;
			}
			$FIELD_LIST .= ")";
			$VALUE_LIST .= ")";
			$UPDATESTR = "INSERT INTO CLASS " . $FIELD_LIST . " VALUES " . $VALUE_LIST;
			$msg = "Listing Created.";
		
	}
	//die ($UPDATESTR);
	$quUpdateClass = mysqli_query($dbh, $UPDATESTR) or die ($UPDATESTR);
	$page = "listings";
	$disData = "listings";
	$needOptions = true;
	
//END editListingDo //
?>
