<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<a class="jqmClose close" ></a>

<?if( $arResult["isFormErrors"] == "Y" ){?>
	<?=$arResult["FORM_ERRORS_TEXT"]?>
<?}?>

<?if( $arResult["isFormNote"] == "Y" ){?>
	<?=$arResult["FORM_NOTE"]?>
<?}else{?>
	
	<?if( $arResult["isFormTitle"] ){?>
		<div class="title"><?=$arResult["FORM_TITLE"]?></div>
	<?}?>
	
	<?=$arResult["FORM_HEADER"]?>
		
		<?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion){
			if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'){
				echo $arQuestion["HTML_CODE"];
			}else{?>
				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])){?>
					<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
				<?}?>
				
				<label><?=$arQuestion["CAPTION"]?></label><?if ($arQuestion["REQUIRED"] == "Y"){?><span class="starrequired">*</span><?}?>
				<?if( $arQuestion["REQUIRED"] == "Y" ){
					$html = str_replace('name=', 'required name=', $arQuestion["HTML_CODE"]);
					echo $html;
				}elseif( $arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "email" ){
					$html = str_replace('type="text"', 'type="email"', $arQuestion["HTML_CODE"]);
					echo $html;
				}else{?>
					<?=$arQuestion["HTML_CODE"]?>
				<?}?>
			<?}
		}?>
		<?if($arResult["isUseCaptcha"] == "Y"){?>
			<br />
			<label><?=GetMessage("CAPTCHA_LABEL")?><span class="starrequired">*</span></label><br />
			<input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
			<input type="text" required name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
		<?}?>
		<button class="button" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>"><span><?=GetMessage("IBLOCK_FORM_SUBMIT")?></span></button>
		<div class="promt">
			<span class="starrequired">*</span> - <?=GetMessage("IBLOCK_FORM_IMPORTANT")?>
		</div>
		
	<?=$arResult["FORM_FOOTER"]?>
<?}?>

<script>
	$('.popup').jqmAddClose('.jqmClose');
	$('input.phone').mask("+7999-999-99-99");
</script>