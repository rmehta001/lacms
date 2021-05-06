<?php session_start() ?> 

<?php include("libcli/client_db.php");

function array_to_string ($array, $char) {
	if (is_array($array)) {
		for ($i=0;$i<=count($array);$i++) {
			$string .= $array[$i];
			if ($i < (count($array) - 1)) {
				$string .= $char;
			}
		}
		}else {
			$string = "";
		}
	return $string;
}

function prepareAdBody ($adString, $allowHTML) {
	if (!$allowHTML) {
 		$adString = strip_tags ($adString, '<b><i><br>');
	}
	$adString = str_replace("\n", " ", $adString);
	$adString = str_replace("\r", " ", $adString);
	$adString = str_replace("   ", " ", $adString);
	$adString = str_replace("  ", " ", $adString);
	$adString = str_replace("Type your ad here.", "", $adString);
	
	if (strpos($adString, "<b>") || strpos($adString, "<i>")) {
		$adString .= "</i></b>";
	}
	
	return $adString;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$email = preg_replace("#'//\<>#","",$_POST['client_email']);
	if (empty($email)) {
	die("<FONT COLOR=\"red\">Please enter an email address.</FONT><BR><BR>Please click the back button <BR>or <a href=\"#\" onClick=\"history.go(-1)\">Click Here to go Back</a>.");
	}

require_once('recaptchalib.php');
$privatekey = "6Lf9HroSAAAAAE1i3mks8FQDSwlRpBup9QKL7K2z";
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {
  die ("<FONT COLOR=\"red\">The reCAPTCHA code wasn't entered correctly.</FONT><BR><BR>Please click the back button <BR>or " .
       "<a href=\"#\" onClick=\"history.go(-1)\">Click Here to go Back</a><BR><BR>Please understand that reCAPTCHA is necessary to stop spammers and automated submissions.");
}

//  group id, CLI change for whatever company//
	$grid = "520";
	$uid = "4774";

	$public = "1";
	$name_first = $_POST['name_first'];
	$name_last = $_POST['name_last'];
	$home_phone = $_POST['home_phone'];
	$work_phone = $_POST['work_phone'];
	$mobile_phone = $_POST['mobile_phone'];		
	$client_email = $_POST['client_email'];
	$pricemin = $_POST['pricemin'];
	$pricemax = $_POST['pricemax'];
	$curaddress = $_POST['curaddress'];
	$curcity = $_POST['curcity'];
	$curstate = $_POST['curstate'];
	$curzip = $_POST['curzip'];
	$source = "6";
	$status_client = "1";
	$client_status2 = "4";
 	$num_people = $_POST['num_people'];
	$newsletter_subscribe  = $_POST['newsletter_subscribe'];
	$date_created = $_POST['dc_year'] ."-". $_POST['dc_month'] ."-". $_POST['dc_day'];
	$date_next_contact = $_POST['nc_year'] ."-". $_POST['nc_month'] ."-". $_POST['nc_day'];
	$date_movein = $_POST['mi_year'] ."-". $_POST['mi_month'] ."-". $_POST['mi_day'];
	$date_movein_end = $_POST['mie_year'] ."-". $_POST['mie_month'] ."-". $_POST['mie_day'];

if ($date_movein_end == "0000-00-00")
{
$date_movein_end = $date_movein;
}

		$type_pref = array_to_string ($_POST['type_pref'], ",");
		$loc_pref = array_to_string ($_POST['loc_pref'], ",");
		$rooms_pref = array_to_string ($_POST['rooms_pref'], ",");
		$bath_pref = array_to_string ($_POST['bath_pref'], ",");
		$pets_pref = array_to_string ($_POST['pets_pref'], ",");
		
	$client_furnished = $_POST['client_furnished'];
	$client_shortterm = $_POST['client_shortterm'];
	$client_notes = prepareAdBody($_POST['client_notes'], false);
		
		$quStrAddClient = "INSERT INTO CLIENTS (GRID, UID, PUBLIC, STATUS_CLIENT, NAME_FIRST, NAME_LAST, HOME_PHONE, WORK_PHONE, MOBILE_PHONE, CLIENT_EMAIL, CURADDRESS, CURCITY, CURSTATE, CURZIP, PRICEMIN, PRICEMAX, AVAIL_PREF, TYPE_PREF, LOC_PREF, ROOMS_PREF, BATH_PREF, NUM_PEOPLE, CLIENT_TYPE, CLIENT_EMPLOYMENT, PETS_PREF, CLIENT_FURNISHED, CLIENT_SHORTTERM, NEWSLETTER_SUBSCRIBE, DATE_CREATED, DATE_NEXT_CONTACT, DATE_MOVEIN, DATE_MOVEIN_END, SOURCE, CLIENT_STATUS2, CLIENT_NOTES) VALUES ('$grid', '$uid', '$public', '$status_client', '$name_first', '$name_last', '$home_phone', '$work_phone', '$mobile_phone', '$client_email', '$curaddress', '$curcity', '$curstate', '$curzip', '$pricemin', '$pricemax', '$avail_pref', '$type_pref', '$loc_pref', '$rooms_pref', '$bath_pref', '$num_people', '$client_type', '$client_employment', '$pets_pref', '$client_furnished', '$client_shortterm', '$newsletter_subscribe', '$date_created', '$date_next_contact', '$date_movein', '$date_movein_end', '$source', '$client_status2', '$client_notes')";
		$quAddClient = mysqli_query($dbh, $quStrAddClient) or die (mysqli_error($dbh));
//$quStrAddClient);
		
ECHO "Your information has been submitted.<BR><BR>
<a href=\"#\" onClick=\"history.go(-2)\">Click Here to return</a><BR>";
return;

        } else {
	
//END createClientDo //

 ?>






<HTML><head><title>Client Intake Form</title></head>
<body>
			<?php 
		$dc_year = date("Y");
		$dc_month = date("n");
		$dc_day = date("j");

		$nc_year = date("Y");
		$nc_month = date("n");
		$nc_day = date("j");
		?>





<CENTER>
<table width="636" border="0" cellspacing="0" cellpadding="0">
<tr height="240">
<td width="635" height="240" colspan="2" valign="top" align="left"><img src="http://www.areahomesrealty.com/homepage.gif" alt="" height="235" width="634" border="0"></td>
<td width="1" height="240"><spacer type="block" width="1" height="240"></td>
</tr>
<tr height="1">
<td width="1" height="1" valign="top" align="left"><img src="http://www.areahomesrealty.com/pixel.gif" alt="" name="pixel" height="1" width="1" border="0"></td>
<td width="634" height="1"></td>
<td width="1" height="1"><spacer type="block" width="1" height="1"></td>
</tr>
</TABLE>



<CENTER><TABLE BORDER="1" CELLPADDING="3" CELLSPACING="3"><TR><TD>

<CENTER>
<H2>Contact Area Homes Realty</H2>

Please fill out this form so that we may contact you with the appropriate listings.<BR>
<font color="red">* required fields</FONT><BR>
<P>


<form action="#" method="POST">

<?php

require_once('recaptchalib.php');

// Get a key from http://recaptcha.net/api/getkey
$publickey = "6Lf9HroSAAAAAAI0tzYDO-43qKcWVTIQV9Lq_1hi";
$privatekey = "6Lf9HroSAAAAAE1i3mks8FQDSwlRpBup9QKL7K2z";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

?>

<input type="hidden" name="status_client" value="1">
<input type="hidden" name="CLIENT_STATUS2" value="4">


<input type="hidden" name="dc_month" value="<?php echo $dc_month;?>">
<input type="hidden" name="dc_day" value="<?php echo $dc_day;?>">
<input type="hidden" name="dc_year" value="<?php echo $dc_year;?>">

<input type="hidden" name="nc_month" value="<?php echo $nc_month;?>">
<input type="hidden" name="nc_day" value="<?php echo $nc_day;?>">
<input type="hidden" name="nc_year" value="<?php echo $nc_year;?>">


Contact Information:<BR>

<table  BORDER=0>

<TR>

			<td height="30" width="20"><NOBR><font size="-1">First Name: <font color="red">*</FONT></FONT></NOBR></font><input type="text" name="name_first" size="20" value="<?php echo $rowGetClient->NAME_FIRST;?>"></td>
			<td height="30" width="1">&nbsp;</td>
			<td height="30" width="20"><NOBR><font size="-1">Last Name:</FONT></NOBR></font><input type="text" name="name_last" size="20" value="<?php echo $rowGetClient->NAME_LAST;?>"></td>

			<td height="30" width="1">&nbsp;</td>

			<td valign="bottom" height="30" width="20"><NOBR><font size="-1">Interested in:</FONT></NOBR></font><select name="type_pref" STYLE="Background-Color : #FFFFFF">
						<option value="1">Rentals</option>
						<option value="2">Sales</option>
						<option value="3">Commercial Sales</option>
						<option value="4">Commercial Rentals</option>
						<option value="5">Parking Spaces - Rentals</option>
						<option value="6">Parking Spaces - Sales</option>
						<option value="7">Parking Spaces - Wanted</option>
						<option value="8">Vacation Rentals</option>
						<option value="9">Rent To Owns</option>
						<option value="10">Business Opportunities</option>
						<option value="11">Senior Living Rentals</option>
						<option value="12">Senior Living Sales</option>
						<option value="13">Bank Owned</option>
						</select></td>


			<tr>
			<td valign="bottom" height="30" width="20"><NOBR><font size="-1">Home Phone:</FONT></NOBR></font><input type="text" name="home_phone" size="15" value="<?php echo $rowGetClient->HOME_PHONE;?>"></td>
			<td valign="bottom" height="30" width="1">&nbsp;</td>
			<td valign="bottom" height="30" width="20"><NOBR><font size="-1">Work Phone:</FONT></NOBR></font><input type="text" name="work_phone" size="15" value="<?php echo $rowGetClient->WORK_PHONE;?>"></td>
			<td valign="bottom" height="30" width="1">&nbsp;</td>
			<td valign="bottom" height="30" width="20"><NOBR><font size="-1">Mobile Phone:</FONT></NOBR><BR><input type="text" name="mobile_phone" size="15" value="<?php echo $rowGetClient->MOBILE_PHONE;?>"></td>
			</tr><TR>
			<td valign="bottom" height="30" width="20"><NOBR><font size="-1">Email: </FONT><font color="red">*</FONT></NOBR></font><BR><input type="text" name="client_email" size="20" value="<?php echo $rowGetClient->CLIENT_EMAIL;?>"></td>
			<td valign="bottom" height="30" width="1">&nbsp;</td>


<TD>

<NOBR><font size="-1"># of people:</FONT></NOBR><BR></font><input type="text" SIZE="2" name="num_people" value="<?php echo $rowGetClient->NUM_PEOPLE;?>">


</TD><TD>&nbsp;</TD><TD>
<div class="menu"><font size="-1">Employment:</FONT></font><select name="client_employment" STYLE="Background-Color : #FFFFFF">
<option value="--">--</option>
<option value="1" >Full Time Employee</option>
<option value="2" >Working and Going to School</option>
<option value="3" >Undergraduate Student</option>
<option value="4" >Graduate Student</option>
<option value="5" >Retired</option>
<option value="8" >Unemployed</option>
<option value="9" >Other</option>
</select>



</TD>
</tr>
			</table>

<table><tr><td>

<NOBR><font size="-1">Current Address:</NOBR></font><BR><input type="text" name="curaddress" size="28" value="<?php echo $rowGetClient->CURADDRESS;?>"></td>

			<td height="30" width="1">&nbsp;</td>

			<td height="30" width="20"><font size="-1">City:</font><BR><input type="text" name="curcity" size="28" value="<?php echo $rowGetClient->CURCITY;?>"></td>

			<td height="30" width="1">&nbsp;</td>


			<td height="30" width="20"><font size="-1">State:</font><BR><input type="text" name="curstate" size="2" value="<?php echo $rowGetClient->CURSTATE;?>"></td>

			<td height="30" width="1">&nbsp;</td>


			<td height="30" width="20"><font size="-1">Zip:</font><BR><input type="text" name="curzip" size="10" value="<?php echo $rowGetClient->CURZIP;?>"></td>

			<td height="30" width="1">&nbsp;</td>


</tr>
</table>


<TABLE><TR><TD>



<NOBR><FONT SIZE="-1">MOVE IN DATE</FONT> <FONT SIZE=-3>(begin)</FONT>:</NOBR></font><NOBR><BR><select name="mi_month" STYLE="Background-Color : #FFFFFF">
						<option value="1" <?php if ($dc_month==1) { echo "selected";}?>>Jan</option>
						<option value="2" <?php if ($dc_month==2) { echo "selected";}?>>Feb</option>
						<option value="3" <?php if ($dc_month==3) { echo "selected";}?>>Mar</option>
						<option value="4" <?php if ($dc_month==4) { echo "selected";}?>>April</option>
						<option value="5" <?php if ($dc_month==5) { echo "selected";}?>>May</option>
						<option value="6" <?php if ($dc_month==6) { echo "selected";}?>>Jun</option>
						<option value="7" <?php if ($dc_month==7) { echo "selected";}?>>Jul</option>
						<option value="8" <?php if ($dc_month==8) { echo "selected";}?>>Aug</option>
						<option value="9" <?php if ($dc_month==9) { echo "selected";}?>>Sep</option>
						<option value="10" <?php if ($dc_month==10) { echo "selected";}?>>Oct</option>
						<option value="11" <?php if ($dc_month==11) { echo "selected";}?>>Nov</option>
						<option value="12" <?php if ($dc_month==12) { echo "selected";}?>>Dec</option>
						</select> 
			<select name="mi_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($mi_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>


			<select name="mi_year" STYLE="Background-Color : #FFFFFF">

<?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>

<option value="<?php echo $i;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
<?php echo $i;?>
</option>

<option value="<?php echo $i+1;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
<?php echo $i+1;?>
</option>



						<?php } ?>
						</select>

</NOBR>


</td>

<td height="30" width="1">&nbsp;</td>


<TD>
<FONT SIZE="-1"><NOBR>MOVE IN DATE</FONT> <FONT SIZE=-3>(end)</FONT>:</NOBR></font><BR><NOBR><select name="mie_month" STYLE="Background-Color : #FFFFFF">
						<option value="1" <?php if ($dc_month==1) { echo "selected";}?>>Jan</option>
						<option value="2" <?php if ($dc_month==2) { echo "selected";}?>>Feb</option>
						<option value="3" <?php if ($dc_month==3) { echo "selected";}?>>Mar</option>
						<option value="4" <?php if ($dc_month==4) { echo "selected";}?>>April</option>
						<option value="5" <?php if ($dc_month==5) { echo "selected";}?>>May</option>
						<option value="6" <?php if ($dc_month==6) { echo "selected";}?>>Jun</option>
						<option value="7" <?php if ($dc_month==7) { echo "selected";}?>>Jul</option>
						<option value="8" <?php if ($dc_month==8) { echo "selected";}?>>Aug</option>
						<option value="9" <?php if ($dc_month==9) { echo "selected";}?>>Sep</option>
						<option value="10" <?php if ($dc_month==10) { echo "selected";}?>>Oct</option>
						<option value="11" <?php if ($dc_month==11) { echo "selected";}?>>Nov</option>
						<option value="12" <?php if ($dc_month==12) { echo "selected";}?>>Dec</option>
						</select> 
			<select name="mie_day" STYLE="Background-Color : #FFFFFF">
						<?php for ($i=1;$i<=31;$i++) {?>
						<option value="<?php echo $i;?>" <?php if ($mi_day==$i) { echo "selected";}?>><?php echo $i;?></option>
						<?php } ?>
						</select>


			<select name="mie_year" STYLE="Background-Color : #FFFFFF">

<?php for ($i=(date("Y")-0);$i<=date("Y");$i++) {?>


<option value="<?php echo $i;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
<?php echo $i;?>
</option>

<option value="<?php echo $i+1;?>" <?php if ($mi_year==$i) { echo "selected";}?>>
<?php echo $i+1;?>
</option>



						<?php } ?>
						</select>

</NOBR>

</TD>


<!--			<td height="30" width="2">
<div class="menu"><NOBR>Client Type:</NOBR></font><select name="client_type" STYLE="Background-Color : #FFFFFF">
					
					<option value="--">--</option>
					<option value="1" >One Person</option>
					<option value="2" >Roommates</option>
					<option value="3" >Couple</option>
					<option value="4" >Family</option>
					<option value="5" >Commercial</option>
					<option value="6" >Other</option>
					</select>
					<br>
			</TD> -->
<td height="30" width="1">&nbsp;</td>
			<td height="30" width="2">






<br>
			</TD>

<td height="30" width="1">&nbsp;</td>
<TD>

<FONT SIZE="-1"><NOBR>Price Minimum:</NOBR></font><BR><NOBR>$<input type="text" name="pricemin" value="<?php echo $rowGetClient->PRICEMIN;?>" SIZE="10">
</NOBR>
</td>
			<td height="30" width="1">&nbsp;</td>
			<td height="30" width="20">
<FONT SIZE="-1"><NOBR>Price Maximum:</NOBR></font><BR><NOBR>$<input type="text" name="pricemax" value="<?php echo $rowGetClient->PRICEMAX;?>" SIZE="10"> </NOBR>
</td>

</TR></TABLE>



			<table>
			<tr>
			
			<td valign="top" height="30" width="20">





<FONT SIZE="-1"><NOBR>Location preference(s):</NOBR></font><select name="loc_pref[]" multiple SIZE=8 STYLE="Background-Color : #FFFFFF">
<option value="1">ABINGTON</option>
<option value="2">ACTON</option>
<option value="3">ACUSHNET</option>
<option value="4">ADAMS</option>
<option value="5">AGAWAM</option>
<option value="6">ALFORD</option>
<option value="7">AMESBURY</option>
<option value="8">AMHERST</option>
<option value="9">ANDOVER</option>
<option value="10">ARLINGTON</option>
<option value="11">ASHBY</option>
<option value="12">ASHFIELD</option>
<option value="13">ASHLAND</option>
<option value="14">ATHOL</option>
<option value="15">ATTLEBORO</option>
<option value="16">AUBURN</option>
<option value="17">AVON</option>
<option value="18">AYER</option>
<option value="19">BARNSTABLE</option>
<option value="20">BARRE</option>
<option value="21">BECKET</option>
<option value="22">BEDFORD</option>
<option value="375">BEDFORD, NH</option>
<option value="23">BELCHERTOWN</option>
<option value="24">BELLINGHAM</option>
<option value="25">BELMONT</option>
<option value="26">BERKLEY</option>
<option value="27">BERLIN</option>
<option value="28">BERNARDSTON</option>
<option value="29">BEVERLY</option>
<option value="30">BILLERICA</option>
<option value="31">BLACKSTONE</option>
<option value="32">BLANDFORD</option>
<option value="33">BOLTON</option>
<option value="403">BONDSVILLE</option>
<option value="34">BOSTON - ALLSTON</option>
<option value="35">BOSTON - BACK BAY</option>
<option value="36">BOSTON - BAY VILLAGE</option>
<option value="37">BOSTON - BEACON HILL</option>
<option value="38">BOSTON - BERKLEE COLLEGE AREA</option>
<option value="39">BOSTON - BOSTON UNIVERSITY AREA</option>
<option value="40">BOSTON - BRIGHAM CIRCLE</option>
<option value="41">BOSTON - BRIGHTON</option>
<option value="42">BOSTON - Brookline Line</option>
<option value="398">BOSTON - CHARLES RIVER PARK</option>
<option value="86">BOSTON - CHARLESTOWN</option>
<option value="43">BOSTON - CHINATOWN</option>
<option value="44">BOSTON - COPLEY SQUARE</option>
<option value="45">BOSTON - DORCHESTER</option>
<option value="46">BOSTON - DOWNTOWN</option>
<option value="47">BOSTON - EAST BOSTON</option>
<option value="381">BOSTON - EMERSON COLLEGE AREA</option>
<option value="48">BOSTON - FENWAY</option>
<option value="49">BOSTON - FINANCIAL DISTRICT</option>
<option value="404">BOSTON - FORT HILL</option>
<option value="389">BOSTON - FORT POINT</option>
<option value="50">BOSTON - FORT POINT CHANNEL</option>
<option value="51">BOSTON - GOVERNMENT CENTER</option>
<option value="177">BOSTON - HYDE PARK</option>
<option value="52">BOSTON - JAMAICA PLAIN</option>
<option value="53">BOSTON - KENMORE SQUARE</option>
<option value="400">BOSTON - LADDER DISTRICT</option>
<option value="54">BOSTON - LEATHER DISTRICT</option>
<option value="55">BOSTON - LONGWOOD</option>
<option value="388">BOSTON - MATTAPAN</option>
<option value="56">BOSTON - MISSION HILL</option>
<option value="395">BOSTON - NEPONSET CIRCLE</option>
<option value="57">BOSTON - NORTH END</option>
<option value="58">BOSTON - NORTHEASTERN UNIV. AREA</option>
<option value="379">BOSTON - PRUDENTIAL AREA</option>
<option value="386">BOSTON - READVILLE</option>
<option value="59">BOSTON - ROSLINDALE</option>
<option value="60">BOSTON - ROXBURY</option>
<option value="61">BOSTON - SEAPORT DISTRICT</option>
<option value="62">BOSTON - SOUTH BOSTON</option>
<option value="63">BOSTON - SOUTH END</option>
<option value="382">BOSTON - SOUTH STATION</option>
<option value="387">BOSTON - SUFFOLK UNIV. AREA</option>
<option value="64">BOSTON - SYMPHONY</option>
<option value="378">BOSTON - THEATER DISTRICT</option>
<option value="65">BOSTON - WATERFRONT</option>
<option value="66">BOSTON - WEST END</option>
<option value="67">BOSTON - WEST ROXBURY</option>
<option value="68">BOURNE</option>
<option value="69">BOXBOROUGH</option>
<option value="70">BOXFORD</option>
<option value="71">BOYLSTON</option>
<option value="392">BRADFORD</option>
<option value="72">BRAINTREE</option>
<option value="73">BREWSTER</option>
<option value="74">BRIDGEWATER</option>
<option value="75">BRIMFIELD</option>
<option value="76">BROCKTON</option>
<option value="77">BROOKFIELD</option>
<option value="78">BROOKLINE</option>
<option value="79">BUCKLAND</option>
<option value="80">BURLINGTON</option>
<option value="81">CAMBRIDGE</option>
<option value="411">CAMBRIDGE - AGASSIZ</option>
<option value="412">CAMBRIDGE - AVON HILL</option>
<option value="413">CAMBRIDGE - CAMBRIDGE HIGHLANDS</option>
<option value="414">CAMBRIDGE - CAMBRIDGEPORT</option>
<option value="415">CAMBRIDGE - CENTRAL SQUARE</option>
<option value="416">CAMBRIDGE - COOLIDGE HILL</option>
<option value="417">CAMBRIDGE - EAST CAMBRIDGE</option>
<option value="442">CAMBRIDGE - FRESH POND</option>
<option value="418">CAMBRIDGE - HARVARD SQUARE</option>
<option value="443">CAMBRIDGE - Near Harvard</option>
<option value="441">CAMBRIDGE - HURON VILLAGE</option>
<option value="419">CAMBRIDGE - INMAN SQUARE</option>
<option value="420">CAMBRIDGE - KENDALL SQUARE</option>
<option value="421">CAMBRIDGE - MID CAMBRIDGE</option>
<option value="422">CAMBRIDGE - NORTH CAMBRIDGE</option>
<option value="423">CAMBRIDGE - PORTER SQUARE</option>
<option value="445">CAMBRIDGE - RADCLIFFE</option>
<option value="424">CAMBRIDGE - RIVERSIDE</option>
<option value="425">CAMBRIDGE - STRAWBERRY HILL</option>
<option value="426">CAMBRIDGE - WEST CAMBRIDGE</option>
<option value="82">CANTON</option>
<option value="83">CAPE COD</option>
<option value="391">CARLISLE</option>
<option value="84">CARVER</option>
<option value="85">CHARLEMONT</option>
<option value="87">CHATHAM</option>
<option value="88">CHELMSFORD</option>
<option value="89">CHELSEA</option>
<option value="90">CHESHIRE</option>
<option value="91">CHESTER</option>
<option value="92">CHESTERFIELD</option>
<option value="93">CHICOPEE</option>
<option value="94">CHILMARK</option>
<option value="95">CLARKSBURG</option>
<option value="96">CLINTON</option>
<option value="97">COHASSET</option>
<option value="98">COLRAIN</option>
<option value="99">CONCORD</option>
<option value="100">CONWAY</option>
<option value="405">CRANSTON, RI</option>
<option value="401">CUMBERLAND, RI</option>
<option value="101">CUMMINGTON</option>
<option value="102">DALTON</option>
<option value="103">DANVERS</option>
<option value="104">DARTMOUTH</option>
<option value="105">DEDHAM</option>
<option value="106">DEERFIELD</option>
<option value="107">DENNIS</option>
<option value="376">DERRY, NH</option>
<option value="108">DIGHTON</option>
<option value="109">DOUGLAS</option>
<option value="110">DOVER</option>
<option value="111">DRACUT</option>
<option value="112">DUDLEY</option>
<option value="113">DUNSTABLE</option>
<option value="114">DUXBURY</option>
<option value="116">EAST BRIDGEWATER</option>
<option value="117">EAST BROOKFIELD</option>
<option value="118">EAST LONGMEADOW</option>
<option value="119">EASTHAM</option>
<option value="120">EASTHAMPTON</option>
<option value="121">EASTON</option>
<option value="122">EDGARTOWN</option>
<option value="123">EGREMONT</option>
<option value="124">ERVING</option>
<option value="125">ESSEX</option>
<option value="126">EVERETT</option>
<option value="127">FAIRHAVEN</option>
<option value="128">FALL RIVER</option>
<option value="129">FALMOUTH</option>
<option value="130">FITCHBURG</option>
<option value="131">FLORIDA</option>
<option value="132">FOXBORO</option>
<option value="133">FRAMINGHAM</option>
<option value="134">FRANKLIN</option>
<option value="135">FREETOWN</option>
<option value="136">GARDNER</option>
<option value="137">GAY HEAD</option>
<option value="138">GEORGETOWN</option>
<option value="139">GILL</option>
<option value="140">GLOUCESTER</option>
<option value="410">GOFFSTOWN, NH</option>
<option value="141">GOSHEN</option>
<option value="142">GOSNOLD</option>
<option value="143">GRAFTON</option>
<option value="144">GRANBY</option>
<option value="145">GRANVILLE</option>
<option value="146">GREAT BARRINGTON</option>
<option value="147">GREENFIELD</option>
<option value="148">GROTON</option>
<option value="149">GROVELAND</option>
<option value="150">HADLEY</option>
<option value="151">HALIFAX</option>
<option value="152">HAMILTON</option>
<option value="153">HAMPDEN</option>
<option value="154">HANCOCK</option>
<option value="155">HANOVER</option>
<option value="156">HANSON</option>
<option value="157">HARDWICK</option>
<option value="158">HARVARD</option>
<option value="159">HARWICH</option>
<option value="160">HATFIELD</option>
<option value="161">HAVERHILL</option>
<option value="162">HAWLEY</option>
<option value="163">HEATH</option>
<option value="164">HINGHAM</option>
<option value="165">HINSDALE</option>
<option value="166">HOLBROOK</option>
<option value="167">HOLDEN</option>
<option value="168">HOLLAND</option>
<option value="169">HOLLISTON</option>
<option value="170">HOLYOKE</option>
<option value="171">HOPEDALE</option>
<option value="172">HOPKINTON</option>
<option value="173">HUBBARDSTON</option>
<option value="174">HUDSON</option>
<option value="175">HULL</option>
<option value="176">HUNTINGTON</option>
<option value="178">IPSWICH</option>
<option value="406">JOHNSTON, RI</option>
<option value="180">KINGSTON</option>
<option value="179">KINGSTON, RI</option>
<option value="384">LAKE WINNIPESAUKEE, NH</option>
<option value="181">LAKEVILLE</option>
<option value="182">LANCASTER</option>
<option value="183">LANESBOROUGH</option>
<option value="184">LAWRENCE</option>
<option value="185">LEE</option>
<option value="186">LEICESTER</option>
<option value="187">LENOX</option>
<option value="188">LEOMINSTER</option>
<option value="189">LEVERETT</option>
<option value="190">LEXINGTON</option>
<option value="191">LEYDEN</option>
<option value="192">LINCOLN</option>
<option value="193">LITTLETON</option>
<option value="194">LONGMEADOW</option>
<option value="195">LOWELL</option>
<option value="196">LUDLOW</option>
<option value="197">LUNENBURG</option>
<option value="198">LYNN</option>
<option value="199">LYNNFIELD</option>
<option value="200">MALDEN</option>
<option value="201">MANCHESTER</option>
<option value="383">MANCHESTER, NH</option>
<option value="202">MANSFIELD</option>
<option value="203">MARBLEHEAD</option>
<option value="204">MARION</option>
<option value="205">MARLBOROUGH</option>
<option value="206">MARSHFIELD</option>
<option value="207">MARTHA'S VINEYARD</option>
<option value="208">MASHPEE</option>
<option value="210">MATTAPOISETT</option>
<option value="211">MAYNARD</option>
<option value="212">MEDFIELD</option>
<option value="213">MEDFORD</option>
<option value="214">MEDWAY</option>
<option value="215">MELROSE</option>
<option value="216">MENDON</option>
<option value="217">MERRIMAC</option>
<option value="218">METHUEN</option>
<option value="219">MIDDLEBOROUGH</option>
<option value="220">MIDDLEFIELD</option>
<option value="221">MIDDLETON</option>
<option value="222">MILFORD</option>
<option value="223">MILLBURY</option>
<option value="224">MILLIS</option>
<option value="225">MILLVILLE</option>
<option value="226">MILTON</option>
<option value="227">MONROE</option>
<option value="228">MONSON</option>
<option value="229">MONTAGUE</option>
<option value="230">MONTEREY</option>
<option value="231">MONTGOMERY</option>
<option value="232">MOUNT WASHINGTON</option>
<option value="233">NAHANT</option>
<option value="234">NANTUCKET</option>
<option value="390">NASHUA, NH</option>
<option value="235">NATICK</option>
<option value="236">NEEDHAM</option>
<option value="237">NEW ASHFORD</option>
<option value="238">NEW BEDFORD</option>
<option value="239">NEW BRAINTREE</option>
<option value="240">NEW MARLBOROUGH</option>
<option value="241">NEW SALEM</option>
<option value="242">NEWBURY</option>
<option value="243">NEWBURYPORT</option>
<option value="244">NEWTON</option>
<option value="245">NORFOLK</option>
<option value="246">NORTH ADAMS</option>
<option value="397">NORTH ANDOVER</option>
<option value="247">NORTH ATTLEBOROUGH</option>
<option value="248">NORTH BROOKFIELD</option>
<option value="249">NORTH READING</option>
<option value="250">NORTHAMPTON</option>
<option value="251">NORTHBOROUGH</option>
<option value="252">NORTHBRIDGE</option>
<option value="253">NORTHFIELD</option>
<option value="254">NORTON</option>
<option value="255">NORWELL</option>
<option value="256">NORWOOD</option>
<option value="257">OAK BLUFFS</option>
<option value="258">OAKHAM</option>
<option value="393">ONSET</option>
<option value="259">ORANGE</option>
<option value="260">ORLEANS</option>
<option value="399">OSTERVILLE</option>
<option value="261">OTIS</option>
<option value="262">OXFORD</option>
<option value="263">PALMER</option>
<option value="264">PAXTON</option>
<option value="265">PEABODY</option>
<option value="266">PELHAM</option>
<option value="267">PEMBROKE</option>
<option value="268">PEPPERELL</option>
<option value="269">PERU</option>
<option value="270">PETERSHAM</option>
<option value="271">PHILLIPSTON</option>
<option value="272">PITTSFIELD</option>
<option value="273">PLAINFIELD</option>
<option value="274">PLAINVILLE</option>
<option value="275">PLYMOUTH</option>
<option value="276">PLYMPTON</option>
<option value="277">PRINCETON</option>
<option value="396">PROVIDENCE, RI</option>
<option value="278">PROVINCETOWN</option>
<option value="279">QUINCY</option>
<option value="280">RANDOLPH</option>
<option value="281">RAYNHAM</option>
<option value="282">READING</option>
<option value="283">REHOBOTH</option>
<option value="284">REVERE</option>
<option value="285">RICHMOND</option>
<option value="286">ROCHESTER</option>
<option value="287">ROCKLAND</option>
<option value="288">ROCKPORT</option>
<option value="289">ROWE</option>
<option value="290">ROWLEY</option>
<option value="291">ROYALSTON</option>
<option value="292">RUSSELL</option>
<option value="293">RUTLAND</option>
<option value="294">SALEM</option>
<option value="394">SALEM, NH</option>
<option value="295">SALISBURY</option>
<option value="296">SANDISFIELD</option>
<option value="297">SANDWICH</option>
<option value="298">SAUGUS</option>
<option value="299">SAVOY</option>
<option value="300">SCITUATE</option>
<option value="301">SEEKONK</option>
<option value="302">SHARON</option>
<option value="303">SHEFFIELD</option>
<option value="304">SHELBURNE</option>
<option value="305">SHERBORN</option>
<option value="306">SHIRLEY</option>
<option value="307">SHREWSBURY</option>
<option value="308">SHUTESBURY</option>
<option value="309">SOMERSET</option>
<option value="310">SOMERVILLE</option>
<option value="427">SOMERVILLE - BALL SQUARE</option>
<option value="428">SOMERVILLE - DAVIS SQUARE</option>
<option value="429">SOMERVILLE - EAST SOMERVILLE</option>
<option value="430">SOMERVILLE - INMAN SQUARE</option>
<option value="439">SOMERVILLE - MAGOUN SQUARE</option>
<option value="440">SOMERVILLE - KIRKLAND VILLAGE</option>
<option value="444">SOMERVILLE - Near Porter Square</option>
<option value="431">SOMERVILLE - POWDERHOUSE SQUARE</option>
<option value="432">SOMERVILLE - PROSPECT HILL</option>
<option value="433">SOMERVILLE - SPRING HILL</option>
<option value="434">SOMERVILLE - TEELE SQUARE</option>
<option value="435">SOMERVILLE - TUFTS UNIVERSITY AREA</option>
<option value="436">SOMERVILLE - UNION SQUARE</option>
<option value="437">SOMERVILLE - WEST SOMERVILLE</option>
<option value="438">SOMERVILLE - WINTER HILL</option>
<option value="311">SOUTH HADLEY</option>
<option value="312">SOUTHAMPTON</option>
<option value="313">SOUTHBOROUGH</option>
<option value="314">SOUTHBRIDGE</option>
<option value="315">SOUTHWICK</option>
<option value="316">SPENCER</option>
<option value="317">SPRINGFIELD</option>
<option value="318">STERLING</option>
<option value="319">STOCKBRIDGE</option>
<option value="320">STONEHAM</option>
<option value="321">STOUGHTON</option>
<option value="322">STOWE</option>
<option value="323">STURBRIDGE</option>
<option value="324">SUDBURY</option>
<option value="325">SUNDERLAND</option>
<option value="326">SUTTON</option>
<option value="327">SWAMPSCOTT</option>
<option value="328">SWANSEA</option>
<option value="329">TAUNTON</option>
<option value="330">TEMPLETON</option>
<option value="331">TEWKSBURY</option>
<option value="332">TISBURY</option>
<option value="333">TOLLAND</option>
<option value="334">TOPSFIELD</option>
<option value="335">TOWNSEND</option>
<option value="336">TRURO</option>
<option value="337">TYNGSBOROUGH</option>
<option value="338">TYRINGHAM</option>
<option value="339">UPTON</option>
<option value="340">UXBRIDGE</option>
<option value="341">WAKEFIELD</option>
<option value="407">WAKEFIELD, RI</option>
<option value="342">WALPOLE</option>
<option value="343">WALTHAM</option>
<option value="344">WARE</option>
<option value="345">WAREHAM</option>
<option value="346">WARREN</option>
<option value="347">WARWICK</option>
<option value="348">WASHINGTON</option>
<option value="349">WATERTOWN</option>
<option value="350">WAYLAND</option>
<option value="351">WEBSTER</option>
<option value="352">WELLESLEY</option>
<option value="353">WELLFLEET</option>
<option value="354">WENDELL</option>
<option value="355">WENHAM</option>
<option value="385">WEST BRIDGEWATER</option>
<option value="408">WEST GREENWICH, RI</option>
<option value="409">WEST WARWICK</option>
<option value="356">WESTBOROUGH</option>
<option value="357">WESTFIELD</option>
<option value="358">WESTFORD</option>
<option value="359">WESTHAMPTON</option>
<option value="360">WESTMINSTER</option>
<option value="361">WESTON</option>
<option value="362">WESTPORT</option>
<option value="363">WESTWOOD</option>
<option value="364">WEYMOUTH</option>
<option value="365">WHITMAN</option>
<option value="366">WILMINGTON</option>
<option value="367">WINCHENDON</option>
<option value="368">WINCHESTER</option>
<option value="369">WINTHROP</option>
<option value="370">WOBURN</option>
<option value="371">WORCESTER</option>
<option value="372">WORTHINGTON</option>
<option value="373">WRENTHAM</option>
<option value="374">YARMOUTH</option>
</select>
</td>
			<td height="30" width="1">&nbsp;</td>
			<td valign="top" height="30" width="20">




<FONT SIZE="-1"><NOBR># of Bedrooms:</NOBR></font>
<select name="rooms_pref[]" multiple SIZE=8 STYLE="Background-Color : #FFFFFF"> 
<option value="0.25" >LOFT</option>
<option value="0.50" >STUDIO</option>
<option value="0.75" >STUDIO + ALCOVE</option>
<option value="0.76" >STUDIO - 2 ROOMS</option>
<option value="0.79" >STUDIO+LOFT BED</option>
<option value="1.00" >1 BEDROOM</option>
<option value="1.50" >1 BEDROOM SPLIT</option>
<option value="1.75" >1 BEDROOM PLUS</option>
<option value="1.78" >1 BEDROOM LOFT</option>
<option value="2.00" >2 BEDROOM</option>
<option value="2.50" >2 BEDROOM SPLIT</option>
<option value="2.75" >2 BEDROOM PLUS</option>
<option value="2.78" >2 BEDROOM LOFT</option>
<option value="3.00" >3 BEDROOM</option>
<option value="3.50" >3 BEDROOM SPLIT</option>
<option value="3.75" >3 BEDROOM PLUS</option>
<option value="3.78" >3 BEDROOM LOFT</option>
<option value="4.00" >4 BEDROOM</option>
<option value="4.50" >4 BEDROOM SPLIT</option>
<option value="4.75" >4 BEDROOM PLUS</option>
<option value="4.78" >4 BEDROOM LOFT</option>
<option value="5.00" >5 BEDROOM</option>
<option value="5.50" >5 BEDROOM SPLIT</option>
<option value="5.75" >5 BEDROOM PLUS</option>
<option value="5.78" >5 BEDROOM LOFT</option>
<option value="6.00" >6 BEDROOM</option>
<option value="7.00" >7 BEDROOM</option>
<option value="8.00" >8 BEDROOM</option>
<option value="9.00" >9 BEDROOM</option>
<option value="10.00" >10 BEDROOM</option>
<option value="11.00" >11 BEDROOM</option>
<option value="12.00" >12 BEDROOM</option>
<option value="13.00" >13 BEDROOM</option>
<option value="14.00" >14 BEDROOM</option>
<option value="15.00" >15 BEDROOM</option>
<option value="16.00" >16 BEDROOM</option>
<option value="17.00" >17 BEDROOM</option>
<option value="18.00" >18 BEDROOM</option>
<option value="19.00" >19 BEDROOM</option>
<option value="20.00" >20 BEDROOM</option>
</select>

</td>


			<td height="30" width="1">&nbsp;</td>
			<td valign="top" height="30" width="20">



<FONT SIZE="-1"><NOBR># of Baths:</NOBR></font><select name="bath_pref[]" multiple  SIZE=3 STYLE="Background-Color : #FFFFFF">
<option value="1.00" >1 BATH</option>
<option value="1.50" >1.5 BATH</option>
<option value="2.00" >2 BATH</option>
<option value="2.50" >2.5 BATH</option>
<option value="3.00" >3 BATH</option>
<option value="3.50" >3.5 BATH</option>
<option value="4.00" >4 BATH</option>
<option value="4.50" >4.5 BATH</option>
<option value="5.00" >5 BATH</option>
<option value="5.50" >5.5 BATH</option>
<option value="6.00" >6 BATH</option>
<option value="99.00" >SHARED BATH</option>
</select>

<FONT SIZE="-3"><BR></FONT>

<FONT SIZE="-1"><NOBR>Pets preference:</NOBR></font><select name="pets_pref[]" multiple  SIZE=3 STYLE="Background-Color : #FFFFFF"> 
<option value="0.00" >Not Selected</option>
<option value="1.00" >NO PETS</option>
<option value="2.00" >Small pets ok</option>
<option value="3.00" >Cat ok</option>
<option value="3.50" >Cat (declawed)</option>
<option value="3.60" >Cat (indoor)</option>
<option value="4.00" >Small dog ok</option>
<option value="5.00" >Pets Ok</option>
<option value="6.00" >Pet Friendly</option>
<option value="7.00" >Pet Negotiable</option>
</select>

</TD>




			<td height="30" width="1">&nbsp;</td>





			</tr>
			</table>


<NOBR><FONT SIZE="-1">Furnished? <input type="checkbox" name="client_furnished" value="1"> &nbsp; 

Short-Term? <input type="checkbox" name="client_shortterm" value="1"></NOBR></FONT>

<TABLE><TR><TD>
<FONT SIZE="-1"><NOBR>Additional Comments:</NOBR></font><BR><textarea name="client_notes" rows="5" cols="75"><?php echo $rowGetClient->CLIENT_NOTES;?></textarea>
</TD></TR></TABLE>


<TABLE><TR><TD>

<script type="text/javascript" src="http://api.recaptcha.net/challenge?k=6Lf9HroSAAAAAAI0tzYDO-43qKcWVTIQV9Lq_1hi"></script>

	<noscript>
  		<iframe src="http://api.recaptcha.net/noscript?k=6Lf9HroSAAAAAAI0tzYDO-43qKcWVTIQV9Lq_1hi" height="300" width="500" frameborder="0"></iframe><br/>
  		<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
  		<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
	</noscript>

</TD><TD>&nbsp;&nbsp;</TD><TD VALIGN="MIDDLE" ALIGN="CENTER">

<TABLE ><TR><TD VALIGN="MIDDLE" ALIGN="CENTER">
<input type="submit" value="Submit Client Information" STYLE="Background-Color : #00DD00;font-size:16px;height:45"><BR>
</TD></TR><TR><TD VALIGN="MIDDLE" ALIGN="CENTER">

<TABLE><TR><TD><IMG SRC="http://www.bostonapartments.com/no_spam.gif"></TD><TD>&nbsp;</TD><TD><FONT SIZE="-2"><NOBR>We respect your privacy.</NOBR><BR><NOBR>Submitting this form</NOBR><BR><NOBR>will not subject you to spam.</NOBR></FONT></TD></TR></TABLE>

</TD></TR></TABLE>

</form>
</TD></TR></TABLE>

<P>

<CENTER><FORM><INPUT TYPE="button" NAME="back" VALUE="BACK" onClick="history.go(-1)"></FORM><BR></CENTER><P><BR>
</font>
<div align="center">
<p><a href="#top" onfocus="if(this.blur)this.blur();"><img src="http://www.areahomesrealty.com/art/top.gif" alt="" height="17" width="44" border="0"></a></p>
</font>
<div class="text">
<div align="center">
<img src="http://www.areahomesrealty.com/footer.gif" alt="" height="52" width="575" border="0">
</font>
</font>
	</body>
	</html>
<?php } ?>