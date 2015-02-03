<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?if (strlen($_REQUEST["bxajaxid"]) || ($_REQUEST["AJAX_CALL"] == "Y")){?><script>jsAjaxUtil.InsertDataToNode('<?=SITE_DIR?>ajax/show_small_cart.php', 'basket_small', false);</script><?}?>	
<div id="id-cart-list"<?if($_REQUEST["section"]=="delay"):?> style="display:none;"<?endif;?>>
	<ul class="tabs">
		<li class="current">
			<span><?=GetMessage("SALE_PRD_IN_BASKET_ACT")?></span>
		</li>
		<?if( $countItemsDelay=count($arResult["ITEMS"]["DelDelCanBuy"]) ){?>
			<li>
				<span onclick="ShowBasketItems(2);"><?=GetMessage("SALE_PRD_IN_BASKET_SHELVE")?> (<?=$countItemsDelay?>)</span>
			</li>
		<?}?>
		<?if( $countItemsSubscribe=count($arResult["ITEMS"]["ProdSubscribe"]) ){?>
			<li>
				<span onclick="ShowBasketItems(3);"><?=GetMessage("SALE_PRD_IN_BASKET_SUBSCRIBE")?> (<?=$countItemsSubscribe?>)</span>
			</li>
		<?}?>
		<?if( $countItemsNotAvailable=count($arResult["ITEMS"]["nAnCanBuy"]) ){?>
			<li>
				<span onclick="ShowBasketItems(4);"><?=GetMessage("SALE_PRD_IN_BASKET_NOTA")?> (<?=$countItemsNotAvailable?>)</span>
			</li>
		<?}?>
	</ul>
<?$numCells = 0;?>
<table class="table-standart" style="margin-top: 20px;" rules="rows">
	<thead>
		<tr>
			<?if( in_array("NAME", $arParams["COLUMNS_LIST"]) ){?>
				<td></td>
				<td class="cart-item-name"><?= GetMessage("SALE_NAME")?></td>
				<?$numCells += 2;?>
			<?}?>
			<?if( in_array("VAT", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-vat"><?= GetMessage("SALE_VAT")?></td>
				<?$numCells++;?>
			<?}?>
			<?if( in_array("TYPE", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-type"><?= GetMessage("SALE_PRICE_TYPE")?></td>
				<?$numCells++;?>
			<?}?>
			<?if( in_array("DISCOUNT", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-discount"><?= GetMessage("SALE_DISCOUNT")?></td>
				<?$numCells++;?>
			<?}?>
			<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-weight"><?= GetMessage("SALE_WEIGHT")?></td>
				<?$numCells++;?>
			<?}?>
			<?if( in_array("QUANTITY", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-quantity"><?= GetMessage("SALE_QUANTITY")?></td>
				<?$numCells++;?>
			<?}?>
			<?if( in_array("PRICE", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-price"><?= GetMessage("SALE_PRICE")?></td>
				<?$numCells++;?>
			<?}?>
			<?if( in_array("DELAY", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-delay"></td>
				<?$numCells++;?>
			<?}?>
		</tr>
	</thead>
<?if(count($arResult["ITEMS"]["AnDelCanBuy"]) > 0){?>
	<tbody>
	<?$i=0;
	
	foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arBasketItems){?>
		<tr>
			<?if( in_array("NAME", $arParams["COLUMNS_LIST"]) ){?>
				<td class="basket-img">
					<?if( in_array("DELETE", $arParams["COLUMNS_LIST"]) ){?>
						<a class="deleteitem" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["delete"])?>" title="<?=GetMessage("SALE_DELETE_PRD")?>"></a>
					<?}?>
					<?if( strlen($arBasketItems["DETAIL_PAGE_URL"]) > 0 ){?>
						<a href="<?=$arBasketItems["DETAIL_PAGE_URL"]?>">
					<?}?>
					<?if( strlen($arBasketItems["DETAIL_PICTURE"]["SRC"]) > 0 ){?>
						<img src="<?=$arBasketItems["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arBasketItems["NAME"] ?>"/>
					<?}else{?>
						<img src="<?=SITE_TEMPLATE_PATH?>/img/noimage170.gif" alt="<?=$arBasketItems["NAME"] ?>"/>
					<?}?>
					<?if( strlen($arBasketItems["DETAIL_PAGE_URL"]) > 0 ){?>
						</a>
					<?}?>
				</td>
				<td class="cart-item-name">
					<?if( strlen($arBasketItems["DETAIL_PAGE_URL"]) > 0 ){?>
						<a href="<?=$arBasketItems["DETAIL_PAGE_URL"]?>">
					<?}?>
					<?=$arBasketItems["NAME"] ?>
					<?if( strlen($arBasketItems["DETAIL_PAGE_URL"]) > 0 ){?>
						</a>
					<?}?>
					<?if (in_array("PROPS", $arParams["COLUMNS_LIST"]))
					{
						foreach($arBasketItems["PROPS"] as $val)
						{
							echo "<br />".$val["NAME"].": ".$val["VALUE"];
						}
					}?>
				</td>
			<?}?>
			<?if( in_array("VAT", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-vat"><?=$arBasketItems["VAT_RATE_FORMATED"]?></td>
			<?}?>
			<?if( in_array("TYPE", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-type"><?=$arBasketItems["NOTES"]?></td>
			<?}?>
			
			<?if( in_array("DISCOUNT", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-discount">
					<?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?>
				</td>
			<?}?>
			<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ){?>
				<td><?=$arBasketItems["WEIGHT_FORMATED"]?></td>
			<?}?>	
			<?if( in_array("QUANTITY", $arParams["COLUMNS_LIST"]) ){?>			
				<td class="cart-item-quantity">
					<div class="counter_block">
						<input class="text" maxlength="18" type="text" name="QUANTITY_<?=$arBasketItems["ID"]?>" value="<?=$arBasketItems["QUANTITY"]?>" size="3" id="QUANTITY_<?=$arBasketItems["ID"]?>">
						<span class="plus">+</span>
						<span class="minus">-</span>
					</div>
				</td>
			<?}?>
			<?if( in_array("PRICE", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-price">
					<?if( (doubleval($arBasketItems["FULL_PRICE"]) > 0 ) && (doubleval($arBasketItems["FULL_PRICE"])!=$arBasketItems["PRICE"])){?>
						<div class="discount-price"><?=$arBasketItems["PRICE_FORMATED"]?></div>
						<div class="old-price"><?=$arBasketItems["FULL_PRICE_FORMATED"]?></div>
					<?}else{?>
						<div class="price"><?=$arBasketItems["PRICE_FORMATED"];?></div>
					<?}?>
				</td>
			<?}?>
			<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])){?>
				<td class="cart-item-delay"><a class="setaside" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["shelve"])?>"><?=GetMessage("SALE_OTLOG")?></a></td>
			<?}?>
		</tr>
		<?
		$i++;
	}
	?>
	</tbody>
</table>
<table class="table-standart">
	<tbody>
		<?if( $arParams["HIDE_COUPON"] != "Y" ){?>
			<tr>
				<td rowspan="5" class="tal">
					<input class="input_text_style"
					<?if( empty($arResult["COUPON"]) ){?>
						onclick="if (this.value=='<?=GetMessage("SALE_COUPON_VAL")?>')this.value=''; this.style.color='black'"
						onblur="if (this.value=='') {this.value='<?=GetMessage("SALE_COUPON_VAL")?>'; this.style.color='#a9a9a9'}"
						style="color:#a9a9a9"
					<?}?>
						value="<?if(!empty($arResult["COUPON"])):?><?=$arResult["COUPON"]?><?else:?><?=GetMessage("SALE_COUPON_VAL")?><?endif;?>"
						name="COUPON">
				</td>
			</tr>
		<?}?>
		<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ){?>
			<tr>
				<td><?echo GetMessage("SALE_ALL_WEIGHT")?>:</td>
				<td><?=$arResult["allWeight_FORMATED"]?></td>
			</tr>
		<?}?>
		<?if( doubleval($arResult["DISCOUNT_PRICE"]) > 0 ){?>
			<tr>
				<td><?echo GetMessage("SALE_CONTENT_DISCOUNT")?><?
					if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0)
						echo " (".$arResult["DISCOUNT_PERCENT_FORMATED"].")";?>:
				</td>
				<td><?=$arResult["DISCOUNT_PRICE_FORMATED"]?></td>
			</tr>
		<?}?>
		<?if( $arParams['PRICE_VAT_SHOW_VALUE'] == 'Y' ){?>
			<tr>
				<td><?echo GetMessage('SALE_VAT_EXCLUDED')?></td>
				<td><?=$arResult["allNOVATSum_FORMATED"]?></td>
			</tr>
			<tr>
				<td><?echo GetMessage('SALE_VAT_INCLUDED')?></td>
				<td><?=$arResult["allVATSum_FORMATED"]?></td>
			</tr>
		<?}?>
		<tr>
			<td><?= GetMessage("SALE_ITOGO")?>:</td>
			<td><?=$arResult["allSum_FORMATED"]?></td>
		</tr>
	</tbody>
</table>
<br/>
<table>
	<tr>
		<td style="padding:30px 2px;" class="tal"><button class="button2" type="submit" value="<?=GetMessage("SALE_UPDATE")?>" name="BasketRefresh" class="bt2"><span><?=GetMessage("SALE_UPDATE")?></span></button></td>
		<td style="padding:30px 2px;" class="tar"><button class="button2" type="submit" value="<?=GetMessage("SALE_ORDER")?>" name="BasketOrder"  id="basketOrderButton2" class="bt3"><span><?=GetMessage("SALE_ORDER")?></span></button></td>
	</tr>
</table>
<?}else{?>
	<tbody>
		<tr>
			<td colspan="<?=$numCells?>" style="text-align:center">
				<div class="cart-notetext"><?=GetMessage("SALE_NO_ACTIVE_PRD");?></div>
				<a href="<?=SITE_DIR?>" class="bt3"><?=GetMessage("SALE_NO_ACTIVE_PRD_START")?></a><br><br>
			</td>
		</tr>
	</tbody>
</table>
<?}?>
</div>
<?