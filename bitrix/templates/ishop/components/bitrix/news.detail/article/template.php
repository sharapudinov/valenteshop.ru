<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="article_detail">
	<?if ($arParams["DISPLAY_NAME"]=="Y"):?><div class="name"><?=$arResult["NAME"]?></div><?endif;?>
	<?if ($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]||$arResult["DETAIL_PICTURE"]):?>
		<div class="left_data">
			<?if($arResult["DETAIL_PICTURE"]){?>
				<?$img = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array( "width" => 180, "height" => 180 ), BX_RESIZE_IMAGE_EXACT, true, array() );?>
				<a class="fancy" rel="article_gallery" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
					<img border="0" src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
				</a>
			<?}?>
			<?if($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]):?>
				<div class="gallery">
					<?foreach( $arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $arPhoto ){
						$arPhoto = CFile::GetFileArray($arPhoto);
						$img = CFile::ResizeImageGet($arPhoto, array( "width" => 800, "height" => 600 ), BX_RESIZE_IMAGE_EXACT, true, array() );?>
						<a class="fancy" rel="article_gallery" href="<?=$img["src"]?>">
							<?$img = CFile::ResizeImageGet($arPhoto, array( "width" => 87, "height" => 87 ), BX_RESIZE_IMAGE_EXACT, true, array() );?>
							<img border="0" src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
						</a>
					<?}?>
				</div>
			<?endif;?>
		</div>
	<?endif;?>
	<div class="right_data<?if(!$arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]&&!$arResult["DETAIL_PICTURE"]):?> no-image<?endif;?>">
		<?if(($arParams["DISPLAY_DATE"]=="Y")&&($arResult["DISPLAY_ACTIVE_FROM"])):?>
			<div class="date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div>
		<?endif;?>
		<?if($arResult["DETAIL_TEXT"]):?>
			<?=$arResult["DETAIL_TEXT"];?>
		<?elseif($arResult["PREVIEW_TEXT"]&&($arParams["DISPLAY_PREVIEW_TEXT"]=="Y")):?>
			<?=$arResult["PREVIEW_TEXT"];?>
		<?endif;?>
	</div>
	<div style="clear: both;"></div>
</div>