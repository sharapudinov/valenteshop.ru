<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>

<?if (count($arResult) > 0){?>
	<div class="view-list">
		<div class="view-header"><?=GetMessage("VIEW_HEADER");?></div>
		<?foreach( $arResult as $key => $arItem ){?>
			<div class="view-item <?if(!$arResult[$key+1]):?> last<?endif;?>">
				<?if( $arParams["VIEWED_IMAGE"]=="Y" && is_array($arItem["PICTURE"]) ){?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PICTURE"]["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"></a>
				<?}?>
				<?if( $arParams["VIEWED_NAME"]=="Y" ){?>
					<div><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>
				<?}?>
				<?if( $arParams["VIEWED_PRICE"]=="Y" && $arItem["CAN_BUY"]=="Y" ){?>
					<div><?=$arItem["PRICE_FORMATED"]?></div>
				<?}?>
				<!--noindex-->
					<?if( $arParams["VIEWED_CANBUY"]=="Y" && $arItem["CAN_BUY"]=="Y" ){?>
						<a rel="nofollow" href="<?=$arItem["BUY_URL"]?>"><?=GetMessage("PRODUCT_BUY")?></a>
					<?}?>
					<?if( $arParams["VIEWED_CANBUSKET"]=="Y" && $arItem["CAN_BUY"]=="Y" ){?>
						<a rel="nofollow" href="<?=$arItem["ADD_URL"]?>"><?=GetMessage("PRODUCT_BUSKET")?></a>
					<?}?>
				<!--/noindex-->
			</div>
		<?}?>
	</div>
<?}?>
