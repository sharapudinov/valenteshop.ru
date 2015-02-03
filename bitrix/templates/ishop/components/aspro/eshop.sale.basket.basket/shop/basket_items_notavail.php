<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="cart-items" id="id-na-list" style="display:none;">
	<ul class="tabs">
		<li>
			<span onclick="ShowBasketItems(1);"><?=GetMessage("SALE_PRD_IN_BASKET_ACT")?> (<?=count($arResult["ITEMS"]["AnDelCanBuy"])?>)</span>
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
			<li class="current">
				<span><?=GetMessage("SALE_PRD_IN_BASKET_NOTA")?></span>
			</li>
		<?}?>
	</ul>
	<?if( count($arResult["ITEMS"]["nAnCanBuy"]) > 0 ){?>
		<table class="table-standart" rules="rows" style="margin-top: 20px;">
			<thead>
				<tr>
					<?if( in_array("NAME", $arParams["COLUMNS_LIST"]) ){?>
						<td></td>
						<td class="cart-item-name"><?= GetMessage("SALE_NAME")?></td>
					<?}?>
					<?if( in_array("TYPE", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-type"><?= GetMessage("SALE_PRICE_TYPE")?></td>
					<?}?>
					<?if( in_array("DISCOUNT", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-discount"><?= GetMessage("SALE_DISCOUNT")?></td>
					<?}?>
					<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-weight"><?= GetMessage("SALE_WEIGHT")?></td>
					<?}?>
					<?if( in_array("QUANTITY", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-quantity"><?= GetMessage("SALE_QUANTITY")?></td>
					<?}?>
					<?if( in_array("PRICE", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-price"><?= GetMessage("SALE_PRICE")?></td>
					<?}?>
				</tr>
			</thead>
			<tbody>
				<?foreach($arResult["ITEMS"]["nAnCanBuy"] as $arBasketItems){?>
					<tr>
						<td class="basket-img">
							<?if( in_array("DELETE", $arParams["COLUMNS_LIST"]) ){?>
								<a class="deleteitem" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["delete"])?>" onclick="return DeleteFromCart(this);" title="<?=GetMessage("SALE_DELETE_PRD")?>"></a>
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

						<?if( in_array("NAME", $arParams["COLUMNS_LIST"]) ){?>
							<td class="cart-item-name"><?if( strlen($arBasketItems["DETAIL_PAGE_URL"]) > 0 ){?>
									<a href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>">
								<?}?>
								<?=$arBasketItems["NAME"] ?>
								<?if( strlen($arBasketItems["DETAIL_PAGE_URL"]) > 0 ){?>
									</a>
								<?}?>
								<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])){
									foreach($arBasketItems["PROPS"] as $val){
										echo "<br />".$val["NAME"].": ".$val["VALUE"];
									}
								}?>
							</td>
						<?}?>	
						<?if( in_array("TYPE", $arParams["COLUMNS_LIST"]) ){?>
							<td class="cart-item-type"><?=$arBasketItems["NOTES"]?></td>
						<?}?>
						<?if( in_array("DISCOUNT", $arParams["COLUMNS_LIST"]) ){?>
							<td class="cart-item-discount"><?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></td>
						<?}?>
						<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ){?>
							<td class="cart-item-weight"><?=$arBasketItems["WEIGHT_FORMATED"]?></td>
						<?}?>
						<?if( in_array("QUANTITY", $arParams["COLUMNS_LIST"]) ){?>
							<td class="cart-item-quantity"><?=$arBasketItems["QUANTITY"]?></td>
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
					</tr>
				<?}?>
			</tbody>
		</table>
	<?}?>
</div>