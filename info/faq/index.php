<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Вопрос-ответ");
?>
<div class="item_faq_wrapp">


<?$APPLICATION->IncludeComponent("bitrix:news.list", "faq", array(
	"IBLOCK_TYPE" => "aspro_ishop_content",
	"IBLOCK_ID" => "18",
	"NEWS_COUNT" => "20",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "EMAIL",
		1 => "NAME",
		2 => "PHONE",
		3 => "THEME",
		4 => "",
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
	"CACHE_GROUPS" => "N",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<div class="shadow-item_info"><img border="0" alt="" src="<?=SITE_TEMPLATE_PATH?>/img/shadow-item_info.png"></div>
<?$APPLICATION->IncludeComponent("bitrix:form", "shop_faq1", array(
	"START_PAGE" => "new",
	"SHOW_LIST_PAGE" => "N",
	"SHOW_EDIT_PAGE" => "N",
	"SHOW_VIEW_PAGE" => "N",
	"SUCCESS_URL" => "",
	"WEB_FORM_ID" => "2",
	"RESULT_ID" => "",
	"SHOW_ANSWER_VALUE" => "N",
	"SHOW_ADDITIONAL" => "N",
	"SHOW_STATUS" => "N",
	"EDIT_ADDITIONAL" => "N",
	"EDIT_STATUS" => "N",
	"NOT_SHOW_FILTER" => array(
		0 => "",
		1 => "",
	),
	"NOT_SHOW_TABLE" => array(
		0 => "",
		1 => "",
	),
	"IGNORE_CUSTOM_TEMPLATE" => "N",
	"USE_EXTENDED_ERRORS" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/info/faq/",
	"AJAX_MODE" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CHAIN_ITEM_TEXT" => "",
	"CHAIN_ITEM_LINK" => "",
	"AJAX_OPTION_ADDITIONAL" => "",
	"VARIABLE_ALIASES" => array(
		"action" => "action",
	)
	),
	false
);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>