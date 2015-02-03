<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
extract($_REQUEST, EXTR_SKIP);
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".SITE_TEMPLATE_ID."/main/auth/auth_form.php");
$cur_page = $GLOBALS["APPLICATION"]->GetCurPage();
$str = "";
if(defined("AUTH_404"))
{
	$page = SITE_DIR."auth.php";
	$str = "<input type='hidden' name='backurl' value='".$GLOBALS["APPLICATION"]->GetCurPage()."'>";
}
else 
	$page = $cur_page;

ShowMessage($arAuthResult);
?>
<form class="ishop auth" method="POST" action="<?echo htmlspecialcharsbx($page).(($s=DeleteParam(array("register"))) == ""? "?register=yes":"?$s&register=yes")?>" name="bform">
<?=$str?>
<input type="hidden" name="AUTH_FORM" value="Y">
<input type="hidden" name="TYPE" value="REGISTRATION">
	
	<label><?=GetMessage("AUTH_NAME")?></label>
	<input type="text" name="USER_NAME" size="30" maxlength="50" value="<?echo htmlspecialcharsbx($USER_NAME)?>" class="inputtext">
	<label><?=GetMessage("AUTH_LAST_NAME")?></label>
	<input type="text" name="USER_LAST_NAME" maxlength="50" size="30" value="<?echo htmlspecialcharsbx($USER_LAST_NAME)?>" class="inputtext">
	<label><?=GetMessage("AUTH_LOGIN_MIN")?><font class="starrequired">*</font></label>
	<input type="text" name="USER_LOGIN" size="30" maxlength="50" value="<?echo htmlspecialcharsbx($USER_LOGIN)?>" class="inputtext">
	<label><?=GetMessage("AUTH_PASSWORD_MIN")?><font class="starrequired">*</font><?=GetMessage("AUTH_PASSWORD_MIN")?></label>
	<input type="password" name="USER_PASSWORD" size="30" maxlength="50" value="<?echo htmlspecialcharsbx($USER_PASSWORD)?>" class="inputtext">
	<label><?=GetMessage("AUTH_CONFIRM")?><font class="starrequired">*</font></label>
	<input type="password" name="USER_CONFIRM_PASSWORD" size="30" maxlength="50" value="<?echo htmlspecialcharsbx($USER_CONFIRM_PASSWORD)?>" class="inputtext">
	<label>E-Mail:<font class="starrequired">*</font></label>
	<input type="text" name="USER_EMAIL" size="30" maxlength="255" value="<?echo htmlspecialcharsbx(strlen($sf_EMAIL)>0? $sf_EMAIL:$USER_EMAIL)?>" class="inputtext">
		<?$arUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("USER", 0, LANGUAGE_ID);
			if (is_array($arUserFields) && count($arUserFields) > 0)
			{
				foreach ($arUserFields as $FIELD_NAME => $arUserField)
				{
					if ($arUserField["MANDATORY"] != "Y")
						continue;
					$arUserField["EDIT_FORM_LABEL"] = htmlspecialcharsbx(strLen($arUserField["EDIT_FORM_LABEL"]) > 0 ? $arUserField["EDIT_FORM_LABEL"] : $arUserField["FIELD_NAME"]);
				?><label><?=$arUserField["EDIT_FORM_LABEL"]?>:<?if ($arUserField["MANDATORY"]=="Y"):?><span class="required">*</span><?endif;?></label>
				<?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit", 
				$arUserField["USER_TYPE"]["USER_TYPE_ID"], 
				array("bVarsFromForm" => (empty($arAuthResult) ? false : true) , "arUserField" => $arUserField, "form_name" => "bform"));?>
				<?
				}
			}
				/* CAPTCHA */
				if (COption::GetOptionString("main", "captcha_registration", "N") == "Y")
				{
					$capCode = $GLOBALS["APPLICATION"]->CaptchaGetCode();?>
						<input type="hidden" name="captcha_sid" value="<?= htmlspecialcharsbx($capCode) ?>">
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($capCode) ?>" width="180" height="40">
						<label><?=GetMessage("CAPTCHA_REGF_PROMT")?>:<font class="starrequired">*</font></label>
						<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext">
					<?
				}
				/* CAPTCHA */
				?>
				<br/><button class="button2" type="Submit" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>" class="inputbodybutton"><span><?=GetMessage("AUTH_REGISTER")?></span></button><br/><br/>

	<p><font class="starrequired">*</font><font class="text"><?=GetMessage("AUTH_REQ")?></font></p>

	<p><font class="text">
	<a href="<?=$cur_page.($s=="" ? "?login=yes" : "?$s&login=yes")?>"><b><?=GetMessage("AUTH_AUTH")?></b></a>
	</font></p> 

</form>

<script>
<!--
document.bform.USER_NAME.focus();
// -->
</script>