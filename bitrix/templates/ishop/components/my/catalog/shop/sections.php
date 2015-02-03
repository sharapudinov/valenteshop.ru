<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h1 class="title"><?$APPLICATION->ShowTitle(false)?></h1>
	<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "content", Array(
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "",
		), 	false
	);?>

	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"shop",
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"]
		),
		$component
	);
	?>

