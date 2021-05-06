<?PHP


$nowYYYYMMDD = date ("Y-m-d");

$RJurl = "http://api.rentjuice.com/4021d0063b9088c47c8d3baceae2bdd8/listings.xml?limit=500";
$RJFEED = file_get_contents($RJurl);

 $RJFEED = str_replace("<status>ok", "<field name=\"X\">ok", $RJFEED);

 
 
$RJFEED = str_replace("<![CDATA[", "", $RJFEED);
$RJFEED = str_replace("]]>", "", $RJFEED);

 $RJFEED = str_replace("<response>", "", $RJFEED);

$RJFEED = preg_replace('%<count>.*</count>%i', '', $RJFEED);
$RJFEED = preg_replace('%<page>.*</page>%i', '', $RJFEED);
$RJFEED = preg_replace('%<bedrooms_display>.*</bedrooms_display>%i', '', $RJFEED);


$RJFEED = preg_replace('% %i', ' ', $RJFEED);
$RJFEED = preg_replace('% %i', ' ', $RJFEED);
$RJFEED = preg_replace('%<address>.*</address>%i', '', $RJFEED);

 
 $RJFEED = preg_replace('%</field>\n%i', '</field>', $RJFEED);
 
 
 $RJFEED = eregi_replace('/<attribution></attribution>/', "", $RJFEED);
 
 
 
 $RJFEED = str_replace("<total_count>", "<number-of-listings>", $RJFEED);
 $RJFEED = str_replace("</total_count>", "</number-of-listings>", $RJFEED);
 
 
 $RJFEED = str_replace("<number-of-listings>", "<bstapts-transport-package>\n
 <account user=\"RentJuice\" pass=\"r3nt\" grid=\"1041\" regkey=\"r3ntjuic3\" /> \n
<transaction-info>\n<number-of-listings>", $RJFEED);


 $RJFEED = str_replace("</number-of-listings>", "</number-of-listings>\n <date-of-export>".$nowYYYYMMDD."</date-of-export>\n 
 <time-of-export>01:01:01</time-of-export>\n 
 </transaction-info>", $RJFEED);


 $RJFEED = str_replace("<listings>", " <listings>", $RJFEED);
 $RJFEED = str_replace("<listing>", " <listing>", $RJFEED);
 
 $RJFEED = str_replace("<rentjuice_id>", "<field name=\"EXTERNALID\">", $RJFEED);
 $RJFEED = str_replace("</rentjuice_id>", "</field>", $RJFEED);
 
 $RJFEED = str_replace("<status>active", "<field name=\"STATUS\">ACT", $RJFEED);
 $RJFEED = str_replace("</status>", "</field>", $RJFEED);

 $RJFEED = str_replace("<status>active", "<field name=\"STATUS\">ACT", $RJFEED);
 $RJFEED = str_replace("</status>", "</field>", $RJFEED);

 $RJFEED = str_replace("<street>", "<field name=\"STREET\">", $RJFEED);
 $RJFEED = str_replace("</street>", "</field>", $RJFEED);
 $RJFEED = str_replace("<street_number>", "<field name=\"STREET_NUM\">", $RJFEED);
 $RJFEED = str_replace("</street_number>", "</field>", $RJFEED); 
 $RJFEED = str_replace("<state>", "<field name=\"STATE\">", $RJFEED);
 $RJFEED = str_replace("</state>", "</field>", $RJFEED);
 $RJFEED = str_replace("<floor_number>", "<field name=\"FLOOR\">", $RJFEED);
 $RJFEED = str_replace("</floor_number>", "</field>", $RJFEED);
 $RJFEED = str_replace("<cross_street>", "<field name=\"xstreet\">", $RJFEED);
 $RJFEED = str_replace("</cross_street>", "</field>", $RJFEED);
 $RJFEED = str_replace("<unit_number>", "<field name=\"APT\">", $RJFEED);
 $RJFEED = str_replace("</unit_number>", "</field>", $RJFEED);
 $RJFEED = str_replace("<zip_code>", "<field name=\"ZIP\">", $RJFEED);
 $RJFEED = str_replace("</zip_code>", "</field>", $RJFEED);

$RJFEED = str_replace("<building_name>", "<field name=\"BUILDING_NAME\">", $RJFEED);
 $RJFEED = str_replace("</building_name>", "</field>", $RJFEED);


 $RJFEED = str_replace("<date_available>", "<field name=\"AVAIL\">", $RJFEED);
 $RJFEED = str_replace("</date_available>", "</field>", $RJFEED);
 $RJFEED = str_replace("<rent>", "<field name=\"PRICE\">", $RJFEED);
 $RJFEED = str_replace("</rent>", "</field>", $RJFEED);
 
 $RJFEED = str_replace("<rent>", "<field name=\"PRICE\">", $RJFEED);
 $RJFEED = str_replace("</rent>", "</field>", $RJFEED);

 $RJFEED = str_replace("<bedrooms>", "<field name=\"ROOMS\">", $RJFEED);
 $RJFEED = str_replace("</bedrooms>", "</field>", $RJFEED);
 $RJFEED = str_replace("<bathrooms>", "<field name=\"BATH\">", $RJFEED);
 $RJFEED = str_replace("</bathrooms>", "</field>", $RJFEED); 
 $RJFEED = str_replace("<title>", "<field name=\"AD_TITLE\">", $RJFEED);
 $RJFEED = str_replace("</title>", "</field>", $RJFEED); 
 
 
 $RJFEED = str_replace("<shared_notes>", "<field name=\"SHOW_INSTRUCT\">", $RJFEED);
 $RJFEED = str_replace("</shared_notes>", "</field>", $RJFEED);

 
 $RJFEED = str_replace("<description>", "<field name=\"BODY\">", $RJFEED);
 $RJFEED = str_replace("</description>", "</field>", $RJFEED);

 $RJFEED = str_replace("<parking_spaces>", "<field name=\"PARKING_NUM\">", $RJFEED);
 $RJFEED = str_replace("</parking_spaces>", "</field>", $RJFEED);


 $RJFEED = str_replace("<feature>Garage</feature>", "<field name=\"PARKING_TYPE\">3", $RJFEED);
 $RJFEED = str_replace("</parking_spaces>", "</field>", $RJFEED);



 
 $RJFEED = str_replace("<square_footage>", "<field name=\"SQFT\">", $RJFEED);
 $RJFEED = str_replace("</square_footage>", "</field>", $RJFEED);
 
 $RJFEED = str_replace("<features>", "", $RJFEED); 
 $RJFEED = str_replace("</features>", "", $RJFEED); 
 
 $RJFEED = str_replace("<fee></fee>", "", $RJFEED);
 $RJFEED = str_replace("<fee_display></fee_display>", "", $RJFEED);
 
 $RJFEED = str_replace("<type>boolean</type>", "", $RJFEED);
 
 $RJFEED = str_replace("<name>Is From Craigslist?</field>", "", $RJFEED);
 
 $RJFEED = str_replace("<name>Source is Craigslist?</name>", "", $RJFEED);
 
 $RJFEED = str_replace("<name>OK to Advertise</field>", "", $RJFEED);
 $RJFEED = str_replace("name>OK to Advertise</field>", "", $RJFEED);
 $RJFEED = str_replace("<value>false</value>", "", $RJFEED);
 $RJFEED = str_replace("<value>true</value>", "", $RJFEED); 
 $RJFEED = str_replace("<name>Import ID</field>", "", $RJFEED); 
 
 
 $RJFEED = str_replace("<custom_field>\n", "", $RJFEED);
 $RJFEED = str_replace("<custom_fields>\n", "", $RJFEED);
 $RJFEED = str_replace("</custom_field>\n", "", $RJFEED);
  $RJFEED = str_replace("</custom_fields>\n", "", $RJFEED);
 
 
 
 $RJFEED = str_replace("<source_name>", "<field name=\"MLS_AGENT\">", $RJFEED);
 $RJFEED = str_replace("</source_name>", "</field>", $RJFEED);
 

 
 
 
  $RJFEED = str_replace("</name>", "</field>", $RJFEED);

  $RJFEED = str_replace("<email>", "<field name=\"MLS_CONTACT\">", $RJFEED);
  $RJFEED = str_replace("</email>", "</field>", $RJFEED);

 
 $RJFEED = str_replace("<company>", "<field name=\"MLS_AGENCY\">", $RJFEED);
 $RJFEED = str_replace("</company>", "</field>", $RJFEED);
 $RJFEED = str_replace("<agent_email>", "<field name=\"MLS_CONTACT\">", $RJFEED);
 $RJFEED = str_replace("</agent_email>", "</field>", $RJFEED);
 $RJFEED = str_replace("<phone>", "<field name=\"MLS_PHONE\">", $RJFEED);
 $RJFEED = str_replace("</phone>", "</field>", $RJFEED);
 $RJFEED = str_replace("<current_tenant>", "<field name=\"TENANT\">", $RJFEED);
 $RJFEED = str_replace("</current_tenant>", "</field>", $RJFEED);
 
 
 
 $RJFEED = str_replace("<partner_rent></partner_rent>", "", $RJFEED);
 $RJFEED = str_replace("<features/>\n", "", $RJFEED);
 
 $RJFEED = str_replace("<photos/>\n", "", $RJFEED);
 $RJFEED = str_replace("<rental_terms/>\n", "", $RJFEED);
 $RJFEED = str_replace("<type>partner</type>\n", "", $RJFEED);
 $RJFEED = str_replace("<contacts>\n", "", $RJFEED);
 $RJFEED = str_replace("<contact>\n", "", $RJFEED);
 $RJFEED = str_replace("</contacts>\n", "", $RJFEED);
 $RJFEED = str_replace("</contact>\n", "", $RJFEED);
 
 //* features translations *//
 
 $RJFEED = str_replace("<feature>Hardwood floors</feature>", "<field name=\"FEATURES_HWFI\">1</field>", $RJFEED);
 $RJFEED = str_replace("<feature>Updated/renovated kitchen</feature>", "<field name=\"FEATURES_MODERN_KITCHEN\">1</field>", $RJFEED);
 $RJFEED = str_replace("<feature>Air Conditioning</feature>", "<field name=\"FEATURES_AC\">1</field>", $RJFEED);
 $RJFEED = str_replace("<feature>Central Air Conditioning</feature>", "<field name=\"FEATURES_CENTRAL_AC\">1</field>", $RJFEED);
 $RJFEED = str_replace("<feature>Patio or deck</feature>", "<field name=\"FEATURES_DECK\">1</field>", $RJFEED);
 $RJFEED = str_replace("<feature>Dining room</feature>", "<field name=\"FEATURES_DINNING_ROOM\">1</field>", $RJFEED);
 
 $RJFEED = str_replace("<feature>Dishwasher</feature>", "<field name=\"FEATURES_DISHWASHER\">1</field>", $RJFEED);
 $RJFEED = str_replace("<feature>Disposal</feature>", "<field name=\"FEATURES_DISPOSAL\">1</field>", $RJFEED);
 $RJFEED = str_replace("<feature>Dining room</feature>", "<field name=\"FEATURES_DINNING_ROOM\">1</field>", $RJFEED);
 
 $RJFEED = str_replace("<feature>Roof deck</feature>", "<field name=\"AMENITIES_ROOF_DECK\">1</field>", $RJFEED);
 
 $RJFEED = str_replace("<feature>Eat-in Kitchen</feature>", "<field name=\"FEATURES_EAT_IN_KITCHEN\">1</field>", $RJFEED);
 $RJFEED = str_replace("<feature>Yard</feature>", "<field name=\"AMENITIES_YARD\">1</field>", $RJFEED);
  $RJFEED = str_replace("<feature>Decorative fireplace</feature>", "<field name=\"FIREPLACE\">1</field>", $RJFEED);
  $RJFEED = str_replace("<feature>Storage unit</feature>", "<field name=\"AMENITIES_BIN\">1</field>", $RJFEED); 
 
 
 $RJFEED = str_replace("<feature>Washer/dryer in unit</feature>", "<field name=\"LAUNDRY_ROOM\">5</field>", $RJFEED);
 $RJFEED = str_replace("<feature>Laundry in unit</feature>", "<field name=\"LAUNDRY_ROOM\">5</field>", $RJFEED);
 $RJFEED = str_replace("<feature>Laundry in building</feature>", "<field name=\"LAUNDRY_ROOM\">7</field>", $RJFEED);
 $RJFEED = str_replace("<feature>On Site Laundry</feature>", "<field name=\"LAUNDRY_ROOM\">7</field>", $RJFEED);
 
 $RJFEED = str_replace("<feature>Carpet</feature>", "<field name=\"FEATURES_CARPET\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Business Center</feature>", "<field name=\"AMENITIES_BUSINESSCENTER\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>WiFi</feature", "<field name=\"FEATURES_INTERNET\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Fully furnished</feature>", "<field name=\"FEATURES_FURNISHED\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Outdoor porch</feature>", "<field name=\"FEATURES_PORCH\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Terrace</feature>", "<field name=\"FEATURES_PATIO\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Oil Heat</feature>", "<field name=\"HEATING_TYPE\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Valet</feature>", "<field name=\"AMENITIES_CONCIEARGE\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Deleaded</feature>", "<field name=\"FEATURES_DELEADED\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Media room or clubhouse</feature>", "<field name=\"AMENITIES_CLUBHOUSE\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Gym/athletic facilities</feature>", "<field name=\"AMENITIES_HEALTH_CLUB\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Pool</feature>", "<field name=\"AMENITIES_POOL\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Walk In Closet</feature>", "<field name=\"FEATURES_WALK_IN_CLOSET\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Gas Heat</feature>", "<field name=\"HEATING_TYPE\">3</field>", $RJFEED);
$RJFEED = str_replace("<feature>Oil Heat</feature>", "<field name=\"HEATING_TYPE\">1</field>", $RJFEED); 
$RJFEED = str_replace("<feature>Doorman</feature>", "<field name=\"AMENITIES_CONCIEARGE\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Balcony</feature>", "<field name=\"FEATURES_BALCONY\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Concierge</feature>", "<field name=\"AMENITIES_CONCIEARGE\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>High-speed internet</feature>", "<field name=\"FEATURES_INTERNET\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Elevator</feature>", "<field name=\"AMENITIES_ELEVATOR\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Microwave</feature>", "<field name=\"FEATURES_MICROWAVE\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Modern bathrooms</feature>", "<field name=\"FEATURES_MODERN_BATH\">1</field>", $RJFEED);
$RJFEED = str_replace("<feature>Refrigerator</feature>", "", $RJFEED);
$RJFEED = str_replace("<feature>Stove</feature>", "", $RJFEED);
$RJFEED = str_replace("<feature>Cable television</feature>", "", $RJFEED);
 $RJFEED = str_replace("<feature>Playground</feature>", "", $RJFEED);
 $RJFEED = str_replace("<feature>Tile Flooring</feature>", "", $RJFEED);
 $RJFEED = str_replace("<feature>Marble Bathroom</feature>", "", $RJFEED);
 $RJFEED = str_replace("<feature>Stainless steel appliances</feature>", "", $RJFEED);
 $RJFEED = str_replace("<feature>Family Room</feature>", "", $RJFEED); 
 $RJFEED = str_replace("<feature>Central heat</feature>", "", $RJFEED); 
 $RJFEED = str_replace("<feature>Renovated</feature>", "", $RJFEED); 
 $RJFEED = str_replace("<feature>Granite countertops</feature>", "", $RJFEED); 
 $RJFEED = str_replace("<feature>Ceiling Fan</feature>", "", $RJFEED); 
 $RJFEED = str_replace("<feature>Hardwood Cabinets</feature>", "", $RJFEED); 
$RJFEED = str_replace("<feature>Barbecue</feature>", "", $RJFEED); 
$RJFEED = str_replace("<feature>Zip Car</feature>", "", $RJFEED); 
$RJFEED = str_replace("<feature>Waterfront</feature>", "", $RJFEED); 
$RJFEED = str_replace("<feature>Library</feature>", "", $RJFEED); 

 $RJFEED = str_replace("<featured>0</featured>", "", $RJFEED);
  
  $RJFEED = str_replace("\n >\n", "", $RJFEED);



 $RJFEED = str_replace("<attribution></attribution>\n", "", $RJFEED);
 $RJFEED = str_replace("<value></value>\n", "", $RJFEED);
 $RJFEED = str_replace("<name>OK to Advertise</field>", "", $RJFEED); 
$RJFEED = str_replace("<name>Is From Craigslist?</field>", "", $RJFEED); 
$RJFEED = str_replace("<name>Import ID</field>", "", $RJFEED); 
 $RJFEED = str_replace("<source_type>external</source_type>", "", $RJFEED); 
$RJFEED = str_replace("<source_type>internal</source_type>", "", $RJFEED);

$RJFEED = str_replace("<type>text</type>", "", $RJFEED); 
 
$RJFEED = str_replace("<parking_space_type></parking_space_type>", "", $RJFEED); 
 
 //* to convert to rentals *//
 
 $RJFEED = str_replace("<property_type></property_type>", "<field name=\"TYPE\">1</field>", $RJFEED);
 $RJFEED = str_replace("<property_type>", "<TYPE>", $RJFEED);
 $RJFEED = str_replace("</property_type>", "</field", $RJFEED);
 
 
$RJFEED = str_replace("<field name=\"X\">ok</field>", "", $RJFEED);

 

 
 
 
 //* Location translation *//
 
 $RJFEED = str_replace("<city>Cambridge</city>", "<field name=\"LOC\">81</field>", $RJFEED);
 $RJFEED = str_replace("<city>Watertown</city>", "<field name=\"LOC\">349</field>", $RJFEED);
 $RJFEED = preg_replace('% %i', ' ', $RJFEED);
 $RJFEED = str_replace("<city></city>", "", $RJFEED);
 $RJFEED = str_replace("<agent_phone></agent_phone>", "", $RJFEED);
 $RJFEED = str_replace("<agent_name></agent_name>", "", $RJFEED);
 $RJFEED = str_replace("<latitude></latitude>", "", $RJFEED);
 $RJFEED = str_replace("<longitude></longitude>", "", $RJFEED);
 
 
 
 $RJFEED = str_replace("<neighborhoods>", "", $RJFEED);
 $RJFEED = str_replace("</neighborhoods>", "", $RJFEED);
$RJFEED = preg_replace('%<neighborhood>.*</neighborhood>\n%i', '', $RJFEED);
 $RJFEED = str_replace("<TYPE>Apartment Complex</field>\n", "", $RJFEED);
 $RJFEED = str_replace("<access_info></access_info>", "", $RJFEED);
 
 
 
$RJFEED = preg_replace('%<last_updated>.*</last_updated>\n%i', '', $RJFEED); 
$RJFEED = preg_replace('%<url>http://app.rentjuice.com/listings.*</url>\n%i', '', $RJFEED); 
 
 
 
 
$RJFEED = str_replace("\t\t", "", $RJFEED);
$RJFEED = str_replace("\t", "", $RJFEED);
$RJFEED = str_replace("  ", " ", $RJFEED);
$RJFEED = str_replace("  ", " ", $RJFEED);
$RJFEED = str_replace("  ", " ", $RJFEED);
$RJFEED = str_replace("  ", " ", $RJFEED);
 $RJFEED = str_replace("\n\n", "\n", $RJFEED);
 $RJFEED = str_replace("\n \n", "\n", $RJFEED);
 $RJFEED = str_replace("\n \n", "\n", $RJFEED);
 $RJFEED = str_replace("\n \n", "\n", $RJFEED);
 $RJFEED = str_replace("\n \n", "\n", $RJFEED);
 $RJFEED = str_replace("\n \n", "\n", $RJFEED);
 $RJFEED = str_replace("\n\n", "\n", $RJFEED);
 $RJFEED = str_replace("\n\n", "\n", $RJFEED);
 $RJFEED = str_replace("</response>", "</bstapts-transport-package>", $RJFEED);
 $RJFEED = preg_replace('%<runtime>.*</runtime>%i', '', $RJFEED);


 
echo $RJFEED;
 
?>