<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>

<?foreach( $arResult as $arItem ){?>
	<ul>
		<li class="menu_title"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
		<?foreach( $arItem["ITEMS"] as $arSubItem ){?>
			<li><a href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?></a></li>
		<?}?>
	</ul>
<?}?>