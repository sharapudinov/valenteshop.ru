<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?><div class="inside_page_content">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"shop",
	Array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"SET_TITLE" => "N",
		"USER_PROPERTY" => array(),
		"SEND_INFO" => "N",
		"CHECK_RIGHTS" => "N",
		"USER_PROPERTY_NAME" => "",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>