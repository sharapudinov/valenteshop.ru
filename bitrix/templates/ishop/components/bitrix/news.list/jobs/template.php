<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="item_jobs_wrapp">
	<?foreach($arResult["ITEMS"] as $key => $arItem){
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="item_jobs" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="name">
				<a <?if ($key==0):?>class="opened"<?endif;?>><span><?=$arItem['NAME']?></span><i class="barr"></i></a>
				<?if ($arItem["DISPLAY_PROPERTIES"]["SALARY"]):?>
					<div class="salary-block">
						<div></div>
						<span><?=GetMessage("SALARY");?> <?=number_format($arItem["DISPLAY_PROPERTIES"]["SALARY"]["VALUE"], 0, "", " ");?></span>
					</div>
				<?endif;?>
			</div>
			<div class="description" <?if ($key==0):?>style="display: block;"<?endif;?>>
				<?if ($arItem['PREVIEW_TEXT']):?>
					<div class="description_text"><?=$arItem['PREVIEW_TEXT']?></div>
				<?endif;?>
				<?if ($arItem['DETAIL_TEXT']): ?>
					<div class="description_text"><?=$arItem['DETAIL_TEXT']?></div>
				<?endif;?>
				<a href="#" class="button resume_send" jobs="<?=$arItem['NAME']?>">
					<span><?=GetMessage('SEND_RESUME')?></span>
				</a>
			</div>
		</div>
	<?}?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]){?>
		<?=$arResult["NAV_STRING"]?>
	<?}?>
</div>
<script> $(document).ready(function() { $(".item_jobs a").click(function(){ $(this).toggleClass('opened').parents(".name").next().toggle(); }); });</script>