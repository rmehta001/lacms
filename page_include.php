<?php

session_register("loc");
session_register("rooms");
session_register("bath");
session_register("priceStart");
session_register("priceEnd");
session_register("sort");
session_register("start");


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