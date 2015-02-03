<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>



<?if( $arResult["isFormErrors"] == "Y" ){?>
	<br /><?=$arResult["FORM_ERRORS_TEXT"]?>
<?}?>

<?if( $arResult["isFormNote"] == "Y" ){?>
	<br /><?=$arResult["FORM_NOTE"]?>
<?}else{?>
	

	<?$html = str_replace('name=', 'class="ishop faq" name=', $arResult["FORM_HEADER"]);?>
	<?=$html?>
		<blockquote>
			<?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion){
				if( $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden' ){
					echo $arQuestion["HTML_CODE"];
				}
			}?>
			
			<div class="left_inputs">
				<?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion){
					if( $arQuestion["STRUCTURE"][0]["FIELD_PARAM"] == 'class="right"' ){ continue; }
					if( $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] != 'hidden' ){?>
						<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])){?>
							<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
						<?}?>
						
						<label><?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"){?><span class="starrequired">*</span><?}?></label>
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
			</div>
			<div class="right_inputs">
				<?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion){
					if( $arQuestion["STRUCTURE"][0]["FIELD_PARAM"] != 'class="right"' ){ continue; }
					if( $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] != 'hidden' ){?>
						<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])){?>
							<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
						<?}?>
						
						<label><?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"){?><span class="starrequired">*</span><?}?></label>
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
					<label><?=GetMessage("CAPTCHA_LABEL")?><span class="starrequired">*</span></label>
					<input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
					<input type="text" required name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
				<?}?>
			</div>
			<div class="button_block">
				<button class="button" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>"><span><?=GetMessage("IBLOCK_FORM_SUBMIT")?></span></button>
			</div>
		</blockquote>
	<?=$arResult["FORM_FOOTER"]?>
<?}?>


<script> $(document).ready(function() { $(".section_title a").click(function(){ $(this).toggleClass('opened').parents(".section_title").next().toggle(); }); });</script>
<script>
	$('input.phone').mask("+7999-999-99-99");
</script>