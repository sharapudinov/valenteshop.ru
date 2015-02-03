<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<script type="text/javascript">		
	jQuery(document).ready(function(){

	var params = {
			changedEl: ".lineForm select",
			visRows: 5,
			scrollArrows: true
		}
		cuSel(params);
});
	</script>
<?/*print_r($arResult);*/?>
<div class="shadow-item_info"><img border="0" alt="" src="<?=SITE_TEMPLATE_PATH?>/img/shadow-item_info.png"></div>
<div class="container left shop">
<div class="inner_left">

<style>
.slides li{border-radius: 10px !important;}
</style>

<div class="item_info">
	<div class="item_slider">
		<ul class="slides">
			<?$images = array();
			if( is_array( $arResult["DETAIL_PICTURE"] ) ){
				$images[] = $arResult["DETAIL_PICTURE"];
			}
			foreach( $arResult["MORE_PHOTO"] as $arPhoto ){
				$images[] = $arPhoto;
			}?>
			<?foreach( $images as $key => $arPhoto ){?>
				<li id="photo-<?=$key?>" <?=$key == 0 ? 'class="current"' : ''?>>
					<?$img = CFile::ResizeImageGet( $arPhoto, array( "width" => 800, "height" => 600 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
					<a href="<?=$img["src"]?>" rel="item_slider" class="fancy">
						<span class="lupa" style="display: none;" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>"></span>
						<div class="marks">
							<?if( $arResult["PROPERTIES"]["STOCK"]["VALUE"] ){?>
								<span class="mark share"></span>
							<?}?>
							<?if( $arResult["PROPERTIES"]["HIT"]["VALUE"] ){?>
								<span class="mark hit"></span>
							<?}?>
							<?if( $arResult["PROPERTIES"]["RECOMMEND"]["VALUE"] ){?>
								<span class="mark like"></span>
							<?}?>
							<?if( $arResult["PROPERTIES"]["NEW"]["VALUE"] ){?>
								<span class="mark new"></span>
							<?}?>
						</div>
						<?$img = CFile::ResizeImageGet( $arPhoto, array( "width" => 280, "height" => 280 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
						<img border="0" src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
					</a>
				</li>
			<?}?>
			<?if( count($images) == 0 ){?>
				<li class="current">
					<div class="marks">
						<?if( $arResult["PROPERTIES"]["STOCK"]["VALUE"] ){?>
							<span class="mark share"></span>
						<?}?>
						<?if( $arResult["PROPERTIES"]["HIT"]["VALUE"] ){?>
							<span class="mark hit"></span>
						<?}?>
						<?if( $arResult["PROPERTIES"]["RECOMMEND"]["VALUE"] ){?>
							<span class="mark like"></span>
						<?}?>
						<?if( $arResult["PROPERTIES"]["NEW"]["VALUE"] ){?>
							<span class="mark new"></span>
						<?}?>
					</div>
					<img border="0" src="<?=SITE_TEMPLATE_PATH?>/img/noimagebig.gif" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
				</li>
			<?}?>
		</ul>
		<?if( count($images) > 1 ){?>
			<div class="thumbs">
				<ul id="thumbs">
					<?foreach( $images as $key => $arPhoto ){?>
						<?$img = CFile::ResizeImageGet( $arPhoto, array( "width" => 80, "height" => 80 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
						<li <?=$key == 0 ? 'class="current"' : ''?>>
							<a href="#photo-<?=$key?>">
								<img border="0" src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
							</a>
						</li>
					<?}?>
				</ul>
			</div>
		<?}?>
	</div>
	<div class="right_info">
		<div class="info_block">

<?$rsStock = CIBlockElement::GetList(array(), array("ACTIVE" => "Y", "IBLOCK_ID" => $arParams["IBLOCK_STOCK_ID"], "PROPERTY_LINK" => $arResult["ID"]));

		$rsStock->SetUrlTemplates($arParams["SEF_MODE_STOCK_SECTIONS"].$arParams["SEF_MODE_STOCK_ELEMENT"]);
		while( $arStock = $rsStock->GetNext() ){?>
			<a href="/sale/skidki/"><img src="/bitrix/images/knopka.png" /></a>
		<?}?>


			<?if( !empty($arResult["PROPERTIES"]["BRAND"]["VALUE"]) ){?>
				<div class="brand">
					<?$rsBrand = CIBlockElement::GetList( array(), array("IBLOCK_ID" => $arResult["PROPERTIES"]["BRAND"]["LINK_IBLOCK_ID"], "ID" => $arResult["PROPERTIES"]["BRAND"]["VALUE"] ));
					$rsBrand->SetUrlTemplates($arParams["SEF_MODE_BRAND_SECTIONS"].$arParams["SEF_MODE_BRAND_ELEMENT"]);
					$arBrand = $rsBrand->GetNext();?>
					<b><?=GetMessage("BRAND");?>:</b> <a href="<?=$arBrand["DETAIL_PAGE_URL"]?>"><?=$arBrand["NAME"]?></a>
				</div>
			<?}?>
			
			<div class="compare" id="compare">
				<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.compare.list",
					"preview",
					Array(
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
						"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
						"NAME" => "CATALOG_COMPARE_LIST",
						"AJAX_OPTION_ADDITIONAL" => ""
					)
				);?>
			</div>
			
		
			
			<?if($arResult["CAN_BUY"] && $arResult["CATALOG_QUANTITY"] ){?>
					<div class="likes_icons">
						<!--noindex-->
							<?if (empty($arResult["OFFERS"])):?>
								<a rel="nofollow" href="#<?=$arResult["ID"]?>" class="wish_item"></a>
								<div class="tooltip wish_item_tooltip">
									<?=GetMessage('CT_BCE_CATALOG_IZB')?>
								</div>
							<?endif;?>
							<?if( $arParams["USE_COMPARE"] == "Y" ){?>
								<a rel="nofollow" element_id="#<?=$arResult["ID"]?>" href="<?=$arResult["COMPARE_URL"]?>" onclick="return addToCompare(this, 'detail', '/catalog/<?=str_replace( "#ACTION_CODE#", "DELETE_FROM_COMPARE_RESULT&ID=".$arResult["ID"], $arParams["SEF_URL_TEMPLATES"]['compare'])?>');" class="compare_item"></a>
								<div class="tooltip compare_item_tooltip">
									<?=GetMessage('CT_BCE_CATALOG_COMPARE')?>
								</div>
							<?}?>
						<!--/noindex-->
					</div>
			<?}?>
			<div style="clear: right;"></div>
		</div>
		<div class="information item_ws">
		
		
			<?if ($arResult["CAN_BUY"] || !empty( $arResult["OFFERS"]) || !empty( $arResult["PRICES"])){?>
<form id="my_form_<?=$arResult['ID']?>" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
				<div class="middle_info">
<div id="div_priceblock" >
					<table id="table_sku_<?=$arResult['ID']?>" class="block_price_add table_sku_default" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td>
					
						<?if( !empty( $arResult["PRICES"] )){?>
							<?
								$arCountPricesCanAccess = 0;
								foreach( $arResult["PRICES"] as $key => $arPrice ) { if($arPrice["CAN_ACCESS"]){$arCountPricesCanAccess++;} }
							?>
							<div class="price_block<?if(!$arResult["CAN_BUY"]):?> bottom20<?endif;?>">
								<?foreach( $arResult["PRICES"] as $key => $arPrice ){?>
									<?if( $arPrice["CAN_ACCESS"] ){?>
										<?$price = CPrice::GetByID($arPrice["ID"]); ?>
										<?if($arCountPricesCanAccess>1):?><div class="price_name"><?=$price["CATALOG_GROUP_NAME"];?></div><?endif;?>
										<div class="price">
											<?if( $arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"] ){?>
												<span class="new"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
												<span class="old"><?=$arPrice["PRINT_VALUE"]?></span>
											<?}else{?><span><?=$arPrice["PRINT_VALUE"]?></span><?}?>
										</div>
									<?}?>
								<?}?>
							</div>
						<?}elseif( !empty( $arResult["OFFERS"] ) ){?>
							<div class="price_block bottom20"><div class="price"><span><?=GetMessage("CATALOG_FROM");?> <?=$arResult["MIN_PRODUCT_OFFER_PRICE_PRINT"]?></span></div></div>
						<?}?>

						<nobr>
							<?if ($arParams["USE_PRODUCT_QUANTITY"]=="Y"):?>
								<div class="counter_block">
									<input type="text" class="text" name="<?echo $arParams['PRODUCT_QUANTITY_VARIABLE']?>" value="1" />
									<span class="plus">+</span>
									<span class="minus">-</span>
								</div>
							<?endif;?>
							<!--noindex-->
							<?if( $arResult["CAN_BUY"] ){?>
								<a rel="nofollow" element_id="#<?=$arResult["ID"];?>" href="<?=$arResult["ADD_URL"]?>" onclick="return addToCart_my2(this, 'detail', '<?=GetMessage("CATALOG_IN_CART")?>', 'cart', '<?=$arParams["BASKET_URL"]?>', '<?=$arResult["ID"]?>');" class="button add_item" alt="<?=$arResult["NAME"]?>">
									<span><?=GetMessage('CATALOG_ADD_TO_BASKET')?></span>
								</a>
								</td>
								<td class="shadow"><i class="shadow_right"></i></td>
								<td class="one-click">
								<a id="one_click_buy_open" class="one_click_buy button" onclick="return oneClickBuy('<?=$arResult["ID"];?>');">
									<span><?=GetMessage('ONE_CLICK_BUY')?></span>
								</a>
							<?}?>
							<!--/noindex-->	
						</nobr>

					</td></tr></table>


<? foreach ($arResult["SKU_ELEMENTS"] as $key => $arSKU){?>
<table id="table_sku_<?=$arSKU['ID'];?>" class="block_price_add" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td>
					
						<?if( !empty($arSKU["PRICE"] )){?>
							<div class="price_block<?if(!$arSKU["CAN_BUY"]):?> bottom20<?endif;?>">
										<div class="price">
											<?if(!empty($arSKU["DISCOUNT_PRICE"])){?>
												<span class="new"><?=$arSKU["DISCOUNT_PRICE"]?></span>
												<span class="old"><?=$arSKU["PRICE"] ?></span>
											<?}else{?><span><?=$arSKU["PRICE"] ?></span><?}?>
										</div>
							</div>
						<?}else{?>
							<div class="price_block bottom20"><div class="price"><span><?=GetMessage("CATALOG_FROM");?> <?=$arSKU["MIN_PRODUCT_OFFER_PRICE_PRINT"]?></span></div></div>
						<?}?>

						<nobr>
							<?if ($arParams["USE_PRODUCT_QUANTITY"]=="Y"):?>
								<div class="counter_block">
									<input type="text" class="text" name="<?echo $arParams['PRODUCT_QUANTITY_VARIABLE']?>" value="1" />
									<span class="plus">+</span>
									<span class="minus">-</span>
								</div>
							<?endif;?>
							<!--noindex-->
							<?if( $arSKU["CAN_BUY"] ){?>
								<a rel="nofollow" element_id="#<?=$arSKU["ID"];?>" href="<?=$arSKU["ADD_URL"]?>" onclick="return addToCart_my2(this, 'detail', '<?=GetMessage("CATALOG_IN_CART")?>', 'cart', '<?=$arParams["BASKET_URL"]?>', '<?=$arResult["ID"]?>','<?=$arSKU["ID"]?>');" class="button add_item" alt="<?=$arSKU["NAME"]?>">
									<span><?=GetMessage('CATALOG_ADD_TO_BASKET')?></span>
								</a>
								</td>
								<td class="shadow"><i class="shadow_right"></i></td>
								<td class="one-click">
								<a id="one_click_buy_open" class="one_click_buy button" onclick="return oneClickBuy('<?=$arSKU["ID"];?>');">
									<span><?=GetMessage('ONE_CLICK_BUY')?></span>
								</a>
							<?}?>
							<!--/noindex-->	
						</nobr>

					</td></tr></table>	

<?}?>

</div>




<?
$proper = array(); $prop = array();

if(!empty($arResult["PROPERTIES"]["PROP"]["VALUE"])){
	$proper = $arResult["PROPERTIES"]["PROP"]["VALUE"];
}else{
	$proper = "";
	 $arFilter = Array('IBLOCK_ID' => $arResult['IBLOCK_ID'] ,'ID' => $arResult['IBLOCK_SECTION_ID']);
	 $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true, Array("UF_PROP"));
	 if($ar_result = $db_list->GetNext()){
		foreach($ar_result['UF_PROP'] as $PROP){
			$rsEnum = CUserFieldEnum::GetList(array(), array("ID" =>$PROP)); 
			$arEnum = $rsEnum->GetNext(); 
			$proper[] =  $arEnum["VALUE"]; 
		}
	 }
	if(empty($proper)){	
		$nav = CIBlockSection::GetNavChain(false,  $arResult['IBLOCK_SECTION_ID']);
		while ($arNav=$nav->GetNext()):

			 $arFilter = Array('IBLOCK_ID' => $arResult['IBLOCK_ID'] ,'ID' => $arNav['ID']);
			 $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true, Array("UF_PROP"));
			 if($ar_result = $db_list->GetNext()){
				if(!empty($ar_result['UF_PROP'])){
					foreach($ar_result['UF_PROP'] as $PROP){
						$rsEnum = CUserFieldEnum::GetList(array(), array("ID" =>$PROP)); 
						$arEnum = $rsEnum->GetNext(); 
						$proper[] =  $arEnum["VALUE"]; 
					}
				}
			 }
		endwhile;
	}
}

?>
<?
$IBLOCK_ID = $arResult['IBLOCK_ID'];
$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$IBLOCK_ID));
while ($prop_fields = $properties->GetNext())
{
	if(in_array($prop_fields["CODE"], $proper)){
  		$prop[$prop_fields["CODE"]] = $prop_fields;
	}
}
?>
<table class="table_width_element" border="0" cellspacing="0" cellpadding="0">
<?$arResult["PRODUCT_PROPERTIES"] = $prop;?>

<tr><td>
			<?if(count($arResult["PRODUCT_PROPERTIES"] )):?>
						<table class="table_left_element" border="0" cellspacing="0" cellpadding="0">
						<?foreach($arResult["PRODUCT_PROPERTIES"] as $pid => $product_property):?>
							<?$pro_es = 0;
							if(empty($arResult['PROPERTIES'][$pid]['VALUE'])){?>
									<?$db_enum_list = CIBlockProperty::GetPropertyEnum($pid, Array("SORT"=>"asc"), Array("IBLOCK_ID"=>$arResult['IBLOCK_ID']));
									if($ar_enum_list = $db_enum_list->GetNext())
									{
										$pro_es = 1;
									}?>
							<?}else{$pro_es = 1;}?>
							<?if(!empty($product_property) && $pro_es > 0){?>
							<input type="hidden" name="propname[<?=$pid?>]" value="<?echo $product_property['NAME']?>" />
							<tr valign="top">
								<td><?echo $product_property["NAME"]?>:</td>
								<td>
								<?if($arResult["PROPERTIES"][$pid]["PROPERTY_TYPE"] == "L" && $arResult["PROPERTIES"][$pid]["LIST_TYPE"] == "C"):?>
									<?foreach($product_property["VALUES"] as $k => $v):?>
										<label><input type="radio" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]" value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"checked"'?>><?echo $v?></label><br>
									<?endforeach;?>
								<?else:?>
								<? if($pid == "COLORS"){?>
								<div class="lineForm">
									<?if(!empty($arResult['PROPERTIES'][$pid]['VALUE'])){?>
										<select class="sel80" id="COLORS_<?=$arResult['ID']?>" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
											<?foreach($arResult['PROPERTIES'][$pid]['VALUE'] as $pr_key => $pr_val){?>
												<?if($pr_val == "Не выбран"){?>
													<option style="position:relative;" value="Выбор">Выбор</option>
												<?}else{?> 
													<option addTags="<div style='background:<?echo $arResult['PROPERTIES'][$pid]['VALUE_XML_ID'][$pr_key];?>;' class='img_select'></div>" style="position:relative;" value="<?echo $pr_val?>" 		<?if($arResult['PROPERTIES'][$pid]['PROPERTY_VALUE_ID'][$pr_key] == $product_property["SELECTED"]) echo '"selected"'?>><?echo $pr_val?></option>
												<?}?>
											<?}?>
										</select>
									<?}else{
										$prop_i = 0;
										$db_enum_list = CIBlockProperty::GetPropertyEnum("COLORS", Array("SORT"=>"asc"), Array("IBLOCK_ID"=>$arResult['IBLOCK_ID']));
										while($ar_enum_list = $db_enum_list->GetNext())
										{?>
											<?if($prop_i++ == 0){?>
												<select class="sel80" id="COLORS_<?=$arResult['ID']?>" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
											<?}?>
											<?if($ar_enum_list['VALUE'] == "Не выбран"){?>
												<option style="position:relative;" value="Выбор" <?if($ar_enum_list['ID'] == $product_property["SELECTED"]) echo '"selected"'?>>Выбор</option>
											<?}else{?> 
												<option addTags="<div style='background:<?echo $ar_enum_list[XML_ID];?>;' class='img_select'></div>" style="position:relative;" value="<?echo $ar_enum_list['VALUE']?>" 		<?if($ar_enum_list['ID'] == $product_property["SELECTED"]) echo '"selected"'?>><?echo $ar_enum_list['VALUE']?></option>
											<?}?>							
										<?}?>
										<?if($prop_i > 0){?>
											</select>
										<?}?>
									<?}?>
								</div>
								<?}else{?>
								<div class="lineForm">
								<?if(!empty($arResult['PROPERTIES'][$pid]['VALUE'])){?>
									<select id="<?=$pid;?>_<?=$arResult['ID']?>" class="sel80" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
									<?foreach($arResult['PROPERTIES'][$pid]['VALUE'] as $pr_key => $pr_val){?>

										<?if($pr_val == "Не выбран"){?>
											<option value="Выбор"  >Выбор</option>
										<?}else{?> 
											<option value="<?echo $pr_val?>" ><?echo $pr_val?></option>
										<?}?>

									<?}?>
									</select>
								<?}else{?>	
									<?$prop_i = 0;?>
									<?$db_enum_list = CIBlockProperty::GetPropertyEnum($pid, Array("SORT"=>"asc"), Array("IBLOCK_ID"=>$arResult['IBLOCK_ID']));
									while($ar_enum_list = $db_enum_list->GetNext())
									{?>
										<?if($prop_i++ == 0){?>
											<select id="<?=$pid;?>_<?=$arResult['ID']?>" class="sel80" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
										<?}?>
										<?if($ar_enum_list['VALUE'] == "Не выбран"){?>
											<option value="Выбор"  >Выбор</option>
										<?}else{?> 
											<option value="<?echo $ar_enum_list['VALUE']?>" ><?echo $ar_enum_list['VALUE']?></option>
										<?}?>
									<?}?>
									<?if($prop_i > 0){?>
										</select>
									<?}?>
								<?}?>
								</div>
								<?}?>
								<?endif;?>
								</td>
							</tr>
<?}?>
						<?endforeach;?>



						
<? endif;?>
<?$numProps = count($arResult["SKU_PROPERTIES"]);?>
<?/*print_r($arResult["SKU_ELEMENTS"]);*/?>
<?if($numProps > 0){?>
<tr><td>
<div class="">В стоимость входит:</div><br />
<div id="sku_lineForm" class="lineForm">
	<select class="sel800" id="SKU_<?=$arResult['ID']?>" name="SKU">
		<option style="position:relative;" value="<?=$arResult['ID']?>">Не выбран</option>
<?/*print_r($arResult["SKU_ELEMENTS"]);*/?>
		<? foreach ($arResult["SKU_ELEMENTS"] as $key => $arSKU){?>
			<option style="position:relative;" value="<?=$arSKU['ID']?>">
			<?for( $ii = 0; $ii < $numProps; $ii++ ){?>
				<?if(!empty( $arSKU[$ii] )){echo $arSKU[$ii];}?>
			<?}?>
			</option>
		<?}?>
	</select>
<input type="hidden" name="skuname[<?=$arResult['ID']?>]" value="Не выбран" />
		<? foreach ($arResult["SKU_ELEMENTS"] as $key => $arSKU){?>
<input type="hidden" name="skuname[<?=$arSKU['ID']?>]" value="
			<?for( $ii = 0; $ii < $numProps; $ii++ ){?>
				<?if(!empty( $arSKU[$ii] )){echo $arSKU[$ii];}?>
			<?}?>
" />
		<?}?>

</td></tr>
<?}?>
</table>


</td><td class="table_width_element_right">
<table class="table_right_element">
<tr><td>



<?
if(empty($arResult['PROPERTIES']['TEXTEL']['VALUE'])){
?>

<?=$arResult['PROPERTIES']['TEXTEL']['DEFAULT_VALUE']['TEXT'];?>

<?}else{?>

<?=htmlspecialcharsBack($arResult['PROPERTIES']['TEXTEL']['VALUE']['TEXT']);?>

<?}?>

</td></tr>
</table>

</td></tr>
</table>
						<input id="price_id" type="hidden" name="price_id" value="<?=$arPrice['PRINT_VALUE']?>" />
						<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
						<input id="product_ids" type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arResult["ID"]?>">
						<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?echo GetMessage("CATALOG_BUY")?>">
						<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?echo GetMessage("CATALOG_ADD")?>">



					<div style="clear: right;"></div>
				</div>
						</form>
			<?}?>
				
		
			<div class="top_info">
				<?if( is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"])):?>
					<?if ($arParams["SHOW_QUANTITY"]!="N"){?>
						<?if( !$arResult["OFFERS_CATALOG_QUANTITY"] ){?>
							<div class="noavailable_block"><?=GetMessage('CATALOG_NOT_AVAILABLE')?></div>
						<?}else{?>
							<div class="available_block"><?=GetMessage('CT_IS_AVAILABLE')?> ( <?=$arResult["OFFERS_CATALOG_QUANTITY"];?> )</div>
						<?}?>
					<?}?>
					<?if ($arResult["OFFERS_CATALOG_QUANTITY"]):?>
					<!--noindex-->
						<div class="center_info">
							<a rel="nofollow" href="#" class="found_cheaper" item-name="<?=$arResult["NAME"]?>"><span><?=GetMessage('CT_BCE_CATALOG_FIND_CHEAPER')?></span></a>
						</div>
					<!--/noindex-->
					<?endif;?>
				<?else:?>
					<?if ($arParams["SHOW_QUANTITY"]!="N"){?>
						<?if( !$arResult["CATALOG_QUANTITY"] ){?>
							<div class="noavailable_block"><?=GetMessage('CATALOG_NOT_AVAILABLE')?></div>
						<?}else {?>
							<div class="available_block"><?=GetMessage('CT_IS_AVAILABLE')?> ( <?=$arResult["CATALOG_QUANTITY"]?> )</div>
						<?}?>
					<?}?>
					<?if ($arResult["CATALOG_QUANTITY"]):?>
					<!--noindex-->
						<div class="center_info">
							<a rel="nofollow" href="#" class="found_cheaper" item-name="<?=$arResult["NAME"]?>"><span><?=GetMessage('CT_BCE_CATALOG_FIND_CHEAPER')?></span></a>
						</div>
					<!--/noindex-->
					<?endif;?>
				<?endif;?>

						<div class="center_right_info">
							<a rel="nofollow" href="#" class="found_descript" item-name="<?=$arResult["NAME"]?>"><span>Описание</span></a>
						</div>
<?if( !empty($arResult["PROPERTIES"]["OPTIONS"]["VALUE"]) ){?>
						<div class="center_right_info">
							<a rel="nofollow" href="#" class="found_kompl" item-name="<?=$arResult["NAME"]?>"><span>Комплектация</span></a>
						</div>

<?}?>
			</div>
			<div class="top_info top_info_text">
				<?=$arResult["DETAIL_TEXT"]?>
			</div>		

			<?if( is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"]) && 1 == 0 ){?>
			
				<?if(($arParams["SKU_DISPLAY_LOCATION"]=="RIGHT")||(!$arParams["SKU_DISPLAY_LOCATION"])):?>
					<table class="equipment" cellspacing="0" cellpadding="0">
						<thead>
							<tr>
								<?foreach ($arResult["SKU_PROPERTIES"] as $key => $arProp){?><td><?=$arProp["NAME"]?></td><?}?>
								<td><?=GetMessage("CATALOG_PRICE")?></td>
								<?if ($arParams["SHOW_QUANTITY"]!="N"){?><td class="offer_count"><?=GetMessage("AVAILABLE")?></td><?}?>
								<td colspan="2"></td>
							</tr>
						</thead>
						<tbody>
							<?$numProps = count($arResult["SKU_PROPERTIES"]);?>
							<?foreach ($arResult["SKU_ELEMENTS"] as $key => $arSKU){?>
								<tr>
									<?for( $i = 0; $i < $numProps; $i++ ){?>
										<td>
											<?=!empty( $arSKU[$i] ) ? $arSKU[$i] : GetMessage('NOT_PROP')?>
										</td>
									<?}?>
									<td class="price">
										<?if( intval($arSKU["DISCOUNT_PRICE"]) > 0 && $arSKU["PRICE"] > 0){?>
											<span class="new"><?=$arSKU["DISCOUNT_PRICE"]?></span> <span class="old"><?=$arSKU["PRICE"]?></span>
										<?}else{?>
											<?=$arSKU["PRICE"]?>
										<?}?>
									</td>
									<?if ($arParams["SHOW_QUANTITY"]!="N"){?>									
										<td class="offer_count">
											<?if($arParams["USE_STORE"] == "Y"):?><a class="show_offers_stores" onclick="return showOffersStores('<?=$arSKU["ID"]?>', '<?=$arParams["MIN_AMOUNT"]?>', '<?=$arParams["USE_MIN_AMOUNT"]?>', '<?=$arParams["USE_STORE_SCHEDULE"]?>', '<?=$arParams["USE_STORE_PHONE"]?>', '<?=$arParams["STORE_PATH"]?>');"><?endif;?>
												<?=$arSKU["CATALOG_QUANTITY"]?>&nbsp;<?=GetMessage("MEASURE");?>
											<?if($arParams["USE_STORE"] == "Y"):?></a><?endif;?>
										</td>
									<?}?>
									<!--noindex-->
										<?if( $arSKU["CAN_BUY"] ){?>
											<td class="buy_link">
												<a rel="nofollow" element_id="#<?=$arSKU["ID"];?>" href="<?=$arSKU["ADD_URL"]?>" onclick="return addToCart(this, 'detail', '<?=GetMessage("CATALOG_IN_CART")?>', 'cart', '<?=$arParams["BASKET_URL"]?>', '<?=$arResult["ID"]?>', '<?=$arSKU["ID"]?>');"><?=GetMessage("CATALOG_BUY")?></a>
											</td>
											<td class="buy_link">
												<a onclick="return oneClickBuy('<?=$arSKU["ID"];?>');"><?=GetMessage('ONE_CLICK_BUY')?></a>	
											</td>
										<?}elseif( $arNotify[SITE_ID]['use'] == 'Y'){?>
											<?if( $USER->IsAuthorized() ){?>
												<td  class="buy_link">
													<noindex>
														<a rel="nofollow" href="<?=$arSKU["SUBSCRIBE_URL"]?>" onclick="return addToSubscribe(this, '<?=GetMessage("CATALOG_IN_SUBSCRIBE")?>');"><?=GetMessage("CATALOG_SUBSCRIBE")?></a>
														<sup class="notavailable"><?=GetMessage("CATALOG_NOT_AVAILABLE2")?></sup>
													</noindex>
												</td>
												<td></td>
											<?}else{?>
												<td  class="buy_link">
													<noindex>
														<a rel="nofollow" href="#" onclick="showAuthForSubscribe(this, <?=$arSKU["ID"]?>, '<?=$arSKU["SUBSCRIBE_URL"]?>')"><?=GetMessage("CATALOG_SUBSCRIBE")?></a>
														<sup class="notavailable"><?=GetMessage("CATALOG_NOT_AVAILABLE2")?></sup>
													</noindex>
												</td>
												<td></td>
											<?}?>
										<?}?>
										<?if( $arParams["DISPLAY_COMPARE"] == "Y" ){?>
											<td>
												<a rel="nofollow" href="#<?=$arSKU["ID"]?>" class="wish_item"><?=GetMessage("CATALOG_IZB")?></a>
											</td>
										<?}?>
									<!--/noindex-->
								</tr>
							<?}?>
						</tbody>
					</table>
				<?endif;?>
			<?}?>
		</div>

		<?if ($arResult["PREVIEW_TEXT"]):?>
			<div class="description"><?=$arResult["PREVIEW_TEXT"];?></div>
		<?endif;?>
<?if( !empty($arResult["PROPERTIES"]["OPTIONS"]["VALUE"]) ){?>
	<div class="komplekt komplekt_title">
		<h4 class="char">Комплектация</h4>
	</div>
<?}?>
	</div>
	<div style="width:100%;height:1px;clear:both"></div>


	<?if( is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"]) ){?>


		<?if($arParams["SKU_DISPLAY_LOCATION"]=="BOTTOM"):?>
		
			<table class="equipment" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<?foreach ($arResult["SKU_PROPERTIES"] as $key => $arProp){?><td><?=$arProp["NAME"]?></td><?}?>
						<td><?=GetMessage("CATALOG_PRICE")?></td>
						<?if ($arParams["SHOW_QUANTITY"]!="N"){?><td class="offer_count"><?=GetMessage("AVAILABLE")?></td><?}?>
						<td colspan="2"></td>
					</tr>
				</thead>
				<tbody>
					<?$numProps = count($arResult["SKU_PROPERTIES"]);?>
					<?foreach ($arResult["SKU_ELEMENTS"] as $key => $arSKU){?>


						<tr>
							<?for( $i = 0; $i < $numProps; $i++ ){?>
								<td>
									<?=!empty( $arSKU[$i] ) ? $arSKU[$i] : GetMessage('NOT_PROP')?>
								</td>
							<?}?>
							<td class="price">
								<?if( intval($arSKU["DISCOUNT_PRICE"]) > 0 && $arSKU["PRICE"] > 0){?>
									<span class="new"><?=$arSKU["DISCOUNT_PRICE"]?></span> <span class="old"><?=$arSKU["PRICE"]?></span>
								<?}else{?>
									<?=$arSKU["PRICE"]?>
								<?}?>
							</td>
							<?if ($arParams["SHOW_QUANTITY"]!="N"){?>							
								<td class="offer_count">
									<?if($arParams["USE_STORE"] == "Y"):?><a class="show_offers_stores" onclick="return showOffersStores('<?=$arSKU["ID"]?>', '<?=$arParams["MIN_AMOUNT"]?>', '<?=$arParams["USE_MIN_AMOUNT"]?>', '<?=$arParams["USE_STORE_SCHEDULE"]?>', '<?=$arParams["USE_STORE_PHONE"]?>', '<?=$arParams["STORE_PATH"]?>');"><?endif;?>
										<?=$arSKU["CATALOG_QUANTITY"]?>&nbsp;<?=GetMessage("MEASURE");?>
									<?if($arParams["USE_STORE"] == "Y"):?></a><?endif;?>
								</td>
							<?}?>
							<!--noindex-->
									<td class="buy_link">
										<?if( $arSKU["CAN_BUY"] ){?>
											<a rel="nofollow" element_id="#<?=$arSKU["ID"];?>" href="<?=$arSKU["ADD_URL"]?>" onclick="return addToCart_my2(this, 'detail', '<?=GetMessage("CATALOG_IN_CART")?>', 'cart', '<?=$arParams["BASKET_URL"]?>', '<?=$arResult["ID"]?>', '<?=$arSKU["ID"]?>');"><?=GetMessage("CATALOG_BUY")?></a>
										<?} elseif ($arNotify[SITE_ID]['use'] == 'Y'){?>
											<?if( $USER->IsAuthorized() ){?>
												<noindex>
													<a rel="nofollow" href="<?=$arSKU["SUBSCRIBE_URL"]?>" onclick="return addToSubscribe(this, '<?=GetMessage("CATALOG_IN_SUBSCRIBE")?>');"><?=GetMessage("CATALOG_SUBSCRIBE")?></a>
													<sup class="notavailable"><?=GetMessage("CATALOG_NOT_AVAILABLE2")?></sup>
												</noindex>
											<?}else{?>
												<noindex>
													<a rel="nofollow" href="#" onclick="showAuthForSubscribe(this, <?=$arSKU["ID"]?>, '<?=$arSKU["SUBSCRIBE_URL"]?>')"><?=GetMessage("CATALOG_SUBSCRIBE")?></a>
													<sup class="notavailable"><?=GetMessage("CATALOG_NOT_AVAILABLE2")?></sup>
												</noindex>
											<?}?>
										<?}?>
									</td>
									<td class="buy_link">
										<?if( $arSKU["CAN_BUY"] ){?>
											<a onclick="return oneClickBuy('<?=$arSKU["ID"];?>');"><?=GetMessage('ONE_CLICK_BUY')?></a>	
										<?}?>
									</td>
								<?if( $arParams["DISPLAY_COMPARE"] == "Y" ){?>
									<td>
										<a rel="nofollow" href="#<?=$arSKU["ID"]?>" class="wish_item"><?=GetMessage("CATALOG_IZB")?></a>
									</td>
								<?}?>
							<!--/noindex-->
						</tr>
					<?}?>
				</tbody>
			</table>
			<br />
		<?endif;?>

	<?}?>
	<?/*?><div class="shadow-item_info"><img border="0" src="<?=SITE_TEMPLATE_PATH?>/img/shadow-item_info_revert.png" alt="" /></div><?*/?>
</div>





<? /*Product Description */ ?>
<?/*$rsStock = CIBlockElement::GetList(array(), array("ACTIVE" => "Y", "IBLOCK_ID" => $arParams["IBLOCK_STOCK_ID"], "PROPERTY_LINK" => $arResult["ID"]));

		$rsStock->SetUrlTemplates($arParams["SEF_MODE_STOCK_SECTIONS"].$arParams["SEF_MODE_STOCK_ELEMENT"]);
		while( $arStock = $rsStock->GetNext() ){?>
			<div class="stock_board">
				<div class="name"><?=GetMessage("CATALOG_STOCK_TITLE")?> <a class="read_more" href="<?=$arStock["DETAIL_PAGE_URL"]?>"><?=GetMessage("CATALOG_STOCK_VIEW")?></a> <i></i> </div>
				<div class="txt"><?=$arStock["PREVIEW_TEXT"]?></div>				
			</div>
		<?}*/?>
		
		
		<?
			$showProps = false;
			foreach( $arResult["DISPLAY_PROPERTIES"] as $arProp )
			{
				if (($arProp["CODE"]!="HIT")&&($arProp["CODE"]!="RECOMMEND")&&($arProp["CODE"]!="OPTIONS")&&($arProp["CODE"]!="NEW")&&($arProp["CODE"]!="STOCK")&&trim($arProp["VALUE"])){$showProps=true;}
			}
		?>
		<?if ($showProps):?>
			<div class="shadow-item_info"><img border="0" src="<?=SITE_TEMPLATE_PATH?>/img/shadow-item_info_revert.png" alt="" /></div>
			<h4 class="char"><?=GetMessage('CT_NAME_DOP_CHAR')?></h4>
			<div class="char-wrapp">			
				<?foreach( $arResult["DISPLAY_PROPERTIES"] as $arProp ){?>

					<?if (($arProp["CODE"]!="HIT")&&($arProp["CODE"]!="RECOMMEND")&&($arProp["CODE"]!="NEW")&&($arProp["CODE"]!="OPTIONS")&&($arProp["CODE"]!="STOCK")):?>				
						<?if( !empty( $arProp["VALUE"] ) ){?>
							<div class="char">
								<div class="char_name"><?=$arProp["NAME"]?>:</div>
								<div class="char_value"><?=$arProp["VALUE"]?></div>
							</div>
						<?}?>
					<?endif;?>
				<?}?>		
			</div>
							
		<?endif;?>
		


<div style="width:100%;height:1px;clear:both"></div>
<div class="shadow-item_info"><img border="0" src="<?=SITE_TEMPLATE_PATH?>/img/shadow-item_info_revert.png" alt="" /></div>


<? /*Product tabs */ ?>

<?
/*
print_r($arResult);
*/
?>
<?
	$count_review = 0;
	$rsRew = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $arParams["IBLOCK_REVIEWS_ID"], "PROPERTY_ITEM" => $arResult["ID"]));
	while( $arRew = $rsRew->GetNext() ){ $count_review++; }
?>
<?/*
if(!empty($arResult["PROPERTIES"]["OPTIONS"]["VALUE"])){

}else{
	$arResult['IBLOCK_SECTION_ID']

	$proper = "";
	 $arFilter = Array('IBLOCK_ID' => $arResult['IBLOCK_ID'] ,'ID' => $arResult['IBLOCK_SECTION_ID']);
	 $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true, Array("UF_PROP"));
	 if($ar_result = $db_list->GetNext()){
	 	$proper = $ar_result['UF_PROP'];
	 }

}*/
?>

<?/*print_r($arResult['PROPERTIES']['GIDRO']['HINT']);*/?>
<div id="nabor_complect">
<?
$IBLOCK_ID_PROP = 15;
$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$IBLOCK_ID_PROP, "PROPERTY_TYPE"=>"E", "CODE"=>"%_CHECK"));
while ($prop_fields = $properties->GetNext())
{
  $prop_vib[] = $prop_fields['CODE'];
}
?>
<?foreach($prop_vib  as $prop_vib_code){?>
<?if(!empty($arResult['PROPERTIES'][$prop_vib_code]['VALUE'])):?>
	<?if($arResult['PROPERTIES'][$prop_vib_code]['HINT'] == "radio"):?>
		<?$proi = 0;?>
<h3><?=$arResult['PROPERTIES'][$prop_vib_code]['NAME']?></h3>
		<?foreach($arResult['PROPERTIES'][$prop_vib_code]['VALUE'] as $propelid){?>
			<?
			$arFilter = Array("IBLOCK_ID"=>'29', "ID" =>  $propelid);
			$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array("nPageSize"=>50), $arSelect);
			if($ob = $res->GetNextElement()){ 
			$ar_fields = $ob->GetFields();  
			 $arProps = $ob->GetProperties();?>
			<? if($proi++ == 0){?>
				<div><input class="compl_checkradio" type="radio" name="<?=$prop_vib_code?>" value="<?=$arProps['PRICE']['VALUE']?>" id="<?=$prop_vib_code?>_<?=$ar_fields['ID']?>" checked="checked" /><label for="<?=$prop_vib_code?>_<?=$ar_fields['ID']?>">
<?if(!empty($ar_fields['PREVIEW_PICTURE'])){
	$file = CFile::ResizeImageGet($ar_fields['PREVIEW_PICTURE'], array('width'=>40, 'height'=>40), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	echo '<img class="prop_picture" border="0" src="'.$file["src"].'" width="'.$file["width"].'" height="'.$file["height"].'" alt="'.$arResult["NAME"].'" title="'.$arResult["NAME"].'" /> ';
}?>
<?=$ar_fields['NAME']?></label></div>
			<?}else{?>
				<div><input class="compl_checkradio" type="radio" name="<?=$prop_vib_code?>" value="<?=$arProps['PRICE']['VALUE']?>" id="<?=$prop_vib_code?>_<?=$ar_fields['ID']?>" /><label for="<?=$prop_vib_code?>_<?=$ar_fields['ID']?>">
<?if(!empty($ar_fields['PREVIEW_PICTURE'])){
	$file = CFile::ResizeImageGet($ar_fields['PREVIEW_PICTURE'], array('width'=>40, 'height'=>40), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	echo '<img class="prop_picture" border="0" src="'.$file["src"].'" width="'.$file["width"].'" height="'.$file["height"].'" alt="'.$arResult["NAME"].'" title="'.$arResult["NAME"].'" /> ';
}?>
<?=$ar_fields['NAME']?></label></div>
			<?}?>


			<?}?>
		<?}?>
	<? elseif($arResult['PROPERTIES'][$prop_vib_code]['HINT'] == "checkbox"): ?>
		<?$proi = 0;?>
<h3><?=$arResult['PROPERTIES'][$prop_vib_code]['NAME']?></h3>
		<?foreach($arResult['PROPERTIES'][$prop_vib_code]['VALUE'] as $propelid){?>
			<?
			$arFilter = Array("IBLOCK_ID"=>'29', "ID" =>  $propelid);
			$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array("nPageSize"=>50), $arSelect);
			if($ob = $res->GetNextElement()){ 
			$ar_fields = $ob->GetFields();  
			 $arProps = $ob->GetProperties();?>
			<? if($proi++ == 0){?>
				<div><input class="compl_checkradio" type="checkbox" name="<?=$prop_vib_code?>" value="<?=$arProps['PRICE']['VALUE']?>" id="<?=$prop_vib_code?>_<?=$ar_fields['ID']?>" checked="checked" /><label for="<?=$prop_vib_code?>_<?=$ar_fields['ID']?>"><?=$ar_fields['NAME']?></label></div>
			<?}else{?>
				<div><input class="compl_checkradio" type="checkbox" name="<?=$prop_vib_code?>" value="<?=$arProps['PRICE']['VALUE']?>" id="<?=$prop_vib_code?>_<?=$ar_fields['ID']?>" /><label for="<?=$prop_vib_code?>_<?=$ar_fields['ID']?>"><?=$ar_fields['NAME']?></label></div>
			<?}?>
			<?}?>
		<?}?>
	<?endif;?>
<?endif;?>
<br />
<? }?>
</div>


<?if( !empty($arResult["PROPERTIES"]["OPTIONS"]["VALUE"]) ){?>
<div class="komplekt">
<?$GLOBALS['arrFilter_options'] = array("ID" => $arResult["PROPERTIES"]["OPTIONS"]["VALUE"]);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"shop_options",
	Array(
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "aspro_ishop_catalog",
		"IBLOCK_ID" => "15",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter_options",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"ADD_SECTIONS_CHAIN" => "N",
		"DISPLAY_COMPARE" => "N",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"PAGE_ELEMENT_COUNT" => "30",
		"LINE_ELEMENT_COUNT" => "1",
		"PROPERTY_CODE" => array(),
		"OFFERS_LIMIT" => "5",
		"PRICE_CODE" => array("BASE"),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_PROPERTIES" => array("PERFOMANCE", "COLORS"),
		"USE_PRODUCT_QUANTITY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "shop",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"HIDE_NOT_AVAILABLE" => "N",
		"CONVERT_CURRENCY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	)
);?>
</div>
<?}?>

		<?if( !empty($arResult["PROPERTIES"]["INSTRUCTIONS"]["VALUE"]) ){?>
			<h4 class="char"><?=GetMessage('CT_NAME_INSTRUCTIONS')?></h4><br/>
			<?foreach( $arResult["PROPERTIES"]["INSTRUCTIONS"]["VALUE"] as $arItem ){?>
				<?$arItem = CFile::GetFileArray($arItem);?>
				<div class="<? if( $arItem["CONTENT_TYPE"] == 'application/pdf' ){ echo "pdf"; } elseif( $arItem["CONTENT_TYPE"] == 'application/octet-stream' ){ echo "word"; } elseif( $arItem["CONTENT_TYPE"] == 'application/xls' ){ echo "excel"; }?>">
					<?$FileName = substr($arItem["ORIGINAL_NAME"], 0, strrpos($arItem["ORIGINAL_NAME"], '.'));?>
					<a href="<?=$arItem["SRC"]?>"><?=$FileName?></a>
					<?=GetMessage('CT_NAME_SIZE')?>:
					<?
						$filesize = $arItem["FILE_SIZE"];
						if($filesize > 1024) {
							$filesize = ($filesize/1024);
							if($filesize > 1024) {
								$filesize = ($filesize/1024);
								if($filesize > 1024) {
									$filesize = ($filesize/1024);
									$filesize = round($filesize, 1);
									echo $filesize.GetMessage('CT_NAME_GB');
								} else {
									$filesize = round($filesize, 1);
									echo $filesize.GetMessage('CT_NAME_MB');
								}
							} else {
								$filesize = round($filesize, 1);
								echo $filesize.GetMessage('CT_NAME_KB');
							}
						} else {
							$filesize = round($filesize, 1);
							echo $filesize.GetMessage('CT_NAME_b');
						}
					?>
				</div>
			<?}?>
		<?}?>

<div class="tabs_section">
<br/><br/>
	<ul class="tabs">
		<? 
			$show_tabs = false;
			$first_tab=-1;
		?>		
		
		<?if( !$arResult["OFFERS"]):?>
			<?if($arParams["USE_STORE"] == "Y"):?>
				<li <? echo !$show_tabs?'class="current"':''; ?>>
					<span><i><?=$arParams["MAIN_TITLE"]?></i></span>
				</li>
				<?
					if (!$show_tabs) {
						$first_tab=1;
						$show_tabs=true;
					}
				?>
			<?endif;?>
		<?endif;?>
		<?if ($arParams["USE_ALSO_BUY"]=="Y"):?>
			<?if( !empty($arResult["PROPERTIES"]["ASSOCIATED"]["VALUE"]) ):?>
				<li <? echo !$show_tabs?'class="current"':''; ?>>
					<span><i><?=GetMessage('CT_NAME_ASSOCIATED_TITLE')?> (<?=count($arResult["PROPERTIES"]["ASSOCIATED"]["VALUE"])?>)</i></span>
				</li>
				<?
					if (!$show_tabs) {
						$first_tab=2;
						$show_tabs=true;
					}
				?>
			<?endif;?>	
		<?endif;?>						
		
		<?if( !empty( $arResult["PROPERTIES"]["EXPANDABLES"]["VALUE"] ) ){ ?>
			<li <? echo !$show_tabs?'class="current"':''; ?>>
				<span><i><?=GetMessage('CT_NAME_DOP_OBORUDOVANIE')?> (<?=count($arResult["PROPERTIES"]["EXPANDABLES"]["VALUE"])?>)</i></span>
			</li>
			<?
				if (!$show_tabs) {
					$first_tab=3;
					$show_tabs=true;
				}
			?>
		<?}?>
	</ul>
	
	<?if( !$arResult["OFFERS"]):?>
		<!--noindex-->
			<?/*if(!$arResult["CATALOG_QUANTITY"]){?>
				<?if( $USER->IsAuthorized() ){?>
					<a rel="nofollow" href="<?=$arResult["SUBSCRIBE_URL"]?>" class="button add_order" onclick="return addToSubscribe(this, '<?=GetMessage("CATALOG_IN_SUBSCRIBE")?>');" class="bt2" id="catalog_add2cart_link"><span><?=GetMessage('CATALOG_ORDER_NAME')?></span></a>
				<?}else{?>
					<a rel="nofollow" href="#" class="button add_order" onclick="showAuthForSubscribe(this, <?=$arResult["ID"]?>, '<?=$arResult["SUBSCRIBE_URL"]?>')" class="bt2"><span><?=GetMessage('CATALOG_ORDER_NAME')?></span></a>
				<?}?><br/><br/>
			<?}*/?>
		<!--/noindex-->	
		<?if($arParams["USE_STORE"] == "Y"){?>	
			<div class="box" <? echo $first_tab==1?'style="display: block;"':''; ?>>	
				<?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount", "shop", array(
						"PER_PAGE" => "10",
						"USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
						"SCHEDULE" => $arParams["USE_STORE_SCHEDULE"],
						"USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
						"MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
						"ELEMENT_ID" => $arResult["ID"],
						"STORE_PATH"  =>  $arParams["STORE_PATH"],
						"MAIN_TITLE"  =>  $arParams["MAIN_TITLE"],
					),
					$component
				);?>	
			</div>
		<?}?>
	<?endif;?>
	



	<?if( !empty($arResult["PROPERTIES"]["ASSOCIATED"]["VALUE"]) ){?>
	<div class="box" <? echo $first_tab==2?'style="display: block;"':''; ?>>
		<div class="associated_items">			
				<?$GLOBALS['arrFilterAssociated'] = array( "ID" => $arResult["PROPERTIES"]["ASSOCIATED"]["VALUE"] );
				$APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					"shop_table_preview",
					Array(
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"SECTION_ID" => 0,
						"SECTION_CODE" => "",
						"ELEMENT_SORT_FIELD" => "sort",
						"ELEMENT_SORT_ORDER" => "asc",
						"FILTER_NAME" => "arrFilterAssociated",
						"INCLUDE_SUBSECTIONS" => "Y",
						"SHOW_ALL_WO_SECTION" => "Y",
						"PAGE_ELEMENT_COUNT" => "99999",
						"LINE_ELEMENT_COUNT" => 4,
						"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
						"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
						"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
						"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
						"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
						"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
						"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
						"BASKET_URL" => $arParams["BASKET_URL"],
						"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
						"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
						"PRODUCT_QUANTITY_VARIABLE" => "quantity",
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
						"AJAX_MODE" => $arParams["AJAX_MODE"],
						"AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
						"AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
						"AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
						"CACHE_TYPE" =>$arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
						"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
						"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
						"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
						"ADD_SECTIONS_CHAIN" => "N",
						"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
						"SET_TITLE" => $arParams["SET_TITLE"],
						"SET_STATUS_404" => $arParams["SET_STATUS_404"],
						"CACHE_FILTER" => $arParams["CACHE_FILTER"],
						"PRICE_CODE" => $arParams["PRICE_CODE"],
						"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
						"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
						"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
						"USE_PRODUCT_QUANTITY" => $arParams["SET_STATUS_404"],
						"OFFERS_CART_PROPERTIES" => array(),
						"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
						"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
						"PAGER_TITLE" => $arParams["PAGER_TITLE"],
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
						"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
						"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
						"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
						"AJAX_OPTION_ADDITIONAL" => "",
						"ADD_CHAIN_ITEM" => "N"
					),
				$component
				);?>		
		</div>
	</div>		
	<?}?>

	
	<?if( !empty($arResult["PROPERTIES"]["EXPANDABLES"]["VALUE"]) ){?>
		<div class="box" <? echo $first_tab==3?'style="display: block;"':''; ?>>
			<?$GLOBALS['arrFilterExpandables'] = array( "ID" => $arResult["PROPERTIES"]["EXPANDABLES"]["VALUE"] );
			$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"shop_table_preview",
			Array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"SECTION_ID" => 0,
				"SECTION_CODE" => "",
				"ELEMENT_SORT_FIELD" => "sort",
				"ELEMENT_SORT_ORDER" => "asc",
				"FILTER_NAME" => "arrFilterExpandables",
				"INCLUDE_SUBSECTIONS" => "Y",
				"SHOW_ALL_WO_SECTION" => "Y",
				"PAGE_ELEMENT_COUNT" => "99999",
				"LINE_ELEMENT_COUNT" => 4,
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
				"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
				"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
				"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
				"AJAX_MODE" => $arParams["AJAX_MODE"],
				"AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
				"AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
				"AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
				"CACHE_TYPE" =>$arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
				"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
				"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
				"ADD_SECTIONS_CHAIN" => "N",
				"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"USE_PRODUCT_QUANTITY" => $arParams["SET_STATUS_404"],
				"OFFERS_CART_PROPERTIES" => array(),
				"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["PAGER_TITLE"],
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
				"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"AJAX_OPTION_ADDITIONAL" => "",
				"ADD_CHAIN_ITEM" => "N"
			),
		$component
		);?>
		</div>
	<?}?>
</div>





<table width="100%" class="share"><tr><td>
	<?$APPLICATION->IncludeFile(SITE_DIR."include/social_button.php", Array(), Array(
			"MODE"      => "html",
			"NAME"      => GetMessage('CT_BCE_CATALOG_SOC_BUTTON'),
		)
	);?>	
</td><td>
	<?$APPLICATION->IncludeFile(SITE_DIR."include/item_description.php", Array(), Array(
				"MODE"      => "html",
				"NAME"      => GetMessage('CT_BCE_CATALOG_DROP_DESCR'),
			)
	);?>
</td></tr></table>

	</div>
</div>