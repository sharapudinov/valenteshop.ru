<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	CModule::IncludeModule("iblock");
	
	$sectionRes = array();
	if ($arResult["VARIABLES"]["SECTION_ID"]>0)
	{
		$arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y', "ID" => $arResult["VARIABLES"]["SECTION_ID"]);
		$db_list = CIBlockSection::GetList(array(), $arFilter, true, array("ID", "NAME"));
		while($section = $db_list->GetNext())
		{
			$sectionRes["NAME"] = $section["NAME"];
			$sectionRes["ID"] = $section["ID"];
		}
	}
	elseif(strlen(trim($arResult["VARIABLES"]["SECTION_CODE"]))>0)
	{
	  $arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y', "=CODE" => $arResult["VARIABLES"]["SECTION_CODE"]);
	  $db_list = CIBlockSection::GetList(array(), $arFilter, true, array("ID", "NAME"));
	  while($section = $db_list->GetNext())
	  {
		$sectionRes["NAME"] = $section["NAME"];
		$sectionRes["ID"] = $section["ID"];
	  }
	} 

	$elementRes =array();
	if ($arResult["VARIABLES"]["ELEMENT_ID"]>0)
	{
		$arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y', "ID" => $arResult["VARIABLES"]["ELEMENT_ID"]);
		$db_list = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "NAME"));
		while($element = $db_list->GetNext())
		{
			$elementRes["NAME"] = $element["NAME"];
			$elementRes["ID"] = $element["ID"];
		}
	}
	elseif(strlen(trim($arResult["VARIABLES"]["ELEMENT_CODE"]))>0)
	{
	  $arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y', "=CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"]);
	  $db_list = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "NAME"));
	  while($element = $db_list->GetNext())
	  {
		$elementRes["NAME"] = $element["NAME"];
		$elementRes["ID"] = $element["ID"];
	  }
	} 
	
	$arPageParams = array();
	if($arParams["DETAIL_META_KEYWORDS"])
	{
		if ($arResult["PROPERTIES"][$arParams["DETAIL_META_KEYWORDS"]]["VALUE"])
		{ $arPageParams["keywords"] = $arResult["PROPERTIES"][$arParams["DETAIL_META_KEYWORDS"]]["VALUE"]; }
	}
	if($arParams["DETAIL_META_DESCRIPTION"])
	{
		if ($arResult["PROPERTIES"][$arParams["DETAIL_META_DESCRIPTION"]]["VALUE"]) 
		{ $arPageParams["description"] = $arResult["PROPERTIES"][$arParams["DETAIL_META_DESCRIPTION"]]["VALUE"]; }
	}
	if($arParams["DETAIL_BROWSER_TITLE"])
	{
		if ($arResult["PROPERTIES"][$arParams["DETAIL_BROWSER_TITLE"]]["VALUE"])
		{ $arPageParams["title"] = $arResult["PROPERTIES"][$arParams["DETAIL_BROWSER_TITLE"]]["VALUE"]; }
	}
	foreach($arPageParams as $code => $value ) { if ($value) { $APPLICATION->SetPageProperty($code, $value); } else {unset($res["PAGE"][$code]);}}
	
	function get_section_path($section_id)
	{	
		$nav = CIBlockSection::GetNavChain(false, $section_id);
		$index = 100;
		while($ar = $nav->GetNext())
		{			
			?><a href="<?=$ar["SECTION_PAGE_URL"]?>"><?=$ar["NAME"]?></a><span class="chain">&rarr;</span><?
		}
	}
?>

<h1 class="title"><?=$elementRes["NAME"]?></h1>

<div class="breadcrumb">
	<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "shop", Array(
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => SITE_ID,
		), false
	);?>
	<?get_section_path($sectionRes["ID"]);?>
</div>



<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.element",
	"shop",
	Array(
		"SEF_URL_TEMPLATES" => $arParams["SEF_URL_TEMPLATES"],
		"IBLOCK_REVIEWS_TYPE" => $arParams["IBLOCK_REVIEWS_TYPE"],
		"IBLOCK_REVIEWS_ID" => $arParams["IBLOCK_REVIEWS_ID"],
		"SEF_MODE_BRAND_SECTIONS" => $arParams["SEF_MODE_BRAND_SECTIONS"],
		"SEF_MODE_BRAND_ELEMENT" => $arParams["SEF_MODE_BRAND_ELEMENT"],
		"USE_COMPARE" => $arParams["USE_COMPARE"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["DETAIL_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["DETAIL_META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["DETAIL_BROWSER_TITLE"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
		"LINK_IBLOCK_TYPE" => $arParams["LINK_IBLOCK_TYPE"],
		"LINK_IBLOCK_ID" => $arParams["LINK_IBLOCK_ID"],
		"LINK_PROPERTY_SID" => $arParams["LINK_PROPERTY_SID"],
		"LINK_ELEMENTS_URL" => $arParams["LINK_ELEMENTS_URL"],
		"USE_ALSO_BUY" => $arParams["USE_ALSO_BUY"],
		"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arParams["DETAIL_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arParams["DETAIL_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
		"SKU_DISPLAY_LOCATION" => $arParams["SKU_DISPLAY_LOCATION"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"ADD_SECTIONS_CHAIN" => "N",
		"USE_STORE" => $arParams["USE_STORE"],
		"USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
		"USE_STORE_SCHEDULE" => $arParams["USE_STORE_SCHEDULE"],
		"USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
		"MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
		"STORE_PATH" => $arParams["STORE_PATH"],
		"MAIN_TITLE" => $arParams["MAIN_TITLE"],
		"USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"IBLOCK_STOCK_ID" => $arParams["IBLOCK_STOCK_ID"],
		"SEF_MODE_STOCK_SECTIONS" => $arParams["SEF_MODE_STOCK_SECTIONS"],
		"SHOW_QUANTITY" => $arParams["SHOW_QUANTITY"],
		"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
		"CURRENCY_ID" => $arParams["CURRENCY_ID"],
		"USE_ELEMENT_COUNTER" => $arParams["USE_ELEMENT_COUNTER"],
		
		"USE_REVIEW" => $arParams["USE_REVIEW"],
		"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
		"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
		"REVIEW_AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
		"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
		"FORUM_ID" => $arParams["FORUM_ID"],
		"URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
		"SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"],
		"POST_FIRST_MESSAGE" => $arParams["POST_FIRST_MESSAGE"],
		"SHOW_BRAND_PICTURE" => $arParams["SHOW_BRAND_PICTURE"],
		"SHOW_FOUND_CHEAPER" => $arParams["SHOW_FOUND_CHEAPER"],
		"SHOW_ASK_BLOCK" => $arParams["SHOW_ASK_BLOCK"],
		"ASK_FORM_ID" => $arParams["ASK_FORM_ID"],
		"PROPERTIES_DISPLAY_LOCATION" => $arParams["PROPERTIES_DISPLAY_LOCATION"],
		"PROPERTIES_DISPLAY_TYPE" => $arParams["PROPERTIES_DISPLAY_TYPE"],
	),
	$component
);?>
		

<div class="sideRight shop">
	
	<?$APPLICATION->IncludeComponent(
		"bitrix:sale.viewed.product", "shop",
		Array(
			"VIEWED_COUNT" => "3",
			"VIEWED_NAME" => "Y",
			"VIEWED_IMAGE" => "Y",
			"VIEWED_PRICE" => "N",
			"VIEWED_CANBUY" => "N",
			"VIEWED_CANBUSKET" => "N",
			"VIEWED_IMG_HEIGHT" => "150",
			"VIEWED_IMG_WIDTH" => "150",
			"BASKET_URL" => SITE_DIR."basket/",
			"ACTION_VARIABLE" => "action",
			"PRODUCT_ID_VARIABLE" => "id",
			"SET_TITLE" => "N"
		)
	);?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list", "advt",
		Array(
			"DISPLAY_DATE" => "N",
			"DISPLAY_NAME" => "N",
			"DISPLAY_PICTURE" => "N",
			"DISPLAY_PREVIEW_TEXT" => "N",
			"AJAX_MODE" => "N",
			"IBLOCK_TYPE" => $arParams["IBLOCK_ADVT_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ADVT_ID"],
			"NEWS_COUNT" => "20",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_ORDER1" => "DESC",
			"SORT_BY2" => "SORT",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "",
			"FIELD_CODE" => array(0=>"DETAIL_PICTURE",),
			"PROPERTY_CODE" => array(0=>"LINK",),
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"SET_TITLE" => "N",
			"SET_STATUS_404" => "N",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"PARENT_SECTION" => $arParams["IBLOCK_ADVT_SECTION_ID"],
			"PARENT_SECTION_CODE" => "",
			"CACHE_TYPE" => "N",
			"CACHE_TIME" => "36000000",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => "",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N"
		)
	);?>
</div>

<div style="clear: both"></div>

<?
	$rsBasket = CSaleBasket::GetList( array( "NAME" => "ASC", "ID" => "ASC"   ),
   array(  "FUSER_ID" => CSaleBasket::GetBasketUserID(),  "LID" => SITE_ID, "ORDER_ID" => "NULL", "CAN_BUY" => "Y",  "DELAY" => "N",  "SUBSCRIBE" => "N" ),
   false, false, array("ID", "PRODUCT_ID", "QUANTITY") );
	  
	while( $arBasket = $rsBasket->GetNext() )
	{
		if( $arBasket["DELAY"] == "Y" ){ $delay_items[] = $arBasket["PRODUCT_ID"];}
		else{$basket_items[] = $arBasket["PRODUCT_ID"];}
	}
	global $compare_items;
?>
<script>
	$(document).ready(function(){
		<?foreach( $delay_items as $item_id ){?>
			$('a.wish_item[href^=#<?=$item_id?>]').addClass('active');
		<?}?>
		$('a.added').hide();
		<?foreach( $basket_items as $item_id ){?>
			$('a.add_item[element_id^=#<?=$item_id?>]').addClass("added").removeAttr("onclick").attr("href", "<?=SITE_DIR?>basket/").find("span").text("<?=GetMessage('CATALOG_IN_CART');?>");
			$('.counter_block[element_id^=#<?=$item_id?>]').remove();
			$('.equipment .buy_link a[element_id^=#<?=$item_id?>]').addClass("added").removeAttr("onclick").attr("href", "<?=SITE_DIR?>basket/").text("<?=GetMessage('CATALOG_IN_CART');?>");
			
		<?}?>
		<?foreach( $compare_items as $item_id ){?>
			$('a.compare_item[element_id^=#<?=$item_id?>]').addClass('active');
		<?}?>
	})
</script>
