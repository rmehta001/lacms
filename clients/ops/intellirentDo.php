<?php

$INTELLIRENT = $_POST['INTELLIRENT'];
$group = $_SESSION['group'];
$isAdmin = $_SESSION['isAdmin'];
$user_level = $_SESSION['user_level'];

$grpqry = "SELECT * FROM `GROUP` WHERE `GRID` = '$grid'";
//echo $grpqry;
$grpres = mysqli_query($dbh, $grpqry);
$rowGetGrp = mysqli_fetch_object($grpres);
//$quStrPSPrefs = "UPDATE `GROUP` SET `GRID`= $rowGetGrp->GRID,`NAME`=$rowGetGrp->NAME,`MAXACT`=$rowGetGrp->MAXACT,`LEVEL`=$rowGetGrp->LEVEL,`ADMIN`=$rowGetGrp->ADMIN,`SIG`=$rowGetGrp->SIG,`GROUP_PHONE`=$rowGetGrp->GROUP_PHONE,`GROUP_EMAIL`=$rowGetGrp->GROUP_EMAIL,`GROUP_URL`=$rowGetGrp->GROUP_URL,`GROUP_LOGO`=$rowGetGrp->GROUP_LOGO,`HEAD`=$rowGetGrp->HEAD,`FOOT`=$rowGetGrp->FOOT,`ABV`=$rowGetGrp->ABV,`GRSTATUS`=$rowGetGrp->GRSTATUS,`USE_GROUP_SIG_ALWAYS`=$rowGetGrp->USE_GROUP_SIG_ALWAYS,`ALLOW_PERSONAL_SIG`=$rowGetGrp->ALLOW_PERSONAL_SIG,`IP_ADDRESS`=$rowGetGrp->IP_ADDRESS,`RESTRICT_IP`=$rowGetGrp->RESTRICT_IP,`TYPE1_HEAD`=$rowGetGrp->TYPE1_HEAD,`TYPE1_FOOT`=$rowGetGrp->TYPE1_FOOT,`TYPE2_HEAD`=$rowGetGrp->TYPE2_HEAD,`TYPE2_FOOT`=$rowGetGrp->TYPE2_FOOT,`TYPE3_HEAD`=$rowGetGrp->TYPE3_HEAD,`TYPE3_FOOT`=$rowGetGrp->TYPE3_FOOT,`TYPE4_HEAD`=$rowGetGrp->TYPE4_HEAD,`TYPE4_FOOT`=$rowGetGrp->TYPE4_FOOT,`TYPE5_HEAD`=$rowGetGrp->TYPE5_HEAD,`TYPE5_FOOT`=$rowGetGrp->TYPE5_FOOT,`TYPE6_HEAD`=$rowGetGrp->TYPE6_HEAD,`TYPE6_FOOT`=$rowGetGrp->TYPE6_FOOT,`TYPE7_HEAD`=$rowGetGrp->TYPE7_HEAD,`TYPE7_FOOT`=$rowGetGrp->TYPE7_FOOT,`TYPE8_HEAD`=$rowGetGrp->TYPE8_HEAD,`TYPE8_FOOT`=$rowGetGrp->TYPE8_FOOT,`TYPE9_HEAD`=$rowGetGrp->TYPE9_HEAD,`TYPE9_FOOT`=$rowGetGrp->TYPE9_FOOT,`TYPE10_HEAD`=$rowGetGrp->TYPE10_HEAD,`TYPE10_FOOT`=$rowGetGrp->TYPE10_FOOT,`TYPE11_HEAD`=$rowGetGrp->TYPE11_HEAD,`TYPE11_FOOT`=$rowGetGrp->TYPE11_FOOT,`TYPE12_HEAD`=$rowGetGrp->TYPE12_HEAD,`TYPE12_FOOT`=$rowGetGrp->TYPE12_FOOT,`TYPE13_HEAD`=$rowGetGrp->TYPE13_HEAD,`TYPE13_FOOT`=$rowGetGrp->TYPE13_FOOT,`MEETAGENTS_HEAD`=$rowGetGrp->MEETAGENTS_HEAD,`MEETAGENTS_FOOT`=$rowGetGrp->MEETAGENTS_FOOT,`OPENHOUSE_HEAD`=$rowGetGrp->OPENHOUSE_HEAD,`OPENHOUSE_FOOT`=$rowGetGrp->OPENHOUSE_FOOT,`HOMEPAGE_HEAD`=$rowGetGrp->HOMEPAGE_HEAD,`HOMEPAGE_FOOT`=$rowGetGrp->HOMEPAGE_FOOT,`COBROKE_HEAD`=$rowGetGrp->COBROKE_HEAD,`COBROKE_FOOT`=$rowGetGrp->COBROKE_FOOT,`COBROKE_PW`=$rowGetGrp->COBROKE_PW,`COBROKE_VIEW`=$rowGetGrp->COBROKE_VIEW,`COBROKE_BOS`=$rowGetGrp->COBROKE_BOS,`WATERMARK`=$rowGetGrp->WATERMARK,`WATERMARK_ON`=$rowGetGrp->WATERMARK_ON,`WATERMARK_PLACEMENT`=$rowGetGrp->WATERMARK_PLACEMENT,`PIC_CUSTOM_WIDTH`=$rowGetGrp->PIC_CUSTOM_WIDTH,`PIC_CUSTOM_HEIGHT`=$rowGetGrp->PIC_CUSTOM_HEIGHT,`WATERMARK_FONT`=$rowGetGrp->WATERMARK_FONT,`EMAIL_HEADER`=$rowGetGrp->EMAIL_HEADER,`EMAIL_FOOTER`=$rowGetGrp->EMAIL_FOOTER,`CL_HEADER`=$rowGetGrp->CL_HEADER,`CL_FOOTER`=$rowGetGrp->CL_FOOTER,`CL_EMAIL`=$rowGetGrp->CL_EMAIL,`CL_PHONE`=$rowGetGrp->CL_PHONE,`CL_AGENTS`=$rowGetGrp->CL_AGENTS,`CL_USE_SIG`=$rowGetGrp->CL_USE_SIG,`SHOW_FBLIKE`=$rowGetGrp->SHOW_FBLIKE,`REGKEY`=$rowGetGrp->REGKEY,`REGEXP`=$rowGetGrp->REGEXP,`REGFEE`=$rowGetGrp->REGFEE,`AGENCIES`=$rowGetGrp->AGENCIES,`EXTERNALGRID`=$rowGetGrp->EXTERNALGRID,`RENTJUICE_KEY`=$rowGetGrp->RENTJUICE_KEY,`RENTJUICE`=$rowGetGrp->RENTJUICE,`RENTJUICE_MLS`=$rowGetGrp->RENTJUICE_MLS,`YGL`=$rowGetGrp->YGL,`YGL_KEY`=$rowGetGrp->YGL_KEY,`YGL_FEED`=$rowGetGrp->YGL_FEED, INTELLIRENT=$INTELLIRENT, `EMAIL_LISTINGS`=$rowGetGrp->EMAIL_LISTINGS,`LUXURY`=$rowGetGrp->LUXURY WHERE `GRID`=$grid";
$quStrPSPrefs = "UPDATE `GROUP` SET `INTELLIRENT` = '$INTELLIRENT' WHERE `GRID` = $grid";
$quStrPSPrefsNew = mysqli_real_escape_string ( $dbh , $quStrPSPrefs ); 
//echo $quStrPSPrefsNew;
$quPSPrefs = mysqli_query($dbh,$quStrPSPrefs) or die ("Something is wrong with sigsettingsprefsDo");

if (($isAdmin)  OR ($user_level <="10")) {
$page = "admin";
$msg = "Intellirent settings for $group saved.";
$title = "Admin";
} else {
$page = "home";
$title = "Hot List";
$msg = "You are not authorized to make this change.";
 }


?>
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

