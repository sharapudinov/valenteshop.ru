<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="catalog_section_list">
	<?foreach( $arResult["SECTIONS"] as $arItems ){?>
		<div class="section_item">
			<div class="section_item_inner">
				<ul>
					<li class="name">
						<a href="<?=$arItems["SECTION_PAGE_URL"]?>"><?=$arItems["NAME"]?><? echo $arItems["ELEMENT_CNT"]?'&nbsp;('.$arItems["ELEMENT_CNT"].')':'';?></a> 
					</li>

					<?foreach( $arItems["SECTIONS"] as $arItem ){?>
						<li class="sect"><a href="<?=$arItem["SECTION_PAGE_URL"]?>"><?=$arItem["NAME"]?><? echo $arItem["ELEMENT_CNT"]?'&nbsp;('.$arItem["ELEMENT_CNT"].')':'';?></a></li>
					<?}?>
					<li class="desc">
						<?=$arItems["DESCRIPTION"]?>
					</li>
				</ul>
			</div>
		</div>
	<?}?>
</div>
