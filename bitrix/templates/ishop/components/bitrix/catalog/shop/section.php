<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
	CModule::IncludeModule("iblock");
	if ($arResult["VARIABLES"]["SECTION_ID"]>0)
	{
		$arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y', "ID" => $arResult["VARIABLES"]["SECTION_ID"]);
		$db_list = CIBlockSection::GetList(array(), $arFilter, true, array());
		while($section = $db_list->GetNext())
		{
			$res["NAME"] = $section["NAME"];
			$res["ID"] = $section["ID"];
			$res["PAGE"]["title"] = $section[$arParams["LIST_BROWSER_TITLE"]];
			$res["PAGE"]["keywords"] = $section[$arParams["LIST_META_KEYWORDS"]];
			$res["PAGE"]["description"] = $section[$arParams["LIST_META_DESCRIPTION"]];
		}
	}
	elseif(strlen(trim($arResult["VARIABLES"]["SECTION_CODE"]))>0)
	{
		$arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y', "=CODE" => $arResult["VARIABLES"]["SECTION_CODE"]);
		$db_list = CIBlockSection::GetList(array(), $arFilter, true, array());
		while($section = $db_list->GetNext())
		{
			$res["NAME"] = $section["NAME"];
			$res["ID"] = $section["ID"];
			$res["PAGE"]["title"] = $section[$arParams["LIST_BROWSER_TITLE"]];
			$res["PAGE"]["keywords"] = $section[$arParams["LIST_META_KEYWORDS"]];
			$res["PAGE"]["description"] = $section[$arParams["LIST_META_DESCRIPTION"]];
		}
	} 
	foreach($res["PAGE"] as $code => $value ) { if ($value) { $APPLICATION->SetPageProperty($code, $value); } else {unset($res["PAGE"][$code]);}}
	if($res["PAGE"]) 
	{
		global $SectionPageProperties;
		$SectionPageProperties = $res["PAGE"];
	}
?>

<h1 class="title"><?=$APPLICATION->ShowTitle();?></h1>

<?
	function get_section_path($section_id)
	{
		
		$nav = CIBlockSection::GetNavChain(IntVal($arParams["IBLOCK_ID"]), IntVal($section_id));
		$index = 100;
		while($ar = $nav->GetNext()){?><a href="<?=$ar["SECTION_PAGE_URL"]?>"><?=$ar["NAME"]?></a><span class="chain">&rarr;</span><?}	
	}
?>

<div class="breadcrumb">
	<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "shop", Array(
		"START_FROM" => "0",	
		"PATH" => "",
		"SITE_ID" => "",
		),
		false
	);?>
	<?get_section_path($res["ID"]);?>
</div>

<?
$count_sections = CIBlockSection::GetCount(array("SECTION_ID" => $res["ID"]));
$APPLICATION->SetTitle($res["NAME"]);


if( $count_sections > 0 ){?>
	<div class="container left shop">
		<div class="inner_left">
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"shop_groups",
				Array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
					"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
					"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
					"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
					"ADD_SECTIONS_CHAIN" => "N",
					"TOP_DEPTH" => "1",
				),
				$component
			);?>
		</div>
	</div>
	<div class="sideRight shop">
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"advt",
			Array(
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "N",
				"DISPLAY_PICTURE" => "N",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"AJAX_MODE" => "N",
				"IBLOCK_TYPE" => $arParams["IBLOCK_ADVT_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ADVT_ID"],
				"NEWS_COUNT" => "20",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_ORDER1" => "DESC",
				"SORT_BY2" => "SORT",
				"SORT_ORDER2" => "ASC",
				"FILTER_NAME" => "",
				"FIELD_CODE" => array(0=>"DETAIL_PICTURE",),
				"PROPERTY_CODE" => array(0=>"LINK",),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"SET_TITLE" => "N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => $arParams["IBLOCK_ADVT_SECTION_ID"],
				"PARENT_SECTION_CODE" => "",
				"CACHE_TYPE" => "N",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"PAGER_TITLE" => "",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N"
			)
		);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:sale.viewed.product",
			"shop",
			Array(
				"VIEWED_COUNT" => "2", 
				"VIEWED_NAME" => "Y",
				"VIEWED_IMAGE" => "Y",
				"VIEWED_PRICE" => "N",
				"VIEWED_CANBUY" => "N",
				"VIEWED_CANBUSKET" => "N",
				"VIEWED_IMG_HEIGHT" => "150",
				"VIEWED_IMG_WIDTH" => "150",
				"BASKET_URL" => SITE_DIR."basket/",
				"ACTION_VARIABLE" => "action",
				"PRODUCT_ID_VARIABLE" => "id",
				"SET_TITLE" => "N"
			)
		);?>
	</div>
<?}else{?>
	<div class="sideRight shop">
		<?$APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "shop", array(
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"SECTION_ID" => $res["ID"],
	"FILTER_NAME" => $arParams["FILTER_NAME"],
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"CACHE_GROUPS" => "N",
	"SAVE_IN_SESSION" => "N",
	"INSTANT_RELOAD" => "N",
	"PRICE_CODE" => array(
		0 => "BASE",
	)
	),
	false
);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"advt",
			Array(
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "N",
				"DISPLAY_PICTURE" => "N",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"AJAX_MODE" => "N",
				"IBLOCK_TYPE" => $arParams["IBLOCK_ADVT_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ADVT_ID"],
				"NEWS_COUNT" => "20",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_ORDER1" => "DESC",
				"SORT_BY2" => "SORT",
				"SORT_ORDER2" => "ASC",
				"FILTER_NAME" => "",
				"FIELD_CODE" => array(0=>"DETAIL_PICTURE",),
				"PROPERTY_CODE" => array(0=>"LINK",),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"SET_TITLE" => "N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => $arParams["IBLOCK_ADVT_SECTION_ID_SECT"],
				"PARENT_SECTION_CODE" => "",
				"CACHE_TYPE" => "N",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"PAGER_TITLE" => "",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N"
			)
		);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:sale.viewed.product",
			"shop",
			Array(
				"VIEWED_COUNT" => "2",
				"VIEWED_NAME" => "Y",
				"VIEWED_IMAGE" => "Y",
				"VIEWED_PRICE" => "N",
				"VIEWED_CANBUY" => "N",
				"VIEWED_CANBUSKET" => "N",
				"VIEWED_IMG_HEIGHT" => "150",
				"VIEWED_IMG_WIDTH" => "150",
				"BASKET_URL" => SITE_DIR."basket/",
				"ACTION_VARIABLE" => "action",
				"PRODUCT_ID_VARIABLE" => "id",
				"SET_TITLE" => "N"
			)
		);?>
	</div>
	<div class="container left">
		<div class="inner_left">
			<div class="sort_header">
				<!--noindex-->
					<?
						if (array_key_exists("display", $_REQUEST) || (array_key_exists("display", $_SESSION)) || $arParams["DEFAULT_LIST_TEMPLATE"])
						{
							if ($_REQUEST["display"]&&((trim($_REQUEST["display"])=="list")||(trim($_REQUEST["display"])=="table"))) 
							{$display=trim($_REQUEST["display"]);  $_SESSION["display"]=trim($_REQUEST["display"]);}
							elseif ($_SESSION["display"]&&(($_SESSION["display"]=="list")||($_SESSION["display"]=="table"))) 
							{$display=$_SESSION["display"];}
							else {$display=$arParams["DEFAULT_LIST_TEMPLATE"];}
						} else { $display = "list"; }
						$template = "shop_".$display;
					?>
					<div class="sort_filter">
						<?	$basePrice = CCatalogGroup::GetBaseGroup();
							$priceSort = "CATALOG_PRICE_".$basePrice["ID"];
							$arAvailableSort = array(
								"POPULARITY" => array("SHOW_COUNTER", "desc"),
								"NAME" => array("NAME", "asc"), 
								"PRICE" => array($priceSort, "asc")
							);
						$sort="POPULARITY";
						if ((array_key_exists("sort", $_REQUEST) && array_key_exists(ToUpper($_REQUEST["sort"]), $arAvailableSort)) || (array_key_exists("sort", $_SESSION) && array_key_exists(ToUpper($_SESSION["sort"]), $arAvailableSort)) || $arParams["ELEMENT_SORT_FIELD"])
						{
							if ($_REQUEST["sort"]) {$sort=ToUpper($_REQUEST["sort"]);  $_SESSION["sort"]=ToUpper($_REQUEST["sort"]);}
							elseif ($_SESSION["sort"]) {$sort=ToUpper($_SESSION["sort"]);}
							else {$sort=ToUpper($arParams["ELEMENT_SORT_FIELD"]);}
						}

						$sort_order=$arAvailableSort[$sort][1];
						if ((array_key_exists("order", $_REQUEST) && in_array(ToLower($_REQUEST["order"]), Array("asc", "desc")) ) || (array_key_exists("order", $_REQUEST) && in_array(ToLower($_REQUEST["order"]), Array("asc", "desc")) ) || $arParams["ELEMENT_SORT_ORDER"])
						{
							if ($_REQUEST["order"]) {$sort_order=$_REQUEST["order"]; $_SESSION["order"]=$_REQUEST["order"];}
							elseif ($_SESSION["order"]) {$sort_order=$_SESSION["order"];}
							else {$sort_order=ToLower($arParams["ELEMENT_SORT_ORDER"]);}
						}
						foreach ($arAvailableSort as $key => $val){
							$newSort = $sort_order == 'desc' ? 'asc' : 'desc';?>
							<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam('sort='.$key.'&order='.$newSort, 	array('sort', 'order', 'mode'))?>" class="button_middle <?=$sort == $key ? 'current' : ''?> <?=$sort_order?> <?=$key?>" rel="nofollow">
								<i></i><span><?=GetMessage('SECT_SORT_'.$key)?></span>
							</a>
						<?}?>
					</div>
					
					<div class="sort_display">
						<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam('display=list', 	array('display', 'mode'))?>" class="button_middle list <?=$display == 'list' ? 'current' : '';?>"><i></i><span><?=GetMessage("SECT_DISPLAY_LIST")?></span></a>
						<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam('display=table', 	array('display', 'mode'))?>" class="button_middle table <?=$display == 'table' ? 'current' : '';?>"><i></i><span><?=GetMessage("SECT_DISPLAY_TABLE")?></span></a>
					</div>
					
					
					<div class="compare" id="compare">
						<?$APPLICATION->IncludeComponent(
							"bitrix:catalog.compare.list",
							"preview",
							Array(
								"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
								"IBLOCK_ID" => $arParams["IBLOCK_ID"],
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
								"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
								"NAME" => "CATALOG_COMPARE_LIST",
								"AJAX_OPTION_ADDITIONAL" => ""
							)
						);?>
					</div>
					
					
				<!--/noindex-->
			</div>
			
	

			<?
				$show=$arParams["PAGE_ELEMENT_COUNT"];
				if (array_key_exists("show", $_REQUEST))
				{
					if ( intVal($_REQUEST["show"]) && in_array(intVal($_REQUEST["show"]), array(20, 40, 60, 80, 100)) ) {$show=intVal($_REQUEST["show"]); $_SESSION["show"] = $show;}
					elseif ($_SESSION["show"]) {$show=intVal($_SESSION["show"]);}
				}
				if ($sort=="PRICE") {$sort = $arAvailableSort["PRICE"][0];} 
			?>	
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section",
				$template,
				Array(
					"SEF_URL_TEMPLATES" => $arParams["SEF_URL_TEMPLATES"],
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
					"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
					"ELEMENT_SORT_FIELD" => $sort,
					"ELEMENT_SORT_ORDER" => $sort_order,
					"FILTER_NAME" => $arParams["FILTER_NAME"],
					"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
					"PAGE_ELEMENT_COUNT" => $show,
					"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
					"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
					"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
					"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
					"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
					"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
					"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
					"BASKET_URL" => $arParams["BASKET_URL"],
					"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
					"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
					"PRODUCT_QUANTITY_VARIABLE" => "quantity",
					"PRODUCT_PROPS_VARIABLE" => "prop",
					"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
					"AJAX_MODE" => $arParams["AJAX_MODE"],
					"AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
					"AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
					"AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
					"CACHE_TYPE" =>$arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
					"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
					"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
					"ADD_SECTIONS_CHAIN" => "N",
					"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
					"SET_TITLE" => $arParams["SET_TITLE"],
					"SET_STATUS_404" => $arParams["SET_STATUS_404"],
					"CACHE_FILTER" => $arParams["CACHE_FILTER"],
					"PRICE_CODE" => $arParams["PRICE_CODE"],
					"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
					"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
					"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
					"USE_PRODUCT_QUANTITY" => $arParams["SET_STATUS_404"],
					"OFFERS_CART_PROPERTIES" => array(),
					"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
					"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
					"PAGER_TITLE" => $arParams["PAGER_TITLE"],
					"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
					"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
					"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
					"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
					"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
					"AJAX_OPTION_ADDITIONAL" => "",
					"ADD_CHAIN_ITEM" => "N",
					"SHOW_QUANTITY" => $arParams["SHOW_QUANTITY"],
					"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
					"CURRENCY_ID" => $arParams["CURRENCY_ID"]
				),
			$component
			);?>
		</div>
	</div>
	
<?}?>
<div style="clear: both"></div>

<?
	$rsBasket = CSaleBasket::GetList(	array( "NAME" => "ASC", "ID" => "ASC"   ),
										array(  "FUSER_ID" => CSaleBasket::GetBasketUserID(),  "LID" => SITE_ID, "ORDER_ID" => "NULL", "CAN_BUY" => "Y",  "DELAY" => "N",  "SUBSCRIBE" => "N" ),
										false, false, array("ID", "PRODUCT_ID", "QUANTITY") ); 
	while( $arBasket = $rsBasket->GetNext() )
	{
		if( $arBasket["DELAY"] == "Y" ){ $delay_items[] = $arBasket["PRODUCT_ID"];}
		else{$basket_items[] = $arBasket["PRODUCT_ID"];}
	}
	global $compare_items;
?>
<script>
	$(document).ready(function(){
		<?foreach( $delay_items as $item_id ){?>
			$('a.wish_item[href^=#<?=$item_id?>]').addClass('active');
		<?}?>
		$('a.added').hide();
		<?foreach( $basket_items as $item_id ){?>
			$('a.add_item[element_id^=#<?=$item_id?>]').addClass("added").removeAttr("onclick").attr("href", "<?=SITE_DIR?>basket/").find("span").text("<?=GetMessage('CATALOG_IN_CART');?>");
			$('.counter_block[element_id^=#<?=$item_id?>]').remove();
			$('.equipment .buy_link a[element_id^=#<?=$item_id?>]').addClass("added").removeAttr("onclick").attr("href", "<?=SITE_DIR?>basket/").text("<?=GetMessage('CATALOG_IN_CART');?>");
			
		<?}?>
		<?foreach( $compare_items as $item_id ){?>
			$('a.compare_item[element_id^=#<?=$item_id?>]').addClass('active');
		<?}?>
	})
</script>