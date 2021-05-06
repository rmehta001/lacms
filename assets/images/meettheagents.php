<?php
include("./lacms/inc/global.php");
include("./lacms/inc/local_info.php");

$co = $HTTP_GET_VARS['cli'];
$agent = $HTTP_GET_VARS['agent'];
$sort = $HTTP_GET_VARS['sort'];

$meetorder = $HTTP_GET_VARS['meetorder'];


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



// DB CONNECT //

mysqli_select_db($dbh, $DBNAME);

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



$quStrGetAgent = "SELECT * FROM `USERS` WHERE `GROUP` = $co ORDER BY `MEETORDER`, `LNAME`, `FNAME`";
$quGetAgent = mysqli_query($dbh, $quStrGetAgent) or die ("I'm sorry. No agents for $co  ");
$rowGetAgent = mysqli_fetch_object($quGetAgent);


//Determine proper heading and footing to use//
if ($co) {


	if($rowGetgr->AGENCY_HEADERS)
	{                
		$agcyStr="SELECT * FROM AGENCIES WHERE AGENCY_ID=$rowGetGr->AGENCY_HEADERS AND GID=$co";
                $agcyGet=mysqli_query($dbh, $agcyStr);
                $agcy=mysqli_fetch_object($agcyGet);
                $aheading_1=$agcy->HEADER_1;
                $afooting_1=$agcy->FOOTER_1;
		$aheading_2=$agcy->HEADER_2;
		$afooting_2=$agcy->FOOTER_2;
	}



		if ($rowGetGr->MEETAGENTS_HEAD) {
			$heading = $rowGetGr->MEETAGENTS_HEAD;
			$footing = $rowGetGr->MEETAGENTS_FOOT;
			}


		elseif ($rowGetGr->HEAD) {
			$heading = $rowGetGr->HEAD;
			$footing = $rowGetGr->FOOT;
		}else {
			$quStrGetBSTAPTSHeadFoot = "SELECT HEAD, FOOT FROM `GROUP` WHERE GRID=1";
			$quGetBSTAPTSHeadFoot = mysqli_query($dbh, $quStrGetBSTAPTSHeadFoot);
			$rowGetHeadFoot = mysqli_fetch_object($quGetBSTAPTSHeadFoot);
			$heading = $rowGetHeadFoot->HEAD;
			$footing = $rowGetHeadFoot->FOOT;
			$noHead = true;
		}
}else {
        if ($agency) {
                $agcyStr="SELECT * FROM AGENCIES WHERE AGENCY_ID=$agency AND GID=$co";
                $agcyGet=mysqli_query($dbh, $agcyStr);
                $agcy=mysqli_fetch_object($agcyGet);
                $heading=$agcy->HEADER_1;
                $footing=$agcy->FOOTER_1;
	}elseif ($rowGetGr->HEAD) {
		$heading = $rowGetGr->HEAD;
		$footing = $rowGetGr->FOOT;
	}else {
		$quStrGetBSTAPTSHeadFoot = "SELECT HEAD, FOOT FROM `GROUP` WHERE GRID=1";
		$quGetBSTAPTSHeadFoot = mysqli_query($dbh, $quStrGetBSTAPTSHeadFoot)or die (mysqli_error($dbh));
		$rowGetHeadFoot = mysqli_fetch_object($quGetBSTAPTSHeadFoot);
		$heading = $rowGetHeadFoot->HEAD;
		$footing = $rowGetHeadFoot->FOOT;
		$noHead = true;
	}
}	




echo "$heading <BR>";

 



mysqli_data_seek ($quGetAgent, 0);
$rowGetAgent = "";


while ($rowGetAgent = mysqli_fetch_object($quGetAgent)) {
		if (isset($agent)) {
				echo " Agent Picture";
		}
		echo "<CENTER><TABLE WIDTH=600><TR><TD>";

if ($rowGetAgent->MEETAGENTS == "1") {

		echo "<CENTER><TABLE WIDTH=600 BORDER=0><TR><TD ALIGN=CENTER WIDTH=200>";

if ($rowGetAgent->PICEXT != "") {


echo "<img src=\"http://www.bostonapartments.com/pics/" . $rowGetAgent->HANDLE . "." . $rowGetAgent->PICEXT . "\" height=225 >";


} else {echo "<IMG SRC=http://www.bostonapartments.com/meettheagents-nopic.jpg BORDER=0>"";}

		echo "<TD><TD ALIGN=LEFT VALIGN=TOP WIDTH=400>";

echo $rowGetAgent->FNAME . "&nbsp;" . $rowGetAgent->LNAME . "<BR>";
if ($rowGetAgent->POSITION) {echo $rowGetAgent->POSITION . "<BR>";}
if ($rowGetAgent->EMAIL) {echo "<A HREF=\"mailto:" . $rowGetAgent->EMAIL . "\" target=\"_NEW\">" . $rowGetAgent->EMAIL . "</A><BR>";}
if ($rowGetAgent->DIRECTLINE) { echo $rowGetAgent->DIRECTLINE . " <font size=-1>(o)</font><BR>";}
if ($rowGetAgent->CELLPHONE) {echo $rowGetAgent->CELLPHONE . " <font size=-1>(c)</font><BR>";}
if ($rowGetAgent->PERSONAL_WEBSITE) {echo "<A HREF=\"" . $rowGetAgent->PERSONAL_WEBSITE . "\" target=\"_NEW\">" . $rowGetAgent->PERSONAL_WEBSITE . "</A>";}


if ($rowGetAgent->BIO) {echo "</TD></TR><TR><TD COLSPAN=3>" . $rowGetAgent->BIO ;}


echo "</TD></TR></TABLE>";



echo "<HR>";

}

		echo "</TD></TR></TABLE></CENTER>";

}



echo $footing;

?>