<?	
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");
	global $first_tab;
?>
	<?if (($arParams["SHOW_ASK_BLOCK"]=="Y")&&(intVal($arParams["ASK_FORM_ID"]))):?>
			<div class="box" <? echo $first_tab==5?'style="display: block;"':''; ?>>
				 <?$APPLICATION->IncludeFile("/include/ask_description.php", Array(), Array( "MODE" => "html") );?>
				 <?$APPLICATION->IncludeComponent(
					"bitrix:form",
					"shop_main",
					Array(
						"AJAX_MODE" => "Y",
						"SEF_MODE" => "N",
						"WEB_FORM_ID" => $arParams["ASK_FORM_ID"],
						"RESULT_ID" => "",
						"START_PAGE" => "new",
						"SHOW_LIST_PAGE" => "N",
						"SHOW_EDIT_PAGE" => "N",
						"SHOW_VIEW_PAGE" => "N",
						"SUCCESS_URL" => "",
						"SHOW_ANSWER_VALUE" => "N",
						"SHOW_ADDITIONAL" => "N",
						"SHOW_STATUS" => "N",
						"EDIT_ADDITIONAL" => "N",
						"EDIT_STATUS" => "N",
						"NOT_SHOW_FILTER" => "",
						"NOT_SHOW_TABLE" => "",
						"CHAIN_ITEM_TEXT" => "",
						"CHAIN_ITEM_LINK" => "",
						"IGNORE_CUSTOM_TEMPLATE" => "N",
						"USE_EXTENDED_ERRORS" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"VARIABLE_ALIASES" => Array(
							"action" => "action"
						)
					)
				);?>
			</div>
	<?endif;?>
	<?if ($arParams["USE_REVIEW"]=="Y"):?>
		<div class="box" <? echo $first_tab==6?'style="display: block;"':''; ?>>
			<?$APPLICATION->IncludeComponent(
				"bitrix:forum.topic.reviews",
				"element_reviews",
				Array(
					"CACHE_TYPE" => "N",
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
					"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
					"FORUM_ID" => $arParams["FORUM_ID"],
					"ELEMENT_ID" => $arResult["ID"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"AJAX_POST" => "N",
					"SHOW_RATING" => "N",
					"SHOW_MINIMIZED" => "Y",
					"SECTION_REVIEW" => "Y",
					"POST_FIRST_MESSAGE" => "Y",
					"MINIMIZED_MINIMIZE_TEXT" => GetMessage("HIDE_FORM"),
					"MINIMIZED_EXPAND_TEXT" => GetMessage("ADD_REVIEW"),
					"SHOW_AVATAR" => "N",
					"SHOW_LINK_TO_FORUM" => "N",
					"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
				),	false
			);?>
		</div>
	<?endif;?>	
</div>

<table width="100%" class="share"><tr><td>
	<?$APPLICATION->IncludeFile(SITE_DIR."include/social_button.php", Array(), Array("MODE" => "html", "NAME" => GetMessage('CT_BCE_CATALOG_SOC_BUTTON'),));?>	
</td><td>
	<?$APPLICATION->IncludeFile(SITE_DIR."include/item_description.php", Array(), Array("MODE" => "html", "NAME" => GetMessage('CT_BCE_CATALOG_DROP_DESCR'),));?>
</td></tr></table>

	</div>
</div>

<div id="compare_content">
	<?$APPLICATION->IncludeComponent("bitrix:catalog.compare.list", "preview", array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"DETAIL_URL" => SITE_DIR."catalog/#ELEMENT_CODE#/",
		"COMPARE_URL" => SITE_DIR."catalog/compare.php?action=#ACTION_CODE#",
		"NAME" => "CATALOG_COMPARE_LIST",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE"=>"N"
		),
		false
	);?>
</div>
<script>
	$(document).ready(function()
	{		
		$(".inner_left div.box").first().show();
		if ($("#compare").length)
		{
			$("#compare").html($("#compare_content").html());
			$("#compare_content").empty();
		}
	});
</script>

