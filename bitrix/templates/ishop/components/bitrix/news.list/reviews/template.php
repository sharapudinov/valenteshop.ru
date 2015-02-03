<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach($arResult["ITEMS"] as $arItem){?>
	<div class="comemts_wr">
		<div class="row">
			<div class="name_wr">
				<?=$arItem["PROPERTIES"]["NAME"]["VALUE"]?>
				<div class="date_comment"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
			</div>
			<div class="rating big">
			<?$val = $arItem["PROPERTIES"]["RATING"]["VALUE_ENUM_ID"] - 64;?>
				<?for( $i = 0; $i < $val; $i++ ){?>
					<span class="a"></span>
				<?}?>
				<?for( ; $i < 5; $i++ ){?>
					<span class=""></span>
				<?}?>
			</div>
		</div>
		<?if( !empty( $arItem["PROPERTIES"]["MERITS"]["VALUE"]["TEXT"] ) ){?>
			<h4><?=GetMessage('MERITS')?></h4>
			<p><?=$arItem["PROPERTIES"]["MERITS"]["VALUE"]["TEXT"]?></p>
		<?}?>
		<?if( !empty( $arItem["PROPERTIES"]["DEFECTS"]["VALUE"]["TEXT"] ) ){?>
			<h4><?=GetMessage('DEFECTS')?></h4>
			<p><?=$arItem["PROPERTIES"]["DEFECTS"]["VALUE"]["TEXT"]?></p>
		<?}?>
		<?if( !empty( $arItem["PROPERTIES"]["COMMENT"]["VALUE"]["TEXT"] ) ){?>
			<h4><?=GetMessage('COMMENT')?></h4>
			<p><?=$arItem["PROPERTIES"]["COMMENT"]["VALUE"]["TEXT"]?></p>
		<?}?>
	</div>
<?}?>