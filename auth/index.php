<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if(!$USER->IsAuthorized()){
	$APPLICATION->AuthForm('', true, true);
}else{
	ShowMessage(array("TYPE" => "OK", "MESSAGE" => "Вы зарегистрированы и успешно авторизовались."));
	LocalRedirect("/personal/");
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>