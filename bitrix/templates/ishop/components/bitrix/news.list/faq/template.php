<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="faq_list">
	<?if( !empty($arResult["ITEMS"]) ){?>
		<div class="faq_name"><?=GetMessage('FAQ_TITLE')?></div>
		<?
		$i = 0;
		foreach( $arResult["ITEMS"] as $arItem ){
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="item_faq <?=$i == 0 ? 'show' : ''?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a href="#" class="name"><span><?=$arItem["NAME"]?></span></a>
				<div class="text"><?=$arItem["DETAIL_TEXT"]?></div>
			</div>
			<?$i++;?>
		<?}?>
		<?=$arResult["NAV_STRING"]?>
	<?}?>
</div>