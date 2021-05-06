<?php

$RentJuiceAPIKey = $_POST["user"];
 
if ($RentJuiceAPIKey != "" && $RentJuiceAPIKey != "RentJuice API-Key" && strlen($RentJuiceAPIKey) > 10) 
{
	echo "Okey, will save your api-key: " . $RentJuiceAPIKey;
}
else 
{
	echo "No.. ";
}





?>