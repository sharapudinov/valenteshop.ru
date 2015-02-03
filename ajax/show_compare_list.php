<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<a class="jqmClose close" ></a>
<div class="title">В список сравнения добавлено:</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.compare.list",
	"shop",
	Array(
		"IBLOCK_TYPE" => "aspro_ishop_catalog",
		"IBLOCK_ID" => "15",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"DETAIL_URL" => "/catalog/#ELEMENT_CODE#/",
		"COMPARE_URL" => "/catalog/compare.php?action=#ACTION_CODE#",
		"NAME" => "CATALOG_COMPARE_LIST",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?>

<script>
	$('.compare_list').closest('.popup').jqmAddClose('.jqmClose');
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>