<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Ошибка 404 - Страница не найдена");
/*$APPLICATION->SetTitle("Запрашиваемая страница не найдена ");*/
/*$APPLICATION->ShowTitle(false);*/
/*
$APPLICATION->IncludeComponent("bitrix:main.map", ".default", array(
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"SET_TITLE" => "Y",
	"LEVEL"	=>	"3",
	"COL_NUM"	=>	"2",
	"SHOW_DESCRIPTION" => "Y"
	),
	false
);
*/
?>
<h1 class="title">Запрашиваемая страница не найдена</h1>
<b>Возможные причины, по которым возникла эта ошибка:</b> 
<br />
 
<ul>
  <li><b>Не правильно указан адрес страницы.</b> 
    <br />
   Проверьте правильность набора адреса страницы в адресной строке браузера.</li>

  <li><b>Эта страница была удалена с сервера либо перемещена по другому адресу.</b> 
    <br />
   Попробуйте найти интересующий документ, используя навигацию по разделам сайта. </li>
</ul>
 <?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>