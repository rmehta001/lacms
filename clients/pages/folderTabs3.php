<?php

if (!$cid) {
	$cid = "0";
}

$adlTab = "yellowTab";
$adlClick = "tabNav('adlEdit', $cid);";
$photoTab = "yellowTab";
$photoClick = "tabNav('managePics', $cid);";
$dealTab = "yellowTab";
$dealClick = "tabNav('manageListingDeals', $cid);";
$printTab = "yellowTab";
$printClick = "tabNav('printOuts', $cid);";




if ($page=="adlEdit-wysiwyg") {
	$preAd = "<span onClick=\"selectView('simple');\">";
	$postAd = "</span>";
	$preListing = "<span onClick=\"selectView('full');\">";
	$postListing = "</span>";

	$adlTab = "whiteTab";
	$adlClick = "";
}elseif ($page=="managePics" || $page=="upload" || $page=="uploadDo" || $page=="editPic" || $page=="deletePic" || $page=="deletePicDo") {
	$photoTab = "whiteTab";
	$photoClick = "";
}elseif ($page=="manageListingDeals" || $page=="createDeal" || $page=="editListingDeal" || $page=="editDealAccounting" || $page=="editDealClients") {
	$dealTab = "whiteTab";
	$dealClick = "";
}elseif ($page=="printOuts") {
	$printTab = "whiteTab";
	$printClick = "";	
}
?>
	
	
	
	
	
<div width="100%"><NOBR><span onClick="<?php echo $adlClick;?>" class="<?php echo $adlTab;?>First" style="width:155;"><?php echo $preAd;?>Ad <img src="../assets/images/simple.gif" width="15" height="15"><?php echo $postAd;?> | <?php echo $preListing;?>Listing <img src="../assets/images/full.gif" width="15" height="15"><?php echo $postListing;?></span><?php if ($user_level>0.5) {?><?php if ($rowGetAd->CSOURCE=='0' OR $rowGetAd->CID == NULL) {  ?><span onClick="<?php echo $photoClick;?>" class="<?php echo $photoTab;?>" style="width:70;">Photos <img border='0' src='../../images/pic.gif'></span><?php } else { ?><a href=https://www.BostonApartments.com/homepage.php?cli=<?php echo $rowGetAd->CLI;?>&ad=<?php echo $rowGetAd->CID;?>&uid=<?php echo $rowGetAd->UID;;?> target=_NEW><span class="<?php echo $photoTab;?>" style="width:70;">Photos <img border='0' src='../../images/pic.gif'></A></span><?php } ?><span onClick="<?php echo $dealClick;?>" class="<?php echo $dealTab;?>" style="width:100;">Deal Sheets <img src="../assets/images/icons/dealsheet-icon.png" vspace="0" hspace="0" border="0" height="18" width="18"></span><span onClick="<?php echo $printClick;?>" class="<?php echo $printTab;?>" style="width:100;">Printouts <img src="../assets/images/printer.gif" vspace="0" hspace="0" border="0" height="18" width="18"></span><?php }?></NOBR></div>
