<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div style="clear:both"></div>
<div class="display_table">
	<?$i = 1;?>
	<?foreach( $arResult["ITEMS"] as $arItem ){?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	?>
		<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="table_item item_ws <?if( $i % $arParams["LINE_ELEMENT_COUNT"] == 0 ):?>last-in-line<?endif;?>">
			<div class="table_item_inner">
				<div class="image">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb_cat">
						<?if( !empty($arItem["PREVIEW_PICTURE"]) ):?>
							<img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						<?else:?>
							<img border="0" src="<?=SITE_TEMPLATE_PATH?>/img/noimage170.gif" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						<?endif;?>
					</a>
					<div class="marks">
						<?if( $arItem["PROPERTIES"]["STOCK"]["VALUE"] == true ){?>
							<span class="mark share"></span>
						<?}?>
						<?if( $arItem["PROPERTIES"]["HIT"]["VALUE"] == true ){?>
							<span class="mark hit"></span>
						<?}?>
						<?if( $arItem["PROPERTIES"]["RECOMMEND"]["VALUE"] == true ){?>
							<span class="mark like"></span>
						<?}?>
						<?if( $arItem["PROPERTIES"]["NEW"]["VALUE"] == true ){?>
							<span class="mark new"></span>
						<?}?>
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
								<?$prefix = count( $arItem["OFFERS"] ) > 1 ? GetMessage("CATALOG_TOP_FROM").'&nbsp;' : '';?>
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