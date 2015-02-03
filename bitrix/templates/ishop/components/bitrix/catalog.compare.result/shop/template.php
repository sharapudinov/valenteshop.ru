<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?$display = array_key_exists("DIFFERENT", $_REQUEST) ? 'all' : 'differences' ;?>
						
<!--noindex-->
	<div class="sort_to_compare">
		<a rel="nofollow" href="/catalog/compare.php?action=COMPARE&IBLOCK_ID=<?=$arParams["IBLOCK_ID"]?>" class="<?=$_REQUEST["DIFFERENT"] == '' ? 'button4' : 'button2';?>"><span><?=GetMessage('CATALOG_ALL_CHARACTERISTICS')?></span></a>
		<a rel="nofollow" href="/catalog/compare.php?action=COMPARE&IBLOCK_ID=<?=$arParams["IBLOCK_ID"]?>&DIFFERENT=Y" class="<?=$_REQUEST["DIFFERENT"] != '' ? 'button4' : 'button2';?>"><span><?=GetMessage('CATALOG_ONLY_DIFFERENT')?></span></a>
	</div>
<!--/noindex-->

<div class="differences_table">
<?if( count( $arResult["ITEMS"] ) > 4 ):?>
	<input type="hidden" name="start_position" value="<?=$arResult["START_POSITION"]?>" />
	<input type="hidden" name="end_position" value="<?=$arResult["END_POSITION"]?>" />
	<div class="left_arrow dec"></div>
	<div class="right_arrow inc"></div>
<?endif;?>
<table>
	<tr>
		<td class="preview"></td>
		<?$position = 0;?>
		<?foreach( $arResult["ITEMS"] as $arItem ){
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCT_ELEMENT_DELETE_CONFIRM')));
			?>
			
			<td class="item_td item_<?=$arItem["ID"]?>" <?=$position >= 4 ? 'style="display: none;"' : ''?>>
				<div class="table_item item_ws">
					<div class="remove_item">
						<!--noindex-->
							<a rel="nofollow"  class="delete"  onclick="return true;" href="<?=htmlspecialcharsbx($APPLICATION->GetCurPageParam("action=DELETE_FROM_COMPARE_RESULT&IBLOCK_ID=".$arParams['IBLOCK_ID']."&ID[]=".$arItem['ID'],array("action", "IBLOCK_ID", "ID")))?>"></a>
						<!--/noindex-->
					</div>
					<div class="image">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb_cat">
							<?if( !empty($arItem["PREVIEW_PICTURE"]) ){?>
								<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
							<?}else{?>
								<img src="<?=SITE_TEMPLATE_PATH?>/images/noimage170.gif" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
							<?}?>
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

					<?if( !empty($arItem["OFFERS"]) ){?>
					
						<?
						$count_offers = 0;
						$min_offer_id = -1;
						$min_price = 0;
						
						foreach( $arItem["OFFERS"] as $key_offer => $arOffer ){
							foreach( $arOffer["PRICES"] as $key_price => $arPrice ){
								if( $arPrice["CAN_ACCESS"] == 'Y' && $arPrice["CAN_BUY"] == 'Y' ){
								
									if( $min_offer_id == -1 ){
										$min_offer_id = $key_offer;
										$min_price = $arPrice["PRICE"];
									}elseif( $arPrice["PRICE"] < $min_price ){
										$min_offer_id = $key_offer;
										$min_price = $arPrice["PRICE"];
									}
								}
							}
							$count_offers++;
						}?>
					
						<div class="price_block" style="text-align: center;">
							<?foreach( $arItem["OFFERS"][$min_offer_id]["PRICES"] as $key => $arPrice ){?>
								<div class="price">
									<?$prefix = count( $arItem["OFFERS"] ) > 1 ? GetMessage("CATALOG_FROM").'&nbsp;' : '';?>
									<span><?=$prefix?><?=FormatCurrency($arPrice["PRICE"], $arPrice["CURRENCY"])?></span>
								</div>
							<?}?>
						</div>
					<?}else{?>
						<div class="price">
							<?$numPrices = count($arParams["PRICE_CODE"]);
							foreach($arItem["PRICES"] as $code=>$arPrice):?>
							<?if($arPrice["CAN_ACCESS"]):?>
								<?if ($numPrices>1):?><p style="padding-bottom: 0; margin-bottom: 5px;"><?=$arResult["PRICES"][$code]["TITLE"];?>:</p><?endif?>
								<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
									<div class="old-price">
										<span><?=$arPrice["PRINT_VALUE"]?></span>
									</div>
									<div class="discount-price">
										<span><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
									</div>
								<?else:?>
									<span><?=$arPrice["PRINT_VALUE"]?></span>
								<?endif;?>
							<?endif;?>
						<?endforeach;?>	
						</div>
					<?}?>
				</div>
			</td>
			<?$position++;?>
		<?}?>
	</tr>
	
	<?$prop_count = 1;?>
	<?foreach( $arResult["DISPLAY_PROPERTIES"] as $key => $arProp ){
		$arCompare = array();
		foreach($arProp["ITEMS"] as $arElement){
			$arPropertyValue = $arElement["VALUE"];
			if(is_array($arPropertyValue))
			{
				sort($arPropertyValue);
				$arPropertyValue = implode(" / ", $arPropertyValue);
			}
			$arCompare[] = $arPropertyValue;
		}
		$diff = (count(array_unique($arCompare)) > 1 ? true : false);
		if($diff || empty($_REQUEST["DIFFERENT"]) ){?>
			<tr class="hovered prop_<?=$prop_count?>">
				<td class="prop_name"><?=$arProp["NAME"]?></td>
				<?$position = 0;?>
				<?foreach( $arProp["ITEMS"] as $key => $arItem ){?>
					<td class="prop_item item_<?=$key?>" <?=$position >= 4 ? 'style="display: none;"' : ''?>>
						<?=$arItem["VALUE"]?>
					</td>
					<?$position++;?>
				<?}?>
			</tr>
		<?}?>
		<?$prop_count++?>
	<?}?>
</table>
</div>
