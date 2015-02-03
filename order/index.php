<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?>
<?$APPLICATION->IncludeComponent(
	"my:sale.order.ajax",
	"template1",
	Array(
		"PATH_TO_BASKET" => "/basket/",
		"PATH_TO_PERSONAL" => "/personal/",
		"PATH_TO_PAYMENT" => "payment.php",
		"PATH_TO_AUTH" => "/auth/",
		"PAY_FROM_ACCOUNT" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"COUNT_DELIVERY_TAX" => "Y",
		"ALLOW_AUTO_REGISTER" => "N",
		"SEND_NEW_USER_NOTIFY" => "Y",
		"DELIVERY_NO_AJAX" => "Y",
		"DELIVERY_NO_SESSION" => "N",
		"TEMPLATE_LOCATION" => ".default",
		"DELIVERY_TO_PAYSYSTEM" => "p2d",
		"SET_TITLE" => "Y",
		"USE_PREPAYMENT" => "N",
		"DISABLE_BASKET_REDIRECT" => "N",
		"PRODUCT_COLUMNS" => array(),
		"PROP_3" => array(),
		"PROP_4" => array()
	)
);?> 
<div> <br />
	<p class="soglashenie">Нажимая на кнопку &quot;Оформить заказ&quot; вы принимаете <a href="/soglashenie.docx" >пользовательское соглашение</a>.</p>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>