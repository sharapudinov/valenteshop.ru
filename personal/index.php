<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>
<div class="inside_page_content"> 
  <p>В личном кабинете Вы можете проверить текущее состояние корзины, ход выполнения Ваших заказов, просмотреть или изменить личную информацию, а также подписаться на новости и другие информационные рассылки. </p>
 							 
  <h4>Личная информация</h4>
 
  <ul> 	 
    <li><a href="/personal/profile/" >Изменить регистрационные данные</a></li>
   </ul>
 
  <h4>Заказы</h4>
 
  <ul> 	 
    <li><a href="/personal/order/" >Ознакомиться с состоянием заказов</a></li>
   </ul>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>