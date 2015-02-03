<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?if (intval($_REQUEST["ELEMENT_ID"])):?>
	<?$APPLICATION->IncludeComponent("aspro:oneclickbuy", "shop", array(
		"IBLOCK_TYPE" => "aspro_ishop_catalog",
		"IBLOCK_ID" => "15",
		"ELEMENT_ID" => intval($_REQUEST["ELEMENT_ID"]),
		"USE_QUANTITY" => "N",
		"PROPERTIES" => array( 0 => "USER_NAME", 1 => "PHONE", 2 => "COMMENT"),
		"REQUIRED" => array( 0 => "USER_NAME", 1 => "PHONE"),
		"DEFAULT_PERSON_TYPE" => "3",
		"DEFAULT_DELIVERY" => "0",
		"DEFAULT_PAYMENT" => "0",
		"DEFAULT_CURRENCY" => "RUB",
		"PRICE_ID" => "1",
		"USE_SKU" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000",
		"SEF_FOLDER" => "//catalog/",
		), false
	);?>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>