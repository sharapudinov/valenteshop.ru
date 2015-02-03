<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="news">
	<?$i = 1;
	foreach( $arResult["ITEMS"] as $key => $arItem ){
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<?if( is_array($arItem["PREVIEW_PICTURE"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb_news">
					<?$img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array( "width" => 115, "height" => 1500 ), BX_RESIZE_IMAGE_PROPORTIONAL );?>
					<img border="0" src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
				</a>
			<?elseif( is_array($arItem["DETAIL_PICTURE"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb_news">
					<?$img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array( "width" => 115, "height" => 1500 ), BX_RESIZE_IMAGE_PROPORTIONAL );?>
					<img border="0" src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
				</a>
			<?endif;?>
			<div class="block_text<?if(!is_array($arItem["DETAIL_PICTURE"])&&!is_array($arItem["PREVIEW_PICTURE"])):?> no-img<?endif;?>">
				<div class="date_news"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
				<a class="item_link" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
			</div>
		</div>
		<?if( $i % 2 == 0 && $i != 1 ){?>
			<div class="long_separator"></div>
		<?}
		$i++;?>
	<?}?>
</div>
<?=$arResult["NAV_STRING"]?>