<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?><div class="inside_page_content inside_page_content_ajax">
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order", 
	".default", 
	array(
		"PROP_1" => array(
			0 => "5",
		),
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/personal/order/",
		"ORDERS_PER_PAGE" => "10",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PATH_TO_BASKET" => "/basket/",
		"SET_TITLE" => "N",
		"SAVE_IN_SESSION" => "N",
		"NAV_TEMPLATE" => "shop",
		"PROP_3" => array(
		),
		"PROP_4" => array(
		),
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"CUSTOM_SELECT_PROPS" => array(
		),
		"HISTORIC_STATUSES" => array(
			0 => "F",
		),
		"STATUS_COLOR_N" => "green",
		"STATUS_COLOR_S" => "gray",
		"STATUS_COLOR_G" => "gray",
		"STATUS_COLOR_Q" => "gray",
		"STATUS_COLOR_P" => "yellow",
		"STATUS_COLOR_F" => "gray",
		"STATUS_COLOR_Y" => "gray",
		"STATUS_COLOR_O" => "gray",
		"STATUS_COLOR_Z" => "gray",
		"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
		"SEF_URL_TEMPLATES" => array(
			"list" => "index.php",
			"detail" => "order_detail.php?ID=#ID#",
			"cancel" => "order_cancel.php?ID=#ID#",
		),
		"VARIABLE_ALIASES" => array(
			"detail" => array(
				"ID" => "ID",
			),
			"cancel" => array(
				"ID" => "ID",
			),
		)
	),
	false
);?>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>