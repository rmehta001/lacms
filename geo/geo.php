<?php
include("../inc/global.php");
include("../inc/local_info.php");
mysqli_select_db($dbh, $DBNAME);

$states[21]="MA";
$states[29]="NH";
$states[40]="RI";

$quStrAddr="SELECT * FROM CLASS INNER JOIN LOC ON CLASS.LOC=LOC.LOCID LIMIT 5";
$quReqAddr=mysqli_query($dbh, $quStrAddr);
//$quObjAddr=mysqli_fetch_object($quReqAddr);
//echo mysqli_num_rows($quReqAddr);
while($rowAddr = mysqli_fetch_object($quReqAddr))
{
   $city=preg_replace("/\ \-\ .*/","",$rowAddr->LOCNAME);
   $address="$rowAddr->STREET_NUM $rowAddr->STREET $city ".$states[$rowAddr->STATE]." $rowAddr->ZIP";
   $address=strtoupper($address);
   echo $address."<br>";
   $quStrCacheLookup="SELECT * FROM location_cache WHERE QUERY_STRING='".$address."'";
   $quReqCacheLookup=mysqli_query($dbh, $quStrCacheLookup);
   if(mysqli_num_rows($quReqCacheLookup) > 0)
   { echo "CACHE ENTRY FOUND<br>"; }
   else
   {
      $request_url="http://maps.google.com/maps/api/geocode/xml?address=".urlencode($address)."&sensor=false";
//      echo $request_url;
      $xml = simplexml_load_file($request_url) or die("url not loading");
      $request="BLANK";
      if($xml)
      {
         foreach($xml->children() as $child)
         {
           if($child->getName()=="status")
    	   {
	      if($child=="OK")
	      {
	         $request="OK";
   	      } else {
	         $request="ERROR";
		 $request_output="ERROR: ".$child->getName()."=".$child;
	      }
	   }
         }
         if($request=="OK")
         {
	    $results_array=$xml->xpath("result");
	    if(sizeof($results_array)>1)
	    { echo "ERROR: Multiple Results"; }
	    else {
	       foreach($xml->result as $result)
               {
   	          if($result->partial_match=="true") 
	          {  echo "ERROR: Partial match"; } 
	          else //($result->type=="street_address")
	          { 
		    foreach($result->address_component as $addr_comp)
		    {
//			echo $addr_comp->type;
			if($addr_comp->type=="postal_code")
			{ $zip=$addr_comp->short_name; }
		    }
		     echo "LAT: ".$result->geometry->location->lat
		     	  ." LNG: ".$result->geometry->location->lng; 
		     $insStrBuildings="INSERT INTO location_cache (TYPE,QUERY_STRING,LAT,LNG,LOC) "
	     			      ."VALUES (\""
				      .$result->type."\",\""
				      .$address."\",\""
				      .$result->geometry->location->lat."\",\""
				      .$result->geometry->location->lng."\",\""
				      .$rowAddr->LOC
				      ."\")";
//		     echo "<br>".$insStrBuildings;
		     $insReqBuildings=mysqli_query($dbh, $insStrBuildings);
		 }
	       }
	    }

         } else { echo $request_output; }
      } else {
        echo "ERROR: no xml output";
      }
   }
   usleep(250000);
//   echo $xml->asXML();
echo "<hr>";
}
?>
