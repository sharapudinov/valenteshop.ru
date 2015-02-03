<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="shadow-item_info"><img border="0" alt="" src="<?=SITE_TEMPLATE_PATH?>/img/shadow-item_info.png"></div>
<div class="container left shop">
<div class="inner_left">
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
					<a href="<?=$img["src"]?>" alt="<?=($arPhoto["ALT"] ? $arPhoto["ALT"] : $arResult["NAME"])?>" title="<?=($arPhoto["TITLE"] ? $arPhoto["TITLE"] : $arResult["NAME"])?>" rel="item_slider" class="fancy">
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
						<img border="0" src="<?=$img["src"]?>" alt="<?=($arPhoto["ALT"] ? $arPhoto["ALT"] : $arResult["NAME"])?>" title="<?=($arPhoto["TITLE"] ? $arPhoto["TITLE"] : $arResult["NAME"])?>" />
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
		
			<?if( !empty($arResult["PROPERTIES"]["BRAND"]["VALUE"]) ){?>
				<div class="brand">
					<?$rsBrand = CIBlockElement::GetList( array(), array("IBLOCK_ID" => $arResult["PROPERTIES"]["BRAND"]["LINK_IBLOCK_ID"], "ID" => $arResult["PROPERTIES"]["BRAND"]["VALUE"] ));
					$rsBrand->SetUrlTemplates($arParams["SEF_MODE_BRAND_SECTIONS"].$arParams["SEF_MODE_BRAND_ELEMENT"]);
					$arBrand = $rsBrand->GetNext();?>
					<?if (($arParams["SHOW_BRAND_PICTURE"]!="Y")||(!($arBrand["PREVIEW_PICTURE"]||$arBrand["DETAIL_PICTURE"]))):?>
						<b><?=GetMessage("BRAND");?>:</b> <a href="<?=$arBrand["DETAIL_PAGE_URL"]?>"><?=$arBrand["NAME"]?></a>
					<?else:?>
						<?	
							$img = array();
							if($arBrand["PREVIEW_PICTURE"]) { $img = CFile::ResizeImageGet( $arBrand["PREVIEW_PICTURE"], array( "width" => 120, "height" => 40 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true );}
							elseif($arBrand["DETAIL_PICTURE"]) { $img = CFile::ResizeImageGet( $arBrand["DETAIL_PICTURE"], array( "width" => 120, "height" => 40 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true );}
						?>
						<a href="<?=$arBrand["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$img["src"]?>" alt="<?=$arBrand["NAME"]?>" title="<?=$arBrand["NAME"]?>" style="margin-top: -10px;" /></a>
					<?endif;?>
				</div>
			<?}?>
			
			<div class="compare" id="compare"></div>
			
		
			<div class="likes_icons">
				<!--noindex-->
					<?if (empty($arResult["OFFERS"])&&$arResult["CAN_BUY"]):?>
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
			
			<div style="clear: right;"></div>
		</div>
		<div class="information item_ws">
		
		
			<?if ($arResult["CAN_BUY"] || !empty( $arResult["OFFERS"]) || !empty( $arResult["PRICES"])){?>
				<div class="middle_info">
					<table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td>
					
						<?if( !empty( $arResult["OFFERS"] ) ){?>
							<div class="price_block bottom20"><div class="price"><span><?=GetMessage("CATALOG_FROM");?> <?=$arResult["MIN_PRODUCT_OFFER_PRICE_PRINT"]?></span></div></div>
						<?}elseif( !empty( $arResult["PRICES"] )){?>
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
						<?}?>

						<nobr>
							<?if (($arParams["USE_PRODUCT_QUANTITY"]=="Y")&&$arResult["CAN_BUY"]&&(!( is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"])))):?>
								<div class="counter_block" element_id="#<?=$arResult["ID"];?>">
									<input type="text" class="text" name="count_items" value="1" />
									<span class="plus">+</span>
									<span class="minus">-</span>
								</div>
							<?endif;?>
							<!--noindex-->
							<?if( $arResult["CAN_BUY"] && empty($arResult["OFFERS"])){?>
								<a rel="nofollow" element_id="#<?=$arResult["ID"];?>" href="<?=$arResult["ADD_URL"]?>" onclick="return addToCart(this, 'detail', '<?=GetMessage("CATALOG_IN_CART")?>', 'cart', '<?=$arParams["BASKET_URL"]?>', '<?=$arResult["ID"]?>');" class="button add_item" alt="<?=$arResult["NAME"]?>">
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
					<div style="clear: right;"></div>
				</div>
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
					<?if ($arResult["MIN_PRODUCT_OFFER_PRICE_PRINT"] && ($arParams["SHOW_FOUND_CHEAPER"]!="N")):?>
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
					<?if ($arCountPricesCanAccess && ($arParams["SHOW_FOUND_CHEAPER"]!="N")):?>
					<!--noindex-->
						<div class="center_info">
							<a rel="nofollow" href="#" class="found_cheaper" item-name="<?=$arResult["NAME"]?>"><span><?=GetMessage('CT_BCE_CATALOG_FIND_CHEAPER')?></span></a>
						</div>
					<!--/noindex-->
					<?endif;?>
				<?endif;?>	
			</div>
			
			<?if( is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"]) ){?>
			
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
								<?if ($arSKU["ID"]):?>
									<tr>
										<?for( $i = 0; $i < $numProps; $i++ ){?>
											<td class="property">
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
								<?endif;?>
							<?}?>
						</tbody>
					</table>
				<?endif;?>
			<?}?>
		</div>
		<?if ($arResult["PREVIEW_TEXT"]):?>
			<div class="description"><?=$arResult["PREVIEW_TEXT"];?></div>
		<?endif;?>

	</div>
	<div style="clear:both"></div>

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
						<?if ($arSKU["ID"]):?>
							<tr>
								<?for( $i = 0; $i < $numProps; $i++ ){?>
									<td  class="property">
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
												<a rel="nofollow" element_id="#<?=$arSKU["ID"];?>" href="<?=$arSKU["ADD_URL"]?>" onclick="return addToCart(this, 'detail', '<?=GetMessage("CATALOG_IN_CART")?>', 'cart', '<?=$arParams["BASKET_URL"]?>', '<?=$arResult["ID"]?>', '<?=$arSKU["ID"]?>');"><?=GetMessage("CATALOG_BUY")?></a>
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
						<?endif;?>
					<?}?>
				</tbody>
			</table>
			<br />
		<?endif;?>
	<?}?>
	<div class="shadow-item_info"><img border="0" src="<?=SITE_TEMPLATE_PATH?>/img/shadow-item_info_revert.png" alt="" /></div>
</div>


<? /*Product Description */ ?>
<?$rsStock = CIBlockElement::GetList(array(), array("ACTIVE" => "Y", "IBLOCK_ID" => $arParams["IBLOCK_STOCK_ID"], "PROPERTY_LINK" => $arResult["ID"]));

		$rsStock->SetUrlTemplates($arParams["SEF_MODE_STOCK_SECTIONS"].$arParams["SEF_MODE_STOCK_ELEMENT"]);
		while( $arStock = $rsStock->GetNext() ){?>
			<div class="stock_board">
				<div class="name"><?=GetMessage("CATALOG_STOCK_TITLE")?> <a class="read_more" href="<?=$arStock["DETAIL_PAGE_URL"]?>"><?=GetMessage("CATALOG_STOCK_VIEW")?></a> <i></i> </div>
				<div class="txt"><?=$arStock["PREVIEW_TEXT"]?></div>				
			</div>
		<?}?>
		<?=$arResult["DETAIL_TEXT"]?>
		
		
		<?if ($arParams["PROPERTIES_DISPLAY_LOCATION"]!="TAB"):?>
			<?

				$showProps = false;
				foreach( $arResult["DISPLAY_PROPERTIES"] as $arProp )
				{

					if (($arProp["CODE"]!="HIT")&&($arProp["CODE"]!="RECOMMEND")&&($arProp["CODE"]!="NEW")&&($arProp["CODE"]!="STOCK")&&trim($arProp["VALUE"])){$showProps=true;}
				}

			?>
			<?if ($showProps):?>
				<div class="shadow-item_info"><img border="0" src="<?=SITE_TEMPLATE_PATH?>/img/shadow-item_info_revert.png" alt="" /></div>
				<h4 class="char"><?=GetMessage('CT_NAME_DOP_CHAR')?></h4>
				<div class="char-wrapp">			
					<?if ($arParams["PROPERTIES_DISPLAY_TYPE"]!="TABLE"):?>
						<?foreach( $arResult["DISPLAY_PROPERTIES"] as $arProp ){?>
							<?if (($arProp["CODE"]!="HIT")&&($arProp["CODE"]!="RECOMMEND")&&($arProp["CODE"]!="NEW")&&($arProp["CODE"]!="STOCK")):?>				
								<?if( !empty( $arProp["VALUE"] ) ){?>
									<div class="char">
										<div class="char_name">
										<?if ($arProp["HINT"]):?><div class="hint"><span class="icon"><i>i</i></span><div class="tooltip"><?=$arProp["HINT"]?></div></div><?endif;?>
										<?=$arProp["NAME"]?>:</div>
										<div class="char_value">
											<?

												if(count($arProp["DISPLAY_VALUE"])>1) 
													{ foreach($arProp["DISPLAY_VALUE"] as $key => $value) { if ($arProp["DISPLAY_VALUE"][$key+1]) {echo $value.", ";} else {echo $value;} }} 
												else 

													{ echo $arProp["DISPLAY_VALUE"]; }
											?>

										</div>
									</div>
								<?}?>
							<?endif;?>
						<?}?>
					<?else:?>
						<table class="props_table">
							<?foreach( $arResult["DISPLAY_PROPERTIES"] as $arProp ){?>
								<?if (($arProp["CODE"]!="HIT")&&($arProp["CODE"]!="RECOMMEND")&&($arProp["CODE"]!="NEW")&&($arProp["CODE"]!="STOCK")):?>				
									<?if( !empty( $arProp["VALUE"] ) ){?>
										<tr>
											<td class="char_name"><span><?if($arProp["HINT"]):?><div class="hint"><span class="icon"><i>i</i></span><div class="tooltip"><?=$arProp["HINT"]?></div></div><?endif;?><?=$arProp["NAME"]?></span></td>
											<td class="char_value"><span>
												<?
													if(count($arProp["DISPLAY_VALUE"])>1) 
														{ foreach($arProp["DISPLAY_VALUE"] as $key => $value) { if ($arProp["DISPLAY_VALUE"][$key+1]) {echo $value.", ";} else {echo $value;} }} 
													else 
														{ echo $arProp["DISPLAY_VALUE"]; }
												?></span>
											</td>
										</tr>
									<?}?>
								<?endif;?>
							<?}?>
						</table>
					<?endif;?>
				</div>			
			<?endif;?>


		<?endif;?>
		
		<?if( !empty($arResult["PROPERTIES"]["INSTRUCTIONS"]["VALUE"]) ){?>
			<div class="shadow-item_info"><img border="0" src="<?=SITE_TEMPLATE_PATH?>/img/shadow-item_info_revert.png" alt="" /></div>
			<h4 class="char"><?=GetMessage('CT_NAME_INSTRUCTIONS')?></h4><br/>
			<?foreach( $arResult["PROPERTIES"]["INSTRUCTIONS"]["VALUE"] as $arItem ){?>
				<?$arItem = CFile::GetFileArray($arItem);?>
				<div class="<? if( $arItem["CONTENT_TYPE"] == 'application/pdf' ){ echo "pdf"; } elseif( $arItem["CONTENT_TYPE"] == 'application/octet-stream' ){ echo "word"; } elseif( $arItem["CONTENT_TYPE"] == 'application/xls' ){ echo "excel"; }?>">
					<?$FileName = substr($arItem["ORIGINAL_NAME"], 0, strrpos($arItem["ORIGINAL_NAME"], '.'));?>
					<a href="<?=$arItem["SRC"]?>"><?if($arItem["DESCRIPTION"]){echo $arItem["DESCRIPTION"];} else {echo $FileName;}?></a>
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





<? /*Product tabs */ ?>

<div class="tabs_section">
<br/><br/>
	<ul class="tabs">
		<? 
			global $first_tab;
			$show_tabs = false;
			$first_tab=-1;
		?>		
		<?if ($arParams["PROPERTIES_DISPLAY_LOCATION"]=="TAB"):?>
			<li <? echo !$show_tabs?'class="current"':''; ?>>
				<span><?=GetMessage('CT_NAME_DOP_CHAR')?></span>
			</li>
			<?
				if (!$show_tabs) {
					$first_tab=1;
					$show_tabs=true;
				}
			?>
		<?endif;?>

		<?if( !$arResult["OFFERS"]):?>
			<?if($arParams["USE_STORE"] == "Y"):?>
				<li <? echo !$show_tabs?'class="current"':''; ?>>
					<span><i><?=$arParams["MAIN_TITLE"]?></i></span>
				</li>
				<?
					if (!$show_tabs) {
						$first_tab=2;

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
						$first_tab=3;

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
					$first_tab=4;
					$show_tabs=true;
				}
			?>
		<?}?>
		<?if (($arParams["SHOW_ASK_BLOCK"]=="Y")&&(intVal($arParams["ASK_FORM_ID"]))):?>
			<li <? echo !$show_tabs?'class="current"':''; ?>>
				<span><i><?=GetMessage('CT_NAME_ASK_BLOCK_TITLE')?></i></span>
				<?
					if (!$show_tabs) {
						$first_tab=5;

						$show_tabs=true;
					}
				?>
			</li>
		<?endif;?>
		<?if ($arParams["USE_REVIEW"]=="Y"):?>
			<li <? echo !$show_tabs?'class="current"':''; ?>>
				<span><i id="product_reviews_title"><?=GetMessage('PRODUCT_REVIEWS')?></i></span>
				<?
					if (!$show_tabs) {
						$first_tab=6;

						$show_tabs=true;
					}
				?>
			</li>
		<?endif;?>	
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
		<?if ($arParams["PROPERTIES_DISPLAY_LOCATION"]=="TAB"):?>
			<div class="box" <? echo $first_tab==1?'style="display: block;"':''; ?>>	
				<?
					$showProps = false;
					foreach( $arResult["DISPLAY_PROPERTIES"] as $arProp )
					{
						if (($arProp["CODE"]!="HIT")&&($arProp["CODE"]!="RECOMMEND")&&($arProp["CODE"]!="NEW")&&($arProp["CODE"]!="STOCK")&&trim($arProp["VALUE"])){$showProps=true;}
					}
				?>
				<?if ($showProps):?>
					<div class="char-wrapp">			
						<?if ($arParams["PROPERTIES_DISPLAY_TYPE"]!="TABLE"):?>
							<?foreach( $arResult["DISPLAY_PROPERTIES"] as $arProp ){?>
								<?if (($arProp["CODE"]!="HIT")&&($arProp["CODE"]!="RECOMMEND")&&($arProp["CODE"]!="NEW")&&($arProp["CODE"]!="STOCK")):?>				
									<?if( !empty( $arProp["VALUE"] ) ){?>
										<div class="char">
											<div class="char_name"><?if ($arProp["HINT"]):?><div class="hint"><span class="icon"><i>i</i></span><div class="tooltip"><?=$arProp["HINT"]?></div></div><?endif;?><?=$arProp["NAME"]?>:</div>
											<div class="char_value">
												<?
													if(count($arProp["DISPLAY_VALUE"])>1) 
														{ foreach($arProp["DISPLAY_VALUE"] as $key => $value) { if ($arProp["DISPLAY_VALUE"][$key+1]) {echo $value.", ";} else {echo $value;} }} 
													else 
														{ echo $arProp["DISPLAY_VALUE"]; }
												?>
											</div>
										</div>
									<?}?>
								<?endif;?>
							<?}?>
						<?else:?>
							<table class="props_table">
								<?foreach( $arResult["DISPLAY_PROPERTIES"] as $arProp ){?>
									<?if (($arProp["CODE"]!="HIT")&&($arProp["CODE"]!="RECOMMEND")&&($arProp["CODE"]!="NEW")&&($arProp["CODE"]!="STOCK")):?>				
										<?if( !empty( $arProp["VALUE"] ) ){?>
											<tr>
												<td class="char_name"><span><?if ($arProp["HINT"]):?><div class="hint"><span class="icon"><i>i</i></span><div class="tooltip"><?=$arProp["HINT"]?></div></div><?endif;?><span><?=$arProp["NAME"]?></span></td>
												<td class="char_value"><span>
													<?
														if(count($arProp["DISPLAY_VALUE"])>1) 
															{ foreach($arProp["DISPLAY_VALUE"] as $key => $value) { if ($arProp["DISPLAY_VALUE"][$key+1]) {echo $value.", ";} else {echo $value;} }} 
														else 
															{ echo $arProp["DISPLAY_VALUE"]; }
													?></span>
												</td>
											</tr>
										<?}?>
									<?endif;?>
								<?}?>
							</table>
						<?endif;?>
					</div>			
				<?endif;?>
			</div>
		<?endif;?>
		<?if($arParams["USE_STORE"] == "Y"){?>	
			<div class="box" <? echo $first_tab==2?'style="display: block;"':''; ?>>	

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
	<div class="box" <? echo $first_tab==3?'style="display: block;"':''; ?>>
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
						"ADD_CHAIN_ITEM" => "N",
						"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
						"CURRENCY_ID" => $arParams["CURRENCY_ID"],

					),
				$component
				);?>		
		</div>
	</div>		
	<?}?>

	
	<?if( !empty($arResult["PROPERTIES"]["EXPANDABLES"]["VALUE"]) ){?>
		<div class="box" <? echo $first_tab==4?'style="display: block;"':''; ?>>
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
				"ADD_CHAIN_ITEM" => "N",
				"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
				"CURRENCY_ID" => $arParams["CURRENCY_ID"],
			),
		$component
		);?>
		</div>
	<?}?>