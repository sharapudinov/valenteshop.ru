<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach( $arResult["ITEMS"] as $arItem ){
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="item_stock" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if( is_array( $arItem["PREVIEW_PICTURE"] )||is_array( $arItem["DETAIL_PICTURE"] ) ):?>
			<div class="left_data">
				<?if( is_array( $arItem["PREVIEW_PICTURE"] ) ):?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						<?$img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array( "width" => 180, "height" => 180 ), BX_RESIZE_IMAGE_PROPORTIONAL );?>
						<img border="0" src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
					</a>
				<?elseif (is_array( $arItem["DETAIL_PICTURE"] )):?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						<?$img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array( "width" => 180, "height" => 180 ), BX_RESIZE_IMAGE_PROPORTIONAL );?>
						<img border="0" src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
					</a>
				<?endif;?>
			</div>
		<?endif;?>
		<div class="right_data<?if(!is_array($arItem["PREVIEW_PICTURE"])&&!is_array($arItem["DETAIL_PICTURE"])):?> no-image<?endif;?>">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="name"><?=$arItem["NAME"]?></a>
			<?if( $arItem["PROPERTIES"]["PERIOD"]["VALUE"] ){?>
				<div class="period"><?=$arItem["PROPERTIES"]["PERIOD"]["VALUE"]?></div><br/>				
			<?}?>
			<?=$arItem["PREVIEW_TEXT"]?>
		</div>
		<div style="clear: both"></div>
	</div>
	
	<div class="shadow-item_info"><img border="0" src="<?=SITE_TEMPLATE_PATH?>/img/shadow-item_info.png" alt=""></div>
	
<?}?>
<?=$arResult["NAV_STRING"]?>