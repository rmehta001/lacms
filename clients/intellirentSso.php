<?php 
	session_start();
	include("../inc/global.php");
	include("../inc/local_info.php");
	include("./app_core.php");

	$qqqq = "SELECT * FROM USERS WHERE UID=$uid";
	$resp = mysql_query($qqqq);
	$asdf = mysql_fetch_object($resp);
	
	if(!empty($asdf->EMAIL)){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://bostonapartments.myintellirent.com/api/v2/managers",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>"{\n    \"email\": \"{$asdf->EMAIL}\", \"external_group_id\": \"{$grid}\", \"phone_number\": \"{$asdf->CELLPHONE}\" \n}",
		  CURLOPT_HTTPHEADER => array(
		    "Security-Token: 663b73c7d5ee83419341eca7616505b0",
		    "Content-Type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		
		echo $response;
	}
	else{
		echo json_encode(array("error_message"=>"Email was not found"));
	}
?>