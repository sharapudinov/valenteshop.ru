<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule("sale");
$arFields["PAY_SYSTEM_ID"]=$_REQUEST['PAY_SYSTEM_ID'];
CSaleOrder::Update($_REQUEST['ORDER_ID'], $arFields);
?>
 <?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.detail",
	"",
	Array(
		"PATH_TO_LIST" => "/personal/order/",
		"PATH_TO_CANCEL" => "",
		"PATH_TO_PAYMENT" => "payment.php",
		"ID" => $_REQUEST['ORDER_ID'],
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "Y",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"PICTURE_WIDTH" => "110",
		"PICTURE_HEIGHT" => "110",
		"PICTURE_RESAMPLE_TYPE" => "1",
		"CUSTOM_SELECT_PROPS" => array(),
		"PROP_3" => array(),
		"PROP_4" => array()
	),
$component
);?> 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>