<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if( count($arResult["ITEMS"]) <= 0 ){?>
	<div class="empty_items">
		<?$APPLICATION->IncludeFile(SITE_DIR."/include/shop_zero_items.php", Array(), Array(
			"MODE"      => "html",
			"NAME"      => GetMessage('CATALOG_NAME_NOT_FOUND'),
			));
		?>
	</div>
<?}else{?>
	<div class="display_table">
		<?$i = 1;?>
		<?foreach( $arResult["ITEMS"] as $arItem ){?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		?>
			<div class="table_item item_ws <?if( $i % 4 == 0 ):?>last-in-line<?endif;?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
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
							<?if( $arItem["PROPERTIES"]["STOCK"]["VALUE"] == true ){?><span class="mark share"></span><?}?>
							<?if( $arItem["PROPERTIES"]["HIT"]["VALUE"] == true ){?><span class="mark hit"></span><?}?>
							<?if( $arItem["PROPERTIES"]["RECOMMEND"]["VALUE"] == true ){?><span class="mark like"></span><?}?>
							<?if( $arItem["PROPERTIES"]["NEW"]["VALUE"] == true ){?><span class="mark new"></span><?}?>
						</div>
					</div>
					<a class="desc_name" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
					<?if( !empty( $arItem["OFFERS"] ) ){?>
						<div class="price_block">
							<div class="price">
								<span><?=GetMessage("CATALOG_FROM");?> <?=$arItem["MIN_PRODUCT_OFFER_PRICE_PRINT"]?></span>
							</div>
						</div>
					<?}else{?>
					
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
										<?if( $arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"] ){?>
											<span class="new"> <?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
											<span class="old"> <?=$arPrice["PRINT_VALUE"]?></span>
										<?}else{?>
											<span> <?=$arPrice["PRINT_VALUE"]?></span>
										<?}?>
									</div>
								<?}?>
							<?}?>
						</div>
					<?}?>
					

					<?if( $arItem["CAN_BUY"] && !count($arItem["OFFERS"])){?>
						<div class="button_block">
							<!--noindex-->
								<a rel="nofollow" element_id="#<?=$arItem["ID"]?>" href="<?=$arItem["ADD_URL"]?>" onclick="return addToCart(this, 'detail', '<?=GetMessage("CATALOG_IN_CART")?>', 'cart', '<?=$arParams["BASKET_URL"]?>', '<?=$arItem["ID"]?>');" class="button add_item" alt="<?=$arItem["NAME"]?>"><span><?=GetMessage('CATALOG_ADD_TO_BASKET')?></span></a>
							<!--/noindex-->
						</div>
					<?}?>
					

					<div class="likes_icons<?if(!$arItem["CAN_BUY"] || count($arItem["OFFERS"])){?> cant_buy<?}?>">
						<!--noindex-->
							<?if( $arItem["CAN_BUY"]){?>
								<?if (empty($arItem["OFFERS"])):?>
									<a rel="nofollow" href="#<?=$arItem["ID"]?>" class="wish_item"></a>
									<div class="tooltip-wrapp">
										<div class="tooltip wish_item_tooltip"><?=GetMessage('CATALOG_IZB')?></div>
									</div>
								<?endif;?>
							<?}?>
							<?if($arParams["DISPLAY_COMPARE"]){?>
								<a rel="nofollow" element_id="#<?=$arItem["ID"]?>" href="<?=$arItem["COMPARE_URL"]?>" onclick="return addToCompare(this, 'detail', '/catalog/<?=str_replace( "#ACTION_CODE#", "DELETE_FROM_COMPARE_RESULT&ID=".$arItem["ID"], $arParams["SEF_URL_TEMPLATES"]['compare'])?>');" class="compare_item"></a>
								<div class="tooltip-wrapp">
									<div class="tooltip compare_item_tooltip"><?=GetMessage('CATALOG_COMPARE')?></div>
								</div>
							<?}?>
						<!--/noindex-->
					</div>
					<div style="clear: both"></div>
					<span class="left_sep"></span>
					
				</div>
			</div>
			<?if( $i % 4 == 0 && $i < count($arResult["ITEMS"]) ){?>
				<div class="long_separator"></div>
			<?}?>
			<?$i++;?>
		<?}?>
	</div>
	<div class="shadow-item_info"><img border="0" alt="" src="/bitrix/templates/ishop/img/shadow-item_info.png"></div>
	<?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?>
		<?=$arResult["NAV_STRING"]?>
	<?}?>
	
	<?
		$show=$arParams["PAGE_ELEMENT_COUNT"];
		if (array_key_exists("show", $_REQUEST))
		{
			if ( intVal($_REQUEST["show"]) && in_array(intVal($_REQUEST["show"]), array(20, 40, 60, 80, 100)) ) {$show=intVal($_REQUEST["show"]); $_SESSION["show"] = $show;}
			elseif ($_SESSION["show"]) {$show=intVal($_SESSION["show"]);}
		}
	?>
	
	<div class="drop_number">
		<?=GetMessage("CATALOG_DROP_TO")?>
		<a rel="nofollow" class="number" href="#"><span><?=$show?></span></a>
		<div class="number_list">
			<a rel="nofollow" class="number" href="#"><span><?=$show?></span></a>
			<?for( $i = 20; $i <= 100; $i+=20 ){
				if( $i == $show ) continue;?>
				<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam('show='.$i, array('show', 'mode'))?>"><?=$i?></a>
			<?}?>
		</div>
	</div>
	<div style="clear:both"></div>
<?}?>

<div class="group_description">
	<?=$arResult["~DESCRIPTION"]?>
</div>