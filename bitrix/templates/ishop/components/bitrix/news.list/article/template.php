<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="item_article_wrapp">
	<?foreach( $arResult["ITEMS"] as $arItem ){
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<table cellspacing="0" cellpadding="0" border="0" width="100%" class="item_article" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><tr>
			<?if( is_array( $arItem["PREVIEW_PICTURE"] ) ):?>
				<td class="left_data">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						<?$img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array( "width" => 180, "height" => 180 ), BX_RESIZE_IMAGE_PROPORTIONAL );?>
						<img border="0" src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
					</a>
				</td>
			<?elseif( is_array( $arItem["DETAIL_PICTURE"] ) ):?>
				<td class="left_data">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						<?$img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array( "width" => 180, "height" => 180 ), BX_RESIZE_IMAGE_PROPORTIONAL );?>
						<img border="0" src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
					</a>
				</td>
			<?endif;?>
			<td>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="name"><?=$arItem["NAME"]?></a>
				<?=$arItem["PREVIEW_TEXT"]?>
			</td>
		</tr></table>
	<?}?>
<?=$arResult["NAV_STRING"]?>
</div>