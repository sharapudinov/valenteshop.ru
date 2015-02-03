<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div>
	<div class="title"><?=GetMessage('FORM_HEADER_CAPTION')?></div>
	<a class="jqmClose close"></a>
	<form method="post" id="one_click_buy_form" action="<?=$arResult['SCRIPT_PATH']?>/script.php">
			<?foreach($arParams['PROPERTIES'] as $field):?>				
				<?if ($USER->IsAuthorized()){ if ($field=='EMAIL') $value = $USER->GetEmail(); elseif ($field=='USER_NAME') $value = $USER->GetFullName(); elseif ($field=='PHONE') $value = $arResult['USER_PHONE']; } ?>
				<label class="description"><?=GetMessage('CAPTION_'.$field)?><?if (in_array($field, $arParams['REQUIRED'])):?><span class="starrequired">*</span><?endif;?></label>
				<?if ($field=="COMMENT"):?><textarea name="ONE_CLICK_BUY[<?=$field?>]" id="one_click_buy_id_<?=$field?>"></textarea>
				<?else:?><input type="text" name="ONE_CLICK_BUY[<?=$field?>]" value="<?=$value?>" id="one_click_buy_id_<?=$field?>" /><?endif;?>
			<?endforeach;?>
			<?if ($arParams['USE_SKU']=="Y"):?>
				<input type="hidden" name="IBLOCK_ID" value="<?=$arParams['IBLOCK_ID']?>" />
				<input type="hidden" name="USE_SKU" value="Y" />
				<input type="hidden" name="SKU_CODES" value="<?=$arResult['SKU_PROPERTIES_STRING']?>" />
				<label><?=GetMessage('CAPTION_SKU_SELECT')?></label>
				<select name="PRODUCT_ID"><?foreach($arResult['OFFERS'] as $id => $offer_data):?><option value="<?=$id?>"><?=$offer_data?></option><?endforeach;?></select>
			<?endif;?>
			<button class="button" type="submit" id="one_click_buy_form_button" name="one_click_buy_form_button" value="<?=GetMessage('ORDER_BUTTON_CAPTION')?>"><span><?=GetMessage("ORDER_BUTTON_CAPTION")?></span></button>
			<div class="promt"><span class="starrequired">*</span> - <?=GetMessage("IBLOCK_FORM_IMPORTANT");?></div>
			<? if ($arParams['USE_SKU']!="Y"):?><input type="hidden" name="PRODUCT_ID" value="<?=$arParams['ELEMENT_ID']?>" /><?endif;?>
			<input type="hidden" name="CURRENCY" value="<?=$arParams['DEFAULT_CURRENCY']?>" />
			<input type="hidden" name="PRICE_ID" value="<?=$arParams['PRICE_ID']?>" />
			<input type="hidden" name="PAY_SYSTEM_ID" value="<?=$arParams['DEFAULT_PAYMENT']?>" />
			<input type="hidden" name="DELIVERY_ID" value="<?=$arParams['DEFAULT_DELIVERY']?>" />
			<input type="hidden" name="PERSON_TYPE_ID" value="<?=$arParams['DEFAULT_PERSON_TYPE']?>" />
			<?=bitrix_sessid_post()?>	
	</form>
	<div class="one_click_buy_result" id="one_click_buy_result">
		<div class="one_click_buy_result_success"><?=GetMessage('ORDER_SUCCESS')?></div>
		<div class="one_click_buy_result_fail"><?=GetMessage('ORDER_ERROR')?></div>
		<div class="one_click_buy_result_text"><?=GetMessage('ORDER_SUCCESS_TEXT')?></div>
	</div>
</div>
<script>
	$('#one_click_buy_form').validate({  rules: 
	{
		<?if (in_array("PHONE", $arParams['REQUIRED'])):?>"ONE_CLICK_BUY[PHONE]": {required : true},	<?endif;?>
		<?if (in_array("USER_NAME", $arParams['REQUIRED'])):?>"ONE_CLICK_BUY[USER_NAME]": {required : true},	<?endif;?>
	} 
	});
	$('.popup').jqmAddClose('.jqmClose');
	$('#one_click_buy_id_PHONE').mask("+7 999-999-99-99");
</script>
