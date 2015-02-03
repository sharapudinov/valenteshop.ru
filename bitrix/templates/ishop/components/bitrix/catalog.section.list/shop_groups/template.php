<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>


	<?$i = 1;
	foreach($arResult["SECTIONS"] as $arSection){
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="table_item item_ws "><?/*print_r($arSection);*/?>
		<div class="table_item_inner">
        <?if(strlen($arSection["PICTURE"]["ID"]) > "0"){?>
		<?$img = CFile::ResizeImageGet($arSection["PICTURE"]["ID"], array('width'=>120, 'height'=>100), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
		<??>
			<a class="home_section_img_box" href="<?=$arSection["SECTION_PAGE_URL"]?>"><img class="home_section_img" width="<?=$img["width"]?>"  src='<?=$img["src"]?>' alt='<?echo $arSection["NAME"];?>' title='<?echo $arSection["NAME"];?>' /></a>
		<?}else{?>
            <a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img style="border-radius: 5px;display:block;margin:0 auto;" src="/noimage170.gif" width="120" /></a>
        <?}?>
          <div class="table_item_href"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?echo $arSection["NAME"];?></a></div>					
		</div>
	</div>
		<?if( $i % 4 == 0 ){?>
			<div style="clear: both; width: 100%; border-bottom: 1px dotted grey;"></div>
		<?}?>
	<?$i++;
	}?>
 <?$GLOBALS["iii"] = $i;
$GLOBALS["DESCRIPTION"] = $arResult["SECTION"]["DESCRIPTION"];
$title = $arResult["SECTION"]["NAME"]." - каталог продукции, цены | Интернет-магазин ValenteShop.ru";
$keywords = "Каталог, ".$arResult["SECTION"]["NAME"].".";
$description = "Интернет-магазин ValenteShop продаёт качественные ".$arResult["SECTION"]["NAME"]." для ванных комнат. Доставка по Москве и МО.";
$APPLICATION->SetPageProperty("title", $title);
$APPLICATION->SetPageProperty("keywords", $keywords);
$APPLICATION->SetPageProperty("description", $description);
 ?>