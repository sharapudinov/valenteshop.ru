<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="history_wr">
	<?foreach( $arResult["ITEMS"] as $arItem ){
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="item_data_wr" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="left_data">
				<span class="date_big"><?=$arItem["NAME"]?></span>
			</div>
			<div class="right_data">
				<?=$arItem["PREVIEW_TEXT"]?>
				<?=$arItem["DETAIL_TEXT"]?>
			</div>
			<div style="clear:both;"></div>
		</div>
	<?}?>
</div>
<?=$arResult["NAV_STRING"]?>
