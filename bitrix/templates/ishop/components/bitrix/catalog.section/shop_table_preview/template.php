<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>
<div class="display_table">
	<?$i = 1;?>
	<?foreach( $arResult["ITEMS"] as $arItem ){?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	?>
		<div class="table_item item_ws <?if( $i % $arParams["LINE_ELEMENT_COUNT"] == 0 ):?>last-in-line<?endif;?>">
			<div class="table_item_inner">
				<div class="image">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb_cat">
						<?if( !empty($arItem["PREVIEW_PICTURE"]) ):?>
							<img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=($arItem["PREVIEW_PICTURE"]["ALT"] ? $arItem["PREVIEW_PICTURE"]["ALT"] : $arItem["NAME"])?>" title="<?=($arItem["PREVIEW_PICTURE"]["TITLE"] ? $arItem["PREVIEW_PICTURE"]["TITLE"] : $arItem["NAME"])?>" />
						<?else:?>
							<img border="0" src="<?=SITE_TEMPLATE_PATH?>/img/noimage170.gif" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						<?endif;?>
					</a>
					<div class="marks">
						<?if( $arItem["PROPERTIES"]["STOCK"]["VALUE"] == true ){?><span class="mark share"></span><?}?>
						<?if( $arItem["PROPERTIES"]["HIT"]["VALUE"] == true ){?><span class="mark hit"></span><?}?>
						<?if( $arItem["PROPERTIES"]["RECOMMEND"]["VALUE"] == true ){?><span class="mark like"></span><?}?>
						<?if( $arItem["PROPERTIES"]["NEW"]["VALUE"] == true ){?><span class="mark new"></span><?}?>
					</div>
				</div>
				<a class="desc_name" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
				
				<?
				$count_offers = 0;
				$min_offer_id = -1;
				$min_price = 0;
				foreach( $arItem["OFFERS"] as $key_offer => $arOffer ){
					foreach( $arOffer["PRICES"] as $key_price => $arPrice ){
						if( $arPrice["CAN_ACCESS"] == 'Y' && $arPrice["CAN_BUY"] == 'Y' ){
							if( $min_offer_id == -1 ){
								$min_offer_id = $key_offer;
								$min_price = $arPrice["VALUE"];
							}elseif( $arPrice["VALUE"] < $min_price ){
								$min_offer_id = $key_offer;
								$min_price = $arPrice["VALUE"];
							}
						}
					}
					$count_offers++;
				}?>
				<?if( !empty($arItem["PRICES"]) ){?>
					<div class="price_block">
						<?foreach( $arItem["PRICES"] as $arPrice ){?>
							<div class="price">
								<?if( $arPrice["VALUE"] != $arPrice["DISCOUNT_VALUE"] ){?>
									<span class="new"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
									<span class="old"><?=$arPrice["PRINT_VALUE"]?></span>
								<?}else{?>
									<span><?=$arPrice["PRINT_VALUE"]?></span>
								<?}?>
							</div>
						<? }?>
					</div>
				<?}elseif( !empty($arItem["OFFERS"]) ){?>
					<div class="price_block">
						<?foreach( $arItem["OFFERS"][$min_offer_id]["PRICES"] as $key => $arPrice ){?>
							<div class="price">
								<?$prefix = count( $arItem["OFFERS"] ) > 1 ? GetMessage("CATALOG_FROM").'&nbsp;' : '';?>
								<?if( count($arItem["OFFERS"][$min_offer_id]["PRICES"]) > 1 ){?>
									<?=$key?>
								<?}?>
								<?if( $arPrice["VALUE"] != $arPrice["DISCOUNT_VALUE"] ){?>
									<span class="new"><?=$prefix?><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
									<span class="old"><?=$prefix?><?=$arPrice["PRINT_VALUE"]?></span>
								<?}else{?>
									<span><?=$prefix?><?=$arPrice["PRINT_VALUE"]?></span>
								<?}?>
							</div>
						<?}?>
					</div>
				<?}?>
				<div class="button_block">
					<!--noindex-->
						<?if( $arItem["CAN_BUY"] ){?>
							<a rel="nofollow" element_id="#<?=$arItem["ID"]?>" href="<?=$arItem["ADD_URL"]?>" onclick="return addToCart(this, 'detail', '<?=GetMessage("CATALOG_IN_CART")?>', 'cart', '<?=$arParams["BASKET_URL"]?>', <?=$arItem["ID"]?>);" class="button add_item" alt="<?=$arItem["NAME"]?>"><span><?=GetMessage('CATALOG_ADD_TO_BASKET')?></span></a>
						<?}?>
					<!--/noindex-->
				</div>
				<?if( empty($arItem["OFFERS"]) && $arItem["CAN_BUY"] ){?>
					<div class="likes_icons">
						<!--noindex-->
							<a rel="nofollow" href="#<?=$arItem["ID"]?>" class="wish_item"></a>
							<div class="tooltip-wrapp">
								<div class="tooltip wish_item_tooltip"><?=GetMessage('CATALOG_IZB')?></div>
							</div>
							<?if($arParams["DISPLAY_COMPARE"]){?>
								<a element_id="#<?=$arItem["ID"]?>" rel="nofollow" href="<?=$arItem["COMPARE_URL"]?>" onclick="return addToCompare(this, 'detail', '<?=$arItem["COMPARE_URL"]?>');" class="compare_item"></a>
								<div class="tooltip-wrapp"><div class="tooltip compare_item_tooltip"><?=GetMessage('CATALOG_COMPARE')?></div></div>
							<?}?>
						<!--/noindex-->
					</div>
					
					<div style="clear: both"></div>
				<?}?>
			</div>
		</div>
		<?if( $i % $arParams["LINE_ELEMENT_COUNT"] == 0 && $i < count($arResult["ITEMS"]) ){?>
			<div class="long_separator"></div>
		<?}?>
		<?$i++;?>
	<?}?>
</div>

<?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?>
	<?=$arResult["NAV_STRING"]?>
<?}?>