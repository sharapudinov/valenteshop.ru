<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["CATEGORIES"])):?>
	<table class="title-search-result">
		<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
			<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
			<tr>
				<?if($category_id === "all"):?>
					<td class="title-search-all" colspan="<?=($arParams["SHOW_PREVIEW"]=="Y") ? '3' : '2'?>" >
						<a href="<?=$arItem["URL"]?>"><span class="text"><?=$arItem["NAME"]?></span><span class="icon"><i></i></span></a>
					</td>
				<?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
					$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];
				?>
					<?if ($arParams["SHOW_PREVIEW"]=="Y"):?>
						<td class="picture">
							<?if (is_array($arElement["PICTURE"])):?>
								<img class="item_preview" align="left" src="<?=$arElement["PICTURE"]["src"]?>" width="<?=$arElement["PICTURE"]["width"]?>" height="<?=$arElement["PICTURE"]["height"]?>">
							<?endif;?>
						</td>
					<?endif;?>
					<td class="main">
						<div class="item-text">
							<a href="<?=$arItem["URL"]?>"><?=$arItem["NAME"]?></a>
							<?if ($arParams["SHOW_ANOUNCE"]=="Y"):?><p class="title-search-preview"><?=$arElement["PREVIEW_TEXT"];?></p><?endif;?>
						</div>
					</td>
					<td class="price">
						<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
							<?if($arPrice["CAN_ACCESS"]):?>
								<p class="title-search-price">
									<?if (count($arElement["PRICES"])>1):?><?=$arResult["PRICES"][$code]["TITLE"];?>:&nbsp;<?endif;?>
								<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
									<s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
								<?else:?><span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span><?endif;?>
								</p>
							<?endif;?>
						<?endforeach;?>
					</td>
				<?elseif(isset($arItem["ICON"])):?>
					<td class="main" colspan="<?=($arParams["SHOW_PREVIEW"]=="Y") ? '3' : '2'?>">
						<div class="item-text">
							<a href="<?=$arItem["URL"]?>"><?=$arItem["NAME"]?></a>
						</div>
					</td>
				<?endif;?>
			</tr>
			<?endforeach;?>
		<?endforeach;?>
	</table>
<?endif;?>
