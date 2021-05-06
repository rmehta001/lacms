<!--BEGIN hot_list_add -->
<?php
switch ($item_type) {
	case 1:
		$item_display = format_ad ($rowGetAd, $DEFINED_VALUE_SETS);		
		$item_type_name = "Listing";

$title = "$rowGetAd->LOCNAME - $rowGetAd->STREET_NUM $rowGetAd->STREET $rowGetAd->APT $$rowGetAd->PRICE $rowGetAd->AVAIL";

		break;
	case 2: 
		$item_display = format_deal($rowGetDeal);
		$item_type_name = "Dealsheet";
$title = "$rowGetAd->LOCNAME - $rowGetAd->STREET_NUM $rowGetAd->STREET $rowGetAd->APT $$rowGetAd->PRICE $rowGetAd->AVAIL";

		break;
	case 3: 
		$item_display = format_client ($rowGetClient);
		$item_type_name = "Client";

$title = "$rowGetClient->NAME_LAST, $rowGetClient->NAME_FIRST";

		break;
	
}
?>
	<center>
	<div class="ad"><img border="0" vspace="0" hspace="0" width="20" height="18" src="../assets/images/<?php echo $item_icon;?>"> &nbsp; Add <?php echo $item_type_name;?> to the Hot list.</div>


<?php echo $item_display;?>
<BR>

	<form action="<?php echo "$PHP_SELF?op=hot_list_addDo"; ?>" method="POST">
	<input type="hidden" name="return_page" value="<?php echo $return_page;?>">
	<input type="hidden" name="item_type" value="<?php echo $item_type;?>">
	<input type="hidden" name="item_id" value="<?php echo $item_id;?>">
	<input type="hidden" name="item_id2" value="<?php echo $item_id2;?>">
	<div class="menu"><P><BR>Name for Hot List Item: <input type="text" name="item_name" value="<?php echo $title;?>" SIZE=40> &nbsp;&nbsp; Share with office: <input type="checkbox" name="public" value="1"><FONT SIZE=-1><I>(Check for yes)</I></FONT></div>
	<input type="submit" value="Add to Hot List" STYLE="Background-Color : #E0FFFF">
	</form>
	</center>

	
	<BR><BR>					
<!--END hot_list_add -->