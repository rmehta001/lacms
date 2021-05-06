<?php
//BEGIN client Reassign Do //

$clid = isset($_GET['clid']) ? $_GET['clid'] : '1';
$cluid = isset($_GET['cluid']) ? $_GET['cluid'] : '1';
$return =  isset($_GET['return']) ? $_GET['return'] : '1';
//print_r($_GET);
//echo $clid;

if (isset($cluid) and ($cluid=="$uid") OR isset($user_level) and ($user_level >="4") OR isset($isAdmin)) {
$tempClient = "SELECT * FROM CLIENTS WHERE `CLID`='$clid' AND `UID`='$cluid'";
$tC = mysqli_query($dbh,$tempClient);
$tCobj =  mysqli_fetch_object($tC);
//echo $tempClient."hello";
while ($row = $tC->fetch_assoc()) {
    echo $row."<br> hey yo";
}
$timestamp = strtotime($tCobj->CLDOB);
//echo $timestamp;
$quStrTransferClient = "UPDATE `CLIENTS` SET `CLID`='$tCobj->CLID',`GRID`='$tCobj->GRID',`UID`='$tCobj->UID',`PUBLIC`='$tCobj->PUBLIC',`SHARE_WITH`='$tCobj->SHARE_WITH',`STATUS_CLIENT`='1',`CLIENT_STATUS2`='$tCobj->CLIENT_STATUS2',`NAME_FIRST`='$tCobj->NAME_FIRST',`NAME_LAST`='$tCobj->NAME_LAST',`HOME_PHONE`='$tCobj->HOME_PHONE',`WORK_PHONE`='$tCobj->WORK_PHONE',`MOBILE_PHONE`='$tCobj->MOBILE_PHONE',`FAX`='$tCobj->FAX',`CLIENT_EMAIL`='$tCobj->CLIENT_EMAIL',`CLIENT_EMAIL2`= '$tCobj->CLIENT_EMAIL2',`CURADDRESS`='$tCobj->CURADDRESS',`CURCITY`='$tCobj->CURCITY',`CURSTATE`='$tCobj->CURSTATE',`CURZIP`='$tCobj->CURZIP',`PRICEMIN`='$tCobj->PRICEMIN',`PRICEMAX`= '$tCobj->PRICEMAX',`AVAIL_PREF`='$tCobj->AVAIL_PREF',`LOC_PREF`='$tCobj->LOC_PREF',`BUILDING_PREF`='$tCobj->BUILDING_PREF',`LEADSAFE`='$tCobj->LEADSAFE',`ROOMS_PREF`='$tCobj->ROOMS_PREF',`BATH_PREF`='$tCobj->BATH_PREF',`NUM_PEOPLE`='$tCobj->NUM_PEOPLE',`CLIENT_TYPE`='$tCobj->CLIENT_TYPE',`CLIENT_SUBTYPE`='$tCobj->CLIENT_SUBTYPE',`CLIENT_EMPLOYMENT`='$tCobj->CLIENT_EMPLOYMENT',`CLIENT_FURNISHED`='$tCobj->CLIENT_FURNISHED',`CLIENT_SHORTTERM`='$tCobj->CLIENT_SHORTTERM',`PETS_PREF`='$tCobj->PETS_PREF',`TYPE_PREF`='$tCobj->TYPE_PREF',`CLIENT_NOTES`='$tCobj->CLIENT_NOTES',`TENANT_FEE_PAID`='$tCobj->TENANT_FEE_PAID',`PAYMENT_FIRST_PAID`='$tCobj->PAYMENT_FIRST_PAID',`PAYMENT_LAST_PAID`='$tCobj->PAYMENT_LAST_PAID',`PAYMENT_SEC_PAID`='$tCobj->PAYMENT_SEC_PAID',`KEY_DEP_PAID`='$tCobj->KEY_DEP_PAID',`CLEAN_DEP_PAID`='$tCobj->CLEAN_DEP_PAID',`CLIENT_APP_STATUS`='$tCobj->CLIENT_APP_STATUS',`CLIENT_CREDIT_CHECK`='$tCobj->CLIENT_CREDIT_CHECK',`FEE_DISCLOSURE`='$tCobj->FEE_DISCLOSURE',`AGENCY_DISCLOSURE`='$tCobj->AGENCY_DISCLOSURE',`MODIFIED_LAST`='$tCobj->MODIFIED_LAST',`CREATED_BY`='$tCobj->CREATED_BY',`DATE_CREATED`='$tCobj->DATE_CREATED',`DATE_MODIFIED`='$tCobj->DATE_MODIFIED',`DATE_NEXT_CONTACT`='$tCobj->DATE_NEXT_CONTACT',`DATE_MOVEIN`='$tCobj->DATE_MOVEIN',`DATE_MOVEIN_END`='$tCobj->DATE_MOVEIN_END',`NEWSLETTER_SUBSCRIBE`='$tCobj->NEWSLETTER_SUBSCRIBE',`SOCIAL`='$tCobj->SOCIAL',`CLDOB`= NULL,`CURREMPLOY`='$tCobj->CURREMPLOY',`CURREMPLOYADDRESS`='$tCobj->CURREMPLOYADDRESS',`CURREMPLOYPHONE`='$tCobj->CURREMPLOYPHONE',`CURREMPLOYCONTACT`='$tCobj->CURREMPLOYCONTACT',`CURREMPLOYPOS`='$tCobj->CURREMPLOYPOS',`CURREMPLOYSALARY`='$tCobj->CURREMPLOYSALARY',`PREVEMPLOY`='$tCobj->PREVEMPLOY',`PREVEMPLOYADDRESS`='$tCobj->PREVEMPLOYADDRESS',`PREVEMPLOYPHONE`='$tCobj->PREVEMPLOYPHONE',`PREVEMPLOYCONTACT`='$tCobj->PREVEMPLOYCONTACT',`PREVEMPLOYPOS`='$tCobj->PREVEMPLOYPOS',`PREVEMPLOYSALARY`='$tCobj->PREVEMPLOYSALARY',`CURRLL`='$tCobj->CURRLL',`CURRLLADDRESS`='$tCobj->CURRLLADDRESS',`CURRLLPHONE`='$tCobj->CURRLLPHONE',`CURRLLRENT`='$tCobj->CURRLLRENT',`PREVLL`='$tCobj->PREVLL',`PREVLLADDRESS`='$tCobj->PREVLLADDRESS',`PREVLLPHONE`='$tCobj->PREVLLPHONE',`PREVLLRENT`='$tCobj->PREVLLRENT',`CREDITREF`='$tCobj->CREDITREF',`CREDITACCOUNT`='$tCobj->CREDITACCOUNT',`PERSREF`='$tCobj->PERSREF',`PERSREFCONTACT`='$tCobj->PERSREFCONTACT',`SHOW_DATE`='$tCobj->SHOW_DATE',`SHOW_TIME`='$tCobj->SHOW_TIME',`SHOW_LENGTH`='$tCobj->SHOW_LENGTH',`SOURCE`='$tCobj->SOURCE',`UNAME`='$tCobj->UNAME',`PWORD`='$tCobj->PWORD' WHERE `CLID`='$clid' AND `UID`='$cluid'";
//echo $quStrTransferClient . "query";
$quTransferClient = mysqli_query($dbh, $quStrTransferClient);



if (isset($return)) if ($return =="hotlist"){
$msg = "The Client status has been changed to ACTIVE";
		$title = "Hot List";
		$disData = "user";
		$page = "home";
} else {
$msg = "The Client status has been changed to ACTIVE ";
		$title = "Manage Clients";
		$disData = "clients";
		$sec_op = "manageClients";
                $page = "manageClients";
}

} else {
$msg = "<FONT COLOR=RED>The Client status was NOT changed</FONT>. Either it's not your client or you're not the Admin";
		$title = "Manage Clients";
		$disData = "clients";
		$sec_op = "manageClients";

}

//END client Reassign Do //
?>