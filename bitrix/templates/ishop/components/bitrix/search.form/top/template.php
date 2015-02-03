<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form action="<?=$arResult["FORM_ACTION"]?>" class="search">
	<input id="title-search-input" class="search_field1" type="text" name="q" placeholder="<?=GetMessage("placeholder")?>" autocomplete="off" />
	<button id="search-submit-button" type="submit" class="submit"><i></i></button>
	<?if ($arParams["USE_SEARCH_TITLE"]=="Y"):?>
		<div id="title-search"></div>
		<?$APPLICATION->IncludeComponent("bitrix:search.title", "catalog", array(
			"NUM_CATEGORIES" => "1",
			"TOP_COUNT" => "5",
			"ORDER" => "date",
			"USE_LANGUAGE_GUESS" => "Y",
			"CHECK_DATES" => "Y",
			"SHOW_OTHERS" => "N",
			"PAGE" => $arParams["PAGE"],
			"CATEGORY_0_TITLE" => GetMessage("CATEGORY_PRODUÑTCS_SEARCH_NAME"),
			"CATEGORY_0" => array(0 => "iblock_aspro_ishop_catalog",),
			"CATEGORY_0_iblock_aspro_ishop_catalog" => array(0 => "all",),
			"SHOW_INPUT" => "N",
			"INPUT_ID" => "title-search-input",
			"CONTAINER_ID" => "title-search",
			"PRICE_CODE" => array(0 => "BASE",	),
			"PRICE_VAT_INCLUDE" => "Y",
			"SHOW_ANOUNCE" => "N",
			"PREVIEW_TRUNCATE_LEN" => "50",
			"SHOW_PREVIEW" => "Y",
			"PREVIEW_WIDTH" => "50",
			"PREVIEW_HEIGHT" => "50",
			"CONVERT_CURRENCY" => "N"
			),	false,			
			array("ACTIVE_COMPONENT" => "Y")
		);?>
	<?endif;?>
</form>