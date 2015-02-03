<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
?><div class="inside_page_content"> 	 
  <h4>Карта сайта</h4>
 <?$APPLICATION->IncludeComponent(
	"bitrix:main.map",
	"map",
	Array(
		"LEVEL" => "3",
		"COL_NUM" => "1",
		"SHOW_DESCRIPTION" => "N",
		"SET_TITLE" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600"
	)
);?> 
 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"map",
	Array(
		"IBLOCK_TYPE" => "aspro_ishop_catalog",
		"IBLOCK_ID" => "15",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_URL" => "",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "3",
		"SECTION_FIELDS" => "",
		"SECTION_USER_FIELDS" => "",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N"
	)
);?> 
 </div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>