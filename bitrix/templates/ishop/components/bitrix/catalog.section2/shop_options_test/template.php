<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if( count($arResult["ITEMS"]) <= 0 ){?>
	<div class="empty_items">
		<?$APPLICATION->IncludeFile(SITE_DIR."/include/shop_zero_items.php", Array(), Array(
			"MODE"      => "html",
			"NAME"      => GetMessage('CT_NAME_NOT_FOUND'),
			));
		?>
	</div>
<?}else{?>
	<div class="display_list">
		<?foreach( $arResult["ITEMS"] as $arItem ){
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		?>
			<div class="list_item item_ws" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="image">
					<div class="marks">
						<?if( $arItem["PROPERTIES"]["STOCK"]["VALUE"] ){?><span class="mark share"></span><?}?>
						<?if( $arItem["PROPERTIES"]["HIT"]["VALUE"] ){?><span class="mark hit"></span><?}?>
						<?if( $arItem["PROPERTIES"]["RECOMMEND"]["VALUE"] ){?><span class="mark like"></span><?}?>
						<?if( $arItem["PROPERTIES"]["NEW"]["VALUE"] ){?><span class="mark new"></span><?}?>
					</div>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb">
						<?if( !empty($arItem["PREVIEW_PICTURE"]) ){?>
							<img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						<?}else{?>
							<img border="0" src="<?=SITE_TEMPLATE_PATH?>/img/noimage170.gif" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						<?}?>
					</a>
				</div>
				<div class="description">
					<div class="desc_name">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
					</div>
					<?if ($arItem["PREVIEW_TEXT"]):?>
						<div class="preview_text"><?=$arItem["PREVIEW_TEXT"]?></div>
					<?endif;?>
					<?if ($arItem["DISPLAY_PROPERTIES"]):?>
						<div class="show_props">
							<a onclick="$(this).toggleClass('open').parents('.description').find('.props-list').toggle();"><span><?=GetMessage('PROPERTIES')?></span></a>
						</div>
						<table class="props-list">
							<?foreach( $arItem["DISPLAY_PROPERTIES"] as $arProp ){?>
								<?if( !empty( $arProp["VALUE"] ) ){?>
									<tr>
										<td><?=$arProp["NAME"]?>:</td>
										<td><?=$arProp["VALUE"]?></td>
									</tr>
								<?}?>
							<?}?>
							
						</table>
					<?endif;?>

						<?foreach($arItem["PRODUCT_PROPERTIES"] as $pid => $product_property):?>
							<tr valign="top">
								<td><?echo $arItem["PROPERTIES"][$pid]["NAME"]?>:</td>
								<td>
								<?if(
									$arItem["PROPERTIES"][$pid]["PROPERTY_TYPE"] == "L"
									&& $arItem["PROPERTIES"][$pid]["LIST_TYPE"] == "C"
								):?>
									<?foreach($product_property["VALUES"] as $k => $v):?>
										<label><input type="radio" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]" value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"checked"'?>><?echo $v?></label><br>
									<?endforeach;?>
								<?else:?>
									<select name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
										<?foreach($product_property["VALUES"] as $k => $v):?>
											<option value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"selected"'?>><?echo $v?></option>
										<?endforeach;?>
									</select>
								<?endif;?>
								</td>
							</tr>
						<?endforeach;?>

				</div>
				<div class="information">
					<div class="desc_name">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
					</div>
					
					<?if ($arParams["SHOW_QUANTITY"]!="N"){?>
						<?if( is_array($arItem["OFFERS"]) && !empty($arItem["OFFERS"])):?>
							<?if( !$arItem["OFFERS_CATALOG_QUANTITY"] ){?>
								<div class="noavailable_block">
									<?=GetMessage('CATALOG_NOT_AVAILABLE')?>
								</div>
							<?}else{?>
								<div class="available_block">
									<?=GetMessage('CT_IS_AVAILABLE')?> ( <?=$arItem["OFFERS_CATALOG_QUANTITY"];?> )
								</div>
							<?}?>
						<?else:?>
							<?if( !$arItem["CATALOG_QUANTITY"] ){?>
								<div class="noavailable_block">
									<?=GetMessage('CATALOG_NOT_AVAILABLE')?>
								</div>
							<?}else {?>
								<div class="available_block">
									<?=GetMessage('CT_IS_AVAILABLE')?> ( <?=$arItem["CATALOG_QUANTITY"]?> )
								</div>
							<?}?>
						<?endif;?>	
					<?}?>
				
					<?if( count( $arItem["OFFERS"] ) > 0 ){?>
						<div class="price_block">
							<div class="price">
								<span><?=GetMessage("CATALOG_FROM");?> <?=$arItem["MIN_PRODUCT_OFFER_PRICE_PRINT"]?></span>
							</div>
						</div>
					<?}elseif( $arItem["CAN_BUY"] ){?>
						<div class="price_block">
							<?
								$arCountPricesCanAccess = 0;
								foreach( $arItem["PRICES"] as $key => $arPrice ) { if($arPrice["CAN_ACCESS"]){$arCountPricesCanAccess++;} }
							?>
							<?foreach( $arItem["PRICES"] as $key => $arPrice ){?>
								<?if($arPrice["CAN_ACCESS"]){?>
									<?$price = CPrice::GetByID($arPrice["ID"]); ?>
									<?if($arCountPricesCanAccess>1):?><div class="price_name"><?=$price["CATALOG_GROUP_NAME"];?></div><?endif;?>
									<div class="price">
										<?$prefix = count( $arItem["OFFERS"] ) > 1 ? GetMessage("CATALOG_FROM") : '';?>
										<?if( $arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"] ){?>
											<span class="new"><?=$prefix?> <?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
											<span class="old"><?=$prefix?> <?=$arPrice["PRINT_VALUE"]?></span>
										<?}else{?>
											<span><?=$prefix?> <?=$arPrice["PRINT_VALUE"]?></span>
										<?}?>
									</div>
								<?}?>
							<?}?>
						</div>
					<?}?>
					
					<div class="button_block">
						<!--noindex-->
							<?if( $arItem["CAN_BUY"] ){?>
								<a rel="nofollow" element_id="#<?=$arItem["ID"]?>" href="<?=$arItem["ADD_URL"]?>" onclick="return addToCart(this, 'detail', '<?=GetMessage("CATALOG_IN_CART")?>', 'cart', '<?=$arParams["BASKET_URL"]?>', '<?=$arItem["ID"]?>');" class="button add_item" alt="<?=$arItem["NAME"]?>"><span><?=GetMessage('CATALOG_ADD_TO_BASKET')?></span></a>
							<?}?>
						<!--/noindex-->
					</div>
					<?if(  $arItem["CAN_BUY"] ){?>
						<div class="likes_icons">
							<!--noindex-->
								<?if (empty($arItem["OFFERS"])):?>
									<a rel="nofollow" href="#<?=$arItem["ID"]?>" class="wish_item large"></a>
								<?endif;?>
								<?if($arParams["DISPLAY_COMPARE"]){?>								
									<a rel="nofollow" element_id="#<?=$arItem["ID"]?>" href="<?=$arItem["COMPARE_URL"]?>" onclick="return addToCompare(this, 'detail', '/catalog/<?=str_replace( "#ACTION_CODE#", "DELETE_FROM_COMPARE_RESULT&ID=".$arItem["ID"], $arParams["SEF_URL_TEMPLATES"]['compare'])?>');" class="compare_item large"></a>
								<?}?>
							<!--/noindex-->
						</div>
						<div style="clear: right;"></div>
					<?}?>
				</div>
				<div class="clearboth"></div>
			</div>
		<?}?>
	</div>
	<div class="shadow-item_info"><img border="0" alt="" src="/bitrix/templates/ishop/img/shadow-item_info.png"></div>
	<?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?>
		<?=$arResult["NAV_STRING"]?>
	<?}?>
	
	<?$show = array_key_exists("show", $_REQUEST) && !empty($_REQUEST['show']) ? $_REQUEST['show'] : 20;?>
	

	<div style="clear:both"></div>
<?}?>

<div class="group_description">
	<?=$arResult["~DESCRIPTION"]?>
</div>
<?print_r($arResult)?>