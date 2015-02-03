<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?> 
<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);


$APPLICATION->IncludeComponent(
	"aspro2:test",
	"",
	Array(
		"IBLOCK_TYPE" => "aspro_ishop_catalog",
		"IBLOCK_ID" => "15",
		"ELEMENT_ID" => 755,
		"USE_QUANTITY" => "N",
		"SEF_FOLDER" => "/catalog/",
		"PROPERTIES" => array("USER_NAME","PHONE"),
		"REQUIRED" => array("USER_NAME","PHONE"),
		"DEFAULT_PERSON_TYPE" => "1",
		"DEFAULT_DELIVERY" => "0",
		"DEFAULT_PAYMENT" => "0",
		"DEFAULT_CURRENCY" => "RUB",
		"PRICE_ID" => "1",
		"USE_SKU" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000",
		"CACHE_NOTES" => ""
	)
);?>