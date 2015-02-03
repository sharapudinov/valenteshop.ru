<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="brands_list_ws">
	<div class="brands_list">
		<ul>
			<?foreach($arResult["ITEMS"] as $arItem){?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<?if( is_array($arItem["PREVIEW_PICTURE"]) ){?>
					<li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
							<img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						</a>
					</li>
				<?}?>
			<?}?>
		</ul>
	</div>
</div>