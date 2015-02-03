<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>

<?if (!empty($arResult)){?>
	<div class="left_menu">
		<ul>
			<?foreach($arResult as $arItem){
				if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
					continue;?>
				<?if($arItem["SELECTED"]){?>
			<li class="current"><a href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a></li>
				<?}else{?>
					<li><a href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a></li>
				<?}
			}?>
		</ul>
	</div>
	
<?}?>