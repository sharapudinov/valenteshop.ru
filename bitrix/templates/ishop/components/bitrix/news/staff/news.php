<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if( CModule::IncludeModule("iblock") ){
	$rsStaff = CIBlockSection::GetList(array("SORT" => "ASC", "ID" => "DESC"), array( "IBLOCK_ID" => $arParams["IBLOCK_ID"] ), true);
	$arStaff = $rsStaff->GetNext();
	LocalRedirect($arStaff["SECTION_PAGE_URL"]);
}?>