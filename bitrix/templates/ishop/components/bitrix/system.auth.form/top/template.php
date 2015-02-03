<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>

<div class="auth_form">
	<?if(!$USER->IsAuthorized()){?>
	<a href="<?=SITE_DIR;?>./auth/" class="auth_enter"><span><?=GetMessage('PERSONAL_CABINET')?></span></a>
	<?}else{?>
		<a href="<?=$arResult["PROFILE_URL"]?>" class="name"><?=$arResult["USER_NAME"]?> [ <?=$arResult["USER_LOGIN"]?> ]</a> <a href="/?logout=yes&amp;login=yes" class="exit"></a>
	<?}?>
</div>
