<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach( $arResult["ITEMS"] as $arItem ){
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="item_video" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="name"><?=$arItem["NAME"]?></a>
		<div class="video"><?=$arItem["DISPLAY_PROPERTIES"]["VIDEO"]["~VALUE"];?></div>
		<div class="text"><?=$arItem["PREVIEW_TEXT"]?></div>
	</div>
<?}?>
<?=$arResult["NAV_STRING"]?>