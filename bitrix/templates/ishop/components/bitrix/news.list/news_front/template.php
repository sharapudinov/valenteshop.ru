<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news_block">
	<div class="title">
		<a href="<?=$arResult["LANG_DIR"]?>company/news/"><?=GetMessage('NEWS_TITLE')?></a>
	</div>
	<ul>
		<?foreach($arResult["ITEMS"] as $arItem){
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
				<a class="name" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
				<?=$arItem['~PREVIEW_TEXT'];?>
			</li>
		<?}?>
	</ul>
</div>