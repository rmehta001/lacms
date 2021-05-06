<? php

include("phoogle.php");

//create an instance of the mapping class $myPhoogleMap = new googleMap; 
//variables to pass to the showMap() method

$myAddress = "208 Dingler Ave Mooresville NC 28115";

//address can also be info pulled from a db or $_GET, $_POST $array = false; 
//do you want to print out a debug array of geocode values, for development you may want to set to true 
//this is the size of the map 

$mWidth = 500; $mHeight = 500;

//this line is what actually displays the map and all that good junk...

$myPhoogleMap->showMap($myAddress, $array, $mWidth, $mHeight);

?>