<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if( CModule::IncludeModule("iblock") )
{
	$arSort= array();
	if ($arParams["SORT_BY1"]&&$arParams["SORT_ORDER1"]) { $arSort[$arParams["SORT_BY1"]] = $arParams["SORT_ORDER1"]; }
	if ($arParams["SORT_BY2"]&&$arParams["SORT_ORDER2"]) { $arSort[$arParams["SORT_BY2"]] = $arParams["SORT_ORDER2"]; }
	$rsStore = CIBlockElement::GetList( $arSort, array("IBLOCK_ID" => $arParams["IBLOCK_ID"]));
	$rsStore->SetUrlTemplates($arParams["SEF_FOLDER"].$arParams["SEF_URL_TEMPLATES"]["detail"]);
	$arStore = $rsStore->GetNext();
	LocalRedirect($arStore["DETAIL_PAGE_URL"]);
}?>