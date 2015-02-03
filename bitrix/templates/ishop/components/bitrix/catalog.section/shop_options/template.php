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
		<form id="my_form_<?=$arItem['ID']?>" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
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
					<?if ($arItem["PROPERTIES"]):?>
						<table class="props-list1">
							<?foreach( $arItem["PROPERTIES"] as $arProp_key => $arProp ){?>
								<?if( !empty( $arProp["VALUE"] ) && $arProp_key == "PROP_2065"  ){?>
									<tr>
										<td><?=$arProp["NAME"]?>:</td>
										<td><?=$arProp["VALUE"]?></td>
									</tr>
								<?}?>
							<?}?>
							
						</table>
					<?endif;?>

<?
$proper = array(); $prop = array();

if(!empty($arItem["PROPERTIES"]["PROP"]["VALUE"])){
	$proper = $arItem["PROPERTIES"]["PROP"]["VALUE"];
}else{

	$proper = "";
	 $arFilter = Array('IBLOCK_ID' => $arItem['IBLOCK_ID'] ,'ID' => $arItem['IBLOCK_SECTION_ID']);
	 $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true, Array("UF_PROP"));
	 if($ar_result = $db_list->GetNext()){
		foreach($ar_result['UF_PROP'] as $PROP){
			$rsEnum = CUserFieldEnum::GetList(array(), array("ID" =>$PROP)); 
			$arEnum = $rsEnum->GetNext(); 
			$proper[] =  $arEnum["VALUE"]; 
		}
	 }
	if(empty($proper)){	
		$nav = CIBlockSection::GetNavChain(false,  $arItem['IBLOCK_SECTION_ID']);
		while ($arNav=$nav->GetNext()):

			 $arFilter = Array('IBLOCK_ID' => $arItem['IBLOCK_ID'] ,'ID' => $arNav['ID']);
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
$IBLOCK_ID = $arItem['IBLOCK_ID'];
$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$IBLOCK_ID));
while ($prop_fields = $properties->GetNext())
{
	if(in_array($prop_fields["CODE"], $proper)){
		if (!preg_match("/_sku/i", $prop_fields["CODE"]) && !preg_match("/_check/i", $prop_fields["CODE"])) {
			$prop[$prop_fields["CODE"]] = $prop_fields;
		}
	}
}
?>
<?
$arItem["PRODUCT_PROPERTIES"] = $prop;
?>

			<?if(count($proper) > 0):?>
					
						<table border="0" cellspacing="0" cellpadding="2">
						<?if($arParams["USE_PRODUCT_QUANTITY"]):?>
							<tr valign="top">
								<td><?echo GetMessage("CT_BCS_QUANTITY")?>:</td>
								<td>
									<input type="text" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" size="5">
								</td>
							</tr>
						<?endif;?>



				<?if(count($arItem["PRODUCT_PROPERTIES"] ) && !empty($arParams["PRODUCT_PROPERTIES"])):?>
						<?foreach($arItem["PRODUCT_PROPERTIES"] as $pid => $product_property):?>
							<?$pro_es = 0;
							if(empty($arItem['PROPERTIES'][$pid]['VALUE'])){?>
									<?$db_enum_list = CIBlockProperty::GetPropertyEnum($pid, Array("SORT"=>"asc"), Array("IBLOCK_ID"=>$arItem['IBLOCK_ID']));
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
								<?if($arItem["PROPERTIES"][$pid]["PROPERTY_TYPE"] == "L" && $arItem["PROPERTIES"][$pid]["LIST_TYPE"] == "C"):?>
									<?foreach($product_property["VALUES"] as $k => $v):?>
										<label><input type="radio" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]" value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"checked"'?>><?echo $v?></label><br>
									<?endforeach;?>
								<?else:?>
								<? if($pid == "COLORS"){?>
								<div class="lineForm">
									<?if(!empty($arItem['PROPERTIES'][$pid]['VALUE'])){?>
										<select class="sel80" id="COLORS_<?=$arItem['ID']?>" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
											<?foreach($arItem['PROPERTIES'][$pid]['VALUE'] as $pr_key => $pr_val){?>
												<?if($pr_val == "Не выбран"){?>
													<option style="position:relative;" value="Выбор">Выбор</option>
												<?}else{?> 
													<option addTags="<div style='background:<?echo $arItem['PROPERTIES'][$pid]['VALUE_XML_ID'][$pr_key];?>;' class='img_select'></div>" style="position:relative;" value="<?echo $pr_val?>" 		<?if($arItem['PROPERTIES'][$pid]['PROPERTY_VALUE_ID'][$pr_key] == $product_property["SELECTED"]) echo '"selected"'?>><?echo $pr_val?></option>
												<?}?>
											<?}?>
										</select>
									<?}else{
										$prop_i = 0;
										$db_enum_list = CIBlockProperty::GetPropertyEnum("COLORS", Array("SORT"=>"asc"), Array("IBLOCK_ID"=>$arItem['IBLOCK_ID']));
										while($ar_enum_list = $db_enum_list->GetNext())
										{?>
											<?if($prop_i++ == 0){?>
												<select class="sel80" id="COLORS_<?=$arItem['ID']?>" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
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
								<?if(!empty($arItem['PROPERTIES'][$pid]['VALUE'])){?>
									<select id="<?=$pid;?>_<?=$arItem['ID']?>" class="sel80" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
									<?foreach($arItem['PROPERTIES'][$pid]['VALUE'] as $pr_key => $pr_val){?>

										<?if($pr_val == "Не выбран"){?>
											<option value="Выбор"  >Выбор</option>
										<?}else{?> 
											<option value="<?echo $pr_val?>" ><?echo $pr_val?></option>
										<?}?>

									<?}?>
									</select>
								<?}else{?>	
									<?$prop_i = 0;?>
									<?$db_enum_list = CIBlockProperty::GetPropertyEnum($pid, Array("SORT"=>"asc"), Array("IBLOCK_ID"=>$arItem['IBLOCK_ID']));
									while($ar_enum_list = $db_enum_list->GetNext())
									{?>
										<?if($prop_i++ == 0){?>
											<select id="<?=$pid;?>_<?=$arItem['ID']?>" class="sel80" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
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
			<?endif;?>
					<?
					$IBLOCK_ID_PROP = 15;$prop_sku = array();
					$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$IBLOCK_ID_PROP, "CODE"=>"%_sku"));
					while ($prop_fields = $properties->GetNext())
					{
					  $prop_sku[] = $prop_fields['CODE'];
					}
					?>
					
					<?foreach($prop_sku  as $prop_sku_code){?>
						<?if(!empty($arItem['PROPERTIES'][$prop_sku_code]['VALUE']) && in_array($prop_sku_code, $proper)):?>
					
							<?if($arItem['PROPERTIES'][$prop_sku_code]['PROPERTY_TYPE'] == "S"):?>
							<tr valign="top">
							<td><?=$arItem['PROPERTIES'][$prop_sku_code]['NAME']?>:</td>
							<td>
							<?/*print_r($arItem['PROPERTIES'][$prop_sku_code]);*/?>
							<div class="lineForm check_select">
							<?$code_clrs = array();?>
							<select id="<?=$prop_sku_code;?>_<?=$arItem['ID']?>" class="sel80" name="prop[<?echo $prop_sku_code?>]">					
								<?$iii = 0;
								foreach($arItem['PROPERTIES'][$prop_sku_code]['VALUE'] as $propelid_key => $propelid){?>
				<?
				$propelid_arr = explode('/', $propelid);
		$propelid = $propelid_arr['0'];
			if(!empty($propelid_arr['1'])){
				$code_clrs[] = $propelid_arr['1'];
			}
			?>	
									<?if($iii++ == 0){?>
										<option value="<?=$arItem['PROPERTIES'][$prop_sku_code]['DESCRIPTION'][$propelid_key]?>/<?=$propelid?>" selected><?=$propelid?></option>
									<?}else{?>
										<option value="<?=$arItem['PROPERTIES'][$prop_sku_code]['DESCRIPTION'][$propelid_key]?>/<?=$propelid?>"><?=$propelid?></option>
									<?}?>
								<?}?>
								
							</select>
<?if(count($code_clrs) > 0):?>		
<div class="colors_boxbox">		
<div id="button_colors<?=$prop_sku_code?>_block_<?=$arItem['ID'];?>" class="button_colors_block">		
	<div class="button_colors">Выберите цвет</div>
</div>		
<div id="frame_colors<?=$prop_sku_code?>_<?=$arItem['ID'];?>" class="frame_colors">
<?$ic = 1;?> 
	<?foreach($code_clrs as $prop_colors_code){?>
		<?if(!empty($arItem['PROPERTIES'][$prop_colors_code]['VALUE'])):?>
<div id="ton_colors<?=$prop_sku_code?>_block_<?=$arItem['ID'];?>" class="block_colors_code block_colors_code<?=$ic++;?>">
	<div class="block_colors_code_name"><?=$arItem['PROPERTIES'][$prop_colors_code]['NAME']?>:</div>
				<?$arFilter = Array("IBLOCK_ID"=>'31', "ID" =>  $arItem['PROPERTIES'][$prop_colors_code]['VALUE']);
				$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
				$iii = 0;
				while($ob = $res->GetNextElement()){
							$ar_fields = $ob->GetFields();  
							$arProps = $ob->GetProperties();?>
	<div class="block_colors_elem">
		<div style="display:none;" class="block_colors_elem_name">prop[<?=$prop_colors_code?>]</div>
		<div style="display:none;" class="block_colors_elem_value"><?=$ar_fields['NAME']?></div>
	<?if(!empty($ar_fields['PREVIEW_PICTURE'])){
		$file = CFile::ResizeImageGet($ar_fields['PREVIEW_PICTURE'], array('width'=>142, 'height'=>47), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		echo '<img class="colors_picture" border="0" src="'.$file["src"].'" width="'.$file["width"].'" height="'.$file["height"].'" alt="'.$ar_fields["NAME"].'" title="'.$ar_fields["NAME"].'" />';
	}?>
	<?=$ar_fields['NAME']?>
	</div>
				<?}?>
	<div class="clear_both"></div>
</div>	

		<?endif;?>
	<?}?>
	</div>
</div>
<?endif;?>
							</div>
							</td>
							</tr>
							<?elseif($arItem['PROPERTIES'][$prop_sku_code]['PROPERTY_TYPE'] == "E"):?>
							
							<tr valign="top">
							<td><?=$arItem['PROPERTIES'][$prop_sku_code]['NAME']?>:</td>
							<td>
							<div class="lineForm check_select">
							<select id="<?=$prop_sku_code;?>_<?=$arItem['ID']?>" class="sel80" name="prop[<?echo $prop_sku_code?>]">
															
								<?$arFilter = Array("IBLOCK_ID"=>'29', "ID" =>  $arItem['PROPERTIES'][$prop_sku_code]['VALUE']);
								$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array("nPageSize"=>50), $arSelect);
								$iii = 0;
								while($ob = $res->GetNextElement()){
											$ar_fields = $ob->GetFields();  
											$arProps = $ob->GetProperties();?>
									<?if($iii++ == 0){?>
										<option value="<?=$arProps['PRICE']['VALUE']?>/<?=$ar_fields['NAME']?>" selected><?=$ar_fields['NAME']?></option>
									<?}else{?>
										<option value="<?=$arProps['PRICE']['VALUE']?>/<?=$ar_fields['NAME']?>"><?=$ar_fields['NAME']?></option>
									<?}?>
								<?}?>
							</select>
							</div>
							</td>
							</tr>
							<?endif;?>
						<?endif;?>
					<?}?>
<?
$IBLOCK_ID_PROP = 15;$prop_colors = array();
$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$IBLOCK_ID_PROP, "CODE"=>"%_COLORS"));
while ($prop_fields = $properties->GetNext())
{
  $prop_colors[] = $prop_fields['CODE'];
}
?>
<?/*print_r($arResult['PROPERTIES']);*/?>	
<?if(!empty($prop_colors)):?>
<?$prop_colors_value = 0;?>
<?foreach($prop_colors  as $prop_colors_code){?>
	<?if(!empty($arItem['PROPERTIES'][$prop_colors_code]['VALUE'])):?>
		<?$prop_colors_value = 1;?>
	<?endif;?>
<?}?>
<?if($prop_colors_value == 1){?>
<tr valign="top">
	<td></td>
		<td>
<div class="colors_boxbox">			
<div id="button_colors_block_<?=$arItem['ID'];?>" class="button_colors_block">		
	<div class="button_colors">Выберите цвет</div>
</div>
<div id="frame_colors_<?=$arItem['ID'];?>" class="frame_colors">
	<?foreach($prop_colors  as $prop_colors_code){?>
		<?if(!empty($arItem['PROPERTIES'][$prop_colors_code]['VALUE'])):?>
<div id="ton_colors_block_<?=$arItem['ID'];?>" class="block_colors_code">	
<div style="display:none;" class="button_colors_id"><?=$arItem['ID'];?></div>
	<div class="block_colors_code_name"><?=$arItem['PROPERTIES'][$prop_colors_code]['NAME']?>:</div>
				<?$arFilter = Array("IBLOCK_ID"=>'31', "ID" =>  $arItem['PROPERTIES'][$prop_colors_code]['VALUE']);
				$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array("nPageSize"=>500), $arSelect);
				$iii = 0;
				while($ob = $res->GetNextElement()){
							$ar_fields = $ob->GetFields();  
							$arProps = $ob->GetProperties();?>
	<div class="block_colors_elem">
		<div style="display:none;" class="block_colors_elem_name">prop[<?=$prop_colors_code?>]</div>
		<div style="display:none;" class="block_colors_elem_value"><?=$ar_fields['NAME']?></div>
	<?if(!empty($ar_fields['PREVIEW_PICTURE'])){
		$file = CFile::ResizeImageGet($ar_fields['PREVIEW_PICTURE'], array('width'=>142, 'height'=>47), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		echo '<img class="colors_picture" border="0" src="'.$file["src"].'" width="'.$file["width"].'" height="'.$file["height"].'" alt="'.$ar_fields["NAME"].'" title="'.$ar_fields["NAME"].'" />';
	}?>
	<?=$ar_fields['NAME']?>
	</div>
				<?}?>
	<div class="clear_both"></div>
</div>	

		<?endif;?>
	<?}?>
	</div>
	</div>
				</td>
			</tr>
<?}?>
<?endif;?>	
						
						
						
						</table>
							<?foreach( $arItem["PRICES"] as $key => $arPrice ){?>
								<?if($arPrice["CAN_ACCESS"]){?>
									<input class="price_id" type="hidden" name="price_id" value="<?=$arPrice['PRINT_VALUE']?>" />
								<?}?>
							<?}?>
						<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
						<input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arItem["ID"]?>">
						<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?echo GetMessage("CATALOG_BUY")?>">
						<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?echo GetMessage("CATALOG_ADD")?>">
						
<? endif;?>


				</div>
				<div class="information">
					<div class="desc_name">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
					</div>
					
					<?/*if ($arParams["SHOW_QUANTITY"]!="N"){?>
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
					<?}*/?>
				
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
							?><?/*print_r($arItem["PRICES"]);*/?>
							<?foreach( $arItem["PRICES"] as $key => $arPrice ){?>
								<?if($arPrice["CAN_ACCESS"]){?>
									<?$price = CPrice::GetByID($arPrice["ID"]); ?>
									<?if($arCountPricesCanAccess>1):?><div class="price_name"><?=$price["CATALOG_GROUP_NAME"];?></div><?endif;?>
									<div class="price">
										<?$prefix = count( $arItem["OFFERS"] ) > 1 ? GetMessage("CATALOG_FROM") : '';?>
										<?if( $arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"] ){?>
											<span class="new"><?=$prefix?> <?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
											<span class="old"><?=$prefix?> <?=$arPrice["PRINT_VALUE"]?></span>
											<input class="price_id" type="hidden" name="price_id" value="<?=$arPrice["PRINT_DISCOUNT_VALUE"]?>" />
											<input class="price_id" type="hidden" name="price_id_discont" value="<?=$arPrice['DISCOUNT_DIFF']?>" />
										<?}else{?>
											<span><?=$prefix?> <?=$arPrice["PRINT_VALUE"]?></span>
											<input class="price_id" type="hidden" name="price_id" value="<?=$arPrice['PRINT_VALUE']?>" />
										<?}?>
									</div>
								<?}?>
							<?}?>
						</div>
					<?}?>
					
					<div class="button_block">
						<!--noindex-->
							<?if( $arItem["CAN_BUY"] ){?>
								<a rel="nofollow" element_id="#<?=$arItem["ID"]?>" href="<?=$arItem["ADD_URL"]?>" onclick="return addToCart_my2(this, 'detail', '<?=GetMessage("CATALOG_IN_CART")?>', 'cart', '<?=$arParams["BASKET_URL"]?>', '<?=$arItem["ID"]?>');" class="button add_item" alt="<?=$arItem["NAME"]?>"><span><?=GetMessage('CATALOG_ADD_TO_BASKET')?></span></a>
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
			</form>
		<?}?>
	</div>
	
	<div class="shadow-item_info"><img border="0" alt="" src="/bitrix/templates/ishop/img/shadow-item_info.png"></div>
	<?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?>
		<?=$arResult["NAV_STRING"]?>
	<?}?>
	
	<?/*$show = array_key_exists("show", $_REQUEST) && !empty($_REQUEST['show']) ? $_REQUEST['show'] : 20;*/?>
	

	<div style="clear:both"></div>
<?}?>

<div class="group_description">
	<?=$arResult["~DESCRIPTION"]?>
</div>