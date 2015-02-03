<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?
CUser::GetList(
  "",
 "desc",
 array(),
 array()
)

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>