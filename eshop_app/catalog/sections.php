<?
define("BX_MOBILE_LOG", true);

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?$APPLICATION->IncludeComponent(
	"bitrix:eshopapp.sections",
	"",
	Array(
		"IBLOCK_TYPE" => "aspro_ishop_catalog",
		"IBLOCK_ID" => "15",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "180",
		"CACHE_GROUPS" => "Y",
		"SECTION_URL" => SITE_DIR."eshop_app/catalog/?SECTION_ID=#ID#"
	)
);
?>