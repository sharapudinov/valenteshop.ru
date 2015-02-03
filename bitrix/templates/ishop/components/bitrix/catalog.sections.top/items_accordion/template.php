<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="accordion_list">
	<?$i = 0;
	foreach($arResult["SECTIONS"] as $arSection){
		if( !count( $arSection["ITEMS"] ) ) continue;
		$i++;?>
		<!--noindex-->
			<div class="item_name"><a rel="nofollow" href="#"><span><?=$arSection["NAME"]?></span></a></div>
		<!--/noindex-->
		<div class="item_list">
			<?$id_s = array();
			foreach( $arSection["ITEMS"] as $item ){
				$id_s[] = $item["ID"];
			}
			$GLOBALS['arrFilterExpandItems'] = array( "ID" => $id_s );
			$APPLICATION->IncludeComponent(
				"bitrix:catalog.section",
				"shop_table_preview",
				Array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"SECTION_ID" => 0,
					"SECTION_CODE" => "",
					"ELEMENT_SORT_FIELD" => "sort",
					"ELEMENT_SORT_ORDER" => "asc",
					"FILTER_NAME" => "arrFilterExpandItems",
					"INCLUDE_SUBSECTIONS" => "Y",
					"SHOW_ALL_WO_SECTION" => "Y",
					"PAGE_ELEMENT_COUNT" => "99999",
					"LINE_ELEMENT_COUNT" => 4,
					"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
					"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
					"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
					"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
					"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
					"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
					"BASKET_URL" => $arParams["BASKET_URL"],
					"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
					"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
					"PRODUCT_QUANTITY_VARIABLE" => "quantity",
					"PRODUCT_PROPS_VARIABLE" => "prop",
					"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
					"AJAX_MODE" => $arParams["AJAX_MODE"],
					"AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
					"AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
					"AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
					"CACHE_TYPE" =>$arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
					"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
					"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
					"ADD_SECTIONS_CHAIN" => "N",
					"DISPLAY_COMPARE" => $arParams["DISPLAY_COMPARE"],
					"SET_TITLE" => $arParams["SET_TITLE"],
					"SET_STATUS_404" => $arParams["SET_STATUS_404"],
					"CACHE_FILTER" => $arParams["CACHE_FILTER"],
					"PRICE_CODE" => $arParams["PRICE_CODE"],
					"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
					"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
					"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
					"USE_PRODUCT_QUANTITY" => $arParams["SET_STATUS_404"],
					"OFFERS_CART_PROPERTIES" => array(),
					"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
					"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
					"PAGER_TITLE" => $arParams["PAGER_TITLE"],
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
					"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
					"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
					"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
					"AJAX_OPTION_ADDITIONAL" => "",
					"ADD_CHAIN_ITEM" => "N"
				),
			$component
			);?>
		</div>
	<?}?>
</div>