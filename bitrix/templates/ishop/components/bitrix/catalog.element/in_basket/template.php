<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
	<table><tr>
	<?if (is_array($arResult["PREVIEW_PICTURE"])):?>
		<td class="image">
			<?if (is_array($arResult["PREVIEW_PICTURE"])):?>
				<img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" height="<?$arResult["PREVIEW_PICTURE"]["HEIGHT"];?>" width="<?$arResult["PREVIEW_PICTURE"]["WIDTH"];?>" title="<?=$arResult["NAME"];?>" alt="<?=$arResult["NAME"];?>" />
			<?endif;?>
		</td>
	<?endif;?>
	<td>
	<div class="product_description">
		<a href="<?=$arResult["DETAIL_PAGE_URL"];?>"><?=$arResult["NAME"]?></a><br />
		<?if( $arResult["CAN_BUY"] && $arResult["CATALOG_QUANTITY"] ){?>
			<div class="price_block">
				<?foreach( $arResult["PRICES"] as $key => $arPrice ){?>
					<?if( $arPrice["CAN_ACCESS"] ){?>
						<div class="price">
							<?if( $arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"] ){?>
								<span class="new"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
								<span class="old"><?=$arPrice["PRINT_VALUE"]?></span>
							<?}else{?>
								<span><?=$arPrice["PRINT_VALUE"]?></span>
							<?}?>
						</div>
					<?}?>
				<?}?>
			</div>
		<?}elseif( !empty( $arResult["OFFERS"] ) ){?>
			<div class="price_block">
				<?foreach( $arResult["PRICES"] as $key => $arPrice ){?>
					<?if( $arPrice["CAN_ACCESS"] ){?>
						<div class="price">
							<?if( $arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"] ){?>
								<span class="new"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
								<span class="old"><?=$arPrice["PRINT_VALUE"]?></span>
							<?}else{?>
								<span><?=$arPrice["PRINT_VALUE"]?></span>
							<?}?>
						</div>
					<?}?>
				<?}?>
			</div>
		<?}?>
	</div>
	</td></tr></table>
<?endif;?>
