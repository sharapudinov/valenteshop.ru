<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");?>

<?if($arParams["USE_REVIEW"]=="Y" && IsModuleInstalled("forum") && $arResult["ID"]):?>
	<div id="reviews_content">
		<?$APPLICATION->IncludeComponent(
			"bitrix:forum.topic.reviews",
			"element_reviews",
			Array(
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
				"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
				"FORUM_ID" => $arParams["FORUM_ID"],
				"ELEMENT_ID" => $arResult["ID"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
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
	<script>
		$(document).ready(function()
		{
			$("#product_reviews").html($("#reviews_content").html());
			$("#reviews_content").empty();
		});
	</script>
<?endif?>