<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if( $arResult["NavPageCount"] != 1 && $arResult["bShowAll"] == '' ):?>
	<?
		$count_item = 5; //  оличество выводимых страниц по бокам
		$arResult["nStartPage"] = $arResult["NavPageNomer"] - $count_item;
		$arResult["nStartPage"] = $arResult["nStartPage"] <= 0 ? 1 : $arResult["nStartPage"];
		
		$arResult["nEndPage"] = $arResult["NavPageNomer"] + $count_item;
		$arResult["nEndPage"] = $arResult["nEndPage"] > $arResult["NavPageCount"] ? $arResult["NavPageCount"] : $arResult["nEndPage"];
		
		$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
		$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
	?>
	
	<div class="pagination">
		<?if( $arResult["NavPageNomer"] > 1 ):?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="arrow left"></a>
		<?endif;?>
		<?if( $arResult["nStartPage"] > 1 ):
			echo "<span class='point big'></span>";
		endif;
		while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

			<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
				<a href="#" class="cur"><?=$arResult["nStartPage"]?></a>
			<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
				<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
			<?else:?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
			<?endif;
			$arResult["nStartPage"]++;
			
		endwhile;
		if( $arResult["nEndPage"] < $arResult["NavPageCount"] ):
			echo "<span class='point big'></span>";
		endif;?>
		<?if( $arResult["NavPageNomer"] < $arResult["NavPageCount"] ):?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="arrow right"></a>
		<?endif;?>
	</div>
<?endif;?>