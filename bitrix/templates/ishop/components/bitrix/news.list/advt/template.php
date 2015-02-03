<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>
<?foreach( $arResult["ITEMS"] as $arItem ){
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<?$img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>180, 'height'=>1000), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
	<?if( is_array( $arItem["DETAIL_PICTURE"] ) ){?>
		<div style="width:180px;height:<?=$img['height']?>px" class="advt_banner" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<?if( !empty( $arItem["PROPERTIES"]["LINK"]["VALUE"] ) ){?>
				<a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>">
			<?}?>
				<span><img data-num="<?=$arItem["DETAIL_PICTURE"]["ID"]?>" class="ajax_img" border="0" src="<?=$img["src"]?>" width="180px" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></span>
			<?if( !empty( $arItem["PROPERTIES"]["LINK"]["VALUE"] ) ){?>
				</a>
			<?}?>
		</div>
	<?}?>
<?}?>