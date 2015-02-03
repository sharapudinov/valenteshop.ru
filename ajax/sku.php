<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
print_r($_REQUEST);
$arFilter = array();
foreach($_REQUEST['prop'] as $key => $val){
	$arFilter['PROPERTY_'.$key][] = $val;
}
$arFilter["IBLOCK_ID"] = 28;
CModule::IncludeModule('catalog');
$rsStock = CIBlockElement::GetList(array(), $arFilter);
if($arStock = $rsStock->GetNext()){
	$ID = $arStock['ID'];
}?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.element",
	"shop_apd_ajax",
	Array(
		"IBLOCK_TYPE" => "aspro_ishop_catalog",
		"IBLOCK_ID" => "15",
		"ELEMENT_ID" => 486,
		"ELEMENT_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"HIDE_NOT_AVAILABLE" => "N",
		"PROPERTY_CODE" => array(0=>"",1=>"STOL",2=>"",),
		"OFFERS_FIELD_CODE" => array(0=>"",1=>"",),
		"OFFERS_PROPERTY_CODE" => array(0=>"CVETARAKOVINA",1=>"CVETASTOL",2=>"",),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "0",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"USE_ELEMENT_COUNTER" => "Y",
		"PRICE_CODE" => array(0=>"BASE",),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(),
		"OFFERS_CART_PROPERTIES" => array(),
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>