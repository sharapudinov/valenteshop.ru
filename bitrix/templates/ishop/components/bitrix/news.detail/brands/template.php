<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>
<div class="brand_view_detail">
	
	<?if( is_array( $arResult["DETAIL_PICTURE"] ) ){?>
		<a class="fancy" rel="stock_gallery" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">			
			<img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
		</a>
		
	<?}?>
	<div class="text">
		<?=$arResult["DETAIL_TEXT"]?>
	</div>
	
	<div class="shadow-item_info"><img border="0" src="/bitrix/templates/ishop/img/shadow-item_info_revert.png" alt=""></div>
	<?$GLOBALS["arrFilter"] = array( "PROPERTY_BRAND" => $arResult["ID"] )?>
	<?$APPLICATION->IncludeComponent("bitrix:catalog.section", "shop_table_preview", array(
	"IBLOCK_TYPE" => "aspro_ishop_catalog",
	"IBLOCK_ID" => $arParams["IBLOCK_CATALOG_ID"],
	"SECTION_ID" => "",
	"SECTION_CODE" => "",
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"FILTER_NAME" => "arrFilter",
	"INCLUDE_SUBSECTIONS" => "Y",
	"SHOW_ALL_WO_SECTION" => "Y",
	"PAGE_ELEMENT_COUNT" => "28",
	"LINE_ELEMENT_COUNT" => "4",
	"PROPERTY_CODE" => array(
		0 => "HIT",
		1 => "RECOMMEND",
		2 => "NEW",
		3 => "STOCK",
	),
	"OFFERS_LIMIT" => "5",
	"SECTION_URL" => "",
	"DETAIL_URL" => "",
	"BASKET_URL" => "/basket/",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"ADD_SECTIONS_CHAIN" => "N",
	"DISPLAY_COMPARE" => "Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"CACHE_FILTER" => "N",
	"PRICE_CODE" => array(
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_PROPERTIES" => array(
	),
	"USE_PRODUCT_QUANTITY" => "N",
	"CONVERT_CURRENCY" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "shop",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
</div>