<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>
<?$APPLICATION->IncludeComponent("aspro:eshop.sale.basket.basket", "shop", array(
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
	"COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "PROPS",
		2 => "PRICE",
		3 => "QUANTITY",
		4 => "DELETE",
		5 => "DELAY",
		6 => "DISCOUNT",
	),
	"AJAX_MODE" => "Y",
	"AJAX_OPTION_JUMP" => "Y",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "Y",
	"PATH_TO_ORDER" => "/order/",
	"HIDE_COUPON" => "N",
	"QUANTITY_FLOAT" => "N",
	"PRICE_VAT_SHOW_VALUE" => "Y",
	"USE_PREPAYMENT" => "N",
	"SET_TITLE" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>