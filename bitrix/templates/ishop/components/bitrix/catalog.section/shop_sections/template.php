<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>
<?$i = $GLOBALS["iii"] - 1;?>
<?foreach( $arResult["ITEMS"] as $arItem ){
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));?>
	<div class="table_item item_ws ">		
		<div class="table_item_inner">
			<?if(strlen($arItem["PREVIEW_PICTURE"]["ID"]) > "0"){?>
				<?$img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>120, 'height'=>140), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
				<a class="home_section_img_box" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="home_section_img" width="<?=$img["width"]?>"  src='<?=$img["src"]?>' alt='<?echo $arSection["NAME"];?>' title='<?echo $arSection["NAME"];?>' /></a>
			<?}else{?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img style="border-radius: 5px;display:block;margin:0 auto;" src="/noimage170.gif" width="120" /></a>
			<?}?>
		    <div class="table_item_href"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>					
		</div>
	</div>
	<?if($i++ == 3){$i = 0;?><div style="clear: both; width: 100%; border-bottom: 1px dotted grey;"></div><?}?>
<?}?>
