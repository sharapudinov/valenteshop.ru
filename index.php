<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords_inner", "мебель для ванной, валенте, valente");
$APPLICATION->SetPageProperty("title", "Мебель для ванной комнаты VALENTE (Валенте) | Официальный сайт Интернет-магазина Валенте шоп");
$APPLICATION->SetPageProperty("description", "Мебель для ванной комнаты Valente (Валенте) по самым минимальным ценам! Интернет-магазин Валенте Шоп. Доставка во все регионы! Дизайнерские решения для ванной комнаты.");
$APPLICATION->SetPageProperty("keywords", "мебель для ванной, валенте, valente");
$APPLICATION->SetTitle("Мебель для ванных комнат ВАЛЕНТЕ");
?>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "front_slider", array(
	"IBLOCK_TYPE" => "aspro_ishop_content",
	"IBLOCK_ID" => "17",
	"NEWS_COUNT" => "20",
	"SORT_BY1" => "SORT",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "DETAIL_PICTURE",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "LINK",
		1 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "123",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "N",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<table cellspacing="0" cellpadding="0" border="0" width="100%" class="index-cat">
	<tr><td class="left-block">
		<?$APPLICATION->IncludeComponent("bitrix:menu", "catalog_vertical", array(
			"ROOT_MENU_TYPE" => "left",
			"MENU_CACHE_TYPE" => "N",
			"MENU_CACHE_TIME" => "3600",
			"MENU_CACHE_USE_GROUPS" => "Y",
			"MENU_CACHE_GET_VARS" => array(
			),
			"MAX_LEVEL" => "2",
			"CHILD_MENU_TYPE" => "left",
			"USE_EXT" => "Y",
			"DELAY" => "N",
			"ALLOW_MULTI_SELECT" => "N"
			),
			false
		);?> 
		<?$APPLICATION->IncludeComponent("bitrix:news.list", "advt", array(
	"IBLOCK_TYPE" => "aspro_ishop_content",
	"IBLOCK_ID" => "17",
	"NEWS_COUNT" => "20",
	"SORT_BY1" => "SORT",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "DETAIL_PICTURE",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "LINK",
		1 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "121",
	"PARENT_SECTION_CODE" => "",
	"INCLUDE_SUBSECTIONS" => "Y",
	"PAGER_TEMPLATE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "N",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
	</td>
	<td>
    
    <h1 style="color: #99262B !important; ">МЕБЕЛЬ ДЛЯ ВАННОЙ КОМНАТЫ</h1>
     <div id="main_display_table" class="display_table">
<?$APPLICATION->IncludeComponent(
	"my:catalog.section", 
	"home_section", 
	array(
		"IBLOCK_TYPE" => "aspro_ishop_catalog",
		"IBLOCK_ID" => "25",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "name",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "9999",
		"LINE_ELEMENT_COUNT" => "4",
		"PROPERTY_CODE" => array(
			0 => "RAZDEl",
			1 => "TOVAR",
			2 => "",
		),
		"OFFERS_LIMIT" => "5",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/personal/basket.php",
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
		"CACHE_GROUPS" => "N",
		"SET_META_KEYWORDS" => "N",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "N",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"ADD_SECTIONS_CHAIN" => "N",
		"DISPLAY_COMPARE" => "N",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "Y",
		"CACHE_FILTER" => "N",
		"PRICE_CODE" => array(
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_PROPERTIES" => array(
		),
		"USE_PRODUCT_QUANTITY" => "N",
		"CONVERT_CURRENCY" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
   
   </div>
   

    
<div> 
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => "inc_index.php",
		"EDIT_TEMPLATE" => ""
	),
false
);?>

</div>
	</td></tr>
</table>



<img src="/include/shadow-bottom.png" width="100%" height="17"  />
<div class="about-company">
<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file","PATH" => "/include/front_info.php","EDIT_TEMPLATE" => ""));?>
</div>
<div class="news-front">
	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"news_front",
	Array(
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "aspro_ishop_content",
		"IBLOCK_ID" => "19",
		"NEWS_COUNT" => "1",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array("DATE_ACTIVE_FROM","DATE_CREATE"),
		"PROPERTY_CODE" => array(),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "200",
		"ACTIVE_DATE_FORMAT" => "d F",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	)
);?></div>
 
<br />
 
<div> <img src="/include/shadow-bottom.png" width="100%" height="17"  /> </div>

<?$APPLICATION->IncludeComponent("bitrix:news.list", "front_brands", array(
	"IBLOCK_TYPE" => "aspro_ishop_content",
	"IBLOCK_ID" => "14",
	"NEWS_COUNT" => "9999",
	"SORT_BY1" => "SORT",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array( 0 => "PREVIEW_PICTURE", 1 => "", ),
	"PROPERTY_CODE" => array( 0 => "", 1 => "", ),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "N",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
					<?/*$APPLICATION->IncludeComponent(
						"wlcomponents:callback",
						".default",
						Array(
							"JQUERY_ON" => "Y",
							"BOOTSTRAP_ON" => "Y",
							"JQUERYUI_ON" => "Y",
							"ADDITIONAL_FIELDS" => array()
						)
					);*/?> 
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>