<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arParams["DISPLAY_TOP_PAGER"]=="Y"):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<div class="staff_wrapp">
	<?foreach( $arResult["SECTIONS"] as $key => $arSection ):?>
	<div class="section_title"><a <?if ($key==0):?>class="opened"<?endif;?>><span><?=$arSection["NAME"];?></span><i class="barr"></i></a></div>
	<div class="section_items" <?if ($key==0):?>style="display: block;"<?endif;?>>
			<?foreach ($arSection["ITEMS"] as $key => $arItem):?>
				<?	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="staff_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<?if( !empty( $arItem["PREVIEW_PICTURE"] ) ){?>
						<div class="image">
							<?$img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array( "width" => 155, "height" => 165 ), BX_RESIZE_IMAGE_PROPORTIONAL );?>
							<img src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" border="0" />
						</div>
					<?}elseif( !empty( $arItem["DETAIL_PICTURE"] ) ){?>
						<div class="image">
							<?$img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array( "width" => 155, "height" => 165 ), BX_RESIZE_IMAGE_PROPORTIONAL );?>
							<img src="<?=$img["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" border="0" />
						</div>
					<?}?>
					<div class="info<?if(empty( $arItem["PREVIEW_PICTURE"] )):?> no-image<?endif;?>">
						<div class="name">
							<?=$arItem["NAME"]?>
						</div>
						<div class="post">
							<?=$arItem["PROPERTIES"]["POST"]["VALUE"]?>
						</div>
						<div class="contacts">
							<div class="phone"><span><?=GetMessage('PHONE')?></span><?=$arItem["PROPERTIES"]["PHONE"]["VALUE"]?></div>
							<div class="email"><span><?=GetMessage('EMAIL')?></span><a href="mailto:<?=$arItem["PROPERTIES"]["EMAIL"]["VALUE"]?>"><?=$arItem["PROPERTIES"]["EMAIL"]["VALUE"]?></a></div>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	<?endforeach;?>
</div>
<?if ($arParams["DISPLAY_BOTTOM_PAGER"]=="Y"):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

<script> $(document).ready(function() { $(".section_title a").click(function(){ $(this).toggleClass('opened').parents(".section_title").next().toggle(); }); });</script>