<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h2><?=GetMessage('USER_INFO_TITLE')?></h2>

<?=ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	echo ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<form class="ishop personal" method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
	<?=$arResult["BX_SESSION_CHECK"]?>
	<input type="hidden" name="lang" value="<?=LANG?>" />
	<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
	<input type="hidden" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
	
	<label for="NAME"><?=GetMessage('NAME')?></label>
	<input type="text" id="NAME" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" />
	<label for="LAST_NAME"><?=GetMessage('LAST_NAME')?></label>
	<input type="text" id="LAST_NAME" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
	<label for="LOGIN"><?=GetMessage('LOGIN')?><span class="starrequired">*</span></label>
	<input required type="text" id="LOGIN" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
	<label for="EMAIL"><?=GetMessage('EMAIL')?><span class="starrequired">*</span></label>
	<input required type="email" id="EMAIL" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
	<label for="PERSONAL_PHONE"><?=GetMessage('USER_PHONE')?></label>
	<input type="text" id="PERSONAL_PHONE" name="PERSONAL_PHONE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" />
	<label for="PERSONAL_BIRTHDAY"><?=GetMessage('USER_BIRTHDAY_DT')?></label>
	<?$APPLICATION->IncludeComponent(
		'bitrix:main.calendar',
		'',
		array(
			'SHOW_INPUT' => 'Y',
			'FORM_NAME' => 'form1',
			'INPUT_NAME' => 'PERSONAL_BIRTHDAY',
			'INPUT_VALUE' => $arResult["arUser"]["PERSONAL_BIRTHDAY"],
			'SHOW_TIME' => 'N'
		),
		null,
		array('HIDE_ICONS' => 'Y')
	);?>
	<br /><br />
	<div class="change_password">
		<div class="title"><?=GetMessage('CHANGE_PASSWORD')?></div>
		<label for="NEW_PASSWORD"><?=GetMessage('NEW_PASSWORD_REQ')?></label>
		<input type="password" id="NEW_PASSWORD" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input" />
		<label for="NEW_PASSWORD_CONFIRM"><?=GetMessage('NEW_PASSWORD_REQ_REPEAT')?></label>
		<input type="password" id="NEW_PASSWORD_CONFIRM" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" />
	</div>
	<br />
	<button type="submit" name="save" value="<?=GetMessage("MAIN_SAVE")?>" class="button b"><span><?=GetMessage('SAVE_ALL')?></span></button>
</form>

