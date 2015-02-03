<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>

<div class="stock_detail">
	<?if( is_array( $arResult["DETAIL_PICTURE"] ) ){?>
		<a class="fancy hideipad hidephone" rel="stock_gallery" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">			
			<img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
		</a>
	<?}?>
	<div class="text">
		<?if( $arResult["PROPERTIES"]["PERIOD"]["VALUE"] ){?>
				<div class="period"><?=$arResult["PROPERTIES"]["PERIOD"]["VALUE"]?></div><br/>				
		<?}?>
		<?=$arResult["DETAIL_TEXT"]?>
	</div>
	<div style="clear:both"></div>
	<div class="shadow-item_info"><img border="0" src="/bitrix/templates/ishop/img/shadow-item_info_revert.png" alt=""></div>
	<?$GLOBALS["arrFilter"] = array( "ID" => $arResult["PROPERTIES"]["LINK"]["VALUE"] )?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"shop_table_preview",
		Array(
			"AJAX_MODE" => "N",
			"IBLOCK_TYPE" => $arParams["IBLOCK_CATALOG_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_CATALOG_ID"],
			"SECTION_ID" => "",
			"SECTION_CODE" => "",
			"SECTION_USER_FIELDS" => array(),
			"ELEMENT_SORT_FIELD" => "sort",
			"ELEMENT_SORT_ORDER" => "asc",
			"FILTER_NAME" => "arrFilter",
			"INCLUDE_SUBSECTIONS" => "Y",
			"SHOW_ALL_WO_SECTION" => "Y",
			"SECTION_URL" => "",
			"DETAIL_URL" => "",
			"BASKET_URL" => "/basket/",
			"ACTION_VARIABLE" => "action",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"META_KEYWORDS" => "-",
			"META_DESCRIPTION" => "-",
			"BROWSER_TITLE" => "-",
			"ADD_SECTIONS_CHAIN" => "N",
			"DISPLAY_COMPARE" => "Y",
			"SET_TITLE" => "N",
			"SET_STATUS_404" => "N",
			"PAGE_ELEMENT_COUNT" => "28",
			"LINE_ELEMENT_COUNT" => "4",
			"PROPERTY_CODE" => array(
				0 => "HIT",
				1 => "RECOMMEND",
				2 => "NEW",
				3 => "",
			),
			"OFFERS_FIELD_CODE" => array("ID"),
			"OFFERS_PROPERTY_CODE" => array(),
			"OFFERS_SORT_FIELD" => "sort",
			"OFFERS_SORT_ORDER" => "asc",
			"OFFERS_LIMIT" => "5",
			"PRICE_CODE" => array(0 => "BASE"),
			"USE_PRICE_COUNT" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"PRICE_VAT_INCLUDE" => "Y",
			"USE_PRODUCT_QUANTITY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Товары",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "shop",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"CONVERT_CURRENCY" => "N",
			"OFFERS_CART_PROPERTIES" => array(),
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N"
		)
	);?>
</div>